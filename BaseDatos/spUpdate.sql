---------------------------------------
--Actualizar registro
---------------------------------------

--Usuario
DELIMITER $$
Create PROCEDURE UpdateUser(
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
    In p_activa bit,
    IN p_user_type VARCHAR(5),
    IN p_supervisor INT
)
BEGIN
    UPDATE user
    SET username=p_username,password = p_password, name = p_name, first_surname = p_first_surname,
    second_surname = p_second_surname, date_of_birth = p_date_of_birth,
    neighborhood = p_neighborhood, street = p_street, postal_code = p_postal_code,
    phone = p_phone, email = p_email, activa = p_activa, 
    user_type= p_user_type, supervisor = p_supervisor
    WHERE username = p_username;
END$$

--Tipo de usuario
DELIMITER $$
Create PROCEDURE UpdateUserType(
    IN p_code VARCHAR(5),
    IN p_name VARCHAR(50),
    IN p_description VARCHAR(100),
    IN p_active bit,
)
Begin
    UPDATE user_type
    SET name = p_name, description = p_description, active = p_active
    where code = p_code; 
END$$

--Caja
DELIMITER $$
Create PROCEDURE UpdateBox(
    IN p_num Int,
    IN p_height DECIMAL(10,2),
    IN p_width DECIMAL(10,2),
    IN p_length DECIMAL(10,2),
    IN p_weight DECIMAL(10,2)
)
BEGIN
    UPDATE box
    SET height = p_height, 
    width = p_width, 
    length = p_length, 
    weight = p_weight
    WHERE num = p_num;
END$$
--Material
DELIMITER $$    
Create PROCEDURE UpdateMaterial(
    IN p_code VARCHAR(5),
    IN p_name VARCHAR(50),
    IN p_description VARCHAR(100),
    In p_avaliable_quantity int,
    IN p_active bit
)
BEGIN
    UPDATE material
    SET name = p_name, description = p_description, available_quantity = p_avaliable_quantity,active = p_active
    WHERE code = p_code;
End$$

--Producto
Delimiter $$
Create PROCEDURE UpdateProduct(
    IN p_code VARCHAR(5),
    IN p_name VARCHAR(50),
    IN p_description VARCHAR(100),
    IN p_height DECIMAL(10,2),
    IN p_width DECIMAL(10,2),
    IN p_length DECIMAL(10,2),
    IN p_weight DECIMAL(10,2),
    In p_active
)
Begin
    UPDATE product
    SET name = p_name, description = p_description, height = p_height, width = p_width
    length = p_length, weight = p_weight, active = p_active
    WHERE code = p_code;
END$$
--Salida
DELIMITER $$
Create PROCEDURE UpdateOutBound(
    IN p_num INT,
    IN p_date DATE,
    In p_exit_quantity int,
    In active bit
)
Begin
    UPDATE outbound
    SET date = p_date, exit_quantity = p_exit_quantity, active = p_active
    WHERE num = p_num;
end $$

--Zona
DELIMITER $$
Create PROCEDURE UpdateZone(
    In p_code VARCHAR(5),
    In p_area VARCHAR(50),
    In p_available_capacity INT,
    In p_total_capacity INT,
    In p_active bit
)
Begin
UPDATE zone
    SET area = p_area, available_capacity = p_available_capacity, total_capacity = p_total_capacity,active = p_active
    WHERE code = p_code;
end $$

--Protocolo
DELIMITER $$
Create PROCEDURE UpdateProtocolo(
    IN p_num INT,
    In p_name varchar(50),
    In file_name varchar(255),
    In p_active bit
)
Begin
    UPDATE packaging_protocol
    SET name = p_name, file_name = file_name, active = p_active
    WHERE num = p_num;
end $$

--Paquete
DELIMITER $$
Create PROCEDURE UpdatePaquete(
    IN p_num INT,
    IN p_product_quantity int,
    IN p_weight decimal (10,2),
    IN p_product varchar(5),
    In p_packaging varchar(5),
    IN p_box int,
    IN p_tag int,
)
begin
    UPDATE packaging
    SET product_quantity = p_product_quantity, weight = p_weight, product = p_product, 
    packaging= p_packaging, box = p_box, tag = p_tag
    WHERE num = p_num;
end $$


--Embalaje
DELIMITER $$
Create PROCEDURE UpdatePackaging(
    IN p_code varchar(5),
    IN p_height DECIMAL(10, 2),
    IN p_width DECIMAL(10, 2),
    IN p_length DECIMAL(10, 2),
    IN p_weight DECIMAL(10, 2),
    IN p_package_quantity INT,
    IN p_zone VARCHAR(5),
    IN p_tag int
)
begin
    UPDATE packaging
    SET height = p_height, width = p_width, length = p_length,weight = p_weight,
    package_quantity = package_quantity, , zone = p_zone, tag = p_tag
    WHERE code = p_code;
end $$
--Etiqueta
DELIMITER $$
Create PROCEDURE UpdateTag(
    IN p_num INT,
    IN p_date DATE,
    IN p_tag_type varchar(5),
    IN p_destination VARCHAR(25)
)
begin
    UPDATE tag
    SET date = p_date, tag_type = p_tag_type, destination = p_destination
    WHERE num= p_num;
end $$
--Tipo de etiqueta
DELIMITER $$
Create PROCEDURE UpdateTagType(
    IN p_code VARCHAR(5),
    IN p_description VARCHAR(255)
)
begin
    UPDATE tag_type
    SET description = p_description
    WHERE code = p_code;
end $$

--Report
DELIMITER $$
Create PROCEDURE ReportPackaging(
    IN p_folio VARCHAR(5),
    IN p_start_date DATE,
    IN p_end_date DATE,
    IN p_report_date DATE,
    IN p_packed_products INT,
    IN p_observations TEXT,
    IN p_traceability INT
)
Begin 
    update report
    set start_date = p_start_date, end_date = p_end_date, 
    report_date = p_report_date, packed_products = p_packed_products,
    observations =p_observations, traceability = p_traceability
    WHERE folio = p_folio;
--Incidente
DELIMITER $$
Create PROCEDURE UpdateIncident(
    IN p_num int,
    IN p_date DATE,
    IN p_description VARCHAR(255),
    /* In p_user int, */
    IN p_traceability INT,
)
begin
    UPDATE incident
    SET date = p_date, description = p_description,traceability = p_traceability
    WHERE num = p_num;
end $$