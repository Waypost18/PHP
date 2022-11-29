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

    if($conexion && isset($_GET['id'])){
        $id = $_GET['id'];
        $consulta = 'SELECT *FROM usuario WHERE id_usuario= \''. $id .'\'';
        $resultado = mysqli_query($conexion , $consulta);
        $numfila = mysqli_num_rows($resultado);
        if($numfila > 0){
            $fila = mysqli_fetch_array($resultado);

?>
<main>
    <section>
        <h2><?php echo $fecha;?></h2>
        <article>
            <form action="modificado.php" method="post" enctype="multipart/form-data">
                <legend>Modificar Usuario</legend>     
                <section>
                    <label for="usuario">Usuario</label>
                    <input type="text" value = "<?php echo $fila['usuario']?>" name="usuario" id="usuario">
                    <label for="pass">Contraseña</label>
                    <input type="password" name="pass" id="pass" value="" id="pass">
                    <label for="tipo">Tipo</label>
                    <select name="tipo" id="tipo" >
                        <option value="Administrador">Administrador</option>
                        <option value="Común">Común</option>
                    </select>
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" accept="image/jpge" id="foto" value="<?php echo $fila['foto']?>">
                    <section id="boton">
                        <input type="hidden" value="<?php echo $id?>" name="id">
                        <input type="submit" name="btnaceptar"  value="Actualizar">
                        
                    </section>
                </section>
            </form>
            <a href="usuario_listado.php">
                        <input type="submit"  name="btncancelar"value="Cancelar">
                        </a>
        </article>
    </section>
</main>
<?php
        }
     
        }
    }else {
        echo '<h2>No se inicio sesion </h2>';
        header('refresh:3; ../html/index.html');
    }
    desconectar($conexion);
    require("../html/footer.html");
    

?>