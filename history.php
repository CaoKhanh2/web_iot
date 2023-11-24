<?php 

    require_once 'header.php'; 
    require_once 'connect.php';

    session_start();
    if($_SESSION['dangnhap']!= 1){

        header("Location:".'login.php');

    }

    $sql = "SELECT * FROM history";
    $stmt = $pdo->query($sql);
    $history = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // header("Refresh:0; url=history.php");

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử ra vào</title>

    <link rel="icon" type="image/png" href="images/favicon.png">
    <script type="text/javascript" src="./bootstrap-5.3.0/js/jquery-2.2.3.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./css/Users.css">

</head>
<body>
<main>
    <section>

    <h1 class="slideInDown animated">Lịch sử đi lại</h1>
  <!--User table-->
        <div class="table-responsive slideInRight animated" style="max-height: 400px;"> 
            <div class="table table-bordered">
                <table class="table mt-4 text-center">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">ID thẻ</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Thời gian</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach($history as $key):  ?>
                                
                                <tr class="<?php echo $key['ID'];?>">
                                    <td scope="row"><?php echo $key['ID'] ?></td>
                                    <td><?php echo $key['ID_Card'] ?></td>
                                    <td><?php 
                                        if($key['VaoRa'] == 1){
                                            echo "Đi Vào";
                                        }else{
                                            echo "Đi Ra";
                                        }
                                    ?></td>
                                    <td><?php echo date("d/m/Y - H:i:s",strtotime($key['ThoiGian'])) ?></td>
                                </tr>
                                
                            <?php endforeach ?>
                            
                        </tbody>
                </table>

            
            </div>
        </div>

    </section>
</main>    
</body>
</html>