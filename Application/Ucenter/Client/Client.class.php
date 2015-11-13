<?php
namespace Ucenter\Client;
class Client{
    public function __construct(){
        $this->initConfig();
        require_cache(dirname(__FILE__)."/uc_client/client.php");//加载uc客户端主脚本
    }
    //加载配置
    public function initConfig(){
        require_cache(COMMON_PATH."Conf/uc.php");
        if(!defined('UC_API')) {
            E('未发现uc配置文件，请确定配置文件位于'.COMMON_PATH."Conf/uc.php");
        }
    }
    
    function __call($method,$params){
        return call_user_func_array($method, $params);
    }
}
