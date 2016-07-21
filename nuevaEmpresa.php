<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<script src="jquery-latest.js"></script>
	<script type="text/javascript" src="jquery.validate.js"></script>
	<title>Registro de Empresa</title>
	<style type="text/css">
		{font-family: Cambria }
			form {padding: 20px; border: 1px Solid #D8D8D8;background: #F2F2F2;}
			label {width: 10em;color: #336699; float: left; font-family: Cambria; padding-left: .5em;}
			label.error {font-family: Cambria; float: none; vertical-align: top; color: red; padding-left: .5em;}
    </style>
	<script>
		$(document).ready(function(){
			
		$.validator.addClassRules("rango", {range:[0,6]});
		$.validator.addClassRules("minimo", {minlength: 2});
		$.validator.addClassRules("uno", {minlength: 1});
		$.validator.addClassRules("dni", {minlength: 6});
		$.validator.addClassRules("cuit", {minlength: 8});
		$.validator.addClassRules("anio", {minlength: 4});
		$.validator.addClassRules("caracteristica", {minlength: 3});

		$("#formulario").validate();
			
		});
	</script>
</head>

<body>
<?php

$usado = $_REQUEST['usado'];
$datos = $_REQUEST['pasarDatos'];

$s = '/-/';
if($usado==1){
$vDatos = explode($s,$datos);
$razonSocial = $vDatos[1];
$cuit1 = $vDatos[2];
$cuit2 = $vDatos[3];
$cuit3 = $vDatos[4];
$direccion = $vDatos[5];
$localidad = $vDatos[6];
$cp = $vDatos[7];
$caracteristicaTel = $vDatos[8];
$tel = $vDatos[9];
$caracteristicaFax = $vDatos[10];
$numFax = $vDatos[11];
$mail = $vDatos[12];
$nombre = $vDatos[13];
$apellido = $vDatos[14];
$puesto = $vDatos[15];
$tipo_dni = $vDatos[16];
$num_dni = $vDatos[17];
$caracteristicaCelSolicitante = $vDatos[18];
$numCelSolicitante = $vDatos[19];
$caracteristicaTelSolicitante = $vDatos[20];
$numTelSolicitante = $vDatos[21];
$diaEntrevista = $vDatos[22];
$mesEntrevista = $vDatos[23];
$anioEntrevista = $vDatos[24];
$hora = $vDatos[25];
$min = $vDatos[26];
$tutor = $vDatos[27];
}else{
$razonSocial = "";
$cuit1 = "";
$cuit2 = "";
$cuit3 = "";
$direccion = "";
$localidad = "";
$cp = "";
$caracteristicaTel = "";
$tel = "";
$caracteristicaFax = "";
$numFax = "";
$mail = "";
$nombre = "";
$apellido = "";
$puesto = "";
$tipo_dni = "";
$num_dni = "";
$caracteristicaCelSolicitante = "";
$numCelSolicitante = "";
$caracteristicaTelSolicitante = "";
$numTelSolicitante = "";
$diaEntrevista = "";
$mesEntrevista = "";
$anioEntrevista = "";
$hora = "";
$min = "";
$tutor = "";
}
?>
<form class="empresa" id="formulario" action="guardarEmpresa.php" method="post">
<fieldset>
<legend><FONT face="Cambria" size="4" color="#6E6E6E">Datos Empresa</FONT></legend>
	<table>	
		<tr>
			<td>
				<label for="cRazon">Raz&oacute;n Social: </label>
				<input id="cRazon" name="razonSocial" type="text" value="<?php echo $razonSocial;?>" class="required" size="22"/>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cCUIT">N&deg; de CUIT: </label>
				<input id="cCUIT" name="cuit1" type="text" value="<?php echo $cuit1; ?>" class="required minimo" maxlength="2" size="2"/>
				<input id="cCUIT" name="cuit2" type="text" value="<?php echo $cuit2; ?>" class="required cuit" maxlength="8" size="8"/>
				<input id="cCUIT" name="cuit3" type="text" value="<?php echo $cuit3; ?>" class="required uno" maxlength="1" size="1"/>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cDireccion">Direcci&oacute;n: </label>
				<input id="cDireccion" name="direccion" type="text" value="<?php echo $direccion; ?>" class="required" size="22"/>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cLocalidad">Localidad: </label>
				<input id="cLocalidad" name="localidad" type="text" value="<?php echo $localidad; ?>" size="22"/>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cCP">C.P: </label>
				<input id="cCP" name="cp" type="text" value="<?php echo $cp; ?>" size="10"/>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cTelefono">Telefono: </label>
				<input id="cCaracteristica" name="caracteristicaTel" type="text" value="<?php echo $caracteristicaTel; ?>" size="5" maxlength="5" class="required caracteristica"/>
				<input id="cTelefono" name="telefono" type="text" value="<?php echo $tel; ?>" size="22" class="required dni" maxlength="8"/>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cFax">Fax: </label>
				<input id="cCaracteristicaFax" name="caracteristicaFax" type="text" value="<?php echo $caracteristicaFax; ?>" size="5" />
				<input id="cFax" name="fax" type="text" value="<?php echo $numFax; ?>" size="22"/>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cMail">Mail: </label>
				<input id="cMail" name="mail" type="text" value="<?php echo $mail; ?>" size="22" class="required email"/>
			</td>
		</tr>
	</table>
</fieldset>
<fieldset>
<legend><FONT face="Cambria" size="4" color="#6E6E6E">Datos Solicitante</FONT></legend>
	<table>
		<tr>
			<td>
				<label for="cname">Nombre: </label>
				<input id="cNombre"   name="nombre"   type="text" value="<?php echo $nombre; ?>"    class="required" size="22"/>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cApellido">Apellido: </label>
				<input id="cApellido" name="apellido" type="text" value="<?php echo $apellido; ?>"  class="required" size="22"/>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cPuesto">Puesto: </label>
				<input id="cPuesto" name="puesto" type="text" size="22" value="<?php echo $puesto; ?>"/>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cDni">DNI y N&deg;: </label>
				<select id="cDni" name="dni" size="1">
				<?php
					include_once "conexionBaseDatos.php";
					$consultaTipo=pg_query("select * FROM tipo_dni");
					while($rowTipo=pg_fetch_array($consultaTipo)){
						if($tipoDni == $rowTipo['id_tipo_dni']){
							echo '<option value="'.$rowTipo['id_tipo_dni'].'" selected>'.$rowTipo['nombre_tipo_dni'].'</option>';
						}else{
							echo '<option value="'.$rowTipo['id_tipo_dni'].'">'.$rowTipo['nombre_tipo_dni'].'</option>';
						}
					}
				?>
			</select>
			<input id="cNumDni" name="numDNI" type="text" value="<?php echo $num_dni; ?>" maxlength="8" class="required dni" size="13"/>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cCelular">Celular: </label>
				<input id="cCaracteristica" name="caracCelSolicitante" type="text" value="<?php echo $caracteristicaCelSolicitante; ?>" size="5" maxlength="5" class="caracteristica"/>
				<input id="cCelular" name="celularSolicitante" type="text" value="<?php echo $numCelSolicitante; ?>" size="22" class="cuit" maxlength="10"/>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cTelefono">Telefono Fijo: </label>
				<input id="cCaracteristica" name="caracTelSolicitante" type="text" value="<?php echo $caracteristicaTelSolicitante; ?>" size="5" maxlength="5" class="caracteristica"/>
				<input id="cTelefono" name="telfijoSolicitante" type="text" value="<?php echo $numTelSolicitante; ?>" size="22" class="dni" maxlength="8"/>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cFecha">Fecha Entrevista: </label>
				<input id="cDia" name="diaEntrevista" type="text"  value="<?php echo $diaEntrevista; ?>" placeholder="dd" class="minimo" maxlength="2" size="2"/>
				<input id="cMes" name="mesEntrevista" type="text"  value="<?php echo $mesEntrevista; ?>" placeholder="mm" class="minimo" maxlength="2" size="2"/>
				<input id="cAnio" name="anioEntrevista" type="text"  value="<?php echo $anioEntrevista; ?>" placeholder="aaaa" class="anio" maxlength="4" size="4"/>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cHora">Hora Entrevista: </label>
				<input id="cHora" name="hora" type="text" size="1" value="<?php echo $hora; ?>" class="required"/>:
				<input id="cMin" name="min" type="text" size="1" value="<?php echo $min; ?>" class="required"/>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cTutor">Tutor por la Empresa: </label>
				<input id="cTutor" name="tutor" type="text" size="22" value="<?php echo $tutor; ?>" class="required"/>
			</td>
		</tr>
	</table>
</fieldset>
<fieldset>
<legend><FONT face="Cambria" size="4" color="#6E6E6E">Datos Login</FONT></legend>
	<table>
		<tr>
			<td>
				<label for="cUsuario">Usuario: </label>
				<input id="cUsuario" name="usuario" type="text" value="" class="required" size="22"/>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cPassword">Contrase&ntilde;a: </label>
				<input id="cPassword" name="password" type="password" size="22" value="" class="required dni"/>
			</td>
		</tr>
	</table>
</fieldset>
		<br>
		<p>
			<input class="submit" type="submit" value="Guardar"/>
			<a href="login.php"><input type="button" value="Atr&aacute;s"></a>
		</p>
</form>
</body>
</html>