<?php 
require_once('commons/header_int.php');
require_once('../clases/valor_definicion.php');

$obj_valordefinicion  = new ClassValDefinicion();

$result = $obj_valordefinicion->get_Definiciones();

$valida=0;
$informacion = array();
for($i=0; $i<count($result); $i++)
{
	if($valida != $result[$i]['id_tipo_definicion']){
		$j = 0;
		$valida = $result[$i]['id_tipo_definicion'];
	}
	$informacion[$result[$i]['id_tipo_definicion']]['id_tipo_definicion']               = $result[$i]['id_tipo_definicion'];
	$informacion[$result[$i]['id_tipo_definicion']]['tipo_definicion']                  = $result[$i]['tipo_definicion'];
	$informacion[$result[$i]['id_tipo_definicion']]['estado']                           = $result[$i]['estado'];
	$informacion[$result[$i]['id_tipo_definicion']]['detalle'][$j]['id_valor_def']      = $result[$i]['id_valor_def'];
	$informacion[$result[$i]['id_tipo_definicion']]['detalle'][$j]['valor_definicion']  = $result[$i]['valor_definicion'];
	$informacion[$result[$i]['id_tipo_definicion']]['detalle'][$j]['desc_valor_def']    = $result[$i]['desc_valor_def'];
	$informacion[$result[$i]['id_tipo_definicion']]['detalle'][$j]['estado_det']        = $result[$i]['estado_det'];
	$j++;
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
                <a href="organizacion_nueva.php" class="button">Nuevo</a>
                <a href="#" class="success button">Button</a>
            </div>            
            <table style="margin: 0 auto !important;" width='100%' class="table table-hover">
            	<tbody>
	            	<tr>
	            		<th width='2%'>&nbsp;</th>
						<th width='60%'>Tipo de Definición</th>
						<th width='20%'>Estado</th>
						<th width='18%'>Acciones</th>
	            	</tr>
	            	<?php foreach($informacion as $key => $valor):  ?>
	            	<tr>
	            		<td><span onclick='javascript:abrir_detalle(this);' id="<?php echo $key; ?>" class="deplega_detalle_<?php echo $key; ?> deplegar" >+</span></td>
	            		<td><?php echo $valor['tipo_definicion']; ?></td>
	            		<td><?php echo $valor['estado']; ?></td>
	            		<td>Content</td>
	            	</tr>
            	</tbody>
            	<tbody style="display:none;" id="detalle_<?php echo $key; ?>" class="detalle_tabla">
					<tr>
		        		<th colspan=2>Descripción</th>
		        		<th>Valor Definición</th>
		        		<th>Estado</th>
		    		</tr>
		    		<?php for ($i=0; $i < count($valor['detalle']); $i++): ?>
		    		<tr>
		    			<td colspan=2><?php echo utf8_encode($valor['detalle'][$i]['desc_valor_def']); ?></td>
		    			<td><?php echo utf8_encode($valor['detalle'][$i]['valor_definicion']); ?></td>
		    			<td><?php echo $valor['detalle'][$i]['estado_det']; ?></td>
		    		</tr>
		    		<?php endfor; ?>
            	</tbody>
            <?php endforeach; ?>
            </table>
		</div>
	</div>
</div>
<?php require_once('commons/footer_int.php'); ?>