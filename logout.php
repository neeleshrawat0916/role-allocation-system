<?php
//session
session_start();

//connection
require("config/connection.php");

//logout
session_destroy();

//redirect to login page
header("location: login.php?logout=1");
?>