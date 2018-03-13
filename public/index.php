<?php require_once("../includes/initialize.php");?>
<?php
	$pagina = (!empty($_GET["pagina"]))? (int)$_GET["pagina"] : 1;
	$fotos_grupo = 3;	
	$total_fotos = FOTO::cantidad_total();
	
	//$fotos = Foto::buscar_todos();
	
	$paginacion = new Paginacion($pagina,$fotos_grupo,$total_fotos);
	$sql = "SELECT * FROM fotos";
	$sql .= " LIMIT {$fotos_grupo} ";
	$sql .= "OFFSET " . $paginacion->offset();
	
	$fotos = Foto::buscar_por_sql($sql);
?>
<?php incluir_plantillas("header.php"); ?>
<div id="cuerpo" align="center">
	<h2>Todas las Fotos</h2>
	<div class="col-md-12" style="float:center; margin:10px;">
	<?php foreach($fotos as $foto){ ?>
		<a href="full_screen.php?id=<?php echo $foto->id; ?>"><img src="<?php echo $foto->ruta_imagen(); ?>" width="100" /></a>
		<p><?php echo $foto->titulo; ?></p>
		<?php }?>
	</div>
	<div style="clear:both;">
		<?php
			if($paginacion->existe_anterior())
			{
				echo "<a href=\"index.php?pagina=";
				echo $paginacion->pagina_anterior();
				echo "\">Anterior</a>";
			}
			
			for($i=1;$i<=$paginacion->total_paginas();$i++)
			{
				if($paginacion->pagina_actual == $i)
				{
					echo "&nbsp;<b>{$i}</b>";
				}
				else
				{
					echo "&nbsp;<a href=\"index.php?pagina={$i}\"> {$i} -</a>";
				}
			}
			
			if($paginacion->existe_siguiente())
			{
				echo "<a href=\"index.php?pagina=";
				echo $paginacion->pagina_siguiente();
				echo "\">Siguiente</a>";
			}
		?>
	</div>
</div>
<?php incluir_plantillas("footer.php"); ?>