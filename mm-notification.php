<?php
/**
 * Plugin Name:اعلان
 * Plugin Author:محمد محمدی
 * Author URI:http:example.com
 * Description:این افزونه برای نمایش اعلان های سایت به کار میرود
 * Licence:GPLv2 or later
 */
defined('ABSPATH') || exit();
date_default_timezone_set('Asia/Tehran');
define('MMN_PLUGIN_ADMIN_DIR',plugin_dir_path(__FILE__).'admin/');
define('MMN_PLUGIN_INC_DIR',plugin_dir_path(__FILE__).'admin/includes/');
define('MMN_PLUGIN_VIEWS_DIR',plugin_dir_path(__FILE__).'admin/views/');
define('MMN_PLUGIN_JS_DIR',plugins_url('admin/js/',__FILE__));
define('MMN_PLUGIN_SETTINGS_KEY','MMN_PLUGIN_SETTINGS_KEY');

/**
 * Test Git
 */
$mmn_settings=array(
    'mmn_activation'=>'active',
    'mmn_text_notification'=>'',
    'mmn_url_notification'=>'',
    'mmn_date_end'=>'',
    'mmn_back_color_settings'=>'#313131',
    'mmn_text_color_settings'=>'#ffffff',
    'mmn_linl_back_color_settings'=>'#e74c3c ',
    'mmn_link_color_settings'=>'#ffffff'
);
if (!get_option(MMN_PLUGIN_SETTINGS_KEY)){
    $mmn_settings=add_option(MMN_PLUGIN_SETTINGS_KEY,$mmn_settings);
}else{
    $mmn_settings=get_option(MMN_PLUGIN_SETTINGS_KEY);
}
$now = new DateTime();
if (is_admin()){
    require_once MMN_PLUGIN_INC_DIR.'functions.php';
}
if ($mmn_settings['mmn_activation']=='active'){
    if ($mmn_settings['mmn_date_end'] >= $now->format('Y-m-d H:i')){
            add_action('wp_head','mmn_echo_notification_styles',1);
            add_action('wp_footer','mmn_echo_notification_html',1);
    }
}
function mmn_echo_notification_styles(){
        $mmn_settings = get_option(MMN_PLUGIN_SETTINGS_KEY);
        $background_notification = $mmn_settings['mmn_back_color_settings'];
        $color_text_notification = $mmn_settings['mmn_text_color_settings'];
        $background_link_notification = $mmn_settings['mmn_linl_back_color_settings'];
        $color_link_notification = $mmn_settings['mmn_link_color_settings'];
        ?>
        <style>
        #mmn_styles_notification {
        background: <?php echo $background_notification?>;
        color: <?php echo $color_text_notification?>;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 999;
        display: flex;
        max-width: 100%;
    <?php if (is_user_logged_in()): ?>
        margin-top: 30px;
    <?php endif; ?>
        text-align: center;
        padding: 10px 30px;
        font-size: 20px;
        font-family: "B Nazanin";
        }
        #mmn_styles_notification a{
        background: <?php echo $background_link_notification?>;
        color: <?php echo $color_link_notification?>;
        border-radius: 3px;
        margin: 0 15px  ;
        padding: 5px;
        text-decoration: none;
        }
        #mmn_notification_counters{
        position:absolute;
        left: 20px;
        overflow:hidden;
        font-size: 14px;
        }
        #mmn_notification_counters span{
          height: 50px;
          width: 70px;
          padding: 10px;
          background-color: #444;
          border-radius: 30%;
          font-size: 20px;
          display: inline;
        }
        #mmn_notification_counters span#mmn_notification_day_counter{
        background-color: rgba(0,0,0,.23);
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        let StartDate=new Date("<?php echo $mmn_settings['mmn_date_end']?>");
        let x=setInterval(function () {
            let now =new Date();
            var distance = StartDate - now;
            if (distance > 0){
                let days = Math.floor(distance / (1000 * 60 * 60 * 24));
                let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                let seconds = Math.floor((distance % (1000 * 60)) / 1000);
                $("#mmn_notification_day_counter").html(days);
                $("#mmn_notification_hour_counter").html(hours);
                $("#mmn_notification_min_counter").html(minutes);
                $("#mmn_notification_sec_counter").html(seconds);
            }else {
                $("#mmn_styles_notification").delay( 1000 ).slideUp();
            }
        },1000);
    </script>
<?php
}
function mmn_echo_notification_html(){
    $html=<<<HTML
    <div id="mmn_styles_notification">
        <span id="mmn_text_notification">شهادت امام رضا(ع) تسلیت باد. شرکت در نذری آموزشی : </span>
        <a id="mmn_link_notification" href="https://www.daneshjooyar.com/landing/emamreza/" target="_blank" rel="noopener">مشاهده</a> 
        <div id="mmn_notification_counters">
                <span id="mmn_notification_day_counter"></span> روز
                <span id="mmn_notification_hour_counter"></span> :
                <span id="mmn_notification_min_counter"></span> :
                <span id="mmn_notification_sec_counter"></span>
            ساعت
        </div>
    </div>
HTML;
    echo $html;
}