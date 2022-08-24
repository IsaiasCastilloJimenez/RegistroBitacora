<?php
    if(!isset($_SESSION)) {
        session_start();
    }
    $auth = $_SESSION['login'] ?? false;
    
    if(!isset($inicio)) {
        $inicio = false;
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registro de Bitacora Laboratorios de Idiomas ENP2, UNAM MX</title>
        <link rel="stylesheet" href="../build/css/app.css"/>
    </head>
    <body>
        <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
            <div class="contenedor contenido-header">
                <div class="barra">
                    <a href="/">
                        <img class="imagen-logo" src="/build/img/mediateca_en2.png" alt="Logotipo de Mediateca"/>
                    </a>

                    <div class="mobile-menu">
                        <img src="/build/img/barras.svg" alt="icono menu responsive">
                    </div>
                    <div class="derecha">
                        <img class="dark-mode-boton" src="/build/img/dark-mode.svg" alt="boton modo oscuro"/>
                        <nav class="navegacion">
                        <?php if(!$auth): ?>
                            <a href="/login">Ingresa al registro</a>
                        <?php endif; ?>  
                            <?php if($auth): ?>
                                <a href="/logout">Cerrar Sesión</a>
                            <?php endif; ?>
                        </nav>
                    </div><!--  .barra -->
                    
                </div>
             
            <?php
                    echo $inicio ? "<a href=\"/login\"  class=\"lugartexto\" >Registro de Bitacora para laboratorios de Idiomas</a>" : '';//esta inea hace lo mismo que la de arriba
                ?>
            </div>    
        </header>

        <?php echo $contenido ?>

        <footer class="footer seccion">
            <div class="contenedor contenedor-footer">
                <nav class="navegacion">
                <a href="/">Créditos</a>
                    
                </nav>
            </div>
            <p class="copyright">
                Todos los Derechos Reservados <?php echo date('Y');?> &copy;
            </p>
        </footer>
        <script src="../build/js/bundle.min.js"></script>
    </body>
</html>