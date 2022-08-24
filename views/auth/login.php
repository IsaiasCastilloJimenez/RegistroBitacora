<main class="contenedor seccion contenido-centrado">
        <h1>Bienvenido Profesor(a)</h1>
        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form method="POST" class="formulario" novalidate>
            <fieldset>
                <legend>
                    Ingrese sus datos:
                </legend>
                
                <label for="idEmpleado">Número de Empleado UNAM</label>
                <input type="text" name="empleado" placeholder="Ingrese su número de empleado" id="idEmpleado" >

                <label for="rfchomoclave">RFC con Homoclave</label>
                <input type="password" name="rfc" placeholder="RFC a 13 posiciones" id="rfchomoclave" >
            </fieldset>
            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
        </form>
    </main>