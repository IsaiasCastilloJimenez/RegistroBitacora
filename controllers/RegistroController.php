<?php
namespace Controllers;

use MVC\Router;

use Model\Registros;

class RegistroController {
    public static function index(Router $router) {//Con esta línea mantenemos la referencia desde el router
        
        $registro = Registros::all();
     
        //Muestra mensaje condicional
        $resultado = $_GET['resultado'] ?? null;
        
        $router->render('propiedades/admin', [
            'registro' => $registro,
            'resultado' => $resultado
        ]);
    }

    public static function crear(Router $router) {
        $resultado = $_GET['resultado'] ?? null;
       
        //Arreglo con mensajes de errores
        $errores = Registros::getErrores();
        $registro = new Registros;
        
    //Ejecutar el código después de que el usuario envia el formulario
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
           
            //Crea una nueva instancia
            $registro = new Registros($_POST['registro']);
           
            //validar
            $errores = $registro->validar();
           
            if(empty($errores)) {
                //Guardar en la base de datos
                $registro->guardar();
            }
        }
       
        $router->render('registros/crear',[
            'errores' => $errores,
            'registro' => $registro,
            'resultado' => $resultado
        ]);
   }

    public static function actualizar(Router $router) {
            
    $id = validarORedireccionar('/admin');
    $registro = Registros::find($id);
    $errores = Registros::getErrores();
    
    //Ejecutar el código después de que el usuario envia el formulario, metodo POST
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    //Asignar los atributos
    $args = $_POST['registro'];
        $registro->sincronizar($args);

    //Validacion
    $errores = $registro->validar();
    
    //Revisar que el array de errores este vacio, en caso que así sea, se insertan los datos en la base de datos
        if(empty($errores)) {
           
            $registro->guardar();
        }
    }

    $router->render('registros/actualizar', [
            'registro' => $registro,
            'errores' => $errores
    
        ]);
    }

    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
        //Validar id
            $id = $_POST['id'];
            
            $id = filter_var($id, FILTER_VALIDATE_INT);
            
            if($id) {
            $tipo = $_POST['tipo'];
            
                if(validarTipoContenido($tipo)) {
                    $registro = Registros::find($id);
                    
                    $registro->eliminar();
                }
            }
        }        
    }
}