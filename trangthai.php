<?php
    require_once 'connect.php';
    $sql = "SELECT * FROM cardid ";
    $stmt = $pdo->query($sql);
    $carid = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (isset($_GET['id'])) {
        
        $id = $_GET['id'];
        $a = 1;
        $b = 0;

        foreach($carid as $key){
            if($key['ID'] == $id){
                if($key['TrangThai'] == 1){
                    $sql = "update cardid set TrangThai= '$b' WHERE ID = '$id'";
                    $stmt = $pdo->query($sql);
                    $stmt->execute();
                }
                if($key['TrangThai'] == 0){
                    $sql = "update cardid set TrangThai= '$a' WHERE ID = '$id'";
                    $stmt = $pdo->query($sql);
                    $stmt->execute();
                }   
            }   

        }

    }

    header("Location: index.php");

?>
