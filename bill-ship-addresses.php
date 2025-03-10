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
	// code for shipping address updation
	if(isset($_POST['update']))
	{
		$address1=$_POST['address1'];
		$address2=$_POST['address2'];
		$address3=$_POST['address3'];
		$landmark=$_POST['landmark'];
		$pincode=$_POST['pincode'];
		$query=mysqli_query($con,"update shipping set address1='$address1',address2='$address2',address3='$address3',landmark='$landmark',pincode='$pincode' where u_id='".$_SESSION['u_id']."'");
		if($query)
		{
			header('location:bill-ship-addresses.php?us');
			echo "<script>alert('Shipping Address has been updated');</script>";
		}
		
	} else if(isset($_POST['save']))
	{
		$address1=$_POST['address1'];
		$address2=$_POST['address2'];
		$address3=$_POST['address3'];
		$landmark=$_POST['landmark'];
		$pincode=$_POST['pincode'];
		$query = mysqli_query($con,"INSERT INTO `shipping` (`address1`, `address2`, `address3`, `landmark`, `pincode`, `u_id`) VALUES ('$address1', '$address2', '$address3', '$landmark', '$pincode', '".$_SESSION['u_id']."')");
		if($query)
		{
			if ($_GET['cart']=='1') {
				header('location:my-cart.php');	
			}
			else{
				header('location:bill-ship-addresses.php?is');
			}

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

	    <title>My Account</title>

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
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
		<!-- <link rel="shortcut icon" href="assets/images/favicon.ico"> -->

	</head>
<body class="cnt-home">
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
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="#">Home</a></li>
				<li class='active'>Checkout</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-bd">
	
	<div class="container">
		
		<div class="checkout-box inner-bottom-sm">
			<div class="checkout-box">
			<div class="row">
				<div class="col-md-8">
					<?php if(isset($_GET['is'])){
							echo "<h3 class='unicase-checkout-title' style='color:#84b943'>Shipping Address has been inserted</h3>";
					}else if(isset($_GET['us'])){
						echo "<h3 class='unicase-checkout-title'  style='color:#84b943'>Shipping Address has been updated</h3>";
					}
					?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8">
					<div class="panel-group checkout-steps" id="accordion">
						<!-- checkout-step-01  -->
<form class="register-form" role="form" method="post">
<div class="panel panel-default checkout-step-01">

	<!-- panel-heading -->
		<div class="panel-heading">
    	<h4 class="unicase-checkout-title">
	        <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
	          <span>#</span>Shipping Address
	        </a>
	     </h4>
    </div>
    <!-- panel-heading -->

	<div id="collapseOne" class="panel-collapse collapse in">

		<!-- panel-body  -->
	    <div class="panel-body">
<?php
$u_id=$_SESSION['u_id'];
$query=mysqli_query($con,"select * from shipping where u_id='".$_SESSION['u_id']."'");

while($row=mysqli_fetch_array($query))
	//print_r($row);
{
?>

<form class="register-form" role="form" method="post">
<div class="form-group">
 <label class="info-title" for="Shipping Address1">Address 1<span>*</span></label>
	<textarea class="form-control unicase-form-control text-input" name="address1" required="required"> <?php echo $row['address1'];?></textarea>
</div>
<div class="form-group">
 <label class="info-title" for="Shipping Address2">Address 2<span>*</span></label>
	<textarea class="form-control unicase-form-control text-input" name="address2" required="required"> <?php echo $row['address2'];?></textarea>
</div>
<div class="form-group">
 <label class="info-title" for="Shipping Address3">Address 3<span>*</span></label>
	<textarea class="form-control unicase-form-control text-input" name="address3" required="required"> <?php echo $row['address3'];?></textarea>
</div>

<div class="form-group">
<label class="info-title" for="Shipping Landmark">Landmark  <span>*</span></label>
	<input type="text" class="form-control unicase-form-control text-input" id="landmark" name="landmark" value="<?php echo $row['landmark'];?>" required>
 </div>

					
 <div class="form-group">
 <label class="info-title" for="Shipping Pincode">Pincode <span>*</span></label>
	<input type="text" class="form-control unicase-form-control text-input" id="pincode" name="pincode" maxlength="6" required="required" value="<?php echo $row['pincode'];?>">
</div>

<button type="submit" name="update" class="btn-upper btn btn-primary checkout-page-button">Update</button>

</form>
<?php }
if (mysqli_num_rows($query) == 0) 
{
	?>
	<form class="register-form" role="form" method="post">
<div class="form-group">
 <label class="info-title" for="Shipping Address1">Address 1<span>*</span></label>
	<textarea class="form-control unicase-form-control text-input" name="address1" required="required"> </textarea>
</div>
<div class="form-group">
 <label class="info-title" for="Shipping Address2">Address 2<span>*</span></label>
	<textarea class="form-control unicase-form-control text-input" name="address2" required="required"> </textarea>
</div>
<div class="form-group">
 <label class="info-title" for="Shipping Address3">Address 3<span>*</span></label>
	<textarea class="form-control unicase-form-control text-input" name="address3" required="required"> </textarea>
</div>

<div class="form-group">
<label class="info-title" for="Shipping Landmark">Landmark  <span>*</span></label>
	<input type="text" class="form-control unicase-form-control text-input" id="landmark" name="landmark"  required>
 </div>

					
 <div class="form-group">
 <label class="info-title" for="Shipping Pincode">Pincode <span>*</span></label>
	<input type="text" class="form-control unicase-form-control text-input" id="pincode" name="pincode" maxlength="6" required="required" >
</div>

<button type="submit" name="save" class="btn-upper btn btn-primary checkout-page-button">Save</button>

</form>


<?php } ?>


						      </div>
						    </div>
					  	</div>
					  	<!-- checkout-step-02  -->
					  	
					</div><!-- /.checkout-steps -->
				</div>
			<?php include('includes/myaccount-sidebar.php');?>
			</div><!-- /.row -->
		</div><!-- /.checkout-box -->
	<?php //include('includes/brands-slider.php');?>

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
		jquery(document).ready(function(){ 
			jquery(".changecolor").switchstylesheet( { seperator:"color"} );
			jquery('.show-theme-options').click(function(){
				jquery(this).parent().toggleClass('open');
				return false;
			});
		});

		jquery(window).bind("load", function() {
		   jquery('.show-theme-options').delay(2000).trigger('click');
		});
	</script>
</body>
</html>
<?php } ?>