<?php include("config.php"); 
$db = new Database();	
$db->open();


if(isset($_REQUEST['save-category']))
{
	$category_name 		= $_REQUEST['category_name'];
	$parent_category 	= $_REQUEST['parent_category'];
	$display_type 		= $_REQUEST['display_type'];
	$category_image 	= $_REQUEST['category_image'];

	$sql 	= "INSERT INTO category(name,parent_category,display_type,image) values('".$category_name."',$parent_category,$display_type,'".$category_image."')";
	$res 	= $db->query($sql);
	
	if($res > 0){
		$_SESSION["inte_sess_ackmsg"]='<div id="ack_div" class="error_message green_msg"> Category Added Successfully </div>';
	}
	else{
		$_SESSION["inte_sess_ackmsg"]='<div id="ack_div" class="error_message red_error"> Category Addition Failed! </div>';
	}
	echo "<script>window.location.href='category.php';</script>";
	exit;
}
?>