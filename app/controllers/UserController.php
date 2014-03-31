<?php

class UserController extends AdminController
{

    /**
	 * 
	 */
    public function actionIndex()
	{
        // list of accounts
        $criteria = new CDbCriteria(array(
            //'condition' => 't.status=' . Transaction::STATUS_PENDING,
            'limit' => 20,
            'with' => array()
        ));

        $userDataProvider = new CActiveDataProvider('User', array(
            'criteria' => $criteria,
        ));

        $userIdSortingLink = $this->getAttributeSortingLink('User', 'id', '/user/index');
        $userNameSortingLink = $this->getAttributeSortingLink('User', 'lastname', '/user/index', 'Nutzer');
        $userEmailSortingLink = $this->getAttributeSortingLink('User', 'email', '/user/index');

        $this->render(
            'index',
            array(
                'userDataProvider' => $userDataProvider,
                'userIdSortingLink' => $userIdSortingLink,
                'userNameSortingLink' => $userNameSortingLink,
                'userEmailSortingLink' => $userEmailSortingLink,
            )
        );
	}

}
