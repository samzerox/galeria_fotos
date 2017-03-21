<?php require_once("../../includes/initialize.php");?>
<?php if(!$sesion->esta_logueado()) { redireccionar_a("login.php"); } ?>
<?php
	if(isset($_POST["submit"]))
	{
		$foto = new Foto();
		$foto->titulo = $_POST["title"];
		$foto->adjuntar_foto($_FILES["file_upload"]);
		if($foto->guardar())
		{
			$mensaje = "El archivo se ha subido con exito.";
		}
		else
		{
			$mensaje = "Existen los siguientes errores <br />";
			$mensaje .= implode("<br />", $foto->errores);
		}
	}
?>
<?php incluir_plantillas("admin_header.php"); ?>
<div id="cuerpo">
<h2>Subir Foto</h2>
<p><a href="list_photos.php">&lt;&lt;Atrás</a></p>
<?php
	if(isset($mensaje))
	{
		echo "<p>{$mensaje}</p>";
	}
	
?>
<form action="photo_upload.php" enctype="multipart/form-data" method="post">
	<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
    <input type="file" name="file_upload" />
    <p>Titulo: <input type="text" name="title" value="" /> <br /></p>
    <input type="submit" name="submit" value="Subir Foto"/>
</form>

</div>
<?php incluir_plantillas("admin_footer.php"); ?>