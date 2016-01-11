<?php 
session_start();

/**
* Clase para la funcionalidad del logueo de los usuarios 
*/
include_once('conexion.php');

class ClassOrganizacion extends ClassConexion
{
    /**
    * Valida la información del logueo 
    * @param varchar $usuario
    * @param varchar $pass
    * 
    * return boolean   
    */
    function get_Organizacion()
    {

        $db = new ClassConexion();
        $ingreso = false;

        $query="SELECT
                organizaciones.id_organizacion,
                organizaciones.id_organizacion_padre,
                organizaciones.id_sec_financiero,
                organizaciones.nit_empresa,
                organizaciones.nombre_empresa,
                organizaciones.direccion,
                organizaciones.telefono_pbx,
                organizaciones.web_site,
                organizaciones.sigla,
                organizaciones.anyo_fundacion,
                organizaciones.clasificacion,
                organizaciones.fecha_creacion,
                organizaciones.usuario_creador,
                organizaciones.fecha_modificacion,
                organizaciones.fecha_creador,
                valores_definiciones.valor_definicion,
                valores_definiciones.desc_valor_def
                FROM
                organizaciones
                INNER JOIN valores_definiciones ON valores_definiciones.id_valor_def = organizaciones.id_sec_financiero
                ";
        $consulta = $db->consulta($query);		
          
        return $consulta;  
    }
}



?>