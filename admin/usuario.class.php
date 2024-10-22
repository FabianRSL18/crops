<?php
require_once ('../sistema.class.php');
class Usuario extends Sistema{
    function create($data) {
        $this->conexion();
        $data = $data['data'];
        $this->con->beginTransaction();
        $sql = "INSERT INTO usuario (correo, contrasena) VALUES (:correo, :contrasena)";
        $insertar = $this->con->prepare($sql);
        $data['contrasena'] = md5($data['contrasena']);
        $insertar->bindParam(':correo', $data['correo'], PDO::PARAM_STR);
        $insertar->bindParam(':contrasena', $data['contrasena'], PDO::PARAM_STR);
        $insertar->execute();
        $this->con->commit();
        return $insertar->rowCount();
    }

    function update($id, $data) {
        $this->conexion();
        $sql = "UPDATE usuario SET correo = :correo, contrasena = :contrasena WHERE id_usuario = :id_usuario";
        $modificar = $this->con->prepare($sql);
        $data['contrasena'] = md5($data['contrasena']);
        $modificar->bindParam(':id_usuario', $id, PDO::PARAM_INT);
        $modificar->bindParam(':correo', $data['correo'], PDO::PARAM_STR);
        $modificar->bindParam(':contrasena', $data['contrasena'], PDO::PARAM_STR);
        $modificar->execute();
        return $modificar->rowCount();
    }

    function delete($id) {
        $result=[];
        $this-> conexion();
        $sql="DELETE from usuario where id_usuario =:id_usuario";
        $borrar = $this-> con -> prepare($sql);
        $borrar -> bindParam(':id_usuario',$id,PDO::PARAM_INT);
        $borrar -> execute();
        $result = $borrar -> rowCount();
        return $result;
    }
    
    function readOne($id) {
        $this -> conexion();
        $result = [];
        $query = "SELECT * FROM usuario where id_usuario=:id_usuario;";
        $sql = $this -> con -> prepare($query);
        $sql -> bindParam(":id_usuario",$id,PDO::PARAM_INT);
        $sql -> execute();
        $result = $sql -> fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function readAll(){
        $this -> conexion();
        $result=[];
        $query = "SELECT * FROM usuario";
        $sql = $this -> con-> prepare($query);
        $sql -> execute();
        $result = $sql -> fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
}
?>