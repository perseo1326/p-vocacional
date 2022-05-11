SET SQL_SAFE_UPDATES = 0;
USE `prueba-vocacional` ;

-- Volcando datos para la tabla prueba-vocacional.categorias: ~20 rows (aproximadamente)
DELETE FROM `prueba-vocacional`.`categorias`
WHERE `categorias`.`cat_status` = 'A';

INSERT INTO `prueba-vocacional`.`categorias` (`cat_id`, `cat_tipo`, `cat_categoria`, `cat_descripcion`, `cat_notas`, `cat_area`, `cat_status`) VALUES
(NULL, 'SS', 'SERVICIO SOCIAL', 'Preferencia por participar en actividades directamente relacionadas con el bienestar de las personas.', '', 'I', 'A'),
(NULL, 'EP', 'EJECUTIVO PERSUASIVA', 'Agrado por planear, organizar o dirigir las actividades de personas o agrupaciones.', '', 'I', 'A'),
(NULL, 'V', 'VERBAL', 'Gusto por la lectura de obras diversas y satisfacción al expresarse verbalmente o pro escrito', '', 'I', 'A'),
(NULL, 'AP', 'ARTISTICO PLASTICA', 'Agrado por conocer o realizar actividades creativas como dibujo, la pintura, escultura, el modelado, etc.', '', 'I', 'A'),
(NULL, 'MS', 'MUSICAL', 'Gusto por la ejecución, estudio o composición de la música.', '', 'I', 'A'),
(NULL, 'OG', 'ORGANIZACION', 'Preferencia por actividades que requieren orden y sistematización.', '', 'I', 'A'),
(NULL, 'CI', 'CIENTIFICA', 'Gusto por conocer o investigar los fenómenos, las causas que los provocan y los principios que los explican.', '', 'I', 'A'),
(NULL, 'CL', 'CALCULO', 'Gusto por resolver problemas de tipo cuantitativo, donde se utilizan las operaciones matemáticas.', '', 'I', 'A'),
(NULL, 'MC', 'MECANICO CONSTRUCTIVA', 'Atracción por armar, conocer o descubrir mecanismos mediante los cuales funciona un aparato, así como proyectar y construir objetos diversos.', '', 'I', 'A'),
(NULL, 'AL', 'TRABAJO AL AIRE LIBRE', 'Satisfacción por actividades que se realizan en lugares abiertos y/o apartados de los conglomerados urbanos.', '', 'I', 'A'),
(NULL, 'SS', 'SERVICIO SOCIAL', 'Habilidad para comprender problemas humanos, para tratar personas, cooperar y persuadir; para hacer lo más adecuado ante situaciones sociales. Actitud de ayuda afectuosa y desinteresada hacia sus semejantes.', '', 'A', 'A'),
(NULL, 'EP', 'EJECUTIVO PERSUASIVA', 'Capacidad para organizar, dirigir y supervisar a otros adecuadamente; poseer iniciativa, confianza en sí mismo, ambición de progreso, habilidad para dominar en situaciones sociales y en relaciones de persona a persona.', '', 'A', 'A'),
(NULL, 'V', 'VERBAL', 'Habilidad para comprender y expresarse correctamente. También para utilizar Las palabras precisas y adecuadas.', '', 'A', 'A'),
(NULL, 'AP', 'ARTISTICO PLASTICA', 'Habilidad para apreciar las formas o colores de un objeto, dibujo, escultura o pintura y para crear obras de mérito artístico en pintura, escultura, grabado o dibujo.', '', 'A', 'A'),
(NULL, 'MS', 'MUSICAL', 'Habilidad para captar y distinguir sonidos en sus diversas modalidades, para imaginar estos sonidos, reproducirlos o utilizarlos en forma creativa; sensibilidad a la combinación y armonía de sonidos.', '', 'A', 'A'),
(NULL, 'OG', 'ORGANIZACION', 'Capacidad de organización, orden, exactitud y rapidez en el manejo de nombres, números, documentos, sistemas y sus detalles en trabajos rutinarios.', '', 'A', 'A'),
(NULL, 'CI', 'CIENTIFICA', 'Habilidad para la investigación; aptitud para captar, definir y comprender principios y relaciones causales de los fenómenos proponiéndose siempre la obtención de la novedad.', '', 'A', 'A'),
(NULL, 'CL', 'CALCULO', 'Dominio de las operaciones y mecanizaciones numéricas, así como habilidad para el cálculo matemático.', '', 'A', 'A'),
(NULL, 'MC', 'MECANICO CONSTRUCTIVA', 'Comprensión y habilidad en la manipulación de objetos y facilidad para percibir, imaginar y analizar formas en dos o tres dimensiones, así como para abstraer sistemas, mecanismos y movimientos', '', 'A', 'A'),
(NULL, 'DT', 'DESTREZA MANUAL', 'Habilidad en el uso de las manos para el manejo de herramientas; ejecución de movimientos coordinados y precisos.', '', 'A', 'A');

SET SQL_SAFE_UPDATES = 1;