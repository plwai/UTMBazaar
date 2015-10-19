$(document).ready(function () {
  search_by_name();
});
 
function search_by_name() {
    $('#search-product').click(function () {
    
        var product_name = $("#search-query").val();
      
        $.ajax({
            url: "<?php echo echo site_url('home/view_search_results'); ?> ",
            async: false,
            type: "POST",
            data: product_name,
            dataType: "html",
            success: function(data) {
                $('#search-product-container').html(data);
            }
        });
    });
}
