<?php session_start();
header("Cache-Control: no-cache, must-revalidate");
ob_start();

require_once("../inc/config.inc.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>LOGIN |  <?php  echo _ADMIN_PAGE_TITLE_;?></title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="css/jquery-ui.css" rel="stylesheet" type="text/css"/>
  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-ui.min.js"></script>
  <script type="text/javascript" src="js/jquery.cookie.js"></script>
  
</head>

<body> 
<div id="login_contenor">
  <div align="center"><img src="../images/logo.png" alt="" title="" /></div>
  <div id="errorLoginMsgBox" align="center"></div>
  <div class="innerdiv" id="shk" >
    <form id="frmLogin" class="login_form" name="frmLogin" method="post" action="">
      <label>Username
        <input name="username" type="text" class="login_input" id="username" />
      </label>
      <label>Password
        <input name="password" type="password" class="login_input" id="password" />
        <input name="login" type="hidden" id="login" value="login" />
      </label>
      <label><input type="checkbox" name="RememberMe" id="RememberMe" value="1">Remember me</label>
      <label> </label>
      <input type="submit" name="Submit2" value="Submit" class="bluebutton" style="float:right;"/>
    </form>
  </div>
</div>






































































































<script>
$(document).ready(function() { var remember = $.cookie('pm[remember]');if (remember=="true") {$('#username').val($.cookie('pm[username]'));$('#password').val($.cookie('pm[password]'));$('#RememberMe').attr("checked", true);}	else{$('#username').val('');$('#password').val('');$('#RememberMe').attr("checked", false);}
	$("#frmLogin").submit(function(){ $("#errorLoginMsgBox").removeClass().addClass('error_message truegreen').text('Validating....').fadeIn(1000);
		$.post("login-submit.inc.php",{ username:$('#username').val(),password:$('#password').val(),rand:Math.random() } ,function(data)
        {dataArray=data.split('#@#');if(dataArray[0]=='yes') {remMe();document.location=dataArray[1];}else {$("#errorLoginMsgBox").removeClass().addClass('error_message errorred').fadeTo(200,0.1,function(){ $(this).html(dataArray[0]).fadeTo(900,1);});	}});return false;}); });	

function remMe(){var expires_day = 365;	if ($('#RememberMe').is(':checked')) { $.cookie('pm[username]', $('#username').val(), { expires: expires_day });  $.cookie('pm[password]', $('#password').val(), { expires: expires_day }); $.cookie('pm[remember]', true, { expires: expires_day }); } else { $.cookie('pm[username]', null); $.cookie('pm[password]', null); $.cookie('pm[remember]', false); } }
</script>

</body>
</html>
