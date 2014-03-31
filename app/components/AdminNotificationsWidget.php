<?php

class AdminNotificationsWidget extends CWidget
{

    public $display = array('error', 'warning', 'notice');

    public function run()
    {
        $data = array();

        foreach (Yii::app()->user->getFlashes() as $key => $message) {
            $data[] = array(
                'class' => 'success',
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
