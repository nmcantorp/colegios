<?php
require 'clases/class.eyemysqladap.inc.php';
require 'clases/class.eyedatagrid.inc.php';
$db = new EyeMySQLAdap('localhost', 'sialen5_adminrh', 'sialenplmnko0', 'sialen5_rh');
$dg = new EyeDataGrid($db);
$x = new EyeDataGrid($db);

// Establecer la consulta
$x->setQuery("id_persona,doc_identidad,nombre_completo,genero,fecha_nac", "personas", 'id_persona');


//$x->setOrder('cod_postal',EyeDataGrid::ORDER_DESC);

// Permite los filtros
$x->allowFilters();

// Cambiar el texto de los encabezados
$x->setColumnHeader('id_persona', 'Id');
$x->setColumnHeader('doc_identidad', 'D.N.I');
$x->setColumnHeader('nombre_completo', 'Nombres');
$x->setColumnHeader('genero', 'Genero');
$x->setColumnHeader('fecha_nac', 'F. Nacimiento');

//$x->setColumnHeader('asesor', 'Asesor');
// Ocultar columna ID
$x->hideColumn('id_persona');


// Cambiar el tipo de columna
//$x->setColumnType('fecha_status', EyeDataGrid::TYPE_DATE, 'M d Y', true);
//$x->setColumnType('aprovacion', EyeDataGrid::TYPE_PERCENT, false, array('Back' => '#c3daf9', 'Fore' => 'black'));

// Mostrar restablecer el control de la grilla
$x->showReset();

// Agregar el control personalizado, el orden sí importa
//$x->addCustomControl(EyeDataGrid::CUSCTRL_TEXT, "alert('%apellidos%\'has promovido!')", EyeDataGrid::TYPE_ONCLICK, 'Promover');

// Agregar el control estándar
$x->addStandardControl(EyeDataGrid::STDCTRL_CREATE, "if(confirm('Desea ingresar un nuevo contacto para la %razon_social% ?')) { document.location.href='usuario_contacto1.php?id=%id_cliente%';}");
$x->addStandardControl(EyeDataGrid::STDCTRL_OP, "");
$x->addStandardControl(EyeDataGrid::STDCTRL_SEG, "if(confirm('Desea ingresar en el seguimiento de %razon_social% ?')) { document.location.href='../reportes/rpt_det_seguimiento1.php?id=%razon_social%';}");
$x->addStandardControl(EyeDataGrid::STDCTRL_OP, "");
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "if(confirm('Desea ingresar un nuevo status para el contacto %nombre% de la %razon_social% ?')) { document.location.href='actualizacion_status1.php?id=%_P%';}");
$x->addStandardControl(EyeDataGrid::STDCTRL_OP, "");
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "if(confirm('Desea eliminar la afiliacion  No.%_P% ?')) { document.location.href='borrar.php?id=%_P%';}");
//

// Mostrar casillas de verificación
//$dg->showCheckboxes();

// Mostrar números de fila
//$x->showRowNumber();

// Agregar el control
$x->showCreateButton("if(confirm('Desea ingresar una nueva Razon Social ?')) { document.location.href='actualizacion_razon.php';}", EyeDataGrid::TYPE_ONCLICK, 'Nuevo');


/* Aplicar una función a una fila
function returnSomething($nombres)
{
	return strrev($nombres);
}
$x->setColumnType('nombres', EyeDataGrid::TYPE_FUNCTION, 'devolver algo', '%nombres%');*/

if (EyeDataGrid::isAjaxUsed())
	{
	$x->printTable();
    exit;
	}
?>
<html>
<head>
<title>Seguimiento de Gestion</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<meta http-equiv="Content-Type" content="text/html; charset=uft-8">
<link href="stylesheets/grilla.css" rel="stylesheet" type="text/css">

</head>
<!--<body bgcolor="#ffffff">
<h1>Seguimiento de Gestion.</h1>
<ul>Se&ntilde;or administrador, estos datos son para su verificacion.
    <p></p>
    Al momento de querer ingresar un contacto... Seleccione el icono Nuevo Contacto.
    <img src= "images/grilla/create.png">
    O ingresar un estatus... Seleccione el icono Seguimiento.
    <img src= "images/grilla/calendario.png">
    <img src= "images/logo.png"  width = "10%" align = "right">
</ul>-->
<?php
// Imprimir la tabla
$x->useAjaxTable();
?>
</body>
</html>




