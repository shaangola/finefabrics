<?php include("config.php");
//print_r($_SESSION);
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php  echo _ADMIN_PAGE_TITLE_;?> </title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/ddaccordion.js"></script>



<link href="css/jquery-ui-1.9.1.custom.css" rel="stylesheet">
<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script> -->

<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script src="js/jquery-ui-1.9.1.custom.js"></script>

</head>

<body id="homeinnerbg">
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
                  <td width="71%" align="left" valign="top"><?php if(isset($_SESSION["inte_sess_privmsg"])){echo $_SESSION["inte_sess_privmsg"];unset($_SESSION["inte_sess_privmsg"]);} ?></td>
                </tr>
          </table>
        </div>
	</div>
    </td>
  </tr>
</table>



</body>
</html>
