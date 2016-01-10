<?php 
session_start();
/**
* Clase para la funcionalidad del logueo de los usuarios 
*/
include_once('conexion.php');

class ClassParameters extends ClassConexion
{	
	public $resultado = array();
	
	function __construct()
	{
		# code...
	}
	
	function get_Parameters(){
		$db = new ClassConexion();
		$db->MySQL();

		$query = "SELECT
		parameter.id_par,
		parameter.parameter_key,
		parameter.parameter_value,
		parameter.description,
		parameter.show_parameter,
		parameter.parameter_type,
		parameter.created,
		parameter.modified
		FROM
		parameter
		WHERE
		parameter.show_parameter = 1";

		$consulta = $db->consulta($query);
		
		if($db->num_rows($consulta)>0){ $conteo=0;
		  while($resultados = $db->fetch_array($consulta)){ 
		  	define($resultados['parameter_key'], $resultados['parameter_value'], true);
		 }

		}
	}

}
?>