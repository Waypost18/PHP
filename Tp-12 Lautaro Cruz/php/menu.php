<?php

    if(($_SESSION['foto'] == '')){
        $_SESSION['foto'] = 'usuario_default.png';
    }

    if(!empty($_SESSION['usuario'] )){ 
            echo '<nav>
                        <img class="usu" src="../img/usuarios/' .$_SESSION['foto'] . '"
                        <h3>' .$_SESSION['usuario']. '</h3>
                        <a href="cerrar.php">Cerrar sesion</a>
                 <nav>';
    }

?>
<nav>
    <?php
        if($_SESSION['tipo'] == 'Administrador'){
        echo '<nav>
                    <h3>Usuarios</h3>
                    <ul>
                    <a href="usuario_alta.php"><li>Alta usuario</li></a> 
                    <a href="usuario_listado.php"><li>Listado usuarios</li></a>  
                    </ul>
              </nav>';
    }
    ?>
    <h3>Libros</h3>
    <ul>
        <a href="libro_listado.php"><li>Listado libros</li></a>
    </ul>
    <ul>
        <a href="preferencias.php"><li>Preferencias</li></a>
    </ul>
    <ul>
        <a href="listado-favorito.php"><li>Listar Favoritos</li></a>
    </ul>
    <?php
         if($_SESSION['tipo'] == 'Administrador'){
            echo '<ul>
            <a href="libro_alta.php"><li>Alta Libro</li></a>
        </ul>';
         } 
    ?>
    
</nav>