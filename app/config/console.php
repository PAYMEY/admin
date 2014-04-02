<?php
/**
 * console configuration
 *
 * This is the configuration for yiic console application.
 * Any writable CConsoleApplication properties can be configured here.
 */

define('DS', '/' /*DIRECTORY_SEPARATOR*/);

if (!file_exists(dirname(__FILE__) . '/admin/_params.php')) {
    die('missed "_params.php" - see "_params.php.default"');
}
if (!file_exists(dirname(__FILE__) . '/admin/_db.php')) {
    die('missed "_db.php" - see "_dp.php.default"');
}
if (!file_exists(dirname(__FILE__) . '/admin/_modules.php')) {
    die('missed "_modules.php" - see "_modules.php.default"');
}
if (!file_exists(dirname(__FILE__) . '/admin/_routes.php')) {
    die('missed "_routes.php" - see "_routes.php.default"');
}
if (!file_exists(dirname(__FILE__) . '/admin/_emails.php')) {
    die('missed "_emails.php" - see "_emails.php.default"');
}

$pre_config = CMap::mergeArray(require (dirname(__FILE__) . '/admin/_params.php'), require (dirname(__FILE__) . '/admin/_db.php'));
$pre_config = CMap::mergeArray($pre_config, require (dirname(__FILE__) . '/admin/_modules.php'));
$pre_config = CMap::mergeArray($pre_config, require (dirname(__FILE__) . '/admin/_routes.php'));
$pre_config = CMap::mergeArray($pre_config, require (dirname(__FILE__) . '/admin/_emails.php'));

return CMap::mergeArray(
    $pre_config,
    array(
        'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
        'name' => 'PAYMEY Console Application',

        // set source language to 00 -> every language comes from message files!
        // http://www.yiiframework.com/wiki/243/how-to-translate-and-do-the-translations-the-easy-way/
        'sourceLanguage' => '00',

        // preloading 'log' component
        'preload' => array('log'),

        // autoloading model and component classes
        'import' => array(
            'application.models.*',
            'application.adminModels.*',
            'application.components.*',
            'application.components.utils.*',
            'application.extensions.awt.*',
            'application.extensions.awt.libs.*',
            'application.extensions.awt.db.*',
            'application.extensions.awt.db.ar.*',
            'ext.YiiMailer.YiiMailer',
        ),
        // application components
        'components' => array(
            'log' => array(
                'class' => 'CLogRouter',
                'routes' => array(
                    array(
                        'class' => 'CFileLogRoute',
                        'levels' => 'error, warning, info, trace',
                        'logFile' => 'console.log'
                    ),
                ),
            ),
        ),
    )
);
