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

    /*
     *
     */
    public function getAttributeSortingLink($model, $attribute, $url, $label = false)
    {
        $sorting = $attribute . '.desc';
        $class = 'sort down';
        if (isset($_GET[$model . '_sort'])) {
            if ($_GET[$model . '_sort'] == $attribute . '.desc') {
                $class = 'active sort up';
                $sorting = $attribute;
            } elseif ($_GET[$model . '_sort'] == $attribute) {
                $class = 'active sort down';
            }
        }
        if (!$label) {
            $obj = new $model();
            $label = $obj->getAttributeLabel($attribute);
        }
        $sortingLink = '<a href="' . $this->createUrl($url, array($model . '_sort' => $sorting)) . '" class="' . $class . '">' . $label . '<i></i></a>';
        return $sortingLink;
    }

}
