<?php
$db_menu=new Database();	
$db_menu->open();

$db_submenu=new Database();	
$db_submenu->open();
?>
<div id="mainleft">
	<div class="inner2">
		<a href="javascript: void(0);">
			<div class="maintablef silverheader">
				<div class="content1"><img src="images/house.png"  width="16" height="16"/></div>
				<div class="content1">Dashboard</div>
			</div>
		</a>
		<div class="navi submenu">
			<a href="index.php"><img src="images/home.png"  width="16" height="16"/>&nbsp;Home</a>
			<?php if(isset($_SESSION["inte_sess_emp_loginid"]) && $_SESSION["inte_sess_emp_loginid"]=="superadministrator"){ ?><a href="list-menu.php"><img src="images/menu/menus.png" width="16" height="16" />&nbsp;Menu Manager</a> <?php } ?>
		</div>
	</div>
	
	
	
	<?php 
	$sql_menu="select menu_id,menu_name,icon from "._DB_PREFIX."menu where parent_id='0' and ispublish=1 order by order_index asc";
	$db_menu->query($sql_menu);
	while($data_menu=$db_menu->fetchArray()){
		$menu_name=strtoupper(str_replace("_"," ",stripslashes($data_menu["menu_name"])));
		$menu_id=stripslashes($data_menu["menu_id"]);
		$menu_icon=stripslashes($data_menu["icon"]);
		
		$sql_submenu="select menu_id,menu_name,icon,page_name from "._DB_PREFIX."menu where parent_id='$menu_id' and ispublish=1 order by order_index asc";
		if(isset($_SESSION["inte_sess_emp_loginid"]) && $_SESSION["inte_sess_emp_loginid"]!="superadministrator"){
			$sql_submenu="select sm.* from "._DB_PREFIX."menu as sm join "._DB_PREFIX."masterprivilege as mp join "._DB_PREFIX."emppriv as ep ".
			" where sm.parent_id='$menu_id' and sm.ispublish=1 and sm.menu_id=mp.parent_id and mp.priv_id=ep.priv_id and ep.emp_id='".$_SESSION["inte_sess_emp_id"]."' group by sm.menu_id";
		}	
//		echo $sql_submenu;
		$db_submenu->query($sql_submenu);
		if($db_submenu->numRows() > 0){
	?>
		<div class="inner2">
			<a href="javascript: void(0);">
				<div class="maintablefdactive silverheader">
					<div class="content1"><img src="images/<?php echo $menu_icon;?>" width="16" height="16" /></div>
					<div class="content1"><?php echo $menu_name;?></div>
				</div>
			</a>
			<div class="navi submenu"> 
			<?php
				while($data_submenu=$db_submenu->fetchArray()){
					$submenu_name=ucwords(str_replace("_"," ",stripslashes($data_submenu["menu_name"])));
					$submenu_id=	$data_submenu["menu_id"];	
					$submenu_icon=stripslashes($data_submenu["icon"]);
					$page_name=	$data_submenu["page_name"];	
				?>
					<a href="<?php echo $page_name;?>"><img src="images/<?php echo $submenu_icon;?>" width="16" height="16" />&nbsp;<?php echo $submenu_name;?></a> 
				<?php
				}
				?>
			</div>
		</div>	
		<?php
		}
		
	}	?>		

</div>

	
	