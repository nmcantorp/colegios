<?php 
session_start();
/**
* Clase para la funcionalidad del logueo de los usuarios 
*/
include_once('conexion.php');
require_once('class.eyemysqladap.inc.php');
require_once('class.eyedatagrid.inc.php');

class ClassTabla extends ClassConexion
{	
	public $resultado = array();
    public $db      = '';
    public $dg      = '';
    public $x       = '';
    public $array_boton=null;
    public $resetear=false;
    public $creacion=null;
    
	function __construct($botones=array(),$mostrar_reset=false, $mostrar_creacion=array())
	{  
        $host 	= $this->host;
        $nomBD	= $this->nomBD;
        $user 	= $this->user;
        $pass	= $this->pass;

		$this->db = new EyeMySQLAdap($host, $user, $pass, $nomBD, true);
        $dg = new EyeDataGrid($this->db);
        $this->x = new EyeDataGrid($this->db);        
        if( count($botones)>0 )
            $this->array_boton = $botones;
        if( $mostrar_reset )
            $this->resetear = $mostrar_reset;
        if( count($mostrar_creacion) > 0 )
            $this->creacion = $mostrar_creacion;
	}
	
	function crear_consultas($campos=array(), $tabla, $primary = '', $where = '', $columna_oculta=array())
    {
		if(is_null($campos) || empty($campos) || count($campos)<=0)
        {
            echo 'No existe información disponible';
            exit;
        } 
        $campos_texto = '';
        $largo_arreglo = count($campos);
        $contador=1;
        foreach ($campos as $key => $value) {
            $campos_texto .= $key;
            if($contador < $largo_arreglo) $campos_texto .= ', ';            
            $contador++;    
        }
        
        // Establecer la consulta
        $this->x->setQuery($campos_texto, $tabla, $primary);        
        
        // Permite los filtros
        $this->x->allowFilters();
        
        
        // Cambiar el texto de los encabezados
        foreach ($campos as $key => $value) {
            $this->x->setColumnHeader($key, $value);
        }
        
        // Se ocultan columnas 
        if( count($columna_oculta)>0)
        {
            for ($i=0; $i < count($columna_oculta); $i++) { 
                $this->x->hideColumn($columna_oculta[$i]);
            }
        }        
        
	}
    
    function imprimir_botones()
    {
        /**
        * El orden de creacion de los botones es el siguiente:
        * $botones = array('STDCTRL_CREATE' => array('mensaje'  =>'Desea ingresar un nuevo contacto para la %razon_social% ?',
        *                                         'href'     =>'usuario_contacto1.php?id=%id_cliente%'
        *                                         ),
        *               'STDCTRL_SEG'    => array('mensaje'  =>'Desea ingresar en el seguimiento de %razon_social% ?',
        *                                         'href'     =>'../reportes/rpt_det_seguimiento1.php?id=%razon_social%'
        *                                         ),
        *               'STDCTRL_EDIT'   => array('mensaje'  =>'Desea ingresar un nuevo status para el contacto %nombre% de la %razon_social% ?',
        *                                         'href'     =>'actualizacion_status1.php?id=%_P%'
        *                                         ),                                                 
        *               'STDCTRL_DELETE' => array('mensaje'  =>'Desea eliminar la afiliacion  No.%_P% ?',
        *                                         'href'     =>'borrar.php?id=%_P%'
        *                                         ),                          
        *                );
        */
        
        if(!is_null($this->array_boton))
        {
           foreach ($this->array_boton as $key => $value) {
               foreach ($value as $key_int => $value_int) {
                   if(!is_null($value_int) && $key_int=='mensaje'){
                       $mensaje_final = "if(confirm('". $value_int."' ))";
                   }elseif(is_null($value_int) && $key_int=='mensaje')
                   {
                       $mensaje_final = null;
                   }
                   
                   if(is_null($mensaje_final) && $key_int=='href')
                   {
                       $complemento = "document.location.href='".$value_int."';";
                   }elseif(!is_null($mensaje_final) && $key_int=='href')
                   {
                       $complemento = "{ document.location.href='".$value_int."';}";
                   }
                   
                       
                   
               }
               switch ($key) {
                   case 'STDCTRL_CREATE':
                      $this->x->addStandardControl(EyeDataGrid::STDCTRL_CREATE, $mensaje_final.$complemento);
                       break;
                       
                   case 'STDCTRL_SEG':
                      $this->x->addStandardControl(EyeDataGrid::STDCTRL_SEG, $mensaje_final.$complemento);
                       break;
                       
                   case 'STDCTRL_EDIT':
                       $this->x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, $mensaje_final.$complemento);
                       break;
                       
                   case 'STDCTRL_DELETE':
                       $this->x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, $mensaje_final.$complemento);
                       break;
               }
               
               
           }
        }
        
        if($this->resetear)
        {
            $this->x->showReset();
        }
        
        if(!is_null($this->creacion))
        {
            $mensaje_final =null;
            foreach ($this->creacion as $key => $value) {
             
                if(!is_null($value) && !empty($value) && $key=='mensaje'){
                    $mensaje_final = "if(confirm('". $value."' ))";
                }elseif(is_null($value) && empty($value) && $key=='mensaje')
                {
                    $mensaje_final = null;
                }
                
                if(is_null($mensaje_final) && $key=='href')
                {
                    $complemento = "document.location.href='".$value."';";
                }elseif(!is_null($mensaje_final) && $key=='href')
                {
                    $complemento = "{ document.location.href='".$value."';}";
                }
            }
            
            $this->x->showCreateButton($mensaje_final.$complemento , EyeDataGrid::TYPE_ONCLICK, 'Nuevo' );
        }
    }
    
    function imprimir_tabla()
    {
        $this->imprimir_botones();
        return $this->x->printTable();
        exit;       
    }
}
?>