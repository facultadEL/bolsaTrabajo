<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<script src="jquery-latest.js"></script>
	<script type="text/javascript" src="jquery.validate.js"></script>
	<title>Perfil Alumno</title>
	<style type="text/css">
		{font-family: Cambria }
			#contenedor {padding: 20px; border: 1px Solid #D8D8D8;background: #F2F2F2;}
			#tabla {}
			label {width: 13em;color: #336699; float: left; font-family: Cambria; padding-left: .5em;}
			label.error {font-family: Cambria; float: none; vertical-align: top; color: red; padding-left: .5em;}
			l1 {font-family: Cambria;color: #424242; text-transform: capitalize;}
			l3 {font-family: Cambria;color: #424242; text-transform: capitalize; width: 13em;}
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
$sep = '/-/';
$pasar = $_REQUEST['idPasar'];
$mostrar = explode($sep,$pasar);
	$id_Solicitud = $mostrar[0];
	$id_empresa = $mostrar[1];
	
	$verSolicitud = pg_query("SELECT * FROM solicitud WHERE $id_Solicitud = id_solicitud ");
	$row=pg_fetch_array($verSolicitud,NULL,PGSQL_ASSOC);
		
		$fecha = $row['fecha'];
		$tipo_trabajo = $row['tipo_trabajo_solicitud'];
		$perfil = $row['perfil'];
		$area_empresa = $row['area_empresa'];
		$cant_horas = $row['cant_horas_diarias'];
		$carga_horaria = $row['carga_horaria_semanal'];
		$celular = $row['celular_alumno'];
		$edad = $row['edad_solicitante'];
		$estimulo = $row['estimulo'];
		$duracion_pasantia = $row['duracion_pasantia'];
		$cant_pasantes = $row['cant_pasantes'];
		$esp = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#8226; ';
		
		$pasar1 = $id_Solicitud.$sep.$id_empresa;
			
?>
<div id="contenedor">
<fieldset>
<legend><FONT face="Cambria" size="4" color="#6E6E6E">Solicita</FONT></legend>
	<table id="tabla">	
		<tr>
			<td>
				<label for="cFecha">Fecha: </label>
				<l1><?php echo $fecha; ?></l1>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cPerfil">Perfil Solicitado: </label>
				<l1><?php echo $perfil; ?></l1>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cTipo">Tipo de Trabajo: </label>
				<l1><?php
					include_once "conexionBaseDatos.php";
					$consulta=pg_query("SELECT * FROM tipo_trabajo");
					while($rowTipo=pg_fetch_array($consulta,NULL,PGSQL_ASSOC)){
                                $id = $rowTipo['id_tipo_trabajo'];
								if($id == $tipo_trabajo){
									echo $rowTipo['nombre_tipo_trabajo']; 
								}
                            }
				?></l1>
			</td>
		</tr>
		<tr >
			<td>
			<label for="cTareas">Tareas a Desempe&ntilde;ar: </label>
			<ul type = disk >
			<?php
				echo '<br>';
				$tareas = pg_query("SELECT * FROM tareas_a_desempeniar WHERE $id_Solicitud = tareas_desempeniar_fk ");
				while($rowTareas=pg_fetch_array($tareas,NULL,PGSQL_ASSOC)){
				$verTareas = $rowTareas['nombre_tareas'];
				echo '<l1>   '.$esp.$verTareas.'</l1>';
				echo '<br>';
				}
			?>
			</ul>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cArea">Area de la Empresa: </label>
				<l1><?php echo $area_empresa; ?></l1>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cCantHoras">Cantidad de Horas Diarias: </label>
				<l1><?php echo $cant_horas; ?></l1>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cCargaHoraria">Carga Horaria Semanal: </label>
				<l1><?php echo $carga_horaria; ?></l1>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cEdad">Edad: </label>
				<l1><?php echo $edad; ?></l1>
			</td>
		</tr>
		<tr >
			<td>
			<label for="cExperiencia">Experiencia: </label>
			<ul type = disk >
			<?php
				echo '<br>';
				$experiencia = pg_query("SELECT * FROM experiencia WHERE $id_Solicitud = experiencia_fk ");
				while($rowExp=pg_fetch_array($experiencia,NULL,PGSQL_ASSOC)){
				$verExp = $rowExp['nombre_experiencia'];
				echo '<l1>   '.$esp.$verExp.'</l1>';
				echo '<br>';
				}
			?>
			</td>
			</ul>
		</tr>
		<tr >
			<td>
			<label for="cExperiencia">Otros Conocimientos: </label>
			<ul type = disk >
			<?php
				echo '<br>';
				$otrosConocimientos = pg_query("SELECT * FROM otros_conocimientos WHERE $id_Solicitud = otros_conocimientos_fk ");
				while($rowOC=pg_fetch_array($otrosConocimientos,NULL,PGSQL_ASSOC)){
				$verOC = $rowOC['nombre_conocimientos'];
				echo '<l1>   '.$esp.$verOC.'</l1>';
				echo '<br>';
				}
			?>
			</td>
			</ul>
		</tr>
	</table>
</fieldset>
<fieldset>
<legend><FONT face="Cambria" size="4" color="#6E6E6E">Ofrece</FONT></legend>
	<table>
		<tr>
			<td>
				<label for="cEstimulo">Est&iacute;mulo: </label>
				<l1><?php echo $estimulo; ?></l1>
			</td>
		</tr>
		<tr >
			<td>
			<label for="cBeneficios">Otros Beneficios: </label>
			<ul type = disk >
			<?php
				echo '<br>';
				$otrosBeneficios = pg_query("SELECT * FROM otros_beneficios WHERE $id_Solicitud = otros_beneficios_fk ");
				while($rowOB=pg_fetch_array($otrosBeneficios,NULL,PGSQL_ASSOC)){
				$verOB = $rowOB['nombre_beneficios'];
				echo '<l1>   '.$esp.$verOB.'</l1>';
				echo '<br>';
				}
			?>
			</td>
			</ul>
		</tr>
		<tr>
			<td>
				<label for="cDuracion">Duraci&oacute;n de la Pasant&iacute;a: </label>
				<l1><?php echo $duracion_pasantia; ?></l1>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cCantPasantes">Cantidad de Pasantes: </label>
				<l1><?php echo $cant_pasantes; ?></l1>
			</td>
		</tr>
	</table>
</fieldset>
		<br>
		<p>
			<a href="nuevaSolicitud.php?regreso=1&idSolicitud=<?php echo $id_Solicitud;?>&idEmpresa=<?php echo $id_empresa;?>"><input type="button" value="Modificar"/></a>
			<a href="listadoSolicitudes.php?idPasar=<?php echo $pasar1; ?>"><input type="button" value="Atr&aacute;s"></a>
		</p>
</body>
</html>