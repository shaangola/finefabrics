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


if(isset($_REQUEST['save-attribute']))
{
	$attribute_name 		= $_REQUEST['attribute_name'];
	$parent_id 				= $_REQUEST['parent_id'];

	$sql 	= "INSERT INTO attribute(name,parent_id) values('".$attribute_name."', $parent_id)";
	$res 	= $db->query($sql);
	
	if($res > 0){
		$_SESSION["inte_sess_ackmsg"]='<div id="ack_div" class="error_message green_msg"> Attribute Added Successfully </div>';
	}
	else{
		$_SESSION["inte_sess_ackmsg"]='<div id="ack_div" class="error_message red_error"> Attribute Addition Failed! </div>';
	}
	echo "<script>window.location.href='attribute.php';</script>";
	exit;
}


if(isset($_REQUEST['save-product']))
{
	$product_name 		= $_REQUEST['product_name'];
	$product_desc 		= $_REQUEST['product_desc'];
	$attribute_id 		= $_REQUEST['attribute_id'];
	$product_price 		= $_REQUEST['product_price'];
	$product_image 		= $_FILES['product_image']['name'];
	$product_link 		= $_REQUEST['link'];

	if( isset($_FILES['product_image']['error']) == 0 && isset($_FILES['product_image']['tmp_name']) ){
		move_uploaded_file($_FILES['product_image']['tmp_name'], 'upload/'.$product_image);
	}


	$sql 	= "INSERT INTO product(name, description, attribute_id, price, image, p_link) values ('".$product_name."', '".$product_desc."', $attribute_id, '".$product_price."', '".$product_image."', $product_link)";
	$res 	= $db->query($sql);
	
	if($res > 0){
		$_SESSION["inte_sess_ackmsg"]='<div id="ack_div" class="error_message green_msg"> Product Added Successfully </div>';
	}
	else{
		$_SESSION["inte_sess_ackmsg"]='<div id="ack_div" class="error_message red_error"> Product Addition Failed! </div>';
	}
	echo "<script>window.location.href='all-products.php';</script>";
	exit;
}
?>