<?php require_once("../../includes/initialize.php");?>
<?php if(!$sesion->esta_logueado()) { redireccionar_a("login.php"); } ?>
<?php
	$mensaje = "";
	if(!empty($_GET["id"]))
	{
		$foto=Foto::buscar_por_id($_GET["id"]);
		if(!$foto)
		{
			redireccionar_a("index.php");
		}
	}
	else
	{
		redireccionar_a("index.php");
	}	
	$comentarios = $foto->comentarios();
?>
<?php incluir_plantillas("admin_header.php"); ?>
<div id="cuerpo">
<?php 
	if(!empty($_GET["mensaje"]))
	{
		echo "<p>" . $_GET["mensaje"] . "</p>";
	}
?>
<h2>Comentarios para <?php echo $foto->archivo;?></h2>
<p><a href="list_photos.php">&lt;&lt;Atrás</a></p>
<?php foreach($comentarios as $coment){ ?>
<div style="margin:5px;">
	<div><?php echo $coment->autor; ?></div>
    <div><?php echo $coment->contenido; ?></div>
    <div><?php echo formato_creado($coment->creado); ?></div>
    <div><a href="delete_comment.php?id=<?php echo $coment->id;?>">Eliminar Comentario</a></div>
</div>
<?php }?>

</div>
<?php incluir_plantillas("admin_footer.php"); ?>