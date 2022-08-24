<main class="contenedor seccion">
        <h1>Actualizar Vendedor(a)</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
        <?php endforeach; ?>
        <form class="formulario" method="POST" > <!--enctype="multipart/form-data"--><!-- se debe poner enctype=multipart/form-data para que la superglobal _File lea el archivo -->
            <?php include 'formulario.php' ?>
            <input type="submit" value="Guardar cambios" class="boton boton-verde">
        </form>
    </main>