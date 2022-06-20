<?php

    // define('RUTA', 'http://192.168.0.101/p-vocacional/');
    define('RUTA', "http://" . $_SERVER['HTTP_HOST'] . "/p-vocacional/");
    define('INTERESES', 'Intereses');
    define('APTITUDES', 'Aptitudes');
    const TIPO_INTERESES = 'I';
    const TIPO_APTITUDES = 'A';
    const ACTIVO = 'A';
    // consultar los tipos de usuarios y cargarlos en un Array
    define('BASICO', "BASICO"); //'Basico' = 1 );
    define('PSICOLOGO', 'PSICOLOGO');
    const ADMINISTRADOR = 'ADMINISTRADOR';
    //Tiempo en segundos para dar vida a la sesión.
    define('TIEMPOSESION', 3600); // 60min 
    // define('TIEMPOSESION', ); // 60min 

    // define los limites de edades 
    const EDAD_MIN = 18;

    // configuracion para la conexion a la base de datos ddbb:
    // $db_config = ['host' => '192.168.0.100', 
    // $db_config = ['host' => '127.0.0.1', 
    $db_config = ['host' => 'localhost', 
                    'ddbb_name' => 'prueba-vocacional',
                    'ddbb_user' => 'p-voca-user',
                    'ddbb_pass' => 'ALejandra2019'
                    ];

    // Clase Area = Intereses o Aptitudes o alguna tercera opcion
    class Area {
        private $tipo;                  // tipo TIPO_INTERESES ('I'), TIPO_APTITUDES ('A')
        private $name;                  // Intereses o Apitudes
        private $titulo;                // titulo de parrafo (bienvenida-prueba.view.php)
        private $textoRecuerda;         // Textos de descripcion de las areas 
        private $textoDescripcion;      // Texto explicacion area
        private $textoInstrucciones;    // Texto de las Instrucciones
        // metodos 
        function getTipo() { return $this->tipo; }
        function getName() { return $this->name; }
        function getTitulo() { return $this->titulo; }
        function getTextoRecuerda() { return $this->textoRecuerda; }
        function getTextoDescripcion() {return $this->textoDescripcion; }
        function getInstrucciones() { return $this->textoInstrucciones; }

        function __construct() {
                $this->tipo = "";
                $this->name = "";
                $this->titulo = "";
                $this->textoRecuerda = "";
                $this->textoDescripcion = "";
                $this->textoInstrucciones = "";
        }

        // *********************************************************
        // NOTA: aunque los miembros de OBJ son "privados" SI se tiene acceso a ellos dentro de la funcion.
        function copiarObjeto( $obj) {
            $this->tipo = $obj->tipo;
            $this->name = $obj->name;
            $this->titulo = $obj->titulo;
            $this->textoRecuerda = $obj->textoRecuerda;
            $this->textoDescripcion = $obj->getTextoDescripcion();
            $this->textoInstrucciones = $obj->getInstrucciones();
        }
        // *********************************************************

        function iniciarObjeto($tipo, $name, $titulo, $textoRecuerda, $textoDescripcion, $textoInstrucciones) {
            $this->tipo = $tipo;
            $this->name = $name;
            $this->titulo = $titulo;
            $this->textoRecuerda = $textoRecuerda;
            $this->textoDescripcion = $textoDescripcion;
            $this->textoInstrucciones = $textoInstrucciones;
        }
    }
    
    // creando el objeto "Intereses" de la clase "Area"
    $intereses = new Area();
    $intereses->iniciarObjeto( TIPO_INTERESES, INTERESES, 'Prueba de Intereses', 
        // Recuerda
        "<p><u>Recuerda</u>, ¿que tanto te <u><strong>gustaría hacer</strong></u> la acción descrita en la pregunta?</p>", 
        // Texto Descripcion
        "<p>En la medida que vayas leyendo, piensa, <u><strong>que tanto te gustaría hacer</strong></u> la acción descrita en la pregunta. Posteriormente, por cada pregunta selecciona la respuesta que estimes de acuerdo a tu interés por desarrollar la actividad planteada teniendo en cuenta la escala indicada.</p>
        <p>Recuerda no saltarte ninguna pregunta, ya que es necesario responder todas y debes responder según <strong>tú</strong> te sientas identificado con cada situación planteada en la pregunta.</p>", 
        // Instrucciones
        '<ol class="instrucciones">
        <li><i class="far fa-angry"></i><span> Me desagrado mucho o totalmente.</span></li>
        <li><i class="far fa-frown-open"></i><span> Me desagrada algo o en parte.</span></li>
        <li><i class="far fa-meh"></i><span> Me es indiferente, ni me gusta ni me disgusta.</span></li>
        <li><i class="far fa-smile"></i><span> Me gusta algo o en parte.</span></li>
        <li><i class="far fa-grin-hearts"></i><span> Me gusta mucho.</span></li>
        </ol>' );

    $aptitudes = new Area;
    $aptitudes->iniciarObjeto( TIPO_APTITUDES, APTITUDES, 'Prueba de Aptitudes', 
        // Recuerda
        "<p><u>Recuerda</u>, ¿que tan apto te consideras para <u><strong>aprender o desempeñar</strong></u> las actividades descritas?</p>",
        // Texto Descripcion
        "<p>Para esta prueba, a diferencia de la anterior, antes de elegir una respuesta recuerda o imagina en qué consiste la respectiva actividad.</p>
        <p>Ten encuenta que no se te pregunta si te gustan las actividades, se trata de que contestes <u><strong>que tan apto te consideras para aprenderlas o desempeñarlas.</strong></u></p>", 
        // Instrucciones
        '<ol class="instrucciones">
        <li><i class="far fa-angry"></i><span> Considero NO ser apto o incompetente.</span></li>
        <li><i class="far fa-frown-open"></i><span> Considero ser muy poco apto o competente.</span></li>
        <li><i class="far fa-meh"></i><span> Considero ser medianamente apto o competente.</span></li>
        <li><i class="far fa-smile"></i><span> Considero ser apto o competente.</span></li>
        <li><i class="far fa-grin-hearts"></i><span> Considero ser muy apto o competente.</span></li>
        </ol>' );







        // *************************************************************
        // FUNCION PARA DEBUG
    
        // funcion para hacer debug del codigo, tipo = true => "var_dump()", sino "print_r()"
        function codDebug($variable, $tipo = true, $mensaje = '') {
            echo "<br>*********************************<br>";
            if ($mensaje != '') {
                echo "MENSAJE: " . $mensaje . "<br>";
            }
            echo "<pre>";
            if($tipo) {
                var_dump($variable);
            } else {
                print_r($variable);
            }
            echo "</pre>";
            echo "<br>*********************************<br>";
        }
        // *************************************************************

    // UTILIZACION DE LIBRERIA "FileHandlerClass.php" PARA ESCRITURA EN DISCO DEL LOG

    require_once __DIR__ . "/../PVocacionalLogClass.php";

    // regLog(__FILE__, __LINE__, "Saliendo de config.php");

    function regLog($p_file, $p_line, $p_mensaje, $p_mode = false)
    {
        $fileMode = $p_mode ? "w" : "a";
        $pathFile = __DIR__ . '/' . "pvocacional.log";

        $log = new PVocacionalLogClass ($pathFile, $fileMode);
        $log->regLog($p_file, $p_line, $p_mensaje); 

    }

    // INICIANDO UN NUEVO ARCHIVO DE LOG PARA REGISTRO
    regLog(__FILE__, __LINE__, "INICIANDO UN NUEVO REGISTRO", true);

    
?>
