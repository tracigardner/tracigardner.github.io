/* JavaScript code should be executed in "strict mode" */
"use strict";

$(document).ready(function() {
    jQuery("#overlay").fadeOut();
});
/* JavaScript code for sidebar" */
$(window).scroll(function() {
    var a = $(window).scrollTop();
    if (a > 100) {
        $(".top-header-scroll").removeClass("tbl-content");
        $(".top-header-scroll").addClass("top-position");
    } else {
        $(".top-header-scroll").removeClass("top-position");
        $(".top-header-scroll").addClass("tbl-content");
    }
    if (a > 2800) {
        $(".top-header-scroll").removeClass("tbl-content");
        $(".top-header-scroll").addClass("d-none");
    } else {
        $(".top-header-scroll").removeClass("d-none");
        $(".top-header-scroll").addClass("tbl-content");
    }
});