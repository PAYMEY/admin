<?php

class CheckJavascriptWidget extends CWidget
{

    public $hide = '.content';

    public function run()
    {
        $this->render(
            'checkJavascript',
            array(
                'hide' => $this->hide
            )
        );
    }
}
