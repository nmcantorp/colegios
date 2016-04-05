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
                matricula_curso_persona.aprobado
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
    {   $i=0;
        $db = new ClassConexion();
        //$db->begin();
        try {
            $query = "  INSERT INTO personas (personas.doc_identidad,
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
                        personas.fecha_creador)
                        VALUES ('".$data['doc_identidad']."', 
                                '".$data['fecha_nac']."', 
                                '".$data['primer_nom']."', 
                                '".$data['segundo_nom']."', 
                                '".$data['primer_ape']."', 
                                '".$data['segundo_ape']."', 
                                '".$data['nombre_completo']."', 
                                '".$data['genero']."', 
                                '".$data['id_departamento']."', 
                                '".$data['id_ciudad']."', 
                                '".$data['telefono']."', 
                                '".$data['celular']."', 
                                '".$data['direccion']."', 
                                '".$data['email']."', 
                                '".$data['activo']."', 
                                NOW(), 
                                'MCANTOR',
                                NOW(), 
                                NOW()
                                )"; 

            $db->consulta($query,'INSERT');
            $id_persona = $db->insert_id();

            if( isset($id_persona) && $id_persona != '' && !is_null($id_persona) )
            {
                for ($i=0; $i < 2; $i++) { 
                    $query = "  INSERT INTO referencias_personales (
                                referencias_personales.id_persona,
                                referencias_personales.tipo_referencia,
                                referencias_personales.nombre_ref,
                                referencias_personales.telefono_ref,
                                referencias_personales.celular_ref,
                                referencias_personales.direccion_ref,
                                referencias_personales.id_tipo_parentesco,
                                referencias_personales.activo,
                                referencias_personales.fecha_creacion,
                                referencias_personales.usuario_creador
                                ) VALUES (
                                '$id_persona'
                                ,'".$data['tipo_referencia'.$i]."'
                                ,'".$data['nombre_ref'.$i]."'
                                ,'".$data['telefono_ref'.$i]."'
                                ,'".$data['celular_ref'.$i]."'
                                ,'".$data['direccion_ref'.$i]."'
                                ,''
                                ,'S'
                                ,now()
                                ,'MCANTOR'
                                )";
                    $db->consulta($query,'INSERT');                
                }

                $query = "  INSERT INTO estudios_realzados (
                            estudios_realzados.id_organizacion,
                            estudios_realzados.id_titulo_profesional,
                            estudios_realzados.id_tipo_formacion,
                            estudios_realzados.estado,
                            estudios_realzados.fecha_creacion,
                            estudios_realzados.usuario_creador,
                            estudios_realzados.id_persona,
                            estudios_realzados.anyo_egresado
                            ) VALUES (
                            '".$data['institucion']."'
                            ,'".$data['titulo_profesional']."'
                            ,'".$data['tipo_formacion']."'
                            ,'S'
                            ,now()
                            ,'MCANTOR'
                            ,'$id_persona'
                            ,'".$data['egresado']."'
                            )";
                $db->consulta($query,'INSERT');

                $query = "  INSERT INTO asignacion_laboral (
                            asignacion_laboral.id_cargo,
                            asignacion_laboral.activo,
                            asignacion_laboral.fecha_creacion,
                            asignacion_laboral.usuario_creador,
                            asignacion_laboral.id_sucursal,
                            asignacion_laboral.fecha_ini,
                            asignacion_laboral.fecha_fin,
                            asignacion_laboral.id_persona
                            ) VALUES (
                            '".$data['cargo_asigna']."'
                            ,'S'
                            ,now()
                            ,'MCANTOR'
                            ,'".$data['empresa_asigna']."'
                            ,'".$data['ingreso_asigna']."'
                            ,'".$data['retiro_asigna']."'
                            ,'$id_persona'
                            )";
                $db->consulta($query,'INSERT');

                $query = "  INSERT INTO historial_laboral (
                            historial_laboral.id_persona,
                            historial_laboral.id_organizacion,
                            historial_laboral.id_cargo,
                            historial_laboral.fecha_ingreso,
                            historial_laboral.fecha_retiro,
                            historial_laboral.jefe_inmediato,
                            historial_laboral.fecha_creacion,
                            historial_laboral.usuario_creador,
                            historial_laboral.telcontacto,
                            historial_laboral.extension
                            ) VALUES (
                            '$id_persona'
                            ,'".$data['empresa']."'
                            ,'".$data['cargo']."'
                            ,'".$data['ingreso']."'
                            ,'".$data['retiro']."'
                            ,'".$data['jefe']."'
                            ,now()
                            ,'MCANTOR'
                            ,'".$data['contacto_jefe']."'
                            ,'".$data['ext_jefe']."'                            
                            )";
                $db->consulta($query,'INSERT');
            }
         
        } catch (Exception $e) {
            $db->rollback();
            return $e;
        }

        if($id_persona != '' && !is_null($id_persona))
        {
            $db->commit();
            return true;
        }
    }


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
        $consulta = $db->consulta($query,'INSERT');      
          
        return $consulta;
    }
}



?>