<?php
require_once('../sistema.class.php');
$app = new Sistema;
$roles = $app->getRol('luislao@itcelaya.edu.mx');
print_r($roles);
$privilegio = $app->getPrivilegio('luislao@itcelaya.edu.mx');
print_r($privilegio);
?>