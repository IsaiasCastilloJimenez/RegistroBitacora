<?php

namespace Model;

class Admin extends ActiveRecord {
    //BAse de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'email', 'password', 'nombre', 'paterno', 'materno', 'empleado', 'rfc', 'admin'];

    public $id;
    public $email;
    public $password;
    public $nombre;
    public $paterno;
    public $materno;
    public $empleado;
    public $rfc;
    public $admin;
    public $user;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->paterno = $args['paterno'] ?? '';
        $this->materno = $args['materno'] ?? '';
        $this->empleado = $args['empleado'] ?? '';
        $this->rfc = $args['rfc'] ?? '';
        $this->admin = $args['admin'] ?? '';

    }

    public function validar() {
        if(!$this->empleado) {
            self::$errores[] = 'El Número de empleado es obligatorio';
        }
        if(!$this->rfc) {
            self::$errores[] = 'El RFC es obligatorio';
        }
        return self::$errores;
    }

    public function existeusuario() {
        $query = "SELECT * FROM " . self::$tabla . " WHERE empleado ='" . $this->empleado . "' LIMIT 1";
        
        $resultado = self::$db->query($query);
        if(!$resultado->num_rows){
            self::$errores[] = 'El usuario no existe';
            return;
        }
        return $resultado; 
    }

    public function comprobarPassword($resultado) {
        $usuario = $resultado->fetch_object();
        
        $autenticado = $this->rfc === $usuario->rfc;
        if(!$autenticado) {
            self::$errores[] = 'El RFC es incorrecto';
        }
        
        return $autenticado;
    }

    public function autenticar() {
       
        session_start();
        
                //Llenar el arreglo de session
        $_SESSION['usuario'] = $this->empleado;
        $_SESSION['rfc'] = $this->rfc;
        $_SESSION['login'] = true;
        //Buscamos los datos del usuario
        $query = "SELECT * FROM " . Admin::$tabla . " WHERE empleado = $this->empleado";
        
        $resultado_user = Admin::consultarSQL($query);
        
        $_SESSION['user'] = $resultado_user[0]->nombre . " " . $resultado_user[0]->paterno . " " . $resultado_user[0]->materno;
     
        if($this->empleado == '819545') {
            header('Location: /admin');
        } else {
            header('Location: /registro/crear');
        }
        
    }

}