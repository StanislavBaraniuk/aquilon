<?php

/**
 * Class Route
 */
class Route
{

    /**
     * @var null
     */
    private static $controller = null;
    /**
     * @var null
     */
    private static $action = null;

    /**
     * @return mixed|string
     */
    public static function getBasePath()
    {
//        $base_path = substr(ROOT, strlen($_SERVER['DOCUMENT_ROOT']));
//        echo ROOT.'<br>';
//        echo $_SERVER['DOCUMENT_ROOT'];
//        if (DS !== '/') {
//            $base_path = str_replace(DS,DS, $base_path);
//        }

        $base_path =  explode('/',$_SERVER['DOCUMENT_ROOT']);

        return $_SERVER['DOCUMENT_ROOT'];

    }

    /**
     * @param $uri
     */
    protected static function getRoute($uri)
    {

//        $route = substr($uri, strlen(self::getBasePath()));

        $route_array = explode('/', $uri);

        if ($route_array[0] === "") {
            array_shift($route_array);
        }
        if (isset($route_array[0]) && $route_array[0] === 'index.php') {
            array_shift($route_array);
        }

        self::$controller = !empty($route_array[0]) ? $route_array[0] : HOME_CONTROLLER;
        self::$action = !empty($route_array[1]) ? $route_array[1] : DEFAULT_ACTION;
    }

    /**
     *
     */
    public static function Start()
    {
        $route = self::cutRoute();

//        print_r($route);
        self::getRoute($route["URI"]);

        $name = ucfirst(self::$controller).'Controller';



        $controller_name = class_exists($name) ? $name  : ucfirst(DEFAULT_404) . 'Controller';
        $action_name = self::$action . 'Action';

        $controller = new $controller_name();

        if (!method_exists($controller, self::$action . 'Action')) {
            $action_name = DEFAULT_ACTION . 'Action';
        }


        $controller->$action_name(self::createInputParams($route["DATA"]));
    }

    private static function cutRoute () {

        if (strpos($_SERVER['REQUEST_URI'], "?")) {
            $request = explode('?', $_SERVER['REQUEST_URI']);
            return ["URI" => $request[0], "DATA" => $request[1]];
        } else {
            $request = explode('/', $_SERVER['REQUEST_URI']);

            $last_element_position = count($request)-1;

            $data = $request[$last_element_position];

            unset($request[$last_element_position]);

            return ["URI" => implode($request, "/"), "DATA" => $data];
        }
    }

    public static function createInputParams ($params) {
        $return_array = [];
        $params_array =  explode("&&", $params);

        if (count($params_array) > 1 || count(explode("=", $params)) > 1) {
            foreach ($params_array as $value) {
                $data = explode("=", $value);
                $return_array[$data[0]] = $data[1];
            }
        } else {
            return $params;
        }

        return $return_array;
    }

    /**
     * @return null
     */
    public static function getAction()
     {
        return self::$action;
     }

    /**
     * @return null
     */
    public static function getController()
     {
        return self::$controller;
     }

}
