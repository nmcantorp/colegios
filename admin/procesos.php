<?php require_once('../pages/commons/header_int.php');
      
      if($_REQUEST['ac'] == 'run')
      {
        if( !is_null($_REQUEST['proceso']) && $_REQUEST['proceso'] != '' )
        {
            switch ($_REQUEST['proceso']) {
                case '1':
                    system("php ../services/plataforma/update_users.php > result_update.php 2>&1 & echo ", $output);

                    break;
                
                default:
                    # code...
                    break;
            }
                    ?>
        <script type="text/javascript">
            window.location="procesos.php";
        </script>
        <?php
        }
      }
      
?>
<script src="../javascripts/funciones_especificas/procesos.js"></script>
<!-- SUBHEADER
================================================== -->
<div id="subheader">
	<div class="row">
		<div class="twelve columns">
			<p class="text-center">
				 <font style="font-size:22px; color:#FFFFFF;">Ejecución de Procesos</font>
			</p>
		</div>
	</div>
</div>
<!-- ANIMATED COLUMNS 
================================================== -->
<div class="row content">
<div class="row">
    <hr>
    <div class="twelve columns" >
        <form  name="process" action="?ac=run" method="post" id="process">
            <fieldset>
                <legend>Listado de procesos a ejecutar</legend>
                <div class="alert-box alert" id="mensaje_error" style="display:none;">
                    Debe completar la información del formulario. <!--<a href="" class="close">x</a>-->
                </div>
                <div class="row">
                    <div class="four columns">
                        <label>Tipo de Sede</label>
                        <select class="chosen-select" id="proceso" name="proceso"  data-placeholder="Seleccione Proceso" multiple required>
                            <option value="" > -Seleccione Tipo </option>
                            <option value="1">Actualizar Usuario</option>
                            <option value="2">Actualizar Notas</option>
                        </select>
                    </div>
                </div>              
                
                <div class="row botonera_form">
                    <a href="javascript:enviar();" class="success button">Correr</a>
                    <a href="javascript:history.back()" class="alert button">Volver</a>
                </div>
                 </fieldset>
        </form>
                </div>


    </div>
	</div>
<?php require_once('../pages/commons/footer_int.php'); ?>