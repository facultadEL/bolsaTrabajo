<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<script src="jquery-latest.js"></script>
	<script type="text/javascript" src="jquery.validate.js"></script>
	<title>Perfil Empresa</title>
	<style type="text/css">
		{font-family: Cambria }
			form {padding: 20px; border: 1px Solid #D8D8D8;background: #F2F2F2;}
			label {width: 10em;color: #336699; float: left; font-family: Cambria; padding-left: .5em;}
			l1 {font-family: Cambria;color: #424242;text-transform: capitalize;}
			l2 {font-family: Cambria;color: #424242;}
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
	$fecha = $row['fecha'];
?>
<form class="empresa" id="formulario" action="" method="post">
<fieldset>
<legend><FONT face="Cambria" size="4" color="#6E6E6E">Datos Empresa</FONT></legend>
	<table>
		<tr>
			<td>
				<label for="cRazon">Raz&oacute;n Social: </label>
				<l1><?php echo $razonSocial; ?></l1>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cCUIT">N&deg; de CUIT: </label>
				<l1><?php echo $cuit; ?></l1>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cDireccion">Direcci&oacute;n: </label>
				<l1><?php echo $direccion; ?></l1>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cLocalidad">Localidad: </label>
				<l1><?php echo $localidad; ?></l1>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cCP">C.P: </label>
				<l1><?php echo $cp; ?></l1>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cTelefono">Telefono: </label>
				<l1><?php echo $telefono; ?></l1>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cFax">Fax: </label>
				<l1><?php echo $fax; ?></l1>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cMail">Mail: </label>
				<l2><?php echo $mail; ?></l2>
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
				<l1><?php echo $nombreEncargado; ?></l1>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cPuesto">Puesto: </label>
				<l1><?php echo $puesto; ?></l1>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cDni">DNI y N&deg;: </label>
				<l1><?php
					include_once "conexionBaseDatos.php";
					$consulta=pg_query("SELECT * FROM tipo_dni");
					while($rowTipo=pg_fetch_array($consulta,NULL,PGSQL_ASSOC)){
                                $id = $rowTipo['id_tipo_dni'];
								if($id == $tipo_dni){
									echo $rowTipo['nombre_tipo_dni']; 
								}
                            }
				?></l1>
			<l1><?php echo $num_dni; ?></l1>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cCelular">Celular: </label>
				<l1><?php echo $celularSolicitante; ?></l1>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cTelefono">Telefono Fijo: </label>
				<l1><?php echo $telFijoSolicitante; ?></l1>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cFecha">Fecha Entrevista: </label>
				<l1><?php echo $fechaEntrevista; ?></l1>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cHora">Hora Entrevista: </label>
				<l1><?php echo $horaEntrevista; ?></l1>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cTutor">Tutor por la Empresa: </label>
				<l1><?php echo $tutor; ?></l1>
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
				<l2><?php echo $usuario; ?></l2>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cPassword">Contrase&ntilde;a: </label>
				<l2><?php echo $password; ?></l2>
			</td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td>
				<a href="cambiarPasswordEmpresa.php?idEmpresa=<?php echo $id_empresa; ?>">Cambiar contrase&ntilde;a</a>
			</td>
		</tr>
	</table>
</fieldset>
		<br>
		<p>
			<a href="modificarEmpresa.php?idEmpresa=<?php echo $id_empresa; ?>"><input type="button" value="Modificar"></a>
			<a href="opcionEmpresa.php?idEmpresa=<?php echo $id_empresa; ?>"><input type="button" value="Atr&aacute;s"></a>
		</p>
</form>
</body>
</html>