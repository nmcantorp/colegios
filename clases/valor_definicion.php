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
    function get_Definiciones($valor=null)
    {

        $db = new ClassConexion();
        $ingreso = false;

        $query="SELECT
                valores_definiciones.id_valor_def,
                valores_definiciones.valor_definicion,
                valores_definiciones.desc_valor_def,
                tipo_definicion.id_tipo_definicion,
                tipo_definicion.tipo_definicion,
                if(tipo_definicion.activo='S','Activo','Inactivo') AS estado,
                if(valores_definiciones.activo = 'S','Activo','Inactivo') AS 'estado_det'
                FROM
                valores_definiciones
                RIGHT JOIN tipo_definicion ON valores_definiciones.id_tipo_definicion = tipo_definicion.id_tipo_definicion
                WHERE
                1
                #AND valores_definiciones.activo = 'S'";
        if(!is_null($valor))        
            $query .= " AND tipo_definicion.tipo_definicion = '$valor'";
            
        $consulta = $db->consulta($query);		
          
        return $consulta;  
    }
    
    /**
    * Guardar la informacion de los tipos de definicion y los valores
    *
    */
    
    function guardar_definicion( $dato=null )
    {
        $db = new ClassConexion();
        
    }
}



?>