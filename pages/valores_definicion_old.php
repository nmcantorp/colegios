<?php 
require_once('commons/header_int.php');
require_once('../clases/valor_definicion.php');

$obj_valordefinicion  = new ClassValDefinicion();

$result = $obj_valordefinicion->get_Definiciones();

$informacion = array();
for($i=0; $i<count($result); $i++)
{
	$informacion[$result[$i]['id_tipo_definicion']]['id_tipo_definicion']               = $result[$i]['id_tipo_definicion'];
	$informacion[$result[$i]['id_tipo_definicion']]['tipo_definicion']                  = $result[$i]['tipo_definicion'];
	$informacion[$result[$i]['id_tipo_definicion']]['estado']                           = $result[$i]['estado'];
	$informacion[$result[$i]['id_tipo_definicion']]['detalle'][$i]['id_valor_def']      = $result[$i]['id_valor_def'];
	$informacion[$result[$i]['id_tipo_definicion']]['detalle'][$i]['valor_definicion']  = $result[$i]['valor_definicion'];
	$informacion[$result[$i]['id_tipo_definicion']]['detalle'][$i]['desc_valor_def']    = $result[$i]['desc_valor_def'];
	$informacion[$result[$i]['id_tipo_definicion']]['detalle'][$i]['estado_det']        = $result[$i]['estado_det'];
}
	  
	
?>

<!-- ANIMATED COLUMNS 
================================================== -->
<div class="row content">
	
<div class="row">
	<hr>
		<!-- TABLES-->
		<div class="twelve columns" style="text-align: center;">
			<h5>VALORES DEFINICIÓN</h5>
			<div class="clear"></div>
			<div class="row botonera">
				<a href="valores_definicion_nuevo.php" class="button">Nuevo</a>
				<a href="#" class="success button">Button</a>
			</div>

			<table  style="margin: 0 auto !important;">
				<tbody>
					<tr>
						<th>&nbsp;</th>
						<th>Tipo de Definición</th>
						<th>Estado</th>
						<th>Acciones</th>
					</tr>
					<?php foreach($informacion as $key => $valor):  ?>
					<tr>
						<td><span onclick="javascript:abrir_detalle(this);" id="<?php echo $key; ?>">+</span></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>

					<?php endforeach; ?>
				</tbody>
			</table>
			<!-- <table style="margin: 0 auto !important;">
			<thead>
			<tr>
				<th>
					&nbsp;
				</th>
				<th>
					Tipo de Definición
				</th>
				<th>
					Estado
				</th>
				<th>
					Acciones
				</th>
			</tr>
			</thead>
			<tbody>
				<?php foreach($informacion as $key => $valor):  ?>
				<tr>
					<td>
						<span onclick='javascript:abrir_detalle(this);' id="<?php echo $key; ?>">+</span>
					</td>
					<td>
						<?php echo $valor['tipo_definicion']; ?>
					</td>
					<td>
						<?php echo $valor['estado']; ?>
					</td>
					<td>
						Content
					</td>
				</tr>
				<tr id="detalle_<?php echo $key; ?>" style="display:none;">
					<td>
						<tr>
							<td>
								Valor Definición
							</td>
							<td>
								Descripción
							</td>
							<td>
								Estado
							</td>
							<td>
								Acciones
							</td>
						</tr>

						<?php for ($i=0; $i < count($valor['detalle']); $i++): ?>
						<tr>
							<td>
								<?php echo utf8_encode($valor['detalle'][$i]['valor_definicion']); ?>
							</td>
							<td>
								<?php echo utf8_encode($valor['detalle'][$i]['desc_valor_def']); ?>
							</td>
							<td>
								<?php echo $valor['detalle'][$i]['estado_det']; ?>
							</td>
							<td>
								Content
							</td>
						</tr>

						<?php endfor; ?>
					</td>                        
				</tr>                
				
			</tbody>
			</table> -->
		</div>

	</div>
</div>
<?php require_once('commons/footer_int.php'); ?>