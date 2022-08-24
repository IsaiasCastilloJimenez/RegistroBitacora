<?php
namespace Model;

class Blog extends ActiveRecord {

    protected static $tabla = 'entradasblog';
    protected static $columnasDB = ['id', 'titulo', 'autor', 'fecha_publicacion', 'contenido'];

    public $id;
    public $titulo;
    public $autor;
    public $fecha_publicacion;
    public $contenido;
    // public $imagen;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? NULL;
        $this->titulo = $args['titulo'] ?? '';
        $this->autor = $args['autor'] ?? '';
        $this->fecha_publicacion = date('Y/m/d');
        $this->contenido = $args['contenido'] ?? '';
        // $this->imagen = $args['imagen'] ?? '';
    }

    public function validar(){
        if(!$this->titulo) {
            self::$errores[] = "Debes añadir un título";
        }
    
        if(!$this->autor) {
            self::$errores[] = "Debes añadir un autor";
        }
    
        if(strlen( $this->contenido ) < 50 ) {
            self::$errores[] = "El contenido es obligatorio y debe tener al menos 50 caracteres";
        }
        
        // if(!$this->imagen) {
        //     self::$errores[] = "La imagen de la entrada de Blog es obligatoria";
        // }
        
        return self::$errores;
    }
}