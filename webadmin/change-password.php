<?php include("config.php");
$contentBox='Reset Password';
if(!isset($_SESSION["inte_sess_reset_password"])){
		$_SESSION["inte_sess_privmsg"]='<div id="ack_div" class="error_message errorred">Access Out of Privilege</div>';
		header("Location: home.php");
		exit;
}


if(isset($_POST['btnAdd']))
{
	$db=new Database();	
	$db->open();

	 $oldpass=sha1($_POST['old_pass']);
	 $newpass=sha1($_POST['new_pass']);
	 $conpass=sha1($_POST['re_new_pass']);
	if($conpass==$newpass)
	{
		
		$sql="select * from "._DB_PREFIX."employee where emp_password='$oldpass' and emp_loginid='".$_SESSION["inte_sess_emp_loginid"]."'";
		$db->query($sql);
		$numrows=$db->numRows();
		if($numrows>0)
		{
			$sql="update "._DB_PREFIX."employee set emp_password='$newpass' where emp_password='$oldpass' and emp_loginid='".$_SESSION["inte_sess_emp_loginid"]."'";
			$db->query($sql);
			$_SESSION['inte_sess_ackmsg']='<div id="ack_div" class="error_message truegreen">Password changed Successfully</div>';
		}
		else
		{
			$_SESSION['inte_sess_ackmsg']='<div id="ack_div" class="error_message errorred">Old Password is not Correct!</div>';
		}
	}
	else
	{
		$_SESSION['inte_sess_ackmsg']='<div id="ack_div" class="error_message errorred">Please correct Confirm Password!</div>';
	}
	
}	



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php  echo _ADMIN_PAGE_TITLE_;?></title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="css/tableelement.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/ddaccordion.js"></script>
<script type="text/javascript" src="js/common.js"></script>


<link href="css/jquery-ui-1.9.1.custom.css" rel="stylesheet">
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
		  
		 <form name="frm_chnagepassword" id="frm_chnagepassword" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
					<input type="hidden" name="query" value="frm_chnagepassword" id="query" />
		  
		  <table width="100%" border="0" cellpadding="2" cellspacing="2" class="table1">
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
			<td width="263" valign="top"  style="padding:5px;"><strong>Old Password</strong></td>
			<td width="862" valign="top"  style="padding:5px;"><input  type="password" onkeypress="return hideLevel('old_pass');"   name="old_pass" id="old_pass"  class="formfld"/><label class="error" id="lbl_old_pass"></label></td>
			</tr>
			<tr>
			<td width="263" valign="top"  style="padding:5px;"><strong>New Password</strong></td>
			<td width="862" valign="top"  style="padding:5px;"><input  type="password" onkeypress="return hideLevel('new_pass');"   name="new_pass" id="new_pass"  class="formfld"/><label class="error" id="lbl_new_pass"></label></td>
			</tr>
			<tr>
			<td width="263" valign="top"  style="padding:5px;"><strong>Re Confirm Password</strong></td>
			<td width="862" valign="top"  style="padding:5px;"><input  type="password" onkeypress="return hideLevel('re_new_pass');"   name="re_new_pass" id="re_new_pass"  class="formfld"/><label class="error" id="lbl_re_new_pass"></label></td>
			</tr>
			 <tr>
               		<td  style="padding:5px;" valign="top" class="codefont">&nbsp;&nbsp; &nbsp;</td>
					<td  style="padding:5px;" valign="top" class="codefont">
						<input name="btnAdd" id="btnAdd" type="submit" class="bluebutton" value="<?php echo $contentBox;?>" onclick="return validateForm();" /></td>
              </tr>
            </table>
				
			
		  </form>
		  
		  
		  </td>
        </tr>
      </table>
	</div>
	</div></td>
  </tr>
</table>
<script language="javascript" type="text/javascript">
function validateForm(){
	var theFields=new Array("old_pass","new_pass","re_new_pass");
	var theCaption=new Array("Old Password","New Password","Re New Password");
	for(var i=0;i<theFields.length;i++)
	{
		var thevalue=$('#'+theFields[i]).val();
		thevalue=rm_trim(thevalue);
		if(thevalue=='')
		{
			$('#lbl_'+theFields[i]).show();
			$('#lbl_'+theFields[i]).html(theCaption[i]+" should not blank");
			$('#'+theFields[i]).focus();
			return false;
		}
		else{
			$('#lbl_'+theFields[i]).html("");
			$('#lbl_'+theFields[i]).hide();
			
		}
		if(i==2)
		{
			
		}
	}
	return true;
}


</script>
</body>
</html>
