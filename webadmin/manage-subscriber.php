<?php include("config.php");
$db=new Database();	
$db->open();

$db1=new Database();	
$db1->open();

$request_array=array("subscriber_name" =>"","subscriber_email" =>"","gender" =>"","contactno" =>"","address" =>"","city" =>"","state" =>"","country" =>"","pincode" =>"","id" =>"","occupied_date" =>"");
$extraurl_array=array("ftxt0"=>"","ftxt1" =>"","rpp" =>"","page" =>"","fcondvalue" =>"","fcond" =>"","ord" =>"","srt" =>"");
$extraurl='';
$adminmsg='';
$ispublish='';	
$ishome='';	
$datediff=0;
$occupied='NO';
$GENDER_ARRAY=unserialize(_GENDER_);
 
if(isset($_REQUEST["meng_subscriber"]) && $_REQUEST["meng_subscriber"]=="edit"){
	foreach($extraurl_array as $key => $val){ $extraurl.=(isset($_REQUEST[$key]) && $_REQUEST[$key]!='')?'&'.$key.'='.$_REQUEST[$key]:'';
		$extraurl_array[$key]=(!isset($_REQUEST[$key]))?'':mysql_real_escape_string(trim($_REQUEST[$key]));	
	}
	
	foreach($request_array as $key => $val){ $request_array[$key]=(!isset($_REQUEST[$key]))?'':mysql_real_escape_string(trim($_REQUEST[$key]));	}
	$ispublish=isset($_REQUEST["ispublish"])?"1":"0";
	$ishome=isset($_REQUEST["ishome"])?"1":"0";
	
	$modifyby=$_SESSION["inte_sess_emp_id"];
	//echo "state_name='".$request_array['state_name']."' and state_id!='".$request_array['state_id']."'";
	if($db1->isFound(_DB_PREFIX."subscription","subscriber_email='".$request_array['subscriber_email']."' and id!='".$request_array['id']."'")){
		$_SESSION["inte_sess_ackmsg"]='<div id="ack_div" class="error_message errorred"> Subscriber Already Exist</div>';
	}
	else{
		if(trim($request_array['occupied_date'])!=''){$occupied='YES';}
		$sql=" update "._DB_PREFIX."subscription set subscriber_name='".$request_array['subscriber_name']."',subscriber_email='".$request_array['subscriber_email']."', ".
		" gender='".$request_array['gender']."',contactno='".$request_array['contactno']."',address='".$request_array['address']."',city='".$request_array['city']."', ".
		" state='".$request_array['state']."',country='".$request_array['country']."',pincode='".$request_array['pincode']."',occupied='$occupied', ".
		" occupied_date='".$request_array['occupied_date']."',ispublish='$ispublish' where id='".$request_array['id']."'";
		$rowAffected=$db->query($sql);
		
		if($rowAffected > 0){ 	
			
		$_SESSION["inte_sess_ackmsg"]='<div id="ack_div" class="error_message truegreen"> Subscriber Detail  Updated successfully</div>';}
		else{ $_SESSION["inte_sess_ackmsg"]='<div id="ack_div" class="error_message errorred">  Subscriber Detail Updation Failed! </div>';}
	}	
	echo "<script>window.location.href='list-subscriber.php?opt=done$extraurl';</script>";
	exit;
	
}
else if(isset($_REQUEST["delsubscription"]) && $_REQUEST["delsubscription"]=="delsubscription"){

	
	foreach($extraurl_array as $key => $val){ $extraurl.=(isset($_REQUEST[$key]) && $_REQUEST[$key]!='')?'&'.$key.'='.$_REQUEST[$key]:'';
		$extraurl_array[$key]=(!isset($_REQUEST[$key]))?'':mysql_real_escape_string(trim($_REQUEST[$key]));	
	}
	$id=$_REQUEST["id"];
	
	$sql="delete from "._DB_PREFIX."subscription where id='$id'";
	$rowafftected=$db->query($sql);
	
	if($rowafftected > 0){
		$_SESSION["inte_sess_ackmsg"]='<div id="ack_div" class="error_message truegreen"> Subscriber Deleted Successfully</div>';
	}
	else{
		$_SESSION["inte_sess_ackmsg"]='<div id="ack_div" class="error_message errorred"> Subscriber Deletetion Failed!</div>';
	}

	echo "<script>window.location.href='list-subscriber.php?opt=done$extraurl';</script>";
	exit;
}





$contentBox='Add Category';
$mode=isset($_REQUEST["mode"])?$_REQUEST["mode"]:'add';
$cat_id="";
$state_name="";
$ispublish="";

$contentBox='Add Category';
if($mode=="edit"){
	if(!isset($_SESSION["inte_sess_edit_subscriber"])){
		$_SESSION["inte_sess_privmsg"]='<div id="ack_div" class="error_message errorred">Access Out of Privilege</div>';
		header("Location: home.php");

		exit;
	}
	foreach($extraurl_array as $key => $val){ $extraurl.=(isset($_REQUEST[$key]) && $_REQUEST[$key]!='')?'&'.$key.'='.$_REQUEST[$key]:'';
		$extraurl_array[$key]=(!isset($_REQUEST[$key]))?'':mysql_real_escape_string(trim($_REQUEST[$key]));	
	}
	$id=$_REQUEST["id"];
	$sql="select sc.*,DATEDIFF(current_date,date(sc.subscribedatetime)) as datediff from "._DB_PREFIX."subscription sc where sc.id='$id'";
	$db->query($sql);
	$data=$db->fetchAssoc();
	$request_array['id']=stripslashes($data["id"]);
	$request_array['subscriber_name']=stripslashes($data["subscriber_name"]);
	$request_array['subscriber_email']=stripslashes($data["subscriber_email"]);
	$request_array['gender']=stripslashes($data["gender"]);
	$request_array['contactno']=stripslashes($data["contactno"]);
	$request_array['address']=stripslashes($data["address"]);
	$request_array['city']=stripslashes($data["city"]);
	$request_array['state']=stripslashes($data["state"]);
	$request_array['country']=stripslashes($data["country"]);
	$request_array['pincode']=stripslashes($data["pincode"]);
	$request_array['occupied_date']=stripslashes($data["occupied_date"]);
	$datediff=intval($data["datediff"]);
	$occupied=($data["occupied"]);
	$ispublish=$data["ispublish"]==1?" checked ":"";
	$contentBox='Update Subscriber';

}
else{
	if(!isset($_SESSION["inte_sess_create_subscriber"])){
		$_SESSION["inte_sess_privmsg"]='<div id="ack_div" class="error_message errorred">Access Out of Privilege</div>';
		header("Location: home.php");
			exit;
	}
	$mode="add";
	//$new_emp_code=getUpdateAutoIncrementCode(_DB_PREFIX."autocode","emp_code","H00",2,'');
	
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php  echo _ADMIN_PAGE_TITLE_;?></title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="css/tableelement.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css" />
<link href="css/jquery-ui-1.9.1.custom.css" rel="stylesheet">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/ddaccordion.js"></script>
<script type="text/javascript" src="js/common.js"></script>
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
	
	<div class="rightbodysec">
	
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="71%" align="left" valign="top">
		  
		 <form method="post" enctype="multipart/form-data" name="frm-submit" id="frm-submit">
		  
		 <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table1">
              <tr>
                <td colspan="7" class="head"><?php echo $contentBox; ?> </td>
              </tr>
			  <?php if(isset($_SESSION["inte_sess_ackmsg"])){?>
			  <tr>
				<td height="27" colspan="5" align="left" style="padding-left:30px;">
					<?php  echo $_SESSION["inte_sess_ackmsg"];unset($_SESSION["inte_sess_ackmsg"]); ?></td>
			  </tr>
			<?php
			}
			?>
			<tr>
                <td width="122" valign="top"  style="padding:5px;"><strong>Name *</strong></td>
                <td width="335" valign="top"  style="padding:5px;">
                <input  type="text" name="subscriber_name" id="subscriber_name"  value="<?php echo $request_array['subscriber_name'];?>" class="validate[required,maxSize[100]] formfld" style="width:300px;"/>
                </td>
                <td width="18" style="padding:5px;"></td>
                 <td width="81" valign="top"  style="padding:5px;"><strong>Email Id *</strong></td>
                <td width="585" valign="top"  style="padding:5px;">
                <input  type="text" name="subscriber_email" id="subscriber_email"  value="<?php echo $request_array['subscriber_email'];?>" class="validate[required,custom[email]] formfld" style="width:300px;"/>
                </td>
			</tr>
            <tr>
                <td valign="top"  style="padding:5px;"><strong>Gender </strong></td>
                <td valign="top"  style="padding:5px;">
                	<select name="gender" id="gender"  class="formfld" style="width:160px;" >
                        <option value="">  </option>
                        <?php
							foreach($GENDER_ARRAY as $key => $val){
								$sel=($request_array['gender']==$val)?' selected':'';
								echo '<option value="'.$val.'" '.$sel.'>'.$val.'</option>';
							}
							
						
						?>
        			</select>                    
		        </td>
                <td width="18" style="padding:5px;"></td>
                 <td width="81" valign="top"  style="padding:5px;"><strong>Contact No.</strong></td>
                <td width="585" valign="top"  style="padding:5px;">
                <input  type="text" name="contactno" id="contactno"  value="<?php echo $request_array['contactno'];?>" class="formfld" style="width:300px;"/>
                </td>
			</tr>
            <tr>
                <td valign="top"  style="padding:5px;"><strong>Address </strong></td>
                <td valign="top"  style="padding:5px;" colspan="6">
                <input  type="text" name="address" id="address"  value="<?php echo $request_array['address'];?>" class="formfld" style="width:75%;"/>
               
                
                </td>
			</tr>
            <tr>
                <td valign="top"  style="padding:5px;"><strong>City</strong></td>
                <td valign="top"  style="padding:5px;">
                <input  type="text" name="city" id="city"  value="<?php echo $request_array['city'];?>" class="validate[maxSize[50]] formfld" style="width:300px;"/>
                </td>
                <td width="18" style="padding:5px;"></td>
                 <td width="81" valign="top"  style="padding:5px;"><strong>State</strong></td>
                <td width="585" valign="top"  style="padding:5px;">
                <input  type="text" name="state" id="state"  value="<?php echo $request_array['state'];?>" class="validate[maxSize[50]] formfld" style="width:300px;"/>
                </td>
			</tr>
            <tr>
                <td valign="top"  style="padding:5px;"><strong>Country</strong></td>
                <td valign="top"  style="padding:5px;">
               <input  type="text" name="country" id="country"  value="<?php echo $request_array['country'];?>" class="validate[maxSize[50]] formfld" style="width:300px;"/>
                </td>
                <td width="18" style="padding:5px;"></td>
                 <td width="81" valign="top"  style="padding:5px;"><strong>Pin Code</strong></td>
                <td width="585" valign="top"  style="padding:5px;">
                <input  type="text" name="pincode" id="pincode"  value="<?php echo $request_array['pincode'];?>" class="formfld" style="width:300px;"/>
                </td>
			</tr>
            <tr>
                <td  style="padding:5px;" valign="top" class="codefont"><strong>Avail Date</strong></td>
                <td  style="padding:5px;" valign="top" class="codefont">
                	<?php if($datediff < 30){ ?>
                	 <input  type="text" name="occupied_date" id="occupied_date"  value="<?php echo $request_array['occupied_date'];?>" class="formfld jdate" style="width:200px;"/>
                    <?php } else { ?>
                    <?php echo $request_array['occupied_date'];?> <font color="#FF0000"><strong>Expired</strong></font>
                    <input  type="hidden" name="occupied_date" id="occupied_date"  value="<?php echo $request_array['occupied_date'];?>"/>
                    <?php } ?> 
                </td>
                <td width="18" style="padding:5px;"></td>
                <td  style="padding:5px;" valign="top" class="codefont"><strong>Is Publish</strong></td>
                <td  style="padding:5px;" valign="top" class="codefont"><input type="checkbox" name="ispublish" id="ispublish"  <?php echo $ispublish;?> /></td>

                
            </tr>	
			 <tr>
               		<td  style="padding:5px;" valign="top" colspan="5" align="center">
                    	<input name="Submit2" id="Submit2" type="submit" class="bluebutton" value="<?php echo $contentBox;?>" onclick="return validateForm();" />
                    </td>
              </tr>
            </table>
				<input type="hidden" name="meng_subscriber" value="<?php echo $mode; ?>" id="meng_subscriber" />
				<input type="hidden" name="page" id="page" value="<?php echo $extraurl_array["page"]; ?>" />
				<input type="hidden" name="rpp" id="rpp" value="<?php echo $extraurl_array["rpp"]; ?>" />
				<input type="hidden" name="fcond" id="fcond" value="<?php echo $extraurl_array["fcond"]; ?>" />
				<input type="hidden" name="fcondvalue" id="fcondvalue" value="<?php echo $extraurl_array["fcondvalue"]; ?>" />
				<input type="hidden"  name="id" id="id" value="<?php echo $request_array["id"]; ?>" />
				<input type="hidden" name="ord" id="ord" value="<?php echo $extraurl_array["ord"];?>" />
				<input type="hidden" name="srt" id="srt" value="<?php echo $extraurl_array["srt"];?>" />
				
			
		  </form>
		  
		  
		  </td>
        </tr>
      </table>
	</div>
	</div></td>
  </tr>
</table>
<?php 
$db->close();
$db1->close();
include("footer.php"); ?>
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/jquery.maskedinput.min.js"></script>
<link rel="stylesheet" href="formcss/validationEngine.jquery.css" type="text/css" media="screen" title="no title" charset="utf-8" />
<script src="js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>



<script language="javascript" type="text/javascript">
$(function() {
	$("#frm-submit").validationEngine();
	$('.jdate').datepicker({dateFormat:'dd-mm-yy',showOn: "button",changeMonth:true,changeYear:true}); 
	$('.jdate').mask("99-99-9999");
	
	
});
function validateIMG(field, rules, i, options){
	var r_file =  field.val();
	if((r_file.toLowerCase().lastIndexOf(".jpg")==-1) 
		&& (r_file.toLowerCase().lastIndexOf(".gif")==-1) 
		&& (r_file.toLowerCase().lastIndexOf(".pjpeg")==-1) 
		&& (r_file.toLowerCase().lastIndexOf(".png")==-1)){
		return "* Invalid image file\n(only *.jpg,*.gif,*.pjpeg,*.png)";
	}
	else
	  return true;
}

</script>
</body>
</html>
