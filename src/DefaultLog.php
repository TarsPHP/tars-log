<?php

namespace Tars\log;


class DefaultLog implements Log
{

    protected $path;
    protected $logLevel;
    protected $stream = [];

    protected $levelNameMap = [
        'DEBUG'    => 'log_debug.log',
        'INFO'     => 'log_info.log',
        'NOTICE'   => 'log_notice.log',
        'WARNING'  => 'log_warning.log',
        'ERROR'    => 'log_error.log',
        'CRITICAL' => 'log_critical.log',
    ];

    public function __construct()
    {

    }

    public function setPath($path){
        $this->path = $path;
    }

    public function setLogLevel($logLevel){
        $this->logLevel = $logLevel;
    }

    public function debug($message)
    {
        if( strtoupper($this->logLevel)!='INFO' ){
            $file = $this->path.$this->levelNameMap['DEBUG'];
            $this->addMesage($file,$message);
        }
    }

    public function info($message)
    {
        $file = $this->path.$this->levelNameMap['INFO'];
        $this->addMesage($file,$message);
    }

    public function notice($message)
    {
        $file = $this->path.$this->levelNameMap['NOTICE'];
        $this->addMesage($file,$message);
    }

    public function warn($message)
    {
        $file = $this->path.$this->levelNameMap['WARNING'];
        $this->addMesage($file,$message);
    }

    public function error($message)
    {
        $file = $this->path.$this->levelNameMap['CRITICAL'];
        $this->addMesage($file,$message);
    }

    private function addMesage($file,$message)
    {
        if ( !isset($this->stream[$file]) || !is_resource($this->stream[$file])) {
            $this->stream[$file] = fopen($file, 'a');
            if (!is_resource($this->stream[$file])) {
                $this->stream[$file] = null;
            }
        }
        if(is_resource($this->stream[$file])){
            $message = date('Y-m-d H:i:s').' '.$message;
            fwrite($this->stream[$file],$message);
        }
    }
    
    public function close()
    {
        foreach ( $this->stream as $file=>$stream ){
            if (is_resource($stream)) {
                fclose($stream);
            }
        }
        $this->stream = [];
    }

}
