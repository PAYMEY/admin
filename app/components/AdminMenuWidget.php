<?php
class AdminMenuWidget extends CWidget
{
    public function init()
    {
    }

    public function run()
    {
        // render the admin menu
        $this->widget(
            'zii.widgets.CMenu',
            array(
                'items' => array(
                    array('label' => Yii::t('admin', 'menu.startpage'), 'url' => array('/dashboard/index')),
                    array('label' => Yii::t('admin', 'menu.account'), 'url' => array('/account/index')),
                    array('label' => Yii::t('admin', 'menu.user'), 'url' => array('/user/index')),
                    array(
                        'label' => Yii::t('admin', 'menu.paymeyaccount'),
                        'url' => array('/paymeyaccount/index'),
                        'items' => array(
                            array(
                                'label' => Yii::t('admin', 'menu.paymeyaccount.'. PaymeyAccount::STATUS_ACCOUNT_APPROVED),
                                'url' => array('/paymeyaccount/index', 'status' => PaymeyAccount::STATUS_ACCOUNT_APPROVED)
                            ),
                        ),
                    ),
                    array(
                        'label' => Yii::t('admin', 'menu.transaction'),
                        'url' => array('/transaction/index'),
                        'items' => array(
                            array(
                                'label' => Yii::t('admin', 'menu.transaction.' . Transaction::STATUS_PENDING),
                                'url' => array('/transaction/index', 'status' => Transaction::STATUS_PENDING)
                            ),
                            array(
                                'label' => Yii::t('admin', 'menu.transaction.' . Transaction::STATUS_FAILED),
                                'url' => array('/transaction/index', 'status' => Transaction::STATUS_FAILED)
                            ),
                            array(
                                'label' => Yii::t('admin', 'menu.transaction.' . Transaction::STATUS_APPROVED),
                                'url' => array('/transaction/index', 'status' => Transaction::STATUS_APPROVED)
                            ),
                        ),
                    ),
                    array('label' => Yii::t('admin', 'menu.logout'), 'url' => array('/default/logout')),
                ),
                'activateParents' => true,
            )
        );
    }
}