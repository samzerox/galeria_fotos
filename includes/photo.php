<?php
require_once(LIB_DIR . SD . "database.php");

class Foto extends Tabla
{
	public $id;
	public $archivo;
	public $tipo;
	public $peso;
	public $titulo;
	private $nombre_tmp;
	private $fotos_dir = "images";
	
	public $errores = array();
	
	protected $errores_upload  = array(
		UPLOAD_ERR_OK => "No se ha producido ningun error.",
		UPLOAD_ERR_INI_SIZE => "El tamaño de archivo ha excedido el maximo indicado en php.ini",
		UPLOAD_ERR_FORM_SIZE => "El tamaño de archivo ha excedido el maximo para este formulario",
		UPLOAD_ERR_PARTIAL => "El archivo ha sido subido parcialmente",
		UPLOAD_ERR_NO_FILE => "El archivo no existe",
		UPLOAD_ERR_NO_TMP_DIR => "El directorio temporal no existe",
		UPLOAD_ERR_CANT_WRITE => "No se puede escribir en el disco duro",
		UPLOAD_ERR_EXTENSION => "Error en una extencion PHP");
	
	protected static $nombre_tabla = "fotos";
	protected static $campos_tabla = array("archivo", "tipo", "peso", "titulo");
	
	public function ruta_imagen()
	{
		return $this->fotos_dir . "/" . $this->archivo;
	}
	
	public function adjuntar_foto($info)
	{
		if(!$info || empty($info) || !is_array($info))
		{
			array_push($errores,"No se ha pasado ninguna informacion de archivo.");
			return false;
		}
		elseif($info["error"] != 0)
		{
			array_push($errores, $errores_upload[$info["error"]]);
			return false;
		}
		else
		{
		  $this->archivo = basename($info["name"]);
		  $this->peso = $info["size"];
		  $this->tipo = $info["type"];
		  $this->nombre_tmp = $info["tmp_name"];
		  return true;
		}
	}
	
	public function guardar()
	{
		if(!isset($this->id))
		{
			if(!empty($this->errores))
			{
				return false;
			}
			
			if(strlen($this->titulo) > 255)
			{
				$this->errores[] = "El titulo posee mas de 255 caracteres.";
				return false;
			}
			
			$nueva_ruta = RAIZ_DIR . SD . "public" . SD . $this->fotos_dir . SD . $this->archivo;
			
			if(empty($this->nombre_tmp))
			{
				$this->errores[] = "No se tienen los datos suficientes.";
				return false;
			}
			if(file_exists($nueva_ruta))
			{
				$this->errores[] = "No se puede utilizar ese nombre de archivo.";
				return false;
			}
			
			if(move_uploaded_file($this->nombre_tmp, $nueva_ruta))
			{
				if($this->crear())
				{
					return true;
				}
				else
				{
					return false;
					$this->errores[] = "No se ha podido crear el registro en la base de datos.";
				}
			}
			else
			{
				$this->errores[] = "No se ha podido mover el archivo subido a una ubicacion segura.";
				return false;
			}			
		}
		else
		{
			$this->actualizar();
		}
	}
	
	public function suprimir()
	{
		if($this->eliminar())
		{
			$ruta_archivo = RAIZ_DIR . SD . "public" . SD . $this->fotos_dir . SD . $this->archivo;
			return unlink($ruta_archivo);
		}
		else
		{
			return false;
		}
	}
	
	public function comentarios()
	{
		return Comentario::comentarios_por_foto($this->id);
	}
}
?>