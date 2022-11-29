<?php 
    session_start();
    $ruta = '../css';
    require("../html/header.html");
    require("conexion.php");
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    setlocale(LC_ALL,'spanish');
    $fechaActual = strftime('%A %d de %B de %Y');
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
<?php
    if(!empty($_SESSION['carrito'])){
        $carrito = $_SESSION['carrito'];
        echo '<main>';
        $tama = count ($carrito);
        echo '<h3> Su Carrito contiene : </h3>';
        echo '<table><tr><th>Titulo</th><th>Autor</th><th>Genero</th>';
        echo '<th>Portada</th>';
        $suma = 0;
        for($i = 0;$i<$tama;$i++){
            if ($carrito[$i]['portada'] !='') {
                $foto = $carrito[$i]['portada'];
            } else {
                $foto = 'libro_default.png';
            }
            echo '<tr><td class="">'.$carrito[$i]['titulo']. '</td>';
            echo '<td class="">'.$carrito[$i]['autor']. '</td>';
            echo '<td class="">'.$carrito[$i]['genero']. '</td>';
            echo '<td class=""><img src="../img/portadas/'.$foto. '"></td></tr>';
        }
    }else{
        echo '<p>Carrito vacio</p>';
    }
?>
</section>
<?php
 require("../html/footer.html");
?>