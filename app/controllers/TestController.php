<?php

class TestController extends CController
{

    /**
	 * 
	 */
    public function actionIndex()
	{

	}

    /**
     *
     */
    public function actionInitData()
    {
        $fixtures = array(
            'accounts' => 'Account',
            'address' => 'Address',
            'admin_users' => 'AdminUser',
            'affiliate_history' => 'AffiliateHistory',
            'api_keys' => 'ApiKey',
            'balance_histories' => 'BalanceHistory',
            'bank_accounts' => 'BankAccount',
            'business_types' => 'BusinessType',
            'businesses' => 'Business',
            'channels' => 'Channel',
            'countries' => 'Country',
            'currencies' => 'Currency',
            'devices' => 'Device',
            'fee_groups' => 'FeeGroup',
            'fees' => 'Fee',
            'languages' => 'Language',
            'paymey_accounts' => 'PaymeyAccount',
            'regions' => 'Region',
            'transaction_details' => 'TransactionDetail',
            'transaction_types' => 'TransactionType',
            'transactions' => 'Transaction',
            'users' => 'User',
        );

        $fixtureManager = Yii::app()->getComponent('fixture');
        $fixtureManager->load($fixtures);

        $user = User::model()->findByPk(127350);
        $user->setPassword('asdf1234');
        $user->save();

        $user = User::model()->findByPk(127351);
        $user->setPassword('asdf1234');
        $user->save();

        $user = User::model()->findByPk(127352);
        $user->setPassword('asdf1234');
        $user->save();

        $adminUser = AdminUser::model()->findByPk(1);
        $adminUser->setPassword('asdf1234');
        $adminUser->save();

        $adminUser = AdminUser::model()->findByPk(2);
        $adminUser->setPassword('asdf1234');
        $adminUser->save();

    }

}
