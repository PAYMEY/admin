<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class AdminController extends CController
{

	/**
	 *
	 */
	public function init () 
    {
		//$this->checkAuthorization();
        //echo 'init';
        //Yii::app()->end();
	}

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {

        $rules[] = array('allow',
            'expression' => '(!Yii::app()->user->getIsGuest())',
        );

        $rules[] = array('allow', // allow all users
            'users' => array('@'),
        );

        $rules[] = array('deny', // deny all users
            'users' => array('*'),
        );

        return $rules;
    }

    /**
     * Return data to browser as JSON
     * @param array $data
     */
    protected function renderJSON($data)
    {
        header('Content-type: application/json');
        echo CJSON::encode($data);

        $this->disableLogging();

        Yii::app()->end();
    }

    /*
     *
     */
    protected function disableLogging()
    {
        foreach (Yii::app()->log->routes as $route) {
            if ($route instanceof CWebLogRoute) {
                $route->enabled = false; // disable any weblogroutes
            }
        }
    }

	/**
	 *

    private function checkAuthorization($doRedirect = true) {
		$auth = false;

		if(Yii::app()->adminUser->getIsGuest() && $doRedirect) {
			$this->redirect($this->createUrl('/'));
		}

		return $auth;
	}*/
}
