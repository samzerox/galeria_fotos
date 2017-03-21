<?php require_once("../includes/initialize.php");?>
<?php
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
	$mensaje = "";
	if(isset($_POST["submit"]))
	{
		$autor = trim($_POST["autor"]);
		$contenido = trim($_POST["contenido"]);
		
		$comentario = Comentario::crear_nuevo($foto->id,$autor,$contenido);
		if($comentario && $comentario->guardar())
		{
			redireccionar_a("full_screen.php?id=" . $foto->id);
		}
		else
		{
			$mensaje = "No se ha podido guardar el comentario.";
		}
	}
	else
	{
		$autor = "";
		$contenido = "";
	}
	
	$comentarios = $foto->comentarios();
?>
<?php incluir_plantillas("header.php"); ?>
<div id="cuerpo">
<p><a href="index.php">&lt;&lt;Atrás</a></p>
<p><?php echo $mensaje; ?></p>
<div style="margin:5px;">
<img src="<?php echo $foto->ruta_imagen(); ?>" width="400"/>
</div>
<?php foreach($comentarios as $coment){ ?>
<div style="margin:5px;">
	<div><?php echo $coment->autor; ?></div>
    <div><?php echo $coment->contenido; ?></div>
    <div><?php echo formato_creado($coment->creado); ?></div>
</div>
<?php }?>
<form action="full_screen.php?id=<?php echo $foto->id; ?>" method="post">
<table>
<tr>
<td>Nombre:</td>
<td><input type="text" name="autor" value="<?php echo $autor; ?>" /></td>
</tr>
<tr>
<td style="vertical-align:top;">Comentario:</td>
<td><textarea name="contenido" cols="40" rows="8"><?php echo $contenido; ?> </textarea></td>
</tr>
<tr>
<td>&nbsp;</td>
<td style="text-align: right"><input type="submit" name="submit" value="Enviar Comentario" /></td>
</tr>
</table>


</form>
</div>
<?php incluir_plantillas("footer.php"); ?>