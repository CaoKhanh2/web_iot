<?php


    require_once 'connect.php';

    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $date = $_POST['date'];

    $sql = "update information set Hovaten = '$name', GioiTinh = '$gender', NgaySinh = '$date', Email = '$email'  WHERE ID = '$id'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    header("Location: ManageUsers.php");


?>