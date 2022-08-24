<fieldset>
    <legend>Datos del nuevo Usuario</legend>
    <label for="email">Correo Electrónico:</label>
    <input type="email" id="email" name="usuario[email]" placeholder="Inserta un correo electrónico válido" value="<?php echo s($usuario->email); ?>">

    <label for="passwordNuevoUsuario">Password:</label>
    <input type="password" id="passwordNuevoUsuario" name="usuario[password]" placeholder="Crea un Password" >

    <label for="nombreUsuario">Nombre:</label>
    <input type="text" id="nombreUsuario" name="usuario[nombre]" placeholder="Nombre del usuario" value="<?php echo s($usuario->nombre); ?>">

    <label for="paternoUsuario">Apellido Paterno:</label>
    <input type="text" id="paternoUsuario" name="usuario[paterno]" placeholder="Apellido Paterno del usuario" value="<?php echo s($usuario->paterno); ?>">

    <label for="maternoUsuario">Apellido Materno:</label>
    <input type="text" id="maternoUsuario" name="usuario[materno]" placeholder="Apellido Materno del usuario" value="<?php echo s($usuario->materno); ?>">

    <label for="numEmpleado">Número de empleado UNAM:</label>
    <input type="text" id="numEmpleado" name="usuario[empleado]" placeholder="Número de empleado del usuario" value="<?php echo s($usuario->empleado); ?>">

    <label for="rfcUsuario">RFC:</label>
    <input type="text" id="rfcUsuario" name="usuario[rfc]" placeholder="RFC" value="<?php echo s($usuario->rfc); ?>">

    <label>Tipo de usuario: </label>
    <select id="tipoUsuario" name="usuario[admin]" >
        <option value="" disabled selected>--Seleccione--</option>
        <option value= 0 >Usuario</option>
        <option value= 1 >Administrador</option>
    </select>
    </fieldset>