<?php
  //iniciamos la conexion
    session_start();
    $db = mysqli_connect('localhost','root','','hoteles')
    or die('Error connecting to MySQL server.');
  //eso sirve para llamar al usuario arriba de la tabla de reservas
    $correo =  $_SESSION['user'];
    $sqlName = "SELECT nombre FROM usuarios WHERE correo = '$correo'";
    $resultado = mysqli_query($db, $sqlName) or die(mysqli_error($db));
    if(mysqli_num_rows($resultado) > 0){
    $fila = $resultado->fetch_array(MYSQLI_ASSOC);
    $_SESSION['name'] = $fila['nombre'];
    }
    //esto es un insert a la base de datos con la opinion y las estrellas que le das a la reserva. Habria que añadir un condicional si la reserva a 
    //acabado o no.
    if (isset($_POST['submit_opinion'])) {
        $stars = $_POST['stars'];
        $hoy = date('Y-m-d');
        $text_valor = $_POST['text_valor'];
        $id_reserva = "SELECT id_reserva FROM reservas WHERE usuario_correo = '$correo'";  
        $result = mysqli_query($db, $id_reserva);
        $row = mysqli_fetch_array($result);
        $id_reserva = $row[0];

        $sql = "INSERT into valoraciones values(0,'$hoy','$stars','$text_valor','$correo','$id_reserva')";
        $query = mysqli_query($db, $sql) or die(mysqli_error($db));
      }
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <title>Proyecto Jose Luis Parejo</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="favicon/ico" href="images/favicon.ico">

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Conexion con el css interno y externo -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet">
  <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
  <link rel="stylesheet" href="css/animate.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">
  <link rel="stylesheet" href="css/aos.css">
  <link rel="stylesheet" href="css/ionicons.min.css">
  <link rel="stylesheet" href="css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="css/jquery.timepicker.css">
  <link rel="stylesheet" href="css/flaticon.css">
  <link rel="stylesheet" href="css/icomoon.css">
  <link rel="stylesheet" href="css/style.css">
  
</head>

<body>
<!-- INICIO NAV -->
  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="index.php">Hotel Sol Y Mar</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
        aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"><a href="indexUser.php" class="nav-link">Home</a></li>
          <li class="nav-item"><a href="roomsUser.php" class="nav-link">Habitaciones</a></li>
          <li class="nav-item"><a href="servicesUser.php" class="nav-link">Servicios</a></li>
          <li class="nav-item active"><a href="cuenta.php" class="nav-link">Mi cuenta</a></li>
          <li class="nav-item"><a href="logout.php" class="nav-link" name="log_out">Cerrar
              Sesión</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- END nav -->

  <!-- TABLA DE RESERVAS -->
  <!-- Aqui mostramos las reservas activas del usuario y su respectivo saludo -->
  <div class="block-31" style="position: relative;">
      <div class="block-30 item" style="background-image: url('images/cuenta_1.jpg');" data-stellar-background-ratio="0.5">
        <div class="container p-4">  
          <div class="row align-items-center">  
            <div class="col-md-8">
            <h2 id="saludo">Hola, <?php echo $_SESSION['name'] ?> </h3> 
              <table class="table table-bordered" id="tabla-color">
                <thead>
                  <tr>
                    <th>fecha_reserva</th>
                    <th>Correo</th>
                    <th>Valoracion</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                //aqui mostramos los datos dentro de la tabla dependiendo del correo, incluyendo el boton para borrar reservar y la llamada al popup (mas abajo) para valorar
                  $query = "SELECT * FROM reservas WHERE usuario_correo = '$correo'";
                  $result_seach = mysqli_query($db, $query) or die(mysqli_error($db));    

                  while($row = mysqli_fetch_assoc($result_seach)) { ?>
                  <tr>
                    <td><?php echo $row['fecha_reserva']; ?></td>
                    <td><?php echo $row['usuario_correo']; ?></td>
                    <td><input type="submit" class="btn-success btn-block" data-toggle="modal" data-target="#opiniones" value="Opina"></td>
                    <td><a href="cuentaDelRes.php?id_reserva=<?php echo $row['id_reserva']?>" class="btn-danger" onclick="return confirm('¿Seguro que quiere borrar la reserva?')">
                        <i class="far fa-trash-alt"></i>
                      </a></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>  
        </div>    
      </div> 
    </div>

  <!-- FIN TABLA DE RESERVAS -->

    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
          stroke="#F96D00" /></svg></div>


    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="js/google-map.js"></script>
    <script src="js/main.js"></script>
    <!-- fin loader -->
</body>

<!-- OPINION POPUP -->
<div class="modal fade" role="dialog" id="opiniones">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Danos tu opinion</h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
<!-- Aqui rellenamos el formulario y lo mandamos con el boton con name submit_opinion a la funcion php de arriba -->
<form action="cuenta.php" method="POST">
      <div class="modal-body">
        <div class="form-group">
          <textarea rows="4" cols="50" name="text_valor" class="form-control" placeholder="Opinion"></textarea>
        </div>
        <div class="form-group">
        <select name="stars">
          <option value="1">*</option>
          <option value="2">**</option>
          <option value="3">***</option>
          <option value="4">****</option>
          <option value="5">*****</option>
        </select>
        </div>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-success" name="submit_opinion">Valorar</button>
      </div>
</form>
    </div>
  </div>
</div>
<!-- FIN OPINION POPUP -->

</html>