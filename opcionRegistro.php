<html>
<head>
	<title>Registrar</title>
	<style type="text/css">
	label {font-family: Cambria; text-transform: capitalize; padding: .5em; }
	#tabla {padding: 50px; border: 1px Solid #D8D8D8;}
	.tabla1 { color: #333377;padding: 6px;margin-left: 16%; margin-right: 20%;margin-top: 50px;border:2px groove #C8C8F2;line-height: 1.5em;white-space: nowrap;}
	.perfil1 { color: #333377;border:2px groove #C8C8F2;line-height: 1.5em;white-space: nowrap;}
	</style>
</head>
<body>
	<?php
	echo '<table id="tabla" class="tabla1">';
		echo '<tr>';
			echo '<td align="center"><label><strong>Registrar Alumno</strong></font></td>';
			echo '<td align="center"><label><strong>Registrar Empresa</strong></font></td>';
		echo '</tr>';
		echo '<tr>';
			echo '<td align="center"><a href="nuevoAlumno.php"><input type="image" src="perfil.png" width="70" height="70" value="Registrar Solicitud" /></a></td>';
			echo '<td align="center"><a href="nuevaEmpresa.php"><input type="image" src="empresa1.png" width="70" height="70" value="Listado Solicitudes" /></a></td>';
		echo '</tr>';
	echo '</table>';
	echo '<br>';
	echo '<center><a href="login.php"><input type="button" value="Atr&aacute;s"/></a></center>';
	?>
</body>
</html>