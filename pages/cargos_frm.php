<?php require_once('commons/header_int.php');
      //require_once('../clases/organizacion.php');
      //require_once('../clases/valor_definicion.php');
      
      
      //$obj_organizacion     = new ClassOrganizacion();
      //$obj_valordefinicion  = new ClassValDefinicion();
      
      //$result   = $obj_organizacion->get_Organizacion();
      //$sectores = $obj_valordefinicion->get_Definiciones('SECTOR_ECONOMICO');
      
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
        <h5>Crear Cargos</h5>
        <form  name="cargos" action="?ac=save" method="post" id="cargos">
            <fieldset>
                <legend>Cargos</legend>
                <div class="alert-box alert" id="mensaje_error" style="display:none;">
                    Debe completar la información del formulario. <!--<a href="" class="close">x</a>-->
                </div>
                <div class="row">
                    <div class="six columns">
                        <label>Descripci&oacute;n</label>
                        <input type="text" class="smoothborder" name="descripcion_cargo" id="descripcion_cargo" required/>
                    </div>
                    <div class="two columns">
                        <label>Actvo</label>
                        <input type="checkbox"  name="activo" id="activo" value="S"/>
                    </div>
                </div>
                <div class="row">
                    <div class="twelve columns">
                        <label>Observaciones</label>
                        <input type="text" class="smoothborder" name="observaciones" id="observaciones" />
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
    
        <!-- TABLES--
		<div class="twelve columns" style="text-align: center;">
			<h5> NUEVA ORGANIZACIÓN</h5>
            <div class="clear"></div>
            <div class="row botonera">
                <a href="#" class="button">Nuevo</a>
                <a href="#" class="success button">Button</a>
            </div>
			<table style="margin: 0 auto !important;">
			<thead>
			<tr>
				<th>
					Nit Empresa
				</th>
				<th>
					Nombre Empresa
				</th>
				<th>
					Sector Economico
				</th>
				<th>
					Acciones
				</th>
			</tr>
			</thead>
			<tbody>
                <?php for($i=0 ; $i < count($result); $i++ ): ?>
			<tr>
				<td>
					<?php echo $result[$i]['nit_empresa']; ?>
				</td>
				<td>
					<?php echo $result[$i]['nombre_empresa']; ?>
				</td>
				<td>
					<?php echo $result[$i]['valor_definicion']; ?>
				</td>
				<td>
					Content
				</td>
			</tr>
            <?php endfor; ?>
			</tbody>
			</table>
		</div>-->
	</div>
</div>
<?php require_once('commons/footer_int.php'); ?>