<?php
    session_start();
    require('../html/header.html');
    if(!empty($_SESSION['usuario'])){
        echo '<h2>Esta cerrando sesion</h2>';
        session_destroy();
        header('refresh:4;../index.php');
    }else{
        echo '<h2>No inicio sesion<h2>';
        header('refresh:4;../index.php');

    }




    require('../html/footer.html');
?>