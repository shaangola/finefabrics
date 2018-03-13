<?php include("config.php"); 
if(isset($_SESSION["inte_sess_emp_loginid"]) && $_SESSION["inte_sess_emp_loginid"]!='superadministrator'){
	$_SESSION["inte_sess_privmsg"]='<div id="ack_div" class="error_message errorred">Access Out of Privilege</div>';
	header("Location: home.php");
	exit;
}


$db=new Database();	
$db->open();
$parent_id=!isset($_REQUEST["parent_id"])?'':$_REQUEST["parent_id"];
$RPP_ARRAY=array("20","30","50","100","200","500","100");
$rpp=!isset($_REQUEST["rpp"])?$RPP_ARRAY[0]:$_REQUEST["rpp"];
$filter_value=array("mn.menu_name","mn.order_index");
$filter_caption=array("Menu Option Name","Order");
$sorting_array=array();
$fcond=isset($_REQUEST["fcond"])?$_REQUEST["fcond"]:"";
$cond="";
$filtertd="none";
$filterqstr="";
$fcondvalue=isset($_REQUEST["fcondvalue"])?$_REQUEST["fcondvalue"]:"";
if($fcond!=""){
	$filtertd="block";
	$cond=" and ".$fcond." like '%".mysql_real_escape_string($fcondvalue)."%'";
	$filterqstr="&fcond=$fcond&fcondvalue=".$fcondvalue;	
}
$pageNum = 1;
if(isset($_GET['page']))
	$pageNum = $_GET['page'];
//************* code for shorting *************
$sortimg="";
$ord=isset($_REQUEST["ord"])?$_REQUEST["ord"]:"asc";
if($ord=="asc"){
	$filterqstr.='&ord=desc';
	$sortimg='<img src="images/s_asc.png" border="0" alt="Ascending" title="Ascending">';
}
else if($ord=="desc"){
	$filterqstr.='&ord=asc';
	$sortimg='<img src="images/s_desc.png" border="0" alt="Decending" title="Decending">';
}
else{
	$filterqstr.='&ord=desc';
	$sortimg='<img src="images/s_desc.png" border="0" alt="Ascending" title="Ascending">';
	$ord="asc";
}

$sortflag=isset($_REQUEST["srt"])?$_REQUEST["srt"]:"";	
$filterqstr1="";
$orderby="order by mn.menu_id asc ";
for($i=0;$i<count($filter_value);$i++){
	
	if($sortflag!='' && $sortflag==$i){
		$filterqstr1='&srt='.$i;
		$orderby=" order by ".$filter_value[$i]." ".$ord;
			
		$sorting_array[$i]='<a href="javascript:void(0);" class="_class_a_header" title="sort by '.$filter_caption[$i].'" style="cursor:pointer"  onclick="javascript:window.location.href=\''.$_SERVER['PHP_SELF'].'?rpp='.$rpp.'&page='.$pageNum.''.$filterqstr.'&srt='.$i.'\'">'.$filter_caption[$i].'&nbsp;'.$sortimg.'</a>';
	}
	else{
		$sorting_array[$i]='<a href="javascript:void(0);" class="_class_a_header" title="sort by '.$filter_caption[$i].'" style="cursor:pointer"   onclick="javascript:window.location.href=\''.$_SERVER['PHP_SELF'].'?rpp='.$rpp.'&page='.$pageNum.''.$filterqstr.'&srt='.$i.'\'">'.$filter_caption[$i].'&nbsp;</a>';
		
	}
}
$filterqstr.=$filterqstr1;

$findex=0;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php  echo _ADMIN_PAGE_TITLE_;?></title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="css/gridstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/ddaccordion.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script src="js/ModalPopupWindow.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
 var modalWin = new CreateModalPopUpObject();
	 modalWin.SetLoadingImagePath("images/loading.gif");
	 modalWin.SetCloseButtonImagePath("images/remove.gif");
	 //Uncomment below line to make look buttons as link
	 //modalWin.SetButtonStyle("background:none;border:none;textDecoration:underline;cursor:pointer");
	
	function ShowNewPage(url,pagetitle,ht,wd){
	 var callbackFunctionArray = new Array(EnrollNow, EnrollLater);
	 modalWin.ShowURL(url,ht,wd,pagetitle,null,callbackFunctionArray);
	 }
	 
	 function EnrollNow(msg){
	modalWin.HideModalPopUp();
	modalWin.ShowMessage(msg,200,400,'User Information',null,null);
	}
	
	function EnrollLater(){
	modalWin.HideModalPopUp();
	modalWin.ShowMessage(msg,200,400,'User Information',null,null);
	}
	
	function jpopup(url,pagetitle,ht,wd){ 
		ShowNewPage(url,pagetitle,ht,wd);

	}
</script>
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
		<h1>Menu Option Manage </h1>
		
		<div class="toperrorbox"><?php if(isset($_SESSION["inte_sess_ackmsg"])){echo $_SESSION["inte_sess_ackmsg"];unset($_SESSION["inte_sess_ackmsg"]); }?> </div>
	</div>
	
	<div class="rightbodysec">
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" name="delteform" id="delteform">
	  <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="100%" align="left" valign="top">
		  <div id="scroll_body">
		  <table width="100%" border="0" class='mGrid'>
            <tr>
              <th>SL No.</th>
              <th> <?php echo $sorting_array[$findex++]; ?> </th>
              <th> <?php echo $sorting_array[$findex++]; ?> </th>
              <th> </td>
			  <th>Action</th>
            </tr>
            <?php 
			
			$sql="select mn.menu_id,mn.menu_name,mn.ispublish,mn.order_index from "._DB_PREFIX."menu as mn where mn.parent_id='$parent_id'  $cond  $orderby";
		
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
					  <td valign="top"  nowrap="nowrap"><?php echo $sno; ?>.</td>
					  <td valign="top"  nowrap="nowrap"><?php echo stripcslashes($rsdata['menu_name']); ?></td>
					  <td valign="top"  nowrap="nowrap"><?php echo stripcslashes($rsdata['order_index']); ?></td>
  					  <td valign="top"  nowrap="nowrap">
					  	<a href="javascript:void(0)"  onclick="jpopup('manage-master-privilege.php?parent_id=<?php echo $rsdata['menu_id'];?>','Manage Privilege',550,550)">Manage Privilege</a></td>

					  <td valign="top"  nowrap="nowrap">
					  <?php if(isset($_SESSION["inte_sess_publish_employee"])){ ?>
						<span id="ststdl<?php echo $rsdata["menu_id"]; ?>">
							<?php if($rsdata["ispublish"]=='1'){ ?>
							<img src="images/publish.jpg" border="0" style="cursor:pointer;" title="Change Status"  onClick="getAjxResp('ststdl<?php echo $rsdata["menu_id"]; ?>','AjaxHandler.php?query=changestatus&field=ispublish&tdid=ststdl<?php echo $rsdata["menu_id"]; ?>&status=0&tname=<?php echo _DB_PREFIX; ?>menu&ccol=menu_id&cval=<?php echo $rsdata["menu_id"]; ?>')"  />
									
							<?php }	else{ ?>
							<img src="images/blocked.gif" border="0" style="cursor:pointer;"  onClick="getAjxResp('ststdl<?php echo $rsdata["menu_id"]; ?>','AjaxHandler.php?query=changestatus&field=ispublish&tdid=ststdl<?php echo $rsdata["menu_id"]; ?>&status=1&tname=<?php echo _DB_PREFIX; ?>menu&ccol=menu_id&cval=<?php echo $rsdata["menu_id"]; ?>')"  title="Change Status" />
							<?php	}  	?>
							</span>
							<?php }
							if(isset($_SESSION["inte_sess_edit_employee"])){ ?>
							<a href="manage-submenu.php?mode=edit&id=<?php echo $rsdata["menu_id"].'&parent_id='.$parent_id.'&page='.$pageNum.''.$filterqstr.'&rpp='.$rpp;?>"><img src="images/modify.gif" border="0" style="cursor:pointer"></a>
							<?php }
							if(isset($_SESSION["inte_sess_delete_employee"])){ 
							?>
						<?php echo '<a href="manage-submenu.php?afid=&rpp='.$rpp.'&parent_id='.$parent_id.'&menu_id='.$rsdata["menu_id"].'&delmenu=delmenu&page='.$pageNum.''.$filterqstr.'" onClick="return cmd_delete(\''.$rsdata["menu_name"].'\');"><img src="images/delete_icon.png" border="0" title="Delete '.$rsdata["menu_name"].'"></a>';
									 ?>
							<?php }
							?>	
					  </td>
					</tr>
				 <?php  $sno++;}
					} else { ?>
					  <tr><td valign="middle" align="center" colspan="4">No Record Found !</td></tr>
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
				<td width="8%" align="left" valign="middle">
				<?php if(isset($_SESSION["inte_sess_create_employee"])){ ?>
	<a style="cursor:pointer" href="manage-submenu.php?mode=add<?php echo $filterqstr.'&page='.$pageNum.'&rpp='.$rpp.'&parent_id='.$parent_id; ?>" class="graybgbtn">Create New</a>
		<?php } ?>
				</td>
				<td width="15%" align="left" valign="middle"><?php echo 'Records : '.$pageFrom.' to '.($rocordperpage+$offset).' of '.$numrows;?> </td>	
				
					<td colspan="2" width="30%" align="left" valign="middle">
					<?php if(isset($_SESSION["inte_sess_filter_employee"])){ ?>
					<div style="float:left;">
						<select name="fcond" id="fcond" onChange="onChangeFilter(this.value)">
						<option value="">Filter</option>
						<?php
						for($i=0;$i<count($filter_value);$i++){
								if($fcond==$filter_value[$i])
									echo '<option value="'.$filter_value[$i].'" selected>'.$filter_caption[$i].'</option>';
								else
									echo '<option value="'.$filter_value[$i].'">'.$filter_caption[$i].'</option>';	
							}
						?>	
					</select>
					
					</div>
					<div style="display:<?php echo $filtertd; ?>;float:left" id="ffieldtd">
						<input type="text"  name="fcondvalue" id="fcondvalue" value="<?php echo stripslashes($fcondvalue); ?>">
						<input type="image" src="images/filter.gif" border=0 title="Apply Filter"> &nbsp;&nbsp;
						<input type="image" src="images/removefilter.png" border=0 title="Remove Filter" onClick="select_options(document.getElementById('fcond'),'')"> 
						
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
</body>
</html>
