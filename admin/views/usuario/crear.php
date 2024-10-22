<?php require('views/header/header_administrador.php')?>
<h1><?php if($accion == "crear"):echo("Nuevo ");else: echo("Modificar ");endif;  ?>Usuario</h1>
<form action="usuario.php?accion=<?php if($accion=="crear"):echo('nuevo');else: echo('modificar&id='.$id);endif;?>" method="post">
    <div class="row mb-3">
                <label for="correo" class="col-sm-2 col-form-label">Correo Electronico</label>
            <div class="col-sm-10">
                <input type="text" name="data[usuario]" placeholder="Escribe aquí el correo" class="form-control" value="<?php if(isset($usuarios['usuario'])):echo($usuarios['usuario']);endif; ?>"/>
            </div>
    </div>
    <div class="row mb-3">
        <label for="contrasena" class="col-sm-2 col-form-label">contraseña</label>
        <div class="col-sm-10">
            <input type="text" name="data[contrasena]" placeholder="Ingresa contraseña" class="form-control" value="<?php if(isset($usuarios['contrasena'])):echo($usuarios['contrasena']);endif; ?>"/>
        </div>
    </div>
    <?php foreach($roles as $rol): ?>
    <div>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" name="rol[<?php echo($rol['id_rol']);?>]">
            <label class="form-check-label" for="flexSwitchCheckChecked"><?php echo($rol['rol']);?></label>
        </div>
    </div>
    <?php endforeach;?>
    <input type="submit" name="data[enviar]" value="Guardar" class="btn btn-success"/>
</form>
<?php require('views/footer.php') ?>