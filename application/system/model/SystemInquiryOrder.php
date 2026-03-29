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

/**
 * 后台用户模型
 * @package app\system\model
 */
class SystemInquiryOrder extends Model
{
    protected $createTime = 'ctime';
    protected $updateTime = 'mtime';
    protected $autoWriteTimestamp = true;

    public function items()
    {
        return $this->hasMany(SystemInquiryOrderItem::class, 'inquiry_order_id', 'id');
    }

    /**
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
                SystemInquiryOrderItem::where('inquiry_order_id', $v)->delete();
                self::where('id', $v)->delete();
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
            SystemInquiryOrderItem::where('inquiry_order_id', $id)->delete();
            self::where('id', $id)->delete();
        }
        return true;
    }
}
