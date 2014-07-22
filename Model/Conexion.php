<?php

class Conexion {

    var $BaseDatos;
    var $Servidor;
    var $Usuario;
    var $Clave;
    /* identificador de conexión y consulta */
    var $Conexion_ID;
    var $Consulta_ID;

    /* número de error y texto error */
    var $Errno = 0;
    var $Error = "";

    function  Conexion() {
        /* Local ******************************/
        $this->BaseDatos = "";
        $this->Servidor = "localhost";
        $this->Usuario = "root";
        $this->Clave = "yuplon";
        /***************************************/
        
        /* Produccion ***************************
        $this->BaseDatos = "";
        $this->Servidor = "";
        $this->Usuario = "";
        $this->Clave = "";
        /***************************************/
         
    }

    function conectar() {
        $this->Conexion_ID = mysql_connect($this->Servidor, $this->Usuario, $this->Clave);
        if (!$this->Conexion_ID) {
            $this->Error = "Ha fallado la conexion.";
            return 0;
        }

        if (!@mysql_select_db($this->BaseDatos, $this->Conexion_ID)) {
            $this->Error = "Imposible abrir " . $this->BaseDatos;
            return 0;
        }
        return $this->Conexion_ID;
    }

}

?>
