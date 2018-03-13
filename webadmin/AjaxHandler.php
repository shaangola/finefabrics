<?php session_start();
require_once("../inc/config.inc.php");
require_once("../inc/database.inc.php");
require_once("../inc/settings.inc.php");
$db=new Database();	
$db->open();
$db1=new Database();	
$db1->open();
$db2=new Database();	
$db2->open();

if($_REQUEST["query"]=="changestatus"){
	$responseText="";
	$status=$_REQUEST["status"];
	$field=$_REQUEST["field"];
	$tdid=$_REQUEST["tdid"];
	$ccol=$_REQUEST["ccol"];
	$cval=$_REQUEST["cval"];
	$tablename=$_REQUEST["tname"];
	$sql_update="update $tablename set $field='$status' where $ccol='$cval'";
	$rowAffected=$db->query($sql_update);
	if($rowAffected>0){
		$responseText="";
		if($status=='1'){
			$responseText.='<img src="images/publish.jpg" border="0" style="cursor:pointer;" title="Change Status"  onClick="getAjxResp(\''.$tdid.'\',\'AjaxHandler.php?query=changestatus&field='.$field.'&tdid='.$tdid.'&tname='.$tablename.'&status=0&ccol='.$ccol.'&cval='.$cval.'\')"  />';
		}
		else if($status=='0'){
			$responseText.='<img src="images/blocked.gif" border="0" style="cursor:pointer;"  onClick="getAjxResp(\''.$tdid.'\',\'AjaxHandler.php?query=changestatus&field='.$field.'&tdid='.$tdid.'&tname='.$tablename.'&status=1&ccol='.$ccol.'&cval='.$cval.'\')"  title="Change Status" />';
		}
	}
	else{
		$responseText="status could not updated try again..";
	}
	echo $responseText;

	
}

else if($_REQUEST["query"]=="avlsubs"){
	$responseText="";
	$id=$_REQUEST["id"];
	$occupied="YES";
	$occupied_date=date("Y-m-d");
	$sql_update="update max_subscription set occupied='$occupied',occupied_date='$occupied_date' where id='$id'";
	$rowAffected=$db->query($sql_update);
	if($rowAffected>0){
		$responseText="1#@#$occupied#@#$occupied_date";
	}
	else{
		$responseText="0#@#error#@#errir";
	}
	echo $responseText;

	
}

else if($_REQUEST["query"]=="checkloginid"){
	$sql="";
	/*if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $_REQUEST["login_id"])){
		$responseText='<font color="#ff0000">Invalid Login Id</font>';
	}else{}*/
	
	
	if(isset($_REQUEST["oldemp_id"]))
		$sql="select * from "._DB_PREFIX."employee where emp_loginid='".$_REQUEST["login_id"]."' and emp_id!='".$_REQUEST["oldemp_id"]."'";
	else
		$sql="select * from "._DB_PREFIX."employee where emp_loginid='".$_REQUEST["login_id"]."'";	
	$db->query($sql);
	if($db->numRows()>0){
		$responseText='<font color="#ff0000">Not Available</font>';
	}
	else{
		$responseText='';
	}

	
	
	echo $responseText;
}

else if($_REQUEST["query"]=="resetpassword"){
	$emp_id=$_REQUEST["emp_id"];
	$emp_password=sha1($_REQUEST["emp_password"]);
	$modifyby=$_SESSION["inte_sess_emp_id"];
	$responseText="";
	$rowAffected=$db->query("update "._DB_PREFIX."employee set emp_password='$emp_password',modifyby='$modifyby',modifydate=now() where emp_id='$emp_id'");
	if($rowAffected>0){$responseText='1#@#<div id="ack_div" class="error_message truegreen">Password Reset successfully</div>';}
	else{$responseText='0#@#<div id="ack_div" class="error_message errorred">Password Reseting Failed Try again!</div>';}	
	
	echo $responseText;
	
}
else if($_REQUEST["query"]=="resetcustpassword"){
	$customer_id=$_REQUEST["customer_id"];
	$password=sha1($_REQUEST["password"]);
	$responseText="";
	$rowAffected=$db->query("update "._DB_PREFIX."customer set password='$password' where customer_id='$customer_id'");
	if($rowAffected>0){$responseText='1#@#<div id="ack_div" class="error_message truegreen">Password Reset successfully</div>';}
	else{$responseText='0#@#<div id="ack_div" class="error_message errorred">Password Reseting Failed Try again!</div>';}	
	
	echo $responseText;
	
}
else if($_REQUEST["query"]=="isfound")
{
    $responseText="";
	$tbl= mysql_real_escape_string($_REQUEST["tbl"]);
	$cc= mysql_real_escape_string($_REQUEST["cc"]);
	$cv= mysql_real_escape_string($_REQUEST["cv"]);
	$idc= mysql_real_escape_string($_REQUEST["idc"]);
	$idv= mysql_real_escape_string($_REQUEST["idv"]);
	$cond="$cc='".$cv."'";
	if($idv!=''){
		$cond.=" and $idc!='".$idv."'";
	}
	
	if($db->isFound(_DB_PREFIX."".$tbl,"$cond"))
		$responseText="Exist in System";
	else
		$responseText="";
	echo $responseText;
}

?>