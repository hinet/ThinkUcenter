<?php
// +----------------------------------------------------------------------
// | HiThink
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.hithink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: honfei <63603636@qq.com>
// +----------------------------------------------------------------------

namespace Home\Controller;
use Ucenter\Api\Uc;
/**
 * Discuz论坛Ucenter同步控制器
 */
class ApiController extends Uc {
	function index(){
        $this->response();
    }
}