<?php require('views/header/header_administrador.php'); ?>

<h1 class="text-center">
    <?php if($accion == "crear"): echo("Nuevo "); else: echo("Modificar "); endif; ?>Invernadero
</h1>

<div class="container my-5">
    <div class="d-flex justify-content-center">
        <form class="w-75" action="invernadero.php?accion=<?php if($accion=="crear"): echo('nuevo'); else: echo('modificar&id='.$id); endif;?>" method="post">
            <div class="mb-3">
                <label for="invernadero" class="form-label">Nombre del Invernadero</label>
                <input type="text" name="data[invernadero]" placeholder="Escribe aquí el nombre" class="form-control" value="<?php if(isset($invernaderos['invernadero'])): echo($invernaderos['invernadero']); endif; ?>"/>
            </div>
            <div class="mb-3">
                <label for="latitud" class="form-label">Latitud</label>
                <input type="number" name="data[latitud]" placeholder="Escribe aquí la latitud" class="form-control" value="<?php if(isset($invernaderos['latitud'])): echo($invernaderos['latitud']); endif; ?>"/>
            </div>
            <div class="mb-3">
                <label for="longitud" class="form-label">Longitud</label>
                <input type="number" name="data[longitud]" placeholder="Escribe aquí la longitud" class="form-control" value="<?php if(isset($invernaderos['longitud'])): echo($invernaderos['longitud']); endif; ?>"/>
            </div>
            <div class="mb-3">
                <label for="area" class="form-label">Área del invernadero (m<sup>2</sup>)</label>
                <input type="number" name="data[area]" placeholder="Escribe aquí el área" class="form-control" value="<?php if(isset($invernaderos['area'])): echo($invernaderos['area']); endif; ?>"/>
            </div>
            <div class="mb-3">
                <label for="fechaCreacion" class="form-label">Fecha de creación</label>
                <input type="date" name="data[fechaCreacion]" placeholder="Escribe aquí la fecha de creación" class="form-control" value="<?php if(isset($invernaderos['fechaCreacion'])): echo($invernaderos['fechaCreacion']); endif; ?>"/>
            </div>
            <div class="text-center">
                <input type="submit" name="data[enviar]" value="Guardar" class="btn btn-success"/>
            </div>
        </form>
    </div>
</div>

<?php require('views/footer.php'); ?>
