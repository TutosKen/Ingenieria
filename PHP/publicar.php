<?php
session_start();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <?php
        require_once('head.php');
    ?>
    <title>Animales</title>
</head>
    <body>
        <?php
            require_once('navbar.php');
            require_once('../DB/Conectar.php');
            $conn = New Conexion;

            $result = $conn->getCategorias();
        ?>
    <main>

        <div class="container">
            <div class="row">
                <div class="col-12 m-auto" style="height:50vh;">
                    <img class="subirImagen" src="/Animales/img/imgsPagina/default.jpg" id="preview">
                </div>

                <div class="col-2 m-auto" style="margin-top:10px!important;">
                    <label for="subirImagen" class="estiloLabel">Seleccionar Imagen</label>
                    <input class="esconder" type="file" id="subirImagen" onchange="preview(event);">
                </div>

                <div class="col-10" style="margin-top:10px!important;"> 
                    <input id="URI" type="text" placeholder="O ingresa una URI" class="form-control inputRes">
                </div>

                <div class="col-12 m-auto" style="margin-top:10px!important;">
                    <input type="text" placeholder="Titulo" class="form-control">
                </div>

                <div class="col-12 m-auto" style="margin-top:10px!important;">
                    <textarea placeholder="Descripcion" class="form-control" name="" id="" cols="30" rows="6"></textarea>
                </div>

                <div class="col-12 m-auto" style="margin-top:10px!important;"> 
                    <textarea placeholder="Tags separados por coma(,)" class="form-control" name="" id="" cols="30" rows="3"></textarea>
                </div>
            </div>
        </div>

        <div class="container mt-4 tarjeta">
            <div class="row" style="background-color:white; border-radius:5px;">
                <div class="col-12">
                    <h4 class="mb-0">Seleccione las categorias</h4><br>
                </div>
            <?php
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<div style='display:inline;' class='col-md-2 col-4 ml-2 mt-3'>";
                        echo "<input class='checkHover' type='checkbox' id='Cat' value=".$row['IDCategoria'].">";
                        echo "<label class='fuenteCheck' for=".$row['Nombre'].">".$row['Nombre']."</label>";
                        echo "</div>";
                    }
                ?>
            </div>

            <div class="row">
                <div class="col-12 mt-3">
                    <button id="agregarImagen" class="btn btn-success form-control boton-mid-len">Subir</button>
                    <button class="btn btn-danger form-control boton-mid-len" onclick="window.location.replace('/Animales/');">Cancelar</button>
                </div>
            </div>
        
        </div>



        <?php
            include('JS.php');
        ?>

        <script>
        function preview(event){
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("preview");
                preview.src = src;
                preview.style.display = "block";
                
            }
        }

        </script>
    </body>
</main>
</html>