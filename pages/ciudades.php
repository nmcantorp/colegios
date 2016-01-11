<?php session_start();
require_once('commons/header_int.php');
require_once('../clases/ciudad.php');

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
<div class="row">
<div class="four columns">
  <table>
  	<thead>
	    <tr>
	    	<th>Nombre Ciudad</th>
	    	<th>Departamento</th>
	    	<th>Pais</th>
	    	<th>Acciones</th>
	    </tr>
    </thead>
    <tbody>
    <?php if(count($resultado_ciudad)>0):
    for($i=0; $i<count($resultado_ciudad) ; $i++): ?>
		<tr>
			<td><?php echo $resultado_ciudad[$i]['nombre_ciudad'] ?></td>
			<td><?php echo $resultado_ciudad[$i]['nombre_departamento'] ?></td>
			<td><?php echo $resultado_ciudad[$i]['nombre_pais'] ?></td>
			<td><!--<div class="dropdown">
				  <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    Seleccione una opci&oacute;n
				    <span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
				    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Actualizar</a></li>
				    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Borrar</a></li>
				  </ul>
				</div>-->
			</td>
		</tr>
	<?php 
	endfor;
	endif; ?>
	</tbody>
  </table>
</div>
</div>
<?php 
require_once('commons/footer_int.php');
 ?>