<?php 
	require_once "../clases/conexion.php";
	require_once "../clases/crud.php";
	$obj= new crud();

	$datos=array(
		$_POST['noFac'],
		$_POST['fechaDoc'],
		$_POST['queja'],
		$_POST['idsucursal']
				);


	echo $obj->agregar($datos);
 ?>