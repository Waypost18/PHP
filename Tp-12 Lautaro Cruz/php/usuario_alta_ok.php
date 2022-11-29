<?php
    session_start();
    require("../html/header.html");
    require("conexion.php");
    $ruta = '../css';

    
    $conexion = conectar();
    if(!empty($_SESSION['usuario']) && ($_SESSION['tipo'] == 'Administrador')){

   
    if(!empty($_POST['usuario']) && !empty($_POST['pass'])&& !empty($_POST['tipo']) || !empty($_FILES['foto']['size']) ){
        $usu = trim($_POST['usuario']); //controlamos los datos y les ponemos variables
        $contra = trim($_POST['pass']);
        $contra = sha1($_POST['pass']);
        $tipo = trim($_POST['tipo']);
        $foto = trim($_FILES['foto']['name']);
        $foto = explode('.',$foto);
        $newName=$usu.'.'.$foto[1];
    if($conexion){
        $consulta = 'SELECT usuario,tipo,foto FROM usuario'; // iniciamos la cosulta de si existe el nombre de usuario
                    $resultado = mysqli_query($conexion, $consulta );
                    $numfila = mysqli_num_rows($resultado);
                    $fila = mysqli_fetch_array($resultado);
        if($fila['usuario'] != $usu){ //si no existe el nombre de usuario
            
            $insert= 'INSERT INTO usuario(usuario, pass, tipo, foto) 
            VALUE (\''.$usu.'\',\''.$contra.'\',\''.$tipo.'\',\''.$newName.'\')';
        $q=mysqli_query($conexion,$insert); // crea el nuevo usuario insertando los datos a la tabla

        if ($q) {
            echo 'guardado con exito'; // guarda con exito los datos
            header("refresh:0;url=usuario_listado.php");
        } else {
            echo 'error al guardar';
            header("refresh:2;url=usuario_alta.php");
        }
        if(($_FILES['foto']['size']>0)){
            $origen = $_FILES['foto']['tmp_name'];
            $destino = '../img/usuarios/'.$newName;
            $envio = move_uploaded_file($origen,$destino);
        }else{

        }
    }else{
        echo 'error usuario ya utilizado'; // si exite el usuario da error
        header("refresh:2;url=usuario_alta.php");
    }
        }
        
    }
   

    desconectar($conexion);
    }else {
        echo '<h2>Usted no es administrador </h2>';
        header('refresh:3; ../html/index.html');
    }
 require("../html/footer.html");






















?>