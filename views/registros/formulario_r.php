<fieldset>
    
    <legend>Este registro cuenta con la siguiente información</legend>

    
    <label>Laboratorio en el que impartió clase: <span class="texto-verde"><?php echo s($registro->laboratorio); ?></span></label>
    <label for="laboratorio">Elija un nuevo laboratorio: </label>
    <select id="laboratorio" name="registro[laboratorio]" >
        <option value="" disabled selected>--Seleccione--</option>
        <option value="D104">D104</option>
        <option value="D105">D105</option>
    </select>

    <label>Idioma que impartió: <span class="texto-verde"><?php echo s($registro->idioma); ?></span></label>
    <label for="idioma">Elija un nuevo idioma:</label>
    <select id="idioma" name="registro[idioma]" >
        <option value="" disabled selected>--Seleccione--</option>
        <option value="ALEMAN">Alemán</option>
        <option value="FRANCES">Francés</option>
        <option value="INGLES">Inglés</option>
        <option value="ITALIANO">Italiano</option>
    </select>
    
    <label for="grupo">Grupo al que impartió clase:</label>
    <input type="text" id="grupo" name="registro[grupo]"  placeholder="Grupo al que impartió clase" value="<?php echo s($registro->grupo); ?>" class="texto-verde">  <!---->

    <label for="alumnos">¿Cuántos alumnos se presentaron?:</label>
    <input type="number" id="alumnos" name="registro[alumnos]" placeholder="Ej: 3" min="1" max="40" value="<?php echo s($registro->alumnos); ?>" class="texto-verde">  <!--  -->
    
    <p class="text-formulario">¿Tuvo algún incidente durante su clase?
        <span class="texto-verde">
            <?php
            
                if (s($registro->incidente) == 0) {
                    echo 'NO';
                } else {
                    echo 'SI';
                    
                }
                
            ?>
        </span>
    </p>
    <input type="text" id="incidente" 
            name="registro[mensaje]"  
            value="<?php 
                if (!s($registro->incidente) == 0) {
                    echo s($registro->mensaje); 
                }

                ?>"    
            class="texto-verde"
    >  <!---->
    <p>Si desea realizar un cambio elija a continuación si tuvo incidente</p>
    <div class="forma-contacto">
        <label for="SI">Sí</label>
        <input type="radio" value=1 id="SI" name="registro[incidente]" >

        <label for="NO">No</label>
        <input type="radio" value=0 id="NO" name="registro[incidente]" >
    </div>
    <div id="mensaje"></div>
    <p>Ya se atendió el incidente</p>
    <div class="forma-contacto">
        <label for="atendio">Sí</label>
        <input type="radio" value=1 id="atendio" name="registro[atendido]" >

        <label for="noatendio">No</label>
        <input type="radio" value=0 id="noatendio" name="registro[atendido]" >
    </div>
    <div id="atendido"></div>
    
</fieldset>