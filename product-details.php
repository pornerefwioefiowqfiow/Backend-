<?php 
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_GET['action']) && $_GET['action']=="add")
{
	$p_id=intval($_GET['p_id']);
	if(isset($_SESSION['cart'][$p_id]))
	{
		$_SESSION['cart'][$p_id]['quantity']++;
	}
	else
	{
		$sql_p="SELECT * FROM product WHERE p_id={$p_id}";
		$query_p=mysqli_query($con,$sql_p);
		if(mysqli_num_rows($query_p)!=0)
		{
			$row_p=mysqli_fetch_array($query_p);
			$_SESSION['cart'][$row_p['p_id']]=array("quantity" => 1, "price" => $row_p['p_price']);
			header('location:my-cart.php');
		}
		else
		{
			$message="Product ID is invalid";
		}
	}
}
$p_id=intval($_GET['p_id']);
if(isset($_POST['submit']))
{
	$r_rating=$_POST['r_rating'];
	$r_review=$_POST['r_review'];
	mysqli_query($con,"insert into product_review(r_rating, r_review, p_id, u_id) values('$r_rating','$r_review','$p_id','".$_SESSION['u_id']."')");
}
if(isset($_GET['del']))
{
	mysqli_query($con,"delete from product_review where r_id = '".$_GET['r_id']."'");
    $_SESSION['msgdel']="Review deleted !!";
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
	    <meta name="keywords" content="MediaCenter, Template, eCommerce">
	    <meta name="robots" content="all">
	    <title>Women Clothing | Product Details</title>
	    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
	    <link rel="stylesheet" href="assets/css/main.css">
	    <link rel="stylesheet" href="assets/css/black.css">
	    <link rel="stylesheet" href="assets/css/owl.carousel.css">
		<link rel="stylesheet" href="assets/css/owl.transitions.css">
		<link href="assets/css/lightbox.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/animate.min.css">
		<link rel="stylesheet" href="assets/css/rateit.css">
		<link rel="stylesheet" href="assets/css/bootstrap-select.min.css">
		<link rel="stylesheet" href="assets/css/config.css">

		<link href="assets/css/green.css" rel="alternate stylesheet" title="Green color">
		<link href="assets/css/blue.css" rel="alternate stylesheet" title="Blue color">
		<link href="assets/css/red.css" rel="alternate stylesheet" title="Red color">
		<link href="assets/css/orange.css" rel="alternate stylesheet" title="Orange color">
		<link href="assets/css/dark-green.css" rel="alternate stylesheet" title="Darkgreen color">
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">

        <!-- Fonts --> 
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
<?php
$ret=mysqli_query($con,"select category.c_name,sub_category.sub_name,product.p_name from product join category on product.c_id=category.c_id join sub_category on product.sub_id=sub_category.sub_id where product.p_id='$p_id'");
while ($rw=mysqli_fetch_array($ret)) 
{

?>


			<ul class="list-inline list-unstyled">
				<li><a href="index.php">Home</a></li>
				<li><?php echo htmlentities($rw['c_name']);?></a></li>
				<li><?php echo htmlentities($rw['sub_name']);?></li>
				<li class='active'><?php echo htmlentities($rw['p_name']);?></li>
			</ul>
			<?php }?>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
	<div class='container'>
		<div class='row single-product outer-bottom-sm '>
			<div class='col-md-3 sidebar'>
				<div class="sidebar-module-container">


					<!-- ==============================================CATEGORY============================================== -->
<div class="sidebar-widget outer-bottom-xs wow fadeInUp">
	<h3 class="section-title">Category</h3>
	<div class="sidebar-widget-body m-t-10">
		<div class="accordion">

<?php $sql=mysqli_query($con,"select c_id, c_name from category");
while($row=mysqli_fetch_array($sql))
{
    ?>
	    	<div class="accordion-group">
	            <div class="accordion-heading">
	                <a href="category.php?cid=<?php echo $row['c_id'];?>"  class="accordion-toggle collapsed">
	                   <?php echo $row['c_name'];?>
	                </a>
	            </div>
	          
	        </div>
	        <?php } ?>
	    </div>
	</div>
</div>
	<!-- ============================================== CATEGORY : END ============================================== -->					<!-- ============================================== HOT DEALS ============================================== -->
<div class="sidebar-widget hot-deals wow fadeInUp">
	<h3 class="section-title">today's deals</h3>
	<div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-xs">
		
<?php
$ret=mysqli_query($con,"select * from product order by rand() limit 4 ");
while ($rws=mysqli_fetch_array($ret)) 
{

?>

								        
				<div class="item">
					<div class="products">
						<div class="hot-deal-wrapper">
							<div class="image">
								<img src="admin/uploads/<?php echo htmlentities($rws['p_image1']);?>"  width="200" height="334" alt="">
							</div>
							
						</div><!-- /.hot-deal-wrapper -->

						<div class="product-info text-left m-t-20">
							<h3 class="name"><a href="product-details.php?p_id=<?php echo htmlentities($rws['p_id']);?>"><?php echo htmlentities($rws['p_name']);?></a></h3>
							<div class="rating rateit-small"></div>

							<div class="product-price">	
								<span class="price">
									&#8377;<?php echo htmlentities($rws['p_price']);?>
								</span>
							
							</div><!-- /.product-price -->
							
						</div><!-- /.product-info -->

						<div class="cart clearfix animate-effect">
							<div class="action">
								
								<div class="add-cart-button btn-group">
									<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
								<i class="fa fa-shopping-cart"></i>													
							</button>
						<a href="product-details.php?page=product&action=add&p_id=<?php echo $rws['p_id']; ?>" class="lnk btn btn-primary" style="padding: 6px 12px;">Add to cart</a>
													
															
								</div>
								
							</div><!-- /.action -->
						</div><!-- /.cart -->
					</div>	
					</div>		
					<?php } ?>        
						
	    
    </div><!-- /.sidebar-widget -->
</div>

<!-- ============================================== COLOR: END ============================================== -->
				</div>
			</div><!-- /.sidebar -->
<?php 
$ret=mysqli_query($con,"select * from product where p_id='$p_id'");
while($row=mysqli_fetch_array($ret))
{

?>


			<div class='col-md-9'>
				<div class="row  wow fadeInUp">
					     <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
    <div class="product-item-holder size-big single-product-gallery small-gallery">

        <div id="owl-single-product">

 <div class="single-product-gallery-item" id="slide1">
                <a data-lightbox="image-1" data-title="<?php echo htmlentities($row['p_name']);?>" href="admin/uploads/<?php echo htmlentities($row['p_image1']);?>">
                    <img class="img-responsive" alt="" src="assets/images/blank.gif" data-echo="admin/uploads/<?php echo htmlentities($row['p_image1']);?>" width="370" height="350" />
                </a>
            </div>




            <div class="single-product-gallery-item" id="slide1">
                <a data-lightbox="image-1" data-title="<?php echo htmlentities($row['p_name']);?>" href="admin/uploads/<?php echo htmlentities($row['p_image1']);?>">
                    <img class="img-responsive" alt="" src="assets/images/blank.gif" data-echo="admin/uploads/<?php echo htmlentities($row['p_image1']);?>" width="370" height="350" />
                </a>
            </div><!-- /.single-product-gallery-item -->

            <div class="single-product-gallery-item" id="slide2">
                <a data-lightbox="image-1" data-title="Gallery" href="admin/uploads/<?php echo htmlentities($row['p_image2']);?>">
                    <img class="img-responsive" alt="" src="assets/images/blank.gif" data-echo="admin/uploads/<?php echo htmlentities($row['p_image2']);?>" />
                </a>
            </div><!-- /.single-product-gallery-item -->

            <div class="single-product-gallery-item" id="slide3">
                <a data-lightbox="image-1" data-title="Gallery" href="admin/uploads/<?php echo htmlentities($row['p_image3']);?>">
                    <img class="img-responsive" alt="" src="assets/images/blank.gif" data-echo="admin/uploads/<?php echo htmlentities($row['p_image3']);?>" />
                </a>
            </div>

        </div><!-- /.single-product-slider -->


        <div class="single-product-gallery-thumbs gallery-thumbs">

            <div id="owl-single-product-thumbnails">
                <div class="item">
                    <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="1" href="#slide1">
                        <img class="img-responsive"  alt="" src="assets/images/blank.gif" data-echo="admin/uploads/<?php echo htmlentities($row['p_image1']);?>" />
                    </a>
                </div>

            <div class="item">
                    <a class="horizontal-thumb" data-target="#owl-single-product" data-slide="2" href="#slide2">
                        <img class="img-responsive" width="85" alt="" src="assets/images/blank.gif" data-echo="admin/uploads/<?php echo htmlentities($row['p_image2']);?>"/>
                    </a>
                </div>
                <div class="item">

                    <a class="horizontal-thumb" data-target="#owl-single-product" data-slide="3" href="#slide3">
                        <img class="img-responsive" width="85" alt="" src="assets/images/blank.gif" data-echo="admin/uploads/<?php echo htmlentities($row['p_image3']);?>" height="200" />
                    </a>
                </div>

               
               
                
            </div><!-- /#owl-single-product-thumbnails -->

            

        </div>

    </div>
</div>     			




	<div class='col-sm-6 col-md-7 product-info-block'>
		<div class="product-info">
			<h1 class="name"><?php echo htmlentities($row['p_name']);?></h1>
<?php $rt=mysqli_query($con,"select * from product_review where p_id='$p_id'");
$num=mysqli_num_rows($rt);
{
?>		
		<div class="rating-reviews m-t-20">
			<div class="row">
				<div class="col-sm-3">
					<div class="rating rateit-small"></div>
				</div>
					<div class="col-sm-8">
						<div class="reviews">
							<a href="#" class="lnk">(<?php echo htmlentities($num);?> Reviews)</a>
						</div>
					</div>
			</div><!-- /.row -->		
		</div><!-- /.rating-reviews -->
<?php } ?>
							<!-- <div class="stock-container info-container m-t-10">
								<div class="row">
									<div class="col-sm-3">
										<div class="stock-box">
											<span class="label">Availability :</span>
										</div>	
									</div>
									<div class="col-sm-9">
										<div class="stock-box">
											<span class="value"><?php echo htmlentities($row['productAvailability']);?></span>
										</div>	
									</div> -->
								<!-- </div> --><!-- /.row -->	
							<!-- </div> -->



<!-- <div class="stock-container info-container m-t-10">
								<div class="row">
									<div class="col-sm-3">
										<div class="stock-box">
											<span class="label">Product Brand :</span>
										</div>	
									</div>
									<div class="col-sm-9">
										<div class="stock-box">
											<span class="value"><?php echo htmlentities($row['productCompany']);?></span>
										</div>	
									</div>
 -->								<!-- </div> --><!-- /.row -->	
								<!-- </div> -->


<!-- <div class="stock-container info-container m-t-10">
								<div class="row">
									<div class="col-sm-3">
										<div class="stock-box">
											<span class="label">Shipping Charge :</span>
										</div>	
									</div>
									<div class="col-sm-9">
										<div class="stock-box">
											<span class="value"><?php if($row['shippingCharge']==0)
											{
												echo "Free";
											}
											else
											{
												echo htmlentities($row['shippingCharge']);
											}

											?></span>
										</div>	
									</div>
 -->								<!-- </div> --><!-- /.row -->	
							<!-- </div> -->

							<div class="price-container info-container m-t-20">
								<div class="row">
									

									<div class="col-sm-6">
										<div class="price-box">
											<span class="price">&#8377;<?php echo htmlentities($row['p_price']);?></span>
										</div>
									</div>




									<!-- <div class="col-sm-6">
										<div class="favorite-button m-t-10">
											<a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Wishlist" href="product-details.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist">
											    <i class="fa fa-heart"></i>
											</a>
											
											</a>
										</div>
									</div> -->

								</div><!-- /.row -->
							</div><!-- /.price-container -->

	




							<div class="quantity-container info-container">
								<div class="row">
									
									<div class="col-sm-2">
										<span class="label">Qty :</span>
									</div>
									
									<div class="col-sm-2">
										<div class="cart-quantity">
											<div class="quant-input">
								                <div class="arrows">
								                  <div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
								                  <div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
								                </div>
								                <input type="text" value="1">
							              </div>
							            </div>
									</div>

									<div class="col-sm-7">
										<a href="product-details.php?page=product&action=add&p_id=<?php echo $row['p_id']; ?>" class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</a>
									</div>

									
								</div><!-- /.row -->
							</div><!-- /.quantity-container -->

							<!-- <div class="product-social-link m-t-20 text-right">
								<span class="social-label">Share :</span>
								<div class="social-icons">
						            <ul class="list-inline">
						                <li><a class="fa fa-facebook" href="http://facebook.com/transvelo"></a></li>
						                <li><a class="fa fa-twitter" href="#"></a></li>
						                <li><a class="fa fa-linkedin" href="#"></a></li>
						                <li><a class="fa fa-rss" href="#"></a></li>
						                <li><a class="fa fa-pinterest" href="#"></a></li>
						            </ul> --><!-- /.social-icons
						        </div>
							</div> -->

							

							
						</div><!-- /.product-info -->
					</div><!-- /.col-sm-7 -->
				</div><!-- /.row -->

				
				<div class="product-tabs inner-bottom-xs  wow fadeInUp">
					<div class="row">
						<div class="col-sm-3">
							<ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
								<li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
								<li><a data-toggle="tab" href="#review">REVIEW</a></li>
							</ul><!-- /.nav-tabs #product-tabs -->
						</div>
						<div class="col-sm-9">

							<div class="tab-content">
								
								<div id="description" class="tab-pane in active">
									<div class="product-tab">
										<p class="text"><?php echo $row['p_description'];?></p>
									</div>	
								</div><!-- /.tab-pane -->

								<div id="review" class="tab-pane">
									<div class="product-tab">
																				
<div class="product-reviews">
	<h4 class="title">User Reviews</h4>
<?php $qry=mysqli_query($con,"select product_review.*, user.fname, user.lname from product_review join user on product_review.u_id=user.u_id where p_id='$p_id'");
while($rvw=mysqli_fetch_array($qry))
{
?>

		<div class="reviews" style="border: solid 1px #000; padding-left: 2% ">
			<div class="review">
				<div class="review-title"><span class="r_review"><?php echo htmlentities($rvw['fname']." ".$rvw['lname']);?></span></div>
				<div class="text"><b>Rating :</b>  <?php echo htmlentities($rvw['r_rating']);?> Star</div>
				<div class="review-title"><span class="r_review"><?php echo htmlentities($rvw['r_review']);?></span><br>
					<span class="date"><i class="fa fa-calendar"></i><span><?php echo htmlentities($rvw['r_date']);?>
					<span>
						<a href="product-details.php?r_id=<?php echo $rvw['r_id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class="">Delete</i></a></td>
					</span></span></span></div>
				
                <!-- <div class="author m-t-15"><i class="fa fa-pencil-square-o"></i> <span class="name"><?php echo htmlentities($rvw['name']);?></span></div> -->
            </div>
		</div>
<?php } ?><!-- /.reviews -->
	</div><!-- /.product-reviews -->
										<form role="form" class="cnt-form" name="review" method="post">

										
										<div class="product-add-review">
											<h4 class="title">Write your reviews</h4>
											<div class="review-table">
												<div class="table-responsive">
													<table class="table table-bordered">	
														<thead>
															<tr>
																<th class="cell-label">&nbsp;Choose Any One</th>
																<th>1 star</th>
																<th>2 stars</th>
																<th>3 stars</th>
																<th>4 stars</th>
																<th>5 stars</th>
															</tr>
														</thead>	
								<tbody>
									<tr>
										<td class="cell-label">Rating</td>
										<td><input type="radio" name="r_rating" class="radio" value="1"></td>
										<td><input type="radio" name="r_rating" class="radio" value="2"></td>
										<td><input type="radio" name="r_rating" class="radio" value="3"></td>
										<td><input type="radio" name="r_rating" class="radio" value="4"></td>
										<td><input type="radio" name="r_rating" class="radio" value="5"></td>
									</tr>
															<!-- <tr>
																<td class="cell-label">Price</td>
																<td><input type="radio" name="price" class="radio" value="1"></td>
																<td><input type="radio" name="price" class="radio" value="2"></td>
																<td><input type="radio" name="price" class="radio" value="3"></td>
																<td><input type="radio" name="price" class="radio" value="4"></td>
																<td><input type="radio" name="price" class="radio" value="5"></td>
															</tr> -->
															<!-- <tr>
																<td class="cell-label">Value</td>
																<td><input type="radio" name="value" class="radio" value="1"></td>
																<td><input type="radio" name="value" class="radio" value="2"></td>
																<td><input type="radio" name="value" class="radio" value="3"></td>
																<td><input type="radio" name="value" class="radio" value="4"></td>
																<td><input type="radio" name="value" class="radio" value="5"></td>
															</tr> -->

			</div><!-- /.form-group --></tr>
														</tbody>
													</table><!-- /.table .table-bordered -->
												</div><!-- /.table-responsive -->
											</div><!-- /.review-table -->
											
					<div class="review-form">
						<div class="form-container">
								<div class="form-group">
								<!-- <label for="exampleInputName">Your Name <span class="astk">*</span></label>
								<input type="text" class="form-control txt" id="exampleInputName" placeholder="" name="name" required="required">
								</div> --><!-- /.form-group -->
								<!-- <div class="form-group">
								<label for="exampleInputSummary">Summary <span class="astk">*</span></label>
								<input type="text" class="form-control txt" id="exampleInputSummary" placeholder="" name="summary" required="required">
																</div> --><!-- /.form-group -->
							</div>

		<div class="form-group">
			<label for="exampleInputReview">Reviews <span class="astk">*</span></label>

		<textarea class="form-control txt txt-review" id="exampleInputReview" rows="4" placeholder="Write your things about product here...!" name="r_review" maxlength="255" required="required"></textarea>
		</div><!-- /.form-group -->
	</div>
															</div>
														
														<div class="action text-right">
															<button name="submit" class="btn btn-primary btn-upper">SUBMIT REVIEW</button>
														</div><!-- /.action -->

													</form><!-- /.cnt-form -->
												</div><!-- /.form-container -->
											</div><!-- /.review-form -->

										</div><!-- /.product-add-review -->										
										
							        </div><!-- /.product-tab -->
								</div><!-- /.tab-pane -->

				

							</div><!-- /.tab-content -->
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.product-tabs -->

<?php $c_id=$row['c_id'];
$sub_id=$row['sub_id']; } ?>
				<!-- ============================================== UPSELL PRODUCTS ============================================== -->
<section class="section featured-product wow fadeInUp">
	<h3 class="section-title">Realted Products </h3>
	<div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">
	   
		<?php 
$qry=mysqli_query($con,"select * from product where sub_id='$sub_id' and c_id='$c_id'");
while($rw=mysqli_fetch_array($qry))
{

			?>	


		<div class="item item-carousel">
			<div class="products">
	<div class="product">		
		<div class="product-image">
			<div class="image">
				<a href="product-details.php?pid=<?php echo htmlentities($rw['id']);?>"><img  src="assets/images/blank.gif" data-echo="admin/uploads/<?php echo htmlentities($rw['p_image1']);?>" width="150" height="240" alt=""></a>
			</div><!-- /.image -->			

			                   		   
		</div><!-- /.product-image -->
			
		
		<div class="product-info text-left">
			<h3 class="name"><a href="product-details.php?p_id=<?php echo htmlentities($rw['id']);?>"><?php echo htmlentities($rw['p_name']);?></a></h3>
			<div class="rating rateit-small"></div>
			<div class="description"></div>

			<div class="product-price">	
				<span class="price">
					&#8377;<?php echo htmlentities($rw['p_price']);?></span>
									
			</div><!-- /.product-price -->
			
		</div><!-- /.product-info -->
					<div class="cart clearfix animate-effect">
				<div class="action">
					<ul class="list-unstyled">
						<li class="add-cart-button btn-group">
							<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
								<i class="fa fa-shopping-cart"></i>													
							</button>
						<a href="product-details.php?page=product&action=add&p_id=<?php echo $rw['p_id']; ?>" class="lnk btn btn-primary">Add to cart</a>
													
						</li>
	                   
		              
					</ul>
				</div><!-- /.action -->
			</div><!-- /.cart -->
			</div><!-- /.product -->
      
			</div><!-- /.products -->
		</div><!-- /.item -->
		<?php } ?>
	
		
			</div><!-- /.home-owl-carousel -->
</section><!-- /.section -->


<!-- ============================================== UPSELL PRODUCTS : END ============================================== -->
			
			</div><!-- /.col -->
			<div class="clearfix"></div>
		</div>
<?php //sinclude('includes/brands-slider.php');?>
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