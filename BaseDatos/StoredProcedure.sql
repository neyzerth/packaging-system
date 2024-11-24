-- Active: 1723058837855@@127.0.0.1@3306@packaging
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

CALL sp_check_zone_capacity('Z002',155,@Resultado);

select @Resultado as respuesta




--Pudieramos cambiar el nombre a search_report
drop PROCEDURE search_report

CREATE PROCEDURE search_report(
    IN p_start_date DATE,
    IN p_end_date DATE
)
BEGIN
    SELECT folio,start_date,end_date,report_date,packed_products,observations,traceability
    FROM report 
    WHERE start_date = p_start_date
    AND end_date = p_end_date ;
END;


call search_report ('2023-10-22','2023-11-22');

update report
set start_date = '2023-10-22',
end_date = '2023-11-22'
where folio = 5

select * from report

drop Procedure `validateUser`
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

call validateUser('Axel','Leyva')

select * from user

drop Procedure login 
DELIMITER $$

DELIMITER $$

CREATE PROCEDURE login(
    IN p_user VARCHAR(30),
    IN p_password VARCHAR(40), 
    OUT p_result BIT           
)
BEGIN
    DECLARE user_exists INT; 


    SET user_exists = (SELECT COUNT(*) FROM user WHERE username = p_user AND password = SHA1(p_password));
    
    IF user_exists > 0 THEN
        SET p_result = 1; 
    ELSE
        SET p_result = 0; 
    END IF;
END $$

CALL addUser('Axel', 'Leyva', 'John', 'Doe', 'Smith', '1985-06-15', 'Downtown', 'Main Street 123', 
12345, '123-456-7890', 'jdoe@example.com', 'ADMIN', NULL);

SET @login_result = NULL;


CALL login('Axel', 'Leyva', @login_result);


SELECT @login_result; 













