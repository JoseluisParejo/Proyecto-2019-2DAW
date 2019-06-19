<?php

    session_start();
    $db = mysqli_connect('localhost','root','','hoteles')
    or die('Error connecting to MySQL server.');

    $errores = array();
    if (isset($_POST['submit_login'])) {
      $mail = mysqli_real_escape_string($db, $_POST['mail']);
      $pass = mysqli_real_escape_string($db, $_POST['password']);

      if (empty($mail)) {
        array_push($errors, "correo requerido");
        }
        if (empty($pass)) {
        array_push($errors, "Password requerida");
        }

      $sql = "SELECT * FROM usuarios WHERE passwd = '$pass' AND correo = '$mail'";
      $query = mysqli_query($db, $sql) or die(mysqli_error($db));
      $results = mysqli_fetch_array($query);
      if (mysqli_num_rows($query) == 1) {
        $_SESSION['user'] = $mail;
        if($results['tipo_usuario'] == 1){
          header('location: indexAdmin.php');
        }
        else {
          header('location: indexUser.php');
        }
    }
  }
  if (isset($_POST['submit_create'])) {
    $newName = $_POST['newname'];
    $newSubname = $_POST['newsubname'];
    $newMail = $_POST['newmail'];
    $newPasswd = $_POST['newpasswd'];

    $sql2 = "INSERT into usuarios values('$newMail','$newName','$newSubname','$newPasswd','0')";
    $query2 = mysqli_query($db, $sql2) or die(mysqli_error($db));
    $_SESSION['user'] = $newMail;
  }

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <title>Hotel Sol y Mar</title>
  <!-- Favicon -->
  <link rel="shortcut icon" type="favicon/ico" href="images/favicon.ico">

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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

  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="index.php">Hotel Sol Y Mar</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
        aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
          <li class="nav-item"><a href="rooms.php" class="nav-link">Habitaciones</a></li>
          <li class="nav-item"><a href="services.php" class="nav-link">Servicios</a></li>
          <li class="nav-item"><a href="" class="nav-link" data-toggle="modal"
              data-target="#registrationModal">Registrarse</a></li>
          <li class="nav-item"><a href="" class="nav-link" data-toggle="modal" data-target="#loginModal">Iniciar
              Sesión</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- END nav -->
  <!-- SLIDER -->
  <div class="block-31" style="position: relative;">
    <div class="owl-carousel loop-block-31 ">
      <div class="block-30 item" style="background-image: url('images/bg_6.jpg');" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-10">
              <span class="subheading-sm">Bienvenido</span>
              <h2 class="heading">Reserva ya tu estancia</h2>
              <p><a href="rooms.php" class="btn py-4 px-5 btn-primary">Reserva</a></p>
            </div>
          </div>
        </div>
      </div>
      <div class="block-30 item" style="background-image: url('images/bg_5.jpg');" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-10">
              <span class="subheading-sm">Bienvenido</span>
              <h2 class="heading">Conoce nuestros servicios</h2>
              <p><a href="services.php" class="btn py-4 px-5 btn-primary">Descubre</a></p>
            </div>
          </div>
        </div>
      </div>
      <div class="block-30 item" style="background-image: url('images/bg_4.jpg');" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-10">
              <span class="subheading-sm">Bienvenido</span>
              <h2 class="heading">Unete a la familia </h2>
              <p><a href="" data-toggle="modal" data-target="#registrationModal" class="btn py-4 px-5 btn-primary">Registrarse</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- FIN SLIDER -->
  <!-- CUADRO DE BUSQUEDA -->
  <div class="container">
    <div class="row mb-5">
      <div class="col-md-12">
        <div class="block-32">
          <form action="reserva.php" method="POST">
            <div class="row">
              <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
                <label for="checkin">Entrada</label>
                <div class="field-icon-wrap">
                  <div class="icon"><span class="icon-calendar"></span></div>
                  <input type="text" id="checkin_date" name="fecha_entrada" class="form-control">
                </div>
              </div>
              <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
                <label for="checkin">Salida</label>
                <div class="field-icon-wrap">
                  <div class="icon"><span class="icon-calendar"></span></div>
                  <input type="text" id="checkout_date" name="fecha_salida" class="form-control">
                </div>
              </div>
              <div class="col-md-6 mb-3 mb-md-0 col-lg-3">
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
                <!-- Este boton mandara los datos introducidos aqui arriba a reserva.php y mostrara los que no entren en el intervalo de dias.  -->
                <button class="btn btn-primary btn-block" name="seach_room">Comprobar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- FIN CUADRO DE BUSQUEDA -->
    <!-- CUADRO DE DISTINTOS HOSPEDAJES -->

    <div class="site-section block-13 bg-light">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-7 section-heading">
            <span class="subheading-sm">Habitaciones</span>
            <h2 class="heading">Nuestros hospedajes</h2>
            <p>Aquí puede comprabar las distintas habitaciones que podemos proporcionar para su disfrute</p>
            <button class="btn btn-info"><a class="text-dark" href="rooms.php">Ver todos</a></button>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="nonloop-block-13 owl-carousel">
              <!-- Aqui ocurre lo mismo que en habitaciones. Muestro habitaciones con id fijo a riesgo de ser borradas de la bd, pero es algo simplemente estetico y se puede modificar
              a habitaciones random como se ha hecho con las opiniones.   -->
            <?php 
              $hab1 = "SELECT * FROM habitaciones WHERE id_habitacion = 1";
              $result_seach = mysqli_query($db, $hab1) or die(mysqli_error($db));
              while($row = mysqli_fetch_assoc($result_seach)) { ?>  
              <div class="item">
                <div class="block-34">
                  <div class="image">
                    <a href="#"><img src="images/hab_1.jpg" alt="Image placeholder"></a>
                  </div>
                  <div class="text">
                    <h2 class="heading">Habitacion <?php echo $row['num_habitacion']; ?></h2>
                    <div class="price"><sup>$</sup><span class="number"><?php echo $row['precio']; ?></span><sub>/por noche</sub></div>
                    <ul class="specs">
                      <li><strong>Adultos:</strong> 2</li>
                      <li><strong>Descripcion:</strong> <?php echo $row['descripcion']; ?></li>
                      <li><strong>Extras:</strong> Armario grande, TV HD, Telefono</li>
                      <li><strong>Nº de camas:</strong> 2</li>
                    </ul>
                  </div>
                </div>
              </div>
              <?php } 
                $hab2 = "SELECT * FROM habitaciones WHERE id_habitacion = 7";
                $result_seach = mysqli_query($db, $hab2) or die(mysqli_error($db));
                while($row = mysqli_fetch_assoc($result_seach)) { ?>
              <div class="item">
                <div class="block-34">
                  <div class="image">
                    <a href="#"><img src="images/hab_2.jpg" alt="Image placeholder"></a>
                  </div>
                  <div class="text">
                    <h2 class="heading">Habitacion <?php echo $row['num_habitacion']; ?></h2>
                    <div class="price"><sup>$</sup><span class="number"><?php echo $row['precio']; ?></span><sub>/por noche</sub></div>
                    <ul class="specs">
                      <li><strong>Adultos:</strong> 1</li>
                      <li><strong>Descripcion:</strong> <?php echo $row['descripcion']; ?></li>
                      <li><strong>Extras:</strong> Armario grande, TV HD, Telefono</li>
                      <li><strong>Nº de camas:</strong> 1</li>
                    </ul>
                  </div>
                </div>
              </div>
              <?php } 
                $hab3 = "SELECT * FROM habitaciones WHERE id_habitacion = 8";
                $result_seach = mysqli_query($db, $hab3) or die(mysqli_error($db));
                while($row = mysqli_fetch_assoc($result_seach)) { ?>
              <div class="item">
                <div class="block-34">
                  <div class="image">
                    <a href="#"><img src="images/hab_3.jpg" alt="Image placeholder"></a>
                  </div>
                  <div class="text">
                    <h2 class="heading">Habitacion <?php echo $row['num_habitacion']; ?></h2>
                    <div class="price"><sup>$</sup><span class="number"><?php echo $row['precio']; ?></span><sub>/por noche</sub></div>
                    <ul class="specs">
                      <li><strong>Adultos:</strong> 2 o más</li>
                      <li><strong>Descripcion:</strong> <?php echo $row['descripcion']; ?></li>
                      <li><strong>Extras:</strong> Mesa de noche grande, TV HD, Telefono, Baño con hidromasaje, Armarios grandes</li>
                      <li><strong>Nº de camas:</strong> 4</li>
                    </ul>
                  </div>
                </div>
              </div>
              <?php } 
                $hab4 = "SELECT * FROM habitaciones WHERE id_habitacion = 9";
                $result_seach = mysqli_query($db, $hab4) or die(mysqli_error($db));
                while($row = mysqli_fetch_assoc($result_seach)) { ?>
              <div class="item">
                <div class="block-34">
                  <div class="image">
                    <a href="#"><img src="images/hab_4.jpg" alt="Image placeholder"></a>
                  </div>
                  <div class="text">
                    <h2 class="heading">Habitacion <?php echo $row['num_habitacion']; ?></h2>
                    <div class="price"><sup>$</sup><span class="number"><?php echo $row['precio']; ?></span><sub>/por noche</sub></div>
                    <ul class="specs">
                      <li><strong>Adultos:</strong> 2</li>
                      <li><strong>Descripcion:</strong> <?php echo $row['descripcion']; ?></li>
                      <li><strong>Extras:</strong> Mesa de noche grande, TV HD, Telefono, Baño con hidromasaje, Armarios grandes</li>
                      <li><strong>Nº de camas:</strong> 2</li>
                    </ul>
                  </div>
                </div>
              </div>
              <?php } ?>
            </div>
          </div> <!-- .col-md-12 -->
        </div>
      </div>
    </div>
    <!-- FIN CUADRO DE DISTINTOS HOSPEDAJES -->
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
<!-- LOGIN POPUP -->
<div class="modal fade" role="dialog" id="loginModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Inicia Sesion</h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

<form action="index.php" method="POST">
      <div class="modal-body">
        <div class="form-group">
          <input type="text" name="mail" class="form-control" placeholder="Correo">
        </div>
        <div class="form-group">
          <input type="password" name="password" class="form-control" placeholder="Contraseña">
        </div>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-success" name="submit_login">Entrar</button>
      </div>
</form>
    </div>
  </div>
</div>
<!-- FIN LOGIN POPUP -->

<!-- REGISTRO CLIENTE POPUP -->
<div class="modal fade" role="dialog" id="registrationModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Introduzca sus datos</h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="index.php" method="POST">
      <div class="modal-body">
        <div class="form-group">
          <input type="text" name="newname" class="form-control" placeholder="Nombre">
        </div>
        <div class="form-group">
          <input type="text" name="newsubname" class="form-control" placeholder="Apellidos">
        </div>
        <div class="form-group">
          <input type="mail" name="newmail" class="form-control" placeholder="Correo">
        </div>
        <div class="form-group">
          <input type="password" name="newpasswd" class="form-control" placeholder="Contraseña">
        </div>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-success" name="submit_create">Crear</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- FIN REGISTRO CLIENTE POPUP -->
</html>