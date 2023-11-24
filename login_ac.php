<?php
    session_start();
    require_once 'connect.php';


    $sql = "SELECT * FROM user";
    $stmt = $pdo->query($sql);
    $infor = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $username = $_POST['username'];
    $pass = $_POST['matkhau'];

    foreach ($infor as $i) {
        if($i['TaiKhoan'] == $username && $i['MatKhau'] == $pass){

            $_SESSION['dangnhap'] = 1;
            $_SESSION['username'] = $username;
            header("Location: index.php");

        }else{
            header("Location:".'login.php');
        }
    }



?>