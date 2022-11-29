<?php
    session_start();
    $ruta = '../css';
    require("../html/header.html");
    require("conexion.php");
    $conexion = conectar();
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    setlocale(LC_ALL,'spanish');
    $fecha = strftime('%A %d de %B de %Y');
    if(!empty($_SESSION['usuario']) && ($_SESSION['tipo'] == 'Administrador')){

   
?>

<main>
    <section id="main_aside">
    <aside>
        <?php
            require_once('menu.php');
        ?>
    </aside>
    <section>
        <h2><?php echo $fecha;?></h2>
        <article>
            <section class="menu_tmp">
                <a class="enlace_boton" href="usuario_alta.php">Alta usuario</a>
            </section>
            <table>
                <caption>Listado de usuarios</caption>
                <tr>
                    <th>Foto</th>
                    <th>Usuario</th>
                    <th>Tipo</th>
                    <th>Modificar</th>
                    <th>Eliminar</th>
                </tr>
                
                <?php
                    $consulta = 'SELECT id_usuario,usuario,tipo,foto FROM usuario'; // hace la consulta del los datos de la tabla
                    $resultado = mysqli_query($conexion, $consulta ); //ejecucion de la consulta
                    $numfila = mysqli_num_rows($resultado); // devuelve los valores de la consulta
                    $default = 'usuario_default.png';
                    $modificar = 'modificar.png';
                    $eliminar = 'eliminar.png';

                    if($numfila > 0){
                        while($fila = mysqli_fetch_array($resultado)){ // los transforma en un array enumerado
                            if(empty($fila['foto'])){ //controlamos que tenga la foto
                                echo '<tr>';
                            echo '<td> <img src="../img/usuarios/' . $default.'"></td>';
                            echo '<td>' . $fila['usuario'].'</td>';
                            echo '<td>' . $fila['tipo'].'</td>';
                            echo '<td><a href="modificar.php?id=' .$fila['id_usuario'] .'"><img src="../img/' .$modificar. '"</td>';
                            echo '<td><a href="borrar.php?id=' .$fila['id_usuario'] .'"><img src="../img/' .$eliminar. '"</td>';
                            echo '</tr>';
                            }else{ //si no la tiene devuelve el dafault
                                echo '<tr>';
                                echo '<td> <img src="../img/usuarios/' . $fila['foto'].'"></td>';
                                echo '<td>' . $fila['usuario'].'</td>';
                                echo '<td>' . $fila['tipo'].'</td>';
                                echo '<td><a href="modificar.php?id=' .$fila['id_usuario'] .'"><img src="../img/' .$modificar. '"</td>';
                                echo '<td><a href="borrar.php?id=' .$fila['id_usuario'] .'"><img src="../img/' .$eliminar. '"</td>';
                                echo '</tr>';
                            }
                        }
                    }
                ?>
                </tr>
            </table>
        </article>
    </section>
</main>

<?php
    desconectar($conexion);
    }else {
        echo '<h2>Usted no es administrador</h2>';
        header('refresh:3; ../html/index.html');
    }
    require("../html/footer.html");
?>