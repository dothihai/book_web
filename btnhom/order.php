<?php
	require('connectdb.php');
	require('getURL.php');
	session_start();
?>

<!doctype html>
<html lang="vi">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Đơn hàng</title>
	<link href='http://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/dest/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/dest/vendors/colorbox/example3/colorbox.css">
	<link rel="stylesheet" title="style" href="assets/dest/css/style.css">
	<link rel="stylesheet" href="assets/dest/css/animate.css">
	<link rel="stylesheet" title="style" href="assets/dest/css/huong-style.css">
</head>

<body>
		<div id="header">
		<div class="header-top">
			<div class="container">
				<div class="pull-left auto-width-left">
					<ul class="top-menu menu-beta l-inline">
						<li><a href=""><i class="fa fa-home"></i> Số 1,Đại Cồ Việt,Hai Bà Trưng,Hà Nội</a></li>
						<li><a href=""><i class="fa fa-phone"></i> 0123456789</a></li>
					</ul>
				</div>
				<div class="pull-right auto-width-right">
					<ul class="top-details menu-beta l-inline">
						<?php
							if (isset($_SESSION['user_fullname']) && ($_SESSION['user_id'] == "admin@gmail.com")) {
						?>
							<li><a href="#"><i class="fa fa-user"></i>Tài khoản: <?php echo $_SESSION['user_fullname']; ?></a></li>
							<li><a href="logout.php">Đăng suất</a></li>
						<?php
							} else {
						?>
						<script language="javascript">                           
							alert('<?php echo "Bạn chưa đăng nhập hoặc tài khoản của bạn không phải là ADMIN. Nhấn \"OK\" để đăng nhập." ?>');                   
						</script>
						<?php
							header('Location: 404.php');
							// $url = "login.php";
							// echo "<meta http-equiv='refresh' content='0;url=$url' />";
							}
						?>
					</ul>
				</div>
				<div class="clearfix"></div>
			</div> <!-- .container -->
		</div> <!-- .header-top -->
		<div class="header-body">
			<div class="container beta-relative">
				<div class="pull-left">
					<a href="admin.php" id="logo"><img src="assets/dest/images/logo-cake.png" width="200px" alt=""></a>
					<h6>Nhà Sách Bách Khoa</h6>
				</div>
				<div class="clearfix"></div>
			</div> <!-- .container -->
		</div> <!-- .header-body -->
		<div class="header-bottom" style="background-color: #0277b8;">
			<div class="container">
				<a class="visible-xs beta-menu-toggle pull-right" href="#"><span class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
				<div class="visible-xs clearfix"></div>
				<nav class="main-menu">
					<ul class="l-inline ov">
						<li><a href="admin.php">Trang chủ</a></li>
						<li><a href="add.php">Thêm sản phẩm</a></li>
						<li><a href="order.php">Đơn Hàng</a>
						</li>
						<li><a href="user.php">Thành viên</a>
						</li>
					</ul>
					<div class="clearfix"></div>
				</nav>
			</div> <!-- .container -->
		</div> <!-- .header-bottom -->
	</div> <!-- .header -->

	<div class="container">
		<div id="content">
			
			<div class="table-responsive">
				<!-- Shop Products Table -->
				<table class="shop_table beta-shopping-cart-table" cellspacing="0">
					<thead>
						<tr>
							<th style = "font-size: 15px">Mã đơn hàng</th>
							<th style = "font-size: 15px">Tên người nhận</th>
							<th style = "font-size: 15px">Địa chỉ nhận</th>
							<th style = "font-size: 15px">Số điện thoại</th>
<!-- 							<th style = "font-size: 15px">Ghi chú</th> -->
							<th style = "font-size: 15px">Tổng tiền</th>
							<th style = "font-size: 15px">Trạng thái</th>
							<th style = "font-size: 15px">Thời gian</th>
							<th class="product-update" style = "font-size: 15px">Cập nhật</th>				
						</tr>
					</thead>
					<tbody>
						
						<?php

							$sql = "SELECT * FROM order_customer WHERE order_status = 'Đang chờ'
									ORDER BY order_datetime";
							$result = mysqli_query($connect, $sql);
							while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) :;
						?>

						<tr class="cart_item">
							<td>
								<span class="amount" style = "color: #33cc33; font-size: 15px"><?php echo $row['order_id']?></span>
							</td>
							<td>
								<span class="amount" style = "color: #33cc33; font-size: 15px"><?php echo $row['customer_name']; ?></span>
							</td>
							<td>
								<span class="amount" style = "color: #33cc33; font-size: 15px"><?php echo $row['customer_add']?></span>
							</td>
							<td>
								<span class="amount" style = "color: #33cc33; font-size: 15px"><?php echo $row['customer_phone']; ?></span>
							</td>
<!-- 							<td>
								<span class="amount" style = "color: #33cc33; font-size: 15px"><?php echo $row['customer_note']?></span>
							</td> -->
							<td>
								<span class="amount" style = "color: #33cc33; font-size: 15px"><?php echo $row['totalmoney']?> VNĐ</span>
							</td>
							<td>
								<span class="amount" style = "color: #33cc33; font-size: 15px"><?php echo $row['order_status']?></span>
							</td>
							<td>
								<span class="amount" style = "color: #33cc33; font-size: 15px"><?php echo $row['order_datetime']?></span>
							</td>
							<td class="product-update">
								<a href="updateOrder.php?order_id=<?php echo $row['order_id']?>" class="remove" title="Update this item"><i class="fa fa-refresh"></i></a>
							</td>
						
						<?php endwhile;?>

						<?php

							$sql = "SELECT * FROM order_customer WHERE order_status = 'Đang giao'
									ORDER BY order_datetime";
							$result = mysqli_query($connect, $sql);
							while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) :;
						?>

						<tr class="cart_item">
							<td>
								<span class="amount" style = "color: blue; font-size: 15px"><?php echo $row['order_id']?></span>
							</td>
							<td>
								<span class="amount" style = "color: blue; font-size: 15px"><?php echo $row['customer_name']; ?></span>
							</td>
							<td>
								<span class="amount" style = "color: blue; font-size: 15px"><?php echo $row['customer_add']?></span>
							</td>
							<td>
								<span class="amount" style = "color: blue; font-size: 15px"><?php echo $row['customer_phone']; ?></span>
							</td>
<!-- 							<td>
								<span class="amount" style = "color: #33cc33; font-size: 15px"><?php echo $row['customer_note']?></span>
							</td> -->
							<td>
								<span class="amount" style = "color: blue; font-size: 15px"><?php echo $row['totalmoney']?> VNĐ</span>
							</td>
							<td>
								<span class="amount" style = "color: blue; font-size: 15px"><?php echo $row['order_status']?></span>
							</td>
							<td>
								<span class="amount" style = "color: blue; font-size: 15px"><?php echo $row['order_datetime']?></span>
							</td>
							<td class="product-update">
								<a href="updateOrder.php?order_id=<?php echo $row['order_id']?>" class="remove" title="Update this item"><i class="fa fa-refresh"></i></a>
							</td>
						
						<?php endwhile;?>

						<?php

							$sql = "SELECT * FROM order_customer WHERE order_status = 'Đã nhận'";
							$result = mysqli_query($connect, $sql);
							while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) :;
						?>

						<tr class="cart_item">
							<td>
								<span class="amount" style = "font-size: 15px"><?php echo $row['order_id']?></span>
							</td>
							<td>
								<span class="amount" style = "font-size: 15px"><?php echo $row['customer_name']; ?></span>
							</td>
							<td>
								<span class="amount" style = "font-size: 15px"><?php echo $row['customer_add']?></span>
							</td>
							<td>
								<span class="amount" style = "font-size: 15px"><?php echo $row['customer_phone']; ?></span>
							</td>
<!-- 							<td>
								<span class="amount" style = "font-size: 15px"><?php echo $row['customer_note']?></span>
							</td> -->
							<td>
								<span class="amount" style = "font-size: 15px"><?php echo $row['totalmoney']?> VNĐ</span>
							</td>
							<td>
								<span class="amount" style = "font-size: 15px"><?php echo $row['order_status']?></span>
							</td>
							<td>
								<span class="amount" style = "font-size: 15px"><?php echo $row['order_datetime']?></span>
							</td>
							<td class="product-update">
								<a href="updateOrder.php" class="remove" title="Update this item"><i class="fa fa-refresh"></i></a>
							</td>
						
						<?php endwhile;?>

						<?php

							$sql = "SELECT * FROM order_customer WHERE order_status = 'Huỷ'";
							$result = mysqli_query($connect, $sql);
							while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) :;
						?>

						<tr class="cart_item">
							<td>
								<span class="amount" style = "color: #ff3300; font-size: 15px"><?php echo $row['order_id']?></span>
							</td>
							<td>
								<span class="amount" style = "color: #ff3300; font-size: 15px"><?php echo $row['customer_name']; ?></span>
							</td>
							<td>
								<span class="amount" style = "color: #ff3300; font-size: 15px"><?php echo $row['customer_add']?></span>
							</td>
							<td>
								<span class="amount" style = "color: #ff3300; font-size: 15px"><?php echo $row['customer_phone']; ?></span>
							</td>
<!-- 							<td>
								<span class="amount" style = "color: #ff3300; font-size: 15px"><?php echo $row['customer_note']?></span>
							</td> -->
							<td>
								<span class="amount" style = "color: #ff3300; font-size: 15px"><?php echo $row['totalmoney']?> VNĐ</span>
							</td>
							<td>
								<span class="amount" style = "color: #ff3300; font-size: 15px"><?php echo $row['order_status']?></span>
							</td>
							<td>
								<span class="amount" style = "color: #ff3300; font-size: 15px"><?php echo $row['order_datetime']?></span>
							</td>
							<td class="product-update">
								<a href="updateOrder.php" class="remove" title="Update this item"><i class="fa fa-refresh"></i></a>
							</td>
						
						<?php endwhile;?>
					</tbody>

				</table>
				<!-- End of Shop Table Products -->
			</div>
			<div class="clearfix"></div>

		</div> <!-- #content -->
	</div> <!-- .container -->
</body>