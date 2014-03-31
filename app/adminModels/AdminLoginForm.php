<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class AdminLoginForm extends CFormModel
{
	public $username;
	public $password;
	public $rememberMe;
	
	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password', 'required'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// password needs to be authenticated
			//array('password', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe'=>'Remember me next time',
			'username'=>'Benutzername',
			'password'=>'Passwort',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	//public function authenticate($attribute,$params)
    public function authenticate()
	{
		$this->_identity=new AdminUserIdentity($this->username,$this->password);
		$this->_identity->authenticate();
		
		/*
        print_r($this->_identity->errorCode);
		print_r(AdminUserIdentity::ERROR_PASSWORD_INVALID);
	    print_r(AdminUserIdentity::ERROR_USERNAME_INVALID);
	    print_r(AdminUserIdentity::ERROR_USER_INACTIVE);
	    print_r(AdminUserIdentity::ERROR_NONE);
		exit();
		*/
		
		if($this->_identity->errorCode != AdminUserIdentity::ERROR_NONE) {
            if($this->_identity->errorCode === AdminUserIdentity::ERROR_PASSWORD_INVALID) {
                $this->addError('username', Yii::t('login', 'Falsche Kombination aus Kennung und Passwort!'));
                $this->addError('password',Yii::t('login','Falsche Kombination aus Kennung und Passwort!')); 
            } elseif($this->_identity->errorCode === AdminUserIdentity::ERROR_USERNAME_INVALID){
                $this->addError('username', Yii::t('login', 'Falsche Kombination aus Kennung und Passwort!'));
                $this->addError('password', Yii::t('login', 'Falsche Kombination aus Kennung und Passwort!'));
            } elseif($this->_identity->errorCode === AdminUserIdentity::ERROR_USER_INACTIVE) {
                $this->addError('username',Yii::t('login','User Inaktiv. Bitte wenden Sie sich an den Administrator!'));
            } elseif ($this->_identity->errorCode === AdminUserIdentity::ERROR_TOO_MANY_ATTEMPTS) {
                $this->addError('username', Yii::t('login', 'Zu viele Log-In Versuche. Der User ist f&uuml;r 24 Stunden gesperrt'));
            }
        } 

	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if ($this->_identity===null) {
			//$this->_identity=new AdminUserIdentity($this->username,$this->password);
			//$this->_identity->authenticate();
            $this->authenticate();
		}
		if ($this->_identity->errorCode===AdminUserIdentity::ERROR_NONE) {
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
            return AdminUserIdentity::ERROR_NONE;
		} else {
            $this->password = '';
            return $this->_identity->errorCode;
        }
	}
}
