------------------------------
--Triggers
------------------------------


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

        UPDATE zone
        SET available_capacity = available_capacity + OLD.package_quantity
        WHERE code = OLD.zone;
    ELSE
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'There is not enough capacity available in the area';
    END IF;
END$$


--Como creo que deberia de ser  no se si es correcto y tampoco lo eh probado
DELIMITER $$
CREATE TRIGGER update_zone_capacity_before_update
BEFORE UPDATE ON packaging
FOR EACH ROW
BEGIN
    DECLARE new_available_capacity INT;
    DECLARE old_available_capacity INT;


    IF OLD.zone IS NOT NULL AND OLD.package_quantity IS NOT NULL THEN
        SELECT available_capacity + OLD.package_quantity INTO old_available_capacity
        FROM zone
        WHERE code = OLD.zone;

        UPDATE zone
        SET available_capacity = old_available_capacity
        WHERE code = OLD.zone;
    END IF;


    IF NEW.zone IS NOT NULL AND NEW.package_quantity IS NOT NULL THEN
        SELECT available_capacity - NEW.package_quantity INTO new_available_capacity
        FROM zone
        WHERE code = NEW.zone;

        IF new_available_capacity >= 0 THEN
            UPDATE zone
            SET available_capacity = new_available_capacity
            WHERE code = NEW.zone;
        ELSE
            SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'There is not enough capacity available in the area';
        END IF;
    END IF;
END$$
DELIMITER ;






------------------------------
--Procedimientos almacenados
------------------------------


DELIMITER $$
CREATE PROCEDURE validateUser(IN usern VARCHAR(30), IN passw VARCHAR(50))
BEGIN
    DECLARE user_exists INT;
    SET user_exists = (
        SELECT COUNT(*) FROM user 
        WHERE username = usern 
        AND password = SHA1(passw)
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
CREATE PROCEDURE addUser(
    IN p_username VARCHAR(30),
    IN p_password VARCHAR(50),
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
END $$



DELIMITER $$
Create PROCEDURE dropUser(In p_num int)
BEGIN
    UPDATE user SET active = 0 WHERE num = p_num;
END$$




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
