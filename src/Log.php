<?php
/**
 * Created by PhpStorm.
 * User: liangchen
 * Date: 2018/3/9
 * Time: 下午3:06.
 */

namespace Tars\log;


interface Log
{
    
    public function debug($message);
    public function info($message);
    public function notice($message);
    public function warn($message);
    public function error($message);

}
