<?php

    require_once 'connect.php';

    $id = $_POST['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $date = $_POST['date'];

    $number = $_POST['number'];


    $sql = "INSERT INTO information(ID, Hovaten, GioiTinh, NgaySinh, Email)  VALUES ('$id', '$name', '$gender', '$date', '$email' ); 
            INSERT INTO cardid(ID, ID_NgDung, TrangThai)  VALUES ('$number', '$id', '1')";
    $stmt = $pdo -> prepare($sql);
    $stmt->execute();

    // $sql = "";
    // $stmt = $pdo -> prepare($sql);
    // $stmt->execute();

    header("Location: ManageUsers.php");


?>