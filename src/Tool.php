<?php
/**
 * Created by PhpStorm.
 * User: melody
 * Date: 2020-08-04
 * Time: 17:51
 */
namespace ApiDoc;

class Tool
{
    public function checkAppId($appid,$appsecret)
    {
        $url = Config::$check_api_url;
        $curlobj = curl_init(); // 初始化
        curl_setopt($curlobj, CURLOPT_URL, $url); // 路径
        curl_setopt($curlobj, CURLOPT_HEADER, 0); // 不显示header，因为不是直接打印所以不用显示header,参数中的1代表true，0代表false
        curl_setopt($curlobj, CURLOPT_RETURNTRANSFER, 1); // 不直接打印,参数中的1代表true，0代表false
        curl_setopt($curlobj, CURLOPT_POST, 1); // 提交方式：post,参数中的1代表true，0代表false
        curl_setopt($curlobj, CURLOPT_POSTFIELDS, ['appid'=>$appid,'appsecret'=>$appsecret]); // 提交的请求参数
        $output = curl_exec($curlobj);
        return $output;
    }
}
