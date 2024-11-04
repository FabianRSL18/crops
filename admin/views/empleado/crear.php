<?php require('views/header/header_administrador.php') ?>
<h1><?php if($accion == "crear"):echo("Nuevo");else: echo("Modificar ");endif; ?>Empleado</h1>

<form action="empleado.php?accion=<?php if($accion=="crear"):echo('nuevo');else: echo('modificar&id='.$id);endif; ?>" method="post" enctype="multipart/form-data">
    <div class="row mb-3">
        <label for="primer_apellido" class="col-sm-2 col-form-label">Primer Apellido</label>
        <div class="col-sm-10">
            <input type="text" name="data[primer_apellido]" placeholder="Escribe aquí el primer apellido" class="form-control" value="<?php if(isset($empleado['primer_apellido'])):echo($empleado['primer_apellido']);endif; ?>"/>
        </div>
    </div>
    
    <div class="row mb-3">
        <label for="segundo_apellido" class="col-sm-2 col-form-label">Segundo Apellido</label>
        <div class="col-sm-10">
            <input type="text" name="data[segundo_apellido]" placeholder="Escribe aquí el segundo apellido" class="form-control" value="<?php if(isset($empleado['segundo_apellido'])):echo($empleado['segundo_apellido']);endif; ?>"/>
        </div>
    </div>
    
    <div class="row mb-3">
        <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
        <div class="col-sm-10">
            <input type="text" name="data[nombre]" placeholder="Escribe aquí el nombre" class="form-control" value="<?php if(isset($empleado['nombre'])):echo($empleado['nombre']);endif; ?>"/>
        </div>
    </div>

    <div class="row mb-3">
        <label for="rfc" class="col-sm-2 col-form-label">RFC</label>
        <div class="col-sm-10">
            <input type="text" name="data[rfc]" placeholder="Escribe aquí el RFC" class="form-control" value="<?php if(isset($empleado['rfc'])):echo($empleado['rfc']);endif; ?>"/>
        </div>
    </div>
    
    <div class="row mb-3">
        <label for="id_usuario" class="col-sm-2 col-form-label">Correo</label>
        <div class="col-sm-10">
            <select name="data[id_usuario]" class="form-select">
                <?php foreach($usuarios as $usuario): ?>
                    <?php 
                    $selected = "";
                    if(isset($empleado['id_usuario']) && $empleado['id_usuario'] == $usuario['id_usuario']) {
                        $selected = "selected";
                    }
                    ?>
                    <option value="<?php echo($usuario['id_usuario']); ?>" <?php echo($selected); ?>>
                        <?php echo($usuario['correo']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    
    <div class="row mb-3">
        <label for="fotografia" class="col-sm-2 col-form-label">Fotografía</label>
        <div class="col-sm-10">
            <input type="file" name="fotografia" placeholder="URL de la fotografía" class="form-control" />
        </div>
    </div>
    
    <input type="submit" name="data[enviar]" value="Guardar" class="btn btn-success"/>
</form>
<?php require_once('views/footer.php') ?>
