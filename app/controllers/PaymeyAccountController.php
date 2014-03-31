<?php

class PaymeyAccountController extends AdminController
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
            'with' => array('account')
        ));

        if (isset($_GET['status'])) {
            switch ($_GET['status']) {
                case PaymeyAccount::STATUS_BANK_APPROVED:
                    $criteria->addCondition('t.status=' . PaymeyAccount::STATUS_BANK_APPROVED);
                    break;
                case PaymeyAccount::STATUS_ACCOUNT_APPROVED:
                    $criteria->addCondition('t.status='. PaymeyAccount::STATUS_ACCOUNT_APPROVED);
                break;
                case PaymeyAccount::STATUS_PENDING:
                    $criteria->addCondition('t.status=' . PaymeyAccount::STATUS_PENDING);
                break;
                default:
                    $criteria->addCondition('t.status<0');
                    break;
            }
        }

        $pmaDataProvider = new CActiveDataProvider('PaymeyAccount', array(
            'criteria' => $criteria,
        ));

        $pmaIdSortingLink = $this->getAttributeSortingLink('PaymeyAccount', 'id', '/paymeyaccount/index', 'PAYMEY-Konto-Nummer');
        $pmaNameSortingLink = $this->getAttributeSortingLink('PaymeyAccount', 'name', '/paymeyaccount/index', 'PAYMEY-Konto');

        $this->render(
            'index',
            array(
                'pmaDataProvider' => $pmaDataProvider,
                'pmaIdSortingLink' => $pmaIdSortingLink,
                'pmaNameSortingLink' => $pmaNameSortingLink,
            )
        );

	}

}
