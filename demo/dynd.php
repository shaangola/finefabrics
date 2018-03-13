<?php error_reporting(0);
ob_start();
session_start();
require_once("inc/config.inc.php");
require_once("inc/database.inc.php");
require_once("inc/functions.inc.php");

$returnjson=array("status" => '0',"message" => 'Invalid Request',"redirecturl" => '');
if (!$_SERVER['REQUEST_METHOD'] === 'POST') {
	$returnjson=array("status" => '0',"message" => 'Invalid Request',"redirecturl" => '');
	echo json_encode($returnjson);
	exit();
	
}	

else if(isset($_REQUEST["qry"]) && $_REQUEST["qry"]=="subscription"){
	$MAIL_ATTACHMENT=NULL;
	$error_msg='';
	$status=0;
	$message='';
	$db=new Database();	
	$db->open();
	$reqval=array("subscriber_name" =>"","subscriber_email" =>"","id" =>"");

	foreach($reqval as $key => $val){ 
		if(isset($_REQUEST[$key])){
			$reqval[$key]=(trim($_REQUEST[$key]));	
		}
	}
	
	if($db->isFound(_DB_PREFIX."subscription","subscriber_email='".$reqval["subscriber_email"]."'")){
		$message='<div class="alert alert-danger">Already Subscribed</div>';
		$status=0;
	}
	else{
		require_once("inc/mail-formate-util.php");
		$sql="INSERT INTO "._DB_PREFIX."subscription(subscriber_name, subscriber_email, subscribedatetime) ".
		" VALUES('".$reqval["subscriber_name"]."', '".$reqval["subscriber_email"]."', now())";
		$affectedrows=$db->query($sql);
		if($affectedrows > 0){
			$reqval["id"]=$db->insertID();
			$return_mail_param=getSubsMailFormat($reqval);
			$SUBJECT=$return_mail_param['mail_subject'];
			$MAIL_BODY=$return_mail_param['mail_message'];
			$BCC=NULL;//array(_BCC_EMAIL_);
		
			$mailack=sendSmtpMail($reqval["subscriber_email"],$reqval["subscriber_name"],_NL_EMAIL,_NL_FROM,$SUBJECT,$MAIL_BODY,NULL,$BCC,$MAIL_ATTACHMENT);
			if($mailack=="send"){
				$message='<div class="alert alert-success">Subcribed Successfully</div>';
				$status=1;
			}
			else{
				$message='<div class="alert alert-danger">Subscribing failed'.$mailack.'</div>';
				$status=0;
			}
		}
		else{
			$message='<div class="alert alert-danger">Subscribing failed try later...</div>';
			$status=0;
		}	
	}	

	
		
	$returnjson=array("status" => $status,"message" => $message,"redirecturl" => '');	
	echo json_encode($returnjson);
	exit();
	
	
}
else if(isset($_REQUEST["qry"]) && $_REQUEST["qry"]=="unsubscribe"){
	$status=0;
	$message='';
	$db=new Database();	
	$db->open();
	$reqval=array("id" =>"");

	foreach($reqval as $key => $val){ 
		if(isset($_REQUEST[$key])){
			$reqval[$key]=(trim($_REQUEST[$key]));	
		}
	}
	
	$sql="update "._DB_PREFIX."subscription set ispublish=0,unsubscribedatetime=now() where id=".$reqval["id"];
	$affectedrows=$db->query($sql);
	if($affectedrows > 0){
		$message='<div class="alert alert-success">Newsletter Unsubscribe successfuly</div>';
		$status=1;
	}
	else{
		$message='<div class="alert alert-danger">Unsubscribing process failed try later...</div>';
		$status=0;
	}		

	
		
	$returnjson=array("status" => $status,"message" => $message,"redirecturl" => '');	
	echo json_encode($returnjson);
	exit();
	
	
}





?>