<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class AdminUserIdentity extends CUserIdentity
{

    /*
    const ERROR_NONE=0;
    const ERROR_USERNAME_INVALID=1;
    const ERROR_PASSWORD_INVALID=2;
    const ERROR_UNKNOWN_IDENTITY=100;
    */
    const ERROR_USER_INACTIVE = 4;
    const ERROR_TOO_MANY_ATTEMPTS = 5;

    /**
     * @var integer user ID
     */
    private $id;

    private $loginAttempts;

    /**
     *
     */
    public function authenticate()
    {
        $adminUserModel = AdminUser::model()->findByAttributes(array('email' => $this->username));
        $maxLoginAttempts = Yii::app()->params['maxAdminLoginAttempts'];
        $userLockoutTime = Yii::app()->params['adminUserLockoutTime'];

        if ($adminUserModel === null) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } elseif ($adminUserModel->status < 1) {
            $this->errorCode = self::ERROR_USER_INACTIVE;
        } elseif ($adminUserModel->login_attempts >= $maxLoginAttempts) {
            $this->loginAttempts = $adminUserModel->login_attempts;
            $this->errorCode = self::ERROR_TOO_MANY_ATTEMPTS;
        } elseif (!$adminUserModel->checkPassword($this->password)) {
            $adminUserModel->saveCounters(array('login_attempts' => 1));
            $this->loginAttempts = $adminUserModel->login_attempts;
            if ($adminUserModel->login_attempts < $maxLoginAttempts) {
                $this->errorCode = self::ERROR_PASSWORD_INVALID;
            } else {
                // lock this user for 24 hours
                $adminUserModel->locked_until = time() + $userLockoutTime;
                $adminUserModel->save();

                $this->errorCode = self::ERROR_TOO_MANY_ATTEMPTS;
            }
        } else {
            $this->id = $adminUserModel->id;
            $this->username = $adminUserModel->email;

            // reset login attempts counter
            $adminUserModel->login_attempts = 0;
            $adminUserModel->save();
            $this->errorCode = self::ERROR_NONE;
        }

        return $this->errorCode;
    }

    /**
     *
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return
     */
    public function getLoginAttempts()
    {
        return $this->loginAttempts;
    }
}
