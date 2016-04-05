<?php 
header("Content-Type:application/json");
require_once('webservice/funciones.php');

if(isset($_REQUEST['Date_Start']) && !empty($_REQUEST['Date_Start'])){
	$date_start = $_REQUEST['Date_Start'];
	$date_finish = (isset($_REQUEST['Date_finish']) && !empty($_REQUEST['Date_finish']))?$_REQUEST['Date_finish']:null;
	$result = Validate_by_Date($date_start, $date_finish);

	if($result != 0){

		Respuesta_entrega(200,"Information found", $result);
	}else{
		Respuesta_entrega(200,"No information for selected date, the format requested is 'Y-M-D'", null);
	}


}else{
	Respuesta_entrega(400,"Invalid Date", null);
	
}

?>