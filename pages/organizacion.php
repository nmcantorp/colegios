<?php require_once('commons/header_int.php');
      require_once('../clases/organizacion.php');
      
      $obj_organizacion = new ClassOrganizacion();
      
      $result = $obj_organizacion->get_Organizacion();
      
       require_once('../clases/table_filter.php');
      
      /**
      * Antes de hacer el llamado a la clase de deben definir los botones que va a tener la 
      * tabla, se genera una matriz con esta informacion
      */
      
      $botones = array('STDCTRL_SEG'    => array('mensaje'  =>NULL,
                                                 'href'     =>'organizacion_nueva.php?id=%organizaciones.id_organizacion%'
                                                 )
                        );
      $bonton_crear = array('mensaje'  =>NULL,
                            'href'     =>'organizacion_nueva.php');
      /**
      * Se hace el llamado a la clase para la creación de la tabla
      */ 
      $objTable  = new ClassTabla($botones, true,$bonton_crear);
      
      /**
      * Se le indica en un arreglo los campos de la tabla a mostrar y como se van a visualizar
      * Donde el key de los valores del arrego es el campo en la tabla y en valor del arreglo 
      * es como se va a visualizar 
      */ 
      
      $campos =array('nit_empresa'        =>'Nit Empresa',
                    'nombre_empresa'      =>'Nombre Empresa',
                    'id_organizacion'     =>'Id persona');
      
      /**
      * si se desea ocultar una columna se crea un arreglo con cada campo a ocultar
      */
      
      $ocultar = array('id_organizacion');
      $tabla = "organizaciones";
      $objTable->crear_consultas($campos, $tabla, 'id_organizacion', '', $ocultar);
      
?>
<link href="../stylesheets/grilla.css" rel="stylesheet" type="text/css">
<!-- SUBHEADER
================================================== -->
<div id="subheader">
	<div class="row">
		<div class="twelve columns">
			<p class="text-center">
				 <font style="font-size:22px; color:#FFFFFF;">Organizaciones</font>
			</p>
		</div>
	</div>
</div>
<div class="row content">
    <div class="row">
    <hr>
    <div class="twelve columns" >
        <div class="clear"></div>
<!--        <div class="row botonera">
            <a href="organizacion_nueva.php" class="button">Nuevo</a>
            <a href="#" class="success button">Button</a>
        </div>-->
        <?php $objTable->imprimir_tabla(); ?>        
    </div>
    </div>
</div>
<!-- ANIMATED COLUMNS 
================================================== -->

<?php require_once('commons/footer_int.php'); ?>