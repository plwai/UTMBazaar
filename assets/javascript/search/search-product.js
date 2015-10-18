$(document).ready(function () {
  search_by_query();
});
 
function search_by_query() {
  $('#search-product').click(function () {
    
      var query = $("#search-query").val();
      
      $.ajax({
      url: "<?php echo echo site_url('home/view_search_results'); ?> ",
      async: false,
      type: "POST",
      data: query,
      dataType: "html",
      success: function(data) {
        $('#search-product-container').html(data);
      }
    });
  });
   
}
