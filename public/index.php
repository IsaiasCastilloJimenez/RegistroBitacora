<?php

require_once __DIR__ . '/../includes/app.php';

use Controllers\BlogController;
use Controllers\LoginController;
use MVC\Router;
use Controllers\PropiedadController;
use Controllers\VendedorController;
use Controllers\PaginasController;
use Controllers\RegistroController;
use Controllers\UsuarioController;

// use Model\Blog;
$router = new Router();
//Zona privada
$router->get('/admin', [PropiedadController::class, 'index']);
$router->get('/propiedades/crear', [PropiedadController::class, 'crear']);
$router->post('/propiedades/crear', [PropiedadController::class, 'crear']);
$router->get('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
$router->post('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
$router->post('/propiedades/eliminar', [PropiedadController::class, 'eliminar']);

 $router->get('/vendedores/crear', [VendedorController::class, 'crear']);
 $router->post('/vendedores/crear', [VendedorController::class, 'crear']);
 $router->get('/vendedores/actualizar', [VendedorController::class, 'actualizar']);
 $router->post('/vendedores/actualizar', [VendedorController::class, 'actualizar']);
 $router->post('/vendedores/eliminar', [VendedorController::class, 'eliminar']);

 $router->get('/entradas_blog/crear', [BlogController::class, 'crear']);
 $router->post('/entradas_blog/crear', [BlogController::class, 'crear']);
 $router->get('/entradas_blog/actualizar', [BlogController::class, 'actualizar']);
 $router->post('/entradas_blog/actualizar', [BlogController::class, 'actualizar']);
 $router->post('/entradas_blog/eliminar', [BlogController::class, 'eliminar']);

 $router->get('/registro/crear', [RegistroController::class, 'crear']);
 $router->post('/registro/crear', [RegistroController::class, 'crear']);
 $router->get('/registro/actualizar', [RegistroController::class, 'actualizar']);
 $router->post('/registro/actualizar', [RegistroController::class, 'actualizar']);
 $router->post('/registro/eliminar', [RegistroController::class, 'eliminar']);

$router->get('/usuario/crear', [UsuarioController::class, 'crear']);
$router->post('/usuario/crear', [UsuarioController::class, 'crear']);
$router->post('/usuario/eliminar', [UsuarioController::class, 'eliminar']);

//Zona pública
$router->get('/', [PaginasController::class, 'index']);
$router->get('/exitoregistro',[PaginasController::class, 'exitoregistro']);
$router->get('/nosotros', [PaginasController::class, 'nosotros']);
$router->get('/propiedades', [PaginasController::class, 'propiedades']);
$router->get('/propiedad', [PaginasController::class, 'propiedad']);
$router->get('/blog', [PaginasController::class, 'blog']);
$router->get('/entrada', [PaginasController::class, 'entrada']);
$router->get('/contacto', [PaginasController::class, 'contacto']);
$router->post('/contacto', [PaginasController::class, 'contacto']);

//Login y autenticación

$router->get('/login', [LoginController::class, 'login']);//Se requiere para cargar el formulario
$router->post('/login', [LoginController::class, 'login']); //Se requiere para enviar los datos del formulario
$router->get('/logout', [LoginController::class, 'logout']); //Se requiere para cerrar la sesion

$router->comprobarRutas();

