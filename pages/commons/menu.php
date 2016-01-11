<?php
    require_once('../clases/menu.php');
    $objMenu = new ClassMenu();
    
    $result_menu = $objMenu->get_menu($perfil);

?>

<div class="headermenu eight columns noleftmarg">
	<nav id="nav-wrap">
	<ul id="main-menu" class="nav-bar sf-menu">
		<?php for ($i=0; $i < count($result_menu); $i++) { 
			$result_submenu=0; 
		?>
			<li class="current">
				<a href="<?php echo $result_menu[$i]['link']; ?>"><?php echo $result_menu[$i]['name_menu'];?></a>
				<?php $result_submenu = $objMenu->get_sub($perfil, $result_menu[$i]['id_menu']);
				if(count($result_submenu)>0){ ?>
					<ul>
						<?php for ($j=0; $j < count($result_submenu); $j++) {  ?>
						<li><a href="<?php echo $result_submenu[$j]['link']; ?>"><?php echo $result_submenu[$j]['name_menu']; ?></a></li>
						<?php } ?> 
					</ul>
				<?php } ?>
			</li>
		<?php } ?>
	</ul>
	</nav>
</div>