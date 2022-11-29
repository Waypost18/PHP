<?php
    session_start();
    $ruta = '../css';
    require("../html/header.html");
    require("conexion.php");
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    setlocale(LC_ALL,'spanish');
    $fechaActual = strftime('%A %d de %B de %Y');
    $conexion= conectar();
    if(!empty($_SESSION['usuario'])){
        if($conexion){
            $consulta = 'SELECT DISTINCT(genero) FROM libro';
            $resultado = mysqli_query($conexion, $consulta );
            $fila = mysqli_fetch_array($resultado);
            
            
            
        
    
?>
<header>
    <p><?php echo ucfirst($fechaActual)?></p>
</header>
<section id="main_aside">
    <aside>
        <?php
            require_once('menu.php');
        ?>
    </aside>
    <main>
        <h1>Preferencias</h1>
        <form action="guardar-preferencia.php" method="post">
            <h2>Genero Favorito</h2>
            <fieldset>Elige tu genero favorito</fieldset>
                <select name="favorito">
                <?php
                    while($fila = mysqli_fetch_array($resultado)){  
                        if($fila)               
                        echo '<option>'. $fila['genero'].'</option>';
                    }
                ?> 
                </select>
                <input type="submit" value="Guardar">
        </form>
    </main>
</section>

<?php
            
        }

    }
    require('../html/footer.html')
?>