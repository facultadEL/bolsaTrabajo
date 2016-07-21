<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<script src="jquery-latest.js"></script>
	<script type="text/javascript" src="jquery.validate.js"></script>
	<title>Perfil Alumno</title>
	<style type="text/css">
		{font-family: Cambria }
			#contenedor {padding: 20px; border: 1px Solid #D8D8D8;background: #F2F2F2;}
			label {width: 13em;color: #336699; float: left; font-family: Cambria; padding-left: .5em;}
			label.error {font-family: Cambria; float: none; vertical-align: top; color: red; padding-left: .5em;}
			l1 {font-family: Cambria;color: #424242; text-transform: capitalize;}
			l3 {font-family: Cambria;color: #424242; text-transform: capitalize; width: 13em;}
			l2 {font-family: Cambria;color: #424242;}
    </style>
</head>

<body>
<?php
include_once "conexionBaseDatos.php";
$id_alumno = $_REQUEST['idAlumno'];
	$perfil = pg_query("SELECT * FROM alumno WHERE $id_alumno = id_alumno ");
	$row=pg_fetch_array($perfil,NULL,PGSQL_ASSOC);

		$nombre = $row['nombre_alumno'];
		$apellido = $row['apellido_alumno'];
		$dni = $row['tipo_dni_alumno'];
		$numDNI = $row['num_dni_alumno'];
		$direccion = $row['direccion_alumno'];
		$fechaNacimiento = $row['fecha_nac_alumno'];
		$caracteristicaCel = $row['caracteristica_cel'];
		$celular = $row['celular_alumno'];
		$cel = $caracteristicaCel.'-'.$celular;
		$caracteristicaTelFijo = $row['caracteristica_fijo'];
		$telfijo = $row['telefono_alumno'];
		$telefonoFijo = $caracteristicaTelFijo.'-'.$telfijo;
		$mail = $row['mail_alumno'];
		$tituloSecundario = $row['titulo_secundario'];
		$establecimiento = $row['establecimiento_alumno'];
		$carreraUniversitaria = $row['carrera_alumno'];
		$legajoUniversitario = $row['legajo_alumno'];
		$materiasAprobadas = $row['materias_aprobadas_alumno'];
		$cursaAnio = $row['cursa_anio_alumno'];
		$promedio = $row['promedio_alumno'];
		$usuario = $mail;
		$password = $row['password_alumno'];
		$localidad = $row['localidad_alumno'];
		$foto = $row['foto'];
		$ancho_final = $row['ancho_final'];
		$alto_final = $row['alto_final'];
		
						
		
		
?>
<div id="contenedor">
<fieldset>
<legend><FONT face="Cambria" size="4" color="#6E6E6E">Foto</FONT></legend>
<table align="center">
	<tr>
		<td>
			<?php
			if($ancho_final>$alto_final){
			//foto horizontal
			$ancho_mostrar=200;
			$alto_mostrar=$alto_final*$ancho_mostrar/$ancho_final;  
			echo '<img src='.$foto.' width="'.$ancho_mostrar.'" height="'.$alto_mostrar.'">';
			}else{
			//fotos verticales
			$alto_mostrar=200;
			$ancho_mostrar=$ancho_final*$alto_mostrar/$alto_final;
			echo '<img src='.$foto.' width="'.$ancho_mostrar.'" height="'.$alto_mostrar.'">';
			}
			?>
		</td>
	</tr>
</table>
</fieldset>
<fieldset>
<legend><FONT face="Cambria" size="4" color="#6E6E6E">Datos Personales</FONT></legend>
<table>
	<tr>
		<td>
			<label for="cname">Apellido y Nombre: </label>
			<l1><?php echo $apellido; ?></l1>
			<l1><?php echo $nombre; ?></l1>
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
								if($id == $dni){
									echo $rowTipo['nombre_tipo_dni']; 
								}
                            }
				?></l1>
		<l1><?php echo $numDNI; ?></l1>
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
			<label for="cDia">Fecha de Nacimiento: </label>
			<l1><?php echo $fechaNacimiento; ?></l1>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cCelular">Celular: </label>
			<l1><?php echo $cel; ?></l1>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cTelefono">Telefono Fijo: </label>
			<l1><?php echo $telefonoFijo; ?></l1>
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
<legend><FONT face="Cambria" size="4" color="#6E6E6E">Datos Estudiantiles</FONT></legend>
<table>
	<tr>
		<td>
			<label for="cTituloSec">T&iacute;tulo Secundario: </label>
			<l1><?php echo $tituloSecundario; ?></l1>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cEstablecimiento">Establecimiento: </label>
			<l1><?php echo $establecimiento; ?></l1>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cCarreraUniv">Carrera Universitaria: </label>
			<l1><?php echo $carreraUniversitaria; ?></l1>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cLegajoUniv">Legajo Universitario N&deg;: </label>
			<l1><?php echo $legajoUniversitario; ?></l1>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cMatAprov">Materias Aprobadas: </label>
			<l1><?php echo $materiasAprobadas; ?></l1>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cAnioCursa">A&ntilde;o que Cursa: </label>
			<l1><?php echo $cursaAnio; ?></l1>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cPromedio">Promedio (con aplazo): </label>
			<l1><?php echo $promedio; ?></l1>
		</td>
	</tr>
	<tr>
		<td>
		<label for="cAntLab">Antecedentes Laborales: </label>
		<ul type = disk >
		<?php
			echo '<br>';
			$ant = pg_query("SELECT * FROM antecedentes_laborales WHERE $id_alumno = alumno_antecedentes_laborales ");
			while($row1=pg_fetch_array($ant,NULL,PGSQL_ASSOC)){
			$antecedentesLaborales = $row1['nombre_antecedentes_laborales'];
			echo '<l1><li>   '.$antecedentesLaborales.'</l1>';
			echo '<br>';
			}
		?>
		</ul>
		</td>
	</tr>
	<tr>
		<td>
		<label for="cAntLab">Conocimientos PC: </label>
		<ul type = disk >
		<?php
			echo '<br>';
			$con = pg_query("SELECT * FROM conocimientos_pc WHERE $id_alumno = alumno_conocimientos_pc ");
			while($row2=pg_fetch_array($con,NULL,PGSQL_ASSOC)){
			$conocimientos_pc = $row2['nombre_conocimientos_pc'];
			echo '<l1><li>   '.$conocimientos_pc.'</l1>';
			echo '<br>';
			}
		?>
		</ul>
		</td>
	</tr>
	<tr>
		<td>
		<label for="cAntLab">Cursos y Seminarios: </label>
		<ul type = disk >
		<?php
			echo '<br>';
			$cys = pg_query("SELECT * FROM cursos_seminarios WHERE $id_alumno = alumno_cs ");
			while($row3=pg_fetch_array($cys,NULL,PGSQL_ASSOC)){
			$cursos_seminarios = $row3['nombre_cursos_seminarios'];
			echo '<l1><li>   '.$cursos_seminarios.'</l1>';
			echo '<br>';
			}
		?>
		</ul>
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
		</tr>
	</table>
</fieldset>
		<br>
		<p>
			<a href="listadoAlumnos.php"><input type="button" value="Atr&aacute;s"></a>
		</p>
</form>
</body>
</html>