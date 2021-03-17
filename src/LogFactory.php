<?php
/**
 * Created by PhpStorm.
 * User: liangchen
 * Date: 2018/3/9
 * Time: 下午2:36.
 */

namespace Tars\log;

class LogFactory
{
    /**
     * @param string $routeName
     * @return DefaultLog
     */
    public static function getLog($name = '')
    {
        if (class_exists($name)) {
            return new $name;
        } else {
            return new DefaultLog;
        }
    }
    
}
