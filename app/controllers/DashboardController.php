<?php

class DashboardController extends AdminController
{

    /**
	 * 
	 */
    public function actionIndex()
	{
		//echo 'dashboard<br>';
        //echo '<a href="/default/logout">logout</a><br>';
        //print_r($_GET);

        //$openTransactions = Transaction::model()->findAllByAttributes(array('status' => Transaction::STATUS_PENDING));

        // List of transactions
        $criteria = new CDbCriteria(array(
            //'condition' => 't.status=' . Transaction::STATUS_PENDING,
            'limit' => 20,
            'order' => 't.created DESC',
            'with' => array(
                'payer',
                'receiver',
                'transactionDetails' => array('condition'=>'transactionDetails.transaction_type_id=5'))
        ));
        $transactionDataProvider = new CActiveDataProvider('Transaction', array(
            'pagination' => array(
                'pageSize' => 20,
            ),
            'criteria' => $criteria,
        ));

        // list of accounts
        $criteria = new CDbCriteria(array(
            //'condition' => 't.status=' . Transaction::STATUS_PENDING,
            'limit' => 20,
            'order' => 't.created DESC',
            'with' => array('business', 'owner')
        ));

        $accountDataProvider = new CActiveDataProvider('Account', array(
            'criteria' => $criteria,
        ));

        date_default_timezone_set('Europe/Berlin');
        $end = strtotime(date('Ymd-0:00'));
        $start = $end - 86400; //(24 * 3600);

        $today = date('d.m.Y', $end);

        $sql = 'SELECT COUNT(*) as count FROM accounts WHERE created >= ' . $end . ' AND status > ' . Transaction::STATUS_PENDING;
        $statistics['newAccountsToday'] = $this->countSql($sql);

        $sql = 'SELECT COUNT(*) as count FROM api_keys as k, devices as d WHERE k.is_active=1 AND d.api_key_id=k.id AND d.is_deleted=0 AND k.created >= ' . $end;
        $statistics['newDevicesToday'] = $this->countSql($sql);

        $sql = 'SELECT COUNT(*) as count FROM transactions WHERE created >= ' . $end;
        $statistics['newTransactionsToday'] = $this->countSql($sql);

        $sql = 'SELECT COUNT(*) as count FROM transactions WHERE created >= ' . $end . ' AND status > '.Transaction::STATUS_NEW;
        $statistics['newSuccessfulTransactionsToday'] = $this->countSql($sql);

        $yesterday = date('d.m.Y', $start);
        $sql = 'SELECT COUNT(*) as count FROM accounts WHERE created >= ' . $start . ' AND created <= ' . $end . ' AND status > ' . Transaction::STATUS_PENDING;
        $statistics['newAccountsYest'] = $this->countSql($sql);

        $sql = 'SELECT COUNT(*) as count FROM api_keys as k, devices as d WHERE k.is_active=1 AND d.api_key_id=k.id AND d.is_deleted=0 AND k.created >= ' . $start . ' AND k.created <= ' . $end;
        $statistics['newDevicesYest'] = $this->countSql($sql);

        $sql = 'SELECT COUNT(*) as count FROM transactions WHERE created >= ' . $start . ' AND created <= ' . $end;
        $statistics['newTransactionsYest'] = $this->countSql($sql);

        $sql = 'SELECT COUNT(*) as count FROM transactions WHERE created >= ' . $start . ' AND created <= ' . $end . ' AND status > ' . Transaction::STATUS_NEW;
        $statistics['newSuccessfulTransactionsYest'] = $this->countSql($sql);

        $start -= 86400;//(24 * 3600);
        $end -= 86400; //(24 * 3600);

        $dbfYest = date('d.m.Y', $start);
        $sql = 'SELECT COUNT(*) as count FROM accounts WHERE created >= ' . $start . ' AND created <= ' . $end . ' AND status > ' . Transaction::STATUS_PENDING;
        $statistics['newAccountsDbfYest'] = $this->countSql($sql);

        $sql = 'SELECT COUNT(*) as count FROM api_keys as k, devices as d WHERE k.is_active=1 AND d.api_key_id=k.id AND d.is_deleted=0 AND k.created >= ' . $start . ' AND k.created <= ' . $end;
        $statistics['newDevicesDbfYest'] = $this->countSql($sql);

        $sql = 'SELECT COUNT(*) as count FROM transactions WHERE created >= ' . $start . ' AND created <= ' . $end;
        $statistics['newTransactionsDbfYest'] = $this->countSql($sql);

        $sql = 'SELECT COUNT(*) as count FROM transactions WHERE created >= ' . $start . ' AND created <= ' . $end . ' AND status > ' . Transaction::STATUS_NEW;
        $statistics['newSuccessfulTransactionsDbfYest'] = $this->countSql($sql);


        $sql = 'SELECT COUNT(*) as count FROM accounts WHERE is_deleted=0 AND status > ' . Transaction::STATUS_NEW;
        $statistics['accounts'] = $this->countSql($sql);

        $sql = 'SELECT COUNT(*) as count FROM api_keys as k, devices as d WHERE k.is_active=1 AND d.api_key_id=k.id AND d.is_deleted=0';
        $statistics['devices'] = $this->countSql($sql);

        $sql = 'SELECT COUNT(*) as count FROM transactions';
        $statistics['transactions'] = $this->countSql($sql);

        $sql = 'SELECT COUNT(*) as count FROM transactions WHERE status > ' . Transaction::STATUS_NEW;
        $statistics['successfulTransactions'] = $this->countSql($sql);

        $sql = 'SELECT COUNT(*) as count FROM transactions WHERE status = ' . Transaction::STATUS_PENDING;
        $statistics['openTransactions'] = $this->countSql($sql);

        $sql = 'SELECT COUNT(*) as count FROM users WHERE is_verified = 0';
        $statistics['unverifiedUsers'] = $this->countSql($sql);

        $sql = 'SELECT COUNT(*) as count FROM paymey_accounts WHERE status = ' . PaymeyAccount::STATUS_ACCOUNT_APPROVED;
        $statistics['unverifiedPaymeyAccounts'] = $this->countSql($sql);

        $this->render(
            'dashboard',
            array(
                'transactionDataProvider' => $transactionDataProvider,
                'accountDataProvider' => $accountDataProvider,
                'today' => $today,
                'yesterday' => $yesterday,
                'statistics' => $statistics,
                'dbfYest' => $dbfYest,
            )
        );

	}

    /*
     *
     */
    private function countSql($sql) {
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $row = $command->queryRow();
        //print_r($row);
        return $row['count'];
    }
}
