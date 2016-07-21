<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<script src="jquery-latest.js"></script>
	<script type="text/javascript" src="jquery.validate.js"></script>
	<title>Listado de empresa</title>
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
		<td id="titulo3" colspan="7" align="center">
			<l1>Listado de Empresas</l1>
		</td>
	</tr>
	<tr align="center" bgcolor="#1C1C1C">
		<td id="titulo2">
			<label>Razon Social</label>
		</td>
		<td id="titulo2">
			<label>CUIT</label>
		</td>
		<td id="titulo2">
			<label>Localidad</label>
		</td>
		<td id="titulo2">
			<label>Nombre Encargado</label>
		</td>
		<td id="titulo2">
			<label>Puesto Encargado</label>
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
	$control = $_REQUEST['controlHabilitar'];
	
	$sqlempresa = pg_query("SELECT * FROM empresa ORDER BY razon_social ASC");
	
	while($rowempresa=pg_fetch_array($sqlempresa)){
	
	
		echo '<tr>';
			echo '<td id="titulo">';
				echo '<l2>'.$rowempresa['razon_social'].'</l2>';
			echo '</td>';
			echo '<td id="titulo">';
				echo '<l2>'.$rowempresa['cuit'].'</l2>';
			echo '</td>';
			echo '<td id="titulo">';
				echo '<l2>'.$rowempresa['localidad_empresa'].'</l2>';
			echo '</td>';
			echo '<td id="titulo">';
				echo '<l2>'.$rowempresa['nombre_encargado'].'</l2>';
			echo '</td>';
			echo '<td>';
				echo '<l3>'.$rowempresa['puesto_encargado'].'</l3>';
			echo '</td>';
			echo '<td id="titulo4" align="center">';
				echo '<a href="perfilEmpresaFacu.php?idEmpresa='.$rowempresa['id_empresa'].'"><input type="image" src="empresa1.png" width="40" height="40" value="Perfil" /></a>';
			echo '</td>';
			echo '<td id="titulo4" align="center">';
			if ($rowempresa['habilitar_empresa'] == "f"){
				echo '<a href="habilitarEmpresa.php?controlHabilitar=0&idEmpresa='.$rowempresa['id_empresa'].'"><input type="image" src="bred.png" width="40" height="40" value="Habilitada"/></a>';
			}else{
				echo '<a href="habilitarEmpresa.php?controlHabilitar=1&idEmpresa='.$rowempresa['id_empresa'].'"><input type="image" src="bgreen.png" width="40" height="40" value="Habilitada"/></a>';
			}
			echo '</td>';
		echo '</tr>';
	}	
	?>
</table>
</div>
</body>
</html>