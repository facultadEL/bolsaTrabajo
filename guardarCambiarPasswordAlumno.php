<?php
	$id_alumno = $_REQUEST['idAlumno'];
	$password_repetido = $_REQUEST['passwordRepetido'];
	$password_nuevo = $_REQUEST['passwordNuevo'];
	$password_anterior = $_REQUEST['passwordAnterior'];
	
	$iguales= strcmp( $password_repetido, $password_nuevo );

	include_once "conexionBaseDatos.php";
	$consulta = pg_query("SELECT * FROM alumno WHERE id_alumno = $id_alumno");
	$row = pg_fetch_array($consulta,NULL,PGSQL_ASSOC);
	$password_alumno = $row['password_alumno'];
	
	$iguales1 = strcmp( $password_alumno, $password_anterior );
	echo 'iguales: '.$iguales;
	echo '<br>';
	echo 'iguales1: '.$iguales1;
	echo '<br>';
	echo 'anterior: '.$password_anterior;
	echo '<br>';
	echo 'alumno: '.$password_alumno;
	
	if ($iguales1 == 0){
		if ($iguales == 0){
			$password = $password_nuevo;
			pg_query("UPDATE alumno SET password_alumno='$password' WHERE id_alumno = $id_alumno");
			echo '<script language="JavaScript"> 			alert("El cambio se realizo correctamente");
														location ="perfilAlumno.php?idAlumno='.$id_alumno.'";</script>';
														pg_query("COMMIT");
		}else{
			echo '<script language="JavaScript"> 			alert("Las contraseñas no coinciden");
														location ="cambiarPasswordAlumno.php?idAlumno='.$id_alumno.'";</script>';
														pg_query("ROLLBACK");
		}
	}else{
		echo '<script language="JavaScript"> 			alert("Las contraseña no es correcta, vuelva a ingresar su contraseña actual");
														location ="cambiarPasswordAlumno.php?idAlumno='.$id_alumno.'";</script>';
	}
?>