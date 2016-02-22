<?php 
session_start()                                                                                                                                                         ;

/**
* Clase para la funcionalidad del logueo de los usuarios 
*/
include_once('conexion.php');

class ClassCargos extends ClassConexion
{
    /**
    * Valida la información del logueo 
    * @param varchar $usuario
    * @param varchar $pass
    * 
    * return boolean   
    */
    function get_Cargos($orden=null)
    {

        $db = new ClassConexion();
        $ingreso = false;

        $query="SELECT
                cargos.id_cargo,
                cargos.descripcion_cargo,
                cargos.observaciones,
                cargos.activo,
                cargos.fecha_creacion,
                cargos.usuario_creador,
                cargos.fecha_modificacion,
                cargos.usuario_modificador
                FROM cargos";
        if(!is_null($orden)) $query.=" ORDER BY $orden ";
        $consulta = $db->consulta($query);		
          
        return $consulta;  
    }

    function ing_cargos()
    {
        $db = new ClassConexion();
        $ingreso = false;

        $query = "call insertar_cargos('Profesor','Profesor de bachillerato','S','ADMIN',Now())";

        $consulta = $db->consulta($query);

        return $consulta;



    }
}



?>