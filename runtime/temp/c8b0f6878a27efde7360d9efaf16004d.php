<?php /*a:7:{s:57:"/www/chemical/application/system/view/material/index.html";i:1769266048;s:49:"/www/chemical/application/system/view/layout.html";i:1766319013;s:55:"/www/chemical/application/system/view/block/header.html";i:1766319013;s:53:"/www/chemical/application/system/view/block/menu.html";i:1766319013;s:54:"/www/chemical/application/system/view/block/layui.html";i:1766319013;s:56:"/www/chemical/application/system/view/block/layuijs.html";i:1766319013;s:55:"/www/chemical/application/system/view/block/footer.html";i:1766319013;}*/ ?>
<?php if(input('param.hisi_iframe') || cookie('hisi_iframe')): ?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlentities($hisiCurMenu['title']); ?> -  Powered by <?php echo config('hisiphp.name'); ?></title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <link rel="stylesheet" href="/static/js/layui/css/layui.css?v=<?php echo config('hisiphp.version'); ?>">
    <link rel="stylesheet" href="/static/system/css/theme.css?v=<?php echo config('hisiphp.version'); ?>">
    <link rel="stylesheet" href="/static/system/css/style.css?v=<?php echo config('hisiphp.version'); ?>" media="all">
    <link rel="stylesheet" href="/static/fonts/typicons/min.css?v=<?php echo config('hisiphp.version'); ?>">
    <link rel="stylesheet" href="/static/fonts/font-awesome/min.css?v=<?php echo config('hisiphp.version'); ?>">
    <?php echo $hisiHead; ?>
</head>
<body class="hisi-theme-<?php echo cookie('hisi_admin_theme'); ?> pb50">
<?php else: ?>
<!DOCTYPE html>
<html>
<head>
    <title><?php if($hisiCurMenu['url'] == 'system/index/index'): ?>管理控制台<?php else: ?><?php echo htmlentities($hisiCurMenu['title']); ?><?php endif; ?> -  Powered by <?php echo config('hisiphp.name'); ?></title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <link rel="stylesheet" href="/static/js/layui/css/layui.css?v=<?php echo config('hisiphp.version'); ?>">
    <link rel="stylesheet" href="/static/system/css/theme.css?v=<?php echo config('hisiphp.version'); ?>">
    <link rel="stylesheet" href="/static/system/css/style.css?v=<?php echo config('hisiphp.version'); ?>" media="all">
    <link rel="stylesheet" href="/static/fonts/typicons/min.css?v=<?php echo config('hisiphp.version'); ?>">
    <link rel="stylesheet" href="/static/fonts/font-awesome/min.css?v=<?php echo config('hisiphp.version'); ?>">
    <?php echo $hisiHead; ?>
</head>
<body class="layui-layout-body hisi-theme-<?php echo cookie('hisi_admin_theme'); ?>">
<?php 
$ca = strtolower(request()->controller().'/'.request()->action());
 ?>
<div class="layui-layout layui-layout-admin">
    <div class="layui-header" style="z-index:999!important;">
    <div class="fl header-logo">后台管理中心</div>
    <div class="fl header-fold"><a href="javascript:;" title="打开/关闭左侧导航" class="aicon ai-shouqicaidan" id="foldSwitch"></a></div>
    <ul class="layui-nav fl nobg main-nav">
        <?php if(is_array($hisiMenus) || $hisiMenus instanceof \think\Collection || $hisiMenus instanceof \think\Paginator): $i = 0; $__LIST__ = $hisiMenus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if(($hisiCurParents['pid'] == $vo['id'] and $ca != 'plugins/run') or ($ca == 'plugins/run' and $vo['id'] == 3)): ?>
           <li class="layui-nav-item layui-this">
            <?php else: ?>
            <li class="layui-nav-item">
            <?php endif; ?> 
            <a href="javascript:;"><?php echo htmlentities($vo['title']); ?></a></li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
    <ul class="layui-nav fr nobg head-info">
        <li class="layui-nav-item">
            <a href="/" target="_blank" class="aicon ai-ai-home" title="前台"></a>
        </li>
        <li class="layui-nav-item">
            <a href="javascript:void(0);" class="aicon ai-qingchu" id="hisi-clear-cache" title="清缓存"></a>
        </li>
        <li class="layui-nav-item">
            <a href="javascript:void(0);" class="aicon ai-suo" id="lockScreen" title="锁屏"></a>
        </li>
        <li class="layui-nav-item">
            <a href="<?php echo url('system/user/setTheme'); ?>" id="hisi-theme-setting" class="aicon ai-theme"></a>
        </li>
        <li class="layui-nav-item hisi-lang">
            <a href="javascript:void(0);"><i class="layui-icon layui-icon-website"></i></a>
            <dl class="layui-nav-child">
                <?php if(is_array($languages) || $languages instanceof \think\Collection || $languages instanceof \think\Paginator): $i = 0; $__LIST__ = $languages;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['pack']): ?>
                    <dd><a href="<?php echo url('system/index/index'); ?>?lang=<?php echo htmlentities($vo['code']); ?>"><?php echo htmlentities($vo['name']); ?></a></dd>
                    <?php endif; ?>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                <dd>
                    <a data-id="000" class="admin-nav-item top-nav-item" href="<?php echo url('system/language/index'); ?>">语言包管理</a>
                </dd>
            </dl>
        </li>
        <li class="layui-nav-item">
            <a href="javascript:void(0);"><?php echo htmlentities($login['nick']); ?>&nbsp;&nbsp;</a>
            <dl class="layui-nav-child">
                <dd>
                    <a data-id="00" class="admin-nav-item top-nav-item" href="<?php echo url('system/user/info'); ?>">个人设置</a>
                </dd>
                <dd>
                    <a href="<?php echo url('system/user/iframe'); ?>" class="hisi-ajax" refresh="true"><?php echo input('cookie.hisi_iframe') ? '单页布局' : '框架布局'; ?></a>
                </dd>
                <dd>
                    <a href="<?php echo url('system/publics/logout'); ?>">退出登陆</a>
                </dd>
            </dl>
        </li>
    </ul>
</div>
<div class="layui-side layui-bg-black" id="switchNav">
    <div class="layui-side-scroll">
        <?php if(is_array($hisiMenus) || $hisiMenus instanceof \think\Collection || $hisiMenus instanceof \think\Paginator): $i = 0; $__LIST__ = $hisiMenus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;if(($hisiCurParents['pid'] == $v['id'] and $ca != 'plugins/run') or ($ca == 'plugins/run' and $v['id'] == 3)): ?>
        <ul class="layui-nav layui-nav-tree">
        <?php else: ?>
        <ul class="layui-nav layui-nav-tree" style="display:none;">
        <?php endif; if((isset($v['childs']))): if(is_array($v['childs']) || $v['childs'] instanceof \think\Collection || $v['childs'] instanceof \think\Paginator): $kk = 0; $__LIST__ = $v['childs'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($kk % 2 );++$kk;?>
            <li class="layui-nav-item <?php if($kk == 1): ?>layui-nav-itemed<?php endif; ?>">
                <a href="javascript:;"><i class="<?php echo htmlentities($vv['icon']); ?>"></i><?php echo htmlentities($vv['title']); ?><span class="layui-nav-more"></span></a>
                <dl class="layui-nav-child">
                    <?php if($vv['title'] == '快捷菜单'): ?>
                        <dd>
                            <a class="admin-nav-item" data-id="0" href="<?php echo input('cookie.hisi_iframe') ? url('system/index/welcome') : url('system/index/index'); ?>"><i class="aicon ai-shouye"></i> 后台首页</a>
                        </dd>
                        <?php if((isset($vv['childs']))): if(is_array($vv['childs']) || $vv['childs'] instanceof \think\Collection || $vv['childs'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vv['childs'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vvv): $mod = ($i % 2 );++$i;?>
                        <dd>
                            <a class="admin-nav-item" data-id="<?php echo htmlentities($vvv['id']); ?>" href="<?php if(strpos('http', $vvv['url']) === false): ?><?php echo url($vvv['url'], $vvv['param']); else: ?><?php echo htmlentities($vvv['url']); ?><?php endif; ?>"><?php if(file_exists('.'.$vvv['icon'])): ?><img src="<?php echo htmlentities($vvv['icon']); ?>" width="16" height="16" /><?php else: ?><i class="<?php echo htmlentities($vvv['icon']); ?>"></i><?php endif; ?> <?php echo htmlentities($vvv['title']); ?></a><i data-href="<?php echo url('system/menu/del?id='.$vvv['id']); ?>" class="layui-icon j-del-menu">&#xe640;</i>
                        </dd>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        <?php endif; else: if((isset($vv['childs']))): if(is_array($vv['childs']) || $vv['childs'] instanceof \think\Collection || $vv['childs'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vv['childs'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vvv): $mod = ($i % 2 );++$i;?>
                        <dd>
                            <a class="admin-nav-item" data-id="<?php echo htmlentities($vvv['id']); ?>" href="<?php if(strpos('http', $vvv['url']) === false): ?><?php echo url($vvv['url'], $vvv['param']); else: ?><?php echo htmlentities($vvv['url']); ?><?php endif; ?>"><?php if(file_exists('.'.$vvv['icon'])): ?><img src="<?php echo htmlentities($vvv['icon']); ?>" width="16" height="16" /><?php else: ?><i class="<?php echo htmlentities($vvv['icon']); ?>"></i><?php endif; ?> <?php echo htmlentities($vvv['title']); ?></a>
                        </dd>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </dl>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        <?php endif; ?>
        </ul>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>
<script type="text/html" id="hisi-theme-tpl">
    <ul class="hisi-themes">
        <?php $_result=session('hisi_admin_themes');if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <li data-theme="<?php echo htmlentities($vo); ?>" class="hisi-theme-item-<?php echo htmlentities($vo); ?>"></li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
</script>
<script type="text/html" id="hisi-clear-cache-tpl">
    <form class="layui-form" style="padding:10px 0 0 30px;" action="<?php echo url('system/index/clear'); ?>" method="post">
        <div class="layui-form-item">
            <input type="checkbox" name="cache" value="1" title="数据缓存" />
        </div>
        <div class="layui-form-item">
            <input type="checkbox" name="log" value="1" title="日志缓存" />
        </div>
        <div class="layui-form-item">
            <input type="checkbox" name="temp" value="1" title="模板缓存" />
        </div>
        <div class="layui-form-item">
            <button class="layui-btn layui-btn-normal" lay-submit="" lay-filter="formSubmit">执行删除</button>
        </div>
    </form>
</script>
    <div class="layui-body" id="switchBody">
        <ul class="bread-crumbs">
            <?php if(is_array($hisiBreadcrumb) || $hisiBreadcrumb instanceof \think\Collection || $hisiBreadcrumb instanceof \think\Paginator): $i = 0; $__LIST__ = $hisiBreadcrumb;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;if($key > 0 && $i != count($hisiBreadcrumb)): ?>
                    <li>></li>
                    <li><a href="<?php echo url($v['url'].'?'.$v['param']); ?>"><?php echo htmlentities($v['title']); ?></a></li>
                <?php elseif($i == count($hisiBreadcrumb)): ?>
                    <li>></li>
                    <li><a href="javascript:void(0);"><?php echo htmlentities($v['title']); ?></a></li>
                <?php else: ?>
                    <li><a href="javascript:void(0);"><?php echo htmlentities($v['title']); ?></a></li>
                <?php endif; ?>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            <li><a href="<?php echo url('system/menu/quick?id='.$hisiCurMenu['id']); ?>" title="添加到首页快捷菜单" class="j-ajax">[+]</a></li>
        </ul>
        <div style="padding:0 10px;" class="mcolor"><?php echo runhook('system_admin_tips'); ?></div>
            <div class="page-body">
<?php endif; switch($hisiTabType): case "1": ?>
        
        <div class="layui-card">
            <div class="layui-tab layui-tab-brief">
                <!--ul class="layui-tab-title">
                    <li class="layui-this">
                        <a href="javascript:;" id="curTitle"><?php echo $hisiCurMenu['title']; ?></a>
                    </li>
                </ul-->
                <div class="layui-tab-content page-tab-content">
                    <div class="layui-tab-item layui-show">
                        <div class="layui-field-box">
<form class="layui-form" id="hisiSearch">
	<div class="layui-form-item mb0">
		<!--搜索  -->
		  <div class="layui-form-item">
			<div class="layui-input-inline">
				<input type="text" class="layui-input field-catalog" name="catalog" value="<?php echo input('get.catalog'); ?>"  lay-verify="required" autocomplete="off" placeholder="请输入货号">
			</div>
			<div class="layui-input-inline">
				<input type="text" class="layui-input field-name" name="name" lay-verify="required" autocomplete="off" placeholder="请输入中文名称">
			</div>

			<div class="layui-input-inline">
				<input type="text" class="layui-input field-ename" name="ename" lay-verify="required" autocomplete="off" placeholder="请输入英文名称">
			</div>
			<div class="layui-input-inline">
				<input type="text" class="layui-input field-cas" name="cas" lay-verify="required" autocomplete="off" placeholder="请输入CAS号">
			</div>
			 <div class="layui-input-inline">
				<input type="text" class="layui-input field-smiles" name="smiles" lay-verify="" autocomplete="off" placeholder="请输入Smiles">
			</div>
			 <div class="layui-input-inline">
				<input type="text" class="layui-input field-mdl" name="mdl" lay-verify="required" autocomplete="off" placeholder="请输入MDL">
			</div>
			 <div class="layui-input-inline">
				<input type="text" class="layui-input field-inchikey" name="inchikey" lay-verify="" autocomplete="off" placeholder="请输入InChIKey">
			</div>
			<button class="layui-btn search_btn" type="submit">搜索</button>
		  </div>
	</div>
</form>
</div>
<table id="dataTable"></table>

<script src="/static/js/layui/layui.js?v=<?php echo config('hisiphp.version'); ?>"></script>
<script src="/static/js/jquery.2.1.4.min.js?v=<?php echo config('hisiphp.version'); ?>"></script>
<script>
    var ADMIN_PATH = "<?php echo htmlentities($_SERVER['SCRIPT_NAME']); ?>", LAYUI_OFFSET = 60;
    layui.config({
    	base: '/static/system/js/',
        version: '<?php echo config("hisiphp.version"); ?>'
    }).use('global');
</script>
<script src="/static/js/layui/lay_pageutil.js?v=<?php echo config('hisiphp.version'); ?>"></script>
<script src="/static/js/layui/pageutil.js?v=<?php echo config('hisiphp.version'); ?>"></script>

<script type="text/html" title="操作按钮模板" id="buttonTpl">
    <a href="<?php echo url('edit'); ?>?id={{ d.id }}" class="layui-btn layui-btn-xs layui-btn-normal" title="修改">修改</a>
	<a href="<?php echo url('del'); ?>?id={{ d.id }}" class="layui-btn layui-btn-xs layui-btn-danger j-tr-del">删除</a>
</script>

<script type="text/html" id="toolbar">
    <div class="layui-btn-group fl">
        <a href="<?php echo url('add'); ?>" class="layui-btn layui-btn-primary layui-btn-sm layui-icon layui-icon-add-circle-fine"  title="添加">&nbsp;添加</a>
        <a data-href="<?php echo url('del'); ?>" class="layui-btn layui-btn-primary layui-btn-sm j-page-btns confirm layui-icon layui-icon-close red">&nbsp;删除</a>
		<button id="upload_data_tag" class="layui-btn layui-btn-primary layui-btn-sm" lay-submit><i class="layui-icon" title="批量导入">&#xe62f;</i>批量导入</button>
		<a href="<?php echo url('download'); ?>" class="layui-btn layui-btn-primary layui-btn-sm"  title="批量导出"><i class="layui-icon" title="批量导出">&#xe601;</i>批量导出</a>
    </div>
</script>

<script type="text/javascript">
    layui.use(['table','upload'], function() {
        var table = layui.table;
		var upload = layui.upload;
		
        table.render({
            elem: '#dataTable'
            ,url: '<?php echo url(); ?>' //数据接口
            ,page: true //开启分页
            ,skin: 'row'
            ,even: true
            ,limit: 20
            ,text: {
                none : '暂无相关数据'
            }
            ,toolbar: '#toolbar'
            ,defaultToolbar: ['filter']
            ,cols: [[ //表头
                 {type:'checkbox',fixed:'left'}
				,{title: '操作',fixed:'left', templet: '#buttonTpl', width:150}
				,{field: 'struture',fixed:'left',width:150, title: '结构式', templet:function(d){
                    var str = '';
                    if(d.struture) {
                        str += '<img class="layui-upload-img" src="'+d.struture+'" >';
                    }
                    return str;
                }}
				,{field: 'file_name',width:200, title: '分析图谱', templet:function(d){
                    var str = '';
                    if(d.file_name) {
						str += '<a href="'+d.file+'">"'+d.file_name+'"</a>';
                    }
					str += '<button type="button" onclick="upFile('+d.id+');"  class="layui-btn layui-btn-small"> <i class="layui-icon" title="上传">';
						str += '</i>上传</button>';
                    return str;
                }}
				,{field: 'catalog', title: '货号', width: 100}
                ,{field: 'test_num', title: '送检单号', width: 100}
				,{field: 'name', title: '中文名称', width: 100}
                ,{field: 'ename', title: '英文名称', width: 100}
                ,{field: 'cas', title: 'CAS', width: 100}
				,{field: 'mdl', title: 'MDL', width: 100}
				,{field: 'purity', title: '纯度', width: 100}
				,{field: 'mf', title: '分子式', width: 100}
				,{field: 'mw', title: '分子量', width: 100}
                ,{field: 'nmr_num', title: '核磁编号', width: 100}
				,{field: 'nmr_method', title: '核磁方法', width: 100}
				,{field: 'po_num', title: 'PO', width: 100}
                ,{field: 'results', title: '分析结论', width: 100}
				,{field: 'store_name', title: '是否入库', width: 100}
				,{field: 'last_num', title: '最近一次谱图', width: 100}
                ,{field: 'appearance', title: '外观', width: 100}
				,{field: 'order_amount', title: '订购数量', width: 100}
				,{field: 'optical', title: '旋光', width: 100}
				,{field: 'optical_result', title: '旋光结果', width: 100}
                ,{field: 'ee', title: 'EE%', width: 100}
				,{field: 'ee_result', title: 'EE% 结果', width: 100}
				,{field: 'hplc_result', title: 'HPLC结果', width: 100}
				,{field: 'gc_result', title: 'GC结果', width: 100}
                ,{field: 'ms_result', title: 'MS结果', width: 100}
				,{field: 'accept_name', title: '是否接收', width: 100}
				,{field: 'caigou_name', title: '采购员', width: 100}
				,{field: 'caigou_tel', title: '采购员电话', width: 100}
				,{field: 'gendan_name', title: '跟单员', width: 100}
				,{field: 'gendan_tel', title: '跟单员电话', width: 100}
				,{field: 'dinggou_name', title: '订购人', width: 100}
				,{field: 'dinggou_tel', title: '订购人电话', width: 100}
				,{field: 'supplier', title: '供应商名称', width: 100}
				,{field: 'water_content', title: '含水量', width: 100}
				,{field: 'ph_num', title: 'PH值', width: 100}
				,{field: 'melting_point', title: '熔点', width: 100}
				,{field: 'batch_num', title: '批号', width: 100}
				,{field: 'caigou_super', title: '采购主管', width: 100}
				,{field: 'cangku_super', title: '库房主管', width: 100}
				,{field: 'dinggou_super', title: '订购人主管', width: 100}
				,{field: 'shouhuoren', title: '收货人', width: 100}
				,{field: 'remark', title: '备注', width: 100}
            ]]
        });
		var dao_url = '<?php echo url("uploadFile"); ?>';
		upload.render({
			 elem: '#upload_data_tag'
			 ,url: dao_url 
			 ,before: function(obj){ //obj参数包含的信息，跟 choose回调完全一致，可参见上文。
				 layer.open({type: 3});//信息加载,上传loading
			 }
			 ,done: function(res, index, upload){ //上传后的回调
				 layer.closeAll('loading'); //关闭loading
				 if(res.code="0") 
				 {  
					 ShowLayerMessage(res.info,5);
					 window.location.reload();
				 }
				 else
				 {
					 ShowLayerMessage("文件上传失败！",5);
				 }
			 } 
			 ,error: function(index, upload){
				layer.closeAll('loading'); //关闭loading
				ShowLayerMessage("文件上传出错！",5);
			 }
			 ,accept: 'file' //允许上传的文件类型
			 ,exts:'xlsx|docx|csv'	
			 ,size: 20480 //最大允许上传的文件大小，20M
		})
    });
</script>
<div id="file_edit_form_tag" class="guanli container-fluid layui-form layui-form-pane" style="display: none;">
	 <fieldset class="layui-elem-field ">
		<legend>增加谱图</legend>
		<input type="hidden" id="id_tag" name="id" >
	    <div class="layui-form-item">
			<fieldset id="upFileBut_tag" class="layui-elem-field site-demo-button">
				<div class="layui-btn-group">
					<button id="upload_file_tag" type="button" class="layui-btn" lay-filter="upFileBut"><i class="layui-icon" title="批量上传附件">&#xe62f;</i>附件上传</button>
				</div>
				<input type="hidden" class="field-file" name="file" id="file">
				<input type="hidden" class="field-file_name" name="file_name" id="file_name">
				<input type="hidden" class="field-file_size" name="file_size" id="file_size">
			</fieldset>
		   <fieldset class="layui-elem-field">
			  <legend>附件：</legend>
			  <div class="layui-field-box layui-upload-list">
				<table class="layui-table">
				   <thead>
					 <tr>
						<th>文件名</th>
						<th>大小(KB)</th>
						<th>操作</th>
					 </tr>
				   </thead>
				   <colgroup>
					<col>
					<col width="100">
					<col width="200">
				  </colgroup>
				  <tbody id="ask_file_list">
					
				  </tbody>
				</table>
			  </div>
		   </fieldset>
	 </div>
	 </fieldset>
	 <div class="layui-form-item" style="display: none;">
		<div class="layui-input-block">
			<button id="file_edit_save_tag" class="layui-btn" lay-submit lay-filter="fileEditSave">保存</button>
		</div>
	 </div>
</div>
<script>
	function upFile(id){
		$("#id_tag").val(id);
		var jsonText = 
		{
			'id':id
		};
		var ParamData = {"device_type":"0","json_text":JSON.stringify(jsonText)};
		var SysUrlStr = '<?php echo url("fileInfo"); ?>';
		layer.open({type: 3});//信息加载,上传loading
		DataInit(SysUrlStr,ParamData,file_obj_tag_init,Action_lay_ErrotFunction);
	}
	function file_obj_tag_init(curResult_obj)
	{
		var temObj = GetJSONObj(curResult_obj);
		if(temObj.code=="0")
		{ 
			layui_loading_close();
			console.log(temObj);
			var dataObj = temObj.data;
			var file_path  = dataObj.file;
			var file_name = dataObj.file_name;
			var file_size = dataObj.file_size;
			var dataHtmlStr='';
			if(dataObj)
			{ 
				 dataHtmlStr +='<tr>'
						    +'<td>'+file_name+'</td>'
						    +'<td>'+file_size+'k</td>'
					        +'<td>'
					        +'<button class="layui-btn layui-btn-small" lay-submit file_path="'+file_path+'" lay-filter="askFileDown"><i class="layui-icon" title="下载">&#xe601;</i>下载</button>'
					        +'</td>'
					        +'</tr>';
					Cur_Tag =  $("#ask_file_list");
					if(Cur_Tag) 
						Cur_Tag.html(dataHtmlStr);	
				$("#file").val(file_path);
				$("#file_name").val(file_name);
				$("#file_size").val(file_size);
				restult_open_show();
			}
		} 	 
		else 
		{ 
			Return_lay_ErrotFunction(temObj);
		}
	}
	
	function restult_open_show()
	{
		layui.use(['form','layer','laydate','table','upload'], function(){
			var form = layui.form
			  ,layer = layui.layer
			  ,table = layui.table
			  ,laydate = layui.laydate
			   ,upload = layui.upload;
				form.on('submit(askFileDown)', function(data){
					   var file_path = $(this).attr('file_path');
					   location.href=file_path;
					   return false;
				 });
				form.render();
			var upload_url = '<?php echo url("upload"); ?>';
			upload.render({
				 elem: '#upload_file_tag'
				 ,url: upload_url 
				 ,before: function(obj){ //obj参数包含的信息，跟 choose回调完全一致，可参见上文。
					 layer.open({type: 3});//信息加载,上传loading
				 }
				 ,done: function(res, index, upload){ //上传后的回调
					 layer.closeAll('loading'); //关闭loading
					 if(res.code="0") 
					 {  
						 var tem_obj = res.data;
						 var file_path = tem_obj.file;
						 var file_name = tem_obj.fileName;
						 var file_size = tem_obj.size;
						 var dataHtmlStr = '';
						 dataHtmlStr +='<tr>'
								+'<td>'+file_name+'</td>'
								+'<td>'+file_size+'k</td>'
								+'<td>'
								+'<button class="layui-btn layui-btn-small" lay-submit file_path="'+file_path+'" lay-filter="askFileDown"><i class="layui-icon" title="下载">&#xe601;</i>下载</button>'
								+'</td>'
								+'</tr>';
						Cur_Tag =  $("#ask_file_list");
						if(Cur_Tag) 
							Cur_Tag.html(dataHtmlStr);	
						$("#file").val(file_path);
						$("#file_name").val(file_name);
						$("#file_size").val(file_size);
					 }
					 else
					 {
						 ShowLayerMessage("文件上传失败！",5);
					 }
				 } 
				 ,error: function(index, upload){
					layer.closeAll('loading'); //关闭loading
					ShowLayerMessage("文件上传失败！",5);
				 }
				 ,accept: 'file' //允许上传的文件类型
				 ,exts:'xls|csv|xlsx|doc|docx|rar|zip'	
				 //,multiple:true //是否允许多文件上传。设置 true即可开启。不支持ie8/9		 
				  //,size: 50 //最大允许上传的文件大小
				  //,……
			})
			var title_str="分析谱图上传";
			pop_edit_form(layer,'file',title_str,750,350);
		    $(".layui-layer-page").css("z-index","198910151");
			$(".layui-layer-shade").css("display","none");
			form.on('submit(fileEditSave)', function(data){
				var jsonData = data.field;
				var json_text = create_json_text(jsonData);
				if(!IsNullOrBlank(json_text))
				{
					layer.open({type: 3});//信息加载,上传loading
					var ParamData = {"device_type":1,"json_text":json_text};
					var SysUrlStr = '<?php echo url("saveData"); ?>';
					DataInit(SysUrlStr,ParamData,ActionBack,Action_lay_ErrotFunction);	
				}
				return false;
			 });
		});
	}
	function create_json_text(jsonData)
	{
		var is_submit = true;
		var file = jsonData.file;
		if(file==''){
			ShowLayerMessage("请选择文件",5);
			is_submit = false;
			return "";
		}
		if(is_submit)
			return JSON.stringify(jsonData);
		else
			return "";
	}
	/**
 * 数据保存成功后的回调函数
 * @param curResult_obj
 */
function ActionBack(curResult_obj)
{
	 var temObj = GetJSONObj(curResult_obj);
	 
     if(temObj.code=="0")
	 {
		layui_pop_close();
		ShowLayerMessage(temObj.info,1);
		$(".layui-laypage-btn")[0].click();
     } 	 
	 else 
	 { 
	     Return_lay_ErrotFunction(temObj);
	 }
}

</script>
                    </div>
                </div>
            </div>
        </div>
    <?php break; case "2": ?>
        
        <div class="layui-card">
            <div class="layui-tab layui-tab-brief">
                <ul class="layui-tab-title">
                    <?php if(is_array($hisiTabData['menu']) || $hisiTabData['menu'] instanceof \think\Collection || $hisiTabData['menu'] instanceof \think\Paginator): $k = 0; $__LIST__ = $hisiTabData['menu'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;if(($k == 1)): ?>
                            <li class="layui-this">
                        <?php else: ?>
                            <li>
                        <?php endif; ?>
                            <a href="javascript:;" class="<?php if((isset($vo['class']))): ?><?php echo htmlentities($vo['class']); ?><?php endif; ?>" id="<?php if((isset($vo['id']))): ?><?php echo htmlentities($vo['id']); ?><?php endif; ?>"><?php echo $vo['title']; ?></a>
                        </li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <div class="layui-tab-content page-tab-content">
                    <div class="layui-field-box">
<form class="layui-form" id="hisiSearch">
	<div class="layui-form-item mb0">
		<!--搜索  -->
		  <div class="layui-form-item">
			<div class="layui-input-inline">
				<input type="text" class="layui-input field-catalog" name="catalog" value="<?php echo input('get.catalog'); ?>"  lay-verify="required" autocomplete="off" placeholder="请输入货号">
			</div>
			<div class="layui-input-inline">
				<input type="text" class="layui-input field-name" name="name" lay-verify="required" autocomplete="off" placeholder="请输入中文名称">
			</div>

			<div class="layui-input-inline">
				<input type="text" class="layui-input field-ename" name="ename" lay-verify="required" autocomplete="off" placeholder="请输入英文名称">
			</div>
			<div class="layui-input-inline">
				<input type="text" class="layui-input field-cas" name="cas" lay-verify="required" autocomplete="off" placeholder="请输入CAS号">
			</div>
			 <div class="layui-input-inline">
				<input type="text" class="layui-input field-smiles" name="smiles" lay-verify="" autocomplete="off" placeholder="请输入Smiles">
			</div>
			 <div class="layui-input-inline">
				<input type="text" class="layui-input field-mdl" name="mdl" lay-verify="required" autocomplete="off" placeholder="请输入MDL">
			</div>
			 <div class="layui-input-inline">
				<input type="text" class="layui-input field-inchikey" name="inchikey" lay-verify="" autocomplete="off" placeholder="请输入InChIKey">
			</div>
			<button class="layui-btn search_btn" type="submit">搜索</button>
		  </div>
	</div>
</form>
</div>
<table id="dataTable"></table>

<script src="/static/js/layui/layui.js?v=<?php echo config('hisiphp.version'); ?>"></script>
<script src="/static/js/jquery.2.1.4.min.js?v=<?php echo config('hisiphp.version'); ?>"></script>
<script>
    var ADMIN_PATH = "<?php echo htmlentities($_SERVER['SCRIPT_NAME']); ?>", LAYUI_OFFSET = 60;
    layui.config({
    	base: '/static/system/js/',
        version: '<?php echo config("hisiphp.version"); ?>'
    }).use('global');
</script>
<script src="/static/js/layui/lay_pageutil.js?v=<?php echo config('hisiphp.version'); ?>"></script>
<script src="/static/js/layui/pageutil.js?v=<?php echo config('hisiphp.version'); ?>"></script>

<script type="text/html" title="操作按钮模板" id="buttonTpl">
    <a href="<?php echo url('edit'); ?>?id={{ d.id }}" class="layui-btn layui-btn-xs layui-btn-normal" title="修改">修改</a>
	<a href="<?php echo url('del'); ?>?id={{ d.id }}" class="layui-btn layui-btn-xs layui-btn-danger j-tr-del">删除</a>
</script>

<script type="text/html" id="toolbar">
    <div class="layui-btn-group fl">
        <a href="<?php echo url('add'); ?>" class="layui-btn layui-btn-primary layui-btn-sm layui-icon layui-icon-add-circle-fine"  title="添加">&nbsp;添加</a>
        <a data-href="<?php echo url('del'); ?>" class="layui-btn layui-btn-primary layui-btn-sm j-page-btns confirm layui-icon layui-icon-close red">&nbsp;删除</a>
		<button id="upload_data_tag" class="layui-btn layui-btn-primary layui-btn-sm" lay-submit><i class="layui-icon" title="批量导入">&#xe62f;</i>批量导入</button>
		<a href="<?php echo url('download'); ?>" class="layui-btn layui-btn-primary layui-btn-sm"  title="批量导出"><i class="layui-icon" title="批量导出">&#xe601;</i>批量导出</a>
    </div>
</script>

<script type="text/javascript">
    layui.use(['table','upload'], function() {
        var table = layui.table;
		var upload = layui.upload;
		
        table.render({
            elem: '#dataTable'
            ,url: '<?php echo url(); ?>' //数据接口
            ,page: true //开启分页
            ,skin: 'row'
            ,even: true
            ,limit: 20
            ,text: {
                none : '暂无相关数据'
            }
            ,toolbar: '#toolbar'
            ,defaultToolbar: ['filter']
            ,cols: [[ //表头
                 {type:'checkbox',fixed:'left'}
				,{title: '操作',fixed:'left', templet: '#buttonTpl', width:150}
				,{field: 'struture',fixed:'left',width:150, title: '结构式', templet:function(d){
                    var str = '';
                    if(d.struture) {
                        str += '<img class="layui-upload-img" src="'+d.struture+'" >';
                    }
                    return str;
                }}
				,{field: 'file_name',width:200, title: '分析图谱', templet:function(d){
                    var str = '';
                    if(d.file_name) {
						str += '<a href="'+d.file+'">"'+d.file_name+'"</a>';
                    }
					str += '<button type="button" onclick="upFile('+d.id+');"  class="layui-btn layui-btn-small"> <i class="layui-icon" title="上传">';
						str += '</i>上传</button>';
                    return str;
                }}
				,{field: 'catalog', title: '货号', width: 100}
                ,{field: 'test_num', title: '送检单号', width: 100}
				,{field: 'name', title: '中文名称', width: 100}
                ,{field: 'ename', title: '英文名称', width: 100}
                ,{field: 'cas', title: 'CAS', width: 100}
				,{field: 'mdl', title: 'MDL', width: 100}
				,{field: 'purity', title: '纯度', width: 100}
				,{field: 'mf', title: '分子式', width: 100}
				,{field: 'mw', title: '分子量', width: 100}
                ,{field: 'nmr_num', title: '核磁编号', width: 100}
				,{field: 'nmr_method', title: '核磁方法', width: 100}
				,{field: 'po_num', title: 'PO', width: 100}
                ,{field: 'results', title: '分析结论', width: 100}
				,{field: 'store_name', title: '是否入库', width: 100}
				,{field: 'last_num', title: '最近一次谱图', width: 100}
                ,{field: 'appearance', title: '外观', width: 100}
				,{field: 'order_amount', title: '订购数量', width: 100}
				,{field: 'optical', title: '旋光', width: 100}
				,{field: 'optical_result', title: '旋光结果', width: 100}
                ,{field: 'ee', title: 'EE%', width: 100}
				,{field: 'ee_result', title: 'EE% 结果', width: 100}
				,{field: 'hplc_result', title: 'HPLC结果', width: 100}
				,{field: 'gc_result', title: 'GC结果', width: 100}
                ,{field: 'ms_result', title: 'MS结果', width: 100}
				,{field: 'accept_name', title: '是否接收', width: 100}
				,{field: 'caigou_name', title: '采购员', width: 100}
				,{field: 'caigou_tel', title: '采购员电话', width: 100}
				,{field: 'gendan_name', title: '跟单员', width: 100}
				,{field: 'gendan_tel', title: '跟单员电话', width: 100}
				,{field: 'dinggou_name', title: '订购人', width: 100}
				,{field: 'dinggou_tel', title: '订购人电话', width: 100}
				,{field: 'supplier', title: '供应商名称', width: 100}
				,{field: 'water_content', title: '含水量', width: 100}
				,{field: 'ph_num', title: 'PH值', width: 100}
				,{field: 'melting_point', title: '熔点', width: 100}
				,{field: 'batch_num', title: '批号', width: 100}
				,{field: 'caigou_super', title: '采购主管', width: 100}
				,{field: 'cangku_super', title: '库房主管', width: 100}
				,{field: 'dinggou_super', title: '订购人主管', width: 100}
				,{field: 'shouhuoren', title: '收货人', width: 100}
				,{field: 'remark', title: '备注', width: 100}
            ]]
        });
		var dao_url = '<?php echo url("uploadFile"); ?>';
		upload.render({
			 elem: '#upload_data_tag'
			 ,url: dao_url 
			 ,before: function(obj){ //obj参数包含的信息，跟 choose回调完全一致，可参见上文。
				 layer.open({type: 3});//信息加载,上传loading
			 }
			 ,done: function(res, index, upload){ //上传后的回调
				 layer.closeAll('loading'); //关闭loading
				 if(res.code="0") 
				 {  
					 ShowLayerMessage(res.info,5);
					 window.location.reload();
				 }
				 else
				 {
					 ShowLayerMessage("文件上传失败！",5);
				 }
			 } 
			 ,error: function(index, upload){
				layer.closeAll('loading'); //关闭loading
				ShowLayerMessage("文件上传出错！",5);
			 }
			 ,accept: 'file' //允许上传的文件类型
			 ,exts:'xlsx|docx|csv'	
			 ,size: 20480 //最大允许上传的文件大小，20M
		})
    });
</script>
<div id="file_edit_form_tag" class="guanli container-fluid layui-form layui-form-pane" style="display: none;">
	 <fieldset class="layui-elem-field ">
		<legend>增加谱图</legend>
		<input type="hidden" id="id_tag" name="id" >
	    <div class="layui-form-item">
			<fieldset id="upFileBut_tag" class="layui-elem-field site-demo-button">
				<div class="layui-btn-group">
					<button id="upload_file_tag" type="button" class="layui-btn" lay-filter="upFileBut"><i class="layui-icon" title="批量上传附件">&#xe62f;</i>附件上传</button>
				</div>
				<input type="hidden" class="field-file" name="file" id="file">
				<input type="hidden" class="field-file_name" name="file_name" id="file_name">
				<input type="hidden" class="field-file_size" name="file_size" id="file_size">
			</fieldset>
		   <fieldset class="layui-elem-field">
			  <legend>附件：</legend>
			  <div class="layui-field-box layui-upload-list">
				<table class="layui-table">
				   <thead>
					 <tr>
						<th>文件名</th>
						<th>大小(KB)</th>
						<th>操作</th>
					 </tr>
				   </thead>
				   <colgroup>
					<col>
					<col width="100">
					<col width="200">
				  </colgroup>
				  <tbody id="ask_file_list">
					
				  </tbody>
				</table>
			  </div>
		   </fieldset>
	 </div>
	 </fieldset>
	 <div class="layui-form-item" style="display: none;">
		<div class="layui-input-block">
			<button id="file_edit_save_tag" class="layui-btn" lay-submit lay-filter="fileEditSave">保存</button>
		</div>
	 </div>
</div>
<script>
	function upFile(id){
		$("#id_tag").val(id);
		var jsonText = 
		{
			'id':id
		};
		var ParamData = {"device_type":"0","json_text":JSON.stringify(jsonText)};
		var SysUrlStr = '<?php echo url("fileInfo"); ?>';
		layer.open({type: 3});//信息加载,上传loading
		DataInit(SysUrlStr,ParamData,file_obj_tag_init,Action_lay_ErrotFunction);
	}
	function file_obj_tag_init(curResult_obj)
	{
		var temObj = GetJSONObj(curResult_obj);
		if(temObj.code=="0")
		{ 
			layui_loading_close();
			console.log(temObj);
			var dataObj = temObj.data;
			var file_path  = dataObj.file;
			var file_name = dataObj.file_name;
			var file_size = dataObj.file_size;
			var dataHtmlStr='';
			if(dataObj)
			{ 
				 dataHtmlStr +='<tr>'
						    +'<td>'+file_name+'</td>'
						    +'<td>'+file_size+'k</td>'
					        +'<td>'
					        +'<button class="layui-btn layui-btn-small" lay-submit file_path="'+file_path+'" lay-filter="askFileDown"><i class="layui-icon" title="下载">&#xe601;</i>下载</button>'
					        +'</td>'
					        +'</tr>';
					Cur_Tag =  $("#ask_file_list");
					if(Cur_Tag) 
						Cur_Tag.html(dataHtmlStr);	
				$("#file").val(file_path);
				$("#file_name").val(file_name);
				$("#file_size").val(file_size);
				restult_open_show();
			}
		} 	 
		else 
		{ 
			Return_lay_ErrotFunction(temObj);
		}
	}
	
	function restult_open_show()
	{
		layui.use(['form','layer','laydate','table','upload'], function(){
			var form = layui.form
			  ,layer = layui.layer
			  ,table = layui.table
			  ,laydate = layui.laydate
			   ,upload = layui.upload;
				form.on('submit(askFileDown)', function(data){
					   var file_path = $(this).attr('file_path');
					   location.href=file_path;
					   return false;
				 });
				form.render();
			var upload_url = '<?php echo url("upload"); ?>';
			upload.render({
				 elem: '#upload_file_tag'
				 ,url: upload_url 
				 ,before: function(obj){ //obj参数包含的信息，跟 choose回调完全一致，可参见上文。
					 layer.open({type: 3});//信息加载,上传loading
				 }
				 ,done: function(res, index, upload){ //上传后的回调
					 layer.closeAll('loading'); //关闭loading
					 if(res.code="0") 
					 {  
						 var tem_obj = res.data;
						 var file_path = tem_obj.file;
						 var file_name = tem_obj.fileName;
						 var file_size = tem_obj.size;
						 var dataHtmlStr = '';
						 dataHtmlStr +='<tr>'
								+'<td>'+file_name+'</td>'
								+'<td>'+file_size+'k</td>'
								+'<td>'
								+'<button class="layui-btn layui-btn-small" lay-submit file_path="'+file_path+'" lay-filter="askFileDown"><i class="layui-icon" title="下载">&#xe601;</i>下载</button>'
								+'</td>'
								+'</tr>';
						Cur_Tag =  $("#ask_file_list");
						if(Cur_Tag) 
							Cur_Tag.html(dataHtmlStr);	
						$("#file").val(file_path);
						$("#file_name").val(file_name);
						$("#file_size").val(file_size);
					 }
					 else
					 {
						 ShowLayerMessage("文件上传失败！",5);
					 }
				 } 
				 ,error: function(index, upload){
					layer.closeAll('loading'); //关闭loading
					ShowLayerMessage("文件上传失败！",5);
				 }
				 ,accept: 'file' //允许上传的文件类型
				 ,exts:'xls|csv|xlsx|doc|docx|rar|zip'	
				 //,multiple:true //是否允许多文件上传。设置 true即可开启。不支持ie8/9		 
				  //,size: 50 //最大允许上传的文件大小
				  //,……
			})
			var title_str="分析谱图上传";
			pop_edit_form(layer,'file',title_str,750,350);
		    $(".layui-layer-page").css("z-index","198910151");
			$(".layui-layer-shade").css("display","none");
			form.on('submit(fileEditSave)', function(data){
				var jsonData = data.field;
				var json_text = create_json_text(jsonData);
				if(!IsNullOrBlank(json_text))
				{
					layer.open({type: 3});//信息加载,上传loading
					var ParamData = {"device_type":1,"json_text":json_text};
					var SysUrlStr = '<?php echo url("saveData"); ?>';
					DataInit(SysUrlStr,ParamData,ActionBack,Action_lay_ErrotFunction);	
				}
				return false;
			 });
		});
	}
	function create_json_text(jsonData)
	{
		var is_submit = true;
		var file = jsonData.file;
		if(file==''){
			ShowLayerMessage("请选择文件",5);
			is_submit = false;
			return "";
		}
		if(is_submit)
			return JSON.stringify(jsonData);
		else
			return "";
	}
	/**
 * 数据保存成功后的回调函数
 * @param curResult_obj
 */
function ActionBack(curResult_obj)
{
	 var temObj = GetJSONObj(curResult_obj);
	 
     if(temObj.code=="0")
	 {
		layui_pop_close();
		ShowLayerMessage(temObj.info,1);
		$(".layui-laypage-btn")[0].click();
     } 	 
	 else 
	 { 
	     Return_lay_ErrotFunction(temObj);
	 }
}

</script>
                </div>
            </div>
        </div>
    <?php break; case "3": ?>
        
        <div class="layui-card">
            <div class="layui-tab layui-tab-brief">
                <ul class="layui-tab-title">
                    <?php if(is_array($hisiTabData['menu']) || $hisiTabData['menu'] instanceof \think\Collection || $hisiTabData['menu'] instanceof \think\Paginator): $i = 0; $__LIST__ = $hisiTabData['menu'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;
                            $hisiTabData['current'] = isset($hisiTabData['current']) ? $hisiTabData['current'] : '';
                         if(($vo['url'] == $hisiCurMenu['url'] or (url($vo['url']) == $hisiTabData['current']))): ?>
                            <li class="layui-this">
                        <?php else: ?>
                            <li>
                        <?php endif; if((strpos($vo['url'], 'http'))): ?>
                                <a href="<?php echo htmlentities($vo['url']); ?>" target="_blank"><?php echo $vo['title']; ?></a>
                            <?php elseif((strpos($vo['url'], config('sys.admin_path')) !== false)): ?>
                                <a href="<?php echo htmlentities($vo['url']); ?>" id="<?php if((isset($vo['id']))): ?><?php echo htmlentities($vo['id']); ?><?php endif; ?>" class="<?php if((isset($vo['class']))): ?><?php echo htmlentities($vo['class']); ?><?php endif; ?>"><?php echo $vo['title']; ?></a>
                            <?php else: ?>
                                <a href="<?php echo url($vo['url']); ?>" class="<?php if((isset($vo['class']))): ?><?php echo htmlentities($vo['class']); ?><?php endif; ?>" id="<?php if((isset($vo['id']))): ?><?php echo htmlentities($vo['id']); ?><?php endif; ?>"><?php echo $vo['title']; ?></a>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <div class="layui-tab-content page-tab-content">
                    <div class="layui-tab-item layui-show">
                        <div class="layui-field-box">
<form class="layui-form" id="hisiSearch">
	<div class="layui-form-item mb0">
		<!--搜索  -->
		  <div class="layui-form-item">
			<div class="layui-input-inline">
				<input type="text" class="layui-input field-catalog" name="catalog" value="<?php echo input('get.catalog'); ?>"  lay-verify="required" autocomplete="off" placeholder="请输入货号">
			</div>
			<div class="layui-input-inline">
				<input type="text" class="layui-input field-name" name="name" lay-verify="required" autocomplete="off" placeholder="请输入中文名称">
			</div>

			<div class="layui-input-inline">
				<input type="text" class="layui-input field-ename" name="ename" lay-verify="required" autocomplete="off" placeholder="请输入英文名称">
			</div>
			<div class="layui-input-inline">
				<input type="text" class="layui-input field-cas" name="cas" lay-verify="required" autocomplete="off" placeholder="请输入CAS号">
			</div>
			 <div class="layui-input-inline">
				<input type="text" class="layui-input field-smiles" name="smiles" lay-verify="" autocomplete="off" placeholder="请输入Smiles">
			</div>
			 <div class="layui-input-inline">
				<input type="text" class="layui-input field-mdl" name="mdl" lay-verify="required" autocomplete="off" placeholder="请输入MDL">
			</div>
			 <div class="layui-input-inline">
				<input type="text" class="layui-input field-inchikey" name="inchikey" lay-verify="" autocomplete="off" placeholder="请输入InChIKey">
			</div>
			<button class="layui-btn search_btn" type="submit">搜索</button>
		  </div>
	</div>
</form>
</div>
<table id="dataTable"></table>

<script src="/static/js/layui/layui.js?v=<?php echo config('hisiphp.version'); ?>"></script>
<script src="/static/js/jquery.2.1.4.min.js?v=<?php echo config('hisiphp.version'); ?>"></script>
<script>
    var ADMIN_PATH = "<?php echo htmlentities($_SERVER['SCRIPT_NAME']); ?>", LAYUI_OFFSET = 60;
    layui.config({
    	base: '/static/system/js/',
        version: '<?php echo config("hisiphp.version"); ?>'
    }).use('global');
</script>
<script src="/static/js/layui/lay_pageutil.js?v=<?php echo config('hisiphp.version'); ?>"></script>
<script src="/static/js/layui/pageutil.js?v=<?php echo config('hisiphp.version'); ?>"></script>

<script type="text/html" title="操作按钮模板" id="buttonTpl">
    <a href="<?php echo url('edit'); ?>?id={{ d.id }}" class="layui-btn layui-btn-xs layui-btn-normal" title="修改">修改</a>
	<a href="<?php echo url('del'); ?>?id={{ d.id }}" class="layui-btn layui-btn-xs layui-btn-danger j-tr-del">删除</a>
</script>

<script type="text/html" id="toolbar">
    <div class="layui-btn-group fl">
        <a href="<?php echo url('add'); ?>" class="layui-btn layui-btn-primary layui-btn-sm layui-icon layui-icon-add-circle-fine"  title="添加">&nbsp;添加</a>
        <a data-href="<?php echo url('del'); ?>" class="layui-btn layui-btn-primary layui-btn-sm j-page-btns confirm layui-icon layui-icon-close red">&nbsp;删除</a>
		<button id="upload_data_tag" class="layui-btn layui-btn-primary layui-btn-sm" lay-submit><i class="layui-icon" title="批量导入">&#xe62f;</i>批量导入</button>
		<a href="<?php echo url('download'); ?>" class="layui-btn layui-btn-primary layui-btn-sm"  title="批量导出"><i class="layui-icon" title="批量导出">&#xe601;</i>批量导出</a>
    </div>
</script>

<script type="text/javascript">
    layui.use(['table','upload'], function() {
        var table = layui.table;
		var upload = layui.upload;
		
        table.render({
            elem: '#dataTable'
            ,url: '<?php echo url(); ?>' //数据接口
            ,page: true //开启分页
            ,skin: 'row'
            ,even: true
            ,limit: 20
            ,text: {
                none : '暂无相关数据'
            }
            ,toolbar: '#toolbar'
            ,defaultToolbar: ['filter']
            ,cols: [[ //表头
                 {type:'checkbox',fixed:'left'}
				,{title: '操作',fixed:'left', templet: '#buttonTpl', width:150}
				,{field: 'struture',fixed:'left',width:150, title: '结构式', templet:function(d){
                    var str = '';
                    if(d.struture) {
                        str += '<img class="layui-upload-img" src="'+d.struture+'" >';
                    }
                    return str;
                }}
				,{field: 'file_name',width:200, title: '分析图谱', templet:function(d){
                    var str = '';
                    if(d.file_name) {
						str += '<a href="'+d.file+'">"'+d.file_name+'"</a>';
                    }
					str += '<button type="button" onclick="upFile('+d.id+');"  class="layui-btn layui-btn-small"> <i class="layui-icon" title="上传">';
						str += '</i>上传</button>';
                    return str;
                }}
				,{field: 'catalog', title: '货号', width: 100}
                ,{field: 'test_num', title: '送检单号', width: 100}
				,{field: 'name', title: '中文名称', width: 100}
                ,{field: 'ename', title: '英文名称', width: 100}
                ,{field: 'cas', title: 'CAS', width: 100}
				,{field: 'mdl', title: 'MDL', width: 100}
				,{field: 'purity', title: '纯度', width: 100}
				,{field: 'mf', title: '分子式', width: 100}
				,{field: 'mw', title: '分子量', width: 100}
                ,{field: 'nmr_num', title: '核磁编号', width: 100}
				,{field: 'nmr_method', title: '核磁方法', width: 100}
				,{field: 'po_num', title: 'PO', width: 100}
                ,{field: 'results', title: '分析结论', width: 100}
				,{field: 'store_name', title: '是否入库', width: 100}
				,{field: 'last_num', title: '最近一次谱图', width: 100}
                ,{field: 'appearance', title: '外观', width: 100}
				,{field: 'order_amount', title: '订购数量', width: 100}
				,{field: 'optical', title: '旋光', width: 100}
				,{field: 'optical_result', title: '旋光结果', width: 100}
                ,{field: 'ee', title: 'EE%', width: 100}
				,{field: 'ee_result', title: 'EE% 结果', width: 100}
				,{field: 'hplc_result', title: 'HPLC结果', width: 100}
				,{field: 'gc_result', title: 'GC结果', width: 100}
                ,{field: 'ms_result', title: 'MS结果', width: 100}
				,{field: 'accept_name', title: '是否接收', width: 100}
				,{field: 'caigou_name', title: '采购员', width: 100}
				,{field: 'caigou_tel', title: '采购员电话', width: 100}
				,{field: 'gendan_name', title: '跟单员', width: 100}
				,{field: 'gendan_tel', title: '跟单员电话', width: 100}
				,{field: 'dinggou_name', title: '订购人', width: 100}
				,{field: 'dinggou_tel', title: '订购人电话', width: 100}
				,{field: 'supplier', title: '供应商名称', width: 100}
				,{field: 'water_content', title: '含水量', width: 100}
				,{field: 'ph_num', title: 'PH值', width: 100}
				,{field: 'melting_point', title: '熔点', width: 100}
				,{field: 'batch_num', title: '批号', width: 100}
				,{field: 'caigou_super', title: '采购主管', width: 100}
				,{field: 'cangku_super', title: '库房主管', width: 100}
				,{field: 'dinggou_super', title: '订购人主管', width: 100}
				,{field: 'shouhuoren', title: '收货人', width: 100}
				,{field: 'remark', title: '备注', width: 100}
            ]]
        });
		var dao_url = '<?php echo url("uploadFile"); ?>';
		upload.render({
			 elem: '#upload_data_tag'
			 ,url: dao_url 
			 ,before: function(obj){ //obj参数包含的信息，跟 choose回调完全一致，可参见上文。
				 layer.open({type: 3});//信息加载,上传loading
			 }
			 ,done: function(res, index, upload){ //上传后的回调
				 layer.closeAll('loading'); //关闭loading
				 if(res.code="0") 
				 {  
					 ShowLayerMessage(res.info,5);
					 window.location.reload();
				 }
				 else
				 {
					 ShowLayerMessage("文件上传失败！",5);
				 }
			 } 
			 ,error: function(index, upload){
				layer.closeAll('loading'); //关闭loading
				ShowLayerMessage("文件上传出错！",5);
			 }
			 ,accept: 'file' //允许上传的文件类型
			 ,exts:'xlsx|docx|csv'	
			 ,size: 20480 //最大允许上传的文件大小，20M
		})
    });
</script>
<div id="file_edit_form_tag" class="guanli container-fluid layui-form layui-form-pane" style="display: none;">
	 <fieldset class="layui-elem-field ">
		<legend>增加谱图</legend>
		<input type="hidden" id="id_tag" name="id" >
	    <div class="layui-form-item">
			<fieldset id="upFileBut_tag" class="layui-elem-field site-demo-button">
				<div class="layui-btn-group">
					<button id="upload_file_tag" type="button" class="layui-btn" lay-filter="upFileBut"><i class="layui-icon" title="批量上传附件">&#xe62f;</i>附件上传</button>
				</div>
				<input type="hidden" class="field-file" name="file" id="file">
				<input type="hidden" class="field-file_name" name="file_name" id="file_name">
				<input type="hidden" class="field-file_size" name="file_size" id="file_size">
			</fieldset>
		   <fieldset class="layui-elem-field">
			  <legend>附件：</legend>
			  <div class="layui-field-box layui-upload-list">
				<table class="layui-table">
				   <thead>
					 <tr>
						<th>文件名</th>
						<th>大小(KB)</th>
						<th>操作</th>
					 </tr>
				   </thead>
				   <colgroup>
					<col>
					<col width="100">
					<col width="200">
				  </colgroup>
				  <tbody id="ask_file_list">
					
				  </tbody>
				</table>
			  </div>
		   </fieldset>
	 </div>
	 </fieldset>
	 <div class="layui-form-item" style="display: none;">
		<div class="layui-input-block">
			<button id="file_edit_save_tag" class="layui-btn" lay-submit lay-filter="fileEditSave">保存</button>
		</div>
	 </div>
</div>
<script>
	function upFile(id){
		$("#id_tag").val(id);
		var jsonText = 
		{
			'id':id
		};
		var ParamData = {"device_type":"0","json_text":JSON.stringify(jsonText)};
		var SysUrlStr = '<?php echo url("fileInfo"); ?>';
		layer.open({type: 3});//信息加载,上传loading
		DataInit(SysUrlStr,ParamData,file_obj_tag_init,Action_lay_ErrotFunction);
	}
	function file_obj_tag_init(curResult_obj)
	{
		var temObj = GetJSONObj(curResult_obj);
		if(temObj.code=="0")
		{ 
			layui_loading_close();
			console.log(temObj);
			var dataObj = temObj.data;
			var file_path  = dataObj.file;
			var file_name = dataObj.file_name;
			var file_size = dataObj.file_size;
			var dataHtmlStr='';
			if(dataObj)
			{ 
				 dataHtmlStr +='<tr>'
						    +'<td>'+file_name+'</td>'
						    +'<td>'+file_size+'k</td>'
					        +'<td>'
					        +'<button class="layui-btn layui-btn-small" lay-submit file_path="'+file_path+'" lay-filter="askFileDown"><i class="layui-icon" title="下载">&#xe601;</i>下载</button>'
					        +'</td>'
					        +'</tr>';
					Cur_Tag =  $("#ask_file_list");
					if(Cur_Tag) 
						Cur_Tag.html(dataHtmlStr);	
				$("#file").val(file_path);
				$("#file_name").val(file_name);
				$("#file_size").val(file_size);
				restult_open_show();
			}
		} 	 
		else 
		{ 
			Return_lay_ErrotFunction(temObj);
		}
	}
	
	function restult_open_show()
	{
		layui.use(['form','layer','laydate','table','upload'], function(){
			var form = layui.form
			  ,layer = layui.layer
			  ,table = layui.table
			  ,laydate = layui.laydate
			   ,upload = layui.upload;
				form.on('submit(askFileDown)', function(data){
					   var file_path = $(this).attr('file_path');
					   location.href=file_path;
					   return false;
				 });
				form.render();
			var upload_url = '<?php echo url("upload"); ?>';
			upload.render({
				 elem: '#upload_file_tag'
				 ,url: upload_url 
				 ,before: function(obj){ //obj参数包含的信息，跟 choose回调完全一致，可参见上文。
					 layer.open({type: 3});//信息加载,上传loading
				 }
				 ,done: function(res, index, upload){ //上传后的回调
					 layer.closeAll('loading'); //关闭loading
					 if(res.code="0") 
					 {  
						 var tem_obj = res.data;
						 var file_path = tem_obj.file;
						 var file_name = tem_obj.fileName;
						 var file_size = tem_obj.size;
						 var dataHtmlStr = '';
						 dataHtmlStr +='<tr>'
								+'<td>'+file_name+'</td>'
								+'<td>'+file_size+'k</td>'
								+'<td>'
								+'<button class="layui-btn layui-btn-small" lay-submit file_path="'+file_path+'" lay-filter="askFileDown"><i class="layui-icon" title="下载">&#xe601;</i>下载</button>'
								+'</td>'
								+'</tr>';
						Cur_Tag =  $("#ask_file_list");
						if(Cur_Tag) 
							Cur_Tag.html(dataHtmlStr);	
						$("#file").val(file_path);
						$("#file_name").val(file_name);
						$("#file_size").val(file_size);
					 }
					 else
					 {
						 ShowLayerMessage("文件上传失败！",5);
					 }
				 } 
				 ,error: function(index, upload){
					layer.closeAll('loading'); //关闭loading
					ShowLayerMessage("文件上传失败！",5);
				 }
				 ,accept: 'file' //允许上传的文件类型
				 ,exts:'xls|csv|xlsx|doc|docx|rar|zip'	
				 //,multiple:true //是否允许多文件上传。设置 true即可开启。不支持ie8/9		 
				  //,size: 50 //最大允许上传的文件大小
				  //,……
			})
			var title_str="分析谱图上传";
			pop_edit_form(layer,'file',title_str,750,350);
		    $(".layui-layer-page").css("z-index","198910151");
			$(".layui-layer-shade").css("display","none");
			form.on('submit(fileEditSave)', function(data){
				var jsonData = data.field;
				var json_text = create_json_text(jsonData);
				if(!IsNullOrBlank(json_text))
				{
					layer.open({type: 3});//信息加载,上传loading
					var ParamData = {"device_type":1,"json_text":json_text};
					var SysUrlStr = '<?php echo url("saveData"); ?>';
					DataInit(SysUrlStr,ParamData,ActionBack,Action_lay_ErrotFunction);	
				}
				return false;
			 });
		});
	}
	function create_json_text(jsonData)
	{
		var is_submit = true;
		var file = jsonData.file;
		if(file==''){
			ShowLayerMessage("请选择文件",5);
			is_submit = false;
			return "";
		}
		if(is_submit)
			return JSON.stringify(jsonData);
		else
			return "";
	}
	/**
 * 数据保存成功后的回调函数
 * @param curResult_obj
 */
function ActionBack(curResult_obj)
{
	 var temObj = GetJSONObj(curResult_obj);
	 
     if(temObj.code=="0")
	 {
		layui_pop_close();
		ShowLayerMessage(temObj.info,1);
		$(".layui-laypage-btn")[0].click();
     } 	 
	 else 
	 { 
	     Return_lay_ErrotFunction(temObj);
	 }
}

</script>
                    </div>
                </div>
            </div>
        </div>
    <?php break; default: ?>
        
        <div class="page-tab-content">
            <div class="layui-field-box">
<form class="layui-form" id="hisiSearch">
	<div class="layui-form-item mb0">
		<!--搜索  -->
		  <div class="layui-form-item">
			<div class="layui-input-inline">
				<input type="text" class="layui-input field-catalog" name="catalog" value="<?php echo input('get.catalog'); ?>"  lay-verify="required" autocomplete="off" placeholder="请输入货号">
			</div>
			<div class="layui-input-inline">
				<input type="text" class="layui-input field-name" name="name" lay-verify="required" autocomplete="off" placeholder="请输入中文名称">
			</div>

			<div class="layui-input-inline">
				<input type="text" class="layui-input field-ename" name="ename" lay-verify="required" autocomplete="off" placeholder="请输入英文名称">
			</div>
			<div class="layui-input-inline">
				<input type="text" class="layui-input field-cas" name="cas" lay-verify="required" autocomplete="off" placeholder="请输入CAS号">
			</div>
			 <div class="layui-input-inline">
				<input type="text" class="layui-input field-smiles" name="smiles" lay-verify="" autocomplete="off" placeholder="请输入Smiles">
			</div>
			 <div class="layui-input-inline">
				<input type="text" class="layui-input field-mdl" name="mdl" lay-verify="required" autocomplete="off" placeholder="请输入MDL">
			</div>
			 <div class="layui-input-inline">
				<input type="text" class="layui-input field-inchikey" name="inchikey" lay-verify="" autocomplete="off" placeholder="请输入InChIKey">
			</div>
			<button class="layui-btn search_btn" type="submit">搜索</button>
		  </div>
	</div>
</form>
</div>
<table id="dataTable"></table>

<script src="/static/js/layui/layui.js?v=<?php echo config('hisiphp.version'); ?>"></script>
<script src="/static/js/jquery.2.1.4.min.js?v=<?php echo config('hisiphp.version'); ?>"></script>
<script>
    var ADMIN_PATH = "<?php echo htmlentities($_SERVER['SCRIPT_NAME']); ?>", LAYUI_OFFSET = 60;
    layui.config({
    	base: '/static/system/js/',
        version: '<?php echo config("hisiphp.version"); ?>'
    }).use('global');
</script>
<script src="/static/js/layui/lay_pageutil.js?v=<?php echo config('hisiphp.version'); ?>"></script>
<script src="/static/js/layui/pageutil.js?v=<?php echo config('hisiphp.version'); ?>"></script>

<script type="text/html" title="操作按钮模板" id="buttonTpl">
    <a href="<?php echo url('edit'); ?>?id={{ d.id }}" class="layui-btn layui-btn-xs layui-btn-normal" title="修改">修改</a>
	<a href="<?php echo url('del'); ?>?id={{ d.id }}" class="layui-btn layui-btn-xs layui-btn-danger j-tr-del">删除</a>
</script>

<script type="text/html" id="toolbar">
    <div class="layui-btn-group fl">
        <a href="<?php echo url('add'); ?>" class="layui-btn layui-btn-primary layui-btn-sm layui-icon layui-icon-add-circle-fine"  title="添加">&nbsp;添加</a>
        <a data-href="<?php echo url('del'); ?>" class="layui-btn layui-btn-primary layui-btn-sm j-page-btns confirm layui-icon layui-icon-close red">&nbsp;删除</a>
		<button id="upload_data_tag" class="layui-btn layui-btn-primary layui-btn-sm" lay-submit><i class="layui-icon" title="批量导入">&#xe62f;</i>批量导入</button>
		<a href="<?php echo url('download'); ?>" class="layui-btn layui-btn-primary layui-btn-sm"  title="批量导出"><i class="layui-icon" title="批量导出">&#xe601;</i>批量导出</a>
    </div>
</script>

<script type="text/javascript">
    layui.use(['table','upload'], function() {
        var table = layui.table;
		var upload = layui.upload;
		
        table.render({
            elem: '#dataTable'
            ,url: '<?php echo url(); ?>' //数据接口
            ,page: true //开启分页
            ,skin: 'row'
            ,even: true
            ,limit: 20
            ,text: {
                none : '暂无相关数据'
            }
            ,toolbar: '#toolbar'
            ,defaultToolbar: ['filter']
            ,cols: [[ //表头
                 {type:'checkbox',fixed:'left'}
				,{title: '操作',fixed:'left', templet: '#buttonTpl', width:150}
				,{field: 'struture',fixed:'left',width:150, title: '结构式', templet:function(d){
                    var str = '';
                    if(d.struture) {
                        str += '<img class="layui-upload-img" src="'+d.struture+'" >';
                    }
                    return str;
                }}
				,{field: 'file_name',width:200, title: '分析图谱', templet:function(d){
                    var str = '';
                    if(d.file_name) {
						str += '<a href="'+d.file+'">"'+d.file_name+'"</a>';
                    }
					str += '<button type="button" onclick="upFile('+d.id+');"  class="layui-btn layui-btn-small"> <i class="layui-icon" title="上传">';
						str += '</i>上传</button>';
                    return str;
                }}
				,{field: 'catalog', title: '货号', width: 100}
                ,{field: 'test_num', title: '送检单号', width: 100}
				,{field: 'name', title: '中文名称', width: 100}
                ,{field: 'ename', title: '英文名称', width: 100}
                ,{field: 'cas', title: 'CAS', width: 100}
				,{field: 'mdl', title: 'MDL', width: 100}
				,{field: 'purity', title: '纯度', width: 100}
				,{field: 'mf', title: '分子式', width: 100}
				,{field: 'mw', title: '分子量', width: 100}
                ,{field: 'nmr_num', title: '核磁编号', width: 100}
				,{field: 'nmr_method', title: '核磁方法', width: 100}
				,{field: 'po_num', title: 'PO', width: 100}
                ,{field: 'results', title: '分析结论', width: 100}
				,{field: 'store_name', title: '是否入库', width: 100}
				,{field: 'last_num', title: '最近一次谱图', width: 100}
                ,{field: 'appearance', title: '外观', width: 100}
				,{field: 'order_amount', title: '订购数量', width: 100}
				,{field: 'optical', title: '旋光', width: 100}
				,{field: 'optical_result', title: '旋光结果', width: 100}
                ,{field: 'ee', title: 'EE%', width: 100}
				,{field: 'ee_result', title: 'EE% 结果', width: 100}
				,{field: 'hplc_result', title: 'HPLC结果', width: 100}
				,{field: 'gc_result', title: 'GC结果', width: 100}
                ,{field: 'ms_result', title: 'MS结果', width: 100}
				,{field: 'accept_name', title: '是否接收', width: 100}
				,{field: 'caigou_name', title: '采购员', width: 100}
				,{field: 'caigou_tel', title: '采购员电话', width: 100}
				,{field: 'gendan_name', title: '跟单员', width: 100}
				,{field: 'gendan_tel', title: '跟单员电话', width: 100}
				,{field: 'dinggou_name', title: '订购人', width: 100}
				,{field: 'dinggou_tel', title: '订购人电话', width: 100}
				,{field: 'supplier', title: '供应商名称', width: 100}
				,{field: 'water_content', title: '含水量', width: 100}
				,{field: 'ph_num', title: 'PH值', width: 100}
				,{field: 'melting_point', title: '熔点', width: 100}
				,{field: 'batch_num', title: '批号', width: 100}
				,{field: 'caigou_super', title: '采购主管', width: 100}
				,{field: 'cangku_super', title: '库房主管', width: 100}
				,{field: 'dinggou_super', title: '订购人主管', width: 100}
				,{field: 'shouhuoren', title: '收货人', width: 100}
				,{field: 'remark', title: '备注', width: 100}
            ]]
        });
		var dao_url = '<?php echo url("uploadFile"); ?>';
		upload.render({
			 elem: '#upload_data_tag'
			 ,url: dao_url 
			 ,before: function(obj){ //obj参数包含的信息，跟 choose回调完全一致，可参见上文。
				 layer.open({type: 3});//信息加载,上传loading
			 }
			 ,done: function(res, index, upload){ //上传后的回调
				 layer.closeAll('loading'); //关闭loading
				 if(res.code="0") 
				 {  
					 ShowLayerMessage(res.info,5);
					 window.location.reload();
				 }
				 else
				 {
					 ShowLayerMessage("文件上传失败！",5);
				 }
			 } 
			 ,error: function(index, upload){
				layer.closeAll('loading'); //关闭loading
				ShowLayerMessage("文件上传出错！",5);
			 }
			 ,accept: 'file' //允许上传的文件类型
			 ,exts:'xlsx|docx|csv'	
			 ,size: 20480 //最大允许上传的文件大小，20M
		})
    });
</script>
<div id="file_edit_form_tag" class="guanli container-fluid layui-form layui-form-pane" style="display: none;">
	 <fieldset class="layui-elem-field ">
		<legend>增加谱图</legend>
		<input type="hidden" id="id_tag" name="id" >
	    <div class="layui-form-item">
			<fieldset id="upFileBut_tag" class="layui-elem-field site-demo-button">
				<div class="layui-btn-group">
					<button id="upload_file_tag" type="button" class="layui-btn" lay-filter="upFileBut"><i class="layui-icon" title="批量上传附件">&#xe62f;</i>附件上传</button>
				</div>
				<input type="hidden" class="field-file" name="file" id="file">
				<input type="hidden" class="field-file_name" name="file_name" id="file_name">
				<input type="hidden" class="field-file_size" name="file_size" id="file_size">
			</fieldset>
		   <fieldset class="layui-elem-field">
			  <legend>附件：</legend>
			  <div class="layui-field-box layui-upload-list">
				<table class="layui-table">
				   <thead>
					 <tr>
						<th>文件名</th>
						<th>大小(KB)</th>
						<th>操作</th>
					 </tr>
				   </thead>
				   <colgroup>
					<col>
					<col width="100">
					<col width="200">
				  </colgroup>
				  <tbody id="ask_file_list">
					
				  </tbody>
				</table>
			  </div>
		   </fieldset>
	 </div>
	 </fieldset>
	 <div class="layui-form-item" style="display: none;">
		<div class="layui-input-block">
			<button id="file_edit_save_tag" class="layui-btn" lay-submit lay-filter="fileEditSave">保存</button>
		</div>
	 </div>
</div>
<script>
	function upFile(id){
		$("#id_tag").val(id);
		var jsonText = 
		{
			'id':id
		};
		var ParamData = {"device_type":"0","json_text":JSON.stringify(jsonText)};
		var SysUrlStr = '<?php echo url("fileInfo"); ?>';
		layer.open({type: 3});//信息加载,上传loading
		DataInit(SysUrlStr,ParamData,file_obj_tag_init,Action_lay_ErrotFunction);
	}
	function file_obj_tag_init(curResult_obj)
	{
		var temObj = GetJSONObj(curResult_obj);
		if(temObj.code=="0")
		{ 
			layui_loading_close();
			console.log(temObj);
			var dataObj = temObj.data;
			var file_path  = dataObj.file;
			var file_name = dataObj.file_name;
			var file_size = dataObj.file_size;
			var dataHtmlStr='';
			if(dataObj)
			{ 
				 dataHtmlStr +='<tr>'
						    +'<td>'+file_name+'</td>'
						    +'<td>'+file_size+'k</td>'
					        +'<td>'
					        +'<button class="layui-btn layui-btn-small" lay-submit file_path="'+file_path+'" lay-filter="askFileDown"><i class="layui-icon" title="下载">&#xe601;</i>下载</button>'
					        +'</td>'
					        +'</tr>';
					Cur_Tag =  $("#ask_file_list");
					if(Cur_Tag) 
						Cur_Tag.html(dataHtmlStr);	
				$("#file").val(file_path);
				$("#file_name").val(file_name);
				$("#file_size").val(file_size);
				restult_open_show();
			}
		} 	 
		else 
		{ 
			Return_lay_ErrotFunction(temObj);
		}
	}
	
	function restult_open_show()
	{
		layui.use(['form','layer','laydate','table','upload'], function(){
			var form = layui.form
			  ,layer = layui.layer
			  ,table = layui.table
			  ,laydate = layui.laydate
			   ,upload = layui.upload;
				form.on('submit(askFileDown)', function(data){
					   var file_path = $(this).attr('file_path');
					   location.href=file_path;
					   return false;
				 });
				form.render();
			var upload_url = '<?php echo url("upload"); ?>';
			upload.render({
				 elem: '#upload_file_tag'
				 ,url: upload_url 
				 ,before: function(obj){ //obj参数包含的信息，跟 choose回调完全一致，可参见上文。
					 layer.open({type: 3});//信息加载,上传loading
				 }
				 ,done: function(res, index, upload){ //上传后的回调
					 layer.closeAll('loading'); //关闭loading
					 if(res.code="0") 
					 {  
						 var tem_obj = res.data;
						 var file_path = tem_obj.file;
						 var file_name = tem_obj.fileName;
						 var file_size = tem_obj.size;
						 var dataHtmlStr = '';
						 dataHtmlStr +='<tr>'
								+'<td>'+file_name+'</td>'
								+'<td>'+file_size+'k</td>'
								+'<td>'
								+'<button class="layui-btn layui-btn-small" lay-submit file_path="'+file_path+'" lay-filter="askFileDown"><i class="layui-icon" title="下载">&#xe601;</i>下载</button>'
								+'</td>'
								+'</tr>';
						Cur_Tag =  $("#ask_file_list");
						if(Cur_Tag) 
							Cur_Tag.html(dataHtmlStr);	
						$("#file").val(file_path);
						$("#file_name").val(file_name);
						$("#file_size").val(file_size);
					 }
					 else
					 {
						 ShowLayerMessage("文件上传失败！",5);
					 }
				 } 
				 ,error: function(index, upload){
					layer.closeAll('loading'); //关闭loading
					ShowLayerMessage("文件上传失败！",5);
				 }
				 ,accept: 'file' //允许上传的文件类型
				 ,exts:'xls|csv|xlsx|doc|docx|rar|zip'	
				 //,multiple:true //是否允许多文件上传。设置 true即可开启。不支持ie8/9		 
				  //,size: 50 //最大允许上传的文件大小
				  //,……
			})
			var title_str="分析谱图上传";
			pop_edit_form(layer,'file',title_str,750,350);
		    $(".layui-layer-page").css("z-index","198910151");
			$(".layui-layer-shade").css("display","none");
			form.on('submit(fileEditSave)', function(data){
				var jsonData = data.field;
				var json_text = create_json_text(jsonData);
				if(!IsNullOrBlank(json_text))
				{
					layer.open({type: 3});//信息加载,上传loading
					var ParamData = {"device_type":1,"json_text":json_text};
					var SysUrlStr = '<?php echo url("saveData"); ?>';
					DataInit(SysUrlStr,ParamData,ActionBack,Action_lay_ErrotFunction);	
				}
				return false;
			 });
		});
	}
	function create_json_text(jsonData)
	{
		var is_submit = true;
		var file = jsonData.file;
		if(file==''){
			ShowLayerMessage("请选择文件",5);
			is_submit = false;
			return "";
		}
		if(is_submit)
			return JSON.stringify(jsonData);
		else
			return "";
	}
	/**
 * 数据保存成功后的回调函数
 * @param curResult_obj
 */
function ActionBack(curResult_obj)
{
	 var temObj = GetJSONObj(curResult_obj);
	 
     if(temObj.code=="0")
	 {
		layui_pop_close();
		ShowLayerMessage(temObj.info,1);
		$(".layui-laypage-btn")[0].click();
     } 	 
	 else 
	 { 
	     Return_lay_ErrotFunction(temObj);
	 }
}

</script>
        </div>
<?php endswitch; if(input('param.hisi_iframe') || cookie('hisi_iframe')): ?>
</body>
</html>
<?php else: ?>
        </div>
    </div>
    <div class="layui-footer footer">
        <span class="fl">Powered by <a href="<?php echo config('hisiphp.url'); ?>" target="_blank"><?php echo config('hisiphp.name'); ?></a> v<?php echo config('hisiphp.version'); ?></span>
        <span class="fr"> © 2018-2020 <a href="<?php echo config('hisiphp.url'); ?>" target="_blank"><?php echo config('hisiphp.copyright'); ?></a> All Rights Reserved.</span>
    </div>
</div>
</body>
</html>
<?php endif; ?>