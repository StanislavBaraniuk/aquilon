<?php
/**
 * Created by PhpStorm.
 * User: stanislaw
 * Date: 1/15/19
 * Time: 11:57
 */

class iLoader
{
    static function classFinder($dir, $class_name){

        $ffs = scandir($dir);

        unset($ffs[array_search('.', $ffs, true)]);
        unset($ffs[array_search('..', $ffs, true)]);

        if (count($ffs) < 1) return false;

        foreach($ffs as $ff){
            $filePath = $dir.'/'.$ff;
            $fileName = explode(".",$ff);
//            echo $ff.($fileName[0] == $class_name ? "1"."<br>" : "2"."<br>");
            if ($fileName[1] == "php" && $fileName[0] == $class_name && strpos(file_get_contents($filePath), "class ".$fileName[0])) {
//                echo "<br>".$filePath."<br><br>";
                require_once $filePath;
                return true;
            }

            if(is_dir($filePath)) {
                self::classFinder($filePath, $class_name);
            }
        }
    }

    static function load($class_names = []) {
        foreach ($class_names as $class_name) {
            self::classFinder(ROOT, $class_name);
        }
    }
}