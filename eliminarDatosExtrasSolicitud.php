<?php
include_once "conexionBaseDatos.php";
$id_Solicitud = $_REQUEST['idSolicitud'];
$id_empresa = $_REQUEST['idEmpresa'];
$eliminar = $_REQUEST['eliminar'];
$idEliminarTD = $_REQUEST['idEliminarTD'];
$idEliminarE = $_REQUEST['idEliminarE'];
$idEliminarOC = $_REQUEST['idEliminarOC'];
$idEliminarOB = $_REQUEST['idEliminarOB'];


if ($eliminar == 1){
	pg_query("DELETE FROM tareas_a_desempeniar WHERE id_tareas_a_desempeniar = $idEliminarTD");
}
if ($eliminar == 2){
	pg_query("DELETE FROM experiencia WHERE id_experiencia = $idEliminarE");
}
if ($eliminar == 3){
	pg_query("DELETE FROM otros_conocimientos WHERE id_otros_conocimientos = $idEliminarOC");
}
if ($eliminar == 4){
	pg_query("DELETE FROM otros_beneficios WHERE id_otros_beneficios = $idEliminarOB");
}


echo '<script type="text/javascript">
		window.location="solicitudDatosExtras.php?control=5&idEmpresa='.$id_empresa.'&idSolicitud='.$id_Solicitud.'";
	 </script>';
	 
//control igual a 5 para que sea distinto a los otros controles que hay y que entre al else
?>
