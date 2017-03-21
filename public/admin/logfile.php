<?php require_once("../../includes/initialize.php");?>
<?php if(!$sesion->esta_logueado()) { redireccionar_a("login.php"); } ?>
<?php
	$archivo_txt = RAIZ_DIR.SD."logs".SD."log.txt";
	if(isset($_GET["limpiar"]) && $_GET["limpiar"]== "1")
	{
		file_put_contents($archivo_txt,"");
		grabar_acciones("Limpiar","El usuario " . $sesion->usuario_id . " ha limpiado el archivo log");
		redireccionar_a("logfile.php");
	}
?>
<?php incluir_plantillas("admin_header.php"); ?>
<div id="cuerpo">
<h2>Archivo Log</h2>
<p><a href="index.php">&lt;&lt;Atrás</a></p>
<p><a href="logfile.php?limpiar=1">Limpiar el archivo Log</a></p>
<ul>
<?php
	
	if(file_exists($archivo_txt) && is_readable($archivo_txt) && $archivo = fopen($archivo_txt,"r"))
	{
		while(!feof($archivo))
		{
			$contenido = trim(fgets($archivo));
			if($contenido != "")
			{
				echo "<li>{$contenido}</li>";
			}
		}
		fclose($archivo);
		
	}
?>
</ul>
</div>
<?php incluir_plantillas("admin_footer.php"); ?>