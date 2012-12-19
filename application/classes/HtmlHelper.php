<?php
/**
 * Created by JetBrains PhpStorm.
 * User: aliaksei
 * Date: 10.12.12
 * Time: 18:20
 * To change this template use File | Settings | File Templates.
 */
class HtmlHelper
{
    public static function out($str)
    {
        return htmlentities($str,ENT_QUOTES,'UTF-8', false);
    }
}
