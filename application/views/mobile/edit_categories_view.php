<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                
                <h4> Looking for something? </h4>
                <?php
                $attributes = array('class' => 'form-inline', 'role' => 'form');
                echo form_open('search', $attributes);
                ?>
                    <div class="form-group">
                        <?php
                        $data = array(
                            'name'        => 'search-query',
                            'id'          => 'search-query',
                            'class'       => 'form-control',
                            'placeholder' => 'Enter keyword here',
                        );

                        echo form_input($data);
                        ?>
                    </div>
                    <?php
                        $btn = array(
                            'name'  => 'search-product',
                            'id'    => 'search-product',
                            'class' => 'btn btn-warning',
                            'value' => 'Search',
                        );

                        echo form_submit($btn);
                     ?>
                <?php echo form_close(); ?>
                <button data-toggle="collapse" data-target="#search_option">Search tools</button>
                <div id="search_option" class="collapse">
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

            <!--Edit Category PANEL-->
            <div class="col-sm-6">
            <h2> Edit Category </h2>
            <div class="list-group">
            <?php foreach ($category_data as $row) { ?>
                   
                    <a href="<?php echo base_url();?>products/del_category/<?php echo $row->pk_id;?>" class="list-group-item" data-toggle="tooltip" data-placement="right" title="Notce: Deleting this category will also delete the product associated with it!"> <span class="badge"> Delete </span> <?php echo $row->category_name; ?> </a>
                    
            <?php } ?>
            </div>
                
            <?php
                $add = array('class' => 'form-inline', 'role' => 'form');
                echo form_open('products/add_category', $add);
            ?>
            
            <div class="form-group">
                <?php
                    $input = array(
                        'name'        => 'cat_name',
                        'id'          => 'cat_name',
                        'class'       => 'form-control',
                        'placeholder' => 'Add new category',
                        );

                    echo form_input($input);
                ?>
            </div>
            <?php
                $addbtn = array(
                    'name'  => 'submit',
                    'id'    => 'submit',
                    'class' => 'btn btn-warning',
                    'value' => 'Add Category',
                );

                echo form_submit($addbtn); 
            ?>
            <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</body>
