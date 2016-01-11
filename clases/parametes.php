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
		
        for($i=0; $i<count($consulta);$i++)
        {
           define($consulta[$i]['parameter_key'], $consulta[$i]['parameter_value'], true); 
        }
	}

}
?>