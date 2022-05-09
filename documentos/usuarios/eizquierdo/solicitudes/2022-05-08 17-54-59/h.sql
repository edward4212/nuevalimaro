DELIMITER $$

USE `nuevalimaro`$$

DROP PROCEDURE IF EXISTS `create_empleado`$$

CREATE DEFINER=CURRENT_USER PROCEDURE `create_empleado`( IN id_empleado INT, nombre_completo VARCHAR(200),
img_empleado VARCHAR(200), correo_empleado VARCHAR(200), id_cargo INT, id_empresa INT, estado_empleado  ENUM('ACTIVO','INACTIVO'))
BEGIN
INSERT INTO empleado VALUES (NULL, nombre_completo,'usuario.png',correo_empleado,id_cargo,'1','ACTIVO');
    END$$

DELIMITER ;