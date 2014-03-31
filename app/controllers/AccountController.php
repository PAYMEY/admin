<?php

class AccountController extends AdminController
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
            'with' => array('business', 'owner')
        ));

        $accountDataProvider = new CActiveDataProvider('Account', array(
            'criteria' => $criteria,
        ));

        $accountIdSortingLink = $this->getAttributeSortingLink('Account', 'id', '/account/index');

        $this->render(
            'index',
            array(
                'accountDataProvider' => $accountDataProvider,
                'accountIdSortingLink' => $accountIdSortingLink,
            )
        );
	}

}
