<?php

class HtmlHelper extends CHtml
{
    /*
     *
     */
    public static function activeLabelEx($model, $attribute, $htmlOptions = array())
    {
        if (!isset($htmlOptions['label']) || !$htmlOptions['label']) {
            $htmlOptions['label'] =  $model->getAttributeLabel($attribute);
        }

        $realAttribute = $attribute;
        parent::resolveName($model, $attribute); // strip off square brackets if any
        $htmlOptions['required'] = $model->isAttributeRequired($attribute);

        if (isset($htmlOptions['required'])) {
            if ($htmlOptions['required']) {
                if (isset($htmlOptions['class'])) {
                    $htmlOptions['class'].=' '.parent::$requiredCss;
                } else {
                    $htmlOptions['class'] = parent::$requiredCss;
                }
                $htmlOptions['label'] = parent::$beforeRequiredLabel . $htmlOptions['label'] . parent::$afterRequiredLabel;
            }
            unset($htmlOptions['required']);
        }

        if ((isset($htmlOptions['before']) && $htmlOptions['before']) || (isset($htmlOptions['after']) && $htmlOptions['after'])) {
            $htmlOptions['label'] = $htmlOptions['before'] . $htmlOptions['label'] . $htmlOptions['after'];
            unset($htmlOptions['before']);
            unset($htmlOptions['after']);
        }

        return parent::activeLabel($model, $realAttribute, $htmlOptions);
    }
}
