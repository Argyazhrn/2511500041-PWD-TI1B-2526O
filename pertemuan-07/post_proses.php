<?php
session_start();
$_SESSION["nama"]  = $_POST["txtNama"];
$_SESSION["Email"] = $_POST["txtEmail"];
$_SESSION["Pesan"] = $_POST["txtPesan"];
echo $_SESSION["nama"] . $_SESSION["Email"] . $_SESSION["Pesan"];
header("location: post.php");
?>