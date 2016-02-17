<?php require_once('pages/commons/header.php'); 

if( $_REQUEST['ac']=='login' )
{
    require_once('clases/usuario.php');
    $objUsuario = new ClassUsuario();
    $resultado = $objUsuario->valida_usuario($_REQUEST['usuario'],$_REQUEST['password']);
    
    if(count($resultado))
    {
        for($i=0; $i<count($resultado);$i++)
        {
            $_SESSION['nombre']     = ucfirst($resultado[$i]['nombre'])." ".ucfirst($resultado[$i]['apellido']);
            $_SESSION['perfil']     = $resultado[$i]['perfil'];
            $_SESSION['id_usuario'] = $resultado[$i]['id_usuario']; 

            if(file_exists('images/perfil/'.$resultado[$i]['foto']))
            {
                $_SESSION['foto'] = 'images/perfil/'.$resultado[$i]['foto'];
                
            }else{
                $_SESSION['foto'] = false;
            }
            $ingreso = true;
        } 
        echo "<script language=\"javascript\">window.location.href=\"pages/index.php\";</script>";  
        exit;
        //header("Location: pages/index2.php");
    }
}else{
    unset($_SESSION);
}
?>

<!-- SUBHEADER
================================================== -->
<div id="subheader" class="subheadertext login2" style="padding:50px 0px !Important;">
	<div class="row login2">
		<div class="twelve columns">
			<div class="noslide" style="width: 40%;">
                <h3>Iniciar Sesion</h3>
                <form name="login" action="?ac=login" method="post" onSubmit="return valida(this);">
                    <center>
                    <div class="login">
                        <span>Usuario :</span>
                            <div>
                                <input name="usuario" type="text"  maxlength="50" />
                            </div>
                    </div>
                    <div class="login">
                        <span>Clave:</span>
                            <div>
                                <input name="password" type="password" maxlength="50"/>
                            </div>
                    </div>
                    </center>
                    <br>
                    <input name="ingresar" type="submit" class="success button" value="Ingresar"/>
                </form>
				 <!-- <h1>Our Photography Studio</h1>
				<h3>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</h3>
			<div class="minipause"></div><br/>
			<a href="#" class="clear actbutton">Action Button</a>-->
			</div>
		</div>
	</div>
</div>
<!-- ANIMATED COLUMNS 
================================================== -->
<div class="row">
	<div class="twelve columns">
		<ul class="ca-menu">
			<li>
			<!--<a href="#">-->
			<span class="ca-icon">S</span>
			<div class="ca-content">
				<h2 class="ca-main">Servicio<br><br>100% Web</h2>
				<h3 class="ca-sub">Todos los procesos en l&iacute;nea</h3>
			</div>
			<!--</a>-->
			</li>
			<li>
			<!--<a href="#">-->
			<span class="ca-icon">E</span>
			<div class="ca-content">
				<h2 class="ca-main">Educativo<br/><br>Unificaci&oacute;n</h2>
				<h3 class="ca-sub">Controlador de la formaci&oacute;n</h3>
			</div>
			<!--</a>-->
			</li>
			<li>
			<a href="#">
			<span class="ca-icon">I</span>
			<div class="ca-content">
				<h2 class="ca-main">Integral<br/><br>Funcionalidades</h2>
				<h3 class="ca-sub">Sistema por m&oacute;dulos</h3>
			</div>
			</a>
			</li>
			<li>
			<a href="#">
			<span class="ca-icon">P</span>
			<div class="ca-content">
				<h2 class="ca-main">Personalizado<br/><br>Administraci&oacute;n</h2>
				<h3 class="ca-sub">Capacitaci&oacute;n y Entrenamiento</h3>
			</div>
			</a>
			</li>
		</ul>
	</div>
</div>
<!-- CONTENT 
================================================== -->
<div class="row">
	<div class="twelve columns">
		<div class="centersectiontitle">
			<h4>&iquest;Por qu&eacute SEIP?</h4>
		</div>
	</div>
	<div class="four columns">
		<h5>Importancia</h5>
		<p align="justify">
             Un sistema de informaci&oacute;n de RR.HH. se hace cada vez m&aacute;s indispensable dentro
             de las organizaciones. Sin embargo, es el menos automatizado de todos los sistemas de una
             empresa. En muchas de ellas los documentos que competen al departamento de RR.HH. se
             encuentran en archivos manuales y el volumen es considerable porque corresponde a
             documentos generales a trav&eacute;s de los a&ntilde;os de funcionamiento de la
             organizaci&oacute;n. As&iacute;, generar cualquier tipo de informaci&oacute;n se hace
             dif&oacute;cil, pues el proceso es manual e implica horas de trabajo, haciendo que muchas
             veces no se alcancen los resultados esperados.<br>
             El surgimiento de las TIC&#39;s  han favorecido considerablemente esta gesti&oacute;n de
             informaci&oacute;n y proporciona las mejores alternativas, con el objetivo de servir de
             apoyo a la gesti&oacute;n de los recursos humanos, tanto a nivel gerencial como operativo,
             brindando tambi&eacute;n informaci&oacute;n que pueda utilizarse en procesos de
             planificaci&oacute;n.

		</p>
        <p>
			<a href="#top" class="readmore">Iniciar Sesi&oacute;n</a>
		</p>
	</div>
	<div class="four columns">
		<h5>Ventajas</h5>
		<p align="justify">
           * Una plataforma s&oacute;lida y fiable, enteramente dise&ntilde;ada para el &aacute;rea de RR.HH.<br><br>
           * R&aacute;pida adaptaci&oacute;n a la evoluci&oacute;n del mercado.<br><br>
           * Actualizaciones funcionales y t&eacute;cnicas autom&aacute;ticas.<br><br>
           * F&aacute;cil integraci&oacute;n con los otros sistemas del "SEIP".<br><br>
           * R&aacute;pido despliegue del sistema en nuevas sucursales o procesos de fusi&oacute;n empresarial;
           herramientas controladas por el usuario y experiencia para una transici&oacute;n y despliegue
           en la informaci&oacute;n.<br><br>
           * Potenciar y armonizar los recursos humanos a nivel internacional reforz&aacute;ndolos a nivel
           local.<br><br>
           * Optimizaci&oacute;n en los procesos y flujos de trabajo.<br><br>
        </p>
		<p>
			<a href="#top" class="readmore">Iniciar Sesi&oacute;n</a>
		</p>
	</div>
	<div class="four columns">
		<h5>Acciones y Resultados</h5>
		<p align="justify">
           An&aacute;lisis e informes generados a tiempo real y a nivel tanto local como global, hacen la vida
           de los responsables y profesionales de RR.HH mucho m&aacute;s sencilla. Se eliminan las
           fronteras entre el talento y la innovaci&oacute;n empresarial:<br><br>
           * Invierte en la plantilla dela compa&ntilde.<br><br>
           * Encuentra a la gente adecuada.<br><br>
           * Da movilidad a la cantera de talento tanto para proyectos espec&iacute;ficos como para
           proyectos sencillos.<br><br>
           * Obten lo mejor de las personas.<br><br>
           * Prepara futuras oportunidades y minimiza los riesgos de perdida de tiempos.<br><br>
           * Optimizaci&oacute;n en los espacios de las organizaciones, para los temas de archivo.
		</p>
		<p>
			<a href="#top" class="readmore">Iniciar Sesi&oacute;n</a>
		</p>
	</div>
</div>
<div class="hr">
</div>
<!-- CLIENTS 
================================================== -->
<div class="row">
	<div class="twelve columns">
		<div class="centersectiontitle">
			<h4>Nuestros Aliados</h4>
		</div>
	</div>
	<div class="twelve columns">
		<div class="image_carousel fitcarousel">
		<div id="foo2">
				<img src="http://placehold.it/140x140/222" alt="" width="140" height="140"/>
				<img src="http://placehold.it/140x140/333" alt="" width="140" height="140"/>
				<img src="http://placehold.it/140x140/222" alt="" width="140" height="140"/>
				<img src="http://placehold.it/140x140/333" alt="" width="140" height="140"/>
				<img src="http://placehold.it/140x140/222" alt="" width="140" height="140"/>
				<img src="http://placehold.it/140x140/333" alt="" width="140" height="140"/>
				<img src="http://placehold.it/140x140/222" alt="" width="140" height="140"/>
				<img src="http://placehold.it/140x140/333" alt="" width="140" height="140"/>
				<img src="http://placehold.it/140x140/222" alt="" width="140" height="140"/>
				<img src="http://placehold.it/140x140/333" alt="" width="140" height="140"/>
				<img src="http://placehold.it/140x140/222" alt="" width="140" height="140"/>
				<img src="http://placehold.it/140x140/333" alt="" width="140" height="140"/>
			</div>
			<div class="clearfix">
			</div>
			<a class="prev" id="foo2_prev" href="#"><span>prev</span></a>
			<a class="next" id="foo2_next" href="#"><span>next</span></a>
		</div>
	</div>
</div>
<!-- TESTIMONIALS 
================================================== -->
<div class="row">
	<div class="twelve columns">
		<div id="testimonials">
			<blockquote>
				<p align="justify">
                     <cite>Clientes como aliados estrat&eacute;gicos.&ndash;</cite>
                     "Nuestra pasi&oacute;n por la tecnolog&iacute;a de RR.HH es el hilo conductor de
                     nuestra forma de trabajar y de la relaci&oacute;n que se establece con los clientes. Esta
                     filosof&iacute;a permite innovar conjuntamente y mejorar la calidad de los procesos de
                     RR.HH a medida que sus necesidades crecen y cambian."
				</p>
			</blockquote>
			<blockquote>
				<p align="justify">
                     <cite>Comunicaci&oacute;n con los usuarios.&ndash;</cite>
                     "Todos los miembros de "SEIP" escuchamos activamente lo que nuestros usuarios
                     tienen que decir y as&iacute; ser capaces de identificar sus necesidades. Para fomentar la
                     comunicaci&oacute;n, recurrentemente invitamos a nuestra comunidad de usuarios a que
                     participen de manera activa en un dialogo con nosotros. De esta manera nos hacen
                     llegar sus inquietudes y podemos actuar en consecuencia. As&iacute; nos aseguramos de
                     mantener a nuestros usuarios satisfechos."
                </p>
			</blockquote>
			<blockquote>
				<p align="justify">
                     <cite>Metas.&ndash;</cite>
                     "Permitir el correcto balance entre Tecnolog&iacute;a, Empresa y Colaboradores, que eleva
                     la competitividad de su organizaci&oacute;n."
                </p>
			</blockquote>
		</div>
		<!--end testimonials-->
	</div>
</div>
<?php require('pages/commons/footer.php'); ?>