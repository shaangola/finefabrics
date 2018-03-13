<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Fine Fabrics</title>
     <link href="css/bootstrap.css" rel="stylesheet">
     <link href="css/style.css" rel="stylesheet">
     <link href="css/font-awesome.css" rel="stylesheet">
    <!-- <link href="css/font.css" rel="stylesheet">-->

  </head>
  <style>
  .modal-open{padding:0 !important}
  </style><!-- class="body-black"-->
  <body>

<?php include_once("ffheader.php");?> <!-- header end -->
    
<!-- =================model popup=========================================-->
 
 
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="padding-left:0px !important">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Subscribe</h4>
        <h5>SUBSCRIBE WITH US TO RECEIVE AN ADDITIONAL 10% OFF.</h5>
         <h5>KINDLY VISIT US IN-STORE, ON-LINE SHOPPING COMING SOON.</h5>
        </div>
        <div class="modal-body">
        
        <img src="images/sales.jpg" class="img-responsive" alt="">
        
        <div class="row">
        <div style="padding:0px 20px">
        <div class="pdding-top30">
        <form id="subs_lbform" method="post" action="dynd.php">
        
        <div class="form-group col-md-5">
        <div>
        <input type="text" id="subscriber_name" name="subscriber_name" placeholder="Your name.." class="form-control" required>
        </div>
        </div> 
        <div class="form-group col-md-5">  
        <div>
        <input type="email" name="subscriber_email" id="subscriber_email" placeholder="Sign up for your email.." class="form-control" required>
        </div>
        </div>  
        <div class="col-md-2">  
        <div>
        <input  type="submit" value="Sign Up" class="themes-button">
        </div>
        </div>
        <div class="col-md-12"><div id="ackdiv"></div></div>
        <input type="hidden" name="qry" id="qry" value="subscription">
        </form>
        </div>
        </div>
        </div>
        
        </div>
        </div>
    </div>
    </div>
  </div>
 <!-- =================model popup End=========================================-->   

<!--=================================================================slider -section--=============================================================================-->

<section>
<div class="slider-section">
<div id="carousel" class="carousel slide carousel-fade" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carousel" data-slide-to="0" class="active"></li>
        <li data-target="#carousel" data-slide-to="1"></li>
        <li data-target="#carousel" data-slide-to="2"></li>
        <li data-target="#carousel" data-slide-to="3"></li>
    </ol>
    <!-- Carousel items -->
    <div class="carousel-inner">
    	<div class="active item"><img src="images/slider-pic1.jpg"></div>
        <div class="item"><img src="images/slider-pic2.jpg"></div>
        <div class="item"><img src="images/slider-pic3.jpg"></div>
        <div class="item"><img src="images/slider-pic4.jpg"></div>
    </div>
    <!-- Carousel nav -->
    <a class="carousel-control left hidden-xs" href="#carousel" data-slide="prev">&lsaquo;</a>
    <a class="carousel-control right hidden-xs" href="#carousel" data-slide="next">&rsaquo;</a></div>
</div>
<div class="opacity-top">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
            <div class="text-md-left"><h4>NEW ARRIVALS 20% OFF IN-STORE MAIN LEVEL<!--New Arrivals 20-30% off IN -STORE LOWER LEVEL--></h4></div>
            </div>
            <div class="col-md-6 col-sm-6">
            <div class="text-md-right"><h4>FINAL STOCK CLEARANCE SALE 30-80% OFF IN-STORE LOWER

LEVEL<!--Final Stock Clearance Sale 30-80% off IN -STORE MAIN LEVEL--></h4></div>
            </div>
        </div><!------------End row------------->
    </div><!------------End container------------->
</div>
</div>
</section>

<!--=================================================================slider -section- Close-=============================================================================-->

<section class="pdding-top80">
<!--===============headdin start============================-->
<div class="tittle-heading">
<h1>Our Selection</h1>
<div class="heading-bar"></div>
</div>
<!--===============headdin end============================-->
    <div class="row">
    <div class="container">
    <div class="col-lg-4 col-md-4 col-xs-6 thumb">
    <div class="grid">
    <figure class="effect-lily">
    <img src="images/pic4.jpg" alt="img12" class="img-responsive" />
    <figcaption>
    <div>
    <h2>Wedding</h2>
    </div>
    </figcaption>			
    </figure>
    </div>
    </div>
    
    <div class="col-lg-4 col-md-4 col-xs-6 thumb">
    <div class="grid">
    <figure class="effect-lily">
    <img src="images/pic2.jpg" alt="img12" class="img-responsive" />
    <figcaption>
    <div>
    <h2>Women</h2>
    </div>
    </figcaption>			
    </figure>
    </div>
    </div>
    
    <div class="col-lg-4 col-md-4 col-xs-6 thumb">
    <div class="grid">
    <figure class="effect-lily">
    <img src="images/pic3.jpg" alt="img12" class="img-responsive" />
    <figcaption>
    <div>
    <h2>Men</h2>
    </div>
    </figcaption>			
    </figure>
    </div>
    </div>
    
    
   


    <div class="col-lg-4 col-md-4 col-xs-6 thumb">
    <div class="grid">
    <figure class="effect-lily">
    <img src="images/pic1.jpg" alt="img12" class="img-responsive" />
    <figcaption>
    <div>
    <h2>Jewellery</h2>
    </div>
    </figcaption>			
    </figure>
    </div>
    </div>
    
    <div class="col-lg-4 col-md-4 col-xs-6 thumb">
    <div class="grid">
    <figure class="effect-lily">
    <img src="images/pic6.jpg" alt="img12" class="img-responsive" />
    <figcaption>
    <div>
    <h2>Children</h2>
    </div>
    </figcaption>			
    </figure>
    </div>
    </div>
    
    <div class="col-lg-4 col-md-4 col-xs-6 thumb">
    <div class="grid">
    <figure class="effect-lily">
    <img src="images/pic5.jpg" alt="img12" class="img-responsive" />
    <figcaption>
    <div>
    <h2>ACCESSORIES</h2>
    </div>
    </figcaption>			
    </figure>
    </div>
    </div>
</div></div>
</section>

<!--==================================================Advertisemetn Section start==================================================-->
<section class="pdding-btop60 no-smallpadding">
<div class="container">
<div class="col-md-12 no-smallpadding">
<div class="grid">
    <figure class="effect-layla">
   <!-- <div class="single"></div>-->
   <img src="images/sing-banner.jpg" alt="img06" class="img-responsive">
    <figcaption>
<!--    <h2>Crazy <span>Layla</span></h2>
    <p>When Layla appears, she brings an eternal summer along.</p>
    <a href="#">View more</a>
    </figcaption>-->			
    </figure>
</div>
</div>
</div>
</section>
<!--==================================================Advertisemetn Section Close==================================================-->


<!--pdding-top30==================================================Video Section==================================================-->
<!--<section class="content-section video-section">
<div class="embed-responsive embed-responsive-4by3">
<iframe class="embed-responsive-item" src="https://player.vimeo.com/video/42829407?autoplay=1&loop=0" width="100%" style="width:100%; height:90%"></iframe>
</div>
</section>-->
<!--==================================================Video Section Close==================================================-->


<!--==================================================Testim monial==================================================-->
<!--pdding-btop60==================================================Testim Section start==================================================-->

<section class="" id="carousel"> 
<!--===============headdin start============================-->
<!--<div class="tittle-heading">
<h1>TESTIMONIALS</h1>
<div class="heading-bar"></div>
</div>-->
<!--===============headdin end============================-->   				
<!--	<div class="container">
		<div class="row">
			<div class="col-md-12">
            <div style="max-width:960px; margin:0 auto;">
                <div class="quote"><i class="fa fa-quote-left fa-4x"></i></div>
				<div class="carousel slide" id="fade-quote-carousel" data-ride="carousel" data-interval="3000">
				 
                  <ol class="carousel-indicators">
				    <li data-target="#fade-quote-carousel" data-slide-to="0" class="active"></li>
				    <li data-target="#fade-quote-carousel" data-slide-to="1"></li>
				    <li data-target="#fade-quote-carousel" data-slide-to="2"></li>
				  </ol>
				
				  <div class="carousel-inner">
				    <div class="active item">
                    <div class="profile-circle" style="background-color:#ffffff;"><img src="images/testimonial1.png" class="img-responsive" /></div>
				    	<blockquote class="text-center">
				    		<p class="text-center">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen </p>
				    	</blockquote>
				    </div>
                    
				     <div class="item">
                    <div class="profile-circle" style="background-color:#ffffff;"><img src="images/testimonial1.png" class="img-responsive" /></div>
				    	<blockquote class="text-center">
				    		<p class="text-center">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen </p>
				    	</blockquote>
				    </div>
                    
				   <div class="item">
                    <div class="profile-circle" style="background-color:#ffffff;"><img src="images/testimonial1.png" class="img-responsive" /></div>
				    	<blockquote class="text-center">
				    		<p class="text-center">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen </p>
				    	</blockquote>
				    </div>
                    
				  </div>
				</div>
                </div>
			</div>							
		</div>
	</div>-->
</section>
<!--==================================================Testim Section Close==================================================-->
<!--==================================================Footer==================================================-->

<?php include_once("fffooter.php");?>
<!--==================================================Footer Close==================================================-->



<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--<script src="js/main.js"></script>
<script src="js/custom.js"></script>-->
<script>
	$( document ).ready(function() {
	$("[rel='tooltip']").tooltip();    
	
	$('.thumbnail').hover(
	function(){
	$(this).find('.caption').slideDown(250); //.fadeIn(250)
	},
	function(){
	$(this).find('.caption').slideUp(250); //.fadeOut(205)
	}
	); 
	});
</script>

 <script>
 $(window).load(function(){
      //Disply the modal popup
        $('#myModal').modal('show');
    });
 </script>    
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>

<script>
    $(function(){
    $(".dropdown").hover(            
            function() {
                $('.dropdown-menu', this).stop( true, true ).fadeIn("fast");
                $(this).toggleClass('open');
                $('b', this).toggleClass("caret caret-up");                
            },
            function() {
                $('.dropdown-menu', this).stop( true, true ).fadeOut("fast");
                $(this).toggleClass('open');
                $('b', this).toggleClass("caret caret-up");                
            });
    });
    
</script>
<!--<script>
$('ul.nav li.dropdown').hover(function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
}, function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
});
</script> -->
  </body>
</html>