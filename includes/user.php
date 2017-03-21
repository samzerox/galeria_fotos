<?php
	require_once(LIB_DIR . SD . "database.php");
	
	class Usuario extends Tabla
	{
		public $id;
		public $usuario;
		public $clave;
		public $nombre;
		public $apellido;
		
		protected static $nombre_tabla = "usuarios";
		protected static $campos_tabla = array("usuario", "clave", "nombre", "apellido");
		
		public static function autenticar($usuario="",$clave="")
		{
			global $bd;
			$usuario =$bd->preparar_consulta($usuario);
			$clave = $bd->preparar_consulta($clave);
			
			$sql = "SELECT * FROM usuarios ";
			$sql .= "WHERE usuario='{$usuario}' ";
			$sql .= "AND clave='{$clave}' ";
			$sql .= "LIMIT 1";
			
			$matriz_usuarios = self::buscar_por_sql($sql);
			return (!empty($matriz_usuarios))? array_shift($matriz_usuarios):false;
		}
		
		
		public function nombre_completo()
		{
			if(isset($this->nombre) && isset($this->apellido))
			{
				return $this->nombre . " " . $this->apellido;
			}
			else
			{
				return "";
			}
		}
	
		
	
	}
?>