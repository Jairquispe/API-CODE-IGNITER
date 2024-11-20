<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class RestProducto extends ResourceController
{
    protected $modelName = "App\Models\ProductoModel";
    protected $format = "json";

    /**
     * Listar todos los productos
     */
    public function listar_productos()
    {
        $productos = $this->model->listar_productos();
        return $this->respond($productos);
    }

    /**
     * Cargar información de un producto por ID
     * 
     * @param int $idProducto
     */
    public function cargar_info_producto($idProducto = null)
    {
        if ($idProducto === null) {
            return $this->failValidationError("El ID del producto es obligatorio.");
        }

        $producto = $this->model->cargar_info_producto($idProducto);
        if (empty($producto)) {
            return $this->failNotFound("Producto no encontrado.");
        }

        return $this->respond($producto);
    }

    /**
     * Insertar un nuevo producto
     */
    public function insertar_producto()
    {
        // Obtener los datos como JSON
        $data = $this->request->getJSON(true); // Usamos true para convertirlo a un array asociativo
    
        // Depura los datos recibidos
        log_message('debug', 'Datos recibidos: ' . print_r($data, true));
    
        // Validar si los campos obligatorios están presentes
        if (!isset($data['nom_producto'], $data['descripcion'], $data['precio'], $data['stock'], $data['codigo_barras'])) {
            return $this->failValidationError("Todos los campos son obligatorios.");
        }
    
        // Llamar al modelo para insertar el producto
        $resultado = $this->model->insertar_producto(
            $data['nom_producto'],
            $data['descripcion'],
            $data['precio'],
            $data['stock'],
            $data['codigo_barras']
        );
    
        if ($resultado['result']) {
            return $this->respondCreated($resultado['msg']);
        } else {
            return $this->fail($resultado['msg']);
        }
    }

    /**
     * Modificar un producto existente
     * 
     * @param int $idProducto
     */
    public function modificar_producto($idProducto = null)
    {
        // Obtener los datos como JSON
        $data = $this->request->getJSON(true); // Usamos true para convertirlo a un array asociativo

        // Validar si el ID y los campos obligatorios están presentes
        if ($idProducto === null || !isset($data['nom_producto'], $data['descripcion'], $data['precio'], $data['stock'], $data['codigo_barras'])) {
            return $this->failValidationError("Todos los campos y el ID del producto son obligatorios.");
        }

        // Llamar al modelo para modificar el producto
        $resultado = $this->model->modificar_producto(
            $idProducto,
            $data['nom_producto'],
            $data['descripcion'],
            $data['precio'],
            $data['stock'],
            $data['codigo_barras']
        );

        if ($resultado['result']) {
            return $this->respondUpdated($resultado['msg']);
        } else {
            return $this->fail($resultado['msg']);
        }
    }

    /**
     * Eliminar un producto
     * 
     * @param int $idProducto
     */
    public function eliminar_producto($idProducto = null)
    {
        // Validar si el ID del producto está presente
        if ($idProducto === null) {
            return $this->failValidationError("El ID del producto es obligatorio.");
        }

        // Llamar al modelo para eliminar el producto
        $resultado = $this->model->eliminar_producto($idProducto);

        if ($resultado['result']) {
            return $this->respondDeleted($resultado['msg']);
        } else {
            return $this->fail($resultado['msg']);
        }
    }
}
?>
