jQuery(document).ready(function($) {
    $('.a').on('click', function() {
        var test = '';
        $('#div1').click(function(event) {
            // Act on the event
        });
      $(".a").live('click',function (event) {
        for (var i = 0; i < arguments.length; i++) {
          var obj = arguments[i];

        }
      });
    });
});