<?php

class MoneyHelper
{
    /*
     * display format
     */
    public static function convert($money)
    {
        // convert money to display format
        return number_format($money / 10000, 2, ',', '.');
    }

    /*
     * double format
     */
    public static function convertDouble($money)
    {
        // convert money to display format
        return number_format($money / 10000, 2, '.', '');
    }

    /*
     * convert fee percent
     */
    public static function convertPercent($percent)
    {
        // convert percent to display format
        return number_format($percent / 100, 2, '.', '');
    }

    /*
     * convert for save in DB
     */
    public static function convertDB($money)
    {
        // convert percent to display format
        return (int)($money * 10000);
    }

}
