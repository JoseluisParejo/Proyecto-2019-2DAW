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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik:300,400,500">
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
   <!-- Esta es la pequeña tabla que inserta la habitacion que rellenes -->
  <div class="block-31" style="position: relative;">
      <div class="block-30 item" style="background-image: url('../images/admin_1.jpg');" data-stellar-background-ratio="0.5">
        <div class="container p-4">  
          <div class="row align-items-center">  
            <div class="col-md4">
              <div class="card card-body">
                <form action="indexAdminGuardarRoom.php" method="POST">
                  <div class="form-group">
                    <input type="hidden" name="newId" class="form-control" placeholder="ID" autofocus>
                  </div>
                  <div class="form-group">
                    <input type="text" name="newdesc" class="form-control" placeholder="Descripcion">
                  </div>
                  <div class="form-group">
                    <input type="text" name="newprecio" class="form-control" placeholder="Precio">
                  </div>
                  <div class="form-group">
                    <input type="file" name="newimage" class="btn-success" class="form-control">
                  </div>
                  <div class="form-group">
                    <input type="number" name="newnum_hab" class="form-control" placeholder="Nº Habitacion">
                  </div>
                  <input type="submit" class="btn-success btn-block" name="guardar_Habitacion" value="Guardar Room">
                </form>
              </div>
            </div>
            <!-- En esta tabla mostraremos todas las habitaciones para modificarlas o borrarlas -->
            <div class="col-md-7" style="overflow-x:auto;">
              <table class="table table-striped table-bordered table-hover table-sm" id="tabla-color">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Descr</th>
                    <th>Precio</th>
                    <th>Img</th>
                    <th>Nº Hab</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $query = "SELECT * FROM habitaciones";
                  $result_seach = mysqli_query($db, $query) or die(mysqli_error($db));    

                  while($row = mysqli_fetch_assoc($result_seach)) { ?>
                  <tr>
                    <td><?php echo $row['id_habitacion']; ?></td>
                    <td><?php echo $row['descripcion']; ?></td>
                    <td><?php echo $row['precio']; ?></td>
                    <td><?php echo $row['img_path']; ?></td>
                    <td><?php echo $row['num_habitacion']; ?></td>
                    <td>
                      <a href="indexAdminEditRoom.php?id_habitacion=<?php echo $row['id_habitacion']?>" class="btn-secondary">
                        <i class="fas fa-marker"></i>
                      </a><br>
                      <a href="indexAdminBorrarRoom.php?id_habitacion=<?php echo $row['id_habitacion']?>" class="btn-danger">
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

    <script>
      $(document).ready(function() {
          $('#tabla-pagin').DataTable();
      } );
    </script>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/table.js"></script>
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
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <!-- fin loader -->

</body>
</html>
