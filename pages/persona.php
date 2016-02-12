<?php require_once('commons/header_int.php');
      require_once('../clases/ciudad.php');
      require_once('../clases/personas.php');

      /*Clases*/
      $obj_ciudad  = new ClassCiudad();
      $obj_Persona = new ClassPersonas();

      /*Metodos*/
      $resultado_ciudad = $obj_ciudad->get_Ciudades();
      $readonly = null;

      if($_REQUEST['ac'] == 'save')
      {
          
      }elseif( !empty($_REQUEST['id']) )
      {
          $info_persona = $obj_Persona->get_Persona_id($_REQUEST['id']);
          $readonly = 'readonly';
          $disabled = 'disabled';
      }
      
      
?>

<!-- ANIMATED COLUMNS 
================================================== -->

<script src="../javascripts/funciones_especificas/personas.js"></script>
<div class="row content">
    <div class="row">
    <hr>
    <div class="twelve columns" >
        <!-- <h5>Crear Personas</h5> -->
        <form  name="lugares" action="?ac=save" method="post" id="lugares" onSubmit="return validar(this.email.value)">
            <fieldset>
                <legend>Datos Personales</legend>
                <div class="row">
                    <div class="three columns">
                        <label>Primer Nombre</label>
                        <input type="text" class="smoothborder" name="primer_nom" id="primer_nom" maxlength="20" required="" value="<?php echo $info_persona[0]['primer_nom']; ?>" <?php echo $readonly; ?>/>
                    </div>
                    <div class="three columns">
                        <label>Segundo Nombre</label>
                        <input type="text" class="smoothborder" name="segundo_nom" id="segundo_nom" maxlength="20" value="<?php echo $info_persona[0]['segundo_nom']; ?>" <?php echo $readonly; ?>/>
                    </div>
                    <div class="three columns">
                        <label>Primer Apellido</label>
                        <input type="text" class="smoothborder" name="primer_ape" id="primer_ape" maxlength="20" required="" value="<?php echo $info_persona[0]['primer_ape']; ?>" <?php echo $readonly; ?>/>
                    </div>
                    <div class="three columns">
                        <label>Segundo Apellido</label>
                        <input type="text" class="smoothborder" name="segundo_ape" id="segundo_ape" maxlength="20" value="<?php echo $info_persona[0]['segundo_ape']; ?>" <?php echo $readonly; ?>/>
                    </div>
                </div>
                <div class="row">
                    <div class="four columns">
                        <label>Documento Nacional de Identidad (D.N.I)</label>
                        <input type="text" class="smoothborder" name="doc_identidad" id="doc_identidad" maxlength="15" onkeypress="return numero(event);" required="" value="<?php echo $info_persona[0]['doc_identidad']; ?>" <?php echo $readonly; ?>/>
                    </div>
                    <div class="four columns">
                        <label>Fecha de Nacimiento</label>
                        <input type="date" class="smoothborder" name="fecha_nac" id="fecha_nac" required="" value="<?php echo $info_persona[0]['fecha_nac']; ?>" <?php echo $readonly; ?>/>
                    </div> 
                    <div class="four columns">
                        <label>Genero</label>
                        <select class="smoothborder" id="genero" name="genero" required="" <?php echo $disabled; ?>>
                            <option value=""></option>
                            <option value="M" <?php echo ($info_persona[0]['genero'] == 'M')?'selected':null; ?>>Masculino</option>
                            <option value="F" <?php echo ($info_persona[0]['genero'] == 'F')?'selected':null; ?>>Femenino</option>
                        </select>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>Datos de Contacto</legend>
                <div class="row">
                    <div class="eight columns">
                        <label>Direcci&oacute;n de Residencia</label>
                        <input type="text" class="smoothborder" name="direccion" id="direccion" maxlength="100" required="" value="<?php echo $info_persona[0]['direccion']; ?>" <?php echo $readonly; ?>/>
                    </div>
                    <div class="four columns">
                        <label>Ciudad de Residencia</label>
                        <select class="smoothborder" id="ciudad" name="ciudad" required="" <?php echo $disabled; ?>>
                            <option value=""></option>
                            <?php
                            if ($resultado_ciudad)
                                for ($i=0; $i < count($resultado_ciudad); $i++) { 
                                    $selected = ($info_persona[0]['id_ciudad'] == $resultado_ciudad[$i]['id_ciudad'])?'selected':null;
                            		echo '<option value="'.$resultado_ciudad[$i]['id_ciudad'].'" '. $selected .' >'.$resultado_ciudad[$i]['nombre_ciudad'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="eight columns">
                        <label>Email</label>
                        <input type="text" class="smoothborder" name="email" id="email" maxlength="100" required="" value="<?php echo $info_persona[0]['email']; ?>" <?php echo $readonly; ?>/>
                    </div>
                    <div class="two columns">
                        <label>Telefono</label>
                        <input type="text" class="smoothborder" name="telefono" id="telefono" maxlength="10" onkeypress="return numero(event);" required="" value="<?php echo $info_persona[0]['telefono']; ?>" <?php echo $readonly; ?>/>
                    </div>
                    <div class="two columns">
                        <label>Celular</label>
                        <input type="text" class="smoothborder" name="celular" id="celular" maxlength="10" onkeypress="return numero(event);" required="" value="<?php echo $info_persona[0]['celular']; ?>" <?php echo $readonly; ?>/>
                    </div>
                </div>
            </fieldset>
            <div class="row">
            <fieldset>
                <legend>Detalles</legend>
                    <div class="twelve columns">
                        <div id="tabs">
                          <ul>
                            <li><a href="#tabs-1">Asignación</a></li>
                            <li><a href="#tabs-2">Experiencia Laboral</a></li>
                            <li><a href="#tabs-3">Formal</a></li>
                            <li><a href="#tabs-4">Funciones</a></li>
                            <li><a href="#tabs-5">Ref. Personales</a></li>                            
                          </ul>
                          <div id="tabs-1">
                            <h2>Content heading 1</h2>
                            <p>Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet massa et lorem. Mauris dapibus lacus auctor risus. Aenean tempor ullamcorper leo. Vivamus sed magna quis ligula eleifend adipiscing. Duis orci. Aliquam sodales tortor vitae ipsum. Aliquam nulla. Duis aliquam molestie erat. Ut et mauris vel pede varius sollicitudin. Sed ut dolor nec orci tincidunt interdum. Phasellus ipsum. Nunc tristique tempus lectus.</p>
                          </div>
                          <div id="tabs-2">
                            <h2>Experiencia Laboral</h2>
                            <p>
                                <div class="row">
                                    <div class="eight columns">
                                        <label>Email</label>
                                        <input type="text" class="smoothborder" name="email" id="email" maxlength="100" required="" value="<?php echo $info_persona[0]['email']; ?>" <?php echo $readonly; ?>/>
                                    </div>
                                    <div class="two columns">
                                        <label>Telefono</label>
                                        <input type="text" class="smoothborder" name="telefono" id="telefono" maxlength="10" onkeypress="return numero(event);" required="" value="<?php echo $info_persona[0]['telefono']; ?>" <?php echo $readonly; ?>/>
                                    </div>
                                    <div class="two columns">
                                        <label>Celular</label>
                                        <input type="text" class="smoothborder" name="celular" id="celular" maxlength="10" onkeypress="return numero(event);" required="" value="<?php echo $info_persona[0]['celular']; ?>" <?php echo $readonly; ?>/>
                                    </div>
                                </div>
                            </p>
                          </div>
                          <div id="tabs-3">
                            <h2>Content heading 3</h2>
                            <p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
                            <p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>
                          </div>
                          <div id="tabs-4">
                            <h2>Content heading 3</h2>
                            <p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
                            <p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>
                          </div>
                          <div id="tabs-5">
                            <h2>Content heading 3</h2>
                            <p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
                            <p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>
                          </div>
                        </div>
                    </div>

            </fieldset>
            </div>
            <div class="row botonera_form">
                <a href="javascript:enviar();" class="success button">Guardar</a>
                <a href="javascript:history.back()" class="alert button">Cancelar</a>
            </div>
        </form>
    </div>
    </div>
</div>
<?php require_once('commons/footer_int.php'); ?>