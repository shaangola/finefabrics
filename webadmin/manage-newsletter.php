<?php include("config.php");
$db=new Database();	
$db->open();

$db1=new Database();	
$db1->open();

$request_array=array("newsletter_id" =>"","newsletter_title" =>"","newsletter_content" =>"");
$extraurl_array=array("ftxt0"=>"","ftxt1" =>"","ftxt2" =>"","ftxt3" =>"","rpp" =>"","page" =>"","fcondvalue" =>"","fcond" =>"","ord" =>"","srt" =>"");
$extraurl='';
$adminmsg='';
$ispublish='';	
$ishome='';	
 
if(isset($_REQUEST["meng_newsletter"]) && $_REQUEST["meng_newsletter"]=="add"){ 
	foreach($extraurl_array as $key => $val){ $extraurl.=(isset($_REQUEST[$key]) && $_REQUEST[$key]!='')?'&'.$key.'='.$_REQUEST[$key]:'';
		$extraurl_array[$key]=(!isset($_REQUEST[$key]))?'':mysql_real_escape_string(trim($_REQUEST[$key]));	
	}
	foreach($request_array as $key => $val){ $request_array[$key]=(!isset($_REQUEST[$key]))?'':mysql_real_escape_string(trim($_REQUEST[$key]));	}
	$ispublish=isset($_REQUEST["ispublish"])?"1":"0";
	$createdby=$_SESSION["inte_sess_emp_id"];
	
	if($db->isFound(_DB_PREFIX."newsletter","validto=''")){
		$rowAffected=$db->query("update "._DB_PREFIX."newsletter set validto='".date('d-m-Y')."' where validto=''");
	}
	
	$sql="insert into "._DB_PREFIX."newsletter(newsletter_title,newsletter_content,validfrom,ispublish,createddate)" .
	" values('".$request_array["newsletter_title"]."','".$request_array["newsletter_content"]."','".date('d-m-Y')."','$ispublish',now())";
	$rowafftected=$db->query($sql);
	
	if($rowafftected > 0){
		
		$_SESSION["inte_sess_ackmsg"]='<div id="ack_div" class="error_message truegreen"> Newsletter added successfully '.$adminmsg.'</div>';
	}
	else{
		$_SESSION["inte_sess_ackmsg"]='<div id="ack_div" class="error_message errorred"> Newsletter Insertion Failed! '.$adminmsg.'</div>';
	}

	echo "<script>window.location.href='list-newsletter.php?opt=done$extraurl';</script>";
	exit;
}
else if(isset($_REQUEST["meng_newsletter"]) && $_REQUEST["meng_newsletter"]=="edit"){
	foreach($extraurl_array as $key => $val){ $extraurl.=(isset($_REQUEST[$key]) && $_REQUEST[$key]!='')?'&'.$key.'='.$_REQUEST[$key]:'';
		$extraurl_array[$key]=(!isset($_REQUEST[$key]))?'':mysql_real_escape_string(trim($_REQUEST[$key]));	
	}
	
	foreach($request_array as $key => $val){ $request_array[$key]=(!isset($_REQUEST[$key]))?'':mysql_real_escape_string(trim($_REQUEST[$key]));	}
	$ispublish=isset($_REQUEST["ispublish"])?"1":"0";
	$modifyby=$_SESSION["inte_sess_emp_id"];
	
	
	
	$sql=" update "._DB_PREFIX."newsletter set newsletter_title='".$request_array['newsletter_title']."',newsletter_content='".$request_array['newsletter_content']."', ".
	" ispublish='$ispublish' where newsletter_id='".$request_array['newsletter_id']."'";
	$rowAffected=$db->query($sql);
	
	if($rowAffected > 0){ 	
		
	$_SESSION["inte_sess_ackmsg"]='<div id="ack_div" class="error_message truegreen"> Newsletter  Updated successfully '.$adminmsg.'</div>';}
	else{ $_SESSION["inte_sess_ackmsg"]='<div id="ack_div" class="error_message errorred"> Newsletter  Updation Failed! '.$adminmsg.'</div>';}

	echo "<script>window.location.href='list-newsletter.php?opt=done$extraurl';</script>";
	exit;
	
}
else if(isset($_REQUEST["delnewsletter"]) && $_REQUEST["delnewsletter"]=="delnewsletter"){

	
	foreach($extraurl_array as $key => $val){ $extraurl.=(isset($_REQUEST[$key]) && $_REQUEST[$key]!='')?'&'.$key.'='.$_REQUEST[$key]:'';
		$extraurl_array[$key]=(!isset($_REQUEST[$key]))?'':mysql_real_escape_string($db1->conn,trim($_REQUEST[$key]));	
	}
	$newsletter_id=$_REQUEST["newsletter_id"];
	
	
	$sql="delete from "._DB_PREFIX."newsletter where newsletter_id='$newsletter_id'";
	$rowafftected=$db->query($sql);
	
	if($rowafftected > 0){
		$_SESSION["inte_sess_ackmsg"]='<div id="ack_div" class="error_message truegreen"> Newsletter Deleted Successfully</div>';
	}
	else{
		$_SESSION["inte_sess_ackmsg"]='<div id="ack_div" class="error_message errorred"> Newsletter Deletetion Failed!</div>';
	}

	echo "<script>window.location.href='list-newsletter.php?opt=done$extraurl';</script>";
	exit;
}





$contentBox='Add Newsletter';
$mode=isset($_REQUEST["mode"])?$_REQUEST["mode"]:'add';
$cat_id="";
$state_name="";
$ispublish="";
$contentBox='Add Newsletter';
if($mode=="edit"){
	if(!isset($_SESSION["inte_sess_edit_newsletter"])){
		$_SESSION["inte_sess_privmsg"]='<div id="ack_div" class="error_message errorred">Access Out of Privilege</div>';
		header("Location: home.php");
		exit;
	}
	foreach($extraurl_array as $key => $val){ $extraurl.=(isset($_REQUEST[$key]) && $_REQUEST[$key]!='')?'&'.$key.'='.$_REQUEST[$key]:'';
		$extraurl_array[$key]=(!isset($_REQUEST[$key]))?'':mysqli_real_escape_string($db1->conn,trim($_REQUEST[$key]));	
	}
	$id=$_REQUEST["id"];
	$sql="select * from "._DB_PREFIX."newsletter where newsletter_id='$id'";
	$db->query($sql);
	$data=$db->fetchAssoc();
	$request_array['newsletter_id']=stripslashes($data["newsletter_id"]);
	$request_array['newsletter_title']=stripslashes($data["newsletter_title"]);
	$request_array['newsletter_content']=stripslashes($data["newsletter_content"]);
	$ispublish=$data["ispublish"]==1?" checked ":"";
	
	$contentBox='Update Newsletter';

}
else{
	if(!isset($_SESSION["inte_sess_create_newsletter"])){
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

<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/ddaccordion.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script language="JavaScript" type="text/javascript" src="../inc/ckeditor/ckeditor.js"></script>
<script language="JavaScript" type="text/javascript" src="../inc/ckeditor/ckfinder/ckfinder.js"></script>
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
				<td height="27" colspan="2" align="left" style="padding-left:30px;">
					<?php  echo $_SESSION["inte_sess_ackmsg"];unset($_SESSION["inte_sess_ackmsg"]); ?></td>
			  </tr>
			<?php
			}
			?>
			<tr>
                <td width="263" valign="top"  style="padding:5px;"><strong>Title *</strong></td>
                <td width="862" valign="top"  style="padding:5px;"><input  type="text" name="newsletter_title" id="newsletter_title"  value="<?php echo $request_array['newsletter_title'];?>" class="validate[required,maxSize[50]] formfld" style="width:95%;"/></label></td>
			</tr>
			<tr>
                <td width="263" valign="top"  style="padding:5px;"><strong>Mail Content *</strong></td>
                <td width="862" valign="top"  style="padding:5px;">
                <textarea rows="5" name="newsletter_content" id="newsletter_content" style="width:98%" class="validate[required] formfld"><?php echo $request_array['newsletter_content'];?></textarea>                        
				<script type="text/javascript">
                    var editor = CKEDITOR.replace('newsletter_content');
                    CKFinder.setupCKEditor( editor,'../<?php echo _CKFINDER_PATH_; ?>' ) ;
             </script>	
                </td>
			</tr>
			
			
		
					<tr>
						<td  style="padding:5px;" valign="top" class="codefont"><strong>Is Publish</strong> &nbsp;</td>
						<td  style="padding:5px;" valign="top" class="codefont">
							<input type="checkbox" name="ispublish" id="ispublish"  <?php echo $ispublish;?> />
						</td>
					</tr>	
			 <tr>
               		<td  style="padding:5px;" valign="top" class="codefont">&nbsp;&nbsp; &nbsp;</td>
					<td  style="padding:5px;" valign="top" class="codefont">
						<input name="Submit2" id="Submit2" type="submit" class="bluebutton" value="<?php echo $contentBox;?>" onclick="return validateForm();" /></td>
              </tr>
            </table>
				<input type="hidden" name="meng_newsletter" value="<?php echo $mode; ?>" id="meng_newsletter" />
				<input type="hidden" name="page" id="page" value="<?php echo $extraurl_array["page"]; ?>" />
				<input type="hidden" name="rpp" id="rpp" value="<?php echo $extraurl_array["rpp"]; ?>" />
				<input type="hidden" name="fcond" id="fcond" value="<?php echo $extraurl_array["fcond"]; ?>" />
				<input type="hidden" name="fcondvalue" id="fcondvalue" value="<?php echo $extraurl_array["fcondvalue"]; ?>" />
				<input type="hidden"  name="newsletter_id" id="newsletter_id" value="<?php echo $request_array["newsletter_id"]; ?>" />
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
<link rel="stylesheet" href="formcss/validationEngine.jquery.css" type="text/css" media="screen" title="no title" charset="utf-8" />
<script src="js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>


<script language="javascript">$('#newsletter_title').focus();</script>
<script language="javascript" type="text/javascript">
$(function() {
	$("#frm-submit").validationEngine();
	
});


</script>
</body>
</html>
