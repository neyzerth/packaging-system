-- Active: 1728065056405@@127.0.0.1@3306@packaging_test
--Apartado para la creacion de vistas 
--FALATARIA AGREGARLE ALIAS A LOS CAMPOS QUE LO REQUIERAN
--En los que tienen _ deberia de quitarselo y agregar un espacio hblando del alias?

--Vistas de Usuario
CREATE VIEW vw_user_info AS
SELECT 
    num,
    username,
    password,
    active,
    user_type,
    supervisor
FROM user AS u WHERE u.active = 1;

drop View vw_user_personal_info

CREATE VIEW vw_user_personal_info AS
SELECT 
    num,
    CONCAT(name,' ',first_surname,IFNULL(CONCAT(' ',second_surname), '')) AS full_name,
    DATE_FORMAT(date_of_birth, "%M/%d/%y") AS date_of_birth,
    username,
    neighborhood,
    street,
    postal_code,
    phone,
    email,
    (SELECT name FROM user_type 
    WHERE code = u.user_type) AS user
FROM user AS u WHERE u.active = 1;

select * from vw_user_personal_info

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
where supervisor is NULL and user_type <> 'admin';


--VISTA DE CAJA
CREATE VIEW vw_box_info AS
SELECT 
    num,
    height,
    width,
    length,
    volume,
    weight
FROM box;

--VISTA ZONA
CREATE VIEW vw_zone_info AS
SELECT 
    code,
    area,
    available_capacity,
    total_capacity
FROM zone;

--VISTA DE SALIDA
CREATE VIEW vw_outbound_info AS
SELECT 
    num,
    date,
    exit_quantity
FROM outbound;

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
CREATE VIEW vw_material_info AS
SELECT 
    code,
    name,
    description,
    available_quantity,
    unit_of_measure
FROM material;

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
CREATE VIEW vw_packaging_protocol_info AS
SELECT 
    num,
    name,
    file_name
FROM packaging_protocol;


--VISTA DE PRODUCTO
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
FROM product;

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
LEFT JOIN report AS r ON r.traceability = t.num;

--VISTA DE INCIDENCIA
CREATE VIEW vw_incident_info AS
SELECT 
    num,
    date,
    description,
    user,
    traceability
FROM incident;

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
