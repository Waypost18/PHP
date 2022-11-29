<?php
    session_start();
    require("conexion.php");
    $conexion = conectar();
    if(!empty($_SESSION['usuario']) && ($_SESSION['tipo'] == 'Administrador')){
        if($conexion && !empty($_GET['id'])){
            $id = $_GET['id'];
            $consulta = 'DELETE FROM libro WHERE id_libro = \''. $id .'\'';
            $resultado = mysqli_query($conexion,$consulta);
            desconectar($conexion);
            if($resultado){
                echo '<p>Eliminacion Exitosa!</p>';
                header("refresh:2;url=libro_listado.php");
            }else{
                echo '<p>No se pudo eliminar</p>';
                header("refresh:2;url=libro_listado.php");
            }
        }else{
            echo'<p>No se realizo la elimnacion</p>';
            header("refresh:2;url=libro_listado.php");
        }    

    }else {
        echo '<h2>No se inicio sesion </h2>';
        header('refresh:3; ../php/index.php');
    }
    
   
   





?>