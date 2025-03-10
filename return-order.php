<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
{   
	header('location:index.php');
}
else
{
	if(isset($_POST['submit']))
	{
		$od_id = $_REQUEST['od_id'];
		$u_id =$_SESSION['u_id'];
		$selectSql ="select
						product.p_name,
					    product.p_price,
						product.p_id,
					    orders.o_id 
					from order_detail 
						join orders on orders.o_id = order_detail.o_id
					    JOIN product on product.p_id = order_detail.p_id
    				where 
    					orders.u_id='".$_SESSION['u_id']."' and
    					order_detail.od_id= '".$od_id."'

    					";
		$query=mysqli_query($con,$selectSql);
		$row = mysqli_fetch_assoc($query);
		$insProductRe ="INSERT INTO `product_return` (`p_id`, `o_id`, `u_id`) VALUES ('".$row['p_id']."', '".$row['o_id']."', '".$_SESSION['u_id']."');";
		$last_id;
		if(mysqli_query($con,$insProductRe)){
		    $last_id = mysqli_insert_id($con);
		    $insProductReDetail="INSERT INTO `product_return_detail` (`reason_of_return`, `p_name`, `p_price`, `pr_id`) VALUES ('".$_POST['reason_of_return']."', '".$row['p_name']."', '".$row['p_price']."', '".$last_id."');";
		    	if(mysqli_query($con,$insProductReDetail)){
		    		echo "<script>alert('Your reason submitted');</script>";
		    	}
		}
		else
		{
			echo "<script>alert('reason not submitted');</script>";
		}
		header('location:order-history.php');
	}
	if(isset($_POST['submit']))
	{
		$sql = "select o_id from order_detail where od_id=$od_id";
      	$c = mysqli_query($con,$sql);
      	$row = mysqli_fetch_assoc($c);
      	$o_id = $row['o_id'];
		$sql=mysqli_query($con,"update orders set o_status='return' where o_id='$o_id'");
		echo "<script>alert('Order updated sucessfully...');</script>";
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

	    <title>Women Clothing | Return Order</title>

	    <!-- Bootstrap Core CSS -->
	    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
	    
	    <!-- Customizable CSS -->
	    <link rel="stylesheet" href="assets/css/main.css">
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
		
		<!-- Favicon -->
		<!-- <link rel="shortcut icon" href="assets/images/favicon.ico"> -->
</head>
<body class="cnt-home">
	
		
	
		<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">

	<!-- ============================================== TOP MENU ============================================== -->
<?php include('includes/top-header.php');?>
<!-- ============================================== TOP MENU : END ============================================== -->
<?php include('includes/main-header.php');?>
	<!-- ============================================== NAVBAR ============================================== -->
<?php include('includes/menu-bar.php');?>
<!-- ============================================== NAVBAR : END ============================================== -->

</header>

<!-- ============================================== HEADER : END ============================================== -->

<div class="body-content outer-top-bd">
	<div class="container">
		<div class="sign-in-page inner-bottom-sm">
			<div class="row">
				<!-- Sign-in -->			
				<div class="col-md-3 col-sm-3">
				</div>
<div class="col-md-6 col-sm-6 sign-in" id="loginPage">
	<h4 class="">Product Return</h4>
	<p class=""><!-- Hello, Welcome to your account. --></p>
	<form class="register-form outer-top-xs" method="post">
	<span style="color:red;" >
<?php
echo htmlentities($_SESSION['errmsg']);
?>
<?php
echo htmlentities($_SESSION['errmsg']="");
?>

</span>
		<div class="form-group">
			<label class="info-title" for="forreturn">Reason for Return <span>*</span></label>
			<textarea class="form-control " name="reason_of_return" placeholder="Write your reason for product return..!" rows="5" cols="5"></textarea>
		</div>
		<button type="submit" class="btn-upper btn btn-primary checkout-page-button" name="submit">Submit</button>
</form>
</div>
</div>
</div>
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