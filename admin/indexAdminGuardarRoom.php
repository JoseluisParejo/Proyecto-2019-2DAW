<?php
  //iniciamos la conexion
   session_start();
    $db = mysqli_connect('localhost','root','','hoteles')
    or die('Error connecting to MySQL server.');
  //con esto insertamos en la bd una habitacion con los datos introducidos en la pantalla anterior
    if (isset($_POST['guardar_Habitacion'])) {
      $newDesc = $_POST['newdesc'];
      $newPrecio = $_POST['newprecio'];
      $newImage = 'images/' . $_POST['newimage']; 
      $newNum_hab = $_POST['newnum_hab'];
  
      $sql = "INSERT into habitaciones(id_habitacion, descripcion, precio, img_path, num_habitacion, hoteles_id_hotel) values(0,'$newDesc', '$newPrecio', '$newImage', '$newNum_hab', 1)";
      echo $sql;
      $query = mysqli_query($db, $sql);
      if (!$query) {
          die("Query Failed.");
      }
      //esto guarda un mensaje y nos redirige
      $_SESSION['message'] = 'Room Saved Successfully';
      $_SESSION['message_type'] = 'success';
      header('Location: indexAdminRoom.php');
    
    }
?>