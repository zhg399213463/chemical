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

use app\system\model\SystemMaterial as MaterialModel;
use app\system\model\SystemProduct as ProductModel;
use app\system\model\SystemUser as UserModel;

/**
 * 后台用户、角色控制器
 * @package app\system\admin
 */
class Material extends Admin
{
    public    $tabData   = [];
    protected $hisiTable = 'SystemMaterial';

    /**
     * 初始化方法
     */
    protected function initialize()
    {
        parent::initialize();
        $userInfo       = session('admin_user');
        $this->userInfo = $userInfo;
        //var_dump($this->userInfo);exit;
    }

    /**
     * 用户管理
     * @return mixed
     * @author 橘子俊 <364666827@qq.com>
     */
    public function index($q = '')
    {
        if ($this->request->isAjax()) {
            $where = $this->buildMaterialSearchWhere();
            $this->appendCtimeToWhere($where, 'a.ctime');
            $page  = $this->request->param('page/d', 1);
            $limit = $this->request->param('limit/d', 15);
            $acceptOptions = [
                0   => ''
                , 1 => '接收'
                , 2 => '不接收，换货或重新采购'
                , 3 => '不接收,退货或不再订购'
            ];
            $resultArray   = array();
            $list          = MaterialModel::alias('a')
                ->join('hisi_system_product b ', 'b.catalog = a.catalog', 'left')
                ->field('a.*,b.name,b.ename,b.struture,b.cas,b.mdl,b.purity,b.mf,b.mw')
                ->where($where)->page($page)->limit($limit)->select();
            foreach ($list as $tem_obj) {
                if ($tem_obj['if_store'] == 1)
                    $store_name = "是";
                else
                    $store_name = "否";
                $if_accept              = $tem_obj['if_accept'];
                $accept_name            = $acceptOptions[$if_accept];
                $tem_obj['store_name']  = $store_name;
                $tem_obj['accept_name'] = $accept_name;

                array_push($resultArray, $tem_obj);
            }
            $data['data']  = $resultArray;
            $data['count'] = MaterialModel::alias('a')
                ->join('hisi_system_product b ', 'b.catalog = a.catalog', 'left')
                ->where($where)->count('a.id');
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
     * 原料分析列表/导出共用筛选（不含添加时间）
     * @return array
     */
    private function buildMaterialSearchWhere()
    {
        $where = [];
        $name = $this->request->param('name/s');
        if ($name) {
            $where[] = ['b.name', 'like', "%{$name}%"];
        }
        $ename = $this->request->param('ename/s');
        if ($ename) {
            $where[] = ['b.ename', 'like', "%{$ename}%"];
        }
        $cas = $this->request->param('cas/s');
        if ($cas) {
            $where[] = ['b.cas', '=', "{$cas}"];
        }
        $smiles = $this->request->param('smiles/s');
        if ($smiles) {
            $where[] = ['b.smiles', '=', "{$smiles}"];
        }
        $mdl = $this->request->param('mdl/s');
        if ($mdl) {
            $where[] = ['b.mdl', '=', "{$mdl}"];
        }
        $inchikey = $this->request->param('inchikey/s');
        if ($inchikey) {
            $where[] = ['b.inchikey', '=', "{$inchikey}"];
        }
        $catalog = $this->request->param('catalog/s');
        if ($catalog) {
            $where[] = ['a.catalog', '=', "{$catalog}"];
        }
        return $where;
    }

    /**
     * 添加用户
     * @return mixed
     * @author 橘子俊 <364666827@qq.com>
     */
    public function add()
    {
        if ($this->request->isPost()) {
            $data    = $this->request->post();
            $where   = [];
            $where[] = ['catalog', '=', "{$data['catalog']}"];
            $result  = ProductModel::where($where)->find();
            //echo ProductModel::getLastSql();exit;
            if (!$result) {
                return $this->error("货号不存在，请重新输入");
            }
            $where   = [];
            $where[] = ['catalog', '=', "{$data['catalog']}"];
            $where[] = ['if_accept', '=', '1'];
            $mInfo   = MaterialModel::where($where)->find();
            if ($mInfo) {
                $data['last_num'] = $mInfo['nmr_num'];
            }
            $data['uid'] = $this->userInfo['uid'];
            $batch_num   = '';
            if ($data['if_store'] == 1) {
                $nowtime   = date("Ymd");
                $tem       = decoct($nowtime);
                $batch_num = dechex($tem);
            } else if ($data['if_accept'] == 1) {
                $nowtime   = date("Ymd");
                $tem       = decoct($nowtime);
                $batch_num = dechex($tem);
            }
            $data['batch_num']         = $batch_num;
            $purchaser                 = $data['purchaser'];
            $merchandiser              = $data['merchandiser'];
            $user_name                 = $data['user_name'];
            $uid                       = $data['uid'];
            $caigou_info               = UserModel::where("id=$purchaser")->field("id,username,nick,mobile,email")->find();
            $gendan_info               = UserModel::where("id=$merchandiser")->field("id,username,nick,mobile,email")->find();
            $dinggou_info              = UserModel::where("id=$user_name")->field("id,username,nick,mobile,email")->find();
            $data['purchaser_name']    = $caigou_info['nick'];
            $data['purchaser_tel']     = $caigou_info['mobile'];
            $data['merchandiser_name'] = $gendan_info['nick'];
            $data['merchandiser_tel']  = $gendan_info['mobile'];
            $data['user_nick']         = $dinggou_info['nick'];
            $data['user_tel']          = $dinggou_info['mobile'];

            $caigou_super            = UserModel::where("role_id=4")->field("id,username,nick,mobile,email")->find();
            $cangku_super            = UserModel::where("role_id=7")->field("id,username,nick,mobile,email")->find();
            $dinggou_super           = UserModel::where("role_id=10")->field("id,username,nick,mobile,email")->find();
            $shouhuo_info            = UserModel::where("id=$uid")->field("id,username,nick,mobile,email")->find();
            $data['purchaser_super'] = $caigou_super['nick'];
            $data['house_super']     = $cangku_super['nick'];
            $data['user_super']      = $dinggou_super['nick'];
            $data['recevier_name']   = $shouhuo_info['nick'];
            if (!MaterialModel::create($data)) {
                return $this->error('添加失败');
            }
            return $this->success('添加成功', url('index'));
        }
        $formData      = [];
        $acceptOptions = [
            0   => '请选择'
            , 1 => '接收'
            , 2 => '不接收，换货或重新采购'
            , 3 => '不接收,退货或不再订购'
        ];
        $str           = '';
        foreach ($acceptOptions as $k => $v) {
            $str .= '<option value="' . $k . '">' . $v . '</option>';
        }
        $caiOptions  = MaterialModel::getcOption();
        $genOptions  = MaterialModel::getgOption();
        $dingOptions = MaterialModel::getdOption();
        $this->assign('formData', $formData);
        $this->assign('acceptOptions', $str);
        $this->assign('caiOptions', $caiOptions);
        $this->assign('genOptions', $genOptions);
        $this->assign('dingOptions', $dingOptions);
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
            $where[] = ['catalog', '=', "{$data['catalog']}"];
            $result  = ProductModel::where($where)->find();
            //echo ProductModel::getLastSql();exit;
            if (!$result) {
                return $this->error("货号不存在，请重新输入");
            }
            $mId   = $data['id'];
            $mInfo = MaterialModel::where("id=$mId")->find()->toArray();
            //var_dump($mInfo);exit;
            if (!$mInfo['batch_num']) {
                if ($data['if_store'] == 1) {
                    $nowtime   = date("Ymd");
                    $tem       = decoct($nowtime);
                    $batch_num = dechex($tem);
                } else if ($data['if_accept'] == 1) {
                    $nowtime   = date("Ymd");
                    $tem       = decoct($nowtime);
                    $batch_num = dechex($tem);
                }
                $data['batch_num'] = $batch_num;
            }
            $purchaser                 = $data['purchaser'];
            $merchandiser              = $data['merchandiser'];
            $user_name                 = $data['user_name'];
            $uid                       = $this->userInfo['uid'];
            $caigou_info               = UserModel::where("id=$purchaser")->field("id,username,nick,mobile,email")->find();
            $gendan_info               = UserModel::where("id=$merchandiser")->field("id,username,nick,mobile,email")->find();
            $dinggou_info              = UserModel::where("id=$user_name")->field("id,username,nick,mobile,email")->find();
            $data['purchaser_name']    = $caigou_info['nick'];
            $data['purchaser_tel']     = $caigou_info['mobile'];
            $data['merchandiser_name'] = $gendan_info['nick'];
            $data['merchandiser_tel']  = $gendan_info['mobile'];
            $data['user_nick']         = $dinggou_info['nick'];
            $data['user_tel']          = $dinggou_info['mobile'];

            $caigou_super            = UserModel::where("role_id=4")->field("id,username,nick,mobile,email")->find();
            $cangku_super            = UserModel::where("role_id=7")->field("id,username,nick,mobile,email")->find();
            $dinggou_super           = UserModel::where("role_id=10")->field("id,username,nick,mobile,email")->find();
            $shouhuo_info            = UserModel::where("id=$uid")->field("id,username,nick,mobile,email")->find();
            $data['purchaser_super'] = $caigou_super['nick'] ?? '';
            $data['house_super']     = $cangku_super['nick'] ?? '';
            $data['user_super']      = $dinggou_super['nick'] ?? '';
            $data['recevier_name']   = $shouhuo_info['nick'] ?? '';
            if (!MaterialModel::update($data)) {
                return $this->error('修改失败');
            }
            $url = url('system/material/index');
            return $this->success('修改成功', $url);
        }

        $row           = MaterialModel::where('id', $id)->find()->toArray();
        $acceptOptions = [
            0   => '请选择'
            , 1 => '接收'
            , 2 => '不接收，换货或重新采购'
            , 3 => '不接收,退货或不再订购'
        ];
        $str           = '';
        foreach ($acceptOptions as $k => $v) {
            $str .= '<option value="' . $k . '">' . $v . '</option>';
        }

        $caiOptions  = MaterialModel::getcOption($row['purchaser']);
        $genOptions  = MaterialModel::getgOption($row['merchandiser']);
        $dingOptions = MaterialModel::getdOption($row['user_name']);
        $this->assign('acceptOptions', $str);
        $this->assign('caiOptions', $caiOptions);
        $this->assign('genOptions', $genOptions);
        $this->assign('dingOptions', $dingOptions);
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
        $model = new MaterialModel();
        if ($model->del($ids)) {
            return $this->success('删除成功');
        }
        return $this->error($model->getError());
    }

    public function fileInfo()
    {
        $jsonText = _find_param_key('json_text');
        if (!isNullOrEmpty($jsonText)) {
            $jsonData = analyJson($jsonText);
            $id       = $jsonData['id'];
            $info     = MaterialModel::where('id', $id)->find()->toArray();
            //var_dump($jsonData['id']);exit;
        }
        returnResultObj($info);
    }

    public function saveData()
    {
        $jsonText     = _find_param_key('json_text');
        $resultAction = 0;
        if (!isNullOrEmpty($jsonText)) {
            $jsonData = analyJson($jsonText);
            //var_dump($jsonData);exit;
            $resultAction = MaterialModel::update($jsonData);
        }
        if ($resultAction)
            $resultAction = 1;
        //var_dump($resultAction);exit;
        returnResultAction($resultAction);
    }

    public function uploadFile()
    {
        if (isset($_FILES['file'])) {
            $file = $_FILES['file']["tmp_name"];
            //var_dump($file);
            $data = $this->importExecl($file);
            //var_dump($data);exit;
            $str = '';
            foreach ($data as $tem_obj) {
                $new_data                      = array();
                $new_data['test_num']          = $tem_obj['A'];
                $new_data['catalog']           = $tem_obj['B'];
                $new_data['file']              = $tem_obj['C'];
                $new_data['file_size']         = $tem_obj['D'];
                $new_data['file_name']         = $tem_obj['E'];
                $new_data['uid']               = $tem_obj['F'];
                $new_data['nmr_num']           = $tem_obj['G'];
                $new_data['nmr_method']        = $tem_obj['H'];
                $new_data['po_num']            = $tem_obj['I'];
                $new_data['results']           = $tem_obj['J'];
                $new_data['if_store']          = $tem_obj['K'];
                $new_data['last_num']          = $tem_obj['L'];
                $new_data['appearance']        = $tem_obj['M'];
                $new_data['order_amount']      = $tem_obj['N'];
                $new_data['optical']           = $tem_obj['O'];
                $new_data['optical_result']    = $tem_obj['P'];
                $new_data['ee']                = $tem_obj['Q'];
                $new_data['ee_result']         = $tem_obj['R'];
                $new_data['hplc_result']       = $tem_obj['S'];
                $new_data['gc_result']         = $tem_obj['T'];
                $new_data['ms_result']         = $tem_obj['U'];
                $new_data['if_accept']         = $tem_obj['V'];
                $new_data['purchaser']         = $tem_obj['W'];
                $new_data['merchandiser']      = $tem_obj['X'];
                $new_data['supplier']          = $tem_obj['Y'];
                $new_data['user_name']         = $tem_obj['Z'];
                $new_data['water_content']     = $tem_obj['AA'];
                $new_data['ph_num']            = $tem_obj['AB'];
                $new_data['melting_point']     = $tem_obj['AC'];
                $new_data['batch_num']         = $tem_obj['AD'];
                $new_data['purchaser_tel']     = $tem_obj['AE'];
                $new_data['merchandiser_tel']  = $tem_obj['AF'];
                $new_data['user_tel']          = $tem_obj['AG'];
                $new_data['purchaser_name']    = $tem_obj['AH'];
                $new_data['merchandiser_name'] = $tem_obj['AI'];
                $new_data['user_nick']         = $tem_obj['AJ'];
                $new_data['purchaser_super']   = $tem_obj['AK'];
                $new_data['house_super']       = $tem_obj['AL'];
                $new_data['user_super']        = $tem_obj['AM'];
                $new_data['recevier_name']     = $tem_obj['AN'];
                $new_data['remark']            = $tem_obj['AO'];
                //var_dump($new_data);exit;
                if ($new_data['catalog']) {
                    $where   = [];
                    $where[] = ['catalog', '=', "{$new_data['catalog']}"];
                    $result  = ProductModel::where($where)->find();
                    if (!$result) {
                        $str .= $new_data['catalog'] . ',';
                    } else {
                        $resultAction = MaterialModel::create($new_data);
                    }
                } else {
                    returnJson_Error("导入的.xlsx文件没有货号！");
                }
            }
            $str  = substr($str, 0, -1);
            $info = '批量添加成功，不存在货号' . $str;
            returnJson_Success($info);
        } else {
            returnJson_Error("请选择要导入的.xlsx文件！");
        }
    }

    /**
     * 数据导入
     * @param string $file excel文件
     * @param string $sheet
     * @return string   返回解析数据
     * @throws PHPExcel_Exception
     * @throws PHPExcel_Reader_Exception
     */
    private function importExecl($file = '', $sheet = 0)
    {

        $file = iconv("utf-8", "gbk", $file);   //转码

        if (empty($file) or !file_exists($file)) {
            die('file not exists!');
        }
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHPExcel/Classes/PHPExcel.php'; //引入PHP EXCEL类
        $objRead = new \PHPExcel_Reader_Excel2007();   //建立reader对象
        if (!$objRead->canRead($file)) {
            $objRead = new \PHPExcel_Reader_Excel5();
            if (!$objRead->canRead($file)) {
                die('No Excel!');
            }
        }
        $cellName  = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');
        $obj       = $objRead->load($file);  //建立excel对象
        $currSheet = $obj->getSheet($sheet);   //获取指定的sheet表
        $columnH   = $currSheet->getHighestColumn();   //取得最大的列号
        $columnCnt = array_search($columnH, $cellName);
        $rowCnt    = $currSheet->getHighestRow();   //获取总行数
        $data      = array();
        for ($_row = 2; $_row <= $rowCnt; $_row++) {  //读取内容
            for ($_column = 0; $_column <= $columnCnt; $_column++) {
                $cellId    = $cellName[$_column] . $_row;
                $cellValue = $currSheet->getCell($cellId)->getValue();
                //$cellValue = $currSheet->getCell($cellId)->getCalculatedValue();  #获取公式计算的值
                if ($cellValue instanceof PHPExcel_RichText) {   //富文本转换字符串
                    $cellValue = $cellValue->__toString();
                }
                $data[$_row][$cellName[$_column]] = $cellValue;
            }
        }
        return $data;
    }

    public function download()
    {
        $title = [
            0    => '送检单号'
            , 1  => '货号'
            , 2  => '分析谱图'
            , 3  => '文件大小'
            , 4  => '文件名称'
            , 5  => '收货人ID'
            , 6  => '核磁编号'
            , 7  => '核磁检测方法'
            , 8  => 'PO单号'
            , 9  => '分析结论'
            , 10 => '是否入库'
            , 11 => '最近一次核磁编号'
            , 12 => '订购数量'
            , 13 => '旋光检测条件'
            , 14 => '旋光检测结果'
            , 15 => 'EE% 检测条件'
            , 16 => 'EE% 结果'
            , 17 => 'HPLC结果'
            , 18 => 'GC结果'
            , 19 => 'MS结果'
            , 20 => '是否接收'
            , 21 => '采购员'
            , 22 => '跟单员'
            , 23 => '供应商名称'
            , 24 => '订购人'
            , 25 => '含水量'
            , 26 => 'PH值'
            , 27 => '熔点'
            , 28 => '批号'
            , 29 => '采购员电话'
            , 30 => '跟单员电话'
            , 31 => '订购人电话'
            , 32 => '采购员名'
            , 33 => '跟单员名'
            , 34 => '订购人名'
            , 35 => '采购员主管'
            , 36 => '仓库主管'
            , 37 => '订购人主管'
            , 38 => '收货人名'
            , 39 => 'HPLC'
            , 40 => 'GC'
            , 41 => '备注'
        ];
        $where = $this->buildMaterialSearchWhere();
        $this->appendCtimeToWhere($where, 'a.ctime');
        $acceptOptions = [
            0 => '',
            1 => '接收',
            2 => '不接收，换货或重新采购',
            3 => '不接收,退货或不再订购',
        ];
        $exportLimit = 50000;
        $list          = MaterialModel::alias('a')
            ->join('hisi_system_product b ', 'b.catalog = a.catalog', 'left')
            ->field('a.*,b.name,b.ename,b.struture,b.cas,b.mdl,b.purity,b.mf,b.mw,b.hplc,b.gc')
            ->where($where)->limit($exportLimit)->select();
        $resultArray = [];
        foreach ($list as $tem_obj) {
            $r = $tem_obj instanceof \think\Model ? $tem_obj->toArray() : (array)$tem_obj;
            $store_name  = (isset($r['if_store']) && (int)$r['if_store'] === 1) ? '是' : '否';
            $if_accept   = isset($r['if_accept']) ? (int)$r['if_accept'] : 0;
            $accept_name = isset($acceptOptions[$if_accept]) ? $acceptOptions[$if_accept] : '';
            $data        = [];
            $data['A']   = $r['test_num'] ?? '';
            $data['B']   = $r['catalog'] ?? '';
            $data['C']   = $r['file'] ?? '';
            $data['D']   = $r['file_size'] ?? '';
            $data['E']   = $r['file_name'] ?? '';
            $data['F']   = $r['uid'] ?? '';
            $data['G']   = $r['nmr_num'] ?? '';
            $data['H']   = $r['nmr_method'] ?? '';
            $data['I']   = $r['po_num'] ?? '';
            $data['J']   = $r['results'] ?? '';
            $data['K']   = $store_name;
            $data['L']   = $r['last_num'] ?? '';
            $data['M']   = $r['order_amount'] ?? '';
            $data['N']   = $r['optical'] ?? '';
            $data['O']   = $r['optical_result'] ?? '';
            $data['P']   = $r['ee'] ?? '';
            $data['Q']   = $r['ee_result'] ?? '';
            $data['R']   = $r['hplc_result'] ?? '';
            $data['S']   = $r['gc_result'] ?? '';
            $data['T']   = $r['ms_result'] ?? '';
            $data['U']   = $accept_name;
            $data['V']   = $r['purchaser'] ?? '';
            $data['W']   = $r['merchandiser'] ?? '';
            $data['X']   = $r['supplier'] ?? '';
            $data['Y']   = $r['user_name'] ?? '';
            $data['Z']   = $r['water_content'] ?? '';
            $data['AA']  = $r['ph_num'] ?? '';
            $data['AB']  = $r['melting_point'] ?? '';
            $data['AC']  = $r['batch_num'] ?? '';
            $data['AD']  = $r['purchaser_tel'] ?? '';
            $data['AE']  = $r['merchandiser_tel'] ?? '';
            $data['AF']  = $r['user_tel'] ?? '';
            $data['AG']  = $r['purchaser_name'] ?? '';
            $data['AH']  = $r['merchandiser_name'] ?? '';
            $data['AI']  = $r['user_nick'] ?? '';
            $data['AJ']  = $r['purchaser_super'] ?? '';
            $data['AK']  = $r['house_super'] ?? '';
            $data['AL']  = $r['user_super'] ?? '';
            $data['AM']  = $r['recevier_name'] ?? '';
            $data['AN']  = $r['hplc'] ?? '';
            $data['AO']  = $r['gc'] ?? '';
            $data['AP']  = $r['remark'] ?? '';
            $resultArray[] = $data;
        }
        $fileName = date("YmdHis") . "material";
        $this->exportExcel($title, $resultArray, $fileName, './', true);
    }

    /**
     * 数据导出
     * @param array  $title 标题行名称
     * @param array  $data 导出数据
     * @param string $fileName 文件名
     * @param string $savePath 保存路径
     * @param        $type   是否下载  false--保存   true--下载
     * @return string   返回文件全路径
     * @throws PHPExcel_Exception
     * @throws PHPExcel_Reader_Exception
     */
    function exportExcel($title = array(), $data = array(), $fileName = '', $savePath = './', $isDown = false)
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHPExcel/Classes/PHPExcel.php'; //引入PHP EXCEL类
        $obj = new \PHPExcel();
        //横向单元格标识
        $cellName = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');
        $obj->getActiveSheet(0)->setTitle('sheet名称');   //设置sheet名称
        $_row = 1;   //设置纵向单元格标识
        if ($title) {
            $_cnt = count($title);
            $obj->getActiveSheet(0)->mergeCells('A' . $_row . ':' . $cellName[$_cnt - 1] . $_row);   //合并单元格
            $obj->setActiveSheetIndex(0)->setCellValue('A' . $_row, '数据导出：' . date('Y-m-d H:i:s'));  //设置合并后的单元格内容
            $_row++;
            $i = 0;
            foreach ($title as $v) {   //设置列标题
                $obj->setActiveSheetIndex(0)->setCellValue($cellName[$i] . $_row, $v);
                $i++;
            }
            $_row++;
        }
        //填写数据
        if ($data) {
            $i = 0;
            foreach ($data as $_v) {
                $j = 0;
                foreach ($_v as $_cell) {
                    $obj->getActiveSheet(0)->setCellValue($cellName[$j] . ($i + $_row), $_cell);
                    $j++;
                }
                $i++;
            }
        }
        //文件名处理
        if (!$fileName) {
            $fileName = uniqid(time(), true);
        }
        $objWrite = \PHPExcel_IOFactory::createWriter($obj, 'Excel2007');
        if ($isDown) {   //网页下载
            header('pragma:public');
            header("Content-Disposition:attachment;filename=$fileName.xlsx");
            $objWrite->save('php://output');
            exit;
        }
        $_fileName = iconv("utf-8", "gb2312", $fileName);   //转码
        $_savePath = $savePath . $_fileName . '.xlsx';
        $objWrite->save($_savePath);
        return $savePath . $fileName . '.xlsx';
    }
}
