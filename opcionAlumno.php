<style type="text/css">
	label {font-family: Cambria; padding: .5em; }
	#tabla {padding: 50px; border: 1px Solid #D8D8D8;}
	.tabla1 { color: #333377;padding: 6px;margin-left: 16%; margin-right: 20%;margin-top: 150px;border:2px groove #C8C8F2;line-height: 1.5em;white-space: nowrap;}
	.perfil1 { color: #333377;border:2px groove #C8C8F2;line-height: 1.5em;white-space: nowrap;}
</style>
<?php
$id_alumno = $_REQUEST['idAlumno'];
include_once 'conexionBaseDatos.php';

$val = pg_query("SELECT * FROM alumno WHERE id_alumno = $id_alumno");
while($row=pg_fetch_array($val,NULL,PGSQL_ASSOC)){
	$usuario = $row['usuario_alumno'];

}

echo '<table id="perfil" class="perfil1">';
	echo '<tr>';
		echo '<td align="center"><label><strong>'.$usuario.'</strong></font></td>';
		echo '<td align="center"><a href="perfilAlumno.php?idAlumno='.$id_alumno.'"><input type="image" src="perfil.png" width="40" height="40" value="Registrar Solicitud" /></a></td>';
	echo '</tr>';
echo '</table>';
echo '<br>';
echo '<center><a href="login.php"><input type="button" value="Salir"/></a></center>';
?>
