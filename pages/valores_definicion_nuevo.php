<?php require_once('commons/header_int.php');
      require_once('../clases/valor_definicion.php');
      
    $obj_valordefinicion  = new ClassValDefinicion();;      
      
      
    if($_REQUEST['ac'] == 'save')
    {
        $data = array('tipo_def'=>$_REQUEST['tipo_definicion']
                    , 'estado_def' => $_REQUEST['p_activo']);
        unset($_REQUEST['tipo_definicion']);
        unset($_REQUEST['p_activo']);
        unset($_REQUEST['ac']);

        for ($i=0; $i < (count($_REQUEST)/3); $i++) { 
            $data['detalle'][$i]['valor_def']  = $_REQUEST['definicion_'.($i+1)];
            $data['detalle'][$i]['desc_def']   = $_REQUEST['descripcion_'.($i+1)];
            $data['detalle'][$i]['estado_def'] = ($_REQUEST['p_activo_'.($i+1)] == 'S' && isset($_REQUEST['p_activo_'.($i+1)])) ? 'S':'N';
        }

        $resultado=$obj_valordefinicion->guardar_definicion($data);
        if($resultado)
        {
            header('Location: valores_definicion.php');
            exit;
        }        
    }
      
?>
<script src="../javascripts/funciones_especificas/definicion_valores.js"></script>
<!-- ANIMATED COLUMNS 
================================================== -->
<div class="row content">
    
<div class="row">
    <hr>
    <div class="twelve columns" >
        <!-- <h5>Crear Organización</h5> -->
        <form  name="frm_definicion" action="?ac=save" method="post" id="frm_definicion">
            <fieldset>
                <legend>Valores Definición Nuevo</legend>
                <div class="row">
                    <div class="six columns">
                        <label>Tipo Definición</label>
                        <input type="text" class="smoothborder" name="tipo_definicion" id="tipo_definicion" required/>
                    </div>
                    <div class="four columns">
                        <label>Activo</label>
                        <input type="checkbox"  name="p_activo" value="S" class="smoothborder" checked/>
                    </div>
                </div>
                <div class="row" id="row_detalle">
                    <div class="row" name="detalle" id="detalle_definicion_1">
                        <hr>
                        <div class="four columns">
                            <label>Valor Definición</label>
                            <input type="text" class="smoothborder" name="definicion_1" id="definicion_1" required/>
                        </div>
                        <div class="six columns">
                            <label>Descripción</label>
                            <textarea rows="2" class="smoothborder" name="descripcion_1" id="descripcion_1" required></textarea>
                        </div>
                        <div class="columns">
                            <label>Activo</label>
                            <input type="checkbox" name="p_activo_1" id="p_activo_1" value="S" class="smoothborder" checked/>
                        </div> 
                        <div class="columns" id="botones_row_1">                        
                            <button type="button" class="btn btn-success" onclick="agregar(this);" id="agrega_1">+</button>
                        </div>                    
                    </div>
                </div>
               
                <div class="row botonera_form">
                    <a href="javascript:enviar();" class="success button">Guardar</a>
                    <a href="javascript:reset();" class="alert button">Limpiar</a>
                </div>
        
                </div>
            </fieldset>
        </form>
       
    </div>

	</div>
</div>
<?php require_once('commons/footer_int.php'); ?>