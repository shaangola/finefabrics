<?php session_start();
require_once("../inc/config.inc.php");
require_once("../inc/database.inc.php");
require_once("../inc/functions.inc.php");

$db=new Database();	
$db->open();

$db1=new Database();	
$db1->open();

$db2=new Database();	
$db2->open();

if(isset($_REQUEST["qry"]) && $_REQUEST["qry"]=="delsubbrand"){
	$responsetext="0#@#Deletion Failed";	
	$sb_id=isset($_REQUEST["sb_id"])?$_REQUEST["sb_id"]:'';
	
	$db->query("select sub_img_file from "._DB_PREFIX."sub_brand where sb_id='$sb_id'");
	$data=$db->fetchAssoc();
	$sub_img_file=$data["sub_img_file"];
	@unlink("../"._SUB_BRAND_IMG_."/".$sub_img_file);

	
	$sql="delete from "._DB_PREFIX."sub_brand where sb_id='$sb_id'";
	$rowafftected=$db->query($sql);
	if($rowafftected > 0){
		$responsetext="1#@#Sub Brand Deleted";	
	}
	else{
		$responsetext="0#@#Sub Brand Deletion Failed";	
	}	
	
	echo $responsetext;	 
	
}
else if(isset($_REQUEST["qry"]) && $_REQUEST["qry"]=="getsubcate"){
	 $responsetext="<option value=''>--Select Sub Category --</option>";
	
	$att_cat_id=mysql_real_escape_string(trim($_REQUEST["att_cat_id"]));
	$att_subcat_id=mysql_real_escape_string(trim($_REQUEST["att_subcat_id"]));
	$sql_comp="select subcat_id,subcat_name from "._DB_PREFIX."subcategory where ispublish=1 and cat_id='$att_cat_id' order by subcat_name";
	$db->query($sql_comp);
	while($data_comp=$db->fetchAssoc()){
		if($att_subcat_id==$data_comp["subcat_id"]){$responsetext.='<option value="'.$data_comp["subcat_id"].'" selected >'.stripslashes($data_comp["subcat_name"]).'</option>'; }
		else { $responsetext.='<option value="'.$data_comp["subcat_id"].'">'.stripslashes($data_comp["subcat_name"]).'</option>';}
	}
	echo $responsetext;
	
}
else if(isset($_REQUEST["qry"]) && $_REQUEST["qry"]=="getbrand"){
	 $responsetext="<option value=''>--Select Brand --</option>";
	
	$att_cat_id=mysql_real_escape_string(trim($_REQUEST["att_cat_id"]));
	$att_subcat_id=mysql_real_escape_string(trim($_REQUEST["att_subcat_id"]));
	$att_brand_id=mysql_real_escape_string(trim($_REQUEST["att_brand_id"]));
	//$sql_comp="select subcat_id,subcat_name from "._DB_PREFIX."subcategory where ispublish=1 and cat_id='$att_cat_id' order by subcat_name";
	$sql_comp="select bi.brand_id,bi.brand_name from "._DB_PREFIX."subcat_brand as sb join "._DB_PREFIX."brand_item as bi on sb.brand_id=bi.brand_id and bi.brand_type='brand' ".
	" where sb.subcat_id='$att_subcat_id' order by bi.brand_name";
	$db->query($sql_comp);
	while($data_comp=$db->fetchAssoc()){
		if($att_brand_id==$data_comp["brand_id"]){$responsetext.='<option value="'.$data_comp["brand_id"].'" selected >'.stripslashes($data_comp["brand_name"]).'</option>'; }
		else { $responsetext.='<option value="'.$data_comp["brand_id"].'">'.stripslashes($data_comp["brand_name"]).'</option>';}
	}
	echo $responsetext;
	
}
else if(isset($_REQUEST["qry"]) && $_REQUEST["qry"]=="getsubcate_p"){
	$cat_id=mysql_real_escape_string(trim($_REQUEST["cat_id"]));
	$subcat_id=mysql_real_escape_string(trim($_REQUEST["subcat_id"]));
	$brand_id=mysql_real_escape_string(trim($_REQUEST["brand_id"]));
	$item_id=mysql_real_escape_string(trim($_REQUEST["item_id"]));
	$item_content='';
	$subcat_content='';
	$brand_contenet='';
	$item_count=0;
	
	$item_content='<select name="item_id" id="item_id"  class="validate[required] formfld" onchange="getAjxResp(\'attributespan\',\'dyndata.php?qry=getproduct_att&cat_id='.$cat_id.'&subcat_id='.$subcat_id.'&item_id=\'+this.value)"><option value="">--Select Item --</option>';
	$sql_comp="select bi.brand_id,bi.brand_name from "._DB_PREFIX."brand_item as bi join "._DB_PREFIX."subcat_brand sb on bi.brand_id=sb.brand_id ".
	" where sb.subcat_id='0' and sb.cat_id='$cat_id' and bi.ispublish=1 and bi.brand_type='item'";
	$db->query($sql_comp);
	while($data_comp=$db->fetchAssoc()){
		$item_content.='<option value="'.$data_comp["brand_id"].'">'.stripslashes($data_comp["brand_name"]).'</option>';
		$item_count++;
	}
	$item_content.='</select>';
	
	
	
	$subcat_content='<select name="subcat_id" id="subcat_id"  class="validate[required] formfld" onchange="changeSubCategory(\'dyndata.php?qry=getbrand_p&cat_id='.$cat_id.'&brand_id='.$brand_id.'&item_id='.$item_id.'&subcat_id=\'+this.value)"  ><option value="'.(($item_count==0)?'':'0').'">--Select Sub Category --</option>';
	$sql_comp="select subcat_id,subcat_name from "._DB_PREFIX."subcategory where ispublish=1 and cat_id='$cat_id' order by subcat_name";
	$db->query($sql_comp);
	while($data_comp=$db->fetchAssoc()){
		if($subcat_id==$data_comp["subcat_id"]){$subcat_content.='<option value="'.$data_comp["subcat_id"].'" selected >'.stripslashes($data_comp["subcat_name"]).'</option>'; }
		else { $subcat_content.='<option value="'.$data_comp["subcat_id"].'">'.stripslashes($data_comp["subcat_name"]).'</option>';}
	}
	
	$brand_contenet='<select name="brand_id" id="brand_id"  class="formfld"><option value="">--Select Brand --</option>';
	$sql_comp="select bi.brand_id,bi.brand_name from "._DB_PREFIX."brand_item as bi join "._DB_PREFIX."subcat_brand sb on bi.brand_id=sb.brand_id ".
	" where sb.subcat_id='0' and sb.cat_id='$cat_id' and bi.ispublish=1 and bi.brand_type='brand'";
	$db->query($sql_comp);
	while($data_comp=$db->fetchAssoc()){
		if($brand_id==$data_comp["brand_id"]){$brand_contenet.='<option value="'.$data_comp["brand_id"].'" selected >'.stripslashes($data_comp["brand_name"]).'</option>'; }
		else { $brand_contenet.='<option value="'.$data_comp["brand_id"].'">'.stripslashes($data_comp["brand_name"]).'</option>';}
	}
	$brand_contenet.='</select>';

	echo '1#@#'.$subcat_content.'#@#'.$brand_contenet.'#@#'.$item_content;
	
}
else if(isset($_REQUEST["qry"]) && $_REQUEST["qry"]=="getsubbrand"){
	$brand_id=mysql_real_escape_string(trim($_REQUEST["brand_id"]));
	$responsetext=' <select name="sb_id" id="sb_id"  class="validate[required] formfld"><option value="">--Sub Brand--</option>';
	
	$sql_comp="select sb.sb_id,sb.sb_name from "._DB_PREFIX."sub_brand as sb where sb.brand_id='".$brand_id."' order by sb.sb_name";
	$db->query($sql_comp);
	while($data_comp=$db->fetchAssoc()){
		$responsetext.='<option value="'.$data_comp["sb_id"].'">'.stripslashes($data_comp["sb_name"]).'</option>';
	}
	
	echo $responsetext;
	
}
else if(isset($_REQUEST["qry"]) && $_REQUEST["qry"]=="getbrand_p"){
	$subcat_id=isset($_REQUEST["subcat_id"])?$_REQUEST["subcat_id"]:'';
	$cat_id=isset($_REQUEST["cat_id"])?$_REQUEST["cat_id"]:'';
	$brand_id=isset($_REQUEST["brand_id"])?$_REQUEST["brand_id"]:'';
	$item_id=isset($_REQUEST["item_id"])?$_REQUEST["item_id"]:'';
	
	$responsetext='1#@#<select name="item_id" id="item_id"  class="validate[required] formfld" onchange="getAjxResp(\'attributespan\',\'dyndata.php?qry=getproduct_att&cat_id='.$cat_id.'&subcat_id='.$subcat_id.'&item_id=\'+this.value)"><option value="">--Select Item --</option>';
	
	$sql_comp="select bi.brand_id,bi.brand_name from "._DB_PREFIX."brand_item as bi join "._DB_PREFIX."subcat_brand sb on bi.brand_id=sb.brand_id ".
	" where sb.subcat_id='$subcat_id' and bi.ispublish=1 and bi.brand_type='item'";
	$db->query($sql_comp);
	while($data_comp=$db->fetchAssoc()){
		$responsetext.='<option value="'.$data_comp["brand_id"].'">'.stripslashes($data_comp["brand_name"]).'</option>';
	}
	
	$responsetext.='</select>#@#';

	$responsetext.='<select name="brand_id" id="brand_id"  class="formfld"><option value="">--Select Brand --</option>';

	$sql_comp="select bi.brand_id,bi.brand_name from "._DB_PREFIX."brand_item as bi join "._DB_PREFIX."subcat_brand sb on bi.brand_id=sb.brand_id ".
	" where sb.subcat_id='$subcat_id' and bi.ispublish=1 and bi.brand_type='brand'";
	$db->query($sql_comp);
	while($data_comp=$db->fetchAssoc()){
		if($brand_id==$data_comp["brand_id"]){$responsetext.='<option value="'.$data_comp["brand_id"].'" selected >'.stripslashes($data_comp["brand_name"]).'</option>'; }
		else { $responsetext.='<option value="'.$data_comp["brand_id"].'">'.stripslashes($data_comp["brand_name"]).'</option>';}
	}
	
	$responsetext.='</select>';
	
	echo $responsetext;
	
}
else if(isset($_REQUEST["qry"]) && $_REQUEST["qry"]=="getproduct_att"){
	$subcat_id=isset($_REQUEST["subcat_id"])?$_REQUEST["subcat_id"]:'';
	$cat_id=isset($_REQUEST["cat_id"])?$_REQUEST["cat_id"]:'';
	$item_id=isset($_REQUEST["item_id"])?$_REQUEST["item_id"]:'';
	
	
	
	$responsetext='';
	$attribute_table='';
	$thead='<thead><tr>';
	$tbody='<tbody><tr>';
	$responsetext.='';
	$is_multiple='';
	$is_mandatory_class='validate[required] ';
	$is_mandatory='*';
	
	
	$sql_comp="select color_id,color_code,color_name from "._DB_PREFIX."master_color as mc where mc.ispublish=1";
	$db->query($sql_comp);
	$row_count=0;
	if($db->numRows() > 0){
		$attcount=0;
		$thead.='<td class="head" ><strong>Color '.$is_mandatory.' </strong></td>';
		$tbody.='<td valign="top">';
		$tbody.='<select name="color1" id="color1"  class="'.$is_mandatory_class.'formfld" '.$is_multiple.'>';
		$tbody.='<option value="">Select Color</option>';
		while($data_comp=$db->fetchAssoc()){
			$tbody.='<option value="'.$data_comp['color_id'].'#@#'.$data_comp['color_code'].'#@#'.$data_comp['color_name'].'">'.$data_comp['color_name'].'</option>';
		}
		$tbody.='</select>';
		$tbody.='</td>';
		
		$thead.='<td class="head" ><strong>Photo  </strong> </td>';
		$tbody.='<td valign="top"><input type="file" name="color_photo1" id="color_photo1" class="validate[funcCall[validateIMG]] formfld_s" style="width:150px;"  /></td>';
		$thead.='<td class="head" ><strong>Stock * </strong> </td>';
		$thead.='<td class="head" ><input type="button" class="bluebutton" id="addtr" value="+" onclick="addTR()" /> </td>';
		$tbody.='<td valign="top"><input type="text" name="color_stock1" id="color_stock1" class="validate[required,custom[number]] formfld_s" style="width:100px;"  /></td>';
		$tbody.='<td valign="top"> <img src="images/delete_icon.png" class="btnDelete" style="cursor:pointer" title="Delete"/></td>';
		$thead.='</tr></thead>';
		$tbody.='</tr></tbody>';
		$responsetext.='<table width="50%" id="att_table" align="center" border="0" cellpadding="0" cellspacing="0">'.$thead.''.$tbody.'</table>';
		$responsetext.='<input type="hidden" name="att_count" id="att_count" value="1" />';
	}
	else{
		
	}
	/*if($cat_id==3){
		$responsetext.='#@#<select name="m_id" id="m_id"  class="validate[required] formfld"><option value="">--Material / Equipment --</option>';
		$sql_vt="select mat.m_id,mat.material,smat.m_id from "._DB_PREFIX."material as mat join "._DB_PREFIX."subcat_material as smat ".
		" on mat.m_id=smat.m_id and mat.cat_id='3' where smat.subcat_id='$subcat_id' and mat.ispublish=1";
		$db1->query($sql_vt);
		while($data_vt=$db1->fetchArray()){
			$responsetext.='<option value="'.$data_vt['m_id'].'">'.stripslashes($data_vt['material']).'</option>';
			
		}
		$responsetext.='</select>';	
	}*/
	
	
	echo $responsetext;
	
}

else if(isset($_REQUEST["qry"]) && $_REQUEST["qry"]=="getsociety"){
	 $responsetext="<option value=''>--Select Society--</option>";
	
	$state_id=mysql_real_escape_string(trim($_REQUEST["state_id"]));
	$city_id=mysql_real_escape_string(trim($_REQUEST["city_id"]));
	$society_id=mysql_real_escape_string(trim($_REQUEST["society_id"]));
	$sql_comp="select society_id,society_name from "._DB_PREFIX."society where ispublish=1 and state_id='$state_id' and city_id='$city_id' order by society_name";
	$db->query($sql_comp);
	while($data_comp=$db->fetchAssoc()){
		if($society_id==$data_comp["society_id"]){
		$responsetext.='<option value="'.$data_comp["society_id"].'" selected >'.stripslashes($data_comp["society_name"]).'</option>'; }
		else { $responsetext.='<option value="'.$data_comp["society_id"].'">'.stripslashes($data_comp["society_name"]).'</option>';}
	}
	echo $responsetext;
	
}
else if(isset($_REQUEST["qry"]) && $_REQUEST["qry"]=="resetcomppassword"){
	$company_id=isset($_REQUEST["company_id"])?$_REQUEST["company_id"]:'';
	$comp_password=isset($_REQUEST["comp_password"])?sha1($_REQUEST["comp_password"]):'';
	$modifyby=$_SESSION["inte_sess_emp_id"];
	$db=new Database();	
	$db->open();

	$responseText="";
	$sql=" update "._DB_PREFIX."company set comp_password='$comp_password',modifyby='$modifyby',modifydate=now() where company_id='$company_id'";
	$rowAffected=$db->query($sql);
	if($rowAffected>0){$responseText='1#@#<div id="ack_div" class="error_message truegreen">Password Reset successfully</div>';}
	else{$responseText='0#@#<div id="ack_div" class="error_message errorred">Password Reseting Failed Try again!</div>';}	
	
	echo $responseText;
	
}
else if($_REQUEST["qry"]=="delattribute"){
	$att_id=isset($_REQUEST["att_id"])?$_REQUEST["att_id"]:'';
	$db->rs_delete(""._DB_PREFIX."attribute"," att_id='$att_id'");
	$responsetext="Attribute Deleted";	
	echo $responsetext;	 
}
else if(isset($_REQUEST["qry"]) && $_REQUEST["qry"]=="getmaterial"){
	$cat_id=mysql_real_escape_string(trim($_REQUEST["cat_id"]));
	$subcat_id=mysql_real_escape_string(trim($_REQUEST["subcat_id"]));
	$responsetext='';
	$bi_count=0;
	$sql="select mat.m_id,mat.material,smat.m_id as map_m_id from "._DB_PREFIX."material as mat left join "._DB_PREFIX."subcat_material as smat ".
	" on mat.m_id=smat.m_id and smat.subcat_id='$subcat_id' where mat.cat_id='$cat_id'  order by mat.material";
	$db->query($sql);
	if($db->numRows() > 0){
		$responsetext='<strong>TYPES OF MATERIAL / EQUIPMENT</strong><table width="100%" border="0" class="mGrid">';
		while($data=$db->fetchAssoc()){
			$checked='';
			if(($bi_count%7)==0){ $responsetext.='</tr><tr>';}
			if($data["map_m_id"]!=''){ $checked=' checked';}
			$responsetext.='<td class="ob_gC1"  nowrap="nowrap"><label>
						<input type="checkbox" name="m_id[]" id="brand'.$data["m_id"].'" value="'.$data["m_id"].'"  '.$checked.' />
						'.stripslashes($data["material"]).'
				 </label></td>';
			$bi_count++;
		}
		$responsetext.='</tr></table>';
	}	
	echo $responsetext;
	
}
else if(isset($_REQUEST["qry"]) && $_REQUEST["qry"]=="getagentaccounts"){}
$db->close();	
$db1->close();	
$db2->close();	

?>