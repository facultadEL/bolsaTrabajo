<?php
$usuario = $_REQUEST['usuario'];
$password = $_REQUEST['password'];
echo 'usuario: '.$usuario.'<br>';
echo 'password: '.$password.'<br>';



include_once "conexionBaseDatos.php";
$controlEmpresa = 0;
$controlAlumno = 0;
$noHabilitar = 0;
//verifico si hay una empresa con los datos del login
//$empresa=pg_query("SELECT * FROM empresa WHERE UPPER(usuario_empresa)   LIKE UPPER('{$_POST['usuario']}') AND UPPER(password_empresa)  LIKE UPPER('{$_POST['password']}')");
$empresa=pg_query("SELECT * FROM empresa WHERE UPPER(usuario_empresa)   LIKE UPPER('{$_REQUEST['usuario']}') AND UPPER(password_empresa)  LIKE UPPER('{$_REQUEST['password']}')");
while($rowE=pg_fetch_array($empresa,NULL,PGSQL_ASSOC)){
$id_empresa = $rowE['id_empresa'];
$habilitarEmpresa = $rowE['habilitar_empresa'];
if ($usuario == $rowE['usuario_empresa'] && $password == $rowE['password_empresa']){
	$controlEmpresa = 1;
	}
}
//verifico si hay un alumno con los datos del login
//$alumno=pg_query("SELECT * FROM alumno WHERE UPPER(usuario_alumno)   LIKE UPPER('{$_POST['usuario']}') AND UPPER(password_alumno)  LIKE UPPER('{$_POST['password']}')");
$alumno=pg_query("SELECT * FROM alumno WHERE UPPER(usuario_alumno)   LIKE UPPER('{$_REQUEST['usuario']}') AND UPPER(password_alumno)  LIKE UPPER('{$_REQUEST['password']}')");
while($rowA=pg_fetch_array($alumno,NULL,PGSQL_ASSOC)){
$id_alumno = $rowA['id_alumno'];
$habilitarAlumno = $rowA['habilitar_alumno'];
if ($usuario == $rowA['usuario_alumno'] && $password == $rowA['password_alumno']){
	$controlAlumno = 1;
	}
}

	if ($controlEmpresa == 1 && $controlAlumno == 0 && $habilitarEmpresa == "t"){
		echo '<script language="JavaScript"> location ="opcionEmpresa.php?idEmpresa='.$id_empresa.'";	</script>';
	}else{
		$noHabilitar = 1;
	}

	if ($controlEmpresa == 0 && $controlAlumno == 1 && $habilitarAlumno == "t"){
		echo '<script language="JavaScript"> location ="opcionAlumno.php?idAlumno='.$id_alumno.'";	</script>';
	}else{
		$noHabilitar = 1;
	}

if ($controlEmpresa == 0 && $controlAlumno == 0){
		echo '<script language="JavaScript"> alert("No se encuentra registrado");</script>';
		echo '<script language="JavaScript"> location ="login.php"	</script>';
	}
if ($noHabilitar == 1){
		echo '<script language="JavaScript"> alert("Sus datos estan siendo evaluados. Espere su habilitación");</script>';
		echo '<script language="JavaScript"> location ="login.php"	</script>';
}
?>