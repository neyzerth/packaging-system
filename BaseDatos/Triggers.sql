
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
drop Trigger calculate_box_volume;

DELIMITER $$
CREATE TRIGGER calculate_box_volume_insert
BEFORE INSERT ON box
FOR EACH ROW
Begin
    SET NEW.volume = NEW.height*NEW.width*NEW.length;
END $$
DELIMITER;


DELIMITER $$
CREATE TRIGGER calculate_box_volume_update
BEFORE UPDATE ON box
FOR EACH ROW
Begin
    SET NEW.volume = NEW.height*NEW.width*NEW.length;
END $$
DELIMITER;

-----------------------------------
        --STORED PROCEDURE
-----------------------------------

