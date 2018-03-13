<?php

// SITE MODES
//------------------------------------------------------------------------------
define("_SITE_MODE",    "debug"); // debug, production 

// SITE CONSTANTS
//------------------------------------------------------------------------------
define("_COMPANY_NAME_","Fine Fabrics");
define("_COMP_ADDRESS_","");

define("_SERVER_NAME_","");
define("_ADMIN_PAGE_TITLE_","Fine Fabrics :: ADMIN");
define("_LOCAL_PAGE_TITLE_","Welcome To Fine Fabrics");
define("_PANEL_NAME",   "CRM :: Fine Fabrics");
define("_DB_PREFIX",    "max_");

define("_SITE_URL_",    "http://finefabrics.ca/");
//define("_HTTP_HOST_",    "http://localhost/development/maxpure.in/");

define("_MAX_ATTRIBUTE_",    "10");

define("_CAT_IMG_",    "catimg");
define("_CAT_W_",    "200");
define("_CAT_H_",    "211");

define("_P_S_IMG_",    "productimg/box");
define("_P_S_W_",    "220");
define("_P_S_H_",    "148");
define("_P_L_IMG_",    "productimg/large");
define("_P_L_W_",    "398");
define("_P_L_H_",    "498");

define("_COLOR_S_IMG_",    "colorimg/box");
define("_COLOR_S_W_",    "220");
define("_COLOR_S_H_",    "148");
define("_COLOR_L_IMG_",    "colorimg/large");
define("_COLOR_L_W_",    "398");
define("_COLOR_L_H_",    "498");


define("_BANNER_IMG_",    "bannerimg");
define("_B_IMG_W_",    "1120");
define("_B_IMG_H_",    "356");

define("_BRAND_IMG_",    "brandimg");
define("_BRAND_W_",    "181");
define("_BRAND_H_",    "112");

define("_SUB_BRAND_IMG_",    "subbrandimg");
define("_SUB_BRAND_W_",    "134");
define("_SUB_BRAND_H_",    "179");

define("_COLOR_IMG_",    "colorimg");
define("_COLOR_W_",    "145");
define("_COLOR_H_",    "42");

define("_ADDS_IMG_",    "addsimg");
define("_L_ADDS_W_",    "959");
define("_L_ADDS_H_",    "135");
define("_S_ADDS_W_",    "313");
define("_S_ADDS_H_",    "164");

define("_shipping_alter_amount_",    "80000");
define("_shipping_free_amount_",    "100000");
define("_HST_",0);

define("_SHIPPING_AMOUNT_",    "0");

define("_COMP_EMAIL_",  "info@finefabrics.ca");
define("_COMP_FROM_NAME_",  "Fine fabrics ");
define("_COMP_MAIL_SINGATURE_","Fine fabrics Team");

define("_CONTACTUS_EMAIL",  "conceptf@finefabrics.ca");
define("_CONTACTUS_FROM",  "CONCEPTF ");
define("_CONTACTUS_SINGATURE_","CONCEPTF  Team");

define("_NL_EMAIL",  "info@finefabrics.ca");
define("_NL_FROM",  "Fine fabrics");
define("_NL_SINGATURE_","Fine fabrics Team");



define("_CKFINDER_PATH_",'inc/ckeditor/ckfinder/');

define("_COMP_SEND_EMAIL_",  "conceptf@finefabrics.ca");
define("_COMP_SEND_FROM_NAME_",  "CONCEPTF ");
define("_COMP_SEND_MAIL_SINGATURE_","Fine Fabrics Team");
define("_ATT_TYPE_", serialize (array ("0" => "text","1" => "select","2" => "radio","3" => "checkbox","4" => "textarea")));
define("_MENU_TYPE_", serialize (array ("0" => "","1" => "Recruitment","2" => "Service","3" => "Document","4" => "Umrah")));
define("_MENU_CLASS_", serialize (array ("1" => "one","2" => "two","3" => "three","4" => "four","5" => "five","6" => "six","7" => "seven","8" => "eight","9" => "nine","10" => "ten","11" => "","12" => "","13" => "","14" => "","15" => "")));

define("_GENDER_", serialize (array ("0" => "Male","1" => "Female")));
define("_PAYMENT_TYPE_", serialize (array ("" =>"", "online" => "Online","cheque" => "Cheque / DD")));
define("_PAYMENT_STATUS_", serialize (array ("" =>"", "pending" => "Pending","completed" => "Completed","canceled" => "Canceled")));
define("_SHIP_STATUS_", serialize (array ("" =>"", "pending" => "Pending","shipped" => "Shipped","delivered" => "Delivered")));


define("_EMAIL_LIST_", serialize (array ()));
define("_SMTP_USERNAME_","postmaster@finefabrics.ca");
define("_SMTP_PASSWORD_",'UQz8dGaOBI');
define("_SMTP_HOST_",'mail.finefabrics.ca');
define("_SMTP_PORT_",25);




//------------------------------------------------------------------------------
if(_SITE_MODE == "debug"){
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors','1');
    ini_set('display_startup_errors','1');
    error_reporting (E_ALL);    
}

//------------------------------------------------------------------------------
class Config
{

    var $host = '';
    var $user = ''; 
    var $password = '';
    var $database = '';  

    function Config()
    {
	$this->host     = "localhost";  
	$this->user     = "finefabr_webuser";
	$this->password = "fLNrNhbNbQ";
	$this->database = "finefabr_webstore";		
	
	
	/*$this->host     = "localhost";  
	$this->user     = "root";
	$this->password = "";
	$this->database = "finefabrics";*/	
	
    }

}

?>