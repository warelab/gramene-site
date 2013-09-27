(function ($){
  $(document).ready(function(){
    var search = Drupal.t('Search');
    $('input[name="search_block_form"]').val(search);
    $('input[name="search_block_form"]').blur(function() {
      if (this.value == "") {
        this.value = search;
      }
    });

    $('input[name="search_block_form"]').focus(function() {
      if (this.value == search) {
        this.value = "";
      }
    });
  });
})(jQuery);
