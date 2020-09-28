$(document).ready(function(){

    $("#login").click(function(){
        $.post("/Animales/PHP/acciones.php",{
            email: $("#Email").val(),
            pass: $("#Contrasenna").val()
        }, function(data,status){
            if (data == "Valido") {
                window.location.replace("/Animales/");
            }else{
                $("#errorInicioSesion").show();
            }
        });
    });

    $("#buscar").keyup(function() { 
        $.post("/Animales/PHP/acciones.php",{
            busqueda: $("#buscar").val()
        }, function(data,status){
            $("#noResult").remove();
            $(".col-md-3").remove();
            $(data).insertAfter("#barraBusqueda");
        });
    });


    
});