<?php
/**
 * Created by PhpStorm.
 * User: baidu
 * Date: 18/3/26
 * Time: 上午3:52
 */
namespace common\utils;
ini_set('include_path',$_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'src');
require_once("common/Functions.php");
class Predis {
    public $redis = "";
    /**
     * 定义单例模式的变量
     * @var null
     */
    private static $_instance = null;

    public static function getInstance() {
        if(empty(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __construct() {
        $this->redis = new \Redis();
        try {
            $config = config('redis');
        } catch (\Exception $e) {
            throw new \Exception('Load redis config Error');
        }
        $this->redis->connect($config['host'], $config['port'], $config['timeOut']);
        $this->redis->auth($config['password']);
        $result = $this->redis->select($config['db']);
        if($result === false) {
            throw new \Exception('redis connect error');
        }
    }

    /**
     * set
     * @param $key
     * @param $value
     * @param int $time
     * @return bool|string
     */
    public function set($key, $value, $time = 0 ) {
        if(!$key) {
            return '';
        }
        if(is_array($value)) {
            $value = json_encode($value);
        }
        if(!$time) {
            return $this->redis->set($key, $value);
        }
        return $this->redis->setex($key, $time, $value);
    }

    /**
     * get
     * @param $key
     * @return bool|string
     */
    public function get($key) {
        if(!$key) {
            return '';
        }
        return $this->redis->get($key);
    }

    /**
     * @param $key
     * @return array
     */
    public function sMembers($key) {
        return $this->redis->sMembers($key);
    }

    /**
     * 哈希值
     * @param $key
     * @param $field
     * @param $value
     * @return int
     */
    public function hSet($key,$field,$value)
    {
        return $this->redis->hSet($key,$field,$value);
    }
    /**
     * 获取哈希值
     * @param $key
     * @param $field
     * @param $value
     * @return int
     */
    public function hGet($key,$field)
    {
        return $this->redis->hGet($key,$field);
    }
    /**
     * 删除哈希值
     * @param $key
     * @param $field
     * @param $value
     * @return int
     */
    public function hDel($key,$field)
    {
        return $this->redis->hDel($key,$field);
    }

    /**
     * @param $name
     * @param $arguments
     * @return array
     */
    public function __call($name, $arguments) {
        //echo $name.PHP_EOL;
        //print_r($arguments);
        if(count($arguments) != 2) {
            return '';
        }
        $this->redis->$name($arguments[0], $arguments[1]);
    }
}