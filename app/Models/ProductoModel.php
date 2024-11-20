<?php

namespace App\Models;
use CodeIgniter\Model;

    class ProductoModel extends Model
    {
        public function listar_productos(){
            $sql = "
                SELECT  
                    t1.id_producto,
                    t1.nom_producto,
                    t1.descripcion,
                    t1.precio,
                    t1.stock,
                    t1.codigo_barras,
                    t1.fecha_crea,
                    t1.fecha_modifica
                FROM 
                    producto t1";

            $query = $this->db->query($sql);
            $numero_filas = $query->getNumRows();
            if ($numero_filas > 0) {
                $data = $query->getResultArray();
            } else {
                $data = array();
            }
            
            return $data;
        }


        public function cargar_info_producto($IdProducto){
            
            $data = array();
            
            if (trim($IdProducto)<>"")
            {
                $sql = "
                    SELECT  
                        t1.id_producto,
                        t1.nom_producto,
                        t1.descripcion,
                        t1.precio,
                        t1.stock,
                        t1.codigo_barras,
                        t1.fecha_crea,
                        t1.fecha_modifica
                    FROM 
                        t1.id_producto = $idProducto
                ";

                $query = $this->db->query($sql);
                $numero_filas = $query->getNumRows();
                
                if ($numero_filas > 0) {
                    $data = $query->getRowArray();
                } 
            }
            return $data;
        }

        public function insertar_producto($nom_producto,$descripcion,$precio,$stock,$codigo_barras){
            
            $mensaje = "Error al guardar los datos.";
            $resultado = false;

            if (trim($IdProducto)<>"")
            {
                $sql = "
                    INSERT INTO producto(
                        nom_producto,
                        descripcion,
                        precio,
                        stock,
                        codigo_barras)
                    VALUES ( 
                        '$nom_producto',
                        '$descripcion',
                        $precio,
                        $stock,
                        '$codigo_barras');
                        
                ";

                $this->db->transBegin();
                $this->db->query($sql);
                
                if ($this->db->transStatus()==FALSE) {
                    $this->db->transRollback();
                } else{
                    $this->db->transCommit();
                    $mensaje = "se guardo el producto.";
                    $resultado=true;
                }
            }
            $result["msg"]=$mensaje;
            $result["result"]=$resultado;
            return $result;
        }


        public function modificar_producto($IDProducto,$nom_producto,$descripcion,$precio,$stock,$codigo_barras){
            
            $mensaje = "Error al actualizar los datos.";
            $resultado = false;
            
            if (trim($IdProducto)<>"")
            {
                $sql = "
                    UPDATE producto SET 
                        nom_producto = '$nom_producto',
                        descripcion = '$descripcion',
                        precio = $precio,,
                        stock = $stock,
                        codigo_barras = '$codigo_barras')
                    WHERE 
                        id_producto = '$IdProducto'
                        
                ";

                $this->db->transBegin();
                $this->db->query($sql);
                
                if ($this->db->transStatus()==FALSE) {
                    $this->db->transRollback();
                } else{
                    $this->db->transCommit();
                    $mensaje = "se modifico el producto.";
                    $resultado=true;
                }
            }
            $result["msg"]=$mensaje;
            $result["result"]=$resultado;
            return $result;
        }

        public function eliminar_producto($IDProducto){
            
            $mensaje = "Error al eliminar los datos.";
            $resultado = false;
            
            if (trim($IdProducto)<>"")
            {
                $sql = "
                    DELETE FROM producto
                    WHERE 
                        id_producto = '$IdProducto'
                        
                ";

                $this->db->transBegin();
                $this->db->query($sql);
                
                if ($this->db->transStatus()==FALSE) {
                    $this->db->transRollback();
                } else{
                    $this->db->transCommit();
                    $mensaje = "se elimino el producto.";
                    $resultado=true;
                }
            }
            $result["msg"]=$mensaje;
            $result["result"]=$resultado;
            return $result;
        }
    }


?>