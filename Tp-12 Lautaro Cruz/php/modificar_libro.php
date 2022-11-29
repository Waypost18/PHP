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

    if($conexion && isset($_GET['id'])){
        $id = $_GET['id'];
        $consulta = 'SELECT *FROM libro WHERE id_libro= \''. $id .'\'';
        $resultado = mysqli_query($conexion , $consulta);
        $numfila = mysqli_num_rows($resultado);
        if($numfila > 0){
            $fila = mysqli_fetch_array($resultado);

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
    </section>
    <section>
        <article>
        <form action="modificar_libro_ok.php" method="post" enctype="multipart/form-data">
                <legend>Modificar libro</legend>     
                <section>
                    <label for="titulo">Titulo</label>
                    <input type="text" name="titulo" value="<?php echo $fila['titulo'] ?>" id="titulo" placeholder="Titulo del Libro" required maxlength="45">
                    <label for="autor">Autor</label>
                    <input type="text" name="autor" id="autor" value="<?php echo $fila['autor'] ?>" placeholder="Autor del Libro" required maxlength="45">
                    <label for="paginas">Cantidad de Paginas del Libro</label>
                    <input type="number" name="paginas" value="<?php echo $fila['paginas'] ?>" id ="paginas" placeholder="Cantidad de Paginas del Libro">
                    <label for="fecha">Fecha de Publicacion del Libro</label>
                    <input type="date" name="fecha" value="<?php echo $fila['fecha_publicacion'] ?>" id="fecha">
                    <fieldset>Elige tu genero favorito</fieldset>
                    <select name="genero">
                    <?php
                        if($conexion){
                            $consulta = 'SELECT DISTINCT(genero) FROM libro';
                            $resultado = mysqli_query($conexion, $consulta );
                            $fila = mysqli_fetch_array($resultado);
                        while($fila = mysqli_fetch_array($resultado)){  
                            if($fila)               
                            echo '<option>'. $fila['genero'].'</option>';
                        }
                     }
                    }
                    ?> 
                    </select>
                    <label for="portada">Portada del Libro</label>
                    <input type="file" name="portada" accept="image/jpge" id="portada">
                    <section id="boton">
                        <input type="hidden" value="<?php echo $id?>" name="id">
                        <input type="submit" name="enviar" value="Confirmar">
                    </section>
                </section>
            </form>
        </article>
    </section>
</main>
<?php
        }
     
        }
    else {
        echo '<h2>No se inicio sesion </h2>';
        header('refresh:3; ../php/index.php');
    }
    desconectar($conexion);
    require("../html/footer.html");
    











?>