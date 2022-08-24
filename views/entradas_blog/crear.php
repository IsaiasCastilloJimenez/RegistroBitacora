<main class="contenedor seccion">
    <h1>Registrar Nueva entrada de Blog</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach($errores as $error): ?>
    <div class="alerta error">
        <?php echo $error; ?>
    </div>
    <?php endforeach; ?>
    <form class="formulario" method="POST" action="/entradas_blog/crear" > 
        <?php include('formulario.php') ?>
        <input type="submit" value="Registrar nueva entrada" class="boton boton-verde">
    </form>
</main>