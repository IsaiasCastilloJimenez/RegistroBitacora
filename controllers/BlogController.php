<?php
namespace Controllers;

use MVC\Router;
use Model\Blog;

class BlogController {
    public static function index(Router $router) {//Con esta línea mantenemos la referencia desde el router
        
        $entradas = Blog::all();

        //Muestra mensaje condicional
        $resultado = $_GET['resultado'] ?? null;
        
        $router->render('propiedades/admin', [
            'entradas' => $entradas,
            'resultado' => $resultado            
        ]);
    }

    public static function crear(Router $router) {
        //Arreglo con mensajes de errores
        
        $errores = Blog::getErrores();
        $entradas = new Blog;
        

    //Ejecutar el código después de que el usuario envia el formulario
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
               
    //            //Crea una nueva instancia
            $entradas = new Blog($_POST['entradas']);
            debuguear($entradas);

            //validar
            $errores = $entradas->validar();
           
            if(empty($errores)) {
                //Guardar en la base de datos
                $entradas->guardar();
            }
        }
       
        $router->render('entradas_blog/crear',[
            'errores' => $errores,
            'entradas' => $entradas
        ]);
   }

   public static function actualizar(Router $router) {
        
        $id = validarORedireccionar('/admin');
      
        $entradas = Blog::find($id);

//       $vendedores = Vendedor::all();

        $errores = Blog::getErrores();

    //Ejecutar el código después de que el usuario envia el formulario, metodo POST
       if($_SERVER['REQUEST_METHOD'] === 'POST') {
       
    //Asignar los atributos
    $args = $_POST['entradas'];
        $entradas->sincronizar($args);

    //Validacion
     $errores = $entradas->validar();

//Revisar que el array de errores este vacio, en caso que así sea, se insertan los datos en la base de datos
        if(empty($errores)) {
          
            $entradas->guardar();
        }
    }

       $router->render('/entradas_blog/actualizar', [
            'entradas' => $entradas,
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
                    $entradas = Blog::find($id);
                    
                    $entradas->eliminar();
               }
            }
        }        
   }
}