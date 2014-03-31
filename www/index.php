<?php

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

$config=dirname(__FILE__).'/../app/config/main-admin.php';

$yii=dirname(__FILE__).'/../framework/yii.php';

require_once($yii);
Yii::createWebApplication($config)->run();
