<main class="contenedor seccion contenido-centrado">
     
    <h1><?php echo $entradas->titulo; ?></h1>
    
        <picture>
            <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada2.jpg" alt="imagen de la propiedad">
        </picture>
        <p class="informacion-meta">Escrito el: <span><?php echo $entradas->fecha_publicacion; ?></span> por: <span><?php echo $entradas->autor; ?></span></p>
        <div class="resumen-propiedad">
            
            <p> <?php echo $entradas->contenido; ?></p>
        </div>

</main>