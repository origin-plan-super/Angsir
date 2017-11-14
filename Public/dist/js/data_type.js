$(document).ready(function($) {
//弹出层组件___城市选择
//<div class="select_pop js_popcity"  maxSelectCount="10" SelectTxt="工作地区">1<i class="ico_select_pop"></i>
//    <input class="form-control w-450 js_pop_text" placeholder="" id="" type="text" value="" readonly/>
//    <input class="form-control w-450 js_pop_val js_validate" placeholder="" id="" name="city_id"  type="hidden"/>
//</div>

var popCityHtml=function(args){         
    var popCityHtml = [];
    popCityHtml.push('');
    popCityHtml.push('    <div class="sx-yx">');
    popCityHtml.push('        <span class="box_checked_txt">已选：</span>');
    popCityHtml.push('        <span class="js_popdata_box_checked">');
    popCityHtml.push('        </span>');
    popCityHtml.push('    </div>');
    popCityHtml.push('    <div class="sx-cnt">');
    popCityHtml.push('        <div class="sx-rm" >');
    popCityHtml.push('        </div>');
    popCityHtml.push('        <div class="sx-nomal">');
    popCityHtml.push('        </div>');                     
    popCityHtml.push('    </div>');
    return popCityHtml.join('');
}
var popCityTpl=popCityHtml();
new popFun().init({
    "eventEle":".js_popcity",
    "popStyle":"fade",
    "popDataId":"pop_city",
    "creatType":[1,{//creatType[0]==1 创建新的层
        "popSize":"large",
        "headTitle":"",
        "conMsg":[0,popCityTpl],//0:普通; 特殊提示： 1：正确，成功; 2:错误 ;3:警告;conMsg: 多行示例：<p>1多行示例：<br/>2多行示例：</p>
        "popAction":[{"actionTxt":"确认","actionId":"pop_comfirm"},{"actionTxt":"取  消","actionColse":true}]//按钮区
    }],
    "popCallbackFun":function(args,TfThis,eventEle){
        
        var returnText=$(".js_pop_text",eventEle);               
        var returnValue=$(".js_pop_val",eventEle);
        var maxSelectCount=$(eventEle).attr("maxSelectCount");
        var SelectTxt=$(eventEle).attr("SelectTxt");
        var extendTitle=$(eventEle).attr("extendTitle");
        extendTitle= extendTitle ? extendTitle : "";
        var headTitle="请选择"+SelectTxt+"（最多选择"+maxSelectCount+"个"+extendTitle+"）";
        $(".pop_head h3",$("#"+args.popDataId)).html(headTitle);
        var dataWidth=730;
        var column=5;
        var eleId="city";              
        creatPopData2({
            "dataArray":new_city_arr,
            "eleId":eleId,
            "column":column,
            "maxSelectCount":maxSelectCount,
            "attrName":"hot",
            "attrContainer":{"1":"#"+args.popDataId+" div.sx-rm","0":"#"+args.popDataId+" div.sx-nomal"},
            "returnText":returnText,
            "returnValue":returnValue,
            "popId":"#"+args.popDataId,
            "confirmBtn":"#pop_comfirm",
            "mainContainer":"#"+args.popDataId,
            "width":dataWidth
        });
        var liwidth= dataWidth/column-40;
        $(".sx-cnt li",$("#"+args.popDataId)).css({"width":liwidth});
        var selectedValues = returnValue.val().split(",");
        for(var i=0;i<selectedValues.length;i++){
        	$("#child_value_"+eleId+selectedValues[i],$("#"+args.popDataId)).trigger('click');
        }
        

    }
});
//弹出层组件___行业
//<div class="select_pop js_popindustry"  maxSelectCount="10" SelectTxt="行业">1<i class="ico_select_pop"></i>
//    <input class="form-control w-450 js_pop_text" placeholder="" id="" type="text" value="" readonly/>
//    <input class="form-control w-450 js_pop_val js_validate" placeholder="" id="" name="city_id"  type="hidden"/>
//</div>
var popIndustryHtml=function(args){         
   var popIndustryHtml = [];
   popIndustryHtml.push('');
   popIndustryHtml.push('<div class="sx-yx">');
   popIndustryHtml.push('    <span class="box_checked_txt">已选：</span>');
   popIndustryHtml.push('    <span  class="js_popdata_box_checked"></span>');
   popIndustryHtml.push('</div>');
   popIndustryHtml.push('<div class="sx-cnt" >');
   popIndustryHtml.push('        <div class="sx-nomal">');
   popIndustryHtml.push('        </div>');             
   popIndustryHtml.push('</div>');    
   return popIndustryHtml.join('');
}
var popIndustryTpl=popIndustryHtml();
new popFun().init({
    "eventEle":".js_popindustry",
    "popStyle":"fade",
    "popDataId":"pop_industry",
    "creatType":[1,{//creatType[0]==1 创建新的层
        "popSize":"large",
        "headTitle":"",
        "conMsg":[0,popIndustryTpl],//0:普通; 特殊提示： 1：正确，成功; 2:错误 ;3:警告;conMsg: 多行示例：<p>1多行示例：<br/>2多行示例：</p>
        "popAction":[{"actionTxt":"确认","actionId":"pop_comfirm"},{"actionTxt":"取  消","actionColse":true}]//按钮区
    }],
    "popCallbackFun":function(args,TfThis,eventEle){

        var returnText=$(".js_pop_text",eventEle);               
        var returnValue=$(".js_pop_val",eventEle);
        var maxSelectCount=$(eventEle).attr("maxSelectCount");
        var SelectTxt=$(eventEle).attr("SelectTxt");
        var extendTitle=$(eventEle).attr("extendTitle");
        extendTitle= extendTitle ? extendTitle : "";
        var headTitle="请选择"+SelectTxt+"（最多选择"+maxSelectCount+"个"+extendTitle+"）";
        $(".pop_head h3",$("#"+args.popDataId)).html(headTitle);
        var dataWidth=730;
        var column=3;
        var eleId="industry";
        creatPopData2({
            "dataArray":new_industry_arr,
            "eleId":eleId,
            "column":column,
            "maxSelectCount":maxSelectCount,
            "attrContainer":{"undefined":"#"+args.popDataId+" div.sx-nomal"},
            "returnText":returnText,
            "returnValue":returnValue,
            "popId":"#"+args.popDataId,
            "confirmBtn":"#pop_comfirm",
            "mainContainer":"#"+args.popDataId,
            "width":dataWidth
        });
        var liwidth= dataWidth/column-40;
        $(".sx-cnt li",$("#"+args.popDataId)).css({"width":liwidth});           
        var selectedValues = returnValue.val().split(",");
        for(var i=0;i<selectedValues.length;i++){
        	$("#child_value_"+eleId+selectedValues[i],$("#"+args.popDataId)).trigger('click');
        }
          

    }
});
//弹出层组件___岗位职能
//<div class="select_pop js_popjobduty"  maxSelectCount="10" SelectTxt="岗位职能">1<i class="ico_select_pop"></i>
//    <input class="form-control w-450 js_pop_text" placeholder="" id="" type="text" value="" readonly/>
//    <input class="form-control w-450 js_pop_val js_validate" placeholder="" id="" name="city_id"  type="hidden"/>
//</div>
var popJobdutyHtml=function(args){         
    var popJobdutyHtml = [];
    popJobdutyHtml.push('');
    popJobdutyHtml.push('<div class="sx-yx">');
    popJobdutyHtml.push('    <span class="box_checked_txt">已选：</span>');
    popJobdutyHtml.push('    <span  class="js_popdata_box_checked"></span>');
    popJobdutyHtml.push('</div>');
    popJobdutyHtml.push('<div class="sx-cnt" >');
    popJobdutyHtml.push('</div>');    
    return popJobdutyHtml.join('');
}
var popJobdutyTpl=popJobdutyHtml();
new popFun().init({
    "eventEle":".js_popjobduty",
    "popStyle":"fade",
    "popDataId":"pop_jobduty",
    "creatType":[1,{//creatType[0]==1 创建新的层
        "popSize":"large",
        "headTitle":"",
        "conMsg":[0,popJobdutyTpl],//0:普通; 特殊提示： 1：正确，成功; 2:错误 ;3:警告;conMsg: 多行示例：<p>1多行示例：<br/>2多行示例：</p>
        "popAction":[{"actionTxt":"确认","actionId":"pop_comfirm"},{"actionTxt":"取  消","actionColse":true}]//按钮区
    }],
    "popCallbackFun":function(args,TfThis,eventEle){
        
        var returnText=$(".js_pop_text",eventEle);               
        var returnValue=$(".js_pop_val",eventEle);
        var maxSelectCount=$(eventEle).attr("maxSelectCount");
        var SelectTxt=$(eventEle).attr("SelectTxt");
        var extendTitle=$(eventEle).attr("extendTitle");
        extendTitle= extendTitle ? extendTitle : "";
        var headTitle="请选择"+SelectTxt+"（最多选择"+maxSelectCount+"个"+extendTitle+"）";
        $(".pop_head h3",$("#"+args.popDataId)).html(headTitle);
        var dataWidth=730;
        var column=3;
        var eleId="duty";
        creatPopData3({
            "dataArray":new_jobduty_arr,
            "eleId":eleId,
            "column":column,
            "maxSelectCount":maxSelectCount,
            "returnText":returnText,
            "returnValue":returnValue,
            "popId":"#"+args.popDataId,
            "confirmBtn":"#pop_comfirm",
            "mainContainer":"#"+args.popDataId,
            "width":dataWidth
        }) 
        var liwidth= dataWidth/column-40;
        $(".sx-cnt li",$("#"+args.popDataId)).css({"width":liwidth});           
        var selectedValues = returnValue.val().split(",");
        for(var i=0;i<selectedValues.length;i++){
        	$("#child_value_"+eleId+selectedValues[i],$("#"+args.popDataId)).trigger('click');
        }

    }
});

});
//二级层次
var creatPopData2=function(args){
	var DataArr=args.dataArray;
	var columnCount = args.column;
	var eleId=args.eleId
	var attrContainer=args.attrContainer
	var attrName=args.attrName;
	var levelCount = {};
	for(var i=0;i<DataArr.length;i++){
		var node = DataArr[i];

        if(node.child.length>0){
            var container;
            var currentIdx = 0;
            container = $(attrContainer[node[attrName]]);
            currentIdx = levelCount[node[attrName]];
            if(currentIdx==null){
                currentIdx = 0;
            }
            levelCount[node[attrName]]=currentIdx+1;

            var workingNode= $(container).children("ul").last();
            if(currentIdx%columnCount==0){
                workingNode = $("<ul class=\"cf\" style=\"width: "+args.width+"px;display:inline-block\"></ul>");
                container.append(workingNode);
            }
            var liNode = $("<li class=\"parent_node\" id=\"li_"+eleId+"_"+node.id+"\">"+
                "<a href=\"javascript:;\" class=\"cls_value\" rel=\""+node.id+"\" id=\"p_child_value_"+eleId+node.id+"\">"+node.name+"</a>"+
                "</li>");
            var iNode = $("<i>");
            iNode.click(function(node){return function(event) {
                $("#p_child_value_"+eleId+node.id).trigger("click");
            }}(node));
            liNode.append(iNode);
            workingNode.append(liNode);
            var childWorkingNode = $("<div class=\"sx-sub sublist_node\" id=\"sublist_"+eleId+"_"+node.id+"\" style=\"display: none;\">"+
                "<ul class=\"cf\" style=\"width: "+args.width+"px;\"></ul></div>");
            for(var j=0;j<node.child.length;j++){
                var childNode = node.child[j];
                childWorkingNode.children("ul").append(
                    $("<li><label for=\"child_value_"+eleId+childNode.id+"\">"+
                        "<input type=\"checkbox\" name=\""+eleId+"\" class=\"cls_child\" id=\"child_value_"+eleId+childNode.id+"\" value=\""+childNode.id+"\" rel=\""+node.id+"\">"+childNode.name+"</label>"+
                        "</li>"));
            }
            childWorkingNode.append("<div class=\"clear\"></div>");
            container.append(childWorkingNode);            
        }

	}

	$("div.sx-cnt",$(args.mainContainer)).on("click","li.parent_node",function(event){
		var id = $("a",this).attr("rel");
		var target = $("#sublist_"+eleId+"_"+id);
		var targetShow = target.css("display")!="none";
		//$("div.sx-sub").hide();
		$("div.sx-sub").hide();
		$("li.parent_node",$(args.mainContainer)).removeClass('cur');

		if(!targetShow){
			$(this).addClass('cur');
			target.show();
			target.addClass('cur');
		}
	})
	
	$("div.sx-cnt",$(args.mainContainer)).on("click",'[type="checkbox"]',function(event){
        var val = $(this).prop('checked');
		var id = $(this).val();
		var name = $(this).closest('label').text();
		if(val&&$(".js_popdata_box_checked a",$(args.mainContainer)).length==args.maxSelectCount){
			$(this).prop("checked",false);
			alert("最多选择"+args.maxSelectCount+"个");
			return false;
		}else{
			if(val){
				$(".js_popdata_box_checked",$(args.mainContainer)).append($("<a href=\"javascript:;\" class=\"sx-yx-cnt\" id=\"checked_value_"+eleId+id+"\"> <span rel=\""+id+"\">"+name+"</span><i class=\"del cls_checked_del\" rel=\""+id+"\" id=\"checked_value_del_"+eleId+id+"\"></i></a>"))
			}else{
				$("#checked_value_del_"+eleId+id).trigger('click');
			}
		}
	})
	$(".js_popdata_box_checked",$(args.mainContainer)).on("click","i.del",function(event){
		var id = $(this).attr("rel");
		$("#checked_value_"+eleId+id).remove();
		$("#child_value_"+eleId+id).prop("checked",false);
	})
	$(args.confirmBtn).on('click', function(event) {
		var texts = [];
		var values = [];
		$(args.mainContainer).find("input:checked").each(function(index, el) {
			texts.push($(this).closest('label').text());
			values.push($(this).val());
		});
		$(args.returnText).val(texts.join(","));
		$(args.returnValue).val(values.join(","));
        //js_validate验证
		$(args.returnValue).trigger('blur');
        if($(args.returnValue).hasClass("error")){
            $(args.returnText).addClass("error");
        }else{
            $(args.returnText).removeClass("error");
        }
	});
}
//三级层次
var creatPopData3 = function(args){
	var dataArr=args.dataArray;
	var columnCount = args.column;
	var eleId=args.eleId;
	var attrContainer=args.attrContainer;
	for(var i=0;i<dataArr.length;i++){
		var typeNode = dataArr[i];
		var typeNodeContainer = $("<div class=\"sx-nomal\" id=\"type_node_"+eleId+"_"+typeNode.id+"\"></div>");
		typeNodeContainer.append("<div class=\"sx-h1\">"+typeNode.name+"</div>");
		var currentIdx = 0;
		for(var j=0;j<typeNode.child.length;j++){
			var node = typeNode.child[j];
            if(node.child.length>0){
    			var typeNodeContainer;
    			var workingNode= $(typeNodeContainer).children("ul").last();

    			if(currentIdx%columnCount==0){
    				workingNode = $("<ul class=\"cf\" style=\"width: "+args.width+"px;display:inline-block\"></ul>");
    				typeNodeContainer.append(workingNode);
    			}
    			currentIdx++;
    			var liNode = $("<li class=\"parent_node\" id=\"li_"+eleId+"_"+node.id+"\">"+
    				"<a href=\"javascript:;\" class=\"cls_value\" rel=\""+node.id+"\" id=\"p_child_value_"+eleId+node.id+"\">"+node.name+"</a>"+
    				"</li>");
    			var iNode = $("<i>");
    			iNode.click(function(node){return function(event) {
    				$("#p_child_value_"+eleId+node.id).trigger("click");
    			}}(node));
    			liNode.append(iNode);
    			workingNode.append(liNode);
    			var childWorkingNode = $("<div class=\"sx-sub sublist_node\" id=\"sublist_"+eleId+"_"+node.id+"\" style=\"display: none;\">"+
    				"<ul class=\"cf\" style=\"width: "+args.width+"px;\"></ul></div>");
    			for(var k=0;k<node.child.length;k++){
    				var childNode = node.child[k];
    				childWorkingNode.children("ul").append(
    					$("<li><label for=\"child_value_"+eleId+childNode.id+"\">"+
    						"<input type=\"checkbox\" name=\""+eleId+"\" class=\"cls_child\" id=\"child_value_"+eleId+childNode.id+"\" value=\""+childNode.id+"\" rel=\""+node.id+"\">"+childNode.name+"</label>"+
    						"</li>"));
    			}
    			childWorkingNode.append("<div class=\"clear\"></div>");
    			typeNodeContainer.append(childWorkingNode);
            }
		}
		$(".sx-cnt",$(args.mainContainer)).append(typeNodeContainer);
	}

	$(".sx-cnt",$(args.mainContainer)).on("click","li.parent_node",function(event){
		var id = $("a",this).attr("rel");
		var target = $("#sublist_"+eleId+"_"+id);
		var targetShow = target.css("display")!="none";
		$("div.sx-sub").hide();
		$("li.parent_node",$(args.mainContainer)).removeClass('cur');
		if(!targetShow){
			$(this).addClass('cur');
			target.show();
			target.addClass('cur');
		}
	})
	
	$("div.sx-cnt",$(args.mainContainer)).on("click",'[type="checkbox"]',function(event){
		var val = $(this).prop('checked');
		var id = $(this).val();
		var name = $(this).closest('label').text();
		if(val&&$(".js_popdata_box_checked a",$(args.mainContainer)).length==args.maxSelectCount){
			$(this).prop("checked",false);
			alert("最多选择"+args.maxSelectCount+"个");
			return false;
		}else{
			if(val){
				$(".js_popdata_box_checked",$(args.mainContainer)).append($("<a href=\"javascript:;\" class=\"sx-yx-cnt\" id=\"checked_value_"+eleId+id+"\"> <span rel=\""+id+"\">"+name+"</span><i class=\"del cls_checked_del\" rel=\""+id+"\" id=\"checked_value_del_"+eleId+id+"\"></i></a>"))
			}else{
				$("#checked_value_del_"+eleId+id).trigger('click');
			}
		}
	})
	$(".js_popdata_box_checked",$(args.mainContainer)).on("click","i.del",function(event){
		var id = $(this).attr("rel");
		$("#checked_value_"+eleId+id).remove();
		$("#child_value_"+eleId+id).prop("checked",false);
	})
	$(args.confirmBtn).on('click', function(event) {
		var texts = [];
		var values = [];
		$(args.mainContainer).find("input:checked").each(function(index, el) {
			texts.push($(this).closest('label').text());
			values.push($(this).val());
		});
		$(args.returnText).val(texts.join(","));
		$(args.returnValue).val(values.join(","));
        //js_validate验证
        $(args.returnValue).trigger('blur');
        if($(args.returnValue).hasClass("error")){
            $(args.returnText).addClass("error");
        }else{
            $(args.returnText).removeClass("error");
        }
	});
}