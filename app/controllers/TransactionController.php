<?php

class TransactionController extends AdminController
{

    /**
	 * 
	 */
    public function actionIndex()
	{


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

        $this->redirect($this->createUrl('/dashboard'));

        // return to dashboard
        //$this->redirect($this->createUrl('/dashboard'));
    }
}
