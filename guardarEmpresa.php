<?php

$razonSocial = $_REQUEST['razonSocial'];
$cuit1 = $_REQUEST['cuit1'];
$cuit2 = $_REQUEST['cuit2'];
$cuit3 = $_REQUEST['cuit3'];
$cuit = $cuit1.'-'.$cuit2.'-'.$cuit3;
$direccion = $_REQUEST['direccion'];
$localidad = $_REQUEST['localidad'];
$cp = $_REQUEST['cp'];
$caracteristicaTel = $_REQUEST['caracteristicaTel'];
$tel = $_REQUEST['telefono'];
$telefono = $caracteristicaTel.'-'.$tel;
$caracteristicaFax = $_REQUEST['caracteristicaFax'];
$numFax = $_REQUEST['fax'];
$fax = $caracteristicaFax.'-'.$numFax;
$mail = $_REQUEST['mail'];
$nombre = $_REQUEST['nombre'];
$apellido = $_REQUEST['apellido'];
$nombreEncargado = $nombre.' '.$apellido;
$puesto = $_REQUEST['puesto'];
$tipo_dni = $_REQUEST['dni'];
$num_dni = $_REQUEST['numDNI'];
$caracteristicaCelSolicitante = $_REQUEST['caracCelSolicitante'];
$numCelSolicitante = $_REQUEST['celularSolicitante'];
$celularSolicitante = $caracteristicaCelSolicitante.'-'.$numCelSolicitante;
$caracteristicaTelSolicitante = $_REQUEST['caracTelSolicitante'];
$numTelSolicitante = $_REQUEST['telfijoSolicitante'];
$telFijoSolicitante = $caracteristicaTelSolicitante.'-'.$numTelSolicitante;
$diaEntrevista = $_REQUEST['diaEntrevista'];
$mesEntrevista = $_REQUEST['mesEntrevista'];
$anioEntrevista = $_REQUEST['anioEntrevista'];
$fechaEntrevista = $diaEntrevista.'-'.$mesEntrevista.'-'.$anioEntrevista;
$hora = $_REQUEST['hora'];
$min = $_REQUEST['min'];
$horaEntrevista = $hora.':'.$min;
$tutor = $_REQUEST['tutor'];
$usuario = $_REQUEST['usuario'];
$password = $_REQUEST['password'];

$s = '/-/';
$pasarDatos = $razonSocial.$s.$cuit1.$s.$cuit2.$s.$cuit3.$s.$direccion.$s.$localidad.$s.$cp.$s.$caracteristicaTel.$s.$tel.$s.$telefono.$s.$caracteristicaFax.$s.$numFax.$s.$fax.$s.$mail.$s.$nombre.$s.$apellido.$s.$puesto.$s.$tipo_dni.$s.$num_dni.$s.$caracteristicaCelSolicitante.$s.$numCelSolicitante.$s.$caracteristicaTelSolicitante.$s.$numTelSolicitante.$s.$diaEntrevista.$s.$mesEntrevista.$s.$anioEntrevista.$s.$hora.$s.$min.$s.$tutor;

include_once "conexionBaseDatos.php";

$sqlControl=pg_query("SELECT count(id_empresa) AS contar FROM empresa WHERE UPPER(usuario_empresa) = UPPER('$usuario');");
$rowControl = pg_fetch_array($sqlControl);
$control = $rowControl['contar'];
if($control==0){

$empresa = "INSERT INTO empresa(razon_social,direccion_empresa,localidad_empresa,cp,telefono_empresa,fax,mail_empresa,nombre_encargado,puesto_encargado,tipo_dni_encargado,num_dni_encargado,telefono_encargado,celular_encargado,dia_entrevista,hora_entrevista,tutor_empresa,cuit,usuario_empresa,password_empresa) VALUES('$razonSocial','$direccion','$localidad','$cp','$telefono','$fax','$mail','$nombreEncargado','$puesto','$tipo_dni','$num_dni','$telFijoSolicitante','$celularSolicitante','$fechaEntrevista','$horaEntrevista','$tutor','$cuit','$usuario','$password')";


$error=0;

	if (!pg_query($cnx,$empresa)) 
	 {
     $errorpg = pg_last_error($cnx);
     $termino = "ROLLBACK";
     $error=1;
	 }
     else
     {
     $termino = "COMMIT";
     }
   pg_query($termino);
		
if ($error==1)

		{
		echo '<script language="JavaScript"> 			alert("Los datos no se guardaron correctamente. Pongase en contacto con el administrador");</script>';
		}else
		{
		echo '<script language="JavaScript"> 
			alert("Los datos se guardaron correctamente.");</script>';
			}
		echo '<script language="JavaScript"> 
		location ="login.php";
		</script>';

}else{
	echo '<script language="JavaScript"> 			alert("Ya existe un usuario");</script>';
		echo '<script language="JavaScript"> 
		location ="nuevaEmpresa.php?usado=1&pasarDatos='.$pasarDatos.'";
		</script>';
}


?>