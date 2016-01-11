<?php require_once('commons/header_int.php');
      require_once('../clases/organizacion.php');
      require_once('../clases/valor_definicion.php');
      
      
      $obj_organizacion     = new ClassOrganizacion();
      $obj_valordefinicion  = new ClassValDefinicion();
      
      $result   = $obj_organizacion->get_Organizacion();
      $sectores = $obj_valordefinicion->get_Definiciones('SECTOR_ECONOMICO');
      
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
        <h5>Crear Lugares</h5>
        <form  name="lugares" action="?ac=save" method="post" id="lugares">
            <fieldset>
                <legend>Pa&iacute;s</legend>
                <div class="row">
                    <div class="four columns">
                        <label>C&oacute;digo Pa&iacute;s</label>
                        <input type="text" class="smoothborder" name="cod_postal" id="cod_postal" required=""/>
                    </div>
                    <div class="eight columns">
                        <label>Nombre Pa&iacute;s</label>
                        <input type="text" class="smoothborder" name="pais" id="pais" required=""/>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>Departamento</legend>
                <div class="row">
                    <div class="four columns">
                        <label>C&oacute;digo Departamento</label>
                        <input type="text" class="smoothborder" name="cod_dep" id="cod_dep" required=""/>
                    </div>
                    <div class="eight columns">
                        <label>Nombre Departamento</label>
                        <input type="text" class="smoothborder" name="nom_depto" id="nom_depto" required=""/>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>Ciudad</legend>
                <div class="row">
                    <div class="four columns">
                        <label>C&oacute;digo Ciudad</label>
                        <input type="text" class="smoothborder" name="cod_dep" id="cod_dep" required=""/>
                    </div>
                    <div class="eight columns">
                        <label>Nombre Ciudad</label>
                        <input type="text" class="smoothborder" name="nom_depto" id="nom_depto" required=""/>
                    </div>
                </div>
            </fieldset>
            <div class="row botonera_form">
                <a href="javascript:enviar();" class="success button">Guardar</a>
                <a href="#" class="alert button">Cancelar</a>
            </div>
        </form>
    </div>
    </div>
</div>
<?php require_once('commons/footer_int.php'); ?>