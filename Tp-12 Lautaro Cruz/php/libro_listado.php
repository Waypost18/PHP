<?php
    session_start();
    $ruta = '../css';
    require("../html/header.html");
    require("conexion.php");
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    setlocale(LC_ALL,'spanish');
    $fechaActual = strftime('%A %d de %B de %Y');
    if(!empty($_SESSION['usuario'])){

    
?>
<header>
    <p><?php echo ucfirst($fechaActual) ?></p>
    <a href="carrito_ver.php">
        <figure><img src="../img/carrito.png"></figure></a>
</header>
<section id="main_aside">
    <aside>
        <?php
            require_once('menu.php');
        ?>
    </aside>
    <main>
    <?php
            require_once('../html/buscador.html');
            ?>
        <section id="libros">
            <?php
                $conexion = conectar();
                $resultado = mysqli_query($conexion, "SELECT * FROM libro");

                while ($fila = mysqli_fetch_array($resultado)) {
                    echo '<article>';
                    if ($fila['portada'] !='') {
                        $foto = $fila['portada'];
                    } else {
                        $foto = 'libro_default.png';
                    }
                    echo "<figure><img src='../img/portadas/".$foto."' alt='portada de libro'>";
                    echo '<figcaption>'.$fila['titulo'].'</figcaption></figure>';
                    echo '<section>';
                    echo '<p>'.$fila['autor'].'</p>';
                    echo '<p>'.$fila['genero'].'</p>';
                    echo '<p>Páginas: '.$fila['paginas'].'</p>';
                    echo '<p class="enlace_carrito"><a href="carrito_agregar.php?id='.$fila['id_libro'].'">Agregar al Carrito</a></p>';
                    if($_SESSION['tipo'] == 'Administrador'){
                    echo '<section class="botones_ud">';
                    echo '<figure><a href="eliminar_libro.php?id='.$fila['id_libro'].'"><img src ="../img/eliminar.png"></a></figure>';
                    echo '<figure><a href="modificar_libro.php?id='.$fila['id_libro'].'"><img src ="../img/modificar.png"></a></figure>';
                    echo '</section>';
                    }
                    echo '</section>';
                    echo '</article>';                
                }
                desconectar($conexion);
            ?>
        </section>
    </main>
</section>
<?php
    }else {
        echo '<h2>No se inicio sesion </h2>';
        header('refresh:3; url="../index.php"');
    }
    require("../html/footer.html");
?>