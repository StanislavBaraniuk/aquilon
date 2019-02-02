<?php
/**
 * Created by PhpStorm.
 * User: stanislaw
 * Date: 1/12/19
 * Time: 00:02
 */

abstract class Controller
{
    protected $model;

    function __call($name, $arguments)
    {
        echo "$name";
    }

    function getModel ($name) {
        $model = str_replace(__CLASS__, "", $name)."Model";
        return new $model();
    }
}