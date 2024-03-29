<?php
/**
 * This is the configuration for generating message translations
 * for the Yii framework. It is used by the 'yiic message' command.
 */
return array(
	'sourcePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'messagePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'messages',
	'languages'=>array('de','en'),
	'fileTypes'=>array('php'),
	'overwrite'=>false,
	'exclude'=>array(
		'.svn',
		'.gitignore',
		'/messages',
		'/runtime',
		'/web/js',
		'/migrations',
		'/gii',
		'/yiic.php',
	),
);
