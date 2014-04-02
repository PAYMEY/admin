<?php

class AccountController extends AdminController
{

    /**
     * @var Account;
     */
    private $accountModel;

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


    /*
     *
     */
    public function actionDetails()
    {
        $this->loadAccountModel();

        // list of users
        $criteria = new CDbCriteria(array(
            'condition' => 't.account_id=' . $this->accountModel->id,
            'limit' => 20,
            'with' => array('account')
        ));

        $userDataProvider = new CActiveDataProvider('User', array(
            'criteria' => $criteria,
        ));


        // list of paymey accounts
        $criteria = new CDbCriteria(array(
            'condition' => 't.account_id=' . $this->accountModel->id,
            'limit' => 20,
            'with' => array('bankAccount','currency')
        ));
        $pmaDataProvider = new CActiveDataProvider('PaymeyAccount', array(
            'criteria' => $criteria,
        ));


        $this->render(
            'details',
            array(
                'accountModel' => $this->accountModel,
                'userDataProvider' => $userDataProvider,
                'pmaDataProvider' => $pmaDataProvider,
            )
        );
    }


    /*
     *
     */
    private function loadAccountModel($forceReload = false)
    {
        if ($this->accountModel instanceof Account && !$forceReload) {
            return;
        }

        $accountId = (int)$_GET['accountId'];
        $this->accountModel = Account::model()->with('owner')->findByPk($accountId);
        if ($this->accountModel == null) {
            throw new CHttpException(500, Yii::t('error', 'Account not found'), 201001);
        }
    }
}
