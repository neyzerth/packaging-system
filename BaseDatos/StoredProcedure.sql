-- Active: 1728665066730@@127.0.0.1@3306@packaging
-----------------------------------
        --STORED PROCEDURE
-----------------------------------

drop Procedure check_zone_capacity

CREATE PROCEDURE sp_check_zone_capacity (
    IN zone_code VARCHAR(5), 
    IN package_quantity INT, 
    OUT result BIT
)
BEGIN
    DECLARE capacity INT;
    
    SELECT available_capacity INTO capacity 
    FROM zone
    WHERE code = zone_code;
    
    IF capacity >= package_quantity THEN
        SET result = TRUE;
    ELSE
        SET result = FALSE;
    END IF;
END;

select * from zone

CALL check_zone_capacity('Z001',55,@Resultado);

select @Resultado as respuesta




--Pudieramos cambiar el nombre a search_report
CREATE PROCEDURE sp_generate_report(
    IN start_date DATE,
    IN end_date DATE
)
BEGIN
    SELECT * FROM report 
    WHERE start_date = start_date
    AND end_date = end_date ;
END;


call sp_generate_report ('2024-09-01','2024-09-30');


--Pudieramos hacer un sp o  triggers que al hacer un moviento en el proceso del embalaje actualice la tabla estado de la trazabilidad
--Creo que seria mejor un trigger por que nos evitamos tener que mandarlo a llamar
--


--usuario general
DELIMITER $$
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
        p_username, p_password, p_name, p_first_surname, p_second_surname,
        p_date_of_birth, p_neighborhood, p_street, p_postal_code, p_phone,
        p_email, p_user_type, p_supervisor
    );

    SELECT num, username, full_name, user
    FROM vw_user_personal_info
    WHERE username = p_username;

END $$

DELIMITER $$
CREATE PROCEDURE validateUser(IN usern VARCHAR(30), IN passw VARCHAR(50))
BEGIN
    DECLARE user_exists INT;
    SET user_exists = (
        SELECT COUNT(*) FROM user 
        WHERE username = usern 
        AND password = passw
        AND active = 1
    );
    
    IF user_exists = 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Invalid username or password';
    END IF;

    SELECT num, username, user_type 
    FROM vw_user_info
    WHERE username = usern;

END $$
DELIMITER $$

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

DELIMITER $$
CREATE PROCEDURE addMaterial(
    IN p_code VARCHAR(5),
    IN p_name VARCHAR(50),
    IN p_description VARCHAR(255),
    IN p_unit VARCHAR(5)
)
BEGIN
    DECLARE exist_unit INT;

    SELECT COUNT(*) INTO exist_unit
    FROM unit_of_measure WHERE code = p_unit;

    IF exist_unit = 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Invalid unit of measure code';
    END IF;

    INSERT INTO material (code, material_name, description, available_quantity, unit_of_measure)
    VALUES(p_code, p_name, p_description, 0, p_unit);

    SELECT code, material_name, description, available_quantity, unit_of_measure
    FROM material WHERE code = p_code;
END $$

--sp para insertar embalaje sin el campo de salida
DELIMITER $$

CREATE PROCEDURE addPackaging(
    IN p_code varchar(5),
    IN p_height DECIMAL(10, 2),
    IN p_width DECIMAL(10, 2),
    IN p_length DECIMAL(10, 2),
    IN p_package_quantity INT,
    IN p_zone VARCHAR(5),
    IN p_tag int,
)
BEGIN
    DECLARE exist_unit INT;

    SELECT COUNT(*) INTO exist_unit
    FROM Packaging WHERE code = p_code;

    IF exist_unit = 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Invalid Packaging code';
    END IF;

    INSERT INTO packaging(code,height,width,length,package_quantity,zone,tag)
    VALUES(p_code,p_height,p_width,p_length,p_package_quantity,p_zone,p_tag)

    SELECT code,volume,package_quantity,zone
    FROM PACKAGING WHERE code = p_code;
END$$


--sp para insertar salida
DELIMITER $$
CREATE Procedure addOutbound(
    IN p_num INT,
    IN p_date DATE,
    IN p_exit_quantity INT
)
BEGIN
    SELECT COUNT(*) INTO exist_unit
    FROM bound WHERE num = p_num;

    IF exist_unit = 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Invalid Packaging code';
    END IF;

    INSER INTO bound(num,date,exit_quantity)
    VALUES(p_num,p_date,p_exit_quantity)

    SELECT num,date,exit_quantity
    FROM bound WHERE num = p_num;
END$$

--sp para insertar Zona
DELIMITER $$
CREATE PROCEDURE addZone(
    In p_code VARCHAR(5),
    In p_area VARCHAR(50),
    In p_available_capacity INT,
    In p_total_capacity INT
)
BEGIN
    DECLARE exist_unit INT;

    SELECT COUNT(*) INTO exist_unit
    FROM zone WHERE code = p_code;

    IF exist_unit = 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Invalid Zone code';
    END IF;

    INSERT INTO zone(code,area,available_capacity,total_capacity)
    VALUES(p_code,p_area,p_available_capacity,p_total_capacity)

    SELECT code,area,available_capacity,total_capacity
    FROM zone WHERE code = p_code;
END $$


--sp para insertar informe  ///CORREGIR
DELIMITER $$
CREATE Procedure addReport(
    IN p_folio INT,
    IN p_start_date DATE,
    IN p_end_date DATE,
    IN p_report_date DATE,
    IN p_packed_products INT,
    IN p_observations TEXT,
    IN p_traceability INT,
)
BEGIN
    DECLARE exist_unit INT;

    SELECT COUNT(*) INTO exist_unit
    FROM report WHERE code = p_folio;

    IF exist_unit = 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Invalid Zone code';
    END IF;

    INSERT INTO report(folio,start_date,end_date,report_date,packed_products,observations,traceability)
    VALUES(p_folio,p_start_date,p_end_date,p_report_date,p_packed_products,p_observations,p_traceability)

    SELECT start_date,end_date,packed_products,observations,traceability
    FROM report where folio = p_folio
END$$

--sp para insertar tag
DELIMITER $$
CREATE Procedure addTag(
    IN p_num INT,
    IN p_date DATE,
    IN p_barcode VARCHAR(255),
    IN p_tag_type varchar(5),
    IN p_destination VARCHAR(25),
)
BEGIN
    DECLARE exist_unit INT;

    SELECT COUNT(*) INTO exist_unit
    FROM tag WHERE num = p_num;

    IF exist_unit = 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Invalid Tag number';
    END IF;

    INSERT INTO tag(num,date,barcode,tag_type,destination)
    VALUES (p_num,p_date,p_barcode,p_tag_type,p_destination)

    SELECT num,date,barcode,tag_type,destination
    from tag where num = p_num
END$$

--sp para darle salida a un embalaje (Seria hacer un update en la tabla de embalaje)