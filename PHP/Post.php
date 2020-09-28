<?php
session_start();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <?php
        require_once('head.php');
    ?>
    <title><?php ?></title>
</head>
    <body>
        <?php
            require_once('../PHP/navbar.php');
            require_once('../DB/Conectar.php');
        ?>
    <main>

        <div class="container tarjeta">

                <?php
                    if (isset($_GET['IDimagen'])) {
                        $id = $_GET['IDimagen'];
                        $conn = New Conexion;
                        $conn->aumentarCantVisitas($id);
                        $result = $conn->getImagen($id);

                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<h2>".$row['Titulo']."</h2>";
                            echo "<div class='divImagenCompleta'><img class='imagenCompleta' src='".$row['URI']."'></div>";
                            echo "<div class='card bg-transparent border-dark' style='width: 100%;''>";
                            echo "<div class='card-header'>Usuario: ".$row['Nick']."</div>";
                            echo "<div class='card-body'>".$row['Descripcion']."";
                            echo "<h5 class='mt-2'>Tags</h5>";
                            echo "<p>".$row['Tags']."</p>";
                            echo "</div>";
                            echo"</div>";
                        }
                    }

                    echo "<h2>Seccion de comentarios en construccion...</h2>";

                ?>
            
        </div>
        


        <?php
            include('PHP/JS.php');
        ?>
    </body>
</main>
</html>