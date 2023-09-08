<?php
    //session_start();
    $id_municipio = $_POST['municipios'];
    $nit = $_POST['nit'];

    require_once "clases/conexion.php";
    $obj = new conectar();
    $conexion=$obj->conexion();
    if ($id_municipio != NULL && $nit != NULL){
      $result = mysqli_query($conexion,"SELECT S.id_comercio,S.nombre_sucursal,S.direccion, C.nit_comercio, S.id_sucursal from sucursal S, comercio C where S.id_municipio = '$id_municipio' and C.nit_comercio = '$nit' and S.id_comercio = C.id_comercio");
    }    
    $extraer = mysqli_fetch_row($result);

    ?>

    <div class="table-responsive">
      <table id="iddatatable" class="table table-hover table-condensed table-striped active " style="text-align:center;">
        <thead>
          <tr>
            <th scope="col-xl-2">Nombre de Sucursal</th>
            <th scope="col-xl-2">Dirección</th>
            <th scope="col">Opciones</th>            
          </tr>
        </thead>

        <tbody>
    
          <?php for($i=0;$i<$extraer;$i++) { ?>
          <tr>              
              <td><?php echo$extraer[1];?></td>
              <td><?php echo$extraer[2];?></td>
              <td style="text-align: center;">
              <!--<span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#agregarnuevo" onclick="agregaFrmActualizar('<?php //echo $extraer[4] ?>')">-->
              <span class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarnuevo" onclick="id_sucursal(<?php echo $extraer[4] ?>)">
                <span class="fa fa-pencil-square-o">Poner Queja</span>
              </span>
              <input type="text" name="sucursal" id="sucursal" hidden value="<?php echo $extraer[4] ?>">
            </td>
            <!--icono boton eliminar
            <td style="text-align: center;">
              <span class="btn btn-danger btn-sm" onclick="eliminarDatos('<?php //echo $mostrar[0] ?>')">
                <span class="fa fa-trash"></span>
              </span>
            </td>-->
          </tr>
          <?php $extraer = mysqli_fetch_row($result);}?>
        </tbody>
      </table>
    </div>

<script type="text/javascript">
    function paraAgregar(id) {
        $.ajax({
            type: "POST",
            url: "datos.php",
            data: "sucursal=" + id,
            success: function (r) {
                if(r==1){
                    alert("funciona");
                }
                
            }
        });
    }
</script>

  <script type="text/javascript">
        $(document).ready(function() {
        $('#iddatatable').DataTable();
        } );
    </script>


