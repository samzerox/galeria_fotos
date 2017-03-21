<?php
require_once("../../includes/initialize.php");
if($sesion->esta_logueado())
{
	redireccionar_a("index.php");
}
elseif(isset($_POST["submit"]))
  {
	  $username = $_POST["username"];
	  $password = $_POST["password"];
	  
	  $usuario = Usuario::autenticar($username,$password);
	  
	  if($usuario)
	  {
		  $sesion->loguearse($usuario);
		  grabar_acciones("Logueo", "el usuario ". $usuario->nombre_completo()." con la id ". $usuario->id. " se ha logueado.");
		  redireccionar_a("index.php");
	  }
	  else
	  {
		  $mensaje = "Usuario/clave no coinciden.";
	  }
  }
?>
<?php incluir_plantillas("admin_header.php"); ?>
<div id="cuerpo"><h2>Login</h2>
<p><?php echo isset($mensaje)? $mensaje : "" ;?></p>
<form id="form1" name="form1" method="post" action="login.php">
	<table>
    	<tr>
        	<td>Nombre de Usuario</td>
            <td><label>
            	<input type="text" name="username" id="username"/>
            </label></td>
        </tr>
        <tr>
        	<td>Contraseña</td>
            <td><label>
            	<input type="password" name="password" id="password"/>
            </label></td>
        </tr>
    </table>
    <label>
    	<input type="submit" name="submit" id="submit" value="Ingresar" />
    </label>
</form>
<p>&nbsp;</p>
</div>
<?php incluir_plantillas("admin_footer.php"); ?>