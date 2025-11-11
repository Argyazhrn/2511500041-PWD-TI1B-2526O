<?php
session_start();
$_SESSION["nama"]  = $_post["txtNama"];
$_SESSION["Email"] = $_post["txtEmail"];
$_SESSION["Pesan"] = $_post["txtPesan"];
echo $_SESSION["nama"] . $_SESSION["Email"] . $_SESSION["Pesan"];
#header("location: post.php");
?>