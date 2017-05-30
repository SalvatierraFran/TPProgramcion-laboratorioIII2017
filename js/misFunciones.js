function Logout()
{
    var Pagina = "nexoAdmin.php";

    $.ajax({
        type : 'POST',
        url : Pagina,
        dataType : 'text',
        data : {"queMuestro" : "2"},
        async : true
    })
    .done(function (resultado){
        if(resultado != "OK"){
            alert("Ha ocurrido un error al cerrar sesión");
        }else{
            alert("Se ha cerrado la sesión actual");
            window.location.href = "index.html";
        }
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
		alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
	});
}