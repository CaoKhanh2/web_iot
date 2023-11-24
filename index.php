<?php
    require_once 'connect.php';

    session_start();
    if($_SESSION['dangnhap']!= 1){

        header("Location:".'login.php');

    }

    $sql = "SELECT cardid.ID as IDT, cardid.TrangThai, information.*, Device FROM cardid INNER JOIN information ON cardid.id_NgDung = information.id";
    $stmt = $pdo->query($sql);
    $carid = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html>
<head>
    <title>Users</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="images/favicon.png">

    <script type="text/javascript" src="./bootstrap-5.3.0/js/jquery-2.2.3.min.js"></script>
    <script type="text/javascript" src="./bootstrap-5.3.0/js/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href="./css/Users.css">

</head>
<body>
<?php require 'header.php'; ?> 
<main>
<section>
  <h1 class="slideInDown animated">Bảng thông tin chung</h1>
  <!--User table-->
    <div class="table-responsive slideInRight animated" style="max-height: 400px;"> 
            <div class="table table-bordered">
                <table class="table mt-4 text-center">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">ID thẻ</th>
                                <th scope="col">Họ và tên</th>
                                <th scope="col">Giới tính</th>
                                <th scope="col">Ngày sinh</th>
                                <th scope="col">Device</th>
                                <th scope="col">Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php $sl = 1; foreach($carid as $key):  ?>
                            
                            <tr class="">
                                <td scope="row"><?php echo $sl++; ?></td>
                                <td scope="row"><?php echo $key['IDT'] ?></td>
                                <td><?php echo $key['Hovaten'] ?></td>
                                <td><?php echo $key['GioiTinh'] ?></td>
                                <td><?php echo date("d/m/Y",strtotime($key['NgaySinh']))?></td>
                                <td><?php echo $key['Device'] ?></td>
                                
                                <td>
                                    <div class="form-check form-switch">
                                        <form action="trangthai.php" method="get">
                                            <!-- <input class="form-check-input" type="checkbox" id="switchChecked" checked>                      -->
                                            <input type="text" name="id" value="<?php echo $key['IDT'] ?>" hidden>
                                            <button class="btn btn-info btn-block">
                                                <?php 
                                                    if($key['TrangThai'] == 1){
                                                        echo "Active";
                                                    }
                                                    else{
                                                        echo "Disable";
                                                    }
                                                ?>
                                            </button>
                                        </form>
                                    </div>
                                </td>
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