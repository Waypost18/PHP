<?php
require("conexion.php");
session_start();
    if(isset($_SESSION['usuario'])){
        $conexion = conectar();
        $sql = 'SELECT * FROM libro WHERE id_libro= \'' .$_GET['id']. '\'';
        $resultado = mysqli_query($conexion, $sql);
        desconectar($conexion);
        $fila=mysqli_fetch_array($resultado);
        if(isset($_SESSION['carrito'])){
            $arreglo = $_SESSION['carrito'];
            $cant = count($arreglo);
            $arreglo[$cant]['id_libro'] = $fila['id_libro'];
            $arreglo[$cant]['titulo'] = $fila['titulo'] ;
            $arreglo[$cant]['autor'] = $fila['autor'];
            $arreglo[$cant]['genero'] = $fila['genero'];
            $arreglo[$cant]['portada'] = $fila['portada'];
            $arreglo[$cant]['paginas'] = $fila['paginas'];
        }else{
            $arreglo[0]['id_libro'] = $fila['id_libro'];
            $arreglo[0]['titulo'] = $fila['titulo'] ;
            $arreglo[0]['autor'] = $fila['autor'];
            $arreglo[0]['genero'] = $fila['genero'];
            $arreglo[0]['portada'] = $fila['portada'];
            $arreglo[0]['paginas'] = $fila['paginas'];
        }
        $_SESSION['carrito'] = $arreglo;
        echo '<p> Se guardo producto en el carrito </p>';
        header('refresh:3; url=libro_listado.php');
    }else {
    echo '<h2>No se inicio sesion </h2>';
    header('refresh:3; url="../index.php"');}









?>