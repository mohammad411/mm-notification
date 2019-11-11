jQuery(document).ready(function ($) {
    $("#mmn_back_color_settings").wpColorPicker({
        change: function (event, ui) {
            $("#mmn_styles_preview_settings").css('background-color', ui.color.toString());
        }
    });
    $("#mmn_text_color_settings").wpColorPicker({
        change: function (event, ui) {
            $("#mmn_styles_preview_settings").css('color', ui.color.toString());
        }
    });
    $("#mmn_linl_back_color_settings").wpColorPicker({
        change: function (event, ui) {
            $("#mmn_styles_preview_settings a").css('background-color', ui.color.toString());
        }
    });
    $("#mmn_link_color_settings").wpColorPicker({
        change: function (event, ui) {
            $("#mmn_styles_preview_settings a").css('color', ui.color.toString());
        }
    });
    $("#mmn_text_notification").on('change', function () {
        $("span#mmn_text_notification_preview").html($("#mmn_text_notification").val());
    });
    $("span#mmn_text_notification_preview").html($("#mmn_text_notification").val());
    $("#mmn_url_notification").on('change', function () {
        mmn_link_notification = $("#mmn_url_notification").val();
        $("a#mmn_link_notification_preview").attr("href", mmn_link_notification);
    });
});