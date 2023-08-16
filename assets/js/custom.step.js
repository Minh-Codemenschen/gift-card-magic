jQuery(document).ready(function ($) {
    var form = $("#gcm-viewmode-slide");
    form.validate({
        errorPlacement: function errorPlacement(error, element) { element.before(error); },
        rules: {
            confirm: {
                equalTo: "#password"
            }
        }
    });
    form.children("div").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "fade",
        onStepChanging: function (event, currentIndex, newIndex) {
            form.validate().settings.ignore = ":disabled,:hidden";
            return form.valid();
        },
        onFinishing: function (event, currentIndex) {
            form.validate().settings.ignore = ":disabled";
            return form.valid();
        },
        onFinished: function (event, currentIndex) {
            alert("Submitted!");
        }
    });
});
jQuery(document).ready(function ($) {
    jQuery('.slide-tep-1').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        adaptiveHeight: true, // Đảm bảo chiều cao thích hợp cho các slide
        dots: true, // Hiển thị điểm chuyển slide
        // Các tùy chọn khác của Slick Slide tùy theo yêu cầu của bạn
    });
});