-- Active: 1730432982636@@127.0.0.1@3306@packaging

SELECT TRIGGER_NAME, EVENT_MANIPULATION, EVENT_OBJECT_TABLE, ACTION_STATEMENT, ACTION_TIMING 
FROM information_schema.TRIGGERS 
WHERE TRIGGER_SCHEMA = 'packaging';


DELIMITER $$

--Calcular el volumen de la caja en un insert
CREATE TRIGGER calculate_box_volume_insert
BEFORE INSERT ON box
FOR EACH ROW
Begin
    SET NEW.volume = NEW.height*NEW.width*NEW.length;
END $$


--Calcular el volumen de la caja en un update

CREATE TRIGGER calculate_box_volume_update
BEFORE UPDATE ON box
FOR EACH ROW
Begin
    SET NEW.volume = NEW.height*NEW.width*NEW.length;
END $$



--Tigger para sacar el volumen del embalaje en insert y update

CREATE TRIGGER calculate_packaging_volume_insert
BEFORE INSERT ON packaging
FOR EACH ROW
Begin
    SET NEW.volume = NEW.height*NEW.width*NEW.length;
END $$


select  * from packaging

INSERT INTO packaging (height, width, length, weight, package_quantity, zone, outbound, tag)
VALUES (12.0, 14.0, 10.0, 5.0, 20, 'Z001', 1, 2);




CREATE TRIGGER calculate_packaging_volume_update
BEFORE UPDATE ON packaging
FOR EACH ROW
Begin
    SET NEW.volume = NEW.height*NEW.width*NEW.length;
END $$


--TRiger de mateiral en sus relaciones muchos a muchos

CREATE TRIGGER material_packging_insert
AFTER INSERT ON material_packging
FOR EACH ROW
BEGIN
    UPDATE material
    SET available_quantity = available_quantity - NEW.quantity
    WHERE code = NEW.material;
END $$

select * from material

INSERT INTO material_packging (material, packaging, quantity)
VALUES ('pla', 3, 30);

select * from material_packging;



CREATE TRIGGER material_package_insert
AFTER INSERT ON material_package
FOR EACH ROW
BEGIN
    UPDATE material
    SET available_quantity = available_quantity - NEW.quantity
    WHERE code = NEW.material;
END $$


select * from material

INSERT INTO material_package (material, package, quantity)
VALUES ('wod', 4, 25);

--Trigger espacio de almacenamiento
CREATE TRIGGER update_zone_capacity_after_insert
AFTER INSERT ON packaging
FOR EACH ROW
BEGIN
    DECLARE new_available_capacity INT;

    SELECT available_capacity - NEW.package_quantity INTO new_available_capacity
    FROM zone
    WHERE code = NEW.zone;


    IF new_available_capacity >= 0 OR NEW.package_quantity IS NULL THEN
        UPDATE zone
        SET available_capacity = new_available_capacity
        WHERE code = NEW.zone;
    ELSE
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'There is not enough capacity available in the area';
    END IF;
END$$



--------------------------------------------------------
CREATE TRIGGER update_zone_capacity_before_update
before update ON packaging
FOR EACH ROW
BEGIN
    DECLARE new_available_capacity INT;

    SELECT available_capacity - NEW.package_quantity INTO new_available_capacity
    FROM zone
    WHERE code = NEW.zone;


    IF new_available_capacity >= 0 OR NEW.package_quantity IS NULL THEN
        UPDATE zone
        SET available_capacity = new_available_capacity
        WHERE code = NEW.zone;
    ELSE
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'There is not enough capacity available in the area';
    END IF;
END$$
---------------------------------------------------------

select * from zone

INSERT INTO packaging (height, width, length, weight, package_quantity, zone, outbound, tag)
VALUES (12.0, 14.0, 10.0, 5.0, 1, 'Z001', 1, 2);

--Trigger peso de  paquete

CREATE TRIGGER before_insert_package
BEFORE INSERT ON package
FOR EACH ROW
BEGIN
    DECLARE product_weight DECIMAL(10, 2);
    
    SELECT weight INTO product_weight
    FROM product
    WHERE code = NEW.product;

    SET NEW.weight = product_weight*NEW.product_quantity;
END $$

CREATE TRIGGER before_update_package
BEFORE UPDATE ON package
FOR EACH ROW
BEGIN
    DECLARE product_weight DECIMAL(10, 2);
    
    SELECT weight INTO product_weight
    FROM product
    WHERE code = NEW.product;

    SET NEW.weight = product_weight * NEW.product_quantity;
END$$





--Trigger peso embalaje
------------------------------------------------------------
drop Trigger update_packaging_weight



CREATE TRIGGER update_packaging_weight
AFTER INSERT ON package
FOR EACH ROW
BEGIN
    DECLARE total_weight DECIMAL(10,2);

    SELECT SUM(weight) INTO total_weight
    FROM package
    WHERE packaging = NEW.packaging;

    IF total_weight IS NULL THEN
        SET total_weight = 0;
    END IF;

    UPDATE packaging
    SET weight = total_weight
    WHERE num = NEW.packaging;
END;

drop trigger update_packaging_weight_update;


CREATE TRIGGER update_packaging_weight_update
AFTER update ON package
FOR EACH ROW
BEGIN
    DECLARE total_weight DECIMAL(10,2);

    SELECT SUM(weight) INTO total_weight
    FROM package
    WHERE packaging = NEW.packaging;

    IF total_weight IS NULL THEN
        SET total_weight = 0;
    END IF;

    UPDATE packaging
    SET weight = total_weight
    WHERE num = NEW.packaging;
END;

select * from packaging

select * from package



--TRigger reporte productos empacados
CREATE TRIGGER update_report_packed_products
AFTER INSERT ON package
FOR EACH ROW
BEGIN
    DECLARE total_quantity INT;
    DECLARE related_traceability INT;

    SELECT num INTO related_traceability
    FROM traceability
    WHERE packaging = NEW.packaging
    LIMIT 1;

    SELECT SUM(product_quantity)
    INTO total_quantity
    FROM package
    WHERE packaging = NEW.packaging;


    UPDATE report
    SET packed_products = total_quantity
    WHERE traceability = related_traceability;
END;



select * from report

select * from traceability

select * from packaging WHERE num =1


select * from package WHERE packaging =1

INSERT INTO package (product_quantity, weight, product, packaging, box, tag)
VALUES 
(25, 1.5, 'S10', 1, NULL, NULL);

--Basicamente se encarga de sumar la cantidad de productos que se han empacado en un paquete determinado conforme al embalaje
--y actualizar el reporte de productos empacados en la base de datos.

--Decrime si esto esta bien,por que se pudiera hacer que tambien todas los paquetes tengan el mismo numero y multiplicaro
--por el  package_quantity de embalaje



--TRIGEGER BARCODE ETIQUETA
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
        '(410)', IFNULL(NEW.destination,''),
        '(420)', NEW.tag_type
    );
    
    -- Longitud del código generado
    SET len = CHAR_LENGTH(gs1_code);

    -- Calcular el checksum recorriendo cada carácter
    WHILE i <= len DO
        -- Verificar si el carácter es un dígito antes de convertirlo
        IF SUBSTRING(gs1_code, i, 1) REGEXP '^[0-9]$' THEN
            SET digito = CAST(SUBSTRING(gs1_code, i, 1) AS UNSIGNED);

            IF i % 2 = 1 THEN
                -- Sumar posición impar y multiplicar por 3
                SET suma_impar = suma_impar + digito;
            ELSE
                -- Sumar posición par
                SET suma_par = suma_par + digito;
            END IF;
        END IF;

        SET i = i + 1;
    END WHILE;

    -- Sumar los resultados y calcular el checksum
    SET checksum = (10 - ((suma_impar * 3 + suma_par) % 10)) % 10;

    -- Concatenar el checksum al final del código GS1-128
    SET NEW.barcode = CONCAT(gs1_code, checksum);
END;


CREATE TRIGGER before_update_tag
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
        '(410)', IFNULL(NEW.destination,''),
        '(420)', NEW.tag_type
    );
    
    -- Longitud del código generado
    SET len = CHAR_LENGTH(gs1_code);

    -- Calcular el checksum recorriendo cada carácter
    WHILE i <= len DO
        -- Verificar si el carácter es un dígito antes de convertirlo
        IF SUBSTRING(gs1_code, i, 1) REGEXP '^[0-9]$' THEN
            SET digito = CAST(SUBSTRING(gs1_code, i, 1) AS UNSIGNED);

            IF i % 2 = 1 THEN
                -- Sumar posición impar y multiplicar por 3
                SET suma_impar = suma_impar + digito;
            ELSE
                -- Sumar posición par
                SET suma_par = suma_par + digito;
            END IF;
        END IF;

        SET i = i + 1;
    END WHILE;

    -- Sumar los resultados y calcular el checksum
    SET checksum = (10 - ((suma_impar * 3 + suma_par) % 10)) % 10;

    -- Concatenar el checksum al final del código GS1-128
    SET NEW.barcode = CONCAT(gs1_code, checksum);
END;


--ELIMINAR LOS TRIGGERS
USE packaging;

DROP TRIGGER IF EXISTS calculate_box_volume_insert;
DROP TRIGGER IF EXISTS calculate_box_volume_update;
DROP TRIGGER IF EXISTS calculate_packaging_volume_insert;
DROP TRIGGER IF EXISTS calculate_packaging_volume_update;
DROP TRIGGER IF EXISTS material_packging_insert;
DROP TRIGGER IF EXISTS material_package_insert;
DROP TRIGGER IF EXISTS update_zone_capacity_after_insert;
DROP TRIGGER IF EXISTS before_insert_package;
DROP TRIGGER IF EXISTS before_update_package;
DROP TRIGGER IF EXISTS update_packaging_weight;
DROP TRIGGER IF EXISTS update_packaging_weight_update;
DROP TRIGGER IF EXISTS update_report_packed_products;
DROP TRIGGER IF EXISTS before_insert_tag;
DROP TRIGGER IF EXISTS before_update_tag;