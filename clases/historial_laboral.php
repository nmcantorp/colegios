<?php 
session_start();

/**
* Clase para la funcionalidad del logueo de los usuarios 
*/
include_once('conexion.php');

class ClassHistorial extends ClassConexion
{
    /**
    * Valida la información del logueo 
    * @param varchar $usuario
    * @param varchar $pass
    * 
    * return boolean   
    */
    function valida_usuario($usuario=null, $pass=null)
    {

        $db = new ClassConexion();
        $ingreso = false;

        $query="SELECT
                    ad_login.id_usuario,
                    ad_login.usuario,
                    ad_login.nombre,
                    ad_login.apellido,
                    ad_login.activo,
                    ad_login.perfil,
                    ad_login.foto
                FROM
                    ad_login
                WHERE
                    usuario = '$usuario'
                    AND clave = '$pass'
                    AND activo = 'SI'";
        $consulta = $db->consulta($query);		
          
        return $consulta;  
    }
}



?>