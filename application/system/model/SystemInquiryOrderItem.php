<?php
namespace app\system\model;

use think\Model;

class SystemInquiryOrderItem extends Model
{
    protected $createTime = 'ctime';
    protected $updateTime = 'mtime';
    protected $autoWriteTimestamp = true;

    public function inquiryOrder()
    {
        return $this->belongsTo(SystemInquiryOrder::class, 'inquiry_order_id', 'id');
    }
}
