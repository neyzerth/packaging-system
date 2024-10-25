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
    
    SELECT available_capacity INTO capacity --esto esta mal
    FROM zone
    WHERE code = zone_code;
    
    IF capacity >= package_quantity THEN
        SET result = TRUE;
    ELSE
        SET result = FALSE;
    END IF;
END;


CREATE PROCEDURE generate_report(
    IN start_date DATE,
    IN end_date DATE
)
BEGIN
    SELECT * FROM report --creo que el * no esta bien
    WHERE report_date BETWEEN start_date AND end_date;
END;


--Pudieramos hacer un sp o  triggers que al hacer un moviento en el proceso del embalaje actualice la tabla estado de la trazabilidad
--Creo que seria mejor un trigger por que nos evitamos tener que mandarlo a llamar
--