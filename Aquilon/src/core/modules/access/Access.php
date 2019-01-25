<?php
/**
 * Created by PhpStorm.
 * User: stanislaw
 * Date: 1/17/19
 * Time: 22:58
 */

class Access
{
    static private $filters = [];

    static public function _USE_ () {

    }

    static public function _RUN_ ($filters) {
        if (is_array($filters)) {
            foreach ($filters as $filter) {
                self::load(ROOT, $filter);
            }
        } else {
            self::load(ROOT, $filters);
        }

        if (count(self::$filters) > 0) {
            foreach ($filters as $filter) {
                if (isset(self::$filters[$filter])) {
                    $filter_req = require self::$filters[$filter];
                    if (!$filter_req[0]) {
                        echo $filter_req[1];
                        exit(0);
                    }
                } else {
                    trigger_error("Filter `$filter` undefined", E_USER_WARNING);
                }
            }

        } else {
            trigger_error("Filters not found", E_USER_WARNING);
        }



    }

    static private function load ($dir, $filter_name) {
        $ffs = scandir($dir);

        unset($ffs[array_search('.', $ffs, true)]);
        unset($ffs[array_search('..', $ffs, true)]);

        if (count($ffs) < 1) return false;

        foreach($ffs as $ff){
            $filePath = $dir.'/'.$ff;
            $fileName = explode(".",$ff);

            if ($fileName[1] == PHP_FILE_EXTENSION && $fileName[0] == $filter_name.FILTER && strpos($fileName[0], FILTER) && strpos(file_get_contents($filePath), 'Access::_USE_()')) {
                self::$filters[explode(FILTER, $fileName[0])[0]] = $filePath;
                return true;
            }

            if(is_dir($filePath)) {
                self::load($filePath, $filter_name);
            }
        }
    }

}