<?php


function conectar(){
    $servidor = 'localhost:3306'; // el puerto de mi pc
    $usuario = 'root';  // usuario por default
    $clave = '';
    $db = 'labo2'; // nombre de la base de datos
    $conexion = mysqli_connect($servidor, $usuario, $clave, $db); // se conecta con la base de datos
    if(!$conexion){
        echo '<p>Error</p>';
    }else{
        return($conexion);
    }
}

function desconectar($conexion){ // llama a la funcion conectar para desconectar la base de datos.
    if($conexion){
        $desco = mysqli_close($conexion);
        if($desco){
            //echo '<p>Desconexion exitosa </p>';
        }else{
            //echo '<p>Error al intentar desconectar</p>';
        }
    }else {
       // echo '<p>No se puede desconectar, no existe coneccion</p>';
    }
}

function mostrarcookie($preferencia){
    $conexion = conectar();
    if(!empty($preferencia)){
        $prefe = explode('-',$preferencia);
        $consulta = 'SELECT *FROM libro WHERE genero = \''.$preferencia.'\'';

    }else {
        $consulta = 'SELECT *FROM libro WHERE genero';
    }
    $resultado = mysqli_query($conexion,$consulta);
    $desconectar=($conexion);
    $numFilas = mysqli_num_rows($resultado);
    if($numFilas > 0){
        echo '<section id="libros">';
        while ($fila = mysqli_fetch_array($resultado)) {
            echo '<article>';
            if ($fila['portada'] !='') {
                $foto = $fila['portada'];
            } else {
                $foto = 'libro_default.png';
            }
            echo "<figure><img src='../img/portadas/".$foto."' alt='portada de libro'>";
            echo '<figcaption>'.$fila['titulo'].'</figcaption></figure>';
            echo '<section>';
            echo '<p>'.$fila['autor'].'</p>';
            echo '<p>'.$fila['genero'].'</p>';
            echo '<p>Páginas: '.$fila['paginas'].'</p>';
            echo '</section>';
            echo '</article>';                
        }
    }
}
function agregarCarrito($id){
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
            $arreglo[$cant]['paginas'] = $fila['paginas'];
        }else{
            $arreglo[0]['id_libro'] = $fila['id_libro'];
            $arreglo[0]['titulo'] = $fila['titulo'] ;
            $arreglo[0]['autor'] = $fila['autor'];
            $arreglo[0]['genero'] = $fila['genero'];
            $arreglo[0]['paginas'] = $fila['paginas'];
        }
        $_SESSION['carrito'] = $arreglo;
        echo 'se agrego correctamente';
        header('refresh:0; url="libro_listado.php"');
    }else{
        echo 'no agrego nada al carrito';
        header('refresh:0; url="libro_listado.php"');
    }
    }
?>