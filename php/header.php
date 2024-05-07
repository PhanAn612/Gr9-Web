<?php 
error_reporting(0);
include '../php/addToCart.php';
?>
<?php
// Kết nối đến cơ sở dữ liệu
require '../php/connect.php';

if(isset($_GET['search'])) {
    $searchKeyword = $_GET['search'] ?? '';
    
    if(!empty($searchKeyword)) {
        $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE ?");
        $searchKeyword = "%$searchKeyword%";
        $stmt->bind_param("s", $searchKeyword);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $products = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            echo "Không có sản phẩm nào.";
        }
        
        $stmt->close();
    } else {
        echo "Từ khóa tìm kiếm không được để trống.";
    }
} else {
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $products = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        echo "Không có sản phẩm nào.";
    }
}

$conn->close();

?>
<?php

require '../php/connect.php';
if (isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];

    if (!empty($productId)) {
        // Sanitize input
        $productId = intval($productId);

        $stmt = $conn->prepare("SELECT * FROM products WHERE idProduct = ?");
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $productInfo = [
                'id' => $row['idProduct'],
                'name' => $row['name'],
                'price' => $row['price'],
                'category' => $row['category'],
                'image' => $row['image'],
                'image2' => $row['image2'],
                'image3' => $row['image3'],
                'description' => $row['description']
            ];
            // Bạn có thể thực hiện xử lý dữ liệu ở đây
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Product Detail</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/linearicons-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/MagnificPopup/magnific-popup.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body class="animsition">
	
	<!-- Header -->
	<header class="header-v4">
		 <!-- Header desktop  -->
		<div class="container-menu-desktop">
			 <!-- Topbar  -->
			

			<div class="wrap-menu-desktop how-shadow1">
				<nav class="limiter-menu-desktop container">
					
					<!-- Logo desktop -->		
					<a href="index.php" class="logo">
						<img src="images/icons/logo-01.png" alt="IMG-LOGO">
					</a>

					<!-- Menu desktop -->
					<div class="menu-desktop">
						<ul class="main-menu">
							<li>
								<a href="index.php">Home</a>
								<ul class="sub-menu">
									<li><a href="index.php">Homepage 1</a></li>
									<li><a href="home-02.html">Homepage 2</a></li>
									<li><a href="home-03.html">Homepage 3</a></li>
								</ul>
							</li>

							<li>
								<a href="product.php">Shop</a>
							</li>

							<li>
								<a href="blog.html">Blog</a>
							</li>

							<li>
								<a href="about.html">About</a>
							</li>

							<li>
								<a href="contact.html">Contact</a>
							</li>
						</ul>
					</div>	

					<!-- Icon header -->
					<div class="wrap-icon-header flex-w flex-r-m">
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
							<i class="zmdi zmdi-search"></i>
						</div>

						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="<?php echo $total_quantity; ?>">
							<i class="zmdi zmdi-shopping-cart"></i>
						</div>

						<!-- <a href="#" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti" data-notify="0">
							<i class="zmdi zmdi-favorite-outline"></i>
						</a> -->
						
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 " >
							<i class="zmdi zmdi-account"></i> <span><?php echo $fullName?></span>
						</div>
						
					</div>
				</nav>
			</div>	
		</div>

		<!-- Header Mobile -->
		<div class="wrap-header-mobile">
			<!-- Logo moblie -->		
			<div class="logo-mobile">
				<a href="index.php"><img src="images/icons/logo-01.png" alt="IMG-LOGO"></a>
			</div>

			<!-- Icon header -->
			<div class="wrap-icon-header flex-w flex-r-m m-r-15">
				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
					<i class="zmdi zmdi-search"></i>
				</div>

				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="<?php echo $total_quantity; ?>">
					<i class="zmdi zmdi-shopping-cart"></i>
				</div>

				<a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti" data-notify="0">
					<i class="zmdi zmdi-favorite-outline"></i>
				</a>
			</div>

			<!-- Button show menu -->
			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>


		<!-- Menu Mobile -->
		<div class="menu-mobile">
			<ul class="topbar-mobile">
				<li>
					<div class="left-top-bar">
						Free shipping for standard order over $100
					</div>
				</li>

				<li>
					<div class="right-top-bar flex-w h-full">
						<a href="#" class="flex-c-m p-lr-10 trans-04">
							My Account
						</a>
					</div>
				</li>
			</ul>

			<ul class="main-menu-m">
				<li>
					<a href="index.php">Home</a>
					<ul class="sub-menu-m">
						<li><a href="index.php">Homepage 1</a></li>
						<li><a href="home-02.html">Homepage 2</a></li>
						<li><a href="home-03.html">Homepage 3</a></li>
					</ul>
					<span class="arrow-main-menu-m">
						<i class="fa fa-angle-right" aria-hidden="true"></i>
					</span>
				</li>

				<li>
					<a href="product.php">Shop</a>
				</li>

				<li>
					<a href="blog.html">Blog</a>
				</li>

				<li>
					<a href="about.html">About</a>
				</li>

				<li>
					<a href="contact.html">Contact</a>
				</li>
			</ul>
		</div>

		<!-- Modal Search -->
		<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
			<div class="container-search-header">
				<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
					<img src="images/icons/icon-close2.png" alt="CLOSE">
				</button>

				<form class="wrap-search-header flex-w p-l-15">
					<button class="flex-c-m trans-04">
						<i class="zmdi zmdi-search"></i>
					</button>
					<input class="plh3" type="text" name="search" placeholder="Search...">
				</form>
			</div>
		</div>
	</header> 
	<!-- Cart -->
	<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
            <span class="mtext-103 cl2">
                Your Cart
            </span>

            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>

        <div class="header-cart-content flex-w js-pscroll">
            <ul class="header-cart-wrapitem w-full">
                
			<?php
								// Mảng để lưu trữ giỏ hàng sau khi gộp các sản phẩm trùng nhau
								$merged_cart_items = [];

								// Duyệt qua các sản phẩm trong giỏ hàng
								foreach ($cart_items as $item) {
									// Biến cờ để kiểm tra xem sản phẩm đã tồn tại trong mảng giỏ hàng mới hay chưa
									$is_existing_item = false;

									// Duyệt qua các sản phẩm đã gộp trong mảng giỏ hàng mới
									foreach ($merged_cart_items as &$merged_item) {
										// Nếu sản phẩm đã tồn tại trong mảng giỏ hàng mới
										if ($merged_item['product_id'] === $item['product_id']) {
											// Tăng số lượng sản phẩm
											$merged_item['quantity'] += 1;
											// Đặt cờ là sản phẩm đã tồn tại
											$is_existing_item = true;
											// Thoát khỏi vòng lặp trong
											break;
										}
									}

									// Nếu sản phẩm chưa tồn tại trong mảng giỏ hàng mới
									if (!$is_existing_item) {
										// Thêm sản phẩm vào mảng giỏ hàng mới
										$merged_cart_items[] = $item;
									}
								}

								// Sau khi gộp các sản phẩm trùng nhau, bạn có thể sử dụng mảng $merged_cart_items để hiển thị giỏ hàng trên trang web.
									
							?>
                            <!-- Lặp qua các mục trong giỏ hàng và hiển thị thông tin -->
								
							<?php foreach ($merged_cart_items as $item): ?>
								<li class="header-cart-item flex-w flex-t m-b-12">
									<div class="header-cart-item-img">
										<img src="<?php echo $item['product_img']; ?>" alt="IMG">
									</div>

									<div class="header-cart-item-txt p-t-8">
										<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
											<?php echo $item['product_name']; ?>
										</a>

										<span class="header-cart-item-info">
											<?php echo $item['quantity']; ?> x <?php echo $item['price']; ?>
										</span>
									</div>
								</li>
							<?php endforeach; ?>
            </ul>

            <div class="w-full">
                <div class="header-cart-total w-full p-tb-40">
                    Total: $<?php echo number_format($total_cart_price, 2); ?> <!-- Hiển thị tổng giá trị của giỏ hàng -->
                </div>

                <div class="header-cart-buttons flex-w w-full">
                    <a href="shoping-cart.php" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                        View Cart
                    </a>

                    <a href="shoping-cart.html" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                        Check Out
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>