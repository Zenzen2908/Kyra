<?php
include 'database.php';

if (isset($_GET['deleteAppno'])) {
    $Appno = $_GET['deleteAppno'];

    $sql = "DELETE FROM app WHERE ApplicationNo = $Appno";
    $result = mysqli_query($conn, $sql);

    $sql1 = "DELETE FROM educ_attained WHERE ApplicationNo = $Appno";
    $result1 = mysqli_query($conn, $sql1);

    $sql2 = "DELETE FROM workexp WHERE ApplicationNo = $Appno";
    $result2 = mysqli_query($conn, $sql2);
    if ($result and $result1 and $result2 === TRUE) {
        header("location: hr.php");
    } else {
        die(mysqli_error($conn));
    }
}
