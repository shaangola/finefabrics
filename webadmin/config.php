<?php error_reporting(0);
ob_start();
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/database.inc.php");
require_once("../inc/functions.inc.php");
$_SESSION["inte_sess_send_back_url"]=full_url();

$inte_sess_login_status=isset($_SESSION['inte_sess_login_status'])?$_SESSION['inte_sess_login_status']:'';
$sess_emp_loginid=isset($_SESSION['inte_sess_emp_loginid'])?$_SESSION['inte_sess_emp_loginid']:'';



if($inte_sess_login_status!=session_id()."_".$sess_emp_loginid."_login"){
	$_SESSION['msg']="Please login first";
	//$_SESSION["send_back_url"]=full_url();
	echo "<script>window.location.href='login.php';</script>";
	exit();
}
?>