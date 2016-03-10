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
                    personas.foto,
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
    
    function getHistoriaLab($idPersona)
    {
        $db = new ClassConexion();
        
        $query="SELECT
                organizaciones.nombre_empresa,
                cargos.descripcion_cargo,
                historial_laboral.fecha_ingreso,
                historial_laboral.fecha_retiro,
                historial_laboral.salario_devengado,
                historial_laboral.jefe_inmediato,
                historial_laboral.telcontacto,
                historial_laboral.extension
                FROM
                historial_laboral
                INNER JOIN organizaciones ON organizaciones.id_organizacion = historial_laboral.id_organizacion
                INNER JOIN cargos ON cargos.id_cargo = historial_laboral.id_cargo
                WHERE
                historial_laboral.id_persona = $idPersona
                ";
        $consulta = $db->consulta($query);		
          
        return $consulta;
    }
    
    function getEduFormal($idPersona)
    {
        $db = new ClassConexion();
        
        $query="SELECT
                valores_definiciones.valor_definicion as 'tipo_formacion',
                titulos_profesionales.titulo_profesional,
                estudios_realzados.titulo_obtenido,
                IFNULL(organizaciones.nombre_empresa,'No aplica') AS institucion,
                estudios_realzados.anyo_egresado
                FROM
                estudios_realzados
                LEFT OUTER JOIN organizaciones ON organizaciones.id_organizacion = estudios_realzados.id_organizacion
                LEFT OUTER JOIN titulos_profesionales ON titulos_profesionales.id_titulo_profesional = estudios_realzados.id_titulo_profesional
                LEFT OUTER JOIN valores_definiciones ON valores_definiciones.id_valor_def = estudios_realzados.id_tipo_formacion
                WHERE
                estudios_realzados.id_persona = $idPersona";
        $consulta = $db->consulta($query);		
          
        return $consulta;
    }
    
    function getReferenciaPersonal($idPersona)
    {
        $db = new ClassConexion();
        
        $query="SELECT
                referencias_personales.nombre_ref,
                referencias_personales.telefono_ref,
                referencias_personales.celular_ref,
                referencias_personales.direccion_ref,
                IFNULL(valor2.valor_definicion,'No aplica') as parentesco,
                IFNULL(valores_definiciones.valor_definicion,'No aplica') as tipo_referencias
                FROM
                referencias_personales
                LEFT OUTER JOIN valores_definiciones ON valores_definiciones.id_valor_def = referencias_personales.tipo_referencia
                LEFT OUTER JOIN valores_definiciones as valor2 ON valor2.id_valor_def = referencias_personales.id_tipo_parentesco
                WHERE
                referencias_personales.id_persona =  $idPersona";
        $consulta = $db->consulta($query);		
          
        return $consulta;
    }
    
    function getFormacionEmpresa($idPersona)
    {
        $db = new ClassConexion();
        
        $query="SELECT
                cursos_ofertados.nombre_curso,
                calificaciones_curso.aprobo_curso
                FROM
                cursos_ofertados
                INNER JOIN matricula_curso_persona ON matricula_curso_persona.id_curso = cursos_ofertados.id_curso
                LEFT OUTER JOIN calificaciones_curso ON calificaciones_curso.id_matricula = matricula_curso_persona.id_matricula
                WHERE
                matricula_curso_persona.id_persona =  $idPersona";
        $consulta = $db->consulta($query);		
          
        return $consulta;
    }

    function getPersonabyDNI($cedula)
    {
        $db = new ClassConexion();
        
        $query="SELECT
                *
                FROM
                personas
                WHERE
                personas.doc_identidad =  $cedula";
        $consulta = $db->consulta($query);      
          
        return $consulta;
    }

    function save_persona($data)
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