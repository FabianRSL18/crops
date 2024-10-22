<?php require('views/header/header_administrador.php')?>
<h1><?php if($accion == "crear"):echo("Nuevo ");else: echo("Modificar ");endif;  ?>Permisos</h1>
<form action="permiso.php?accion=<?php if($accion=="crear"):echo('nuevo');else: echo('modificar&id='.$id);endif;?>" method="post">
    <div class="row mb-3">
                <label for="permiso" class="col-sm-2 col-form-label">Permiso</label>
            <div class="col-sm-10">
                <input type="text" name="data[permiso]" placeholder="Escribe aquí el permiso" class="form-control" value="<?php if(isset($permisos['permiso'])):echo($permisos['permiso']);endif; ?>"/>
            </div>
    </div>
    <input type="submit" name="data[enviar]" value="Guardar" class="btn btn-success"/>
</form>
<?php require('views/footer.php') ?>