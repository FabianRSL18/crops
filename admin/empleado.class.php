<?php
require_once ('../sistema.class.php');
class Empleado extends Sistema {
    
    function create($data) {
        $result = [];
        $this->conexion();
        $sql = "INSERT INTO empleado(primer_apellido, segundo_apellido, nombre, rfc, id_usuario, fotografia) VALUES(:primer_apellido, :segundo_apellido, :nombre, :rfc, :id_usuario, :fotografia);";
        $insertar = $this->con->prepare($sql);
        $insertar->bindParam(':primer_apellido', $data['primer_apellido'], PDO::PARAM_STR);
        $insertar->bindParam(':segundo_apellido', $data['segundo_apellido'], PDO::PARAM_STR);
        $insertar->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
        $insertar->bindParam(':rfc', $data['rfc'], PDO::PARAM_STR);
        $insertar->bindParam(':id_usuario', $data['id_usuario'], PDO::PARAM_INT);
        $insertar->bindParam(':fotografia', $data['fotografia'], PDO::PARAM_STR);
        $insertar->execute();
        $result = $insertar->rowCount();
        return $result;
    }

    function update($id, $data) {
        $this->conexion();
        $result = [];
        $sql = "UPDATE empleado SET primer_apellido=:primer_apellido, segundo_apellido=:segundo_apellido, nombre=:nombre, rfc=:rfc, id_usuario=:id_usuario, fotografia=:fotografia WHERE id_empleado=:id_empleado;";
        $modificar = $this->con->prepare($sql);
        $modificar->bindParam(':id_empleado', $id, PDO::PARAM_INT);
        $modificar->bindParam(':primer_apellido', $data['primer_apellido'], PDO::PARAM_STR);
        $modificar->bindParam(':segundo_apellido', $data['segundo_apellido'], PDO::PARAM_STR);
        $modificar->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
        $modificar->bindParam(':rfc', $data['rfc'], PDO::PARAM_STR);
        $modificar->bindParam(':id_usuario', $data['id_usuario'], PDO::PARAM_INT);
        $modificar->bindParam(':fotografia', $data['fotografia'], PDO::PARAM_STR);
        $modificar->execute();
        $result = $modificar->rowCount();
        return $result;
    }

    function delete($id) {
        $this->conexion();
        $result = [];
        if (is_numeric($id)) {
            $sql = "DELETE FROM empleado WHERE id_empleado = :id_empleado";
            $borrar = $this->con->prepare($sql);
            $borrar->bindParam(':id_empleado', $id, PDO::PARAM_INT);
            $borrar->execute();
            $result = $borrar->rowCount();
        }
        return $result;
    }

    function readOne($id) {
        $this->conexion();
        $result = [];
        $query = "SELECT * FROM empleado WHERE id_empleado = :id_empleado;";
        $sql = $this->con->prepare($query);
        $sql->bindParam(":id_empleado", $id, PDO::PARAM_INT);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function readAll() {
        $this->conexion();
        $sql = "SELECT e.*, u.correo FROM empleado e JOIN usuario u ON e.id_usuario = u.id_usuario";
        $consulta = $this->con->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>