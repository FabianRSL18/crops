<?php
require_once('../sistema.class.php'); 
$app= new Sistema;
$accion = (isset($_GET['accion'])) ? $_GET['accion'] : NULL;
switch ($accion){
    case 'login':
        $correo = $_POST['data']['correo'];
        $contrasena= $_POST['data']['contrasena'];
        if($app->login($correo,$contrasena)){
            $mensaje="Bienvenido al sistema";
            $tipo="success";
            $app->checkRol('Administrador');
            require_once('views/header/header_administrador.php');
            $app->alert($tipo,$mensaje);

        }else{
            $mensaje="Correo o contraseña incorrectos <a href='login.php' [Presione aquí para volver a intentar]</a>";
            $tipo="danger";
            require_once('views/header.php');
            $app->alert($tipo,$mensaje);
        }
    break;
    case 'logout':
        $app->logout();
    break;
    default:
    require_once('views/login/index.php');
    break;
}
require_once('views/footer.php');
?>


