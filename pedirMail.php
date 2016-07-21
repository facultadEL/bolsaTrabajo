<html>
	<head>
		<title> Olvido de Password </title>
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
<?php
$correo = $_REQUEST['correo'];
?>
<form class="login" id="formulario" action="olvidoPassword.php" method="post">
<fieldset>
<legend><FONT face="Cambria" size="4" color="#6E6E6E">Ingrese su Mail</FONT></legend>
			<table>
				<tr>
					<td>
						<label for="cUsuario">Mail: </label>
					</td>
					<td>
						<input id="cUsuario" name="mail" type="text" value="<?php echo $correo; ?>" class="required email" size="22"/>
					</td>
				</tr>
			</table>
			<br>
			<center><input class="submit" type="submit" value="Enviar"/></center>
</form>
</body>
</html>