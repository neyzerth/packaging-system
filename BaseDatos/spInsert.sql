---------------------------------------
--Insertar registro
---------------------------------------
drop Procedure addUser
DELIMITER $$

--Este procedimiento dice que invalid colum username pero eso se debia a que la vista vw_user_personal_info
--no tiene la columna username entonces la agregue
CREATE PROCEDURE addUser(
    IN p_username VARCHAR(30),
    IN p_password VARCHAR(20),
    IN p_name VARCHAR(50),
    IN p_first_surname VARCHAR(30),
    IN p_second_surname VARCHAR(30),
    IN p_date_of_birth DATE,
    IN p_neighborhood VARCHAR(50),
    IN p_street VARCHAR(50),
    IN p_postal_code INT,
    IN p_phone VARCHAR(15),
    IN p_email VARCHAR(30),
    IN p_user_type VARCHAR(5),
    IN p_supervisor INT
)
BEGIN

    DECLARE type_exists INT;
    SET type_exists = (SELECT COUNT(*) FROM user_type WHERE code = p_user_type);


    IF type_exists = 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Invalid user_type code';
    END IF;


    INSERT INTO user (
        username, password, name, first_surname, second_surname,
        date_of_birth, neighborhood, street, postal_code, phone,
        email, user_type, supervisor
    ) VALUES (
        p_username, SHA1(p_password), p_name, p_first_surname, p_second_surname,
        p_date_of_birth, p_neighborhood, p_street, p_postal_code, p_phone,
        p_email, p_user_type, p_supervisor
    );


    SELECT num, username, full_name, user
    FROM vw_user_personal_info
    WHERE username = p_username;
END $$
DELIMITER ;


CALL addUser('hola', 'hola', 'John', 'Doe', 'Smith', '1985-06-15', 'Downtown', 'Main Street 123', 
12345, '123-456-7890', 'jdoe@example.com', 'ADMIN', NULL);

select * from `user`



--Usertype
drop Procedure insertUserType

DELIMITER $$
Create PROCEDURE addUserType(
    IN p_code VARCHAR(5),
    IN p_name VARCHAR(50),
    IN p_description VARCHAR(100)
)
Begin
    INSERT into user_type (code,name,description)
    VALUES (p_code,p_name,p_description);

    Select code,name,description
    from tag_type
    where code = p_code;
END$$

call addUserType('a','a','a')

select * from user_type

--box
DELIMITER $$
CREATE PROCEDURE addBox(
    IN p_height DECIMAL(10,2),
    IN p_width DECIMAL(10,2),
    IN p_length DECIMAL(10,2),
    IN p_weight DECIMAL(10,2)
)
BEGIN
    INSERT INTO box (height, width, length, weight)
    VALUES(p_height, p_width, p_length, p_weight);

    SELECT num, height, width, length, volume, weight
    FROM box WHERE num = LAST_INSERT_ID();
END $$

CALL addBox (11.5, 12.0, 20.0, 10.0);

--Material
drop Procedure addMaterial
DELIMITER $$
CREATE PROCEDURE addMaterial(
    IN p_code VARCHAR(5),
    IN p_name VARCHAR(50),
    IN p_description VARCHAR(255),
    IN p_available_quantity int,
    IN p_unit VARCHAR(5)
)
BEGIN
    DECLARE exist_unit INT;

    SELECT COUNT(*) INTO exist_unit
    FROM unit_of_measure WHERE code = p_unit;

    IF exist_unit = 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Invalid unit of measure code';
    END IF;

    INSERT INTO material (code, name, description, available_quantity, unit_of_measure)
    VALUES(p_code, p_name, p_description, p_available_quantity, p_unit);

    SELECT code,name, description, available_quantity, unit_of_measure
    FROM material WHERE code = p_code;
END $$

call addMaterial('GDL','GOLD','N/A',77,'UOM01')

SELECT * FROM material


--Product FALTAAAAA AGREGAR VOLUMEN A LA BASE

Delimiter $$
Create PROCEDURE UpdateProduct(
    IN p_code VARCHAR(5),
    IN p_name VARCHAR(50),
    IN p_description VARCHAR(100),
    IN p_height DECIMAL(10,2),
    IN p_width DECIMAL(10,2),
    IN p_length DECIMAL(10,2),
    IN p_weight DECIMAL(10,2)
)
Begin
    Insert into(code,name,description,height,width,length,weight)
    values(p_code,p_name,p_description,p_heigh,p_width,p_length,p_weight)

--agegar volumen
    Select name,description,weight
    from product
    where code= p_code
END$$

--outBound
drop Procedure addOutbound

DELIMITER $$

CREATE PROCEDURE addOutbound(
    IN p_date DATE,
    IN p_exit_quantity INT
)
BEGIN
    DECLARE exist_unit INT DEFAULT 1; 

    INSERT INTO outbound(date, exit_quantity)
    VALUES (p_date, p_exit_quantity);

    SELECT num, date, exit_quantity
    FROM outbound
    WHERE num = LAST_INSERT_ID();
END $$
call addOutbound ('2023-1-1',7)
--Zone

drop Procedure addZone;
DELIMITER $$

DELIMITER $$

CREATE PROCEDURE addZone(
    IN p_code VARCHAR(5),
    IN p_area VARCHAR(50),
    IN p_available_capacity INT,
    IN p_total_capacity INT
)
BEGIN
    IF EXISTS (SELECT 1 FROM zone WHERE area = p_area) THEN
        SELECT 0 AS success, 'The area name is already in use.' AS message;
    ELSE
        INSERT INTO zone (code, area, available_capacity, total_capacity)
        VALUES (p_code, p_area, p_available_capacity, p_total_capacity);
        SELECT 1 AS success, 'Zone added successfully.' AS message;
    END IF;
END $$

DELIMITER ;



--Protocol

CREATE PROCEDURE addIncident(
    IN p_date DATE,
    IN p_description VARCHAR(255),
    IN p_traceability INT
)
BEGIN
    DECLARE traceability_count INT DEFAULT 0;

    SELECT COUNT(*) INTO traceability_count FROM trazabilidad WHERE num = p_traceability;

    IF traceability_count = 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Invalid traceability ID';
    END IF;

    INSERT INTO incident (date, description, traceability)
    VALUES (p_date, p_description, p_traceability);

    SELECT num, date, description, user, traceability
    FROM incident WHERE num = LAST_INSERT_ID();

END $$




--sp para insertar embalaje sin el campo de salida

drop Procedure addPackaging
DELIMITER $$
CREATE PROCEDURE addPackaging(
    IN p_code varchar(5),
    IN p_height DECIMAL(10, 2),
    IN p_width DECIMAL(10, 2),
    IN p_length DECIMAL(10, 2),
    IN p_weight DECIMAL(10, 2),
    IN p_package_quantity INT,
    IN p_zone VARCHAR(5),
    IN p_tag int
)
BEGIN
    INSERT INTO packaging(code,height,width,length,weight,package_quantity,zone,tag)
    VALUES(p_code,p_height,p_width,p_length,p_weight,p_package_quantity,p_zone,p_tag);

    SELECT code,volume,package_quantity,zone
    FROM PACKAGING WHERE code = p_code;
END$$

call addPackaging('PK007', 10.0, 15.0, 20.0, 25, 'Z001',1)




call addZone ('Z006','C',1,17)


--sp para insertar informe   //Que se ocupario insetar aqui?
drop Procedure addReport
DELIMITER $$
CREATE Procedure addReport(
    IN p_start_date DATE,
    IN p_end_date DATE,
    IN p_report_date DATE,
    IN p_packed_products INT,
    IN p_observations TEXT,
    IN p_traceability INT
)
BEGIN
    DECLARE exist_unit INT;

    IF exist_unit = 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Invalid Zone code';
    END IF;

    INSERT INTO report(start_date,end_date,report_date,packed_products,observations,traceability)
    VALUES(p_start_date,p_end_date,p_report_date,p_packed_products,p_observations,p_traceability);

    SELECT start_date,end_date,packed_products,observations,traceability
    FROM report where folio = LAST_INSERT_ID();
END $$

call addReport('2024-09-01', CURRENT_DATE, '2024-10-01', 1000, 'No major issues', 7)

--sp para insertar tag
drop Procedure addTag
DELIMITER $$
CREATE Procedure addTag(
    IN p_date DATE,
    IN p_tag_type varchar(5),
    IN p_destination VARCHAR(25)
)
BEGIN
    INSERT INTO tag(date,tag_type,destination)
    VALUES (p_date,p_tag_type,p_destination);

    SELECT num, barcode,date,tag_type,destination
    from tag where num = LAST_INSERT_ID();
END$$

call addTag(CURRENT_DATE, 'TT01','Tj')

select * from tag_type



--unidad de medida  --revisar
drop Procedure addUnit_of_measure

DELIMITER $$
CREATE PROCEDURE addUnit_of_measure(
    IN p_code VARCHAR(5),
    IN p_description VARCHAR(50)
)
BEGIN
    INSERT INTO unit_of_measure(code, description)
    VALUES (p_code, p_description);

    SELECT code, description
    FROM unit_of_measure
    WHERE code = p_code;
END$$

CALL addUnit_of_measure('UOM08', 'Prueba 4');

select * from unit_of_measure


--trazabilidad

--tablas muchos a muchos

DELIMITER $$

CREATE PROCEDURE addUserTraceability(
    IN p_user INT,
    IN p_traceability INT
)
BEGIN
    INSERT INTO user_traceability(user, traceability)
    VALUES (p_user, p_traceability);

    SELECT user, traceability
    FROM user_traceability
    WHERE user = p_user AND traceability = p_traceability;
END$$

CALL addUserTraceability(1, 100);


DELIMITER $$

CREATE PROCEDURE addMaterialPackging(
    IN p_packaging VARCHAR(5),
    IN p_material VARCHAR(5),
    IN p_quantity INT
)
BEGIN
    INSERT INTO material_packging(packaging, material, quantity)
    VALUES (p_packaging, p_material, p_quantity);

    SELECT packaging, material, quantity
    FROM material_packging
    WHERE packaging = p_packaging AND material = p_material;
END$$


select * from material_packging

DELIMITER $$

CREATE PROCEDURE addMaterialPackage(
    IN p_material VARCHAR(5),
    IN p_package INT,
    IN p_quantity INT
)
BEGIN
    INSERT INTO material_package(material, package, quantity)
    VALUES (p_material, p_package, p_quantity);

    SELECT material, package, quantity
    FROM material_package
    WHERE material = p_material AND package = p_package;
END$$


select * from material_package