<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>
    <?php 
        if($resultado) {
            $mensaje = mostrarNotificacion( intval($resultado) );
            if($mensaje) { ?>
                <p class="alerta exito"><?php echo s($mensaje) ?></p>
            <?php }
        } 
    ?>

    <a href="/propiedades/crear" class="boton boton-verde">Nueva Propiedad</a>
    <a href="/vendedores/crear" class="boton boton-amarillo">Nuevo(a) Vendedor(a)</a>
    <a href="/entradas_blog/crear" class="boton boton-amarillo">Nueva Entrada de Blog</a>
    <a href="/registro/crear" class="boton boton-verde">Nuevo Registro Bitacora</a>
    <a href="/usuario/crear" class="boton boton-verde">Nuevo Usuario</a>

    <h2>Usuarios</h2>
    <table class="propiedades tabla-registro">
        <thead> 
            <tr>
                <th>ID</th>
                <th>e-mail</th>
                <th>Password</th>
                <th>Nombre</th>
                <th>Paterno</th>
                <th>Materno</th>
                <th>Empleado</th>
                <th>RFC</th>
                <th>Admin</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody > <!--Mostrar los resultados-->
            <?php foreach( $usuario as $usuario ): ?>
                
            <tr>
                <td><?php echo $usuario->id; ?></td>
                <td><?php echo $usuario->email; ?></td>
                <td><?php echo $usuario->password; ?></td>
                <td><?php echo $usuario->nombre; ?></td>
                <td><?php echo $usuario->paterno; ?></td>
                <td><?php echo $usuario->materno; ?></td>
                <td><?php echo $usuario->empleado; ?></td>
                <td><?php echo $usuario->rfc; ?></td>
                <td><?php echo $usuario->admin; ?></td>
                <td>
                    <form method="POST" class="w-100" action="/usuario/eliminar">
                        <input type="hidden" name="id" value="<?php echo $usuario->id; ?>">
                        <input type="hidden" name="tipo" value="usuario">
                        <input type="submit" class="boton-rojo-block" value="Eliminar" >
                    </form>    
                
                    
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Registros de Bitacora</h2>
    <table class="propiedades tabla-registro">
        <thead> 
            <tr>
                <th>ID</th>
                <th>laboratorio</th>
                <th>idioma</th>
                <th>grupo</th>
                <th>alumnos</th>
                <th>incidente</th>
                <th>mensaje</th>
                <th>atendido</th>
                <th>fecha_atencion</th>
                <th>hora_atencion</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody > <!--Mostrar los resultados-->
            <?php foreach( $registros as $registro ): ?>
                
            <tr>
                <td><?php echo $registro->id; ?></td>
                <td><?php echo $registro->laboratorio; ?></td>
                <td><?php echo $registro->idioma; ?></td>
                <td><?php echo $registro->grupo; ?></td>
                <td><?php echo $registro->alumnos; ?></td>
                <td><?php echo $registro->incidente; ?></td>
                <td><?php echo $registro->mensaje; ?></td>
                <td><?php echo $registro->atendido; ?></td>
                <td><?php echo $registro->fecha_atencion; ?></td>
                <td><?php echo $registro->hora_atencion; ?></td>
                <td>
                    <form method="POST" class="w-100" action="/registro/eliminar">
                        <input type="hidden" name="id" value="<?php echo $registro->id; ?>">
                        <input type="hidden" name="tipo" value="registro">
                        <input type="submit" class="boton-rojo-block" value="Eliminar" >
                    </form>    
                
                    <a href="/registro/actualizar?id=<?php echo $registro->id; ?>"
                    class="boton-amarillo-block">Actualizar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <h2>Propiedades</h2>
    <table class="propiedades">
        <thead> 
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody> <!--Mostrar los resultados-->
            <?php foreach( $propiedades as $propiedad ): ?>
                
            <tr>
                <td><?php echo $propiedad->id; ?></td>
                <td><?php echo $propiedad->titulo; ?></td>
                <td><img src="/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-tabla" ></td>
                <td>$ <?php echo $propiedad->precio; ?></td>
                <td>
                    <form method="POST" class="w-100" action="/propiedades/eliminar">
                        <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                        <input type="hidden" name="tipo" value="propiedad">
                        <input type="submit" class="boton-rojo-block" value="Eliminar" >
                    </form>    
                
                    <a href="/propiedades/actualizar?id=<?php echo $propiedad->id; ?>"
                        class="boton-amarillo-block">Actualizar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Vendedores</h2>

    <table class="propiedades">
        <thead> 
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody> <!--Mostrar los resultados-->
            <?php foreach( $vendedores as $vendedor ): ?>
                
            <tr>
                <td><?php echo $vendedor->id; ?></td>
                <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                <td><?php echo $vendedor->telefono; ?></td>
                <td>
                    <form method="POST" class="w-100" action="/vendedores/eliminar">
                        <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                        <input type="hidden" name="tipo" value="vendedor">
                        <input type="submit" class="boton-rojo-block" value="Eliminar" >
                    </form>    
                
                    <a href="/vendedores/actualizar?id=<?php echo $vendedor->id; ?>"
                    class="boton-amarillo-block">Actualizar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Entradas de Blog</h2>
    <table class="propiedades">
        <thead> 
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Autor</th>
                <th>Fecha de Publicación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody> <!--Mostrar los resultados-->
            <?php foreach( $entradas as $entrada ): ?>
                
            <tr>
                <td><?php echo $entrada->id; ?></td>
                <td><?php echo $entrada->titulo; ?></td>
                <td><?php echo $entrada->autor; ?></td>
                <td><?php echo $entrada->fecha_publicacion; ?></td>
                <td>
                    <form method="POST" class="w-100" action="/entradas_blog/eliminar">
                        <input type="hidden" name="id" value="<?php echo $entrada->id; ?>">
                        <input type="hidden" name="tipo" value="entradas_blog">
                        <input type="submit" class="boton-rojo-block" value="Eliminar" >
                    </form>    
                
                    <a href="/entradas_blog/actualizar?id=<?php echo $entrada->id; ?>"
                    class="boton-amarillo-block">Actualizar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    

</main>