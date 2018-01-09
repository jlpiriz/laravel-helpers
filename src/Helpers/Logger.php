<?php 

namespace Jlpiriz\LaravelHelpers\Helpers;



class Logger 
{
    private static $instance = null;

    public static function getInstance($path='') 
    {
        if (self::$instance == null) 
        {
            if ($path != '') 
                $path  = base_path().'/'.$path;
            else
                $path = base_path();

            self::$instance = new Logger($path);
        }
        return self::$instance;
    }

    public function __clone()
    {
        trigger_error("Invalid operation: cannot clone an instance of ".get_class($this)." class.", E_USER_ERROR);
    }

    public function __wakeup()
    {
        trigger_error("Invalid operation: cannot serialize an instance of ".get_class($this)." class.", E_USER_ERROR);
    }

    /*------------------------------------------------*/

    var $path;

    private function __construct($path) 
    {
        $this->changePath($path);
    }

    public function changePath($path)
    {
        $this->path = $path;

        if(!file_exists($path))
            mkdir($path, 0777, true);
    }

    public function save($file, $value, $newFile=true)
    {
        if($newFile)
            $modeOpenFile = 'w+';
        else
            $modeOpenFile = 'a+';


        $fp = fopen($this->path.'/'.$file,$modeOpenFile);
        $stringValue = $this->convertString($value);
        fwrite($fp, $stringValue);
        fclose($fp);
    }

    private function convertString($value)
    {
        if(is_array($value))
        {
            return var_export($value,true);
        }
        elseif(is_bool($value))
        {
            if($value)  return 'true';
            else        return 'false';
        }
        elseif(is_float($value))
        {
            return (string)$value;
        }
        elseif(is_int($value))
        {
            return (string)$value;
        }
        elseif(is_null($value))
        {
            return 'NULL';
        }
        elseif(is_object($value))
        {
            return '(object) '.var_export($value,true);
        }
        elseif(is_string($value))
        {
            return $value;
        }
        else  // type callable, resource and others
        {
            $value = "Cannot save data to a file: unknown typeee";
            if(defined('JH_Logger_unknown_type')) $value = JH_Logger_unknown_type;
            return $value;
        }    
    }

}

