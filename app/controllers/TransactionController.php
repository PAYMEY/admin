<?php

class TransactionController extends AdminController
{

    /**
	 * 
	 */
    public function actionIndex()
	{
        // list of accounts
        $criteria = new CDbCriteria(array(
            //'condition' => 't.status=' . Transaction::STATUS_PENDING,
            'with' => array(
                'payer',
                'receiver',
                'transactionDetails' => array('condition' => 'transactionDetails.transaction_type_id=5'))
        ));

        if (isset($_GET['status'])) {
            switch ($_GET['status']) {
                case Transaction::STATUS_PENDING:
                    $criteria->addCondition('t.status=' . Transaction::STATUS_PENDING);
                    break;
                case Transaction::STATUS_APPROVED:
                    $criteria->addCondition('t.status=' . Transaction::STATUS_APPROVED);
                    break;
                case Transaction::STATUS_FAILED:
                    $criteria->addCondition('t.status=' . Transaction::STATUS_FAILED);
                    break;
                default:
                    $criteria->addCondition('t.status<0');
                    break;
            }
        }

        $transactionDataProvider = new CActiveDataProvider('Transaction', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 100,
            ),
        ));

        $transactionIdSortingLink = $this->getAttributeSortingLink('Transaction', 'id', '/transaction/index');
        $dateSortingLink = $this->getAttributeSortingLink('Transaction', 'created', '/transaction/index');
        $amountSortingLink = $this->getAttributeSortingLink('Transaction', 'amount', '/transaction/index');

        $this->render(
            'index',
            array(
                'transactionDataProvider' => $transactionDataProvider,
                'transactionIdSortingLink' => $transactionIdSortingLink,
                'dateSortingLink' => $dateSortingLink,
                'amountSortingLink' => $amountSortingLink,

            )
        );
	}

    /*
     *
     */
    public function actionCompleteTransaction()
    {
        // TODO: ajax call
        // get transaction id
        $id = (int)$_POST['Transaction']['id'];
        if ($id > 0) {

            $shortId = $_POST['Transaction']['short_id'];
            $transactionLogic = new TransactionLogic();
            // call complete
            $result = $transactionLogic->completeTransaction($id, $shortId);

            if ($result['returnCode'] !== true) {
                Yii::app()->user->setFlash('error', 'Die Transaction konnte nicht abgeschlossen werden: ' . $result['errorMessage']);
            } else {
                Yii::app()->user->setFlash('success', 'Transaktion abgeschlossen - ' . $result['amount'] . ' auf Paymey Konto gutgeschrieben.');
            }

        }

        if (strpos(Yii::app()->request->urlReferrer,'dashboard')!==false) {
            $this->redirect($this->createUrl('/dashboard'));
        } else {
            $this->redirect($this->createUrl('/transaction'));
        }
    }
}
