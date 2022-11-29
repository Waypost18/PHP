<?php
    session_start();
    $ruta = '../css';
    require("../html/header.html");
    require("conexion.php");
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    setlocale(LC_ALL,'spanish');
    $fechaActual = strftime('%A %d de %B de %Y');
    $conexion= conectar();
    if(!empty($_SESSION['usuario'])){
        $usuario = $_SESSION['usuario'];




?>
<header>
    <p><?php echo ucfirst($fechaActual)?></p>
</header>
<section id="main_aside">
    <aside>
        <?php
            require_once('menu.php');
        ?>
    </aside>
    <main>
        
        <?php
            if(!empty($_COOKIE[$usuario]) && isset($_COOKIE[$usuario])){
                mostrarCookie($_COOKIE[$usuario]);
            }
    
            }else {
                echo '<h2>No se inicio sesion </h2>';
                header('refresh:3; ../html/index.html');}
        ?>
        
    </main>
<?php
    require("../html/footer.html");


?>