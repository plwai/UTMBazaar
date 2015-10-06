<body>
<div class="row">
                <div class="col-sm-3">
                    <h2> Categories </h2>
                    <div class="list-group">
                        <a href="#" class="list-group-item active"> Utensils <span class="label label-warning">+5 New</span></a>
                        <a href="#" class="list-group-item"> T-Shirts <span class="label label-warning">+3 New</span></a>
                        <a href="#" class="list-group-item"> Gadgets <span class="label label-warning">+2 New</span></a>
                        <a href="#" class="list-group-item"> Books </a>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item"><a href="#"> T-Shirts</a> <span class="label label-warning">+3 New</span></li>
                        <li class="list-group-item"><a href="#"> Gadgets</a> <span class="label label-warning">+2 New</span></li>
                        <li class="list-group-item"><a href="#"> Utensils</a> <span class="label label-warning">+5 New</span></li>
                        <li class="list-group-item"><a href="#"> Books</a></li>
                    </ul>
                    <h3> Search Items </h3>
                    <form class="form-inline" role="form">
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" placeholder="Enter keyword">
                        </div>
                        <button type="button" class="btn btn-warning">
                            <span class="glyphicon glyphicon-search"></span> Search
                        </button>
                    </form>
                    <button data-toggle="collapse" data-target="#demo">Search tools</button>
                    <div id="demo" class="collapse">
                        <form role="form">
                            <div class="checkbox">
                                <label><input type="checkbox" value="">Option 1</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" value="">Option 2</label>
                            </div>
                        </form>
                    </div>
                </div>
                <!--FEATURED ITEMS PANEL-->
                <div class="col-sm-9">
                    <h2> Featured Items </h2>
                    <div class="row">
                        <div class="col-md-4">
                            <a class="thumbnail">
                                <div class="well well-sm"><span data-toggle="popover" title="PRICE" data-content="RM 0.50">Spectacles 1</span></div>
                                <img src="assets/image/sample.jpg" style="width:150px;height:150px">
                                <button type="button" class="btn btn-warning">
                                    <span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart
                                </button>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a class="thumbnail">
                                <div class="well well-sm">Sectacles 2 <span class="label label-info">RM 0.50</span></div>
                                <img src="assets/image/sample.jpg" style="width:150px;height:150px">
                                <button type="button" class="btn btn-warning">
                                     Add to Cart <span class="glyphicon glyphicon-shopping-cart"></span>
                                </button>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a class="thumbnail">
                                <div class="well well-sm">Sectacles 3</div>
                                <img src="assets/image/sample.jpg" style="width:150px;height:150px">
                                <p>
                                    Price <span class="label label-info">RM 0.50</span>
                                </p>
                                <button type="button" class="btn btn-warning">
                                    <span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <ul class="pager">
                            <li class="previous"><a href="#">Previous</a></li>
                            <li class="next"><a href="#">Next</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--THIS IS ADS PANEL-->
            <div class="row">
                <h3>ADS</h3>
                <div id="adsSlide" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#adsSlide" data-slide-to="0" class="active"></li>
                        <li data-target="#adsSlide" data-slide-to="1"></li>
                        <li data-target="#adsSlide" data-slide-to="2"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <img src="assets/image/blog-one.jpg" alt="one" width="460" height="345">
                        </div>

                        <div class="item">
                            <img src="assets/image/blog-two.jpg" alt="two" width="460" height="345">
                        </div>

                        <div class="item">
                          <img src="assets/image/blog-three.jpg" alt="three" width="460" height="345">
                        </div>
                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <!--THIS IS FOOTER-->
            <div id="footer">
                <p>Copyrighted© Universiti Teknologi Malaysia</p>
            </div>
        </div>
    </body>
</html>
