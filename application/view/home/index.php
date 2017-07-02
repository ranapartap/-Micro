<div id="home">
    <div class="slider">
        <div id="about-slider">
            <div id="carousel-slider" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators visible-xs">
                    <li data-target="#carousel-slider" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-slider" data-slide-to="1"></li>
                    <li data-target="#carousel-slider" data-slide-to="2"></li>
                </ol>

                <div class="carousel-inner">
                    <div class="item active">
                        <img src="<?= get_url('img/front') ?>slide1.jpg" class="img-responsive" alt="">
                    </div>
                    <div class="item">
                        <img src="<?= get_url('img/front') ?>slide2.jpg" class="img-responsive" alt="">
                    </div>
                    <div class="item">
                        <img src="<?= get_url('img/front') ?>slide3.jpg" class="img-responsive" alt="">
                    </div>
                </div>

                <a class="left carousel-control hidden-xs" href="#carousel-slider" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>

                <a class=" right carousel-control hidden-xs"href="#carousel-slider" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div> <!--/#carousel-slider-->
        </div><!--/#about-slider-->
    </div>
</div>


<section id="about">
    <div class="container">
        <div class="center">
            <div class="col-md-6 col-md-offset-3">
                <h2>Micro</h2>
                <hr>
                <p class="lead">Micro - a quickstart Core PHP skeleton</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-6 wow fadeInRight">
                <img src="<?= get_url('img/front') ?>front.jpg" class="img-responsive" />
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni autem minus sint, commodi.</p>

            </div><!--/.col-sm-6-->

            <div class="col-sm-6 wow fadeInDown">
                <div class="accordion">
                    <div class="panel-group" id="accordion1">
                        <div class="panel panel-default">
                            <a class="panel-heading accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne1">
                                Frontend Pages
                                <i class="fa fa-angle-right pull-right"></i>
                            </a>

                            <div id="collapseOne1" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <div class="media accordion-inner">
<!--                                        <div class="pull-left">
                                            <img class="img-responsive" src="<?= get_url('img/front') ?>accordion1.png">
                                        </div>-->
                                        <div class="media-body">
                                            <h4>Frontend Pages</h4>
                                            <p>Demo front end pages designed with bootstrap with micro settings</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                           <a class="panel-heading accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo1">
                                User Login with Authentication
                                <i class="fa fa-angle-right pull-right"></i>
                            </a>
                            <div id="collapseTwo1" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                                        3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                                        Brunch 3 wolf moon tempor.<br>

                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                                        non cupidatat skateboard dolor brunch.</p>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                             <a class="panel-heading accordion-toggle collapsed"  data-toggle="collapse" data-parent="#accordion1" href="#collapseThree1">
                                        User CRUD + Block Demo
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </a>
                            <div id="collapseThree1" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                                        3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                                        Brunch 3 wolf moon tempor.<br>

                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                                        non cupidatat skateboard dolor brunch.</p>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                             <a class="panel-heading accordion-toggle collapsed"  data-toggle="collapse" data-parent="#accordion1" href="#collapseFour1">
                                        Admin Panel with Sidebar
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </a>
                            <div id="collapseFour1" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                                        3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                                        Brunch 3 wolf moon tempor.<br>

                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                                        non cupidatat skateboard dolor brunch.</p>
                                </div>
                            </div>
                        </div>
                    </div><!--/#accordion1-->
                </div>
            </div>

        </div><!--/.row-->
    </div><!--/.container-->
</section><!--/#about-->