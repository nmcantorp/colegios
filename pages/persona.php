<?php require_once('commons/header_int.php');
      require_once('../clases/ciudad.php');
      require_once('../clases/personas.php');
      require_once('../clases/historial_laboral.php');
      require_once('../clases/organizacion.php');
      require_once('../clases/cargos.php');
      require_once('../clases/valor_definicion.php');
      require_once('../clases/asignacion.php');

      /*Clases*/
      $obj_ciudad       = new ClassCiudad();
      $obj_Persona      = new ClassPersonas();
      $obj_Organizacion = new ClassOrganizacion();
      $obj_Cargos       = new ClassCargos();
      $obj_Valor        = new ClassValDefinicion();
      $obj_Asignacion   = new ClassAsignacion();

      /*Metodos*/
      $resultado_ciudad = $obj_ciudad->get_Ciudades();
      $organizaciones   = $obj_Organizacion->get_Organizacion('nombre_empresa ASC');
      $cargos           = $obj_Cargos->get_Cargos('descripcion_cargo ASC');
      $valor_def        = $obj_Valor->get_Definiciones('S', 'TIPO_FORMACION');
      $valor_def        = $obj_Valor->get_Definiciones('S', 'TIPO_FORMACION');

      $readonly = null;

      if($_REQUEST['ac'] == 'save')
      {
        $result         = $obj_Persona->getPersonabyDNI($_REQUEST['doc_identidad']);
        $info_ciudad    = $obj_ciudad->get_Ciudades($_REQUEST['ciudad']);

        if(count($result)<= 0  ){
            $data = array(  'doc_identidad' => $_REQUEST['doc_identidad'],
                            'fecha_nac' => $_REQUEST['fecha_nac'],
                            'primer_nom' => $_REQUEST['primer_nom'],
                            'segundo_nom' => $_REQUEST['segundo_nom'],
                            'primer_ape' => $_REQUEST['primer_ape'],
                            'segundo_ape' => $_REQUEST['segundo_ape'],
                            'nombre_completo' => $_REQUEST['primer_nom']." ". $_REQUEST['segundo_nom']." ". $_REQUEST['primer_ape']." ". $_REQUEST['segundo_ape'],
                            'genero' => $_REQUEST['genero'],
                            'id_departamento' => $info_ciudad[0]['id_departamento'],
                            'id_ciudad' => $info_ciudad[0]['id_ciudad'],
                            'telefono' => $_REQUEST['telefono'],
                            'celular' => $_REQUEST['celular'],
                            'direccion' => $_REQUEST['direccion'],
                            'email' => $_REQUEST['email'],
                            'activo' => 'S',
                            'fecha_creacion' => 'now()',
                            'usuario_creador' => $_SESSION['id_usuario'],
                            'fecha_creador' => 'now()',
                            'tipo_referencia0'=>$_REQUEST['tip_referencia_0'],
                            'nombre_ref0'=>$_REQUEST['nom_referencia_0'],
                            'telefono_ref0'=>$_REQUEST['tel_referencia_0'],
                            'celular_ref0'=>$_REQUEST['cel_referencia_0'],
                            'direccion_ref0'=>$_REQUEST['dir_referencia_0'],
                            'tipo_referencia1'=>$_REQUEST['tip_referencia_1'],
                            'nombre_ref1'=>$_REQUEST['nom_referencia_1'],
                            'telefono_ref1'=>$_REQUEST['tel_referencia_1'],
                            'celular_ref1'=>$_REQUEST['cel_referencia_1'],
                            'direccion_ref1'=>$_REQUEST['dir_referencia_1'],
                            'empresa_asigna'=>$_REQUEST['empresa_asigna'],
                            'cargo_asigna'=>$_REQUEST['cargo_asigna'],
                            'ingreso_asigna'=>$_REQUEST['ingreso_asigna'],
                            'retiro_asigna'=>$_REQUEST['retiro_asigna'],
                            'estado_asigna'=>((is_null($_REQUEST['retiro_asigna']) || $_REQUEST['retiro_asigna'] == '' )?'S':'N'),
                            'institucion'=>$_REQUEST['institucion'],
                            'titulo_profesional'=>1,
                            'tipo_formacion'=>$_REQUEST['titulo_profesional'],
                            'empresa'=>$_REQUEST['empresa'],
                            'cargo'=>$_REQUEST['cargo'],
                            'jefe'=>$_REQUEST['jefe'],
                            'contacto_jefe'=>$_REQUEST['tel'],
                            'ext_jefe'=>$_REQUEST['ext'],
                            'ingreso'=>$_REQUEST['ingreso'],
                            'retiro'=>$_REQUEST['retiro'],
                            );
            $resultado = $obj_Persona->save_persona($data);
            header("Location: persona_list.php");
        }   
      }elseif( !empty($_REQUEST['id']) && is_numeric($_REQUEST['id']))
      {
          $info_persona = $obj_Persona->get_Persona_id($_REQUEST['id']);
          $readonly = 'readonly';
          $disabled = 'disabled';
          
          $historia_laboral     = $obj_Persona->getHistoriaLab($_REQUEST['id']);
          $educacion_formal     = $obj_Persona->getEduFormal($_REQUEST['id']);
          $referencia_personal  = $obj_Persona->getReferenciaPersonal($_REQUEST['id']);
          $formacion_empresa    = $obj_Persona->getFormacionEmpresa($_REQUEST['id']);
          $asignacion           = $obj_Asignacion->get_AsignacionByUser($_REQUEST['id']);
          $cargos               = $obj_Asignacion->get_AsignacionByUser($_REQUEST['id']);
      }
      
      
?>
<script src="../javascripts/funciones_especificas/personas.js"></script>
<!-- SUBHEADER
================================================== -->
<div id="subheader">
	<div class="row">
		<div class="twelve columns">
			<p class="text-center">
				 <font style="font-size:22px; color:#FFFFFF;">Informaci&oacute;n Personal</font>
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
        <form  name="lugares" action="?ac=save" method="post" id="lugares" onSubmit="return validar(this.email.value)">
            <fieldset>
                <legend>Datos Personales</legend>
                <div class="row">
                    <div class="foto three columns">
                        <?php if( !is_null($info_persona[0]['foto']) && $info_persona[0]['foto'] != '' ){ ?>
                            <img src="../images/avatar/<?php echo $info_persona[0]['foto']; ?>" alt="" width="80" class="avatar_inter"/>
                        <?php }else{ ?>
                            <img src="../images/gravatar.png" alt="" width="80" class="avatar_inter"/>
                         <?php } ?>
                    </div>
                    <div class="four columns">
                        <label>Primer Nombre</label>
                        <input type="text" class="smoothborder" name="primer_nom" id="primer_nom" maxlength="20" required="" value="<?php echo $info_persona[0]['primer_nom']; ?>" <?php echo $readonly; ?>/>
                    </div>
                    <div class="four columns">
                        <label>Segundo Nombre</label>
                        <input type="text" class="smoothborder" name="segundo_nom" id="segundo_nom" maxlength="20" value="<?php echo $info_persona[0]['segundo_nom']; ?>" <?php echo $readonly; ?>/>
                    </div>

                    <div class="four columns">
                        <label>Primer Apellido</label>
                        <input type="text" class="smoothborder" name="primer_ape" id="primer_ape" maxlength="20" required="" value="<?php echo $info_persona[0]['primer_ape']; ?>" <?php echo $readonly; ?>/>
                    </div>
                    <div class="four columns">
                        <label>Segundo Apellido</label>
                        <input type="text" class="smoothborder" name="segundo_ape" id="segundo_ape" maxlength="20" value="<?php echo $info_persona[0]['segundo_ape']; ?>" <?php echo $readonly; ?>/>
                    </div>
                    <div class="three columns">
                        <label>Documento de Identidad (D.N.I)</label>
                        <input type="text" class="smoothborder" name="doc_identidad" id="doc_identidad" maxlength="15" onkeypress="return numero(event);" required="" value="<?php echo $info_persona[0]['doc_identidad']; ?>" <?php echo $readonly; ?>/>
                    </div>
                    <div class="three columns">
                        <label>Fecha de Nacimiento</label>
                        <input type="date" class="smoothborder" name="fecha_nac" id="fecha_nac" required="" value="<?php echo $info_persona[0]['fecha_nac']; ?>" <?php echo $readonly; ?>/>
                    </div> 
                    <div class="three columns">
                        <label>Genero</label>
                        <select class="smoothborder" id="genero" name="genero" required="" <?php echo $disabled; ?>>
                            <option value=""></option>
                            <option value="M" <?php echo ($info_persona[0]['genero'] == 'M')?'selected':null; ?>>Masculino</option>
                            <option value="F" <?php echo ($info_persona[0]['genero'] == 'F')?'selected':null; ?>>Femenino</option>
                        </select>
                    </div>
                </div>
                <div class="row">
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
                            <?php if (count($asignacion)>0 && !empty($_REQUEST['id'])):
                                for ($i=0; $i < count($asignacion); $i++): 
                                    $checked = ($asignacion[$i]['estado'] == 1)?'checked':'';
                                 ?>
                            <p>
                                <hr>
                                <div class="row">
                                    <div class="six columns">
                                        <label>Nom. Empresa</label>
                                        <input type="text" class="smoothborder" name="text" id="empresa" maxlength="100" required="" value="<?php echo $asignacion[$i]['nombre_empresa']; ?>" <?php echo $readonly; ?>/>
                                    </div>
                                    <div class="six columns">
                                        <label>Cargo</label>
                                        <input type="text" class="smoothborder" name="cargo" id="cargo" required="" value="<?php echo $asignacion[$i]['descripcion_cargo']; ?>" <?php echo $readonly; ?>/>
                                    </div>
                                    <div class="row">
                                        <div class="three columns">
                                            <label>F. Ingreso</label>
                                            <input type="text" class="smoothborder" name="ingreso" id="ingreso" required="" value="<?php echo $asignacion[$i]['fecha_ini']; ?>" <?php echo $readonly; ?>/>
                                        </div>
                                        <div class="three columns">
                                            <label>F. Retiro</label>
                                            <input type="text" class="smoothborder" name="retiro" id="retiro" required="" value="<?php echo $asignacion[$i]['fecha_fin']; ?>" <?php echo $readonly; ?>/>
                                        </div>
                                        <div class="three columns">
                                            <label>Estado</label>
                                            <input type="checkbox" class="smoothborder" name="estado" id="estado" required="" value="<?php echo $asignacion[$i]['estado']; ?>" <?php echo $readonly; ?> <?php echo $checked;?> <?php echo $disabled; ?>/>
                                        </div>
                                         <div class="three columns">
                                         </div>
                                    </div>
                                </div>                                
                            </p>
                            <?php endfor; 
                                elseif(count($asignacion)<=0 && !empty($_REQUEST['id'])): ?>
                                <p>
                                    <hr>
                                    <div class="row">
                                        <div class="twelve columns">
                                            <h3>No existe información para esta sección</h3>
                                        </div>
                                    </div>
                                </p>
                                
                            <?php else: ?>
                            <p>
                                <hr>
                                <div class="row">
                                    <div class="six columns">
                                        <label>Nom. Empresa</label>
                                        <select class="chosen-select" name="empresa_asigna" id="empresa_asigna" data-placeholder="Seleccione empresa" multiple required>
                                            <?php for ($i=0; $i < count($organizaciones); $i++) { ?>
                                                <option value="<?php echo $organizaciones[$i]['id_organizacion']; ?>"><?php echo $organizaciones[$i]['nombre_empresa']; ?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="six columns">
                                        <label>Cargo</label>
                                        <select class="chosen-select" name="cargo_asigna" id="cargo_asigna" data-placeholder="Seleccione un cargo" multiple required>
                                            <?php for ($i=0; $i < count($cargos); $i++) { ?>
                                                <option value="<?php echo $cargos[$i]['id_cargo']; ?>"><?php echo $cargos[$i]['descripcion_cargo']; ?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="three columns">
                                            <label>F. Ingreso</label>
                                            <input type="date" class="smoothborder" name="ingreso_asigna" id="ingreso_asigna" required="" />
                                        </div>
                                        <div class="three columns">
                                            <label>F. Retiro</label>
                                            <input type="date" class="smoothborder" name="retiro_asigna" id="retiro_asigna" />
                                        </div>
                                        <div class="three columns">
                                            <label>Estado</label>
                                            <input type="checkbox" class="smoothborder" name="estado_asigna" id="estado_asigna" value="<?php echo $asignacion[$i]['estado']; ?>" <?php echo $readonly; ?> <?php echo $checked;?> <?php echo $disabled; ?>/>
                                        </div>
                                         <div class="three columns">
                                         </div>
                                    </div>
                                </div>                                
                            </p>

                            <?php 
                                endif; ?>
                          </div>
                          <div id="tabs-2">
                            <h2>Experiencia Laboral</h2>
                            <?php if (count($historia_laboral)>0 && !empty($_REQUEST['id'])):
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
                                elseif(count($historia_laboral)<=0 && !empty($_REQUEST['id'])): ?>
                                <p>
                                    <hr>
                                    <div class="row">
                                        <div class="twelve columns">
                                            <h3>No existe información para esta sección</h3>
                                        </div>
                                    </div>
                                </p>
                                
                            <?php else: ?> 
                            <p>
                                <hr>
                                <div class="row">
                                    <div class="six columns">
                                        <label>Nom. Empresa</label>
                                        <select class="chosen-select" name="empresa" id="empresa" data-placeholder="Seleccione empresa" multiple required width="100%">
                                            <?php for ($i=0; $i < count($organizaciones); $i++) { ?>
                                                <option value="<?php echo $organizaciones[$i]['id_organizacion']; ?>"><?php echo $organizaciones[$i]['nombre_empresa']; ?></option>
                                            <?php }?>
                                        </select>                                       
                                    </div>
                                    <div class="six columns">
                                        <label>Cargo</label> 
                                        <select class="chosen-select" name="cargo" id="cargo" data-placeholder="Seleccione un cargo" multiple required>
                                            <?php for ($i=0; $i < count($cargos); $i++) { ?>
                                                <option value="<?php echo $cargos[$i]['id_cargo']; ?>"><?php echo $cargos[$i]['descripcion_cargo']; ?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="three columns">
                                        <label>Jefe Inmediato</label>
                                        <input type="text" class="smoothborder" name="jefe" id="jefe" required="" value="<?php echo $historia_laboral[$i]['jefe_inmediato']; ?>" <?php echo $readonly; ?>/>
                                    </div>
                                    <div class="two columns">
                                        <label>Tel. Contacto</label>
                                        <input type="text" class="smoothborder" name="tel" id="tel" required="" value="<?php echo $historia_laboral[$i]['telcontacto']; ?>" <?php echo $readonly; ?>/>
                                    </div>
                                    <div class="one columns">
                                        <label>Ext.</label>
                                        <input type="text" class="smoothborder" name="ext" id="ext" value="<?php echo $historia_laboral[$i]['extension']; ?>" <?php echo $readonly; ?>/>
                                    </div>
                                    <div class="three columns">
                                        <label>F. Ingreso</label>
                                        <input type="date" class="smoothborder" name="ingreso" id="ingreso" required="" value="<?php echo $historia_laboral[$i]['fecha_ingreso']; ?>" <?php echo $readonly; ?>/>
                                    </div>
                                    <div class="three columns">
                                        <label>F. Retiro</label>
                                        <input type="date" class="smoothborder" name="retiro" id="retiro" required="" value="<?php echo $historia_laboral[$i]['fecha_retiro']; ?>" <?php echo $readonly; ?>/>
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
                                elseif(count($referencia_personal)<=0 && !empty($_REQUEST['id'])): ?>
                                <p>
                                    <hr>
                                    <div class="row">
                                        <div class="twelve columns">
                                            <h3>No existe información para esta sección</h3>
                                        </div>
                                    </div>
                                </p>
                                
                            <?php else:
                                for ($i=0; $i < 2; $i++) : ?>
                            
                               <p>
                                <hr>
                                <div class="row">
                                    <div class="six columns">
                                        <label>Nombre</label>
                                        <input type="text" class="smoothborder" name="nom_referencia_<?php echo $i; ?>" id="nom_referencia_<?php echo $i; ?>" maxlength="100" required="" value="<?php echo $referencia_personal[$i]['nombre_ref']; ?>" <?php echo $readonly; ?>/>
                                    </div>
                                    <div class="six columns">
                                        <label>Parentesco</label>
                                        <input type="text" class="smoothborder" name="parentesco_<?php echo $i; ?>" id="parentesco_<?php echo $i; ?>" required="" value="<?php echo $referencia_personal[$i]['parentesco']; ?>" <?php echo $readonly; ?>/>
                                    </div>
                                    <div class="four columns">
                                        <label>Dirección</label>
                                        <input type="text" class="smoothborder" name="dir_referencia_<?php echo $i; ?>" id="dir_referencia_<?php echo $i; ?>" required="" value="<?php echo $referencia_personal[$i]['direccion_ref']; ?>" <?php echo $readonly; ?>/>
                                    </div>
                                    <div class="three columns">
                                        <label>Tipo Referencia</label>
                                        <select class="chosen-select" name="tip_referencia_<?php echo $i; ?>" id="tip_referencia_<?php echo $i; ?>" data-placeholder="Tipo referencia" multiple required>
                                            <option value="P">Personal</option>                                            
                                            <option value="F">Familiar</option>                                            
                                        </select>                                        
                                    </div>
                                    <div class="two columns">
                                        <label>Teléfono</label>
                                        <input type="text" class="smoothborder" name="tel_referencia_<?php echo $i; ?>" id="tel_referencia_<?php echo $i; ?>" required="" value="<?php echo $referencia_personal[$i]['telefono_ref']; ?>" <?php echo $readonly; ?>/>
                                    </div>
                                    <div class="two columns">
                                        <label>Celular</label>
                                        <input type="text" class="smoothborder" name="cel_referencia_<?php echo $i; ?>" id="cel_referencia_<?php echo $i; ?>" value="<?php echo $referencia_personal[$i]['celular_ref']; ?>" <?php echo $readonly; ?>/>
                                    </div>                                    
                                </div>                                
                            </p>
                            <?php endfor;  endif; ?>
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
                                        <input type="text" class="smoothborder" name="institucion" id="institucion" maxlength="100" required="" value="<?php echo $educacion_formal[$i]['institucion']; ?>" <?php echo $readonly; ?>/>
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
                                elseif(count($educacion_formal)<=0 && !empty($_REQUEST['id'])): ?>
                                <p>
                                    <hr>
                                    <div class="row">
                                        <div class="twelve columns">
                                            <h3>No existe información para esta sección</h3>
                                        </div>
                                    </div>
                                </p>
                                
                            <?php else: ?>
                                <p>
                                    <hr>
                                    <div class="row">
                                        <div class="six columns">
                                            <label>Nom. Institución</label>
                                            
                                            <select class="chosen-select" name="institucion" id="institucion" data-placeholder="Seleccione Institución" multiple required>
                                                <?php for ($i=0; $i < count($organizaciones); $i++) { ?>
                                                    <option value="<?php echo $organizaciones[$i]['id_organizacion']; ?>"><?php echo $organizaciones[$i]['nombre_empresa']; ?></option>
                                                <?php }?>
                                            </select> 
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
                                            <select class="chosen-select" data-placeholder="Elige tu titulo" style="width:350px;" name="titulo_profesional" id="titulo_profesional" multiple required>
                                            <?php for ($i=0; $i < count($valor_def); $i++) { ?>
                                                <option value="<?php echo $valor_def[$i]['id_valor_def']; ?>"><?php echo $valor_def[$i]['valor_definicion']; ?></option> 
                                            <?php }?>
                                            </select>                                            
                                        </div>
                                        <div class="two columns">
                                            <label>Año Egresado</label>
                                            <input type="text" class="smoothborder" name="anyo_egresado" id="anyo_egresado" maxlength="4" value="<?php echo $educacion_formal[$i]['anyo_egresado']; ?>" <?php echo $readonly; ?>/>
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
                                        <th>Nota</th>   
                                        <th>Calificación</th>   
                                    </tr>  
                                    <?php for ($i=0; $i < count($formacion_empresa); $i++) :  ?>
                                    <tr>
                                        <td><?php echo $formacion_empresa[$i]['nombre_curso']?></td> 
                                        <td style="text-align:center"><?php echo (is_null($formacion_empresa[$i]['aprobado']) || $formacion_empresa[$i]['aprobado'] == '' )?'-':$formacion_empresa[$i]['aprobado']; ?></td> 
                                        <td style="text-align:center"><?php echo (is_null($formacion_empresa[$i]['aprobado']) || $formacion_empresa[$i]['aprobado'] == '' )?'En progreso':((int)$formacion_empresa[$i]['aprobado'] < 4? 'Reprobó' : 'Aprobó' ); ?></td> 
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
                    <a href="javascript:reset();" class="alert button">Limpiar</a>
                <?php endif; ?>
                <a href="javascript:history.back()" class="alert button">Volver</a>
            </div>
        </form>
    </div>
    </div>
</div>
<?php require_once('commons/footer_int.php'); ?>