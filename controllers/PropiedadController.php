<?php
namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\vendedor;
use Model\Blog;
use Intervention\Image\ImageManagerStatic as Image;
use Model\Admin;
use Model\Registros;


class PropiedadController {
    public static function index(Router $router) {//Con esta línea mantenemos la referencia desde el router
        
        $propiedades = Propiedad::all();
        $usuario = Admin::all();
        $vendedores = Vendedor::all();
        $entradas = Blog::all();
        $registros = Registros::all();

        //Muestra mensaje condicional
        $resultado = $_GET['resultado'] ?? null;
        
        $router->render('propiedades/admin', [
            'propiedades' =>  $propiedades,
            'resultado' => $resultado,
            'vendedores' => $vendedores,
            'entradas' => $entradas,
            'registros' => $registros,
            'usuario' => $usuario
        ]);
    }

    public static function crear(Router $router) {
         $propiedad = new Propiedad;
         $vendedores = Vendedor::all();
         $usuario = Admin::all();
         //Arreglo con mensajes de errores
        $errores = propiedad::getErrores();

         
                //Ejecutar el código después de que el usuario envia el formulario
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
                
                //Crea una nueva instancia
            $propiedad = new Propiedad($_POST['propiedad']);


            /** SUBIDA DE ARCHIVOS**/
            //Generar un nombre unico
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";
            
            //setear la imagen
            //Realiza un resize a la imagen con Intervention
            if($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                $propiedad->setImagen($nombreImagen);
            }

            //validar
            $errores = $propiedad->validar();
            
            if(empty($errores)) {

            //Crear carpeta si no existe
                if(!is_dir( CARPETA_IMAGENES )) { //is_dir es una funcion que dice si el directorio entre parentesis existe
                    mkdir(CARPETA_IMAGENES); //Si no existe el directorio lo crea con esta 
                }
                //guarda la Imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);
                
                //Guardar en la base de datos
                $propiedad->guardar();
            }
        }

         $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores,
            'usuario' => $usuario
         ]);
    }

    public static function actualizar(Router $router) {
       $id = validarORedireccionar('/admin');
       
       $propiedad = Propiedad::find($id);

       $vendedores = Vendedor::all();
       $usuario = Admin::all();

       $errores = Propiedad::getErrores();

       //Ejecutar el código después de que el usuario envia el formulario, metodo POST
       if($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        //Asignar los atributos
        $args = $_POST['propiedad'];
     
        $propiedad->sincronizar($args);

        //Validacion
        $errores = $propiedad->validar();

        //Subida de archivos 
        $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";
    
        //setear la imagen
        //Realiza un resize a la imagen con Intervention
        if($_FILES['propiedad']['tmp_name']['imagen']) {
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
            $propiedad->setImagen($nombreImagen);
        }
       
        //Revisar que el array de errores este vacio, en caso que así sea, se insertan los datos en la base de datos
        if(empty($errores)) {
            if($_FILES['propiedad']['tmp_name']['imagen']) {
            //Almacenar la imagen
            $image->save(CARPETA_IMAGENES . $nombreImagen);            
            }
            
            $propiedad->guardar();
        }
    }

       $router->render('/propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores,
            'usuario' => $usuario
       ]);
    }

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Validar id
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
    
            if($id) {
    
                $tipo = $_POST['tipo'];
    
               if(validarTipoContenido($tipo)) {
                
                $propiedad = Propiedad::find($id);
                $propiedad->eliminar();
               }
            }
        }        
    }

}