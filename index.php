<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quejas Diaco</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
    </script>
    <script src="librerias/alertifyjs/alertify.min.js"></script>
    <!-- include the style -->
    <link rel="stylesheet" href="librerias/alertifyjs/css/alertify.min.css" />
    <!-- include a theme -->
    <link rel="stylesheet" href="librerias/alertifyjs/css/themes/default.min.css" />
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>

</head>

<body>
    <nav>
        <div class="encabezado">Registro de quejas DIACO</div>
    </nav>
    <section class="buscar-comercio">
        <br>
        <center><p>Ingrese el nit y ubicación del comercio</p></center>
        <div class="">
        <div class="formBusqueda">
        <form id="formularioBuscar" method="POST">
            <label for="nit">Nit</label>
            <input type="text" id="nit" name="nit" placeholder="12345678-9" class="form-control" col="">
            <br>
            <select id="departamentos" name="departamentos" class="form-select">
                <option value="0" selected="">Seleccione departamento</option>
                <option value="1">Alta Verapaz</option>
                <option value="2">Baja Verapaz</option>
                <option value="3">Chimaltenango</option>
                <option value="4">Chiquimula</option>
                <option value="5">El Progreso</option>
                <option value="6">Escuintla</option>
                <option value="7">Guatemala</option>
                <option value="8">Huehuetenango</option>
                <option value="9">Izabal</option>
                <option value="10">Jalapa</option>
                <option value="11">Jutiapa</option>
                <option value="12">Petén</option>
                <option value="13">Quetzaltenango</option>
                <option value="14">Quiché</option>
                <option value="15">Retalhuleu</option>
                <option value="16">Sacatepequez</option>
                <option value="17">San Marcos</option>
                <option value="18">Santa Rosa</option>
                <option value="19">Sololá</option>
                <option value="20">Suchitepéquez</option>
                <option value="21">Totonicapán</option>
                <option value="22">Zacapa</option>
            </select>
            <br>
            <select id="municipios" name="municipios" class="form-select">
                <option value="0">Selecciona un municipio</option>
            </select>
            <br>
            <button id="Busqueda" type="button" class="btn btn-primary">Buscar</button>
        </form>
        </div>
        </div>
    </section>

    <div id="tablaDatatable" class="tablaSucursal"></div>


</body>

</html>

<script>
    $(document).ready(function () {

        var municipio = $('#municipios');

        $('#departamentos').change(function () {
            var departamentos = $(this).val();

            $.ajax({
                data: {
                    departamentos: departamentos
                },
                dataType: 'html',
                type: 'POST',
                url: 'selects.php',

            }).done(function (data) {
                municipio.html(data);
            });

        });

    });
</script>

<script>
    $('#Busqueda').click(function () {
        $.ajax({
            url: 'tabla.php',
            type: 'POST',
            data: $('#formularioBuscar').serialize(),
            success: function (res) {
                $('#tablaDatatable').html(res);
            }
        });
    });
</script>

<!-- Modal ingresar queja-->

<div class="modal fade" id="agregarnuevo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmnuevo" class="needs-validation" novalidate>
                    <input type="text" id="idsucursal" name="idsucursal" hidden>
                    <label for="noFac">No. Factura</label>
                    <input type="text" name="noFac" id="noFac" class="form-control input-sm" required>
                    <label for="fechaDoc">Fecha de emisión</label>
                    <input type="date" name="fechaDoc" id="fechaDoc" class="form-control">
                    <label for="queja">Queja</label>
                    <textarea name="queja" id="queja" cols="30" rows="10" class="form-control"></textarea>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" id="agregarproducto" class="btn btn-primary">Enviar Queja</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    fechaDoc.max = new Date().toISOString().split("T")[0];
</script>



<!--cargar id a formulario-->
<script type="text/javascript">
    function id_sucursal(idsucursal) {
        document.getElementById('idsucursal').value = idsucursal;
    }
</script>

<script type="text/javascript">
    $(document).ready(function () {
        //funcion deshabilitada por que no valida campos
        $('#agregarproducto').click(function () {
            datos = $('#frmnuevo').serialize();
            $.ajax({
                type: "POST",
                data: datos,
                url: "procesos/agregar.php",
                success: function (r) {
                    if (r == 1) {
                        //$('#frmnuevo')[0].reset();
                        //$('#tablaDatatable').load('tabla.php');
                        alert("agregado con exito :D");
                    } else {
                        alertify.error("Fallo al agregar :(");
                    }
                }
            });
        });

        $('#btnActualizar').click(function () {
            datos = $('#frmnuevoU').serialize();

            $.ajax({
                type: "POST",
                data: datos,
                url: "procesos/actualizar.php",
                success: function (r) {
                    if (r == 1) {
                        $('#frmnuevo')[0].reset();
                        recargarLista();
                        //$('#tablaDatatable').load('tabla.php');
                        alertify.success("Actualizado con exito :D");
                    } else {
                        alertify.error("Fallo al actualizar :(");
                    }
                }
            });
        });
    });
</script>




<script type="text/javascript">
    // Example starter JavaScript for disabling form submissions if there are invalid fields
  (function() {
    'use strict';
    window.addEventListener('load', function() {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            alertify.error("Ingrese los datos requeridos :D");

          }else{
            agregar();
              
            alert("Agregado con exito");

          }
          

          form.classList.add('was-validated');
          

        }, false); 
      });
    }, false);
  })();

</script>



<!--Cargar sucursales por nit-->
<!--<script type="text/javascript">
    $(document).ready(function () {
        $('#nit').val();
        recargarListaS();

        $('#nit').change(function () {
            recargarListaS();
        });
    })
</script>
<script type="text/javascript">
    function recargarListaS() {
        $.ajax({
            type: "POST",
            url: "tabla.php",
            data: "nit=" + $('#nit').val(),
            success: function (r) {
                //$('#municipios').html(r);
                
            }
        });
    }
</script>-->

<!--llamar la tabla
<script type="text/javascript">
  $(document).ready(function(){
    $('#tablaDatatable').load('tabla.php');
  });
</script>
-->