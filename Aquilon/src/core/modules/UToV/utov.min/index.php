<?php abstract class UtovA{ private static $log=null; public static function run($default=[],$input=[],$logger=0,$reg=true){switch($logger){case 0;self::clearElse($default,$input);break;case 1:self::set_logging(['error'=>false,'warning'=>true],$default,$input);break;case 2:self::set_logging(['error'=>true,'warning'=>false],$default,$input);break;default:trigger_error("Logger type '".$logger."' is undefined",E_USER_ERROR);}if(!$reg){self::keyToReg($default,$input,1);}foreach($default as $key=>$item){if(!isset($input[$key])){$input[$key]=$item;}}if(!$reg){self::keyToReg($default,$input,0);}return $input;} private static function set_logging($log_typing,$default,$input){$report='';self::$log=new Logger();self::$log->track($log_typing);foreach($input as $key=>$item){if(!isset($default[$key])){$report.=' "'.$key.'" with value = "'.$item.'" undefined;';unset($item);}}self::$log->createWarning($report);self::$log->createError($report);} private static function clearElse($default,&$input){foreach($input as $key=>&$item){if(!isset($default[$key])){unset($item);}}} private static function keyToReg(&$default,&$input,$reg){$time_d=[];$time_i=[];foreach($default as $key=>$item){$time_d[$reg==1?strtoupper($key):strtolower($key)]=$item;}foreach($input as $key=>$item){$time_i[$reg==1?strtoupper($key):strtolower($key)]=$item;}$default=$time_d;$input=$time_i;unset($time_d);unset($time_i);}}class UtovO{ private $log=null; public function run($default=[],$input=[],$logger=0,$reg=true){switch($logger){case 0;$this->clearElse($default,$input);break;case 1:$this->set_logging(['error'=>false,'warning'=>true],$default,$input);break;case 2:$this->set_logging(['error'=>true,'warning'=>false],$default,$input);break;default:trigger_error("Logger type '".$logger."' is undefined",E_USER_ERROR);}if(!$reg){$this->keyToReg($default,$input,1);}foreach($default as $key=>$item){if(!isset($input[$key])){$input[$key]=$item;}}if(!$reg){$this->keyToReg($default,$input,1);}return $input;} private function set_logging($log_typing,$default,$input){$report='';$this->log=new Logger();$this->log->track($log_typing);foreach($input as $key=>$item){if(!isset($default[$key])){$report.=' "'.$key.'" with value = "'.$item.'" undefined;';unset($item);}}$this->log->createWarning($report);$this->log->createError($report);} private function clearElse($default,&$input){foreach($input as $key=>&$item){if(!isset($default[$key])){unset($item);}}} private function keyToReg(&$default,&$input,$reg){$time_d=[];$time_i=[];foreach($default as $key=>$item){$time_d[$reg==1?strtoupper($key):strtolower($key)]=$item;}foreach($input as $key=>$item){$time_i[$reg==1?strtoupper($key):strtolower($key)]=$item;}$default=$time_d;$input=$time_i;unset($time_d);unset($time_i);}}class Logger implements LoggerI{ private $turn=['error'=>false,'warning'=>false]; public function track($turn=['error'=>false,'warning'=>false]){$this->turn=$turn;}function createError($undefind){if($this->turn['error']&&mb_strlen($undefind,'utf-8')>0){trigger_error($undefind,E_USER_ERROR);}}function createWarning($undefind){if($this->turn['warning']&&mb_strlen($undefind,'utf-8')>0){echo "Warning:".$undefind."\n";}}} interface LoggerI{ public function track($turn=false);function createError($undefind);function createWarning($undefind);}?>