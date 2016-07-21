<?php
include_once "conexionBaseDatos.php";
$id_Alumno = $_REQUEST['idAlumno'];
$eliminar = $_REQUEST['eliminar'];
$idEliminarAL = $_REQUEST['idEliminarAL'];
$idEliminarCP = $_REQUEST['idEliminarCP'];
$idEliminarCS = $_REQUEST['idEliminarCS'];

echo 'id_Alumno: '.$id_Alumno;

if ($eliminar == 1){
	pg_query("DELETE FROM antecedentes_laborales WHERE id_antecedentes_laborales = $idEliminarAL");
}
if ($eliminar == 2){
	pg_query("DELETE FROM conocimientos_pc WHERE id_conocimientos_pc = $idEliminarCP");
}
if ($eliminar == 3){
	pg_query("DELETE FROM cursos_seminarios WHERE id_cursos_seminarios = $idEliminarCS");
}


echo '<script type="text/javascript">
		window.location="datosExtra.php?control=5&idAlumno='.$id_Alumno.'";
	 </script>';
	 
//control igual a 5 para que sea distinto a los otros controles que hay y que entre al else
?>
