<?php
require_once('../sistema.class.php');

class Roles extends Sistema {
    function create($data) {
        $this->conexion();
        $sql = "INSERT INTO rol (rol) VALUES (:rol)";
        $insertar = $this->con->prepare($sql);
        $insertar->bindParam(':rol', $data['rol'], PDO::PARAM_STR);
        $insertar->execute();
        return $insertar->rowCount();
    }

    function update($id, $data) {
        $this->conexion();
        $sql = "UPDATE rol SET rol = :rol WHERE id_rol = :id_rol";
        $modificar = $this->con->prepare($sql);
        $modificar->bindParam(':id_rol', $id, PDO::PARAM_INT);
        $modificar->bindParam(':rol', $data['rol'], PDO::PARAM_STR);
        $modificar->execute();
        return $modificar->rowCount();
    }

    function delete($id) {
        $this->conexion();
        $sql="DELETE FROM rol WHERE id_rol = :id_rol";
        $borrar = $this->con->prepare($sql);
        $borrar->bindParam(':id_rol', $id, PDO::PARAM_INT);
        $borrar->execute();
        return $borrar->rowCount();
    }

    function readOne($id) {
        $this->conexion();
        $sql="SELECT * FROM rol WHERE id_rol = :id_rol";
        $consulta = $this->con->prepare($sql);
        $consulta->bindParam(':id_rol', $id, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    function readAll() {
        $this->conexion();
        $sql="SELECT * FROM rol";
        $consulta = $this->con->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>