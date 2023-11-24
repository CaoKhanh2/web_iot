<head>
	<link rel="stylesheet" href="./css/font-awesome.min.css">
	<link rel='stylesheet' type='text/css' href="./bootstrap-5.3.0/css/bootstrap.css"/>
	<link rel="stylesheet" href="./bootstrap-5.3.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./css/header.css"/>

</head>
<header>
<div class="header">
	<div class="logo">
		<a href="index.php">RFID Attendance</a>
	</div>
</div>

<div class="topnav" id="myTopnav">
	<a href="index.php">Trang chủ</a>
    <a href="ManageUsers.php">Quản lý</a>
    <a href="history.php">Lịch sử</a>

    <?php  
    	if (isset($_SESSION['Admin-name'])) {
    		echo '<a href="#" data-toggle="modal" data-target="#admin-account">'.$_SESSION['Admin-name'].'</a>';
    		echo '<a href="logout.php">Log Out</a>';
    	}
    	else{
    		echo '<a href="logout.php">Đăng xuất</a>';
    	}
    ?>
    <a href="javascript:void(0);" class="icon" onclick="navFunction()">
	  <i class="fa fa-bars"></i></a>
</div>

</header>


	

	
