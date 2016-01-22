<?php require_once('commons/header_int.php');
      require_once('../clases/ciudad.php');

      /*Clases*/
      $obj_ciudad  = new ClassCiudad();

      /*Metodos*/
      $resultado_ciudad = $obj_ciudad->get_Ciudades();
      print_r($resultado_ciudad);die();
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
        <h5>Crear Personas</h5>
        <form  name="lugares" action="?ac=save" method="post" id="lugares" onSubmit="return validar(this.email.value)">
            <fieldset>
                <legend>Datos Personales</legend>
                <div class="row">
                    <div class="three columns">
                        <label>Primer Nombre</label>
                        <input type="text" class="smoothborder" name="primer_nom" id="primer_nom" maxlength="20" required=""/>
                    </div>
                    <div class="three columns">
                        <label>Segundo Nombre</label>
                        <input type="text" class="smoothborder" name="segundo_nom" id="segundo_nom" maxlength="20"/>
                    </div>
                    <div class="three columns">
                        <label>Primer Apellido</label>
                        <input type="text" class="smoothborder" name="primer_ape" id="primer_ape" maxlength="20" required=""/>
                    </div>
                    <div class="three columns">
                        <label>Segundo Apellido</label>
                        <input type="text" class="smoothborder" name="segundo_ape" id="segundo_ape" maxlength="20"/>
                    </div>
                </div>
                <div class="row">
                    <div class="four columns">
                        <label>Documento Nacional de Identidad (D.N.I)</label>
                        <input type="text" class="smoothborder" name="doc_identidad" id="doc_identidad" maxlength="15" onkeypress="return numero(event);" required=""/>
                    </div>
                    <div class="four columns">
                        <label>Fecha de Nacimiento</label>
                        <input type="date" class="smoothborder" name="fecha_nac" id="fecha_nac" required=""/>
                    </div>
                    <div class="four columns">
                        <label>Genero</label>
                        <select class="smoothborder" id="genero" name="genero" required="">
                            <option value=""></option>
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                        </select>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>Datos de Contacto</legend>
                <div class="row">
                    <div class="eight columns">
                        <label>Direcci&oacute;n de Residencia</label>
                        <input type="text" class="smoothborder" name="direccion" id="direccion" maxlength="100" required=""/>
                    </div>
                    <div class="four columns">
                        <label>Ciudad de Residencia</label>
                        <select class="smoothborder" id="ciudad" name="ciudad" required="">
                            <option value=""></option>
                            <?php
                            if ($resultado_ciudad)
                            	while($row = mysql_fetch_array($resultado_ciudad))
                            		{
                            		echo '<option value="'.$row[id_ciudad].'">'.$row[nombre_ciudad].'</option>';
                            		}
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="eight columns">
                        <label>Email</label>
                        <input type="text" class="smoothborder" name="email" id="email" maxlength="100" required=""/>
                    </div>
                    <div class="two columns">
                        <label>Telefono</label>
                        <input type="text" class="smoothborder" name="telefono" id="telefono" maxlength="10" onkeypress="return numero(event);" required=""/>
                    </div>
                    <div class="two columns">
                        <label>Celular</label>
                        <input type="text" class="smoothborder" name="celular" id="celular" maxlength="10" onkeypress="return numero(event);" required=""/>
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