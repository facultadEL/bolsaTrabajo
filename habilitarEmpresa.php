<?php 
include 'conexionBaseDatos.php';
$control = $_REQUEST['controlHabilitar'];
$idEmpresa = $_REQUEST['idEmpresa'];

if ($control == 1){
	pg_query("UPDATE empresa SET habilitar_empresa=FALSE WHERE $idEmpresa = id_empresa;");
}else{
	pg_query("UPDATE empresa SET habilitar_empresa=TRUE WHERE $idEmpresa = id_empresa;");
	
}
echo '<script type="text/javascript">window.location="listadoEmpresa.php?idEmpresa='.$idEmpresa.'"</script>';
?>