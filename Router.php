<?php

namespace MVC;

class Router {
    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn) {
        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn) {
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas()
    {
        session_start();
        $auth = $_SESSION['login'] ?? null;
        
        //Arreglo de rutas protegidas..
        $rutas_protegidas = ['/admin','/propiedades/crear', '/vendedores/crear', '/entradas_blog/crear', '/propiedades/actualizar', '/vendedores/actualizar', '/entradas_blog/actualizar', '/propiedades/eliminar', '/vendedores/eliminar', '/entradas_blog/eliminar', 'registro/crear',  'registro/actualizar',  'registro/eliminar', 'usuario/crear',  'usuario/actualizar',  'usuario/eliminar'];

        // $urlActual = $_SERVER['REQUEST_URI'] === '' ?? '/' : $_SERVER['REQUEST_URI'];
        if(isset($_SERVER['PATH_INFO'])) {
            $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        } else {
            $urlActual = $_SERVER['REQUEST_URI'] === '' ? '/' : $_SERVER['REQUEST_URI'];
        }
        $metodo = $_SERVER['REQUEST_METHOD'];
        
        if($metodo === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? null;
        } else {
            
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }
        //Proteger las rutas
        if(in_array($urlActual, $rutas_protegidas) && !$auth) {
            header('Location: /');
        }

        if($fn) {
            //La URL existe y hay una función asociada

            call_user_func($fn, $this);//Con esta función manda a llamar una función de la cual no se sabe el nombre pues es dinámica dependiendo de la página que el usuario visite
        } else {
            echo "Página No Encontrada";
        }
    }

    //Muestra una vista

    public function render($view, $datos = []) {
        
        foreach($datos as $key => $value) {
            $$key = $value;
        }

        ob_start();//Almacenamiento en memoria durante un momento...
        include __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean();//Limpia el buffer

        include __DIR__ . "/views/layout.php";
    }
}