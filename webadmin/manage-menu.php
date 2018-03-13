<?php include("config.php");
if(isset($_SESSION["inte_sess_emp_loginid"]) && $_SESSION["inte_sess_emp_loginid"]!='superadministrator'){
	$_SESSION["inte_sess_privmsg"]='<div id="ack_div" class="error_message errorred">Access Out of Privilege</div>';
	header("Location: home.php");
	exit;
}

$db=new Database();	
$db->open();

$db1=new Database();	
$db1->open();

$MENU_TYPE_ARRAY = unserialize (_MENU_TYPE_);


//print_r($_REQUEST);
$request_array=array("menu_id" =>"","menu_name" =>"","ispublish" =>"","order_index" =>"","icon" =>"","is_dashboard_icon" =>"","menu_type" => "");
$extraurl_array=array("rpp" =>"","page" =>"","fcondvalue" =>"","fcond" =>"","ord" =>"","srt" =>"");
$extraurl='';
$adminmsg='';
	
if(isset($_REQUEST["meng_menu"]) && $_REQUEST["meng_menu"]=="add"){ 
	foreach($extraurl_array as $key => $val){ 
		$extraurl.=(isset($_REQUEST[$key]) && $_REQUEST[$key]!='')?'&'.$key.'='.$_REQUEST[$key]:'';
		$extraurl_array[$key]=(!isset($_REQUEST[$key]))?'':mysql_real_escape_string(trim($_REQUEST[$key]));	
	}
	foreach($request_array as $key => $val){ $request_array[$key]=(!isset($_REQUEST[$key]))?'':mysql_real_escape_string(trim($_REQUEST[$key]));	}
	$ispublish=isset($_REQUEST["ispublish"])?"1":"0";
	$is_dashboard_icon=isset($_REQUEST["is_dashboard_icon"])?"1":"0";
	$createdby=$_SESSION["inte_sess_emp_id"];
	
	$sql="insert into "._DB_PREFIX."menu(menu_name,ispublish,order_index,icon,is_dashboard_icon,menu_type)" .
	" values('".$request_array["menu_name"]."','".$ispublish."','".$request_array["order_index"]."','".$request_array["icon"]."','".$is_dashboard_icon."','".$request_array["menu_type"]."')";
	$rowafftected=$db->query($sql);
	
	if($rowafftected > 0){
		$_SESSION["inte_sess_ackmsg"]='<div id="ack_div" class="error_message truegreen"> Menu added successfully</div>';
	}
	else{
		$_SESSION["inte_sess_ackmsg"]='<div id="ack_div" class="error_message errorred"> Menu Insertion Failed!</div>';
	}

	
	echo "<script>window.location.href='list-menu.php?opt=done$extraurl';</script>";
	exit;
}
else if(isset($_REQUEST["meng_menu"]) && $_REQUEST["meng_menu"]=="edit"){
	foreach($extraurl_array as $key => $val){ 
		$extraurl.=(isset($_REQUEST[$key]) && $_REQUEST[$key]!='')?'&'.$key.'='.$_REQUEST[$key]:'';
		$extraurl_array[$key]=(!isset($_REQUEST[$key]))?'':mysql_real_escape_string(trim($_REQUEST[$key]));	
	}
	
	
	foreach($request_array as $key => $val){ $request_array[$key]=(!isset($_REQUEST[$key]))?'':mysql_real_escape_string(trim($_REQUEST[$key]));	}
	$ispublish=isset($_REQUEST["ispublish"])?"1":"0";
	$is_dashboard_icon=isset($_REQUEST["is_dashboard_icon"])?"1":"0";
	
	$sql=" update "._DB_PREFIX."menu set menu_name='".$request_array['menu_name']."',is_dashboard_icon='".$is_dashboard_icon."',ispublish='".$ispublish."',order_index='".$request_array['order_index']."',icon='".$request_array['icon']."',menu_type='".$request_array['menu_type']."' where menu_id='".$request_array['menu_id']."'";
	$rowAffected=$db->query($sql);
	
	if($rowAffected > 0){ 	$_SESSION["inte_sess_ackmsg"]='<div id="ack_div" class="error_message truegreen"> Menu  Updated successfully</div>';}
	else{ $_SESSION["inte_sess_ackmsg"]='<div id="ack_div" class="error_message errorred"> Menu Updation Failed!</div>';}


	echo "<script>window.location.href='list-menu.php?opt=done$extraurl';</script>";
	exit;
	
}
else if(isset($_REQUEST["delmenu"]) && $_REQUEST["delmenu"]=="delmenu"){
	
	foreach($extraurl_array as $key => $val){ $extraurl.=(isset($_REQUEST[$key]) && $_REQUEST[$key]!='')?'&'.$key.'='.$_REQUEST[$key]:'';
		$extraurl_array[$key]=(!isset($_REQUEST[$key]))?'':mysql_real_escape_string(trim($_REQUEST[$key]));	

	}
	$menu_id=$_REQUEST["menu_id"];
	$sql="delete from "._DB_PREFIX."menu where menu_id='".$menu_id."'";
	$rowafftected=$db->query($sql);
	if($rowafftected > 0){
		$_SESSION["inte_sess_ackmsg"]='<div id="ack_div" class="error_message truegreen"> Menu Deleted Successfully</div>';
	}
	else{
		$_SESSION["inte_sess_ackmsg"]='<div id="ack_div" class="error_message errorred"> Menu Deletetion Failed!</div>';
	}

	echo "<script>window.location.href='list-menu.php?opt=done$extraurl';</script>";
	exit;
}

$mode=$_REQUEST["mode"];

$contentBox='Add Menu';
if($mode=="edit"){
	$id=$_REQUEST["id"];
	$sql="select * from "._DB_PREFIX."menu where menu_id='$id'";
	$db->query($sql);
	$data=$db->fetchAssoc();
	$request_array['menu_id']=stripslashes($data["menu_id"]);
	$request_array['menu_name']=stripslashes($data["menu_name"]);
	$request_array['menu_type']=stripslashes($data["menu_type"]);
	$request_array['ispublish']=stripslashes($data["ispublish"]);
	$request_array['order_index']=stripslashes($data["order_index"]);
	$request_array['icon']=stripslashes($data["icon"]);
	$request_array['is_dashboard_icon']=stripslashes($data["is_dashboard_icon"]);
	$contentBox='Update Menu';

}
else{
	$mode="add";
	//$new_emp_code=getUpdateAutoIncrementCode(_DB_PREFIX."autocode","emp_code","H00",2,'');
	
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php  echo _ADMIN_PAGE_TITLE_;?> </title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="css/tableelement.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/ddaccordion.js"></script>

<script type="text/javascript" src="js/common.js"></script>


<link href="css/jquery-ui-1.9.1.custom.css" rel="stylesheet">
<script src="js/jquery.min.js" type="text/javascript"></script>
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
	<!--<h1><?php //echo $profile['company']; ?>Product Management System</h1>-->

	<table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="71%" align="left" valign="top">
		  
		 <form method="post" enctype="multipart/form-data" name="frmSearch" id="frmSearch">
		  
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
				<td width="151" valign="top"  style="padding:5px;"><strong>Menu Group Name *</strong></td>
				<td width="198" valign="top"  style="padding:5px;"><input  type="text" onkeypress="return hideLevel('menu_name');"   name="menu_name" id="menu_name" value="<?php echo $request_array['menu_name'];?>" class="formfld" style="width:150px;"/><label class="error" id="lbl_menu_name"></label></td>
				<td  style="padding:5px;"></td>
				
				<td width="117" valign="top"  style="padding:5px;"><strong>Order Index *</strong> </td>
				<td width="610" valign="top"  style="padding:5px;"><input  type="text" onkeypress="return  numbersonly(event);hideLevel('order_index');"   name="order_index" id="order_index" value="<?php echo $request_array['order_index'];?>" class="formfld" style="width:150px;"/><label class="error" id="lbl_order_index"></label></td>		
					</tr>

			<tr>
				<td width="151" valign="top"  style="padding:5px;"><strong>Icon</strong></td>
				<td width="198" valign="top"  style="padding:5px;"><input  type="text" onkeypress="return hideLevel('icon');"   name="icon" id="icon" value="<?php echo $request_array['icon'];?>" class="formfld" style="width:150px;"/><label class="error" id="lbl_icon"></label></td>
				<td  style="padding:5px;"></td>
				
				<td width="117" valign="top"  style="padding:5px;"><strong>Type </strong> &nbsp; </td>
				<td width="610" valign="top"  style="padding:5px;">
				<select name="menu_type" id="menu_type"  class="formfld" style="width:100px;" >
					<?php
					foreach ($MENU_TYPE_ARRAY as $key => $value){
						$sel='';
						if($key==$request_array["menu_type"] ){ $sel=' selected '; }
						echo '<option value="'.$key.'" '.$sel.'>'.$value.'</option>';
						
					}
					?>
					</select>
				</td>	
					</tr>
							
							<tr>
								<td  style="padding:5px;" valign="top" class="codefont"><strong>Show In Dashboard?</strong> &nbsp;</td>
								<td  style="padding:5px;" valign="top" class="codefont">
									<input type="checkbox" name="is_dashboard_icon" id="is_dashboard_icon"  <?php echo ($request_array['is_dashboard_icon']==1)?' checked ':'';?> />
								</td>
								<td  style="padding:5px;"></td>
								<td  style="padding:5px;" valign="top" class="codefont"><strong>Is Show?</strong> &nbsp;</td>
								<td  style="padding:5px;" valign="top" class="codefont">
									<input type="checkbox" name="ispublish" id="ispublish"    <?php echo ($request_array['ispublish']==1)?' checked ':'';?> />
								</td>
								
							</tr>	
			 <tr>
                <td colspan="5" align="center" style="padding:5px;"><input name="Submit2" id="Submit2" type="submit" class="bluebutton" value="<?php echo $contentBox;?>" onclick="return validateForm();" /></td>
              </tr>
            </table>
				<input type="hidden" name="meng_menu" value="<?php echo $mode; ?>" id="meng_employee" />
				<input type="hidden" name="page" id="page" value="<?php echo $extraurl_array["page"]; ?>" />
				<input type="hidden" name="rpp" id="rpp" value="<?php echo $extraurl_array["rpp"];?>" />
				<input type="hidden" name="fcond" id="fcond" value="<?php echo $extraurl_array["fcond"];?>" />
				<input type="hidden" name="fcondvalue" id="fcondvalue" value="<?php echo $extraurl_array["fcondvalue"];?>" />
				<input type="hidden"  name="menu_id" id="menu_id" value="<?php echo $request_array['menu_id'];?>" />
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
<script language="javascript">$('#menu_name').focus();</script>
<script language="javascript" type="text/javascript">
function validateForm(){
	var returnflag=true;
	var theFields=new Array("menu_name","order_index");
	var theCaption=new Array("menu group name","order index");
	for(var i=0;i<theFields.length;i++)
	{
		var thevalue=$('#'+theFields[i]).val();
		thevalue=rm_trim(thevalue);
		if(thevalue=='')
		{
			$('#lbl_'+theFields[i]).show();
			$('#lbl_'+theFields[i]).html(theCaption[i]+" should not blank");
			if(returnflag) { $('#'+theFields[i]).focus(); }
			returnflag= false;
		}
		
	}
	return returnflag;
}


</script>
</body>
</html>
