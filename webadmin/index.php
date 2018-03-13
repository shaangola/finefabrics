<?php ob_start();
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Administrator</title>
	<link href="style.css" type="text/css" rel="stylesheet">
</head>
<body>
<?php
if(isset($_SESSION["inte_sess_login_status"]) and isset($_SESSION["inte_sess_emp_loginid"])){
	if($_SESSION['inte_sess_login_status']!=session_id()."_".$_SESSION["inte_sess_emp_loginid"]."_login"){
		echo "<script>window.location.href='login.php';</script>";
		exit();
	}
	else{
		echo "<script>window.location.href='home.php';</script>";
		exit();
	}		
}	
else{
	echo "<script>window.location.href='home.php';</script>";
	exit();
}		

?>
</body>
</html>

