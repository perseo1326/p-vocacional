-- --------------------------------------------------------
-- Host:                         192.168.0.101
-- Versión del servidor:         8.0.28-0ubuntu0.20.04.3 - (Ubuntu)
-- SO del servidor:              Linux
-- HeidiSQL Versión:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para prueba-vocacional
DROP DATABASE IF EXISTS `prueba-vocacional`;
CREATE DATABASE IF NOT EXISTS `prueba-vocacional` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `prueba-vocacional`;

-- Volcando estructura para tabla prueba-vocacional.categorias
DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `cat_id` smallint unsigned NOT NULL AUTO_INCREMENT,
  `cat_tipo` char(2) COLLATE utf8_bin DEFAULT NULL,
  `cat_categoria` varchar(50) COLLATE utf8_bin NOT NULL,
  `cat_descripcion` varchar(500) COLLATE utf8_bin NOT NULL COMMENT 'Categorías (SS, EP, V, AP, MS, OG, CI, CL, MC, {AL = Aptitudes /DT = Intereses}) en las cuales se divide el area (Aptitudes o Intereses).',
  `cat_notas` varchar(2000) COLLATE utf8_bin DEFAULT '',
  `cat_area` char(1) COLLATE utf8_bin NOT NULL COMMENT 'Area a la que pertenece la categoria',
  `cat_status` char(1) COLLATE utf8_bin NOT NULL DEFAULT 'A' COMMENT 'Campo que puede ser usado, por ejemplo, para "Activar" o "Desactivar" la pregunta. Valor por defecto "A".',
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin COMMENT='Aqui estan las diferentes categorias para cada una de las areas de INTERESES Y APTITUDES. La tabla contiene las categorias con su codigo, su nombre y su descripcion junto al area al que pertenecen.';

-- Volcando datos para la tabla prueba-vocacional.categorias: ~20 rows (aproximadamente)
DELETE FROM `categorias`;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` (`cat_id`, `cat_tipo`, `cat_categoria`, `cat_descripcion`, `cat_notas`, `cat_area`, `cat_status`) VALUES
	(1, 'SS', 'SERVICIO SOCIAL', 'Preferencia por participar en actividades directamente relacionadas con el bienestar de las personas.', '', 'I', 'A'),
	(2, 'EP', 'EJECUTIVO PERSUASIVA', 'Agrado por planear, organizar o dirigir las actividades de personas o agrupaciones.', '', 'I', 'A'),
	(3, 'V', 'VERBAL', 'Gusto por la lectura de obras diversas y satisfacción al expresarse verbalmente o pro escrito', '', 'I', 'A'),
	(4, 'AP', 'ARTISTICO PLASTICA', 'Agrado por conocer o realizar actividades creativas como dibujo, la pintura, escultura, el modelado, etc.', '', 'I', 'A'),
	(5, 'MS', 'MUSICAL', 'Gusto por la ejecución, estudio o composición de la música.', '', 'I', 'A'),
	(6, 'OG', 'ORGANIZACION', 'Preferencia por actividades que requieren orden y sistematización.', '', 'I', 'A'),
	(7, 'CI', 'CIENTIFICA', 'Gusto por conocer o investigar los fenómenos, las causas que los provocan y los principios que los explican.', '', 'I', 'A'),
	(8, 'CL', 'CALCULO', 'Gusto por resolver problemas de tipo cuantitativo, donde se utilizan las operaciones matemáticas.', '', 'I', 'A'),
	(9, 'MC', 'MECANICO CONSTRUCTIVA', 'Atracción por armar, conocer o descubrir mecanismos mediante los cuales funciona un aparato, así como proyectar y construir objetos diversos.', '', 'I', 'A'),
	(10, 'AL', 'TRABAJO AL AIRE LIBRE', 'Satisfacción por actividades que se realizan en lugares abiertos y/o apartados de los conglomerados urbanos.', '', 'I', 'A'),
	(11, 'SS', 'SERVICIO SOCIAL', 'Habilidad para comprender problemas humanos, para tratar personas, cooperar y persuadir; para hacer lo más adecuado ante situaciones sociales. Actitud de ayuda afectuosa y desinteresada hacia sus semejantes.', '', 'A', 'A'),
	(12, 'EP', 'EJECUTIVO PERSUASIVA', 'Capacidad para organizar, dirigir y supervisar a otros adecuadamente; poseer iniciativa, confianza en sí mismo, ambición de progreso, habilidad para dominar en situaciones sociales y en relaciones de persona a persona.', '', 'A', 'A'),
	(13, 'V', 'VERBAL', 'Habilidad para comprender y expresarse correctamente. También para utilizar Las palabras precisas y adecuadas.', '', 'A', 'A'),
	(14, 'AP', 'ARTISTICO PLASTICA', 'Habilidad para apreciar las formas o colores de un objeto, dibujo, escultura o pintura y para crear obras de mérito artístico en pintura, escultura, grabado o dibujo.', '', 'A', 'A'),
	(15, 'MS', 'MUSICAL', 'Habilidad para captar y distinguir sonidos en sus diversas modalidades, para imaginar estos sonidos, reproducirlos o utilizarlos en forma creativa; sensibilidad a la combinación y armonía de sonidos.', '', 'A', 'A'),
	(16, 'OG', 'ORGANIZACION', 'Capacidad de organización, orden, exactitud y rapidez en el manejo de nombres, números, documentos, sistemas y sus detalles en trabajos rutinarios.', '', 'A', 'A'),
	(17, 'CI', 'CIENTIFICA', 'Habilidad para la investigación; aptitud para captar, definir y comprender principios y relaciones causales de los fenómenos proponiéndose siempre la obtención de la novedad.', '', 'A', 'A'),
	(18, 'CL', 'CALCULO', 'Dominio de las operaciones y mecanizaciones numéricas, así como habilidad para el cálculo matemático.', '', 'A', 'A'),
	(19, 'MC', 'MECANICO CONSTRUCTIVA', 'Comprensión y habilidad en la manipulación de objetos y facilidad para percibir, imaginar y analizar formas en dos o tres dimensiones, así como para abstraer sistemas, mecanismos y movimientos', '', 'A', 'A'),
	(20, 'DT', 'DESTREZA MANUAL', 'Habilidad en el uso de las manos para el manejo de herramientas; ejecución de movimientos coordinados y precisos.', '', 'A', 'A');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;

-- Volcando estructura para tabla prueba-vocacional.conclusiones
DROP TABLE IF EXISTS `conclusiones`;
CREATE TABLE IF NOT EXISTS `conclusiones` (
  `concl_id` tinyint unsigned NOT NULL AUTO_INCREMENT,
  `concl_1cat_id` smallint unsigned NOT NULL,
  `concl_2cat_id` smallint unsigned NOT NULL,
  `concl_explicacion` varchar(1000) COLLATE utf8_bin DEFAULT '',
  `concl_texto` varchar(2000) COLLATE utf8_bin NOT NULL,
  `concl_area` char(1) COLLATE utf8_bin NOT NULL,
  `concl_status` char(1) COLLATE utf8_bin NOT NULL DEFAULT 'A' COMMENT 'Permite colocar una conclusion en estado Activo ''A'' o Desactivado (otro valor)',
  PRIMARY KEY (`concl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin COMMENT='Aqui se encuentran los textos del analisis final de acuerdo a las categorias que fueron mas valoradas durante el examen, encontrandose los selectores en pares de indices segun las categorias mas altas.';

-- Volcando datos para la tabla prueba-vocacional.conclusiones: ~31 rows (aproximadamente)
DELETE FROM `conclusiones`;
/*!40000 ALTER TABLE `conclusiones` DISABLE KEYS */;
INSERT INTO `conclusiones` (`concl_id`, `concl_1cat_id`, `concl_2cat_id`, `concl_explicacion`, `concl_texto`, `concl_area`, `concl_status`) VALUES
	(1, 2, 1, NULL, 'Ciencias Políticas y Administración Pública. Relaciones Internacionales, Ciencias de la Comunicación, Sociología, Derecho, Trabajo Social, Economía, Pedagogía, Enseñanza de Inglés, Psicología, Enfermería y Obstetricia, Odontología, Optometría.', 'I', 'A'),
	(2, 2, 3, NULL, 'Relaciones Internacionales, Derecho, Letras Clásicas, Lengua y Literaturas Hispánicas, Literatura Dramática y Teatro, Lengua y Literaturas Modernas, Bibliotecología y Estudios de la Información, Enseñanza de Inglés, Ciencias de la Comunicación, Ciencias Políticas y Administración Pública.', 'I', 'A'),
	(3, 2, 4, NULL, 'Diseño Gráfico, Diseño y Comunicación Visual, Urbanismo, Diseño Industrial, Literatura Dramática y Teatro.', 'I', 'A'),
	(4, 2, 5, NULL, 'Etnomusicología, Piano, Canto, Instrumentista, Composición, Educación Musical.', 'I', 'A'),
	(5, 2, 6, NULL, 'Actuaría, Economía, Administración, Informática, Ciencias Políticas y Administración Pública, Relaciones Internacionales, Planificación para el Desarrollo Agropecuario, Geografía, Contaduría, Ingeniería en Alimentos, Quimica Industrial.', 'I', 'A'),
	(6, 3, 1, NULL, 'Ciencias de la Comunicación, Derecho, Ciencias Políticas y Administración Pública, Estudios Latinoamericanos, Letras Clásicas, Lengua y Literaturas Hispánicas,  Literatura Dramática y Teatro, Lengua y Literatura Modernas, Enseñanza de Inglés, Bibliotecología y Estudios de la Información.', 'I', 'A'),
	(7, 3, 5, NULL, 'Composición, Educación Musical, Canto.', 'I', 'A'),
	(8, 3, 6, NULL, 'Bibliotecología y Estudios de la Información, Relaciones Internacionales, Ciencias Políticas y Administración Pública, Sociología, Estudios Latinoamericanos.', 'I', 'A'),
	(9, 4, 1, NULL, ' Artes Visuales, Diseño Gráfico, Diseño y Comunicación Visual, Urbanismo, Arquitectura del Paisaje, Arquitectura, Diseño Industrial.', 'I', 'A'),
	(10, 5, 1, NULL, 'Composición, Instrumentista, Piano,Educación Músical, Canto, Etnomusicología.', 'I', 'A'),
	(11, 7, 1, NULL, 'Ingeniería en Alimentos, Investigación Biomédica Básica, Ciencias Genómicas, Optometría, Química en Alimentos, Química Farmacéutico- Biológica, Biología, Odontología, Medicina Veterinaria y Zootecnia, Medicina, Enfermería y Obstetricia, Psicología, Ciencias Políticas y Administración Pública, Sociología, Trabajo Social, Historia, Pedagogía, Estudios Latinoamericanos, Filosofía.', 'I', 'A'),
	(12, 7, 2, NULL, 'Medicina, Medicina Veterinaria y Zootecnia, Física, Química, Biología, Ciencias Genómicas, Investigación Biomédica Básica, Enfermería, Psicología, Estudios Latinoamericanos, Pedagogía, Optometría.', 'I', 'A'),
	(13, 7, 4, NULL, 'Odontología, Urbanismo, Arquitectura, Diseño Industrial.', 'I', 'A'),
	(14, 9, 8, NULL, 'Arquitectura, Diseño Industrial, Física, Ingenierías: Civil, en Computación, Geofísica, Mecánica Eléctrica, de Minas y Metalurgia, Petrolera, Topográfica y Geodésica, en Telecomunicaciones, Mecánica y Mecatrónica.', 'I', 'A'),
	(15, 10, 1, NULL, 'Ingeniería Agrícola, Ingeniería Petrolera, Sociología, Planificación para el Desarrollo Agropecuario, Trabajo Social, Medicina Veterinaria y Zootecnia, Biología, Arquitectura de Paisaje.', 'I', 'A'),
	(16, 10, 2, NULL, 'Ingeniería Petrolera, Planificación para el Desarrollo Agropecuario, Trabajo Social, Ingeniería Agrícola, Medicina Veterinaria y Zootecnia, Ingeniería Civil, Arquitectura, Urbanista.', 'I', 'A'),
	(17, 10, 4, NULL, 'Arquitectura, Urbanismo, Arquitectura de Paisaje, Artes Visuales.', 'I', 'A'),
	(18, 10, 6, NULL, 'Ingeniería Agrícola, Geografía, Planificación para el Desarrollo Agropecuario, Biología, Medicina Veterinaria y Zootencnia.', 'I', 'A'),
	(19, 10, 7, NULL, 'Ingenierías: Agrícolas, Geológica, Petrolera, de minas y Metalurgia, Geografía, Planificación para el Desarrollo Agropecuario, Biología, Medicina Veterinaria y Zootecnica, Ciencias Ambientales, Manejo de Zonas Costeras.', 'I', 'A'),
	(20, 10, 8, NULL, 'Arquitectura, Urbanismo, Arquitectura de Paisaje, Ingenierías: Agrícola, Civil, Geológica, Mecánica Eléctrica, de Minas y Metalurgia, Petrolera, Topográfica y Geodésica, Química Metalúrgica y Telecomunicaciones.', 'I', 'A'),
	(21, 10, 9, NULL, 'Ingierías: Civil, Industrial, Mecánica Eléctrica, Petrolera, Topográfica y Geodésica, de Minas y Metalurgia, Geofísica, Geológica y Telecomunicaciones.', 'I', 'A'),
	(22, 11, 11, 'Preferencia por participar en actividades directamente relacionadas con el bienestiar de las personas.', 'Urbanismo, Ingenieria Civil, Sociología, Trabajo Social,Derecho, Enfermería y Obestetricia, Psicología, Pedagogía, Medicina, Odontología, Ciencias Politicas y Administración Pública, Economía, Relaciones Internacionales, Enseñanza de Inglés, Optometría, Planificación para el Desarrollo Agropecuario, Estudios Latinoamericanos, Bibliotecología y Estudios de la Información, Educación Musical.', 'A', 'A'),
	(23, 12, 12, 'Agrado por planear, organizar o dirigir las actividades de personas o agrupaciones.', 'Actuaría, Economía, Administración, Ciencias Políticas y Administración Pública, Derecho, Ingeniería Industrial, Ingeniería de Alimentos, Ingeniería Petrolera, Psicología, Medicina, Relaciones Internacionales.', 'A', 'A'),
	(24, 13, 13, 'Gusto por la lectura de obras diversas y satisfacción al expresarse verbalmente o por escrito.', 'Derecho, Ciencias de la Comunicación, Letras Clásicas, Lengua y Literaturas Modernas, Relaciones Internacionales, Literatura Dramática y Teatro, Sociología, Ciencias Políticas y Administración Pública.', 'A', 'A'),
	(25, 14, 14, 'Agrado por conocer o realizar actividades creativas como dibujo, pintura, escultura, modelado.', 'Artes Visuales, Diseño y Comunicación Visual, Diseño Gráfico, Arquitectura, Arquitectura de Paisaje, Odontología, Literatura Dramática y Teatro.', 'A', 'A'),
	(26, 15, 15, 'Gusto por la ejecución, estudio o  composición de la música.', 'Composición, Instrumentista, Canto, Etnomusicología, Piano, Educación Musical.', 'A', 'A'),
	(27, 16, 16, 'Preferencia por actividades que requieren orden y sistematización.', 'Bibliotecología y Estudios de la Información, Actuaría, Matemáticas Aplicadas y Computación, Informática, Contaduría, Administración, Ciencias de la Comunicación, Matemáticas, Relaciones Internacionales, Economía, Ciencias Políticas y Administración Pública.', 'A', 'A'),
	(28, 17, 17, 'Gusto por conocer o investigar la razón de ser de los fenómenos, las causas que los provocan y los principios que los explican.', 'Investiación Biomédica Básica, Ciencias Genómicas, Matemáticas, Física, Ingeniería Mecatrónica, Química, Biología, Psicología, Medicina Veterinaria y Zootecnia, Ingeniería Química, Química Farmacéutico- Biológica, Química Industrial, Química de Alimentos, Ingeniería en Alimentos, Filosofía, Historia.', 'A', 'A'),
	(29, 18, 18, 'Gusto por resolver problemas de tipo cuantitativo, en donde intervienen las operaciones matemáticas.', 'Matemáticas, Economía, Contaduría,  Física, Ingenierías: Geológica, Geofísica, Civil, en Telecomunicaciones, Computación, Topográfica, Industrial, Química; Arquitectura, Geografía, Actuaría, Informática, Química, Matemáticas Aplicadas y Computación, Ciencias de la Comunicación.', 'A', 'A'),
	(30, 19, 19, 'Atracción por armar, conocer o descubrir mecanismos por los cuales funciona un aparato y por proyectar y construir objetos diversos.', 'Ingenierías: Eléctrica - Electrónica, Geofísica, Topográfica, Civil, Petrolera, Mecánica Eléctrica, Química, en Computación, Mecánica, Química Metalúrgica, Mecatrónica, Arquitectura, Diseño Industrial.', 'A', 'A'),
	(31, 20, 20, 'Satisfacción por actividades que se realizan en lugares abiertos, apartados de los conglomerados urbanos.', 'Biología, Ingeniería Agrícola, Ingeniería Geológica, Ingeniería Petrolera, Geografía, Ingeniería Civil, Ingeniería Topográfica y Geodésica, Medicina Veterinaria y Zootecnia, Planificación para el Desarrollo Agropecuario, Urbanismo.', 'A', 'A');
/*!40000 ALTER TABLE `conclusiones` ENABLE KEYS */;

-- Volcando estructura para tabla prueba-vocacional.preguntas
DROP TABLE IF EXISTS `preguntas`;
CREATE TABLE IF NOT EXISTS `preguntas` (
  `preg_id` smallint unsigned NOT NULL AUTO_INCREMENT,
  `preg_categ_id` smallint unsigned NOT NULL,
  `preg_pregunta` varchar(300) COLLATE utf8_bin NOT NULL,
  `preg_area` char(1) COLLATE utf8_bin NOT NULL COMMENT 'El AREA solo sera APTITUDES o INTERESES.',
  `preg_status` char(1) COLLATE utf8_bin NOT NULL DEFAULT 'A' COMMENT 'Campo que puede ser usado, por ejemplo, para "Activar" o "Desactivar" la pregunta. Valor por defecto "A".',
  PRIMARY KEY (`preg_id`),
  KEY `idx_preguntas_pregunta` (`preg_pregunta`),
  KEY `FK_preguntas_categorias_idx` (`preg_categ_id`),
  CONSTRAINT `FK_preguntas_categorias` FOREIGN KEY (`preg_categ_id`) REFERENCES `categorias` (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- Volcando datos para la tabla prueba-vocacional.preguntas: ~120 rows (aproximadamente)
DELETE FROM `preguntas`;
/*!40000 ALTER TABLE `preguntas` DISABLE KEYS */;
INSERT INTO `preguntas` (`preg_id`, `preg_categ_id`, `preg_pregunta`, `preg_area`, `preg_status`) VALUES
	(1, 1, 'Atender y cuidar enfermos', 'I', 'A'),
	(2, 2, 'Intervenir activamente en las discusiones de clase', 'I', 'A'),
	(3, 3, 'Escribir cuentos, crónicas o articulos', 'I', 'A'),
	(4, 4, 'Dibujar y pintar', 'I', 'A'),
	(5, 5, 'Cantar en un coro estudiantil', 'I', 'A'),
	(6, 6, 'Llevar en orden tus libros y cuadernos', 'I', 'A'),
	(7, 7, 'Conocer y estudiar la estructura de las plantas y los animales', 'I', 'A'),
	(8, 8, 'Resolver cuestionarios de matemáticas', 'I', 'A'),
	(9, 9, 'Armar y desarmar objetos mecánicos', 'I', 'A'),
	(10, 10, 'Salir de excursión', 'I', 'A'),
	(11, 1, 'Proteger a los muchachos menores del grupo', 'I', 'A'),
	(12, 2, 'Ser jefe de un grupo', 'I', 'A'),
	(13, 3, 'Leer obras literarias', 'I', 'A'),
	(14, 4, 'Moldear el barro, plastilina o cualquier otro material', 'I', 'A'),
	(15, 5, 'Escuchar música clásica', 'I', 'A'),
	(16, 6, 'Ordenar y clasificar libros de una biblioteca', 'I', 'A'),
	(17, 7, 'Hacer experimentos en un laboratorio', 'I', 'A'),
	(18, 8, 'Resolver problemas de aritmética', 'I', 'A'),
	(19, 9, 'Manejar herramientas y maquinaria', 'I', 'A'),
	(20, 10, 'Pertenecer a un grupo de exploradores', 'I', 'A'),
	(21, 1, 'Ser miembro de una sociedad de ayuda y asistencia', 'I', 'A'),
	(22, 2, 'Dirigir la campaña politica para un candidato estudiantil', 'I', 'A'),
	(23, 3, 'Hacer versos para una publicación', 'I', 'A'),
	(24, 4, 'Encargarte del decorado de un lugar para un festival', 'I', 'A'),
	(25, 5, 'Aprender a tocar un instrumento músical', 'I', 'A'),
	(26, 6, 'Aprender a escribir en máquina y en taquigrafía', 'I', 'A'),
	(27, 7, 'Investigar el origen de las costumbres de los pueblos', 'I', 'A'),
	(28, 8, 'Llevar las cuentas de una institución', 'I', 'A'),
	(29, 9, 'Construir objetos o muebles', 'I', 'A'),
	(30, 10, 'Trabajar al aire libre o fuera de la ciudad', 'I', 'A'),
	(31, 1, 'Enseñar a leer a los analfabetos', 'I', 'A'),
	(32, 2, 'Hacer propaganda para la difusión de una idea', 'I', 'A'),
	(33, 3, 'Representar un papel en una obra de teatro', 'I', 'A'),
	(34, 4, 'Idear y diseñar el escudo de un club o sociedad', 'I', 'A'),
	(35, 5, 'Ser miembro de una sociedad músical', 'I', 'A'),
	(36, 6, 'Ayudar a calificar pruebas', 'I', 'A'),
	(37, 7, 'Estudiar y entender las causas de los movimientos sociales', 'I', 'A'),
	(38, 8, 'Explicar a otros cómo resolver problemas de matemáticas', 'I', 'A'),
	(39, 9, 'Reparar las instalaciones eléctricas, de gas o plomería en tu casa', 'I', 'A'),
	(40, 10, 'Sembrar y plantar en una granja durante las vacaciones', 'I', 'A'),
	(41, 1, 'Ayudar a tus compañeros en sus dificultades y preocupaciones', 'I', 'A'),
	(42, 2, 'Leer biografías de políticos eminentes', 'I', 'A'),
	(43, 3, 'Participar en un concurso de oratoria', 'I', 'A'),
	(44, 4, 'Diseñar el vestuario para una presentación teatral', 'I', 'A'),
	(45, 5, 'Leer biografias de músicos eminentes', 'I', 'A'),
	(46, 6, 'Encargarte del archivo y los documentos de una sociedad', 'I', 'A'),
	(47, 7, 'Leer revistas y libros científicos', 'I', 'A'),
	(48, 8, 'Participar en concursos de matemáticas', 'I', 'A'),
	(49, 9, 'Proyectar y dirigir alguna construcción', 'I', 'A'),
	(50, 10, 'Atender animales en un racho durante las vacaciones', 'I', 'A'),
	(51, 1, 'Funcionario al servicio de las clases humildes', 'I', 'A'),
	(52, 2, 'Experto en relaciones sociales de una gran empresa', 'I', 'A'),
	(53, 3, 'Escritor en un periódico o empresa editorial', 'I', 'A'),
	(54, 4, 'Dibujante profesional en una empresa', 'I', 'A'),
	(55, 5, 'Concertista en una sinfónica', 'I', 'A'),
	(56, 6, 'Técnico organizador de oficinas', 'I', 'A'),
	(57, 7, 'Investigar en un laboratorio', 'I', 'A'),
	(58, 8, 'Experto calculista en una institución', 'I', 'A'),
	(59, 9, 'Perito mecánico en un taller', 'I', 'A'),
	(60, 10, 'Técnico cuyas actividades se desempeñen fuera de la ciudad', 'I', 'A'),
	(61, 11, 'Tratar y hablar con sensibilidad a las personas', 'A', 'A'),
	(62, 12, 'Ser jefe competente de un grupo, equipo o sociedad', 'A', 'A'),
	(63, 13, 'Expresarte con facilidad en clase o al platicar con tus amigos', 'A', 'A'),
	(64, 14, 'Dibujar casas, objetos, figuras humanas, etcétera', 'A', 'A'),
	(65, 15, 'Cantar en un grupo', 'A', 'A'),
	(66, 16, 'Llevar en forma correcta y ordenada los apuntes de clase', 'A', 'A'),
	(67, 17, 'Entender principios y experimentos de biología', 'A', 'A'),
	(68, 18, 'Ejecutar con rapidez y exactitud operaciones aritméticas', 'A', 'A'),
	(69, 19, 'Armar y componer objetos mecánicos como  chapas, timbres, etcétera', 'A', 'A'),
	(70, 20, 'Actividades que requieren destreza manual', 'A', 'A'),
	(71, 11, 'Ser miembro activo y útil en un club o sociedad', 'A', 'A'),
	(72, 12, 'Organizar y dirigir festivales, encuentros deportivos, excursiones o campañas sociales', 'A', 'A'),
	(73, 13, 'Redactar composiciones o artículos periodísticos', 'A', 'A'),
	(74, 14, 'Pintar paisajes', 'A', 'A'),
	(75, 15, 'Tocar un instrumento músical', 'A', 'A'),
	(76, 16, 'Ordenar y clasificar debidamente documentos en una oficina', 'A', 'A'),
	(77, 17, 'Entender principios y experimentos de física', 'A', 'A'),
	(78, 18, 'Resolver problemas de aritmética', 'A', 'A'),
	(79, 19, 'Desarmar, armar y componer objetos complicados', 'A', 'A'),
	(80, 20, 'Manejar con habilidad herramientas de carpintería', 'A', 'A'),
	(81, 11, 'Colaborar con otros para el bien de la comunidad', 'A', 'A'),
	(82, 12, 'Convencer a otros para que hagan lo que crees que deben hacer', 'A', 'A'),
	(83, 13, 'Componer versos serios o jocosos', 'A', 'A'),
	(84, 14, 'Decorar artisticamente un salón o corredor, escenario o patio para un festival', 'A', 'A'),
	(85, 15, 'Distinguir cuando alguien desentona en las canciones o piezas musicales', 'A', 'A'),
	(86, 16, 'Contestar y redactar correctamente oficios y cartas', 'A', 'A'),
	(87, 17, 'Entender principios y experimentos de química', 'A', 'A'),
	(88, 18, 'Resolver rompecabezas numéricos', 'A', 'A'),
	(89, 19, 'resolver rompecabezas de alambre o de madera', 'A', 'A'),
	(90, 20, 'Manejar con habilidad herramientas mecánicas como pinzas, llaves de tuercas, desarmador, etc', 'A', 'A'),
	(91, 11, 'Saber escuchar a otros con paciencia y compreder su punto de vista', 'A', 'A'),
	(92, 12, 'Dar órdenes a otros con seguridad y naturalidad', 'A', 'A'),
	(93, 13, 'Escribir cuentos, narraciones o historietas', 'A', 'A'),
	(94, 14, 'Modelar con barro, plastilina o grabar madera', 'A', 'A'),
	(95, 15, 'Entonar correctamente las canciones de moda', 'A', 'A'),
	(96, 16, 'Anotar y manejar con exactitud y rapidez nombres, números y otros datos', 'A', 'A'),
	(97, 17, 'Entender principios y hechos económicos y sociales', 'A', 'A'),
	(98, 18, 'Resolver problemas de algebra', 'A', 'A'),
	(99, 19, 'Armar y componer muebles', 'A', 'A'),
	(100, 20, 'Manejar con habilidad pequeñas piezas y herramientas como agujas, manecillas, joyas, piezas de relojeria, etc', 'A', 'A'),
	(101, 11, 'Conversar en las reuniones y fiestas con acierto y naturalidad', 'A', 'A'),
	(102, 12, 'Dirigir un grupo o equipo en situaciones difíciles o peligrosas', 'A', 'A'),
	(103, 13, 'Distinguir y apreciar la buena literatura', 'A', 'A'),
	(104, 14, 'Distinguir y apreciar la buena pintura', 'A', 'A'),
	(105, 15, 'Distinguir y apreciar la buena música', 'A', 'A'),
	(106, 16, 'Encargarse de recibir, anotar y dar recados sin olvidar detalles importantes', 'A', 'A'),
	(107, 17, 'Entender las causas que determinan los acontecimientos históricos', 'A', 'A'),
	(108, 18, 'Resolver problemas de geometría', 'A', 'A'),
	(109, 19, 'Aprender el funcionamiento de ciertos mecanismos complicados como motores, relojes, bombas, etc', 'A', 'A'),
	(110, 20, 'Hacer con facilidad trazos geométricos con la ayuda de escuadras, regla T y compás', 'A', 'A'),
	(111, 11, 'Actuar con desinteres', 'A', 'A'),
	(112, 12, 'Corregir a los demás sin ofenderlos', 'A', 'A'),
	(113, 13, 'Exponer juicios públicamente sin preocupación por la crítica', 'A', 'A'),
	(114, 14, 'Colaborar en la elaboración de un libro sobre el arte de la arquitectura', 'A', 'A'),
	(115, 15, 'Dirigir un grupo músical', 'A', 'A'),
	(116, 16, 'Colaborar en el desarrollo de métodos mas eficientes de trabajo', 'A', 'A'),
	(117, 17, 'Realizar investigaciones cientificas teniendo como finalidad la búsqueda de la verdad', 'A', 'A'),
	(118, 18, 'Enseñar a resolver problemas de matemáticas', 'A', 'A'),
	(119, 19, 'Inducir a las personas a obtener resultados prácticos', 'A', 'A'),
	(120, 20, 'Participar en un concurso de modelismo de coches, aviones, barcos, etc', 'A', 'A');
/*!40000 ALTER TABLE `preguntas` ENABLE KEYS */;

-- Volcando estructura para tabla prueba-vocacional.resultados
DROP TABLE IF EXISTS `resultados`;
CREATE TABLE IF NOT EXISTS `resultados` (
  `resul_id` int unsigned NOT NULL AUTO_INCREMENT,
  `resul_fexamen` datetime NOT NULL,
  `resul_fmodificacion` datetime NOT NULL,
  `resul_area` char(1) COLLATE utf8_bin NOT NULL COMMENT 'Solo dos posibles valores para el area de aplicacion de la prueba: APTITUDES o INTERESES.',
  `resul_usuario_id` int unsigned NOT NULL,
  `resul_pregunta_id` smallint unsigned NOT NULL,
  `resul_categoria_id` smallint unsigned NOT NULL,
  `resul_valor` smallint unsigned NOT NULL,
  PRIMARY KEY (`resul_id`,`resul_valor`),
  UNIQUE KEY `UN_resul_usuario_id_pregunta_id` (`resul_usuario_id`,`resul_pregunta_id`),
  KEY `idx_resultados_fExamen` (`resul_fexamen`),
  KEY `FK_resultados_categorias_idx` (`resul_categoria_id`),
  KEY `FK_resultados_usuarios_idx` (`resul_usuario_id`),
  CONSTRAINT `FK_resultados_categorias` FOREIGN KEY (`resul_categoria_id`) REFERENCES `categorias` (`cat_id`),
  CONSTRAINT `FK_resultados_usuarios` FOREIGN KEY (`resul_usuario_id`) REFERENCES `usuarios` (`usuarios_id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- Volcando datos para la tabla prueba-vocacional.resultados: ~84 rows (aproximadamente)
DELETE FROM `resultados`;
/*!40000 ALTER TABLE `resultados` DISABLE KEYS */;
INSERT INTO `resultados` (`resul_id`, `resul_fexamen`, `resul_fmodificacion`, `resul_area`, `resul_usuario_id`, `resul_pregunta_id`, `resul_categoria_id`, `resul_valor`) VALUES
	(11, '2022-04-19 11:44:58', '2022-04-19 11:44:58', 'I', 5, 1, 1, 2),
	(12, '2022-04-19 11:44:58', '2022-04-19 11:44:58', 'I', 5, 2, 2, 0),
	(13, '2022-04-19 11:44:58', '2022-04-19 11:44:58', 'I', 5, 3, 3, 1),
	(14, '2022-04-19 11:44:58', '2022-04-19 11:44:58', 'I', 5, 4, 4, 4),
	(15, '2022-04-19 11:44:58', '2022-04-19 11:44:58', 'I', 5, 5, 5, 2),
	(16, '2022-04-19 11:44:58', '2022-04-19 11:44:58', 'I', 5, 6, 6, 2),
	(17, '2022-04-19 11:44:58', '2022-04-19 11:44:58', 'I', 5, 7, 7, 0),
	(18, '2022-04-19 11:44:58', '2022-04-19 11:44:58', 'I', 5, 8, 8, 2),
	(19, '2022-04-19 11:44:58', '2022-04-19 11:44:58', 'I', 5, 9, 9, 2),
	(20, '2022-04-19 11:44:58', '2022-04-19 11:44:58', 'I', 5, 10, 10, 2),
	(23, '2022-04-23 12:26:40', '2022-04-23 12:26:40', 'A', 5, 61, 11, 0),
	(24, '2022-04-23 12:26:40', '2022-04-23 12:26:40', 'A', 5, 62, 12, 1),
	(25, '2022-04-23 12:26:40', '2022-04-23 12:26:40', 'A', 5, 63, 13, 2),
	(26, '2022-04-23 12:26:40', '2022-04-23 12:26:40', 'A', 5, 64, 14, 3),
	(27, '2022-04-23 12:26:40', '2022-04-23 12:26:40', 'A', 5, 65, 15, 4),
	(28, '2022-04-23 12:26:40', '2022-04-23 12:26:40', 'A', 5, 66, 16, 0),
	(29, '2022-04-23 12:26:40', '2022-04-23 12:26:40', 'A', 5, 67, 17, 1),
	(30, '2022-04-23 12:26:40', '2022-04-23 12:26:40', 'A', 5, 68, 18, 2),
	(31, '2022-04-23 12:26:40', '2022-04-23 12:26:40', 'A', 5, 69, 19, 3),
	(32, '2022-04-23 12:26:40', '2022-04-23 12:26:40', 'A', 5, 70, 20, 4),
	(34, '2022-04-25 13:45:20', '2022-04-25 13:45:20', 'I', 7, 1, 1, 0),
	(35, '2022-04-25 13:45:20', '2022-04-25 13:45:20', 'I', 7, 2, 2, 1),
	(36, '2022-04-25 13:45:20', '2022-04-25 13:45:20', 'I', 7, 3, 3, 2),
	(37, '2022-04-25 13:45:20', '2022-04-25 13:45:20', 'I', 7, 4, 4, 3),
	(38, '2022-04-25 13:45:20', '2022-04-25 13:45:20', 'I', 7, 5, 5, 4),
	(39, '2022-04-25 13:45:20', '2022-04-25 13:45:20', 'I', 7, 6, 6, 0),
	(40, '2022-04-25 13:45:20', '2022-04-25 13:45:20', 'I', 7, 7, 7, 1),
	(41, '2022-04-25 13:45:20', '2022-04-25 13:45:20', 'I', 7, 8, 8, 2),
	(42, '2022-04-25 13:45:20', '2022-04-25 13:45:20', 'I', 7, 9, 9, 3),
	(43, '2022-04-25 13:45:20', '2022-04-25 13:45:20', 'I', 7, 10, 10, 4),
	(44, '2022-04-25 13:45:45', '2022-04-25 13:45:45', 'A', 7, 61, 11, 4),
	(45, '2022-04-25 13:45:45', '2022-04-25 13:45:45', 'A', 7, 62, 12, 3),
	(46, '2022-04-25 13:45:45', '2022-04-25 13:45:45', 'A', 7, 63, 13, 2),
	(47, '2022-04-25 13:45:46', '2022-04-25 13:45:46', 'A', 7, 64, 14, 1),
	(48, '2022-04-25 13:45:46', '2022-04-25 13:45:46', 'A', 7, 65, 15, 0),
	(49, '2022-04-25 13:45:46', '2022-04-25 13:45:46', 'A', 7, 66, 16, 4),
	(50, '2022-04-25 13:45:46', '2022-04-25 13:45:46', 'A', 7, 67, 17, 3),
	(51, '2022-04-25 13:45:46', '2022-04-25 13:45:46', 'A', 7, 68, 18, 2),
	(52, '2022-04-25 13:45:46', '2022-04-25 13:45:46', 'A', 7, 69, 19, 1),
	(53, '2022-04-25 13:45:46', '2022-04-25 13:45:46', 'A', 7, 70, 20, 0),
	(54, '2022-04-25 14:28:23', '2022-04-25 14:28:23', 'I', 6, 1, 1, 0),
	(55, '2022-04-25 14:28:23', '2022-04-25 14:28:23', 'I', 6, 2, 2, 1),
	(56, '2022-04-25 14:28:23', '2022-04-25 14:28:23', 'I', 6, 3, 3, 2),
	(57, '2022-04-25 14:28:23', '2022-04-25 14:28:23', 'I', 6, 4, 4, 1),
	(58, '2022-04-25 14:28:23', '2022-04-25 14:28:23', 'I', 6, 5, 5, 3),
	(59, '2022-04-25 14:28:23', '2022-04-25 14:28:23', 'I', 6, 6, 6, 4),
	(60, '2022-04-25 14:28:23', '2022-04-25 14:28:23', 'I', 6, 7, 7, 2),
	(61, '2022-04-25 14:28:23', '2022-04-25 14:28:23', 'I', 6, 8, 8, 4),
	(62, '2022-04-25 14:28:23', '2022-04-25 14:28:23', 'I', 6, 9, 9, 1),
	(63, '2022-04-25 14:28:23', '2022-04-25 14:28:23', 'I', 6, 10, 10, 2),
	(64, '2022-04-25 14:28:35', '2022-04-25 14:28:35', 'A', 6, 61, 11, 3),
	(65, '2022-04-25 14:28:35', '2022-04-25 14:28:35', 'A', 6, 62, 12, 3),
	(66, '2022-04-25 14:28:35', '2022-04-25 14:28:35', 'A', 6, 63, 13, 3),
	(67, '2022-04-25 14:28:35', '2022-04-25 14:28:35', 'A', 6, 64, 14, 3),
	(68, '2022-04-25 14:28:35', '2022-04-25 14:28:35', 'A', 6, 65, 15, 3),
	(69, '2022-04-25 14:28:35', '2022-04-25 14:28:35', 'A', 6, 66, 16, 3),
	(70, '2022-04-25 14:28:35', '2022-04-25 14:28:35', 'A', 6, 67, 17, 3),
	(71, '2022-04-25 14:28:35', '2022-04-25 14:28:35', 'A', 6, 68, 18, 3),
	(72, '2022-04-25 14:28:35', '2022-04-25 14:28:35', 'A', 6, 69, 19, 3),
	(73, '2022-04-25 14:28:35', '2022-04-25 14:28:35', 'A', 6, 70, 20, 2),
	(74, '2022-04-25 14:37:41', '2022-04-25 14:37:41', 'I', 8, 1, 1, 3),
	(75, '2022-04-25 14:37:41', '2022-04-25 14:37:41', 'I', 8, 2, 2, 3),
	(76, '2022-04-25 14:37:41', '2022-04-25 14:37:41', 'I', 8, 3, 3, 3),
	(77, '2022-04-25 14:37:41', '2022-04-25 14:37:41', 'I', 8, 4, 4, 2),
	(78, '2022-04-25 14:37:41', '2022-04-25 14:37:41', 'I', 8, 5, 5, 2),
	(79, '2022-04-25 14:37:41', '2022-04-25 14:37:41', 'I', 8, 6, 6, 2),
	(80, '2022-04-25 14:37:41', '2022-04-25 14:37:41', 'I', 8, 7, 7, 4),
	(81, '2022-04-25 14:37:41', '2022-04-25 14:37:41', 'I', 8, 8, 8, 4),
	(82, '2022-04-25 14:37:41', '2022-04-25 14:37:41', 'I', 8, 9, 9, 4),
	(83, '2022-04-25 14:37:41', '2022-04-25 14:37:41', 'I', 8, 10, 10, 4),
	(84, '2022-04-25 14:37:52', '2022-04-25 14:37:52', 'A', 8, 61, 11, 1),
	(85, '2022-04-25 14:37:52', '2022-04-25 14:37:52', 'A', 8, 62, 12, 1),
	(86, '2022-04-25 14:37:52', '2022-04-25 14:37:52', 'A', 8, 63, 13, 2),
	(87, '2022-04-25 14:37:52', '2022-04-25 14:37:52', 'A', 8, 64, 14, 2),
	(88, '2022-04-25 14:37:52', '2022-04-25 14:37:52', 'A', 8, 65, 15, 0),
	(89, '2022-04-25 14:37:52', '2022-04-25 14:37:52', 'A', 8, 66, 16, 0),
	(90, '2022-04-25 14:37:52', '2022-04-25 14:37:52', 'A', 8, 67, 17, 4),
	(91, '2022-04-25 14:37:52', '2022-04-25 14:37:52', 'A', 8, 68, 18, 4),
	(92, '2022-04-25 14:37:52', '2022-04-25 14:37:52', 'A', 8, 69, 19, 2),
	(93, '2022-04-25 14:37:52', '2022-04-25 14:37:52', 'A', 8, 70, 20, 2);
/*!40000 ALTER TABLE `resultados` ENABLE KEYS */;

-- Volcando estructura para tabla prueba-vocacional.resultado_resumen
DROP TABLE IF EXISTS `resultado_resumen`;
CREATE TABLE IF NOT EXISTS `resultado_resumen` (
  `resulResumen_id` int unsigned NOT NULL AUTO_INCREMENT,
  `resulResumen_total` smallint unsigned NOT NULL DEFAULT '0',
  `resulResumen_usuario_id` int unsigned NOT NULL,
  `resulResumen_categoria_id` smallint unsigned NOT NULL,
  `resulResumen_area` char(1) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`resulResumen_id`),
  UNIQUE KEY `UN_resulResumen_usuario_id_categoria_id` (`resulResumen_usuario_id`,`resulResumen_categoria_id`),
  KEY `FK_resulResumen_usuarios_idx` (`resulResumen_usuario_id`),
  KEY `FK_resulResumen_categorias_idx` (`resulResumen_categoria_id`),
  CONSTRAINT `FK_resulResumen_categorias` FOREIGN KEY (`resulResumen_categoria_id`) REFERENCES `categorias` (`cat_id`),
  CONSTRAINT `FK_resulResumen_usuarios` FOREIGN KEY (`resulResumen_usuario_id`) REFERENCES `usuarios` (`usuarios_id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- Volcando datos para la tabla prueba-vocacional.resultado_resumen: ~84 rows (aproximadamente)
DELETE FROM `resultado_resumen`;
/*!40000 ALTER TABLE `resultado_resumen` DISABLE KEYS */;
INSERT INTO `resultado_resumen` (`resulResumen_id`, `resulResumen_total`, `resulResumen_usuario_id`, `resulResumen_categoria_id`, `resulResumen_area`) VALUES
	(11, 2, 5, 1, 'I'),
	(12, 0, 5, 2, 'I'),
	(13, 1, 5, 3, 'I'),
	(14, 4, 5, 4, 'I'),
	(15, 2, 5, 5, 'I'),
	(16, 2, 5, 6, 'I'),
	(17, 0, 5, 7, 'I'),
	(18, 2, 5, 8, 'I'),
	(19, 2, 5, 9, 'I'),
	(20, 2, 5, 10, 'I'),
	(21, 0, 5, 11, 'A'),
	(22, 1, 5, 12, 'A'),
	(23, 2, 5, 13, 'A'),
	(24, 3, 5, 14, 'A'),
	(25, 4, 5, 15, 'A'),
	(26, 0, 5, 16, 'A'),
	(27, 1, 5, 17, 'A'),
	(28, 2, 5, 18, 'A'),
	(29, 3, 5, 19, 'A'),
	(30, 4, 5, 20, 'A'),
	(31, 0, 7, 1, 'I'),
	(32, 1, 7, 2, 'I'),
	(33, 2, 7, 3, 'I'),
	(34, 3, 7, 4, 'I'),
	(35, 4, 7, 5, 'I'),
	(36, 0, 7, 6, 'I'),
	(37, 1, 7, 7, 'I'),
	(38, 2, 7, 8, 'I'),
	(39, 3, 7, 9, 'I'),
	(40, 4, 7, 10, 'I'),
	(41, 4, 7, 11, 'A'),
	(42, 3, 7, 12, 'A'),
	(43, 2, 7, 13, 'A'),
	(44, 1, 7, 14, 'A'),
	(45, 0, 7, 15, 'A'),
	(46, 4, 7, 16, 'A'),
	(47, 3, 7, 17, 'A'),
	(48, 2, 7, 18, 'A'),
	(49, 1, 7, 19, 'A'),
	(50, 0, 7, 20, 'A'),
	(51, 0, 6, 1, 'I'),
	(52, 1, 6, 2, 'I'),
	(53, 2, 6, 3, 'I'),
	(54, 1, 6, 4, 'I'),
	(55, 3, 6, 5, 'I'),
	(56, 4, 6, 6, 'I'),
	(57, 2, 6, 7, 'I'),
	(58, 4, 6, 8, 'I'),
	(59, 1, 6, 9, 'I'),
	(60, 2, 6, 10, 'I'),
	(61, 3, 6, 11, 'A'),
	(62, 3, 6, 12, 'A'),
	(63, 3, 6, 13, 'A'),
	(64, 3, 6, 14, 'A'),
	(65, 3, 6, 15, 'A'),
	(66, 3, 6, 16, 'A'),
	(67, 3, 6, 17, 'A'),
	(68, 3, 6, 18, 'A'),
	(69, 3, 6, 19, 'A'),
	(70, 2, 6, 20, 'A'),
	(71, 3, 8, 1, 'I'),
	(72, 3, 8, 2, 'I'),
	(73, 3, 8, 3, 'I'),
	(74, 2, 8, 4, 'I'),
	(75, 2, 8, 5, 'I'),
	(76, 2, 8, 6, 'I'),
	(77, 4, 8, 7, 'I'),
	(78, 4, 8, 8, 'I'),
	(79, 4, 8, 9, 'I'),
	(80, 4, 8, 10, 'I'),
	(81, 1, 8, 11, 'A'),
	(82, 1, 8, 12, 'A'),
	(83, 2, 8, 13, 'A'),
	(84, 2, 8, 14, 'A'),
	(85, 0, 8, 15, 'A'),
	(86, 0, 8, 16, 'A'),
	(87, 4, 8, 17, 'A'),
	(88, 4, 8, 18, 'A'),
	(89, 2, 8, 19, 'A'),
	(90, 2, 8, 20, 'A');
/*!40000 ALTER TABLE `resultado_resumen` ENABLE KEYS */;

-- Volcando estructura para tabla prueba-vocacional.tipos_usuario
DROP TABLE IF EXISTS `tipos_usuario`;
CREATE TABLE IF NOT EXISTS `tipos_usuario` (
  `tipousua_id` smallint unsigned NOT NULL AUTO_INCREMENT,
  `tipoUsua_codigo` varchar(3) COLLATE utf8_bin NOT NULL,
  `tipousua_nombre` varchar(20) COLLATE utf8_bin NOT NULL,
  `tipousua_descripcion` varchar(200) COLLATE utf8_bin NOT NULL,
  `tipousua_notas` varchar(3000) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`tipousua_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- Volcando datos para la tabla prueba-vocacional.tipos_usuario: ~2 rows (aproximadamente)
DELETE FROM `tipos_usuario`;
/*!40000 ALTER TABLE `tipos_usuario` DISABLE KEYS */;
INSERT INTO `tipos_usuario` (`tipousua_id`, `tipoUsua_codigo`, `tipousua_nombre`, `tipousua_descripcion`, `tipousua_notas`) VALUES
	(1, 'BAS', 'BASICO', 'USUARIO CON PERMISOS BASICOS Y RESTRINGIDOS. SOLO PUEDE VER SU INFORMACION Y TOMAR LA PRUEBA. USUARIO PARA EL QUE ESTA DISEÑADA LA PRUEBA.', NULL),
	(2, 'PSI', 'PSICOLOGO', 'USUARIO QUE ANALIZA Y PUEDE CONSULTAR LA INFORMACION DE USUARIOS BASICOS PARA TOMAR CONCLUSIONES Y/O INFORMES.', NULL),
	(3, 'ADM', 'ADMINISTRADOR', '(sin aplicación) USUARIO CON PERMISOS TOTALES PARA LABORES DE MANTENIMIENTO Y OPERACION DE LA APLICACION, ENCARGADO DEL DISEÑO Y LA PROGRAMACION DE LA APLICACION.', NULL);
/*!40000 ALTER TABLE `tipos_usuario` ENABLE KEYS */;

-- Volcando estructura para tabla prueba-vocacional.usuarios
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `usuarios_id` int unsigned NOT NULL AUTO_INCREMENT,
  `usuarios_usuario` varchar(500) COLLATE utf8_bin NOT NULL,
  `usuarios_password` varchar(500) COLLATE utf8_bin NOT NULL,
  `usuarios_nombres` varchar(500) COLLATE utf8_bin NOT NULL,
  `usuarios_apellido1` varchar(500) COLLATE utf8_bin NOT NULL,
  `usuarios_apellido2` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `usuarios_nacimiento` date NOT NULL,
  `usuarios_creacionReg` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuarios_email` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `usuarios_telefono` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `usuarios_notas` varchar(10000) COLLATE utf8_bin DEFAULT NULL,
  `usuarios_status` char(1) COLLATE utf8_bin NOT NULL DEFAULT 'A' COMMENT 'Campo que puede ser usado, por ejemplo, para "Activar" o "Desactivar" la pregunta. Valor por "A".',
  `usuarios_tipoUsuario_id` smallint unsigned NOT NULL,
  PRIMARY KEY (`usuarios_id`),
  UNIQUE KEY `usuarios_usuario_UNIQUE` (`usuarios_usuario`),
  KEY `idx_usuarios_usuario` (`usuarios_usuario`),
  KEY `idx_usuarios_email` (`usuarios_email`),
  KEY `FK_usuarios_tipoUsuario_idx` (`usuarios_tipoUsuario_id`),
  CONSTRAINT `FK_usuarios_tipoUsuario` FOREIGN KEY (`usuarios_tipoUsuario_id`) REFERENCES `tipos_usuario` (`tipousua_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- Volcando datos para la tabla prueba-vocacional.usuarios: ~6 rows (aproximadamente)
DELETE FROM `usuarios`;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`usuarios_id`, `usuarios_usuario`, `usuarios_password`, `usuarios_nombres`, `usuarios_apellido1`, `usuarios_apellido2`, `usuarios_nacimiento`, `usuarios_creacionReg`, `usuarios_email`, `usuarios_telefono`, `usuarios_notas`, `usuarios_status`, `usuarios_tipoUsuario_id`) VALUES
	(1, 'q', '4dff4ea340f0a823f15d3f4f01ab62eae0e5da579ccb851f8db9dfe84c58b2b37b89903a740e1ee172da793a6e79d560e5f7f9bd058a12a280433ed6fa46510a', 'Quentin', 'Queretaro', 'Quiros', '2000-01-01', '2020-11-03 21:28:47', '', '', '', 'A', 1),
	(3, 'john', 'b7fcc6e612145267d2ffea04be754a34128c1ed8133a09bfbbabd6afe6327688aa71d47343dd36e719f35f30fa79aec540e91b81c214fddfe0bedd53370df46d', 'John', 'Skolik', 'Hernandez', '1979-09-13', '2020-11-03 21:33:53', '', '', '', 'A', 2),
	(5, 'w', 'aa66509891ad28030349ba9581e8c92528faab6a34349061a44b6f8fcd8d6877a67b05508983f12f8610302d1783401a07ec41c7e9ebd656de34ec60d84d9511', 'wiston', 'werley', 'wey', '2000-01-01', '2022-04-19 11:42:39', '', '', '', 'A', 1),
	(6, 'p', '929872838cb9cfe6578e11f0a323438aee5ae7f61d41412d62db72b25dac52019de2d6a355eb2d033336fb70e73f0ec0afeca3ef36dd8a90d83f998fee23b78d', 'Pedro', '', '', '2000-09-13', '2022-04-23 12:33:28', '', '', '', 'A', 1),
	(7, 'k', '2af8a9104b3f64ed640d8c7e298d2d480f03a3610cbc2b33474321ec59024a48592ea8545e41e09d5d1108759df48ede0054f225df39d4f0f312450e0aa9dd25', 'Kevin', '', '', '2001-03-02', '2022-04-25 13:36:55', '', '', '', 'A', 1),
	(8, 'f', '711c22448e721e5491d8245b49425aa861f1fc4a15287f0735e203799b65cffec50b5abd0fddd91cd643aeb3b530d48f05e258e7e230a94ed5025c1387bb4e1b', 'Fernando', 'Feries', '', '2003-02-28', '2022-04-25 14:37:28', '', '', '', 'A', 1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
