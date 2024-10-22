<?php
require_once ('../sistema.class.php');
class Usuario extends Sistema{
    function create ($data) {
        $result=[];
        $this -> conexion();
        $sql= "INSERT into usuario (correo,contrasena) 
        VALUES (:correo,MD5(:contrasena));";
        $insertar = $this-> con -> prepare($sql);
        $insertar -> bindParam(':correo', $data['correo'],PDO::PARAM_STR);
        $insertar -> bindParam(':contrasena', $data['contrasena'],PDO::PARAM_STR);
        $insertar -> execute();
        $result = $insertar ->rowCount();
        return $result;
    }
    function update($id, $data) {
        $this->conexion();
        $result=[];
        $sql = "UPDATE usuario SET correo=:correo, contrasena=:contrasena WHERE id_usuario=:id_usuario;";
        $modificar = $this -> con -> prepare($sql);
        $modificar -> bindParam(':id_usuario', $id,PDO::PARAM_INT);
        $modificar -> bindParam(':correo', $data['correo'],PDO::PARAM_STR);
        $modificar -> bindParam(':contrasena', $data['contrasena'],PDO::PARAM_STR);
        $modificar -> execute();
        $result = $modificar -> rowCount();
        return $result;
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
        $result=[];
        $query = "SELECT * FROM usuario where id_usuario=:id_usuario;";
        $sql = $this -> con -> prepare($query);
        $sql - >bindParam(":id_usuario",$id,PDO::PARAM_INT);
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