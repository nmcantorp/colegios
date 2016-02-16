<?php require_once('commons/header_int.php');
      require_once('../clases/ciudad.php');
      require_once('../clases/personas.php');
      require_once('../clases/historial_laboral.php');

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
          
          $historia_laboral = $obj_Persona->getHistoriaLab($_REQUEST['id']);
          $educacion_formal = $obj_Persona->getEduFormal($_REQUEST['id']);
          $referencia_personal = $obj_Persona->getReferenciaPersonal($_REQUEST['id']);
          $formacion_empresa =  $obj_Persona->getFormacionEmpresa($_REQUEST['id']);
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
                            <li><a href="#tabs-3">Ref. Personales</a></li>
                            <li><a href="#tabs-4">Funciones</a></li>
                            <li><a href="#tabs-5">Educación Formal</a></li>
                            <li><a href="#tabs-6">Educación Empresa</a></li>                                                        
                          </ul>
                          <div id="tabs-1">
                            <h2>Asignación</h2>
                            <p>
                                    <hr>
                                    <div class="row">
                                        <div class="twelve columns">
                                            <h3>No existe información para esta sección</h3>
                                        </div>
                                    </div>
                                </p>
                          </div>
                          <div id="tabs-2">
                            <h2>Experiencia Laboral</h2>
                            <?php if (count($historia_laboral)>0 ):
                                for ($i=0; $i < count($historia_laboral); $i++):  ?>
                            <p>
                                <hr>
                                <div class="row">
                                    <div class="six columns">
                                        <label>Nom. Empresa</label>
                                        <input type="text" class="smoothborder" name="text" id="empresa" maxlength="100" required="" value="<?php echo $historia_laboral[$i]['nombre_empresa']; ?>" <?php echo $readonly; ?>/>
                                    </div>
                                    <div class="six columns">
                                        <label>Cargo</label>
                                        <input type="text" class="smoothborder" name="cargo" id="cargo" required="" value="<?php echo $historia_laboral[$i]['descripcion_cargo']; ?>" <?php echo $readonly; ?>/>
                                    </div>
                                    <div class="four columns">
                                        <label>Jefe Inmediato</label>
                                        <input type="text" class="smoothborder" name="jefe" id="jefe" required="" value="<?php echo $historia_laboral[$i]['jefe_inmediato']; ?>" <?php echo $readonly; ?>/>
                                    </div>
                                    <div class="two columns">
                                        <label>Tel. Contacto</label>
                                        <input type="text" class="smoothborder" name="tel" id="tel" required="" value="<?php echo $historia_laboral[$i]['telcontacto']; ?>" <?php echo $readonly; ?>/>
                                    </div>
                                    <div class="two columns">
                                        <label>Ext.</label>
                                        <input type="text" class="smoothborder" name="ext" id="ext" value="<?php echo $historia_laboral[$i]['extension']; ?>" <?php echo $readonly; ?>/>
                                    </div>
                                    <div class="two columns">
                                        <label>F. Ingreso</label>
                                        <input type="text" class="smoothborder" name="ingreso" id="ingreso" required="" value="<?php echo $historia_laboral[$i]['fecha_ingreso']; ?>" <?php echo $readonly; ?>/>
                                    </div>
                                    <div class="two columns">
                                        <label>F. Retiro</label>
                                        <input type="text" class="smoothborder" name="ingreso" id="ingreso" required="" value="<?php echo $historia_laboral[$i]['fecha_retiro']; ?>" <?php echo $readonly; ?>/>
                                    </div>
                                </div>                                
                            </p>
                            <?php endfor; 
                                else: ?>
                                <p>
                                    <hr>
                                    <div class="row">
                                        <div class="twelve columns">
                                            <h3>No existe información para esta sección</h3>
                                        </div>
                                    </div>
                                </p>
                                <?php endif; ?> 
                          </div>
                          <div id="tabs-3">
                            <h2>Referencias Personales</h2>
                            <?php if (count($referencia_personal)>0 ):
                                for ($i=0; $i < count($referencia_personal); $i++):  ?>
                            <p>
                                <hr>
                                <div class="row">
                                    <div class="six columns">
                                        <label>Nombre</label>
                                        <input type="text" class="smoothborder" name="nom_referencia" id="nom_referencia" maxlength="100" required="" value="<?php echo $referencia_personal[$i]['nombre_ref']; ?>" <?php echo $readonly; ?>/>
                                    </div>
                                    <div class="six columns">
                                        <label>Parentesco</label>
                                        <input type="text" class="smoothborder" name="parentesco" id="parentesco" required="" value="<?php echo $referencia_personal[$i]['parentesco']; ?>" <?php echo $readonly; ?>/>
                                    </div>
                                    <div class="four columns">
                                        <label>Dirección</label>
                                        <input type="text" class="smoothborder" name="dir_referencia" id="dir_referencia" required="" value="<?php echo $referencia_personal[$i]['direccion_ref']; ?>" <?php echo $readonly; ?>/>
                                    </div>
                                    <div class="two columns">
                                        <label>Tipo Referencia</label>
                                        <input type="text" class="smoothborder" name="tip_referencia" id="tip_referencia" required="" value="<?php echo $referencia_personal[$i]['tipo_referencias']; ?>" <?php echo $readonly; ?>/>
                                    </div>
                                    <div class="two columns">
                                        <label>Teléfono</label>
                                        <input type="text" class="smoothborder" name="tel_referencia" id="tel_referencia" required="" value="<?php echo $referencia_personal[$i]['telefono_ref']; ?>" <?php echo $readonly; ?>/>
                                    </div>
                                    <div class="two columns">
                                        <label>Celular</label>
                                        <input type="text" class="smoothborder" name="cel_referencia" id="cel_referencia" value="<?php echo $referencia_personal[$i]['celular_ref']; ?>" <?php echo $readonly; ?>/>
                                    </div>                                    
                                </div>                                
                            </p>
                            <?php endfor; 
                                else: ?>
                                <p>
                                    <hr>
                                    <div class="row">
                                        <div class="twelve columns">
                                            <h3>No existe información para esta sección</h3>
                                        </div>
                                    </div>
                                </p>
                                <?php endif; ?>
                          </div>
                          <div id="tabs-4">
                            <h2>Funciones</h2>
                            <p>
                                <hr>
                                <div class="row">
                                    <div class="twelve columns">
                                        <h3>No existe información para esta sección</h3>
                                    </div>
                                </div>
                            </p>
                          </div> 
                          <div id="tabs-5">
                            <h2>Educación Formal</h2>
                            <?php if (count($educacion_formal)>0 ):
                                for ($i=0; $i < count($educacion_formal); $i++):  ?>
                            <p>
                                <hr>
                                <div class="row">
                                    <div class="six columns">
                                        <label>Nom. Institución</label>
                                        <input type="text" class="smoothborder" name="text" id="institucion" maxlength="100" required="" value="<?php echo $educacion_formal[$i]['institucion']; ?>" <?php echo $readonly; ?>/>
                                    </div>
                                    <div class="six columns">
                                        <label>Tip. Formación</label>
                                        <input type="text" class="smoothborder" name="tipo_form" id="tipo_form" required="" value="<?php echo $educacion_formal[$i]['tipo_formacion']; ?>" <?php echo $readonly; ?>/>
                                    </div>
                                    <div class="six columns">
                                        <label>Titulo Profesional</label>
                                        <input type="text" class="smoothborder" name="tit_profesional" id="tit_profesional" required="" value="<?php echo $educacion_formal[$i]['titulo_profesional']; ?>" <?php echo $readonly; ?>/>
                                    </div>
                                    <div class="four columns">
                                        <label>Titulo Obtenido</label>
                                        <input type="text" class="smoothborder" name="titulo_profesional" id="titulo_profesional" required="" value="<?php echo $educacion_formal[$i]['titulo_profesional']; ?>" <?php echo $readonly; ?>/>
                                    </div>
                                    <div class="two columns">
                                        <label>Año Egresado</label>
                                        <input type="text" class="smoothborder" name="anyo_egresado" id="anyo_egresado" maxlength="4" value="<?php echo $educacion_formal[$i]['anyo_egresado']; ?>" <?php echo $readonly; ?>/>
                                    </div>                                    
                                </div>                                
                            </p>
                            <?php endfor; 
                                else: ?>
                                <p>
                                    <hr>
                                    <div class="row">
                                        <div class="twelve columns">
                                            <h3>No existe información para esta sección</h3>
                                        </div>
                                    </div>
                                </p>
                                <?php endif; ?> 
                          </div>
                          <div id="tabs-6">
                            <h2>Formación Empresa</h2>
                            <p>
                                <?php if(count($formacion_empresa)>0): ?>
                                <table class="table table-bordered" style="width: 100%;">                                    
                                    <tr>
                                        <th>Nombre del Curso</th>
                                        <th>Calificación</th>   
                                    </tr>  
                                    <?php for ($i=0; $i < count($formacion_empresa); $i++) :  ?>
                                    <tr>
                                        <td><?php echo $formacion_empresa[$i]['nombre_curso']?></td> 
                                        <td style="text-align:center"><?php echo (is_null($formacion_empresa[$i]['aprobo_curso']) || $formacion_empresa[$i]['aprobo_curso'] == '' )?'En progreso':null; ?></td> 
                                    </tr>
                                    <?php endfor;?>  
                                </table>
                                <?php else: ?> 
                                    <hr>
                                    <div class="row">
                                        <div class="twelve columns">
                                            <h3>No existe información para esta sección</h3>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </p>
                          </div>                                                    
                        </div>
                    </div>

            </fieldset>
            </div>
            <div class="row botonera_form">
                <?php if( empty($_REQUEST['id']) || !isset($_REQUEST['id'])):?>
                    <a href="javascript:enviar();" class="success button">Guardar</a>
                <?php endif; ?>
                <a href="javascript:history.back()" class="alert button">Volver</a>
            </div>
        </form>
    </div>
    </div>
</div>
<?php require_once('commons/footer_int.php'); ?>