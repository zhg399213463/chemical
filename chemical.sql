/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : chemical

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-10-29 21:54:10
*/

SET
FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for hisi_jobs
-- ----------------------------
DROP TABLE IF EXISTS `hisi_jobs`;
CREATE TABLE `hisi_jobs`
(
    `id`           int(11) NOT NULL AUTO_INCREMENT,
    `queue`        varchar(255) NOT NULL,
    `payload`      longtext     NOT NULL,
    `attempts`     tinyint(3) unsigned NOT NULL,
    `reserved`     tinyint(3) unsigned NOT NULL,
    `reserved_at`  int(10) unsigned DEFAULT NULL,
    `available_at` int(10) unsigned NOT NULL,
    `created_at`   int(10) unsigned NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hisi_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for hisi_system_annex
-- ----------------------------
DROP TABLE IF EXISTS `hisi_system_annex`;
CREATE TABLE `hisi_system_annex`
(
    `id`      int(10) unsigned NOT NULL AUTO_INCREMENT,
    `data_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '关联的数据ID',
    `type`    varchar(20)  NOT NULL DEFAULT '' COMMENT '类型',
    `group`   varchar(100) NOT NULL DEFAULT 'sys' COMMENT '文件分组',
    `file`    varchar(255) NOT NULL COMMENT '上传文件',
    `hash`    varchar(64)  NOT NULL COMMENT '文件hash值',
    `size`    decimal(12, 2) unsigned NOT NULL DEFAULT '0.00' COMMENT '附件大小KB',
    `status`  tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '使用状态(0未使用，1已使用)',
    `ctime`   int(10) unsigned NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    UNIQUE KEY `hash` (`hash`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[系统] 上传附件';

-- ----------------------------
-- Records of hisi_system_annex
-- ----------------------------

-- ----------------------------
-- Table structure for hisi_system_annex_group
-- ----------------------------
DROP TABLE IF EXISTS `hisi_system_annex_group`;
CREATE TABLE `hisi_system_annex_group`
(
    `id`    int(10) unsigned NOT NULL AUTO_INCREMENT,
    `name`  varchar(50)    NOT NULL COMMENT '附件分组',
    `count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '附件数量',
    `size`  decimal(12, 2) NOT NULL DEFAULT '0.00' COMMENT '附件大小kb',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[系统] 附件分组';

-- ----------------------------
-- Records of hisi_system_annex_group
-- ----------------------------

-- ----------------------------
-- Table structure for hisi_system_config
-- ----------------------------
DROP TABLE IF EXISTS `hisi_system_config`;
CREATE TABLE `hisi_system_config`
(
    `id`      int(10) unsigned NOT NULL AUTO_INCREMENT,
    `system`  tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否为系统配置(1是，0否)',
    `group`   varchar(20)  NOT NULL DEFAULT 'base' COMMENT '分组',
    `title`   varchar(20)  NOT NULL COMMENT '配置标题',
    `name`    varchar(50)  NOT NULL COMMENT '配置名称，由英文字母和下划线组成',
    `value`   text         NOT NULL COMMENT '配置值',
    `type`    varchar(20)  NOT NULL DEFAULT 'input' COMMENT '配置类型()',
    `options` text         NOT NULL COMMENT '配置项(选项名:选项值)',
    `url`     varchar(255) NOT NULL DEFAULT '' COMMENT '文件上传接口',
    `tips`    varchar(255) NOT NULL COMMENT '配置提示',
    `sort`    int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
    `status`  tinyint(1) unsigned NOT NULL COMMENT '状态',
    `ctime`   int(10) unsigned NOT NULL DEFAULT '0',
    `mtime`   int(10) unsigned NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COMMENT='[系统] 系统配置';

-- ----------------------------
-- Records of hisi_system_config
-- ----------------------------
INSERT INTO `hisi_system_config`
VALUES ('1', '1', 'sys', '扩展配置分组', 'config_group', '', 'array', ' ', '',
        '请按如下格式填写：&lt;br&gt;键值:键名&lt;br&gt;键值:键名&lt;br&gt;&lt;span style=&quot;color:#f00&quot;&gt;键值只能为英文、数字、下划线&lt;/span&gt;',
        '2', '1', '1492140215', '1492140215');
INSERT INTO `hisi_system_config`
VALUES ('13', '1', 'base', '网站域名', 'site_domain', '', 'input', '', '', '', '2', '1', '1492140215', '1492140215');
INSERT INTO `hisi_system_config`
VALUES ('14', '1', 'upload', '图片上传大小限制', 'upload_image_size', '0', 'input', '', '', '单位：KB，0表示不限制大小', '3', '1',
        '1490841797', '1491040778');
INSERT INTO `hisi_system_config`
VALUES ('15', '1', 'upload', '允许上传图片格式', 'upload_image_ext', 'jpg,png,gif,jpeg,ico', 'input', '', '', '多个格式请用英文逗号（,）隔开',
        '4', '1', '1490842130', '1491040778');
INSERT INTO `hisi_system_config`
VALUES ('16', '1', 'upload', '缩略图裁剪方式', 'thumb_type', '2', 'select',
        '1:等比例缩放\r\n2:缩放后填充\r\n3:居中裁剪\r\n4:左上角裁剪\r\n5:右下角裁剪\r\n6:固定尺寸缩放\r\n', '', '', '5', '1', '1490842450',
        '1491040778');
INSERT INTO `hisi_system_config`
VALUES ('17', '1', 'upload', '图片水印开关', 'image_watermark', '1', 'switch', '0:关闭\r\n1:开启', '', '', '6', '1', '1490842583',
        '1491040778');
INSERT INTO `hisi_system_config`
VALUES ('18', '1', 'upload', '图片水印图', 'image_watermark_pic', '', 'image', '', '', '', '7', '1', '1490842679',
        '1491040778');
INSERT INTO `hisi_system_config`
VALUES ('19', '1', 'upload', '图片水印透明度', 'image_watermark_opacity', '50', 'input', '', '', '可设置值为0~100，数字越小，透明度越高', '8',
        '1', '1490857704', '1491040778');
INSERT INTO `hisi_system_config`
VALUES ('20', '1', 'upload', '图片水印图位置', 'image_watermark_location', '9', 'select',
        '7:左下角\r\n1:左上角\r\n4:左居中\r\n9:右下角\r\n3:右上角\r\n6:右居中\r\n2:上居中\r\n8:下居中\r\n5:居中', '', '', '9', '1', '1490858228',
        '1491040778');
INSERT INTO `hisi_system_config`
VALUES ('21', '1', 'upload', '文件上传大小限制', 'upload_file_size', '0', 'input', '', '', '单位：KB，0表示不限制大小', '1', '1',
        '1490859167', '1491040778');
INSERT INTO `hisi_system_config`
VALUES ('22', '1', 'upload', '允许上传文件格式', 'upload_file_ext', 'doc,docx,xls,xlsx,ppt,pptx,pdf,wps,txt,rar,zip', 'input',
        '', '', '多个格式请用英文逗号（,）隔开', '2', '1', '1490859246', '1491040778');
INSERT INTO `hisi_system_config`
VALUES ('23', '1', 'upload', '文字水印开关', 'text_watermark', '0', 'switch', '0:关闭\r\n1:开启', '', '', '10', '1', '1490860872',
        '1491040778');
INSERT INTO `hisi_system_config`
VALUES ('24', '1', 'upload', '文字水印内容', 'text_watermark_content', '', 'input', '', '', '', '11', '1', '1490861005',
        '1491040778');
INSERT INTO `hisi_system_config`
VALUES ('25', '1', 'upload', '文字水印字体', 'text_watermark_font', '', 'file', '', '', '不上传将使用系统默认字体', '12', '1',
        '1490861117', '1491040778');
INSERT INTO `hisi_system_config`
VALUES ('26', '1', 'upload', '文字水印字体大小', 'text_watermark_size', '20', 'input', '', '', '单位：px(像素)', '13', '1',
        '1490861204', '1491040778');
INSERT INTO `hisi_system_config`
VALUES ('27', '1', 'upload', '文字水印颜色', 'text_watermark_color', '#000000', 'input', '', '', '文字水印颜色，格式:#000000', '14',
        '1', '1490861482', '1491040778');
INSERT INTO `hisi_system_config`
VALUES ('28', '1', 'upload', '文字水印位置', 'text_watermark_location', '7', 'select',
        '7:左下角\r\n1:左上角\r\n4:左居中\r\n9:右下角\r\n3:右上角\r\n6:右居中\r\n2:上居中\r\n8:下居中\r\n5:居中', '', '', '11', '1', '1490861718',
        '1491040778');
INSERT INTO `hisi_system_config`
VALUES ('29', '1', 'upload', '缩略图尺寸', 'thumb_size', '300x300;500x500', 'input', '', '',
        '为空则不生成，生成 500x500 的缩略图，则填写 500x500，多个规格填写参考 300x300;500x500;800x800', '4', '1', '1490947834', '1491040778');
INSERT INTO `hisi_system_config`
VALUES ('30', '1', 'sys', '开发模式', 'app_debug', '1', 'switch', '0:关闭\r\n1:开启', '',
        '&lt;strong class=&quot;red&quot;&gt;生产环境下一定要关闭此配置&lt;/strong&gt;', '3', '1', '1491005004', '1492093874');
INSERT INTO `hisi_system_config`
VALUES ('31', '1', 'sys', '页面Trace', 'app_trace', '0', 'switch', '0:关闭\r\n1:开启', '',
        '&lt;strong class=&quot;red&quot;&gt;生产环境下一定要关闭此配置&lt;/strong&gt;', '4', '1', '1491005081', '1492093874');
INSERT INTO `hisi_system_config`
VALUES ('33', '1', 'sys', '富文本编辑器', 'editor', 'umeditor', 'select',
        'ueditor:UEditor\r\numeditor:UMEditor\r\nkindeditor:KindEditor\r\nckeditor:CKEditor', '', '', '0', '1',
        '1491142648', '1492140215');
INSERT INTO `hisi_system_config`
VALUES ('35', '1', 'databases', '备份目录', 'backup_path', './backup/database/', 'input', '', '', '数据库备份路径,路径必须以 / 结尾', '0',
        '1', '1491881854', '1491965974');
INSERT INTO `hisi_system_config`
VALUES ('36', '1', 'databases', '备份分卷大小', 'part_size', '20971520', 'input', '', '', '用于限制压缩后的分卷最大长度。单位：B；建议设置20M', '0',
        '1', '1491881975', '1491965974');
INSERT INTO `hisi_system_config`
VALUES ('37', '1', 'databases', '备份压缩开关', 'compress', '1', 'switch', '0:关闭\r\n1:开启', '',
        '压缩备份文件需要PHP环境支持gzopen,gzwrite函数', '0', '1', '1491882038', '1491965974');
INSERT INTO `hisi_system_config`
VALUES ('38', '1', 'databases', '备份压缩级别', 'compress_level', '4', 'radio', '1:最低\r\n4:一般\r\n9:最高', '',
        '数据库备份文件的压缩级别，该配置在开启压缩时生效', '0', '1', '1491882154', '1491965974');
INSERT INTO `hisi_system_config`
VALUES ('39', '1', 'base', '网站状态', 'site_status', '1', 'switch', '0:关闭\r\n1:开启', '', '站点关闭后将不能访问，后台可正常登录', '1', '1',
        '1492049460', '1494690024');
INSERT INTO `hisi_system_config`
VALUES ('40', '1', 'sys', '后台管理路径', 'admin_path', 'admin.php', 'input', '', '', '必须以.php为后缀', '1', '1', '1492139196',
        '1492140215');
INSERT INTO `hisi_system_config`
VALUES ('41', '1', 'base', '网站标题', 'site_title', '原料分析系统', 'input', '', '',
        '网站标题是体现一个网站的主旨，要做到主题突出、标题简洁、连贯等特点，建议不超过28个字', '6', '1', '1492502354', '1494695131');
INSERT INTO `hisi_system_config`
VALUES ('42', '1', 'base', '网站关键词', 'site_keywords', '原料分析系统', 'input', '', '',
        '网页内容所包含的核心搜索关键词，多个关键字请用英文逗号&quot;,&quot;分隔', '7', '1', '1494690508', '1494690780');
INSERT INTO `hisi_system_config`
VALUES ('43', '1', 'base', '网站描述', 'site_description', '原料分析系统', 'textarea', '', '',
        '网页的描述信息，搜索引擎采纳后，作为搜索结果中的页面摘要显示，建议不超过80个字', '8', '1', '1494690669', '1494691075');
INSERT INTO `hisi_system_config`
VALUES ('44', '1', 'base', 'ICP备案信息', 'site_icp', '', 'input', '', '',
        '请填写ICP备案号，用于展示在网站底部，ICP备案官网：&lt;a href=&quot;http://www.miibeian.gov.cn&quot; target=&quot;_blank&quot;&gt;http://www.miibeian.gov.cn&lt;/a&gt;',
        '9', '1', '1494691721', '1494692046');
INSERT INTO `hisi_system_config`
VALUES ('45', '1', 'base', '站点统计代码', 'site_statis', '', 'textarea', '', '',
        '第三方流量统计代码，前台调用时请先用 htmlspecialchars_decode函数转义输出', '10', '1', '1494691959', '1494694797');
INSERT INTO `hisi_system_config`
VALUES ('46', '1', 'base', '网站名称', 'site_name', '原料分析系统', 'input', '', '', '将显示在浏览器窗口标题等位置', '3', '1', '1494692103',
        '1494694680');
INSERT INTO `hisi_system_config`
VALUES ('47', '1', 'base', '网站LOGO', 'site_logo', '', 'image', '', '', '网站LOGO图片', '4', '1', '1494692345',
        '1494693235');
INSERT INTO `hisi_system_config`
VALUES ('48', '1', 'base', '网站图标', 'site_favicon', '', 'image', '', '/system/annex/favicon',
        '又叫网站收藏夹图标，它显示位于浏览器的地址栏或者标题前面，&lt;strong class=&quot;red&quot;&gt;.ico格式&lt;/strong&gt;，&lt;a href=&quot;https://www.baidu.com/s?ie=UTF-8&amp;wd=favicon&quot; target=&quot;_blank&quot;&gt;点此了解网站图标&lt;/a&gt;',
        '5', '1', '1494692781', '1494693966');
INSERT INTO `hisi_system_config`
VALUES ('49', '1', 'base', '手机网站', 'wap_site_status', '1', 'switch', '0:关闭\r\n1:开启', '', '如果有手机网站，请设置为开启状态，否则只显示PC网站',
        '2', '1', '1498405436', '1498405436');
INSERT INTO `hisi_system_config`
VALUES ('50', '1', 'sys', '云端推送', 'cloud_push', '0', 'switch', '0:关闭\r\n1:开启', '', '关闭之后，无法通过云端推送安装扩展', '5', '1',
        '1504250320', '1504250320');
INSERT INTO `hisi_system_config`
VALUES ('51', '1', 'base', '手机网站域名', 'wap_domain', '', 'input', '', '', '手机访问将自动跳转至此域名，示例：http://m.domain.com', '2',
        '1', '1504304776', '1504304837');
INSERT INTO `hisi_system_config`
VALUES ('52', '1', 'sys', '多语言支持', 'multi_language', '0', 'switch', '0:关闭\r\n1:开启', '', '开启后你可以自由上传多种语言包', '6', '1',
        '1506532211', '1506532211');
INSERT INTO `hisi_system_config`
VALUES ('53', '1', 'sys', '后台白名单验证', 'admin_whitelist_verify', '0', 'switch', '0:禁用\r\n1:启用', '', '禁用后不存在的菜单节点将不在提示',
        '7', '1', '1542012232', '1542012321');
INSERT INTO `hisi_system_config`
VALUES ('54', '1', 'sys', '系统日志保留', 'system_log_retention', '30', 'input', '', '', '单位天，系统将自动清除 ? 天前的系统日志', '8', '1',
        '1542013958', '1542014158');
INSERT INTO `hisi_system_config`
VALUES ('55', '1', 'upload', '上传驱动', 'upload_driver', 'local', 'select', 'local:本地上传', '', '资源上传驱动设置', '0', '1',
        '1558599270', '1558618703');

-- ----------------------------
-- Table structure for hisi_system_hook
-- ----------------------------
DROP TABLE IF EXISTS `hisi_system_hook`;
CREATE TABLE `hisi_system_hook`
(
    `id`     int(10) unsigned NOT NULL AUTO_INCREMENT,
    `system` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '系统插件',
    `name`   varchar(50)  NOT NULL DEFAULT '' COMMENT '钩子名称',
    `source` varchar(50)  NOT NULL DEFAULT '' COMMENT '钩子来源[plugins.插件名，module.模块名]',
    `intro`  varchar(200) NOT NULL DEFAULT '' COMMENT '钩子简介',
    `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
    `ctime`  int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
    `mtime`  int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
    PRIMARY KEY (`id`),
    UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='[系统] 钩子表';

-- ----------------------------
-- Records of hisi_system_hook
-- ----------------------------
INSERT INTO `hisi_system_hook`
VALUES ('1', '1', 'system_admin_index', '', '后台首页', '1', '1490885108', '1490885108');
INSERT INTO `hisi_system_hook`
VALUES ('2', '1', 'system_admin_tips', '', '后台所有页面提示', '1', '1490713165', '1490885137');
INSERT INTO `hisi_system_hook`
VALUES ('3', '1', 'system_annex_upload', '', '附件上传钩子，可扩展上传到第三方存储', '1', '1490884242', '1490885121');
INSERT INTO `hisi_system_hook`
VALUES ('4', '1', 'system_member_login', '', '会员登陆成功之后的动作', '1', '1490885108', '1490885108');
INSERT INTO `hisi_system_hook`
VALUES ('5', '1', 'system_member_register', '', '会员注册成功后的动作', '1', '1512610518', '1512610518');

-- ----------------------------
-- Table structure for hisi_system_hook_plugins
-- ----------------------------
DROP TABLE IF EXISTS `hisi_system_hook_plugins`;
CREATE TABLE `hisi_system_hook_plugins`
(
    `id`      int(11) unsigned NOT NULL AUTO_INCREMENT,
    `hook`    varchar(32) NOT NULL COMMENT '钩子id',
    `plugins` varchar(32) NOT NULL COMMENT '插件标识',
    `ctime`   int(11) unsigned NOT NULL DEFAULT '0',
    `mtime`   int(11) unsigned NOT NULL DEFAULT '0',
    `sort`    int(11) unsigned NOT NULL DEFAULT '0',
    `status`  tinyint(2) unsigned NOT NULL DEFAULT '1',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='[系统] 钩子-插件对应表';

-- ----------------------------
-- Records of hisi_system_hook_plugins
-- ----------------------------
INSERT INTO `hisi_system_hook_plugins`
VALUES ('1', 'system_admin_index', 'hisiphp', '1509380301', '1509380301', '0', '1');

-- ----------------------------
-- Table structure for hisi_system_language
-- ----------------------------
DROP TABLE IF EXISTS `hisi_system_language`;
CREATE TABLE `hisi_system_language`
(
    `id`     int(11) unsigned NOT NULL AUTO_INCREMENT,
    `name`   varchar(50)  NOT NULL DEFAULT '' COMMENT '语言包名称',
    `code`   varchar(20)  NOT NULL DEFAULT '' COMMENT '编码',
    `locale` varchar(255) NOT NULL DEFAULT '' COMMENT '本地浏览器语言编码',
    `icon`   varchar(30)  NOT NULL DEFAULT '' COMMENT '图标',
    `pack`   varchar(100) NOT NULL DEFAULT '' COMMENT '上传的语言包',
    `sort`   tinyint(2) unsigned NOT NULL DEFAULT '1',
    `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='[系统] 语言包';

-- ----------------------------
-- Records of hisi_system_language
-- ----------------------------
INSERT INTO `hisi_system_language`
VALUES ('1', '简体中文', 'zh-cn', 'zh-CN,zh-CN.UTF-8,zh-cn', '', '1', '1', '1');

-- ----------------------------
-- Table structure for hisi_system_log
-- ----------------------------
DROP TABLE IF EXISTS `hisi_system_log`;
CREATE TABLE `hisi_system_log`
(
    `id`     int(11) unsigned NOT NULL AUTO_INCREMENT,
    `uid`    int(10) unsigned NOT NULL DEFAULT '0',
    `title`  varchar(100) DEFAULT '',
    `url`    varchar(200) DEFAULT '',
    `param`  text,
    `remark` varchar(255) DEFAULT '',
    `count`  int(10) unsigned NOT NULL DEFAULT '1',
    `ip`     varchar(128) DEFAULT '',
    `ctime`  int(10) unsigned NOT NULL DEFAULT '0',
    `mtime`  int(10) unsigned NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8 COMMENT='[系统] 操作日志';

-- ----------------------------
-- Records of hisi_system_log
-- ----------------------------
INSERT INTO `hisi_system_log`
VALUES ('1', '1', '后台首页', '/admin.php/system/index/index.html', '[]', '浏览数据', '8', '127.0.0.1', '1572071377',
        '1572353467');
INSERT INTO `hisi_system_log`
VALUES ('2', '1', '系统菜单', '/admin.php/system/menu/index.html', '[]', '浏览数据', '21', '127.0.0.1', '1572071424',
        '1572099568');
INSERT INTO `hisi_system_log`
VALUES ('3', '1', '添加菜单', '/admin.php/system/menu/add/pid/1/mod/system.html', '{\"pid\":\"1\",\"mod\":\"system\"}',
        '浏览数据', '8', '127.0.0.1', '1572071430', '1572095484');
INSERT INTO `hisi_system_log`
VALUES ('4', '1', '添加菜单', '/admin.php/system/menu/add.html',
        '{\"pid\":\"145\",\"title\":\"\\u5206\\u6790\\u5217\\u8868\",\"icon\":\"fa fa-calculator\",\"url\":\"system\\/material\\/index\",\"param\":\"\",\"status\":\"1\",\"system\":\"0\",\"nav\":\"1\",\"id\":\"\",\"module\":\"system\"}',
        '保存数据', '8', '127.0.0.1', '1572071534', '1572095571');
INSERT INTO `hisi_system_log`
VALUES ('5', '1', '修改菜单', '/admin.php/system/menu/edit/id/142/mod/system.html', '{\"id\":\"142\",\"mod\":\"system\"}',
        '浏览数据', '1', '127.0.0.1', '1572071599', '1572071599');
INSERT INTO `hisi_system_log`
VALUES ('6', '1', '修改菜单', '/admin.php/system/menu/edit.html',
        '{\"pid\":\"148\",\"title\":\"\\u6dfb\\u52a0\",\"icon\":\"\",\"url\":\"system\\/material\\/add\",\"param\":\"\",\"status\":\"1\",\"system\":\"0\",\"nav\":\"0\",\"id\":\"146\",\"module\":\"system\"}',
        '保存数据', '5', '127.0.0.1', '1572071607', '1572099565');
INSERT INTO `hisi_system_log`
VALUES ('7', '1', '产品管理', '/admin.php/system/product/index.html', '[]', '浏览数据', '63', '127.0.0.1', '1572072034',
        '1572353494');
INSERT INTO `hisi_system_log`
VALUES ('8', '1', '系统管理员', '/admin.php/system/user/index.html', '[]', '浏览数据', '30', '127.0.0.1', '1572072204',
        '1572253364');
INSERT INTO `hisi_system_log`
VALUES ('9', '1', '系统管理员', '/admin.php/system/user/index.html?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}',
        '浏览数据', '30', '127.0.0.1', '1572072205', '1572253364');
INSERT INTO `hisi_system_log`
VALUES ('10', '1', '添加管理员', '/admin.php/system/user/adduser.html?hisi_iframe=yes', '{\"hisi_iframe\":\"yes\"}', '浏览数据',
        '11', '127.0.0.1', '1572072210', '1572142349');
INSERT INTO `hisi_system_log`
VALUES ('11', '1', '管理员角色', '/admin.php/system/user/role.html', '[]', '浏览数据', '22', '127.0.0.1', '1572072573',
        '1572253365');
INSERT INTO `hisi_system_log`
VALUES ('12', '1', '管理员角色', '/admin.php/system/user/role.html?page=1&limit=10', '{\"page\":\"1\",\"limit\":\"10\"}',
        '浏览数据', '22', '127.0.0.1', '1572072573', '1572253365');
INSERT INTO `hisi_system_log`
VALUES ('13', '1', '添加角色', '/admin.php/system/user/addrole.html', '[]', '浏览数据', '15', '127.0.0.1', '1572072596',
        '1572142343');
INSERT INTO `hisi_system_log`
VALUES ('14', '1', '产品管理', '/admin.php/system/product/index.html?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}',
        '浏览数据', '54', '127.0.0.1', '1572072951', '1572353495');
INSERT INTO `hisi_system_log`
VALUES ('15', '1', '添加', '/admin.php/system/product/add.html', '[]', '浏览数据', '43', '127.0.0.1', '1572074673',
        '1572146677');
INSERT INTO `hisi_system_log`
VALUES ('16', '1', '添加', '/admin.php/system/product/add.html',
        '{\"catalog\":\"rywtytrty\",\"name\":\"yertyrte\",\"ename\":\"ryteyter\",\"cas\":\"dsaf\",\"mdl\":\"yertytr\",\"purity\":\"adsf34\",\"mf\":\"tyertyer\",\"mw\":\"tyerty\",\"smiles\":\"\",\"inchi\":\"\",\"inchikey\":\"\",\"ghs\":\"\",\"store\":\"\",\"transport\":\"\",\"physical_trait\":\"\",\"packing_rules\":\"\",\"package\":\"\",\"nmr\":\"yert\",\"nmrsolvent\":\"\",\"hplc\":\"\",\"gc\":\"\",\"ms\":\"\",\"optical\":\"\",\"ee\":\"\",\"review\":\"\",\"remark\":\"\",\"struture\":\"\",\"__token__\":\"279a0f2a8fe9492010670650cad9e424\",\"id\":\"\"}',
        '保存数据', '18', '127.0.0.1', '1572076241', '1572079939');
INSERT INTO `hisi_system_log`
VALUES ('17', '1', '未加入系统菜单', '/admin.php/system/product/upload.html', '[]', '保存数据', '11', '127.0.0.1', '1572077319',
        '1572081392');
INSERT INTO `hisi_system_log`
VALUES ('18', '1', '未加入系统菜单', '/admin.php/system/product/edituser.html?id=1&hisi_iframe=yes',
        '{\"id\":\"1\",\"hisi_iframe\":\"yes\"}', '浏览数据', '2', '127.0.0.1', '1572080946', '1572081014');
INSERT INTO `hisi_system_log`
VALUES ('19', '1', '编辑', '/admin.php/system/product/edit.html?id=1', '{\"id\":\"1\"}', '浏览数据', '11', '127.0.0.1',
        '1572081229', '1572103151');
INSERT INTO `hisi_system_log`
VALUES ('20', '1', '编辑', '/admin.php/system/product/edit.html',
        '{\"catalog\":\"ewrasdf\",\"name\":\"sadf\",\"ename\":\"sadf\",\"cas\":\"dsaf\",\"mdl\":\"dsfa\",\"purity\":\"adsf\",\"mf\":\"sdaf\",\"mw\":\"asdf\",\"smiles\":\"dsaf\",\"inchi\":\"dsfa\",\"inchikey\":\"sdaf\",\"ghs\":\"\",\"store\":\"sdaf\",\"transport\":\"dsfa\",\"physical_trait\":\"sdaf\",\"packing_rules\":\"sadf\",\"package\":\"dsaf\",\"nmr\":\"fdsa\",\"nmrsolvent\":\"dsfa\",\"hplc\":\"dsaf\",\"gc\":\"dsaf\",\"ms\":\"dfsadaf\",\"optical\":\"fds\",\"ee\":\"af\",\"review\":\"aewsdsaf\",\"remark\":\"dsafeweaafdsf\",\"struture\":\"\\/upload\\/sys\\/image\\/59\\/5421f9543e0ea366d84ac9844c3c53.png\",\"__token__\":\"e8b84ac74e41eac745bed7249acfef32\",\"id\":\"1\"}',
        '保存数据', '5', '127.0.0.1', '1572081237', '1572081348');
INSERT INTO `hisi_system_log`
VALUES ('21', '1', '产品管理', '/admin.php/system/product/index.html?page=1&limit=20&q=sadf',
        '{\"page\":\"1\",\"limit\":\"20\",\"q\":\"sadf\"}', '浏览数据', '2', '127.0.0.1', '1572094105', '1572094117');
INSERT INTO `hisi_system_log`
VALUES ('22', '1', '产品管理', '/admin.php/system/product/index.html?page=1&limit=20&q=sadf54',
        '{\"page\":\"1\",\"limit\":\"20\",\"q\":\"sadf54\"}', '浏览数据', '1', '127.0.0.1', '1572094130', '1572094130');
INSERT INTO `hisi_system_log`
VALUES ('23', '1', '产品管理', '/admin.php/system/product/index.html?page=1&limit=20&keyword=ads',
        '{\"page\":\"1\",\"limit\":\"20\",\"keyword\":\"ads\"}', '浏览数据', '1', '127.0.0.1', '1572094205', '1572094205');
INSERT INTO `hisi_system_log`
VALUES ('24', '1', '产品管理', '/admin.php/system/product/index.html?page=1&limit=20&keyword=',
        '{\"page\":\"1\",\"limit\":\"20\",\"keyword\":\"\"}', '浏览数据', '1', '127.0.0.1', '1572094209', '1572094209');
INSERT INTO `hisi_system_log`
VALUES ('25', '1', '产品管理', '/admin.php/system/product/index.html?page=1&limit=20&keyword=sadf',
        '{\"page\":\"1\",\"limit\":\"20\",\"keyword\":\"sadf\"}', '浏览数据', '1', '127.0.0.1', '1572094213', '1572094213');
INSERT INTO `hisi_system_log`
VALUES ('26', '1', '产品管理',
        '/admin.php/system/product/index.html?page=1&limit=20&catalog=ewrasdf&name=&ename=&cas=&smiles=&mdl=&inchikey=',
        '{\"page\":\"1\",\"limit\":\"20\",\"catalog\":\"ewrasdf\",\"name\":\"\",\"ename\":\"\",\"cas\":\"\",\"smiles\":\"\",\"mdl\":\"\",\"inchikey\":\"\"}',
        '浏览数据', '1', '127.0.0.1', '1572094892', '1572094892');
INSERT INTO `hisi_system_log`
VALUES ('27', '1', '产品管理',
        '/admin.php/system/product/index.html?page=1&limit=20&catalog=ewrasdf&name=sadf&ename=&cas=&smiles=&mdl=&inchikey=',
        '{\"page\":\"1\",\"limit\":\"20\",\"catalog\":\"ewrasdf\",\"name\":\"sadf\",\"ename\":\"\",\"cas\":\"\",\"smiles\":\"\",\"mdl\":\"\",\"inchikey\":\"\"}',
        '浏览数据', '2', '127.0.0.1', '1572094897', '1572094975');
INSERT INTO `hisi_system_log`
VALUES ('28', '1', '产品管理',
        '/admin.php/system/product/index.html?page=1&limit=20&catalog=ewrasdf&name=sadf&ename=sadf&cas=&smiles=&mdl=&inchikey=',
        '{\"page\":\"1\",\"limit\":\"20\",\"catalog\":\"ewrasdf\",\"name\":\"sadf\",\"ename\":\"sadf\",\"cas\":\"\",\"smiles\":\"\",\"mdl\":\"\",\"inchikey\":\"\"}',
        '浏览数据', '2', '127.0.0.1', '1572094902', '1572094969');
INSERT INTO `hisi_system_log`
VALUES ('29', '1', '产品管理',
        '/admin.php/system/product/index.html?page=1&limit=20&catalog=ewrasdf&name=sadf&ename=sadf&cas=dsaf&smiles=&mdl=&inchikey=',
        '{\"page\":\"1\",\"limit\":\"20\",\"catalog\":\"ewrasdf\",\"name\":\"sadf\",\"ename\":\"sadf\",\"cas\":\"dsaf\",\"smiles\":\"\",\"mdl\":\"\",\"inchikey\":\"\"}',
        '浏览数据', '2', '127.0.0.1', '1572094914', '1572094964');
INSERT INTO `hisi_system_log`
VALUES ('30', '1', '产品管理',
        '/admin.php/system/product/index.html?page=1&limit=20&catalog=ewrasdf&name=sadf&ename=sadf&cas=dsaf&smiles=&mdl=dsfa&inchikey=',
        '{\"page\":\"1\",\"limit\":\"20\",\"catalog\":\"ewrasdf\",\"name\":\"sadf\",\"ename\":\"sadf\",\"cas\":\"dsaf\",\"smiles\":\"\",\"mdl\":\"dsfa\",\"inchikey\":\"\"}',
        '浏览数据', '1', '127.0.0.1', '1572094921', '1572094921');
INSERT INTO `hisi_system_log`
VALUES ('31', '1', '产品管理',
        '/admin.php/system/product/index.html?page=1&limit=20&catalog=ewrasdf&name=sadf&ename=sadf&cas=dsaf&smiles=dsaf&mdl=dsfa&inchikey=sdaf',
        '{\"page\":\"1\",\"limit\":\"20\",\"catalog\":\"ewrasdf\",\"name\":\"sadf\",\"ename\":\"sadf\",\"cas\":\"dsaf\",\"smiles\":\"dsaf\",\"mdl\":\"dsfa\",\"inchikey\":\"sdaf\"}',
        '浏览数据', '1', '127.0.0.1', '1572094936', '1572094936');
INSERT INTO `hisi_system_log`
VALUES ('32', '1', '产品管理',
        '/admin.php/system/product/index.html?page=1&limit=20&catalog=ewrasdf&name=sadf&ename=sadf&cas=dsaf&smiles=dsaf&mdl=dsfa&inchikey=sdafera',
        '{\"page\":\"1\",\"limit\":\"20\",\"catalog\":\"ewrasdf\",\"name\":\"sadf\",\"ename\":\"sadf\",\"cas\":\"dsaf\",\"smiles\":\"dsaf\",\"mdl\":\"dsfa\",\"inchikey\":\"sdafera\"}',
        '浏览数据', '1', '127.0.0.1', '1572094953', '1572094953');
INSERT INTO `hisi_system_log`
VALUES ('33', '1', '产品管理',
        '/admin.php/system/product/index.html?page=1&limit=20&catalog=ewrasdf&name=sadf&ename=sadf&cas=dsaf&smiles=dsaf&mdl=dsfagf&inchikey=',
        '{\"page\":\"1\",\"limit\":\"20\",\"catalog\":\"ewrasdf\",\"name\":\"sadf\",\"ename\":\"sadf\",\"cas\":\"dsaf\",\"smiles\":\"dsaf\",\"mdl\":\"dsfagf\",\"inchikey\":\"\"}',
        '浏览数据', '1', '127.0.0.1', '1572094958', '1572094958');
INSERT INTO `hisi_system_log`
VALUES ('34', '1', '产品管理',
        '/admin.php/system/product/index.html?page=1&limit=20&catalog=ewrasdf&name=sadf&ename=sadf&cas=dsaf&smiles=dsafgf&mdl=&inchikey=',
        '{\"page\":\"1\",\"limit\":\"20\",\"catalog\":\"ewrasdf\",\"name\":\"sadf\",\"ename\":\"sadf\",\"cas\":\"dsaf\",\"smiles\":\"dsafgf\",\"mdl\":\"\",\"inchikey\":\"\"}',
        '浏览数据', '1', '127.0.0.1', '1572094961', '1572094961');
INSERT INTO `hisi_system_log`
VALUES ('35', '1', '产品管理',
        '/admin.php/system/product/index.html?page=1&limit=20&catalog=ewrasdf&name=sadf&ename=sadf&cas=dsaftf&smiles=&mdl=&inchikey=',
        '{\"page\":\"1\",\"limit\":\"20\",\"catalog\":\"ewrasdf\",\"name\":\"sadf\",\"ename\":\"sadf\",\"cas\":\"dsaftf\",\"smiles\":\"\",\"mdl\":\"\",\"inchikey\":\"\"}',
        '浏览数据', '1', '127.0.0.1', '1572094967', '1572094967');
INSERT INTO `hisi_system_log`
VALUES ('36', '1', '产品管理',
        '/admin.php/system/product/index.html?page=1&limit=20&catalog=ewrasdf&name=sadf&ename=sadff&cas=&smiles=&mdl=&inchikey=',
        '{\"page\":\"1\",\"limit\":\"20\",\"catalog\":\"ewrasdf\",\"name\":\"sadf\",\"ename\":\"sadff\",\"cas\":\"\",\"smiles\":\"\",\"mdl\":\"\",\"inchikey\":\"\"}',
        '浏览数据', '1', '127.0.0.1', '1572094972', '1572094972');
INSERT INTO `hisi_system_log`
VALUES ('37', '1', '产品管理',
        '/admin.php/system/product/index.html?page=1&limit=20&catalog=ewrasdff&name=sadf&ename=&cas=&smiles=&mdl=&inchikey=',
        '{\"page\":\"1\",\"limit\":\"20\",\"catalog\":\"ewrasdff\",\"name\":\"sadf\",\"ename\":\"\",\"cas\":\"\",\"smiles\":\"\",\"mdl\":\"\",\"inchikey\":\"\"}',
        '浏览数据', '1', '127.0.0.1', '1572094978', '1572094978');
INSERT INTO `hisi_system_log`
VALUES ('38', '1', '产品管理',
        '/admin.php/system/product/index.html?page=1&limit=20&catalog=ewrasdffff&name=sadf&ename=&cas=&smiles=&mdl=&inchikey=',
        '{\"page\":\"1\",\"limit\":\"20\",\"catalog\":\"ewrasdffff\",\"name\":\"sadf\",\"ename\":\"\",\"cas\":\"\",\"smiles\":\"\",\"mdl\":\"\",\"inchikey\":\"\"}',
        '浏览数据', '1', '127.0.0.1', '1572094983', '1572094983');
INSERT INTO `hisi_system_log`
VALUES ('39', '1', '产品管理',
        '/admin.php/system/product/index.html?page=1&limit=20&catalog=ewrasdffff&name=sadff&ename=&cas=&smiles=&mdl=&inchikey=',
        '{\"page\":\"1\",\"limit\":\"20\",\"catalog\":\"ewrasdffff\",\"name\":\"sadff\",\"ename\":\"\",\"cas\":\"\",\"smiles\":\"\",\"mdl\":\"\",\"inchikey\":\"\"}',
        '浏览数据', '2', '127.0.0.1', '1572094985', '1572095024');
INSERT INTO `hisi_system_log`
VALUES ('40', '1', '产品管理',
        '/admin.php/system/product/index.html?page=1&limit=20&catalog=&name=sadff&ename=&cas=&smiles=&mdl=&inchikey=',
        '{\"page\":\"1\",\"limit\":\"20\",\"catalog\":\"\",\"name\":\"sadff\",\"ename\":\"\",\"cas\":\"\",\"smiles\":\"\",\"mdl\":\"\",\"inchikey\":\"\"}',
        '浏览数据', '1', '127.0.0.1', '1572095028', '1572095028');
INSERT INTO `hisi_system_log`
VALUES ('41', '1', '产品管理',
        '/admin.php/system/product/index.html?page=1&limit=20&catalog=&name=sadf&ename=&cas=&smiles=&mdl=&inchikey=',
        '{\"page\":\"1\",\"limit\":\"20\",\"catalog\":\"\",\"name\":\"sadf\",\"ename\":\"\",\"cas\":\"\",\"smiles\":\"\",\"mdl\":\"\",\"inchikey\":\"\"}',
        '浏览数据', '1', '127.0.0.1', '1572095034', '1572095034');
INSERT INTO `hisi_system_log`
VALUES ('42', '1', '产品管理',
        '/admin.php/system/product/index.html?page=1&limit=20&catalog=&name=&ename=&cas=&smiles=&mdl=&inchikey=',
        '{\"page\":\"1\",\"limit\":\"20\",\"catalog\":\"\",\"name\":\"\",\"ename\":\"\",\"cas\":\"\",\"smiles\":\"\",\"mdl\":\"\",\"inchikey\":\"\"}',
        '浏览数据', '1', '127.0.0.1', '1572095037', '1572095037');
INSERT INTO `hisi_system_log`
VALUES ('43', '1', '修改菜单', '/admin.php/system/menu/edit/id/144/mod/system.html', '{\"id\":\"144\",\"mod\":\"system\"}',
        '浏览数据', '1', '127.0.0.1', '1572095137', '1572095137');
INSERT INTO `hisi_system_log`
VALUES ('44', '1', '修改菜单', '/admin.php/system/menu/edit/id/147/mod/system.html', '{\"id\":\"147\",\"mod\":\"system\"}',
        '浏览数据', '2', '127.0.0.1', '1572095578', '1572099571');
INSERT INTO `hisi_system_log`
VALUES ('45', '1', '修改菜单', '/admin.php/system/menu/edit/id/146/mod/system.html', '{\"id\":\"146\",\"mod\":\"system\"}',
        '浏览数据', '2', '127.0.0.1', '1572095593', '1572099559');
INSERT INTO `hisi_system_log`
VALUES ('46', '1', '原料分析', '/admin.php/system/material/index.html', '[]', '浏览数据', '153', '127.0.0.1', '1572096216',
        '1572356609');
INSERT INTO `hisi_system_log`
VALUES ('47', '1', '原料分析', '/admin.php/system/material/index.html?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}',
        '浏览数据', '156', '127.0.0.1', '1572096216', '1572356610');
INSERT INTO `hisi_system_log`
VALUES ('48', '1', '添加管理员', '/admin.php/system/user/adduser.html',
        '{\"nick\":\"\\u8ba2\\u8d2d\\u4eba\",\"username\":\"000111\",\"password\":\"111111\",\"password_confirm\":\"111111\",\"email\":\"3992@163.com\",\"mobile\":\"15489929266\",\"iframe\":\"0\",\"status\":\"1\",\"role_id\":{\"10\":\"12\"},\"__token__\":\"972f49bda328e4db26d7ca95ae5eb608\",\"id\":\"\"}',
        '保存数据', '9', '127.0.0.1', '1572096827', '1572142411');
INSERT INTO `hisi_system_log`
VALUES ('49', '1', '修改角色', '/admin.php/system/user/editrole.html?id=2', '{\"id\":\"2\"}', '浏览数据', '2', '127.0.0.1',
        '1572096849', '1572096909');
INSERT INTO `hisi_system_log`
VALUES ('50', '1', '修改管理员', '/admin.php/system/user/edituser.html?id=2&hisi_iframe=yes',
        '{\"id\":\"2\",\"hisi_iframe\":\"yes\"}', '浏览数据', '7', '127.0.0.1', '1572096873', '1572142623');
INSERT INTO `hisi_system_log`
VALUES ('51', '1', '修改角色', '/admin.php/system/user/editrole.html?id=3', '{\"id\":\"3\"}', '浏览数据', '1', '127.0.0.1',
        '1572096972', '1572096972');
INSERT INTO `hisi_system_log`
VALUES ('52', '1', '未加入系统菜单', '/admin.php/system/material/add.html', '[]', '浏览数据', '2', '127.0.0.1', '1572099496',
        '1572099528');
INSERT INTO `hisi_system_log`
VALUES ('53', '1', '修改菜单', '/admin.php/system/menu/edit/id/148/mod/system.html', '{\"id\":\"148\",\"mod\":\"system\"}',
        '浏览数据', '2', '127.0.0.1', '1572099517', '1572099551');
INSERT INTO `hisi_system_log`
VALUES ('54', '1', '添加', '/admin.php/system/material/add.html', '[]', '浏览数据', '66', '127.0.0.1', '1572099577',
        '1572353522');
INSERT INTO `hisi_system_log`
VALUES ('55', '1', '添加', '/admin.php/system/material/add.html',
        '{\"test_num\":\"weawea\",\"catalog\":\"ewrasdf\",\"nmr_num\":\"aweafw\",\"nmr_method\":\"adsf\",\"po_num\":\"adsf\",\"results\":\"adsf\",\"if_store\":\"1\",\"last_num\":\"asdf\",\"appearance\":\"adsf\",\"order_amount\":\"adsf\",\"optical\":\"\",\"optical_result\":\"dsaf\",\"ee\":\"sadf\",\"ee_result\":\"\",\"hplc_result\":\"\",\"gc_result\":\"asdf\",\"if_accept\":\"1\",\"purchaser\":\"3\",\"merchandiser\":\"4\",\"supplier\":\"asdf\",\"user_name\":\"5\",\"water_content\":\"asdf\",\"ph_num\":\"asdf\",\"melting_point\":\"asdf\",\"ms_result\":\"\",\"remark\":\"asdf\",\"file\":\"\",\"file_name\":\"\",\"file_size\":\"\",\"__token__\":\"7e01352bcc13176183a6f0a7f5357bd9\",\"id\":\"\"}',
        '保存数据', '20', '127.0.0.1', '1572102577', '1572353544');
INSERT INTO `hisi_system_log`
VALUES ('56', '1', '编辑', '/admin.php/system/material/edit.html?id=2', '{\"id\":\"2\"}', '浏览数据', '1', '127.0.0.1',
        '1572103018', '1572103018');
INSERT INTO `hisi_system_log`
VALUES ('57', '1', '添加角色', '/admin.php/system/user/addrole.html',
        '{\"name\":\"\\u8ba2\\u8d2d\\u4eba\",\"intro\":\"\\u8ba2\\u8d2d\\u4eba\",\"status\":\"1\",\"auth\":[\"1\",\"4\",\"24\",\"25\",\"41\",\"105\",\"106\",\"112\",\"113\",\"141\",\"142\",\"143\",\"144\",\"145\",\"148\",\"146\",\"147\"],\"id\":\"\"}',
        '保存数据', '11', '127.0.0.1', '1572141025', '1572142340');
INSERT INTO `hisi_system_log`
VALUES ('58', '1', '修改角色', '/admin.php/system/user/editrole.html?id=4', '{\"id\":\"4\"}', '浏览数据', '2', '127.0.0.1',
        '1572141102', '1572141300');
INSERT INTO `hisi_system_log`
VALUES ('59', '1', '修改角色', '/admin.php/system/user/editrole.html',
        '{\"name\":\"\\u91c7\\u8d2d\\u7ecf\\u7406\",\"intro\":\"\\u91c7\\u8d2d\\u7ecf\\u7406\",\"status\":\"1\",\"auth\":[\"1\",\"4\",\"24\",\"25\",\"41\",\"105\",\"106\",\"112\",\"113\",\"141\",\"142\",\"143\",\"144\",\"145\",\"148\",\"146\",\"147\"],\"id\":\"4\"}',
        '保存数据', '1', '127.0.0.1', '1572141297', '1572141297');
INSERT INTO `hisi_system_log`
VALUES ('60', '1', '修改管理员', '/admin.php/system/user/edituser.html',
        '{\"nick\":\"ceshi\",\"username\":\"ceshi\",\"password\":\"\",\"password_confirm\":\"\",\"email\":\"3999@163.com\",\"mobile\":\"15829999999\",\"iframe\":\"0\",\"status\":\"1\",\"role_id\":{\"2\":\"4\"},\"__token__\":\"54f1a4e4133432db89db91283fa208d0\",\"id\":\"2\"}',
        '保存数据', '1', '127.0.0.1', '1572141652', '1572141652');
INSERT INTO `hisi_system_log`
VALUES ('61', '1', '修改管理员', '/admin.php/system/user/edituser.html?id=5&hisi_iframe=yes',
        '{\"id\":\"5\",\"hisi_iframe\":\"yes\"}', '浏览数据', '1', '127.0.0.1', '1572142433', '1572142433');
INSERT INTO `hisi_system_log`
VALUES ('62', '1', '未加入系统菜单', '/admin.php/system/material/upload.html', '[]', '保存数据', '17', '127.0.0.1', '1572146979',
        '1572248604');
INSERT INTO `hisi_system_log`
VALUES ('63', '1', '编辑', '/admin.php/system/material/edit.html?id=3', '{\"id\":\"3\"}', '浏览数据', '14', '127.0.0.1',
        '1572149065', '1572252052');
INSERT INTO `hisi_system_log`
VALUES ('64', '1', '编辑', '/admin.php/system/material/edit.html',
        '{\"test_num\":\"safsadf\",\"catalog\":\"ewrasdf\",\"nmr_num\":\"fdsasfdfd\",\"nmr_method\":\"sfdafd\",\"po_num\":\"sdaf\",\"results\":\"fdsa\",\"if_store\":\"1\",\"last_num\":\"fdsa\",\"appearance\":\"asfd\",\"order_amount\":\"fdas\",\"optical\":\"easdsfasd\",\"optical_result\":\"fdsfds\",\"ee\":\"sfda\",\"ee_result\":\"sdfa\",\"hplc_result\":\"fdsa\",\"gc_result\":\"fdsa\",\"if_accept\":\"1\",\"purchaser\":\"3\",\"merchandiser\":\"4\",\"supplier\":\"dasf\",\"user_name\":\"5\",\"water_content\":\"asfdfdas\",\"ph_num\":\"fdsafdsa\",\"melting_point\":\"dsffda\",\"ms_result\":\"dasf\",\"remark\":\"dasffdafdsafsda\",\"file\":\"\",\"file_name\":\"\",\"file_size\":\"\",\"__token__\":\"e347be43f48d8f6a800d830633931cd8\",\"id\":\"4\"}',
        '保存数据', '8', '127.0.0.1', '1572149431', '1572254323');
INSERT INTO `hisi_system_log`
VALUES ('65', '1', '未加入系统菜单', '/admin.php/system/material/del.html?id=2', '{\"id\":\"2\"}', '浏览数据', '1', '127.0.0.1',
        '1572151384', '1572151384');
INSERT INTO `hisi_system_log`
VALUES ('66', '1', '原料分析', '/admin.php/system/material/index.html', '[]', '保存数据', '8', '127.0.0.1', '1572153232',
        '1572153314');
INSERT INTO `hisi_system_log`
VALUES ('67', '1', '未加入系统菜单', '/admin.php/system/material/fileinfo.html',
        '{\"device_type\":\"0\",\"json_text\":\"{&quot;id&quot;:4}\"}', '保存数据', '33', '127.0.0.1', '1572244168',
        '1572255665');
INSERT INTO `hisi_system_log`
VALUES ('68', '1', '未加入系统菜单', '/admin.php/system/material/savedata.html',
        '{\"device_type\":\"1\",\"json_text\":\"{&quot;id&quot;:&quot;3&quot;,&quot;file&quot;:&quot;\\/upload\\/sys\\/file\\/16\\/24c3bab7eb3ecce2da81c599953362.doc&quot;,&quot;file_name&quot;:&quot;\\u65b0\\u5efa DOC \\u6587\\u6863 - \\u526f\\u672c.doc&quot;,&quot;file_size&quot;:&quot;9&quot;}\"}',
        '保存数据', '16', '127.0.0.1', '1572247460', '1572248605');
INSERT INTO `hisi_system_log`
VALUES ('69', '1', '未加入系统菜单', '/admin.php/system/material/undefined', '[]', '浏览数据', '1', '127.0.0.1', '1572251369',
        '1572251369');
INSERT INTO `hisi_system_log`
VALUES ('70', '1', '编辑', '/admin.php/system/material/edit.html?id=4', '{\"id\":\"4\"}', '浏览数据', '1', '127.0.0.1',
        '1572254312', '1572254312');
INSERT INTO `hisi_system_log`
VALUES ('71', '1', '原料分析',
        '/admin.php/system/material/index.html?page=1&limit=20&catalog=ewrasdf&name=&ename=&cas=&smiles=&mdl=&inchikey=',
        '{\"page\":\"1\",\"limit\":\"20\",\"catalog\":\"ewrasdf\",\"name\":\"\",\"ename\":\"\",\"cas\":\"\",\"smiles\":\"\",\"mdl\":\"\",\"inchikey\":\"\"}',
        '浏览数据', '2', '127.0.0.1', '1572254410', '1572254413');
INSERT INTO `hisi_system_log`
VALUES ('72', '1', '原料分析',
        '/admin.php/system/material/index.html?page=1&limit=20&catalog=ewrasdf&name=&ename=&cas=dsaf&smiles=&mdl=&inchikey=',
        '{\"page\":\"1\",\"limit\":\"20\",\"catalog\":\"ewrasdf\",\"name\":\"\",\"ename\":\"\",\"cas\":\"dsaf\",\"smiles\":\"\",\"mdl\":\"\",\"inchikey\":\"\"}',
        '浏览数据', '1', '127.0.0.1', '1572254422', '1572254422');
INSERT INTO `hisi_system_log`
VALUES ('73', '1', '原料分析',
        '/admin.php/system/material/index.html?page=1&limit=20&catalog=ewrasdfe&name=&ename=&cas=dsaf&smiles=&mdl=&inchikey=',
        '{\"page\":\"1\",\"limit\":\"20\",\"catalog\":\"ewrasdfe\",\"name\":\"\",\"ename\":\"\",\"cas\":\"dsaf\",\"smiles\":\"\",\"mdl\":\"\",\"inchikey\":\"\"}',
        '浏览数据', '1', '127.0.0.1', '1572254520', '1572254520');
INSERT INTO `hisi_system_log`
VALUES ('74', '1', '未加入系统菜单', '/admin.php/system/material/download.html', '[]', '浏览数据', '1', '127.0.0.1', '1572256208',
        '1572256208');
INSERT INTO `hisi_system_log`
VALUES ('75', '1', '未加入系统菜单', '/admin.php/system/material/uploadfile.html', '[]', '保存数据', '17', '127.0.0.1',
        '1572257552', '1572356608');
INSERT INTO `hisi_system_log`
VALUES ('76', '1', '系统设置', '/admin.php/system/system/index.html', '[]', '浏览数据', '2', '127.0.0.1', '1572309803',
        '1572309938');
INSERT INTO `hisi_system_log`
VALUES ('77', '1', '基础配置', '/admin.php/system/system/index/group/base.html',
        '{\"id\":{\"site_status\":\"1\",\"site_domain\":\"\",\"wap_site_status\":\"1\",\"wap_domain\":\"\",\"site_name\":\"\\u539f\\u6599\\u5206\\u6790\\u7cfb\\u7edf\",\"site_logo\":\"\",\"site_favicon\":\"\",\"site_title\":\"\\u539f\\u6599\\u5206\\u6790\\u7cfb\\u7edf\",\"site_keywords\":\"\\u539f\\u6599\\u5206\\u6790\\u7cfb\\u7edf\",\"site_description\":\"\\u539f\\u6599\\u5206\\u6790\\u7cfb\\u7edf\",\"site_icp\":\"\",\"site_statis\":\"\"},\"type\":{\"site_status\":\"switch\",\"site_domain\":\"input\",\"wap_site_status\":\"switch\",\"wap_domain\":\"input\",\"site_name\":\"input\",\"site_logo\":\"image\",\"site_favicon\":\"image\",\"site_title\":\"input\",\"site_keywords\":\"input\",\"site_description\":\"textarea\",\"site_icp\":\"input\",\"site_statis\":\"textarea\"},\"__token__\":\"72c35a0c0bdcb4a361b4a59c896b7aa3\",\"group\":\"base\"}',
        '保存数据', '1', '127.0.0.1', '1572309855', '1572309855');
INSERT INTO `hisi_system_log`
VALUES ('78', '1', '基础配置', '/admin.php/system/system/index/group/base.html', '{\"group\":\"base\"}', '浏览数据', '1',
        '127.0.0.1', '1572309858', '1572309858');
INSERT INTO `hisi_system_log`
VALUES ('79', '1', '系统配置', '/admin.php/system/system/index/group/sys.html', '{\"group\":\"sys\"}', '浏览数据', '1',
        '127.0.0.1', '1572309871', '1572309871');
INSERT INTO `hisi_system_log`
VALUES ('80', '1', '配置管理', '/admin.php/system/config/index.html', '[]', '浏览数据', '2', '127.0.0.1', '1572309876',
        '1572309952');
INSERT INTO `hisi_system_log`
VALUES ('81', '1', '配置管理', '/admin.php/system/config/index.html?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}',
        '浏览数据', '2', '127.0.0.1', '1572309876', '1572309952');
INSERT INTO `hisi_system_log`
VALUES ('82', '1', '数据库管理', '/admin.php/system/database/index.html', '[]', '浏览数据', '1', '127.0.0.1', '1572309928',
        '1572309928');
INSERT INTO `hisi_system_log`
VALUES ('83', '1', '数据库管理', '/admin.php/system/database/index.html?group=export&page=1&limit=10',
        '{\"group\":\"export\",\"page\":\"1\",\"limit\":\"10\"}', '浏览数据', '1', '127.0.0.1', '1572309928', '1572309928');
INSERT INTO `hisi_system_log`
VALUES ('84', '1', '配置管理', '/admin.php/system/config/index/group/sys.html', '{\"group\":\"sys\"}', '浏览数据', '1',
        '127.0.0.1', '1572309962', '1572309962');
INSERT INTO `hisi_system_log`
VALUES ('85', '1', '配置管理', '/admin.php/system/config/index/group/sys.html?page=1&limit=20',
        '{\"page\":\"1\",\"limit\":\"20\",\"group\":\"sys\"}', '浏览数据', '1', '127.0.0.1', '1572309962', '1572309962');
INSERT INTO `hisi_system_log`
VALUES ('86', '1', '配置管理', '/admin.php/system/config/index/group/databases.html', '{\"group\":\"databases\"}', '浏览数据',
        '1', '127.0.0.1', '1572309967', '1572309967');
INSERT INTO `hisi_system_log`
VALUES ('87', '1', '配置管理', '/admin.php/system/config/index/group/databases.html?page=1&limit=20',
        '{\"page\":\"1\",\"limit\":\"20\",\"group\":\"databases\"}', '浏览数据', '1', '127.0.0.1', '1572309968',
        '1572309968');

-- ----------------------------
-- Table structure for hisi_system_menu
-- ----------------------------
DROP TABLE IF EXISTS `hisi_system_menu`;
CREATE TABLE `hisi_system_menu`
(
    `id`     int(10) unsigned NOT NULL AUTO_INCREMENT,
    `uid`    int(5) unsigned NOT NULL DEFAULT '0' COMMENT '管理员ID(快捷菜单专用)',
    `pid`    int(10) unsigned NOT NULL DEFAULT '0',
    `module` varchar(20)  NOT NULL COMMENT '模块名或插件名，插件名格式:plugins.插件名',
    `title`  varchar(20)  NOT NULL COMMENT '菜单标题',
    `icon`   varchar(80)  NOT NULL DEFAULT 'aicon ai-shezhi' COMMENT '菜单图标',
    `url`    varchar(200) NOT NULL COMMENT '链接地址(模块/控制器/方法)',
    `param`  varchar(200) NOT NULL DEFAULT '' COMMENT '扩展参数',
    `target` varchar(20)  NOT NULL DEFAULT '_self' COMMENT '打开方式(_blank,_self)',
    `sort`   int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
    `debug`  tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '开发模式可见',
    `system` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否为系统菜单，系统菜单不可删除',
    `nav`    tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否为菜单显示，1显示0不显示',
    `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态1显示，0隐藏',
    `ctime`  int(10) unsigned NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=149 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='[系统] 管理菜单';

-- ----------------------------
-- Records of hisi_system_menu
-- ----------------------------
INSERT INTO `hisi_system_menu`
VALUES ('1', '0', '0', 'system', '首页', '', 'system/index', '', '_self', '0', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('2', '0', '0', 'system', '系统', '', 'system/system', '', '_self', '1', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('3', '0', '0', 'system', '插件', 'aicon ai-shezhi', 'system/plugins', '', '_self', '2', '0', '1', '1', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('4', '0', '1', 'system', '快捷菜单', 'aicon ai-caidan', 'system/quick', '', '_self', '0', '0', '1', '1', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('5', '0', '3', 'system', '插件列表', 'aicon ai-mokuaiguanli', 'system/plugins', '', '_self', '0', '0', '1', '1',
        '1', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('6', '0', '2', 'system', '系统基础', 'aicon ai-gongneng', 'system/system', '', '_self', '1', '0', '1', '1', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('7', '0', '17', 'system', '导入主题SQL', '', 'system/module/exeSql', '', '_self', '10', '0', '1', '0', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('8', '0', '2', 'system', '系统扩展', 'aicon ai-shezhi', 'system/extend', '', '_self', '3', '0', '1', '1', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('9', '0', '4', 'system', '预留占位', '', '', '', '_self', '4', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('10', '0', '6', 'system', '系统设置', 'aicon ai-icon01', 'system/system/index', '', '_self', '1', '0', '1', '1',
        '1', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('11', '0', '6', 'system', '配置管理', 'aicon ai-peizhiguanli', 'system/config/index', '', '_self', '2', '1', '1',
        '1', '1', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('12', '0', '6', 'system', '系统菜单', 'aicon ai-systemmenu', 'system/menu/index', '', '_self', '3', '1', '1', '1',
        '1', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('13', '0', '6', 'system', '管理员角色', '', 'system/user/role', '', '_self', '4', '0', '1', '0', '1', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('14', '0', '6', 'system', '系统管理员', 'aicon ai-tubiao05', 'system/user/index', '', '_self', '5', '0', '1', '1',
        '1', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('15', '0', '6', 'system', '系统日志', 'aicon ai-xitongrizhi-tiaoshi', 'system/log/index', '', '_self', '7', '0',
        '1', '1', '1', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('16', '0', '6', 'system', '附件管理', '', 'system/annex/index', '', '_self', '8', '0', '1', '0', '1', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('17', '0', '8', 'system', '本地模块', 'aicon ai-mokuaiguanli1', 'system/module/index', '', '_self', '1', '0', '1',
        '1', '1', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('18', '0', '8', 'system', '本地插件', 'aicon ai-chajianguanli', 'system/plugins/index', '', '_self', '2', '0', '1',
        '1', '1', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('19', '0', '8', 'system', '插件钩子', 'aicon ai-icon-test', 'system/hook/index', '', '_self', '3', '0', '1', '1',
        '1', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('20', '0', '4', 'system', '预留占位', '', '', '', '_self', '1', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('21', '0', '4', 'system', '预留占位', '', '', '', '_self', '2', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('22', '0', '4', 'system', '预留占位', '', '', '', '_self', '1', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('23', '0', '4', 'system', '预留占位', '', '', '', '_self', '2', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('24', '0', '4', 'system', '后台首页', '', 'system/index/index', '', '_self', '100', '0', '1', '0', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('25', '0', '4', 'system', '清空缓存', '', 'system/index/clear', '', '_self', '2', '0', '1', '0', '1', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('26', '0', '12', 'system', '添加菜单', '', 'system/menu/add', '', '_self', '1', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('27', '0', '12', 'system', '修改菜单', '', 'system/menu/edit', '', '_self', '2', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('28', '0', '12', 'system', '删除菜单', '', 'system/menu/del', '', '_self', '3', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('29', '0', '12', 'system', '状态设置', '', 'system/menu/status', '', '_self', '4', '0', '1', '1', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('30', '0', '12', 'system', '排序设置', '', 'system/menu/sort', '', '_self', '5', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('31', '0', '12', 'system', '添加快捷菜单', '', 'system/menu/quick', '', '_self', '6', '0', '1', '1', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('32', '0', '12', 'system', '导出菜单', '', 'system/menu/export', '', '_self', '7', '0', '1', '1', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('33', '0', '13', 'system', '添加角色', '', 'system/user/addrole', '', '_self', '1', '0', '1', '1', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('34', '0', '13', 'system', '修改角色', '', 'system/user/editrole', '', '_self', '2', '0', '1', '1', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('35', '0', '13', 'system', '删除角色', '', 'system/user/delrole', '', '_self', '3', '0', '1', '1', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('36', '0', '13', 'system', '状态设置', '', 'system/user/statusRole', '', '_self', '4', '0', '1', '1', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('37', '0', '14', 'system', '添加管理员', '', 'system/user/adduser', '', '_self', '1', '0', '1', '1', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('38', '0', '14', 'system', '修改管理员', '', 'system/user/edituser', '', '_self', '2', '0', '1', '1', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('39', '0', '14', 'system', '删除管理员', '', 'system/user/deluser', '', '_self', '3', '0', '1', '1', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('40', '0', '14', 'system', '状态设置', '', 'system/user/status', '', '_self', '4', '0', '1', '0', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('41', '0', '4', 'system', '个人信息设置', '', 'system/user/info', '', '_self', '5', '0', '1', '0', '1', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('42', '0', '18', 'system', '安装插件', '', 'system/plugins/install', '', '_self', '1', '0', '1', '1', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('43', '0', '18', 'system', '卸载插件', '', 'system/plugins/uninstall', '', '_self', '2', '0', '1', '1', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('44', '0', '18', 'system', '删除插件', '', 'system/plugins/del', '', '_self', '3', '0', '1', '1', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('45', '0', '18', 'system', '状态设置', '', 'system/plugins/status', '', '_self', '4', '0', '1', '1', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('46', '0', '18', 'system', '生成插件', '', 'system/plugins/design', '', '_self', '5', '0', '1', '1', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('47', '0', '18', 'system', '运行插件', '', 'system/plugins/run', '', '_self', '6', '0', '1', '1', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('48', '0', '18', 'system', '更新插件', '', 'system/plugins/update', '', '_self', '7', '0', '1', '1', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('49', '0', '18', 'system', '插件配置', '', 'system/plugins/setting', '', '_self', '8', '0', '1', '1', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('50', '0', '19', 'system', '添加钩子', '', 'system/hook/add', '', '_self', '1', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('51', '0', '19', 'system', '修改钩子', '', 'system/hook/edit', '', '_self', '2', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('52', '0', '19', 'system', '删除钩子', '', 'system/hook/del', '', '_self', '3', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('53', '0', '19', 'system', '状态设置', '', 'system/hook/status', '', '_self', '4', '0', '1', '1', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('54', '0', '19', 'system', '插件排序', '', 'system/hook/sort', '', '_self', '5', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('55', '0', '11', 'system', '添加配置', '', 'system/config/add', '', '_self', '1', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('56', '0', '11', 'system', '修改配置', '', 'system/config/edit', '', '_self', '2', '0', '1', '1', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('57', '0', '11', 'system', '删除配置', '', 'system/config/del', '', '_self', '3', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('58', '0', '11', 'system', '状态设置', '', 'system/config/status', '', '_self', '4', '0', '1', '1', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('59', '0', '11', 'system', '排序设置', '', 'system/config/sort', '', '_self', '5', '0', '1', '1', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('60', '0', '10', 'system', '基础配置', '', 'system/system/index', 'group=base', '_self', '1', '0', '1', '1', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('61', '0', '10', 'system', '系统配置', '', 'system/system/index', 'group=sys', '_self', '2', '0', '1', '1', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('62', '0', '10', 'system', '上传配置', '', 'system/system/index', 'group=upload', '_self', '3', '0', '1', '1', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('63', '0', '10', 'system', '开发配置', '', 'system/system/index', 'group=develop', '_self', '4', '0', '1', '1', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('64', '0', '17', 'system', '生成模块', '', 'system/module/design', '', '_self', '6', '1', '1', '1', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('65', '0', '17', 'system', '安装模块', '', 'system/module/install', '', '_self', '1', '0', '1', '1', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('66', '0', '17', 'system', '卸载模块', '', 'system/module/uninstall', '', '_self', '2', '0', '1', '1', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('67', '0', '17', 'system', '状态设置', '', 'system/module/status', '', '_self', '3', '0', '1', '1', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('68', '0', '17', 'system', '设置默认模块', '', 'system/module/setdefault', '', '_self', '4', '0', '1', '1', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('69', '0', '17', 'system', '删除模块', '', 'system/module/del', '', '_self', '5', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('70', '0', '4', 'system', '预留占位', '', '', '', '_self', '1', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('71', '0', '4', 'system', '预留占位', '', '', '', '_self', '2', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('72', '0', '4', 'system', '预留占位', '', '', '', '_self', '3', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('73', '0', '4', 'system', '预留占位', '', '', '', '_self', '4', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('74', '0', '4', 'system', '预留占位', '', '', '', '_self', '5', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('75', '0', '4', 'system', '预留占位', '', '', '', '_self', '0', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('76', '0', '4', 'system', '预留占位', '', '', '', '_self', '0', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('77', '0', '4', 'system', '预留占位', '', '', '', '_self', '0', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('78', '0', '16', 'system', '附件上传', '', 'system/annex/upload', '', '_self', '1', '0', '1', '1', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('79', '0', '16', 'system', '删除附件', '', 'system/annex/del', '', '_self', '2', '0', '1', '1', '1', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('80', '0', '8', 'system', '框架升级', 'aicon ai-iconfontshengji', 'system/upgrade/index', '', '_self', '4', '0',
        '1', '1', '1', '1491352728');
INSERT INTO `hisi_system_menu`
VALUES ('81', '0', '80', 'system', '获取升级列表', '', 'system/upgrade/lists', '', '_self', '0', '0', '1', '1', '1',
        '1491353504');
INSERT INTO `hisi_system_menu`
VALUES ('82', '0', '80', 'system', '安装升级包', '', 'system/upgrade/install', '', '_self', '0', '0', '1', '1', '1',
        '1491353568');
INSERT INTO `hisi_system_menu`
VALUES ('83', '0', '80', 'system', '下载升级包', '', 'system/upgrade/download', '', '_self', '0', '0', '1', '1', '1',
        '1491395830');
INSERT INTO `hisi_system_menu`
VALUES ('84', '0', '6', 'system', '数据库管理', 'aicon ai-shujukuguanli', 'system/database/index', '', '_self', '6', '0',
        '1', '1', '1', '1491461136');
INSERT INTO `hisi_system_menu`
VALUES ('85', '0', '84', 'system', '备份数据库', '', 'system/database/export', '', '_self', '0', '0', '1', '1', '1',
        '1491461250');
INSERT INTO `hisi_system_menu`
VALUES ('86', '0', '84', 'system', '恢复数据库', '', 'system/database/import', '', '_self', '0', '0', '1', '1', '1',
        '1491461315');
INSERT INTO `hisi_system_menu`
VALUES ('87', '0', '84', 'system', '优化数据库', '', 'system/database/optimize', '', '_self', '0', '0', '1', '1', '1',
        '1491467000');
INSERT INTO `hisi_system_menu`
VALUES ('88', '0', '84', 'system', '删除备份', '', 'system/database/del', '', '_self', '0', '0', '1', '1', '1',
        '1491467058');
INSERT INTO `hisi_system_menu`
VALUES ('89', '0', '84', 'system', '修复数据库', '', 'system/database/repair', '', '_self', '0', '0', '1', '1', '1',
        '1491880879');
INSERT INTO `hisi_system_menu`
VALUES ('90', '0', '21', 'system', '设置默认等级', '', 'system/member/setdefault', '', '_self', '0', '0', '1', '1', '1',
        '1491966585');
INSERT INTO `hisi_system_menu`
VALUES ('91', '0', '10', 'system', '数据库配置', '', 'system/system/index', 'group=databases', '_self', '5', '0', '1', '0',
        '1', '1492072213');
INSERT INTO `hisi_system_menu`
VALUES ('92', '0', '17', 'system', '模块打包', '', 'system/module/package', '', '_self', '7', '0', '1', '1', '1',
        '1492134693');
INSERT INTO `hisi_system_menu`
VALUES ('93', '0', '18', 'system', '插件打包', '', 'system/plugins/package', '', '_self', '0', '0', '1', '1', '1',
        '1492134743');
INSERT INTO `hisi_system_menu`
VALUES ('94', '0', '17', 'system', '主题管理', '', 'system/module/theme', '', '_self', '8', '0', '1', '1', '1',
        '1492433470');
INSERT INTO `hisi_system_menu`
VALUES ('95', '0', '17', 'system', '设置默认主题', '', 'system/module/setdefaulttheme', '', '_self', '9', '0', '1', '1', '1',
        '1492433618');
INSERT INTO `hisi_system_menu`
VALUES ('96', '0', '17', 'system', '删除主题', '', 'system/module/deltheme', '', '_self', '10', '0', '1', '1', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('97', '0', '6', 'system', '语言包管理', '', 'system/language/index', '', '_self', '9', '0', '1', '0', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('98', '0', '97', 'system', '添加语言包', '', 'system/language/add', '', '_self', '100', '0', '1', '0', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('99', '0', '97', 'system', '修改语言包', '', 'system/language/edit', '', '_self', '100', '0', '1', '0', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('100', '0', '97', 'system', '删除语言包', '', 'system/language/del', '', '_self', '100', '0', '1', '0', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('101', '0', '97', 'system', '排序设置', '', 'system/language/sort', '', '_self', '100', '0', '1', '0', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('102', '0', '97', 'system', '状态设置', '', 'system/language/status', '', '_self', '100', '0', '1', '0', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('103', '0', '16', 'system', '收藏夹图标上传', '', 'system/annex/favicon', '', '_self', '3', '0', '1', '0', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('104', '0', '17', 'system', '导入模块', '', 'system/module/import', '', '_self', '11', '0', '1', '0', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('105', '0', '4', 'system', '后台首页', '', 'system/index/welcome', '', '_self', '100', '0', '1', '0', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('106', '0', '4', 'system', '布局切换', '', 'system/user/iframe', '', '_self', '100', '0', '1', '0', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('107', '0', '15', 'system', '删除日志', '', 'system/log/del', 'table=admin_log', '_self', '100', '0', '1', '0', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('108', '0', '15', 'system', '清空日志', '', 'system/log/clear', '', '_self', '100', '0', '1', '0', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('109', '0', '17', 'system', '编辑模块', '', 'system/module/edit', '', '_self', '100', '0', '1', '0', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('110', '0', '17', 'system', '模块图标上传', '', 'system/module/icon', '', '_self', '100', '0', '1', '0', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('111', '0', '18', 'system', '导入插件', '', 'system/plugins/import', '', '_self', '100', '0', '1', '0', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('112', '0', '4', 'system', '钩子插件状态', '', 'system/hook/hookPluginsStatus', '', '_self', '100', '0', '1', '0',
        '1', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('113', '0', '4', 'system', '设置主题', '', 'system/user/setTheme', '', '_self', '100', '0', '1', '0', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('114', '0', '8', 'system', '应用市场', 'aicon ai-app-store', 'system/store/index', '', '_self', '0', '0', '1', '1',
        '1', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('115', '0', '114', 'system', '安装应用', '', 'system/store/install', '', '_self', '0', '0', '1', '1', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('116', '0', '21', 'system', '重置密码', '', 'system/member/resetPwd', '', '_self', '6', '0', '1', '1', '1',
        '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('117', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('118', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('119', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('120', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('121', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('122', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('123', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('124', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('125', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('126', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('127', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('128', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('129', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('130', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('131', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('132', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('133', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('134', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('135', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('136', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('137', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('138', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('139', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('140', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `hisi_system_menu`
VALUES ('141', '0', '1', 'system', '产品管理', 'aicon ai-gongneng', 'system/product/index', '', '_self', '0', '0', '0', '1',
        '1', '1572071534');
INSERT INTO `hisi_system_menu`
VALUES ('142', '0', '141', 'system', '产品列表', 'typcn typcn-th-menu-outline', 'system/product/index', '', '_self', '0',
        '0', '0', '1', '1', '1572071591');
INSERT INTO `hisi_system_menu`
VALUES ('143', '0', '142', 'system', '添加', 'aicon ai-tianjia', 'system/product/add', '', '_self', '0', '0', '0', '0',
        '1', '1572071650');
INSERT INTO `hisi_system_menu`
VALUES ('144', '0', '142', 'system', '编辑', '', 'system/product/edit', '', '_self', '0', '0', '0', '0', '1',
        '1572071672');
INSERT INTO `hisi_system_menu`
VALUES ('145', '0', '1', 'system', '原料分析', 'fa fa-newspaper-o', 'system/material/index', '', '_self', '0', '0', '0',
        '1', '1', '1572095405');
INSERT INTO `hisi_system_menu`
VALUES ('146', '0', '148', 'system', '添加', '', 'system/material/add', '', '_self', '0', '0', '0', '0', '1',
        '1572095447');
INSERT INTO `hisi_system_menu`
VALUES ('147', '0', '148', 'system', '编辑', '', 'system/material/edit', '', '_self', '0', '0', '0', '0', '1',
        '1572095470');
INSERT INTO `hisi_system_menu`
VALUES ('148', '0', '145', 'system', '分析列表', 'fa fa-calculator', 'system/material/index', '', '_self', '0', '0', '0',
        '1', '1', '1572095571');

-- ----------------------------
-- Table structure for hisi_system_menu_lang
-- ----------------------------
DROP TABLE IF EXISTS `hisi_system_menu_lang`;
CREATE TABLE `hisi_system_menu_lang`
(
    `id`      int(11) unsigned NOT NULL AUTO_INCREMENT,
    `menu_id` int(11) unsigned NOT NULL DEFAULT '0',
    `title`   varchar(120) NOT NULL DEFAULT '' COMMENT '标题',
    `lang`    tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '语言包',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=271 DEFAULT CHARSET=utf8 COMMENT='[系统] 管理菜单语言包';

-- ----------------------------
-- Records of hisi_system_menu_lang
-- ----------------------------
INSERT INTO `hisi_system_menu_lang`
VALUES ('131', '1', '首页', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('132', '2', '系统', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('133', '3', '插件', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('134', '4', '快捷菜单', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('135', '5', '插件列表', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('136', '6', '系统基础', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('137', '7', '预留占位', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('138', '8', '系统扩展', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('139', '9', '开发专用', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('140', '10', '系统设置', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('141', '11', '配置管理', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('142', '12', '系统菜单', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('143', '13', '管理员角色', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('144', '14', '系统管理员', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('145', '15', '系统日志', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('146', '16', '附件管理', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('147', '17', '本地模块', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('148', '18', '本地插件', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('149', '19', '插件钩子', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('150', '20', '预留占位', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('151', '21', '预留占位', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('152', '22', '预留占位', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('153', '23', '预留占位', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('154', '24', '后台首页', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('155', '25', '清空缓存', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('156', '26', '添加菜单', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('157', '27', '修改菜单', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('158', '28', '删除菜单', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('159', '29', '状态设置', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('160', '30', '排序设置', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('161', '31', '添加快捷菜单', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('162', '32', '导出菜单', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('163', '33', '添加角色', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('164', '34', '修改角色', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('165', '35', '删除角色', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('166', '36', '状态设置', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('167', '37', '添加管理员', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('168', '38', '修改管理员', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('169', '39', '删除管理员', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('170', '40', '状态设置', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('171', '41', '个人信息设置', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('172', '42', '安装插件', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('173', '43', '卸载插件', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('174', '44', '删除插件', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('175', '45', '状态设置', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('176', '46', '生成插件', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('177', '47', '运行插件', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('178', '48', '更新插件', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('179', '49', '插件配置', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('180', '50', '添加钩子', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('181', '51', '修改钩子', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('182', '52', '删除钩子', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('183', '53', '状态设置', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('184', '54', '插件排序', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('185', '55', '添加配置', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('186', '56', '修改配置', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('187', '57', '删除配置', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('188', '58', '状态设置', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('189', '59', '排序设置', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('190', '60', '基础配置', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('191', '61', '系统配置', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('192', '62', '上传配置', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('193', '63', '开发配置', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('194', '64', '生成模块', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('195', '65', '安装模块', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('196', '66', '卸载模块', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('197', '67', '状态设置', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('198', '68', '设置默认模块', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('199', '69', '删除模块', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('200', '70', '预留占位', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('201', '71', '预留占位', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('202', '72', '预留占位', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('203', '73', '预留占位', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('204', '74', '预留占位', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('205', '75', '预留占位', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('206', '76', '预留占位', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('207', '77', '预留占位', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('208', '78', '附件上传', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('209', '79', '删除附件', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('210', '80', '框架升级', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('211', '81', '获取升级列表', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('212', '82', '安装升级包', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('213', '83', '下载升级包', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('214', '84', '数据库管理', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('215', '85', '备份数据库', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('216', '86', '恢复数据库', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('217', '87', '优化数据库', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('218', '88', '删除备份', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('219', '89', '修复数据库', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('220', '90', '设置默认等级', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('221', '91', '数据库配置', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('222', '92', '模块打包', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('223', '93', '插件打包', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('224', '94', '主题管理', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('225', '95', '设置默认主题', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('226', '96', '删除主题', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('227', '97', '语言包管理', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('228', '98', '添加语言包', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('229', '99', '修改语言包', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('230', '100', '删除语言包', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('231', '101', '排序设置', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('232', '102', '状态设置', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('233', '103', '收藏夹图标上传', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('234', '104', '导入模块', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('235', '105', '后台首页', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('236', '106', '布局切换', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('237', '107', '删除日志', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('238', '108', '清空日志', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('239', '109', '编辑模块', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('240', '110', '模块图标上传', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('241', '111', '导入插件', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('242', '112', '钩子插件状态', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('243', '113', '设置主题', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('244', '114', '应用市场', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('245', '115', '安装应用', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('246', '116', '重置密码', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('247', '117', '预留占位', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('248', '118', '预留占位', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('249', '119', '预留占位', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('250', '120', '预留占位', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('251', '121', '预留占位', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('252', '122', '预留占位', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('253', '123', '预留占位', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('254', '124', '预留占位', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('255', '125', '预留占位', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('256', '126', '预留占位', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('257', '127', '预留占位', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('258', '128', '预留占位', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('259', '129', '预留占位', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('260', '130', '预留占位', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('261', '131', '预留占位', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('262', '132', '预留占位', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('263', '133', '预留占位', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('264', '134', '预留占位', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('265', '135', '预留占位', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('266', '136', '预留占位', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('267', '137', '预留占位', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('268', '138', '预留占位', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('269', '139', '预留占位', '1');
INSERT INTO `hisi_system_menu_lang`
VALUES ('270', '140', '预留占位', '1');

-- ----------------------------
-- Table structure for hisi_system_module
-- ----------------------------
DROP TABLE IF EXISTS `hisi_system_module`;
CREATE TABLE `hisi_system_module`
(
    `id`         int(10) unsigned NOT NULL AUTO_INCREMENT,
    `system`     tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '系统模块',
    `name`       varchar(50)  NOT NULL COMMENT '模块名(英文)',
    `identifier` varchar(100) NOT NULL COMMENT '模块标识(模块名(字母).开发者标识.module)',
    `title`      varchar(50)  NOT NULL COMMENT '模块标题',
    `intro`      varchar(255) NOT NULL COMMENT '模块简介',
    `author`     varchar(100) NOT NULL COMMENT '作者',
    `icon`       varchar(80)  NOT NULL DEFAULT 'aicon ai-mokuaiguanli' COMMENT '图标',
    `version`    varchar(20)  NOT NULL COMMENT '版本号',
    `url`        varchar(255) NOT NULL COMMENT '链接',
    `sort`       int(5) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
    `status`     tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0未安装，1未启用，2已启用',
    `default`    tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '默认模块(只能有一个)',
    `config`     text         NOT NULL COMMENT '配置',
    `app_id`     varchar(30)  NOT NULL DEFAULT '0' COMMENT '应用市场ID(0本地)',
    `app_keys`   varchar(200)          DEFAULT '' COMMENT '应用秘钥',
    `theme`      varchar(50)  NOT NULL DEFAULT 'default' COMMENT '主题模板',
    `ctime`      int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
    `mtime`      int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
    PRIMARY KEY (`id`),
    UNIQUE KEY `name` (`name`),
    UNIQUE KEY `identifier` (`identifier`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='[系统] 模块';

-- ----------------------------
-- Records of hisi_system_module
-- ----------------------------
INSERT INTO `hisi_system_module`
VALUES ('1', '1', 'system', 'system.hisiphp.module', '系统管理模块', '系统核心模块，用于后台各项管理功能模块及功能拓展', 'HisiPHP官方出品', '', '1.0.0',
        'http://www.hisiphp.com', '0', '2', '0', '', '0', '', 'default', '1489998096', '1489998096');
INSERT INTO `hisi_system_module`
VALUES ('2', '1', 'index', 'index.hisiphp.module', '默认模块', '推荐使用扩展模块作为默认首页。', 'HisiPHP官方出品', '', '1.0.0',
        'http://www.hisiphp.com', '0', '2', '0', '', '0', '', 'default', '1489998096', '1489998096');
INSERT INTO `hisi_system_module`
VALUES ('3', '1', 'install', 'install.hisiphp.module', '系统安装模块', '系统安装模块，勿动。', 'HisiPHP官方出品', '', '1.0.0',
        'http://www.hisiphp.com', '0', '2', '0', '', '0', '', 'default', '1489998096', '1489998096');

-- ----------------------------
-- Table structure for hisi_system_plugins
-- ----------------------------
DROP TABLE IF EXISTS `hisi_system_plugins`;
CREATE TABLE `hisi_system_plugins`
(
    `id`         int(11) unsigned NOT NULL AUTO_INCREMENT,
    `system`     tinyint(1) unsigned NOT NULL DEFAULT '0',
    `name`       varchar(32)  NOT NULL COMMENT '插件名称(英文)',
    `title`      varchar(32)  NOT NULL COMMENT '插件标题',
    `icon`       varchar(64)  NOT NULL COMMENT '图标',
    `intro`      text         NOT NULL COMMENT '插件简介',
    `author`     varchar(32)  NOT NULL COMMENT '作者',
    `url`        varchar(255) NOT NULL COMMENT '作者主页',
    `version`    varchar(16)  NOT NULL DEFAULT '' COMMENT '版本号',
    `identifier` varchar(64)  NOT NULL DEFAULT '' COMMENT '插件唯一标识符',
    `config`     text         NOT NULL COMMENT '插件配置',
    `app_id`     varchar(30)  NOT NULL DEFAULT '0' COMMENT '来源(0本地)',
    `app_keys`   varchar(200)          DEFAULT '' COMMENT '应用秘钥',
    `ctime`      int(10) unsigned NOT NULL DEFAULT '0',
    `mtime`      int(10) unsigned NOT NULL DEFAULT '0',
    `sort`       int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
    `status`     tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='[系统] 插件表';

-- ----------------------------
-- Records of hisi_system_plugins
-- ----------------------------
INSERT INTO `hisi_system_plugins`
VALUES ('1', '1', 'hisiphp', '系统基础信息', '/static/plugins/hisiphp/hisiphp.png', '后台首页展示系统基础信息和开发团队信息', 'HisiPHP',
        'http://www.hisiphp.com', '1.0.0', 'hisiphp.hisiphp.plugins', '', '0', '', '1509379331', '1509379331', '0',
        '2');

-- ----------------------------
-- Table structure for hisi_system_role
-- ----------------------------
DROP TABLE IF EXISTS `hisi_system_role`;
CREATE TABLE `hisi_system_role`
(
    `id`     int(10) unsigned NOT NULL AUTO_INCREMENT,
    `name`   varchar(50)  NOT NULL COMMENT '角色名称',
    `intro`  varchar(200) NOT NULL COMMENT '角色简介',
    `auth`   text         NOT NULL COMMENT '角色权限',
    `ctime`  int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
    `mtime`  int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
    `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
    PRIMARY KEY (`id`),
    UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='[系统] 管理角色';

-- ----------------------------
-- Records of hisi_system_role
-- ----------------------------
INSERT INTO `hisi_system_role`
VALUES ('1', '超级管理员', '拥有系统最高权限', '0', '1489411760', '0', '1');
INSERT INTO `hisi_system_role`
VALUES ('2', '系统管理员', '拥有系统管理员权限',
        '[\"1\",\"4\",\"25\",\"24\",\"2\",\"6\",\"10\",\"60\",\"61\",\"62\",\"63\",\"91\",\"11\",\"55\",\"56\",\"57\",\"58\",\"59\",\"12\",\"26\",\"27\",\"28\",\"29\",\"30\",\"31\",\"32\",\"13\",\"33\",\"34\",\"35\",\"36\",\"14\",\"37\",\"38\",\"39\",\"40\",\"41\",\"16\",\"78\",\"79\",\"84\",\"85\",\"86\",\"87\",\"88\",\"89\",\"7\",\"20\",\"75\",\"76\",\"77\",\"21\",\"90\",\"70\",\"71\",\"72\",\"73\",\"74\",\"8\",\"17\",\"65\",\"66\",\"67\",\"68\",\"94\",\"95\",\"18\",\"42\",\"43\",\"45\",\"47\",\"48\",\"49\",\"19\",\"80\",\"81\",\"82\",\"83\",\"9\",\"22\",\"23\",\"3\",\"5\"]',
        '1489411760', '1507731116', '1');
INSERT INTO `hisi_system_role`
VALUES ('3', '普通管理员', '普通管理员', '{\"0\":\"1\",\"1\":\"4\",\"2\":\"25\",\"4\":\"24\",\"6\":\"106\",\"8\":\"113\"}',
        '1507737902', '1542075415', '1');
INSERT INTO `hisi_system_role`
VALUES ('4', '采购经理', '采购经理',
        '[\"1\",\"4\",\"24\",\"25\",\"41\",\"105\",\"106\",\"112\",\"113\",\"141\",\"142\",\"143\",\"144\",\"145\",\"148\",\"146\",\"147\"]',
        '1572141083', '1572141297', '1');
INSERT INTO `hisi_system_role`
VALUES ('5', '采购员', '采购员',
        '[\"1\",\"4\",\"24\",\"25\",\"41\",\"105\",\"106\",\"112\",\"113\",\"141\",\"142\",\"143\",\"144\",\"145\",\"148\",\"146\",\"147\"]',
        '1572141324', '1572141324', '1');
INSERT INTO `hisi_system_role`
VALUES ('6', '跟单员', '跟单员',
        '[\"1\",\"4\",\"24\",\"25\",\"41\",\"105\",\"106\",\"112\",\"113\",\"141\",\"142\",\"143\",\"144\",\"145\",\"148\",\"146\",\"147\"]',
        '1572141412', '1572141412', '1');
INSERT INTO `hisi_system_role`
VALUES ('7', '仓库主管', '仓库主管',
        '[\"1\",\"4\",\"24\",\"25\",\"41\",\"105\",\"106\",\"112\",\"113\",\"141\",\"142\",\"143\",\"144\",\"145\",\"148\",\"146\",\"147\"]',
        '1572141442', '1572141442', '1');
INSERT INTO `hisi_system_role`
VALUES ('8', '数据员', '数据员',
        '[\"1\",\"4\",\"24\",\"25\",\"41\",\"105\",\"106\",\"112\",\"113\",\"141\",\"142\",\"143\",\"144\",\"145\",\"148\",\"146\",\"147\"]',
        '1572141473', '1572141473', '1');
INSERT INTO `hisi_system_role`
VALUES ('9', '质检经理', '质检经理',
        '[\"1\",\"4\",\"24\",\"25\",\"41\",\"105\",\"106\",\"112\",\"113\",\"141\",\"142\",\"143\",\"144\",\"145\",\"148\",\"146\",\"147\"]',
        '1572141492', '1572141492', '1');
INSERT INTO `hisi_system_role`
VALUES ('10', '订购人主管', '订购人主管',
        '[\"1\",\"4\",\"24\",\"25\",\"41\",\"105\",\"106\",\"112\",\"113\",\"141\",\"142\",\"143\",\"144\",\"145\",\"148\",\"146\",\"147\"]',
        '1572141520', '1572141520', '1');
INSERT INTO `hisi_system_role`
VALUES ('11', '产品经理', '产品经理',
        '[\"1\",\"4\",\"24\",\"25\",\"41\",\"105\",\"106\",\"112\",\"113\",\"141\",\"142\",\"143\",\"144\",\"145\",\"148\",\"146\",\"147\"]',
        '1572141541', '1572141541', '1');
INSERT INTO `hisi_system_role`
VALUES ('12', '订购人', '订购人',
        '[\"1\",\"4\",\"24\",\"25\",\"41\",\"105\",\"106\",\"112\",\"113\",\"141\",\"142\",\"143\",\"144\",\"145\",\"148\",\"146\",\"147\"]',
        '1572142340', '1572142340', '1');

-- ----------------------------
-- Table structure for hisi_system_user
-- ----------------------------
DROP TABLE IF EXISTS `hisi_system_user`;
CREATE TABLE `hisi_system_user`
(
    `id`              int(10) unsigned NOT NULL AUTO_INCREMENT,
    `role_id`         varchar(100) NOT NULL DEFAULT '0' COMMENT '多个角色,分割',
    `username`        varchar(50)  NOT NULL COMMENT '用户名',
    `password`        varchar(64)  NOT NULL,
    `nick`            varchar(50)  NOT NULL COMMENT '昵称',
    `mobile`          varchar(11)  NOT NULL,
    `email`           varchar(50)  NOT NULL COMMENT '邮箱',
    `auth`            text         NOT NULL COMMENT '权限',
    `iframe`          tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0默认，1框架',
    `theme`           varchar(50)  NOT NULL DEFAULT 'default' COMMENT '主题',
    `status`          tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
    `last_login_ip`   varchar(128) NOT NULL COMMENT '最后登陆IP',
    `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登陆时间',
    `remark`          varchar(500)          DEFAULT NULL,
    `ctime`           int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
    `mtime`           int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='[系统] 管理用户';

-- ----------------------------
-- Records of hisi_system_user
-- ----------------------------
INSERT INTO `hisi_system_user`
VALUES ('1', '1', 'admin', '$2y$10$gOH6Z0b07rbxXYGi.2Z7jO7RyvDXvZ1.iCV8FDeD99Ng8LpCIKB3W', '超级管理员', '', '', '', '0',
        'default', '1', '127.0.0.1', '1572353440', null, '1572071353', '1572353440');
INSERT INTO `hisi_system_user`
VALUES ('2', '4', 'ceshi', '$2y$10$VUxXBoHG3qGrB1Nm0Z1E7.Ff6PsCzl2i1lERZPs7sxGxSz356NM/2', 'ceshi', '15829999999',
        '3999@163.com', '', '0', 'default', '1', '127.0.0.1', '0', null, '1572096828', '1572141652');
INSERT INTO `hisi_system_user`
VALUES ('3', '5', 'caigouyuan', '$2y$10$zFwewsUeFCMNxnrBbIrTaelHx.ItK6Ygir2AASM1CxII3U/SNr5vK', '采购员', '15829999999',
        '399213463@qq.com', '', '0', 'default', '1', '127.0.0.1', '0', null, '1572142003', '1572142003');
INSERT INTO `hisi_system_user`
VALUES ('4', '6', 'gendanyuan', '$2y$10$9yFwhqSZ0mK5FqY5UYzIv.9u/Pj4QuZ6mo7DmHNMcqflYt/A3j5ES', '跟单员', '15892929999',
        '39921343@qq.com', '', '0', 'default', '1', '127.0.0.1', '0', null, '1572142188', '1572142188');
INSERT INTO `hisi_system_user`
VALUES ('5', '12', '000111', '$2y$10$Cn9n1QWHXS1IsIIBx/Ttf.GHHChmEYZtAVjCXk3UWHVMhbb4HvqTS', '订购人', '15489929266',
        '3992@163.com', '', '0', 'default', '1', '127.0.0.1', '0', null, '1572142411', '1572142411');

-- ----------------------------
-- Table structure for hisi_system_product
-- ----------------------------
DROP TABLE IF EXISTS `hisi_system_product`;
CREATE TABLE `hisi_system_product`
(
    `id`             INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name`           VARCHAR(255) NOT NULL DEFAULT '0' COMMENT '多个角色,分割',
    `ename`          VARCHAR(255) NOT NULL COMMENT '用户名',
    `catalog`        VARCHAR(50)  NOT NULL,
    `cas`            VARCHAR(64)  NOT NULL,
    `mdl`            VARCHAR(50)  NOT NULL COMMENT '昵称',
    `purity`         VARCHAR(50)  NOT NULL COMMENT '纯度',
    `mf`             VARCHAR(50)  NOT NULL COMMENT '分子式',
    `mw`             VARCHAR(50)  NOT NULL COMMENT '分子量',
    `smiles`         VARCHAR(255) NOT NULL DEFAULT '0' COMMENT '0默认，1框架',
    `inchi`          VARCHAR(255) NOT NULL DEFAULT 'default' COMMENT '主题',
    `inchikey`       VARCHAR(50)  NOT NULL DEFAULT '1' COMMENT '状态',
    `ghs`            VARCHAR(50)  NOT NULL,
    `store`          VARCHAR(50)  NOT NULL DEFAULT '0' COMMENT '储存条件',
    `transport`      VARCHAR(255)          DEFAULT '' COMMENT '运输条件',
    `physical_trait` VARCHAR(255)          DEFAULT NULL,
    `packing_rules`  VARCHAR(255)          DEFAULT NULL COMMENT '分装条件',
    `package`        VARCHAR(255)          DEFAULT NULL COMMENT '包装材料',
    `struture`       VARCHAR(255)          DEFAULT NULL,
    `nmr`            VARCHAR(255)          DEFAULT NULL,
    `nmrsolvent`     VARCHAR(255)          DEFAULT NULL COMMENT '检测溶剂',
    `hplc`           VARCHAR(255)          DEFAULT NULL,
    `gc`             VARCHAR(255)          DEFAULT NULL,
    `ms`             VARCHAR(255)          DEFAULT NULL,
    `optical`        VARCHAR(255)          DEFAULT NULL COMMENT '旋光',
    `ee`             VARCHAR(255)          DEFAULT NULL,
    `review`         VARCHAR(255)          DEFAULT NULL,
    `remark`         VARCHAR(255)          DEFAULT NULL,
    `ctime`          INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
    `mtime`          INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '修改时间',
    PRIMARY KEY (`id`),
    UNIQUE KEY uk_inquiry_no (inquiry_no),
) ENGINE = InnoDB
  AUTO_INCREMENT = 2
  DEFAULT CHARSET = utf8 COMMENT ='[系统] 产品';

-- ----------------------------
-- Records of hisi_system_product
-- ----------------------------
INSERT INTO `hisi_system_product`
VALUES ('1', 'sadf', 'sadf', 'ewrasdf', 'dsaf', 'dsfa', 'adsf', 'sdaf', 'asdf', 'dsaf', 'dsfa', 'sdaf', '', 'sdaf',
        'dsfa', 'sdaf', 'sadf', 'dsaf', '/upload/sys/image/59/5421f9543e0ea366d84ac9844c3c53.png', 'fdsa', 'dsfa',
        'dsaf', 'dsaf', 'dfsadaf', 'fds', 'af', 'aewsdsaf', 'dsafeweaafdsf', '1572079410', '1572081348');


-- ----------------------------
-- Table structure for hisi_system_material
-- ----------------------------
DROP TABLE IF EXISTS `hisi_system_material`;
CREATE TABLE `hisi_system_material`
(
    `id`                INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `uid`               INT(10) NOT NULL COMMENT '登录人ID',
    `test_num`          VARCHAR(255) NOT NULL DEFAULT '0' COMMENT '送检单号',
    `catalog`           VARCHAR(255) NOT NULL COMMENT '货号',
    `file`              VARCHAR(255)          DEFAULT NULL,
    `file_size`         VARCHAR(50)           DEFAULT NULL,
    `file_name`         VARCHAR(255)          DEFAULT NULL,
    `nmr_num`           VARCHAR(50)  NOT NULL COMMENT '核磁编号',
    `nmr_method`        VARCHAR(50)  NOT NULL COMMENT '核磁检测方法',
    `po_num`            VARCHAR(50)  NOT NULL COMMENT 'PO单号',
    `results`           VARCHAR(50)  NOT NULL COMMENT '分析结论',
    `if_store`          TINYINT(1) NOT NULL DEFAULT '0' COMMENT '0否，1是 是否入库',
    `last_num`          VARCHAR(50)  NOT NULL COMMENT '最近一次核磁编号',
    `appearance`        VARCHAR(50)  NOT NULL COMMENT '外观',
    `order_amount`      VARCHAR(50)  NOT NULL COMMENT '订购数量',
    `optical`           VARCHAR(50)  NOT NULL DEFAULT '0' COMMENT '旋光检测条件',
    `optical_result`    VARCHAR(100)          DEFAULT '' COMMENT '旋光检测结果',
    `ee`                VARCHAR(100)          DEFAULT NULL COMMENT 'EE% 检测条件',
    `ee_result`         VARCHAR(100)          DEFAULT NULL COMMENT 'EE% 结果',
    `hplc_result`       VARCHAR(100)          DEFAULT NULL COMMENT '结果',
    `gc_result`         VARCHAR(100)          DEFAULT NULL,
    `ms_result`         VARCHAR(100)          DEFAULT NULL,
    `if_accept`         TINYINT(1) DEFAULT NULL COMMENT '是否接收 0空白，1接收，2不接收，换货或重新采购 3不接收退货不再订购',
    `purchaser`         VARCHAR(100)          DEFAULT NULL COMMENT '采购员',
    `merchandiser`      VARCHAR(100)          DEFAULT NULL COMMENT '跟单员',
    `supplier_id`       INT (10) DEFAULT 0 COMMENT '供应商ID',
    `supplier`          VARCHAR(100)          DEFAULT NULL COMMENT '供应商名称',
    `user_name`         VARCHAR(50)           DEFAULT NULL COMMENT '订购人',
    `water_content`     VARCHAR(50)           DEFAULT NULL COMMENT '含水量',
    `ph_num`            VARCHAR(50)           DEFAULT NULL COMMENT 'PH',
    `melting_point`     VARCHAR(50)           DEFAULT NULL COMMENT '熔点',
    `batch_num`         VARCHAR(50)           DEFAULT NULL COMMENT '批号',
    `purchaser_tel`     VARCHAR(50)           DEFAULT NULL COMMENT '采购员电话',
    `merchandiser_tel`  VARCHAR(50)           DEFAULT NULL COMMENT '跟单员电话',
    `user_tel`          VARCHAR(50)           DEFAULT NULL COMMENT '订购人电话',
    `purchaser_name`    VARCHAR(50)           DEFAULT NULL COMMENT '采购员名',
    `merchandiser_name` VARCHAR(50)           DEFAULT NULL COMMENT '跟单员名',
    `user_nick`         VARCHAR(50)           DEFAULT NULL COMMENT '采购员',
    `purchaser_super`   VARCHAR(50)           DEFAULT NULL COMMENT '采购员主管',
    `house_super`       VARCHAR(50)           DEFAULT NULL COMMENT '仓库主管',
    `user_super`        VARCHAR(50)           DEFAULT NULL COMMENT '订购人主管',
    `recevier_name`     VARCHAR(50)           DEFAULT NULL,
    `remark`            VARCHAR(255)          DEFAULT NULL,
    `ctime`             INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
    `mtime`             INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '修改时间',
    PRIMARY KEY (`id`),
    INDEX catalog (catalog)
) ENGINE = InnoDB
  AUTO_INCREMENT = 7
  DEFAULT CHARSET = utf8 COMMENT ='[系统] 分析';

-- ----------------------------
-- Records of hisi_system_material
-- ----------------------------
INSERT INTO `hisi_system_material`
VALUES ('3', '1', 'dsaffdsa', 'ewrasdf', '/upload/sys/file/16/24c3bab7eb3ecce2da81c599953362.doc', '9',
        '新建 DOC 文档 - 副本.doc', 'fdsa', 'dsfa', 'fdsa', 'dsaf', '1', 'fdsa', 'fdsa', 'dfsa', 'fdsa', 'dsaf', 'afds',
        'dsfa', 'fdsa', 'fdsa', 'ssddsdsfds', '1', '3', '4', 'fdsafdfsa', '5', 'dfs', 'erttre', 'dfsg', '55555', null,
        null, null, null, null, null, null, null, null, null, 'dsaffddegrsdsgfdsgfgdsfgfds', '1572148795',
        '1572251588');
INSERT INTO `hisi_system_material`
VALUES ('4', '1', 'safsadf', 'ewrasdf', '', '', '', 'fdsasfdfd', 'sfdafd', 'sdaf', 'fdsa', '1', 'fdsa', 'asfd', 'fdas',
        'easdsfasd', 'fdsfds', 'sfda', 'sdfa', 'fdsa', 'fdsa', 'dasf', '1', '3', '4', 'dasf', '5', 'asfdfdas',
        'fdsafdsa', 'dsffda', '6daf758', null, null, null, null, null, null, null, null, null, null, 'dasffdafdsafsda',
        '1572254266', '1572254323');
INSERT INTO `hisi_system_material`
VALUES ('5', '1', 'weawea', 'ewrasdf', '', '', '', 'aweafw', 'adsf', 'adsf', 'adsf', '1', 'fdsa', 'adsf', 'adsf', '',
        'dsaf', 'sadf', '', '', 'asdf', '', '1', '3', '4', 'asdf', '5', 'asdf', 'asdf', 'asdf', '6daf759',
        '15829999999', '15892929999', '15489929266', '采购员', '跟单员', '订购人', 'ceshi', null, null, '超级管理员', 'asdf',
        '1572353544', '1572353544');
INSERT INTO `hisi_system_material`
VALUES ('6', '0', 'test_num', 'ewrasdf', 'file', 'file_size', 'file_name', 'nmr_num', 'nmr_method', 'po_num', 'results',
        '0', 'last_num', 'appearance', 'order_amount', 'optical', 'optical_result', 'ee', 'ee_result', 'hplc_result',
        'gc_result', 'ms_result', '0', 'purchaser', 'merchandiser', 'supplier', 'user_name', 'water_content', 'ph_num',
        'melting_point', 'batch_num', 'purchaser_tel', 'merchandiser_tel', 'user_tel', 'purchaser_name',
        'merchandiser_name', 'user_nick', 'purchaser_super', 'house_super', 'user_super', 'recevier_name', 'remark',
        '1572356609', '1572356609');

CREATE TABLE hisi_system_supplier
(
    id             INT AUTO_INCREMENT PRIMARY KEY COMMENT '供应商ID',
    supplier_name  VARCHAR(100)           NOT NULL COMMENT '供应商名称',
    supplier_type  TINYINT(1)   DEFAULT 1 COMMENT '供应商类型：生产商、代理商、经销商等',
    invoice_type   VARCHAR(50) COMMENT '开票类型：增值税专用发票、普通发票等',
    tax_rate       DECIMAL(5, 2) COMMENT '税率（百分比，如13.00表示13%）',
    payment_type   TINYINT(1)   DEFAULT 1 COMMENT '付款条件：月结30天、预付等',
    bank_account   VARCHAR(50) COMMENT '供应商账号',
    bank_name      VARCHAR(100) COMMENT '开户行',
    bank_branch    VARCHAR(100) COMMENT '开户支行',
    address        VARCHAR(255) COMMENT '地址',
    province       VARCHAR(50) COMMENT '省份',
    city           VARCHAR(50) COMMENT '城市',
    district       VARCHAR(50) COMMENT '区县',
    post_code      VARCHAR(20) COMMENT '邮政编码',
    contact_person VARCHAR(50) COMMENT '联系人',
    contact_phone  VARCHAR(20) COMMENT '联系电话',
    contact_mobile VARCHAR(20) COMMENT '手机号码',
    contact_qq     VARCHAR(20) COMMENT 'QQ号码',
    contact_email  VARCHAR(100) COMMENT 'E-mail',
    wechat         VARCHAR(50) COMMENT '微信号',
    credit_code    VARCHAR(50) COMMENT '统一社会信用代码',
    status         TINYINT      DEFAULT 1 COMMENT '状态：0-停用，1-启用，2-待审核',
    ctime          INT UNSIGNED DEFAULT 0 NOT NULL COMMENT '创建时间',
    mtime          INT UNSIGNED DEFAULT 0 NOT NULL COMMENT '修改时间',
    UNIQUE KEY uk_credit_code (credit_code) COMMENT '统一社会信用代码唯一',
    INDEX idx_status (status),
    INDEX idx_city (supplier_name)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci COMMENT ='供应商表';

DROP TABLE IF EXISTS `hisi_system_delivery`;
CREATE TABLE `hisi_system_delivery`
(
    `id`                  INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `catalog`             VARCHAR(100)   NOT NULL DEFAULT '' COMMENT '货号',
    `cas`                 VARCHAR(64)    NOT NULL DEFAULT '' COMMENT 'cas号',
    `physical_trait`      VARCHAR(255)   NOT NULL DEFAULT '' COMMENT '外观',
    `supplier`            VARCHAR(255)   NOT NULL DEFAULT '' COMMENT '供应商',
    `po_num`              VARCHAR(255)   NOT NULL DEFAULT '' COMMENT '采购单号',
    `purchase_num`        DECIMAL(10, 2) NOT NULL DEFAULT 0 COMMENT '采购数量',
    `delivered_num`       DECIMAL(10, 2) NOT NULL DEFAULT 0 COMMENT '到货数量',
    `unit`                VARCHAR(255)   NOT NULL DEFAULT '' COMMENT '单位',
    `delivered_date`      VARCHAR(32)    NOT NULL DEFAULT '' COMMENT '到货日前',
    `supplier_evaluation` VARCHAR(255)   NOT NULL DEFAULT '' COMMENT '供应商评价',
    `is_analysis`         INT(10) NOT NULL DEFAULT 0 COMMENT '是否送检',
    `remark`              VARCHAR(255)            DEFAULT NULL DEFAULT '',
    `ctime`               INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
    `mtime`               INT(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '修改时间',
    PRIMARY KEY (`id`),
    INDEX catalog (catalog)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COMMENT ='[系统] 到货登记';
CREATE TABLE hisi_system_inquiry_order
(
    id                  INT AUTO_INCREMENT PRIMARY KEY COMMENT '询价单ID',
    inquiry_no          VARCHAR(50)    NOT NULL COMMENT '询价单号（自动生成）',
    catalog             VARCHAR(100)   NOT NULL,
    cas                 VARCHAR(64)    NOT NULL,
    quantity            DECIMAL(12, 4) NOT NULL COMMENT '数量',
    price_excluding_tax DECIMAL(12, 4) COMMENT '不含税价',
    total_price         DECIMAL(12, 4) COMMENT '总价',
    invoice_type        VARCHAR(50) COMMENT '发票类型',
    tax_rate            DECIMAL(5, 2) COMMENT '税率（百分比，如13.00表示13%）',
    `supplier_id`       INT (10) DEFAULT 0 COMMENT '供应商ID',
    supplier            VARCHAR(50)    NOT NULL COMMENT '供应商',
    need_spectrum       TINYINT DEFAULT 0 COMMENT '是否提供谱图：0-否，1-是',
    remark              TEXT COMMENT '备注',
    ctime               INT UNSIGNED DEFAULT 0 NOT NULL COMMENT '创建时间',
    mtime               INT UNSIGNED DEFAULT 0 NOT NULL COMMENT '修改时间',
    UNIQUE KEY uk_inquiry_no (inquiry_no),
    INDEX catalog (catalog)
) ENGINE = InnoDB COMMENT ='询价单表';

CREATE TABLE hisi_system_purchase_order
(
    id                   INT AUTO_INCREMENT PRIMARY KEY COMMENT '采购单ID',
    purchase_no          VARCHAR(50)    NOT NULL COMMENT '采购单号（自动生成）',
    inquiry_no           VARCHAR(50)    NOT NULL COMMENT '询价单号',
    catalog              VARCHAR(100)   NOT NULL,
    cas                  VARCHAR(64)    NOT NULL,
    quantity             DECIMAL(12, 4) NOT NULL COMMENT '数量',
    unit                 VARCHAR(20) COMMENT '单位（冗余存储，方便查询）',
    price_excluding_tax  DECIMAL(12, 4) COMMENT '不含税价',
    total_price          DECIMAL(12, 4) COMMENT '总价',
    invoice_type         VARCHAR(50) COMMENT '发票类型',
    tax_rate             DECIMAL(5, 2) COMMENT '税率（百分比）',
    `supplier_id`        INT (10) DEFAULT 0 COMMENT '供应商ID',
    supplier             VARCHAR(50)    NOT NULL COMMENT '供应商',
    tracking_no          VARCHAR(100) COMMENT '运单号',
    tracking_info        TEXT COMMENT '运单路由信息（接口生成）',
    need_spectrum        TINYINT DEFAULT 0 COMMENT '是否提供谱图',
    purchase_person      VARCHAR(50) COMMENT '采购员',
    purchase_date        DATE COMMENT '采购日期',
    delivery_date        DATE COMMENT '要求交货日期',
    actual_delivery_date DATE COMMENT '实际交货日期',
    remark               TEXT COMMENT '备注',
    ctime                INT UNSIGNED DEFAULT 0 NOT NULL COMMENT '创建时间',
    mtime                INT UNSIGNED DEFAULT 0 NOT NULL COMMENT '修改时间',
    UNIQUE KEY uk_purchase_no (purchase_no),
    INDEX catalog (catalog)
) ENGINE = InnoDB COMMENT ='采购单表';

CREATE TABLE hisi_system_complaint
(
    id                INT AUTO_INCREMENT PRIMARY KEY COMMENT '主键ID',
    catalog           VARCHAR(100)  NOT NULL DEFAULT '',
    cas               VARCHAR(64)   NOT NULL DEFAULT '',
    sales_order_no    VARCHAR(50)   NOT NULL DEFAULT '' COMMENT '销售订单号',
    customer_order_no VARCHAR(50)   NOT NULL DEFAULT '' COMMENT '客户订单号',
    purchase_order_no VARCHAR(50)   NOT NULL DEFAULT '' COMMENT '对应采购单号',
    purity            VARCHAR(50)   NOT NULL DEFAULT '' COMMENT '纯度',
    order_quantity    DECIMAL(10, 2) COMMENT '订单数量',
    order_amount      DECIMAL(10, 2) COMMENT '订单金额',
    customer_name     VARCHAR(100)  NOT NULL DEFAULT '' COMMENT '客户名称',
    sales_person      VARCHAR(50)   NOT NULL DEFAULT '' COMMENT '销售人员',
    supplier_name     VARCHAR(100)  NOT NULL DEFAULT '' COMMENT '供应商名称',
    purchaser         VARCHAR(50)   NOT NULL DEFAULT '' COMMENT '采购员',
    complaint_content VARCHAR(1000) NOT NULL DEFAULT '' COMMENT '投诉内容',
    result            VARCHAR(500)  NOT NULL DEFAULT '' COMMENT '处理结果',
    ctime             INT UNSIGNED DEFAULT 0 NOT NULL COMMENT '创建时间',
    mtime             INT UNSIGNED DEFAULT 0 NOT NULL COMMENT '修改时间',
    INDEX catalog (catalog)
) ENGINE = InnoDB COMMENT ='投诉表';