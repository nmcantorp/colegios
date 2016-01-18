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
    function get_Definiciones($estado=null, $valor=null)
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
                1";
                
        if(!is_null($valor))        
            $query .= " AND tipo_definicion.tipo_definicion = '$valor'";
            
        if(!is_null($estado))        
            $query .= " AND valores_definiciones.activo = '$estado'";
            
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