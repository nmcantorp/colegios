 

function agregar(e)
{   
    var detalle=document.getElementsByName('detalle');
    $('#'+detalle[0].id).clone().appendTo('#row_detalle');
    
    var order=document.getElementsByName('detalle');

    var valida = order.length-1;

    for (var i = 0; i < order.length; i++) {
        if(i==valida){
            numero_id = order[i].id.substr(19, 1);//console.log(numero_id.substr(19, 1));
            $('#'+order[i].id).attr('id', 'detalle_definicion_'+(i+1));
            $('#definicion_'+numero_id).attr('id', 'definicion_'+(i+1));
            $('#descripcion_'+numero_id).attr('id', 'descripcion_'+(i+1));
            $('#p_activo_'+numero_id).attr('id', 'p_activo_'+(i+1));
            $('#definicion_'+(i+1)).attr('name', 'definicion_'+(i+1));
            $('#descripcion_'+(i+1)).attr('name', 'descripcion_'+(i+1));
            $('#p_activo_'+(i+1)).attr('name', 'p_activo_'+(i+1));
            
            $('#detalle_definicion_'+(i+1)+' button.btn-danger').remove()

            $("#botones_row_"+numero_id).append('<button type="button" class="btn btn-danger" onclick="eliminar('+(i+1)+');">-</button>');
            $('#botones_row_'+numero_id).attr('id', 'botones_row_'+(i+1));
        }

    };
    //$('#container').jaySort('detalle_definicion_', order);
    //console.log(detalle);
}

function eliminar(id)
{
    console.log(id);
    var order=document.getElementsByName('detalle');

    if(order.length > 1){
        $("#detalle_definicion_"+id).remove();

        for (var i = 0; i < order.length; i++) {
            var id = order[i].id;
            numero_id = order[i].id.substr(19,1);

            order[i].id="detalle_definicion_"+(i+1);
            $('#detalle_definicion_'+(i+1)+' #definicion_'+numero_id).attr('id', 'definicion_'+(i+1));
            $('#detalle_definicion_'+(i+1)+' #descripcion_'+numero_id).attr('id', 'descripcion_'+(i+1));
            $('#detalle_definicion_'+(i+1)+' #p_activo_'+numero_id).attr('name', 'p_activo_'+(i+1));
            $('#detalle_definicion_'+(i+1)+' #p_activo_'+numero_id).attr('id', 'p_activo_'+(i+1));
            $('#detalle_definicion_'+(i+1)+' #botones_row_'+numero_id).attr('id', 'botones_row_'+(i+1));
            $("#botones_row_"+(i+1)+"> button.btn-danger").attr('onclick', 'eliminar('+(i+1)+');');

        };
    }
}