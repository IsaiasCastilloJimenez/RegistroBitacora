<?php

namespace Model;

class Registros extends ActiveRecord {
    protected static $tabla = 'datos';
    protected static $tabla2 = 'registro';
    protected static $tabla3 = 'registrodatos';

    protected static $columnasDB = ['id', 'laboratorio', 'idioma', 'grupo', 'alumnos', 'incidente', 'mensaje', 'atendido', 'fecha_atencion', 'hora_atencion'];
    protected static $columnasDB2 = ['id', 'fecha', 'hora', 'usuarioId'];
    protected static $columnasDB3 = ['id', 'registroId', 'datosId'];
    public $id;
    public $laboratorio;
    public $idioma;
    public $grupo;
    public $alumnos;
    public $incidente;
    public $mensaje;
    public $atendido;
    public $fecha_atencion;
    public $hora_atencion;
    public $fecha;
    public $hora;
    public $usuarioId;
    public $registroId;
    public $datosId;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? NULL;
        $this->laboratorio = $args['laboratorio'] ?? '';
        $this->idioma = $args['idioma'] ?? '';
        $this->grupo = $args['grupo'] ?? 0;
        $this->alumnos = $args['alumnos'] ?? 0;
        $this->incidente = $args['incidente'] ?? '';
        $this->mensaje = $args['mensaje'] ?? '';
        $this->atendido = $args['atendido'] ?? 0;
        $this->fecha_atencion = $args['fecha_atencion'] ?? '0000-00-00';
        $this->hora_atencion = $args['hora_atencion'] ?? '00:00:00';
        $this->fecha = $args['fecha'] ?? '0000-00-00';
        $this->hora = $args['hora'] ?? '00:00:00';
        $this->usuarioId = $args['usuarioId'] ?? NULL;
        $this->registroId = $args['registroId'] ?? NULL;
        $this->datosId = $args['datosId'] ?? NULL;
    }

    public function validar(){
        if(!$this->laboratorio) {
            self::$errores[] = "Debes elegir un laboratorio";
        }
    
        if(!$this->idioma) {
            self::$errores[] = "Debes elegir un idioma";
        }
        if(!$this->grupo) {
            self::$errores[] = "Debes ingresar un grupo";
        }

        if(!$this->alumnos) {
            self::$errores[] = "Debes ingresar el número de alumnos atendidos";
        }

        if($this->incidente === '' ) {
            self::$errores[] = "Debes mencionar si tuviste incidentes o no";
        }

        // if(strlen( $this->mensaje ) < 20 ) {
        //     self::$errores[] = "El contenido es obligatorio y debe tener al menos 20 caracteres";
        // }
                
        return self::$errores;
    }
}

