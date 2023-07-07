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
});