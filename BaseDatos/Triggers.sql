-- Active: 1723058837855@@127.0.0.1@3306@embalaje

--Miniimos 2 triggers
--Minimo 2 Stored Procedure

--Tenemos que decir el nombre
--Tenememos que describir que es lo va a realizar

-----------------------------------
            --TRIGGERS
-----------------------------------
SELECT TRIGGER_NAME, EVENT_MANIPULATION, EVENT_OBJECT_TABLE, ACTION_STATEMENT, ACTION_TIMING 
FROM information_schema.TRIGGERS 
WHERE TRIGGER_SCHEMA = 'embalaje';

--CHECAR Como Funciona el INSERT OR UPDATE

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


INSERT INTO box (height, width, length, weight)
VALUES (5.5,5.5,5.5, 3.5)


uPDATE box
set height = 10
where num = 6


--Hacer pruebas bien con respecto a este aun no estoy seguro

--Por que agrega varios productos diferentes y se hace el calculo bien osea suma el peso de todos los prodcutos y lo multiplica
--por la cantida de producto ej  180+180+157=517 * 10 = 5170 no se si eso deberia de ser correcto jeje
DELIMITER $$

CREATE TRIGGER calculate_package_weight_after_product_insert
AFTER INSERT ON product
FOR EACH ROW
BEGIN
    DECLARE total_weight DECIMAL(10, 2);

    SELECT SUM(p.weight * pk.product_quantity) INTO total_weight
    FROM product p
    JOIN package pk ON pk.num = p.package
    WHERE p.package = NEW.package;

    UPDATE package
    SET weight = total_weight
    WHERE num = NEW.package;
END $$

DELIMITER ;

-- Insert de prueba en la tabla product
INSERT INTO product (code, name, description, height, width, length, weight, package, packaging_protocol)
VALUES ('P0', 'Pixel 5', 'Premium product', 14.40, 7.30, 0.80, 180, 1, 1);


select * from product where package = 1

SELECT * FROM package WHERE num = 1;

select * from package


select * from packaging


--Falta saber lo del peso del embalaje



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

DELIMITER ;



DELIMITER $$

CREATE TRIGGER material_package_insert
AFTER INSERT ON material_package
FOR EACH ROW
BEGIN
    UPDATE material
    SET available_quantity = available_quantity - NEW.quantity
    WHERE code = NEW.material;
END $$
DELIMITER ;


select * from material


INSERT INTO material_packging (packaging, material, quantity)
VALUES 
('PK001', 'alm', 50)

INSERT INTO material_package (material, package, quantity)
VALUES 
('stl',3, 70)

select * from packaging

