<?php
require_once('permiso.class.php');
$app = new Permiso();
$app -> checkRol('Administrador');
$accion = (isset($_GET['accion'])) ? $_GET['accion'] : NULL;
$id = (isset($_GET['id'])) ? $_GET['id'] : null;

switch ($accion) {
    case 'crear':
        include 'views/permiso/crear.php';
        break;
    case 'nuevo':
        $data = $_POST['data'];
        $resultado = $app->create($data);
        if ($resultado) {
            $mensaje = "El permiso se agrego correctamente";
            $tipo = "success";
        } else {
            $mensaje = "Hubo un error al agregar el permiso";
            $tipo = "danger";
        }
        $permisos = $app->readAll();
        include('views/permiso/index.php');
        break;
    case 'actualizar':
        $permisos = $app->readOne($id);
        include('views/permiso/crear.php');

        break;
    case 'modificar':
        $data = $_POST['data'];
        $resultado = $app->update($id, $data);
        if ($resultado) {
            $mensaje = "El permiso se actualizo";
            $tipo = "success";
        } else {
            $mensaje = "El permiso no se actualizo";
            $tipo = "danger";
        }
        $permisos = $app->readAll();
        include('views/permiso/index.php');
        break;

    case 'eliminar':
        if (!is_null($id)) {
            if (is_numeric($id)) {
                $resultado = $app->delete($id);
                if ($resultado) {
                    $mensaje = "El permiso se ha eliminado correctamente";
                    $tipo = "success";
                } else {
                    $mensaje = "Ocurrió un error";
                    $tipo = "danger";
                }
            }
        }
        $permisos = $app->readAll();
        include("views/permiso/index.php");
        break;
    default:
        $permisos = $app->readAll();
        include 'views/permiso/index.php';
}
require_once('views/footer.php');
?>