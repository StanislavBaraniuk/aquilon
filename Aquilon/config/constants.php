<?php

define("ROOT", str_replace("/Aquilon", "", getcwd()));
define("DS", '/');
define("HOME_CONTROLLER", 'AquiHome');
define("DEFAULT_ACTION", 'show');
define("DEFAULT_404", 'unf');
define("COMPONENT", 'CMP');
define("PHP_FILE_EXTENSION", 'php');
define("FILTER", "FTR");
define("DEFAULT_ACCESS_RULE", "site_online");
define("CORS", "on");

define('MYSQL_HOST','mysql.zzz.com.ua');
define('MYSQL_PORT',3306);
define('DB_NAME','ticket_schedule');
define('DB_USERNAME','ticket1schedule');
define('DB_PASSWORD','1234567Asd');

//define('MYSQL_HOST','localhost');
//define('MYSQL_PORT',3306);
//define('DB_NAME','ticket-s');
//define('DB_USERNAME','root');
//define('DB_PASSWORD','mysql');

define('SQL_UPDATE_SET_NAME','SET');
define('SQL_UPDATE_WHERE_NAME','WHERE');
define('SQL_SELECT_GET_NAME','GET');
define('SQL_SELECT_WHERE_NAME','WHERE');
define('SQL_SELECT_EXCEPT_NAME','EXCEPT');