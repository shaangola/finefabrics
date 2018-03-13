<?php include("config.php");
if(!isset($_SESSION["inte_sess_send_newsletter"])){
	$_SESSION["rolex_sess_privmsg"]='<div id="ack_div" class="error_message errorred">Access Out of Privilege</div>';
	header("Location: ".$ABS_PATH."home.php");
	exit;
}
$contentBox='Send Newsletter';
$db=new Database();	
$db->open();

$db1=new Database();	
$db1->open();
$entry_type='';
$isentry=0;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php  echo _ADMIN_PAGE_TITLE_;?> </title>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="css/tableelement.css" rel="stylesheet" type="text/css" />
<link href="css/gridstyle.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css" />
<link href="css/jquery-ui-1.9.1.custom.css" rel="stylesheet">
<link href="css/chosen.css" rel="stylesheet"  />
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/ddaccordion.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/chosen.jquery.js"></script>



</head>

<body id="homeinnerbg">

<div id="loadingdiv" class="LockOff"><img src="images/anim_load.gif" /></div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="10%" align="left" valign="top" style="width:156px;">
	<?php include("left_menu_home.php"); ?>
	
	
	</td>
    <td width="90%" align="left" valign="top">
	<div id="rightbody">
  
<?php include("header.php"); ?>
	<div class="formpages">
		<form method="post" enctype="multipart/form-data" name="frmMain" id="frmMain">
		  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table1">
		  <tr><td colspan="3" class="head"><?php echo $contentBox;?></td></tr>
		   <tr>
			<td width="13%" style="padding:5px;"><strong>Sending Mode</strong> </td>
			<td width="87%" style="padding:5px;" colspan="2">
            	<label>
					<input type="radio" checked="checked" name="bulktype" id="bulktxt" value="1" onclick="showsmstype(1);">
					<span title="Static Messages on multiple mobile numbers"><strong>Bulk</strong> </span>
                </label>
                <label>
					<input type="radio" name="bulktype" id="bulktxt" value="2" onclick="showsmstype(2);">
					<span title="Static Messages on multiple mobile numbers"><strong>Individual</strong> </span>
                </label>
                
                	
			</td>
           </tr>
           <tr id="trmobile2" style="display:none;">
				<td width="13%" style="padding:5px;"><strong>Email ID </strong> </td>
				<td width="87%" style="padding:5px;" colspan="2">
                    <select id="subscriber_email" name="subscriber_email[]" class="formfld" multiple  style="width:952px;">
                    	<?php 
						$sql="select subscriber_email from "._DB_PREFIX."subscription where ispublish=1 order by subscriber_email";
						$db->query($sql);
						while($data=$db->fetchAssoc()){
							$subscriber_email=$data['subscriber_email'];
							//$agnt_name=stripslashes($data['agnt_name']);
							
							echo '<option value="'.$subscriber_email.'">'.$subscriber_email.'</option>';	
						}
						?>
					</select>	
                  
                </td>
           </tr>
           
           
           <tr id="trmobile4" style="display:none;">
				<td width="13%" style="padding:5px;"><strong>Mobile No.</strong> </td>
				<td width="87%" style="padding:5px;" colspan="2">
                    <input type="text" name="sms_contactno4" id="sms_contactno4" class="validate[required] formfld" style="width:98%;" />
                   <strong> Mobile number should be separated by comma , only.</strong>
                </td>
           </tr>
           <tr>
			<td width="13%" style="padding:5px;"><strong>Newsletter * </strong> </td>
			<td width="87%" style="padding:5px;" colspan="2">
                <select name="newsletter_id" id="newsletter_id"  class="validate[required] formfld" style="width:98%;" >
                    <option value=""> Select Newsletter </option>
                    <?php
                    $sql="select newsletter_id,newsletter_title from "._DB_PREFIX."newsletter where  ispublish='1' ";
                    $db1->query($sql);
                    while($data=$db1->fetchArray()){
						 echo '<option value="'.$data["newsletter_id"].'">'.stripslashes($data["newsletter_title"]).'</option>';
                    }
                    ?>
                    </select>
			</td>
            </tr>
            <tr>
            <td width="13%" style="padding:5px;">&nbsp; </td>
            <td style="padding:2px;" colspan="2">
			<input name="Submit2" id="Submit2" type="submit" class="bluebutton" value=" SEND "/>
			</td>

           </tr>
			</table>
			<div id="detaildiv" style="height:150px;"></div>
    </form>
	</div>
	
	</td>
  </tr>
</table>
<link rel="stylesheet" href="formcss/validationEngine.jquery.css" type="text/css" media="screen" title="no title" charset="utf-8" />
<script src="js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>

<script language="javascript" type="text/javascript">
$(document).ready(function(){
	$("#subscriber_email").chosen();
	$( "#frmMain" ).submit(function( event ) { 
		if(jQuery("#frmMain").validationEngine('validate')){
			
			$('#loadingdiv').addClass("LockOn");
			$.ajax({
				type: "POST",
				url: "ajxsendnl.php?qry=sendnewsletter",
				data: $("#frmMain").serialize(),
				cache: false,
				success: function(data) { //alert(data);
					$('#loadingdiv').removeClass("LockOn").addClass("LockOff");
					$('#detaildiv').html(data);
				}
			});
		
			return false;
		}
		else{  
			//alert('invalid');
			return false;
		
		}
	});
});
function showsmstype(opt){
	$("#trmobile2").hide();	$("#trmobile4").hide();
	if(opt=="2"){$("#trmobile2").show();}
	else if(opt=="4"){$("#trmobile4").show();}
}		
</script>
<?php $db->close();
include("footer.php"); ?>

</body>
</html>
