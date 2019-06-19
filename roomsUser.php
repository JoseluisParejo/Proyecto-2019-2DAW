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
          <li class="nav-item active"><a href="roomsUser.php" class="nav-link">Habitaciones</a></li>
          <li class="nav-item"><a href="servicesUser.php" class="nav-link">Servicios</a></li>
          <li class="nav-item"><a href="cuenta.php" class="nav-link">Mi cuenta</a></li>
          <li class="nav-item"><a href="logout.php" class="nav-link" name="log_out">Cerrar
              Sesión</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- END NAV -->

  <!-- MUESTRA HABITACIONES -->

  <div class="block-30 block-30-sm item" style="background-image: url('images/bg_2.jpg');"
    data-stellar-background-ratio="0.5">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-10">
          <span class="subheading-sm">Habitaciones</span>
          <h2 class="heading">Cuartos &amp; Suites</h2>
        </div>
      </div>
    </div>
  </div>

  <div class="site-section bg-light">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md-12 mb-5">
  <!-- Esta select cogeria una habitacion fija por la id en la web por que quiero mostrar un en concreto. Al borrarla de la bd habria que cambiar esta id -->
        <?php 
          $hab1 = "SELECT * FROM habitaciones WHERE id_habitacion = 1";
          $result_seach = mysqli_query($db, $hab1) or die(mysqli_error($db));
          while($row = mysqli_fetch_assoc($result_seach)) { ?>

          <div class="block-3 d-md-flex">
            
            <div class="image" style="background-image: url('<?php echo $row['img_path'];?>');"></div>
            <div class="text">

              <h2 class="heading"><?php echo $row['descripcion']; ?></h2>
              <div class="price"><sup>$</sup><span class="number"><?php echo $row['precio']; ?></span><sub>/por noche</sub></div>
              <ul class="specs mb-5">
                <li><strong>Categoria:</strong> Doble</li>
                <li><strong>Facilities:</strong> Mesa de noche grande, TV HD, Telefono, Baño con hidromasaje</li>
                <li><strong>Tamaño:</strong> 40m<sup>3</sup></li>
                <li><strong>Tipo de cama:</strong> Dos camas</li>
                <li><strong>Nº Habitacion: </strong><?php echo $row['num_habitacion']; ?></li>
              </ul>

              <p><a href="#" class="btn btn-primary py-3 px-5"  data-toggle="modal" data-target="#busquedaHab">Reservar</a></p>

            </div>
          </div>

        </div>
        <!-- Esta select cogeria una habitacion fija por la id en la web por que quiero mostrar un en concreto. Al borrarla de la bd habria que cambiar esta id -->
        <?php } 
          $hab2 = "SELECT * FROM habitaciones WHERE id_habitacion = 10";
          $result_seach = mysqli_query($db, $hab2) or die(mysqli_error($db));
          while($row = mysqli_fetch_assoc($result_seach)) { ?>

        <div class="col-md-12 mb-5">

          <div class="block-3 d-md-flex">
            <div class="image order-2" style="background-image: url('<?php echo $row['img_path'];?>'); "></div>
            <div class="text order-1">

            <h2 class="heading"><?php echo $row['descripcion']; ?></h2>
              <div class="price"><sup>$</sup><span class="number"><?php echo $row['precio']; ?></span><sub>/por noche</sub></div>
              <ul class="specs mb-5">
                <li><strong>Categoria:</strong> Doble</li>
                <li><strong>Facilities:</strong> Mesa de noche grande, TV HD, Telefono, Baño con hidromasaje</li>
                <li><strong>Tamaño:</strong> 50m<sup>2</sup></li>
                <li><strong>Tipo de cama:</strong> Dos camas</li>
                <li><strong>Nº Habitacion: </strong><?php echo $row['num_habitacion']; ?></li>
              </ul>

              <p><a href="#" class="btn btn-primary py-3 px-5"   data-toggle="modal" data-target="#busquedaHab">Reservar</a></p>

            </div>
          </div>
        </div>
        <?php } ?>

      <div class="row mb-5 pt-5 justify-content-center">
        <div class="col-md-7 text-center section-heading">
          <h2 class="heading">Mas Habitaciones</h2>
          <p>Tambien tenemos unas habitaciones de gama mas baja para bolsillos mas ajustados conservando la calidad de nuestro hotel</p>
        </div>
      </div>

      <div class="row">
        <!-- Esta select si selecciona varias habitaciones sin importar el tipo, solo para mostrar algunas -->
      <?php 
          $hab = "SELECT * FROM habitaciones ORDER BY RAND() LIMIT 1";
          $result_seach = mysqli_query($db, $hab) or die(mysqli_error($db));
          while($row = mysqli_fetch_assoc($result_seach)) { ?>
        <div class="col-lg-4 mb-5">
          <div class="block-34">
            <div class="image">
              <img src="<?php echo $row['img_path']; ?>" alt="Image placeholder">
            </div>
            <div class="text">
              <h2 class="heading"><?php echo $row['descripcion']; ?></h2>
              <div class="price"><sup>$</sup><span class="number"><?php echo $row['precio']; ?></span><sub>/por noche</sub></div>
              <ul class="specs">
              <li><strong>Nº Habitacion: </strong><?php echo $row['num_habitacion']; ?></li>
              </ul>
              <p><a href="#" class="btn btn-primary py-3 px-5"   data-toggle="modal" data-target="#busquedaHab">Reservar</a></p>
            </div>
          </div>
        </div>
        <?php } ?>
        <!-- Esta select cogeria una habitacion fija por la id en la web por que quiero mostrar un en concreto. Al borrarla de la bd habria que cambiar esta id -->
        <?php 
          $hab = "SELECT * FROM habitaciones ORDER BY RAND() LIMIT 1";
          $result_seach = mysqli_query($db, $hab) or die(mysqli_error($db));
          while($row = mysqli_fetch_assoc($result_seach)) { ?>
        <div class="col-lg-4 mb-5">
          <div class="block-34">
            <div class="image">
              <img src="<?php echo $row['img_path']; ?>" alt="Image placeholder">
            </div>
            <div class="text">
              <h2 class="heading"><?php echo $row['descripcion']; ?></h2>
              <div class="price"><sup>$</sup><span class="number"><?php echo $row['precio']; ?></span><sub>/por noche</sub></div>
              <ul class="specs">
              <li><strong>Nº Habitacion: </strong><?php echo $row['num_habitacion']; ?></li>
              </ul>
              <p><a href="#" class="btn btn-primary py-3 px-5"   data-toggle="modal" data-target="#busquedaHab">Reservar</a></p>
            </div>
          </div>
        </div>
        <?php } ?>
<!-- Esta select cogeria una habitacion fija por la id en la web por que quiero mostrar un en concreto. Al borrarla de la bd habria que cambiar esta id -->
        <?php 
          $hab = "SELECT * FROM habitaciones ORDER BY RAND() LIMIT 1";
          $result_seach = mysqli_query($db, $hab) or die(mysqli_error($db));
          while($row = mysqli_fetch_assoc($result_seach)) { ?>
        <div class="col-lg-4 mb-5">
          <div class="block-34">
            <div class="image">
              <img src="<?php echo $row['img_path']; ?>" alt="Image placeholder">
            </div>
            <div class="text">
              <h2 class="heading"><?php echo $row['descripcion']; ?></h2>
              <div class="price"><sup>$</sup><span class="number"><?php echo $row['precio']; ?></span><sub>/por noche</sub></div>
              <ul class="specs">
              <li><strong>Nº Habitacion: </strong><?php echo $row['num_habitacion']; ?></li>
              </ul>
              <p><a href="#" class="btn btn-primary py-3 px-5"   data-toggle="modal" data-target="#busquedaHab">Reservar</a></p>
            </div>
          </div>
        </div>
        <?php } ?>
<!-- Esta select cogeria una habitacion fija por la id en la web por que quiero mostrar un en concreto. Al borrarla de la bd habria que cambiar esta id -->
        <?php 
          $hab = "SELECT * FROM habitaciones ORDER BY RAND() LIMIT 1";
          $result_seach = mysqli_query($db, $hab) or die(mysqli_error($db));
          while($row = mysqli_fetch_assoc($result_seach)) { ?>
        <div class="col-lg-4 mb-5">
          <div class="block-34">
            <div class="image">
              <img src="<?php echo $row['img_path']; ?>" alt="Image placeholder">
            </div>
            <div class="text">
              <h2 class="heading"><?php echo $row['descripcion']; ?></h2>
              <div class="price"><sup>$</sup><span class="number"><?php echo $row['precio']; ?></span><sub>/por noche</sub></div>
              <ul class="specs">
              <li><strong>Nº Habitacion: </strong><?php echo $row['num_habitacion']; ?></li>
              </ul>
              <p><a href="#" class="btn btn-primary py-3 px-5"   data-toggle="modal" data-target="#busquedaHab">Reservar</a></p>
            </div>
          </div>
        </div>
        <?php } ?>
<!-- Esta select cogeria una habitacion fija por la id en la web por que quiero mostrar un en concreto. Al borrarla de la bd habria que cambiar esta id -->
        <?php 
          $hab = "SELECT * FROM habitaciones ORDER BY RAND() LIMIT 1";
          $result_seach = mysqli_query($db, $hab) or die(mysqli_error($db));
          while($row = mysqli_fetch_assoc($result_seach)) { ?>
        <div class="col-lg-4 mb-5">
          <div class="block-34">
            <div class="image">
              <img src="<?php echo $row['img_path']; ?>" alt="Image placeholder">
            </div>
            <div class="text">
              <h2 class="heading"><?php echo $row['descripcion']; ?></h2>
              <div class="price"><sup>$</sup><span class="number"><?php echo $row['precio']; ?></span><sub>/por noche</sub></div>
              <ul class="specs">
              <li><strong>Nº Habitacion: </strong><?php echo $row['num_habitacion']; ?></li>
              </ul>
              <p><a href="#" class="btn btn-primary py-3 px-5"   data-toggle="modal" data-target="#busquedaHab">Reservar</a></p>
            </div>
          </div>
        </div>
        <?php } ?>
<!-- Esta select cogeria una habitacion fija por la id en la web por que quiero mostrar un en concreto. Al borrarla de la bd habria que cambiar esta id -->
        <?php 
          $hab = "SELECT * FROM habitaciones ORDER BY RAND() LIMIT 1";
          $result_seach = mysqli_query($db, $hab) or die(mysqli_error($db));
          while($row = mysqli_fetch_assoc($result_seach)) { ?>
        <div class="col-lg-4 mb-5">
          <div class="block-34">
            <div class="image">
              <img src="<?php echo $row['img_path']; ?>" alt="Image placeholder">
            </div>
            <div class="text">
              <h2 class="heading"><?php echo $row['descripcion']; ?></h2>
              <div class="price"><sup>$</sup><span class="number"><?php echo $row['precio']; ?></span><sub>/por noche</sub></div>
              <ul class="specs">
              <li><strong>Nº Habitacion: </strong><?php echo $row['num_habitacion']; ?></li>
              </ul>
              <p><a href="#" class="btn btn-primary py-3 px-5"   data-toggle="modal" data-target="#busquedaHab">Reservar</a></p>
            </div>
          </div>
        </div>
        <?php } ?>

      </div>
    </div>
  </div>
  <!-- FIN MUESTRA HABITACIONES -->

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
            <!-- Esta select hace lo mismo que la anterior para habitaciones pero con opiniones -->
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
           <!-- Esta select hace lo mismo que la anterior para habitaciones pero con opiniones -->
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
           <!-- Esta select hace lo mismo que la anterior para habitaciones pero con opiniones -->
          </div>
          <div class="col-md-6 col-lg-4">

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
                <li><span class="icon icon-clock-o"></span><span class="text">Lunes &mdash; Viernes 8:00am -
                    5:00pm</span></li>
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
    <!-- fin loader -->
</body>
<!-- CUADRO BUSQUEDA POPUP -->
<div class="modal fade" role="dialog" id="busquedaHab">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Introduzca datos de busqueda</h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="reserva.php" method="POST">
            <div class="row" style="margin: 5px;">
              <div class="col-md-6 mb-3 mb-lg-0 col-lg-5">
                <label for="checkin">Entrada</label>
                <div class="field-icon-wrap">
                  <div class="icon"><span class="icon-calendar"></span></div>
                  <input type="text" id="checkin_date" name="fecha_entrada" class="form-control">
                </div>
              </div>
              <div class="col-md-6 mb-3 mb-lg-0 col-lg-5">
                <label for="checkin">Salida</label>
                <div class="field-icon-wrap">
                  <div class="icon"><span class="icon-calendar"></span></div>
                  <input type="text" id="checkout_date" name="fecha_salida" class="form-control">
                </div>
              </div>
              <div class="col-md-6 mb-3 mb-md-0 col-lg-5">
                <div class="row">
                  <div class="col-md-6 mb-3 mb-md-0">
                    <label for="checkin">Personas</label>
                    <div class="field-icon-wrap">
                      <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                      <select name="people_room" id="" class="form-control">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4+</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-3 align-self-end">
                <button class="btn btn-primary btn-block" name="seach_room">Check</button>
              </div>
            </div>
          </form>
    </div>
  </div>
</div>
  <!-- FIN CUADRO BUSQUEDA POPUP -->
</html>