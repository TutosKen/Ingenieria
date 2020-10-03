$(document).ready(function(){
    var cuentaImagenes = 12;

    function countPosts(){
        $.post("/Animales/PHP/acciones.php",{
            MaxPosts: cuentaImagenes
        }, function(data,status){
                // alert(data);
                if (data == 1) {
                    setTimeout(function(){
                        $("#mostrarMas").attr('disabled',"");
                      }, 100);   
                }
        });
    }

    countPosts();

    $("#login").click(function(){
        $.post("/Animales/PHP/acciones.php",{
            email: $("#Email").val(),
            pass: $("#Contrasenna").val()
        }, function(data,status){
            if (data == "Valido") {
                window.location.replace("/Animales/");
            }else{
                // alert(data);
                $("#errorInicioSesion").show();
            }
        });
    });

    $("#buscar").keyup(function() {
            // cuentaImagenes = 12;
            if (this.value != "") {
                $("#mostrarMas").removeAttr('disabled');
                $("#seccionPosts").load("/Animales/PHP/acciones.php",{
                    busqueda:$("#buscar").val()
                }, function(responseTxt, statusTxt, xhr){
                    if (responseTxt != '') {
                        $("#mostrarMas").hide();
                    }
                });
        }else{
            window.location.replace("/Animales/");
        }

    });

    $(".especial").click(function() {
        $("#mostrarMas").hide();
        $("#mostrarMas").removeAttr('disabled');
        var nombreCat = $(this).html();
        $("#seccionPosts").load("/Animales/PHP/acciones.php",{
            NombreCat:nombreCat
        });
    });

    $("#noFiltro").click(function (){
        cuentaImagenes = 12;
        $("#mostrarMas").removeAttr('disabled');
        $("#seccionPosts").load("/Animales/PHP/acciones.php",{
            cargar:'true'
        });

        setTimeout(function(){
            $("#mostrarMas").show();
          }, 100); 
    });

    $("#mostrarMas").click(function(){
        cuentaImagenes = cuentaImagenes + 4;
        $("#seccionPosts").load("/Animales/PHP/acciones.php",{
            nuevaCuenta:cuentaImagenes
        });

        countPosts();
    });

    $("#emailRegistro").keyup(function(){
        $.post("/Animales/PHP/acciones.php",{
            verEmail: $("#emailRegistro").val()
        }, function(data,status){
            if (data == "Existe") {
                $("#emailExistente").show();
            }else{
                $("#emailExistente").hide();
            }
        });
    });

    $("#usuarioRegistro").keyup(function(){
        $.post("/Animales/PHP/acciones.php",{
            verUsuario: $("#usuarioRegistro").val()
        }, function(data,status){
            if (data == "Existe") {
                $("#usuarioExistente").show();
            }else{
                $("#usuarioExistente").hide();
            }
        });
    });

    $("#cedulaRegistro").keyup(function(){
        $.post("/Animales/PHP/acciones.php",{
            verCedula: $("#cedulaRegistro").val()
        }, function(data,status){
            if (data == "Existe") {
                $("#cedulaExistente").show();
            }else{
                $("#cedulaExistente").hide();
            }
        });
    });

    $("#confPassRegistro").keyup(function(){
        var pass = $("#passRegistro").val();
        var confPass = $("#confPassRegistro").val();

        if (pass != confPass) {
            $("#contraNoCoincide").show();
        }else{
            $("#contraNoCoincide").hide();
        }
    });
    
    $("#passRegistro").keyup(function(){
        var pass = $("#passRegistro").val();
        var confPass = $("#confPassRegistro").val();

        if (pass != confPass) {
            $("#contraNoCoincide").show();
        }else{
            $("#contraNoCoincide").hide();
        }
    });

    $("#contBtnRegistro").mouseover(function() {
        if ($("#emailExistente").is(":visible") || $("#usuarioExistente").is(":visible") || $("#cedulaExistente").is(":visible") || $("#contraNoCoincide").is(":visible")) {
            $("#registrarse").attr('disabled','');
        }else{
            $("#registrarse").removeAttr('disabled');
        }
    });

    $("#contBtnModificar").mouseover(function() {
        if ($("#emailExistente").is(":visible") || $("#usuarioExistente").is(":visible") || $("#cedulaExistente").is(":visible") || $("#contraNoCoincide").is(":visible")) {
            $("#modificarUsuario").attr('disabled','');
        }else{
            $("#modificarUsuario").removeAttr('disabled');
        }
    });

    $("#modificarPerfil").click(function() {
        window.location.replace("/Animales/PHP/Paginas/editarPerfil.php");
    });


    $("#contBtnModificar").focusout(function(){
        $("#infoModificada").hide();
    });

    $("#modificarUsuario").click(function(){
        if ($("#emailRegistro").val() != "" && $("#nombreRegistro").val() != "" && $("#apellidoRegistro").val()!= "" &&  $("#usuarioRegistro").val() != ""  && $("#passRegistro").val() != "" && $("#confPassRegistro").val() && parseInt($("#PreguntaSecretaRegistro").val()) != 0 && $("#cedulaRegistro").val() != "") {
            $.post("/Animales/PHP/acciones.php",{
                NombreEditado: $("#nombreRegistro").val(),
                Apellido: $("#apellidoRegistro").val(),
                Email: $("#emailRegistro").val(),
                Cedula: $("#cedulaRegistro").val(),
                Direccion: $("#direccionRegistro").val(),
                Telefono: $("#telefonoRegistro").val(),
                UsuarioR: $("#usuarioRegistro").val(),
                Pass: $("#passRegistro").val(),
                ConfPass: $("#confPassRegistro").val(),
                Pregunta: parseInt($("#PreguntaSecretaRegistro").val()), 
                Respuesta: $("#respuestaRegistro").val()
                
            }, function(data,status){
                if (data == "Exito") {
                    $("#infoModificada").show();
                }
            });   
        }else{
            $("#camposIncompletos").show();
        }
    });

    $("#registrarse").click(function(){
        if ($("#emailRegistro").val() != "" && $("#nombreRegistro").val() != "" && $("#apellidoRegistro").val()!= "" &&  $("#usuarioRegistro").val() != ""  && $("#passRegistro").val() != "" && $("#confPassRegistro").val() && parseInt($("#PreguntaSecretaRegistro").val()) != 0 && $("#cedulaRegistro").val() != "") {
            $.post("/Animales/PHP/acciones.php",{
                Nombre: $("#nombreRegistro").val(),
                Apellido: $("#apellidoRegistro").val(),
                Email: $("#emailRegistro").val(),
                Cedula: $("#cedulaRegistro").val(),
                Direccion: $("#direccionRegistro").val(),
                Telefono: $("#telefonoRegistro").val(),
                UsuarioR: $("#usuarioRegistro").val(),
                Pass: $("#passRegistro").val(),
                Pregunta: parseInt($("#PreguntaSecretaRegistro").val()), 
                Respuesta: $("#respuestaRegistro").val()
                
            }, function(data,status){
                if (data == "Exito") {
                    window.location.replace("/Animales/");
                }
            });   
        }else{
            $("#camposIncompletos").show();
        }

    });

    $("#recuperarContra").click(function(){
        if (!$("#emailRecover").val()) {
            $("#correoVacio").show();
        }else{
            $.post("/Animales/PHP/acciones.php",{
                respuestaS: $("#respuestaS").val()
            }, function(data,status){
                if (data == "Exito") {
                    $("#correoEnviado").show();
                    $("#correoNoEnviado").hide();
                }else{
                    $("#correoNoEnviado").show();
                    $("#correoEnviado").hide();
                }
            });
        }
    });

    $("#emailRecover").keyup(function(){
        $.post("/Animales/PHP/acciones.php",{
            emailRecover: $("#emailRecover").val()
        }, function(data,status){
            $("#correoNoEnviado").hide();
            $("#preguntaS").remove();
            $("#respuestaS").remove();
            $(data).insertAfter("#emailRecover");

        });
    });

    $("#limpiarFormRecuperarContra").click(function(){
        $("#preguntaS").remove();
        $("#respuestaS").remove();
        $("#emailRecover").val('');

        $("#correoEnviado").hide();
        $("#correoVacio").hide();
        $("#correoNoEnviado").hide();

        $("#emailRecover").removeAttr('disabled');


    });

    $("#eliminarCuenta").click(function() {
        $.post("/Animales/PHP/acciones.php",{
            EliminarCuenta: 'true'
        }, function(data,status){
            if (data == "Exito") {
                window.location.replace("/Animales/");
            }
        });
    });

    $("#URI").keyup(function() {
        var imagen = $("#preview");
        $("#subirImagen").val('');

        if ($("#URI").val() == '') {
            imagen.attr("src","/Animales/img/imgsPagina/default.jpg");
        }else{
            imagen.attr("src",$("#URI").val());   
        }
    });

    $("#agregarImagen").click(function (){
        var tagsImg = $(".tagContent");
        var tags;

        for (var i = 0; i < tagsImg.length; i++) {
            if (i == 0) {
                tags = tagsImg[i].innerHTML;
            }else{
                tags += "," + tagsImg[i].innerHTML;
            }
        }

        // alert(tags);
        var cats = [];
        var fd = new FormData(); 
        var tituloImg  = $("#titulo").val();
        var URIImg = $("#URI").val();
        var descImg = $("#desc").val();
        

        var files = $('#subirImagen')[0].files[0]; 

        $('input:checked').each(function (){
            cats.push($(this).val());
        });
        cats.join(',');

        fd.append('file', files); 
        fd.append('cat',cats);
        fd.append('titulo',tituloImg);
        fd.append('URI',URIImg);
        fd.append('desc',descImg);
        fd.append('tags',tags);

        $.ajax({ 
            url: '/Animales/PHP/agregarImagen.php', 
            type: 'post', 
            data: fd, 
            contentType: false, 
            processData: false, 
            success: function(response){ 
                if(response != 0){ 
                    $("#publicacionCorrecta").show();
                    $("#agregarImagen").attr("disabled","");
                } 
                else{ 
                    $("#errorSubida").show();
                } 
            }, 
        }); 

        $("#subirImagen").val('');
        $("#URI").val('');
        $("#titulo").val('');
        $("#desc").val('');
        $("#tags").val('');
        $("input:checked").prop("checked", false);
        $(".tag").remove();
        $("#preview").attr('src','/Animales/img/imgsPagina/default.jpg')

    });

    $("#modificarImagen").click(function(){
        var tagsImg = $(".tagContent");
        var tags;

        for (var i = 0; i < tagsImg.length; i++) {
            if (i == 0) {
                tags = tagsImg[i].innerHTML;
            }else{
                tags += "," + tagsImg[i].innerHTML;
            }
        }

        var cats = [];
        var fd = new FormData(); 
        var tituloImg  = $("#titulo").val();
        var descImg = $("#desc").val();
        var id = $("#IDPostEd").val();

        $('input:checked').each(function (){
            cats.push($(this).val());
        });
        cats.join(',');

        fd.append('cat',cats);
        fd.append('titulo',tituloImg);
        fd.append('desc',descImg);
        fd.append('tags',tags);
        fd.append('id',id);

        $.ajax({ 
            url: '/Animales/PHP/acciones.php', 
            type: 'post', 
            data: fd, 
            contentType: false, 
            processData: false, 
            success: function(response){ 
                if(response != 0){ 
                    // alert(response);
                    $("#edicionCorrecta").show();
                    $("#modificarImagen").attr("disabled","");
                } 
                else{ 
                    alert(response);
                    $("#errorModificar").show();
                } 
            }, 
        }); 

    });

    $("#subirImagen").click(function() {
        $("#URI").val('');
    });
 

    $("#SubidaPost").mouseover(function(){
        if ((!$('#subirImagen').val() && !$("#URI").val()) || !$("#titulo").val() || $('input:checkbox:checked').length == 0) {
            $("#agregarImagen").attr('disabled','');
            $("#publicacionCorrecta").hide();
        }else{
            $("#agregarImagen").removeAttr('disabled');
            $("#publicacionCorrecta").hide();
        }
    });

    $("#modificarPost").mouseover(function (){
        if (!$("#titulo").val() || $('input:checkbox:checked').length == 0) {
            $("#modificarImagen").attr('disabled','');
            $("#edicionCorrecta").hide();
        }else{
            $("#modificarImagen").removeAttr('disabled');
            $("#edicionCorrecta").hide();
        }
    });

    // $("#SubidaPost").mouseover(function(){
    //     if ($('input:checkbox:checked').length == 0) {
    //         $("#errorCat").show();
    //     }else{
    //         $("#errorCat").hide();
    //     }
    // });

    $(".showBtns").click(function(){
        var padre = $(this).parent();
        padre.find(".editarPost").slideToggle("fast");
        padre.find(".eliminarPost").slideToggle("fast");
    });

    $(".eliminarPost").click(function(){
        var id = $(this).val();
        var padre = $(this).parent();
        $.post("/Animales/PHP/acciones.php",{
            idElimP: id
        },function(data,status){
            if (data == 1) {
                $("#postElim").show();
                padre.remove();
                var cantActual = parseInt($("#cantPosts").html());
                $("#cantPosts").html(cantActual-1);
            }
        });
    });

    $("#URI").focusout(function(){
        if ((!$('#subirImagen').val() && !$("#URI").val())){
            $("#errorArchivo").show();
        }else{
            $("#errorArchivo").hide();
        }
    });

    $("#titulo").focusout(function(){
        if (!$("#titulo").val()) {
            $("#errorTitulo").show();
        }else{
            $("#errorTitulo").hide();
        }
    });
});

    $("#tags").keyup(function() {
        if (this.value.indexOf(',') > -1) {
            $.post("/Animales/PHP/acciones.php", {
                tag: $("#tags").val()
            }, function(data,status){
                $(data).insertAfter("#descDiv");
                $("#tags").val('');
                $(".eliminarTag").click(function() {
                    $(this).parent().remove();
                    $("#tags").removeAttr("disabled");
                    $("#tags").attr("placeholder","Tags separados por coma(,)");
                });
            });

            if ($(".eliminarTag").length == 4) {
                $("#tags").attr("disabled","");
                $("#tags").attr("placeholder","Maximo de tags alcanzado");
            }
            
        }
});

