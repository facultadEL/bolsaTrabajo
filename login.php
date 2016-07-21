<html>
	<head>
		<title> Login </title>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
		<script src="jquery-latest.js"></script>
		<script type="text/javascript" src="jquery.validate.js"></script>
		<style type="text/css">
		{font-family: Cambria }
			form {padding: 2%; margin-left: 30px; margin-right: 30px;margin-top: 100px; border: 1px Solid #D8D8D8;background: #F2F2F2;}
			label {width: 6em; float: left; font-family: Cambria; color: #336699; display: block;}
			l1 {font-family: Cambria; color: #336699;}
			label.error {font-family: Cambria; float: right; color: red; padding-left: 2px;}
		</style>
		<script>
		$(document).ready(function(){
		
		$("#formulario").validate();
			
		});
		</script>
	</head>
	<body>
		<form class="login" id="formulario" action="verificarLogin.php" method="post">
			<table align="center">
				<tr>
					<td>
						<label for="cUsuario">Usuario: </label>
					</td>
					<td>
						<input id="cUsuario" name="usuario" type="text" value="<?php echo $usuario; ?>" class="required" size="22"/>
					</td>
				</tr>
				<tr>
					<td>
						<label for="cPassword">Contrase&ntilde;a: </label>
					</td>
					<td>
						<input id="cPassword" name="password" type="password" value="" class="required" size="22"/>
					</td>
				</tr>
			</table>
			<br>
			<center><input class="submit" type="submit" value="Enviar"/></center>
			<br>
			<center><l1>&iquest;No se encuentra registrado? haga click <a href="opcionRegistro.php">aqu&iacute;</a></l1></center>
			<br>
			<center><l1>&iquest;Olvid&oacute; su contrase&ntilde;a? haga click <a href="pedirMail.php">aqu&iacute;</a></l1></center>
		</form>
	</body>
</html>