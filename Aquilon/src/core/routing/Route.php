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
        $base_path = substr(ROOT, strlen($_SERVER['DOCUMENT_ROOT']));

        if (DS !== '/') {
            $base_path = str_replace(DS,DS, $base_path);
        }

        return $base_path;

    }

    /**
     * @param $uri
     */
    protected static function getRoute($uri)
    {
         $route = substr($uri, strlen(self::getBasePath()));
         $route_array = explode('/', $route);

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
            $request = explode('?', $_SERVER['REQUEST_URI']);
            $uri = $request[0];

            self::getRoute($uri);

            $name = ucfirst(self::$controller).'Controller';

            $controller_name = class_exists($name) ? $name  : ucfirst(DEFAULT_404) . 'Controller';
            $action_name = self::$action . 'Action';

            $controller = new $controller_name();

            if (!method_exists($controller, self::$action . 'Action')) {
                $action_name = DEFAULT_ACTION . 'Action';
            }

            $controller->$action_name(self::createInputParams($request[1]));
     }

     public static function createInputParams ($params) {
        $return_array = [];
        $params_array =  explode("&&", $params);
        if (count($params_array) > 1) {
            foreach (explode("&&", $params) as $value) {
                $data = explode("=", $value);
                $return_array[$data[0]] = $data[1];
            }
        } else {
            return $params_array;
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
