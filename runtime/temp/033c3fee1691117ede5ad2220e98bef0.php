<?php /*a:6:{s:56:"/www/chemical/application/system/view/purchase/form.html";i:1774765698;s:49:"/www/chemical/application/system/view/layout.html";i:1766319013;s:55:"/www/chemical/application/system/view/block/header.html";i:1766319013;s:53:"/www/chemical/application/system/view/block/menu.html";i:1766319013;s:54:"/www/chemical/application/system/view/block/layui.html";i:1766319013;s:55:"/www/chemical/application/system/view/block/footer.html";i:1766319013;}*/ ?>
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
                        <form class="layui-form" action="<?php echo url(); ?>" method="post"  lay-filter="editForm">
 
    <div class="layui-form-item">
		<label class="layui-form-label">货号</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-catalog" name="catalog" lay-verify="required" autocomplete="off" placeholder="请输入货号">
        </div>
		<label class="layui-form-label">CAS号</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-cas" name="cas" lay-verify="" autocomplete="off" placeholder="请输入CAS号">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">询价单号</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-inquiry_no" name="inquiry_no" lay-verify="" autocomplete="off" placeholder="请输入询价单号">
        </div>
        <label class="layui-form-label">数量</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-quantity" name="quantity" lay-verify="" autocomplete="off" placeholder="请输入数量">
        </div>
        <label class="layui-form-label">单位</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-unit" name="unit" lay-verify="" autocomplete="off" placeholder="请输入单位">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">不含税价格</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-price_excluding_tax" name="price_excluding_tax" lay-verify="" autocomplete="off" placeholder="请输入不含税价格">
        </div>
        <label class="layui-form-label">总价格</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-total_price" name="total_price" lay-verify="" autocomplete="off" placeholder="请输入总价">
        </div>
        <label class="layui-form-label">税率</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-tax_rate" name="tax_rate" lay-verify="" autocomplete="off" placeholder="请输入税率">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">供应商名称</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-supplier" name="supplier" lay-verify="" autocomplete="off" placeholder="请输入供应商名称">
        </div>
        <label class="layui-form-label">发票类型</label>
        <div class="layui-input-inline">
            <select name="invoice_type" lay-verify="">
                <option value="1" selected>普通发票</option>
                <option value="2">专用发票</option>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">运单号</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-tracking_no" name="tracking_no" lay-verify="" autocomplete="off" placeholder="请输入运单号">
        </div>
		<label class="layui-form-label">运单信息</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-tracking_info" name="tracking_info" lay-verify="" autocomplete="off" placeholder="请输入运单信息">
        </div>
        <label class="layui-form-label">是否提供谱图</label>
        <div class="layui-input-inline">
            <input type="radio" class="field-need_spectrum" name="need_spectrum" value="1" title="是" checked>
            <input type="radio" class="field-need_spectrum" name="need_spectrum" value="0" title="否">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">采购员</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-purchase_person" name="purchase_person" lay-verify="" autocomplete="off" placeholder="请输入采购员">
        </div>
        <label class="layui-form-label">采购日前</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-purchase_date" name="purchase_date" lay-verify="" autocomplete="off" placeholder="采购日前">
        </div>
        <label class="layui-form-label">要求到货日期</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-delivery_date" name="delivery_date" lay-verify="" autocomplete="off" placeholder="请输入要求到货日前">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">实际到货日前</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-actual_delivery_date" name="actual_delivery_date" lay-verify="" autocomplete="off" placeholder="请输入实际到货日前">
        </div>
        <label class="layui-form-label">备注</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-remark" name="remark" lay-verify="" autocomplete="off" placeholder="备注">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <?php echo token(); ?>
            <input type="hidden" class="field-id" name="id">
            <input type="hidden" class="field-supplier_id" name="supplier_id" value="0">
        </div>
    </div>
    <div class="pop-bottom-bar">
        <button type="submit" class="layui-btn layui-btn-normal" lay-submit="" lay-filter="formSubmit" hisi-data="{pop: true, refresh: true}">提交保存</button>
        <a href="javascript:parent.layui.layer.closeAll();" class="layui-btn layui-btn-primary ml10">取消</a>
    </div>
    </form>
    <script src="/static/js/layui/layui.js?v=<?php echo config('hisiphp.version'); ?>"></script>
<script src="/static/js/jquery.2.1.4.min.js?v=<?php echo config('hisiphp.version'); ?>"></script>
<script>
    var ADMIN_PATH = "<?php echo htmlentities($_SERVER['SCRIPT_NAME']); ?>", LAYUI_OFFSET = 60;
    layui.config({
    	base: '/static/system/js/',
        version: '<?php echo config("hisiphp.version"); ?>'
    }).use('global');
</script>
    <script>
    var formData = <?php echo json_encode($formData); ?>;
    layui.use(['form', 'func','upload'], function() {
        var $ = layui.jquery, form = layui.form, upload = layui.upload;
        layui.func.assign(formData);
        var fv = {
            invoice_type: formData.invoice_type != null && formData.invoice_type !== ''
                ? String(formData.invoice_type) : '1'
        };
        if (formData.need_spectrum !== undefined && formData.need_spectrum !== null) {
            fv.need_spectrum = String(formData.need_spectrum);
        }
        form.val('editForm', fv);
        form.render('select');
        form.render('radio');
    });
	function ShowLayerMessage(msgStr,msgIndex)
	{
		layui.use(['layer'], function(){
			var layer = layui.layer;
			layer.msg(msgStr, {icon: msgIndex});
		});
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
                    <form class="layui-form" action="<?php echo url(); ?>" method="post"  lay-filter="editForm">
 
    <div class="layui-form-item">
		<label class="layui-form-label">货号</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-catalog" name="catalog" lay-verify="required" autocomplete="off" placeholder="请输入货号">
        </div>
		<label class="layui-form-label">CAS号</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-cas" name="cas" lay-verify="" autocomplete="off" placeholder="请输入CAS号">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">询价单号</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-inquiry_no" name="inquiry_no" lay-verify="" autocomplete="off" placeholder="请输入询价单号">
        </div>
        <label class="layui-form-label">数量</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-quantity" name="quantity" lay-verify="" autocomplete="off" placeholder="请输入数量">
        </div>
        <label class="layui-form-label">单位</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-unit" name="unit" lay-verify="" autocomplete="off" placeholder="请输入单位">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">不含税价格</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-price_excluding_tax" name="price_excluding_tax" lay-verify="" autocomplete="off" placeholder="请输入不含税价格">
        </div>
        <label class="layui-form-label">总价格</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-total_price" name="total_price" lay-verify="" autocomplete="off" placeholder="请输入总价">
        </div>
        <label class="layui-form-label">税率</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-tax_rate" name="tax_rate" lay-verify="" autocomplete="off" placeholder="请输入税率">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">供应商名称</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-supplier" name="supplier" lay-verify="" autocomplete="off" placeholder="请输入供应商名称">
        </div>
        <label class="layui-form-label">发票类型</label>
        <div class="layui-input-inline">
            <select name="invoice_type" lay-verify="">
                <option value="1" selected>普通发票</option>
                <option value="2">专用发票</option>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">运单号</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-tracking_no" name="tracking_no" lay-verify="" autocomplete="off" placeholder="请输入运单号">
        </div>
		<label class="layui-form-label">运单信息</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-tracking_info" name="tracking_info" lay-verify="" autocomplete="off" placeholder="请输入运单信息">
        </div>
        <label class="layui-form-label">是否提供谱图</label>
        <div class="layui-input-inline">
            <input type="radio" class="field-need_spectrum" name="need_spectrum" value="1" title="是" checked>
            <input type="radio" class="field-need_spectrum" name="need_spectrum" value="0" title="否">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">采购员</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-purchase_person" name="purchase_person" lay-verify="" autocomplete="off" placeholder="请输入采购员">
        </div>
        <label class="layui-form-label">采购日前</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-purchase_date" name="purchase_date" lay-verify="" autocomplete="off" placeholder="采购日前">
        </div>
        <label class="layui-form-label">要求到货日期</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-delivery_date" name="delivery_date" lay-verify="" autocomplete="off" placeholder="请输入要求到货日前">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">实际到货日前</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-actual_delivery_date" name="actual_delivery_date" lay-verify="" autocomplete="off" placeholder="请输入实际到货日前">
        </div>
        <label class="layui-form-label">备注</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-remark" name="remark" lay-verify="" autocomplete="off" placeholder="备注">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <?php echo token(); ?>
            <input type="hidden" class="field-id" name="id">
            <input type="hidden" class="field-supplier_id" name="supplier_id" value="0">
        </div>
    </div>
    <div class="pop-bottom-bar">
        <button type="submit" class="layui-btn layui-btn-normal" lay-submit="" lay-filter="formSubmit" hisi-data="{pop: true, refresh: true}">提交保存</button>
        <a href="javascript:parent.layui.layer.closeAll();" class="layui-btn layui-btn-primary ml10">取消</a>
    </div>
    </form>
    <script src="/static/js/layui/layui.js?v=<?php echo config('hisiphp.version'); ?>"></script>
<script src="/static/js/jquery.2.1.4.min.js?v=<?php echo config('hisiphp.version'); ?>"></script>
<script>
    var ADMIN_PATH = "<?php echo htmlentities($_SERVER['SCRIPT_NAME']); ?>", LAYUI_OFFSET = 60;
    layui.config({
    	base: '/static/system/js/',
        version: '<?php echo config("hisiphp.version"); ?>'
    }).use('global');
</script>
    <script>
    var formData = <?php echo json_encode($formData); ?>;
    layui.use(['form', 'func','upload'], function() {
        var $ = layui.jquery, form = layui.form, upload = layui.upload;
        layui.func.assign(formData);
        var fv = {
            invoice_type: formData.invoice_type != null && formData.invoice_type !== ''
                ? String(formData.invoice_type) : '1'
        };
        if (formData.need_spectrum !== undefined && formData.need_spectrum !== null) {
            fv.need_spectrum = String(formData.need_spectrum);
        }
        form.val('editForm', fv);
        form.render('select');
        form.render('radio');
    });
	function ShowLayerMessage(msgStr,msgIndex)
	{
		layui.use(['layer'], function(){
			var layer = layui.layer;
			layer.msg(msgStr, {icon: msgIndex});
		});
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
                        <form class="layui-form" action="<?php echo url(); ?>" method="post"  lay-filter="editForm">
 
    <div class="layui-form-item">
		<label class="layui-form-label">货号</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-catalog" name="catalog" lay-verify="required" autocomplete="off" placeholder="请输入货号">
        </div>
		<label class="layui-form-label">CAS号</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-cas" name="cas" lay-verify="" autocomplete="off" placeholder="请输入CAS号">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">询价单号</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-inquiry_no" name="inquiry_no" lay-verify="" autocomplete="off" placeholder="请输入询价单号">
        </div>
        <label class="layui-form-label">数量</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-quantity" name="quantity" lay-verify="" autocomplete="off" placeholder="请输入数量">
        </div>
        <label class="layui-form-label">单位</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-unit" name="unit" lay-verify="" autocomplete="off" placeholder="请输入单位">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">不含税价格</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-price_excluding_tax" name="price_excluding_tax" lay-verify="" autocomplete="off" placeholder="请输入不含税价格">
        </div>
        <label class="layui-form-label">总价格</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-total_price" name="total_price" lay-verify="" autocomplete="off" placeholder="请输入总价">
        </div>
        <label class="layui-form-label">税率</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-tax_rate" name="tax_rate" lay-verify="" autocomplete="off" placeholder="请输入税率">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">供应商名称</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-supplier" name="supplier" lay-verify="" autocomplete="off" placeholder="请输入供应商名称">
        </div>
        <label class="layui-form-label">发票类型</label>
        <div class="layui-input-inline">
            <select name="invoice_type" lay-verify="">
                <option value="1" selected>普通发票</option>
                <option value="2">专用发票</option>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">运单号</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-tracking_no" name="tracking_no" lay-verify="" autocomplete="off" placeholder="请输入运单号">
        </div>
		<label class="layui-form-label">运单信息</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-tracking_info" name="tracking_info" lay-verify="" autocomplete="off" placeholder="请输入运单信息">
        </div>
        <label class="layui-form-label">是否提供谱图</label>
        <div class="layui-input-inline">
            <input type="radio" class="field-need_spectrum" name="need_spectrum" value="1" title="是" checked>
            <input type="radio" class="field-need_spectrum" name="need_spectrum" value="0" title="否">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">采购员</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-purchase_person" name="purchase_person" lay-verify="" autocomplete="off" placeholder="请输入采购员">
        </div>
        <label class="layui-form-label">采购日前</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-purchase_date" name="purchase_date" lay-verify="" autocomplete="off" placeholder="采购日前">
        </div>
        <label class="layui-form-label">要求到货日期</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-delivery_date" name="delivery_date" lay-verify="" autocomplete="off" placeholder="请输入要求到货日前">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">实际到货日前</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-actual_delivery_date" name="actual_delivery_date" lay-verify="" autocomplete="off" placeholder="请输入实际到货日前">
        </div>
        <label class="layui-form-label">备注</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-remark" name="remark" lay-verify="" autocomplete="off" placeholder="备注">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <?php echo token(); ?>
            <input type="hidden" class="field-id" name="id">
            <input type="hidden" class="field-supplier_id" name="supplier_id" value="0">
        </div>
    </div>
    <div class="pop-bottom-bar">
        <button type="submit" class="layui-btn layui-btn-normal" lay-submit="" lay-filter="formSubmit" hisi-data="{pop: true, refresh: true}">提交保存</button>
        <a href="javascript:parent.layui.layer.closeAll();" class="layui-btn layui-btn-primary ml10">取消</a>
    </div>
    </form>
    <script src="/static/js/layui/layui.js?v=<?php echo config('hisiphp.version'); ?>"></script>
<script src="/static/js/jquery.2.1.4.min.js?v=<?php echo config('hisiphp.version'); ?>"></script>
<script>
    var ADMIN_PATH = "<?php echo htmlentities($_SERVER['SCRIPT_NAME']); ?>", LAYUI_OFFSET = 60;
    layui.config({
    	base: '/static/system/js/',
        version: '<?php echo config("hisiphp.version"); ?>'
    }).use('global');
</script>
    <script>
    var formData = <?php echo json_encode($formData); ?>;
    layui.use(['form', 'func','upload'], function() {
        var $ = layui.jquery, form = layui.form, upload = layui.upload;
        layui.func.assign(formData);
        var fv = {
            invoice_type: formData.invoice_type != null && formData.invoice_type !== ''
                ? String(formData.invoice_type) : '1'
        };
        if (formData.need_spectrum !== undefined && formData.need_spectrum !== null) {
            fv.need_spectrum = String(formData.need_spectrum);
        }
        form.val('editForm', fv);
        form.render('select');
        form.render('radio');
    });
	function ShowLayerMessage(msgStr,msgIndex)
	{
		layui.use(['layer'], function(){
			var layer = layui.layer;
			layer.msg(msgStr, {icon: msgIndex});
		});
	}
    </script>

                    </div>
                </div>
            </div>
        </div>
    <?php break; default: ?>
        
        <div class="page-tab-content">
            <form class="layui-form" action="<?php echo url(); ?>" method="post"  lay-filter="editForm">
 
    <div class="layui-form-item">
		<label class="layui-form-label">货号</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-catalog" name="catalog" lay-verify="required" autocomplete="off" placeholder="请输入货号">
        </div>
		<label class="layui-form-label">CAS号</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-cas" name="cas" lay-verify="" autocomplete="off" placeholder="请输入CAS号">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">询价单号</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-inquiry_no" name="inquiry_no" lay-verify="" autocomplete="off" placeholder="请输入询价单号">
        </div>
        <label class="layui-form-label">数量</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-quantity" name="quantity" lay-verify="" autocomplete="off" placeholder="请输入数量">
        </div>
        <label class="layui-form-label">单位</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-unit" name="unit" lay-verify="" autocomplete="off" placeholder="请输入单位">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">不含税价格</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-price_excluding_tax" name="price_excluding_tax" lay-verify="" autocomplete="off" placeholder="请输入不含税价格">
        </div>
        <label class="layui-form-label">总价格</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-total_price" name="total_price" lay-verify="" autocomplete="off" placeholder="请输入总价">
        </div>
        <label class="layui-form-label">税率</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-tax_rate" name="tax_rate" lay-verify="" autocomplete="off" placeholder="请输入税率">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">供应商名称</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-supplier" name="supplier" lay-verify="" autocomplete="off" placeholder="请输入供应商名称">
        </div>
        <label class="layui-form-label">发票类型</label>
        <div class="layui-input-inline">
            <select name="invoice_type" lay-verify="">
                <option value="1" selected>普通发票</option>
                <option value="2">专用发票</option>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">运单号</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-tracking_no" name="tracking_no" lay-verify="" autocomplete="off" placeholder="请输入运单号">
        </div>
		<label class="layui-form-label">运单信息</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-tracking_info" name="tracking_info" lay-verify="" autocomplete="off" placeholder="请输入运单信息">
        </div>
        <label class="layui-form-label">是否提供谱图</label>
        <div class="layui-input-inline">
            <input type="radio" class="field-need_spectrum" name="need_spectrum" value="1" title="是" checked>
            <input type="radio" class="field-need_spectrum" name="need_spectrum" value="0" title="否">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">采购员</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-purchase_person" name="purchase_person" lay-verify="" autocomplete="off" placeholder="请输入采购员">
        </div>
        <label class="layui-form-label">采购日前</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-purchase_date" name="purchase_date" lay-verify="" autocomplete="off" placeholder="采购日前">
        </div>
        <label class="layui-form-label">要求到货日期</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-delivery_date" name="delivery_date" lay-verify="" autocomplete="off" placeholder="请输入要求到货日前">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">实际到货日前</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-actual_delivery_date" name="actual_delivery_date" lay-verify="" autocomplete="off" placeholder="请输入实际到货日前">
        </div>
        <label class="layui-form-label">备注</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input field-remark" name="remark" lay-verify="" autocomplete="off" placeholder="备注">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <?php echo token(); ?>
            <input type="hidden" class="field-id" name="id">
            <input type="hidden" class="field-supplier_id" name="supplier_id" value="0">
        </div>
    </div>
    <div class="pop-bottom-bar">
        <button type="submit" class="layui-btn layui-btn-normal" lay-submit="" lay-filter="formSubmit" hisi-data="{pop: true, refresh: true}">提交保存</button>
        <a href="javascript:parent.layui.layer.closeAll();" class="layui-btn layui-btn-primary ml10">取消</a>
    </div>
    </form>
    <script src="/static/js/layui/layui.js?v=<?php echo config('hisiphp.version'); ?>"></script>
<script src="/static/js/jquery.2.1.4.min.js?v=<?php echo config('hisiphp.version'); ?>"></script>
<script>
    var ADMIN_PATH = "<?php echo htmlentities($_SERVER['SCRIPT_NAME']); ?>", LAYUI_OFFSET = 60;
    layui.config({
    	base: '/static/system/js/',
        version: '<?php echo config("hisiphp.version"); ?>'
    }).use('global');
</script>
    <script>
    var formData = <?php echo json_encode($formData); ?>;
    layui.use(['form', 'func','upload'], function() {
        var $ = layui.jquery, form = layui.form, upload = layui.upload;
        layui.func.assign(formData);
        var fv = {
            invoice_type: formData.invoice_type != null && formData.invoice_type !== ''
                ? String(formData.invoice_type) : '1'
        };
        if (formData.need_spectrum !== undefined && formData.need_spectrum !== null) {
            fv.need_spectrum = String(formData.need_spectrum);
        }
        form.val('editForm', fv);
        form.render('select');
        form.render('radio');
    });
	function ShowLayerMessage(msgStr,msgIndex)
	{
		layui.use(['layer'], function(){
			var layer = layui.layer;
			layer.msg(msgStr, {icon: msgIndex});
		});
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