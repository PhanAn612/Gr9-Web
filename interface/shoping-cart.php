<?php
include '../php/header.php';
?>


	<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="index.php" class="stext-109 cl8 hov-cl1 trans-04">
				Home
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				Shoping Cart
			</span>
		</div>
	</div>
		

	<!-- Shoping Cart -->
	<form class="bg0 p-t-75 p-b-85" action="../php/process_order.php" method="POST">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <!-- Thông tin giỏ hàng -->
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        <!-- Bảng hiển thị giỏ hàng -->
                        <table class="table-shopping-cart">
                            <!-- Tiêu đề của bảng -->
                            <tr class="table_head">
                                <th class="column-1">Product</th>
                                <th class="column-2"></th>
                                <th class="column-3">Price</th>
                                <th class="column-4">Quantity</th>
                                <th class="column-5">Total</th>
                            </tr>
							
                            <!-- Lặp qua các mục trong giỏ hàng và hiển thị thông tin -->
							<?php foreach ($cart_items as $item): ?>
								<?php
								$total_item_price = $item['product_price'] * $item['quantity'];
								?>
								<tr class="table_row">
									<td class="column-1">
										<div class="how-itemcart1">
											<img src="<?php echo $item['product_img']?>" alt="IMG">
										</div>
									</td>
									<td class="column-2"><?php echo $item['product_name']?></td>
									<td class="column-3"><?php echo $item['product_price']?></td>
									<td class="column-4">
										<div class="wrap-num-product flex-w m-l-auto m-r-0">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>
											<!-- Số lượng sản phẩm -->
											<input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product1" value="<?php echo $item['quantity']?>" data-price="<?php echo $item['product_price'] ?>">
											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>
									</td>
									<td class="column-5">$ <span class="total-item-price"><?php echo number_format($total_item_price,2) ?></span></td>
								</tr>
							<?php endforeach; ?>

								


                        </table>
                    </div>

                    <!-- Cập nhật giỏ hàng và nhập mã giảm giá -->
                    <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                        <div class="flex-w flex-m m-r-20 m-tb-5">
                            <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon" placeholder="Coupon Code">
                            <div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
                                Apply coupon
                            </div>
                        </div>
                        <div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10" onclick="updateCart()">
                            Update Cart
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tổng tiền và thông tin vận chuyển -->
            <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                    <h4 class="mtext-109 cl2 p-b-30">
                        Cart Totals
                    </h4>
                    <!-- Tổng tiền -->
                    <div class="flex-w flex-t bor12 p-b-13">
                        <div class="size-208">
                            <span class="stext-110 cl2">Subtotal:</span>
                        </div>
                        <div class="size-209">
							<span class="mtext-110 cl2 total-cart-price">$<?php echo number_format($total_cart_price); ?></span>
                        </div>
                    </div>
                    <!-- Thông tin vận chuyển -->
					
                    <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                        <div class="size-208 w-full-ssm">
                            <span class="stext-110 cl2">Shipping:</span>
                        </div>
                        <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                            <p class="stext-111 cl6 p-t-2">There are no shipping methods available. Please double check your address, or contact us if you need any help.</p>
                            <!-- Form nhập thông tin vận chuyển -->
                            <div class="p-t-15">
                                
								<span class="stext-112 cl8">Calculate Shipping</span>
                                <div class="bor8 bg0 m-b-12">
									<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" id="nameInput" name="name" placeholder="Name">
								</div>
								<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
								<select class="js-select2" id="citySelect" name="city" onchange="checkCity()">
									<option value="">Select city...</option>
									<option value="HO_CHI_MINH">HO CHI MINH</option>
									<option value="HA_NOI">HA NOI</option>
									<option value="DA_NANG">DA NANG</option>
									<option value="HAI_PHONG">HAI PHONG</option>
								</select>
								<div class="dropDownSelect2"></div>
								</div>
								<div class="bor8 bg0 m-b-12">
									<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" id="districtInput" name="district" placeholder="District">
								</div>
								<div class="bor8 bg0 m-b-22">
									<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="postcode" placeholder="Address">
								</div>

                            </div>
                        </div>
                    </div>
                    <!-- Tổng tiền -->
                    <div class="flex-w flex-t p-t-27 p-b-33">
                        <div class="size-208">
                            <span class="mtext-101 cl2">Total:</span>
                        </div>
                        <div class="size-209 p-t-1">
                            <span class="mtext-110 cl2 total-cart-price">$<?php echo number_format($total_cart_price); ?></span>
                        </div>
                    </div>
                    <!-- Nút "Proceed to Checkout" -->
                    <button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer" type="submit">
                        Proceed to Checkout
                    </button>
                </div>
            </div>
        </div>
    </div>
	</form>

		
	
		

	<!-- Footer -->
	<footer class="bg3 p-t-75 p-b-32">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Categories
					</h4>

					<ul>
						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Women
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Men
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Shoes
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Watches
							</a>
						</li>
					</ul>
				</div>

				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Help
					</h4>

					<ul>
						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Track Order
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Returns 
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Shipping
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								FAQs
							</a>
						</li>
					</ul>
					
				</div>

				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						GET IN TOUCH
					</h4>

					<p class="stext-107 cl7 size-201">
						Any questions? Let us know in store at 8th floor, 379 Hudson St, New York, NY 10018 or call us on (+1) 96 716 6879
					</p>

					<div class="p-t-27">
						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-facebook"></i>
						</a>

						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-instagram"></i>
						</a>

						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-pinterest-p"></i>
						</a>
					</div>
				</div>

				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Newsletter
					</h4>

					<form>
						<div class="wrap-input1 w-full p-b-4">
							<input class="input1 bg-none plh1 stext-107 cl7" type="text" name="email" placeholder="email@example.com">
							<div class="focus-input1 trans-04"></div>
						</div>

						<div class="p-t-18">
							<button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
								Subscribe
							</button>
						</div>
					</form>
				</div>
			</div>

			<div class="p-t-40">
				<div class="flex-c-m flex-w p-b-18">
					<a href="#" class="m-all-1">
						<img src="images/icons/icon-pay-01.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="images/icons/icon-pay-02.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="images/icons/icon-pay-03.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="images/icons/icon-pay-04.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-all-1">
						<img src="images/icons/icon-pay-05.png" alt="ICON-PAY">
					</a>
				</div>

				<p class="stext-107 cl6 txt-center">
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> &amp; distributed by <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

				</p>
			</div>
		</div>
	</footer>


	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>
<script>
	function checkCity() {
    var citySelect = document.getElementById("citySelect");
    var districtInput = document.getElementById("districtInput");
    var selectedCity = citySelect.value;

    if (selectedCity === "") {
        districtInput.classList.remove("hide");
        districtInput.setAttribute("placeholder", "District");
    } else {
        districtInput.classList.add("hide");
        switch (selectedCity) {
            case "HO_CHI_MINH":
                districtInput.setAttribute("placeholder", "Quận 1");
                break;
            case "HA_NOI":
                districtInput.setAttribute("placeholder", "Quận Hoàn Kiếm");
                break;
            case "DA_NANG":
                districtInput.setAttribute("placeholder", "District in Da Nang");
                break;
            case "HAI_PHONG":
                districtInput.setAttribute("placeholder", "District in Hai Phong");
                break;
            default:
                districtInput.setAttribute("placeholder", "District");
                districtInput.classList.remove("hide");
                break;
        }
    }
}

</script>
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>
<!--===============================================================================================-->
	<script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function(){
			$(this).css('position','relative');
			$(this).css('overflow','hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function(){
				ps.update();
			})
		});
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
	<script>
	$(document).ready(function(){
		// Bắt sự kiện khi số lượng sản phẩm thay đổi
		$('.num-product').on('change', function() {
			updateTotalPrice($(this));
		});

		// Bắt sự kiện khi nút cộng trừ được click
		$('.btn-num-product-down').on('click', function () {
			var numInput = $(this).next();
			var numProduct = Number(numInput.val());
			if (numProduct > 0) {
				numInput.val(numProduct - 1);
				updateTotalPrice(numInput);
			}
		});

		$('.btn-num-product-up').on('click', function () {
			var numInput = $(this).prev();
			numInput.val(Number(numInput.val()) + 1);
			updateTotalPrice(numInput);
		});

		// Hàm cập nhật tổng giá của sản phẩm
		function updateTotalPrice(inputElement) {
			var pricePerProduct = Number(inputElement.data('price'));
			var quantity = Number(inputElement.val());
			var totalItemPrice = quantity * pricePerProduct;
			// Hiển thị tổng giá mới trong cột column-5 của sản phẩm
			var row = inputElement.closest('.table_row');
			row.find('.column-5').text('$ ' + totalItemPrice.toFixed(2));
			
			// Gọi hàm tính tổng giá của giỏ hàng khi số lượng sản phẩm thay đổi
			updateTotalCartPrice();
		}

		// Hàm tính lại tổng giá của tất cả các sản phẩm trong giỏ hàng
		function updateTotalCartPrice() {
			var totalCartPrice = 0;
			$('.column-5').each(function() {
				var totalItemPrice = parseFloat($(this).text().replace('$', '').trim());
				if (!isNaN(totalItemPrice)) {
					totalCartPrice += totalItemPrice;
				}
			});
			$('.total-cart-price').text('$ ' + totalCartPrice.toFixed(2));
		}

	});
	</script>


   
</script>
</body>
</html>