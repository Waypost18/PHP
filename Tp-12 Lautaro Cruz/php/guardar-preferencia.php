<?php
    session_start();
    if(!empty($_SESSION['usuario']) && !empty($_POST)){
        $unido = implode('-',$_POST);
        $usuario = $_SESSION['usuario'];
        $time_expira = time() + 30 * 24 * 60 * 60;
        setcookie($usuario , $unido , $time_expira, '/');
        header('refresh:0; url=libro_listado.php');
    }


?>

