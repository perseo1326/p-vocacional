SET SQL_SAFE_UPDATES = 0;
USE `prueba-vocacional` ;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando datos para la tabla prueba-vocacional.preguntas: ~0 rows (aproximadamente)
DELETE FROM `prueba-vocacional`.`preguntas`
WHERE preg_area = 'I' 
AND preg_status = 'A';

/*!40000 ALTER TABLE `prueba-vocacional`.`preguntas` DISABLE KEYS */;

INSERT INTO `prueba-vocacional`.`preguntas`(preg_id, preg_categ_id, preg_pregunta, preg_area, preg_status) VALUES
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='SS' AND cat_area='I'), 'Atender y cuidar enfermos', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='EP' AND cat_area='I'), 'Intervenir activamente en las discusiones de clase', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='V' AND cat_area='I'), 'Escribir cuentos, crónicas o articulos', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='AP' AND cat_area='I'), 'Dibujar y pintar', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='MS' AND cat_area='I'), 'Cantar en un coro estudiantil', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='OG' AND cat_area='I'), 'Llevar en orden tus libros y cuadernos', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='CI' AND cat_area='I'), 'Conocer y estudiar la estructura de las plantas y los animales', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='CL' AND cat_area='I'), 'Resolver cuestionarios de matemáticas', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='MC' AND cat_area='I'), 'Armar y desarmar objetos mecánicos', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='AL' AND cat_area='I'), 'Salir de excursión', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='SS' AND cat_area='I'), 'Proteger a los muchachos menores del grupo', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='EP' AND cat_area='I'), 'Ser jefe de un grupo', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='V' AND cat_area='I'), 'Leer obras literarias', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='AP' AND cat_area='I'), 'Moldear el barro, plastilina o cualquier otro material', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='MS' AND cat_area='I'), 'Escuchar música clásica', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='OG' AND cat_area='I'), 'Ordenar y clasificar libros de una biblioteca', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='CI' AND cat_area='I'), 'Hacer experimentos en un laboratorio', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='CL' AND cat_area='I'), 'Resolver problemas de aritmética', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='MC' AND cat_area='I'), 'Manejar herramientas y maquinaria', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='AL' AND cat_area='I'), 'Pertenecer a un grupo de exploradores', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='SS' AND cat_area='I'), 'Ser miembro de una sociedad de ayuda y asistencia', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='EP' AND cat_area='I'), 'Dirigir la campaña politica para un candidato estudiantil', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='V' AND cat_area='I'), 'Hacer versos para una publicación', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='AP' AND cat_area='I'), 'Encargarte del decorado de un lugar para un festival', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='MS' AND cat_area='I'), 'Aprender a tocar un instrumento músical', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='OG' AND cat_area='I'), 'Aprender a escribir en máquina y en taquigrafía', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='CI' AND cat_area='I'), 'Investigar el origen de las costumbres de los pueblos', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='CL' AND cat_area='I'), 'Llevar las cuentas de una institución', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='MC' AND cat_area='I'), 'Construir objetos o muebles', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='AL' AND cat_area='I'), 'Trabajar al aire libre o fuera de la ciudad', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='SS' AND cat_area='I'), 'Enseñar a leer a los analfabetos', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='EP' AND cat_area='I'), 'Hacer propaganda para la difusión de una idea', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='V' AND cat_area='I'), 'Representar un papel en una obra de teatro', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='AP' AND cat_area='I'), 'Idear y diseñar el escudo de un club o sociedad', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='MS' AND cat_area='I'), 'Ser miembro de una sociedad músical', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='OG' AND cat_area='I'), 'Ayudar a calificar pruebas', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='CI' AND cat_area='I'), 'Estudiar y entender las causas de los movimientos sociales', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='CL' AND cat_area='I'), 'Explicar a otros cómo resolver problemas de matemáticas', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='MC' AND cat_area='I'), 'Reparar las instalaciones eléctricas, de gas o plomería en tu casa', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='AL' AND cat_area='I'), 'Sembrar y plantar en una granja durante las vacaciones', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='SS' AND cat_area='I'), 'Ayudar a tus compañeros en sus dificultades y preocupaciones', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='EP' AND cat_area='I'), 'Leer biografías de políticos eminentes', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='V' AND cat_area='I'), 'Participar en un concurso de oratoria', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='AP' AND cat_area='I'), 'Diseñar el vestuario para una presentación teatral', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='MS' AND cat_area='I'), 'Leer biografias de músicos eminentes', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='OG' AND cat_area='I'), 'Encargarte del archivo y los documentos de una sociedad', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='CI' AND cat_area='I'), 'Leer revistas y libros científicos', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='CL' AND cat_area='I'), 'Participar en concursos de matemáticas', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='MC' AND cat_area='I'), 'Proyectar y dirigir alguna construcción', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='AL' AND cat_area='I'), 'Atender animales en un racho durante las vacaciones', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='SS' AND cat_area='I'), 'Funcionario al servicio de las clases humildes', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='EP' AND cat_area='I'), 'Experto en relaciones sociales de una gran empresa', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='V' AND cat_area='I'), 'Escritor en un periódico o empresa editorial', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='AP' AND cat_area='I'), 'Dibujante profesional en una empresa', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='MS' AND cat_area='I'), 'Concertista en una sinfónica', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='OG' AND cat_area='I'), 'Técnico organizador de oficinas', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='CI' AND cat_area='I'), 'Investigar en un laboratorio', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='CL' AND cat_area='I'), 'Experto calculista en una institución', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='MC' AND cat_area='I'), 'Perito mecánico en un taller', 'I', 'A'), 
(NULL, (SELECT cat_id FROM `prueba-vocacional`.`categorias` WHERE cat_tipo='AL' AND cat_area='I'), 'Técnico cuyas actividades se desempeñen fuera de la ciudad', 'I', 'A'); 


/*!40000 ALTER TABLE `prueba-vocacional`.`preguntas` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

SET SQL_SAFE_UPDATES = 1;