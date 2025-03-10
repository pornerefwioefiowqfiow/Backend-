<?php 
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['submit'])){
	if(!empty($_SESSION['cart']))
	{
		foreach($_POST['quantity'] as $key => $val)
		{
			if($val==0){
				unset($_SESSION['cart'][$key]);
			}else{
				$_SESSION['cart'][$key]['quantity']=$val;

			}
		}
			echo "<script>alert('Your Cart has been Updated');</script>";
		}
	}
// Code for Remove a Product from Cart
if(isset($_POST['remove_code']))
{
	if(!empty($_SESSION['cart'])){
		foreach($_POST['remove_code'] as $key)
		{
			
				unset($_SESSION['cart'][$key]);
		}
			echo "<script>alert('Your Cart has been Updated');</script>";
	}
}
// code for insert product in order table


if(isset($_POST['ordersubmit'])) 
{
	if(strlen($_SESSION['login'])==0){   
		header('location:login.php');
	} else {
		$o_quantity=$_SESSION['qnty'];
		$sessionAllData = $_SESSION['allData'];
		$p_id=$_SESSION['p_id'];

		$value =array_combine($p_id,$o_quantity);
		$orderSql ="INSERT INTO `orders` (`o_total`, `o_status`, `u_id`) VALUES ('".$_SESSION['totalprice']."', 'pending', '".$_SESSION['u_id']."')";
		$last_id;
		if(mysqli_query($con,$orderSql)){
		    $last_id = mysqli_insert_id($con);
			    echo "Records inserted successfully. Last inserted ID is: " . $last_id;
		}
		foreach($sessionAllData as $val34)
		{
		    $orerDetailSql ="INSERT INTO `order_detail` (`od_qty`, `p_price`, `p_id`, `o_id`) VALUES ( '".$val34['o_quantity']."', '".$val34['o_price']."', '".$val34['p_id']."', $last_id)";
		 	mysqli_query($con,$orerDetailSql);
		}
		unset($_SESSION['cart']);
		header('location:order-history.php');

	}

}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
	    <meta name="keywords" content="MediaCenter, Template, eCommerce">
	    <meta name="robots" content="all">

	    <title>My Cart</title>
	    <link rel="stylesheet" href="assets/css/main.css">
	    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
	    <link rel="stylesheet" href="assets/css/black.css">
	    <link rel="stylesheet" href="assets/css/owl.carousel.css">
		<link rel="stylesheet" href="assets/css/owl.transitions.css">
		<!--<link rel="stylesheet" href="assets/css/owl.theme.css">-->
		<link href="assets/css/lightbox.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/animate.min.css">
		<link rel="stylesheet" href="assets/css/rateit.css">
		<link rel="stylesheet" href="assets/css/bootstrap-select.min.css">

		<!-- Demo Purpose Only. Should be removed in production -->
		<link rel="stylesheet" href="assets/css/config.css">

		<link href="assets/css/green.css" rel="alternate stylesheet" title="Green color">
		<link href="assets/css/blue.css" rel="alternate stylesheet" title="Blue color">
		<link href="assets/css/red.css" rel="alternate stylesheet" title="Red color">
		<link href="assets/css/orange.css" rel="alternate stylesheet" title="Orange color">
		<link href="assets/css/dark-green.css" rel="alternate stylesheet" title="Darkgreen color">
		<!-- Demo Purpose Only. Should be removed in production : END -->

		<!-- Icons/Glyphs -->
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">

        <!-- Fonts --> 
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>

	</head>
    <body class="cnt-home">
		<header class="header-style-1">
			<?php include('includes/top-header.php');?>
			<?php include('includes/main-header.php');?>
			<?php include('includes/menu-bar.php');?>
		</header>
<!-- ============================================== HEADER : END ============================================== -->
		<div class="breadcrumb">
			<div class="container">
				<div class="breadcrumb-inner">
					<ul class="list-inline list-unstyled">
						<li><a href="#">Home</a></li>
						<li class='active'>Shopping Cart</li>
					</ul>
				</div><!-- /.breadcrumb-inner -->
			</div><!-- /.container -->
		</div><!-- /.breadcrumb -->

		<div class="body-content outer-top-xs">
			<div class="container">
				<div class="row inner-bottom-sm">
					<div class="shopping-cart">
						<div class="col-md-12 col-sm-12 shopping-cart-table ">
							<div class="table-responsive">
								<form name="cart" method="post">	
								<?php
								if(!empty($_SESSION['cart']))
								{
									?>
										<table class="table table-bordered">
											<thead>
												<tr>
													
													<th class="cart-description item">Image</th>
													<th class="cart-product-name item">Product Name</th>		
													<th class="cart-qty item">Quantity</th>
													<th class="cart-sub-total item">Price</th>
													<th class="cart-total last-item">Total Amount</th>
													<th class="cart-romove item">Remove</th>
												</tr>
											</thead><!-- /thead -->
											<tfoot>
												<tr>
													<td colspan="7">
														<div class="shopping-cart-btn">
															<span class="">
																<a href="index.php" class="btn btn-upper btn-primary outer-left-xs">Continue Shopping</a>
																<input type="submit" name="submit" value="Update cart" class="btn btn-upper btn-primary pull-right outer-right-xs">
															</span>
														</div><!-- /.shopping-cart-btn -->
													</td>
												</tr>
											</tfoot>
											<tbody>
<?php
$pdtid=array();
$productArray=array();
$allData=array();
$sql = "SELECT * FROM product WHERE p_id IN(";
	foreach($_SESSION['cart'] as $p_id => $value)
	{
		$sql .=$p_id. ",";
	}
	$sql=substr($sql,0,-1) . ") ORDER BY p_id ASC";
	$query = mysqli_query($con,$sql);
	$totalprice=0;
	$totalqunty=0;
	if(!empty($query))
	{
		while($row = mysqli_fetch_array($query))
		{
			$o_quantity=$_SESSION['cart'][$row['p_id']]['quantity'];
		    $subtotal= $_SESSION['cart'][$row['p_id']]['quantity']*$row['p_price'];
			$totalprice += $subtotal;
			$_SESSION['qnty']=$totalqunty+=$o_quantity;

			$productArray = array(
								'p_id' => $row['p_id'],
								'o_quantity' =>$o_quantity,
								'o_total' => $totalprice,
								'o_price' =>$row['p_price']
							 );
			array_push($allData, $productArray);
			array_push($pdtid,$row['p_id']);
	?>
		<tr>
			<td class="cart-image">
				<a class="entry-thumbnail" href="detail.html">
				    <img src="admin/uploads/<?php echo $row['p_image1'];?>" alt="" width="114" height="146">
				</a>
			</td>
			<td class="cart-product-name-info">
				<h4 class='cart-product-description'><a href="product-details.php?p_id=<?php echo htmlentities($pd=$row['p_id']);?>" ><?php echo $row['p_name'];

					$_SESSION['s_id']=$pd;
						 ?></a>
				</h4>
				<div class="row">
					<div class="col-sm-4">
						<div class="rating rateit-small"></div>
					</div>
					<div class="col-sm-8">
						<?php $rt=mysqli_query($con,"select * from product_review where p_id='$p_id'");
						$num=mysqli_num_rows($rt);
						{ ?>
							<div class="reviews">
								( <?php echo htmlentities($num);?> Reviews )
							</div>
					<?php } ?>
					</div>
				</div><!-- /.row -->
			</td>
			<td class="cart-product-quantity">
				<div class="quant-input">
	                <div class="arrows">
	           	       <div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span>
	            	      </div>
	                	  <div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span>
	                  	</div>
                	</div>
	             	<input type="text" value="<?php echo $_SESSION['cart'][$row['p_id']]['quantity']; ?>" name="quantity[<?php echo $row['p_id']; ?>]">
				             
              	</div>
            </td>
			<td class="cart-product-sub-total"><span class="cart-sub-total-price"><?php echo "&#8377;"." ".$row['p_price']; ?></span>
			</td>
			<td class="cart-product-grand-total"><span class="cart-grand-total-price"><?php echo "&#8377;". ($_SESSION['cart'][$row['p_id']]['quantity']*$row['p_price']); ?></span>
			</td>
			<td class="romove-item"><input type="checkbox" name="remove_code[]" value="<?php echo htmlentities($row['p_id']);?>" />
			</td>
		</tr>

<?php }
 }
$_SESSION['p_id']=$pdtid;
$_SESSION['totalprice']=$totalprice;
$_SESSION['allData']=$allData;
				?>
			
	</tbody><!-- /tbody -->
</table><!-- /table -->
	
</div>
</div><!-- /.shopping-cart-table -->			
<div class="col-md-4 col-sm-12 estimate-ship-tax">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>
					<span class="estimate-title">Shipping Address</span>
				</th>
			</tr>
		</thead>
		<tbody>
				<tr>
					<td>
						<div class="form-group">
						<?php $qry=mysqli_query($con,"select * from shipping where u_id='".$_SESSION['u_id']."'");
						$isAddressExit=false;
while ($rt=mysqli_fetch_array($qry)) {
	$isAddressExit=true;
	echo htmlentities($rt['address1'])."<br />";
	echo htmlentities($rt['address2'])."<br />";
	echo htmlentities($rt['address3'])."<br />";
	echo htmlentities($rt['landmark'])." - ";
	echo htmlentities($rt['pincode']);
}
if (!$isAddressExit) {
		?>
		<a href="bill-ship-addresses.php?cart=1">Add Address</a>
		<?php
}

						?>
		
						</div>
					
					</td>
				</tr>
		</tbody><!-- /tbody -->
	</table><!-- /table -->
</div>
<div class="col-md-4 col-sm-12 cart-shopping-total">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>
					
					<div class="cart-grand-total">
						Grand Total<span class="inner-left-md"><?php echo $_SESSION['tp']=  "&#8377;".$totalprice; ?></span>
					</div>
				</th>
			</tr>
		</thead><!-- /thead -->
		<tbody>
				<tr>
					<td>
						<div class="cart-checkout-btn pull-right">
							<?php
								if ($isAddressExit) {
									?>
									<button type="submit" name="ordersubmit" class="btn btn-primary">PROCCED TO CHEKOUT</button>
									<?php
								}
							 ?>
							
						
						</div>
					</td>
				</tr>
		</tbody><!-- /tbody -->
	</table>
	<?php } else {
echo "Your shopping Cart is empty";
		}?>
	</div>
</div>
</div> 
</form>
</div>
</div>
<?php include('includes/footer.php');?>

	<script src="assets/js/jquery-1.11.1.min.js"></script>
	
	<script src="assets/js/bootstrap.min.js"></script>
	
	<script src="assets/js/bootstrap-hover-dropdown.min.js"></script>
	<script src="assets/js/owl.carousel.min.js"></script>
	
	<script src="assets/js/echo.min.js"></script>
	<script src="assets/js/jquery.easing-1.3.min.js"></script>
	<script src="assets/js/bootstrap-slider.min.js"></script>
    <script src="assets/js/jquery.rateit.min.js"></script>
    <script type="text/javascript" src="assets/js/lightbox.min.js"></script>
    <script src="assets/js/bootstrap-select.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
	<script src="assets/js/scripts.js"></script>

	<!-- For demo purposes – can be removed on production -->
	
	<script src="switchstylesheet/switchstylesheet.js"></script>
	
	<script>
		$(document).ready(function(){ 
			$(".changecolor").switchstylesheet( { seperator:"color"} );
			$('.show-theme-options').click(function(){
				$(this).parent().toggleClass('open');
				return false;
			});
		});

		$(window).bind("load", function() {
		   $('.show-theme-options').delay(2000).trigger('click');
		});
	</script>
	<!-- For demo purposes – can be removed on production : End -->
</body>
</html>