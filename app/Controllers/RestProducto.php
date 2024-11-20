<?php
namespace App\controllers;
use CodeIgniter\RESTful\ResourceController;

class RestProducto extends ResourceController
{
    protected $modelName = "App\Models\ProductoModel";
    protected $format = "json";
    
    public function listar_productos(){
        
        return $this->respond($this->model->listar_productos());
    }
}
?>