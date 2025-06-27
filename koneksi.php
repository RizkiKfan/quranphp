<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "dbquran";

$koneksi = mysqli_connect($server, $username, $password, $database) or die(mysqli_connect_error($koneksi));
