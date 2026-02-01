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

use app\system\model\SystemSupplier as SupplierModel;

/**
 * 后台用户、角色控制器
 * @package app\system\admin
 */
class Supplier extends Admin
{
    public    $tabData   = [];
    protected $hisiTable = 'SystemDelivery';

    /**
     * 初始化方法
     */
    protected function initialize()
    {
        parent::initialize();

    }

    /**
     * 用户管理
     * @return mixed
     * @author 橘子俊 <364666827@qq.com>
     */
    public function index($q = '')
    {
        if ($this->request->isAjax()) {
            $where = $data = [];
            $page  = $this->request->param('page/d', 1);
            $limit = $this->request->param('limit/d', 15);

            $supplierName = $this->request->param('supplier_name/s');
            if ($supplierName) {
                $where[] = ['supplier_name', 'like', "%{$supplierName}%"];
            }

            $data['data'] = SupplierModel::where($where)->page($page)->limit($limit)->select();
            $data['count'] = SupplierModel::where($where)->count('id');
            $data['code']  = 0;
            $data['msg']   = '';
            return json($data);
        }

        $assign                = [];
        $assign['hisiTabData'] = $this->tabData;
        $assign['hisiTabType'] = 1;
        //$assign['roles'] = RoleModel::column('id,name');
        return $this->assign($assign)->fetch();
    }


    /**
     * 添加用户
     * @return mixed
     * @author 橘子俊 <364666827@qq.com>
     */
    public function add()
    {
        if ($this->request->isPost()) {

            $data = $this->request->post();

            if (!SupplierModel::create($data)) {
                return $this->error('添加失败');
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
     * @return mixed
     * @author 橘子俊 <364666827@qq.com>
     */
    public function edit($id = 0)
    {
        if ($this->request->isPost()) {
            $data    = $this->request->post();

            if (!SupplierModel::update($data)) {
                return $this->error('修改失败');
            }
            $url = url('system/material/index');
            return $this->success('修改成功', $url);
        }

        $row = SupplierModel::where('id', $id)->find()->toArray();

        $this->assign('formData', $row);
        return $this->fetch('form');
    }


    /**
     * 删除用户
     * @param int $id
     * @return mixed
     * @author 橘子俊 <364666827@qq.com>
     */
    public function del()
    {
        $ids   = $this->request->param('id/a');
        $model = new SupplierModel();
        if ($model->del($ids)) {
            return $this->success('删除成功');
        }
        return $this->error($model->getError());
    }

}
