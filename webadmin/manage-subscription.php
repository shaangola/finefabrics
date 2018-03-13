<?php include("config.php");
$db=new Database();	
$db->open();

$request_array=array("cat_id" =>"","cat_name" =>"","order_index" =>"","cat_img" =>"");
$extraurl_array=array("ftxt0"=>"","ftxt1" =>"","rpp" =>"","page" =>"","fcondvalue" =>"","fcond" =>"","ord" =>"","srt" =>"");
$extraurl='';
$adminmsg='';
$ispublish='';	
$ishome='';	
if(isset($_REQUEST["delsubscription"]) && $_REQUEST["delsubscription"]=="delsubscription"){

	
	foreach($extraurl_array as $key => $val){ $extraurl.=(isset($_REQUEST[$key]) && $_REQUEST[$key]!='')?'&'.$key.'='.$_REQUEST[$key]:'';
		$extraurl_array[$key]=(!isset($_REQUEST[$key]))?'':mysql_real_escape_string(trim($_REQUEST[$key]));	
	}
	$id=$_REQUEST["id"];
	
	
	$sql="delete from "._DB_PREFIX."subscription where id='$id'";
	$rowafftected=$db->query($sql);
	
	if($rowafftected > 0){
		$_SESSION["inte_sess_ackmsg"]='<div id="ack_div" class="error_message truegreen"> Subscriber Deleted Successfully</div>';
	}
	else{
		$_SESSION["inte_sess_ackmsg"]='<div id="ack_div" class="error_message errorred"> Subscriber Deletetion Failed!</div>';
	}

	echo "<script>window.location.href='list-subscription.php?opt=done$extraurl';</script>";
	exit;
}







?>

