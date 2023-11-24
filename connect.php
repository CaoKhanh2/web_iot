<?php

    try {
        $conn = 'mysql:host=localhost;dbname=database';
        $user = 'root';
        $pass = '';
        $pdo = new PDO($conn, $user, $pass);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

?>