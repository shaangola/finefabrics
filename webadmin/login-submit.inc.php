<?php session_start();
header("Cache-Control: no-cache, must-revalidate");
ob_start();
require_once("../inc/config.inc.php");
require_once("../inc/database.inc.php");
require_once("../inc/settings.inc.php");

?>
<?php

//get the posted values

$errmsg="";
$send_back_url="";
$db=new Database();	
$db->open();
$db1=new Database();	
$db1->open();

	$emp_loginid=($_POST["username"]);
	$emp_password=sha1($_POST["password"]);

	$sql_login="select emp.*,d.designation,d.desg_code,d.desg_id from "._DB_PREFIX."employee as emp left join "._DB_PREFIX."designation as d on  d.desg_id=emp.desg_id ".
					" where emp.emp_loginid='".$emp_loginid."' and emp.emp_password='".$emp_password."'";
	$db->query($sql_login);
	if($db->numRows()==1){
		$log=$db->fetchAssoc();				
		if($log["emp_loginid"]=="superadministrator"){
			$_SESSION["inte_sess_login_status"]=session_id()."_".$log["emp_loginid"]."_login";
			$_SESSION["inte_sess_emp_loginid"]=$log["emp_loginid"];
			$_SESSION['inte_sess_emp_type']='';
			$_SESSION['inte_sess_emp_name']=$log["emp_name"];
			$_SESSION['inte_sess_emp_id']=$log["emp_id"];
			$_SESSION['inte_sess_desg_code']=0;
			$_SESSION['inte_sess_desg_id']=0;
			$emp_id=$log["emp_id"];
			
			$db1->query("update "._DB_PREFIX."employee set last_login=now() where emp_loginid='".$emp_loginid."'");
			$_SESSION["inte_sess_login_time"]=date("F j, Y, g:i a");		

			$db1->query("select priv_name from "._DB_PREFIX."masterprivilege");
			while($data_priv=$db1->fetchArray())
				$_SESSION["inte_sess_".strtolower(str_replace(" ","_",$data_priv["priv_name"]))]="1";		

			$send_back_url=isset($_SESSION["inte_sess_send_back_url"])?$_SESSION["inte_sess_send_back_url"]:'';
			$_SESSION["inte_sess_send_back_url"]='';
			unset($_SESSION["inte_sess_send_back_url"]);
			if($send_back_url==''){ $send_back_url="index.php"; }
			$errmsg='yes#@#'.$send_back_url;
		}
		else if($log["ispublish"]=="1"){
			$_SESSION["inte_sess_login_status"]=session_id()."_".$log["emp_loginid"]."_login";
			$_SESSION["inte_sess_emp_loginid"]=$log["emp_loginid"];
			$_SESSION['inte_sess_emp_type']=$log["designation"];
			$_SESSION['inte_sess_emp_id']=$log["emp_id"];
			$_SESSION['inte_sess_emp_name']=$log["emp_name"];
			$_SESSION['inte_sess_desg_code']=$log["desg_code"];
			$_SESSION['inte_sess_desg_id']=$log["desg_id"];
			$emp_id=$log["emp_id"];
			
			$db1->query("update "._DB_PREFIX."employee set last_login=now() where emp_loginid='".$emp_loginid."'");
			$_SESSION["inte_sess_login_time"]=date("F j, Y, g:i a");
			
			$db1->query("select mp.priv_name from "._DB_PREFIX."masterprivilege as mp,"._DB_PREFIX."emppriv as ep  where mp.priv_id=ep.priv_id and ep.emp_id='".$log["emp_id"]."'");
			while($data_priv=$db1->fetchArray())
				$_SESSION["inte_sess_".strtolower(str_replace(" ","_",$data_priv["priv_name"]))]="1";
			
			$send_back_url=isset($_SESSION["inte_sess_send_back_url"])?$_SESSION["inte_sess_send_back_url"]:'';
			$_SESSION["inte_sess_send_back_url"]='';
			unset($_SESSION["inte_sess_send_back_url"]);
			if($send_back_url==''){ $send_back_url="home.php"; }	
			$errmsg='yes#@#'.$send_back_url;
		}
		else{
			 $errmsg='Wait for Authentication.You are blocked by Administrator.';
		}		
	}else{
		$errmsg='Login Detail is Incorrect.';
	}
	
	
	$db->close();
	$db1->close();
	
	echo $errmsg;
	

?>