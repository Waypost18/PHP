<?php
    session_start();
    $ruta = '../css';
    require("../html/header.html");
    require("conexion.php");
    $conexion = conectar();

    if(!empty($_SESSION['usuario'])){
        if(!empty($_POST['usuario']) && !empty($_POST['pass']) && !empty($_POST['tipo'])){
            $usu = trim($_POST['usuario']); //controlamos los datos y les ponemos variables
            $contra = trim($_POST['pass']);
            $contra = sha1($_POST['pass']);
            $tipo = trim($_POST['tipo']);
            $foto=trim($_FILES['foto']['name']);
            $foto = explode('.',$foto);
            $newName=$usu.'.'.$foto[1];
        if($conexion && isset($_POST['id'])){
            $id = $_POST['id'];
            $consulta = 'UPDATE usuario
                         SET usuario = \''. $usu . '\',
                         pass = \'' . $contra . '\',
                          tipo = \'' . $tipo . '\',
                         foto = \'' . $newName . '\'
                         WHERE id_usuario = ' . $id . '';
            $resultado = mysqli_query($conexion ,$consulta);
            if(($_FILES['foto']['size']>0)){
                $origen = $_FILES['foto']['tmp_name'];
                $destino = '../img/usuarios/'.$newName;
                $envio = move_uploaded_file($origen,$destino);
            }
            if($resultado){
                echo '<p>Actualizacion exitosa</p>';
                header("refresh:0;url=usuario_listado.php");
            }
        }else{
            echo 'no se puede modificar el registro';
        }
       }
        desconectar($conexion);
    }else {
        echo '<h2>No se inicio sesion </h2>';
        header('refresh:3; ../html/index.html');
    }
    







?>