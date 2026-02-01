<?php
// +----------------------------------------------------------------------
// | HisiPHP框架[基于ThinkPHP5.1开发]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2021 http://www.hisiphp.com
// +----------------------------------------------------------------------
// | HisiPHP承诺基础框架永久免费开源，您可用于学习和商用，但必须保留软件版权信息。
// +----------------------------------------------------------------------
// | Author: 橘子俊 <364666827@qq.com>，开发者QQ群：50304283
// +----------------------------------------------------------------------
// 后台函数库
if (!function_exists('app_status')) {
    /**
     * 应用状态
     * @param string $v 状态值
     * @author 橘子俊 <364666827@qq.com>
     * @return array|null
     */
    function app_status($v = 0) {
        $arr = [];
        $arr[0] = '未安装';
        $arr[1] = '未启用';
        $arr[2] = '已启用';

        if (isset($arr[$v])) {
            return $arr[$v];
        }
        return '';
    }
}
if (!function_exists('_find_param_key')) {
    /**
	 * 根据键值接收参数，首先以get方式获取，如果获取不到再以post方式获取
	 * @param unknown_type $key
	 * @return unknown
	 */
    function _find_param_key($key)
	{
		if(isset($_REQUEST[$key]))
			return $_REQUEST[$key];
		elseif(isset($_POST[$key]))
		return $_POST[$key];
	}
}

/**
 * 判断字符串不存在或者为空
 * @param unknown_type $str
 * @return boolean
 */
function isNullOrEmpty($str)
{
	if(isset($str))
	{
		if($str == "")
			return true;
		else
			return false;
	}
	else
		return false;
}

/**
 * 解析json串
 * @param type $json_str
 * @return type
 */
function analyJson($json_str)
{
	if(is_array($json_str))
		return $json_str;
	$json_str = str_replace('＼＼', '', $json_str);
	return json_decode($json_str, TRUE);
}

function returnJsonObj_Success($jsonObj)
{
	$resultJson = array();
	$resultJson["code"] = "0";
	$resultJson["info"] = "操作成功";
	$resultJson["data"] = $jsonObj;
	echo json_encode($resultJson);
	exit;
}

function returnJson_Error($info)
{
	$resultJson = array();
	$resultJson["code"] = "1";
	$resultJson["info"] = $info;
	echo json_encode($resultJson);
	exit;
}

function returnResultObj($resultObj)
{
	if(is_array($resultObj))
		returnJsonObj_Success($resultObj);
	else
		returnJson_Error("数据获取操作失败！");
}

function returnResultAction($resultAction,$info=null)
{
	if(!$resultAction&&$resultAction!=0)
	{
		returnJson_Error("操作失败！");
	}
	elseif(is_numeric($resultAction))
		 returnJson_Success($info);
	else
		 returnJson_Error($resultAction);
}

function returnJson_Success($info=null,$data = null)
{
	$resultJson = array();
	$resultJson["code"] = "0";
	if(!isNullOrEmpty($info)){
		$resultJson["info"] = $info;
	}else{
		$resultJson["info"] = "操作成功！";
	}
	if($data)
		$resultJson["data"] = $data;
	echo json_encode($resultJson);
	exit;
}



