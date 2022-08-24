<fieldset>
    
    <legend>Información General</legend>

    <label for="titulo">Titulo:</label>
    <input type="text" id="titulo" name="entradas[titulo]" placeholder="Titulo de la entrada" value="<?php echo s($entradas->titulo); ?>">

    <label for="autor">Autor:</label>
    <input type="text" id="autor" name="entradas[autor]" placeholder="Autor de la entrada" value="<?php echo s($entradas->autor); ?>">
    
    <legend>Contenido</legend>
    <label for="contenido">Contenido:</label>
    <input type="" id="contenido" name="entradas[contenido]" placeholder="Contenido de la entrada" value="<?php echo s($entradas->contenido); ?>">

</fieldset>