<?php
/**
 * Created by PhpStorm.
 * User: stanislaw
 * Date: 1/18/19
 * Time: 12:20
 */

class Parser
{
    static public function json () {
        $postData = file_get_contents('php://input');
        $data = json_decode($postData, true);
        return $data;
    }
}