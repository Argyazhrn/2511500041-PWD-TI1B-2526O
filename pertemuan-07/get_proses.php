<?php
session_start();
$_SESSION["nama"]  = $_GET["txtNama"];
$_SESSION["Email"] = $_GET["txtEmail"];
$_SESSION["Pesan"] = $_GET["txtPesan"];
?>