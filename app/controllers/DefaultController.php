<?php

class DefaultController extends CController
{
    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        if (!Yii::app()->user->getIsGuest()) {
            if ($_GET['status']!=null) {
                $status = preg_replace('/[^0-9a-zA-Z]/', "", $_GET['status']);
                $this->redirect($this->createUrl('/dashboard/index', array('status' => $status)));
                //echo 'aha';
            } else {
                $this->redirect($this->createUrl('/dashboard'));
                //echo 'aha';
            }
        }

        /*
        $model = new LoginForm;

         // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];

            // validate user input and redirect to the previous page if valid
            if ($model->validate() && ($errorCode = $model->login()) == UserIdentity::ERROR_NONE) {
                $this->redirect($this->createUrl('/dashboard'));
            } elseif ($errorCode == UserIdentity::ERROR_TOO_MANY_ATTEMPTS) {
                $this->render('24h-blocked');
                Yii::app()->end();
            }
            //echo $errorCode;exit;
        }

        $maxLoginAttempts = Yii::app()->params['maxLoginAttempts'];
        $loginAttempts = $model->getLoginAttempts();

        $loginAttemptsString = '';
        if ($loginAttempts > 0) {
            if (($loginAttempts + 1) == $maxLoginAttempts) {
                $loginAttemptsString = Yii::t('paymey', '93-default-button-last-attempt');
            } else {
                //$loginAttemptsString = '(noch ' . ($maxLoginAttempts - $model->getLoginAttempts()) . ' Versuche)';
                $loginAttemptsString = Yii::t('paymey', '92-default-button-attempts-left', ($maxLoginAttempts - $model->getLoginAttempts()));
            }
        }

        // check for status message
        switch($_GET['status']) {
            case 'activated':
                $statusMessage = 1;
                break;
            default:
                $statusMessage = 0;
                break;
        }

        $this->render(
            'index',
            array(
                'model' => $model,
                'loginAttempts' => $loginAttemptsString,
                'statusMessage' => $statusMessage
            )
        );
        */

        $loginFormModel = new AdminLoginForm;

        if (isset($_POST['AdminLoginForm'])) {
            $loginFormModel->attributes = $_POST['AdminLoginForm'];

            if ($loginFormModel->validate() && ($errorCode = $loginFormModel->login()) == AdminUserIdentity::ERROR_NONE) {
                // successful logged in
                $this->redirect($this->createUrl('/dashboard/index'));
            } elseif ($errorCode == AdminUserIdentity::ERROR_TOO_MANY_ATTEMPTS) {
                $this->render('24h-blocked');
                Yii::app()->end();
            }
        }


        $this->render(
            'index',
            array(
                'loginFormModel' => $loginFormModel,
            )
        );
        
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        echo 'error';
        /*
        if ($error=Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest) {
                // TODO: ajax error handling
                echo $error['message'];
            } else {
                if (!Yii::app()->user->isGuest) {
                    $this->layout = 'main';
                }

                if ($error['errorCode'] == 0) {
                    $error['errorCode'] = 404;
                }
                
                $this->layout = 'mobile'; // Fallunterscheidung für  mobile Version erforderlich   
                $this->render(
                    'error',
                    array(
                        'message' => $error['message'],
                        'errorCode' => $error['errorCode'],
                    )
                );
            }
        }
        */
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }
}
