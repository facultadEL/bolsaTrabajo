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

		$("#commentForm").validate();

		});
	</script>

<?php
	include_once "conexionBaseDatos.php";
	$control = $_REQUEST['control'];
	$esp = '&nbsp;&nbsp;';
	
	if($control == 0){
	
	$id_Alumno = $_REQUEST['idAlumno'];
		if ($id_Alumno == NULL){
		
		$nombre = $_REQUEST['nombre'];
		$apellido = $_REQUEST['apellido'];
		$dni = $_REQUEST['dni'];
		$numDNI = $_REQUEST['numDNI'];
		$direccion = $_REQUEST['direccion'];
		$dia = $_REQUEST['dia'];
		$mes = $_REQUEST['mes'];
		$anio = $_REQUEST['anio'];
		$fechaNacimiento = $dia.'/'.$mes.'/'.$anio;
		$caracteristicaCel = $_REQUEST['caracteristicaCel'];
		$celular = $_REQUEST['celular'];
		$cel = $caracteristicaCel.'-'.$celular;
		$caracteristicaTelFijo = $_REQUEST['caracteristicaTel'];
		$telfijo = $_REQUEST['telfijo'];
		$mail = $_REQUEST['mail'];
		$tituloSecundario = $_REQUEST['tituloSecundario'];
		$establecimiento = $_REQUEST['establecimiento'];
		$carreraUniversitaria = $_REQUEST['carreraUniversitaria'];
		$legajoUniversitario = $_REQUEST['legajoUniversitario'];
		$materiasAprobadas = $_REQUEST['materiasAprobadas'];
		$cursaAnio = $_REQUEST['cursaAnio'];
		$promedio = $_REQUEST['promedio'];
		$usuario = $mail;
		$password = $numDNI;
		$localidad = $_REQUEST['localidad'];
		
		$nombreFoto = $_FILES['foto']['name'];
		$tipo_archivo = $_FILES['foto']['type'];	
		$tamano_archivo = $_FILES['foto']['size'];
		$archivo_foto = $_FILES['foto']['tmp_name'];
		
		//en el siguiente paso le quito los espacios al nombre de la foto para evitar problemas.
		$nombre_foto = str_replace(" ", "-", $nombreFoto);
		
		$ftp_server = "190.114.198.126";
		$ftp_user_name = "fernandoserassioextension";
		$ftp_user_pass = "fernando2013";
		$destino_Imagen = "web/pasantias/fotos/".$nombre_foto;
		$destinoImagen = "fotos/".$nombre_foto;
		
		//conexión
		$conn_id = ftp_connect($ftp_server); 
		// logeo
		$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

		$imagen = explode(".", $nombre_foto);
		$totalImagen=count($imagen);
		$formato = $totalImagen - 1;
			if ($imagen[$formato] == "jpeg" || $imagen[$formato] == "jpg" || $imagen[$formato] == "png") {
			// archivo a copiar/subir
				$upload = ftp_put($conn_id, $destino_Imagen, $archivo_foto, FTP_BINARY);
			}else{
				echo '<script type="text/javascript">alert("El archivo subido no es válido. Suba algunos de estos formatos: - jpg - jpeg - png");
													window.location="nuevoAlumno.php?idAlumno='.$id_Alumno.'&regreso=1";	
					  </script>';
			}
			
		// cerramos
		ftp_close($conn_id);
		
		if ($imagen[$formato] == "jpeg" || $imagen[$formato] == "jpg"){

		$imagen_origen = imagecreatefromjpeg($destinoImagen);
		//obtengo el ancho de la imagen original
		$ancho_origen = imagesx($imagen_origen);
		//obtengo el alto de la imagen original
		$alto_origen = imagesy($imagen_origen);
		
		$ancho=600;
		$alto=400;
		
		if($ancho_origen>$alto_origen){
		//foto horizontal
			$ancho_final=$ancho;
			$alto_final=$alto_origen*$ancho_final/$ancho_origen;    
		}else{
		//fotos verticales
			$alto_final=$alto;
			$ancho_final=$ancho_origen*$alto_final/$alto_origen;
		}
		// creo la imagen con el tamaño que le pase
		$imagen_destino = imagecreatetruecolor($ancho_final ,$alto_final );

		imagecopyresized( $imagen_destino, $imagen_origen, 0, 0, 0, 0, $ancho_final, $alto_final, $ancho_origen, $alto_origen);
		
		//guardo la nueva foto (nuevaFoto, destino, calidad)
		imagejpeg( $imagen_destino,$destinoImagen,100 );
		}
		
		if ($imagen[$formato] == "png") {
		$imagen_origen = imagecreatefrompng($destinoImagen);
		//obtengo el ancho de la imagen original
		$ancho_origen = imagesx($imagen_origen);
		//obtengo el alto de la imagen original
		$alto_origen = imagesy($imagen_origen);
		
		$ancho=600;
		$alto=400;
		
		if($ancho_origen>$alto_origen){
		//foto horizontal
			$ancho_final=$ancho;
			$alto_final=$alto_origen*$ancho_final/$ancho_origen;    
		}else{
		//fotos verticales
			$alto_final=$alto;
			$ancho_final=$ancho_origen*$alto_final/$alto_origen;
		}
		// creo la imagen con el tamaño que le pase
		$imagen_destino = imagecreatetruecolor($ancho_final ,$alto_final );
		
		//Copio y cambio el tamaño de la imagen
		imagecopyresized( $imagen_destino, $imagen_origen, 0, 0, 0, 0, $ancho_final, $alto_final, $ancho_origen, $alto_origen);
		
		//guardo la nueva foto (nuevaFoto, destino, calidad)
		imagepng( $imagen_destino,$destinoImagen,9 );
		}
		
		
		//$sep = '/-/';
		//$datosPasar = $nombre.$sep.$apellido.$sep.$dni.$sep.$numDNI.$sep.$direccion.$sep.$dia.$sep.$mes.$sep.$anio.$sep.$caracteristicaCel.$sep.$celular.$sep.$caracteristicaTelFijo.$sep.$telfijo.$sep.$mail.$sep.$tituloSecundario.$sep.$establecimiento.$sep.$carreraUniversitaria.$sep.$legajoUniversitario.$sep.$materiasAprobadas.$sep.$cursaAnio.$sep.$promedio.$sep.$usuario.$sep.$password.$sep.$localidad.$sep.$destinoImagen.$sep.$ancho_final.$sep.$alto_final;
	
	$consultaMax = pg_query("SELECT max(id_alumno) FROM alumno");
	$rowMax = pg_fetch_array($consultaMax);
	$maximoAlumno = $rowMax['max'];
	$maximoAlumno = $maximoAlumno + 1;
	$id_Alumno = $maximoAlumno;
	
	
	$fechaNac = $dia.'/'.$mes.'/'.$anio;
	$sqlNuevoAlumno = "INSERT INTO alumno(id_alumno,nombre_alumno,apellido_alumno,tipo_dni_alumno,num_dni_alumno,direccion_alumno,localidad_alumno,fecha_nac_alumno,caracteristica_cel,celular_alumno,caracteristica_fijo,telefono_alumno,mail_alumno,titulo_secundario,establecimiento_alumno,carrera_alumno,materias_aprobadas_alumno,cursa_anio_alumno,promedio_alumno,legajo_alumno,usuario_alumno,password_alumno,foto,ancho_final,alto_final) VALUES('$id_Alumno','$nombre','$apellido','$dni','$numDNI','$direccion','$localidad','$fechaNac','$caracteristicaCel','$celular','$caracteristicaTelFijo','$telfijo','$mail','$tituloSecundario','$establecimiento','$carreraUniversitaria','$materiasAprobadas','$cursaAnio','$promedio','$legajoUniversitario','$usuario','$password','$destinoImagen','$ancho_final','$alto_final');";
		
	$error=0;

	if(!pg_query($cnx,$sqlNuevoAlumno)){
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
		$nombre = $_REQUEST['nombre'];
		$apellido = $_REQUEST['apellido'];
		$dni = $_REQUEST['dni'];
		$numDNI = $_REQUEST['numDNI'];
		$direccion = $_REQUEST['direccion'];
		$dia = $_REQUEST['dia'];
		$mes = $_REQUEST['mes'];
		$anio = $_REQUEST['anio'];
		$fechaNacimiento = $dia.'/'.$mes.'/'.$anio;
		$caracteristicaCel = $_REQUEST['caracteristicaCel'];
		$celular = $_REQUEST['celular'];
		$cel = $caracteristicaCel.'-'.$celular;
		$caracteristicaTelFijo = $_REQUEST['caracteristicaTel'];
		$telfijo = $_REQUEST['telfijo'];
		$telefonoFijo = $caracteristicaTelFijo.'-'.$telfijo;
		$mail = $_REQUEST['mail'];
		$tituloSecundario = $_REQUEST['tituloSecundario'];
		$establecimiento = $_REQUEST['establecimiento'];
		$carreraUniversitaria = $_REQUEST['carreraUniversitaria'];
		$legajoUniversitario = $_REQUEST['legajoUniversitario'];
		$materiasAprobadas = $_REQUEST['materiasAprobadas'];
		$cursaAnio = $_REQUEST['cursaAnio'];
		$promedio = $_REQUEST['promedio'];
		$usuario = $mail;
		$password = $_REQUEST['password'];;
		$localidad = $_REQUEST['localidad'];
		
		$nombreFoto = $_FILES['foto']['name'];
		$tipo_archivo = $_FILES['foto']['type'];	
		$tamano_archivo = $_FILES['foto']['size'];
		$archivo_foto = $_FILES['foto']['tmp_name'];
		
		//en el siguiente paso le quito los espacios al nombre de la foto para evitar problemas.
		$nombre_foto = str_replace(" ", "-", $nombreFoto);
		
		
		
		if($nombre_foto == NULL){
			$sqlFoto = pg_query("SELECT * FROM alumno WHERE id_alumno = $id_Alumno");
			$rowFoto = pg_fetch_array($sqlFoto);
			
			$destinoImagen = $rowFoto['foto'];
			$ancho_final = $rowFoto['ancho_final'];
			$alto_final = $rowFoto['alto_final'];
			
			
			
		}else{
			$ftp_server = "190.114.198.126";
			$ftp_user_name = "fernandoserassioextension";
			$ftp_user_pass = "fernando2013";
			$destino_Imagen = "web/pasantias/fotos/".$nombre_foto;
			$destinoImagen = "fotos/".$nombre_foto;
			
			//conexión
			$conn_id = ftp_connect($ftp_server); 
			// logeo
			$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
		
		$imagen = explode(".", $nombre_foto);
		$totalImagen=count($imagen);
		$formato = $totalImagen - 1;
		
			if ($imagen[$formato] == "jpeg" || $imagen[$formato] == "jpg" || $imagen[$formato] == "png") {
			// archivo a copiar/subir
				$upload = ftp_put($conn_id, $destino_Imagen, $archivo_foto, FTP_BINARY);
			}else{
				echo '<script type="text/javascript">alert("El archivo subido no es válido. Suba algunos de estos formatos: - jpg - jpeg - png");
													window.location="nuevoAlumno.php?idAlumno='.$id_Alumno.'&regreso=1";	
					  </script>';
			}
		
		// cerramos
		ftp_close($conn_id);
		
		if ($imagen[$formato] == "jpeg" || $imagen[$formato] == "jpg"){

		$imagen_origen = imagecreatefromjpeg($destinoImagen);
		//obtengo el ancho de la imagen original
		$ancho_origen = imagesx($imagen_origen);
		//obtengo el alto de la imagen original
		$alto_origen = imagesy($imagen_origen);
		
		$ancho=600;
		$alto=400;
		
		if($ancho_origen>$alto_origen){
		//foto horizontal
			$ancho_final=$ancho;
			$alto_final=$alto_origen*$ancho_final/$ancho_origen;    
		}else{
		//fotos verticales
			$alto_final=$alto;
			$ancho_final=$ancho_origen*$alto_final/$alto_origen;
		}
		// creo la imagen con el tamaño que le pase
		$imagen_destino = imagecreatetruecolor($ancho_final ,$alto_final );

		imagecopyresized( $imagen_destino, $imagen_origen, 0, 0, 0, 0, $ancho_final, $alto_final, $ancho_origen, $alto_origen);
		
		//guardo la nueva foto (nuevaFoto, destino, calidad)
		imagejpeg( $imagen_destino,$destinoImagen,100 );
		}
		
		if ($imagen[$formato] == "png") {
		$imagen_origen = imagecreatefrompng($destinoImagen);
		//obtengo el ancho de la imagen original
		$ancho_origen = imagesx($imagen_origen);
		//obtengo el alto de la imagen original
		$alto_origen = imagesy($imagen_origen);
		
		$ancho=600;
		$alto=400;
		
		if($ancho_origen>$alto_origen){
		//foto horizontal
			$ancho_final=$ancho;
			$alto_final=$alto_origen*$ancho_final/$ancho_origen;    
		}else{
		//fotos verticales
			$alto_final=$alto;
			$ancho_final=$ancho_origen*$alto_final/$alto_origen;
		}
		// creo la imagen con el tamaño que le pase
		$imagen_destino = imagecreatetruecolor($ancho_final ,$alto_final );
		
		//Copio y cambio el tamaño de la imagen
		imagecopyresized( $imagen_destino, $imagen_origen, 0, 0, 0, 0, $ancho_final, $alto_final, $ancho_origen, $alto_origen);
		
		//guardo la nueva foto (nuevaFoto, destino, calidad)
		imagepng( $imagen_destino,$destinoImagen,9 );
		}
		
		
		}
		
		
		$sqlModAlumno = "UPDATE alumno SET nombre_alumno='$nombre', apellido_alumno='$apellido', tipo_dni_alumno='$dni', num_dni_alumno='$numDNI', direccion_alumno='$direccion', localidad_alumno='$localidad', fecha_nac_alumno='$fechaNacimiento', caracteristica_cel='$caracteristicaCel', celular_alumno='$celular', caracteristica_fijo='$caracteristicaTelFijo', telefono_alumno='$telfijo', mail_alumno='$mail', titulo_secundario='$tituloSecundario', establecimiento_alumno='$establecimiento', carrera_alumno='$carreraUniversitaria', materias_aprobadas_alumno='$materiasAprobadas', cursa_anio_alumno='$cursaAnio', promedio_alumno='$promedio', legajo_alumno='$legajoUniversitario', foto='$destinoImagen', ancho_final='$ancho_final', alto_final='$alto_final' WHERE id_alumno = $id_Alumno;";
		
	$error=0;

	if(!pg_query($cnx,$sqlModAlumno)){
		$errorpg = pg_last_error($cnx);
		$termino = "ROLLBACK";
		$error=1;
	}else{
		$termino = "COMMIT";
	}
	pg_query($termino);
	if($error==1){
		echo '<script language="JavaScript"> 			alert("Los datos del alumno no se actualizaron correctamente. Pongase en contacto con el administrador");</script>';
		echo $errorpg;
	}
	
	
	
	}
	
	}else{
	
		$id_Alumno = $_REQUEST['idAlumno'];
			
		$sqlAlumno = pg_query("SELECT * FROM alumno WHERE id_alumno = $id_Alumno");
		$rowAlumno = pg_fetch_array($sqlAlumno);
		
		$nombre = $rowAlumno['nombre_alumno'];
		$apellido = $rowAlumno['apellido_alumno'];
		$dni = $rowAlumno['tipo_dni_alumno'];
		$numDNI = $rowAlumno['num_dni_alumno'];
		$direccion = $rowAlumno['direccion_alumno'];
		$fechaNacimiento = $rowAlumno['fecha_nac_alumno'];
			$vFechaNac = explode('/',$fechaNac);
		$dia = $vFechaNac[0];
		$mes = $vFechaNac[1];
		$anio = $vFechaNac[2];
		$caracteristicaCel = $rowAlumno['caracteristica_cel'];
		$celular = $rowAlumno['celular_alumno'];
		$cel = $caracteristicaCel.'-'.$celular;
		$caracteristicaTelFijo = $rowAlumno['caracteristica_fijo'];
		$telfijo = $rowAlumno['telefono_alumno'];
		$telefonoFijo = $caracteristicaTelFijo.'-'.$telfijo;
		$mail = $rowAlumno['mail_alumno'];
		$tituloSecundario = $rowAlumno['titulo_secundario'];
		$establecimiento = $rowAlumno['establecimiento_alumno'];
		$carreraUniversitaria = $rowAlumno['carrera_alumno'];
		$legajoUniversitario = $rowAlumno['legajo_alumno'];
		$materiasAprobadas = $rowAlumno['materias_aprobadas_alumno'];
		$cursaAnio = $rowAlumno['cursa_anio_alumno'];
		$promedio = $rowAlumno['promedio_alumno'];
		$usuario = $mail;
		$password = $rowAlumno['password_alumno'];
		$localidad = $rowAlumno['localidad_alumno'];
		$destinoImagen = $rowAlumno['foto'];
		$ancho_final = $rowAlumno['ancho_final'];
		$alto_final = $rowAlumno['alto_final'];
		
	

	if($control == 1){
	$id_Alumno = $_REQUEST['idAlumno'];
	$antecLaborales = $_REQUEST['antecLaborales'];
	$sqlAntecLabor = "";
		
	$consultaMax = pg_query("SELECT max(id_antecedentes_laborales) FROM antecedentes_laborales");
	$rowMax = pg_fetch_array($consultaMax);
	$maximoAntecLabor = $rowMax['max'];
	$maxAntecLabor = $maximoAntecLabor+1;	
		
	$sqlAntecLabor = "INSERT INTO antecedentes_laborales(id_antecedentes_laborales, nombre_antecedentes_laborales,alumno_antecedentes_laborales) VALUES('$maxAntecLabor','$antecLaborales','$id_Alumno');";
	
	$error=0;

	if(!pg_query($cnx,$sqlAntecLabor)){
		$errorpg = pg_last_error($cnx);
		$termino = "ROLLBACK";
		$error=1;
	}else{
		$termino = "COMMIT";
	}
	pg_query($termino);
	if($error==1){
		echo '<script language="JavaScript"> 			alert("Los Antecedentes Laborales no se guardaron correctamente. Pongase en contacto con el administrador");</script>';
		echo $errorpg;
	}	
			
	
}
	


	if($control == 2){
		$id_Alumno = $_REQUEST['idAlumno'];
		$conocPc = $_REQUEST['conocPc'];
		$sqlConocimientosPc = "";
		
	$consultaMax = pg_query("SELECT max(id_conocimientos_pc) FROM conocimientos_pc");
	$rowMax = pg_fetch_array($consultaMax);
	$maximoConocimientosPc = $rowMax['max'];
	$maxConocimientosPc = $maximoConocimientosPc+1;

	$sqlConocimientosPc = "INSERT INTO conocimientos_pc(id_conocimientos_pc, nombre_conocimientos_pc,alumno_conocimientos_pc) VALUES('$maxConocimientosPc','$conocPc','$id_Alumno');";
				
	$error=0;

	if(!pg_query($cnx,$sqlConocimientosPc)){
		$errorpg = pg_last_error($cnx);
		$termino = "ROLLBACK";
		$error=1;
	}else{
		$termino = "COMMIT";
	}
	pg_query($termino);
	if($error==1){
		echo '<script language="JavaScript"> 			alert("Los Conocimientos de PC no se guardaron correctamente. Pongase en contacto con el administrador");</script>';
		echo $errorpg;
	}	
			
	}

		if($control == 3){

		$id_Alumno = $_REQUEST['idAlumno'];
		$cursosSeminarios = $_REQUEST['cursosSeminarios'];
		$sqlCursosSeminarios = "";
		
	$consultaMax = pg_query("SELECT max(id_cursos_seminarios) FROM cursos_seminarios");
	$rowMax = pg_fetch_array($consultaMax);
	$maximoCursosSeminarios = $rowMax['max'];
	$maxCursosSeminarios = $maximoCursosSeminarios+1;

	$sqlCursosSeminarios = "INSERT INTO cursos_seminarios(id_cursos_seminarios, nombre_cursos_seminarios,alumno_cs) VALUES('$maxCursosSeminarios','$cursosSeminarios','$id_Alumno');";
				
	$error=0;

	if(!pg_query($cnx,$sqlCursosSeminarios)){
		$errorpg = pg_last_error($cnx);
		$termino = "ROLLBACK";
		$error=1;
	}else{
		$termino = "COMMIT";
	}
	pg_query($termino);
	if($error==1){
		echo '<script language="JavaScript"> 			alert("Los Cursos y Seminarios no se guardaron correctamente. Pongase en contacto con el administrador");</script>';
		echo $errorpg;
	}	
			
	}
}

?>
</head>
<body>
<div id="contenedor">
<fieldset>
<legend><FONT face="Cambria" size="4" color="#6E6E6E">Foto</FONT></legend>
<table align="center">
	<tr>
		<td>
		<?php
			$alto_destino = imagesy($imagen_destino);
			$ancho_destino = imagesx($imagen_destino);
			if($ancho_destino>$alto_destino){
		//foto horizontal
			$ancho_mostrar=200;
			$alto_mostrar=$alto_destino*$ancho_mostrar/$ancho_destino;  
			echo '<img src='.$destinoImagen.' width="'.$ancho_mostrar.'" height="'.$alto_mostrar.'">';
		}else{
		//fotos verticales
			$alto_mostrar=200;
			$ancho_mostrar=$ancho_destino*$alto_mostrar/$alto_destino;
			echo '<img src='.$destinoImagen.' width="'.$ancho_mostrar.'" height="'.$alto_mostrar.'">';
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
<form  id="commentForm" action="?control=1" method="post">
	<table>
		<tr>
			<td>
				<label for="cAntecedentes">Antecedentes Laborales: </label>
				<input id="cAntecedentes" name="antecLaborales" type="text" size="50" value="" class="required"/>
				<?php echo '<input type="hidden" name="idAlumno" value="'.$id_Alumno.'" />'; ?>
				<input type="submit" value="Cargar"/>
			<br>
				<ul type = disk >
				<?php				
				$antecedentesRestantes = pg_query("SELECT * FROM antecedentes_laborales WHERE alumno_antecedentes_laborales = $id_Alumno");
				while($rowAL=pg_fetch_array($antecedentesRestantes,NULL,PGSQL_ASSOC)){				
					echo '<l3>';
					echo '<li>'.$rowAL['nombre_antecedentes_laborales'].$esp.'<a href="eliminarDatosExtras.php?eliminar=1&idAlumno='.$id_Alumno.'&idEliminarAL='.$rowAL['id_antecedentes_laborales'].'"><img src="eliminar.png" width="16" height="16" name="Eliminar" value="Eliminar"/></a><br>';
					echo '</l3>';}
				?>
				</ul>
			</td>
		</tr>
</form>
<form  id="commentForm" action="?control=2" method="post">
		<tr>
			<td>
				<label for="cAntecedentes">Conocimientos en PC: </label>
				<input id="cAntecedentes" name="conocPc" type="text" size="50" value="" class="required"/>
				<?php echo '<input type="hidden" name="idAlumno" value="'.$id_Alumno.'" />'; ?>
				<input type="submit" value="Cargar"/>
				<br>
				<ul type = disk >
				<?php	
				echo '<input type="hidden" name="idAlumno" value="'.$id_Alumno.'" />';
				$conocimientosPC_Restantes = pg_query("SELECT * FROM conocimientos_pc WHERE alumno_conocimientos_pc = $id_Alumno");
				while($rowCP=pg_fetch_array($conocimientosPC_Restantes,NULL,PGSQL_ASSOC)){				
					echo '<l3>';
					echo '<li>'.$rowCP['nombre_conocimientos_pc'].$esp.'<a href="eliminarDatosExtras.php?eliminar=2&idAlumno='.$id_Alumno.'&idEliminarCP='.$rowCP['id_conocimientos_pc'].'"><img src="eliminar.png" width="16" height="16" name="Eliminar" value="Eliminar"/></a><br>';
					echo '</l3>';}
				?>
				</ul>
			</td>
		</tr>
</form>
<form  id="commentForm" action="?control=3" method="post">
		<tr>
			<td>
				<label for="cAntecedentes">Cursos y Seminarios: </label>
				<input id="cAntecedentes" name="cursosSeminarios" type="text" size="50" value="" class="required"/>
				<?php echo '<input type="hidden" name="idAlumno" value="'.$id_Alumno.'" />'; ?>
				<input type="submit" value="Cargar"/>
			<br>
				<ul type = disk >
				<?php	
				echo '<input type="hidden" name="idAlumno" value="'.$id_Alumno.'" />';
				$cursos_seminarios_Restantes = pg_query("SELECT * FROM cursos_seminarios WHERE alumno_cs = $id_Alumno");
				while($rowCS=pg_fetch_array($cursos_seminarios_Restantes,NULL,PGSQL_ASSOC)){				
					echo '<l3>';
					echo '<li>'.$rowCS['nombre_cursos_seminarios'].$esp.'<a href="eliminarDatosExtras.php?eliminar=3&idAlumno='.$id_Alumno.'&idEliminarCS='.$rowCS['id_cursos_seminarios'].'"><img src="eliminar.png" width="16" height="16" name="Eliminar" value="Eliminar"/></a><br>';
					echo '</l3>';}
				?>
				</ul>
			</td>
		</tr>
		
	</table>
</fieldset>
</form>
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
	<a href="nuevoAlumno.php?regreso=1&idAlumno=<?php echo $id_Alumno;?>"><input type="button" name="volver" value="Volver"/></a>
	<a href="verificarLogin.php?usuario=<?php echo $usuario;?>&password=<?php echo $password;?>"><input type="button" name="registrar" value="Guardar"/></a>
	</p>
</div>
</body>
</html>
