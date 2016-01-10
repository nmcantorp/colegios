<?php session_start();
require_once('../comunes/up_pages_inter.php');
require_once('../class/ciudad.php');
require_once('../class/modal.php');
/*Clases*/
$obj_ciudad  = new ClassCiudad();

/*Metodos*/
$resultado_ciudad = $obj_ciudad->get_Ciudades();

/*Paginacion*/
$objPaginator = new ClassPaginator();
if(!isset($_REQUEST['pg'])) $_REQUEST['pg']=1;
$pagina_actual = $_REQUEST['pg'];

$resultado_ciudad = $objPaginator->create_paginator($resultado_ciudad, $_REQUEST['pg']);
/*Fin Paginacion*/
?>
<div class="table">
  <table class="table table-bordered table-hover">
  	<thead>
	    <tr>
	    	<th>Nombre Ciudad</th>
	    	<th>Departamento</th>
	    	<th>Pais</th>
	    	<th width='19%'>Acciones</th>
	    </tr>
    </thead>
    <tbody>
    <?php if(count($resultado_ciudad)>0):
    for($i=0; $i<count($resultado_ciudad) ; $i++): ?>
		<tr>
			<td><?php echo $resultado_ciudad[$i]['nombre_ciudad'] ?></td>
			<td><?php echo $resultado_ciudad[$i]['nombre_departamento'] ?></td>
			<td><?php echo $resultado_ciudad[$i]['nombre_pais'] ?></td>
			<td><div class="dropdown">
				  <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    Seleccione una opci&oacute;n
				    <span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
				    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Actualizar</a></li>
				    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Borrar</a></li>
				  </ul>
				</div>
			</td>
		</tr>
	<?php 
	endfor;
	endif; ?>
	</tbody>
  </table>
</div>

<?php 
require_once('../comunes/down_pages_inter.php');
 ?>