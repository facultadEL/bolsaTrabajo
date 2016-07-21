<html>
	<head>
		<title> Cambiar Password </title>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
		<script src="jquery-latest.js"></script>
		<script type="text/javascript" src="jquery.validate.js"></script>
		<style type="text/css">
		{font-family: Cambria }
			form {padding: 20px; border: 1px Solid #D8D8D8;background: #F2F2F2;}
			label {width: 10em;color: #336699; float: left; font-family: Cambria; padding-left: .5em;}
			label.error {font-family: Cambria; float: none; vertical-align: top; color: red; padding-left: .5em;}
		</style>
		<script>
			$(document).ready(function(){
			
			$.validator.addClassRules("password", {minlength: 6});
			
			$("#commentForm").validate();
			
			});
		</script>
	</head>
	<body>
	<?php
	include_once "conexionBaseDatos.php";
	
	$id_empresa = $_REQUEST['idEmpresa'];
	?>
		<form class="cambioPassword" id="commentForm" action="guardarCambiarPasswordEmpresa.php?idEmpresa=<?php echo $id_empresa; ?>" method="post">
		<fieldset>
		<legend><FONT face="Cambria" size="4" color="#6E6E6E">Cambio de Contrase&ntilde;a</FONT></legend>
		<br>
		<table>
			<tr>
				<td>
					<label for="cpasswordAnt"> Contrase&ntilde;a Actual: </label>
					<input name="passwordAnterior" id="cpasswordAnt" value="" type="password" size="22" class="required"/>
				</td>
			</tr>
			<tr>
				<td>
					<label for="cpasswordNew"> Contrase&ntilde;a Nueva: </label>
					<input name="passwordNuevo" id="cpasswordNew" value="" type="password" size="22" class="required password"/>
				</td>
			</tr>
			<tr>
				<td>
					<label for="cpasswordRepetido"> Repita la Contrase&ntilde;a: </label>
					<input name="passwordRepetido" id="cpasswordRepetido" value="" type="password" size="22" class="required password"/>
				</td>
			</tr>
		</table>
		<br>
			<input class="submit" type="submit" value="Cambiar"/>
			<a href="perfilEmpresa.php?idEmpresa=<?php echo $id_empresa; ?>"><input type="button" value="Atr&aacute;s"></a>
		<br>
		</form>
	</body>
</html>