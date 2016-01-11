<?php require_once('commons/header_int.php');
      require_once('../clases/organizacion.php');
      
      $obj_organizacion = new ClassOrganizacion();
      
      $result = $obj_organizacion->get_Organizacion();
      
?>

<!-- ANIMATED COLUMNS 
================================================== -->
<div class="row content">
    
<div class="row">
    <hr>
        <!-- TABLES-->
		<div class="twelve columns" style="text-align: center;">
			<h5>ORGANIZACIONES</h5>
            <div class="clear"></div>
            <div class="row botonera">
                <a href="organizacion_nueva.php" class="button">Nuevo</a>
                <a href="#" class="success button">Button</a>
            </div>
			<table style="margin: 0 auto !important;">
			<thead>
			<tr>
				<th>
					Nit Empresa
				</th>
				<th>
					Nombre Empresa
				</th>
				<th>
					Sector Economico
				</th>
				<th>
					Acciones
				</th>
			</tr>
			</thead>
			<tbody>
                <?php for($i=0 ; $i < count($result); $i++ ): ?>
			<tr>
				<td>
					<?php echo $result[$i]['nit_empresa']; ?>
				</td>
				<td>
					<?php echo $result[$i]['nombre_empresa']; ?>
				</td>
				<td>
					<?php echo $result[$i]['valor_definicion']; ?>
				</td>
				<td>
					Content
				</td>
			</tr>
            <?php endfor; ?>
			</tbody>
			</table>
		</div>
	</div>

<!--<div class="row">
	<div class="twelve columns">
		<ul class="ca-menu">
			<li>
			<a href="#">
			<span class="ca-icon"><i class="fa fa-heart"></i></span>
			<div class="ca-content">
				<h2 class="ca-main">Responsive<br/> Design</h2>
				<h3 class="ca-sub">Across all major devices</h3>
			</div>
			</a>
			</li>
			<li>
			<a href="#">
			<span class="ca-icon"><i class="fa fa-bullhorn"></i></span>
			<div class="ca-content">
				<h2 class="ca-main">Friendly<br/> Documentation</h2>
				<h3 class="ca-sub">Straight to the point</h3>
			</div>
			</a>
			</li>
			<li>
			<a href="#">
			<span class="ca-icon"><i class="fa fa-user"></i></span>
			<div class="ca-content">
				<h2 class="ca-main">Alternate<br/> Home Pages</h2>
				<h3 class="ca-sub">Full slider, boxed or none</h3>
			</div>
			</a>
			</li>
			<li>
			<a href="#">
			<span class="ca-icon"><i class="fa fa-camera"></i></span>
			<div class="ca-content">
				<h2 class="ca-main">Filterable<br/> Portofolio</h2>
				<h3 class="ca-sub">Isotop & PrettyPhoto</h3>
			</div>
			</a>
			</li>
		</ul>
	</div>
</div>
<!-- CONTENT 
================================================== --
<div class="row">
	<div class="twelve columns">
		<div class="centersectiontitle">
			<h4>What we do</h4>
		</div>
	</div>
	<div class="four columns">
		<h5>Photography</h5>
		<p>
			 Swine short ribs meatball irure bacon nulla pork belly cupidatat meatloaf cow. Nulla corned beef sunt ball tip, qui bresaola enim jowl. Capicola short ribs minim salami nulla nostrud pastrami.
		</p>
		<p>
			<a href="#" class="readmore">Learn more</a>
		</p>
	</div>
	<div class="four columns">
		<h5>Artwork</h5>
		<p>
			 Swine short ribs meatball irure bacon nulla pork belly cupidatat meatloaf cow. Nulla corned beef sunt ball tip, qui bresaola enim jowl. Capicola short ribs minim salami nulla nostrud pastrami.
		</p>
		<p>
			<a href="#" class="readmore">Learn more</a>
		</p>
	</div>
	<div class="four columns">
		<h5>Logos</h5>
		<p>
			 Swine short ribs meatball irure bacon nulla pork belly cupidatat meatloaf cow. Nulla corned beef sunt ball tip, qui bresaola enim jowl. Capicola short ribs minim salami nulla nostrud pastrami.
		</p>
		<p>
			<a href="#" class="readmore">Learn more</a>
		</p>
	</div>
</div>
<div class="hr">
</div>
<!-- TESTIMONIALS 
================================================== --
<div class="row">
	<div class="twelve columns">
		<div id="testimonials">
			<blockquote>
				<p>
					 "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis." <cite>Martin - NY</cite>
				</p>
			</blockquote>
			<blockquote>
				<p>
					 "Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco." <cite>Sandra - LA</cite>
				</p>
			</blockquote>
			<blockquote>
				<p>
					 "Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco." <cite>Jason - MA</cite>
				</p>
			</blockquote>
		</div>
		<!--end testimonials--
	</div>
</div>-->
</div>
<?php require_once('commons/footer_int.php'); ?>