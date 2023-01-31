/* JavaScript code should be executed in "strict mode" */
"use strict";
// contact form
jQuery(document).ready(function ($) {
$(document).find('form#btn_con_frm_one').submit(function (event) {
$.post('contact.php', $(this).serialize(), function (data, textStatus, xhr) {
$('#success').html(data.msg);
$('#success').show().delay(500).fadeOut(2500);
$('form#btn_con_frm_one').trigger('reset');
});
return false;
});
});