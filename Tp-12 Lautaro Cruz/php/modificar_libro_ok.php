<?php
    session_start();
    $ruta = '../css';
    require("../html/header.html");
    require("conexion.php");
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    setlocale(LC_ALL,'spanish');
    $fecha = strftime('%A %d de %B de %Y');
    $conexion = conectar();
    if(!empty($_SESSION['usuario']) && ($_SESSION['tipo'] == 'Administrador')){

        if(!empty($_POST['titulo']) && !empty($_POST['autor']) && !empty($_POST['paginas']) && !empty($_POST['fecha']) && !empty($_POST['genero']) && !empty($_FILES['portada']['size'])){
            $titulo = trim($_POST['titulo']);
            $autor = trim($_POST['autor']);
            $paginas = trim($_POST['paginas']);
            $fecha = trim($_POST['fecha']);
            $prefe = trim($_POST['genero']);
            $foto = trim($_FILES['portada']['name']);
            $foto = explode('.',$foto);
            $newName=$titulo.'.'.$foto[1];
            if($conexion && isset($_POST['id'])){
                $id = $_POST['id'];
            $consulta = 'UPDATE libro
                         SET titulo = \''. $titulo . '\',
                         autor = \'' . $autor . '\',
                          genero = \'' . $prefe . '\',
                         paginas = \'' . $paginas . '\',
                         fecha_publicacion = \'' . $fecha . '\',
                         portada = \'' . $newName . '\'
                         WHERE id_libro = ' . $id . '';
            $resultado = mysqli_query($conexion ,$consulta);
            if(($_FILES['portada']['size']>0)){
                $origen = $_FILES['portada']['tmp_name'];
                $destino = '../img/portadas/'.$newName;
                $envio = move_uploaded_file($origen,$destino);
            }
            if($resultado){
                echo '<p>Actualizacion exitosa</p>';
                header("refresh:0;url=usuario_listado.php");
            }

            }
        }else if(!empty($_POST['titulo']) && !empty($_POST['autor']) && !empty($_POST['paginas']) && !empty($_POST['fecha']) && !empty($_POST['genero'])){
            $titulo = trim($_POST['titulo']);
                $autor = trim($_POST['autor']);
                $paginas = trim($_POST['paginas']);
                $fecha = trim($_POST['fecha']);
                $prefe = trim($_POST['genero']);
                if($conexion && isset($_POST['id'])){
                    $id = $_POST['id'];
                $consulta = 'UPDATE libro
                             SET titulo = \''. $titulo . '\',
                             autor = \'' . $autor . '\',
                              genero = \'' . $prefe . '\',
                             paginas = \'' . $paginas . '\',
                             fecha_publicacion = \'' . $fecha . '\'
                             WHERE id_libro = ' . $id . '';
                $resultado = mysqli_query($conexion ,$consulta);
        }
        header('refresh:0; ../php/libro_listado.php');
        desconectar($conexion);
      }


    }else{
        echo '<p>No se inicio Seccion</p>';
    }





























?>