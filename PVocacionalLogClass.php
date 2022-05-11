<?php
// ************ FILE MODE ************  
// Modes   Description
// r       Open a file for read only. File pointer starts at the beginning of the file
// w       Open a file for write only. Erases the contents of the file or creates a new file if it doesn't exist. File pointer starts at the beginning of the file
// a       Open a file for write only. The existing data in file is preserved. File pointer starts at the end of the file. Creates a new file if the file doesn't exist
// x       Creates a new file for write only. Returns FALSE and an error if file already exists
// r+      Open a file for read/write. File pointer starts at the beginning of the file
// w+      Open a file for read/write. Erases the contents of the file or creates a new file if it doesn't exist. File pointer starts at the beginning of the file
// a+      Open a file for read/write. The existing data in file is preserved. File pointer starts at the end of the file. Creates a new file if the file doesn't exist
// x+      Creates a new file for read/write. Returns FALSE and an error if file already exists


// const FILE_MODE = "w";
// const FILE_PATH = RUTA_LOG;
// const FILE_NAME = "pvocacional.log";
// // const $p_fileName = FILE_PATH . "/" . FILE_NAME;

require_once __DIR__ . "/../lib/FileHandlerClass.php";

class PVocacionalLogClass extends FileHandlerClass
{
    private $m_dataFile;

    public function __construct($p_fileName, $p_fileMode)
    {
        $nombreArchivo  = $p_fileName;
        $this->m_dataFile       = "";

        parent::__construct($nombreArchivo, $p_fileMode);

    }
    
    public function regLog($p_file, $p_line, $p_mensaje)
    {
        $this->m_dataFile = $p_file . ' ** LINEA: '. $p_line . ' => ' . $p_mensaje . PHP_EOL;
        $this->writeContent($this->m_dataFile);
        // codigoDebug($this, false, "TESTRESULTCLASS");
    }
    
}

// $p_file = FILE_PATH . "/" . FILE_NAME;
// $GLOBALS['log'] = new PVocacionalLogClass ($p_file, FILE_MODE);
// regLog("INICIANDO LOG...", __LINE__,  ""); 