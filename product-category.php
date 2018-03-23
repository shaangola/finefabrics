<?php
require_once("inc/config.inc.php");
require_once("inc/database.inc.php");

$db = new Database();   
$db->open();

$dba = new Database();   
$dba->open();
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>Fine Fabrics</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/font-awesome.css" rel="stylesheet">
    </head>
    <body class="body-black">
        <?php include_once("ffheader.php");?>

        <section class="pdding-top80">
            <div class="tittle-heading">
                <h1>Products</h1>
                <div class="heading-bar"></div>
            </div>
            <!--===============headdin end============================-->
            <div class="pdding-top80 topbar-of-products">
                <div class="row">
                    <div class="container">

                        <div class="col-sm-12">

                            <!-- /////new accordian added///////-->         
                            <div class="col-sm-4">

                                <div class="categories-block">
                                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                                        <?php 
                                        $sql    = "SELECT * FROM attribute WHERE parent_id = 0 order by attribute_id ASC";
                                        $db->query($sql);
                                        $rows   = $db->numRows();
                                        if($rows>0){
                                            while($rsdata = $db->fetchAssoc()){ ?>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading" role="tab" id="heading<?php echo $rsdata['attribute_id']; ?>">
                                                        <h4 class="panel-title">
                                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $rsdata['attribute_id']; ?>" aria-expanded="true" aria-controls="collapseOne">
                                                                <i class="more-less glyphicon glyphicon-plus"></i>
                                                                <?php echo $rsdata['name']; ?>
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    
                                                    <div id="collapse<?php echo $rsdata['attribute_id']; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                                        <div class="panel-body">
                                                            <?php 
                                                            $sqla    = "SELECT * FROM attribute WHERE parent_id = '".$rsdata['attribute_id']."' order by attribute_id ASC";
                                                            $dba->query($sqla);
                                                            $rowsa   = $dba->numRows();
                                                            if($rowsa>0){  ?>
                                                                <ul class="level0">
                                                                    <?php
                                                                    $count = 0;
                                                                    while($rsdataa = $dba->fetchAssoc()){ 
                                                                        $class = '';
                                                                        if($count == 0){
                                                                            $class= 'first'; 
                                                                        }else if($count == $rowsa){
                                                                            $class= 'last'; 
                                                                        }?>

                                                                        <li class="level1 item nav-1-<?php echo $rsdataa['attribute_id'];?> <?php echo $class;?>">
                                                                            <a href="#">
                                                                                <span><?php echo $rsdataa['name'];?></span>
                                                                            </a>
                                                                        </li>

                                                                        <?php
                                                                    $count++; 
                                                                    }?>
                                                                </ul>
                                                            <?php } ?>                                                            
                                                        </div>
                                                    </div>                                                        
                                                </div>
                                        <?php }
                                        } ?>    

                                    </div>
                                </div>
                            </div>
                            <!--  //////////////END//////////-->



                            <div class="col-sm-8">
                                <!--  //////////////header strip above product display block//////////-->

                                <nav class="navbar navbar-default">                  
                                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                        <ul class="nav navbar-nav">
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">SORT BY: POSITION <span class="caret"></span></a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#">Position</a></li>
                                                    <li><a href="#">Size</a></li>
                                                     <li><a href="#">Style</a></li>
                                                     <li><a href="#">Color</a></li>
                                                    <li><a href="#">Name</a></li>
                                                    <li><a href="#">Price</a></li>                                                     
                                                </ul>
                                            </li>
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">150 ITEMS/PAGE <span class="caret"></span></a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#">50</a></li>
                                                    <li><a href="#">100</a></li>
                                                    <li><a href="#">150</a></li>                                                  
                                                </ul>
                                            </li>
                                        </ul>

                                        <ul class="nav navbar-nav navbar-right">
                                            <li class="active"><a href="#"><span class="glyphicon glyphicon-th"></span> <span class="sr-only">(current)</span></a></li>
                                            <li><a href="#"><span class="glyphicon glyphicon-th-list"></span></a></li>

                                        </ul>
                                    </div><!-- /.navbar-collapse -->                                 
                                </nav>

                                <?php if(isset($_REQUEST['_pcat'])) {
                                    $sql = "SELECT * FROM product where p_link='".$_REQUEST['_pcat']."' order by product_id ASC";
                                    $db->query($sql);
                                    $rows   = $db->numRows();
                                    if($rows>0){
                                        while($rsdata = $db->fetchAssoc()){ ?>

                                            <div class="col-lg-4 col-md-4 col-xs-6 thumb">
                                                <div class="grid">
                                                    <figure class="effect-lily">
                                                        <img src="upload/<?php echo $rsdata['image'];?>" alt="<?php echo $rsdata['image'];?>" class="img-responsive" />
                                                        <p><span><?php echo $rsdata['image'];?></span></p>
                                                        <p><span><?php echo $rsdata['price'];?></span></p>
                                                    </figure>
                                                </div>
                                            </div>
                                <?php   }
                                    }
                                } ?>
                                <!--  //////////////END//////////-->
                            </div>
                        </div>                   

                    </div>        
                </div>
            </div>
        </section>

        <!--==================================================Footer Close==================================================-->


        <?php include_once("fffooter.php");?>

        <!--/*******************************
Script for left side categories panel
*******************************/-->

        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>


        <script>
            function toggleIcon(e) {
                $(e.target)
                    .prev('.panel-heading')
                    .find(".more-less")
                    .toggleClass('glyphicon-plus glyphicon-minus');
            }
            $('.panel-group').on('hidden.bs.collapse', toggleIcon);
            $('.panel-group').on('shown.bs.collapse', toggleIcon);
        </script>

        <!--/*******************************
End
*******************************/-->

    </body>
</html>