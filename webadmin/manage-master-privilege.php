<?php include("config.php"); 
$db=new Database();	
$db->open();

$parent_id=!isset($_REQUEST["parent_id"])?'':$_REQUEST["parent_id"];
$request_array=array("priv_id" =>"","priv_name" =>"","parent_id" =>"");

if(isset($_REQUEST["meng_priv"]) && $_REQUEST["meng_priv"]=="add"){ 
	foreach($request_array as $key => $val){ $request_array[$key]=(!isset($_REQUEST[$key]))?'':mysql_real_escape_string(trim($_REQUEST[$key]));	}
	
	$sql="insert into "._DB_PREFIX."masterprivilege(priv_name,parent_id) values('".$request_array["priv_name"]."','".$request_array["parent_id"]."')";
	$rowafftected=$db->query($sql);
	if($rowafftected > 0){
		$request_array['priv_id']=$db->insertID();
		$db->rs_insert(""._DB_PREFIX."emppriv","emp_id,priv_id","'1','".$request_array['priv_id']."'");
		
		$_SESSION["inte_sess_ackmsg"]='<div id="ack_div" class="error_message green_msg"> Privilege Added Successfully </div>';
	}
	else{
		$_SESSION["inte_sess_ackmsg"]='<div id="ack_div" class="error_message red_error"> Privilege Addition Failed! </div>';
	}
	echo "<script>window.location.href='manage-master-privilege.php?mode=add&parent_id=$parent_id';</script>";
	exit;
}
else if(isset($_REQUEST["meng_priv"]) && $_REQUEST["meng_priv"]=="edit"){
	foreach($request_array as $key => $val){ $request_array[$key]=(!isset($_REQUEST[$key]))?'':mysql_real_escape_string(trim($_REQUEST[$key]));	}
	$sql=" update "._DB_PREFIX."masterprivilege set priv_name='".$request_array['priv_name']."',parent_id='".$request_array['parent_id']."' ".
	" where priv_id='".$request_array['priv_id']."'";
	$rowafftected=$db->query($sql);	

	if($rowafftected > 0){ $_SESSION["inte_sess_ackmsg"]='<div id="ack_div" class="error_message green_msg"> Privilege Updated Successfully </div>';	}
	else{ $_SESSION["inte_sess_ackmsg"]='<div id="ack_div" class="error_message red_error"> Privilege Updation Failed! </div>'; }

	echo "<script>window.location.href='manage-master-privilege.php?mode=add&parent_id=$parent_id';</script>";
	exit;
		
}
else if(isset($_REQUEST["delprivilege"]) && $_REQUEST["delprivilege"]=="delprivilege"){
	$priv_id=$_REQUEST["priv_id"];
	$sql="delete from "._DB_PREFIX."emppriv where priv_id='".$priv_id."'";
	$rowafftected=$db->query($sql);
	
	
	$sql="delete from "._DB_PREFIX."masterprivilege where priv_id='".$priv_id."'";
	$rowafftected=$db->query($sql);
	if($rowafftected > 0){$_SESSION["inte_sess_ackmsg"]='<div id="ack_div" class="error_message green_msg"> Privilege Deleted Successfully </div>';}
	else{ $_SESSION["inte_sess_ackmsg"]='<div id="ack_div" class="error_message errorred"> Privilege Deletion Failed! </div>';}
	echo "<script>window.location.href='manage-master-privilege.php?mode=add&parent_id=$parent_id';</script>";
	exit;
}
$mode=isset($_REQUEST["mode"])?$_REQUEST["mode"]:"add";

$page_caption=' Add ';
if($mode=="edit"){
	$priv_id=$_REQUEST["priv_id"];
	foreach($request_array as $key => $val){ $request_array[$key]=(!isset($_REQUEST[$key]))?'':mysql_real_escape_string(trim($_REQUEST[$key]));	}
	$sql="select * from "._DB_PREFIX."masterprivilege where priv_id='$priv_id'";
	$db->query($sql);
	$data=$db->fetchAssoc();
	$request_array['priv_name']=stripslashes($data["priv_name"]);
	$request_array['parent_id']=stripslashes($data["parent_id"]);
	$page_caption=' Update ';

}
else{
	$mode="add";
}

$INPUT_FLAG=true;
//if(isset($_SESSION["sess_add_service_payment"]) && $mode=="add"){ $INPUT_FLAG=true;}
//else if(isset($_SESSION["sess_edit_service_payment"]) && $mode=="edit"){ $INPUT_FLAG=true;}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php  echo _ADMIN_PAGE_TITLE_;?></title>
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<style>
	
.listinggrid{padding:8px;  border-bottom:1px #dfdfdf solid;}
.listinggrid a{ color:#21759b; text-decoration:none;}
.listinggrid a:hover{ color:#666; text-decoration:none;}
.current_Row { background-color:#cdc9c9;}
.temp_Row { background-color:#eee9e9;	}
.bluebutton {font-weight: bold; color: white; background: #0580bd url(images/button-grad.png) repeat-x scroll left top; text-shadow: rgba(0, 0, 0, 0.3) 0 -1px 0; font-family: sans-serif; padding: 3px 10px; border: none; font-size: 13px; border-style: solid; -moz-border-radius: 11px; -khtml-border-radius: 11px; -webkit-border-radius: 11px; border-radius: 11px; cursor: pointer; text-decoration: none; margin-top: -3px; border-image: initial; border:1px #006699 solid;}
label.error { 
   float: none; color: red; 
   padding-left: .5em;
   vertical-align: top; 
   display: block;
   font-size:10px;
}

.error_message {border-width: 1px; border-top-width: 1px; border-right-width: 1px;border-bottom-width: 1px; border-left-width: 1px; border-style: solid; border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; padding: 12px;
padding-top: 12px; padding-right: 12px; padding-bottom: 12px; padding-left: 12px; -moz-border-radius: 3px; -khtml-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px;border-top-left-radius: 3px; border-top-right-radius: 3px; border-bottom-right-radius: 3px; border-bottom-left-radius: 3px;}
.red_error {background-color:#FFEBE8;  border:1px #C00 solid;}
.green_msg {background-color: #d2f1b9; border:1px #c4ee6b solid;}
.truegreen{ background-color: #d2f1b9; border:1px #c4ee6b solid; background-image:url(images/accept.png); background-position:10px center; padding:10px 10px 10px 35px; background-repeat:no-repeat; margin-bottom:10px;}
.errorred{ background-color:#FFEBE8;  border:1px #C00 solid; background-image:url(images/cross.png); background-position:10px center; padding:10px 10px 10px 35px; }
.tblheader_td {
	background-image: url(images/excel-2007-header-bg.gif);
	background-repeat: repeat-x; 
	font-weight: bold;
	font-size: 14px;
	border: 1px solid #9EB6CE;
	border-width: 0px 1px 1px 0px;
	height: 17px;
}
.tblheader_td a {
	color:#666;
	text-decoration:none;
}
.tblheader_td a:hover{ color:#666; text-decoration:underline;}
</style>
</head>

<body id="homeinnerbg">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td  align="left" valign="top">
	<?php if(isset($_SESSION["inte_sess_ackmsg"])){ echo $_SESSION["inte_sess_ackmsg"];unset($_SESSION["inte_sess_ackmsg"]); }?>
	<?php if($INPUT_FLAG){ ?>
	
	<div class="rightbodysec">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td align="left" valign="top">
		 <form method="post" name="frmSearch" id="frmSearch">
		  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table1">
			<tr>
				<td valign="top"  style="padding:5px;">Privilege Name  *</td>
				<td valign="top"  style="padding:5px;">
					<input  type="text" value="<?php echo $request_array['priv_name'];?>" name="priv_name" id="priv_name" class="formfld" style="width:300px;" />
					&nbsp;&nbsp;<label class="error" id="lbl_priv_name"></label>
				</td>
			</tr>
			 <tr>
					<td  style="padding:5px;" valign="top" class="codefont" colspan="2" align="center">
						<input name="Submit2" id="Submit2" type="submit" class="bluebutton" value="<?php echo $page_caption;?>" onclick="return validateForm();" />
					</td>
              </tr>
            </table>
				<input type="hidden" name="meng_priv" value="<?php echo $mode; ?>" id="meng_priv" />
				<input type="hidden"  name="priv_id" id="priv_id" value="<?php echo $request_array['priv_id'];?>" />
				<input type="hidden"  name="parent_id" id="parent_id" value="<?php echo $parent_id;?>" />
				
		  </form>
		  </td>
        </tr>
      </table>
	</div>
	<br />
	<?php } ?>
	
	<div class="rightbodysec">
	  <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="100%" align="left" valign="top">
		  <table width="100%" border="1"style="border: 1px solid #B0CBEF;border-width: 1px 0px 0px 1px;font-size: 11pt;font-family: Calibri;font-weight: 100;border-spacing: 0px;border-collapse: collapse;">
            <tr>
              <td align="left" valign="top" class="tblheader_td">SL No.</td>
              <td align="left" valign="top" class="tblheader_td">Privilege Name</td>
			  <td align="center" valign="top" class="tblheader_td">Action</td>
            </tr>
            <?php 
			$sql="select * from "._DB_PREFIX."masterprivilege where parent_id='$parent_id' order by priv_id desc";
			$db->query($sql);
			$numrows=$db->numRows();
			if($numrows>0){
				$classID="greenbg";
				$sno=1;
				while($rsdata=$db->fetchAssoc()){
				$priv_id=$rsdata["priv_id"];
				$parent_id=$rsdata["parent_id"];
				 
			?>
					<tr class="<?php echo $classID;?>"  onclick="ChangeGridCSS(this,'<?php echo $classID; ?>')" onmouseover="mouseMove(this,'<?php echo $classID; ?>')" onmouseout="mouseOut(this,'<?php echo $classID; ?>')">
					  <td align="left" valign="top"><?php echo $sno; ?>.</td>
					  <td  align="left" valign="top"><?php echo stripslashes($rsdata["priv_name"]); ?></td>
					  <td align="center" valign="top">
					  <a href="manage-master-privilege.php?mode=edit&priv_id=<?php echo $priv_id.'&parent_id='.$parent_id;?>">
					  	<img src="images/modify.gif" border="0" style="cursor:pointer" title="Edit">
					  </a>
							
						<?php echo '<a href="manage-master-privilege.php?priv_id='.$priv_id.'&parent_id='.$parent_id.'&delprivilege=delprivilege" onClick="return cmd_delete(\'privilege\');"><img src="images/delete_icon.png" border="0" title="Delete "></a>';
								?>	
					  </td>
					</tr>
				 <?php  $sno++;}
					} else { ?>
					  <tr><td align="center" valign="middle" colspan="3">No Payment Found !</td></tr>
					<?php } ?>
          </table></td>
        </tr>
      </table>
	</div>
	</td>
  </tr>
</table>
<script language="javascript" type="text/javascript">
function validateForm(){
	var returnflag=true;
	var theFields=new Array("priv_name");
	var theCaption=new Array("privilege name");
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
