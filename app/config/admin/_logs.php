<?php
/**
 * Logging configuration
 *
 */

/**
 * Array output for a browser
 *
 * @param array $object
 * @param bool  $returnValue
 * @access public
 * @return void
 */
function Array_print_r($object, $returnValue = false)
{
    $output = print_r($object, true);
    //$output = htmlentities($output);
    $output = str_replace(" ", "&nbsp;", $output);
    $output = nl2br($output);

    if ($returnValue) {
        return $output;
    } else {
        echo $output;
        return true;
    }
}

/**
 * Alias of Array_print_r
 *
 * @param array $object
 * @param bool  $returnValue
 * @access public
 * @return void
 */
function _apr($object, $returnValue = false)
{
    return Array_print_r($object, $returnValue);
}

return array(
    'components' => array(
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
                array(
                    'class' => 'CWebLogRoute',
                    'showInFireBug' => true
                )
            )
        )
    )
);