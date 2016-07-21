<html>
<head>
	<link rel="stylesheet" type='text/css' href="boton.css">
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />	
	<script src="jquery-latest.js"></script>
	<script type="text/javascript" src="jquery.validate.js"></script>
	<title>Listado de Solicitudes</title>
	<style type="text/css">
			{font-family: Cambria}
			#tabla {background: #F2F2F2;}
			#titulo { border-right: 2px solid #BDBDBD;padding: 3px; text-align: center;}
			#titulo3 { border-top: 2px solid #BDBDBD;border-bottom: 2px solid #BDBDBD;padding: 3px;}
			#titulo4 {border-left: 2px solid #BDBDBD;padding: 3px;}
			#titulo2 { border-bottom: 2px solid #BDBDBD;padding: 3px;}
			#titulo5 { text-align: center;padding: 3px;}
			label {font-family: Cambria; text-transform: capitalize; padding: .5em; color: #0080FF;}
			l1 {font-family: Cambria;color: #0B615E; text-transform: capitalize; font-size: 1.5em;}
			l2 {font-family: Cambria;color: #424242; text-transform: capitalize; padding: .12em;}
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
			<l1>Listado de Solicitudes</l1>
		</td>
	</tr>
	<tr align="center" bgcolor="#1C1C1C">
		<td id="titulo2">
			<label>Tipo de Trabajo</label>
		</td>
		<td id="titulo2">
			<label>Perfil</label>
		</td>
		<td id="titulo2">
			<label>&Aacute;rea de la Empresa</label>
		</td>
		<td id="titulo2">
			<label>Ver Solicitud</label>
		</td>
	</tr>
	<?php
	
	include_once "conexionBaseDatos.php";
	
	$id_empresa = $_REQUEST['idEmpresa'];
	$pasar = $_REQUEST['idPasar'];
	$sep = '/-/';
	if ($id_empresa <> ''){
	$solicitud = pg_query("SELECT * FROM solicitud WHERE empresa_solicitud = $id_empresa ORDER BY id_solicitud ASC");
	}else{	
	$mostrar = explode($sep,$pasar);
	$id_solicitud = $mostrar[0];
	$id_empresa = $mostrar[1];
	$solicitud = pg_query("SELECT * FROM solicitud WHERE empresa_solicitud = $id_empresa ORDER BY id_solicitud ASC");
	}	
	
	while($rowSolicitud=pg_fetch_array($solicitud)){
	$tipoTrabajo = $rowSolicitud['tipo_trabajo_solicitud'];
	$ver = "&nbsp;"."N&deg;&nbsp;".$rowSolicitud['id_solicitud']."&nbsp;";
	$id_solicitud = $rowSolicitud['id_solicitud'];
	$pasar = $id_solicitud.$sep.$id_empresa;
	
		echo '<tr height="50">';
			echo '<td id="titulo">';
				echo '<l2>';
					$tipo=pg_query("SELECT * FROM tipo_trabajo");
					while($rowTipo=pg_fetch_array($tipo,NULL,PGSQL_ASSOC)){
                                $idTipo = $rowTipo['id_tipo_trabajo'];
								if($idTipo == $tipoTrabajo){
									echo $rowTipo['nombre_tipo_trabajo']; 
								}
                            }
					 '</l2>';
			echo '</td>';
			echo '<td id="titulo">';
				echo '<l2>'.$rowSolicitud['perfil'].'</l2>';
			echo '</td>';
			echo '<td id="titulo5">';
				echo '<l3>'.$rowSolicitud['area_empresa'].'</l3>';
			echo '</td>';
			echo '<td id="titulo4" align="center">';
				echo '<a href="verSolicitud.php?idPasar='.$pasar.'" class="boton3">'.$ver.'</a>';
			echo '</td>';
		echo '</tr>';
	}
	?>
</table>
<br>
<center><a href="opcionEmpresa.php?idEmpresa=<?php echo $id_empresa;?>"><input type="button" name="volver" value="Atr&aacute;s"/></a></center>
</div>
</body>
</html>