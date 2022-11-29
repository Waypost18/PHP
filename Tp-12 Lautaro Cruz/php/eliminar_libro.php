<?php
    session_start();
    require("../html/header.html");
    require("conexion.php");
    $ruta = '../css';
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    setlocale(LC_ALL,'spanish');
    $fechaActual = strftime('%A %d de %B de %Y');


    $conexion = conectar();
    if(!empty($_SESSION['usuario']) && ($_SESSION['tipo'] == 'Administrador')){
        if($conexion && !empty($_GET['id'])){
            $id = $_GET['id'];
            $consulta = 'SELECT titulo  FROM libro
                         WHERE id_libro= \''.$id.'\'';
            $resultado = mysqli_query($conexion, $consulta);
            $numfila = mysqli_num_rows($resultado);
            if($numfila > 0){
                $fila = mysqli_fetch_array($resultado);
                echo '<section>';
                echo '<h2 id="elimina">Eliminar Libro:</h2>';
                echo '<article><p id="eliminado">Esta seguro que desea eliminar el libro : ' .$fila['titulo']. '</p>';
                echo '<a class="enlace_boton2" href ="libro_borrado.php?id=' .$id.'">Aceptar</a>';
                echo '<a class="enlace_boton2" href="libro_listado.php">Cancelar</a></article>'; 
                echo '</section></main>';
               }
            desconectar($conexion);
           }
    }else{
        echo '<p>No es adm </p>';
        }


















?>