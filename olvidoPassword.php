<?php
$correo = $_REQUEST['mail'];


include_once "conexionBaseDatos.php";
$controlEmpresa = 0;
$controlAlumno = 0;
$mismoMail = 2;
$correcto = 0;
$empresa=pg_query("SELECT * FROM empresa WHERE UPPER(mail_empresa)   LIKE UPPER('{$_POST['mail']}')");
while($row=pg_fetch_array($empresa,NULL,PGSQL_ASSOC)){
$id_empresa = $row['id_empresa'];
$usuario_empresa = $row['usuario_empresa'];
$password_empresa = $row['password_empresa'];
$mail_empresa = $row['mail_empresa'];
if ($correo == $mail_empresa){
	$controlEmpresa = 1;
	$controlAlumno = 0;
	$mismoMail--;
	$correcto = 1;
	}
}
$alumno=pg_query("SELECT * FROM alumno WHERE UPPER(mail_alumno)   LIKE UPPER('{$_POST['mail']}')");
while($row=pg_fetch_array($alumno,NULL,PGSQL_ASSOC)){
$id_alumno = $row['id_alumno'];
$usuario_alumno = $row['usuario_alumno'];
$password_alumno = $row['password_alumno'];
$mail_alumno = $row['mail_alumno'];
	if ($correo == $mail_alumno){
	$controlEmpresa = 0;
	$controlAlumno = 1;
	$mismoMail--;
	$correcto = 1;
	}
}
require ("PHPMailer_5.2.1/class.phpmailer.php");



		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "ssl"; 
		$mail->Host = "smtp.gmail.com"; // dirección del servidor
		$mail->Username = "extensionfrvm@gmail.com"; // Usuario
		$mail->Password = "4537500frvm"; // Contraseña
		$mail->Port = 465; // Puerto a utilizar
		$mail->From = "s_extension@frvm.utn.edu.ar"; // dirección remitente
		$mail->FromName = "Extension"; // nombre remitente
		if ($controlEmpresa == 1 && $controlAlumno == 0 && $mismoMail == 1){
			$mail->AddAddress($correo,''); // Esta es la dirección a donde enviamos
		}
		if ($controlEmpresa == 0 && $controlAlumno == 1 && $mismoMail == 1){
			$mail->AddAddress($correo,''); // Esta es la dirección a donde enviamo
		}
		if ($mismoMail == 0){
			$mail->AddAddress($correo,''); // Esta es la dirección a donde enviamo
		}
		//$mail->AddCC("cuenta@dominio.com"); // Copia
		//$mail->AddBCC("cuenta@dominio.com"); // Copia oculta
		$mail->IsHTML(true); // El correo se envía como HTML
		$mail->Subject = "Datos Login"; // Asunto
		$body0 = '<FONT FACE="cambria" SIZE=4>Sus datos para loguearse son: </FONT>';
		if ($controlEmpresa == 1 && $controlAlumno == 0 && $mismoMail == 1){
			$body1 .= "<br>";
			$body2 .= "<u>Usuario:</u> <strong>$usuario_empresa</strong>\n<br />";
			$body3 .= "<u>Contrase&ntilde;a:</u> <strong>$password_empresa</strong>";
			$body4 .= "</p>";
		}
		if ($controlEmpresa == 0 && $controlAlumno == 1 && $mismoMail == 1){		
			$body1 .= "<p>";
			$body2 .= "<u>Usuario:</u> <strong>$usuario_alumno</strong>\n<br />";
			$body3 .= "<u>Contrase&ntilde;a:</u> <strong>$password_alumno</strong>";
			$body4 .= "</p>";
		}
		if ($mismoMail == 0){
			$body1 .= "<br>";
			$body2 .= "<u>Usuario Empresa:</u> <strong>$usuario_empresa</strong>\n<br />";
			$body3 .= "<u>Contrase&ntilde;a Empresa:</u> <strong>$password_empresa</strong>";
			$body4 .= "</p>";
			$body5 .= "<p>";
			$body6 .= "<u>Usuario Alumno:</u> <strong>$usuario_alumno</strong>\n<br />";
			$body7 .= "<u>Contrase&ntilde;a Alumno:</u> <strong>$password_alumno</strong>";
			$body8 .= "</p>";
		}
		$enter = '<br>';
		$body = $body0.$enter.$body1.$enter.$body2.$enter.$body3.$enter.$body4.$enter.$body5.$enter.$body6.$enter.$body7.$enter.$body8;
		$mail->Body = $body; // Mensaje a enviar
		//$mail->AltBody = "Hola mundo. Esta es la primer línean Acá continuo el mensaje"; // cuerpo alternativo del mensaje
		//$mail->AddAttachment("imagenes/imagen.jpg", "imagen.jpg");
		$exito = $mail->Send(); // Envía el correo.



if ($correcto == 1){
if($exito){
	echo '<script language="JavaScript"> 
		alert("Verifique su casilla de correo, le hemos enviado un mail.");
		location ="login.php";
		</script>';	
}else{
	echo '<script language="JavaScript"> 
		alert("No se puedo enviar el corre, comuniquese con el administrador");
		location ="login.php";
		</script>';
}
}else{
	
	echo '<script language="JavaScript"> 
		alert("El mail ingresado no pertenece a ningun usuario, verifique que lo ingreso bien.");
		location ="pedirMail.php?correo='.$correo.'";
		</script>';
}