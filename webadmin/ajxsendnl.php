<?php session_start();
require_once("../inc/config.inc.php");
require_once("../inc/database.inc.php");
require_once("../inc/functions.inc.php");


$db=new Database();	
$db->open();
$db1=new Database();	
$db1->open();
$db_count=new Database();	
$db_count->open();
$responsetext="";

if(isset($_REQUEST["qry"]) && $_REQUEST["qry"]=="sendnewsletter"){
    $responsetext="";
	$bulktype=mysqli_real_escape_string($db->conn,trim($_REQUEST["bulktype"]));
	$newsletter_id=mysqli_real_escape_string($db->conn,trim($_REQUEST["newsletter_id"]));
	$MAIL_BODY='';
	$sql="select newsletter_title,newsletter_content from "._DB_PREFIX."newsletter where newsletter_id='$newsletter_id' and ispublish=1";
	$db->query($sql);
	$rows_ob=$db->numRows();
	if($rows_ob > 0){
		$data=$db->fetchAssoc();
		$MAIL_BODY=stripslashes($data["newsletter_content"]);
		$MAIL_SUBJECT=stripslashes($data["newsletter_title"]);
		$send_flag=false;
		$sql_count="select count(id) as scount  from "._DB_PREFIX."newsletter where ispublish=1 and send=0";
		$db_count->query($sql_count);
		$data_count=$db_count->fetchAssoc();
		$rows_count=intval($data_count["scount"]);
		if($rows_count > 0){
			$send_flag=true;
		}
		else{
			$sql_count="update "._DB_PREFIX."newsletter set send=0 where ispublish=1";
			$db_count->query($sql_count);
			$send_flag=true;
		}
		if($bulktype=="1"){
			$scount=0;
			$sql1="select subscriber_email,subscriber_name,id from "._DB_PREFIX."subscription where ispublish=1";
			$db1->query($sql1);
			$rows_ob1=$db1->numRows();
			if($rows_ob1 > 0){
				while($data1=$db1->fetchAssoc()){
					$unsubscribelink=_SITE_URL_.'unsubscribe.php?id='.md5($data1['id']);
					$current_MAIL_BODY=str_replace('@unsubscribelink',$unsubscribelink,$MAIL_BODY);
					$subscriber_email=stripslashes($data1["subscriber_email"]);
					$subscriber_name=stripslashes($data1["subscriber_name"]);
					$mailack=sendSmtpMail($subscriber_email,$subscriber_name,_NL_EMAIL,_NL_FROM,$MAIL_SUBJECT,$current_MAIL_BODY,NULL,NULL,NULL);
					$sql_count="update "._DB_PREFIX."subscription set send=1 where id=".$data1['id'];
					$db_count->query($sql_count);
					$scount++;
				}
				$responsetext='<div class="error_message truegreen">Newsletter send to '.$scount.' subscriber</div>';
			}
		}
		else if($bulktype=="2"){
			$scount=0;
			$email_cond='';
			if(isset($_REQUEST["subscriber_email"])){
				if(is_array($_REQUEST["subscriber_email"])){
					foreach($_POST["subscriber_email"] as $skey => $sval){
						if(trim($sval)!=''){
							if($scount > 0){ $email_cond.=',';}
							$email_cond.="'".stripslashes(trim($sval))."'";
							$scount++;
						}
					}
				}
			}
			if($scount > 0){
				$sql1="select subscriber_email,subscriber_name,id from "._DB_PREFIX."subscription where ispublish=1 and subscriber_email in($email_cond)";
				$db1->query($sql1);
				$rows_ob1=$db1->numRows();
				if($rows_ob1 > 0){
					while($data1=$db1->fetchAssoc()){
						$unsubscribelink=_SITE_URL_.'unsubscribe.php?id='.md5($data1['id']);
						$current_MAIL_BODY=str_replace('@unsubscribelink',$unsubscribelink,$MAIL_BODY);
						$subscriber_email=stripslashes($data1["subscriber_email"]);
						$subscriber_name=stripslashes($data1["subscriber_name"]);
						$mailack=sendSmtpMail($subscriber_email,$subscriber_name,_NL_EMAIL,_NL_FROM,$MAIL_SUBJECT,$current_MAIL_BODY,NULL,NULL,NULL);
						$sql_count="update "._DB_PREFIX."subscription set send=1 where id=".$data1['id'];
						$db_count->query($sql_count);
						
					}
					$responsetext='<div class="error_message truegreen">Newsletter send to '.$scount.' subscriber</div>';
				}
				
			}
		}
	}
	else { $responsetext='<div class="error_message red_error">No newsletter selected</div>'; }	

		
	
}
echo $responsetext;

$db->close();	

?>