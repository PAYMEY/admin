<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta charset="utf-8">
	<meta name="language" content="en" />
<?php
    // Stylesheet files
    Yii::app()->clientScript->registerCssFile('/css/jquery-ui/jquery-ui-1.10.3.custom.min.css');
    Yii::app()->clientScript->registerCssFile('/admin/css/custom.css');

    // JavaScript files
    Yii::app()->clientScript->registerScriptFile('/js/lib/jquery/jquery.min.js');
    Yii::app()->clientScript->registerScriptFile('/js/lib/jquery/jquery-ui.custom.min.js');
    Yii::app()->clientScript->registerScriptFile('/admin/js/lib/tipsy.js');
    //Yii::app()->clientScript->registerScriptFile('/js/lib/modernizr.js');
    Yii::app()->clientScript->registerScriptFile('/admin/js/com.paymey.admin.js');
?>

    <title>PAYMEY Admin</title>
    <link rel="shortcut icon" href="/admin/pics/shared/favicon.ico">

</head>
<body>
<a id="top"></a>
<div id="cnt-main"> <!-- Start #cnt-main -->

    <div id="cnt-top"> <!-- Start #cnt-top -->
        <div id="cnt-logo"><a href="<?= $this->createUrl('/dashboard'); ?>"><img src="/admin/pics/shared/logo.png" width="210" height="83" alt="" /></a></div>
    </div> <!-- End #cnt-top -->

    <?php echo $content; ?>

</div> <!-- End #cnt-main -->
<? $this->widget('AdminNotificationsWidget'); ?>
</body>
<script>
    $('a').tipsy({gravity: $.fn.tipsy.autoWE});
</script>
</html>
