<?php
//UC通信接口基类,抽象类，必须继承使用
namespace Ucenter\Api;
use Think\Controller;
abstract class Uc extends Controller{
    public $code;//code参数原始字符串
    public $action;//解析code得到的动作名
    public $error = NULL;
    public $post;//post数据
    /**
     * 初始化方法
     */
    public function _initialize(){
        $this->initConfig();//加载uc配置文件
        load("Ucenter.functions");//加载UC函数库
        load("Ucenter.XML");//加载UC XML类库
        $this->initConfig();//初始化UC应用配置
        $this->initRequest();//初始化请求
    }
    
    function initConfig(){
        require_cache(COMMON_PATH."Conf/uc.php");
        if(!defined('UC_API')) {
            exit('未发现uc配置文件，请确定配置文件位于'.COMMON_PATH."Conf/uc.php");
        }
    }
    /**
     * 解析请求
     * @return boolean
     */
    public function initRequest(){
        $code = @$_GET['code'];
	parse_str(_uc_authcode($code, 'DECODE', UC_KEY), $get);
	if(get_magic_quotes_gpc()) {
		$get = _uc_stripslashes($get);
	}
        if(empty($get)) {
		$this->error = '非法请求';
                return false;
	}
	$timestamp = time();
	if($timestamp - $get['time'] > 3600) {
		$this->error = '请求有效期已过';
                return false;
	}
	$this->code = $code;
	$this->action = parse_name($get['action'],'1');
        $this->post = xml_unserialize(file_get_contents('php://input'));
    }
    /**
     * 响应ucserver的通信请求，调用相应方法，输出最终结果并结束整个流程
     */
    public function response(){
        if($this->_before_response()){
            if ($this->error !== NULL) {
                exit($this->error);
            }
            $response = call_user_func(array($this,$this->action));
        }
        if($this->_after_response($response)){
            exit($response);
        }
        exit('-1');
    }
    
    protected function _before_response(){
        return true;
    }
    
    protected function _after_response($response=""){
        return true;
    }
    
    public function test(){
        return '1';
    }
}
