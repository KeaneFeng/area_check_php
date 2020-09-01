<?php

function getip() {
    if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) {
        $ip = getenv("HTTP_X_FORWARDED_FOR");
	$ip = explode(",", $ip)[0];
    } else if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
        $ip = getenv("HTTP_CLIENT_IP");
    else if (getenv("HTTP_CF_CONNECTING_IP") && strcasecmp(getenv("HTTP_CF_CONNECTING_IP"), "unknown"))
        $ip = getenv("HTTP_CF_CONNECTING_IP");
    else if (isset ($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
        $ip = $_SERVER['REMOTE_ADDR'];
    else $ip = "unknown";

    return preg_match ( '/[\d\.]{7,15}/', $ip, $matches ) ? array_pop($matches) : '';
}

/**
 * 获取用户真实IP
 * @return string
 */
function getClientIp() {
    try{
        if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        else if (getenv('HTTP_X_REAL_IP'))
            $ip = getenv('HTTP_X_REAL_IP');
        else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
            $ip = getenv("REMOTE_ADDR");
        else if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
            $ip = getenv("HTTP_CLIENT_IP");
        else if (getenv("HTTP_CF_CONNECTING_IP") && strcasecmp(getenv("HTTP_CF_CONNECTING_IP"), "unknown"))
            $ip = getenv("HTTP_CF_CONNECTING_IP");
        else $ip = "unknown";
    }catch (\Exception $e){
        $ip = "unknown";
    }
    return preg_match ( '/[\d\.]{7,15}/', $ip, $matches ) ? array_pop($matches) : '';
}

function validip($ip)
{
    if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_IPV4)) {
        return true;
    }
    else {
        return false;
    }
}
function getip2()
{
    global $_SERVER;
    if (validip(getenv('HTTP_CLIENT_IP'))) return getenv('HTTP_CLIENT_IP');
    elseif (getenv('HTTP_X_FORWARDED_FOR')!="")
    {
        $forwarded=str_replace(" ","",getenv('HTTP_X_FORWARDED_FOR'));
        $forwarded_array=str_split(",",$forwarded);
        foreach($forwarded_array as $value){ 
            if (validip($value)){ 
                return $value; 
            }
        }
    }
    return getenv('REMOTE_ADDR');
}

function ipto16($ip){
    $ipArray = explode('.', $ip);
    foreach($ipArray as $key=>$var){
        $ipArray[$key]=dechex($var);
    }
    return implode('|', $ipArray);
}


$ip = isset($_GET['ips'])?$_GET['ips']:getip();


?>
