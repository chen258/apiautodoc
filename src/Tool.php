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
        $url = Config::CHECK_APPID_URL;
        $curlobj = curl_init(); // 初始化
        curl_setopt($curlobj, CURLOPT_URL, $url); // 路径
        curl_setopt($curlobj, CURLOPT_HEADER, 0); // 不显示header，因为不是直接打印所以不用显示header,参数中的1代表true，0代表false
        curl_setopt($curlobj, CURLOPT_RETURNTRANSFER, 1); // 不直接打印,参数中的1代表true，0代表false
        curl_setopt($curlobj, CURLOPT_POST, 1); // 提交方式：post,参数中的1代表true，0代表false
        curl_setopt($curlobj, CURLOPT_POSTFIELDS, ['appid'=>$appid,'appsecret'=>$appsecret]); // 提交的请求参数
        $output = curl_exec($curlobj);
        return $output;
    }

    public function getAppidInfo($appid)
    {
        $url = Config::GET_APPID_INFO_URL;
        $curlobj = curl_init(); // 初始化
        curl_setopt($curlobj, CURLOPT_URL, $url); // 路径
        curl_setopt($curlobj, CURLOPT_HEADER, 0); // 不显示header，因为不是直接打印所以不用显示header,参数中的1代表true，0代表false
        curl_setopt($curlobj, CURLOPT_RETURNTRANSFER, 1); // 不直接打印,参数中的1代表true，0代表false
        curl_setopt($curlobj, CURLOPT_POST, 1); // 提交方式：post,参数中的1代表true，0代表false
        curl_setopt($curlobj, CURLOPT_POSTFIELDS, ['appid'=>$appid]); // 提交的请求参数
        $output = curl_exec($curlobj);
        if($output !== false){
            $output = json_decode($output,true);
            if($output['code'] == 0){
                throw new \Exception($output['msg']);
            }
            return $output['data'];
        }
        throw new \Exception('验证appid平台出错');
    }

    /**
     * @ApiDescription(section="checkInputSign", description="检验输入的签名是否正确")
     * @ApiMethod(type="post")
     * @ApiRoute(name="checkInputSign")
     * @param $inputSign
     * @param $inputParams
     * @ApiParams(name="", type="", nullable=false, description="")
     * @return array
     * @ApiReturn(type="object", sample="{'code':'1:成功 0:失败','data':{}",'msg':'string')
     */
    public function checkInputSign($inputSign,$inputParams,$isCheckNonceStr=true)
    {
        try{
            if(!isset($inputParams['appid'])){
                throw new \Exception('请传入appid');
            }
            if($isCheckNonceStr && (!isset($inputParams['nonce_str']) || empty($inputParams['nonce_str']))){
                throw new \Exception('请传入nonce_str');
            }
            $ret = $this->getAppidInfo($inputParams['appid']);
            $key = $ret['appsecret'];
            if(empty($key)){
                throw new \Exception('当前appid的key为null');
            }
            if($inputSign == $this->makeSignByKey($inputParams,$key)){
                unset($ret['appsecret']);
                return ['code'=> 1 ,'data'=>$ret ,'msg'=>'success'];
            }else{
                return ['code'=> 0 ,'data'=>null,'msg'=>'验证错误'];
            }
        }catch (\Exception $e){
            return ['code'=> 0 ,'data'=>null,'msg'=>$e->getMessage()];
        }
    }


    /**
     * @ApiDescription(section="makeSignByKey", description="传入密钥得到签名")
     * @ApiMethod(type="post")
     * @ApiRoute(name="makeSignByKey")
     * @param $inputParams
     * @param $key
     * @ApiParams(name="", type="", nullable=false, description="")
     * @return string
     * @ApiReturn(type="object", sample="{'code':'1:成功 0:失败','data':{}",'msg':'string')
     */
    public function makeSignByKey($inputParams,$key)
    {
        //签名步骤一：按字典序排序参数
        ksort($inputParams);
        $string = $this->toUrlParams($inputParams);
        if(!isset($inputParams['appid'])){
            throw new \Exception('当前appid不存在');
        }
        //签名步骤二：在string后加入KEY
        $string = $string . "&key=".$key;
        //签名步骤三：MD5加密
        $string = md5($string);
        //签名步骤四：所有字符转为大写
        $result = strtoupper($string);
        return $result;
    }

    public function makeSign($inputParams,$isSetNonceStr = true)
    {
        if($isSetNonceStr){
            $inputParams['nonce_str'] = self::getNonceStr();
        }
        //签名步骤一：按字典序排序参数
        ksort($inputParams);
        $string = $this->toUrlParams($inputParams);
        if(!isset($inputParams['appid'])){
            throw new \Exception('当前appid不存在');
        }
        $ret = $this->getAppidInfo($inputParams['appid']);
        $key = $ret['appsecret'];
        if(empty($key)){
            throw new \Exception('当前appid的key为null');
        }
        //签名步骤二：在string后加入KEY
        $string = $string . "&key=".$key;
        //签名步骤三：MD5加密
        $string = md5($string);
        //签名步骤四：所有字符转为大写
        $result = strtoupper($string);
        return $result;
    }

    public static function getNonceStr($length = 32)
    {
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $str ="";
        for ( $i = 0; $i < $length; $i++ )  {
            $str .= substr($chars, mt_rand(0, strlen($chars)-1), 1);
        }
        return $str;
    }

    public function toUrlParams($params)
    {
        $buff = "";
        foreach ($params as $k => $v)
        {
            if($k != "sign" && $v != "" && !is_array($v)){
                $buff .= $k . "=" . $v . "&";
            }
        }

        $buff = trim($buff, "&");
        return $buff;
    }
}
