<?php
$id_empresa = $_REQUEST['idEmpresa'];
$fecha = $_REQUEST['fecha'];
$razonSocial = $_REQUEST['razonSocial'];
$cuit = $_REQUEST['cuit'];
$direccion = $_REQUEST['direccion'];
$localidad = $_REQUEST['localidad'];
$cp = $_REQUEST['cp'];
$telefono = $_REQUEST['telefono'];
$fax = $_REQUEST['fax'];
$mail = $_REQUEST['mail'];
$nombreEncargado = $_REQUEST['nombre_apellido'];
$puesto = $_REQUEST['puesto'];
$tipo_dni = $_REQUEST['dni'];
$num_dni = $_REQUEST['numDNI'];
$celularSolicitante = $_REQUEST['celularSolicitante'];
$telFijoSolicitante = $_REQUEST['telFijoSolicitante'];
$fechaEntrevista = $_REQUEST['fechaEntrevista'];
$horaEntrevista = $_REQUEST['horaEntrevista'];
$tutor = $_REQUEST['tutor'];
$usuario = $_REQUEST['usuario'];
$password = $_REQUEST['password'];

include_once "conexionBaseDatos.php";

$empresa = ("UPDATE empresa SET fecha='$fecha',razon_social='$razonSocial',direccion_empresa='$direccion',localidad_empresa='$localidad',cp='$cp',telefono_empresa='$telefono',fax='$fax',mail_empresa='$mail',nombre_encargado='$nombreEncargado',puesto_encargado='$puesto',tipo_dni_encargado='$tipo_dni',num_dni_encargado='$num_dni',telefono_encargado='$telFijoSolicitante',celular_encargado='$celularSolicitante',dia_entrevista='$fechaEntrevista',hora_entrevista='$horaEntrevista',tutor_empresa='$tutor',cuit='$cuit', usuario_empresa = '$usuario', password_empresa = '$password'");
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
		}else{
			echo '<script language="JavaScript"> 
			alert("Los datos se guardaron correctamente.");
			location ="perfilEmpresa.php?idEmpresa='.$id_empresa.'";
			</script>';
			}

?>