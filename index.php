<?php
//header("Content-Type: application/javascript;charset=utf-8");

header("Cache-Control: private");

require_once("ipfunction.php");//获取ip

require_once("src/common/Functions.php");//公用函数
//两种引入工具库的方法
//include_once('src/common/utils/Predis.php');
spl_autoload_register(function ($class)
{
    if (strpos($class, 'common\utils') !== FALSE)
    {
        require_once __DIR__ . '/src/' . implode(DIRECTORY_SEPARATOR, explode('\\', $class)) . '.php';
    }
});

$redis = \common\utils\Predis::getInstance();

$areaConf = config('redis.area_ip_key');
$cacheIP = $redis->hGet($areaConf['key'],$areaConf['field'].ip2long($ip));

if (!empty($cacheIP)){ //ip已有缓存
    $data = unserialize($cacheIP);
}else{ // ip没有缓存进行ip库查询
    require_once("ipip.class.php");//ip查询库
    //黑名单区域
    $shieldArea = config('common.shield_area');

    $ipLocal = 'area:'.$local;

    $data = ['local'=>$ipLocal,'localArr'=>$cityArr,'areaKey'=>0,'ip'=>$ip];
    foreach($shieldArea as $keys => $vals){
        if(strpos($ipLocal, $vals)){
            //黑名单内的区域
            $data = ['local'=>$ipLocal,'localArr'=>$cityArr,'areaKey'=>$keys,'ip'=>$ip];
            break;
        }
    }
    $redis->hSet($areaConf['key'],$areaConf['field'].ip2long($ip),serialize($data));
}

echo json_encode($data);

//echo 'ipLocal:' . $ipLocal;
//
//echo 'ip:' . $ip;

//var_dump($_SERVER['HTTP_CLIENT_IP'], $_SERVER['HTTP_True_Client_IP'], $_SERVER['HTTP_X_FORWARDED_FOR'], $_SERVER['REMOTE_ADDR']);

?>