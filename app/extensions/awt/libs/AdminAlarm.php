<?php
/**
 * Class AdminAlarm
 * @author Christian Vollrath <vollrath@attentra.de>
 *
 * Alarm actions if something goes wrong
 */
class AdminAlarm
{
    /**
     * alarm handling
     */
    public static function alarm($subject, $message)
    {
        $data = array('message' => $message);

        $message = new YiiMailer();
        $message->setView('adminAlarm');
        $message->setData($data);
        $message->setSubject($subject);
        $message->setTo(Yii::app()->params['adminEmailAddress']);
        $message->setFrom(Yii::app()->params['sendFromEmailAddress'], Yii::app()->params['sendFromName']);
        if (!$message->send()) {
            throw new CHttpException(500, Yii::t('error', 'Mail send error'), 100003);
        }
    }
}
