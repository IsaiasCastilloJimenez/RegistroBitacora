<?php

namespace Model;

class ActiveRecord {

//Base de Datos
    protected static $db;
    protected static $columnasDB = [];
    protected static $columnasDB2 = [];
    protected static $columnasDB3 = [];
    protected static $tabla = '';
    protected static $tabla2 = '';
    protected static $tabla3 = '';


//Validación de errores
    protected static $errores = [];


     //Definir la conexion a la BD
    public static function setDB($database) {
        self::$db = $database;
    }

    

    public function guardar() {
        if(!is_null($this->id)){
            //Actualizar
            $this->actualizar();
        } else {
            //Crear un nuevo registro
            $this->crear();
        }
    }

    public function crear(){
        $time = time();
        $time = $time - 18000; //Se ajusta la hora a la ciudad de México GMT-5
       //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
        
        //Insertar en la base de datos, tabla datos
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES ('";
        $query .= join("', '", array_values($atributos));
        $query .= "') ";
        
        $resultado = self::$db->query($query);

//Preparar datos para la base de datos, tabla registro
        $this->empleado = $_SESSION['usuario'];
        $empleado_busqueda = $_SESSION['usuario'];
        $this->fecha = date('Y/m/d');
        $this->hora = date("H:i:s", $time);
        
        //Buscamos el id del usuario
        $query = "SELECT * FROM " . Admin::$tabla . " WHERE empleado = ${empleado_busqueda}";
        $resultado = Admin::consultarSQL($query);
        $this->usuarioId = $resultado[0]->id;
              
        //Insertar en la base de datos en la tabla registro
        $query = " INSERT INTO " . static::$tabla2 . " ( ";
        $query .= " fecha, hora, usuarioId ";
        $query .= " ) VALUES ('$this->fecha' , '$this->hora', '$this->usuarioId' ) ";
         
        $resultado = self::$db->query($query);
        
         //Buscamos los ultimos datos insertados en la base de datos para insertarlos en la tabla registrodatos
        $querybuscadatos = "SELECT * FROM "  . Registros::$tabla .  " WHERE id in (SELECT MAX(id) FROM "  . Registros::$tabla .  ") LIMIT 1";
        $resultadobuscadatos = Registros::consultarSQL($querybuscadatos);
        $this->datosId = $resultadobuscadatos[0]->id;
        //Busca ultimo dato en tabla registro
        $querybuscaregistro = "SELECT * FROM "  . Registros::$tabla2 .  " WHERE id in (SELECT MAX(id) FROM "  . Registros::$tabla2 .  ") LIMIT 1";
        $resultadobuscaregistro = Registros::consultarSQL($querybuscaregistro);
        $this->registroId = $resultadobuscaregistro[0]->id;
        //Inserta en la base de datos, en la tabla registrodatos
        
        $query = " INSERT INTO " . static::$tabla3 . " ( registroId, datosId ) VALUES ('$this->registroId', '$this->datosId') ";
        
        $resultado = self::$db->query($query);

        
        //Mensaje de éxito
        if($resultado) {
            //Redireccionar al usuario.
            session_start();
            $_SESSION = [];
            header('Location: /exitoregistro?resultado=1');
            
        }
    }

    public function actualizar() {
       //Sanitizar los datos
       $atributos = $this->sanitizarAtributos();
       $valores = [];
       foreach($atributos as $key => $value) {
        $valores[] = "{$key}='{$value}'";
       }
       $query = "UPDATE " . static::$tabla . " SET ";
       $query .= join(', ', $valores );
       $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
       $query .= " LIMIT 1 ";
       
       $resultado = self::$db->query($query);
       if($resultado) {
        //Redireccionar al usuario.
        header('Location: /admin?resultado=2');
    }
    }

    //Eliminar un registro
    public function eliminar(){
        //Eliminar la propiedad
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id . " LIMIT 1 ");//escape_string() sirve para sanitizar el código y evitar la inyección de código malicioso, poner limit 1 al eliminar, asegura que sólo se borrará un registro.
        
        $resultado = self::$db->query($query);
        
        if($resultado) {
            $this->borrarImagen();
            header('location: /admin?resultado=3');
        }
    }

    //Identificar y unir los atributos de la BD
    public function atributos(){
        $atributos = [];
        
        foreach(static::$columnasDB as $columna) {
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
            
        }
        
        return $atributos;
        
    }


   public function sanitizarAtributos() {
        $atributos = $this->atributos();
       $sanitizado = [];
       
       foreach($atributos as $key => $value ){
            $sanitizado[$key] = self::$db->escape_string($value);
       }
       return $sanitizado;
   }

    //Subida de archivos
    public function setImagen($imagen) {
        //Elimina la imagen previa
        if(!is_null($this->id)) {
            $this->borrarImagen();
        }
        
        //Asignar al atributo de imagen el nombre de la imagen
        if($imagen) {
            $this->imagen = $imagen;
        }
    }

    //Eliminar el archivo
    public function borrarImagen() {
        //Comprobar si existe el archivo
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

   //Validación
   public static function getErrores() {
    return static::$errores;
   }

   public function validar(){
    static::$errores = [];
    return static::$errores;
   }

   //Lista todos los registros
   public static function all() {
    $query = "SELECT * FROM " . static::$tabla;

    $resultado = self::consultarSQL($query);
    return $resultado;
   }

   //Obtiene determinado número de registros
   public static function get($cantidad) {
    $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;
   

    $resultado = self::consultarSQL($query);
    return $resultado;
   }



   //Busca un registro por su id
   public static function find($id){
    $query = "SELECT * FROM " . static::$tabla . " WHERE id = ${id}";
    $resultado = self::consultarSQL($query);
    return array_shift($resultado);
   }

   public static function consultarSQL($query) {
        //Consultar la base de datos
    $resultado = self::$db->query($query);
        //Iterar los resultados
    $array =[];
    while($registro = $resultado->fetch_assoc()) {
        $array[] = static::crearObjeto($registro);
    }
   
        //Liberar la memoria
    $resultado->free();

        //retornar los resultados
        return $array;
   }

   protected static function crearObjeto($registro) {
    $objeto = new static;

    foreach($registro as $key => $value) {
        if(property_exists( $objeto, $key )) {
            $objeto->$key = $value;
        }
    }
    return $objeto;
   }
   
   //Sincroniza el objeto en memoria con los cambios realizados por el usuario
   public function sincronizar( $args = [] ) {
    foreach($args as $key => $value) {
        if(property_exists($this, $key) && !is_null($value)) {
            $this->$key = $value;
        }
    }
   }
}