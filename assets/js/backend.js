jQuery(document).ready(function ($) {
    $('.nav-tab-wrapper .nav-tab').on('click', function (e) {
        e.preventDefault();

        // Get the selected tab's data attribute
        var tab = $(this).data('tab');

        // Remove active class from all tabs and panels
        $('.nav-tab-wrapper .nav-tab').removeClass('nav-tab-active');
        $('.tab-panel').hide();

        // Add active class to the selected tab and show the corresponding panel
        $(this).addClass('nav-tab-active');
        $('#tab-' + tab).show();
    });
    $(".toogle-slider-giftcardMagic").click(function() {
        var name = '#'+$(this).attr('name');
        if($(name).length) {
            // Check if the checkbox is checked
            if ($(this).is(":checked")) {
              // If checked, show the associated div
              $(name).show();
            } else {
              // If not checked, hide the div
              $(name).hide();
            }
        }
      });
});