<?php
       session_start();
       $ruta = '../css';
       require("../html/header.html");
       require("conexion.php");
       date_default_timezone_set('America/Argentina/Buenos_Aires');
       setlocale(LC_ALL,'spanish');
       $fecha = strftime('%A %d de %B de %Y');
       $conexion = conectar();

       if(!empty($_SESSION['usuario'])){
              if($conexion && !empty($_GET['id'])){
                     $id = $_GET['id'];
                     $consulta = 'SELECT usuario  FROM usuario
                                  WHERE id_usuario= \''.$id.'\'';
                     $resultado = mysqli_query($conexion, $consulta);
                     $numfila = mysqli_num_rows($resultado);
                     if($numfila > 0){
                         $fila = mysqli_fetch_array($resultado);
                         echo '<main><section><h2>' .$fecha. '</h2></section>';
                         echo '<section>';
                         echo '<h2 id="elimina">Eliminar usuario</h2>';
                         echo '<article><p id="eliminado">Esta seguro que desea eliminar al usuario ' .$fila['usuario']. '</p>';
                         echo '<a class="enlace_boton2" href ="borrado.php?id=' .$id.'">Aceptar</a>';
                         echo '<a class="enlace_boton2" href="usuario_listado.php">Cancelar</a></article>'; 
                         echo '</section></main>';
                        }
                     desconectar($conexion);
                    }
       }else {
              echo '<h2>No se inicio sesion </h2>';
              header('refresh:3; ../html/index.html');
          }
       
       
       require("../html/footer.html");

?>

