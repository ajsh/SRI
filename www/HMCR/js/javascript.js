function set_page(page){   
  $.ajax({
      type: 'post',
      url: 'includes/page_functions.php',
      data: {
           set_page:page
      },
      success: function (response) {
        location.reload(true);
      }
  });
}