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
            <div class="row">
                <div class="container">

                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <div class="col-lg-3  sidebar">
                                <div class="col-left">
                                    <div class="block block-nav">
                                        <div class="block-title">
                                            <strong><span>Categories</span></strong>
                                        </div>
                                        <div class="block-content">

                                            <ul>
                                                <?php 
                                                $db_menu=new Database();    
                                                $db_menu->open();
                                                ?>
                                                <?php
                                                function fetchCategoryTree($parent = 0, $spacing = '', $user_tree_array = '') {

                                                    if (!is_array($user_tree_array))
                                                        $user_tree_array = array();

                                                    $sql = "SELECT `category_id`, `name`, `parent` FROM `category` WHERE 1 AND `parent` = $parent ORDER BY category_id ASC";
                                                    $db_menu->query($sql);
                                                    
                                                    if ($db_submenu->numRows() > 0) {
                                                        while ($row = $db_menu->fetchArray()) {
                                                            $user_tree_array[] = array("id" => $row['category_id'], "name" => $spacing . $row['name']);
                                                            $user_tree_array = fetchCategoryTree($row['category_id'], $spacing . '&nbsp;&nbsp;', $user_tree_array);
                                                        }
                                                    }
                                                    return $user_tree_array;
                                                }
                                                $return = fetchCategoryTree();
                                                /*$query = mysql_query($sql);
                                                
                                                if (mysql_num_rows($query) > 0) {
                                                    while ($row = mysql_fetch_object($query)) {
                                                        $user_tree_array[] = array("id" => $row->category_id, "name" => $spacing . $row->name);
                                                        $user_tree_array = fetchCategoryTree($row->category_id, $spacing . '&nbsp;&nbsp;', $user_tree_array);
                                                    }
                                                }*/

                                                /*$res = fetchCategoryTreeList();
                                                foreach ($res as $r) {
                                                    echo  $r;
                                                }*/
                                                ?>
                                            </ul>

                                            <?php /* <ul id="categories_nav" class="nav-accordion nav-categories" style="">
                                                <li class="level0 nav-1 active level-top first parent">
                                                    <a href="fashion.html" class="level-top">
                                                        <span>STYLE</span>
                                                    </a><span class="collapse">collapse</span>
                                                    <ul class="level0">
                                                        <li class="level1 item nav-1-1 first">
                                                            <a href="#">
                                                                <span>ANARKALI</span>
                                                            </a>
                                                        </li>
                                                        <li class="level1 item nav-1-2">
                                                            <a href="#">
                                                                <span>ANARKALI SUIT</span>
                                                            </a>
                                                        </li>
                                                        <li class="level1 item nav-1-3">
                                                            <a href="#">
                                                                <span>BRIDAL LEHANGA</span>
                                                            </a>
                                                        </li>
                                                        <li class="level1 item nav-1-4 last">
                                                            <a href="#">
                                                                <span>SALWAR KAMEEZ</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="level0 nav-2 level-top parent">
                                                    <a href="occasion.html" class="level-top">
                                                        <span>OCCASION</span>
                                                    </a><span class="collapse">collapse</span>
                                                    <ul class="level0">
                                                        <li class="level1 item nav-2-1 first">
                                                            <a href="occasion/cocktail.html">
                                                                <span>COCKTAIL</span>
                                                            </a>
                                                        </li>
                                                        <li class="level1 item nav-2-2">
                                                            <a href="occasion/dinner-party.html">
                                                            <span>DINNER PARTY</span>
                                                            </a>
                                                        </li>
                                                        <li class="level1 item nav-2-3">
                                                            <a href="occasion/mehendi.html">
                                                                <span>MEHENDI</span>
                                                            </a>
                                                        </li>
                                                        <li class="level1 item nav-2-4 last">
                                                            <a href="occasion/wedding-day.html">
                                                            <span>WEDDING DAY</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="level0 nav-3 level-top last parent">
                                                    <a href="role.html" class="level-top">
                                                        <span>ROLE</span>
                                                    </a><span class="collapse">collapse</span>
                                                    <ul class="level0">
                                                        <li class="level1 item nav-3-1 first">
                                                            <a href="role/best-friend.html">
                                                                <span>BEST FRIEND</span>
                                                            </a>
                                                        </li>
                                                        <li class="level1 item nav-3-2">
                                                            <a href="role/bride.html">
                                                                <span>BRIDE</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul> */ ?>
                                        </div>
                                    </div>
                                </div>
                            </div>    
                        </div>

                        <div class="col-sm-8">
                            <div class="col-lg-4 col-md-4 col-xs-6 thumb">
                                <div class="grid">
                                    <figure class="effect-lily">
                                        <img src="images/pic4.jpg" alt="img12" class="img-responsive" />
                                        <p><span>Image-1</span></p>
                                        <p><span>10</span></p>
                                    </figure>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-xs-6 thumb">
                                <div class="grid">
                                    <figure class="effect-lily">
                                        <img src="images/pic2.jpg" alt="img12" class="img-responsive" />
                                        <p><span>Image-2</span></p>
                                        <p><span>20</span></p>          
                                    </figure>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-xs-6 thumb">
                                <div class="grid">
                                    <figure class="effect-lily">
                                        <img src="images/pic3.jpg" alt="img12" class="img-responsive" />
                                        <p><span>Image-3</span></p>
                                        <p><span>30</span></p>          
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>                   

                </div>        
            </div>
        </section>

<!--==================================================Footer Close==================================================-->


        <?php include_once("fffooter.php");?>
    </body>
</html>