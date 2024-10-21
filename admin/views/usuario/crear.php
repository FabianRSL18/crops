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
        <label for="contrasena" class="col-sm-2 col-form-label">contrasena</label>
        <div class="col-sm-10">
            <input type="text" name="data[contrasena]" placeholder="Ingresa contrasena" class="form-control" value="<?php if(isset($usuarios['contrasena'])):echo($usuarios['contrasena']);endif; ?>"/>
        </div>
    </div>
    <input type="submit" name="data[enviar]" value="Guardar" class="btn btn-success"/>
</form>
<?php require('views/footer.php') ?>