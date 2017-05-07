<?php
$conn = mysqli_connect("localhost","root","")
or die("server connection error");

mysqli_select_db($conn, "balance")
or die(mysqli_error());


?>