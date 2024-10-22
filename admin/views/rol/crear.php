<?php require('views/header/header_administrador.php')?>
<h1><?php if($accion == "crear"):echo("Nuevo ");else: echo("Modificar ");endif;  ?>rol</h1>
<form action="rol.php?accion=<?php if($accion=="crear"):echo('nuevo');else: echo('modificar&id='.$id);endif;?>" method="post">
    <div class="row mb-3">
                <label for="rol" class="col-sm-2 col-form-label">Nombre del rol</label>
            <div class="col-sm-10">
                <input type="text" name="data[rol]" placeholder="Escribe aquí el nombre" class="form-control" value="<?php if(isset($roles['rol'])):echo($roles['rol']);endif; ?>"/>
            </div>
    </div>
    <input type="submit" name="data[enviar]" value="Guardar" class="btn btn-success"/>
</form>
<?php require('views/footer.php') ?>