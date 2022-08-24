<?php
define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');

function incluirTemplate( string $nombre, bool $inicio = false) {
    
    include TEMPLATES_URL . "/${nombre}.php";
}

function estaAutenticado() {
    session_start();
    if(!$_SESSION['login']) {
        header('Location: /');
    };
  
}

function debuguear($variable) {
    echo "<pre>";
        var_dump($variable);
        echo "</pre>";
        exit;
}

//Escapa /sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

//Validar tipo de contenido

function validarTipoContenido($tipo) {
    $tipos = ['vendedor', 'propiedad', 'entradas_blog', 'registro', 'usuario'];

    return in_array($tipo, $tipos);
}

//Muestra los mensajes
function mostrarNotificacion($codigo) {
    $mensaje = '';

    switch($codigo) {
        case 1:
            $mensaje = 'Registro Creado Correctamente!';
            break;
        case 2:
            $mensaje = 'Actualizado Correctamente!';
            break;
        case 3:
            $mensaje = 'Eliminado Correctamente!';
            break;
        default:
            $mensaje = false;
            break;
    }

    return $mensaje;
}

function validarORedireccionar(string $url) {
    //Validar la URL por ID valido
    $id = $_GET['id']; //asigna a una variable el valor que le pasa el navegador con el boton actualizar
    $id = filter_var($id, FILTER_VALIDATE_INT); //valida que el valor sea un entero para que sea un valor valido

    if(!$id) {
        header("Location: ${url}");
    }
    return $id;
}