<?php require_once("config.php"); 
$db = new Database();   
$db->open();?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title><?php  echo _ADMIN_PAGE_TITLE_;?> </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
                            <h1>Add new product</h1>
                        </div>

                        <div class="container">
                            <form class="form-horizontal" method="post" action="all-products.php" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="email">Name:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="product_name" name="product_name">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="email">Description:</label>
                                    <div class="col-sm-10">
                                        <textarea id="product_desc" name="product_desc"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="pwd">Product categories</label>
                                    <div class="col-sm-10">          
                                        <select id="attribute_id" name="attribute_id">
                                            <option value="0">None</option>
                                            <?php 
                                            $sql    = "SELECT * FROM attribute WHERE parent_id != 0 order by attribute_id ASC";
                                            $db->query($sql);
                                            $rows   = $db->numRows();
                                            if($rows>0) {
                                                while($rsdata = $db->fetchAssoc()) { ?>
                                                    <option value="<?php echo $rsdata['attribute_id'];?>"><?php echo $rsdata['name'];?></option>
                                                <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="pwd">Product price</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="product_price" name="product_price">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="pwd">Product image</label>
                                    <div class="col-sm-10">          
                                        <input type="file" id="product_image" name="product_image">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="plink">Link</label>
                                    <div class="col-sm-10">
                                        <select id="link" name="link"> 
                                            <?php 
                                            $sql    = "SELECT * FROM category order by category_id ASC";
                                            $db->query($sql);
                                            $rows   = $db->numRows();
                                            if($rows>0) {
                                                while($rsdata = $db->fetchAssoc()) { ?>
                                                    <option value="<?php echo $rsdata['category_id'];?>"><?php echo $rsdata['name'];?></option>
                                                <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">        
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" name="save-product" class="btn btn-default" value="yes">Add new product</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </body>
</html>