$(function(){
    
});

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