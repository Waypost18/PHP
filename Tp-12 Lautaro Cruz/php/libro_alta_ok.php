<?php

    session_start();
    require("../html/header.html");
    require("conexion.php");
    $ruta = '../css';


    $conexion = conectar();
    if(!empty($_SESSION['usuario']) && ($_SESSION['tipo'] == 'Administrador')){
        if(!empty($_POST['titulo']) && !empty($_POST['autor'])&& !empty($_POST['paginas'])&& !empty($_POST['fecha']) && !empty($_POST['genero']) && !empty($_FILES['portada']['size']) ){
            $titulo = trim($_POST['titulo']);
            $autor = trim($_POST['autor']);
            $paginas = trim($_POST['paginas']);
            $fecha = trim($_POST['fecha']);
            $prefe = trim($_POST['genero']);
            $foto = trim($_FILES['portada']['name']);
            $foto = explode('.',$foto);
            $newName=$titulo.'.'.$foto[1];
            if($conexion){
                $insert= 'INSERT INTO libro(titulo, autor, genero, paginas,fecha_publicacion,portada) 
                VALUE (\''.$titulo.'\',\''.$autor.'\',\''.$prefe.'\',\''.$paginas.'\',\''.$fecha.'\',\''.$newName.'\')';
                echo $insert;
                $q=mysqli_query($conexion,$insert);
                if(($_FILES['portada']['size']>0)){
                    $origen = $_FILES['portada']['tmp_name'];
                    $destino = '../img/portadas/'.$newName;
                    $envio = move_uploaded_file($origen,$destino);
                }
                header('refresh:0; ../php/libro_listado.php');
            }
        }else if(!empty($_POST['titulo']) && !empty($_POST['autor'])&& !empty($_POST['paginas'])&& !empty($_POST['fecha']) && !empty($_POST['genero']) && empty($_FILES['portada']['size']) ){
                $titulo = trim($_POST['titulo']);
                $autor = trim($_POST['autor']);
                $paginas = trim($_POST['paginas']);
                $fecha = trim($_POST['fecha']);
                $prefe = trim($_POST['genero']);
                $foto = 'libro_default.png';
                if($conexion){
                    if($fila['id_libro'] != $usu){
                    $insert= 'INSERT INTO libro(titulo, autor, genero, paginas,fecha_publicacion,portada) 
                    VALUE (\''.$titulo.'\',\''.$autor.'\',\''.$prefe.'\',\''.$paginas.'\',\''.$fecha.'\',\''.$foto.'\')';
                    }
                    echo $insert;
                    $q=mysqli_query($conexion,$insert);
                    header('refresh:0; ../php/libro_listado.php');
                }
            desconectar($conexion);
        }
    }else {
        echo '<p>no inicio sesion</p>';
    }



































?>