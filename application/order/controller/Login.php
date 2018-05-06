<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 2018/5/2
 * Time: 9:12
 */
namespace app\order\controller;
use app\order\controller\Base;
use think\Cookie;
use think\Session;

use think\Db;
use think\Request;
class Login extends Base{
   

    function checkLogin(){

    $appid="wx8bea4fc29893bc93";
    $secret="6570e9c2e98789824b7ca8a57413f638";
    $code=$this->request->param('code');
   
    $encryptedData = $this->request->param('encryptedData');
    $rawData = Request::instance()->param("rawData");
    $signature =  Request::instance()->param("signature"); 
    $iv =  Request::instance()->param("iv");
    $grant_type="authorization_code";

    $params = [
        'appid' => $appid,
        'secret' => $secret,
        'js_code' => $code,
        'grant_type' => $grant_type
    ];
    $url="https://api.weixin.qq.com/sns/jscode2session"; 
    $res = makeRequest($url, $params);
    if ($res['code'] !== 200 || !isset($res['result']) || !isset($res['result'])) {
        return json(ret_message('requestTokenFailed'));
    }
    $reqData = json_decode($res['result'], true);
    if (!isset($reqData['session_key'])) {
        return json(ret_message('requestTokenFailed'));
    }
    $sessionKey = $reqData['session_key'];
    $signature2 = sha1($rawData . $sessionKey);

    if ($signature2 !== $signature) return ret_message("signNotMatch");

    /**
     *
     * 6.使用第4步返回的session_key解密encryptData, 将解得的信息与rawData中信息进行比较, 需要完全匹配,
     * 解得的信息中也包括openid, 也需要与第4步返回的openid匹配. 解密失败或不匹配应该返回客户相应错误.
     * （使用官方提供的方法即可）
     */
    $pc = new WXBizDataCrypt($this->appid, $sessionKey);
    $errCode = $pc->decryptData($encryptedData, $iv, $data);

    if ($errCode !== 0) {
        return json(ret_message("encryptDataNotMatch"));
    }


    /**
     * 7.生成第三方3rd_session，用于第三方服务器和小程序之间做登录态校验。为了保证安全性，3rd_session应该满足：
     * a.长度足够长。建议有2^128种组合，即长度为16B
     * b.避免使用srand（当前时间）然后rand()的方法，而是采用操作系统提供的真正随机数机制，比如Linux下面读取/dev/urandom设备
     * c.设置一定有效时间，对于过期的3rd_session视为不合法
     *
     * 以 $session3rd 为key，sessionKey+openId为value，写入memcached
     */
    $data = json_decode($data, true);
    $session3rd = randomFromDev(16);

    $data['session3rd'] = $session3rd;
    cache($session3rd, $data['openId'] . $sessionKey);


    $s =json_encode( $data);

    $rows1 = db("office")->where('wid',$s -> openId)->find();
    if(empty($rows)){
        $rows2 = db("leader")->where('wid',$s -> openId)->find();
        if(empty($rows2)){
            return array("role"=>0);
        }else{
             $data=db("assignment")->select();
             
             return array("role"=>1,$data,'wid'=>$s -> openId);
    }
    }else {
        $data = db("assignment")->select( );
        return array("role"=>2,$data,'wid'=>$s -> openId);
    }

   
    }



    function makeRequest($url, $params = array(), $expire = 0, $extend = array(), $hostIp = '')
{
    if (empty($url)) {
        return array('code' => '100');
    }

    $_curl = curl_init();
    $_header = array(
        'Accept-Language: zh-CN',
        'Connection: Keep-Alive',
        'Cache-Control: no-cache'
    );
    // 方便直接访问要设置host的地址
    if (!empty($hostIp)) {
        $urlInfo = parse_url($url);
        if (empty($urlInfo['host'])) {
            $urlInfo['host'] = substr(DOMAIN, 7, -1);
            $url = "http://{$hostIp}{$url}";
        } else {
            $url = str_replace($urlInfo['host'], $hostIp, $url);
        }
        $_header[] = "Host: {$urlInfo['host']}";
    }

    // 只要第二个参数传了值之后，就是POST的
    if (!empty($params)) {
        curl_setopt($_curl, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($_curl, CURLOPT_POST, true);
    }

    if (substr($url, 0, 8) == 'https://') {
        curl_setopt($_curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($_curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    }
    curl_setopt($_curl, CURLOPT_URL, $url);
    curl_setopt($_curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($_curl, CURLOPT_USERAGENT, 'API PHP CURL');
    curl_setopt($_curl, CURLOPT_HTTPHEADER, $_header);

    if ($expire > 0) {
        curl_setopt($_curl, CURLOPT_TIMEOUT, $expire); // 处理超时时间
        curl_setopt($_curl, CURLOPT_CONNECTTIMEOUT, $expire); // 建立连接超时时间
    }

    // 额外的配置
    if (!empty($extend)) {
        curl_setopt_array($_curl, $extend);
    }

    $result['result'] = curl_exec($_curl);
    $result['code'] = curl_getinfo($_curl, CURLINFO_HTTP_CODE);
    $result['info'] = curl_getinfo($_curl);
    if ($result['result'] === false) {
        $result['result'] = curl_error($_curl);
        $result['code'] = -curl_errno($_curl);
    }

    curl_close($_curl);
    return $result;
}

function ret_message($message = "") {
    if ($message == "") return ['result'=>0, 'message'=>''];
    $ret = lang($message);

    if (count($ret) != 2) {
        return ['result'=>-1,'message'=>'未知错误'];
    }
    return array(
        'result'  => $ret[0],
        'message' => $ret[1]
    );
}

function randomFromDev($len) {
    $fp = @fopen('/dev/urandom','rb');
    $result = '';
    if ($fp !== FALSE) {
        $result .= @fread($fp, $len);
        @fclose($fp);
    }
    else
    {
        trigger_error('Can not open /dev/urandom.');
    }
    // convert from binary to string
    $result = base64_encode($result);
    // remove none url chars
    $result = strtr($result, '+/', '-_');

    return substr($result, 0, $len);
}


}