-- Active: 1723058837855@@127.0.0.1@3306@packaging

-----------------------------------
            --TRIGGERS
-----------------------------------
SELECT TRIGGER_NAME, EVENT_MANIPULATION, EVENT_OBJECT_TABLE, ACTION_STATEMENT, ACTION_TIMING 
FROM information_schema.TRIGGERS 
WHERE TRIGGER_SCHEMA = 'embalaje';

DROP TRIGGER after_insert_tag

--Calcular el volumen de la caja en un insert
DELIMITER $$
CREATE TRIGGER calculate_box_volume_insert
BEFORE INSERT ON box
FOR EACH ROW
Begin
    SET NEW.volume = NEW.height*NEW.width*NEW.length;
END $$
DELIMITER;


--Calcular el volumen de la caja en un update
DELIMITER $$
CREATE TRIGGER calculate_box_volume_update
BEFORE UPDATE ON box
FOR EACH ROW
Begin
    SET NEW.volume = NEW.height*NEW.width*NEW.length;
END $$
DELIMITER;

--Tigger para sacar el volumen del embalaje en insert y update

DELIMITER $$
CREATE TRIGGER calculate_packaging_volume_insert
BEFORE INSERT ON packaging
FOR EACH ROW
Begin
    SET NEW.volume = NEW.height*NEW.width*NEW.length;
END $$
DELIMITER;


DELIMITER $$
CREATE TRIGGER calculate_packaging_volume_update
BEFORE UPDATE ON packaging
FOR EACH ROW
Begin
    SET NEW.volume = NEW.height*NEW.width*NEW.length;
END $$


--Trigger para sacer el volumen de un producto en insert y update
DELIMITER $$
CREATE TRIGGER calculate_product_volume_insert
BEFORE INSERT ON product
FOR EACH ROW
Begin
    SET NEW.volume = NEW.height*NEW.width*NEW.length;
END $$


DELIMITER $$
CREATE TRIGGER calculate_product_volume_insert
BEFORE INSERT ON product
FOR EACH ROW
Begin
    SET NEW.volume = NEW.height*NEW.width*NEW.length;
END $$


--TRIGER DE MATERIAL

DELIMITER $$

CREATE TRIGGER material_packging_insert
AFTER INSERT ON material_packging
FOR EACH ROW
BEGIN
    UPDATE material
    SET available_quantity = available_quantity - NEW.quantity
    WHERE code = NEW.material;
END $$

DELIMITER $$

CREATE TRIGGER material_package_insert
AFTER INSERT ON material_package
FOR EACH ROW
BEGIN
    UPDATE material
    SET available_quantity = available_quantity - NEW.quantity
    WHERE code = NEW.material;
END $$

---Etiqueta

drop Trigger before_insert_tag

CREATE TRIGGER before_insert_tag
BEFORE INSERT ON tag
FOR EACH ROW
BEGIN
    DECLARE checksum INT DEFAULT 0;
    DECLARE gs1_code VARCHAR(255);
    DECLARE i INT DEFAULT 1;
    DECLARE len INT;
    DECLARE digito INT;
    DECLARE suma_impar INT DEFAULT 0;
    DECLARE suma_par INT DEFAULT 0;

    -- Generar el código GS1-128 básico (sin checksum)
    SET gs1_code = CONCAT(
        '(17)', DATE_FORMAT(NEW.date, '%y%m%d'),
        '(410)', NEW.destination,
        '(420)', NEW.tag_type
    );
    
    -- Longitud del código generado
    SET len = CHAR_LENGTH(gs1_code);

    -- Calcular el checksum recorriendo cada carácter
    WHILE i <= len DO
        SET digito = CAST(SUBSTRING(gs1_code, i, 1) AS UNSIGNED);

        IF i % 2 = 1 THEN
            -- Sumar posición impar y multiplicar por 3
            SET suma_impar = suma_impar + digito;
        ELSE
            -- Sumar posición par
            SET suma_par = suma_par + digito;
        END IF;
        
        SET i = i + 1;
    END WHILE;

    -- Sumar los resultados y calcular el checksum
    SET checksum = (10 - ((suma_impar * 3 + suma_par) % 10)) % 10;

    -- Concatenar el checksum al final del código GS1-128
    SET NEW.barcode = CONCAT(gs1_code, checksum);
END;

select * from tag

Insert into tag (date,tag_type,destination)
values ('2024-10-30','TT03','UABC')

CREATE TRIGGER before_UPDATE_tag
BEFORE UPDATE ON tag
FOR EACH ROW
BEGIN
    DECLARE checksum INT DEFAULT 0;
    DECLARE gs1_code VARCHAR(255);
    DECLARE i INT DEFAULT 1;
    DECLARE len INT;
    DECLARE digito INT;
    DECLARE suma_impar INT DEFAULT 0;
    DECLARE suma_par INT DEFAULT 0;

    -- Generar el código GS1-128 básico (sin checksum)
    SET gs1_code = CONCAT(
        '(17)', DATE_FORMAT(NEW.date, '%y%m%d'),
        '(410)', NEW.destination,
        '(420)', NEW.tag_type
    );
    
    -- Longitud del código generado
    SET len = CHAR_LENGTH(gs1_code);

    -- Calcular el checksum recorriendo cada carácter
    WHILE i <= len DO
        SET digito = CAST(SUBSTRING(gs1_code, i, 1) AS UNSIGNED);

        IF i % 2 = 1 THEN
            -- Sumar posición impar y multiplicar por 3
            SET suma_impar = suma_impar + digito;
        ELSE
            -- Sumar posición par
            SET suma_par = suma_par + digito;
        END IF;
        
        SET i = i + 1;
    END WHILE;

    -- Sumar los resultados y calcular el checksum
    SET checksum = (10 - ((suma_impar * 3 + suma_par) % 10)) % 10;

    -- Concatenar el checksum al final del código GS1-128
    SET NEW.barcode = CONCAT(gs1_code, checksum);
END;

--Trigger para que se actulize automaticamente la available_capacity en zona  despues de insert en packaging

DELIMITER $$

CREATE TRIGGER update_zone_capacity_after_insert
AFTER INSERT ON packaging
FOR EACH ROW
BEGIN
    UPDATE zone
    SET available_capacity = available_capacity - NEW.package_quantity
    WHERE code = NEW.zone;
END$$

DELIMITER ;

--Trigger para el estado de trazabilidad

--Trigger para la cantidad de salida de los embalajes tabla outbound



--Pensar el nombre correcto en ingles


DELIMITER $$
CREATE PROCEDURE Sp_RegistroSalidaEmbalaje (
    IN p_packaging_code VARCHAR(5), 
    IN p_exit_quantity INT          
)
BEGIN
    DECLARE available_quantity INT;

    SELECT package_quantity INTO available_quantity
    FROM packaging
    WHERE code = p_packaging_code;

    IF available_quantity IS NULL THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Packaging not found.';
    ELSEIF available_quantity < p_exit_quantity THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Insufficient quantity in inventary.';
    ELSE
        UPDATE packaging
        SET package_quantity = package_quantity - p_exit_quantity
        WHERE code = p_packaging_code;


        INSERT INTO outbound (date, exit_quantity)
        VALUES (CURRENT_DATE, p_exit_quantity);
    END IF;
END $$


--DUDAAAA
--Trigger peso paquete

--Trigger peso embalaje
