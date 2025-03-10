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
	if(isset($_POST['post']))
	{
		$f_description=$_POST['f_description'];
		$u_id=$_SESSION['u_id'];
		$query=mysqli_query($con,"insert into feedback(f_description ,u_id) values('$f_description','$u_id')");
		if($query)
		{
			echo "<script>alert('Your feedback submitted');</script>";
		}
		else
		{
			echo "<script>alert('feedback not submitted');</script>";
		}
		header('location:feedback.php');

	}
	if(isset($_GET['del']))
	{
	    mysqli_query($con,"delete from feedback where f_id = '".$_GET['f_id']."'");
        $_SESSION['msgdel']="Feedback deleted !!";
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

	    <title>Women Clothing | Feedback</title>

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
		<style type="text/css">
			body{
				font-size: 13px !important;
		    color: #666666 !important;
		    background-color: #fff !important;
		    overflow-x: hidden !important;
		    margin: 0 !important;
		    padding: 0 !important;
		    font-family: 'Roboto', sans-serif !important;
			}
		</style>
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
	<h4 class="">Feedback</h4>
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
			<label class="info-title" for="forfeedback">Your Feedback <span>*</span></label>
			<textarea class="form-control " name="f_description" placeholder="Write your valuable feedback here..!" rows="5" cols="5" maxlength="255" required></textarea>
		</div>
		<button type="submit" class="btn-upper btn btn-primary checkout-page-button" name="post">Post</button>
</form>
</div>
</div>
</div>
		<div class="module">
		<div class="module-head">
			<h3>Your Feedback : - </h3>
		</div>
	<?php 
	$u_id=$_SESSION['u_id'];
	$query=mysqli_query($con,"select feedback.*, user.fname, user.lname from feedback join user on feedback.u_id = user.u_id where feedback.u_id=$u_id");

	while($row=mysqli_fetch_array($query))
	{
	?>	<br>
		<div class="module-body table">
		<table>
			<thead>
				<tr>
					<td><?php echo htmlentities($row['fname']." ".$row['lname']);?></td>
				</tr>
				<tr>
					<td><?php echo htmlentities($row['f_description']);?></td>
				</tr>
				<tr>
					<td><?php echo htmlentities($row['f_date']);?></td>
					<td><a href="feedback.php?f_id=<?php echo $row['f_id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class="">Delete</i></a></td>
				</tr>
			</thead>
		</table>
	<?php } ?>
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