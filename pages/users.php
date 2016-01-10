<?php session_start();
require_once('../comunes/up_pages_inter.php');
require_once('../class/users.php');
//require_once('../class/modal.php');
/*Clases*/
$obj_user = new ClassUser();

/*Metodos*/
$resultado_user = $obj_user->get_Users();

?>
<div id="botones">
    <a class="btn btn-primary btn-lg" href="new_user.php" role="button">Agregar</a>
</div>
<?php
/*Paginacion*/
$objPaginator = new ClassPaginator();
if(!isset($_REQUEST['pg'])) $_REQUEST['pg']=1;
$pagina_actual = $_REQUEST['pg'];

$resultado_usuario = $objPaginator->create_paginator($resultado_user, $_REQUEST['pg']);
/*Fin Paginacion*/
?>

<div class="table">
  <table class="table table-bordered table-hover">
  	<thead>
	    <tr>
	    	<th>Id</th>
	    	<th>Usuario</th>
	    	<th>Perfil</th>
	    	<th width='19%'>Acciones</th>
	    </tr>
    </thead>
    <tbody>
    <?php if(count($resultado_usuario)>0):
    for($i=0; $i<count($resultado_usuario) ; $i++): ?>
		<tr>
			<td><?php echo $resultado_usuario[$i]['Id_usuario'] ?></td>
			<td><?php echo $resultado_usuario[$i]['Usuario'] ?></td>
			<td><?php echo $resultado_usuario[$i]['name_profile'] ?></td>
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