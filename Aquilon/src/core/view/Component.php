<?php
/**
 * Created by PhpStorm.
 * User: stanislaw
 * Date: 1/14/19
 * Time: 09:43
 */

class Component
{
    private $name;
    private $path;
    static private $is_connect = false;
    protected static $get = [];

    public function __construct($component = ["name", "path"])
    {
        $this->name = $component["name"];

        $this->path = $component["path"];

        return true;
    }

    static protected function checkExistingOfComponent ($name, $file, $error = true) {
        if (isset(self::$get[$name]) && $error) {
            trigger_error("You have same components by path `".self::$get[$name]->path."` and `".$file."`, rename one of this.", E_USER_ERROR);
        } else if (isset(self::$get[$name])) {
            return true;
        }

        return false;
    }

    static public function show ($name) {
        self::loadViews(ROOT, $name);
        if (!self::$is_connect) {
            trigger_error("Component `$name` undefined", E_USER_ERROR);
        }
    }

    static function loadViews ($dir, $component) {
        $ffs = scandir($dir);

        unset($ffs[array_search('.', $ffs, true)]);
        unset($ffs[array_search('..', $ffs, true)]);

        if (count($ffs) < 1) return false;

        foreach($ffs as $ff){
            $filePath = $dir.DS.$ff;
            $fileName = explode(".",$ff);

            if ($fileName[0] == $component.COMPONENT && $fileName[1] == PHP_FILE_EXTENSION) {
                if (!self::checkExistingOfComponent($component, $filePath)) {
                    require $filePath;
                    self::$get[$component] = new Component(["name" => $component, "path" => $filePath]);
                    self::$is_connect = true;
                }
            }

            if(is_dir($filePath)) {
                self::loadViews($filePath, $component);
            }
        }
    }

}