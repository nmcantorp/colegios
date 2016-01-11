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

    $nombre = $_SESSION['nombre'];
    $foto   = $_SESSION['foto'];
    switch ($_SESSION['perfil']) {
    	case 'Administrador':
    		$perfil = 1;
    		break;
    	
    	default:
    		# code...
    		break;
    }
    
	$objParameters->get_Parameters();

    $archivo_actual = basename($_SERVER['PHP_SELF']);

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
<title>Studio Francesca - Premium Theme by WowThemesNet</title>
<!-- CSS Files-->
<link rel="stylesheet" href="../stylesheets/style.css">

<link rel="stylesheet" href="../stylesheets/skins/blue.css">
<!-- skin color -->
<link rel="stylesheet" href="../stylesheets/responsive.css">
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
			<img src="http://www.wowthemes.net/demo/studiofrancesca/images/info.png" class="pics" alt="info">
			<div class="infotext">
				 Thank you for visiting my theme! Replace this with your message to visitors.
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
			<a href="index.html">
			<h4>Studio Francesca</h4>
			</a>
		</div>
	</div>
    
    <?php require_once('menu.php'); ?>    
    <input type="hidden" id="foto_temp" value="<?php echo $foto ?>"> 
</div>
<div class="clear">
</div>