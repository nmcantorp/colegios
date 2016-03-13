<?php require_once('commons/header_int.php');
      require_once('../clases/table_filter.php');
      
      /**
      * Antes de hacer el llamado a la clase de deben definir los botones que va a tener la 
      * tabla, se genera una matriz con esta informacion
      */
      
      $botones = array('STDCTRL_SEG'    => array('mensaje'  =>NULL,
                                                 'href'     =>'persona.php?id=%id_persona%'
                                                 )
                        );
      $bonton_crear = array('mensaje'  =>NULL,
                            'href'     =>'persona.php');

      /**
      * Se hace el llamado a la clase para la creación de la tabla
      */
      $objTable  = new ClassTabla($botones, true,$bonton_crear);
      
      /**
      * Se le indica en un arreglo los campos de la tabla a mostrar y como se van a visualizar
      * Donde el key de los valores del arrego es el campo en la tabla y en valor del arreglo 
      * es como se va a visualizar 
      */ 
      
      $campos =array('id_persona'        =>'Id',
                    'doc_identidad'     =>'D.N.I',
                    'nombre_completo'   =>'Nombres',
                    'genero'            =>'Genero',
                    'fecha_nac'         =>'F. Nacimiento',
                    'email'             =>'Email');
      
      /**
      * si se desea ocultar una columna se crea un arreglo con cada campo a ocultar
      */
      
      $ocultar = array('id_persona');
      
      $objTable->crear_consultas($campos, 'personas', 'id_persona', '', $ocultar);
      
?>
<link href="../stylesheets/grilla.css" rel="stylesheet" type="text/css">
<!-- SUBHEADER
================================================== -->
<div id="subheader">
	<div class="row">
		<div class="twelve columns">
			<p class="text-center">
				 <font style="font-size:22px; color:#FFFFFF;">Lista de Personal</font>
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
        <?php $objTable->imprimir_tabla(); ?>        
    </div>
    </div>
</div>
<?php require_once('commons/footer_int.php'); ?>