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
			l1 {font-family: Cambria;color: #424242;}
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
include_once "conexionBaseDatos.php";
$id_empresa = $_REQUEST['idEmpresa'];
	$perfil = pg_query("SELECT * FROM empresa WHERE $id_empresa = id_empresa");
	$row=pg_fetch_array($perfil,NULL,PGSQL_ASSOC);
	
	$fecha = date('d').'-'.date('m').'-'.date('Y');
	$razonSocial = $row['razon_social'];
	$cuit = $row['cuit'];
	$direccion = $row['direccion_empresa'];
	$localidad = $row['localidad_empresa'];
	$cp = $row['cp'];
	$telefono = $row['telefono_empresa'];
	$fax = $row['fax'];
	$mail = $row['mail_empresa'];
	$nombreEncargado = $row['nombre_encargado'];
	$puesto = $row['puesto_encargado'];
	$tipo_dni = $row['tipo_dni_encargado'];
	$num_dni = $row['num_dni_encargado'];
	$celularSolicitante = $row['celular_encargado'];
	$telFijoSolicitante = $row['telefono_encargado'];
	$fechaEntrevista = $row['dia_entrevista'];
	$horaEntrevista = $row['hora_entrevista'];
	$tutor = $row['tutor_empresa'];
	$usuario = $row['usuario_empresa'];
	$password = $row['password_empresa'];
	
?>
<form class="empresa" id="formulario" action="guardarModificarEmpresa.php" method="post">
<input name="idEmpresa" type="hidden"  value="<?php echo $id_empresa; ?>"/>
<fieldset>
<legend><FONT face="Cambria" size="4" color="#6E6E6E">Datos Empresa</FONT></legend>
	<table>
		<tr>
			<td>
				<label for="cFechaM">Fecha: </label>
					<input id="cFechaM" name="fecha" type="text"  value="<?php echo $fecha; ?>" maxlength="10" size="22"/>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cRazon">Raz&oacute;n Social: </label>
				<input id="cRazon" name="razonSocial" type="text" value="<?php echo $razonSocial; ?>" class="required" size="22"/>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cCUIT">N&deg; de CUIT: </label>
				<input id="cCUIT" name="cuit" type="text" value="<?php echo $cuit; ?>" class="required" maxlength="13" size="22"/>
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
				<input id="cTelefono" name="telefono" type="text" value="<?php echo $telefono; ?>" size="22"/>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cFax">Fax: </label>
				<input id="cFax" name="fax" type="text" value="<?php echo $fax; ?>" size="22"/>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cMail">Mail: </label>
				<input id="cMail" name="mail" type="text" value="<?php echo $mail; ?>" size="22" class="email"/>
			</td>
		</tr>
	</table>
</fieldset>
<fieldset>
<legend><FONT face="Cambria" size="4" color="#6E6E6E">Datos Solicitante</FONT></legend>
	<table>
		<tr>
			<td>
				<label for="cname">Apellido y Nombre: </label>
				<input id="cname" name="nombre_apellido" type="text" value="<?php echo $nombreEncargado; ?>"  class="required" size="22"/>
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
					$consulta=pg_query("SELECT * FROM tipo_dni");
					while($rowTipo=pg_fetch_array($consulta,NULL,PGSQL_ASSOC)){
                                $id = $rowTipo['id_tipo_dni'];
								if($id == $tipo_dni){
									$id = '"'.$id.'"';
									echo "<option value=".$id." selected>".$rowTipo['nombre_tipo_dni']."</option>"; 
								}else{
									$id = '"'.$id.'"';
									echo "<option value=".$id.">".$rowTipo['nombre_tipo_dni']."</option>"; 
								}
                            }
				?>
			</select>
			<input id="cNumDni" name="numDNI" type="text" value="<?php echo $num_dni; ?>" maxlength="8" class="required dni" size="12"/>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cCelular">Celular: </label>
				<input id="cCelular" name="celularSolicitante" type="text" value="<?php echo $celularSolicitante; ?>" size="22" maxlength="11"/>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cTelefono">Telefono Fijo: </label>
				<input id="cTelefono" name="telFijoSolicitante" type="text" value="<?php echo $telFijoSolicitante; ?>" size="22" maxlength="13"/>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cFecha">Fecha Entrevista: </label>
				<input id="cFecha" name="fechaEntrevista" type="text"  value="<?php echo $fechaEntrevista; ?>" maxlength="10" size="22"/>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cHora">Hora Entrevista: </label>
				<input id="cHora" name="horaEntrevista" type="text" size="22" value="<?php echo $horaEntrevista; ?>" />
			</td>
		</tr>
		<tr>
			<td>
				<label for="cTutor">Tutor por la Empresa: </label>
				<input id="cTutor" name="tutor" type="text" size="22" value="<?php echo $tutor; ?>"/>
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
				<l1><?php echo $usuario; ?></l1>
				<input name="usuario" type="hidden"  value="<?php echo $usuario; ?>"/>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cPassword">Contrase&ntilde;a: </label>
				<l1><?php echo $password; ?></l1>
				<input name="password" type="hidden"  value="<?php echo $password; ?>"/>
			</td>
		</tr>
	</table>
</fieldset>
		<br>
		<p>
			<input class="submit" type="submit" value="Modificar"/>
			<a href="opcionEmpresa.php?idEmpresa=<?php echo $id_empresa; ?>"><input type="button" value="Atr&aacute;s"></a>
		</p>
</form>
</body>
</html>