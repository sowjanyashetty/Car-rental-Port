<?php
session_start();
unset($_SESSION["admin_id"]);
header("Location:http://localhost/carrentalport/index.php");
 
 
?> 