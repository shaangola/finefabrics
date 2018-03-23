<?php require_once("config.php"); ?>
<?php require_once('action_page.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title><?php  echo _ADMIN_PAGE_TITLE_;?> </title>
        <link href="css/main.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/ddaccordion.js"></script>
        <link href="css/jquery-ui-1.9.1.custom.css" rel="stylesheet">
        <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
        <script src="js/jquery-ui-1.9.1.custom.js"></script>
    </head>

    <body id="homeinnerbg">
        
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="10%" align="left" valign="top" style="width:156px;">
                    <?php include("left_menu_home.php"); ?>
                </td>
                <td width="90%" align="left" valign="top">
                    <div id="rightbody">
                        <?php include("header.php"); ?>
                        <div class="rightbodysec">
                            <h1>Products</h1>
                            <span><a href="add-new-product.php">Add new product</a></span>
                        </div>

                        <div>
                            <?php if(isset($_SESSION["inte_sess_ackmsg"])){ ?>
                                <p><?php echo $_SESSION["inte_sess_ackmsg"];?></p>
                            <?php } ?>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                
                                <tr>
                                    <td><input type="checkbox" name=""></td>
                                    <td><strong>Name</strong></td>
                                    <td><strong>Description</strong></td>
                                    <td><strong>Price</strong></td>
                                    <td><strong>Action</strong></td>
                                </tr>
                                
                                
                                <?php 
                                $sql    = "SELECT * FROM product order by product_id DESC";
                                $db->query($sql);
                                $rows   = $db->numRows();
                                if($rows>0){
                                    while($rsdata = $db->fetchAssoc()){ ?>
                                    <tr>
                                        <td><input type="checkbox" name="" value="<?php echo $rsdata['product_id'];?>"></td>
                                        <td><?php echo $rsdata['name'];?></td>
                                        <td><?php echo $rsdata['description'];?></td>
                                        <td><?php echo $rsdata['price'];?></td>
                                        <td>Edit | Delete</td>
                                    </tr>
                                <?php }
                                }else{ ?>
                                    <tr>
                                        <td colspan="5">No Records Found</td>
                                    </tr>
                                <?php } ?>
                                
                            </table>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
        <?php unset($_SESSION["inte_sess_ackmsg"]);?>
    </body>
</html>