<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                
                <h2> Categories </h2>
                <div class="list-group">
                    <?php foreach ($category_data as $row) { ?>
                    <a href="#" class="list-group-item"> <?php echo $row->category_name; ?> </a>
                    <?php } ?>
                </div>
                
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
                    <?php foreach ($product_list as $row) { ?>
                    <div class="col-md-4">
                        <a class="thumbnail">
                                <div class="well well-sm"><?php echo $row->product_name; ?></div>    
                                <img src="assets/image/no-image.jpg" style="width:150px;height:150px">
                                <p>
                                    Price <span class="label label-info"><?php echo $row->price; ?></span>
                                </p>
                                <button type="button" class="btn btn-warning">
                                    <span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart
                                </button>
                            </a>
                    </div>        
                    <?php } ?>
                </div>
            
            
            
            
            
            
            
                <div class="row">
                    <ul class="pager">
                        <li class="previous"><a href="#">Previous</a></li>
                        <li class="next"><a href="#">Next</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
