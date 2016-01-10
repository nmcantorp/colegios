<?php 
session_start();
/**
* Clase para la funcionalidad del logueo de los usuarios 
*/
include_once('conexion.php');

class ClassMenu extends ClassConexion
{	
	public $resultado = array();
	
	function __construct()
	{
		# code...
	}
	
	function get_menu($data){
		$db = new ClassConexion();
		$db->MySQL();

		$query = "SELECT
			menu.name_menu,
			menu.link,
			menu.parent,
			menu.id_menu,
			menu.orden,
			menu_x_profiles.id_profile
			FROM
			menu
			Inner Join menu_x_profiles ON menu.id_menu = menu_x_profiles.id_menu
			where
			menu_x_profiles.id_profile = '$data'
			AND
			menu.parent = '0'
			AND
			menu.status = '1'
			GROUP BY
			menu.name_menu
			ORDER BY
			menu.id_menu ASC,
			menu.parent ASC,
			menu.orden ASC";

		$consulta = $db->consulta($query);
		
		if($db->num_rows($consulta)>0){ $conteo=0;
		  while($resultados = $db->fetch_array($consulta)){ 
		  	$this->resultado[$conteo]['name_menu']=$resultados['name_menu'];
		  	$this->resultado[$conteo]['link']=$resultados['link'];
		  	$this->resultado[$conteo]['parent']=$resultados['parent'];
		  	$this->resultado[$conteo]['id_menu']=$resultados['id_menu'];
		  	$this->resultado[$conteo]['orden']=$resultados['orden'];
		  	$this->resultado[$conteo]['id_profile']=$resultados['id_profile'];
		   	$conteo++;
		 }
		   return $this->resultado;
		}
	}

	function get_sub($data){
		$db = new ClassConexion();
		$db->MySQL();

		$query = "SELECT
			menu.name_menu,
			menu.link,
			menu.parent,
			menu.id_menu,
			menu.orden,
			menu_x_profiles.id_profile
			FROM
			menu
			Inner Join menu_x_profiles ON menu.id_menu = menu_x_profiles.id_menu
			where
			menu_x_profiles.id_profile = $data
			AND
			menu.parent >  '0'
			AND
			menu.status = '1'
			GROUP BY
			menu.name_menu
			ORDER BY
			menu.id_menu ASC,
			menu.parent ASC,
			menu.orden ASC";
			//echo $query;die();
		$consulta = $db->consulta($query);
		
		if($db->num_rows($consulta)>0){ $conteo=0;
		  while($resultados = $db->fetch_array($consulta)){ 
		  	$this->resultado[$conteo]['name_menu']=$resultados['name_menu'];
		  	$this->resultado[$conteo]['link']=$resultados['link'];
		  	$this->resultado[$conteo]['parent']=$resultados['parent'];
		  	$this->resultado[$conteo]['id_menu']=$resultados['id_menu'];
		  	$this->resultado[$conteo]['orden']=$resultados['orden'];
		  	$this->resultado[$conteo]['id_profile']=$resultados['id_profile'];
		   	$conteo++;
		 }
		   return $this->resultado;
		}
	}

}
?>