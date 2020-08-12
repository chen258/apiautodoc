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
//        $curl = curl_init();
//        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
//        //设置抓取的url
//        curl_setopt($curl, CURLOPT_URL,  $url . "?appid=$appid&appsecret=$appsecret");
//        //设置获取的信息以文件流的形式返回，而不是直接输出。
//        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//        //执行命令
//        $data_curl = curl_exec($curl);
//        //关闭URL请求
//        curl_close($curl);

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
