<?php
require_once('roles.class.php');
$app = new Roles();
$app->checkRol('Administrador');
$accion = (isset($_GET['accion'])) ? $_GET['accion'] : NULL;
$id = (isset($_GET['id'])) ? $_GET['id'] : null;

switch ($accion) {
    case 'crear':
        include 'views/roles/crear.php';
        break;
    case 'nuevo':
        $data = $_POST['data'];
        $resultado = $app->create($data);
        if ($resultado) {
            $mensaje = "El rol se agregó correctamente";
            $tipo = "success";
        } else {
            $mensaje = "Hubo un error al agregar el rol";
            $tipo = "danger";
        }
        $roles = $app->readAll();
        include('views/roles/index.php');
        break;
    case 'actualizar':
        $rol = $app->readOne($id);
        include('views/roles/crear.php');
        break;
    case 'modificar':
        $data = $_POST['data'];
        $resultado = $app->update($id, $data);
        if ($resultado) {
            $mensaje = "El rol se actualizó correctamente";
            $tipo = "success";
        } else {
            $mensaje = "Hubo un error al actualizar el rol";
            $tipo = "danger";
        }
        $roles = $app->readAll();
        include('views/roles/index.php');
        break;
    case 'eliminar':
        if (!is_null($id)) {
            if (is_numeric($id)) {
                $resultado = $app->delete($id);
                if ($resultado) {
                    $mensaje = "El rol se ha eliminado correctamente";
                    $tipo = "success";
                } else {
                    $mensaje = "Ocurrió un error al eliminar el rol";
                    $tipo = "danger";
                }
            }
        }
        $roles = $app->readAll();
        include("views/roles/index.php");
        break;
    default:
        $roles = $app->readAll();
        include 'views/roles/index.php';
}

require_once('views/footer.php');
?>