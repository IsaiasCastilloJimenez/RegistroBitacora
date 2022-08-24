<?php

namespace Controllers;

use MVC\Router;
use Model\Admin;

class LoginController {

    public static function login(Router $router) {

        $errores = [];
        $usuario = Admin::all();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
           $auth = new Admin($_POST);

           $errores = $auth->validar();
           if(empty($errores)) {
                //Verificar si el usuario existe
                $resultado = $auth->existeusuario();
            
                if(!$resultado) {
                    //verificar si el usuario existe o no (mensaje de error)
                    $errores = Admin::getErrores();
                } else {
                //Verificar el password
                    
                    $autenticado = $auth->comprobarPassword($resultado);
                      
                    if($autenticado) {
                    //Autenticar el usuario
                        
                        $auth->autenticar();
                        
                    } else {
                        //Password incorrecto (mensaje de error)
                        $errores = Admin::getErrores();
                    }
                    
                }
            
            }
        }

        $router->render('auth/login',[
            'errores' => $errores,
            'usuario' => $usuario
        ]);
    }

    public static function logout() {
       session_start();
       $_SESSION = [];
       header('Location: /');
    }

}

