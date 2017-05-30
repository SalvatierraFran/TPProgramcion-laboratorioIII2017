function Login()
{
    var usuario = $("#usuario").val();
    var clave = $("#clave").val();

    if(!ValidarCampos(usuario, clave))
    {
        alert("No se han completado correctamente los campos");
    }
    else
    {
        VerificarSiExisteUsuario("adminLogin.php", usuario, clave);
    }
}

function ValidarCampos(usuario, clave)
{
    if(usuario.length == 0 || clave.length == 0)
    {
        return false;
    }
    return true;
}

function VerificarSiExisteUsuario(url, usuario, clave)
{
    $.ajax({
        type : 'POST',
        url : url,
        dataType : 'text',
        data : {'usuario' : usuario,
                'clave' : clave},
        async : false
    })
    .done(function (resultado){
        //alert(resultado);

        if(resultado != "OK"){
            alert("Error!!! No coincide el usuario y/o clave!");
        }else{
            window.location.href = "Principal.php";
        }
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
		alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
	});
}