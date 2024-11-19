---------------------------------------
--Eliminar registro
---------------------------------------

--Usuario  --active
DELIMITER $$
Create PROCEDURE dropUser(In p_num int)
BEGIN
    UPDATE user SET active = 0 WHERE num = p_num;
END$$

call dropUser(5)

select * from user

--Tipo de usuario

Drop Procedure dropUserType
DELIMITER $$
Create PROCEDURE dropUserType(IN p_code varchar(5))
BEGIN
    UPDATE user_type SET active = 0 WHERE code = p_code;
END$$

call dropUserType('Super')

SELECT * from user_type

--caja
DELIMITER $$
Create PROCEDURE dropBox(In p_num int)
BEGIN
    UPDATE box SET active = 0 WHERE num = p_num;
END$$

call dropBox (5)

Select * from box 

--Material
drop Procedure dropMaterial

DELIMITER $$
Create PROCEDURE dropMaterial(In p_code varchar(5))
BEGIN
    UPDATE material SET active = 0 WHERE code = p_code;
END$$

call dropMaterial('wod')

Select * from material

--producto
drop Procedure dropProduct
DELIMITER $$
Create PROCEDURE dropProduct(In p_code varchar(5))
Begin
    UPDATE product SET active = 0 WHERE code = p_code;
End $$

call dropProduct('x')

select * from product

--Salida
DELIMITER $$
Create PROCEDURE dropOutBound(In p_num int)
Begin
    UPDATE outbound SET active = 0 WHERE num = p_num;
End$$

call dropOutBound(5)

select * from outbound

--Zona
drop Procedure dropZone

DELIMITER $$
Create PROCEDURE dropZone(In p_code varchar(5))
BEGIN
    UPDATE zone SET active = 0 WHERE code = p_code;
END$$

call dropZone('Z005')

select * from zone

--Protocolo
DELIMITER $$
Create PROCEDURE dropProtocol(In p_num int)
BEGIN
    UPDATE packaging_protocol SET active = 0 WHERE num = p_num;
END$$

call dropProtocol(5)

select * from packaging_protocol



--Paquete
--Embalaje
--Etiqueta
--Tipo de etiqueta
--Report
--Incidente
