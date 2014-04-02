<?php

class UserController extends AdminController
{

    /**
     * @var Account;
     */
    private $accountModel;

    /**
     * @var User;
     */
    private $userModel;

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

    /*
     * show and update user model
     */
    public function actionDetails()
    {
        $this->loadUserModel();
        $this->loadAccountModel();

        if (isset($_POST['User'])) {
            $this->userModel->attributes = $_POST['User'];
            if (!$this->userModel->save()) {
                Yii::app()->user->setFlash('error', Yii::t('admin', 'updateError'));
            } else {
                Yii::app()->user->setFlash('success', Yii::t('admin', 'updateSuccess'));
            }
        }

        $this->render(
            'details',
            array(
                'userModel' => $this->userModel,
                'accountModel' => $this->accountModel,
            )
        );
    }

    /*
     * delete a user model
     */
    public function actionDelete()
    {
        $this->loadUserModel();
        $accountId = $this->userModel->account_id;
        if (!$this->userModel->delete()) {
            if ($this->userModel->getError('is_deleted')!=null) {
                // show the model error in flash
                Yii::app()->user->setFlash('error', Yii::t('admin', 'deleteError').' '.$this->userModel->getError('is_deleted'));
            } else {
                // show a common error
                Yii::app()->user->setFlash('error', Yii::t('admin', 'deleteError'));
            }
            // redirect to the user
            $this->redirect($this->createUrl('/user/details', array('userId' => $this->userModel->id)));
        } else {
            // redirect to the account
            Yii::app()->user->setFlash('success', Yii::t('admin', 'deleteSuccess'));
            $this->redirect($this->createUrl('/account/details', array('accountId' => $accountId)));
        }
    }

    /*
     * toggle user status between blocked & approved
     */
    public function actionToggleStatus()
    {
        $this->loadUserModel();

        if ($this->userModel->status == User::STATUS_BLOCKED) {
            $this->userModel->status = User::STATUS_APPROVED;
        } elseif($this->userModel->status == User::STATUS_APPROVED) {
            $this->userModel->status = User::STATUS_BLOCKED;
        }

        if (!$this->userModel->save()) {
            Yii::app()->user->setFlash('error', Yii::t('admin', 'updateError'));
        } else {
            Yii::app()->user->setFlash('success', Yii::t('admin', 'updateSuccess'));
        }

        $this->redirect($this->createUrl('/user/details', array('userId'=>$this->userModel->id)));
    }

    /*
     * load user model (active record)
     */
    private function loadUserModel($forceReload = false)
    {
        if ($this->userModel instanceof User && !$forceReload) {
            return;
        }
        $userId = (int)$_GET['userId'];
        $this->userModel = User::model()->with('account')->findByPk($userId);
        if ($this->userModel == null) {
            throw new CHttpException(500, Yii::t('error', 'User not found'), 201000);
        }
    }

    /*
     * load account model (active record)
     */
    private function loadAccountModel($accountId = false, $forceReload = false)
    {
        if ($this->accountModel instanceof Account && !$forceReload) {
            return;
        }

        if ($this->userModel instanceof User) {
            // get account from userModel
            $this->accountModel = $this->userModel->account;
        } else {
            // load account model
            if (!$accountId) {
                $accountId = (int)$_GET['accountId'];
            }
            $this->accountModel = Account::model()->with('owner')->findByPk($accountId);
        }

        if ($this->accountModel == null) {
            throw new CHttpException(500, Yii::t('error', 'Account not found'), 201001);
        }
    }

}
