<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Rutas para el controlador RestProducto
$routes->get('/producto/listar', 'RestProducto::listar_productos');
$routes->get('/producto/(:num)', 'RestProducto::cargar_info_producto/$1'); // Obtener un producto por ID
$routes->post('/producto/insertar', 'RestProducto::insertar_producto'); // Insertar producto
$routes->post('/producto/modificar/(:num)', 'RestProducto::modificar_producto/$1'); // Modificar producto
$routes->delete('/producto/eliminar/(:num)', 'RestProducto::eliminar_producto/$1'); // Eliminar producto

?>
