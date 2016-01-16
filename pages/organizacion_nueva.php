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
        <h5>Crear Organización</h5>
        <form  name="empresas" action="?ac=save" method="post" id="empresas">
            <fieldset>
                <legend>Organización</legend>
                <div class="alert-box alert" id="mensaje_error" style="display:none;">
                    Debe completar la información del formulario. <!--<a href="" class="close">x</a>-->
                </div>
                <div class="row">
                    <div class="four columns">
                        <label>Nit</label>
                        <input type="text" class="smoothborder" name="nit" id="nit" required/>
                    </div>
                    <div class="eight columns">
                        <label>Nombre Empresa</label>
                        <input type="text" class="smoothborder" name="nombre" id="nombre" required/>
                    </div>
                </div>
                <div class="row">
                    <div class="four columns">
                        <label>Dirección</label>
                        <input type="text" class="smoothborder" name="direccion" id="direccion" required/>
                    </div>
                    <div class="four columns">
                        <label>Teléfono - PBX</label>
                        <input type="text" class="smoothborder" name="telefono" id="telefono" required/>
                    </div>
                    <div class="four columns">
                        <label>URL</label>
                        <input type="text" class="smoothborder" name="url" id="url"/>
                    </div>
                </div>
                <div class="row">
                    <div class="four columns">
                        <label>Sigla</label>
                        <input type="text" class="smoothborder" name="sigla" id="sigla"/>
                    </div>
                    <div class="four columns">
                        <label>Año fundacion</label>
                        <input type="date" class="smoothborder" name="anyo" id="anyo" />
                    </div>
                    <div class="four columns">
                        <label>Tipo de Sede</label>
                        <select class="form-control" id="tipo" name="tipo" required>
                            <option value="" > -Seleccione Tipo </option>
                            <option value="PR">Pricipal</option>
                            <option value="SU">Sucursale</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="four columns">
                        <label>Sector Económico</label>
                        <select class="form-control" name="sector" id="sector" required>
                            <option value="" > -Seleccione Sector- </option>
                            <?php for($i=0; $i<count($sectores); $i++ ): ?>
                                <option value="<?php echo $sectores[$i]['id_valor_def']; ?>"><?php echo utf8_encode($sectores[$i]['valor_definicion']); ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>
                
                <div class="row botonera_form">
                    <a href="javascript:enviar();" class="success button">Guardar</a>
                    <a href="javascript:reset();" class="alert button">Limpiar</a>
                </div>
                 </fieldset>
        </form>
                </div>


    </div>
	</div>
<?php require_once('commons/footer_int.php'); ?>