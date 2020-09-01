<?php
/**
 * redis相关配置
 * Created by PhpStorm.
 * User: Keane
 * Date: 18/3/23
 * Time: 上午9:17
 */

return [
    'host' => '47.113.224.83',
    'port' => 6383,
    'password'=>'ycabc6383',
    'out_time' => 120,
    'timeOut' => 5, // 超时时间
    'area_ip_key' => [
        'key' => 'shield_area_ip',
        'field' => 'ip2long_'
    ],
    'db'        => 1,
];