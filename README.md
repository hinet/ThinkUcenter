## 简介

ThinkUcenter 是面向康盛论坛Discuz的Ucenter通信一套API,实现模块级应用配置。项目作者[吾爱](http://ekan001.com)

## 版本说明

本接口支持ThinkPHP3.2与Ucenter1.6版本：

## 注册应用

可根据项目示例注册应用，具体步骤：
1) 复制Ucenter目录到你的Application目录作为Ucenter模块
2) 以Home模块为例，创建控制器 Home\Controller\ApiController,控制器继承 Ucenter\Api\Uc 类；创建：
index动作方法，该方法用于响应UC通信 ，方法实现如下：
```Php
public function index(){
    $this->response();
}
```
3) 整个 ApiController 源码如下：
```Php
<?php
namespace Home\Controller;
use Ucenter\Api\Uc;

class ApiController extends Uc {
	function index(){
        $this->response();
    }
}
?>
```
4) 到论坛添加应用,登录论坛的Ucenter,在应用管理 > 添加应用

应用的主URL: http://localhost/Home
通信秘钥：
应用接口文件名称：index

5) 应用创建成功后，拷贝配置代码到Application/Home/conf/uc.php中,到这里应该可以看到通信正常。

## 同步登录

uc_client所有api请参考[ucenter手册](http://www.discuz.net/forum.php?mod=attachment&aid=MjM5MjUzfDdkYjg2ODVjfDE0NDYwMTEyNjN8MzA4NTQyfDg3OTIzNw%3D%3D) ，你所要做的就是在项目中实例化 Ucenter\client\client 类，通过类调用接口函数，如下：：
```php
<?php
namespace Home\Controller; 
class PublicController extends \Think\Controller{
    function login(){
        $uc = new \Ucenter\Client\Client();
        $re = $uc->uc_user_login("username", "password");
        //dump($re);
    }
}
?>
```


## 同步注册
参考同步登录，调用注册函数，如下：
```php
<?php
namespace Home\Controller; 
class PublicController extends \Think\Controller{
    function login(){
        $uc = new \Ucenter\Client\Client();
        $re = $ucenter->uc_user_register($username,$password, $email);
        //dump($re);
    }
}
?>
```

## 实现模块的UC通信响应

这部分尚未完善，但是你完全可以自行开发，一些基本的响应方法会逐步添加到Uc类里，请留意更新，后面也会逐步添加一些简单的开发说明，但还是建议读者自己分析ucenter包里的api/uc.php，结合本模块中的 Uc.class.php 尝试自行在ApiController里实现

当你需要接收同步登录等请求时，你需要在上面的Api类中添加对应的事件动作，动作方法命名请参考康盛UCenter压缩包里的手册， API接口一节。