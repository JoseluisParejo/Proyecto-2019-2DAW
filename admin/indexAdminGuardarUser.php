<?php
  //iniciamos la conexion
   session_start();
    $db = mysqli_connect('localhost','root','','hoteles')
    or die('Error connecting to MySQL server.');
  //esto repite la formula de registrar usuario del index.
    if (isset($_POST['guardar_Usuario'])) {
      $newMail = $_POST['newmail'];
      $newName = $_POST['newname'];
      $newSubname = $_POST['newsubname'];
      $newPasswd = $_POST['newpasswd'];
      $newTipoUsr = $_POST['tipoUser'];
  
      $sql = "INSERT into usuarios(correo, nombre, apellidos, passwd, tipo_usuario) values('$newMail', '$newName', '$newSubname', '$newPasswd', '$newTipoUsr')";
      $query = mysqli_query($db, $sql);
      if (!$query) {
          die("Query Failed.");
      }
//esto guarda un mensaje y nos redirige
      $_SESSION['message'] = 'User Saved Successfully';
      $_SESSION['message_type'] = 'success';
      header('Location: indexAdminUser.php');
    
    }
?>