-- Active: 1728665066730@@127.0.0.1@3306@packaging
--Apartado para la creacion de vistas 
--FALATARIA AGREGARLE ALIAS A LOS CAMPOS QUE LO REQUIERAN
--En los que tienen _ deberia de quitarselo y agregar un espacio hblando del alias?

--Vistas de Usuario
DROP VIEW vw_user_info;
CREATE VIEW vw_user_info AS
SELECT 
    num,
    username,
    password,
    user_type,
    supervisor
FROM user AS u WHERE u.active = 1;

drop View vw_user_personal_info;

CREATE VIEW vw_user_personal_info AS
SELECT 
    num,
    CONCAT(name,' ',first_surname,IFNULL(CONCAT(' ',second_surname), '')) AS full_name,
    DATE_FORMAT(date_of_birth, "%m/%d/%y") AS date_of_birth,
    username,
    neighborhood,
    street,
    postal_code,
    phone,
    email,
    (SELECT name FROM user_type 
    WHERE code = u.user_type) AS user
FROM user AS u WHERE u.active = 1;



CREATE VIEW vw_supervisor AS
SELECT num,
    username,
    CONCAT(name,' ',first_surname,IFNULL(CONCAT(' ',second_surname), '')) AS full_name,
    DATE_FORMAT(date_of_birth, "%M/%d/%y") AS date_of_birth,
    neighborhood,
    street,
    postal_code,
    phone,
    email
From user
where supervisor is NULL and user_type <> 'admin' and active = 1;



create view vw_userType_info as 
Select code,
name,
description,
active
From user_type;


--VISTA DE CAJA
DROP VIEW vw_box_info;
CREATE VIEW vw_box_info AS
SELECT 
    num,
    height,
    width,
    length,
    volume,
    weight
FROM box WHERE active = 1;

--VISTA ZONA
DROP VIEW vw_zone_info;
CREATE VIEW vw_zone_info AS
SELECT 
    code,
    area,
    available_capacity,
    total_capacity
FROM zone WHERE active = 1
AND available_capacity > 0;


--VISTA DE SALIDA
DROP VIEW vw_outbound_info;
CREATE VIEW vw_outbound_info AS
SELECT 
    num,
    date,
    exit_quantity
FROM outbound WHERE active = 1;

--VISTA ETIQUETA
CREATE VIEW vw_tag_info AS
SELECT 
    num,
    date,
    barcode,
    tag_type,
    destination
FROM tag;


--VISTA EMBALAJE

CREATE VIEW vw_packaging_info AS
SELECT 
    num,
    height,
    width,
    length,
    package_quantity,
    zone,
    outbound,
    tag
FROM packaging;

--VISTA MATERIAL
DROP VIEW vw_material_info;
CREATE VIEW vw_material_info AS
SELECT 
    code,
    name,
    description,
    available_quantity,
    unit_of_measure
FROM material WHERE active = 1;

--VISTA PAQUETE
CREATE VIEW vw_package_info AS
SELECT 
    num,
    product_quantity,
    weight,
    product,
    packaging,
    box,
    tag
FROM package;

--VISTA PROTOCOLO EMBALAJE
DROP VIEW vw_packaging_protocol_info;
CREATE VIEW vw_packaging_protocol_info AS
SELECT 
    num,
    name,
    file_name
FROM packaging_protocol WHERE active = 1;


--VISTA DE PRODUCTO
DROP VIEW vw_product_info;
CREATE VIEW vw_product_info AS
SELECT 
    code,
    name,
    description,
    height,
    width,
    length,
    weight,
    packaging_protocol
FROM product WHERE active = 1;

DROP VIEW vw_traceability_info;
--VISTA DE TRAZABILIDAD
CREATE VIEW vw_traceability_info AS
SELECT 
    t.num AS ID,
    IFNULL(p.name, "--") AS Product,
    IFNULL(t.packaging, "--") AS Packaging_ID,
    s.description AS State,
    r.start_date AS Date
FROM traceability AS t
LEFT JOIN product AS p ON p.code = t.product
LEFT JOIN state AS s ON s.code = t.state
LEFT JOIN report AS r ON r.traceability = t.num
ORDER BY ID desc;
--VISTA DE INCIDENCIA
CREATE VIEW vw_incident_info AS
SELECT 
    num,
    date,
    description,
    user,
    traceability
FROM incident;

--VISTA DE UNIDAD DE MEDIDA

CREATE VIEW vw_unitOfMeasure_info AS
SELECT
    code,
    description
FROM unit_of_measure;

--VISTA DE REPORTE
CREATE VIEW vw_report_info AS
SELECT
    folio,
    start_date,
    end_date,
    report_date,
    packed_products,
    observations,
    traceability
FROM report;

--VISTA DE TAG TYPE
CREATE VIEW vw_tag_type_info AS
SELECT
    code,
    description
FROM tag_type;

--VISTA DE USER_TYPE
CREATE VIEW vw_user_type_info AS
SELECT
    code,
    name,
    description
FROM user_type;

--VISTA DE USER_EDIT
DROP VIEW vw_user_edit_info;
CREATE VIEW vw_user_edit_info AS
SELECT
    num,
    name,
    first_surname,
    second_surname,
    date_of_birth,
    username,
    email,
    phone,
    password,
    user_type,
    supervisor,
    postal_code,
    neighborhood,
    street
FROM user;



SELECT * FROM vw_process;


CREATE VIEW vw_users_in_process AS
SELECT ut.traceability AS Traceability_ID,
    ut.user AS User_ID,
    u.full_name AS User_Name
FROM user_traceability AS ut
INNER JOIN vw_user_personal_info AS u 
ON u.num = ut.user;

drop view vw_material_process;
CREATE VIEW vw_material_process AS
SELECT m.code AS Code, 
    m.name AS Material, 
    mp.quantity AS Quantity,
    m.unit_of_measure AS Unit,
    mp.packaging AS Packaging 
FROM material_packging AS mp
INNER JOIN material AS m 
ON m.code = mp.material

DROP VIEW vw_process;

CREATE VIEW vw_process AS
SELECT 
    t.num AS Traceability,
    p.code AS Product_Code,
    p.name AS Product,
    (
        SELECT product_quantity 
        FROM package 
        WHERE packaging = t.packaging
        LIMIT 1
    ) AS Product_Quantity,
    pp.file_name AS File_Protocol,
    pp.name AS Protocol,
    pk.package_quantity AS Package_Quantity,
    (
        SELECT tag FROM package
        WHERE packaging = t.packaging
        LIMIT 1
    ) AS Package_Tag,
    (
        SELECT description FROM tag_type
        WHERE code = (
            SELECT tag_type FROM tag
            WHERE num = Package_Tag
        )
    ) AS Package_Type,
    (
        SELECT tag FROM packaging
        WHERE num = t.packaging
    ) AS Packaging_Tag,
    (
        SELECT description FROM tag_type
        WHERE code = (
            SELECT tag_type FROM tag
            WHERE num = Packaging_Tag
        )
    ) AS Packaging_Type,
    t.packaging AS Packaging,
    tg.barcode AS Packaging_Barcode,
    t.state AS State_Code,
    s.description AS State,
    r.start_date AS Start_Date,
    z.area AS Area,
    z.total_capacity AS Capacity,
    z.available_capacity AS Available
FROM traceability AS t
LEFT JOIN report AS r ON t.num = r.traceability
LEFT JOIN state AS s ON t.state = s.code
LEFT JOIN packaging AS pk ON t.packaging = pk.num
LEFT JOIN tag AS tg ON tg.num = pk.tag
LEFT JOIN tag_type AS tgt ON tgt.code = tg.tag_type 
LEFT JOIN product AS p ON t.product = p.code
LEFT JOIN packaging_protocol AS pp ON pp.num = p.packaging_protocol
LEFT JOIN zone AS z ON z.code = pk.zone;

SELECT * FROM vw_process;


CREATE VIEW vw_users_in_process AS
SELECT ut.traceability AS Traceability_ID,
    ut.user AS User_ID,
    u.full_name AS User_Name
FROM user_traceability AS ut
INNER JOIN vw_user_personal_info AS u 
ON u.num = ut.user;

drop view vw_material_process;
CREATE VIEW vw_material_process AS
SELECT m.code AS Code, 
    m.name AS Material, 
    mp.quantity AS Quantity,
    m.unit_of_measure AS Unit,
    mp.packaging AS Packaging 
FROM material_packging AS mp
INNER JOIN material AS m 
ON m.code = mp.material


--1. Reporte de embalajes hechos y enviados por mes

drop View packaging_sent_report

CREATE VIEW packaging_sent AS
SELECT 
    DATE_FORMAT(o.date, '%Y-%m') AS month,
    COUNT(p.num) AS total_packaging_sent
FROM packaging p
JOIN outbound o ON p.outbound = o.num
WHERE o.date IS NOT NULL
GROUP BY DATE_FORMAT(o.date, '%Y-%m');

select * from packaging_sent

select * from traceability where state = 'warhs'



--2. Productos más embalados por mes MES, PRODUCT, TOTAL
drop VIEW  top_packaged_products

CREATE VIEW top_packaged_products AS
SELECT 
    DATE_FORMAT(t.date, '%Y-%m') AS month,
    pr.name AS product_name,
    SUM(pa.product_quantity * pk.package_quantity) AS total_quantity
FROM  package pa
JOIN product pr ON pa.product = pr.code
JOIN packaging pk ON pa.packaging = pk.num
JOIN tag t ON pa.tag = t.num
GROUP BY 
    DATE_FORMAT(t.date, '%Y-%m'), pr.name
ORDER BY 
    month, total_quantity DESC;



select * from top_packaged_products

--3. Embalajes sin rotación / con más tiempo en el warehouse

drop VIEW packaging_no_rotation

CREATE VIEW packaging_no_rotation AS
SELECT 
    p.num AS packaging_id,
    p.volume,
    p.weight,
    z.area AS zone,
    DATEDIFF(CURDATE(), t.date) AS days_in_warehouse
FROM 
    packaging p
LEFT JOIN 
    traceability tr ON p.num = tr.packaging
LEFT JOIN state s ON tr.state = s.code
LEFT JOIN tag t ON p.tag = t.num
JOIN zone z ON p.zone = z.code
WHERE 
    tr.state = 'warhs'
ORDER BY 
    days_in_warehouse DESC;

select * from traceability  

select * from packaging_no_rotation

--4. Empleados más chambeadores
CREATE VIEW top_employees AS
SELECT 
    u.num AS user_id,
    u.name AS user_name,
    u.first_surname,
    COUNT(ut.traceability) AS processes_involved
FROM user_traceability ut
JOIN user u ON ut.user = u.num
GROUP BY 
    u.num, u.name, u.first_surname
ORDER BY 
    processes_involved DESC;

select * from top_employees

SELECT * FROM top_packaged_products;

