<?php
require_once ('../sistema.class.php');
class Rol extends Sistema{
    function create ($data) {
        $result=[];
        $this -> conexion();
        $sql= "INSERT into rol (rol) 
        VALUES (:rol);";
        $insertar = $this-> con -> prepare($sql);
        $insertar -> bindParam(':rol', $data['rol'],PDO::PARAM_STR);
        $insertar -> execute();
        $result = $insertar ->rowCount();
        return $result;
    }
    function update($id, $data) {
        $this->conexion();
        $result=[];
        $sql = "UPDATE rol SET rol=:rol WHERE id_rol=:id_rol;";
        $modificar = $this->con->prepare($sql);
        $modificar -> bindParam(':id_rol', $id,PDO::PARAM_INT);
        $modificar -> bindParam(':rol', $data['rol'],PDO::PARAM_STR);
        $modificar -> execute();
        $result =$modificar->rowCount();
        return $result;
    }
    function delete($id) {
        $result=[];
        $this-> conexion();
        $sql="DELETE from rol where id_rol =:id_rol";
        $borrar = $this->con-> prepare($sql);
        $borrar -> bindParam(':id_rol',$id,PDO::PARAM_INT);
        $borrar -> execute();
        $result = $borrar -> rowCount();
        return $result;
    }
    function readOne($id) {
        $this -> conexion();
        $result=[];
        $query = "SELECT * FROM rol where id_rol=:id_rol;";
        $sql = $this -> con->prepare($query);
        $sql->bindParam(":id_rol",$id,PDO::PARAM_INT);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    function readAll(){
        $this -> conexion();
        $result=[];
        $query = "SELECT * FROM rol";
        $sql = $this -> con->prepare($query);
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>