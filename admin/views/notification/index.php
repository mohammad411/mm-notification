<div class="wrap">
    <h2><b>تنظیمات اعلان</b></h2>
    <?php
        $mmn_default_settings=get_option(MMN_PLUGIN_SETTINGS_KEY);
        if (isset($_POST['mmn_save_settings'])):
            $now = new DateTime();
            if ($now->format('Y-m-d H:i') > str_replace('T',' ',$_POST['mmn_date_end'])){
                show_notice('تاریخ وارد شده معتبر نیست','error');
            }else{
                $new_settings=array(
                    'mmn_activation'=>in_array($_POST['mmn_activation'],['active','deactive']) ? $_POST['mmn_activation']: 'active',
                    'mmn_text_notification'=>sanitize_text_field($_POST['mmn_text_notification']),
                    'mmn_url_notification'=>$_POST['mmn_url_notification'],
                    'mmn_date_end'=>str_replace('T',' ',$_POST['mmn_date_end']),
                    'mmn_back_color_settings'=>$_POST['mmn_back_color_settings'],
                    'mmn_text_color_settings'=>$_POST['mmn_text_color_settings'],
                    'mmn_linl_back_color_settings'=>$_POST['mmn_linl_back_color_settings'],
                    'mmn_link_color_settings'=>$_POST['mmn_link_color_settings']
                );
                if (update_option(MMN_PLUGIN_SETTINGS_KEY,$new_settings)){
                    show_notice('تغیرات با موفقیت ذخیره شد','success');
                    $mmn_default_settings=get_option(MMN_PLUGIN_SETTINGS_KEY);
                }else{
                    show_notice('خطایی در ثبت اطلاعات رخ داد','error');
                }
            }
        endif;
    ?>
    <form action="" method="post">
        <p>
            <label>وضعیت افزونه :</label>
            <label for="mmn_activation1"> فعال </label>
            <input type="radio" id="mmn_activation1"  name="mmn_activation" value="active" <?php checked($mmn_default_settings['mmn_activation'],'active'); ?>>
            <label for="mmn_activation0"> غیر فعال </label>
            <input type="radio" id="mmn_activation0" name="mmn_activation" value="deactive" <?php checked($mmn_default_settings['mmn_activation'],'deactive'); ?>>
        </p>
        <p>
            <label for="mmn_text_notification">متن اعلان :</label><br><br>
            <textarea id="mmn_text_notification" name="mmn_text_notification" placeholder="متنی که قرار است به عنوان اطلاعیه قرار بگیرد را تایپ کنید . . . " class="widefat rtl"><?php echo $mmn_default_settings['mmn_text_notification'];?></textarea>
        </p>
        <p>
            <label for="mmn_url_notification">لینک ورود به صفحه اعلان :</label><br><br>
            <input type="url" id="mmn_url_notification" name="mmn_url_notification" placeholder="https://www.example.com" class="widefat ltr" value="<?php echo $mmn_default_settings['mmn_url_notification'];?>">
        </p>
        <p>
            <label for="mmn_date_end">تاریخ وساعت  پایان :</label>
            <input type="datetime-local" name="mmn_date_end" id="mmn_date_end" value="<?php echo str_replace(' ','T',$mmn_default_settings['mmn_date_end']);?>">
        </p>
        <p>
            <label>تنظیمات استایل </label><br><br>
            <label for="mmn_back_color_settings">رنگ پس زمینه اعلان</label>
            <input type="text" name="mmn_back_color_settings" value="<?php echo $mmn_default_settings['mmn_back_color_settings'];?>" id="mmn_back_color_settings">
            <label for="mmn_text_color_settings">رنگ متن اعلان</label>
            <input type="text" name="mmn_text_color_settings" value="<?php echo $mmn_default_settings['mmn_text_color_settings'];?>" id="mmn_text_color_settings">
            <label for="mmn_linl_back_color_settings">رنگ پس زمینه لینک</label>
            <input type="text" name="mmn_linl_back_color_settings" value="<?php echo $mmn_default_settings['mmn_linl_back_color_settings'];?>" id="mmn_linl_back_color_settings">
            <label for="mmn_link_color_settings">رنگ متن لینک</label>
            <input type="text" name="mmn_link_color_settings" value="<?php echo $mmn_default_settings['mmn_link_color_settings'];?>" id="mmn_link_color_settings">
        </p>
        <p><input type="submit" value="ثبت تغیرات" name="mmn_save_settings" class="button button-primary"></p>
    </form>
    <label for="mmn_styles_preview_settings">پیش نمایش :</label><br><br>
    <div id="mmn_styles_preview_settings">
        <span id="mmn_text_notification_preview"></span>
        <a id="mmn_link_notification_preview" href="https://www.daneshjooyar.com/landing/emamreza/" target="_blank" rel="noopener">مشاهده</a>
        <div id="mmn_notification_preview_counters">
                <span id="mmn_notification_preview_day_counter">1</span> روز
                <span id="mmn_notification_preview_hour_counter">24</span> :
                <span id="mmn_notification_preview_min_counter">60</span> :
                <span id="mmn_notification_preview_sec_counter">60</span>
            ساعت
        </div>
    </div>
</div>