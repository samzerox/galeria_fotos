<?php
require_once(LIB_DIR . SD . "database.php");

class Tabla
{
	protected static $nombre_tabla;
	protected static $campos_tabla;
	
	public static function buscar_por_id($id)
	{
		global $bd;
		$matriz_usuarios = static::buscar_por_sql("SELECT * FROM " . static::$nombre_tabla ." WHERE id =" . $bd->preparar_consulta($id) . " LIMIT 1");
		return (!empty($matriz_usuarios))? array_shift($matriz_usuarios):false;
	}
		
	public static function buscar_todos()
	{
		return self::buscar_por_sql("SELECT * FROM " . static::$nombre_tabla);
		
	}
		
	public static function buscar_por_sql($sql)
	{
		global $bd;
		$resultado = $bd->enviar_consulta($sql);
		$matriz_objetos = array();
		while($registro = $bd->fetch_array($resultado))
		{
			array_push($matriz_objetos, static::instanciar($registro));
		}
		return $matriz_objetos;
	}
	
	public static function instanciar($registro)
	{
		$nombre_clase = get_called_class();
		$objeto = new $nombre_clase;
		foreach($registro as $propiedad => $valor)
		{
			if($objeto->propiedad_existe($propiedad))
			{
				$objeto->$propiedad = $valor;
			}
		}
		
		return $objeto;
	}
	
	public static function cantidad_total()
	{
		global $bd;
		$sql="SELECT COUNT(*) FROM " . static::$nombre_tabla;
		$resultado = $bd->enviar_consulta($sql);
		$registro = $bd->fetch_array($resultado);
		return array_shift($registro);
	}
		
	public function propiedad_existe($propiedad)
	{
		$propiedades = get_object_vars($this);
		return array_key_exists($propiedad,$propiedades);
	}
	
	public function propiedades()
	{
		$campos_props = array();
		foreach(static::$campos_tabla as $campo)
		{
			$campos_props[$campo] = $this->$campo;
		}
		return $campos_props;
	}
		
	public function guardar()
	{
		if(!isset($this->id))
		{
			return $this->crear();
		}
		else
		{
			return $this->actualizar();
		}
	}
	
	public function crear()
	{
		global $bd;
		$propiedades = $this->propiedades();
		$sql = "INSERT INTO " . static::$nombre_tabla . "(";
		$sql .=  implode(",",array_keys($propiedades));
		$sql .= ") VALUES ('";
		$sql .= implode("','",array_values($propiedades)) . "')";
		if($bd->enviar_consulta($sql))
		{
			$this->id = $bd->insert_id();
			return true;
		}
		else
		{
			return false;
		}	
	}
	
	public function actualizar()
	{
		global $bd;
		$propiedades = $this->propiedades();
		$prop_format = array();
		foreach($propiedades as $propiedad => $valor)
		{
			array_push($prop_format , "{$propiedad} = '{$valor}'");
		}
		$sql = "UPDATE ". static::$nombre_tabla ." SET ";
		$sql .= implode("," , $prop_format);
		$sql .= " WHERE id = " . $bd->preparar_consulta($this->id);
		
		$bd->enviar_consulta($sql);
		if($bd->affected_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}
	
	public function eliminar()
	{
		global $bd;
		$sql = "DELETE FROM " . static::$nombre_tabla . " ";
		$sql .= " WHERE id = " . $bd->preparar_consulta($this->id);
		$sql .= " LIMIT 1";
		$bd->enviar_consulta($sql);
		if($bd->affected_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}		
	
}
?>