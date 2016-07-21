<style type="text/css">
	label {font-family: Cambria; text-transform: capitalize; padding: .5em; }
	#tabla {padding: 50px; border: 1px Solid #D8D8D8;}
	.tabla1 { color: #333377;padding: 6px;margin-left: 16%; margin-right: 20%;margin-top: 150px;border:2px groove #C8C8F2;line-height: 1.5em;white-space: nowrap;}
	.perfil1 { color: #333377;border:2px groove #C8C8F2;line-height: 1.5em;white-space: nowrap;}
</style>
<?php
$id_empresa = $_REQUEST['idEmpresa'];
include_once 'conexionBaseDatos.php';

$val = pg_query("SELECT * FROM empresa WHERE id_empresa = $id_empresa");
while($row=pg_fetch_array($val,NULL,PGSQL_ASSOC)){
	$usuario = $row['usuario_empresa'];

}

echo '<table id="perfil" class="perfil1">';
	echo '<tr>';
		echo '<td align="center"><label><strong>'.$usuario.'</strong></font></td>';
		echo '<td align="center"><a href="perfilEmpresa.php?idEmpresa='.$id_empresa.'"><input type="image" src="empresa1.png" width="40" height="40" value="Registrar Solicitud" /></a></td>';
	echo '</tr>';
echo '</table>';
echo '<table id="tabla" class="tabla1">';
	echo '<tr>';
		echo '<td align="center"><label><strong>Realizar Solicitud</strong></font></td>';
		echo '<td align="center"><label><strong>Listado de Solicitudes</strong></font></td>';
	echo '</tr>';
	echo '<tr>';
		echo '<td align="center"><a href="nuevaSolicitud.php?idEmpresa='.$id_empresa.'"><input type="image" src="solicitud.png" width="50" height="50" value="Registrar Solicitud" /></a></td>';
		echo '<td align="center"><a href="listadoSolicitudes.php?idEmpresa='.$id_empresa.'"><input type="image" src="listado.png" width="50" height="50" value="Listado Solicitudes" /></a></td>';
	echo '</tr>';
echo '</table>';
echo '<br>';
echo '<center><a href="login.php"><input type="button" value="Salir"/></a></center>';

?>
