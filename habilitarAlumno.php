<?php 
include 'conexionBaseDatos.php';
$control = $_REQUEST['controlHabilitar'];
$idAlumno = $_REQUEST['idAlumno'];

if ($control == 1){
	pg_query("UPDATE alumno SET habilitar_alumno=FALSE WHERE $idAlumno = id_alumno;");
}else{
	pg_query("UPDATE alumno SET habilitar_alumno=TRUE WHERE $idAlumno = id_alumno;");
	
}
echo '<script type="text/javascript">window.location="listadoAlumnos.php?idAlumno='.$idAlumno.'"</script>';
?>