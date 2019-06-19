<?php
    //este php destruye la session del usuario y te deja sin usuario para hacer diversas acciones.
    session_start();
    session_destroy();
    unset($_SESSION["user"]);
    header("Location: index.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>cerrar sesion</title>
</head>
<body></body>
</html>
