<?php
  //Iniciamos la conexion
   session_start();
    $db = mysqli_connect('localhost','root','','hoteles')
    or die('Error connecting to MySQL server.');
  //inicializamos variables
$correo = '';
$nombre = '';
$apellidos = '';
$passwd = '';
  //con esto rellenamos los inputs con los datos anteriores para ver que vamos a modificar
if (isset($_GET['correo'])) {
  $correo = $_GET['correo'];
  $query = "SELECT * FROM usuarios WHERE correo='$correo'";
  $result = mysqli_query($db, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $correo = $row['correo'];
    $nombre = $row['nombre'];
    $apellidos = $row['apellidos'];
    $passwd = $row['passwd'];
  }
}
  //con esto sustituimos en la bd los datos anteriores por los ahora rellenados
if (isset($_POST['update'])) {
  $correo = $_GET['correo'];
  $nombre = $_POST['nombre'];
  $apellidos = $_POST['apellidos'];
  $passwd = $_POST['passwd'];

  $query2 = "UPDATE `usuarios` SET `correo`='$correo',`nombre`='$nombre',`apellidos`='$apellidos',`passwd`='$passwd' WHERE `correo`='$correo'";
  $result = mysqli_query($db, $query2);
  if(!$result) {
    die("Query Failed.");
  }
  //devuelve un mensaje y nos manda otra vez a la vista general
  $_SESSION['message'] = 'User Updated Successfully';
  $_SESSION['message_type'] = 'warning';
  header('Location: indexAdminUser.php');
}

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
   <!-- INICIO NAV -->
<body>
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
  <!-- INICIO CUADRO QUE MUESTRA LA TABLA PARA HACER UPDATE -->
  <div class="block-31" style="position: relative;">
    <div class="block-30 item" style="background-image: url('../images/admin_1.jpg');" data-stellar-background-ratio="0.5">
        <div class="container p-4">
            <div class="row align-items-center">
                <div class="col-md-4 mx-auto">
                    <div class="card card-body">
                        <form action="indexAdminEditUser.php?correo=<?php echo $_GET['correo']; ?>" method="POST">
                            <div class="form-group">
                                <input name="Correo" type="text" class="form-control" value="<?php echo $correo; ?>" placeholder="Update Correo">
                            </div>
                            <div class="form-group">
                                <input name="nombre" type="text" class="form-control" value="<?php echo $nombre; ?>" placeholder="Update nombre">
                            </div>
                            <div class="form-group">
                                <input name="apellidos" type="text" class="form-control" value="<?php echo $apellidos; ?>" placeholder="Update apellidos">
                            </div>
                            <div class="form-group">
                                <input name="passwd" type="password" class="form-control" value="<?php echo $passwd; ?>" placeholder="Update password">
                            </div>
                            <button class="btn-success" name="update">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  FIN TABLA UPDATE -->
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