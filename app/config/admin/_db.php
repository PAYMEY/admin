<?php
/**
 * database settings
 *
 * This is an example. Copy file to "_db.php"
 * and set your local database here
 */

return array(
    'components' => array(
        'db' => array(
            'pdoClass' => 'NestedPDO',
            'class' => 'CDbConnection',
            'connectionString' => 'mysql:host=localhost;dbname=paymey_admin',
            'charset' => 'utf8',
            'username' => 'root',
            'password' => 'intranet',
            'emulatePrepare' => true,
            'enableProfiling' => true,
            'enableParamLogging' => true
        )
    )
);