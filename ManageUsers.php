<?php
	session_start();
    if($_SESSION['dangnhap']!= 1){

        header("Location:".'login.php');

    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Quản lý thông tin người dùng</title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="icon" type="image/png" href="images/favicon.png">
	<link rel="stylesheet" type="text/css" href="css/manageusers.css">

    <script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
    <script type="text/javascript" src="js/bootbox.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script src="js/manage_users.js"></script>

	<script>
	  $(document).ready(function(){
	  	  $.ajax({
	        url: "./manage_users_up.php"
	        }).done(function(data) {
	        $('#manage_users').html(data);
	      });
	    setInterval(function(){
	      $.ajax({
	        url: "./manage_users_up.php"
	        }).done(function(data) {
	        $('#manage_users').html(data);
	      });
	    },5000);
	  });
	</script>


</head>
<body>
<?php require 'header.php';?>
<main>
	<!-- <h1 class="slideInDown animated">Add a new User or update his information <br> or remove him</h1> -->
	<div class="form-style-5 slideInDown animated">
		<?php
			require_once 'connect.php';

			$sql = "SELECT * FROM information";
			$stmt = $pdo->query($sql);
			$infor = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		
		?>
		<?php if(isset($_GET['user_id'])){ ?>

			<?php

				$id = $_GET['user_id'];
				$sql = "SELECT cardid.ID as cardid ,information.* FROM information INNER JOIN cardid ON cardid.ID_NgDung = information.ID WHERE information.ID = '$id' ";
				$stmt = $pdo->query($sql);
				$infor = $stmt->fetchAll(PDO::FETCH_ASSOC);
				
			?>
			<?php foreach($infor as $row): ?>
				<form method="post" action="update_information.php">
					<fieldset>
						<legend><span class="number"></span> User Info</legend>
						<input type="text" name="id" id="id" value="<?php echo $row['ID'];?>">
						<input type="text" name="name" id="name" value="<?php echo $row['Hovaten'];?>">
						<input type="date" name="date" class="mb-4 form-control" value="<?php echo $row['NgaySinh'];?>">
						<input type="text" name="number" id="number" value="<?php echo $row['cardid'];?>">
						<input type="email" name="email" id="email" value="<?php echo $row['Email'];?>">
					</fieldset>
					<fieldset>
						<label>
							<?php if($row['GioiTinh'] == "Nam") { ?>
								<input type="radio" name="gender" class="form-check-input" value="Nam" checked="checked">Nam
								<input type="radio" name="gender" class="form-check-input" value="Nữ">Nữ
							<?php }else{ ?>
								<input type="radio" name="gender" class="form-check-input" value="Nam">Nam
								<input type="radio" name="gender" class="form-check-input" value="Nữ" checked="checked">Nữ
							<?php } ?>
						</label >
					</fieldset>

					<button type="submit" name="user_add" class="user_add">Update User</button>

				</form>
				<form action="delete.php" method="post">
						
						<input type="text" name="id_xoa" id="id" value="<?php echo $row['ID'];?>" hidden>
						<button type="submit" name="user_add" class="user_add">Remove User</button>

				</form>
			<?php endforeach ?>

		<?php } else { ?>

			<?php


				$sql = "SELECT cardid.ID FROM cardid";
				$stmt = $pdo->query($sql);
				$card = $stmt->fetchAll(PDO::FETCH_ASSOC);
				
			?>

			<form method="post" action="add_information.php">
				<fieldset>
					<legend><span class="number"></span> User Info</legend>
					<input type="text" name="user_id" class="mb-4 form-control" placeholder="ID...">
					<input type="text" name="name" id="name" placeholder="Họ và tên...">
					<input type="date" name="date" class="mb-4 form-control">
					<input type="text" name="number" id="number" placeholder="Mã thẻ...">

					<input type="email" name="email" id="email" placeholder="Email...">
				</fieldset>
				<fieldset>
					<label class="form-label mb-5">
						<label class="">Giới tính</label>
						<input type="radio" name="gender" class="form-check-input" value="Nam" checked="checked">Nam
						<input type="radio" name="gender" class="form-check-input" value="Nữ">Nữ
					</label >
				</fieldset>

				<button type="submit" name="user_add" class="user_add">Add User</button>

			</form>
			

		<?php } ?>
	</div>
	<!--User table-->
	<div class="section">
		<div class="slideInRight animated">
			<div id="manage_users"></div>
    	</div>
	</div>
</main>
</body>
</html>