<?php
session_start();

unset($_SESSION['felhasznaloNev']);
session_destroy();

header("Location: ../index.php");
?>