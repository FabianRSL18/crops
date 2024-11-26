<?php
header("Content-type: application/json; charset=utf-8");
include("permisos.class.php");

$app = new Permisos();
//$app->checkRol('Administrador');
$accion = $_SERVER['REQUEST_METHOD'];
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
$data = [];
switch ($accion) {
    case 'POST':
        $datos = $_POST;
        $resultado = $app->create($datos);
        echo $resultado;
        if($resultado == 1){
            $data['mensaje'] = "El permiso se creo correctamente";
        } else{
            $data['mensaje'] = "Ocurrio algun error";
        }
        $permisos = $app->readAll();
        break;
    case 'modificar':
        $data = $_POST['data'];
        $resultado = $app->update($id, $data);
        if ($resultado) {
            $mensaje = "El permiso se actualizó correctamente";
            $tipo = "success";
        } else {
            $mensaje = "Hubo un error al actualizar el permiso";
            $tipo = "danger";
        }
        $permisos = $app->readAll();
        break;
    case 'DELETE':
        if (!is_null($id)) {
            if (is_numeric($id)) {
                $resultado = $app->delete($id);
                if ($resultado) {
                    $mensaje = "El permiso se ha eliminado correctamente";
                } else {
                    $mensaje = "Ocurrió un error al eliminar el permiso";
                }
            }
        }
        $data['mensaje'] = $mensaje;
        break;
    default:
        if(!is_null($id) && is_numeric($id)){
            $permisos = $app->readOne($id);
        }else{
            $permisos = $app->readAll();
        }
        $data = $permisos;
}
echo json_encode($data);
?>