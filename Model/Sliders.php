<?php
include_once("Conexion.php");
class Sliders {

    private $id;
    private $url_imagen;
    private $url_destino;
    private $activo;
    private $orden;
    private $created_at;
    private $updated_at;
    
    
    function Sliders(){
    }
    
    /*Metodo utilizado para insertar un Precio a la base de datos*/
    function insertarSlider() {
        $rpta;
        try {
            /*Creamos un objeto de la clase conexion*/
            $miconexion = new Conexion();
            /*Obtenemos la conexion*/
            $cn = $miconexion->conectar();
            /*Comenzamos la transaccion*/
            mysql_query("BEGIN", $cn);
           /*Elaboramos la sentencia*/
            $sql = "INSERT INTO sliders (`url_imagen`, `url_destino`, `activo`, `orden`, `created_at`)
                                VALUES('$this->url_imagen','$this->url_destino','$this->activo', '$this->orden', NOW())";
            
            /*Ejecutamos la sentencia*/
            $result = mysql_query($sql, $cn);
            if (!$result) {
                /*Si no obtiene resultados anulamos la transaccion*/
                mysql_query("ROLLBACK", $cn);
                $rpta = false;
            } else {
                /*Si obtiene resultados confirmamos la transaccion*/
                mysql_query("COMMIT", $cn);
                $this->created_at = date("Y-m-d H:i:s", time());
                $rpta = true;
            }
            /*Cerramos la conexion*/
            mysql_close($cn);
        } catch (exception $e) {
            try {
                mysql_query("ROLLBACK", $cn);
            } catch (exception $e1) {

            }
            try {
                mysql_close($cn);
            } catch (exception $e1) {

            }
            $rpta = false;
        }
        return $rpta;
    }

    /*Metodo utilizado para actualizar un Periodo*/
    function actualizarSlider() {
        $rpta;
        try {
            /*Creamos un objeto de la clase conexion*/
            $miconexion = new Conexion();
            /*Obtenemos la conexion*/
            $cn = $miconexion->conectar();
            /*Comenzamos la transaccion*/
            mysql_query("BEGIN", $cn);
            
            /*Elaboramos la sentencia*/
            $sql = "UPDATE sliders SET url_imagen='$this->url_imagen', url_destino='$this->url_destino', activo='$this->activo', orden='$this->orden', updated_at=NOW()
                WHERE id='$this->id'";
            
            /*Ejecutamos la sentencia*/
            $result = mysql_query($sql, $cn);
            $rpta;
            if (!$result) {
                /*Si no obtiene resultados anulamos la transaccion*/
                mysql_query("ROLLBACK", $cn);
                $rpta = false;
            } else {
                /*Si obtiene resultados confirmamos la transaccion*/
                mysql_query("COMMIT", $cn);
                $this->updated_at =  date("Y-m-d H:i:s", time());
                $rpta = true;
            }
            /*Cerramos la conexion*/
            mysql_close($cn);
        } catch (exception $e) {
            try {
                mysql_query("ROLLBACK", $cn);
            } catch (exception $e1) {

            }
            try {
                mysql_close($cn);
            } catch (exception $e1) {

            }
            $rpta = false;
        }
        return $rpta;
    }
    
    /*Metodo utilizado para obtener un Precio*/
    function buscarSlider($where=array()) {
        /*Le deciamos que la locacion es lenguaje español*/
        setlocale(LC_CTYPE, 'es');
        /*La sentencia a ejecutar*/
        
        $str_where = "id='$this->id'";
        if(count($where)>0) $str_where = implode(" AND ", $where);
        $sql = "SELECT * FROM sliders WHERE $str_where";
        
        /*Creamos un array que almacenara los datos de la sentencia*/
        $registros = array();
        
        /*Creamos un objeto de la clase conexion*/
        $miconexion = new Conexion();
        /*Obtenemos la conexion*/
        $cn = $miconexion->conectar();
        $rs = null;
        try {
            /*Ejecutamos la sentencia*/
            $rs = mysql_query($sql, $cn);
            if(mysql_num_rows($rs)==1) 
                $registros = mysql_fetch_assoc($rs);
            else{
                /*Recorremos el resultado de la consulta y lo almacenamos en el array*/
                while ($reg = mysql_fetch_assoc($rs)) {
                    array_push($registros, $reg);
                }
            }
            /*Liberamos recursos*/
            mysql_free_result($rs);
            mysql_close($cn);
        } catch (exception $e) {
            try {
                mysql_free_result($rs);
            } catch (exception $e) {

            }
            try {
                mysql_close($cn);
            } catch (exception $e) {

            }
        }
        return $registros;
    }
    
     /*Metodo utilizado para obtener todas*/
    function getSlidersTodos() {
       /*Le deciamos que la locacion es lenguaje español*/
        setlocale(LC_CTYPE, 'es');
        /*La sentencia a ejecutar*/
        $sql = "SELECT * FROM sliders WHERE activo='1' ORDER BY orden ASC";
        try {
            /*Creamos un objeto de la clase conexion*/
            $miconexion = new Conexion();
            /*Obtenemos la conexion*/
            $cn = $miconexion->conectar();
            /*Ejecutamos la sentencia*/
            $rs = mysql_query($sql, $cn);
            /*Creamos un array que almacenara los datos de la sentencia*/
            $registros = array();
            /*Recorremos el resultado de la consulta y lo almacenamos en el array*/
            while ($reg = mysql_fetch_assoc($rs)) {
                array_push($registros, $reg);
            }
            /*Liberamos recursos*/
            mysql_free_result($rs);
            mysql_close($cn);
        } catch (exception $e) {
            try {
                mysql_free_result($rs);
            } catch (exception $e) {

            }
            try {
                mysql_close($cn);
            } catch (exception $e) {

            }
        }
        return $registros;
    }
    
    function removeSlider($id){
        $rpta=false;
        /*Creamos un objeto de la clase conexion*/
        $miconexion = new Conexion();
        /*Obtenemos la conexion*/
        $cn = $miconexion->conectar();
        try {
            /*Comenzamos la transaccion*/
            mysql_query("BEGIN", $cn);
            
            /*Elaboramos la sentencia*/
            $sql = "DELETE FROM sliders WHERE id='$id'";
            
            /*Ejecutamos la sentencia*/
            $result = mysql_query($sql, $cn);
            if (!$result) {
                /*Si no obtiene resultados anulamos la transaccion*/
                mysql_query("ROLLBACK", $cn);
                $rpta = false;
            } else {
                /*Si obtiene resultados confirmamos la transaccion*/
                mysql_query("COMMIT", $cn);
                $rpta = true;
            }
            /*Cerramos la conexion*/
            mysql_close($cn);
        } catch (exception $e) {
            try {
                mysql_query("ROLLBACK", $cn);
            } catch (exception $e1) {

            }
            try {
                mysql_close($cn);
            } catch (exception $e1) {

            }
            $rpta = false;
        }
        return $rpta;
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getUrl_imagen() {
        return $this->url_imagen;
    }

    public function setUrl_imagen($url_imagen) {
        $this->url_imagen = $url_imagen;
    }

    public function getUrl_destino() {
        return $this->url_destino;
    }

    public function setUrl_destino($url_destino) {
        $this->url_destino = $url_destino;
    }

    public function getActivo() {
        return $this->activo;
    }

    public function setActivo($activo) {
        $this->activo = $activo;
    }

    public function getOrden() {
        return $this->orden;
    }

    public function setOrden($orden) {
        $this->orden = $orden;
    }

    public function getCreated_at() {
        return $this->created_at;
    }

    public function getUpdated_at() {
        return $this->updated_at;
    }
}

