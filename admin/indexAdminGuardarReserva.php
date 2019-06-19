<?php
  //iniciamos la conexion
   session_start();
    $db = mysqli_connect('localhost','root','','hoteles')
    or die('Error connecting to MySQL server.');
  //con esto guardamos en la bd una reserva con los datos de la tabla anterior
    if (isset($_POST['guardar_Reserva'])) {
      $fecha_entrada = $_POST['fecha_entrada'];
      $fecha_salida = $_POST['fecha_salida'];
      $ocupantes = $_POST['ocupantes'];
      $habitaciones_id_habitacion = $_POST['habitaciones_id_habitacion'];
      $reservas_id_reserva = $_POST['reservas_id_reserva'];
      $tipo_pensiones_id = $_POST['tipo_pensiones_id'];
  
      $sql = "INSERT into reservas_habitacion(fecha_entrada, fecha_salida, ocupantes, habitaciones_id_habitacion, reservas_id_reserva, tipo_pensiones_id) values('$fecha_entrada', '$fecha_salida', '$ocupantes', '$habitaciones_id_habitacion', '$reservas_id_reserva', '$tipo_pensiones_id')";
      $query = mysqli_query($db, $sql);
      if (!$query) {
          die("Query Failed.");
      }
//esto guarda un mensaje y nos redirige
      $_SESSION['message'] = 'Reservation Saved Successfully';
      $_SESSION['message_type'] = 'success';
      header('Location: indexAdminReservas.php');
    
    }
?>