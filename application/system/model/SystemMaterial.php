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
namespace app\system\model;

use think\Model;
use app\system\model\SystemUser as UserModel;
/**
 * 后台用户模型
 * @package app\system\model
 */
class SystemMaterial extends Model
{
    // 定义时间戳字段名
    protected $createTime = 'ctime';
    protected $updateTime = 'mtime';

    // 自动写入时间戳
    protected $autoWriteTimestamp = true;

    
    /**
     * 删除用户
     * @param string $id 用户ID
     * @author 橘子俊 <364666827@qq.com>
     * @return bool
     */
    public function del($id = 0) 
    {
        if (is_array($id)) {
            $error = '';
            foreach ($id as $k => $v) {
                if ($v <= 0) {
                    $error .= '参数传递错误['.$v.']！<br>';
                    continue;
                }
                $map = [];
                $map['id'] = $v;
                // 删除用户
                self::where($map)->delete();
            }
            if ($error) {
                $this->error = $error;
                return false;
            }
        } else {
            $id = (int)$id;
            if ($id <= 0) {
                $this->error = '参数传递错误！';
                return false;
            }
            $map = [];
            $map['id'] = $id;
            // 删除用户
            self::where($map)->delete();
        }
        return true;
    }
	public static function getcOption($id = 0)
    {
		$sql = "SELECT id,username,nick FROM hisi_system_user WHERE FIND_IN_SET('5',`role_id`)";
        $rows = UserModel::query($sql);
         $str = '<option value="">请选择</option>';
        foreach ($rows as $k => $v) {
            if ($id == $v['id']) {
                $str .= '<option value="'.$v['id'].'" selected>'.$v['nick'].'</option>';
            } else {
                $str .= '<option value="'.$v['id'].'">'.$v['nick'].'</option>';
            }
        }
        return $str;
    }
  public static function getgOption($id = 0)
    {
        $sql = "SELECT id,username,nick FROM hisi_system_user WHERE FIND_IN_SET('6',`role_id`)";
        $rows = UserModel::query($sql);
         $str = '<option value="">请选择</option>';
        foreach ($rows as $k => $v) {
            if ($id == $v['id']) {
                $str .= '<option value="'.$v['id'].'" selected>'.$v['nick'].'</option>';
            } else {
                $str .= '<option value="'.$v['id'].'">'.$v['nick'].'</option>';
            }
        }
        return $str;
    }
	public static function getdOption($id = 0)
    {
        $sql = "SELECT id,username,nick FROM hisi_system_user WHERE FIND_IN_SET('12',`role_id`)";
        $rows = UserModel::query($sql);
        $str = '<option value="">请选择</option>';
        foreach ($rows as $k => $v) {
            if ($id == $v['id']) {
                $str .= '<option value="'.$v['id'].'" selected>'.$v['nick'].'</option>';
            } else {
                $str .= '<option value="'.$v['id'].'">'.$v['nick'].'</option>';
            }
        }
        return $str;
    }
}
