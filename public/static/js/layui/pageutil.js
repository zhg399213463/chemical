function getRootPath_dc() 
{
    var pathName = window.location.pathname.substring(1);
    var webName = pathName == '' ? '' : pathName.substring(0, pathName.indexOf('/'));
    if (webName == "") {
        return window.location.protocol + '//' + window.location.host;
    }
    else {
        return window.location.protocol + '//' + window.location.host + '/' + webName;
    }
}
var RootPath = getRootPath_dc();
/**
 * js获取url后所带参数值
 * @param key
 * @returns
 */
function getQueryString(key) {
	var reg = new RegExp("(^|&)" + key + "=([^&]*)(&|$)");
	var result = window.location.search.substr(1).match(reg);
	return result ? decodeURIComponent(result[2]) : null;
}
/**
 * 异步后台提交和获取数据
 */
function DataInit(UrlStr,ParamData,successFunction,errorFunction)
{
	 var aj = $.ajax({  
		    url:UrlStr,// 跳转到 action  
		    data:ParamData,
		    type:'post',  
		    cache:false,  
		    dataType:'json',  
		    success:successFunction,
			error :errorFunction
		});
}
/**
 * 异步后台提交和获取数据
 */
function DataInit_resultStr(UrlStr,ParamData,successFunction,errorFunction)
{
	 var aj = $.ajax({  
		    url:UrlStr,// 跳转到 action  
		    data:ParamData,
		    type:'post',  
		    cache:false,  
		    success:successFunction,
			error :errorFunction
		});
}
/**
 * 异步后台提交和获取数据
 */
function DataInitBefore(UrlStr,ParamData,successFunction,beforeSendAction,errorFunction)
{
	 var aj = $.ajax({  
		    url:UrlStr,// 跳转到 action  
		    data:ParamData,
		    type:'post',  
		    cache:false,  
		    dataType:'json',
		    beforeSend:beforeSendAction,
		    success:successFunction,
			error :errorFunction
		});
}
/**
 * 判断对象是否存在并且判断字符串是否为空，如果对象不存在或者为空都返回：true，否则返回false
 * @param temStr
 * @returns {Boolean}
 */
function IsNullOrBlank(temStr)
{
	if(temStr)
		if(cTrim(temStr,0)=="")
			return true;
		else
			return false;
	else
		return true;
}
/**
 * 如果对象不存在就返回空字符串否则返回自己（只针对字符串类型数据）
 * @param temStr
 * @returns
 */
function GetValueOrTrim(temStr)
{
	if(isNumber(temStr))
		return temStr;
	else if(isString(temStr))
	{	
		if(IsNullOrBlank(temStr))
			return "";
		else
			return temStr;
	}
	else
		return "";
}
/**
 * 如果对象不存在或为空返回给定的初始值，否则返回自己（只针对字符串类型数据）
 * @param temStr
 * @param defvalue
 * @returns
 */
function GetValueOrDef(temStr,defvalue)
{
	if(IsNullOrBlank(temStr))
		return defvalue;
	else
		return temStr;
}
/**
 * 格式化日期字符串展示
 * @param temStr
 * @param temFormat
 * @returns {String}
 */
function GetDateTimeStr(temStr,temFormat)
{
	var returnStr = "";
	if(!IsNullOrBlank(temStr))
	{
		if(temStr.indexOf (':')<0)
			temStr +=" 00:00:00";
		if(CheckDateTime(temStr))
	    {
			var temDate = StringToDate(temStr);
			returnStr = temDate.Format(temFormat);
	    }
	}
	return returnStr;
}
/**
 * 替换页面指定标签内容
 * @param TagName
 * @param valueStr
 */
function ChangeTagText(TagName,valueStr)
{
	var Cur_Tag = $("#"+TagName);
	if(Cur_Tag)
		Cur_Tag.html(valueStr);
	else
	{
		Cur_Tag =  $("."+TagName);
		if(Cur_Tag) 
			Cur_Tag.html(valueStr);
	}
}
/**
 * 根据指定的值设定选择项
 * @param TagName
 * @param value
 */
function SetSelected(TagName,value)
{
	var Cur_Tag = $("#"+TagName);
	if(!Cur_Tag)
		Cur_Tag =  $("."+TagName);
	if(Cur_Tag)
    {
		if(IsNullOrBlank(value))
			value = 0;
	    Cur_Tag.children("option").each(function(){
		    var temp_value = $(this).val(); 
	        var tem_text = $(this).text(); 
	        if(temp_value == value||tem_text==value){
	       //setTimeout解决selected在IE6中无法设置
//	         setTimeout(function(){
	        	$(this).prop("selected","selected");
//	         },1)
	            
	        }  
	    });  
    }
}
function SetRedioSelected(TagName,value)
{
	var Cur_Tag = document.getElementsByName(TagName); 
    if(Cur_Tag)
    {
		var len = Cur_Tag.length; 
		var i = 0; 
		for(; i < len; i++){ 
		    // 必须先赋值为false,再移除属性 
			Cur_Tag[i].checked = false; 
		   // 不移除属性也可以 
		   //checkedbrowser[i].removeAttribute("checked");
			if(Cur_Tag[i].value==value)
				Cur_Tag[i].checked = true;
		}
    }
}
function SetCheckBoxSelected(TagName,value_list)
{
	var Cur_Tag = document.getElementsByName(TagName); 
    if(Cur_Tag)
    {
		var len = Cur_Tag.length; 
		var i = 0; 
		for(; i < len; i++){ 
		    // 必须先赋值为false,再移除属性 
			Cur_Tag[i].checked = false; 
		    // 不移除属性也可以 
		    var value = Cur_Tag[i].value;
		    var index_flg = $.inArray(value,value_list);
		    if(index_flg>=0)
			//if(Cur_Tag[i].value==value)
				Cur_Tag[i].checked = true;
		}
    }
}
/**
 * 判断是否为字符串
 * @param str
 * @returns {Boolean}
 */
function isString(str){
	if(str)
	  return (typeof str=='string')&&str.constructor==String;
	else
	  return false;	
}
/**
 * 判断是否为数字
 * @param obj
 * @returns {Boolean}
 */
function isNumber(obj){
	if(obj)
	  return !isNaN(obj);
	  //(typeof obj=='number')&&obj.constructor==Number;
	else
	  return false;	
}
/**
 * 根据图片路径解析创建缩略图路径
 */
function CreateSubImageUrl(image_url)
{
	if(!IsNullOrBlank(image_url))
	{
		var indexCount = image_url.lastIndexOf(".");
		var befStr = image_url.substring(0,indexCount);
		var altStr = image_url.substring(indexCount+1,image_url.length);
		return befStr+"-m."+altStr;
	}
	return image_url;
}
//****************************************************************
// Description: sInputString为输入字符串，iType为类型
// 分别为0－去除前后空格；1－去前导空格；2－去尾部空格
//****************************************************************
function cTrim(sInputString,iType)
{
	if(isString(sInputString))
	{
		var sTmpStr = ' ';
		var i = -1;
		if(iType == 0 || iType == 1)
		{
		    while(sTmpStr == ' ')
		    {
		        ++i;
		        sTmpStr = sInputString.substr(i,1);
		    }
		    sInputString = sInputString.substring(i);
		}
		if(iType == 0 || iType == 2)
		{
		    sTmpStr = ' ';
		    i = sInputString.length;
		    while(sTmpStr == ' ')
		    {
		        --i;
		        sTmpStr = sInputString.substr(i,1);
		    }
		    sInputString = sInputString.substring(0,i+1);
		}
	}
    return sInputString;
}
/**
 * 信息提示
 * @param msgStr
 */
function ShowMessage(msgStr)
{
	//showAlert(msgStr);
	YIDA.notify(msgStr);
}
function ShowLayerMessage(msgStr,msgIndex)
{
	layui.use(['layer'], function(){
		var layer = layui.layer;
		layer.msg(msgStr, {icon: msgIndex});
	});
}
/**
 * 后台服务没反应后提示用户
 */
function Action_tag_ErrotFunction(curResult_obj)
{
    ShowMessage("后台服务异常！");
}
/**
 * 如果是json对象就直接返回，如果是字符串就转换为json对象返回，否则返回数据获取失败！
 * @param curDataObj
 * @returns
 */
function GetJSONObj(curDataObj)
{
	if(curDataObj)
	{
		 if(curDataObj.code)
			 return curDataObj;
		 else if(cTrim(curDataObj,0)!="")
			 return JSON.parse(curDataObj);
		 else
			 return {"code":"3","info":"数据获取失败！"};
	}
	else
		return {"code":"3","info":"操作失败！"};
}
/**
 * 服务器返回数据出错处理
 * @param temObj
 */
function Return_ErrotFunction(temObj)
{
	if(temObj)
		if(temObj.code)
		{
			if(temObj.code=="5")
			  {
				 //session失效或者未登录处理，提示用户重新登录
				 //layer.msg(temObj.info);
				 ShowMessage(temObj.info);
				 location.href= sessurl+"/login";
			  }
			  else
				  //其它操作失败，提示用户
				  //layer.msg(temObj.info);
				  ShowMessage(temObj.info);
		}
}
/**
 * 根据图片路径解析创建缩略图路径
 */
function CreateSubImageUrl(image_url)
{
	if(!IsNullOrBlank(image_url))
	{
		var indexCount = image_url.lastIndexOf(".");
		var befStr = image_url.substring(0,indexCount);
		var altStr = image_url.substring(indexCount+1,image_url.length);
		return befStr+"-m."+altStr;
	}
	return image_url;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//输入验证
/**
 * 返回类型 
 * 1 中国移动:134、135、136、137、138、139、150、151、152、157(TD)、158、159、182、183、184、187、188、147（数据卡）
 * 2 中国联通:130、131、132、152、155、156、185、186
 * 3 中国电信133、153、180、181、189
 * 0 无法识别
 **/       
function validatormobileimp(phoneno){ 
        var regex = /^(134|135|136|137|138|139|147|148|150|151|152|157|158|159|172|182|183|184|187|188|178|198)[0-9]{8}$/; 
        if(regex.test(phoneno)){ 
            //alert("中国移动！"); 
            return 1; 
        } 
        regex = /^(130|131|132|145|146|152|155|156|166|171|175|185|186|176|167)[0-9]{8}$/; 
        if(regex.test(phoneno)){ 
            //alert("中国联通！"); 
            return 2; 
        } 
        regex = /^(133|153|180|181|189|177|173|174|149|199|191)[0-9]{8}$/; 
        if(regex.test(phoneno)){ 
            //alert("中国电信！"); 
            return 3; 
        } 
        regex = /^(170|171)[0-9]{8}$/; 
        if(regex.test(phoneno)){ 
            //alert("虚拟运营商！"); 
            return 3; 
        } 
        return 0; 
}

/**
 * 验证普通座机电话号码是否正确
 * @param value
 */
function validatortelephone(value)
{
	var isPhone=/^((0\d{2,3})-)?(\d{7,8})(-(\d{3,}))?$/;
	return isPhone.test(value); 
}
/**
 * 验证车牌:验证说明
 *   ^[\u4e00-\u9fa5]{1}[A-Z]{1}[A-Z_0-9]{5}$
 *   ^[\u4e00-\u9fa5]{1}代表以汉字开头并且只有一个，这个汉字是车辆所在省的简称
 *   [A-Z]{1}代表A-Z的大写英文字母且只有一个，代表该车所在地的地市一级代码
 *   [A-Z_0-9]{5}代表后面五个数字是字母和数字的组合。
 *   ^[\u4e00-\u9fa5]{1}[a-zA-Z]{1}[a-zA-Z_0-9]{3}$如果是这种格式的话，英文字母大小写都可以。但是最好在后台进行转换
 * @param carplate
 */
function validatorcarplate(carplate)
{
	var re=/^[\u4e00-\u9fa5]{1}[A-Z]{1}[A-Z_0-9]{5}$/;
    if(carplate.search(re)==-1)
    {
        return false;
    }
    else
    	return true;
}
/**
 * 必须输入字母或数字验证
 * @param str
 * @returns
 */
function ischarornum(str){ 
	 var reg=/^(([a-z]+[0-9]+)|([0-9]+[a-z]+))[a-z0-9]*$/i; 
	 return reg.test(str); 
}
/**
 * 
 * 要求要字母（大小写不限）、数字、下划线组成的8-15位字符
 * @param value
 * @returns
 */
function curpassword(value)
{
	var reg=/^[0-9a-zA-Z_]{8,15}$/;
	return reg.test(value);
}

/**
 * 验证电子邮箱的格式是否正确
 * @param str
 */
function isEmail(value)
{
	var reg = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;  
	return reg.test(value);
}

/**
 * 身份证号码为15位或者18位，15位时全为数字，18位前17位为数字，最后一位是校验位，可能为数字或字符X
 * @param card
 * @returns
 */
function isCardNo(card)
{
	var reg = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;
	return reg.test(card);
}
/**
 * 身份证号码的验证规则
 */
function isIdCardNo(num) {  
    //if (isNaN(num)) {alert("输入的不是数字！"); return false;}   
    var len = num.length, re;  
    if (len == 15)  
        re = new RegExp(/^(\d{6})()?(\d{2})(\d{2})(\d{2})(\d{2})(\w)$/);  
    else if (len == 18)  
        re = new RegExp(/^(\d{6})()?(\d{4})(\d{2})(\d{2})(\d{3})(\w)$/);  
    else {  
        //alert("输入的数字位数不对。");   
        return false;  
    }  
    var a = num.match(re);  
    if (a != null) {  
        if (len == 15) {  
            var D = new Date("19" + a[3] + "/" + a[4] + "/" + a[5]);  
            var B = D.getYear() == a[3] && (D.getMonth() + 1) == a[4] && D.getDate() == a[5];  
        }  
        else {  
            var D = new Date(a[3] + "/" + a[4] + "/" + a[5]);  
            var B = D.getFullYear() == a[3] && (D.getMonth() + 1) == a[4] && D.getDate() == a[5];  
        }  
        if (!B) {  
            //alert("输入的身份证号 "+ a[0] +" 里出生日期不对。");   
            return false;  
        }  
    }  
    if (!re.test(num)) {  
        //alert("身份证最后一位只能是数字和字母。");  
        return false;  
    }  
    return true;  
}  
/**
 * 手机验证调用转换
 * @param value
 * @returns
 */
function validatormobile(value)
{
   return validatormobileimp(value)!=0?true:false;
}
////////以上是工具方法
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
/**
 * 组织提交地址
 */
function create_action_url(object,action)
{
	var urlStr = RootPath + "/admincp.php?ac="+object;
	if(!IsNullOrBlank(action))
		urlStr += "&op="+action;
	return urlStr;
}
function create_upload_url(action)
{
	var urlStr = RootPath + "/api.php?c=upload";
	if(!IsNullOrBlank(action))
		urlStr += "&a="+action;
	return urlStr;
}
/**
 * 组织提交地址
 */
function create_api_action_url(object,action,BasePath)
{
	var urlStr = BasePath + "/api.php?c="+object;
	if(!IsNullOrBlank(action))
		urlStr += "&a="+action;
	return urlStr;
}
/**
 * 根据分页信息创建分页导航条
 */
var ShowPageBur = function(curPage){
	var curAllCount = Number(curPage.totalCount);
	var curPageIndex = Number(curPage.pageNo);
    var curPageSize = Number(curPage.pageSize);
    var curPageAll = parseInt(curAllCount%curPageSize==0?curAllCount/curPageSize:curAllCount/curPageSize+1);
	var peforePage = curPageIndex - 1;
	var nextPage= curPageIndex + 1;
    if(peforePage<=0)
		peforePage = 1;
	if(nextPage>=curPageAll)
		nextPage = curPageAll;
	var str = "(总页数/当前页："+curPageAll+"/"+curPageIndex+")(总条数/每页条数："+curAllCount+"/"+curPageSize+")";
	ChangeTagText("Page_left_tag",str);
	str = "<li><a href=\"#\" onclick=\"ExecutePage("+peforePage+")\" title=\"上一页\">&laquo;</a></li>";
	var pageIndexCount = 0;
	var pageIndexStart = nextPage - 5;
	if(pageIndexStart<=0)pageIndexStart = 1;
	for(var i= pageIndexStart ;i <= curPageAll;i++)
    {
		if(i!=curPageIndex)
		    str += "<li><a href=\"#\" onclick=\"ExecutePage("+i+")\">"+i+"</a></li>";
		else
			str += "<li>"+i+"</li>";
		if(pageIndexCount>=5)
			break;
		pageIndexCount++;
	}
    str += "<li><a href=\"#\" onclick=\"ExecutePage("+nextPage+")\" title=\"下一页\">&raquo;</a></li>";
    //str += "<li><a href=\"#\" class=\"end\" onclick=\"ExecutePage("+curPageAll+")\"></a></li>";
    if(curAllCount==0)
    	showAlert("没有查到相关记录！");
    ChangeTagText("Page_right_tag",str);
};
/**
 * 数据唯一性检测成功后的回调函数
 * @param curResult_obj
 */
function CheckActionBack(curResult_obj)
{
	 var temObj = GetJSONObj(curResult_obj);
     if(temObj.code!="0")
    	 ShowMessage(temObj.info);
}
function page_init(curPageIndex,curPageSize,curAllCount)
{
	var curPageAll = parseInt(curAllCount%curPageSize==0?curAllCount/curPageSize:curAllCount/curPageSize+1);
	var SysUrlStr = create_action_url("page_init");
	var ParamData = 
    {
	   "totalCount":curAllCount
   	  ,"pageIndex":curPageIndex
   	  ,"pageSize":curPageSize
   	  ,"pageAll":curPageAll
    };
	//获取档案列表数据
	//DataInit_resultStr(SysUrlStr,ParamData,page_tag_init,Action_tag_ErrotFunction);
	DataInit(SysUrlStr,ParamData,page_tag_init,Action_tag_ErrotFunction);
}
function page_tag_init(DataObj)
{
	 var temObj = GetJSONObj(DataObj);
	 if(temObj.code=="0")
	 {
		 var dataStr = temObj.data;
	     ChangeTagText("NewPage_tag",dataStr); 
	 }
	  else 
		  //服务器返回出错处理
		  Return_ErrotFunction(temObj);
}
function select_tag_init(tagName,DataObj,firstName)
{
 	 var temObj = GetJSONObj(DataObj);
 	 if(temObj.code=="0")
 	 { 
 		 var dataHtmlStr = "";
 		 if(firstName)
 			dataHtmlStr = "<option value=\"all\">"+firstName+"</option>";
 		 else
 			dataHtmlStr = "<option value=\"0\">请选择</option>";
 		 var dataItems = temObj.data.dataItem;
 		 if(dataItems)
 			   if(dataItems.length)
 				 $.each(dataItems, function(i, itemObj) {
 					 if(itemObj)
 				     {
 						 if(itemObj.id && itemObj.name)
					     {
					    	 var id = GetValueOrTrim(itemObj.id);
							 var name = GetValueOrTrim(itemObj.name);
							 dataHtmlStr += '<option value="'+id+'">'+name+'</option>';
					     }
					     else
					     {	
	 						 var param_value = itemObj.param_value;
	 						 var param_name = itemObj.param_name;
	 						 dataHtmlStr +="<option value=\""+param_value+"\">"+param_name+"</option>";
					     }
 				     }
 				 });
 		 ChangeTagText(tagName,dataHtmlStr);
 	 }
 	 else 
 		 //服务器返回出错处理
 		 Return_ErrotFunction(temObj);
 }
function select_lay_init(tagName,dataList,firstName)
{
	 var dataHtmlStr = "";
	 if(firstName)
		 dataHtmlStr = "<option value=\"all\">"+firstName+"</option>";
	 else
		 dataHtmlStr = "<option value=\"0\">请选择</option>";
	 var dataItems = dataList;
	 if(dataItems)
	   if(dataItems.length)
		  $.each(dataItems, function(i, itemObj) {
			 if(itemObj)
				{
				    if(itemObj.id && itemObj.name)
				    {
				    	 var id = GetValueOrTrim(itemObj.id);
						 var name = GetValueOrTrim(itemObj.name);
						 dataHtmlStr += '<option value="'+id+'">'+name+'</option>';
				    }
				    else
				    {	
						var param_value = itemObj.param_value;
					    var param_name = itemObj.param_name;
					    dataHtmlStr +="<option value=\""+param_value+"\">"+param_name+"</option>";
				    }
				}
		  });
    ChangeTagText(tagName,dataHtmlStr);
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////
//面试流程轨迹页面
function process_tag_init(DataObj)
{
	 var temObj = GetJSONObj(DataObj);
	 if(temObj.code=="0")
	 { 
		 var dataHtmlStr = "";
		 var xh=1;
		 var length = 0;
		 var dataItems = temObj.data.dataItem;
		 if(dataItems)
			   if(dataItems.length)
			   {
				   length = dataItems.length;		
				 $.each(dataItems, function(i, itemObj) {
					 if(itemObj)
				     {
						 var id = GetValueOrTrim(itemObj.id);
						 var cl_time = GetValueOrTrim(itemObj.cl_time);
						 //var create_time = GetValueOrTrim(itemObj.create_time);
						 var uniqid = GetValueOrTrim(itemObj.uniqid);
						 var cur_state = GetValueOrTrim(itemObj.cur_state);
						 var do_type = GetValueOrTrim(itemObj.do_type);
						 var judge = GetValueOrTrim(itemObj.judge);
						 var dispose = GetValueOrTrim(itemObj.dispose);
						 var interview_num = GetValueOrTrim(itemObj.interview_num);
						 //var next_clr = GetValueOrTrim(itemObj.fix_uniqid);
						 var next_cltime = GetValueOrTrim(itemObj.fix_time);
						 
						 var cur_stateStr = "";
						 if(cur_state=="1")
							 cur_stateStr="信息录入";
						 else if(cur_state=="2")
							 cur_stateStr="电话邀约";
						 else if(cur_state=="3")
							 cur_stateStr="面试";
						 else if(cur_state=="4")
							 cur_stateStr="面试";
						 else if(cur_state=="5")
							 cur_stateStr="试讲";
						 else if(cur_state=="6")
							 cur_stateStr="过课";
						 else if(cur_state=="7")
							 cur_stateStr="培训";
						 else if(cur_state=="8")
							 cur_stateStr="训练营";
						 else if(cur_state=="9")
							 cur_stateStr="待参加训练营";
						 else if(cur_state=="10")
							 cur_stateStr="试岗";
						 else if(cur_state=="13")
							 cur_stateStr="入职";
						 else if(cur_state=="11")
							 cur_stateStr="淘汰";
						 else if(cur_state=="12")
							 cur_stateStr="储备";
						 else if(cur_state=="14")
							 cur_stateStr="转正";
						 else if(cur_state=="15")
							 cur_stateStr="离职";
						 else if(cur_state=="16")
							 cur_stateStr="转岗";
						 else if(cur_state=="17")
							 cur_stateStr="兼职";
						 else if(cur_state=="18")
							 cur_stateStr="电话未接";
						 else if(cur_state=="19")
							 cur_stateStr="待试岗";
						 else if(cur_state=="20")
							 cur_stateStr="导入";
						 else if(cur_state=="21")
							 cur_stateStr="黑名单";
	 
						 var do_typeStr = "";
						 if(do_type=="1")
							 do_typeStr="信息录入";
						 else if(do_type=="2")
							 do_typeStr="电话邀约";
						 else if(do_type=="3")
							 do_typeStr="面试";
						 else if(do_type=="4")
							 do_typeStr="面试";
						 else if(do_type=="5")
							 do_typeStr="试讲";
						 else if(do_type=="6")
							 do_typeStr="过课";
						 else if(do_type=="7")
							 do_typeStr="培训";
						 else if(do_type=="8")
							 do_typeStr="训练营";
						 else if(do_type=="9")
							 do_typeStr="待参加训练营";
						 else if(do_type=="10")
							 do_typeStr="试岗";
						 else if(do_type=="13")
							 do_typeStr="入职";
						 else if(do_type=="11")
							 do_typeStr="淘汰";
						 else if(do_type=="12")
							 do_typeStr="储备";
						 else if(do_type=="14")
							 do_typeStr="转正";
						 else if(do_type=="15")
							 do_typeStr="离职";
						 else if(do_type=="16")
							 do_typeStr="转岗";
						 else if(cur_state=="17")
							 cur_stateStr="兼职";
						 else if(cur_state=="18")
							 cur_stateStr="电话未接";
						 else if(cur_state=="19")
							 cur_stateStr="待试岗";
						 else if(cur_state=="20")
							 cur_stateStr="导入";
						 else if(cur_state=="21")
							 cur_stateStr="黑名单";
						 
						 dataHtmlStr += processList_item_init(xh,length,id,cl_time,uniqid,cur_stateStr,do_typeStr,judge,dispose,next_cltime,interview_num);
						 xh++;
				     }
				 });
			  }
		 ChangeTagText("process_tag",dataHtmlStr);
	 }
	  else 
		  //服务器返回出错处理
		  Return_ErrotFunction(temObj);
}
var index = 0; 
var processList_item_init=function(xh,length,id,cl_time,uniqid,cur_stateStr,do_typeStr,judge,dispose,next_cltime,interview_num){
	str ="<div class=\"interview_route\">";	
	str += "<div class=\"tc_h1\">";
	
	if(cur_stateStr == "面试" || cur_stateStr == "试讲" || cur_stateStr == "过课")
		str += "   <b>第" + interview_num + "轮" + cur_stateStr +"</b>"; 
	else
		str += "   <b>" + cur_stateStr +"</b>"; 
	
	str += "</div>";
	str += "<div class=\"content\" >";
	str += "    <div class=\"content_info\">";
	str += "        <span>处理人：</span>";
	str += "        <span>" + uniqid + "</span>";
	str += "        <span>处理时间：</span>";
	str += "        <span>" + cl_time + "</span>";
	str += "        <span>下一状态：</span>";
	str += "        <span>" + do_typeStr + "</span> "; 
	str += "    </div>";
	
	if(cur_stateStr == "信息录入")
	{
		str += "    <div class=\"content_info\">";
		str += "        <span>下一步处理时间：</span>";
		str += "        <span>" + next_cltime + "</span>";
		str += "    </div>";
	}
	else if(cur_stateStr != "入职")
	{
		str += "    <div class=\"content_info\">";
		str += "        <span>下一步处理时间：</span>";
		str += "        <span>" + next_cltime + "</span>";
		str += "    </div>";
		str += "    <div class=\"content_info\">";
		str += "        <span>评价信息：</span> "; 
		str += "        <span>" + judge + "</span> "; 
		str += "    </div>";
		str += "    <div class=\"content_info\">";
		str += "        <span>处理意见：</span> "; 
		str += "        <span>" + dispose + "</span> "; 
		str += "    </div>";
	}
	
	str += "</div>";
	str += "</div>";
	if(xh!=length)
	{
	str += "<div class=\"arrow_bottom\">";
	str += "<span>";
	str += "    <img src=\""+RootPath+"/template/rrt_admin/images/arrow_03.png\" />";
	str += "</span>";
	str += "</div>";
	}
	return str;
};
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/**
 * weight,体重，公斤
 * height，身高，米
 * 体重指数BMI=体重/身高的平方（国际单位kg/㎡）
 */
function getBMI(weight,height)
{
	var BMI = weight/(height*height);
	BMI = Math.round(BMI*100)/100;
	return BMI;
}

