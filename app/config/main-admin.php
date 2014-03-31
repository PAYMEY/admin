<?php
/**
 * main configuration
 *
 * This is the main Web application configuration. Any writable
 * CWebApplication properties can be configured here.
 */

define('DS', '/'/*DIRECTORY_SEPARATOR*/);

if (! file_exists(dirname(__FILE__) . '/admin/_params.php')) {
    die('missed "_params.php" - see "_params.php.default"');
}
if (! file_exists(dirname(__FILE__) . '/admin/_db.php')) {
    die('missed "_db.php" - see "_dp.php.default"');
}
if (! file_exists(dirname(__FILE__) . '/admin/_modules.php')) {
    die('missed "_modules.php" - see "_modules.php.default"');
}
if (! file_exists(dirname(__FILE__) . '/admin/_logs.php')) {
    die('missed "_logs.php" - see "_logs.php.default"');
}
if (! file_exists(dirname(__FILE__) . '/admin/_routes.php')) {
    die('missed "_routes.php" - see "_routes.php.default"');
}
if (! file_exists(dirname(__FILE__) . '/admin/_emails.php')) {
    die('missed "_emails.php" - see "_emails.php.default"');
}
if (!file_exists(dirname(__FILE__) . '/admin/_payon.php')) {
    die('missed "_payon.php" - see "_payon.php.default"');
}
if (!file_exists(dirname(__FILE__) . '/admin/_zendesk.php')) {
    die('missed "_zendesk.php" - see "_zendesk.php.default"');
}
$pre_config = CMap::mergeArray(require (dirname(__FILE__) . '/admin/_params.php'), require (dirname(__FILE__) . '/admin/_db.php'));
$pre_config = CMap::mergeArray($pre_config, require (dirname(__FILE__) . '/admin/_modules.php'));
$pre_config = CMap::mergeArray($pre_config, require (dirname(__FILE__) . '/admin/_logs.php'));
$pre_config = CMap::mergeArray($pre_config, require (dirname(__FILE__) . '/admin/_routes.php'));
$pre_config = CMap::mergeArray($pre_config, require (dirname(__FILE__) . '/admin/_emails.php'));
$pre_config = CMap::mergeArray($pre_config, require (dirname(__FILE__) . '/admin/_payon.php'));
$pre_config = CMap::mergeArray($pre_config, require (dirname(__FILE__) . '/admin/_zendesk.php'));

return CMap::mergeArray(
    $pre_config,
    array(
        'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
        'name'=>'PAYMEY Admin',
        'defaultController' => 'default',

        'sourceLanguage'=>'00',
        'language'=>'de',

        // preloading 'log' component
        'preload'=>array('log'),

        // autoloading model and component classes
        'import'=>array(
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
        'components'=>array(
            // ADMIN Login
    		'user'=>array(
        		'class' => 'AdminWebUser',
    	        'authExpires' => 1200,        // in seconds
        		// enable cookie-based authentication
        		'allowAutoLogin'=>true,
        		//'stateKeyPrefix'=>'admin',
                'loginUrl'=>'/',
        	),

            'curl' => array(
                'class' => 'ext.curl.Curl',
                //'options' => array(/.. additional curl options ../)
            ),

            'errorHandler'=>array(
                // use 'site/error' action to display errors
                //'errorAction'=>'site/error',
            ),

            'log'=>array(
                'class'=>'CLogRouter',
                'routes'=>array(
                    array(
                        'class'=>'CFileLogRoute',
                        'levels'=>'error, warning',
                    ),
                    // uncomment the following to show log messages on web pages
                    /*
                    array(
                        'class'=>'CWebLogRoute',
                    ),
                    */
                ),
            ),

            'request' => array(
                'csrfTokenName' => 'token',
                'enableCsrfValidation' => true,
                'enableCookieValidation' => true,
            ),

        ),
    )
);
