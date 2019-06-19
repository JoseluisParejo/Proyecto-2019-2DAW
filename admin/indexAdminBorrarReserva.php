<?php
  //iniciamos la conexion
   session_start();
    $db = mysqli_connect('localhost','root','','hoteles')
    or die('Error connecting to MySQL server.');
  //insertamos los datos de la tabla para borrar en la bd la row seleccionada
    if(isset($_GET['id_reserva_habitacion'])) {
        $id_reserva_habitacion = $_GET['id_reserva_habitacion'];
        $query = "DELETE FROM reservas_habitacion WHERE id_reserva_habitacion = '$id_reserva_habitacion'";
        $result = mysqli_query($db, $query);
        if(!$result) {
          die("Query Failed.");
        }
        //mensaje de exito y redireccion 
        $_SESSION['message'] = 'Reservation Removed Successfully';
        $_SESSION['message_type'] = 'danger';
        header('Location: indexAdminReservas.php');
      }
?>