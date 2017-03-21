<?php require_once("../../includes/initialize.php");?>
<?php incluir_plantillas("admin_header.php"); ?>
<?php
	/*$usuario = new Usuario();
  	$usuario->usuario = "keyn";
  	$usuario->clave = "159";
  	$usuario->nombre = "veronica";
  	$usuario->apellido = "cordova";
  	$usuario->crear();*/
  	//echo $usuario->id;

$usuario = Usuario::buscar_por_id(1);
$usuario->clave = "123";
$usuario->guardar();

/*$usuario = Usuario::buscar_por_id(1);
$usuario->actualizar();
echo $usuario->id;*/

	
?>
<?php incluir_plantillas("admin_footer.php"); ?>