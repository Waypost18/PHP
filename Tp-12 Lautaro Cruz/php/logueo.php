<?php

session_start();

if (!empty($_POST['usuario']) && !empty($_POST['pass'])) {
    include ('conexion.php');
    $conexion = conectar();
    if ($conexion){
        $usu = $_POST['usuario'];
        $clave = sha1($_POST['pass']);
        $consulta = 'SELECT usuario,foto,tipo
                        FROM usuario
                        WHERE usuario = \''.$usu. '\' AND pass = \''.$clave.'\'';
        $resultado = mysqli_query($conexion, $consulta);
        $numfilas = mysqli_num_rows($resultado);
        if($numfilas > 0){
            $fila = mysqli_fetch_array($resultado);
            echo '<p>Usuario y Clave correctos</p>';
            $_SESSION['usuario'] = $fila['usuario'];
            $_SESSION['foto'] = $fila['foto'];
            $_SESSION['tipo'] = $fila['tipo'];
            header("refresh:0;url=libro_listado.php");
        }else{
            echo '<p>Usuario o Clave incorrectos</p>';
            header("refresh:2;url=../index.php");

        }
        /*if($q){
            echo '<p>Guardado exitoso</p>';
        }else{
            echo '<p>Error al guardar</p>';
        }*/
        desconectar($conexion);
    }
    //hacer cuestiones
    
}else {
    echo '<h2>No se inicio sesion </h2>';
    header('refresh:3; ../html/index.html');
}

?>