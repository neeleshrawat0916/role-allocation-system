<?php
session_start();
require("config/connection.php");

if (isset($_GET['id'])) {
    $leave_id = $_GET['id'];

    // Update the leave status to approved
    $update = "UPDATE `leave_application` SET `status` = 'approved' WHERE `id` = $leave_id";
    $query = mysqli_query($connection, $update);

    if ($query) {
        echo "<script>alert('Leave approved successfully'); window.location.href = 'student_leave_request.php';</script>";
    } else {
        echo "<script>alert('Error in approval. Please try again.'); window.location.href = 'student_leave_request.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request'); window.location.href = 'student_leave_request.php';</script>";
}
?>
