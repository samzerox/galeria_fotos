<?php
require_once(LIB_DIR . SD . "database.php");

class Comentario extends Tabla
{
	public $id;
	public $foto_id;
	public $creado;
	public $autor;
	public $contenido;
	
	protected static $nombre_tabla = "comentarios";
	protected static $campos_tabla = array("foto_id", "creado", "autor", "contenido");
	
	public static function crear_nuevo($foto_id,$autor,$contenido)
	{
		if(!empty($foto_id) && !empty($autor) && !empty($contenido))
		{
			$comentario = new Comentario();
			$comentario->foto_id = (int)$foto_id;
			$comentario->autor = $autor;
			$comentario->creado = strftime("%Y-%m-%d %H:%M:%S",time());
			$comentario->contenido = $contenido;
			return $comentario;
		}
		else
		{
			return false;
		}
	}
	
	public static function comentarios_por_foto($foto_id)
	{
		global $bd;
		$sql = "SELECT * FROM " . self::$nombre_tabla;
		$sql .= " WHERE foto_id =" . $bd->preparar_consulta($foto_id);
		$sql .= " ORDER BY creado ASC";
		return self::buscar_por_sql($sql);
	}
	
	
}
?>