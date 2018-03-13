<?php error_reporting(0);
ob_start();
session_start();
require_once("inc/config.inc.php");
require_once("inc/database.inc.php");
require_once("inc/functions.inc.php");
$db_page=new Database();	
$db_page->open();
$subscriber_email='';
$id=isset($_REQUEST["id"])?$_REQUEST["id"]:'';
$reqval=array("id" =>"","subscriber_email" =>"","subscriber_name"=>"","ispublish" =>"");	
$sql="select subscriber_name,subscriber_email,id,ispublish from max_subscription where md5(id)='$id'";
$foundflag=false;										 
$db_page -> query($sql);
if($db_page->numRows() > 0){
	$event_data=$db_page->fetchAssoc();
	foreach($reqval as $key => $val){ $reqval[$key]=(!isset($event_data[$key]))?'':stripslashes(($event_data[$key]));	}
	$foundflag=true;
	
}
?>
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

  </head>
  <body class="body-black">
  <div id="loadingdiv" class="LockOff"><span>Please Wait...</span></div>
<?php include_once("ffheader.php");?> <!-- header end -->
    



<!--=================================================================slider -section- Close-=============================================================================-->

<section class="pdding-top20">
<!--===============headdin start============================-->
<!--<div class="tittle-heading">
<h1>Our Selection</h1>
<div class="heading-bar"></div>
</div>-->
<!--===============headdin end============================-->

    <div class="row">
    <div class="pdding-btop40 no-maxpadding">
    <div class="container">
    <div class="col-md-12">
        
        <div class="text" id="unsubscribediv">
        	
        	<?php 
			if($foundflag){ 
				if(intval($reqval['ispublish'])==0){ ?>
                <p><span href="" style="border-bottom:1px solid #FF0000;"><?php echo $reqval['subscriber_email'];?></span> Already Unsubscribed!</p>
                <?php } else { 
			?>
            
            <p>Unsubscribe <span href="" style="border-bottom:1px solid #FF0000;"><?php echo $reqval['subscriber_email'];?></span> from Newsletter ? By unsubscribing, you won't be notified via email</p>
            <form id="frmunsubscribe" name="frmunsubscribe" method="post" action="dynd.php">
                 <input type="submit" value="Unsubscribe" class="btn btn-md  btn-danger">
                 
                 <a href="<?php echo _SITE_URL_;?>" class="btn btn-md  btn-success">Cancel</a>
                
                 <input type="hidden" name="qry" id="qry" value="unsubscribe" />
                 <input type="hidden" name="id" id="id" value="<?php echo $reqval['id'];?>" />
            </form>
             <div id="ackdiv"></div>
            <?php }
			} else{ ?>
            <p style="text-align:center;"> <span href="" style="border-bottom:1px solid #FF0000;">Invalid Request!</span></p>
            <?php } ?>
           
        </div>
     </div>
       
    </div>
    </div>
    </div>




<!--==================================================Footer==================================================-->

<?php include_once("fffooter.php");?>
<!--==================================================Footer Close==================================================-->



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/main.js"></script>
<script src="js/custom.js?v=123"></script>
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


 
  </body>
</html>