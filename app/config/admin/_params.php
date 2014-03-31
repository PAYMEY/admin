<?php

return array(
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        'maxAdminLoginAttempts' => 5, // maximum attempts before user is locked out
        'adminUserLockoutTime' => 86400, // lockout time for user in seconds (=> 24 hours)

    )
);
