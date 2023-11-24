<?php

    date_default_timezone_set('Asia/Ho_Chi_Minh');

    $d = date("Y-m-d");
    $t = date("H:i:sa");
    $dt = date("Y-m-d H:i:saa");

    require_once 'connect.php';
    
    global $id;

    // $sql = "SELECT cardid.ID, history.TrangThai FROM cardid INNER JOIN history ON cardid.ID = history.ID_Card";
    // $stmt = $pdo->query($sql);
    // $item = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SELECT * FROM cardid";
    $stmt = $pdo->query($sql);
    $item = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (isset($_POST['ID']) && isset($_POST['TT'])){

        $id = $_POST['ID'];
        $tt = $_POST['TT'];
      
        $check = 0;

        foreach ($item as $key) {
            
            if ($key['ID'] == $id && $key['TrangThai'] == 1) {

                $check = 1;
                // $sql = "update cardid set TrangThai = '$tt' WHERE ID = '$id'";
                $sql = "INSERT INTO history(ID_Card, VaoRa, ThoiGian)  VALUES ('$id','$tt','$dt')";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();

              
            }
            
        }

        
        printf($check);
        printf(" ");
        printf($tt);

        


    }



?>