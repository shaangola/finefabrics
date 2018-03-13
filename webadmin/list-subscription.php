<?php include("config.php"); 
if(!isset($_SESSION["inte_sess_view_subscriber"])){
	$_SESSION["inte_sess_privmsg"]='<div id="ack_div" class="error_message errorred">Access Out of Privilege</div>';
	header("Location: home.php");
	exit;
}
$db=new Database();	
$db->open();
$db1=new Database();	
$db1->open();

$RPP_ARRAY=array("20","30","50","100","200","500","100");
$rpp=!isset($_REQUEST["rpp"])?$RPP_ARRAY[0]:$_REQUEST["rpp"];
$filter_value=array("s.subscriber_name","s.subscriber_email","s.confirmdatetime");
$filter_caption=array("Name","Email ID","Subscribe Date");
$sorting_array=array();
$fcond=isset($_REQUEST["fcond"])?$_REQUEST["fcond"]:"";
$cond="";
$filtertd="none";
$filterqstr="";
$sortingstr="";

$extra_url_filter='';
$extra_url_sorting='';
$extra_url_others='';

$pageNum = 1;
if(isset($_GET['page']))
	$pageNum = $_GET['page'];
//************* code for shorting *************
$sortimg="";
$ord=isset($_REQUEST["ord"])?$_REQUEST["ord"]:"asc";
if($ord=="asc"){
	$extra_url_others.='&ord=desc';
	$sortimg='<img src="images/s_asc.png" border="0" alt="Ascending" title="Ascending">';
}
else if($ord=="desc"){
	$extra_url_others.='&ord=asc';
	$sortimg='<img src="images/s_desc.png" border="0" alt="Decending" title="Decending">';
}
else{
	$filterqstr.='&ord=desc';
	$sortimg='<img src="images/s_desc.png" border="0" alt="Ascending" title="Ascending">';
	$ord="asc";
}

$sortflag=isset($_REQUEST["srt"])?$_REQUEST["srt"]:"";	
$filterqstr1="";
$orderby="order by s.id desc ";
for($i=0;$i<count($filter_value);$i++){
	if(isset($_REQUEST["ftxt".$i]) && $_REQUEST["ftxt".$i]!=""){
		$cond.= " and ".$filter_value[$i]." like '%".mysql_real_escape_string($_REQUEST["ftxt".$i])."%'";
		$filtertd="visible";
		$extra_url_filter.="&ftxt".$i."=".$_REQUEST["ftxt".$i];
	}
}
for($i=0;$i<count($filter_value);$i++){
	if($sortflag!='' && $sortflag==$i){
		$extra_url_sorting='&srt='.$i.'&ord='.$ord;
		$orderby=" order by ".$filter_value[$i]." ".$ord;
			
		$sorting_array[$i]='<a href="javascript:void(0);" class="class_a_header" title="sort by '.$filter_caption[$i].'" style="cursor:pointer"  onclick="javascript:window.location.href=\''.$_SERVER['PHP_SELF'].'?rpp='.$rpp.'&page='.$pageNum.''.$extra_url_filter.'&srt='.$i.''.$extra_url_others.'\'">'.$filter_caption[$i].'&nbsp;'.$sortimg.'</a>';
	}
	else{
		$sorting_array[$i]='<a href="javascript:void(0);" class="class_a_header" title="sort by '.$filter_caption[$i].'" style="cursor:pointer"   onclick="javascript:window.location.href=\''.$_SERVER['PHP_SELF'].'?rpp='.$rpp.'&page='.$pageNum.''.$extra_url_filter.'&srt='.$i.''.$extra_url_others.'\'">'.$filter_caption[$i].'&nbsp;</a>';
		
	}
}
$findex=0;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php  echo _ADMIN_PAGE_TITLE_;?></title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="css/gridstyle.css" rel="stylesheet" type="text/css" />
<link href="css/boxover.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/boxover.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/ddaccordion.js"></script>
<script type="text/javascript" src="js/common.js"></script>
</head>

<body id="homeinnerbg">
<div id="loadingdiv" class="LockOff"><img src="images/anim_load.gif" /></div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="10%" align="left" valign="top" style="width:156px;">
	<?php include("left_menu_home.php"); ?>
	
	
	</td>
    <td width="90%" align="left" valign="top">
	<div id="rightbody">
<?php include("header.php"); ?>
	
	<div class="rightbodysec">
		<h1>Manage Subscription </h1>
		
		<div class="toperrorbox"><?php if(isset($_SESSION["inte_sess_ackmsg"])){echo $_SESSION["inte_sess_ackmsg"];unset($_SESSION["inte_sess_ackmsg"]); }?> </div>
	</div>
	
	<div class="rightbodysec">
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" name="delteform" id="delteform">
	  <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="100%" align="left" valign="top">
		  <div id="scroll_body">
		  <table width="100%" border="0" class='mGrid'>
            <tr id="filtertxttr"  >
            	<td class="ob_gC1" style="display:<?php echo $filtertd;?>"></td>
				<?php 
				foreach ($filter_value as $fkey => $fval){
					$txtval=isset($_REQUEST["ftxt".$fkey])?$_REQUEST["ftxt".$fkey]:'';
					echo '<td class="ob_gC1" style="display:'.$filtertd.'">';
					echo '<input class="freetext" type="text" name="ftxt'.$fkey.'" id="ftxt'.$fkey.'" placeholder="'.$filter_caption[$fkey].'" value="'.$txtval.'">';
					echo '</td>';
				}	
				?>	
				<td class="ob_gC1" style="display:<?php echo $filtertd;?>"></td>
            	<td class="ob_gC1" style="display:<?php echo $filtertd;?>"><div style="display:<?php echo $filtertd; ?>;float:left" id="filterfielddiv">
						<input type="image" src="images/filter.gif" border=0 title="Apply Filter"> &nbsp;&nbsp;
						<img src="images/removefilter.png" border=0 title="Remove Filter" onClick="javascript:window.location.href='<?php echo $_SERVER['PHP_SELF'].'?opt=iais'.''.$extra_url_sorting.''.$extra_url_others.'&page='.$pageNum.'&rpp='.$rpp;?>'" style="cursor:pointer;"> 
						
					</div></td>
            </tr>
            
            <tr>
              <th>SL No.</th>
              <th><?php echo $sorting_array[$findex++]; ?> </th>
              <th><?php echo $sorting_array[$findex++]; ?> </th>
			   <th><?php echo $sorting_array[$findex++]; ?> </th>
			 <th>Action</th>
            </tr>
            <?php 
			 $sql="select s.id,s.subscriber_name,s.subscriber_email,s.ispublish,s.confirmdatetime from "._DB_PREFIX."subscription as s   where 1  $cond $orderby";
		
			$db->query($sql);
			$numrows=$db->numRows();
			$rowsPerPage = $rpp;
				$pageNum = 1;
				if(isset($_GET['page']) && $_GET['page']!="")
					$pageNum = $_GET['page'];
			
				$offset = ($pageNum - 1) * $rowsPerPage;
				$pageFrom=$offset==0?"1":$offset+1;
				$sno=$pageFrom;
				
				$maxPage = ceil($numrows/$rowsPerPage);
				$self = $_SERVER['PHP_SELF'].'?opt=iais';
			
				//$rs=mysql_query($sql." LIMIT $offset, $rowsPerPage")or die("mysql_error : ".mysql_error());
				$db->query($sql." LIMIT $offset, $rowsPerPage");
				$rocordperpage=$db->numRows();
				if($rocordperpage>0){
					$classID="";
					 while($rsdata=$db->fetchAssoc()){
						if($classID=="tr_bg_1") { $classID="tr_bg_2"; }
						else {$classID="tr_bg_1"; }	
						
			?>
					<tr class="<?php echo $classID;?>"  onclick="ChangeGridCSS(this,'<?php echo $classID; ?>')" onmouseover="mouseMove(this,'<?php echo $classID; ?>')" onmouseout="mouseOut(this,'<?php echo $classID; ?>')">
					  <td class='ob_gC1'><?php echo $sno; ?>.</td>
					  <td class='ob_gC1'><?php echo stripcslashes($rsdata['subscriber_name']); ?></td>
					  <td class='ob_gC1'><?php echo stripcslashes($rsdata['subscriber_email']); ?></td>
					  <td class='ob_gC1'><?php echo stripcslashes($rsdata['confirmdatetime']); ?></td>
					 
					  <td class='ob_gC1'>
					  <?php if(isset($_SESSION["inte_sess_publish_subscriber"])){ ?>
						<span id="ststdl<?php echo $rsdata["id"]; ?>">
							<?php if($rsdata["ispublish"]=='1'){ ?>
							<img src="images/publish.jpg" border="0" style="cursor:pointer;" title="Change Status"  onClick="getAjxResp('ststdl<?php echo $rsdata["id"]; ?>','AjaxHandler.php?query=changestatus&field=ispublish&tdid=ststdl<?php echo $rsdata["id"]; ?>&status=0&tname=<?php echo _DB_PREFIX; ?>subscription&ccol=id&cval=<?php echo $rsdata["id"]; ?>')"  />
									
							<?php }	else{ ?>
							<img src="images/blocked.gif" border="0" style="cursor:pointer;"  onClick="getAjxResp('ststdl<?php echo $rsdata["id"]; ?>','AjaxHandler.php?query=changestatus&field=ispublish&tdid=ststdl<?php echo $rsdata["id"]; ?>&status=1&tname=<?php echo _DB_PREFIX; ?>subscription&ccol=id&cval=<?php echo $rsdata["id"]; ?>')"  title="Change Status" />
							<?php	}  	?>
							</span>
							<?php }
							if(isset($_SESSION["inte_sess_edit_subscriber"])){}
							if(isset($_SESSION["inte_sess_delete_subscriber"])){ 
								
									echo '<a href="manage-subscription.php?afid='.session_id().'&rpp='.$rpp.'&id='.$rsdata["id"].'&delsubscription=delsubscription&page='.$pageNum.''.$extra_url_filter.''.$extra_url_sorting.'" onClick="return cmd_delete(\''.$rsdata["subscriber_name"].'\');"><img src="images/delete_icon.png" border="0" title="Delete '.$rsdata["subscriber_name"].'"></a>';
							
							 }
							 
							?>
								
					  </td>
					</tr>
				 <?php  $sno++;}
					} else { ?>
					  <tr><td align="center" valign="middle" colspan="5">No Record Found !</td></tr>
					<?php } ?>
          </table>
		  </div>
		  </td>
        </tr>
		<tr>
			<td>
			<table width="100%" border="0"  cellspacing="1" cellpadding="3" bgcolor="#e7e5e5">
     <tr bgcolor="#ffffff">
        <td align="left" valign="middle" height="40">
		
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
					 <tr >
					<td width="15%" align="left" valign="middle">
					Row Per Page: 
			<select name="rpp" id="rpp" onChange="javascript:window.location.href='<?php echo $_SERVER['PHP_SELF']; ?>?rpp='+this.value+'<?php echo $filterqstr; ?>'">
			<?php 
				for($i=0;$i<count($RPP_ARRAY);$i++){
					if($rpp==$RPP_ARRAY[$i])
						echo '<option value="'.$RPP_ARRAY[$i].'" selected>'.$RPP_ARRAY[$i].'</option>';
					else
						echo '<option value="'.$RPP_ARRAY[$i].'">'.$RPP_ARRAY[$i].'</option>';	
				}
			?>	
			</select></td>
				
				<td width="15%" align="left" valign="middle"><?php if($numrows > 0){ echo 'Records : '.$pageFrom.' to '.($rocordperpage+$offset).' of '.$numrows;}?> </td>	
				
					<td colspan="2" width="30%" align="left" valign="middle">
					<?php if(isset($_SESSION["inte_sess_filter_subscriber"])){ ?>
					<div style="float:left;display:<?php echo ($filtertd=="none")?'visible':'none';?>;" id="filtertxtdiv">
						<a href="javascript:void(0)" onclick="showfilter()">Filter</a>
					</div>
					
					<?php } ?>
				</td>
				<td width="40%" align="left" valign="middle">
				<?php if ($maxPage > 1){ echo '<div id="paging-box">'.getPagination($numrows,$rowsPerPage,$pageNum,$self,"","4").'</div>'; } ?>
				
				
				 </td>	
				  </tr>
				 </table>
		
		</td>
    </tr>
    </table>
			</td>
		</tr>
      </table>
	  </form>
	</div>
	</div>
	
	</td>
  </tr>
</table>
<?php
$db->close();

include("footer.php"); ?>
?>
</body>
</html>
