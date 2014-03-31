<?php

class CheckCookiesWidget extends CWidget
{

    public $hide = '.content';

    public function run()
    {
        $this->render(
            'checkCookies',
            array(
                'hide' => $this->hide
            )
        );
    }
}
