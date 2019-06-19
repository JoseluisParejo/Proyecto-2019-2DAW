<?php
   session_start();
    $db = mysqli_connect('localhost','root','','hoteles')
    or die('Error connecting to MySQL server.');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Proyecto Jose Luis Parejo</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="favicon/ico" href="../images/faviconAdmin.ico">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Conexion con el css interno y externo -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet">
  <link rel="stylesheet" href="../css/open-iconic-bootstrap.min.css">
  <link rel="stylesheet" href="../css/animate.css">
  <link rel="stylesheet" href="../css/owl.carousel.min.css">
  <link rel="stylesheet" href="../css/owl.theme.default.min.css">
  <link rel="stylesheet" href="../css/magnific-popup.css">
  <link rel="stylesheet" href="../css/aos.css">
  <link rel="stylesheet" href="../css/ionicons.min.css">
  <link rel="stylesheet" href="../css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="../css/jquery.timepicker.css">
  <link rel="stylesheet" href="../css/flaticon.css">
  <link rel="stylesheet" href="../css/icomoon.css">
  <link rel="stylesheet" href="../css/style.css">

</head>
 
<body>
<!-- INICIO NAV -->
  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="">Hotel Sol Y Mar</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
        aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a href="../indexAdmin.php" class="nav-link" >Panel de Administrador</a></li>
          <li class="nav-item"><a href="../index.php" class="nav-link" name="log_out">Cerrar
              Sesión</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- END NAV -->
  <!-- TABLA INSERTAR ROOM -->
    <!-- Esta es la pequeña tabla que inserta la reserva que rellenes (esta tabla es poco recomendable de usar)-->
  <div class="block-31" style="position: relative;">
      <div class="block-30 item" style="background-image: url('../images/admin_1.jpg');" data-stellar-background-ratio="0.5">
        <div class="container p-4">  
          <div class="row align-items-center">  
            <div class="col-md4">
              <div class="card card-body">
                <form action="indexAdminGuardarReserva.php" method="POST">
                  <div class="form-group">
                    <input type="hidden" name="id_reserva_habitacion" class="form-control" placeholder="ID">
                  </div>
                  <div class="form-group">
                    <input type="date" name="fecha_entrada" class="form-control" placeholder="Fecha Entrada">
                  </div>
                  <div class="form-group">
                    <input type="date" name="fecha_salida" class="form-control" placeholder="Fecha Salida">
                  </div>
                  <div class="form-group">
                    <input type="number" name="ocupantes" class="btn-success" class="form-control" placeholder="Ocupantes">
                  </div>
                  <div class="form-group">
                    <input type="number" name="habitaciones_id_habitacion" class="form-control" placeholder="Id Habitacion">
                  </div>
                  <div class="form-group">
                    <input type="number" name="reservas_id_reserva" class="form-control" placeholder="Id Reserva">
                  </div>
                  <div class="form-group">
                    <input type="number" name="tipo_pensiones_id" class="form-control" placeholder="Id Pension">
                  </div>
                  <input type="submit" class="btn-success btn-block" name="guardar_Reserva" value="Guardar Reserva">
                </form>
              </div>
            </div>
            <!-- En esta tabla mostraremos todas las reservas para modificarlas o borrarlas -->
            <div class="col-md-8">
              <table class="table table-bordered" id="tabla-color">
                <thead>
                  <tr>
                    <th>Fecha Entrada</th>
                    <th>Fecha Salida</th>
                    <th>Ocupantes</th>
                    <th>Nº de habitacion</th>
                    <th>Nº de la reserva</th>
                    <th>Tipo de pension</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $query = "SELECT * FROM reservas_habitacion LEFT JOIN reservas ON reservas_habitacion.reservas_id_reserva = reservas.id_reserva LEFT JOIN habitaciones ON reservas_habitacion.habitaciones_id_habitacion = habitaciones.id_habitacion LEFT JOIN tipo_pensiones ON reservas_habitacion.tipo_pensiones_id = tipo_pensiones.id_tipo_pension";
                  $result_seach = mysqli_query($db, $query) or die(mysqli_error($db));    

                  while($row = mysqli_fetch_assoc($result_seach)) { ?>
                  <tr>
                    <td><?php echo $row['fecha_entrada']; ?></td>
                    <td><?php echo $row['fecha_salida']; ?></td>
                    <td><?php echo $row['ocupantes']; ?></td>
                    <td><?php echo $row['num_habitacion']; ?></td>
                    <td><?php echo $row['reservas_id_reserva']; ?></td>
                    <td><?php echo $row['descripcion']; ?></td>
                    <td>
                      <a href="indexAdminEditReserva.php?id_reserva_habitacion=<?php echo $row['id_reserva_habitacion']?>" class="btn-secondary">
                        <i class="fas fa-marker"></i>
                      </a><br>
                      <a href="indexAdminBorrarReserva.php?id_reserva_habitacion=<?php echo $row['id_reserva_habitacion']?>" class="btn-danger">
                        <i class="far fa-trash-alt"></i>
                      </a>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>  
        </div>    
      </div> 
    </div>
  <!-- FIN TABLA INSERTAR ROOM -->
  
    <!-- INICIO FOOTER -->
    <footer class="footer">
    </footer>
    <!-- FIN FOOTER -->
    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
          stroke="#F96D00" /></svg></div>


    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery-migrate-3.0.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.easing.1.3.js"></script>
    <script src="../js/jquery.waypoints.min.js"></script>
    <script src="../js/jquery.stellar.min.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/jquery.magnific-popup.min.js"></script>
    <script src="../js/bootstrap-datepicker.js"></script>
    <script src="../js/aos.js"></script>
    <script src="../js/jquery.animateNumber.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="../js/google-map.js"></script>
    <script src="../js/main.js"></script>
    <!-- fin loader -->

</body>
</html>
