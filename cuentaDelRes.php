<?php
  //iniciamos la conexion
   session_start();
    $db = mysqli_connect('localhost','root','','hoteles')
    or die('Error connecting to MySQL server.');
  //eso es una funcion que usamos en cuenta para borrar reservas.
    if(isset($_GET['id_reserva'])) {
        $id_reserva = $_GET['id_reserva'];

        $query = "DELETE FROM reservas_habitacion WHERE reservas_id_reserva = '$id_reserva'";
        $result = mysqli_query($db, $query);
        if(!$result) {
          die("Query Failed.");
        }
        $query = "DELETE FROM reservas WHERE id_reserva = '$id_reserva'";
        $result = mysqli_query($db, $query);
        if(!$result) {
          die("Query Failed.");
        }
      
        $_SESSION['message'] = 'Reserva Removed Successfully';
        $_SESSION['message_type'] = 'danger';
        header('location: correoReserva.php');
      }
?>