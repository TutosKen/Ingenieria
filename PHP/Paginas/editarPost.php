<?php
session_start();
if (!isset($_SESSION['IDUsuario'])) {
    header('location: /Animales/');
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <?php
        require_once('../head.php');
    ?>
    <title>Animales</title>
</head>
    <body>
        <?php
            require_once('../navbar.php');
            require_once('../../DB/Publicacion.php');
            $catM = [];
            $miPost = New Publicacion;
            $miPost->setID($_GET['IDimg']);
            $infoImagen = $miPost->getImagen();
            $categoriasMarcadas = $miPost->getPostCategoria();

            while($fila = mysqli_fetch_assoc($infoImagen)) {
                $uri = $fila['URI'];
                $titulo = $fila['Titulo'];
                $desc = $fila['Descripcion'];
                $tags = $fila['Tags'];
            }

            while ($cats = mysqli_fetch_assoc($categoriasMarcadas)) {
                array_push($catM,$cats['FK_Categoria']);
            }

            $result = $miPost->getCategorias();
        ?>
    <main>

        <div class="container">
            <div class="row">

                <input id="IDPostEd" type="hidden" value="<?php echo $miPost->getID();?>">
                <div class="col-12 m-auto" style="height:50vh;">
                    <img class="subirImagen" src="<?php echo $uri;?>">
                </div>

                <div class="col-12 m-auto" style="margin-top:10px!important;">
                    <input id="titulo" type="text" placeholder="Titulo" class="form-control" value="<?php echo $titulo;?>">
                </div>

                <div class="col-12 mt-2">
                    <div id="errorTitulo" class="alert alert-danger esconder" role="alert">
                        Debe ingresar un titulo
                    </div>
                </div>

                <div id="descDiv" class="col-12 m-auto" style="margin-top:10px!important;">
                    <textarea id="desc" maxlength="100" placeholder="Descripcion" class="form-control" cols="30" rows="4"><?php echo $desc;?></textarea>
                </div>

                <?php
                    $listaTags = explode(",",$tags);

                    foreach ($listaTags as $tag) {
                        echo "<div class='col-md-2 col-4 mt-2 bg-dark tag ml-2'>";
                        echo "<button class='eliminarTag btn btn-sm btn-danger' style='background:transparent; border:none;' onclick='eliminarTagPrevio(this)'>&#10005;</button>";
                        echo "<p class='tagContent'>".$tag."</p>";
                        echo "</div>";
                    }
                
                ?>

                <div class="col-12 m-auto" style="margin-top:10px!important;"> 
                    <textarea id="tags" maxlength="20" placeholder="Tags separados por coma(,)" class="form-control" cols="30" rows="2"></textarea>
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
                        echo "<input class='checkHover' type='checkbox' value=".$row['IDCategoria']." ".(in_array($row['IDCategoria'],$catM) ? 'checked' : '').">";
                        echo "<label class='fuenteCheck' for=".$row['Nombre'].">".$row['Nombre']."</label>";
                        echo "</div>";
                    }
                ?>
            </div>
            
            <div class="row">

            <!-- <div class="col-12  mt-2">
                    <div id="errorCat" class="alert alert-danger esconder" role="alert">
                        Debe seleccionar la(s) categoria(s)
                    </div>
                </div> -->

                <div class="col-12 mt-3">
                    <div id="errorModificar" class="alert alert-danger esconder" role="alert">
                        Error al actualizar la publicacion, por favor intente nuevamente
                    </div>

                    <div id="edicionCorrecta" class="alert alert-success esconder" role="alert">
                        Publicacion actualizada
                    </div>
                </div>

                <div id="modificarPost" class="col-12" style="padding:5px;">
                    <button id="modificarImagen" class="btn btn-success form-control boton-mid-len">Editar</button>
                    <button class="btn btn-danger form-control boton-mid-len" onclick="window.location.replace('/Animales/PHP/Paginas/perfil.php?IDUsuario=<?php echo $_SESSION['IDUsuario']?>')">Cancelar</button>
                </div>
            </div>
        
        </div>



        <?php
            require_once('../JS.php');
        ?>
        <script>
            function eliminarTagPrevio(thisObj){
                // alert(thisObj.innerHTML);
                thisObj.parentElement.remove();
            }
        </script>
    </body>
</main>
</html>