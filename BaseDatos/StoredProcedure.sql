-----------------------------------
        --STORED PROCEDURE
-----------------------------------

--corregir 
CREATE PROCEDURE check_zone_capacity (
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


call sp_generate_report ('2024-09-01','2024-09-30')


--Pudieramos hacer un sp o  triggers que al hacer un moviento en el proceso del embalaje actualice la tabla estado de la trazabilidad
--Creo que seria mejor un trigger por que nos evitamos tener que mandarlo a llamar
--