<?php require_once("../../includes/initialize.php");?>
<?php if(!$sesion->esta_logueado()) { redireccionar_a("login.php"); } ?>
<?php incluir_plantillas("admin_header.php"); ?>
<div id="cuerpo">
<h2>Index</h2>
<ul>
	<li><a href="list_photos.php">Todas las Fotos</a></li>
    <li><a href="logfile.php">Ver el archivo Log</a></li>
</ul>
</div>
<?php incluir_plantillas("admin_footer.php"); ?>