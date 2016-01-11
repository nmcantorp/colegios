<?php 
session_start();

/**
* Clase para la funcionalidad del logueo de los usuarios 
*/
include_once('conexion.php');

class ClassCiudad extends ClassConexion
{
    /**
    * Valida la información del logueo 
    * @param varchar $usuario
    * @param varchar $pass
    * 
    * return boolean   
    */
    function get_Ciudades()
    {

        $db = new ClassConexion();
        $ingreso = false;

        $query="SELECT
                ciudades.id_ciudad,
                ciudades.nombre_ciudad,
                ciudades.cod_postal,
                ciudades.id_departamento,
                ciudades.fecha_creacion,
                ciudades.usuario_creador,
                ciudades.fecha_modificacion,
                ciudades.usuario_modificador,
                departamentos.nombre_departamento,
                paises.nombre_pais
                FROM
                ciudades
                INNER JOIN departamentos ON ciudades.id_departamento = departamentos.id_departamento
                INNER JOIN paises ON departamentos.id_pais = paises.id_pais";
        $consulta = $db->consulta($query);		
          
        return $consulta;  
    }
}



?>