<?php
    session_start();
    $ruta = '../css';
    require("../html/header.html");
    require("conexion.php");
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    setlocale(LC_ALL,'spanish');
    $fecha = strftime('%A %d de %B de %Y');

    if(!empty($_SESSION['usuario']) && ($_SESSION['tipo'] == 'Administrador')){
        $conexion = conectar();
            if($conexion){
                $consulta = 'SELECT DISTINCT(genero) FROM libro';
                $resultado = mysqli_query($conexion, $consulta );
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
        <article>
            <section class="menu_tmp">
                <p>Opción: Libros > Alta Libros</p>
            </section>
            <form action="libro_alta_ok.php" method="post" enctype="multipart/form-data" id="form.alta.libro">
                <legend>Alta libro</legend>     
                <section>
                    <label for="titulo">Titulo</label>
                    <input type="text" name="titulo" id="titulo" placeholder="Titulo del Libro" required maxlength="45">
                    <label for="autor">Autor</label>
                    <input type="text" name="autor" id="autor" placeholder="Autor del Libro" required maxlength="45">
                    <label for="paginas">Cantidad de Paginas del Libro</label>
                    <input type="number" name="paginas" id ="paginas" placeholder="Cantidad de Paginas del Libro">
                    <label for="fecha">Fecha de Publicacion del Libro</label>
                    <input type="date" name="fecha" id="fecha">
                    <fieldset>Elige tu genero favorito</fieldset>
                    <select name="genero">
                    <?php
                        while($fila = mysqli_fetch_array($resultado)){  
                            if($fila)               
                            echo '<option>'. $fila['genero'].'</option>';
                        }
                    }
                    ?> 
                    </select>
                    <label for="portada">Portada del Libro</label>
                    <input type="file" name="portada" accept="image/jpge" id="portada">
                    <section id="boton">
                        <input type="submit" name="enviar" value="Confirmar">
                    </section>
                </section>
            </form>
        </article>
    </section>
</main>

<?php
    }else {
        echo '<h2>Usted no es administrador</h2>';
        header('refresh:3; ../index.php');
    }
    require("../html/footer.html");
?>