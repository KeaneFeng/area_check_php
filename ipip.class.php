<?php

ini_set('memory_limit', '2G');

spl_autoload_register(function ($class)
{
    if (strpos($class, 'ipip\db') !== FALSE)
    {
        require_once __DIR__ . '/src/' . implode(DIRECTORY_SEPARATOR, explode('\\', $class)) . '.php';
    }
});


if(file_exists('ipipfree.ipdb')){
    $city = new ipip\db\City('ipipfree.ipdb');
}
else{
    $city = new ipip\db\City('ipipfree.ipdb');
}
//$ip = '59.42.128.87';
$cityArr = $city->find($ip, 'CN');
//$cityArr = $city->find("47.106.113.124", 'CN');//59.42.128.87 广州  47.106.113.124 深圳

//$local = iconv("UTF-8", "GBK//IGNORE", $cityArr[0].$cityArr[1].$cityArr[2]);//编码是GBK的时候需要转码
$local = $cityArr[0].$cityArr[1].$cityArr[2];

?>