<main class="contenedor seccion contenido-centrado">
    <section class="blog">
        <h3>Nuestro Blog</h3>
        <?php foreach($entradas as $entrada) {?>
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image/webp">
                        <source srcset="build/img/blog1.jpg" type="image/jpeg">
                        <img loading="lazy" src="build/img/blog1.jpg" alt="Texto Entrada Blog">
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="/entrada?id=<?php echo $entrada->id; ?>">
                    <!-- <a href="/propiedad?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block"> -->
                    <h4><?php echo $entrada->titulo; ?></h4>
                        <p>Escrito el: <span><?php echo $entrada->fecha_publicacion; ?></span> por: <span><?php echo $entrada->autor; ?></span></p>
                        <p>
                            <?php echo $entrada->contenido; ?>
                        </p>
                    </a>
                </div>
            </article>
        <?php }?>
    </section>
</main>