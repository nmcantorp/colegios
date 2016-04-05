<?php require_once('clases/personas.php');

$objPersona = new ClassPersonas();
$result=1;

while ($result == 1) {

	$objPersona->SyncPlataform();

	echo "<p>".date('Y-m-d H:i:s');

	usleep(40000000);
	//usleep(14400000);	
}




?>