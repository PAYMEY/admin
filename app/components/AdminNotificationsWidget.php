<?php

class AdminNotificationsWidget extends CWidget
{

    public $display = array('error', 'warning', 'notice');

    public function run()
    {
        $data = array();

        foreach (Yii::app()->user->getFlashes() as $key => $message) {
            switch ($key) {
                case 'error':
                    $class = 'error';
                    break;
                case 'success':
                    $class = 'success';
                    break;
                default:
                    $class = 'notice';
                    break;
            }
            $data[] = array(
                'class' => $class,
                'message' => $message
            );
        }
/*
        if (in_array('error', $this->display)) {
            foreach (Yii::app()->user->getErrors() as $d) {
                $data[] = $d;
            }
        }

        if (in_array('warning', $this->display)) {
            foreach (Yii::app()->user->getWarnings() as $d) {
                $data[] = $d;
            }
        }

        if (in_array('notice', $this->display)) {
            foreach (Yii::app()->user->getNotices() as $d) {
                $data[] = $d;
            }
        }
*/
        $this->render(
            'adminNotifications',
            array(
                'notifications' => $data
            )
        );
    }

}
