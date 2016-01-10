<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="">
    <title>Home</title>
    <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  	<link rel="stylesheet" type="text/css" media="screen" href="css/normalize.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/reset.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/slider.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/zerogrid.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/responsive.css">
        <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap-3.3.4/css/bootstrap.css" type="text/css" >
    
    <link rel="stylesheet" href="font/style.css">
    <!-- <link href='http://fonts.googleapis.com/css?family=Lato:300italic' rel='stylesheet' type='text/css'> 
    <script src="js/jquery-2.1.3.js" type="text/javascript" charset="utf-8" ></script>-->
    <script src="js/jquery-1.8.0.min.js" type="text/javascript"></script>
	  <script src="js/funciones_plataforma.js" type="text/javascript" ></script>
    <script > 

      $(document).ready(function() {
        /* Act on the event */
        $('#open_menu').click(function() {
          open_menu();
        });

        $('#menu_principal').mouseleave(function(){
          open_menu();
        });

      });
        

    </script>

</head>
<body>

	<header> 
   		<div class="nav-responsive"><div>MENU</div>
			<select onchange="location=this.value">
				<option></option>
				<option value="index.html">Home</option>
				<option value="about.html">About</option>
				<option value="services.html">Services</option>
				<option value="products.html">Products</option>
				<option value="contacts.html">Contacts</option>
			</select>
		</div>
       <div> 
          <div>
      		<div class="imagen_header">
      		  <h1><a href="index.html"><img src="images/logo.png" alt=""></a></h1> 
      		</div> 
	      		<div class="imagen_header">
	      		  <h1>
	      		  	<div id="img_perfil">
	      		  		
		      		  	<a href="#" id="img_perfil"><img src="images/logo.png" alt=""></a>
						<a href="#">Perfil</a>
					</div>
	      		  </h1> 
	      		</div>                	
              <div class="clear"></div>
              
              
          </div>
      </div>
    </header> 
    <div id="open_menu" class="icon-flickr" title="Selección Modulos"></div>
    <nav style="display:block !important; height: 80px; padding-right: 35px;">  
      <ul class="menu">
            <li class="current"><a href="index.html">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="services.html">Services</a></li>
            <li><a href="products.html">Products</a></li>
            <li><a href="contacts.html">Contacts</a></li>
        </ul>
    </nav>

    <section id="menu_principal" style="display:none;box-shadow: 0px 0px 10px white;">

    		<ul>
    			<li><a href="" title="">Modulo 1</a></li>
    			<li><a href="" title="">Modulo 2</a></li>
    			<li><a href="" title="">Modulo 3</a></li>
    		</ul>

    </section>
  <div id="content">
    <form role="form" action="index_submit" method="get" accept-charset="utf-8">
      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Text</label>
        <input type="text" class="form-control" id="exampleInputText1" placeholder="Enter texto">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
      </div>
      <div class="form-group">
        <label for="exampleInputFile">File input</label>
        <input type="file" id="exampleInputFile">
        <p class="help-block">Example block-level help text here.</p>
      </div>
      <div class="checkbox">
        <label>
          <input type="checkbox"> Check me out
        </label>
      </div>
      <button type="submit" class="btn btn-default">Submit</button>
    </form>  
      
  </div>  




  <footer>
    <div id="copyright">
    <div class="container">
      <div class="eleven columns alpha">
        <p class="copyright">&copy; Copyright <?php echo date(Y);?>. Powered by <a href="http://www.sialen.com/">Sialen Ingenieros</a>. Todos los Derechos reservados.</p>
      </div>
      <div class="five columns omega">
        <section class="socials">
          <ul class="socials fr">
            <li><a href="<?= twitter_sialen ?>" target="_blank"><img src="images/socials/twitter.png" class="poshytip" title="Twitter"  alt="" /></a></li>
            <li><a href="<?= facebook_sialen ?>" target="_blank"><img src="images/socials/facebook.png" class="poshytip" title="Facebook" alt="" /></a></li>
            <li><a href="https://plus.google.com/114463416160723914589"  target="_blank"><img src="images/socials/google.png" class="poshytip" title="Google" alt="" /></a></li>
            <!--<li><a href="#"><img src="images/socials/dribbble.png" class="poshytip" title="Dribbble" alt="" /></a></li> -->
          </ul>
        </section>
      </div>
    </div>
    <!-- container ends here --> 
  </div>
  </footer>
</body>
</html>