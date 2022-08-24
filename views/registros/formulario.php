<h2 class="nombre_user"><?php echo s($_SESSION['user']); ?></h2>
<fieldset>
    <legend>Por favor llene los siguientes campos: </legend>

    
    <label for="laboratorio">Laboratorio en el que impartió clase:</label>
    <select id="laboratorio" name="registro[laboratorio]" require>
        <option value="" disabled selected>--Seleccione--</option>
        <option value="D104">D104</option>
        <option value="D105">D105</option>
    </select>

    <label for="idioma">Idioma que impartió:</label>
    <select id="idioma" name="registro[idioma]" require>
        <option value="" disabled selected>--Seleccione--</option>
        <option value="ALEMAN">Alemán</option>
        <option value="FRANCES">Francés</option>
        <option value="INGLES">Inglés</option>
        <option value="ITALIANO">Italiano</option>
    </select>
    
    <label for="grupo">Grupo al que impartió clase:</label>
    <input type="text" id="grupo" name="registro[grupo]"  placeholder="Grupo al que impartió clase" value="<?php echo s($registro->grupo); ?>" require>  <!---->

    <label for="alumnos">¿Cuántos alumnos se presentaron?:</label>
    <input type="number" id="alumnos" name="registro[alumnos]" placeholder="Ej: 3" min="1" max="40" value="<?php echo s($registro->alumnos); ?>" require>  <!--  -->
    
    <p>¿Tuvo algún incidente durante su clase?</p>
    <div class="forma-contacto">
        <label for="SI">Sí</label>
        <input type="radio" value=1 id="SI" name="registro[incidente]" >

        <label for="NO">No</label>
        <input type="radio" value=0 id="NO" name="registro[incidente]" >
    </div>
    
    <div id="mensaje"></div>
    
</fieldset>