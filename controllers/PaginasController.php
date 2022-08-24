<?php

namespace Controllers;

use Model\Blog;
use MVC\Router;
use Model\Propiedad;
use Model\Registros;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController {
    public static function index(Router $router) {
        $propiedades = Propiedad::get(3);
        $inicio = true;
        $resultado = $_GET['resultado'] ?? null;

        $router->render('paginas/index',[
            'propiedades' => $propiedades,
            'inicio' =>$inicio,
            'resultado' => $resultado
        ]);
    }
    public static function nosotros(Router $router) {

        $router->render('paginas/nosotros',[]);
    }
    public static function propiedades(Router $router) {
        $propiedades = Propiedad::all();
        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }
    public static function propiedad(Router $router) {
        $id = validarORedireccionar('/propiedades');
        //Buscar la propiedad por su id
        $propiedad = Propiedad::find($id);
        $router->render('paginas/propiedad',[
            'propiedad' => $propiedad
        ]);
    }
    public static function blog(Router $router) {
        $entradas = Blog::all();
        
        $router->render('paginas/blog',[
            'entradas' => $entradas
        ]);
    }
    public static function entrada(Router $router) {
        $id = validarORedireccionar('/blog');
        //Buscar la entrada por su id
        $entradas = Blog::find($id);

        $router->render('paginas/entrada',[
            'entradas' => $entradas
        ]);
    }
    public static function contacto(Router $router) {
        
        $mensaje = null;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $respuestas = $_POST['contacto'];

                    
           //Crear una instancia de PHPMailer
           $mail = new PHPMailer();
           //Configurar SMTP, protocolo que se utiliza para enviar los email
           $mail->isSMTP();
           $mail->Host = 'smtp.mailtrap.io';
           $mail->SMTPAuth = true;
           $mail->Username = 'ae9f6f2dd0d2f8';
           $mail->Password = 'c964892a4e59f4';
           $mail->SMTPSecure = 'tls';
           $mail->Port = 2525;

           //Configurar el contenido del email
           $mail->setFrom('admin@bienesraices.com');
           $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
           $mail->Subject = 'Tienes un nuevo mensaje';

           //Habilitar el HTML

           $mail->isHTML(true);
           $mail->Charset = 'UTF-8';

           //Definir el contenido

           $contenido  = '<html>';
           $contenido .= '<p>Tienes un nuevo mensaje</p>';
           $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . '</p>';
           
           //Enviar de forma condicional algunos campos de emal o telefono
           if($respuestas['contacto'] === 'telefono') {
                $contenido .= '<p>Eligió ser contactado por Teléfono: </p>';
                $contenido .= '<p>Teléfono: ' . $respuestas['telefono'] . '</p>';
                $contenido .= '<p>El día: ' . $respuestas['fecha'] . '</p>';
                $contenido .= '<p>Cercano a las: ' . $respuestas['hora'] . '</p>';
           } else {
            // Es email, entonces agregamos el campo de email
                $contenido .= '<p>Eligió ser contactado por email: </p>';
                $contenido .= '<p>Email: ' . $respuestas['email'] . '</p>';
           }
           
           $contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] . '</p>';
           $contenido .= '<p>Compra o Vende: ' . $respuestas['tipo'] . '</p>';
           $contenido .= '<p>Precio o Presupuesto: $' . $respuestas['precio'] . '</p>';
           $contenido .= '<p>Prefiere ser contactado por: ' . $respuestas['contacto'] . '</p>';

           $contenido .= '</html>';
            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alternativo sin HTML';
            //Enviar el email

            if($mail->send()) {
                $mensaje = "Mensaje enviado correctamente";
            } else {
                $mensaje = "El mensaje no se pudo enviar...";
            }
        }

        $router->render('paginas/contacto', [
                'mensaje' => $mensaje
        ]);       
    }

    public static function exitoregistro(Router $router) {
        $resultado = $_GET['resultado'] ?? null;
        
        $errores = Registros::getErrores();
        
        $router->render('paginas/exitoregistro',[
            'errores' => $errores,
            'resultado' => $resultado
        ]);
    }
   
}