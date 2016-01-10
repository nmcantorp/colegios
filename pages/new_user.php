<?php session_start();
require_once('../comunes/up_pages_inter.php');
require_once('../class/users.php');

/*Clases*/
$obj_user = new ClassUser();

if($_REQUEST['add'] == 1)
{
	$obj_user->saveuser($_REQUEST['usuario'],$_REQUEST['email'],$_REQUEST['profile'],$_REQUEST['pass'], $_SESSION['tokenb']);
	header('Location: users.php');
}

/*Metodos*/
$resultado_profiles = $obj_user->get_Profiles();

?>

<form role="form" action="?add=1" method="post" accept-charset="utf-8" class="user">
  	<div class="form-group">
    	<label for="usuario">Usuario</label>
		<input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" required="required">
  	</div>
  	<div class="form-group">
    	<label for="email">Email Usuario</label>
    	<input type="email" class="form-control" id="email" name="email" placeholder="Email Usuario" required="required">
  	</div>
  	<div class="form-group">
  		<label for="email">Perfil Usuario</label>
	  	<select name="profile" id="profile">
	  		<option value="">Seleccione un Perfil</option>
	  		<?php for ($i=0; $i < count($resultado_profiles); $i++) { ?> 
	  			<option value="<?php echo $resultado_profiles[$i]['id_profile']; ?>"><?php echo $resultado_profiles[$i]['name_profile']; ?></option>}
	  			
	  		<?php } ?>
	  	</select>
  	</div>
  	<div class="form-group">
    	<label for="pass">Contraseña Temporal</label>
    	<input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña Termporal" required="required">
  	</div>

  	<button type="submit" class="btn btn-default">Submit</button>
</form> 


<?php 
require_once('../comunes/down_pages_inter.php');
 ?>