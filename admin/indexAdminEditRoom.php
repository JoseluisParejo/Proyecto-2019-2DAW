<?php
//Iniciamos la conexion
   session_start();
    $db = mysqli_connect('localhost','root','','hoteles')
    or die('Error connecting to MySQL server.');
  //inicializamos variables
$id_habitacion = '';
$descripcion = '';
$precio = '';
$img_path = '';
$num_habitacion = '';
//con esto rellenamos los inputs con los datos anteriores para ver que vamos a modificar
if (isset($_GET['id_habitacion'])) {
  $id_habitacion = $_GET['id_habitacion'];
  $query = "SELECT * FROM `habitaciones` WHERE `id_habitacion`='$id_habitacion'";
  $result = mysqli_query($db, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $descripcion = $row['descripcion'];
    $precio = $row['precio'];
    $num_habitacion = $row['num_habitacion'];
  }
}
//con esto sustituimos en la bd los datos anteriores por los ahora rellenados
if (isset($_POST['update'])) {
  $id_habitacion = $_GET['id_habitacion'];
  $descripcion = $_POST['descripcion'];
  $precio = $_POST['precio'];
  $img_path = $_POST['img_path'];
  $num_habitacion = $_POST['num_habitacion'];

  $query2 = "UPDATE `habitaciones` SET `descripcion`='$descripcion',`precio`='$precio',`img_path`='$img_path',`num_habitacion`='$num_habitacion',`hoteles_id_hotel`='1' WHERE `id_habitacion`='$id_habitacion'";
  $result = mysqli_query($db, $query2);
  if(!$result) {
    die("Query Failed.");
  }
  //devuelve un mensaje y nos manda otra vez a la vista general
  $_SESSION['message'] = 'Room Updated Successfully';
  $_SESSION['message_type'] = 'warning';
  header('Location: indexAdminRoom.php');
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
  <!-- INICIO CUADRO QUE MUESTRA LA TABLA PARA HACER UPDATE -->
  <div class="block-31" style="position: relative;">
    <div class="block-30 item" style="background-image: url('../images/admin_1.jpg');" data-stellar-background-ratio="0.5">
        <div class="container p-4">
            <div class="row align-items-center">
                <div class="col-md-4 mx-auto">
                    <div class="card card-body">
                        <form action="indexAdminEditRoom.php?id_habitacion=<?php echo $_GET['id_habitacion']; ?>" method="POST">
                            <div class="form-group">
                                <input type="hidden" name="id_habitacion" class="form-control" placeholder="ID">
                            </div>
                            <div class="form-group">
                                <input type="text" name="descripcion" class="form-control" value="<?php echo $descripcion; ?>" placeholder="Descripcion" autofocus>
                            </div>
                            <div class="form-group">
                                <input type="text" name="precio" class="form-control" value="<?php echo $precio; ?>" placeholder="Precio">
                            </div>
                            <div class="form-group">
                                <input type="file" name="img_path" class="btn-success" value="<?php echo $img_path; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="number" name="num_habitacion" class="form-control" value="<?php echo $num_habitacion; ?>" placeholder="Nº Habitacion">
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