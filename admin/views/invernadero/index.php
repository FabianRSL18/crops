<?php require('views/header/header_administrador.php'); ?>
<h1>Invernaderos</h1>
<?php if(isset($mensaje)): $app->alert($tipo, $mensaje); endif; ?>
<a href="invernadero.php?accion=crear" class="btn btn-success">Nuevo</a>
<div class="container my-5">
    <div class="d-flex justify-content-center">
        <table class="table table-bordered table-striped w-90">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Area</th>
                    <th scope="col">Latitud</th>
                    <th scope="col">Longitud</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($invernaderos as $invernadero): ?>
                <tr>
                    <th scope="row"><?php echo $invernadero['id_invernadero']; ?></th>
                    <td><?php echo $invernadero['invernadero']; ?></td>
                    <td><?php echo $invernadero['area']; ?></td>
                    <td><?php echo $invernadero['latitud']; ?></td>
                    <td><?php echo $invernadero['longitud']; ?></td>
                    <td><?php echo $invernadero['fechaCreacion']; ?></td>
                    <td class="text-center">
                        <a href="invernadero.php?accion=actualizar&id=<?php echo $invernadero['id_invernadero']; ?>" class="btn btn-primary">Actualizar</a>
                        <a href="invernadero.php?accion=eliminar&id=<?php echo $invernadero['id_invernadero']; ?>" class="btn btn-danger">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require('views/footer.php'); ?>