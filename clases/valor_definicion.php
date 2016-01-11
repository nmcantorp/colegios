<?php 
session_start();

/**
* Clase para la funcionalidad del logueo de los usuarios 
*/
include_once('conexion.php');

class ClassValDefinicion extends ClassConexion
{
    /**
    * Valida la información del logueo 
    * @param varchar $usuario
    * @param varchar $pass
    * 
    * return boolean   
    */
    function get_Definiciones($valor)
    {

        $db = new ClassConexion();
        $ingreso = false;

        $query="SELECT
                valores_definiciones.id_valor_def,
                valores_definiciones.valor_definicion,
                valores_definiciones.desc_valor_def
                FROM
                valores_definiciones
                INNER JOIN tipo_definicion ON valores_definiciones.id_tipo_definicion = tipo_definicion.id_tipo_definicion
                WHERE
                valores_definiciones.activo = 'S' AND
                tipo_definicion.tipo_definicion = '$valor'
                ";
        $consulta = $db->consulta($query);		
          
        return $consulta;  
    }
}



?>