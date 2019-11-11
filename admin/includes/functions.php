<?php
add_action('admin_menu',function (){
    $hook=add_menu_page(
        'اعلان',
        'تنظیمات اعلان',
        'administrator',
        'mmn-notification',
        function (){require_once MMN_PLUGIN_VIEWS_DIR.'notification/index.php';},
    ''
    );
    add_action("load-$hook",'mmn_add_color_picker');
},5);
function mmn_add_color_picker(){
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('mmum_color_picker',MMN_PLUGIN_JS_DIR.'color-picker.js',array('jquery','wp-color-picker'));
    $mmn_settings=get_option('MMN_PLUGIN_SETTINGS_KEY');
    $background_notification=$mmn_settings['mmn_back_color_settings'];
    $color_text_notification=$mmn_settings['mmn_text_color_settings'];
    $background_link_notification=$mmn_settings['mmn_linl_back_color_settings'];
    $color_link_notification=$mmn_settings['mmn_link_color_settings'];
    $html=<<<HTML
    <style>
    #mmn_styles_preview_settings {
    background: {$background_notification};
    color: {$color_text_notification};
    text-align: right;
    padding:20px;
    border-radius: 3px;
    font-size: 18px;
    font-family: Arial;
    }
    #mmn_styles_preview_settings  a{
    background: {$background_link_notification};
    color: {$color_link_notification};
    border-radius: 3px;
    padding: 5px;
    text-decoration: none;
    }
    #mmn_notification_preview_counters{
    font-size: 14px;
    position:absolute;
    left: 30px; 
    }
    #mmn_notification_preview_counters span{
      height: 50px;
      width: 70px;
      padding: 10px;
      background-color: #444;
      border-radius: 5px;
      font-size: 20px;
      display: inline;
    }
    #mmn_notification_preview_counters span#mmn_notification_preview_day_counter{
    background-color: rgba(0,0,0,.23);
    }
    </style>
HTML;
    echo $html;
}
function show_notice($message='پیام',$type='success'){
    echo "<div class='notice notice-{$type} is-dismissible'>";
    echo "<p>{$message}</p>";
    echo "</div>";
}