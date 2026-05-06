<?php

//connection
require ("config/connection.php");

//get id
$id = $_GET['id'];

//delete query
$delete = "DELETE FROM school WHERE id=$id";
$query = mysqli_query($connection, $delete);

//redirect to view page
header('location: tables.php?deleted=1');
?>