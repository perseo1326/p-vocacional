SET SQL_SAFE_UPDATES = 0;
USE `prueba-vocacional` ;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando datos para la tabla' prueba-vocacional'.preguntas: ~0 rows (aproximadamente)
DELETE FROM `prueba-vocacional`.`preguntas`
WHERE preg_area = 'A' 
AND preg_status = 'A';
/*!40000 ALTER TABLE `prueba-vocacional`.`preguntas` DISABLE KEYS */;

INSERT INTO `prueba-vocacional`.`preguntas`(preg_id, preg_categ_id, preg_pregunta, preg_area, preg_status) VALUES
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'SS' AND cat_area = 'A'), 'Tratar y hablar con sensibilidad a las personas', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'EP' AND cat_area = 'A'), 'Ser jefe competente de un grupo, equipo o sociedad', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'V' AND cat_area = 'A'), 'Expresarte con facilidad en clase o al platicar con tus amigos', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'AP' AND cat_area = 'A'), 'Dibujar casas, objetos, figuras humanas, etcétera', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'MS' AND cat_area = 'A'), 'Cantar en un grupo', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'OG' AND cat_area = 'A'), 'Llevar en forma correcta y ordenada los apuntes de clase', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'CI' AND cat_area = 'A'), 'Entender principios y experimentos de biología', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'CL' AND cat_area = 'A'), 'Ejecutar con rapidez y exactitud operaciones aritméticas', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'MC' AND cat_area = 'A'), 'Armar y componer objetos mecánicos como  chapas, timbres, etcétera', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'DT' AND cat_area = 'A'), 'Actividades que requieren destreza manual', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'SS' AND cat_area = 'A'), 'Ser miembro activo y útil en un club o sociedad', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'EP' AND cat_area = 'A'), 'Organizar y dirigir festivales, encuentros deportivos, excursiones o campañas sociales', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'V' AND cat_area = 'A'), 'Redactar composiciones o artículos periodísticos', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'AP' AND cat_area = 'A'), 'Pintar paisajes', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'MS' AND cat_area = 'A'), 'Tocar un instrumento músical', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'OG' AND cat_area = 'A'), 'Ordenar y clasificar debidamente documentos en una oficina', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'CI' AND cat_area = 'A'), 'Entender principios y experimentos de física', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'CL' AND cat_area = 'A'), 'Resolver problemas de aritmética', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'MC' AND cat_area = 'A'), 'Desarmar, armar y componer objetos complicados', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'DT' AND cat_area = 'A'), 'Manejar con habilidad herramientas de carpintería', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'SS' AND cat_area = 'A'), 'Colaborar con otros para el bien de la comunidad', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'EP' AND cat_area = 'A'), 'Convencer a otros para que hagan lo que crees que deben hacer', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'V' AND cat_area = 'A'), 'Componer versos serios o jocosos', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'AP' AND cat_area = 'A'), 'Decorar artisticamente un salón o corredor, escenario o patio para un festival', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'MS' AND cat_area = 'A'), 'Distinguir cuando alguien desentona en las canciones o piezas musicales', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'OG' AND cat_area = 'A'), 'Contestar y redactar correctamente oficios y cartas', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'CI' AND cat_area = 'A'), 'Entender principios y experimentos de química', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'CL' AND cat_area = 'A'), 'Resolver rompecabezas numéricos', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'MC' AND cat_area = 'A'), 'resolver rompecabezas de alambre o de madera', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'DT' AND cat_area = 'A'), 'Manejar con habilidad herramientas mecánicas como pinzas, llaves de tuercas, desarmador, etc', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'SS' AND cat_area = 'A'), 'Saber escuchar a otros con paciencia y compreder su punto de vista', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'EP' AND cat_area = 'A'), 'Dar órdenes a otros con seguridad y naturalidad', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'V' AND cat_area = 'A'), 'Escribir cuentos, narraciones o historietas', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'AP' AND cat_area = 'A'), 'Modelar con barro, plastilina o grabar madera', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'MS' AND cat_area = 'A'), 'Entonar correctamente las canciones de moda', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'OG' AND cat_area = 'A'), 'Anotar y manejar con exactitud y rapidez nombres, números y otros datos', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'CI' AND cat_area = 'A'), 'Entender principios y hechos económicos y sociales', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'CL' AND cat_area = 'A'), 'Resolver problemas de algebra', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'MC' AND cat_area = 'A'), 'Armar y componer muebles', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'DT' AND cat_area = 'A'), 'Manejar con habilidad pequeñas piezas y herramientas como agujas, manecillas, joyas, piezas de relojeria, etc', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'SS' AND cat_area = 'A'), 'Conversar en las reuniones y fiestas con acierto y naturalidad', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'EP' AND cat_area = 'A'), 'Dirigir un grupo o equipo en situaciones difíciles o peligrosas', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'V' AND cat_area = 'A'), 'Distinguir y apreciar la buena literatura', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'AP' AND cat_area = 'A'), 'Distinguir y apreciar la buena pintura', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'MS' AND cat_area = 'A'), 'Distinguir y apreciar la buena música', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'OG' AND cat_area = 'A'), 'Encargarse de recibir, anotar y dar recados sin olvidar detalles importantes', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'CI' AND cat_area = 'A'), 'Entender las causas que determinan los acontecimientos históricos', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'CL' AND cat_area = 'A'), 'Resolver problemas de geometría', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'MC' AND cat_area = 'A'), 'Aprender el funcionamiento de ciertos mecanismos complicados como motores, relojes, bombas, etc', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'DT' AND cat_area = 'A'), 'Hacer con facilidad trazos geométricos con la ayuda de escuadras, regla T y compás', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'SS' AND cat_area = 'A'), 'Actuar con desinteres', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'EP' AND cat_area = 'A'), 'Corregir a los demás sin ofenderlos', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'V' AND cat_area = 'A'), 'Exponer juicios públicamente sin preocupación por la crítica', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'AP' AND cat_area = 'A'), 'Colaborar en la elaboración de un libro sobre el arte de la arquitectura', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'MS' AND cat_area = 'A'), 'Dirigir un grupo músical', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'OG' AND cat_area = 'A'), 'Colaborar en el desarrollo de métodos mas eficientes de trabajo', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'CI' AND cat_area = 'A'), 'Realizar investigaciones cientificas teniendo como finalidad la búsqueda de la verdad', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'CL' AND cat_area = 'A'), 'Enseñar a resolver problemas de matemáticas', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'MC' AND cat_area = 'A'), 'Inducir a las personas a obtener resultados prácticos', 'A', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo = 'DT' AND cat_area = 'A'), 'Participar en un concurso de modelismo de coches, aviones, barcos, etc', 'A', 'A');


/*!40000 ALTER TABLE `prueba-vocacional`.`preguntas` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

SET SQL_SAFE_UPDATES = 1;