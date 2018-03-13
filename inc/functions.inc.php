<?php
################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 #
## --------------------------------------------------------------------------- #
##  PHP AdminPanel Free                                                        #
##  Developed by:  ApPhp <info@apphp.com>                                      # 
##  License:       GNU GPL v.2                                                 #
##  Site:          http://www.apphp.com/php-adminpanel/                        #
##  Copyright:     PHP AdminPanel (c) 2006-2009. All rights reserved.          #
##                                                                             #
##  Additional modules (embedded):                                             #
##  -- PHP DataGrid 4.2.8                   http://www.apphp.com/php-datagrid/ #
##  -- JS AFV 1.0.5                 http://www.apphp.com/js-autoformvalidator/ #
##  -- jQuery 1.1.2                                         http://jquery.com/ #
##                                                                             #
################################################################################

    //--------------------------------------------------------------------------
    // set browser definitions
    //--------------------------------------------------------------------------
    function setBrowserDefinitions(){
        $bd = array();
        
        $agent = $_SERVER['HTTP_USER_AGENT'];
        // initialize properties
        $bd['platform'] = "Windows";
        $bd['browser'] = "MSIE";
        $bd['version'] = "6.0";    
          
        // find operating system
        if (eregi("win", $agent))       $bd['platform'] = "Windows";
        elseif (eregi("mac", $agent))   $bd['platform'] = "MacIntosh";
        elseif (eregi("linux", $agent)) $bd['platform'] = "Linux";
        elseif (eregi("OS/2", $agent))  $bd['platform'] = "OS/2";
        elseif (eregi("BeOS", $agent))  $bd['platform'] = "BeOS";
        
        // test for Opera
        if (eregi("opera",$agent)){
            $val = stristr($agent, "opera");
            if (eregi("/", $val)){
                $val = explode("/",$val); $bd['browser'] = $val[0]; $val = explode(" ",$val[1]); $bd['version'] = $val[0];
            }else{
                $val = explode(" ",stristr($val,"opera")); $bd['browser'] = $val[0]; $bd['version'] = $val[1];
            }
        // test for MS Internet Explorer version 1
        }elseif(eregi("microsoft internet explorer", $agent)){
            $bd['browser'] = "MSIE"; $bd['version'] = "1.0"; $var = stristr($agent, "/");
            if (ereg("308|425|426|474|0b1", $var)) $bd['version'] = "1.5";
        // test for MS Internet Explorer
        }elseif(eregi("msie",$agent) && !eregi("opera",$agent)){
            $val = explode(" ",stristr($agent,"msie")); $bd['browser'] = $val[0]; $bd['version'] = $val[1];
        // test for MS Pocket Internet Explorer
        }elseif(eregi("mspie",$agent) || eregi('pocket', $agent)){
            $val = explode(" ",stristr($agent,"mspie")); $bd['browser'] = "MSPIE"; $bd['platform'] = "WindowsCE";
            if (eregi("mspie", $agent))
                $bd['version'] = $val[1];
            else {
                $val = explode("/",$agent);     $bd['version'] = $val[1];
            }
        // test for Firebird
        }elseif(eregi("firebird", $agent)){
            $bd['browser']="Firebird"; $val = stristr($agent, "Firebird"); $val = explode("/",$val); $bd['version'] = $val[1];
        // test for Firefox
        }elseif(eregi("Firefox", $agent)){
            $bd['browser']="Firefox"; $val = stristr($agent, "Firefox"); $val = explode("/",$val); $bd['version'] = $val[1];
        // test for Mozilla Alpha/Beta Versions
        }elseif(eregi("mozilla",$agent) && eregi("rv:[0-9].[0-9][a-b]",$agent) && !eregi("netscape",$agent)){
            $bd['browser'] = "Mozilla"; $val = explode(" ",stristr($agent,"rv:")); eregi("rv:[0-9].[0-9][a-b]",$agent,$val); $bd['version'] = str_replace("rv:","",$val[0]);
        // test for Mozilla Stable Versions
        }elseif(eregi("mozilla",$agent) && eregi("rv:[0-9]\.[0-9]",$agent) && !eregi("netscape",$agent)){
            $bd['browser'] = "Mozilla"; $val = explode(" ",stristr($agent,"rv:")); eregi("rv:[0-9]\.[0-9]\.[0-9]",$agent,$val); $bd['version'] = str_replace("rv:","",$val[0]);
        // remaining two tests are for Netscape
        }elseif(eregi("netscape",$agent)){
            $val = explode(" ",stristr($agent,"netscape")); $val = explode("/",$val[0]); $bd['browser'] = $val[0]; $bd['version'] = $val[1];
        }elseif(eregi("mozilla",$agent) && !eregi("rv:[0-9]\.[0-9]\.[0-9]",$agent)){
            $val = explode(" ",stristr($agent,"mozilla")); $val = explode("/",$val[0]); $bd['browser'] = "Netscape"; $bd['version'] = $val[1];
        }
        // clean up extraneous garbage that may be in the name
        $bd['browser'] = ereg_replace("[^a-z,A-Z]", "", $bd['browser']);
        $bd['version'] = ereg_replace("[^0-9,.,a-z,A-Z]", "", $bd['version']);
        
        return $bd;
    }
    
    function removeBadChars($strWords){
        $bad_string = array("select", "drop", ";", "--", "insert","delete", "xp_", "%20union%20", "/*", "*/union/*", "+union+", "load_file", "outfile", "document.cookie", "onmouse", "<script", "<iframe", "<applet", "<meta", "<style", "<form", "<img", "<body", "<link", "_GLOBALS", "_REQUEST", "_GET", "_POST", "include_path", "prefix", "http://", "https://", "ftp://", "smb://" );
        for ($i = 0; $i < count($bad_string); $i++){
            $strWords = str_replace ($bad_string[$i], "", $strWords);
        }
        return $strWords;
    }
    
    function stripQuotes($strWords){
        return str_replace("'", "''", $strWords);
    }
	
	function full_url()
#
{
#
$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
#
$protocol = substr(strtolower($_SERVER["SERVER_PROTOCOL"]), 0, strpos(strtolower($_SERVER["SERVER_PROTOCOL"]), "/")) . $s;
#
$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
#
return $protocol . "://" . $_SERVER['SERVER_NAME'] . $port . $_SERVER['REQUEST_URI'];
#
}

function random_generator($digits){
srand ((double) microtime() * 10000000);
//Array of alphabets
$input = array ("A", "B", "C", "D", "E","F","G","H","I","J","K","L","M","N","O","P","Q",
"R","S","T","U","V","W","X","Y","Z");

$random_generator="";// Initialize the string to store random numbers
for($i=1;$i<$digits+1;$i++){ // Loop the number of times of required digits

if(rand(1,2) == 1){// to decide the digit should be numeric or alphabet
// Add one random alphabet 
$rand_index = array_rand($input);
$random_generator .=$input[$rand_index]; // One char is added

}else{

// Add one numeric digit between 1 and 10
$random_generator .=rand(1,10); // one number is added
} // end of if else

} // end of for loop 

return $random_generator;
}
function sendSmtpMail($TO_EMAIL,$TO_NAME,$FROM_EMAIL,$FROM_NAME,$SUBJECT,$MAIL_BODY,$CC_ARRAY,$BCC_ARRAY,$MAIL_ATTACHMENT){
	$send_flag=false;
	require_once ('class.phpmailer.php');
	//configuring mail
	$mail = new PHPMailer();
	//$mail->SetLanguage("en",'language/');
	$mail->SetLanguage("en",dirname($_SERVER['SCRIPT_FILENAME']).'/inc/language');
	$mail->IsSMTP();
	$mail->Host = _SMTP_HOST_;
	//$mail->Host = 'smtp.googlemail.com';
	$mail->SMTPDebug  = false;  
	$mail->SMTPAuth = true; // These three lines are necessary
	$mail->Port       =_SMTP_PORT_;  
	//$mail->SMTPSecure = 'ssl';
	$mail->Username = _SMTP_USERNAME_; // only if your SMTP server
	$mail->Password = _SMTP_PASSWORD_; // requires authentication
	$mail->From =$FROM_EMAIL;
	$mail->FromName =$FROM_NAME;
	$mail->Subject = $SUBJECT;
	$mail->IsHTML(true);
	//add receipent name
	$mail->AddAddress($TO_EMAIL,$TO_NAME);
	
	//add cc if any
	if(!is_null($CC_ARRAY)){
		foreach ($CC_ARRAY as $ccid => $ccemail){
			$mail->AddCC($ccemail);
		}
	}
	//add bcc if any
	if(!is_null($BCC_ARRAY)){
		foreach ($BCC_ARRAY as $bccid => $bccemail){
			$mail->AddBCC($bccemail);
		}
	}
	
	//add attachment if any	
	if(!is_null($MAIL_ATTACHMENT)){
		foreach ($MAIL_ATTACHMENT as $atchid => $attachment){
			$mail->AddAttachment($attachment);
		}
	}
	
	$mail->Body = $MAIL_BODY;
	if(!$mail->Send()) {
		$send_flag=$mail->ErrorInfo;
	}
	else{
		$send_flag="send";
	}
	
	return $send_flag;
}

function getPagination($rowCount,$rowsperpage,$page,$fnName,$abpath,$disppage)
{
	$pagenum=$page;// what page number
	$pagingstr="";
	//int offset=(int)((pagenum-1)* rowsperpage);
	$maxpage=0;
	$y=0;
	if($rowCount != 0)
	{
		$maxpage= ceil($rowCount/$rowsperpage);// count maximum page 

		//$y = ceil($rowCount % $rowsperpage);
	}
//	if($y != 0){
//		$maxpage = $maxpage+1;
//	}

	if($pagenum>1)
	{ // if page greater page then one
		$page=$pagenum-1;// decrese page no. the page no
		$first='<div class="port-links"><a href="'.$fnName.'&page='.$page.'">&lt;&lt; &nbsp;</a></div>';// for the back page
	}	 
	else
	{
			$first='<div class="port-links"><a href="#">&lt;&lt; &nbsp;</a></div>';
			// we're on page one, don't enable 'previous' link	
	}
	
	if($pagenum<$maxpage)
	{ // if page no is less then maximum page after the prevoius condition
		$page=$pagenum+1;  // add one in page
		$next ='<div class="port-links"><a href="'.$fnName.'&page='.$page.'">&nbsp; &gt;&gt;</a></div>'; //it should be linked
	}
	else
	{
		$next ='<div class="port-links"><a href="#" > &nbsp;&gt;&gt;</a></div>'; //not linked
	}
	
	$pagingstr="";
	$startPos=1;
	$endPos=$disppage;//limit of page to be display in paging
	$v3=$endPos; // how much page no u display

	if($maxpage<$endPos)
		$endPos=$maxpage;

	if($page==$maxpage-1 && $page>$v3)
	{// condition for the checking the page no == max page -1 and  page no greater then  show 										
										//page - 3 
		$startPos=$maxpage-$v3;
		$endPos=$maxpage;
	}
	else if($page==$maxpage  && $page>$v3)
	{
		$startPos=$maxpage-$v3;
		$endPos=$page;
	}
	else if($page>$v3)
	{
		$startPos=$page-$v3;
		$endPos=$page+2;
	}

	for($i=$startPos;$i<=$endPos;$i++)
	{
		if($i==$pagenum)
		{
			$pagingstr .='<div class="port-links" id="port-links-active">'.$i.'</div>';
		} 
		else 
		{
			$pagingstr .='<div class="port-links"><a href="'.$fnName.'&page='.$i.'">'.$i.'</a></div>';
		}
	}

	$pagingstr=$first.$pagingstr.$next;
	return $pagingstr;
}

function getID($table,$field,$cond_con,$cond_val){
	$dbgid=new Database();	
	$dbgid->open();

	$idgid='';
	$sqlgid="select $field from $table where $cond_con='$cond_val'";
	$dbgid->query($sqlgid);
	$numrowsgid=$dbgid->numRows();
	if($numrowsgid>0){
		$datagid=$dbgid->fetchAssoc();
		$idgid=stripslashes($datagid[$field]);
	}	
	return $idgid;	
}

function setLogHistory($effected_id,$effected_status,$effected_type,$remarks,$createdby){
	$db=new Database();	
	$db->open();
	$sql="insert into mp_action_log(effected_id,effected_status,effected_type,remarks,createdby,createddate) ".
		" values('$effected_id','$effected_status','$effected_type','$remarks','$createdby',now())";
	$db->query($sql);
}

function setRecruitmentLogHistory($effected_id,$effected_status,$effected_type,$remarks,$createdby){
	$db=new Database();	
	$db->open();
	$sql="insert into mp_action_log_recruitment(effected_id,effected_status,effected_type,remarks,createdby,createddate) ".
		" values('$effected_id','$effected_status','$effected_type','$remarks','$createdby',now())";
	$db->query($sql);
}

//candidate pdf generator
function createCandidatePDF($reference_no){
	$db=new Database();	
	$db->open();
	$db1=new Database();	
	$db1->open();
	$db2=new Database();	
	$db2->open();
		$QUALIFICATION_ARRAY = unserialize (_QUALIFICATION_);
		$PROFF_QUALIFICATION_ARRAY = unserialize (_PROFF_QUALIFICATION_);

		require('pdf.class.php');
		$pdf=new PDF();
		$pdf->AddPage();
		$pdf->SetAutoPageBreak(true,20);
		
		$sql="select tm.trade_name as post_applied,cinfo.candidate_name,cinfo.father_name,cinfo.mother_name,cinfo.date_of_birth,cinfo.nationality,cinfo.photo, ".
		" cinfo.place_of_birth,cinfo.languages_know,cinfo.qualification,cinfo.prof_qualification,cinfo.passport_number, ".
		" cinfo.place_of_issue,cinfo.issue_date,cinfo.expiry_date from mp_candidateinfo as cinfo  ".
		" left join mp_applicationinfo as appinfo on cinfo.reference_no=appinfo.reference_no ".
		" left join mp_trademaster as tm on appinfo.applied_position=tm.trade_id where cinfo.reference_no='$reference_no' ";
		
		$db->query($sql);
		$data=$db->fetchAssoc();
		
		$filename = _CANDIDATE_PDF_."/".stripslashes(str_replace(" ","-",$data["candidate_name"]))."-$reference_no.pdf";
		
		//$InvoiceNo = $bookingno; old
		$candidate_pic='';
		if($data["photo"]!="" &&  file_exists(_CANDIDATE_PHOTO_."/".$data["photo"])){
			$candidate_pic=_CANDIDATE_PHOTO_."/".$data["photo"];
		}
		$pdf->top(_COMPANY_NAME_,_COMP_ADDRESS_,stripslashes($data["post_applied"]),$candidate_pic);
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
			
		$pd_caption=array("Name" => stripslashes($data["candidate_name"]),
							"Father's Name"=> stripslashes($data["father_name"]),
							"Mother's Name" => stripslashes($data["mother_name"]),
							"Nationality"=> stripslashes($data["nationality"]),
							"Date Of Birth" => stripslashes($data["date_of_birth"]),
							"Place Of Birth"=> stripslashes($data["place_of_birth"]),
							"Languages Known"=> stripslashes($data["languages_know"]),
							"Educational Qualification"=> $QUALIFICATION_ARRAY[$data["qualification"]],
							"Professional Qualification"=> $PROFF_QUALIFICATION_ARRAY[$data["prof_qualification"]]);
		$pdf->setPersonalDetail($pd_caption);
		$pdf->Ln();

		$pd_caption=array("passport_number" => stripslashes($data["passport_number"]),
							"place_of_issue"=> stripslashes($data["place_of_issue"]),
							"issue_date"=> stripslashes($data["issue_date"]),
							"expiry_date"=> stripslashes($data["expiry_date"]));
		$pdf->setPassportDetail($pd_caption);
		$pdf->Ln();
		
		$exp=array();
		$exp_index=0;

		$sql="select * from mp_experience where reference_no='$reference_no' and exp_type='ind'";
		$db1->query($sql);
		if($db1->numRows() > 0 ){
			$exp_index=0;
			$exp='';
			while($data1=$db1->fetchAssoc()){
				$exp[$exp_index]=array("exp_year" => $data1['exp_year'],"exp_org" => stripslashes($data1['exp_org']),"exp_job" => stripslashes($data1['exp_job']));
				$exp_index++;
			}
			$pdf->setExperience($exp,"India");
			$pdf->Ln();
		}
		$sql="select * from mp_experience where reference_no='$reference_no' and exp_type='ovr'";
		$db2->query($sql);
		if($db2->numRows() > 0 ){
			$exp_index=0;
			$exp='';
			while($data2=$db2->fetchAssoc()){
				$exp[$exp_index]=array("exp_year" => $data2['exp_year'],"exp_org" => stripslashes($data2['exp_org']),"exp_job" => stripslashes($data2['exp_job']));
				$exp_index++;
			}
			$pdf->setExperience($exp,"Overseas");
			$pdf->Ln();
		}

		$sql="select doc_name,doc_file from mp_candidate_doc where reference_no='$reference_no'";
		$db->query($sql);
		if($db->numRows() > 0 ){
				$pdf->AddPage();
				$doc_index=0;
				$doc_array='';
				while($data=$db->fetchAssoc()){
					$doc_array[$doc_index]=array("doc_name" => $data['doc_name'],"doc_file" => stripslashes($data['doc_file']));
					$doc_index++;
				}

				$pdf->setDocument($doc_array);
				$pdf->Ln();
		}

		//$pdf->table_create();
		$pdf->Output($filename, 'F');
//		$to=$custemail;

}
// generate service invoice
function createServiceInvoice($candidates_id,$invoice_no,$agent_id){
	$db=new Database();	
	$db->open();
	$db1=new Database();	
	$db1->open();
	$db2=new Database();	
	$db2->open();
		
		require('invoice.class.php');
		$pdf=new PDF();
		$pdf->AddPage();
		$pdf->SetAutoPageBreak(true,20);
		$filename = _INVOICE_PDF_."/".$invoice_no.".pdf";
		$agnt_name='';
		$agnt_contactno='';
		$agnt_email='';
		$agnt_address='';
		
		$sql="select agnt_name,agnt_contactno,agnt_email,agnt_address from "._DB_PREFIX."agent where agent_id='$agent_id'";
		$db->query($sql);
		$data=$db->fetchAssoc();
		$to=stripslashes($data['agnt_name']);
		if($data['agnt_address']!=''){
			$to.="\n".stripslashes($data['agnt_address']);
		}
		if($data['agnt_contactno']!=''){
			$to.="\nContact No. : ".stripslashes($data['agnt_contactno']);
		}
		if($data['agnt_email']!=''){
			$to.="\nEmail : ".stripslashes($data['agnt_email']);
		}
		
		$from="Ziyarat e Haramain Travel Pvt. Ltd.\nGF 5, Building 27 B, Khizrabad\nNew Friends Colony".
		"\nNew Delhi - 110025\nContact No. : 91 11 26834777\nEmail : bir@ziyarateharamaintravel.com";
		
		$pdf->top("INVOICE",$from,$to,$invoice_no);
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		
		$db->query($sql);
		$data=$db->fetchAssoc();
		$candidate_detail=array();
		$c_index=0;

		$sql="select sci.delivery_date,sci.candidate_name,sci.pp_no,sci.pp_status,vt.visa_type,s.entry_type,sci.service_rate ".
		" from "._DB_PREFIX."service_candidateinfo  as sci left join "._DB_PREFIX."service as s on sci.service_id=s.service_id  ".
		" left join "._DB_PREFIX."visa_type as vt on s.vt_id=vt.vt_id".
		" where sci.cand_id in($candidates_id)";
		
		$db1->query($sql);
		if($db1->numRows() > 0 ){
			$exp_index=0;
			$exp='';
			while($data1=$db1->fetchAssoc()){
				$candidate_detail[$c_index]=array("delivery_date" => $data1['delivery_date'],"candidate_name" => stripslashes($data1['candidate_name']),"pp_no" => stripslashes($data1['pp_no']),"visa_type" => stripslashes($data1['visa_type']),"entry_type" => stripslashes($data1['entry_type']),"service_rate" => stripslashes($data1['service_rate']));
				$c_index++;
			}
			$pdf->setParticulars($candidate_detail);
			$pdf->Ln();
		}
		//$pdf->Ln();
		//$pdf->Footer();

		//$pdf->table_create();
		$pdf->Output($filename, 'F');
//		$to=$custemail;

}
//get document invoice
function createDocumentInvoice($candidates_id,$invoice_no,$agent_id){
	$db=new Database();	
	$db->open();
	$db1=new Database();	
	$db1->open();
	$db2=new Database();	
	$db2->open();
		
		require('document-invoice.class.php');
		$pdf=new PDF();
		$pdf->AddPage();
		$pdf->SetAutoPageBreak(true,20);
		$filename = _INVOICE_PDF_."/".$invoice_no.".pdf";
		$agnt_name='';
		$agnt_contactno='';
		$agnt_email='';
		$agnt_address='';
		
		$sql="select agnt_name,agnt_contactno,agnt_email,agnt_address from "._DB_PREFIX."agent where agent_id='$agent_id'";
		$db->query($sql);
		$data=$db->fetchAssoc();
		$to=stripslashes($data['agnt_name']);
		if($data['agnt_address']!=''){
			$to.="\n".stripslashes($data['agnt_address']);
		}
		if($data['agnt_contactno']!=''){
			$to.="\nContact No. : ".stripslashes($data['agnt_contactno']);
		}
		if($data['agnt_email']!=''){
			$to.="\nEmail : ".stripslashes($data['agnt_email']);
		}
		
		$from="Ziyarat e Haramain Travel Pvt. Ltd.\nGF 5, Building 27 B, Khizrabad\nNew Friends Colony".
		"\nNew Delhi - 110025\nContact No. : 91 11 26834777\nEmail : bir@ziyarateharamaintravel.com";
		
		$pdf->top("INVOICE",$from,$to,$invoice_no);
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		
		$db->query($sql);
		$data=$db->fetchAssoc();
		$candidate_detail=array();
		$c_index=0;

		$sql="select di.doc_reference_no,di.doc_holder_name,dt.doc_type_name,dw.work_name,dd.work_status,dd.work_rate ".
		" from mp_documentinfo_detail as dd left join mp_documentinfo as di on dd.doc_reference_no=di.doc_reference_no ".
		" left join mp_document_type as dt on dd.doc_type_id=dt.doc_type_id ".
		" left join mp_document_work as dw on dd.work_id=dw.work_id  where dd.ddid in($candidates_id)";
		
		$db1->query($sql);
		if($db1->numRows() > 0 ){
			$exp_index=0;
			$exp='';
			while($data1=$db1->fetchAssoc()){
				$candidate_detail[$c_index]=array("doc_reference_no" => $data1['doc_reference_no'],"doc_holder_name" => stripslashes($data1['doc_holder_name']),"doc_type_name" => stripslashes($data1['doc_type_name']),"work_name" => stripslashes($data1['work_name']),"work_status" => stripslashes($data1['work_status']),"work_rate" => stripslashes($data1['work_rate']));
				$c_index++;
			}
			$pdf->setParticulars($candidate_detail);
			$pdf->Ln();
		}
		//$pdf->Ln();
		//$pdf->setDisclaimer();

		//$pdf->table_create();
		$pdf->Output($filename, 'F');
//		$to=$custemail;

}
function getUpdateAutoIncrementCode($TABLE_NAME,$COLUMN_NAME,$PREFIX,$LENGHT,$COND){
	$db=new Database();	
	$db->open();
	$NEWVALUE=getAutoIncrementId($TABLE_NAME,$COLUMN_NAME,$PREFIX,$LENGHT,$COND);
	$db->query("update $TABLE_NAME set $COLUMN_NAME='$NEWVALUE'");
	return $NEWVALUE;
}	
function getAutoIncrementId($TABLE_NAME,$COLUMN_NAME,$PREFIX,$LENGHT,$COND){
	$db=new Database();	
	$db->open();

	$NEWVALUE="";	
	$sql_auto="select max(mid($COLUMN_NAME,".(strlen($PREFIX)+1).")) as maxid from $TABLE_NAME WHERE 1 $COND";
	$db->query($sql_auto);
	$data_auto=$db->fetchAssoc();
	$maxval=$data_auto["maxid"];
	$maxval=$maxval+1;
	$NEWVALUE="".$PREFIX;
	for($i=1;$i<=$LENGHT-(strlen($maxval));$i++)
		$NEWVALUE.="0";
	$NEWVALUE.=$maxval;	
	return $NEWVALUE;
}	
function getReferenceNo($TABLE_NAME,$COLUMN_NAME,$PREFIX){
	//get reference no
	$db=new Database();	
	$db->open();
	$db1=new Database();	
	$db1->open();
	$reference_no='';
	$db->query("select $COLUMN_NAME from $TABLE_NAME");
	if($db->numRows() > 0){
		$d_ref=$db->fetchAssoc();
		$db_reference_no=trim($d_ref[$COLUMN_NAME]);

		if($db_reference_no==''){
			$reference_no=$PREFIX.'1';
			$db1->query("update  $TABLE_NAME set $COLUMN_NAME='$reference_no'");
		}
		else{
			$db_prefix=substr($db_reference_no,0,strlen($PREFIX));
			if($PREFIX==$db_prefix){
				$reference_no=getUpdateAutoIncrementCode($TABLE_NAME,$COLUMN_NAME,$PREFIX,0,'');
			}
			else{
				$reference_no=$PREFIX.'1';
				$db1->query("update  $TABLE_NAME set $COLUMN_NAME='$reference_no'");
			}	
		}
	}
	else{
		$reference_no=$PREFIX.'1';
		$db1->query("insert into  $TABLE_NAME($COLUMN_NAME) values('$reference_no')");
	}
	return $reference_no;
		
}
function findAbs($url)
{
	$Start_Leve=3; //offline
	//$Start_Leve=1;//online
	$fd = parse_url($url);
	$path_parts = pathinfo($fd['path']);
	$dirs = explode("/", $path_parts['dirname']);
	//$extension=$path_parts['extension'];
	array_shift($dirs);
	
	$abspath='';
	if(count($dirs)==1 && $dirs[0]==''){
		$abspath.='';
	}
	else{
		for($i=$Start_Leve;$i<count($dirs);$i++){
			$abspath.='../';
		}
	}	
	return $abspath;
}
function curPageName() {
 return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
}
function send_mail($from,$fromname,$to,$subject,$message){
	$headers = "From: $fromname.< $from >";
	$headers .= PHP_EOL;
	$headers .= "Reply-To: " . $to."\n";
	$headers.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	if(@mail($to, $subject, $message, $headers)){
		return true;
	}	
	else{
		return false;
	}
}    
function getStartEndDate($start_date,$duration){
	$totaltime = strtotime(date("d-m-Y", strtotime($start_date)) . "+".$duration." days");
	$end_date = date('d-m-Y', $totaltime);	
	return(array("start_date" =>$start_date,"end_date" =>$end_date));
}
function getMetaData($table,$cond){
	$db=new Database();	
	$db->open();

	$metadata_title='<title>Product :: adorRn</title>';
	$metadata_keywords='<meta name="keywords" content="" />';
	$metadata_description='<meta name="description" content="" />';
	
	$sql="select page_title,page_keywords,page_description from $table where $cond";
	$db->query($sql);
	$numrows=$db->numRows();
	if($numrows>0){
		$data=$db->fetchAssoc();
		$page_title=stripslashes(trim($data['page_title']));
		$page_keywords=stripslashes(trim($data['page_keywords']));
		$page_description=stripslashes(trim($data['page_description']));
		if($page_title!=''){$metadata='<title>'.$page_title.'</title>';}
		if($page_keywords!=''){$metadata_keywords='<meta name="keywords" content="'.$page_keywords.'" />';}
		if($page_description!=''){$metadata_description='<meta name="description" content="'.$page_description.'" />';}
	}	
	
	return $metadata_title.''.$metadata_keywords.''.$metadata_description;	
}

function getPaginationFront($rowCount,$rowsperpage,$page,$fnName,$abpath,$disppage)
{
	$pagenum=$page;// what page number
	$pagingstr="";
	$maxpage=0;
	$y=0;
	if($rowCount != 0){
		$maxpage= ceil($rowCount/$rowsperpage);// count maximum page 
	}
	if($pagenum>1){ 
		$page=$pagenum-1;// decrese page no. the page no
		//$first='<div class="port-links"><a href="'.$fnName.'&page='.$page.'">&lt;&lt; &nbsp;</a></div>';// for the back page
		$first='<li><a href="javascript:void(0);" onclick="'.$fnName.'(\''.$page.'\')"><i class="fa fa-angle-left"></i></a></li>';
		
		 
	}	 
	else{
		//$first='<div class="port-links"><a href="#">&lt;&lt; &nbsp;</a></div>';
		$first='';
		// we're on page one, don't enable 'previous' link	
	}
	
	if($pagenum<$maxpage){ // if page no is less then maximum page after the prevoius condition
		$page=$pagenum+1;  // add one in page
		//$next ='<div class="port-links"><a href="'.$fnName.'&page='.$page.'">&nbsp; &gt;&gt;</a></div>'; //it should be linked
		$next ='<li><a href="javascript:void(0);" onclick="'.$fnName.'(\''.$page.'\')"><i class="fa fa-angle-right"></i></a></li>'; //it should be linked
	}
	else{
		//$next ='<div class="port-links"><a href="#" > &nbsp;&gt;&gt;</a></div>'; //not linked
		$next ='';
	}
	
	$pagingstr="";
	$startPos=1;
	$endPos=$disppage;//limit of page to be display in paging
	$v3=$endPos; // how much page no u display

	if($maxpage<$endPos)
		$endPos=$maxpage;

	if($page==$maxpage-1 && $page>$v3)
	{// condition for the checking the page no == max page -1 and  page no greater then  show 										
										//page - 3 
		$startPos=$maxpage-$v3;
		$endPos=$maxpage;
	}
	else if($page==$maxpage  && $page>$v3)
	{
		$startPos=$maxpage-$v3;
		$endPos=$page;
	}
	else if($page>$v3)
	{
		$startPos=$page-$v3;
		$endPos=$page+2;
	}

	for($i=$startPos;$i<=$endPos;$i++)
	{
		if($i==$pagenum)
		{
			//$pagingstr .='<div class="port-links" id="port-links-active">'.$i.'</div>';
			$pagingstr .='<li class="active"><a href="javascript:void(0);">'.$i.'</a></li>';
		} 
		else 
		{
			//$pagingstr .='<div class="port-links"><a href="'.$fnName.'&page='.$i.'">'.$i.'</a></div>';
			$pagingstr .='<li><a href="javascript:void(0);" onclick="'.$fnName.'(\''.$page.'\')">'.$i.'</a></li>';
			
		}
	}

	$pagingstr=$first.$pagingstr.$next;
	return $pagingstr;
}
function getScrollCart($CFSESSION,$ABS_PATH){
	$scollcart='';
	$total_amount=0;
	if(isset($CFSESSION["sess_cart"]) && count($CFSESSION["sess_cart"]) > 0){ 
		$total_amount=0;$shipping_amount=0;$total_weight=0;$total_tax=0;$subcat_array=array();
		$array_index=0;
		$subtotaldisp='visible';
		foreach($CFSESSION["sess_cart"] as $cartKey => $cartVal){
			$product_name=stripslashes(isset($cartVal['product_name'])?$cartVal['product_name']:'');
			$product_id=isset($cartVal['product_id'])?$cartVal['product_id']:'';
			$ass_id=isset($cartVal['ass_id'])?$cartVal['ass_id']:'';
			$imagepath=isset($cartVal['imagepath'])?$cartVal['imagepath']:'';
			$quantity=isset($cartVal['quantity'])?$cartVal['quantity']:'';
			$color_id=isset($cartVal['color_id'])?$cartVal['color_id']:'';
			$color_code=isset($cartVal['color_code'])?$cartVal['color_code']:'';
			$color_name=isset($cartVal['color_name'])?$cartVal['color_name']:'';
			
			$price=$cartVal['price'];
			
			$scollcart.='<li>
						<img src="'.$imagepath.'" alt="">
						<button type="button" class="close" onClick="return cartSetup(\''.$ABS_PATH.'cartsetup.php?qry=removeitem&pid='.$product_id.'&ass_id='.$ass_id.'\',\'removeitem\',\''.$ABS_PATH.'\',this);">&times;</button>
						<div class="overflow-h">
							<span>'.$product_name.'('.$color_name.')</span>
							<small>'.$quantity.' x $'.$price.'</small>
						</div>    
					</li>';
			$total_amount=($total_amount + ($price * $quantity));
		}
		$scollcart='<a href="cart.php"><i class="icon-custom icon-sm rounded-x icon-color-grey icon-line icon-line icon-basket"></i></a>
					<span class="badge badge-sea rounded-x" id="scrollbarcartitemno">'.count($CFSESSION["sess_cart"]).'</span>
					<ul class="list-unstyled badge-open contentHolder animated fadeInDown ps-container">'.$scollcart;
					$scollcart.='<li class="subtotal" id="scrollbarsubtotalli">
									<div class="overflow-h margin-bottom-10">
										<span>Subtotal</span>
										<span class="pull-right subtotal-cost" id="scrollbarsubtotalamount">$'.$total_amount.'</span>
									</div>
									<div class="row">    
										<div class="col-xs-6"><a href="cart.php" class="btn-u btn-brd btn-brd-hover btn-u-sea-shop btn-block">View Cart</a></div>
										<div class="col-xs-6"><a href="cart.php?op=checkout" class="btn-u btn-u-sea-shop btn-block">Checkout</a></div>
									</div>        
								</li>
					</ul>';    
	}
	else{
		$scollcart='<a href="#"><i class="icon-custom icon-sm rounded-x icon-color-grey icon-line icon-line icon-basket"></i></a>';
        $scollcart.='<span class="badge badge-sea rounded-x">0</span>';
	}
	return $scollcart;
}

function getMainCart($CFSESSION,$ABS_PATH){
	
	$shipping_amount=_SHIPPING_AMOUNT_;
	$responsetext_subtotal='';
	$responsetext_cart='';
	$returnarray=array("cart" =>"1","subtotal" =>"2");
	$coupon_discount_amount=0;
	
	if(isset($CFSESSION["sess_cart"])){ 
		if(count($CFSESSION["sess_cart"]) > 0){
			$total_amount=0;
			$total_weight=0;
			$array_index=0;
			$responsetext_cart.='<table class="table table-striped">
						<thead>
							<tr>
								<th>Product</th>
								<th>Price</th>
								<th>Qty</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>';
			foreach($CFSESSION["sess_cart"] as $cartKey => $cartVal){
				$product_name=stripslashes(isset($cartVal['product_name'])?$cartVal['product_name']:'');
				$product_id=isset($cartVal['product_id'])?$cartVal['product_id']:'';
				$ass_id=isset($cartVal['ass_id'])?$cartVal['ass_id']:'';
				$stock=isset($cartVal['stock'])?$cartVal['stock']:'0';
				$imagepath=isset($cartVal['imagepath'])?$cartVal['imagepath']:'';
				$quantity=isset($cartVal['quantity'])?$cartVal['quantity']:'';
				$color_name=isset($cartVal['color_name'])?$cartVal['color_name']:'';
				$delivery_time=isset($cartVal['delivery_time'])?$cartVal['delivery_time']:'';
				$price=$cartVal['price'];
				$actual_price=$cartVal['actual_price'];
				$total_weight=($total_weight + ($quantity * $cartVal['weight']));
				$discount=$cartVal['discount'];

				$total_amount=($total_amount + ($price * $quantity));
				$price=number_format($price,2, '.', '');
				$actual_price=number_format($actual_price,2, '.', '');
				$description='';
				$count_att=0;
				
				$responsetext_cart.='<tr>
					<td class="product-in-table">
						<img class="img-responsive" src="'.$imagepath.'" alt="">
						<div class="product-it-in">
							<h3>'.$product_name.'</h3>
							<span>'.$color_name.'</span>
						</div>    
					</td>
					<td>$ '.number_format($price,2, '.', '').'</td>
					<td>
						<button type="button" class="quantity-button bor_radius_left" name="subtract" onclick="javascript: subtractQtyCart(\'qty'.$ass_id.'\',\''.$product_id.'\',\''.$ass_id.'\',\''.$ABS_PATH.'\');" value="-">-</button>
						<input type="text" class="quantity-field" name="qty'.$ass_id.'" value="'.$quantity.'" id="qty'.$ass_id.'"/>
						<input type="hidden" name="stock'.$ass_id.'" value="'.$stock.'" id="stock'.$ass_id.'"/>
						<button type="button" class="quantity-button bor_radius_right" name="add" onclick="javascript: addQtyCart(\'qty'.$ass_id.'\',\''.$product_id.'\',\''.$ass_id.'\',\''.$ABS_PATH.'\');" value="+">+</button>
					</td>
					<td class="shop-red">$ '.number_format(($quantity * $price),2, '.', '').'</td>
					<td>
						<button type="button" class="close" onClick="return cartSetup(\''.$ABS_PATH.'cartsetup.php?qry=removeitemmain&pid='.$product_id.'&ass_id='.$ass_id.'\',\'removeitemmain\',\''.$ABS_PATH.'\',this);"><span>&times;</span><span class="sr-only">Close</span></button>
					</td>
				</tr>';	
			}
			$responsetext_cart.='</table>';
			if(isset($CFSESSION["sess_coupon_discount"]) && intval($CFSESSION["sess_coupon_discount"]) > 0){
				$coupon_discount_amount=0;
				$coupon_discount_amount=($total_amount -(($total_amount * $CFSESSION["sess_coupon_discount"])/100));
			}
			$gst_hst=0.00;
			if(intval(_HST_) > 0){
				$gst_hst=(($total_amount * _HST_)/100);
			}
			$grand_total= ( $total_amount + $shipping_amount + $gst_hst);
			
			$responsetext_subtotal='<ul class="list-inline total-result">
					<li>
						<h4>Subtotal:</h4>
						<div class="total-result-in">
							<span>$ '.number_format($total_amount,2, '.', '').'</span>
						</div>    
					</li> 
					<li>
						<h4>Discount:</h4>
						<div class="total-result-in">
							<span id="discountspan">$ '.number_format($coupon_discount_amount,2, '.', '').'</span>
						</div>    
					</li>    
					<li>
						<h4>Estimated GST/HST:</h4>
						<div class="total-result-in">
							<span>$ '.number_format($gst_hst,2, '.', '').'</span>
						</div>    
					</li>    
					<li>
						<h4>Shipping:</h4>
						<div class="total-result-in">
							<span class="text-right">$ '.number_format($shipping_amount,2, '.', '').'</span>
						</div>
					</li>
					<li class="divider"></li>
					<li class="total-price">
						<h4>Total:</h4>
						<div class="total-result-in">
							<span>$ '.number_format($grand_total,2, '.', '').'</span>
						</div>
					</li>
				</ul>';
		
		}

		else{$responsetext_cart.='<strong>Cart is empty</strong>';}

	}					  

	else{$responsetext_cart.='<strong>Cart is empty</strong>';}			  

	$returnarray["cart"]=$responsetext_cart;
	$returnarray["subtotal"]=$responsetext_subtotal;
	return $returnarray;
}
function getCouponDiscount($CFSESSION,$ABS_PATH,$coupon_discount){
	$total_amount=0;
	$responsetext_subtotal='';
	$coupon_discount_amount=0;
	$shipping_amount=_SHIPPING_AMOUNT_;
	foreach($CFSESSION["sess_cart"] as $cartKey => $cartVal){
		$quantity=isset($cartVal['quantity'])?$cartVal['quantity']:'';
		$price=$cartVal['price'];
		$total_amount=($total_amount + ($price * $quantity));
	}
	if($coupon_discount > 0){
		$coupon_discount_amount=($total_amount -(($total_amount * $coupon_discount)/100));
	}
	$grand_total= ( $total_amount - $coupon_discount_amount);
	$gst_hst=0.00;
	if(intval(_HST_) > 0){
		$gst_hst=(($total_amount * _HST_)/100);
	}		
	$grand_total= ( $grand_total + $shipping_amount + $gst_hst);
		
	//$grand_total= ( $total_amount + $shipping_amount - $coupon_discount_amount);
	$responsetext_subtotal='<ul class="list-inline total-result">
			<li>
				<h4>Subtotal:</h4>
				<div class="total-result-in">
					<span>$ '.number_format($total_amount,2, '.', '').'</span>
				</div>    
			</li>    
			<li>
				<h4>Discount:</h4>
				<div class="total-result-in">
					<span id="discountspan">$ '.number_format($coupon_discount_amount,2, '.', '').'</span>
				</div>    
			</li>    
			<li>
				<h4>Estimated GST/HST:</h4>
				<div class="total-result-in">
					<span>$ '.number_format($gst_hst,2, '.', '').'</span>
				</div>    
			</li>    
			<li>
				<h4>Shipping:</h4>
				<div class="total-result-in">
					<span class="text-right">$ '.number_format($shipping_amount,2, '.', '').'</span>
				</div>
			</li>
			<li class="divider"></li>
			<li class="total-price">
				<h4>Total:</h4>
				<div class="total-result-in">
					<span>$ '.number_format($grand_total,2, '.', '').'</span>
				</div>
			</li>
		</ul>';
	
	return $responsetext_subtotal;	
}

function getAmountToPay($CFSESSION){
	$amount_array=array("total_amount" =>"0.00","discount_amount" =>"0.00","hst_amount" =>"0.00","shipping_amount" =>"0.00","grand_amount" =>"0.00");
	$total_amount=0.00;
	$grand_amount=0.00;
	$coupon_discount=isset($CFSESSION["sess_coupon_discount"])?$CFSESSION["sess_coupon_discount"]:0;
	$coupon_discount_amount=0;
	$shipping_amount=_SHIPPING_AMOUNT_;

	foreach($CFSESSION["sess_cart"] as $cartKey => $cartVal){
		$quantity=isset($cartVal['quantity'])?$cartVal['quantity']:'';
		$price=$cartVal['price'];
		$total_amount=($total_amount + ($price * $quantity));
	}
	$amount_array["total_amount"]=$total_amount;
	if($coupon_discount > 0){
		$coupon_discount_amount=($total_amount -(($total_amount * $coupon_discount)/100));
		$amount_array["discount_amount"]=$coupon_discount_amount;
	}
	$grand_total= ( $total_amount - $coupon_discount_amount);
	$gst_hst=(($grand_total * _HST_)/100);
	$amount_array["hst_amount"]=$gst_hst;
	$amount_array["shipping_amount"]=$shipping_amount;
	
	$grand_total= ( $grand_total + $shipping_amount + $gst_hst);
	$amount_array["grand_amount"]=$grand_total;
	
	return $amount_array;	
}
function PaypalPaymentAPI($payment_param){
	$return_array=array ("status"  => "fail","statusdescription" => "Gateway Not Configured","transaction_id" => "","transaction_approved" =>"");	
	$sandbox = FALSE;
	$api_version = '85.0';
	$api_endpoint = "https://api-3t.paypal.com/nvp";
	$api_username = "binny_api1.conceptf.ca";
	$api_password = "L62P4TWJV8UCSJ4K";
	$api_signature = "AFcWxV21C7fd0v3bYYYRCpSSRl31Ah3KNuB0BfKQ8vQn1az4gkCX8V-X";
	$paymentaction="Sale";
	
	$exp_date=$payment_param["expiration_month"].''.$payment_param["expiration_year"];
	
	$request_params = array
						(
						'METHOD' => 'DoDirectPayment', 
						'USER' => $api_username, 
						'PWD' => $api_password, 
						'SIGNATURE' => $api_signature, 
						'VERSION' => $api_version, 
						'PAYMENTACTION' => $paymentaction, 					
						'IPADDRESS' => $_SERVER['REMOTE_ADDR'],
						'CREDITCARDTYPE' => $payment_param["cc_type"], 
						'ACCT' => $payment_param["cc_no"], 						
						'EXPDATE' => $exp_date, 			
						'CVV2' => $payment_param["cvv"], 
						'INVNUM' => $payment_param["invoice_num"], 
						'EMAIL'	 => $payment_param["cus_email"],
						'FIRSTNAME' => $payment_param["first_name"], 
						'LASTNAME' => $payment_param["last_name"], 
						'STREET' => $payment_param["address"], 
						'CITY' => $payment_param["city"], 
						'STATE' => $payment_param["state"], 					
						'COUNTRYCODE' =>$payment_param["country"], 
						'ZIP' => $payment_param["zip_code"], 
						'AMT' => $payment_param["paid_price"], 
						'CURRENCYCODE' => 'CAD', 
						'DESC' => '' 
						);
	//print_r($api_input);					
	//print_r($request_params);					
						
	// Loop through $request_params array to generate the NVP string.
	$nvp_string = '';
	foreach($request_params as $var=>$val)
	{
		$nvp_string .= '&'.$var.'='.urlencode($val);	
	}
	//echo $nvp_string;
	// Send NVP string to PayPal and store response
	$curl = curl_init();
			curl_setopt($curl, CURLOPT_VERBOSE, 1);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($curl, CURLOPT_TIMEOUT, 30);
			curl_setopt($curl, CURLOPT_URL, $api_endpoint);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $nvp_string);
	
	$result = curl_exec($curl);
	
	curl_close($curl);
	
	$result_array = NVPToArray($result);
//print_r($result_array);
	//return $result_array;
	
	if($result_array['ACK']=='Success'){
		$return_array['status']="success";
		$return_array['statusdescription']="This transaction has been approved";
		$return_array['transaction_id']=$result_array['TRANSACTIONID'];
	}
	else{
		$return_array['statusdescription']=$result_array['L_LONGMESSAGE0'];
		$return_array['status']="fail";
	}

	
		
	

	return $return_array;
}

// Function to convert NTP string to an array related to paypal
function NVPToArray($NVPString)
{
	$proArray = array();
	while(strlen($NVPString))
	{
		// name
		$keypos= strpos($NVPString,'=');
		$keyval = substr($NVPString,0,$keypos);
		// value
		$valuepos = strpos($NVPString,'&') ? strpos($NVPString,'&'): strlen($NVPString);
		$valval = substr($NVPString,$keypos+1,$valuepos-$keypos-1);
		// decoding the respose
		$proArray[$keyval] = urldecode($valval);
		$NVPString = substr($NVPString,$valuepos+1,strlen($NVPString));
	}
	return $proArray;
}
function getPaginationCF($rowCount,$rowsperpage,$page,$fnName,$abpath,$disppage)
{
	$pagenum=$page;// what page number
	$pagingstr="";
	//int offset=(int)((pagenum-1)* rowsperpage);
	$maxpage=0;
	$y=0;
	if($rowCount != 0)
	{
		$maxpage= ceil($rowCount/$rowsperpage);// count maximum page 

		//$y = ceil($rowCount % $rowsperpage);
	}
//	if($y != 0){
//		$maxpage = $maxpage+1;
//	}

	if($pagenum>1)
	{ // if page greater page then one
		$page=$pagenum-1;// decrese page no. the page no
		//$first='<div class="port-links"><a href="'.$fnName.'&page='.$page.'">&lt;&lt; &nbsp;</a></div>';// for the back page
		$first='<li><a href="'.$fnName.'&page='.$page.'"><i class="fa fa-angle-left"></i></a></li>';
	}	 
	else
	{
			$first='<li><a href="#"><i class="fa fa-angle-left"></i></a></li>';
			// we're on page one, don't enable 'previous' link	
	}
	
	if($pagenum<$maxpage)
	{ // if page no is less then maximum page after the prevoius condition
		$page=$pagenum+1;  // add one in page
		//$next ='<div class="port-links"><a href="'.$fnName.'&page='.$page.'">&nbsp; &gt;&gt;</a></div>'; //it should be linked
		$next ='<li><a href="'.$fnName.'&page='.$page.'"><i class="fa fa-angle-right"></i></a></li>';
	}
	else
	{
		$next ='<li><a href="#"><i class="fa fa-angle-right"></i></a></li>';
	}
	
	$pagingstr="";
	$startPos=1;
	$endPos=$disppage;//limit of page to be display in paging
	$v3=$endPos; // how much page no u display

	if($maxpage<$endPos)
		$endPos=$maxpage;

	if($page==$maxpage-1 && $page>$v3)
	{// condition for the checking the page no == max page -1 and  page no greater then  show 										
										//page - 3 
		$startPos=$maxpage-$v3;
		$endPos=$maxpage;
	}
	else if($page==$maxpage  && $page>$v3)
	{
		$startPos=$maxpage-$v3;
		$endPos=$page;
	}
	else if($page>$v3)
	{
		$startPos=$page-$v3;
		$endPos=$page+2;
	}

	for($i=$startPos;$i<=$endPos;$i++)
	{
		if($i==$pagenum)
		{
			//$pagingstr .='<div class="port-links" id="port-links-active">'.$i.'</div>';
			$pagingstr .='<li class="active"><a href="#">'.$i.'</a></li>';
		} 
		else 
		{
			//$pagingstr .='<div class="port-links"><a href="'.$fnName.'&page='.$i.'">'.$i.'</a></div>';
			$pagingstr .='<li><a href="'.$fnName.'&page='.$i.'">'.$i.'</a></li>';
		}
	}

	$pagingstr=$first.$pagingstr.$next;
	return $pagingstr;
}	
?>
