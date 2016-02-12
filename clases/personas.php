<?php 
session_start();

/**
* Clase para la funcionalidad del logueo de los usuarios 
*/
include_once('conexion.php');

class ClassPersonas extends ClassConexion
{
    /**
    * Valida la información del logueo 
    * @param varchar $usuario
    * @param varchar $pass
    * 
    * return boolean   
    */
    function get_Persona_id($id_usuario)
    {

        $db = new ClassConexion();
        
        $query="SELECT
                    personas.id_persona,
                    personas.doc_identidad,
                    personas.fecha_nac,
                    personas.primer_nom,
                    personas.segundo_nom,
                    personas.primer_ape,
                    personas.segundo_ape,
                    personas.nombre_completo,
                    personas.genero,
                    personas.id_departamento,
                    personas.id_ciudad,
                    personas.telefono,
                    personas.celular,
                    personas.direccion,
                    personas.email,
                    personas.activo,
                    personas.fecha_creacion,
                    personas.usuario_creador,
                    personas.fecha_modificacion,
                    personas.fecha_creador
                FROM
                    personas
                WHERE
                    personas.id_persona = $id_usuario
                ";
        $consulta = $db->consulta($query);		
          
        return $consulta;  
    }
}



?>