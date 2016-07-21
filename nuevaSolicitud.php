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
$id_empresa = $_REQUEST['idEmpresa'];
$id_Solicitud = $_REQUEST['idSolicitud'];
$regreso = $_REQUEST['regreso'];
$dia = date("d");
$mes = date("m");
$anio = date("Y");

include_once "conexionBaseDatos.php";

	$sqlSolicitud = pg_query("SELECT * FROM solicitud WHERE empresa_solicitud = $id_empresa AND id_solicitud = $id_Solicitud");
	$rowSolicitud = pg_fetch_array($sqlSolicitud);
	
		$tipoTrabajo = $rowSolicitud['tipo_trabajo_solicitud'];
		$perfilSolicitado = $rowSolicitud['perfil'];
		$areaEmpresa = $rowSolicitud['area_empresa'];
		$cantHoras = $rowSolicitud['cant_horas_diarias'];
		$cargaHoraria = $rowSolicitud['carga_horaria_semanal'];
		$edad = $rowSolicitud['edad_solicitante'];
		$estimulo = $rowSolicitud['estimulo'];
		$duracionPasantia = $rowSolicitud['duracion_pasantia'];
		$cantPasantes = $rowSolicitud['cant_pasantes'];
		$fecha = $rowSolicitud['fecha'];
		
		$sep = '-';
		$mostrar = explode($sep,$fecha);
			$dia1 = $mostrar[0];
			$mes1 = $mostrar[1];
			$anio1 = $mostrar[2];
		


?>
<form class="empresa" id="formulario" action="solicitudDatosExtras.php?control=0&idSolicitud=<?php echo $id_Solicitud;?>&idEmpresa=<?php echo $id_empresa; ?>" method="post">
<fieldset>
<legend><FONT face="Cambria" size="4" color="#6E6E6E">Solicita</FONT></legend>
	<table>
		<tr>
			<td>
				<label for="cFecha">Fecha: </label>
				<?php
				if ($regreso == 1){
					echo '<input id="cDia" name="dia" type="text"  value="'.$dia1.'" placeholder="dd" class="minimo" maxlength="2" size="2"/>';
					echo '<input id="cMes" name="mes" type="text"  value="'.$mes1.'" placeholder="mm" class="minimo" maxlength="2" size="2"/>';
					echo '<input id="cAnio" name="anio" type="text" value="'.$anio1.'" placeholder="aaaa" class="anio" maxlength="4" size="4"/>';
				}else{
					echo '<input id="cDia" name="dia" type="text"  value="'.$dia.'" placeholder="dd" class="minimo" maxlength="2" size="2"/>';
					echo '<input id="cMes" name="mes" type="text"  value="'.$mes.'" placeholder="mm" class="minimo" maxlength="2" size="2"/>';
					echo '<input id="cAnio" name="anio" type="text" value="'.$anio.'" placeholder="aaaa" class="anio" maxlength="4" size="4"/>';
				}
			
				?>
				
			</td>
		</tr>
		<tr>
			<td>
				<label for="cPerfil">Perfil Solicitado: </label>
				<input id="cPerfil" name="perfilSolicitado" type="text" value="<?php echo $perfilSolicitado; ?>" class="required" size="22"/>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cTipo">Tipo de Trabajo: </label>
				<select id="cTipo" name="tipoTrabajo" size="1">
				<?php
					include_once "conexionBaseDatos.php";
					$consultaTipo=pg_query("select * FROM tipo_trabajo");
					while($rowTipo=pg_fetch_array($consultaTipo)){
						$id = $rowTipo['id_tipo_trabajo'];
						if($id == $tipoTrabajo){
							$id = '"'.$id.'"';
							echo "<option value=".$id." selected>".$rowTipo['nombre_tipo_trabajo']."</option>";
						}else{
							$id = '"'.$id.'"';
							echo "<option value=".$id.">".$rowTipo['nombre_tipo_trabajo']."</option>";
						}
					}
				?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cArea">Area de la Empresa: </label>
				<input id="cArea" name="areaEmpresa" type="text" value="<?php echo $areaEmpresa; ?>" class="required" size="22"/>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cCantHoras">Cantidad de Horas Diarias: </label>
				<input id="cCantHoras" name="cantHoras" type="text" value="<?php echo $cantHoras; ?>" size="22" class="required"/>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cCargaHoraria">Carga Horaria Semanal: </label>
				<input id="cCargaHoraria" name="cargaHoraria" type="text" value="<?php echo $cargaHoraria; ?>" class="required" size="22"/>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cEdad">Edad: </label>
				<input id="cEdad" name="edad" type="text" value="<?php echo $edad; ?>" size="22" class="required"/>
			</td>
		</tr>
	</table>
</fieldset>
<fieldset>
<legend><FONT face="Cambria" size="4" color="#6E6E6E">Ofrece</FONT></legend>
	<table>
		<tr>
			<td>
				<label for="cEstimulo">Est&iacute;mulo: </label>
				<input id="cEstimulo" name="estimulo" type="text" value="<?php echo $estimulo; ?>" class="required" size="22"/>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cDuracion">Duraci&oacute;n de la Pasant&iacute;a: </label>
				<input id="cDuracion" name="duracionPasantia" type="text" value="<?php echo $duracionPasantia; ?>" class="required" size="22"/>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cCantPasantes">Cantidad de Pasantes: </label>
				<input id="cCantPasantes" name="cantPasantes" type="text" value="<?php echo $cantPasantes; ?>" size="22" class="required"/>
			</td>
		</tr>
	</table>
</fieldset>
		<br>
		<p>
			<input class="submit" type="submit" value="Siguiente"/>
			<?php echo '<a href="opcionEmpresa.php?idEmpresa='.$id_empresa.'"><input type="button" value="Atr&aacute;s"/></a>';?>
		</p>
</form>
</body>
</html>