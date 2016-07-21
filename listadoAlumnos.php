<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<script src="jquery-latest.js"></script>
	<script type="text/javascript" src="jquery.validate.js"></script>
	<title>Listado de Alumnos</title>
	<style type="text/css">
			{font-family: Cambria }
			#tabla {background: #F2F2F2;}
			#titulo { border-right: 2px solid #BDBDBD;padding: 3px}
			#titulo3 { border-top: 2px solid #BDBDBD;border-bottom: 2px solid #BDBDBD;padding: 3px;}
			#titulo4 {border-left: 2px solid #BDBDBD;padding: 3px;}
			#titulo2 { border-bottom: 2px solid #BDBDBD;padding: 3px;}
			label {font-family: Cambria; text-transform: capitalize; padding: .5em; color: #0080FF;}
			l1 {font-family: Cambria;color: #0B615E; text-transform: capitalize; font-size: 1.5em;}
			l2 {font-family: Cambria;color: #424242; text-transform: capitalize;}
			l3 {font-family: Cambria;color: #424242;}
    </style>
	<script>
		$(document).ready(function(){
			
		$.validator.addClassRules("rango", {range:[0,6]});
		$.validator.addClassRules("minimo", {minlength: 2});
		$.validator.addClassRules("dni", {minlength: 6});
		$.validator.addClassRules("anio", {minlength: 4});
		$.validator.addClassRules("caracteristica", {minlength: 3});
			
		$('form').validate();
		$("#commentForm").validate();
			
		});
	</script>
</head>

<body>
<div id="contenedor">
<table id="tabla"  cellpadding="2" cellspacing="1">
	<tr bgcolor="#FFFFFF">
		<td id="titulo3" colspan="6" align="center">
			<l1>Listado de Alumnos</l1>
		</td>
	</tr>
	<tr align="center" bgcolor="#1C1C1C">
		<td id="titulo2">
			<label>Apellido</label>
		</td>
		<td id="titulo2">
			<label>Nombre</label>
		</td>
		<?php //<td id="titulo2">
			//<label>N&deg; Dni</label>
		//</td>?>
		<td id="titulo2">
			<label>Celular</label>
		</td>
		<td id="titulo2">
			<label>E-mail</label>
		</td>
		<td id="titulo2">
			<label>Ver Perfil</label>
		</td>
		<td id="titulo2">
			<label>Habilitar</label>
		</td>
	</tr>
	<?php
	
	include_once "conexionBaseDatos.php";
	
	$sqlAlumnos = pg_query("SELECT * FROM alumno ORDER BY apellido_alumno, nombre_alumno ASC");
	
	while($rowAlumnos=pg_fetch_array($sqlAlumnos)){
	$id_alumno = $rowAlumnos['id_alumno'];
	
		echo '<tr>';
			echo '<td id="titulo">';
				echo '<l2>'.$rowAlumnos['apellido_alumno'].'</l2>';
			echo '</td>';
			echo '<td id="titulo">';
				echo '<l2>'.$rowAlumnos['nombre_alumno'].'</l2>';
			echo '</td>';
			//echo '<td id="titulo">';
				//echo '<l2>'.$rowAlumnos['num_dni_alumno'].'</l2>';
			//echo '</td>';
			echo '<td id="titulo">';
				echo '<l2>'.$rowAlumnos['caracteristica_cel'].' - '.$rowAlumnos['celular_alumno'].'</l2>';
			echo '</td>';
			echo '<td>';
				echo '<l3>'.$rowAlumnos['mail_alumno'].'</l3>';
			echo '</td>';
			echo '<td id="titulo4" align="center">';
				echo '<a href="perfilAlumnoFacu.php?idAlumno='.$id_alumno.'"><input type="image" src="perfil.png" width="40" height="40" value="Perfil" /></a>';
			echo '</td>';
			echo '<td id="titulo4" align="center">';
			if ($rowAlumnos['habilitar_alumno'] == "f"){
				echo '<a href="habilitarAlumno.php?controlHabilitar=0&idAlumno='.$id_alumno.'"><input type="image" src="bred.png" width="40" height="40" value="Habilitada"/></a>';
			}else{
				echo '<a href="habilitarAlumno.php?controlHabilitar=1&idAlumno='.$id_alumno.'"><input type="image" src="bgreen.png" width="40" height="40" value="Habilitada"/></a>';
			}
			echo '</td>';
		echo '</tr>';
	}


	
	?>
</table>
</div>
</body>
</html>