<?php 
include("config.php");
$db=new Database();	
$db->open();
$db1=new Database();	
$db1->open();
$db2=new Database();	
$db2->open();


if($_REQUEST["qry"]=="showempprivilege"){
	$emp_id=$_REQUEST["emp_id"];
	$emp_name=stripslashes($_REQUEST["emp_name"]);
	$emp_code=stripslashes($_REQUEST["emp_code"]);
//	$sql="select mp.priv_id from emppriv as ep,masterpriv as mp ".
	//	" where ep.priv_id=mp.priv_id and ep.login_id='$login_id'";
	$sql="select priv_id from "._DB_PREFIX."emppriv  where emp_id='$emp_id'";
	$db->query($sql);
	$upriv[0]="";
	$index=1;
	while($d=$db->fetchArray()){$upriv[$index++]=$d["priv_id"];}
	$responsetext='<form name="frm_assingpriv" id="frm_assingpriv">
		<input type=hidden name=emp_id value="'.$emp_id.'">
		<table width="1000px" border="0" cellspacing="1" cellpadding="3" bgcolor="#e7e5e5" style="font-size:14px">
			<tr><td class="listingheader345">Privilege Assing For <font color="#005fbb">'.$emp_name.' </font></td><tr>';
	
	$sql_menu="select menu_id,menu_name from "._DB_PREFIX."menu where parent_id='0' and ispublish=1 order by order_index asc";
	if($_SESSION["inte_sess_desg_id"]!="0"){
		$sql_menu="select mm.menu_id,mm.menu_name from "._DB_PREFIX."menu as mm join "._DB_PREFIX."menu as sm on mm.menu_id=sm.parent_id ".
		" join "._DB_PREFIX."masterprivilege as mpriv on sm.menu_id=mpriv.parent_id  ".
		" join "._DB_PREFIX."emppriv as epriv on mpriv.priv_id=epriv.priv_id and epriv.emp_id='".$_SESSION["inte_sess_emp_id"]."' where mm.parent_id=0 and sm.ispublish=1 group by mm.menu_id order by  mm.order_index asc";
	}	
	//echo "<br>sq;_menu : ".$sql_menu;
	$db->query($sql_menu);
	while($data_menu=$db->fetchArray()){
		$menu_name=strtoupper(str_replace("_"," ",stripslashes($data_menu["menu_name"])));
		$menu_id=stripslashes($data_menu["menu_id"]);
		$sql_submenu="select menu_id,menu_name from "._DB_PREFIX."menu where parent_id='$menu_id' and ispublish=1 order by order_index asc";
		if($_SESSION["inte_sess_desg_id"]!="0"){
			$sql_submenu="select sm.menu_id,sm.menu_name from "._DB_PREFIX."menu as sm join "._DB_PREFIX."masterprivilege as mpriv on sm.menu_id=mpriv.parent_id ".
			" join "._DB_PREFIX."emppriv as epriv on mpriv.priv_id=epriv.priv_id and epriv.emp_id='".$_SESSION["inte_sess_emp_id"]."' where sm.parent_id='$menu_id' and sm.ispublish=1 ".
			" group by sm.menu_id order by  sm.order_index asc";
		}	
		//echo "<br>sql_submenu : ".$sql_submenu;
		$db1->query($sql_submenu);
		if($db1->numRows() > 0){
			$responsetext.='<tr><td align=left class="listingheader345"><input type="checkbox" id="p_'.$menu_id.'" name="p_'.$menu_id.'" onclick="checkAll_M(this,\'c_'.$menu_id.'\')">'.$menu_name.'</td></tr>';
			$sno=0;
			while($data_submenu=$db1->fetchArray()){
				$submenu_name=ucwords(str_replace("_"," ",stripslashes($data_submenu["menu_name"])));
				$submenu_id=	$data_submenu["menu_id"];	
				$sql_priv="select * from "._DB_PREFIX."masterprivilege where parent_id='$submenu_id' order by priv_id asc";
				if($_SESSION["inte_sess_desg_id"]!="0"){
					$sql_priv="select mpriv.* from "._DB_PREFIX."masterprivilege as mpriv join "._DB_PREFIX."emppriv as epriv ".
					" on mpriv.parent_id='$submenu_id' and mpriv.priv_id=epriv.priv_id and epriv.emp_id='".$_SESSION["inte_sess_emp_id"]."' where 1  order by  mpriv.priv_id asc";
				}	
				$db2->query($sql_priv);
				if($db2->numRows() > 0){
					$responsetext.='<tr><td align=left class="listingheader345" style="padding-left:20px;">
										<input type="checkbox" alt="c_'.$menu_id.'" id="parent_'.$submenu_id.'" name="parent_'.$submenu_id.'" onclick="checkAll(this,\'child_'.$submenu_id.'\')">'.$submenu_name.'</td></tr>
									<tr><td width="100%" style="padding-left:40px;">
									<table width="100%" border="0" cellspacing="10" cellpadding="10">
									<tr>';
					while($data_priv=$db2->fetchArray()){
						$priv_id=$data_priv["priv_id"];	
						$priv_name=ucwords(str_replace("_"," ",stripslashes($data_priv["priv_name"])));
						if($sno%4==0 && $sno!=0){ $responsetext.='</tr><tr>'; }
						$foundchk=array_search($priv_id,$upriv)==""?"":"checked";
						$responsetext.='
						<td width="200px;">
							<lable>
								<input type="checkbox" alt="c_'.$menu_id.'" class="child_'.$submenu_id.'" name="'.$priv_id.'" id="'.$priv_id.'" '.$foundchk.'>&nbsp;&nbsp;'.$priv_name.'
							</label>
						</td>';
						$sno++;
					}
				$responsetext.='</tr></table></td></tr>';
				}				

			}
		}
	}		
	$responsetext.='<tr><td align=center><input type="button" value=" Assign Now" onclick="assignEmpPriv(\'frm_assingpriv\')"><span id="presesstd"></span></td>
	</table>
	</form>';	
	echo $responsetext;	
}
else if($_REQUEST["qry"]=="assignemppriv"){
	$responsetext='0#@#';
	$emp_id=$_REQUEST["emp_id"];
	//print_r($_REQUEST);
	$db->query("delete from "._DB_PREFIX."emppriv where emp_id='$emp_id'");
	$rowAffected=0;
	$sql_master="select priv_id from "._DB_PREFIX."masterprivilege where parent_id!='0'";
	$db->query($sql_master);
	while($data_master=$db->fetchArray()){
		if(isset($_REQUEST[$data_master["priv_id"]])){
			//echo "insert into "._DB_PREFIX."emppriv(emp_id,priv_id) values('$emp_id','".$data_master["priv_id"]."')";
			$rowAffected+=$db1->query("insert into "._DB_PREFIX."emppriv(emp_id,priv_id) values('$emp_id','".$data_master["priv_id"]."')");
		}	
	}
	$responsetext='1#@#'.$rowAffected.' Privilege Assign Successfully';
	
	echo $responsetext;
}
$db->close();
$db1->close();
?>