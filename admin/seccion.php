<?php
require_once ('seccion.class.php');
require_once ('invernadero.class.php');
$appinvernadero = new Invernadero();
$app=new Seccion();
$app -> checkRol('Administrador');
$accion = (isset($_GET['accion']))?$_GET['accion']:NULL;

$id=(isset($_GET['id']))?$_GET['id']:null;

switch($accion){
    case 'crear':
        $invernaderos = $appinvernadero -> readAll();
        require_once("views/seccion/crear.php");
        break;

    case 'nuevo':
        $data = $_POST['data'];
        $resultado = $app -> create($data);
        if($resultado){
            $mensaje = "La sección se ha agregado correctamente";
            $tipo = "success";
        }else{
            $mensaje = "Ocurrió un error al agregar";
            $tipo = "danger";
        }
        $secciones = $app -> readAll();
        require_once('views/seccion/index.php');
        break;

    case 'actualizar':
        $secciones = $app -> readOne($id);
        $invernaderos = $appinvernadero -> readAll();
        require_once('views/seccion/crear.php');
        break;

    case 'modificar':
        $data = $_POST['data'];
        $resultado = $app -> update($id,$data);
        if($resultado){
            $mensaje = "La sección se ha actualizado correctamente";
            $tipo = "success";
        }else{
            $mensaje = "Ocurrió un error al actualizar";
            $tipo = "danger";
        }
        $secciones = $app -> readAll();
        require_once('views/seccion/index.php');
        break;  

    case 'eliminar':
        if(!is_null($id)){
            if(is_numeric($id)){
                $resultado = $app -> delete($id);
                if($resultado){
                    $mensaje = "La sección se ha eliminado correctamente";
                    $tipo = "success";
                }else{
                    $mensaje = "Ocurrió un error";
                    $tipo = "danger";
                }
            }
        }
        $secciones = $app -> readAll();
        require_once("views/seccion/index.php");
        break;
    default:
        $secciones = $app -> readAll();
        require_once("views/seccion/index.php");

}
?>