<link rel="stylesheet" href="bootstrap-5.3.0/css/bootstrap.min.css">
<div class="table-responsive-lg"> 
  <table class="table">
    <thead class="table-primary">
      <tr>
        <th>No Badge</th>
        <th>ID</th>
        <th>Họ và tên</th>
        <th>Giới tính</th>
        <th>Ngày sinh</th>
        <th>Email</th>
        <th></th>

      </tr>
    </thead>
    <tbody class="table-secondary">
    <?php
      //Connect to database
      require_once 'connect.php';
      $sql = "SELECT cardid.ID as cardid ,information.* FROM information INNER JOIN cardid ON cardid.ID_NgDung = information.ID";
      $stmt = $pdo->query($sql);
      $infor = $stmt->fetchAll(PDO::FETCH_ASSOC);

      foreach($infor as $row):
        
    ?>
                  <TR>
                    <TD><?php echo $row['cardid'];?></TD>
                    <TD><?php echo $row['ID'];?></TD>
                    <TD><?php echo $row['Hovaten'];?></TD>
                    <TD><?php echo $row['GioiTinh'];?></TD>
                    <TD><?php echo date("d/m/Y",strtotime($row['NgaySinh']));?></TD>
                    <TD><?php echo $row['Email'];?></TD>
                    <TD><a href="ManageUsers.php?user_id=<?php echo $row['ID']?>">edit</a></TD>
                  </TR>
    <?php
      endforeach
    ?>
    </tbody>
  </table>
</div>