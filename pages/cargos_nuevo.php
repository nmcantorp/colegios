<?php require_once('commons/header_int.php');
      require_once('../clases/cargos.php');
      
      $obj_valordefinicion  = new ClassCargos();      
      
      
      if($_REQUEST['ac'] == 'save')
      {

      }
      
?>

<!-- ANIMATED COLUMNS 
================================================== -->
<div class="row content">
    
<div class="row">
    <hr>
    <div class="twelve columns" >
        <h5>Crear Organización</h5>
        <form  name="cargo" action="?ac=save" method="post" id="cargo">
            <fieldset>
                <legend>Descripci&oacute;n de Cargos</legend>
                <div class="row">
                    <div class="four columns">
                        <label>Cargo</label>
                        <input type="text" class="smoothborder" name="cargo" id="cargo" required/>
                    </div>
                    <div class="twelve columns">
                        <label>Descripci&oacute;n Cargo</label>
                        <textarea rows="4" class="smoothborder" name="p_desc_cargo" id="p_desc_cargo" required></textarea>
                        <label>Activo</label>
                        <input type="checkbox"  name="p_activo" value="S" class="smoothborder" checked/>
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