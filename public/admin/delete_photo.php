<?php require_once("../../includes/initialize.php");?>
<?php if(!$sesion->esta_logueado()) { redireccionar_a("login.php"); } ?>
<?php
	$mensaje = "";
	if(!empty($_GET["id"]))
	{
		
		$foto = Foto::buscar_por_id($_GET["id"]);
		if($foto->suprimir())
		{
			$mensaje = "Se ha eliminado correctamente la foto";
		}
		else
		{
			$mensaje = "No se ha podido eliminar la foto";
		}
	}
	redireccionar_a("list_photos.php?mensaje={$mensaje}");
?>


<?php if(isset($bd)) {$bd->cerrar_conexion();} ?>
