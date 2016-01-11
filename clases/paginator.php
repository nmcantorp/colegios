<?php 
session_start();
/**
* Clase para la funcionalidad del logueo de los usuarios 
*/
include_once('conexion.php');

class ClassPaginator extends ClassConexion
{	
	
	function __construct()
	{
		
	}

	public function create_paginator($datos=array(), $page_selected )
	{
		$max_result_page = 10;
		$max_pag = 10;	

		$result  = array_chunk($datos, $max_result_page);
		//print_r($result);die();
		$resultado_ciudad = $result[( $page_selected ) ? ( ( int ) $page_selected - 1 ) : 0 ];
		$count_page = count($result);
		$pagina_actual = $page_selected;
		if ($pagina_actual<=($count_page-$max_pag)) {
			$val_page = $pagina_actual+$max_pag;
		}else{
			$val_page = $pagina_actual+($count_page-$pagina_actual+1);
		}

		$html = "<div id='divPag'><ul class='pagination'>";
		if (($pagina_actual-1)==0) {
			$html.="<li class='disabled'>";
		}else{
			$html.="<li>";
		}
		$pag_anterior = $pagina_actual-1;	
		$html.="<a href=?pg=$pag_anterior aria-label='Previous' >";
		$html.="<span aria-hidden='true'>&laquo;</span>";
		$html.="</a>";
		$html.="</li>";
		    for ($i=$pagina_actual; $i < $val_page ; $i++):

		     	$html.="<li><a href='?pg=".$i."'>". $i; ($pagina_actual==$i)?'<span class="sr-only">(current)</span>':'' ."</a></li>";
		    
			endfor;
		if (($pagina_actual)==$count_page) {
			$html.="<li class='disabled'>";
		}else{
			$html.="<li>";
		}

		$pag_siguiente = $pagina_actual+1;
	    
		$html.="<a href='?pg=$pag_siguiente' aria-label='Next'>";
		$html.="<span aria-hidden='true'>&raquo;</span>";
		$html.="</a></li></ul></div>";
		echo $html;
		return $resultado_ciudad;
	}
		
}
?>