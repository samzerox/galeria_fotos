<?php require_once("../../includes/initialize.php");?>
<?php if(!$sesion->esta_logueado()) { redireccionar_a("login.php"); } ?>
<?php
	$fotos = Foto::buscar_todos();
?>
<?php incluir_plantillas("admin_header.php"); ?>
<div id="cuerpo">
<h2>Todas las fotos </h2>
<p><a href="index.php">&lt;&lt;Atrás</a></p>
<?php 
	if(!empty($_GET["mensaje"]))
	{
		echo "<p>" . $_GET["mensaje"] . "</p>";
	}
?>
<table border="1">
	<tr>
    	<th>Imagen</th>
        <th>Nombre de archivo</th>
        <th>Titulo</th>
        <th>Tamaño</th>
        <th>Tipo</th>
        <th>Comentario</th>
        <th>&nbsp;</th>
 	</tr>
    <?php
		foreach($fotos as $foto){
	?>
    <tr>
    	<td><img width="100" src="../<?php echo $foto->ruta_imagen(); ?>" /></td>
        <td><?php echo $foto->archivo; ?></td>
        <td><?php echo $foto->titulo; ?></td>
        <td><?php echo round(((float)$foto->peso)/1024) . " KB"; ?></td>
        <td><?php echo $foto->tipo; ?></td>
        <td style="text-align:center"><a href="list_comments.php?id=<?php echo $foto->id;?>"><?php echo count($foto->comentarios()); ?></a></td>
        <td><a href="delete_photo.php?id=<?php echo $foto->id; ?>">Eliminar</a></td>
    </tr>
    <?php } ?>
</table>
<p><a href="photo_upload.php">Subir una nueva foto</a></p>
</div>

<?php incluir_plantillas("admin_footer.php"); ?>
