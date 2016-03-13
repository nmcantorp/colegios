<?php session_start();
    /**
    *   Llamados a las clases
    */
    require_once('../clases/parametes.php'); 
    require_once('../clases/paginator.php');    
    /**
    *   Llamados a los objetos
    */
    
	$objParameters = new ClassParameters();    
    /**
    *   Llamados a los metodos
    */
    $nombre = $_SESSION["nombre"];
    $foto   = $_SESSION["foto"];
    switch ($_SESSION["perfil"]) {
    	case 'Administrador':
    		$perfil = 1;
    		break;
    	
    	default:
    		# code...
    		break;
    }
    
	$objParameters->get_Parameters();
    $archivo_actual = basename($_SERVER["PHP_SELF"]);
    $captcha_publickey = captcha_publickey;
	$captcha_privatekey = captcha_privatekey;
    $error_captcha=null;
    
    // seconds, minutes, hours, days
    $expires = 60*60*24*14;
    header("Pragma: public");
    header("Cache-Control: maxage=".$expires);
    header('Expires: ' . gmdate('D, d M Y H:i:s', time()+$expires) . ' GMT');
    
    
 ?>
<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="es">
<!--<![endif]-->
<head>
<meta charset="utf-8"/>
<!-- Set the viewport width to device width for mobile -->
<meta name="viewport" content="width=device-width"/>
<link type="image/x-icon" href="../images/favicon.ico" rel="icon"/>
<title>"SEIP" RR.HH</title>
<!-- CSS Files-->
<link href="../javascripts/jquery-ui-1.11.4.custom/jquery-ui.css" rel="stylesheet">
<link rel="stylesheet" href="../stylesheets/bootstrap/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link rel="stylesheet" href="../stylesheets/style.css">

<link rel="stylesheet" href="../stylesheets/skins/blue.css">
<!-- skin color -->
<link rel="stylesheet" href="../stylesheets/responsive.css">
<link rel="stylesheet" href="../stylesheets/sialen.css">
<link rel="stylesheet" href="../javascripts/chosen/chosen.css" type="text/css" />

<script src="../javascripts/jquery-1.11.3.js"></script>
<script src="../javascripts/jquery-ui-1.11.4.custom/jquery-ui.js"></script>

<!-- Selector animado-->


<!-- IE Fix for HTML5 Tags -->
<!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
</head>
<body>
<!-- HIDDEN PANEL 
================================================== -->
<div id="panel">
	<div class="row">
        <div class="twelve columns">
            <img src="../images/logo_2.png" width="40" height="40" class="pics" alt="info">
			<div class="infotext">
                <center>"SEIP" - SERVICIO&nbsp;EDUCATIVO&nbsp;INTEGRAL&nbsp;PERSONALIZADO.</center>
			</div>
		</div>
	</div>
</div>
<p class="slide">
	<a href="#" class="btn-slide"></a>
</p>
<!-- HEADER
================================================== -->
<div class="row">
	<div class="headerlogo four columns">
		<div class="logo">
			<a href="index.php">
			<img src="../images/logo.png" width="140" class="pics" alt="info">
			</a>
		</div>
	</div>

    <?php require_once('menu.php'); ?>    
    <input type="hidden" id="foto_temp" value="<?php echo $foto ?>"> 
</div>
<div class="clear">
</div>
</body>
</html>