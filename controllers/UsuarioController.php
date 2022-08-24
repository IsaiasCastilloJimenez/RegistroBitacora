<?php

namespace Controllers;

use Model\Admin;
use MVC\Router;


class UsuarioController {
    public static function index(Router $router) {

        $usuario = Admin::all();
        $resultado = $_GET['resultado'] ?? null;
        
        $router->render('propiedades/admin', [
            'usuario' => $usuario,
            'resultado' => $resultado
        ]);
    }

    public static function crear(Router $router) {
         //Arreglo con mensajes de errores
        $errores = Admin::getErrores();
        $usuario = new Admin;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Crea una nueva instancia
            $usuario = new Admin($_POST['usuario']);
            
            $usuario->password =password_hash($usuario->password, PASSWORD_BCRYPT);
          
            
            //validar
            $errores = $usuario->validar();
            if(empty($errores)) {
                //Guardar en la base de datos
                $usuario->guardar();
            }

        }
        $router->render('usuario/crear',[
            'errores' => $errores,
            'usuario' => $usuario
            
        ]);
    }

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            //validar id
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id) {
                $tipo = $_POST['tipo'];
                if(validarTipoContenido($tipo)) {
                    $usuario = Admin::find($id);
                    $usuario->eliminar();
                }
            }
        }
    }

}