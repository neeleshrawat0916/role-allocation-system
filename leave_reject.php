<?php
session_start();
require("config/connection.php");

if (isset($_GET['id'])) {
    $leave_id = $_GET['id'];

    // Update the leave status to rejected
    $update = "UPDATE `leave_application` SET `status` = 'rejected' WHERE `id` = $leave_id";
    $query = mysqli_query($connection, $update);

    if ($query) {
        echo "<script>alert('Leave rejected successfully'); window.location.href = 'student_leave_request.php';</script>";
    } else {
        echo "<script>alert('Error in rejection. Please try again.'); window.location.href = 'student_leave_request.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request'); window.location.href = 'student_leave_request.php';</script>";
}
?>
