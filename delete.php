<?php

    require_once 'connect.php';

    $id = $_POST['id_xoa'];
    $sql = "DELETE FROM information WHERE ID = '$id' ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    header("Location: ManageUsers.php");

?>