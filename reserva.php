<?php
   //Iniciamos la conexion
session_start();
    $db = mysqli_connect('localhost','root','','hoteles')
    or die('Error connecting to MySQL server.');
    //CODIGO DE BUSQUEDA DE HABITACION SEGUN FEHCAS
    $arrayhabs = array();
    if (isset($_POST['seach_room'])) {
         //con esto cogemos las variables y las guardamos en un session para usarlas despues, al usarlas destruimos las sessions
        $fecha_entrada = $_POST['fecha_entrada'];
        $_SESSION['fentrada'] = $fecha_entrada;
        $fecha_salida = $_POST['fecha_salida'];
        $_SESSION['fsalida'] = $fecha_salida;
        $people_room = $_POST['people_room'];
        $_SESSION['ocupantes'] = $people_room;
 //con la siguiente sql seleccionamos las habitaciones disponibles en esa brecha de fechas
        $sql = mysqli_query($db, "SELECT * FROM reservas_habitacion  WHERE fecha_entrada BETWEEN '$fecha_entrada' 
        AND '$fecha_salida' OR fecha_salida BETWEEN '$fecha_entrada' AND '$fecha_salida'") or die(mysqli_error($db));
        if(mysqli_num_rows($sql) > '0'){
            while($row = mysqli_fetch_assoc($sql)){
                $arrayhabs[] = $row;
            }
        }

        $seachArray = array_map(function($el){ return $el['habitaciones_id_habitacion']; }, $arrayhabs);

        $stringSeach = "'".implode("','", $seachArray)."'";
        //Aqui descartariamos las habitaciones no disponibles para mostrar finalmente las habitaciones
        $ult_result = mysqli_query($db, "SELECT * FROM habitaciones LEFT JOIN reservas_habitacion ON reservas_habitacion.habitaciones_id_habitacion = habitaciones.id_habitacion
        WHERE habitaciones.id_habitacion NOT IN ($stringSeach)");
    }
    //CODIGO DE INICIO DE SESION
    if (isset($_POST['submit_login'])) {
        $mail = mysqli_real_escape_string($db, $_POST['mail']);
        $pass = mysqli_real_escape_string($db, $_POST['password']);
  
        if (empty($mail)) {
          array_push($errors, "correo requerido");
          }
          if (empty($pass)) {
          array_push($errors, "Password requerida");
          }
  //con esta select seleccionamos de la base de datos el usuario
          $sql = "SELECT * FROM usuarios WHERE passwd = '$pass' AND correo = '$mail'";
          $query = mysqli_query($db, $sql) or die(mysqli_error($db));
          $results = mysqli_fetch_array($query);
          if (mysqli_num_rows($query) == 1) {
            $_SESSION['user'] = $mail;
            if($results['tipo_usuario'] == 1){
              //con esto manda al usuario admin a su propio index
              header('location: indexAdmin.php');
            }
            else {
              header('location: indexUser.php');
            }
        }
    }
      //CODIGO DE CREAR USUARIO
      if (isset($_POST['submit_create'])) {
        $newName = $_POST['newname'];
        $newSubname = $_POST['newsubname'];
        $newMail = $_POST['newmail'];
        $newPasswd = $_POST['newpasswd'];
    //con esto insertamos el usuario y mandamos la web al index para su logueo
        $sql2 = "INSERT into usuarios values('$newMail','$newName','$newSubname','$newPasswd','0')";
        $query2 = mysqli_query($db, $sql2) or die(mysqli_error($db));
        header('location: index.php');
      }
      //CODIGO DE CREAR RESERVA
      if(isset($_POST['do_reserva'])) {
        //aqui cogemos las variables del formulario de abajo al pulsa el button con name do_reserva
        $id_hab_reserva = $_POST['id_hab_reserva'];
        $precio_reserva = $_POST['precio_reserva'];
        $entrada_reserva =  $_SESSION['fentrada'];
        $salida_reserva = $_SESSION['fsalida'];
        $ocup_reserva = $_SESSION['ocupantes'];
        $pension_reserva = $_POST['pension_reserva'];
        //con esta select cogemos el precio de la pension segun su id para calcular el precio final mas abajo
        $sqlprecio = "SELECT precio FROM tipo_pensiones WHERE id_tipo_pension = '$pension_reserva'";
        $queryPrecio = mysqli_query($db, $sqlprecio) or die(mysqli_error($db));
        $results = mysqli_fetch_array($queryPrecio);
        $precioPension = $results['precio'];
        //esta funcion saca la diferencia de dias en valor int asi podremos multiplicar el precio no solo por ocupante, sino por el numero de dias
        function dateDifferent($date1, $date2, $differenceFormat = '%d'){
          $dateTime1 = date_create($date1);
          $dateTime2 = date_create($date2);
          $interval = date_diff($dateTime1,$dateTime2);
          return $interval->format($differenceFormat);
        }
        $difDia = dateDifferent($entrada_reserva, $salida_reserva);
        //estas serian las operaciones matematicas para calcular el precio final de la reserva 
        $precioDIA = $precio_reserva + ($precioPension * $ocup_reserva);
        $precioFinal = $precioDIA * $difDia;
        $fechaHOY = date('Y-m-d');
        $user = $_SESSION['user'];
        //esta select busca el id de la reserva para hacer el insert segun los datos de las variables anteriores. luego el insert de abajo la mete en la bd
        $sqlCHECKID = "SELECT id_reserva FROM reservas WHERE fecha_reserva = '$fechaHOY' AND precio_final = '$precioFinal'";
        $queryIdRES = mysqli_query($db, $sqlCHECKID) or die(mysqli_error($db));
        $results = mysqli_fetch_array($queryIdRES);
        $id_reserva = $results['id_reserva'];
  
        $sqlRESERVA = "INSERT INTO reservas(id_reserva, fecha_reserva, usuario_correo, precio_final) values(0, '$fechaHOY','$user', '$precioFinal')";
        $queryRESERVA = mysqli_query($db, $sqlRESERVA) or die(mysqli_error($db));
        //esta select selecciona la select insertada anteriormente para poder asociarla al foreing key de la tabla reservas_habitacion y luego insertar la reserva en dicha tabla.
        $sqlCHECKID2 = "SELECT id_reserva FROM reservas WHERE fecha_reserva = '$fechaHOY' AND precio_final = '$precioFinal'";
        $queryIdRES2 = mysqli_query($db, $sqlCHECKID2) or die(mysqli_error($db));
        $results = mysqli_fetch_array($queryIdRES2);
        $id_reserva2 = $results['id_reserva'];

        $sqlHABITACION = "INSERT INTO reservas_habitacion values(0, '$entrada_reserva', '$salida_reserva', '$ocup_reserva', '$id_hab_reserva', '$id_reserva2', '$pension_reserva')";
        $queryHAB = mysqli_query($db, $sqlHABITACION) or die(mysqli_error($db));
        //con esto destruimos los session que usabamos para coger datos desde la busqueda de index o de habitaciones y vamos al php de mandar un correo con la confirmacion
        unset($_SESSION["fentrada"]);
        unset($_SESSION["fsalida"]);
        unset($_SESSION["ocupantes"]);
        header('location: correoReserva.php');

      }
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
        <!-- este if cambiara el nav dependiendo si estas logueado o no. Se puede aplicar a las otras pantallas -->
      <?php 
       if (isset($_SESSION['user'])){
          echo"<li class='nav-item'><a href='indexUser.php' class='nav-link'>Home</a></li>";
          echo"<li class='nav-item active'><a href='roomsUser.php' class='nav-link'>Habitaciones</a></li>";
          echo"<li class='nav-item'><a href='servicesUser.php' class='nav-link'>Servicios</a></li>";
          echo"<li class='nav-item'><a href='cuenta.php' class='nav-link'>Mi cuenta</a></li>";
          echo"<li class='nav-item'><a href='logout.php' class='nav-link' name='log_out'>Cerrar Sesión</a></li>";
          }else{
          echo"<li class='nav-item'><a href='index.php' class='nav-link'>Home</a></li>";
          echo"<li class='nav-item active'><a href='rooms.php' class='nav-link'>Habitaciones</a></li>";
          echo"<li class='nav-item'><a href='services.php' class='nav-link'>Servicios</a></li>";
          echo"<li class='nav-item'><a href='' class='nav-link' data-toggle='modal' data-target='#registrationModal'>Registrarse</a></li>";
          echo"<li class='nav-item'><a href='' class='nav-link' data-toggle='modal' data-target='#loginModal'>Iniciar Sesión</a></li>";
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>
  <!-- END nav -->

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

      <div class="row mb-5 pt-5 justify-content-center">
        <div class="col-md-7 text-center section-heading">
          <h2 class="heading">Habitaciones Disponibles</h2>
          <p>Esta en la gama de habitaciones disponibles</p>
        </div>
      </div>

      <div class="row">
        <!-- Con esto hacemos la consulta a la base de datos para sacar todos los resultados posibles dependiendo la fecha. Ea consulta esta hecha arriba --> 
      <?php 
        if(mysqli_num_rows($ult_result) > '0'){
        while($final = mysqli_fetch_array($ult_result)){
        echo"<div class='col-lg-4 mb-5'>";
        echo"<div class='block-34'>";
        echo"<div class='image'>";
        echo"<img src=".$final['img_path']." alt='Image placeholder'>";
        echo"</div>";
        echo"<div class='text'>";
        echo"<h2 class='heading'>".$final['descripcion']."</h2>";
        echo"<div class='price'><sup>$</sup><span class='number'>".$final['precio']."</span><sub>/por noche</sub></div>";
        echo"<ul class='specs'>";
        echo"<li><strong>Nº Habitacion: </strong>".$final['num_habitacion']."</li>";
        echo"</ul>";
        ?>
        <!-- este formulario nos permitira introducir el tipo de pension  y las variables de precio y id habitacion que estan ocultas pero insertadas por value= -->
          <form action="reserva.php" method="POST">
          <div class="modal-body">
            <div class="form-group">
              <input type="hidden" name="id_hab_reserva" class="form-control" value=<?php print $final['id_habitacion']?>>
            </div>
            <div class="form-group">
              <input type="hidden" name="precio_reserva" class="form-control" value=<?php print $final['precio']?>>
            </div>
            <div class="form-group">
              <select name="pension_reserva" class="form-control">
                  <option value="1">Pension Completa: 50€</option>
                  <option value="2">Media Pension: 30€</option>
                  <option value="3">Desayuno: 15€</option>
                  <option value="4">Nada: 0€</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <!-- Esto cambiara el boton si la consulta para realizar la reserva se hace desde un usuario o desde anonimo, osea nadie logueado -->
            <?php if(isset($_SESSION['user']) == TRUE){
            echo"<button type='submit' class='btn py-4 px-5 btn-success' name='do_reserva'>Reservar</button>";
            }else{
            echo"<a href='index.php' class='btn py-4 px-5 btn-danger'>Debe Registrarse</a>";
            }
            ?>
          </div>
          </form>
        <?php 
        echo"</div>";
        echo"</div>";
        echo"</div>";             
            }
        } ?>
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
          <!-- Insertamos la select para conseguir una opinion aleatoria cada vez que carga la pagina -->
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
