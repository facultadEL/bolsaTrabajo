<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<script src="jquery-latest.js"></script>
	<script type="text/javascript" src="jquery.validate.js"></script>
	<title>Registro de Pasante</title>
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
		$.validator.addClassRules("dni", {minlength: 6});
		$.validator.addClassRules("cuit", {minlength: 8});
		$.validator.addClassRules("anio", {minlength: 4});
		$.validator.addClassRules("caracteristica", {minlength: 3});
			
		$("#commentForm").validate();
			
		});
	</script>
</head>

<body>
<?php


$id_Alumno = $_REQUEST['idAlumno'];
$regreso = $_REQUEST['regreso'];

include_once "conexionBaseDatos.php";

		$sqlAlumno = pg_query("SELECT * FROM alumno WHERE id_alumno = $id_Alumno");
		$rowAlumno = pg_fetch_array($sqlAlumno);
		
		$nombre = $rowAlumno['nombre_alumno'];
		$apellido = $rowAlumno['apellido_alumno'];
		$dni = $rowAlumno['tipo_dni_alumno'];
		$numDNI = $rowAlumno['num_dni_alumno'];
		$direccion = $rowAlumno['direccion_alumno'];
		$fechaNac = $rowAlumno['fecha_nac_alumno'];
			$vFechaNac = explode('/',$fechaNac);
		$dia = $vFechaNac[0];
		$mes = $vFechaNac[1];
		$anio = $vFechaNac[2];
		$caracteristicaCel = $rowAlumno['caracteristica_cel'];
		$celular = $rowAlumno['celular_alumno'];
		//$cel = $caracteristicaCel.'-'.$celular;
		$caracteristicaTelFijo = $rowAlumno['caracteristica_fijo'];
		$telfijo = $rowAlumno['telefono_alumno'];
		//$telefonoFijo = $caracteristicaTelFijo.'-'.$telfijo;
		$mail = $rowAlumno['mail_alumno'];
		$tituloSecundario = $rowAlumno['titulo_secundario'];
		$establecimiento = $rowAlumno['establecimiento_alumno'];
		$carreraUniversitaria = $rowAlumno['carrera_alumno'];
		$legajoUniversitario = $rowAlumno['legajo_alumno'];
		$materiasAprobadas = $rowAlumno['materias_aprobadas_alumno'];
		$cursaAnio = $rowAlumno['cursa_anio_alumno'];
		$promedio = $rowAlumno['promedio_alumno'];
		$usuario = $rowAlumno['usuario_alumno'];
		$password = $rowAlumno['password_alumno'];
		$localidad = $rowAlumno['localidad_alumno'];
		$foto = $rowAlumno['foto'];
		$ancho_final = $rowAlumno['ancho_final'];
		$alto_final = $rowAlumno['alto_final'];
	
?>
<form class="formAltaPasante" id="commentForm" action="datosExtra.php?control=0&idAlumno=<?php echo $id_Alumno ?>&password=<?php echo $password ?>" method="post" enctype="multipart/form-data">
<fieldset>
<legend><FONT face="Cambria" size="4" color="#6E6E6E">Datos Personales</FONT></legend>
<table>
	<tr>
		<td>
			<label for="cname">Nombre: </label>
			<input id="cNombre" name="nombre" type="text" value="<?php echo $nombre; ?>" class="required" size="22"/>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cname">Apellido: </label>
			<input id="cApellido" name="apellido" type="text" value="<?php echo $apellido; ?>" class="required" size="22"/>
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
					echo '<option value="'.$rowTipo['id_tipo_dni'].'">'.$rowTipo['nombre_tipo_dni'].'</option>';
				}
			?>
		</select>
		<input id="cNumDni" name="numDNI" type="text" value="<?php echo $numDNI; ?>" maxlength="8" class="required dni" size="13"/>
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
			<input id="cLocalidad" name="localidad" type="text" value="<?php echo $localidad; ?>" class="required" size="22"/>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cDia">Fecha de Nacimiento: </label>
			<input id="cDia" name="dia" type="text"  value="<?php echo $dia; ?>" placeholder="dd" class="required minimo" maxlength="2" size="2"/>
			<input id="cMes" name="mes" type="text"  value="<?php echo $mes; ?>" placeholder="mm" class="required minimo" maxlength="2" size="2"/>
			<input id="cAnio" name="anio" type="text"  value="<?php echo $anio; ?>" placeholder="aaaa" class="required anio" maxlength="4" size="4"/>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cCelular">Celular: </label>
			<input id="cCaracteristica" name="caracteristicaCel" type="text" value="<?php echo $caracteristicaCel; ?>" size="5" maxlength="5" class="required caracteristica"/>
			<input id="cCelular" name="celular" type="text" value="<?php echo $celular; ?>" size="22" class="required cuit" maxlength="10"/>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cTelefono">Telefono Fijo: </label>
			<input id="cCaracteristica" name="caracteristicaTel" type="text" value="<?php echo $caracteristicaTelFijo; ?>" size="5" maxlength="5" class="caracteristica"/>
			<input id="cTelefono" name="telfijo" type="text" value="<?php echo $telfijo; ?>" size="22" class="dni" maxlength="8"/>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cMail">Mail: </label>
			<input id="cMail" name="mail" type="text" value="<?php echo $mail; ?>" size="22" class="required email"/>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cFoto">Foto: </label>
			<?php
			if ($regreso == 1){
				echo '<input type="file" name="foto"/>';
			}else{
				echo '<input type="file" name="foto" class="required"/>';
			}
			
			?>
		</td>
	<tr>
</table>	
</fieldset>
<fieldset>
<legend><FONT face="Cambria" size="4" color="#6E6E6E">Datos Estudiantiles</FONT></legend>
<table>
	<tr>
		<td>
			<label for="cTituloSec">T&iacute;tulo Secundario: </label>
			<input id="cTituloSec" name="tituloSecundario" type="text" size="22" value="<?php echo $tituloSecundario; ?>" class="required"/>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cEstablecimiento">Establecimiento: </label>
			<input id="cEstablecimiento" name="establecimiento" type="text" size="22" value="<?php echo $establecimiento; ?>" class="required"/>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cCarreraUniv">Carrera Universitaria: </label>
			<input id="cCarreraUniv" name="carreraUniversitaria" type="text" size="22" value="<?php echo $carreraUniversitaria; ?>" class="required"/>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cLegajoUniv">Legajo N&deg;: </label>
			<input id="cLegajoUniv" name="legajoUniversitario" type="text" size="22" value="<?php echo $legajoUniversitario; ?>" class="required"/>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cMatAprov">Materias Aprobadas: </label>
			<input id="cMatAprov" name="materiasAprobadas" type="text" size="22" value="<?php echo $materiasAprobadas; ?>" class="required"/>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cAnioCursa">A&ntilde;o que Cursa: </label>
			<input id="cAnioCursa" name="cursaAnio" type="text" size="22" value="<?php echo $cursaAnio; ?>" class="required rango"/>
		</td>
	</tr>
	<tr>
		<td>
			<label for="cPromedio">Promedio (con aplazo): </label>
			<input id="cPromedio" name="promedio" type="text" size="22" value="<?php echo $promedio; ?>" class="required"/>
		</td>
	</tr>
	</table>
</fieldset>
		<p>
			<input class="submit" type="submit" value="Siguiente"/>
			<a href="login.php"><input type="button" value="Atr&aacute;s"></a>
		</p>
		<br>
</form>
</body>
</html>