<?php require('views/header/header_administrador.php')?>
<h1><?php if($accion == "crear"):echo("Nuevo ");else: echo("Modificar ");endif;  ?>Invernadero</h1>
<form action="invernadero.php?accion=<?php if($accion=="crear"):echo('nuevo');else: echo('modificar&id='.$id);endif;?>" method="post">
    <div class="row mb-3">
                <label for="invernadero" class="col-sm-2 col-form-label">Nombre del Invernadero</label>
            <div class="col-sm-10">
                <input type="text" name="data[invernadero]" placeholder="Escribe aquí el nombre" class="form-control" value="<?php if(isset($invernaderos['invernadero'])):echo($invernaderos['invernadero']);endif; ?>"/>
            </div>
    </div>
    <div class="row mb-3">
        <label for="latitud" class="col-sm-2 col-form-label">Latitud</label>
        <div class="col-sm-10">
            <input type="number" name="data[latitud]" placeholder="Escribe aquí la latitud" class="form-control" value="<?php if(isset($invernaderos['latitud'])):echo($invernaderos['latitud']);endif; ?>"/>
        </div>
    </div>
    <div class="row mb-3">
        <label for="longitud" class="col-sm-2 col-form-label">Longitud</label>
        <div class="col-sm-10">
            <input type="number" name="data[longitud]" placeholder="Escribe aquí la longitud" class="form-control" value="<?php if(isset($invernaderos['longitud'])):echo($invernaderos['longitud']);endif; ?>"/>
        </div>
    </div>
    <div class="row mb-3">
        <label for="area" class="col-sm-2 col-form-label">Área del invernadero (m<sup>2</sup>)</label>
        <div class="col-sm-10">
            <input type="number" name="data[area]" placeholder="Escribe aquí el área" class="form-control" value="<?php if(isset($invernaderos['area'])):echo($invernaderos['area']);endif; ?>"/>
        </div>
    </div>
    <div class="row mb-3">
        <label for="fechaCreacion" class="col-sm-2 col-form-label">Fecha de creación</label>
        <div class="col-sm-10">
            <input type="date" name="data[fechaCreacion]" placeholder="Escribe aquí la fecha de creación" class="form-control" value="<?php if(isset($invernaderos['fechaCreacion'])):echo($invernaderos['fechaCreacion']);endif; ?>"/>
        </div>
    </div>
    <input type="submit" name="data[enviar]" value="Guardar" class="btn btn-success"/>
</form>
<?php require('views/footer.php') ?>