<?php
/**
 * Created by PhpStorm.
 * User: stanislaw
 * Date: 1/12/19
 * Time: 00:04
 */
//

class Aquilon
{
    static function start ()
    {
        Access::_RUN_(explode(",",DEFAULT_ACCESS_RULE));
        Route::Start();
    }
}