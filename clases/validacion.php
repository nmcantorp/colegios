<?php
session_start();
include('conexion.php');

$db = new ClassConexion();
if (!isset( $_POST['usuario'] ))
	{
	header("Location.href:../index.html");
	} 
	else 
		{
		$link = $db->MySQL();
		$query = "SELECT perfil FROM ad_login WHERE usuario = '{$_POST['usuario']}' AND clave = '{$_POST['password']}' AND activo='SI'";
        $datos = $db->consulta($query);
		//$datos = mysql_query($sql, $link)or die("Error $sql");
		while($row = mysql_fetch_array($datos))
			$perfil=$row[perfil];
			{
			switch($perfil)
				{
				case Administrador:
					$_SESSION['User'] = $_POST['usuario'];
                    $sql1 = "SELECT nombre FROM ad_login WHERE usuario = '{$_POST['usuario']}'";
            		$datos1 = $db->consulta($sql1);
            		while($row = mysql_fetch_array($datos1))
                        $id=$row[asesor];
					echo "<script language=javascript> alert('Acceso correcto !... Bienvenido.');document.location.href='admon.php?id=$id'</script>";
					break;
				case Asesor:
					$_SESSION['User'] = $_POST['usuario'];
                    $sql1 = "SELECT nombre FROM ad_login WHERE usuario = '{$_POST['usuario']}'";
            		$datos1 = $db->consulta($sql1);
            		while($row = mysql_fetch_array($datos1))
                        $id=$row[asesor];
					echo "<script language=javascript> alert('Acceso correcto !... Bienvenido.');document.location.href='inicio.php?id=$id'</script>";
					break;
				default:
					echo "<script language=javascript> alert('Usuario o Contrasena incorrectos... Intente de Nuevo.! o si esta seguro de su contrasena, puede que este no activo para el ingreso...');parent.location.href='../../login.html'</script>";
				}
			}
		mysql_close($link);			
		}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"/>
</head>
<body></body>
</html>