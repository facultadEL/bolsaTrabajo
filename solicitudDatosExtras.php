<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<script src="jquery-latest.js"></script>
	<script type="text/javascript" src="jquery.validate.js"></script>
	<title>Registro de Pasante</title>
	<style type="text/css">
		{font-family: Cambria }
			#contenedor {padding: 20px; border: 1px Solid #D8D8D8;background: #F2F2F2;}
			label {width: 13em;color: #336699; float: left; font-family: Cambria; padding-left: .5em;}
			label.error {font-family: Cambria; float: none; vertical-align: top; color: red; padding-left: .5em;}
			l1 {font-family: Cambria;color: #424242; text-transform: capitalize;}
			l3 {font-family: Cambria;color: #424242; text-transform: capitalize; width: 13em;}
			l4 {font-family: Cambria;color: #424242; text-transform: capitalize;}
			l2 {font-family: Cambria;color: #424242;}
    </style>
	<script>
		$(document).ready(function(){

		$.validator.addClassRules("rango", {range:[0,6]});
		$.validator.addClassRules("minimo", {minlength: 2});
		$.validator.addClassRules("dni", {minlength: 6});
		$.validator.addClassRules("cuit", {minlength: 8});
		$.validator.addClassRules("anio", {minlength: 4});
		$.validator.addClassRules("caracteristica", {minlength: 3});

		$("#datosExtras").validate();

		});
	</script>
<?php
	include_once "conexionBaseDatos.php";
	$control = $_REQUEST['control'];
	$esp = '&nbsp;&nbsp;';
	
	if($control == 0){
		
		$id_Solicitud = $_REQUEST['idSolicitud'];
		
		if ($id_Solicitud == NULL){
		
				$dia = $_REQUEST['dia'];
				$mes = $_REQUEST['mes'];
				$anio = $_REQUEST['anio'];
				$fecha = $dia.'-'.$mes.'-'.$anio;
				$perfilSolicitado = $_REQUEST['perfilSolicitado'];
				$tipoTrabajo = $_REQUEST['tipoTrabajo'];
				$areaEmpresa = $_REQUEST['areaEmpresa'];
				$cantHoras = $_REQUEST['cantHoras'];
				$cargaHoraria = $_REQUEST['cargaHoraria'];
				$edad = $_REQUEST['edad'];
				$estimulo = $_REQUEST['estimulo'];
				$duracionPasantia = $_REQUEST['duracionPasantia'];
				$cantPasantes = $_REQUEST['cantPasantes'];
				$id_empresa = $_REQUEST['idEmpresa'];
				
				
				$consultaMax = pg_query("SELECT max(id_solicitud) FROM solicitud WHERE empresa_solicitud = $id_empresa");
				$rowMax = pg_fetch_array($consultaMax);
				$maximaSolicitud = $rowMax['max'];
				$maximaSolicitud = $maximaSolicitud + 1;
				$id_Solicitud = $maximaSolicitud;
				
				
				$sqlNuevaSolicitud = "INSERT INTO solicitud(id_solicitud,empresa_solicitud,tipo_trabajo_solicitud,perfil,area_empresa,cant_horas_diarias,carga_horaria_semanal,edad_solicitante,estimulo,duracion_pasantia,cant_pasantes,fecha) VALUES ('$id_Solicitud','$id_empresa','$tipoTrabajo','$perfilSolicitado','$areaEmpresa','$cantHoras','$cargaHoraria','$edad','$estimulo','$duracionPasantia','$cantPasantes','$fecha');";
				
					$error=0;

					if(!pg_query($cnx,$sqlNuevaSolicitud)){
						$errorpg = pg_last_error($cnx);
						$termino = "ROLLBACK";
						$error=1;
					}else{
						$termino = "COMMIT";
					}
					pg_query($termino);
					if($error==1){
						echo '<script language="JavaScript"> 			alert("Los datos no se guardaron correctamente. Pongase en contacto con el administrador");</script>';
						echo $errorpg;
					}
		}else{
		//aca va el update
				$dia = $_REQUEST['dia'];
				$mes = $_REQUEST['mes'];
				$anio = $_REQUEST['anio'];
				$fecha = $dia.'-'.$mes.'-'.$anio;
				$perfilSolicitado = $_REQUEST['perfilSolicitado'];
				$tipoTrabajo = $_REQUEST['tipoTrabajo'];
				$areaEmpresa = $_REQUEST['areaEmpresa'];
				$cantHoras = $_REQUEST['cantHoras'];
				$cargaHoraria = $_REQUEST['cargaHoraria'];
				$edad = $_REQUEST['edad'];
				$estimulo = $_REQUEST['estimulo'];
				$duracionPasantia = $_REQUEST['duracionPasantia'];
				$cantPasantes = $_REQUEST['cantPasantes'];
				$id_empresa = $_REQUEST['idEmpresa'];
				
				$sqlModSolicitud = "UPDATE solicitud SET tipo_trabajo_solicitud='$tipoTrabajo',perfil='$perfilSolicitado',area_empresa='$areaEmpresa',cant_horas_diarias='$cantHoras',carga_horaria_semanal='$cargaHoraria',edad_solicitante='$edad',estimulo='$estimulo',duracion_pasantia='$duracionPasantia',cant_pasantes='$cantPasantes',fecha='$fecha' WHERE id_solicitud = $id_Solicitud AND empresa_solicitud = $id_empresa;";
				
				$error=0;

				if(!pg_query($cnx,$sqlModSolicitud)){
					$errorpg = pg_last_error($cnx);
					$termino = "ROLLBACK";
					$error=1;
				}else{
					$termino = "COMMIT";
				}
				pg_query($termino);
				if($error==1){
					echo '<script language="JavaScript"> 			alert("Los datos de la solicitud no se actualizaron correctamente. Pongase en contacto con el administrador");</script>';
					echo $errorpg;
				}
		
			}
		
		}else{
	
		$id_empresa = $_REQUEST['idEmpresa'];
		
		$consultaMax = pg_query("SELECT max(id_solicitud) FROM solicitud WHERE empresa_solicitud = $id_empresa");
		$rowMax = pg_fetch_array($consultaMax);
		$id_Solicitud = $rowMax['max'];
		
		$sqlSolicitud = pg_query("SELECT * FROM solicitud WHERE id_solicitud = $id_Solicitud");
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
		
		
		

		if($control == 1){
		
			$id_empresa = $_REQUEST['idEmpresa'];
			$id_Solicitud = $_REQUEST['idSolicitud'];
		
			$tareasDesempeniar = $_REQUEST['tareas'];
			$sqlTareasDesempeniar = "";
			
		
			$consultaMax = pg_query("SELECT max(id_tareas_a_desempeniar) FROM tareas_a_desempeniar");
			$rowMax = pg_fetch_array($consultaMax);
			$maximaTareaD = $rowMax['max'];
			$maxTareaDesempeniar = $maximaTareaD+1;	
		
			$sqlTareasDesempeniar = "INSERT INTO tareas_a_desempeniar(id_tareas_a_desempeniar, nombre_tareas,tareas_desempeniar_fk) VALUES('$maxTareaDesempeniar','$tareasDesempeniar','$id_Solicitud');";
	
			$error=0;

			if(!pg_query($cnx,$sqlTareasDesempeniar)){
				$errorpg = pg_last_error($cnx);
				$termino = "ROLLBACK";
				$error=1;
			}else{
				$termino = "COMMIT";
			}
			pg_query($termino);
			if($error==1){
				echo '<script language="JavaScript"> 			alert("Las tareas a desempeñar no se guardaron correctamente. Pongase en contacto con el administrador");</script>';
				echo $errorpg;
			}	
		}
		
		if($control == 2){
			$id_empresa = $_REQUEST['idEmpresa'];
			$id_Solicitud = $_REQUEST['idSolicitud'];
		
			$experiencia = $_REQUEST['experiencia'];
			$sqlExperiencia = "";
		
			$consultaMax = pg_query("SELECT max(id_experiencia) FROM experiencia");
			$rowMax = pg_fetch_array($consultaMax);
			$maximaExperiencia = $rowMax['max'];
			$maxExperiencia = $maximaExperiencia+1;	
		
			$sqlExperiencia = "INSERT INTO experiencia(id_experiencia, nombre_experiencia,experiencia_fk) VALUES('$maxExperiencia','$experiencia','$id_Solicitud');";
	
			$error=0;

			if(!pg_query($cnx,$sqlExperiencia)){
				$errorpg = pg_last_error($cnx);
				$termino = "ROLLBACK";
				$error=1;
			}else{
				$termino = "COMMIT";
			}
			pg_query($termino);
			if($error==1){
				echo '<script language="JavaScript"> 			alert("Las experiencias no se guardaron correctamente. Pongase en contacto con el administrador");</script>';
				echo $errorpg;
			}
		
		}
		if($control == 3){
		
			$id_empresa = $_REQUEST['idEmpresa'];
			$id_Solicitud = $_REQUEST['idSolicitud'];
			
			$otrosConocimientos = $_REQUEST['otrosConocimientos'];
			$sqlOtrosConocimientos = "";
		
			$consultaMax = pg_query("SELECT max(id_otros_conocimientos) FROM otros_conocimientos");
			$rowMax = pg_fetch_array($consultaMax);
			$maximoOtrosConocimientos = $rowMax['max'];
			$maxOtrosConocimientos = $maximoOtrosConocimientos+1;	
		
			$sqlOtrosConocimientos = "INSERT INTO otros_conocimientos(id_otros_conocimientos, nombre_conocimientos, otros_conocimientos_fk) VALUES('$maxOtrosConocimientos','$otrosConocimientos','$id_Solicitud');";
	
			$error=0;

			if(!pg_query($cnx,$sqlOtrosConocimientos)){
				$errorpg = pg_last_error($cnx);
				$termino = "ROLLBACK";
				$error=1;
			}else{
				$termino = "COMMIT";
			}
			pg_query($termino);
			if($error==1){
				echo '<script language="JavaScript"> 			alert("Los conocimientos no se guardaron correctamente. Pongase en contacto con el administrador");</script>';
				echo $errorpg;
			}
		
		
		}
		if($control == 4){
			
			$id_empresa = $_REQUEST['idEmpresa'];
			$id_Solicitud = $_REQUEST['idSolicitud'];
		
			$otrosBeneficios = $_REQUEST['otrosBeneficios'];
			$sqlOtrosBeneficios = "";
		
			$consultaMax = pg_query("SELECT max(id_otros_beneficios) FROM otros_beneficios");
			$rowMax = pg_fetch_array($consultaMax);
			$maximoOtrosBeneficios = $rowMax['max'];
			$maxOtrosBeneficios = $maximoOtrosBeneficios+1;	
		
			$sqlOtrosBeneficios = "INSERT INTO otros_beneficios(id_otros_beneficios, nombre_beneficios,otros_beneficios_fk) VALUES('$maxOtrosBeneficios','$otrosBeneficios','$id_Solicitud');";
	
			$error=0;

			if(!pg_query($cnx,$sqlOtrosBeneficios)){
				$errorpg = pg_last_error($cnx);
				$termino = "ROLLBACK";
				$error=1;
			}else{
				$termino = "COMMIT";
			}
			pg_query($termino);
			if($error==1){
				echo '<script language="JavaScript"> 			alert("Los conocimientos no se guardaron correctamente. Pongase en contacto con el administrador");</script>';
				echo $errorpg;
			}
		
		
		}
	}
	?>
</head>
<body>
<div id="contenedor">
<fieldset>
<legend><FONT face="Cambria" size="4" color="#6E6E6E">Solicita</FONT></legend>
<table>
		<tr>
			<td>
				<label for="cFecha">Fecha: </label>
				<l1><?php echo $fecha; ?></l1>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cPerfil">Perfil Solicitado: </label>
				<l1><?php echo $perfilSolicitado; ?></l1>
			</td>
		</tr>
</table>
<form  id="datosExtras" action="?control=1" method="post">
	<table>
		<tr>
			<td>
				<?php
					echo '<input type="hidden" name="idEmpresa" value="'.$id_empresa.'" />';
					echo '<input type="hidden" name="idSolicitud" value="'.$id_Solicitud.'" />';
				?>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cTareas">Tareas a Desempe&ntilde;ar: </label>
					<input id="cTareas" name="tareas" type="text" size="22" value="" class="required"/>
					<input type="submit" value="Cargar"/>
			<br>
				<ul type = disk >
					<?php
				
						$tareasDesempeniar = pg_query("SELECT * FROM tareas_a_desempeniar WHERE tareas_desempeniar_fk = $id_Solicitud");
						while($rowTD=pg_fetch_array($tareasDesempeniar,NULL,PGSQL_ASSOC)){				
							echo '<l3>';
							echo '<li>'.$rowTD['nombre_tareas'].$esp.'<a href="eliminarDatosExtrasSolicitud.php?eliminar=1&idSolicitud='.$id_Solicitud.'&idEmpresa='.$id_empresa.'&idEliminarTD='.$rowTD['id_tareas_a_desempeniar'].'"><img src="eliminar.png" width="16" height="16" name="Eliminar" value="Eliminar"/></a><br>';
							echo '</l3>';
							}
					?>
				</ul>
			</td>
		</tr>
	</table>
</form>
<table>
		<tr>
			<td>
				<label for="cTipo">Tipo de Trabajo: </label>
				<l1><?php
					include_once "conexionBaseDatos.php";
					$consulta=pg_query("SELECT * FROM tipo_trabajo");
					while($rowTipo=pg_fetch_array($consulta,NULL,PGSQL_ASSOC)){
                                $tipo = $rowTipo['id_tipo_trabajo'];
								if($tipo == $tipoTrabajo){
									echo $rowTipo['nombre_tipo_trabajo']; 
								}
                            }
				?></l1>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cArea">Area de la Empresa: </label>
				<l1><?php echo $areaEmpresa; ?></l1>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cCantHoras">Cantidad de Horas Diarias: </label>
				<l1><?php echo $cantHoras; ?></l1>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cCargaHoraria">Carga Horaria Semanal: </label>
				<l1><?php echo $cargaHoraria; ?></l1>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cEdad">Edad: </label>
				<l1><?php echo $edad; ?></l1>
			</td>
		</tr>
	</table>
<form  id="datosExtras" action="?control=2" method="post">
	<table>
		<tr>
			<td>
				<?php
					echo '<input type="hidden" name="idEmpresa" value="'.$id_empresa.'" />';
					echo '<input type="hidden" name="idSolicitud" value="'.$id_Solicitud.'" />';
				?>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cExperiencia">Experiencia: </label>
				<input id="cExperiencia" name="experiencia" type="text" size="22" value="" class="required"/>
				<input type="submit" value="Cargar"/>
			<br>
				<ul type = disk >
					<?php	
						$experiencia = pg_query("SELECT * FROM experiencia WHERE experiencia_fk = $id_Solicitud");
						while($rowE=pg_fetch_array($experiencia,NULL,PGSQL_ASSOC)){				
							echo '<l3>';
							echo '<li>'.$rowE['nombre_experiencia'].$esp.'<a href="eliminarDatosExtrasSolicitud.php?eliminar=2&idSolicitud='.$id_Solicitud.'&idEmpresa='.$id_empresa.'&idEliminarE='.$rowE['id_experiencia'].'"><img src="eliminar.png" width="16" height="16" name="Eliminar" value="Eliminar"/></a><br>';
							echo '</l3>';
							}
					?>
				</ul>
			</td>
		</tr>
	</table>
</form>
<form  id="datosExtras" action="?control=3" method="post">
	<table>
		<tr>
			<td>
				<?php
					echo '<input type="hidden" name="idEmpresa" value="'.$id_empresa.'" />';
					echo '<input type="hidden" name="idSolicitud" value="'.$id_Solicitud.'" />';
				?>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cOtrosConocimientos">Otros Conocimientos: </label>
				<input id="cOtrosConocimientos" name="otrosConocimientos" type="text" size="22" value="" class="required"/>
				<input type="submit" value="Cargar"/>
			<br>
				<ul type = disk >
					<?php	
						$otrosConocimientos = pg_query("SELECT * FROM otros_conocimientos WHERE otros_conocimientos_fk = $id_Solicitud");
						while($rowOC=pg_fetch_array($otrosConocimientos,NULL,PGSQL_ASSOC)){				
							echo '<l3>';
							echo '<li>'.$rowOC['nombre_conocimientos'].$esp.'<a href="eliminarDatosExtrasSolicitud.php?eliminar=3&idSolicitud='.$id_Solicitud.'&idEmpresa='.$id_empresa.'&idEliminarOC='.$rowOC['id_otros_conocimientos'].'"><img src="eliminar.png" width="16" height="16" name="Eliminar" value="Eliminar"/></a><br>';
							echo '</l3>';
							}
					?>
				</ul>
			</td>
		</tr>
	</table>
</form>
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
	</table>
	<form  id="datosExtras" action="?control=4" method="post">
	<table>
		<tr>
			<td>
				<?php
					echo '<input type="hidden" name="idEmpresa" value="'.$id_empresa.'" />';
					echo '<input type="hidden" name="idSolicitud" value="'.$id_Solicitud.'" />';
				?>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cOtrosBeneficios">Otros Beneficios: </label>
				<input id="cOtrosBeneficios" name="otrosBeneficios" type="text" size="22" value="" class="required"/>
				<input type="submit" value="Cargar"/>
			<br>
				<ul type = disk >
					<?php	
						$otrosBeneficios = pg_query("SELECT * FROM otros_beneficios WHERE otros_beneficios_fk = $id_Solicitud");
						while($rowOB=pg_fetch_array($otrosBeneficios,NULL,PGSQL_ASSOC)){
							echo '<l3>';
							echo '<li>'.$rowOB['nombre_beneficios'].$esp.'<a href="eliminarDatosExtrasSolicitud.php?eliminar=4&idSolicitud='.$id_Solicitud.'&idEmpresa='.$id_empresa.'&idEliminarOB='.$rowOB['id_otros_beneficios'].'"><img src="eliminar.png" width="16" height="16" name="Eliminar" value="Eliminar"/></a><br>';
							echo '</l3>';
							}
					?>
				</ul>
			</td>
		</tr>
	</table>
</form>
	<table>
		<tr>
			<td>
				<label for="cDuracion">Duraci&oacute;n de la Pasant&iacute;a: </label>
				<l1><?php echo $duracionPasantia; ?></l1>
			</td>
		</tr>
		<tr>
			<td>
				<label for="cCantPasantes">Cantidad de Pasantes: </label>
				<l1><?php echo $cantPasantes; ?></l1>
			</td>
		</tr>
	</table>

</fieldset>
	<br>
	<p>
	<a href="nuevaSolicitud.php?regreso=1&idSolicitud=<?php echo $id_Solicitud;?>&idEmpresa=<?php echo $id_empresa;?>"><input type="button" name="volver" value="Volver"/></a>
	<a href="listadoSolicitudes.php?idSolicitud=<?php echo $id_Solicitud;?>&idEmpresa=<?php echo $id_empresa;?>"><input type="button" name="registrar" value="Guardar"/></a>
	</p>
</div>
</body>
</html>