<?php require('views/header/header_administrador.php')?>
<h1><?php if($accion == "crear"):echo("Nuevo");else: echo("Modificar ");endif;  ?>Seccion</h1>

<form action="seccion.php?accion=<?php if($accion=="crear"):echo('nuevo');else: echo('modificar&id='.$id);endif;?>" method="post">
    <div class="row mb-3">
        <label for="seccion" class="col-sm-2 col-form-label">Nombre de la Sección</label>
        <div class="col-sm-10">
            <input type="text" name="data[seccion]" placeholder="Escribe aquí la sección" class="form-control" value="<?php if(isset($secciones['seccion'])):echo($secciones['seccion']);endif; ?>"/>
        </div>
    </div>
    <div class="row mb-3">
        <label for="area" class="col-sm-2 col-form-label">Área del seccion (m<sup>2</sup>)</label>
        <div class="col-sm-10">
            <input type="number" name="data[area]" placeholder="Escribe aquí el área" class="form-control" value="<?php if(isset($secciones['area'])):echo($secciones['area']);endif; ?>"/>
        </div>
    </div>
    <div class="row mb-3">
        <label for="id_invernadero" class="col-sm-2 col-form-label">Invernadero</label>
        <select name="data[id_invernadero]" id="" class="form-select">
            <?php foreach($invernaderos as $invernadero):?>
                <?php 
                $selected = "";
                if($secciones['id_invernadero'] == $invernadero['id_invernadero']){
                    $selected = "selected";
                }
                ?>
            <option value="<?php echo($invernadero['id_invernadero']); ?>" <?php echo($selected);?>><?php echo($invernadero['invernadero']); ?></option>
            <?php endforeach; ?>
        </select>
        </div>
    </div>
    <input type="submit" name="data[enviar]" value="Guardar" class="btn btn-success"/>
</form>
<?php require_once('views/footer.php') ?>