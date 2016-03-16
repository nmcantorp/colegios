<?php 
session_start();

/**
* Clase para la funcionalidad del logueo de los usuarios 
*/
include_once('conexion.php');

class ClassAsignacion extends ClassConexion
{
    /**
    * Valida la información del logueo 
    * @param int $user_id
    * @param varchar $pass
    * 
    * return array   
    */
    function get_AsignacionByUser($user_id)
    {

        $db = new ClassConexion();
        $ingreso = false;

        $query="SELECT
                cargos.descripcion_cargo,
                valores_definiciones.valor_definicion,
                organizaciones.nombre_empresa,
                asignacion_laboral.fecha_ini,
                asignacion_laboral.fecha_fin,
                if(asignacion_laboral.activo='S', 1, 0) as estado
                FROM
                asignacion_laboral
                INNER JOIN organizaciones ON asignacion_laboral.id_sucursal = organizaciones.id_organizacion
                INNER JOIN cargos ON cargos.id_cargo = asignacion_laboral.id_cargo
                INNER JOIN valores_definiciones ON valores_definiciones.id_valor_def = asignacion_laboral.id_tipo_departamento 
                AND valores_definiciones.id_tipo_definicion = 12
                WHERE
                asignacion_laboral.id_persona = $user_id
                GROUP BY
                asignacion_laboral.id_asignacion_lab";
            
        $consulta = $db->consulta($query);		
          
        return $consulta;  
    }
    
    /**
    * Guardar la informacion de los tipos de definicion y los valores
    *
    */
    
    function guardar_definicion( $dato=array())
    {
        $db = new ClassConexion();
        $db->begin();
        try {
            $query = "  INSERT INTO tipo_definicion (tipo_definicion, activo, fecha_creacion, usuario_creador)
                        VALUES ('".$dato['tipo_def']."', '".$dato['estado_def']."', NOW(), '".$_SESSION['nombre']."' )"; 

            $db->consulta($query,'INSERT');
            $id_padre = $db->insert_id();

            if( isset($id_padre) && $id_padre != '' && !is_null($id_padre) )
            {
                for ($i=0; $i < count($dato['detalle']); $i++) { 
                    $query = "  INSERT INTO valores_definiciones (
                                id_tipo_definicion,
                                valor_definicion,
                                desc_valor_def,
                                tipo_valor_def,
                                activo,
                                fecha_creacion,
                                usuario_creador
                                ) VALUES (
                                '$id_padre'
                                ,'".$dato['detalle'][$i]['valor_def']."'
                                ,'".$dato['detalle'][$i]['desc_def']."'
                                ,'".$dato['tipo_def']."'
                                ,'".$dato['detalle'][$i]['estado_def']."'
                                ,NOW()
                                ,'".$_SESSION['nombre']."'
                                )";
                    $db->consulta($query,'INSERT');
                    $id_hijo[] = $db->insert_id();
                }
            }
         
        } catch (Exception $e) {
            $db->rollback();
            return $e;
        }

        if($id_padre != '' && !is_null($id_padre) && count($id_hijo)>0 && isset($id_hijo))
        {
            $db->commit();
            return true;
        }
    }
    
}



?>