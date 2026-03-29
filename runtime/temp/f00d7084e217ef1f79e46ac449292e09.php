<?php /*a:6:{s:55:"/www/chemical/application/system/view/inquiry/form.html";i:1774758333;s:49:"/www/chemical/application/system/view/layout.html";i:1766319013;s:55:"/www/chemical/application/system/view/block/header.html";i:1766319013;s:53:"/www/chemical/application/system/view/block/menu.html";i:1766319013;s:54:"/www/chemical/application/system/view/block/layui.html";i:1766319013;s:55:"/www/chemical/application/system/view/block/footer.html";i:1766319013;}*/ ?>
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
                        <form class="layui-form" action="<?php echo url(); ?>" method="post" id="editForm" lay-filter="editForm">

    <div class="layui-form-item">
        <label class="layui-form-label">货号</label>
        <div class="layui-input-inline" style="width:200px;">
            <input type="text" class="layui-input js-catalog" name="catalog" lay-verify="required" autocomplete="off" placeholder="请输入货号" id="field-catalog">
        </div>
        <div class="layui-input-inline<?php if(!empty($isEdit)): ?> layui-hide<?php endif; ?>" style="width:auto;">
            <button type="button" class="layui-btn layui-btn-primary layui-btn-sm js-lookup-product" id="btnLookupProduct">按货号查品名</button>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">CAS号</label>
        <div class="layui-input-inline" style="width:200px;">
            <input type="text" class="layui-input js-cas" name="cas" lay-verify="required" autocomplete="off" placeholder="请输入CAS号" id="field-cas">
        </div>
        <label class="layui-form-label">商品名称</label>
        <div class="layui-input-inline" style="width:280px;">
            <input type="text" class="layui-input js-product-name" name="product_name" readonly autocomplete="off" placeholder="根据货号自动带出" id="field-product_name">
        </div>
    </div>

    <fieldset class="layui-elem-field layui-field-title" style="margin-top:16px;">
        <legend>供应商报价（最多10家）</legend>
    </fieldset>
    <div id="supplierRows"></div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button type="button" class="layui-btn layui-btn-primary" id="btnAddSupplier"><i class="layui-icon">&#xe654;</i> 添加供应商</button>
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-input-block">
            <?php echo token(); ?>
            <input type="hidden" class="field-id" name="id" id="field-id">
            <input type="hidden" class="field-inquiry_no" name="inquiry_no" id="field-inquiry_no">
        </div>
    </div>
    <div class="pop-bottom-bar">
        <button type="submit" class="layui-btn layui-btn-normal" lay-submit="" lay-filter="formSubmit" hisi-data="{pop: true, refresh: true}">提交保存</button>
        <a href="javascript:parent.layui.layer.closeAll();" class="layui-btn layui-btn-primary ml10">取消</a>
    </div>
</form>

<script type="text/html" id="tplSupplierRow">
    <div class="layui-card supplier-row" style="margin-bottom:12px;">
        <div class="layui-card-header" style="display:flex;align-items:center;justify-content:space-between;">
            <span>供应商报价 <span class="row-label"></span></span>
            <button type="button" class="layui-btn layui-btn-danger layui-btn-xs btn-remove-row">删除</button>
        </div>
        <div class="layui-card-body">
            <div class="layui-form-item">
                <label class="layui-form-label">供应商</label>
                <div class="layui-input-inline" style="width:200px;">
                    <input type="text" class="layui-input item-supplier" lay-verify="required" autocomplete="off" placeholder="供应商名称">
                </div>
                <label class="layui-form-label">数量</label>
                <div class="layui-input-inline" style="width:120px;">
                    <input type="text" class="layui-input item-quantity" autocomplete="off" placeholder="数量">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">不含税价</label>
                <div class="layui-input-inline" style="width:120px;">
                    <input type="text" class="layui-input item-price_excluding_tax" autocomplete="off" placeholder="不含税价">
                </div>
                <label class="layui-form-label">总价</label>
                <div class="layui-input-inline" style="width:120px;">
                    <input type="text" class="layui-input item-total_price" autocomplete="off" placeholder="总价">
                </div>
                <label class="layui-form-label">税率</label>
                <div class="layui-input-inline" style="width:100px;">
                    <input type="text" class="layui-input item-tax_rate" autocomplete="off" placeholder="税率%">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">发票类型</label>
                <div class="layui-input-inline" style="width:160px;">
                    <select class="item-invoice_type">
                        <option value="1">普通发票</option>
                        <option value="2">专用发票</option>
                    </select>
                </div>
                <label class="layui-form-label">谱图</label>
                <div class="layui-input-inline" style="width:200px;">
                    <input type="radio" class="item-need_spectrum" name="need_spectrum_placeholder" value="1" title="是" checked>
                    <input type="radio" class="item-need_spectrum" name="need_spectrum_placeholder" value="0" title="否">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">备注</label>
                <div class="layui-input-inline" style="width:400px;">
                    <input type="text" class="layui-input item-remark" autocomplete="off" placeholder="备注">
                </div>
            </div>
            <input type="hidden" class="item-supplier_id" value="0">
        </div>
    </div>
</script>

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
var formData = <?php echo json_encode(isset($formData) ? $formData : []); ?>;
var itemsJson = <?php echo json_encode(isset($itemsJson) ? $itemsJson : [], JSON_UNESCAPED_UNICODE); ?>;
var isEdit = <?php echo json_encode(!empty($isEdit)); ?>;
var lookupUrl = "<?php echo url('add'); ?>";

layui.use(['form', 'func', 'upload', 'jquery'], function() {
    var $ = layui.jquery, form = layui.form;
    var maxSuppliers = 10;
    var tplHtml = $('#tplSupplierRow').html();

    function rowCount() {
        return $('#supplierRows .supplier-row').length;
    }

    function updateAddButtonState() {
        $('#btnAddSupplier').prop('disabled', rowCount() >= maxSuppliers);
    }

    function reindexRowNames() {
        $('#supplierRows .supplier-row').each(function(i) {
            var $row = $(this);
            $row.find('.row-label').text('#' + (i + 1));
            $row.find('.item-supplier').attr('name', 'items[' + i + '][supplier]');
            $row.find('.item-quantity').attr('name', 'items[' + i + '][quantity]');
            $row.find('.item-price_excluding_tax').attr('name', 'items[' + i + '][price_excluding_tax]');
            $row.find('.item-total_price').attr('name', 'items[' + i + '][total_price]');
            $row.find('.item-tax_rate').attr('name', 'items[' + i + '][tax_rate]');
            $row.find('.item-invoice_type').attr('name', 'items[' + i + '][invoice_type]');
            $row.find('.item-remark').attr('name', 'items[' + i + '][remark]');
            $row.find('.item-supplier_id').attr('name', 'items[' + i + '][supplier_id]');
            $row.find('.item-need_spectrum').attr('name', 'items[' + i + '][need_spectrum]');
        });
        form.render('select');
        form.render('radio');
    }

    function addRow(data) {
        if (rowCount() >= maxSuppliers) {
            layer.msg('最多添加10个供应商', {icon: 0});
            return;
        }
        var $node = $(tplHtml);
        $('#supplierRows').append($node);
        if (data) {
            $node.find('.item-supplier').val(data.supplier || '');
            $node.find('.item-quantity').val(data.quantity != null ? data.quantity : '');
            $node.find('.item-price_excluding_tax').val(data.price_excluding_tax != null ? data.price_excluding_tax : '');
            $node.find('.item-total_price').val(data.total_price != null ? data.total_price : '');
            $node.find('.item-tax_rate').val(data.tax_rate != null ? data.tax_rate : '');
            $node.find('.item-invoice_type').val(String(data.invoice_type != null ? data.invoice_type : '1'));
            $node.find('.item-remark').val(data.remark || '');
            $node.find('.item-supplier_id').val(data.supplier_id != null ? data.supplier_id : 0);
            var ns = String(data.need_spectrum == null ? 1 : data.need_spectrum);
            $node.find('.item-need_spectrum[value="' + ns + '"]').prop('checked', true);
        }
        reindexRowNames();
        updateAddButtonState();
    }

    $('#btnAddSupplier').on('click', function() {
        addRow(null);
    });

    $('#supplierRows').on('click', '.btn-remove-row', function() {
        if (rowCount() <= 1) {
            layer.msg('至少保留一行供应商报价', {icon: 0});
            return;
        }
        $(this).closest('.supplier-row').remove();
        reindexRowNames();
        updateAddButtonState();
    });

    function runLookup() {
        var catalog = $.trim($('#field-catalog').val());
        if (!catalog) {
            layer.msg('请先输入货号', {icon: 0});
            return;
        }
        $.ajax({
            url: lookupUrl,
            data: {lookup_catalog: catalog},
            dataType: 'json',
            headers: {'X-Requested-With': 'XMLHttpRequest'}
        }).done(function(res) {
            if (res.code !== 0) {
                layer.msg(res.msg || '查询失败', {icon: 2});
                return;
            }
            var d = res.data || {};
            $('#field-product_name').val(d.name || '');
            if (!isEdit && d.cas) {
                $('#field-cas').val(d.cas);
            }
        }).fail(function() {
            layer.msg('请求失败', {icon: 2});
        });
    }

    $('#btnLookupProduct').on('click', runLookup);
    $('#field-catalog').on('blur', function() {
        if (!isEdit) {
            runLookup();
        }
    });

    if (isEdit) {
        $('#field-catalog').prop('readonly', true);
        $('#field-cas').prop('readonly', true);
        $('#field-product_name').prop('readonly', true);
        layui.func.assign(formData);
        $('#field-id').val(formData.id || '');
        $('#field-inquiry_no').val(formData.inquiry_no || '');
        $('#field-catalog').val(formData.catalog || '');
        $('#field-cas').val(formData.cas || '');
        $('#field-product_name').val(formData.product_name || '');
        var arr = Array.isArray(itemsJson) ? itemsJson : [];
        if (!arr.length) {
            addRow(null);
        } else {
            for (var j = 0; j < arr.length; j++) {
                addRow(arr[j]);
            }
        }
    } else {
        layui.func.assign(formData);
        addRow(null);
    }

    form.render('select');
    form.render('radio');
});
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
                    <form class="layui-form" action="<?php echo url(); ?>" method="post" id="editForm" lay-filter="editForm">

    <div class="layui-form-item">
        <label class="layui-form-label">货号</label>
        <div class="layui-input-inline" style="width:200px;">
            <input type="text" class="layui-input js-catalog" name="catalog" lay-verify="required" autocomplete="off" placeholder="请输入货号" id="field-catalog">
        </div>
        <div class="layui-input-inline<?php if(!empty($isEdit)): ?> layui-hide<?php endif; ?>" style="width:auto;">
            <button type="button" class="layui-btn layui-btn-primary layui-btn-sm js-lookup-product" id="btnLookupProduct">按货号查品名</button>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">CAS号</label>
        <div class="layui-input-inline" style="width:200px;">
            <input type="text" class="layui-input js-cas" name="cas" lay-verify="required" autocomplete="off" placeholder="请输入CAS号" id="field-cas">
        </div>
        <label class="layui-form-label">商品名称</label>
        <div class="layui-input-inline" style="width:280px;">
            <input type="text" class="layui-input js-product-name" name="product_name" readonly autocomplete="off" placeholder="根据货号自动带出" id="field-product_name">
        </div>
    </div>

    <fieldset class="layui-elem-field layui-field-title" style="margin-top:16px;">
        <legend>供应商报价（最多10家）</legend>
    </fieldset>
    <div id="supplierRows"></div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button type="button" class="layui-btn layui-btn-primary" id="btnAddSupplier"><i class="layui-icon">&#xe654;</i> 添加供应商</button>
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-input-block">
            <?php echo token(); ?>
            <input type="hidden" class="field-id" name="id" id="field-id">
            <input type="hidden" class="field-inquiry_no" name="inquiry_no" id="field-inquiry_no">
        </div>
    </div>
    <div class="pop-bottom-bar">
        <button type="submit" class="layui-btn layui-btn-normal" lay-submit="" lay-filter="formSubmit" hisi-data="{pop: true, refresh: true}">提交保存</button>
        <a href="javascript:parent.layui.layer.closeAll();" class="layui-btn layui-btn-primary ml10">取消</a>
    </div>
</form>

<script type="text/html" id="tplSupplierRow">
    <div class="layui-card supplier-row" style="margin-bottom:12px;">
        <div class="layui-card-header" style="display:flex;align-items:center;justify-content:space-between;">
            <span>供应商报价 <span class="row-label"></span></span>
            <button type="button" class="layui-btn layui-btn-danger layui-btn-xs btn-remove-row">删除</button>
        </div>
        <div class="layui-card-body">
            <div class="layui-form-item">
                <label class="layui-form-label">供应商</label>
                <div class="layui-input-inline" style="width:200px;">
                    <input type="text" class="layui-input item-supplier" lay-verify="required" autocomplete="off" placeholder="供应商名称">
                </div>
                <label class="layui-form-label">数量</label>
                <div class="layui-input-inline" style="width:120px;">
                    <input type="text" class="layui-input item-quantity" autocomplete="off" placeholder="数量">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">不含税价</label>
                <div class="layui-input-inline" style="width:120px;">
                    <input type="text" class="layui-input item-price_excluding_tax" autocomplete="off" placeholder="不含税价">
                </div>
                <label class="layui-form-label">总价</label>
                <div class="layui-input-inline" style="width:120px;">
                    <input type="text" class="layui-input item-total_price" autocomplete="off" placeholder="总价">
                </div>
                <label class="layui-form-label">税率</label>
                <div class="layui-input-inline" style="width:100px;">
                    <input type="text" class="layui-input item-tax_rate" autocomplete="off" placeholder="税率%">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">发票类型</label>
                <div class="layui-input-inline" style="width:160px;">
                    <select class="item-invoice_type">
                        <option value="1">普通发票</option>
                        <option value="2">专用发票</option>
                    </select>
                </div>
                <label class="layui-form-label">谱图</label>
                <div class="layui-input-inline" style="width:200px;">
                    <input type="radio" class="item-need_spectrum" name="need_spectrum_placeholder" value="1" title="是" checked>
                    <input type="radio" class="item-need_spectrum" name="need_spectrum_placeholder" value="0" title="否">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">备注</label>
                <div class="layui-input-inline" style="width:400px;">
                    <input type="text" class="layui-input item-remark" autocomplete="off" placeholder="备注">
                </div>
            </div>
            <input type="hidden" class="item-supplier_id" value="0">
        </div>
    </div>
</script>

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
var formData = <?php echo json_encode(isset($formData) ? $formData : []); ?>;
var itemsJson = <?php echo json_encode(isset($itemsJson) ? $itemsJson : [], JSON_UNESCAPED_UNICODE); ?>;
var isEdit = <?php echo json_encode(!empty($isEdit)); ?>;
var lookupUrl = "<?php echo url('add'); ?>";

layui.use(['form', 'func', 'upload', 'jquery'], function() {
    var $ = layui.jquery, form = layui.form;
    var maxSuppliers = 10;
    var tplHtml = $('#tplSupplierRow').html();

    function rowCount() {
        return $('#supplierRows .supplier-row').length;
    }

    function updateAddButtonState() {
        $('#btnAddSupplier').prop('disabled', rowCount() >= maxSuppliers);
    }

    function reindexRowNames() {
        $('#supplierRows .supplier-row').each(function(i) {
            var $row = $(this);
            $row.find('.row-label').text('#' + (i + 1));
            $row.find('.item-supplier').attr('name', 'items[' + i + '][supplier]');
            $row.find('.item-quantity').attr('name', 'items[' + i + '][quantity]');
            $row.find('.item-price_excluding_tax').attr('name', 'items[' + i + '][price_excluding_tax]');
            $row.find('.item-total_price').attr('name', 'items[' + i + '][total_price]');
            $row.find('.item-tax_rate').attr('name', 'items[' + i + '][tax_rate]');
            $row.find('.item-invoice_type').attr('name', 'items[' + i + '][invoice_type]');
            $row.find('.item-remark').attr('name', 'items[' + i + '][remark]');
            $row.find('.item-supplier_id').attr('name', 'items[' + i + '][supplier_id]');
            $row.find('.item-need_spectrum').attr('name', 'items[' + i + '][need_spectrum]');
        });
        form.render('select');
        form.render('radio');
    }

    function addRow(data) {
        if (rowCount() >= maxSuppliers) {
            layer.msg('最多添加10个供应商', {icon: 0});
            return;
        }
        var $node = $(tplHtml);
        $('#supplierRows').append($node);
        if (data) {
            $node.find('.item-supplier').val(data.supplier || '');
            $node.find('.item-quantity').val(data.quantity != null ? data.quantity : '');
            $node.find('.item-price_excluding_tax').val(data.price_excluding_tax != null ? data.price_excluding_tax : '');
            $node.find('.item-total_price').val(data.total_price != null ? data.total_price : '');
            $node.find('.item-tax_rate').val(data.tax_rate != null ? data.tax_rate : '');
            $node.find('.item-invoice_type').val(String(data.invoice_type != null ? data.invoice_type : '1'));
            $node.find('.item-remark').val(data.remark || '');
            $node.find('.item-supplier_id').val(data.supplier_id != null ? data.supplier_id : 0);
            var ns = String(data.need_spectrum == null ? 1 : data.need_spectrum);
            $node.find('.item-need_spectrum[value="' + ns + '"]').prop('checked', true);
        }
        reindexRowNames();
        updateAddButtonState();
    }

    $('#btnAddSupplier').on('click', function() {
        addRow(null);
    });

    $('#supplierRows').on('click', '.btn-remove-row', function() {
        if (rowCount() <= 1) {
            layer.msg('至少保留一行供应商报价', {icon: 0});
            return;
        }
        $(this).closest('.supplier-row').remove();
        reindexRowNames();
        updateAddButtonState();
    });

    function runLookup() {
        var catalog = $.trim($('#field-catalog').val());
        if (!catalog) {
            layer.msg('请先输入货号', {icon: 0});
            return;
        }
        $.ajax({
            url: lookupUrl,
            data: {lookup_catalog: catalog},
            dataType: 'json',
            headers: {'X-Requested-With': 'XMLHttpRequest'}
        }).done(function(res) {
            if (res.code !== 0) {
                layer.msg(res.msg || '查询失败', {icon: 2});
                return;
            }
            var d = res.data || {};
            $('#field-product_name').val(d.name || '');
            if (!isEdit && d.cas) {
                $('#field-cas').val(d.cas);
            }
        }).fail(function() {
            layer.msg('请求失败', {icon: 2});
        });
    }

    $('#btnLookupProduct').on('click', runLookup);
    $('#field-catalog').on('blur', function() {
        if (!isEdit) {
            runLookup();
        }
    });

    if (isEdit) {
        $('#field-catalog').prop('readonly', true);
        $('#field-cas').prop('readonly', true);
        $('#field-product_name').prop('readonly', true);
        layui.func.assign(formData);
        $('#field-id').val(formData.id || '');
        $('#field-inquiry_no').val(formData.inquiry_no || '');
        $('#field-catalog').val(formData.catalog || '');
        $('#field-cas').val(formData.cas || '');
        $('#field-product_name').val(formData.product_name || '');
        var arr = Array.isArray(itemsJson) ? itemsJson : [];
        if (!arr.length) {
            addRow(null);
        } else {
            for (var j = 0; j < arr.length; j++) {
                addRow(arr[j]);
            }
        }
    } else {
        layui.func.assign(formData);
        addRow(null);
    }

    form.render('select');
    form.render('radio');
});
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
                        <form class="layui-form" action="<?php echo url(); ?>" method="post" id="editForm" lay-filter="editForm">

    <div class="layui-form-item">
        <label class="layui-form-label">货号</label>
        <div class="layui-input-inline" style="width:200px;">
            <input type="text" class="layui-input js-catalog" name="catalog" lay-verify="required" autocomplete="off" placeholder="请输入货号" id="field-catalog">
        </div>
        <div class="layui-input-inline<?php if(!empty($isEdit)): ?> layui-hide<?php endif; ?>" style="width:auto;">
            <button type="button" class="layui-btn layui-btn-primary layui-btn-sm js-lookup-product" id="btnLookupProduct">按货号查品名</button>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">CAS号</label>
        <div class="layui-input-inline" style="width:200px;">
            <input type="text" class="layui-input js-cas" name="cas" lay-verify="required" autocomplete="off" placeholder="请输入CAS号" id="field-cas">
        </div>
        <label class="layui-form-label">商品名称</label>
        <div class="layui-input-inline" style="width:280px;">
            <input type="text" class="layui-input js-product-name" name="product_name" readonly autocomplete="off" placeholder="根据货号自动带出" id="field-product_name">
        </div>
    </div>

    <fieldset class="layui-elem-field layui-field-title" style="margin-top:16px;">
        <legend>供应商报价（最多10家）</legend>
    </fieldset>
    <div id="supplierRows"></div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button type="button" class="layui-btn layui-btn-primary" id="btnAddSupplier"><i class="layui-icon">&#xe654;</i> 添加供应商</button>
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-input-block">
            <?php echo token(); ?>
            <input type="hidden" class="field-id" name="id" id="field-id">
            <input type="hidden" class="field-inquiry_no" name="inquiry_no" id="field-inquiry_no">
        </div>
    </div>
    <div class="pop-bottom-bar">
        <button type="submit" class="layui-btn layui-btn-normal" lay-submit="" lay-filter="formSubmit" hisi-data="{pop: true, refresh: true}">提交保存</button>
        <a href="javascript:parent.layui.layer.closeAll();" class="layui-btn layui-btn-primary ml10">取消</a>
    </div>
</form>

<script type="text/html" id="tplSupplierRow">
    <div class="layui-card supplier-row" style="margin-bottom:12px;">
        <div class="layui-card-header" style="display:flex;align-items:center;justify-content:space-between;">
            <span>供应商报价 <span class="row-label"></span></span>
            <button type="button" class="layui-btn layui-btn-danger layui-btn-xs btn-remove-row">删除</button>
        </div>
        <div class="layui-card-body">
            <div class="layui-form-item">
                <label class="layui-form-label">供应商</label>
                <div class="layui-input-inline" style="width:200px;">
                    <input type="text" class="layui-input item-supplier" lay-verify="required" autocomplete="off" placeholder="供应商名称">
                </div>
                <label class="layui-form-label">数量</label>
                <div class="layui-input-inline" style="width:120px;">
                    <input type="text" class="layui-input item-quantity" autocomplete="off" placeholder="数量">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">不含税价</label>
                <div class="layui-input-inline" style="width:120px;">
                    <input type="text" class="layui-input item-price_excluding_tax" autocomplete="off" placeholder="不含税价">
                </div>
                <label class="layui-form-label">总价</label>
                <div class="layui-input-inline" style="width:120px;">
                    <input type="text" class="layui-input item-total_price" autocomplete="off" placeholder="总价">
                </div>
                <label class="layui-form-label">税率</label>
                <div class="layui-input-inline" style="width:100px;">
                    <input type="text" class="layui-input item-tax_rate" autocomplete="off" placeholder="税率%">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">发票类型</label>
                <div class="layui-input-inline" style="width:160px;">
                    <select class="item-invoice_type">
                        <option value="1">普通发票</option>
                        <option value="2">专用发票</option>
                    </select>
                </div>
                <label class="layui-form-label">谱图</label>
                <div class="layui-input-inline" style="width:200px;">
                    <input type="radio" class="item-need_spectrum" name="need_spectrum_placeholder" value="1" title="是" checked>
                    <input type="radio" class="item-need_spectrum" name="need_spectrum_placeholder" value="0" title="否">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">备注</label>
                <div class="layui-input-inline" style="width:400px;">
                    <input type="text" class="layui-input item-remark" autocomplete="off" placeholder="备注">
                </div>
            </div>
            <input type="hidden" class="item-supplier_id" value="0">
        </div>
    </div>
</script>

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
var formData = <?php echo json_encode(isset($formData) ? $formData : []); ?>;
var itemsJson = <?php echo json_encode(isset($itemsJson) ? $itemsJson : [], JSON_UNESCAPED_UNICODE); ?>;
var isEdit = <?php echo json_encode(!empty($isEdit)); ?>;
var lookupUrl = "<?php echo url('add'); ?>";

layui.use(['form', 'func', 'upload', 'jquery'], function() {
    var $ = layui.jquery, form = layui.form;
    var maxSuppliers = 10;
    var tplHtml = $('#tplSupplierRow').html();

    function rowCount() {
        return $('#supplierRows .supplier-row').length;
    }

    function updateAddButtonState() {
        $('#btnAddSupplier').prop('disabled', rowCount() >= maxSuppliers);
    }

    function reindexRowNames() {
        $('#supplierRows .supplier-row').each(function(i) {
            var $row = $(this);
            $row.find('.row-label').text('#' + (i + 1));
            $row.find('.item-supplier').attr('name', 'items[' + i + '][supplier]');
            $row.find('.item-quantity').attr('name', 'items[' + i + '][quantity]');
            $row.find('.item-price_excluding_tax').attr('name', 'items[' + i + '][price_excluding_tax]');
            $row.find('.item-total_price').attr('name', 'items[' + i + '][total_price]');
            $row.find('.item-tax_rate').attr('name', 'items[' + i + '][tax_rate]');
            $row.find('.item-invoice_type').attr('name', 'items[' + i + '][invoice_type]');
            $row.find('.item-remark').attr('name', 'items[' + i + '][remark]');
            $row.find('.item-supplier_id').attr('name', 'items[' + i + '][supplier_id]');
            $row.find('.item-need_spectrum').attr('name', 'items[' + i + '][need_spectrum]');
        });
        form.render('select');
        form.render('radio');
    }

    function addRow(data) {
        if (rowCount() >= maxSuppliers) {
            layer.msg('最多添加10个供应商', {icon: 0});
            return;
        }
        var $node = $(tplHtml);
        $('#supplierRows').append($node);
        if (data) {
            $node.find('.item-supplier').val(data.supplier || '');
            $node.find('.item-quantity').val(data.quantity != null ? data.quantity : '');
            $node.find('.item-price_excluding_tax').val(data.price_excluding_tax != null ? data.price_excluding_tax : '');
            $node.find('.item-total_price').val(data.total_price != null ? data.total_price : '');
            $node.find('.item-tax_rate').val(data.tax_rate != null ? data.tax_rate : '');
            $node.find('.item-invoice_type').val(String(data.invoice_type != null ? data.invoice_type : '1'));
            $node.find('.item-remark').val(data.remark || '');
            $node.find('.item-supplier_id').val(data.supplier_id != null ? data.supplier_id : 0);
            var ns = String(data.need_spectrum == null ? 1 : data.need_spectrum);
            $node.find('.item-need_spectrum[value="' + ns + '"]').prop('checked', true);
        }
        reindexRowNames();
        updateAddButtonState();
    }

    $('#btnAddSupplier').on('click', function() {
        addRow(null);
    });

    $('#supplierRows').on('click', '.btn-remove-row', function() {
        if (rowCount() <= 1) {
            layer.msg('至少保留一行供应商报价', {icon: 0});
            return;
        }
        $(this).closest('.supplier-row').remove();
        reindexRowNames();
        updateAddButtonState();
    });

    function runLookup() {
        var catalog = $.trim($('#field-catalog').val());
        if (!catalog) {
            layer.msg('请先输入货号', {icon: 0});
            return;
        }
        $.ajax({
            url: lookupUrl,
            data: {lookup_catalog: catalog},
            dataType: 'json',
            headers: {'X-Requested-With': 'XMLHttpRequest'}
        }).done(function(res) {
            if (res.code !== 0) {
                layer.msg(res.msg || '查询失败', {icon: 2});
                return;
            }
            var d = res.data || {};
            $('#field-product_name').val(d.name || '');
            if (!isEdit && d.cas) {
                $('#field-cas').val(d.cas);
            }
        }).fail(function() {
            layer.msg('请求失败', {icon: 2});
        });
    }

    $('#btnLookupProduct').on('click', runLookup);
    $('#field-catalog').on('blur', function() {
        if (!isEdit) {
            runLookup();
        }
    });

    if (isEdit) {
        $('#field-catalog').prop('readonly', true);
        $('#field-cas').prop('readonly', true);
        $('#field-product_name').prop('readonly', true);
        layui.func.assign(formData);
        $('#field-id').val(formData.id || '');
        $('#field-inquiry_no').val(formData.inquiry_no || '');
        $('#field-catalog').val(formData.catalog || '');
        $('#field-cas').val(formData.cas || '');
        $('#field-product_name').val(formData.product_name || '');
        var arr = Array.isArray(itemsJson) ? itemsJson : [];
        if (!arr.length) {
            addRow(null);
        } else {
            for (var j = 0; j < arr.length; j++) {
                addRow(arr[j]);
            }
        }
    } else {
        layui.func.assign(formData);
        addRow(null);
    }

    form.render('select');
    form.render('radio');
});
</script>

                    </div>
                </div>
            </div>
        </div>
    <?php break; default: ?>
        
        <div class="page-tab-content">
            <form class="layui-form" action="<?php echo url(); ?>" method="post" id="editForm" lay-filter="editForm">

    <div class="layui-form-item">
        <label class="layui-form-label">货号</label>
        <div class="layui-input-inline" style="width:200px;">
            <input type="text" class="layui-input js-catalog" name="catalog" lay-verify="required" autocomplete="off" placeholder="请输入货号" id="field-catalog">
        </div>
        <div class="layui-input-inline<?php if(!empty($isEdit)): ?> layui-hide<?php endif; ?>" style="width:auto;">
            <button type="button" class="layui-btn layui-btn-primary layui-btn-sm js-lookup-product" id="btnLookupProduct">按货号查品名</button>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">CAS号</label>
        <div class="layui-input-inline" style="width:200px;">
            <input type="text" class="layui-input js-cas" name="cas" lay-verify="required" autocomplete="off" placeholder="请输入CAS号" id="field-cas">
        </div>
        <label class="layui-form-label">商品名称</label>
        <div class="layui-input-inline" style="width:280px;">
            <input type="text" class="layui-input js-product-name" name="product_name" readonly autocomplete="off" placeholder="根据货号自动带出" id="field-product_name">
        </div>
    </div>

    <fieldset class="layui-elem-field layui-field-title" style="margin-top:16px;">
        <legend>供应商报价（最多10家）</legend>
    </fieldset>
    <div id="supplierRows"></div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button type="button" class="layui-btn layui-btn-primary" id="btnAddSupplier"><i class="layui-icon">&#xe654;</i> 添加供应商</button>
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-input-block">
            <?php echo token(); ?>
            <input type="hidden" class="field-id" name="id" id="field-id">
            <input type="hidden" class="field-inquiry_no" name="inquiry_no" id="field-inquiry_no">
        </div>
    </div>
    <div class="pop-bottom-bar">
        <button type="submit" class="layui-btn layui-btn-normal" lay-submit="" lay-filter="formSubmit" hisi-data="{pop: true, refresh: true}">提交保存</button>
        <a href="javascript:parent.layui.layer.closeAll();" class="layui-btn layui-btn-primary ml10">取消</a>
    </div>
</form>

<script type="text/html" id="tplSupplierRow">
    <div class="layui-card supplier-row" style="margin-bottom:12px;">
        <div class="layui-card-header" style="display:flex;align-items:center;justify-content:space-between;">
            <span>供应商报价 <span class="row-label"></span></span>
            <button type="button" class="layui-btn layui-btn-danger layui-btn-xs btn-remove-row">删除</button>
        </div>
        <div class="layui-card-body">
            <div class="layui-form-item">
                <label class="layui-form-label">供应商</label>
                <div class="layui-input-inline" style="width:200px;">
                    <input type="text" class="layui-input item-supplier" lay-verify="required" autocomplete="off" placeholder="供应商名称">
                </div>
                <label class="layui-form-label">数量</label>
                <div class="layui-input-inline" style="width:120px;">
                    <input type="text" class="layui-input item-quantity" autocomplete="off" placeholder="数量">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">不含税价</label>
                <div class="layui-input-inline" style="width:120px;">
                    <input type="text" class="layui-input item-price_excluding_tax" autocomplete="off" placeholder="不含税价">
                </div>
                <label class="layui-form-label">总价</label>
                <div class="layui-input-inline" style="width:120px;">
                    <input type="text" class="layui-input item-total_price" autocomplete="off" placeholder="总价">
                </div>
                <label class="layui-form-label">税率</label>
                <div class="layui-input-inline" style="width:100px;">
                    <input type="text" class="layui-input item-tax_rate" autocomplete="off" placeholder="税率%">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">发票类型</label>
                <div class="layui-input-inline" style="width:160px;">
                    <select class="item-invoice_type">
                        <option value="1">普通发票</option>
                        <option value="2">专用发票</option>
                    </select>
                </div>
                <label class="layui-form-label">谱图</label>
                <div class="layui-input-inline" style="width:200px;">
                    <input type="radio" class="item-need_spectrum" name="need_spectrum_placeholder" value="1" title="是" checked>
                    <input type="radio" class="item-need_spectrum" name="need_spectrum_placeholder" value="0" title="否">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">备注</label>
                <div class="layui-input-inline" style="width:400px;">
                    <input type="text" class="layui-input item-remark" autocomplete="off" placeholder="备注">
                </div>
            </div>
            <input type="hidden" class="item-supplier_id" value="0">
        </div>
    </div>
</script>

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
var formData = <?php echo json_encode(isset($formData) ? $formData : []); ?>;
var itemsJson = <?php echo json_encode(isset($itemsJson) ? $itemsJson : [], JSON_UNESCAPED_UNICODE); ?>;
var isEdit = <?php echo json_encode(!empty($isEdit)); ?>;
var lookupUrl = "<?php echo url('add'); ?>";

layui.use(['form', 'func', 'upload', 'jquery'], function() {
    var $ = layui.jquery, form = layui.form;
    var maxSuppliers = 10;
    var tplHtml = $('#tplSupplierRow').html();

    function rowCount() {
        return $('#supplierRows .supplier-row').length;
    }

    function updateAddButtonState() {
        $('#btnAddSupplier').prop('disabled', rowCount() >= maxSuppliers);
    }

    function reindexRowNames() {
        $('#supplierRows .supplier-row').each(function(i) {
            var $row = $(this);
            $row.find('.row-label').text('#' + (i + 1));
            $row.find('.item-supplier').attr('name', 'items[' + i + '][supplier]');
            $row.find('.item-quantity').attr('name', 'items[' + i + '][quantity]');
            $row.find('.item-price_excluding_tax').attr('name', 'items[' + i + '][price_excluding_tax]');
            $row.find('.item-total_price').attr('name', 'items[' + i + '][total_price]');
            $row.find('.item-tax_rate').attr('name', 'items[' + i + '][tax_rate]');
            $row.find('.item-invoice_type').attr('name', 'items[' + i + '][invoice_type]');
            $row.find('.item-remark').attr('name', 'items[' + i + '][remark]');
            $row.find('.item-supplier_id').attr('name', 'items[' + i + '][supplier_id]');
            $row.find('.item-need_spectrum').attr('name', 'items[' + i + '][need_spectrum]');
        });
        form.render('select');
        form.render('radio');
    }

    function addRow(data) {
        if (rowCount() >= maxSuppliers) {
            layer.msg('最多添加10个供应商', {icon: 0});
            return;
        }
        var $node = $(tplHtml);
        $('#supplierRows').append($node);
        if (data) {
            $node.find('.item-supplier').val(data.supplier || '');
            $node.find('.item-quantity').val(data.quantity != null ? data.quantity : '');
            $node.find('.item-price_excluding_tax').val(data.price_excluding_tax != null ? data.price_excluding_tax : '');
            $node.find('.item-total_price').val(data.total_price != null ? data.total_price : '');
            $node.find('.item-tax_rate').val(data.tax_rate != null ? data.tax_rate : '');
            $node.find('.item-invoice_type').val(String(data.invoice_type != null ? data.invoice_type : '1'));
            $node.find('.item-remark').val(data.remark || '');
            $node.find('.item-supplier_id').val(data.supplier_id != null ? data.supplier_id : 0);
            var ns = String(data.need_spectrum == null ? 1 : data.need_spectrum);
            $node.find('.item-need_spectrum[value="' + ns + '"]').prop('checked', true);
        }
        reindexRowNames();
        updateAddButtonState();
    }

    $('#btnAddSupplier').on('click', function() {
        addRow(null);
    });

    $('#supplierRows').on('click', '.btn-remove-row', function() {
        if (rowCount() <= 1) {
            layer.msg('至少保留一行供应商报价', {icon: 0});
            return;
        }
        $(this).closest('.supplier-row').remove();
        reindexRowNames();
        updateAddButtonState();
    });

    function runLookup() {
        var catalog = $.trim($('#field-catalog').val());
        if (!catalog) {
            layer.msg('请先输入货号', {icon: 0});
            return;
        }
        $.ajax({
            url: lookupUrl,
            data: {lookup_catalog: catalog},
            dataType: 'json',
            headers: {'X-Requested-With': 'XMLHttpRequest'}
        }).done(function(res) {
            if (res.code !== 0) {
                layer.msg(res.msg || '查询失败', {icon: 2});
                return;
            }
            var d = res.data || {};
            $('#field-product_name').val(d.name || '');
            if (!isEdit && d.cas) {
                $('#field-cas').val(d.cas);
            }
        }).fail(function() {
            layer.msg('请求失败', {icon: 2});
        });
    }

    $('#btnLookupProduct').on('click', runLookup);
    $('#field-catalog').on('blur', function() {
        if (!isEdit) {
            runLookup();
        }
    });

    if (isEdit) {
        $('#field-catalog').prop('readonly', true);
        $('#field-cas').prop('readonly', true);
        $('#field-product_name').prop('readonly', true);
        layui.func.assign(formData);
        $('#field-id').val(formData.id || '');
        $('#field-inquiry_no').val(formData.inquiry_no || '');
        $('#field-catalog').val(formData.catalog || '');
        $('#field-cas').val(formData.cas || '');
        $('#field-product_name').val(formData.product_name || '');
        var arr = Array.isArray(itemsJson) ? itemsJson : [];
        if (!arr.length) {
            addRow(null);
        } else {
            for (var j = 0; j < arr.length; j++) {
                addRow(arr[j]);
            }
        }
    } else {
        layui.func.assign(formData);
        addRow(null);
    }

    form.render('select');
    form.render('radio');
});
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