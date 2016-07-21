<?php
	$id_empresa = $_REQUEST['idEmpresa'];
	$password_repetido = $_REQUEST['passwordRepetido'];
	$password_nuevo = $_REQUEST['passwordNuevo'];
	$password_anterior = $_REQUEST['passwordAnterior'];
	
	$iguales= strcmp( $password_repetido, $password_nuevo );

	include_once "conexionBaseDatos.php";
	$consulta = pg_query("SELECT * FROM empresa WHERE id_empresa = $id_empresa");
	$row = pg_fetch_array($consulta,NULL,PGSQL_ASSOC);
	$password_empresa = $row['password_empresa'];
	
	$iguales1 = strcmp( $password_empresa, $password_anterior );
	if ($iguales1 == 0){
		if ($iguales == 0){
			$password = $password_nuevo;
			pg_query("UPDATE empresa SET password_empresa='$password' WHERE id_empresa = $id_empresa");
			echo '<script language="JavaScript"> 			alert("El cambio se realizo correctamente");
														location ="perfilEmpresa.php?idEmpresa='.$id_empresa.'";</script>';
														pg_query("COMMIT");
		}else{
			echo '<script language="JavaScript"> 			alert("Las contraseñas no coinciden");
														location ="cambiarPasswordEmpresa.php?idEmpresa='.$id_empresa.'";</script>';
														pg_query("ROLLBACK");
		}
	}else{
		echo '<script language="JavaScript"> 			alert("Las contraseña no es correcta, vuelva a ingresar su contraseña actual");
														location ="cambiarPasswordEmpresa.php?idEmpresa='.$id_empresa.'";</script>';
	}
?>