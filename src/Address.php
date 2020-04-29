<?php
/**
 * Created by PhpStorm.
 * User: iszmxw
 * Date: 2020/04/29
 * Time: 17:51
 */

namespace Iszmxw\IpAddress;

class Address
{
    public static function ip()
    {
        if (@$_SERVER["HTTP_X_FORWARDED_FOR"])
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        else if (@$_SERVER["HTTP_CLIENT_IP"])
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        else if (@$_SERVER["REMOTE_ADDR"])
            $ip = $_SERVER["REMOTE_ADDR"];
        else if (@getenv("HTTP_X_FORWARDED_FOR"))
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        else if (@getenv("HTTP_CLIENT_IP"))
            $ip = getenv("HTTP_CLIENT_IP");
        else if (@getenv("REMOTE_ADDR"))
            $ip = getenv("REMOTE_ADDR");
        else
            $ip = "Unknown";
        return $ip;
    }

    /**
     * 根据ip获取用户的地址
     * @param $ip
     * @return array|bool
     * @author: iszmxw <mail@54zm.com>
     * @Date：2020/4/29 21:27
     */
    public static function address($ip)
    {
        if ("127.0.0.1" == $ip) {
            return ['origip' => $ip, 'location' => '本地开发'];
        }
        $url      = "https://sp0.baidu.com/8aQDcjqpAAV3otqbppnN2DJv/api.php?query={$ip}&resource_id=6006";
        $response = HttpCurl::doGet($url);
        $response = mb_convert_encoding($response, 'utf-8', 'GB2312');
        $re       = json_decode($response, true);
        if (empty($re['data'])) {
            return false;
        } else {
            return $re['data']['0'];
        }
    }
}