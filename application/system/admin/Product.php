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

use app\system\model\SystemProduct as ProductModel;


/**
 * 后台用户、角色控制器
 * @package app\system\admin
 */
class Product extends Admin
{
    public $tabData = [];
    protected $hisiTable = 'SystemProduct';
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
            $where = $this->buildProductSearchWhere();
            $this->appendCtimeToWhere($where, 'ctime');
            $page  = $this->request->param('page/d', 1);
            $limit = $this->request->param('limit/d', 15);
            $data['data'] = ProductModel::where($where)->page($page)->limit($limit)->select();
            $data['count'] = ProductModel::where($where)->count('id');
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
     * 产品列表/导出共用筛选（不含添加时间）
     * @return array
     */
    private function buildProductSearchWhere()
    {
        $where = [];
        $name = $this->request->param('name/s');
        if ($name) {
            $where[] = ['name', 'like', "%{$name}%"];
        }
        $ename = $this->request->param('ename/s');
        if ($ename) {
            $where[] = ['ename', 'like', "%{$ename}%"];
        }
        $cas = $this->request->param('cas/s');
        if ($cas) {
            $where[] = ['cas', '=', "{$cas}"];
        }
        $smiles = $this->request->param('smiles/s');
        if ($smiles) {
            $where[] = ['smiles', '=', "{$smiles}"];
        }
        $mdl = $this->request->param('mdl/s');
        if ($mdl) {
            $where[] = ['mdl', '=', "{$mdl}"];
        }
        $inchikey = $this->request->param('inchikey/s');
        if ($inchikey) {
            $where[] = ['inchikey', '=', "{$inchikey}"];
        }
        $catalog = $this->request->param('catalog/s');
        if ($catalog) {
            $where[] = ['catalog', '=', "{$catalog}"];
        }
        return $where;
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
            // 验证
            $result = $this->validate($data, 'SystemProduct');
            if($result !== true) {
                return $this->error($result);
            }
			$where=[];
			$where[] = ['cas', '=', "{$data['cas']}"];
			$where[] = ['purity', '=', "{$data['purity']}"];
            $result = ProductModel::where($where)->find();
			
			if($result) {
				$catalog = $result['catalog'];
                return $this->error("$catalog 已存在");
            }
			
            if (!ProductModel::create($data)) {
                return $this->error('添加失败');
            }
			$url = url('system/product/index');
            return $this->success('添加成功',$url);
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
            // 验证
            $result = $this->validate($data, 'SystemProduct.update');
            if($result !== true) {
                return $this->error($result);
            }


            if (!ProductModel::update($data)) {
                return $this->error('修改失败');
            }
            return $this->success('修改成功');
        }

        $row = ProductModel::where('id', $id)->find()->toArray();

       
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
        $model = new ProductModel();
        if ($model->del($ids)) {
            return $this->success('删除成功');
        }
        return $this->error($model->getError());
    }

   public function uploadFile(){
		if(isset($_FILES['file']))
		{
			$file=$_FILES['file']["tmp_name"];
			//var_dump($file);
			$data=$this->importExecl($file);
			//var_dump($data);exit;
			$str = '';
			foreach($data as $tem_obj){
				$new_data = array();
				$new_data['catalog']=$tem_obj['A'];
				$new_data['name']=$tem_obj['B'];
				$new_data['ename']=$tem_obj['C'];
				$new_data['cas']=$tem_obj['D'];
				$new_data['mdl']=$tem_obj['E'];
				$new_data['purity']=$tem_obj['G'];
				$new_data['mf']=$tem_obj['H'];
				$new_data['mw']=$tem_obj['I'];
				$new_data['smiles']=$tem_obj['J'];
				$new_data['inchi']=$tem_obj['K'];
				$new_data['inchikey']=$tem_obj['L'];
				$new_data['ghs']=$tem_obj['M'];
				$new_data['store']=$tem_obj['N'];
				$new_data['transport']=$tem_obj['O'];
				$new_data['physical_trait']=$tem_obj['P'];
				$new_data['packing_rules']=$tem_obj['Q'];
				$new_data['package']=$tem_obj['R'];
				$new_data['struture']=$tem_obj['F'];
				$new_data['nmr']=$tem_obj['S'];
				$new_data['nmrsolvent']=$tem_obj['T'];
				$new_data['hplc']=$tem_obj['U'];
				$new_data['gc']=$tem_obj['V'];
				$new_data['ms']=$tem_obj['W'];
				$new_data['ee']=$tem_obj['Y'];
				$new_data['optical']=$tem_obj['X'];
				$new_data['review']=$tem_obj['Z'];
				$new_data['remark']=$tem_obj['AA'];
				//var_dump($new_data);exit;
				if($new_data['catalog']){
					$where=[];
					$where[] = ['catalog', '=', "{$new_data['catalog']}"];
					$result = ProductModel::where($where)->find();
					if($result){
						$str .= $new_data['catalog'].',';
					}else{
						$resultAction = ProductModel::create($new_data);
					}
				}else{
					returnJson_Error("导入的.xlsx文件没有货号！");
				}
			}
			 $str = substr($str,0,-1);
			 $info = '批量添加成功，已存在货号'.$str;
			 returnJson_Success($info);
		}else{
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
	private function importExecl($file='', $sheet=0){

		//$file = iconv("utf-8", "gb2312", $file);   //转码

		if(empty($file) OR !file_exists($file)) {
			die('file not exists!');
		}
		require_once $_SERVER['DOCUMENT_ROOT'].'/PHPExcel/Classes/PHPExcel.php'; //引入PHP EXCEL类
		$objRead = new \PHPExcel_Reader_Excel2007();   //建立reader对象
		if(!$objRead->canRead($file)){
			$objRead = new \PHPExcel_Reader_Excel5();
			if(!$objRead->canRead($file)){
				die('No Excel!');
			}
		}
		$cellName = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');
		$obj = $objRead->load($file);  //建立excel对象
		$currSheet = $obj->getSheet($sheet);   //获取指定的sheet表
		$columnH = $currSheet->getHighestColumn();   //取得最大的列号
		$columnCnt = array_search($columnH, $cellName);
		$rowCnt = $currSheet->getHighestRow();   //获取总行数
		$data = array();
		for($_row=2; $_row<=$rowCnt; $_row++){  //读取内容
			for($_column=0; $_column<=$columnCnt; $_column++){
				$cellId = $cellName[$_column].$_row;
				$cellValue = $currSheet->getCell($cellId)->getValue();
				//$cellValue = $currSheet->getCell($cellId)->getCalculatedValue();  #获取公式计算的值
				if($cellValue instanceof PHPExcel_RichText){   //富文本转换字符串
					$cellValue = $cellValue->__toString();
				}
				$data[$_row][$cellName[$_column]] = $cellValue;
			}
		}
		return $data;
	}
	public function download(){
		$title=[
			 0=>'货号'
		    ,1=>'中文名称'
			,2=>'英文名称'
			,3=>'CAS'
			,4=>'MDL'
			,5=>'结构式'
			,6=>'纯度'
			,7=>'分子式'
			,8=>'分子量'
			,9=>'Smiles'
			,10=>'InChI'
			,11=>'InChIKey'
			,12=>'GHS'
			,13=>'储存条件'
			,14=>'运输条件'
			,15=>'外观'
			,16=>'分装规则'
			,17=>'包装材料'
			,18=>'核磁'
			,19=>'溶剂'
			,20=>'HPLC'
			,21=>'GC'
			,22=>'MS'
			,23=>'旋光检测'
			,24=>'EE%'
			,25=>'复检周期'
			,26=>'备注'
		];
		$where = $this->buildProductSearchWhere();
		$this->appendCtimeToWhere($where, 'ctime');
		$exportLimit = 50000;
		$list = ProductModel::where($where)->limit($exportLimit)->select();
		//var_dump($list);exit;
		$resultArray=array();
		foreach ($list as $tem_obj){
			$data = array();
			$data['A']=$tem_obj['catalog'];
			$data['B']=$tem_obj['name'];
			$data['C']=$tem_obj['ename'];
			$data['D']=$tem_obj['cas'];
			$data['E']=$tem_obj['mdl'];
			$data['G']=$tem_obj['purity'];
			$data['H']=$tem_obj['mf'];
			$data['I']=$tem_obj['mw'];
			$data['J']=$tem_obj['smiles'];
			$data['K']=$tem_obj['inchi'];
			$data['L']=$tem_obj['inchikey'];
			$data['M']=$tem_obj['ghs'];
			$data['N']=$tem_obj['store'];
			$data['O']=$tem_obj['transport'];
			$data['P']=$tem_obj['physical_trait'];
			$data['Q']=$tem_obj['packing_rules'];
			$data['R']=$tem_obj['package'];
			$data['F']=$tem_obj['struture'];
			$data['S']=$tem_obj['nmr'];
			$data['T']=$tem_obj['nmrsolvent'];
			$data['U']=$tem_obj['hplc'];
			$data['V']=$tem_obj['gc'];
			$data['W']=$tem_obj['ms'];
			$data['Y']=$tem_obj['ee'];
			$data['X']=$tem_obj['optical'];
			$data['Z']=$tem_obj['review'];
			$data['AA']=$tem_obj['remark'];
			array_push($resultArray,$data);
		}
		//var_dump($resultArray);exit;
		$fileName=date("YmdHis")."product";
		$this->exportExcel($title, $resultArray, $fileName, './', true);
	}
	 /** 
	 * 数据导出 
	 * @param array $title   标题行名称 
	 * @param array $data   导出数据 
	 * @param string $fileName 文件名 
	 * @param string $savePath 保存路径 
	 * @param $type   是否下载  false--保存   true--下载 
	 * @return string   返回文件全路径 
	 * @throws PHPExcel_Exception 
	 * @throws PHPExcel_Reader_Exception 
	 */ 
	function exportExcel($title=array(), $data=array(), $fileName='', $savePath='./', $isDown=false){  
		require_once $_SERVER['DOCUMENT_ROOT'].'/PHPExcel/Classes/PHPExcel.php'; //引入PHP EXCEL类    
		$obj = new \PHPExcel();  
		//横向单元格标识  
		$cellName = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');  
		$obj->getActiveSheet(0)->setTitle('sheet名称');   //设置sheet名称  
		$_row = 1;   //设置纵向单元格标识  
		if($title){  
			$_cnt = count($title);  
			$obj->getActiveSheet(0)->mergeCells('A'.$_row.':'.$cellName[$_cnt-1].$_row);   //合并单元格  
			$obj->setActiveSheetIndex(0)->setCellValue('A'.$_row, '数据导出：'.date('Y-m-d H:i:s'));  //设置合并后的单元格内容  
			$_row++;  
			$i = 0;  
			foreach($title AS $v){   //设置列标题  
				$obj->setActiveSheetIndex(0)->setCellValue($cellName[$i].$_row, $v);  
				$i++;  
			}  
			$_row++;  
		}  
		//填写数据  
		if($data){  
			$i = 0;  
			foreach($data AS $_v){  
				$j = 0;  
				foreach($_v AS $_cell){  
					$obj->getActiveSheet(0)->setCellValue($cellName[$j] . ($i+$_row), $_cell);  
					$j++;  
				}  
				$i++;  
			}  
		}  
		//文件名处理  
		if(!$fileName){  
			$fileName = uniqid(time(),true);  
		}  
		$objWrite = \PHPExcel_IOFactory::createWriter($obj, 'Excel2007');  
		if($isDown){   //网页下载  
			header('pragma:public');  
			header("Content-Disposition:attachment;filename=$fileName.xlsx");  
			$objWrite->save('php://output');exit;  
		}  
		$_fileName = iconv("utf-8", "gb2312", $fileName);   //转码  
		$_savePath = $savePath.$_fileName.'.xlsx';  
		$objWrite->save($_savePath);  
		return $savePath.$fileName.'.xlsx';  
	}  
	
}
