<?php require_once("../../includes/initialize.php");?>
<?php if(!$sesion->esta_logueado()) { redireccionar_a("login.php"); } ?>
<?php
	$mensaje = "";
	if(!empty($_GET["id"]))
	{
		
		$comentario = Comentario::buscar_por_id($_GET["id"]);
		if($comentario && $comentario->eliminar())
		{
			$mensaje = "Se ha eliminado el comentario";
		}
		else
		{
			$mensaje = "No se ha podido eliminar el comentario";
		}
	}
	redireccionar_a("list_photos.php?mensaje={$mensaje}");
?>


<?php if(isset($bd)) {$bd->cerrar_conexion();} ?>
