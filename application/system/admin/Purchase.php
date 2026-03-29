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

namespace app\system\admin;

use app\system\model\SystemPurchaseOrder as PurchaseModel;
use app\system\model\SystemProduct as ProductModel;

/**
 * 后台用户、角色控制器
 * @package app\system\admin
 */
class Purchase extends Admin
{
    public $tabData = [];
    protected $hisiTable = 'SystemPurchase';
    /**
     * 初始化方法
     */
    protected function initialize()
    {
        parent::initialize();

    }

    /**
     * 用户管理
     * @author 橘子俊 <364666827@qq.com>
     * @return mixed
     */
    public function index($q = '')
    {
        if ($this->request->isAjax()) {
            $where      = $data = [];
            $page       = $this->request->param('page/d', 1);
            $limit      = $this->request->param('limit/d', 15);

			$supplier  = $this->request->param('supplier/s');
            if ($supplier) {
                $where[] = ['supplier', '=', "{$supplier}"];
            }
			$catalog  = $this->request->param('catalog/s');
            if ($catalog) {
                $where[] = ['catalog', '=', "{$catalog}"];
            }
            $this->appendCtimeToWhere($where, 'ctime');

            $data['data'] = PurchaseModel::where($where)->page($page)->limit($limit)->select();

            $data['count'] = PurchaseModel::where($where)->count('id');
            $data['code'] = 0;
            $data['msg'] = '';
            return json($data);
        }

        $assign = [];
        $assign['hisiTabData'] = $this->tabData;
        $assign['hisiTabType'] = 1;
        //$assign['roles'] = RoleModel::column('id,name');
        return $this->assign($assign)->fetch();
    }

   

    /**
     * 添加用户
     * @author 橘子俊 <364666827@qq.com>
     * @return mixed
     */
    public function add()
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();
           
			$where=[];
			$where[] = ['catalog', '=', "{$data['catalog']}"];
            $result = ProductModel::where($where)->find();
			if(!$result) {
                return $this->error("货号不存在，请重新输入");
            }
            try {
                $lastId = PurchaseModel::order('id desc')->value('id');

                $data['purchase_no'] = $this->generateOrderNo($lastId +1);

                if (!PurchaseModel::create($data)) {
                    return $this->error('添加失败');
                }
            } catch (\Exception $e) {
                dump($e->getMessage());
            }

            return $this->success('保存成功', url('index'));
        }
		$formData = [];

        $this->assign('formData', $formData);
        return $this->fetch('form');
    }

    /**
     * 修改用户
     * @param int $id
     * @author 橘子俊 <364666827@qq.com>
     * @return mixed
     */
    public function edit($id = 0)
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();  
            $where[] = ['catalog', '=', "{$data['catalog']}"];
            $result = PurchaseModel::where($where)->find();
			//echo ProductModel::getLastSql();exit;
			if(!$result) {
                return $this->error("货号不存在，请重新输入");
            }

            if (!PurchaseModel::update($data)) {
                return $this->error('修改失败');
            }
			$url = url('system/material/index');
            return $this->success('修改成功',$url);
        }

        $row = PurchaseModel::where('id', $id)->find()->toArray();

        $this->assign('formData', $row);
        return $this->fetch('form');
    }

   
    /**
     * 删除用户
     * @param int $id
     * @author 橘子俊 <364666827@qq.com>
     * @return mixed
     */
    public function del()
    {
        $ids   = $this->request->param('id/a');
        $model = new PurchaseModel();
        if ($model->del($ids)) {
            return $this->success('删除成功');
        }
        return $this->error($model->getError());
    }

    private function generateOrderNo($id)
    {
        // 1. 获取当前年月
        $yearMonth = date('Ym'); // 如：202401

        // 2. 将ID补0到10位
        $paddedId = str_pad($id, 10, '0', STR_PAD_LEFT);

        // 3. 组合并返回16位单号
        return $yearMonth . $paddedId;
    }
}
