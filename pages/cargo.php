<?php require_once('commons/header_int.php');
      require_once('../clases/cargos.php');
      
      $obj_cargo  = new ClassCargos();    
      
      $result = $obj_cargo->get_Cargos();
      
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
                <a href="cargos_nuevo.php" class="button">Nuevo</a>
                <a href="#" class="success button">Button</a>
            </div>
			<table style="margin: 0 auto !important;">
			<thead>
			<tr>
				<th>
					Nombre Cargo
				</th>
				<th>
					Descripción Cargo
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
					<?php echo $result[$i]['descripcion_cargo']; ?>
				</td>
				<td>
					<?php echo $result[$i]['observaciones']; ?>
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
</div>
<?php require_once('commons/footer_int.php'); ?>