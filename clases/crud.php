<?php 

	class crud{
		public function agregar($datos){
			$obj= new conectar();
			$conexion=$obj->conexion();
			
			$sql="INSERT INTO queja(fecha_queja,detalle_queja,no_factura,fecha_factura,id_sucursal,status)
											values (NOW(),
											'$datos[2]',
											'$datos[0]',
											'$datos[1]',
											'$datos[3]',
                                            '1');";
            
			//mysqli_query($conexion,$sql);

			//$id = mysqli_insert_id($conexion);

			//$sql1 = "INSERT INTO HISTORIAL_ENTREGA (ID_ACTIVO,FECHA,ENCARGADO_ACTUAL) VALUES ('$id',NOW(),'$datos[12]');";
			
			return mysqli_query($conexion,$sql);

		}

		public function obtenDatos($idactivo){
			$obj= new conectar();
			$conexion=$obj->conexion();

			$sql = "SELECT id_sucursal from sucursal where id_sucursal = '$idactivo'";
			$result=mysqli_query($conexion,$sql);
			$ver=mysqli_fetch_row($result);

			$datos=array(
				'id_activo' => $ver[0],
				'nombre_activo' => $ver[1],
				'marca' => $ver[2],
				'modelo' => $ver[3],
				'caracteristicas' => $ver[4],
				'observacion' => $ver[5],
				'ubicacion' => $ver[6],
				'estatus' => $ver[7],
				'encargado_actual' => $ver[8]
				);
			return $datos;
		}

		public function actualizar($datos){
			
			$obj= new conectar();
			$conexion=$obj->conexion();

			$sql = "UPDATE ACTIVO set NOMBRE_ACTIVO = '$datos[0]',
									  MARCA = '$datos[1]',
									  MODELO = '$datos[2]',
									  CARACTERISTICAS = '$datos[3]',
									  OBSERVACION = '$datos[4]',
									  UBICACION = '$datos[5]',
									  ESTATUS = '$datos[6]'
					where ID_ACTIVO = '$datos[8]';";
			
			//mysql_query($conexion,$sql);

			$sql .= "UPDATE HISTORIAL_ENTREGA set ENCARGADO_ACTUAL = '$datos[7]' where ID_ACTIVO = '$datos[8]';";


			/* ejecutar multi consulta */
			if (mysqli_multi_query($conexion, $sql)) {

			    do {
			        /* almacenar primer juego de resultados */
			        if ($result = mysqli_store_result($conexion)) {
			            
			            mysqli_free_result($result);

			        }
			        return mysqli_next_result($conexion);
			        
			    } while (mysqli_next_result($conexion));
   
			}
			
		}
	}
 ?>