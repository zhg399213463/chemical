/**
 * 注册lay日期选择事件
 * @param tag_name
 * @param laydate
 */
function laydate_render(tag_name,laydate)
{
	laydate.render({ 
		  elem: '#'+tag_name
		  ,format: 'yyyy-MM-dd'
		});
}
/**
 * 注册lay时间选择事件
 * @param tag_name
 * @param laydate
 */
function laydatetime_render(tag_name,laydate)
{
	laydate.render({ 
		  elem: '#'+tag_name
		  ,type: 'datetime'
		  ,format:'yyyy-MM-dd HH:mm'
		});
}
/**
 * 注册lay时间选择事件
 * @param tag_name
 * @param laydate
 */
function laytime_render(tag_name,laydate)
{
	laydate.render({ 
		  elem: '#'+tag_name
		  ,type: 'time'
		  ,format:'HH:mm'
		});
}
/**
 * 注册lay月份选择事件
 * @param tag_name
 * @param laydate
 */
function laymonth_render(tag_name,laydate)
{
	laydate.render({ 
		  elem: '#'+tag_name
		  ,type: 'month'
		});
}
/**
 * 注册lay年选择事件
 * @param tag_name
 * @param laydate
 */
function layyear_render(tag_name,laydate)
{
	laydate.render({ 
		  elem: '#'+tag_name
		  ,type: 'year'
		});
}
/**
 * 关闭所有弹出框
 */
function layui_pop_close()
{
	layui.use('layer',function(){
		var layer = layui.layer;
		//关闭弹出框
    	layer.closeAll();
	});
}
/**
 * 关闭最后的弹出框
 */
function layui_pop_last_close()
{
	layui.use('layer',function(){
		var layer = layui.layer;
		//关闭弹出框
    	layer.close(layer.index);
	});
}
/**
 * 关闭最后的弹出框
 */
function layui_pop_cur_close(index)
{
	layui.use('layer',function(){
		var layer = layui.layer;
		//关闭特定弹出框
    	layer.close(index);
	});
}
/**
 * 根据身份证号计算生日
 * @param card_num
 * @returns {String}
 */
function exe_birthday_from_card(card_num)
{
	var birthday = "";  
    if(card_num != null && card_num != ""){  
        if(card_num.length == 15){  
            birthday = "19"+card_num.substr(6,6);  
        } else if(card_num.length == 18){  
            birthday = card_num.substr(6,8);
        }  
        birthday = birthday.replace(/(.{4})(.{2})/,"$1-$2-");  
    }  
    return birthday; 
}
/**
 * 根据身份证号计算性别
 * @param card_num
 * @returns {Number}
 */
function exe_sex_from_card(card_num)
{
	var sex = 1;
	var iIdNo = $.trim(card_num);
    if(iIdNo.length == 15)
    {
    	sex = parseInt(iIdNo.substring(14, 1),10) % 2 ? 1 : 2;
    }
    else
    {
    	sex = parseInt(iIdNo.substring(17, 1),10) % 2 ? 1 : 2;
    }
    return sex;
}
/**
 * 根据生日计算年龄
 * @param birthday
 * @returns
 */
function exe_age_from_birthday(birthday)
{
	var age="";
	var myDate = new Date();
    var cur_Date_time = myDate.getTime();
    var birthday_date = StringToDate(birthday);
    var birthday_time = birthday_date.getTime();
	var age = execute_data(cur_Date_time,birthday_time);
	return age;
}
function execute_data(start_date_str,end_date_str)
{
	if(!IsNullOrBlank(start_date_str)&&!IsNullOrBlank(end_date_str))
	{
		var end_date = Date.parse(new Date(end_date_str));
	    var value = Math.abs(parseInt((end_date - start_date_str)/1000/3600/24/360));
	    return value;
	}
	else
		return "";
}
/**
 * 根据职位类型异步获取职位名称列表
 * @param job_type_id
 */
function show_job_list(job_type_id)
{
	 var jsonText={"job_id":job_type_id};
	 var ParamData = {"device_type":"0","json_text":JSON.stringify(jsonText)};
	 var SysUrlStr = create_action_url("info_collect","select_job");
	 DataInit(SysUrlStr,ParamData,select_job_list,Action_tag_ErrotFunction);
}
function select_job_list(DataObj)
{
	 var temObj = GetJSONObj(DataObj);
	 if(temObj.code=="0")
	 {
		 var dataItems = temObj.data.dataItem;
		 select_tag_list("job_child_name",dataItems);
	 }
	  else 
		  //服务器返回出错处理
		  Return_lay_ErrotFunction(temObj);
};
/**
 * 根据区域id异步获取该区域下的校区列表
 * @param area_value
 */
function show_school_list(area_value)
{
	 var jsonText={"city_id":area_value};
	 var ParamData = {"device_type":"0","json_text":JSON.stringify(jsonText)};
	 var SysUrlStr = create_action_url("info_collect","select_city");
	 DataInit(SysUrlStr,ParamData,select_school_list,Action_tag_ErrotFunction);
}
function select_school_list(DataObj)
{
	 var temObj = GetJSONObj(DataObj);
	 if(temObj.code=="0")
	 {
		 var dataItems = temObj.data.dataItem;
		 select_tag_list("region_name",dataItems);
	 }
	  else 
		  //服务器返回出错处理
		  Return_lay_ErrotFunction(temObj);
};
/**
 * 根据校区id异步获取该校区下的部门列表
 * @param school_id
 */
function show_dept_list(school_id)
{
	 var jsonText={"region_id":school_id};
	 var ParamData = {"device_type":"0","json_text":JSON.stringify(jsonText)};
	 var SysUrlStr = create_action_url("info_collect","select_depart");
	 DataInit(SysUrlStr,ParamData,select_dept_list,Action_tag_ErrotFunction);
}
function select_dept_list(DataObj)
{
	 var temObj = GetJSONObj(DataObj);
	 if(temObj.code=="0")
	 {
		 var dataItems = temObj.data.dataItem;
		 select_tag_list("depart_name",dataItems);
	 }
	  else 
		  //服务器返回出错处理
		  Return_lay_ErrotFunction(temObj);
};
/**
 * 根据培训主题显示对应的培训地点
 */
function show_train_address(train_id)
{
	var jsonText = 
    {
   	   "train_id":train_id
    };
	var ParamData = {"device_type":"0","json_text":JSON.stringify(jsonText)};
	var SysUrlStr = create_action_url("info_collect","select_train");
    DataInit(SysUrlStr,ParamData,trainList_tag_init,Action_tag_ErrotFunction);
}
function trainList_tag_init(DataObj)
{
	 var temObj = GetJSONObj(DataObj);
	 if(temObj.code=="0")
	 { 
		 var dataItems = temObj.data.dataItem;
		 select_tag_list("train_address",dataItems);
	 }
	  else 
		  //服务器返回出错处理
		  Return_lay_ErrotFunction(temObj);
}
/**
 * 根据训练营主题显示训练营地点
 */
function show_teach_train_address(teach_train_id)
{
	var jsonText = 
    {
   	   "teach_train_id":teach_train_id
    };
	var ParamData = {"device_type":"0","json_text":JSON.stringify(jsonText)};
	var SysUrlStr = create_action_url("info_collect","select_teach_train");
    DataInit(SysUrlStr,ParamData,teach_trainList_tag_init,Action_tag_ErrotFunction);
}
function teach_trainList_tag_init(DataObj)
{
	 var temObj = GetJSONObj(DataObj);
	 if(temObj.code=="0")
	 { 
		 var dataItems = temObj.data.dataItem;
		 select_tag_list("teach_train_address",dataItems);
	 }
	  else 
		  //服务器返回出错处理
		  Return_lay_ErrotFunction(temObj);
}
/**
 * 初始化下拉框列表选项
 * @param tag_name
 * @param school_list
 */
function select_tag_list(tag_name,school_list)
{
	 var dataHtmlStr = "<option value='0'>请选择</option>";
	 var dataItems = school_list;
     var xh=1;
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
	 ChangeTagText(tag_name,dataHtmlStr);
	 layui_render();
}
/**
 * 重新加载页面
 */
function layui_render()
{
	layui.use(['form'], function(){
		var form = layui.form;
		form.render();
	});
}
/**
 * 显示轨迹信息
 * @param task_name
 * @param process_list
 * @param layer
 */
function open_process_form(task_name,process_list,layer)
{
	//关闭数据加载层
	layer.closeAll('loading');
	//更新轨迹标题
	ChangeTagText("process_title_tag","");
	var dataHtmlStr = "";
	var dataItems = process_list;
	if(dataItems)
		   if(dataItems.length)
			 $.each(dataItems, function(i, itemObj) {
				 if(itemObj)
			     { 
					 var id = GetValueOrTrim(itemObj.id);
					 var cl_time = GetValueOrTrim(itemObj.cl_time);
					 //var create_time = GetValueOrTrim(itemObj.create_time);
					 var uniqid = GetValueOrTrim(itemObj.uniqid);
					 var uniqname = GetValueOrTrim(itemObj.uniqname);  //姓名（账号）
					  
					 var cur_state = GetValueOrTrim(itemObj.cur_state);
					 var do_type = GetValueOrTrim(itemObj.do_type);
					 var judge = GetValueOrTrim(itemObj.judge);
					 var dispose = GetValueOrTrim(itemObj.dispose);
					 var interview_num = GetValueOrTrim(itemObj.interview_num);
					 //var next_clr = GetValueOrTrim(itemObj.fix_uniqid);
					 var next_cltime = GetValueOrTrim(itemObj.fix_time);
					 var new_ruzhi_time = GetValueOrTrim(itemObj.new_ruzhi_time);
					 
					 var isZG = GetValueOrTrim(itemObj.isZG);
					 var zg_date = "";
					 var before_jobName = "";
					 var after_jobName = "";
					 var ZG_num = "";
					 if(isZG == "2")   //转岗操作
					 {
						 zg_date = GetValueOrTrim(itemObj.zg_date);
						 before_jobName = GetValueOrTrim(itemObj.before_jobName);
						 after_jobName = GetValueOrTrim(itemObj.after_jobName);
						 ZG_num = GetValueOrTrim(itemObj.ZG_num);
					 }
					 
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
						 cur_stateStr="特训营";
					 else if(cur_state=="9")
						 cur_stateStr="待参加特训营";
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
					 else if(cur_state=="22")
						 cur_stateStr="面试未到";
					 else if(cur_state=="23")
						 cur_stateStr="试讲未到";
					 else if(cur_state=="24")
						 cur_stateStr="过课未到";
					 else if(cur_state=="25")
						 cur_stateStr="试岗未到";
					 else if(cur_state=="26")
						 cur_stateStr="培训待补课";
 
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
						 do_typeStr="特训营";
					 else if(do_type=="9")
						 do_typeStr="待参加特训营";
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
					 else if(do_type=="17")
						 do_typeStr="兼职";
					 else if(do_type=="18")
						 do_typeStr="电话未接";
					 else if(do_type=="19")
						 do_typeStr="待试岗";
					 else if(do_type=="20")
						 do_typeStr="导入";
					 else if(do_type=="21")
						 do_typeStr="黑名单";
					 else if(do_type=="22")
						 do_typeStr="面试未到";
					 else if(do_type=="23")
						 do_typeStr="试讲未到";
					 else if(do_type=="24")
						 do_typeStr="过课未到";
					 else if(do_type=="25")
						 do_typeStr="试岗未到";
					 else if(do_type=="26")
						 do_typeStr="培训待补课";
					 dataHtmlStr += processList_item_init(length,id,cl_time,uniqid,cur_stateStr,do_typeStr,judge,dispose,next_cltime,interview_num,before_jobName,after_jobName,zg_date,isZG,ZG_num,uniqname,new_ruzhi_time);
				}
		 });
	ChangeTagText("process_data_list_tag",dataHtmlStr);
	layer.open({
		  type: 1
		 ,title:task_name
		 ,area: ['600px', '750px']
		 ,content: $('#process_form_tag') //这里content是一个DOM，注意：最好该元素要存放在body最外层，否则可能被其它的相对元素所影响
		 ,btn: ['关闭']
	     ,btnAlign: 'c'		    
	});
}
var processList_item_init=function(length,id,cl_time,uniqid,cur_stateStr,do_typeStr,judge,dispose,next_cltime,interview_num,before_jobName,after_jobName,zg_date,isZG,ZG_num,uniqname,new_ruzhi_time)
{
	var title_str = "";	
	if(cur_stateStr == "面试" || cur_stateStr == "试讲" || cur_stateStr == "过课")
		title_str += "   <b>第" + interview_num + "轮" + cur_stateStr +"</b>"; 
	else
		title_str += "   <b>" + cur_stateStr +"</b>"; 
	
	//转岗轨迹
	if(isZG == "2")
	{
		title_str += "   <b>转岗信息</b>"; 		
		var dataHtmlStr ='<li class="layui-timeline-item">'
		    +'<i class="layui-icon layui-timeline-axis">&#xe63f;</i>'
		    +'<div class="layui-timeline-content layui-text">'
		    +' <h3 class="layui-timeline-title">'+title_str+"~~"+cl_time+'</h3>'
		    +' <p>'
		    +' <b>处理人：</b>'+uniqid
		    +'   <br><b>转岗前职位：</b>'+before_jobName
		    +'   <br><b>转岗后职位：</b>'+after_jobName
		    +'   <br><b>转岗日期：</b>'+zg_date;
	}
	else
	{		
		var dataHtmlStr ='<li class="layui-timeline-item">'
		    +'<i class="layui-icon layui-timeline-axis">&#xe63f;</i>'
		    +'<div class="layui-timeline-content layui-text">'
		    +' <h3 class="layui-timeline-title">'+title_str+"~~"+cl_time+'</h3>'
		    +' <p>'
		    +' <b>录入人：</b>'+uniqname
		    +' <br><b>面试人/处理人：</b>'+uniqid;
		
		if(do_typeStr == "入职")
		{
			if(!IsNullOrBlank(new_ruzhi_time))
				dataHtmlStr += '   <br><b>下一状态：</b>'+do_typeStr+'（入职时间：'+new_ruzhi_time+'）';	
			else
				dataHtmlStr += '   <br><b>下一状态：</b>'+do_typeStr;
		}
		else
		{
			dataHtmlStr += '   <br><b>下一状态：</b>'+do_typeStr;
		}
		
		//+'   <br><b>下一状态：</b>'+do_typeStr;
		
		if(cur_stateStr != "信息录入" && cur_stateStr != "入职")
		{
				dataHtmlStr +='   <br><b>下一步处理时间：</b>'+next_cltime
				    +'  <br><b>评价信息：</b>'+judge
				    +'  <br><b>处理意见：</b>'+dispose;
		}
	}
	
	
	dataHtmlStr += '</p>';
	dataHtmlStr +='</div>'
	    +' </li>';
	return dataHtmlStr;
};

/**
 * 弹出基本信息编辑框
 * @param layer
 */
function open_edit_form(layer,title)
{	
	layer.open({
		  type: 1
		 ,title:title
		 ,area: ['1100px', '650px']
		 ,content: $('#edit_form_tag') //这里content是一个DOM，注意：最好该元素要存放在body最外层，否则可能被其它的相对元素所影响
		 ,btn: ['提交', '取消']
	     ,btnAlign: 'c'
	     ,yes: function(index, layero){
	        //按钮【按钮一】的回调
	        $("#edit_save_tag").click();
	     }
	});
	layui_render();//重新加载页面
}
/**
 * 弹出基本信息编辑框
 * @param layer
 */
function open_show_form(layer,tagName,title)
{	
	layer.open({
		  type: 1
		 ,title:title
		 ,area: ['1100px', '650px']
		 ,content: $('#'+tagName) //这里content是一个DOM，注意：最好该元素要存放在body最外层，否则可能被其它的相对元素所影响
		 ,btn: ['关闭']
	     ,btnAlign: 'c'
	});
	layui_render();//重新加载页面
}
/**
 * 文件上传
 * @param layer
 * @param upload_url
 */
function open_upload_form(layer,upload_url)
{	
	layer.open({
		  type: 1
		 ,title:"文件上传"
		 ,area: ['550px', '600px']
		 ,content: $('#imp_form_tag') //这里content是一个DOM，注意：最好该元素要存放在body最外层，否则可能被其它的相对元素所影响
		 ,btn: ['取消']
	     ,btnAlign: 'c'
	});
}
function lay_upload_init(upload_url)
{	
	 layui.use(['upload','layer'], function(){
			var upload = layui.upload
			  ,layer = layui.layer;
			upload.render({
				 elem: '#upload_button_tag'
				 ,url: upload_url
				 ,before: function(obj){ //obj参数包含的信息，跟 choose回调完全一致，可参见上文。
					 layer.open({type: 3});//信息加载,上传loading
					 $("#ResultMessage_tag").html("");
				 }
				 ,done: function(res, index, upload){ //上传后的回调
					 layer.closeAll('loading'); //关闭loading
					 if(res.success) {  
		                var resultStr = $("#ResultMessage_tag").html();
		            	resultStr += res.message +"<br>";
		            	$("#ResultMessage_tag").html(resultStr);
		            	lay_table_reload();
		            }
		            else
		            {
		            	var resultStr = $("#ResultMessage_tag").html();
		            	resultStr += res.message +"<br>";
		            	$("#ResultMessage_tag").html(resultStr);
		            }
				 } 
				 ,error: function(index, upload){
					layer.closeAll('loading'); //关闭loading
				 }
				 ,accept: 'file' //允许上传的文件类型
				 ,exts:'xls|csv|xlsx'	 
				  //,size: 50 //最大允许上传的文件大小
				  //,……
			})
	 });
}

/**
 * 服务器返回数据出错处理
 * @param temObj
 */
function Return_lay_ErrotFunction(temObj)
{
	layui_loading_close();
	if(temObj)
		if(temObj.code)
		{
			ShowLayerMessage(temObj.info,5);
		}
}
/**
 * 后台服务没反应后提示用户
 */
function Action_lay_ErrotFunction(curResult_obj)
{
	layui_loading_close();
	ShowLayerMessage("后台服务异常！",5);
}
/**
 * 关闭所有数据加载层
 */
function layui_loading_close()
{
	layui.use('layer',function(){
		var layer = layui.layer;
		//关闭所有数据加载层
		layer.closeAll('loading');
	});
}
/**
 * 打开数据加载层
 */
function layui_loading_open()
{
	layui.use('layer',function(){
		var layer = layui.layer;
		//关闭所有数据加载层
		layer.open({type: 3});//信息加载,上传loading
	});
}
/**
 * 根据属性 id或者param_value 查找临时列表当中的对象
 * @param DataList
 * @param check_id
 * @returns
 */
function tem_find_list_id(DataList,check_id)
{
	var temObj = null;
	if(DataList)
		if(DataList.length)
		{
			$.each(DataList,function(i,itemObj){
				if(itemObj)
				{
					if(itemObj.id)
					{
						var id = itemObj.id;
						if(id==check_id)
					    {
							temObj = itemObj;
							return temObj;
						}
					}
					else if(itemObj.param_value)
					{
						var id = itemObj.param_value;
						if(id==check_id)
					    {
							temObj = itemObj;
							return temObj;
						}
					}
				}
			})
		}
	return temObj;
}
/**
 * 根据属性 xh 查找临时列表当中的对象
 * @param DataList
 * @param check_id
 * @returns
 */
function tem_find_list_xh(DataList,check_xh)
{
	var temObj = null;
	if(DataList)
		if(DataList.length)
		{
			$.each(DataList,function(i,itemObj){
				if(itemObj)
				{
					var xh = itemObj.xh;
					if(xh==check_xh)
				    {
						temObj = itemObj;
						return temObj;
					}
				}
			})
		}
	return temObj;
}
/**
 * 根据属性 id 更新或删除临时列表当中数据
 * @param DataList
 * @param check_xh
 * @param temObj
 * @returns
 */
function tem_del_update_list_id(DataList,check_id,temObj)
{
	var index = -1;
	if(DataList)
		if(DataList.length)
		{
			$.each(DataList,function(i,itemObj){
				if(itemObj)
				{
					var id = itemObj.id;
					if(id==check_id)
				    {
						index = i;
					}
				}
			})
		}
	if(index>=0)
    {
    	if(temObj)
    		DataList.splice(index,1,temObj);
    	else
    	    DataList.splice(index,1);
    }
	else
	{	
		//DataList.push(temObj);
		// 拼接函数(索引位置, 要删除元素的数量, 元素) 注意数组索引, [0,1,2..] 
		DataList.splice(0, 0, temObj); //插入数组第一位
	}	
    return DataList;
}
/**
 * 根据属性 xh 更新或删除临时列表当中数据
 * @param DataList
 * @param check_xh
 * @param temObj
 * @returns
 */
function tem_del_update_list_xh(DataList,check_xh,temObj)
{
	var index = -1;
	if(DataList)
		if(DataList.length)
		{
			$.each(DataList,function(i,itemObj){
				if(itemObj)
				{
					var xh = itemObj.xh;
					if(xh==check_xh)
				    {
						index = i;
					}
				}
			})
		}
	if(index>=0)
    {
    	if(temObj)
    		DataList.splice(index,1,temObj);
    	else
    	    DataList.splice(index,1);
    }
	else
	{	
		//DataList.push(temObj);
		// 拼接函数(索引位置, 要删除元素的数量, 元素) 注意数组索引, [0,1,2..] 
		DataList.splice(0, 0, temObj); //插入数组第一位
	}	
    return DataList;
}

/**
 * 显示教师补助的轨迹信息
 * @param task_name
 * @param teachBuZhu_process_list
 * @param layer
 */
function open_teachBuZhu_process_form(task_name,teachBuZhu_process_list,layer)
{
	//关闭数据加载层
	layer.closeAll('loading');
	//更新轨迹标题
	ChangeTagText("process_title_tag","");
	var dataHtmlStr = "";
	var dataItems = teachBuZhu_process_list;
	if(dataItems)
		   if(dataItems.length)
			 $.each(dataItems, function(i, itemObj) {
				 if(itemObj)
			     { 
					 var id = GetValueOrTrim(itemObj.id);
					 var cl_time = GetValueOrTrim(itemObj.cl_time);
					 var uniqid = GetValueOrTrim(itemObj.uniqid);
					 var user_name = GetValueOrTrim(itemObj.user_name);
					 var cur_state = GetValueOrTrim(itemObj.cur_state);
					 var next_state = GetValueOrTrim(itemObj.next_state);					 
					 var remark = GetValueOrTrim(itemObj.remark);  //审批意见
					 var create_time = GetValueOrTrim(itemObj.create_time);
					 var teacher_subsidy_id = GetValueOrTrim(itemObj.teacher_subsidy_id);				 					 
					 
					 var cur_stateStr = "";
					 if(cur_state=="1")
						 cur_stateStr="新建中";
					 else if(cur_state=="2")
						 cur_stateStr="教务审批";
					 else if(cur_state=="3")
						 cur_stateStr="教务驳回";
					 else if(cur_state=="4")
						 cur_stateStr="教务通过";
					 else if(cur_state=="5")
						 cur_stateStr="财务审批";
					 else if(cur_state=="6")
						 cur_stateStr="财务驳回";
					 else if(cur_state=="10")
						 cur_stateStr="财务通过";
					 else if(cur_state=="11")
						 cur_stateStr="教师中心主任审批";
					 else if(cur_state=="12")
						 cur_stateStr="教师中心主任驳回";
					 else if(cur_state=="13")
						 cur_stateStr="区域教师中心主管审批";
					 else if(cur_state=="14")
						 cur_stateStr="区域教师中心主管驳回";
					
					 var next_stateStr = "";
					 if(next_state=="1")
						 next_stateStr="新建中";
					 else if(next_state=="2")
						 next_stateStr="教务审批";
					 else if(next_state=="3")
						 next_stateStr="教务驳回";
					 else if(next_state=="4")
						 next_stateStr="教务通过";
					 else if(next_state=="5")
						 next_stateStr="财务审批";
					 else if(next_state=="6")
						 next_stateStr="财务驳回";
					 else if(next_state=="10")
						 next_stateStr="财务通过";
					 else if(next_state=="11")
						 next_stateStr="教师中心主任审批";
					 else if(next_state=="12")
						 next_stateStr="教师中心主任驳回";
					 else if(next_state=="13")
						 next_stateStr="区域教师中心主管审批";
					 else if(next_state=="14")
						 next_stateStr="区域教师中心主管驳回";
					 
					 dataHtmlStr += teachBuZhu_processList_item_init(length,id,cl_time,uniqid,cur_stateStr,next_stateStr,user_name,remark,create_time,teacher_subsidy_id);
				}
		 });
	ChangeTagText("process_data_list_tag",dataHtmlStr);
	layer.open({
		  type: 1
		 ,title:task_name
		 ,area: ['600px', '750px']
		 ,content: $('#process_form_tag') //这里content是一个DOM，注意：最好该元素要存放在body最外层，否则可能被其它的相对元素所影响
		 ,btn: ['关闭']
	     ,btnAlign: 'c'		    
	});
}
var teachBuZhu_processList_item_init=function(length,id,cl_time,uniqid,cur_stateStr,next_stateStr,user_name,remark,create_time,teacher_subsidy_id)
{
	var title_str = "";	
	title_str += "   <b>" + cur_stateStr +"</b>"; 
		
	var dataHtmlStr ='<li class="layui-timeline-item">'
		    +'<i class="layui-icon layui-timeline-axis">&#xe63f;</i>'
		    +'<div class="layui-timeline-content layui-text">'
		    +' <h3 class="layui-timeline-title">'+title_str+"~~"+cl_time+'</h3>'
		    +' <p>'
		    +' <b>处理人：</b>'+user_name+'（'+uniqid+'）'
		    //+'   <br>前一状态：'+title_str
		    +'   <br><b>下一状态：</b>'+next_stateStr
			+'  <br><b>审批意见：</b>'+remark;
	

	dataHtmlStr += '</p>';
	dataHtmlStr +='</div>'
	    +' </li>';
	return dataHtmlStr;
};

/**
 * 显示教师车补的轨迹信息
 * @param task_name
 * @param teachBuZhu_process_list
 * @param layer
 */
function open_carBuZhu_process_form(task_name,carBuZhu_process_list,layer)
{
	//关闭数据加载层
	layer.closeAll('loading');
	//更新轨迹标题
	ChangeTagText("process_title_tag","");
	var dataHtmlStr = "";
	var dataItems = carBuZhu_process_list;
	if(dataItems)
		   if(dataItems.length)
			 $.each(dataItems, function(i, itemObj) {
				 if(itemObj)
			     { 
					 var id = GetValueOrTrim(itemObj.id);
					 var cl_time = GetValueOrTrim(itemObj.cl_time);
					 var uniqid = GetValueOrTrim(itemObj.uniqid);
					 var user_name = GetValueOrTrim(itemObj.user_name);
					 var cur_state = GetValueOrTrim(itemObj.cur_state);
					 var next_state = GetValueOrTrim(itemObj.next_state);					 
					 var remark = GetValueOrTrim(itemObj.remark);  //审批意见
					 var create_time = GetValueOrTrim(itemObj.create_time);
					 var teacher_subsidy_id = GetValueOrTrim(itemObj.teacher_subsidy_id);				 					 
					 
					 var cur_stateStr = "";
					 if(cur_state=="1")
						 cur_stateStr="新建中";
					 else if(cur_state=="2")
						 cur_stateStr="派车组确认";
					 else if(cur_state=="3")
						 cur_stateStr="派车组驳回";
					 else if(cur_state=="4")
						 cur_stateStr="财务审批";
					 else if(cur_state=="5")
						 cur_stateStr="财务驳回";
					 else if(cur_state=="10")
						 cur_stateStr="财务通过";
					
					 var next_stateStr = "";
					 if(next_state=="1")
						 next_stateStr="新建中";
					 else if(next_state=="2")
						 next_stateStr="派车组确认";
					 else if(next_state=="3")
						 next_stateStr="派车组驳回";
					 else if(next_state=="4")
						 next_stateStr="财务审批";
					 else if(next_state=="5")
						 next_stateStr="财务驳回";
					 else if(next_state=="10")
						 next_stateStr="财务通过";
					 
					 dataHtmlStr += carBuZhu_processList_item_init(length,id,cl_time,uniqid,cur_stateStr,next_stateStr,user_name,remark,create_time,teacher_subsidy_id);
				}
		 });
	ChangeTagText("process_data_list_tag",dataHtmlStr);
	layer.open({
		  type: 1
		 ,title:task_name
		 ,area: ['600px', '750px']
		 ,content: $('#process_form_tag') //这里content是一个DOM，注意：最好该元素要存放在body最外层，否则可能被其它的相对元素所影响
		 ,btn: ['关闭']
	     ,btnAlign: 'c'		    
	});
}
var carBuZhu_processList_item_init=function(length,id,cl_time,uniqid,cur_stateStr,next_stateStr,user_name,remark,create_time,teacher_subsidy_id)
{
	var title_str = "";	
	title_str += "   <b>" + cur_stateStr +"</b>"; 
		
	var dataHtmlStr ='<li class="layui-timeline-item">'
		    +'<i class="layui-icon layui-timeline-axis">&#xe63f;</i>'
		    +'<div class="layui-timeline-content layui-text">'
		    +' <h3 class="layui-timeline-title">'+title_str+"~~"+cl_time+'</h3>'
		    +' <p>'
		    +' <b>处理人：</b>'+user_name+'（'+uniqid+'）'
		    //+'   <br>前一状态：'+title_str
		    +'   <br><b>下一状态：</b>'+next_stateStr
			+'  <br><b>审批意见：</b>'+remark;
	

	dataHtmlStr += '</p>';
	dataHtmlStr +='</div>'
	    +' </li>';
	return dataHtmlStr;
};

/**
 * 显示教师住宿补的轨迹信息
 * @param task_name
 * @param teachBuZhu_process_list
 * @param layer
 */
function open_liveBuZhu_process_form(task_name,carBuZhu_process_list,layer)
{
	//关闭数据加载层
	layer.closeAll('loading');
	//更新轨迹标题
	ChangeTagText("process_title_tag","");
	var dataHtmlStr = "";
	var dataItems = carBuZhu_process_list;
	if(dataItems)
		   if(dataItems.length)
			 $.each(dataItems, function(i, itemObj) {
				 if(itemObj)
			     { 
					 var id = GetValueOrTrim(itemObj.id);
					 var cl_time = GetValueOrTrim(itemObj.cl_time);
					 var uniqid = GetValueOrTrim(itemObj.uniqid);
					 var user_name = GetValueOrTrim(itemObj.user_name);
					 var cur_state = GetValueOrTrim(itemObj.cur_state);
					 var next_state = GetValueOrTrim(itemObj.next_state);					 
					 var remark = GetValueOrTrim(itemObj.remark);  //审批意见
					 var create_time = GetValueOrTrim(itemObj.create_time);
					 var teacher_subsidy_id = GetValueOrTrim(itemObj.teacher_subsidy_id);				 					 
					 
					 var cur_stateStr = "";
					 if(cur_state=="1")
						 cur_stateStr="新建中";
					 else if(cur_state=="2")
						 cur_stateStr="分校确认";
					 else if(cur_state=="3")
						 cur_stateStr="分校驳回";
					 else if(cur_state=="4")
						 cur_stateStr="教务审批";
					 else if(cur_state=="5")
						 cur_stateStr="教务驳回";
					 else if(cur_state=="6")
						 cur_stateStr="财务审批";
					 else if(cur_state=="7")
						 cur_stateStr="财务驳回";
					 else if(cur_state=="10")
						 cur_stateStr="财务通过";
					
					 var next_stateStr = "";
					 if(next_state=="1")
						 next_stateStr="新建中";
					 else if(next_state=="2")
						 next_stateStr="分校确认";
					 else if(next_state=="3")
						 next_stateStr="分校驳回";
					 else if(next_state=="4")
						 next_stateStr="教务审批";
					 else if(next_state=="5")
						 next_stateStr="教务驳回";
					 else if(next_state=="6")
						 next_stateStr="财务审批";
					 else if(next_state=="7")
						 next_stateStr="财务驳回";
					 else if(next_state=="10")
						 next_stateStr="财务通过";
					 
					 dataHtmlStr += liveBuZhu_processList_item_init(length,id,cl_time,uniqid,cur_stateStr,next_stateStr,user_name,remark,create_time,teacher_subsidy_id);
				}
		 });
	ChangeTagText("process_data_list_tag",dataHtmlStr);
	layer.open({
		  type: 1
		 ,title:task_name
		 ,area: ['600px', '750px']
		 ,content: $('#process_form_tag') //这里content是一个DOM，注意：最好该元素要存放在body最外层，否则可能被其它的相对元素所影响
		 ,btn: ['关闭']
	     ,btnAlign: 'c'		    
	});
}
var liveBuZhu_processList_item_init=function(length,id,cl_time,uniqid,cur_stateStr,next_stateStr,user_name,remark,create_time,teacher_subsidy_id)
{
	var title_str = "";	
	title_str += "   <b>" + cur_stateStr +"</b>"; 
		
	var dataHtmlStr ='<li class="layui-timeline-item">'
		    +'<i class="layui-icon layui-timeline-axis">&#xe63f;</i>'
		    +'<div class="layui-timeline-content layui-text">'
		    +' <h3 class="layui-timeline-title">'+title_str+"~~"+cl_time+'</h3>'
		    +' <p>'
		    +' <b>处理人：</b>'+user_name+'（'+uniqid+'）'
		    //+'   <br>前一状态：'+title_str
		    +'   <br><b>下一状态：</b>'+next_stateStr
			+'  <br><b>审批意见：</b>'+remark;
	

	dataHtmlStr += '</p>';
	dataHtmlStr +='</div>'
	    +' </li>';
	return dataHtmlStr;
};
/**
 * 弹出基本信息编辑框
 * @param layer
 */
function pop_edit_form(layer,sub_tag_id,title,width,height)
{	
	var width_str = width +"px";
	var height_str = height +"px";
	layer.open({
		  type: 1
		 ,title:title
		 ,area: [width_str, height_str]
		 ,content: $('#'+sub_tag_id+"_edit_form_tag") //这里content是一个DOM，注意：最好该元素要存放在body最外层，否则可能被其它的相对元素所影响
		 ,btn: ['提交', '取消']
	     ,btnAlign: 'c'
	     ,yes: function(index, layero){
	            //按钮【按钮一】的回调
	            $("#"+sub_tag_id+"_edit_save_tag").click();
	      }
	     ,btn2: function(index, layero){
		        //关闭所有弹出窗口
	    	 layui_pop_close();
		  }
	});
	ChangeTagText(sub_tag_id+"_edit_form_title_tag",title);
	layui_render();//重新加载页面
}
/**
 * 弹出基本信息编辑框
 * @param layer
 */
function open_pop_form(layer,tag_id,title,width,height)
{	
	var width_str = width +"px";
	var height_str = height +"px";
	var pop_index = layer.open({
		  type: 1
		 ,title:title
		 ,area: [width_str, height_str]
		 ,content: $('#'+tag_id+"_form_tag") //这里content是一个DOM，注意：最好该元素要存放在body最外层，否则可能被其它的相对元素所影响
		 ,btn: ['确认', '取消']
	     ,btnAlign: 'c'
	     ,yes: function(index, layero){
	    	 //按钮【按钮一】的回调
	         $("#"+tag_id+"_save_tag").click();
	      }
	     ,btn2: function(index, layero){
		     //关闭弹出窗口
	    	 layer.close(index);
		  }
	});
	ChangeTagText(tag_id+"_form_title_tag",title);
	layui_render();//重新加载页面
	return pop_index;
}