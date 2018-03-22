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


                        <!-- /////old code ///////-->


                        <!--    <div class="col-sm-4">
<div class="col-lg-3  sidebar">
<div class="col-left">
<div class="block block-nav">
<div class="block-title">
<strong><span>Categories</span></strong>
</div>
<div class="block-content">
<ul id="categories_nav" class="nav-accordion nav-categories" style="">
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
</ul>
</div>
</div>
</div>
</div>    
</div>

-->
                        <!-- /////old code end///////-->



                        <!-- /////new accordian added///////-->         
                        <div class="col-sm-4">

                            <div class="categories-block">
                              <!--  <div class="block-title">
                                    <strong><span>Categories</span></strong>
                                </div>-->
                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingOne">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                                    STYLE
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                            <div class="panel-body">
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
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingTwo">
                                            <h4 class="panel-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    <i class="more-less glyphicon glyphicon-plus"></i>

                                                    OCCASION

                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                            <div class="panel-body">
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
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingThree">
                                            <h4 class="panel-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                                    ROLE
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                            <div class="panel-body">
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
                                            </div>
                                        </div>
                                    </div>

                                </div>                            </div>

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
                            <!--  //////////////END//////////-->
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