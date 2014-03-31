     <div class="cookies_disabled_notification" style="width: 940px; margin: 50px auto; display:none;">
        <div class="inner">
                <h3><?//ID 69: Headline: Keine Cookies ?><?= Yii::t('paymey', '69-main-headline-error-cookies'); ?></h3>
                <?//ID 70: Text: Keine Cookies ?><?= Yii::t('paymey', '70-main-text-error-cookies'); ?>
        </div>
    </div>
    <script>
        if(!PAYMEY.Cookies.enabled()) {
            $('<?= $hide ?>').hide();
            $('.cookies_disabled_notification').css('display', 'block');
        }
    </script>
