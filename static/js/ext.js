jQuery(document).ready( function(){


reloadProducts();

function reloadProducts(){
  jQuery('#fotky .reloaded-content').fadeOut(function(){
  jQuery.ajax({
              url : 'https://data.ceska-ecommerce.cz/sold-products.php',
              type : 'get',
              success : function( response ) {
                  jQuery('#fotky .reloaded-content').html(response);
                  jQuery('#fotky .reloaded-content').fadeIn();
                  setTimeout(function () {
                    reloadProducts();
                  }, 10000);
              }
          });
  });
}

});
