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

use app\system\model\SystemDelivery as DeliveryModel;
use app\system\model\SystemProduct as ProductModel;

/**
 * 后台用户、角色控制器
 * @package app\system\admin
 */
class Delivery extends Admin
{
    public $tabData = [];
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
     * @author 橘子俊 <364666827@qq.com>
     * @return mixed
     */
    public function index($q = '')
    {
        if ($this->request->isAjax()) {
            $where      = $data = [];
            $page       = $this->request->param('page/d', 1);
            $limit      = $this->request->param('limit/d', 15);
            $name    = $this->request->param('name/s');
            if ($name) {
                $where[] = ['name', 'like', "%{$name}%"];
            }
			$ename  = $this->request->param('ename/s');
            if ($ename) {
                $where[] = ['ename', 'like', "%{$ename}%"];
            }
			$cas  = $this->request->param('cas/s');
            if ($cas) {
                $where[] = ['b.cas', '=', "{$cas}"];
            }
			$supplier  = $this->request->param('supplier/s');
            if ($supplier) {
                $where[] = ['supplier', '=', "{$supplier}"];
            }
			$catalog  = $this->request->param('catalog/s');
            if ($catalog) {
                $where[] = ['b.catalog', '=', "{$catalog}"];
            }
	
            $data['data'] = DeliveryModel::alias('a')
					->join('hisi_system_product b ','b.catalog = a.catalog','left')
					->field('a.*,b.name,b.ename,b.struture,b.cas,b.mdl,b.purity,b.mf,b.mw,b.nmr,b.nmrsolvent')
					->where($where)->page($page)->limit($limit)->select();

            $data['count'] = DeliveryModel::alias('a')
					->join('hisi_system_product b ','b.catalog = a.catalog','left')
					->where($where)->count('a.id');
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
			
            if (!DeliveryModel::create($data)) {
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
     * @author 橘子俊 <364666827@qq.com>
     * @return mixed
     */
    public function edit($id = 0)
    {
        
        if ($this->request->isPost()) {
            $data = $this->request->post();  
            $where[] = ['catalog', '=', "{$data['catalog']}"];
            $result = ProductModel::where($where)->find();
			//echo ProductModel::getLastSql();exit;
			if(!$result) {
                return $this->error("货号不存在，请重新输入");
            }

            if (!DeliveryModel::update($data)) {
                return $this->error('修改失败');
            }
			$url = url('system/material/index');
            return $this->success('修改成功',$url);
        }

        $row = DeliveryModel::where('id', $id)->find()->toArray();

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
        $model = new DeliveryModel();
        if ($model->del($ids)) {
            return $this->success('删除成功');
        }
        return $this->error($model->getError());
    }

}
