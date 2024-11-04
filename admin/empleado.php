<?php
require_once('empleado.class.php'); 
require_once('usuario.class.php');

$appEmpleado = new Empleado();
$appUsuario = new Usuario();

$appEmpleado->checkRol('Administrador');
$accion = (isset($_GET['accion'])) ? $_GET['accion'] : NULL;
$id = (isset($_GET['id'])) ? $_GET['id'] : null;

switch ($accion) {
    case 'crear':
        $usuarios = $appUsuario->readAll();
        require_once("views/empleado/crear.php");
        break;

    case 'nuevo':
        //print_r($_POST);
        //print_r($_FILES);
        move_uploaded_file($_FILES['fotografia']['tmp_name'],"C:\\wamp64\\www\\crops\\uploads\\".$_FILES['fotografia']['name']);
        //echo("El archivo se cargo");
        //die();
        $data = $_POST['data'];
        $resultado = $appEmpleado->create($data);
        if ($resultado) {
            $mensaje = "El empleado se ha agregado correctamente";
            $tipo = "success";
        } else {
            $mensaje = "Ocurrió un error al agregar";
            $tipo = "danger";
        }
        $empleados = $appEmpleado->readAll();
        require_once('views/empleado/index.php');
        break;

    case 'actualizar':
        $empleado = $appEmpleado->readOne($id);
        $usuarios = $appUsuario->readAll();
        require_once('views/empleado/crear.php');
        break;

    case 'modificar':
        $data = $_POST['data'];
        $resultado = $appEmpleado->update($id, $data);
        if ($resultado) {
            $mensaje = "El empleado se ha actualizado correctamente";
            $tipo = "success";
        } else {
            $mensaje = "Ocurrió un error al actualizar";
            $tipo = "danger";
        }
        $empleados = $appEmpleado->readAll();
        require_once('views/empleado/index.php');
        break;

    case 'eliminar':
        if (!is_null($id) && is_numeric($id)) {
            $resultado = $appEmpleado->delete($id);
            if ($resultado) {
                $mensaje = "El empleado se ha eliminado correctamente";
                $tipo = "success";
            } else {
                $mensaje = "Ocurrió un error";
                $tipo = "danger";
            }
        }
        $empleados = $appEmpleado->readAll();
        require_once("views/empleado/index.php");
        break;

    default:
        $empleados = $appEmpleado->readAll();
        require_once("views/empleado/index.php");
}
?>