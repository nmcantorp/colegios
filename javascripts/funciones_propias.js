/* global $ */
$(function(){
    var foto = $('#foto_temp').val();
    
    if(foto)
    {   
        $('#main-menu > li > a > img').attr('src', '../'+foto);
    }
});

// Funciones para el logueo 

function vacio(q) {
    for ( i = 0; i < q.length; i++ ) {
            if ( q.charAt(i) != " " ) {
                    return true
            }
    }
    return false
}

function valida(F)
{
    if( vacio(F.usuario.value) == false )
    {
        alert("Introduzca un usuario valido.");
        return false;
    }
    if( vacio(F.password.value) == false )
    {
        alert("Introduzca una clave valida.");
        return false;
    } else {//alert("OK")
        //cambiar la linea siguiente por return true para que ejecute la accion del formulario
        return true
    }
}

//Final funciones de logueo 


//Funciones para el submit de formularios

function enviar()
{
    var formularios = document.forms;
    console.log(formularios);
    for (var i = 0; i < formularios.length; i++) {
        id_form = formularios[i].id;

        inputs = $('#'+id_form+' :input');

        for (var j = 0; j < inputs.length; j++) {
            //$("#"+inputs[i].id).attr('required');
            if(inputs[j].required){
                if( inputs[j].value=='' || inputs[j].value == null)
                {
                    
                }
            }
            console.log(inputs[j].required);
        };

        console.log($('#'+id_form+' :input'));
        return false;
        document.getElementById(id_form).submit();
     }; 
       

}

// Funciones para la validacion del email

function validar(txt)
{

    //expresion regular
        var b=/^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/

   //comentar la siguiente linea si no se desea que aparezca el alert()
        alert("" + (b.test(txt)?"":"Verifique su email no es para una ") + "Suscripción válida.")

   //devuelve verdadero si validacion OK, y falso en caso contrario
        return b.test(txt)
}

// Funcion para campos numericos

function numero(e)
{
    var num = window.event ? window.event.keyCode : e.which;
    if ( num == 8 ) return true;
    return /\d/.test(String.fromCharCode(num));
}



