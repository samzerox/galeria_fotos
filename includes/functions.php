<?php

function redireccionar_a($url)
{
	header("Location: {$url}");
	exit();
}

function __autoload($nombre_clase)
{
	die("La clase {$nombre_clase} no ha sido encontrada.");
}

function incluir_plantillas($plantilla)
{
	include(RAIZ_DIR.SD."public".SD."layouts".SD.$plantilla);
}

function grabar_acciones($accion,$mensaje)
{
	$ruta_archivo = RAIZ_DIR.SD."logs".SD."log.txt";
	if($archivo = fopen($ruta_archivo,"at"))
	{
		$tiempo = strftime("%Y-%m-%d %H:%M:%S",time());
		$cadena = $tiempo . " | " . $accion . " | " . $mensaje . "\n";
		fwrite($archivo,$cadena);
		fclose($archivo);
	}
	else
	{
		echo "No se ha podido registrar la accion.";
	}
}

function formato_creado($fecha_bd)
{
	setlocale(LC_ALL,'Spanish');
	$tiempo =strtotime($fecha_bd);
	return strftime("%d de %B del %Y a las %I:%M:%p",$tiempo);
	
}
?>
