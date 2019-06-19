<?php 

   //Iniciamos la conexion
   session_start();
    $db = mysqli_connect('localhost','root','','hoteles')
    or die('Error connecting to MySQL server.');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Hotel Sol y Mar</title>
  <!-- Favicon -->
  <link rel="shortcut icon" type="favicon/ico" href="images/favicon.ico">

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Conexion con el css interno y externo -->
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
<!-- INICIO DE NAV -->
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
          <li class="nav-item active"><a href="servicesUser.php" class="nav-link">Servicios</a></li>
          <li class="nav-item"><a href="cuenta.php" class="nav-link">Mi cuenta</a></li>
          <li class="nav-item"><a href="logout.php" class="nav-link" name="log_out">Cerrar
              Sesión</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- END NAV -->


  <!-- PORTADA -->
  <div class="block-30 block-30-sm item" style="background-image: url('images/service_1.jpg');"
    data-stellar-background-ratio="0.5">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-10">
          <span class="subheading-sm">Disfrute de nuestras</span>
          <h2 class="heading">Instalaciones &amp; Servicios</h2>
        </div>
      </div>
    </div>
  </div>
<!-- FIN PORTADA -->

<!-- CONTAINER CON CARACTERISTICAS DEL HOTEL -->
  <div class="container">
    <div class="row site-section">
      <div class="col-lg-7 mb-5">
        <img src="images/service_3.jpg" alt="Image placeholder" class="img-fluid img-shadow">
      </div>
      <div class="col-lg-5 pl-md-5">

        <div class="media block-6">
          <div class="icon"><span class="ion-ios-checkmark"></span></div>
          <div class="media-body">
            <h3 class="heading">Piscinas</h3>
            <p>Dese un chapuzón en una de nuestras piscinas o pruebe nuestro nuevo jacuzzi.</p>
          </div>
        </div>

        <div class="media block-6">
          <div class="icon"><span class="ion-ios-checkmark"></span></div>
          <div class="media-body">
            <h3 class="heading">Zona Relax</h3>
            <p>Olvide sus problemas en nuestra zona ChillOut o nuestra sala de masajes.</p>
          </div>
        </div>

        <div class="media block-6">
          <div class="icon"><span class="ion-ios-checkmark"></span></div>
          <div class="media-body">
            <h3 class="heading">Instalaciones</h3>
            <p>Gimnasio, zona de golf, pista de padel, spa, zona infantil... Usted elige.</p>
          </div>
        </div>
      </div>
    </div>
<!-- FIN CONTAINER -->

<!-- INICIO ZONA CON MAS INFORMACION DEL HOTEL -->

    <div class="row site-section pt-0">
      <div class="col-lg-7 mb-5 order-lg-2">
        <img src="images/service_2.jpg" alt="Image placeholder" class="img-fluid img-shadow">
      </div>
      <div class="col-lg-5 pr-md-5 order-lg-1">

        <div class="media block-6">
          <div class="icon"><span class="ion-ios-checkmark"></span></div>
          <div class="media-body">
            <h3 class="heading">Nuesto servicio</h3>
            <p>Sera atendido las 24 horas por nuestros profesionales para hacer de su estancia una experiencia memorable.</p>
          </div>
        </div>

        <div class="media block-6">
          <div class="icon"><span class="ion-ios-checkmark"></span></div>
          <div class="media-body">
            <h3 class="heading">Gastronomía</h3>
            <p>Restaurante gastronómico, un bistrot de tapas y especialidades, y un cocktail bar.</p>
          </div>
        </div>

        <div class="media block-6">
          <div class="icon"><span class="ion-ios-checkmark"></span></div>
          <div class="media-body">
            <h3 class="heading">Su opinión</h3>
            <p>Escuchamos a nuestros huéspedes y sus opiniones son el motor que nos ayuda a mejorar cada día y todos los días.</p>
          </div>
        </div>
      </div>
    </div>
  <!-- FIN INFORMACION EXTRA -->
  </div>
  <!-- SERVICIOS DEL HOTEL -->
  <div class="bg-light site-section">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md-7 section-heading">
          <span class="subheading-sm">More</span>
          <h2 class="heading">Servicios del Hotel</h2>
          <p>Si aun no a quedado satisfecho con todo lo que dispone dentro del hotel, !tenemos aun más caracteristicas única!</p>
        </div>
      </div>
      <div class="row ">
        <div class="col-md-6 col-lg-4">
          <div class="media block-6">
            <div class="icon"><span class="flaticon-double-bed"></span></div>
            <div class="media-body">
              <h3 class="heading">Habitaciones lujosas</h3>
              <p>Dispone de una amplia gama de habitaciones de alto lujo.</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="media block-6">
            <div class="icon"><span class="flaticon-wifi"></span></div>
            <div class="media-body">
              <h3 class="heading">Fast &amp; Free Wifi</h3>
              <p>Desde el vestíbulo cuenta con zona Wifi 4G.</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="media block-6">
            <div class="icon"><span class="flaticon-customer-service"></span></div>
            <div class="media-body">
              <h3 class="heading">Disponibilidad 24 horas</h3>
              <p>Tiene a su servicio las 24 horas del dia al servicio del hotel.</p>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="media block-6">
            <div class="icon"><span class="flaticon-taxi"></span></div>
            <div class="media-body">
              <h3 class="heading">Parking propio</h3>
              <p>Dispone de una plaza de aparcamiento dentro del hotel que viene gratis con la reserva.</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="media block-6">
            <div class="icon"><span class="flaticon-credit-card"></span></div>
            <div class="media-body">
              <h3 class="heading">Tipos de pago</h3>
              <p>Aceptamos cualquier tipo de tarjeta bancaria o metodo de pago online como PayPal.</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="media block-6">
            <div class="icon"><span class="flaticon-dinner"></span></div>
            <div class="media-body">
              <h3 class="heading">Zona culinaria</h3>
              <p>Explore la zona y descubra sus diversos restaurantes y zonas gourmet.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- FIN CUADRO DE SERVICIOS -->
  <!-- CUADRO DE OPINIONES -->

  <div class="site-section bg-light">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-7 section-heading">
            <span class="subheading-sm">Reseñas</span>
            <h2 class="heading">Vuestra opinión cuenta</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 col-lg-4">
  <!-- Insertamos la select para conseguir una opinion aleatoria cada vez que carga la pagina -->
            <?php 
            $val1 = "SELECT * FROM valoraciones ORDER BY RAND() LIMIT 1";
            $result_seach = mysqli_query($db, $val1) or die(mysqli_error($db));
            while($row = mysqli_fetch_assoc($result_seach)) { ?>
            <div class="block-33">
              <div class="vcard d-flex mb-3">
                <div class="name-text align-self-center">
                  <h2 class="heading"><?php echo $row['usuario_correo']; ?></h2>
                  <span class="meta"><?php echo $row['fecha']; ?></span>
                  <img src="images/stars_<?php echo $row['valoracion']; ?>.png" alt="Image placeholder" id="estrellas">
                </div>
              </div>
              <div class="text">
                <span class="meta"><?php echo $row['opinion']; ?></span>
              </div>
            </div>
            <?php }?>
          </div>
          <div class="col-md-6 col-lg-4">
<!-- Insertamos la select para conseguir una opinion aleatoria cada vez que carga la pagina -->
          <?php 
            $val1 = "SELECT * FROM valoraciones ORDER BY RAND() LIMIT 1";
            $result_seach = mysqli_query($db, $val1) or die(mysqli_error($db));
            while($row = mysqli_fetch_assoc($result_seach)) { ?>
            <div class="block-33">
              <div class="vcard d-flex mb-3">
                <div class="name-text align-self-center">
                  <h2 class="heading"><?php echo $row['usuario_correo']; ?></h2>
                  <span class="meta"><?php echo $row['fecha']; ?></span>
                  <img src="images/stars_<?php echo $row['valoracion']; ?>.png" alt="Image placeholder" id="estrellas">
                </div>
              </div>
              <div class="text">
                <span class="meta"><?php echo $row['opinion']; ?></span>
              </div>
            </div>
            <?php }?>

          </div>
          <div class="col-md-6 col-lg-4">
<!-- Insertamos la select para conseguir una opinion aleatoria cada vez que carga la pagina -->
          <?php 
            $val1 = "SELECT * FROM valoraciones ORDER BY RAND() LIMIT 1";
            $result_seach = mysqli_query($db, $val1) or die(mysqli_error($db));
            while($row = mysqli_fetch_assoc($result_seach)) { ?>
            <div class="block-33">
              <div class="vcard d-flex mb-3">
                <div class="name-text align-self-center">
                  <h2 class="heading"><?php echo $row['usuario_correo']; ?></h2>
                  <span class="meta"><?php echo $row['fecha']; ?></span>
                  <img src="images/stars_<?php echo $row['valoracion']; ?>.png" alt="Image placeholder" id="estrellas">
                </div>
              </div>
              <div class="text">
              <span class="meta"><?php echo $row['opinion']; ?></span>
              </div>
            </div>
            <?php }?>
          </div>
        </div>
      </div>
    </div>
    <!-- FIN CUADRO DE OPINIONES -->

  <!-- INICIO FOOTER -->
  <footer class="footer">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-6 col-lg-4">
            <h3 class="heading-section">Redes Sociales</h3>
            <a href="#" class="fa fa-twitter"></a>
            <a href="#" class="fa fa-facebook"></a>
            <a href="#" class="fa fa-instagram"></a>
            <a href="#" class="fa fa-github"></a>
          </div>
 
          <div class="col-md-6 col-lg-4">
            <div class="block-23">
            </div>
          </div>
  
          <div class="col-md-6 col-lg-4">
            <div class="block-23">
              <h3 class="heading-section">Información de contacto</h3>
              <ul>
                <li><span class="icon icon-map-marker"></span><span class="text">4 Cerro del Carmen, Cádiz, Andalucía,
                    España</span></li>
                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+34 956 425 210</span></a></li>
                <li><a href="#"><span class="icon icon-envelope"></span><span
                      class="text">info@hotelsolymar.com</span></a></li>
                <li><span class="icon icon-clock-o"></span><span class="text">Lunes &mdash; Viernes 8:00am - 5:00pm</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- FIN FOOTER -->
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
  <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>

</body>
</html>