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
		
	   	return $consulta;
	}

	function get_sub($data, $id_menu){
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
			menu.parent =  '$id_menu'
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

	   	return $consulta;
	}

}
?>