<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductoModel extends Model
{
    public function listar_productos()
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
                producto t1";

        $query = $this->db->query($sql);
        $numero_filas = $query->getNumRows();
        $data = $numero_filas > 0 ? $query->getResultArray() : [];

        return $data;
    }

    public function cargar_info_producto($IdProducto)
    {
        $data = [];

        if (trim($IdProducto) !== "") {
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
                    producto t1
                WHERE 
                    t1.id_producto = $IdProducto
            ";

            $query = $this->db->query($sql);
            $data = $query->getNumRows() > 0 ? $query->getRowArray() : [];
        }
        return $data;
    }

    public function insertar_producto($nom_producto, $descripcion, $precio, $stock, $codigo_barras)
    {
        $mensaje = "Error al guardar los datos.";
        $resultado = false;

        if (!empty($nom_producto)) {
            $sql = "
                INSERT INTO producto(
                    nom_producto,
                    descripcion,
                    precio,
                    stock,
                    codigo_barras
                ) VALUES (
                    '$nom_producto',
                    '$descripcion',
                    $precio,
                    $stock,
                    '$codigo_barras'
                )
            ";

            $this->db->transBegin();
            $this->db->query($sql);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
            } else {
                $this->db->transCommit();
                $mensaje = "Se guardó el producto.";
                $resultado = true;
            }
        }

        return [
            "msg" => $mensaje,
            "result" => $resultado
        ];
    }

    public function modificar_producto($IdProducto, $nom_producto, $descripcion, $precio, $stock, $codigo_barras)
    {
        $mensaje = "Error al actualizar los datos.";
        $resultado = false;

        if (trim($IdProducto) !== "") {
            $sql = "
                UPDATE producto SET 
                    nom_producto = '$nom_producto',
                    descripcion = '$descripcion',
                    precio = $precio,
                    stock = $stock,
                    codigo_barras = '$codigo_barras'
                WHERE 
                    id_producto = $IdProducto
            ";

            $this->db->transBegin();
            $this->db->query($sql);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
            } else {
                $this->db->transCommit();
                $mensaje = "Se modificó el producto.";
                $resultado = true;
            }
        }

        return [
            "msg" => $mensaje,
            "result" => $resultado
        ];
    }

    public function eliminar_producto($IdProducto)
    {
        $mensaje = "Error al eliminar los datos.";
        $resultado = false;

        if (trim($IdProducto) !== "") {
            $sql = "
                DELETE FROM producto
                WHERE id_producto = $IdProducto
            ";

            $this->db->transBegin();
            $this->db->query($sql);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
            } else {
                $this->db->transCommit();
                $mensaje = "Se eliminó el producto.";
                $resultado = true;
            }
        }

        return [
            "msg" => $mensaje,
            "result" => $resultado
        ];
    }
}

?>
