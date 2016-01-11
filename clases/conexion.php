<?php

/**
* Conexion a la base de datos
*/
class ClassConexion
{
	public $host 	= 'localhost';
	public $nomBD 	= 'sialen5_rh';
	public $user 	= 'root';
	public $pass	= '';

	/*public $nomBD 	= 'sialen5_pagina';
	public $user 	= 'sialen5_PaginaOw';
	public $pass	= 's14l3n2013';*/
	
	public $conexion; public $total_consultas;
    
    function __construct()
	{
		$this->MySQL();
	}

	public function MySQL(){ 
		if(!isset($this->conexion)){
			$this->conexion = (mysql_connect($this->host,$this->user,$this->pass)) or die(mysql_error());
			mysql_select_db($this->nomBD,$this->conexion) or die(mysql_error());
		}
	}

	public function consulta($consulta){
        $resultado_final = array();
		$this->total_consultas++; 
		$resultado = mysql_query($consulta,$this->conexion);
		if(!$resultado){ 
			echo 'MySQL Error: ' . mysql_error();
			exit;
		}
        if($this->num_rows($resultado)>0){ $conteo=0;
            while($resultados = $this->fetch_array($resultado)){
                foreach($resultados as $key => $value)
                {
                    if(!is_numeric($key))
                    {
                        $resultado_final[$conteo][$key]=$value;
                    }                    
                } 
                $conteo++;              
               }           
        }
		return $resultado_final;
	}

	public function fetch_array($consulta){
		return mysql_fetch_array($consulta);
	}

	public function num_rows($consulta){
		return mysql_num_rows($consulta);
	}

	public function getTotalConsultas(){
		return $this->total_consultas; 
	}

	public function insert_id(){
		return mysql_insert_id();
	}

	public function close_con(){
		return mysql_close();
	}
}

?>