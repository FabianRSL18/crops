<?php require('views/header/header_administrador.php'); ?>
<h1><?php echo ($accion == "crear") ? "Nuevo " : "Modificar "; ?>Rol</h1>

<form action="roles.php?accion=<?php echo ($accion == "crear") ? 'nuevo' : 'modificar&id=' . $id; ?>" method="post">
    <div class="row mb-3">
        <label for="rol" class="col-sm-2 col-form-label">Nombre del Rol</label>
        <div class="col-sm-10">
            <input type="text" name="data[rol]" placeholder="Escribe aquí el nombre del rol" class="form-control" value="<?php echo isset($rol['rol']) ? $rol['rol'] : ''; ?>" required/>
        </div>
    </div>
    <input type="submit" name="data[enviar]" value="Guardar" class="btn btn-success"/>
</form>
<?php require('views/footer.php'); ?>