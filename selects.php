<?php
require_once "clases/conexion.php";

$departamentos = filter_input(INPUT_POST, 'departamentos'); 


$obj = new conectar();
$conexion=$obj->conexion();

$result = mysqli_query($conexion,"SELECT id_municipio, nombre_municipio from municipio where id_departamento='$departamentos'");

//$extraer = mysqli_fetch_row($result);

    echo '<option value="0">Seleccione una opción</option>';

while ($extraer = mysqli_fetch_row($result)) {

    echo '<option value="'.$extraer[0].'">'.$extraer[1].'</option>';

}
      
    



?>


	
