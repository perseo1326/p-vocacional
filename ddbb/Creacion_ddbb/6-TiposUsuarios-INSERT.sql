SET SQL_SAFE_UPDATES = 0;
USE `prueba-vocacional` ;

-- Volcando datos para la tabla prueba-vocacional.tipos_usuario: 

-- lIMPIEZA E INICIALIZACION DE LA TABLA "Tipos_usuarios" :
DELETE FROM `prueba-vocacional`.`tipos_usuario`
WHERE TRUE = TRUE;


-- Insercion de los tipos de usuarios permitidos en le sistema
-- BASICO = Usuario normal
-- PSICOLOGO = Usuario con privilegios pava ver y añadir notas a los usuarios basicos.
-- ADMINISTRADOR = (No en uso) Pensado para manejar aspectos tecnicos de la base de datos,
-- como promocion de usuarios basicos a Psicologos o eliminacion de usuarios Basicos, por ejemplo.

INSERT INTO `prueba-vocacional`.`tipos_usuario`(tipousua_id, tipoUsua_codigo, tipousua_nombre, tipousua_descripcion, tipousua_notas) VALUES 
(NULL, 'BAS', 'BASICO', 'USUARIO CON PERMISOS BASICOS Y RESTRINGIDOS. SOLO PUEDE VER SU INFORMACION Y TOMAR LA PRUEBA. USUARIO PARA EL QUE ESTA DISEÑADA LA PRUEBA.', NULL), 
(NULL, 'PSI', 'PSICOLOGO', 'USUARIO QUE ANALIZA Y PUEDE CONSULTAR LA INFORMACION DE USUARIOS BASICOS PARA TOMAR CONCLUSIONES Y/O INFORMES.', NULL), 
(NULL, 'ADM', 'ADMINISTRADOR', '(sin aplicación) USUARIO CON PERMISOS TOTALES PARA LABORES DE MANTENIMIENTO Y OPERACION DE LA APLICACION, ENCARGADO DEL DISEÑO Y LA PROGRAMACION DE LA APLICACION.', NULL);

SET SQL_SAFE_UPDATES = 1;
