<?php 
session_start();

/**
* Clase para la funcionalidad del logueo de los usuarios 
*/
include_once('conexion.php');

class ClassPersonas extends ClassConexion
{    
    /***
    * Ejecuta la Sincronización del ID y el USUARIO de los personas que esten en RRHH y se registraron en plataforma virtual
    * 
    **/

    function SyncPlataform()
    {
        $db = new ClassConexion();
        
        $query="UPDATE
                sialen5_rh.personas as rh
                INNER JOIN 
                (SELECT
                virtual.id,
                virtual.email,
                virtual.username
                FROM
                sialen5_vtalcan.alc_user AS virtual
                ) AS X ON X.email = rh.email 

                SET rh.id_plat_virtual = X.id, rh.username = X.username

                WHERE
                rh.id_plat_virtual IS NULL OR 
                rh.username IS NULL";
        $db->consulta($query,'INSERT');      
        $consulta = $db->insert_id();
          
        return $consulta;
    }
}



?>