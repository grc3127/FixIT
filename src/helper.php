<?php

class AppHelper
{

    private $Db;
    private $Container = [];

    public function __construct($db){
        $this->Db = $db;
    }
    public function pdo(){
        return $this->Db;
    }

    public function set($var,$val){
        $this->Container[$var] = $val;
    }
    public function get($var){
        return $this->Container[$var] ?? null;
    }

    public function includeFile($file, $asfile = false, $once = false)
    {
        $pdo = $this->pdo();
        $APP = &$this;
        $file = $this->cleanDirectory(__DIR__ . '/' . $file);
        if ($asfile) {
            return $file;
        }
        if ($once) {
            include_once($file);
        } else {
            include($file);
        }
    }

    public function cleanDirectory($dir)
    {
        $dir = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $dir);
        $dir = preg_replace('/' . preg_quote(DIRECTORY_SEPARATOR, '/') . '{2,}/', DIRECTORY_SEPARATOR, $dir);
        return $dir;
    }
}