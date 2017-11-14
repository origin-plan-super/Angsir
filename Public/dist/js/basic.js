$(document).ready(function () {

	//登录		
	new popFun().init({
		"eventEle": "#js-login,.js-login",
		"popStyle": "fade",
		"popDataId": "js_popuplogin"
	});


	//登录检查
	//loginCheckFun();

	//登录 后显示下拉用户中心
	$(".js_navlogin").on("mouseover mouseout", function (event) {
		if (event.type == "mouseover") {
			$(this).addClass("open");
			//鼠标悬浮
		} else if (event.type == "mouseout") {
			//鼠标离开
			$(this).removeClass("open");
		}
	});
	/*目的:tab切换*/
	$(".js_navtab1 label").on('click', function (event) {
		var curParent = $(this).closest('.js_navtab1')
		$("label", curParent).removeClass("cur");
		$(this).addClass('cur');
	});
	/*trunlrFun 注册切换*/
	trunlrFun();

	//显示 隐藏切换，百叶窗切换
	shtoggle();
	//锚点定位动画
	scrollToFun();
	//a代理
	jsAagentfun();
	//selvalueFun
	selvalueFun();
	//下载文件
	//downloadFile();
	//btn_turn on off 切换
	btnTurnFun();

	placeholderFun();
	var bascstatic = "http://s2.wealinkcdn.com/";
	//AJAX 请求刚开始时执行
	/*	$(document).ajaxStart(function() {
			var poploadingtxt='<img src="'+bascstatic+'pc/images/default/landing.gif" width="160"  alt="">'
			popnormal({
				"popconMsg":poploadingtxt,//可选项
				"popId":"poploading"//弹出层id 默认为popnormal,（可自定义）
			});
		});
		$(document).ajaxSuccess(function() {
			$("#poploading").remove();		
		});	*/
	//更多筛选
	morefilterFun();
	//极简历展示
	fastResumeToggle();
	//极简历申请登录
	fastResumelogin();

	//页面初始化
	pageInit();
	$("body").resize(function () {
		pageInit();
	});

	//headerNavChange 导航切换
	headerNavChange()

	//form reset
	formReset();
	proxySelectFun();//js 调用 模拟Select
	//模拟 radio checkbox  样式  注意label 的for属性 与  radio checkbox  一一对应；
	proxyInput();
	//搜索关键字高亮红色字
	searchKwFun();
	//首页 company-name 高度设置
	iRecommendCompany();
	//职位申请页 js_position_bar 的悬浮定位
	positionBarsit();
	//偶数行加class even;
	evenClassFun();
	//弹出小提示
	popTips();
	//省略符
	ellipsisText();
});
//省略符
function ellipsisText() {
	$(".js_ellipsis").each(function (index, el) {
		var row = parseInt($(this).attr('ellipsis_row'));
		var eleH = $(this).height();
		var lineH = parseInt($(this).css("line-height"));
		var limtH = lineH * row;
		if (eleH > limtH) {
			$(this).addClass('text-ellipsis');
			$(this).css({ 'height': limtH + 'px', 'overflow': 'hidden' });
		}
	});
}
//form reset
function formReset() {
	$("form").on("reset", function () {
		$("input.form-control", $(this)).attr("value", "");
		$('select.form-control option', $(this)).removeAttr("selected");
	})
}
//搜索关键字高亮红色字
function searchKwFun() {
	if ($(".js_highlight").length > 0) {
		//var curlocation=decodeURIComponent(location.href,true);
		curlocation = location.href;
		var kwStart = curlocation.indexOf("kw=");
		if (kwStart != -1) {
			kwStart = kwStart + 3;
			var keyWord = curlocation.substring(kwStart);
			keyWord = keyWord.substring(0, keyWord.indexOf("&"));
			keyWord = keyWord.replace(/\+/g, ' ');
			keyWord = decodeURIComponent(keyWord, true);
			keyWord = keyWord.replace(/\s+$/g, '');
			keyWord = keyWord.replace(/^\s+/g, '');
			//console.log(keyWord);
			$(".js_highlight").each(function (index, el) {
				if ($(this).attr("highlight") != "false") {
					var highlightPId = $(this).attr("id");
					SearchHighlight(highlightPId, keyWord);
					$(this).attr("highlight", "false");
				}
			});
		}
	}
	//关键字高亮红色字
	function SearchHighlight(idVal, keyword) {
		var pucl = document.getElementById(idVal);
		if ("" == keyword) return;
		var temp = pucl.innerHTML;
		var htmlReg = new RegExp("\<.*?\>", "i");
		var arrA = new Array();
		//替换HTML标签 
		for (var i = 0; true; i++) {
			var m = htmlReg.exec(temp);
			if (m) {
				arrA[i] = m;
			} else {
				break;
			}
			temp = temp.replace(m, "{[(" + i + ")]}");
		}
		words = keyword.split(/\s+/);
		//console.log(words);
		//替换关键字 
		for (w = 0; w < words.length; w++) {
			var r = new RegExp("(" + words[w].replace(/[(){}.+*?^$|\\\[\]]/g, "\\$&") + ")", "ig");
			temp = temp.replace(r, "<span style='color:red;'>$1</span>");
		}
		//恢复HTML标签 
		for (var i = 0; i < arrA.length; i++) {
			temp = temp.replace("{[(" + i + ")]}", arrA[i]);
		}
		pucl.innerHTML = temp;
	}
}
var bascstatic = "http://s2.wealinkcdn.com/";
//弹出小提示
function popTips() {
	$(document).on('mouseover mouseout', '.js-tips', function (event) {
		var tipsText = $(this).attr("tipsText");
		var tipsEleH = $(this).height();
		var tipsT = $(this).offset().top;
		tipsT = tipsT - tipsEleH;
		var tipsL = $(this).offset().left;
		if (event.type == "mouseover") {
			//鼠标悬浮
			if ($(".js_popTips").length == 0) {
				$("body").append('<div class="js_popTips" style="left:' + tipsL + 'px; opacity:0;"><i></i>' + tipsText + '</div>');
				var popTipsH = $(".js_popTips").height();
				tipsT = tipsT - popTipsH - 5;
				$(".js_popTips").css({ "top": tipsT + "px", "opacity": 1 });
			}
		} else if (event.type == "mouseout") {
			console.log($(".js_popTips").length);
			//鼠标离开
			if ($(".js_popTips").length > 0) {
				$(".js_popTips").remove();
			}
		}
	});

}
//偶数行加class even;
function evenClassFun() {
	$(".evenParent").each(function (index, el) {
		var evenCell = $(this).attr("even_cell");
		$(evenCell + ':odd', $(this)).addClass('even');
	});
}
/*首页 company-name 高度设置*/
function iRecommendCompany() {
	$(".i-recommend-company .company-name").each(function (index, el) {
		var curH = $(this).height();
		if (curH > 48) {
			var lineH = 48 / (curH / 48);
			if (lineH < 18) {
				lineH = 18;
				$(this).css({ "padding": "0px", "height": "52px" });
			}
			$(this).css({ "line-height": lineH + "px" });
		}
	})
}
/*职位申请页 js_position_bar 的悬浮定位*/
function positionBarsit() {
	if ($(".js_position_bar").length > 0) {
		$(window).scroll(function (event) {
			var scrollTop = $(this).scrollTop(); //滚动条距离顶部的高度
			var stats = true;
			if (scrollTop > 86 && stats) {
				$(".js_position_bar .tbar3-bottom").slideUp(100, function () {
					var jsPositionBarH = $(".js_position_bar").height();
					if ($(".js_position_barH").length == 0) {
						$(".js_position_bar").after('<div class="js_position_barH" style="height:' + jsPositionBarH + 'px;"></div>');
					}
					$(".js_position_bar").css({ "position": "fixed", "top": "0px", "left": "0px" });
					stats = false;
				});
			} else {
				$(".js_position_bar .tbar3-bottom").slideDown(100, function () {
					$(".js_position_bar").css({ "position": "static", "top": "", "left": "" });
					$(".js_position_barH").remove();
					stats = true;
				});
			}
		});
	}
}
function headerNavChange() {
	var bascWealink = "http://www.wealink.com";
	var curlocation = location.href;
	if (curlocation == bascWealink + "/") {
		$('#header .nav li a[href="/"]').closest("li").addClass("cur");
	} else {
		$('#header .nav li a').each(function (index, el) {
			var curHref = $(this).attr("href");
			if (curlocation.indexOf(curHref) != -1) {
				$(this).closest("li").addClass('cur');
			} else {
				if (curlocation.indexOf("http://www.wealink.com/position/manage/online") != -1 || curlocation.indexOf("http://www.wealink.com/position/manage/offline") != -1 || curlocation.indexOf("http://www.wealink.com/position/manage/failure") != -1) {
					$('#header .nav li a[href="/apply/resume-manage"]').closest("li").addClass('cur');
				}
				if (curlocation.indexOf("http://www.wealink.com/apply/success") != -1 || curlocation.indexOf("http://www.wealink.com/apply/view") != -1 || curlocation.indexOf("http://www.wealink.com/apply/waitTalk") != -1 || curlocation.indexOf("http://www.wealink.com/apply/face") != -1 || curlocation.indexOf("http://www.wealink.com/apply/notFit") != -1 || curlocation.indexOf("http://www.wealink.com/collect/list") != -1) {
					$('#header .nav li a[href="/apply/all"]').closest("li").addClass('cur');
				}
			}
		});
		$('#header .nav li a[href="/"]').closest("li").removeClass("cur");
	}
}
//页面初始化
function pageInit() {
	var win = {
		W: $(window).width(),
		H: $(window).height()
	}
	var bodyWH = {
		W: $("body").width(),
		H: $("body").height()
	}
	var addH = 0;
	if ($("#js_footer").hasClass("footer-fixed")) {
		addH = $("#js_footer").height();
	}
	var bodyAddH = parseInt(bodyWH.H + addH);
	if (win.H > bodyAddH) {
		$("#js_footer").addClass('footer-fixed');
	} else {
		$("#js_footer").removeClass('footer-fixed');
	}

}
//a代理
var jsAagentfun = function () {
	$(".js_agent").each(function (index, el) {
		var agenttag = $(this).attr("agenttag");
		$("body").off('click', ".js_agent " + agenttag);
		$("body").on('click', ".js_agent " + agenttag, function (event) {
			if ($(event.target)[0].tagName != "A" && $(event.target)[0].tagName != "INPUT" && $(event.target)[0].tagName != "LABEL") {
				var agentUrl = $(this).attr("agenturl");
				var agentTarget = $(this).attr("agenttarget");
				if (agentUrl != "" && !agentUrl != undefined) {
					if (agentTarget == "_blank") {
						window.open(agentUrl);
					} else {
						location.href = agentUrl;
					}
				}
			}
		});
	});

}
//锚点定位动画
function scrollToFun(agrs) {
	$(".js_goto").click(function (event) {
		var gotodata = $(this).attr("gotodata");
		$("html,body").animate({ scrollTop: $(gotodata).offset().top }, 300);
	});
}

//登录验证
var loginCheckFun = function () {
	PublishFormCheck({
		"formId": "#login_form",
		"parentEleTagName": "li",
		"validateOption": {
			"username": {
				"requiredCheck": { "msg": "用户名不能为空" },
				"usernameCheck": { "msg": "用户名格式不正确" }
			},
			"password": {
				"requiredCheck": { "msg": "密码不能为空" }
			}
		}
	});
	$("#login_form input").on("focusin", function (event) {
		$("#login_error").remove();
	});

}
// 弹出层 
var popFun = function () {
	this.animateTime = 350;
	this.popDataId = null;
}
popFun.prototype = {
	init: function (args) {
		var TfThis = this;
		if (args.popDataId != undefined) {
			this.popDataId = args.popDataId;
		} else {
			this.popDataId = args.popId;
		}

		if (args.eventEle != undefined) {
			$(document).on('click', args.eventEle, ((function (TfThis) {
				return function (event) {
					event.preventDefault();
					args.eventEle = $(this);
					var curPop = null;
					if (args.creatType != undefined) {
						if (args.creatType[0] == 1) {
							$("body").append(TfThis.pops1(args));
							curPop = $("#" + TfThis.popDataId);
							//兼容  单数据源 对 1个模板1个位置						
							if (args.popTplId != undefined && args.data != undefined) {
								//兼容  单数据源 对 1个模板1个位置
								multipleTpl({
									"data": args.data,
									"sourcetpl": args.popTplId,//1个模板
									"insertsit": "#" + TfThis.popDataId + " .pops1_con",//1个位置
									"insertmethod": "html"
								});
							}
							TfThis.popStyleFun(args, curPop);
							if (args.popCallbackFun) {
								args.popCallbackFun(args, TfThis, $(this));
							}

						}
					} else {
						var curPop = null;
						if (TfThis.popDataId != undefined) {
							curPop = $("#" + TfThis.popDataId);
						} else {
							curPop = $($(this).attr("pop-data"));
						}
						if (curPop.length > 0) {
							TfThis.popStyleFun(args, curPop);
							if (args.popCallbackFun) {
								args.popCallbackFun(args, TfThis, $(this));
							}
						}
					}
				}
			})(this)));
		}
		if (args.showPop != undefined) {

			var curPop = null;
			switch (args.showPop) {
				case true:
					curPop = $("#" + this.popDataId);

					break;
				default:

					curPop = $(args.showPop);
			}

			if (args.creatType != undefined) {
				if (args.creatType[0] == 1) {
					$("body").append(TfThis.pops1(args));
					curPop = $("#" + this.popDataId);
					//兼容  单数据源 对 1个模板1个位置						
					if (args.popTplId != undefined && args.data != undefined) {
						//兼容  单数据源 对 1个模板1个位置
						multipleTpl({
							"data": args.data,
							"sourcetpl": args.popTplId,//1个模板
							"insertsit": "#" + this.popDataId + " .pops1_con",//1个位置
							"insertmethod": "html"
						});
					}
					TfThis.popStyleFun(args, curPop);
					if (args.popCallbackFun) {
						args.popCallbackFun(args, TfThis);
					}

				}
			} else {
				if (curPop.length > 0) {
					this.popStyleFun(args, curPop);
					if (args.popCallbackFun) {
						args.popCallbackFun(args, TfThis, $(this));
					}
				}

			}
		}
	},
	popStyleFun: function (args, curPop) {
		var animateTime = this.animateTime;
		var curPop = curPop;
		curPop.css({ "display": "block" });
		var popWH = {
			W: $(".pop", curPop).width(),
			H: $(".pop", curPop).height()
		}

		switch (args.popStyle) {
			case "zoom":
				$(".pop", curPop).css({ "opacity": 0, "left": "50%", "top": "50%", "width": "0px", "height": "0px" });
				$(".pop", curPop).addClass('over-hidden');
				$(".pop", curPop).animate({
					"opacity": 1,
					"width": popWH.W + "px",
					"height": popWH.H + "px",
					"margin": "-" + (popWH.H / 2) + "px 0 0 -" + (popWH.W / 2) + "px"
				}, animateTime, function () {

					/*close*/
					$(".close", curPop).on('click', function (event) {
						$(".pop", curPop).animate({
							"opacity": 0,
							"width": "0px",
							"height": "0px",
							"margin": "0px 0 0 0px"
						},
							animateTime, function () {
								if (args.creatType != undefined) {
									if (args.creatType[0] == 1) {
										curPop.remove();
									}
								} else {
									curPop.css({ "display": "none" });
									$(".pop", curPop).removeClass('over-hidden');
									$(".pop", curPop).css({ "opacity": 0, "left": "50%", "top": "50%", "width": popWH.W + "px", "height": popWH.H + "px" });
								}
							});

					});
					$(".pop_action a,.pop_action input", curPop).on('click', function (event) {
						var actionColse = $(this).attr("actionColse");

						switch (actionColse) {
							case "false":

								break;
							case "true":
								$(".close", curPop).trigger("click");
								break;
							default:
								$(".close", curPop).trigger("click");
						}
					});
				});

				break;
			case "fade":
				$(".pop", curPop).css({ "opacity": 0, "left": "50%", "top": "50%", "margin": "-" + (popWH.H / 2) + "px 0 0 -" + (popWH.W / 2) + "px" });
				$(".pop", curPop).animate({
					"opacity": 1
				}, animateTime, function () {
					$("body").addClass("popbody");
					/*close*/
					$(".close", curPop).on('click', function (event) {
						$(".pop", curPop).animate({
							"opacity": 0
						},
							0, function () {
								$("body").removeClass("popbody");
								if (args.creatType != undefined) {
									if (args.creatType[0] == 1) {
										curPop.remove();
									}
								} else {
									curPop.css({ "display": "none" });
								}
							});
					});
					if (args.creatType != undefined) {
						if (args.creatType[0] == 1) {
							if (args.creatType[1].conMsg[0] == 1) {
								setTimeout(function () {
									if (curPop.length > 0) {
										$(".close", curPop).trigger("click");
									}
								}, 3000);
							}
						}
					}
					$(".pop_action a,.pop_action input", curPop).on('click', function (event) {
						var actionColse = $(this).attr("actionColse");
						switch (actionColse) {
							case "false":
								break;
							case "true":
								$(".close", curPop).trigger("click");
								break;
							default:
								$(".close", curPop).trigger("click");
								;
						}
					});
				});
				break;
			default:
				$(".pop", curPop).css({ "opacity": 1, "left": "50%", "top": "50%", "margin": "-" + (popWH.H / 2) + "px 0 0 -" + (popWH.W / 2) + "px" });
				$(".pop", curPop).animate({
					"opacity": 1
				}, animateTime, function () {

				});
		}
	},
	pops1: function (args) {
		var curDomArgs = args.creatType[1];

		var pops1html = [];
		pops1html.push('');
		pops1html.push('<div id="' + this.popDataId + '" class="popUp"  >');
		pops1html.push('    <div id="gmask"></div>');
		if (curDomArgs.popSize != undefined) {
			pops1html.push('    <div class="pop ' + curDomArgs.popSize + ' pops1">');
		} else {
			pops1html.push('    <div class="pop mid pops1">');
		}
		if (curDomArgs.headTitle != undefined) {
			pops1html.push('        <span class="close"></span>');
		} else {
			pops1html.push('        <span class="close close2"></span>');
		}

		if (curDomArgs.headTitle != undefined) {
			pops1html.push('        <div class="pop_head">');
			if (curDomArgs.headRight != undefined) {
				pops1html.push('            <div class="poph_right">' + curDomArgs.headRight + '</div>');
			}
			pops1html.push('            <h3>' + curDomArgs.headTitle + '</h3>');
			if (curDomArgs.headRight != undefined) {
				pops1html.push('			<div class="sub">' + curDomArgs.headTitleSub + '</div>');
			}
			pops1html.push('        </div>');
		}
		pops1html.push('        <div class="pop_body">');
		pops1html.push('            <div class="pops1_con">');
		if (curDomArgs.conMsg != undefined) {
			switch (curDomArgs.conMsg[0]) {
				case 0:
					pops1html.push(curDomArgs.conMsg[1]);
					break;
				case 1:
					pops1html.push('                <div class="pop_tips_info_wrap"><div class="pop_tips_info"><i class="ico ico-tips-succ"></i>' + curDomArgs.conMsg[1] + '</div></div>');
					break;
				case 2:
					pops1html.push('                <div class="pop_tips_info_wrap"><div class="pop_tips_info" ><i class="ico ico-tips-error"></i>' + curDomArgs.conMsg[1] + '</div></div>');
					break;
				case 3:
					pops1html.push('                <div class="pop_tips_info_wrap"><div class="pop_tips_info"><i class="ico ico-tips-warning"></i>' + curDomArgs.conMsg[1] + '</div></div>');
					break;
			}
		}
		pops1html.push('            </div>');
		if (curDomArgs.popAction != undefined) {
			pops1html.push('            <div class="pop_action">');
			for (var i = 0; i < curDomArgs.popAction.length; i++) {
				var curAction = curDomArgs.popAction[i];
				pops1html.push('                <a  ');
				if (curAction.actionClass) {
					pops1html.push('class="' + curAction.actionClass + '"');
				} else {
					switch (i) {
						case 0:
							pops1html.push('class="btn btn-green2"');
							break;
						case 1:
							pops1html.push('class="btn btn-gray"');
							break;
						default:
							pops1html.push('class="btn btn-green2"');

					}
				}
				if (curAction.actionHref) {
					pops1html.push('href="' + curAction.actionHref + '"');
				} else {
					pops1html.push('href="javascript:;"');
				}
				if (curAction.actionId != undefined) {
					pops1html.push('id="' + curAction.actionId + '"');
				}
				if (curAction.actionColse != undefined) {
					pops1html.push('actionColse="' + curAction.actionColse + '"');
				}
				if (curAction.onclick != undefined) {
					pops1html.push('onclick="' + curAction.onclick + '"');
				}
				pops1html.push('>' + curAction.actionTxt + '</a>');
			}
			pops1html.push('            </div>');
		}
		pops1html.push('        </div>');
		pops1html.push('    </div> ');
		pops1html.push('</div>');
		return pops1html.join('');
	}

}
//普通弹出层
/*

<!-- 普通模板 start -->
<div id="normalbox" class="js_hidetpl_box">
    普通内容Tpl{{title}}

    <!-- 按钮区 a,input 标签 默认自带关闭该层功能 如果设置 actionColse="false" 则不关闭该层 start-->
    <div class="pop_action">
        <a href="javascript:;" class="btn btn-green2" actionColse="false" >提交</a>
        <a href="javascript:;" class="btn btn-gray"  >取消</a>
        <a class="link" href="javascript:;">修改信息</a>
    </div>
    <!-- 按钮区 end--> 
</div>
<!-- 普通模板 end -->
<a href="javascript:;"   class="js_popnormal">普通</a>
<script type="text/javascript">
var data1 = {title: "My New Posffsst", body: "This is my first post!"};
popnormal({
    "data":data1,//使用 handlebars 带数据的内容模板id  的 数据  //可选项
    "popTplId":"#normalbox",//内容模板id
    //"popconMsg":"popconMsg普通内容",//可选项
    "eventEle":".js_popnormal",//点击事件元素（不定义：立即弹出）
    "popId":"popnormal",//弹出层id 默认为popnormal,（可自定义）
    "headTitle":"普通标题",//普通标题
    "popSize":"",//控制大小样式 //可选项
	//"popAction":[{"actionTxt":"提  交","actionId":"js_report_submit","actionClass":"btn btn-info","actionColse":false},{"actionTxt":"取  消","actionColse":true},{"actionTxt":"修改信息"}],//按钮区
    "popCallbackFun":function(args,TfThis){//popCallbackFun 可选项
        //console.log(args);//层的相关参数
        //var curpopid = "#" + args.popId; 
        //$(curpopid+" .close").trigger('click');//关闭该层
        //$(curpopid+" .close").on('click', function(event) {
            //关闭层做的操作
        //});
    }

});
//$("#popnormal .close").trigger("click");//关闭层
//$("#popnormal .close").on('click', function(event) {
//    //关闭层做的操作
//});
</script>
*/
var popnormal = function (args) {
	var popTpl;

	if (args.popconMsg != undefined) {
		if (args.popAction) {
			popTpl = '<div class="pop_tips_msg">' + args.popconMsg + '</div>';
		} else {
			popTpl = '<div class="pop_tips_msg_noaction">' + args.popconMsg + '</div>';
		}
	}
	if (args.popTplId != undefined) {
		/*		if($(args.popTplId).attr("popformat")=="false"||$(args.popTplId)[0].tagName=="SCRIPT"){
					popTpl=$(args.popTplId).html();
				}else{
					if($(args.popTplId).find(".pop_normal_msg").length!=0){
						popTpl=$(args.popTplId).html();			
					}else{
						if($(args.popTplId).find(".pop_normal_msg").length==0){
							var conTpl="";
							switch($(args.popTplId+" .pop_action").length){
								case 0:						
									if(args.popAction){
										popTpl='<div class="pop_normal_tpl">'+$(args.popTplId).html()+'</div>';
									}else{
										popTpl='<div class="pop_normal_noaction_tpl">'+$(args.popTplId).html()+'</div>';
									}
								break;
								case 1:
									var popActionTpl=$(args.popTplId+" .pop_action").prop('outerHTML');
									$(args.popTplId+" .pop_action").remove();
									conTpl=	$(args.popTplId).html();				
									popTpl='<div class="pop_normal_tpl">'+conTpl+'</div>'+ popActionTpl;					
								break;
								default:
									popTpl=$(args.popTplId).html();
							}
							$(args.popTplId).html(popTpl);
						}			
		
					}
				}*/
		popTpl = $(args.popTplId).html();
		var data = args.data;
	}
	if (args.popconTpl != undefined) {
		popTpl = args.popconTpl;
	}
	var popDataId;
	if (args.popId == undefined) {
		popDataId = "popnormal";
	} else {
		popDataId = args.popId;
	}
	var popCallbackFun;
	if (args.popCallbackFun) {
		popCallbackFun = args.popCallbackFun;
	}
	var popAction;
	if (args.popAction) {
		popAction = args.popAction;
	}
	var popSize;
	if (args.popSize) {
		popSize = args.popSize;
	}
	if (args.eventEle == undefined) {
		new popFun().init({
			"popTplId": args.popTplId,
			"data": data,
			"popStyle": "fade",
			"popDataId": popDataId,
			"popId": popDataId,
			"creatType": [1, {
				"popSize": popSize,
				"headTitle": args.headTitle,
				"conMsg": [0, popTpl],
				"popAction": popAction
			}],
			"showPop": true,
			"popCallbackFun": popCallbackFun
		});
	} else {
		new popFun().init({
			"popTplId": args.popTplId,
			"data": data,
			"eventEle": args.eventEle,
			"popStyle": "fade",
			"popDataId": popDataId,
			"popId": popDataId,
			"creatType": [1, {
				"popSize": popSize,
				"headTitle": args.headTitle,
				"conMsg": [0, popTpl],
				"popAction": popAction
			}],
			"popCallbackFun": popCallbackFun
		});
	}

}
//弹出层成功
/*
<!-- 几秒后自动关闭该层 -->
<a href="javascript:;"   class="js_popsucc">成功</a>
<script type="text/javascript">
popsucc({
    "popconMsg":"成功",//成功Msg
    "eventEle":".js_popsucc",//点击事件元素（不定义：立即弹出）
    "popId":"popsucc",//弹出层id 默认为ppopsucc,（可自定义）
    "headTitle":"成功",//成功标题
	"popCallbackFun":function(args,TfThis){//popCallbackFun 可选项
        //console.log(args);//层的相关参数
        //var curpopid = "#" + args.popId; 
        //$(curpopid+" .close").trigger('click');//关闭该层
        //$(curpopid+" .close").on('click', function(event) {
        	//关闭层做的操作
        //});
	}
});
//$("#popsucc .close").trigger("click");//关闭层
//$("#popsucc .close").on('click', function(event) {
//    //关闭层做的操作
//});
</script>  
*/
var popsucc = function (args) {
	var popTpl = args.popconMsg;
	var popDataId;
	if (args.popId == undefined) {
		popDataId = "popsucc";
	} else {
		popDataId = args.popId;
	}
	var popCallbackFun;
	if (args.popCallbackFun) {
		popCallbackFun = args.popCallbackFun;
	}
	if (args.eventEle == undefined) {
		new popFun().init({
			"popStyle": "fade",
			"popDataId": popDataId,
			"popId": popDataId,
			"creatType": [1, {
				"headTitle": args.headTitle,
				"conMsg": [1, popTpl]
			}],
			"showPop": true,
			"popCallbackFun": popCallbackFun
		});
	} else {
		new popFun().init({
			"eventEle": args.eventEle,
			"popStyle": "fade",
			"popDataId": popDataId,
			"popId": popDataId,
			"creatType": [1, {
				"headTitle": args.headTitle,
				"conMsg": [1, popTpl]
			}],
			"popCallbackFun": popCallbackFun
		});
	}

}
//弹出层失败
/*
<!-- 点击确认按钮关闭该层 -->
<a href="javascript:;"   class="js_poperror">失败</a>
<script type="text/javascript">
poperror({
    "popconMsg":"失败",
    "eventEle":".js_poperror",//点击事件元素（不定义：立即弹出）                              
    "popId":"poperror",//弹出层id 默认为poperror,（可自定义）
    "headTitle":"失败",//失败标题
    "popCallbackFun":function(args,TfThis){//popCallbackFun 可选项
        //console.log(args);//层的相关参数
        //var curpopid = "#" + args.popId; 
        //$(curpopid+" .close").trigger('click');//关闭该层
        //$(curpopid+" .close").on('click', function(event) {
        	//关闭层做的操作
        //});
    }
});
//$("#poperror .close").trigger("click");//关闭层
//$("#poperror .close").on('click', function(event) {
//    //关闭层做的操作
//}); 
</script>       
*/
var poperror = function (args) {
	var popTpl = args.popconMsg;
	var popDataId;
	if (args.popId == undefined) {
		popDataId = "poperror";
	} else {
		popDataId = args.popId;
	}
	var popCallbackFun;
	if (args.popCallbackFun) {
		popCallbackFun = args.popCallbackFun;
	}
	var popSize;
	if (args.popSize) {
		popSize = args.popSize;
	}
	if (args.eventEle == undefined) {
		new popFun().init({
			"popStyle": "fade",
			"popDataId": popDataId,
			"popId": popDataId,
			"creatType": [1, {
				"popSize": popSize,
				"headTitle": args.headTitle,
				"conMsg": [2, popTpl],
				"popAction": [{ "actionTxt": "确  认" }]
			}],
			"showPop": true,
			"popCallbackFun": popCallbackFun
		});
	} else {
		new popFun().init({
			"eventEle": args.eventEle,
			"popStyle": "fade",
			"popDataId": popDataId,
			"popId": popDataId,
			"creatType": [1, {
				"popSize": popSize,
				"headTitle": args.headTitle,
				"conMsg": [2, popTpl],
				"popAction": [{ "actionTxt": "确  认" }]
			}],
			"popCallbackFun": popCallbackFun
		});
	}
}
// 弹出层 end


//左右切换
var trunlrFun = function () {
	var animtime = 300;
	var curTrunlrwrap = null;
	var tabcurcalss = null
	$('.js_trunlrwrap').each(function (index, el) {
		curTrunlrwrap = $(this);
		var trunlrpagecount = $(".js_trunlrpage", curTrunlrwrap).length;
		if (trunlrpagecount > 0) {
			var trunlrpagewidth = $(".js_trunlrconwrap", curTrunlrwrap).attr("trunlrpagewidth");
			var trunlrconwidth = trunlrpagewidth * trunlrpagecount;
			if ($("#register_mobile_form", curTrunlrwrap).length > 0) {
				curTrunlrwrap.css({ "overflow": "hidden", "width": trunlrpagewidth + "px" });
			} else {
				curTrunlrwrap.css({ "overflow": "hidden", "width": trunlrpagewidth + "px", "position": "relative" });
			}

			$(".js_conwrap", curTrunlrwrap).css({ "overflow": "hidden", "width": trunlrpagewidth + "px" });
			/*init*/
			tabcurcalss = $(".js_trunlrtabwrap", curTrunlrwrap).attr("tabcurcalss");
			curtabid = $(".js_trunlrtabwrap", curTrunlrwrap).attr("curtabid");
			$(".js_trunlrpage", curTrunlrwrap).css({ "float": "left", "width": trunlrpagewidth + "px", "overflow": "hidden" });
			$(".js_trunlrconwrap", curTrunlrwrap).css({ "width": trunlrconwidth });
			/*初始选中*/
			$(".js_trunlrtab", curTrunlrwrap).eq(curtabid).addClass(tabcurcalss);
			$(".js_trunlrconwrap", curTrunlrwrap).css({ "margin-left": "-" + (trunlrpagewidth * curtabid) + "px" });
		}
	});
	$(".js_trunlrtab").on('click', function (event) {
		if (!$(this).hasClass(tabcurcalss)) {
			curTrunlrwrap = $(this).closest('.js_trunlrwrap');
			tabcurcalss = $(".js_trunlrtabwrap", curTrunlrwrap).attr("tabcurcalss");
			$(".js_trunlrtab", curTrunlrwrap).removeClass(tabcurcalss);
			$(this).addClass(tabcurcalss);
			var trunlrpagewidth = $(".js_trunlrconwrap", curTrunlrwrap).attr("trunlrpagewidth");
			var trunlrpagecount = $(".js_trunlrpage", curTrunlrwrap).length;
			var trunlrconwidth = trunlrpagewidth * trunlrpagecount;
			curtabid = $(this).attr("tabid");
			$(".js_trunlrconwrap", curTrunlrwrap).animate({
				"margin-left": "-" + (trunlrpagewidth * curtabid) + "px"
			},
				animtime, function () {

				});
		}

	});
}
//倒数
function discount(i, fun) {
	var dis = i;
	function _discount() {
		fun(dis);
		if (dis > 0) {
			setTimeout(_discount, 1000);
		}
		dis--;
	}
	_discount();
}
//显示 隐藏切换，百叶窗切换
var shtoggle = function () {
	$(".js_toggle_btn").each(function (index, element) {
		$(this).on("click", function () {
			var toggledata = $(this).attr("toggle_data");
			$(toggledata).slideDown('slow', function () {
				$(".close", $(toggledata)).on("click", function () {
					$(toggledata).slideUp('slow', function () {
						// Animation complete.
					});
				});

			});

		});
	});
}
//显示 隐藏切换
var shChangeFun = function () {
	$("body").on('click', '[shChangEvent]', function (event) {
		var shChangEvent = $(this).attr("shChangEvent");
		var shChangeConobj = $(this).next('[shChangeCon="' + shChangEvent + '"]');
		if ($(this).attr("shChangParent") != undefined && $(this).attr("shChangParent") != "") {
			var shChangParent = $(this).attr("shChangParent");
			shChangParent = $(this).closest(shChangParent);
			shChangeConobj = $('[shChangeCon="' + shChangEvent + '"]', shChangParent);
		}
		var curojb = $(this);
		var shChangclass = $(this).attr("shChangclass");
		var shChangtxt = $(this).attr("shChangtxt");
		if (shChangtxt != undefined && shChangtxt != "") {
			shChangtxt = shChangtxt.split(",");
		}


		new shChange({
			"shChangEvent": shChangEvent,
			"shChangeConobj": shChangeConobj,
			"shChangclass": shChangclass,
			"shChangtxt": shChangtxt,
			"curojb": curojb
		});
	});
	function shChange(args) {
		var shChangEvent = args.shChangEvent;
		var shChangeConobj = args.shChangeConobj;
		var curojb = args.curojb;
		var shChangclass = args.shChangclass;
		var shChangtxt = args.shChangtxt;
		if (shChangeConobj.hasClass("hidden")) {
			shChangeConobj.removeClass('hidden');
			curojb.removeClass(shChangclass);
			if (shChangtxt != undefined && shChangtxt != "") {
				$(".shChangtxt", curojb).html(shChangtxt[1]);
			}
		} else {
			shChangeConobj.addClass('hidden');
			curojb.addClass(shChangclass);
			if (shChangtxt != undefined && shChangtxt != "") {
				$(".shChangtxt", curojb).html(shChangtxt[0]);
			}
		}
	}
}




//form 控件选中
//SELECT,radio:selectValue="2";
//checkbox: selectValue="2,3" 
/*selvalueFun({"parentEle":});*/
var selvalueFun = function (args) {
	var curparentEle = "";
	if (args != undefined) {
		curparentEle = args.parentEle;
	}
	$(curparentEle + " :input").each(function (index, el) {
		if ($(this).attr("selectValue") != undefined && $(this).attr("selectValue") != "") {
			var selectValue = $(this).attr("selectValue");
			var curOjbTagName = $(this)[0].tagName;
			if ($(this).closest('form').length == 1) {
				var curformEle = $(this).closest('form');
			}
			switch (curOjbTagName) {
				case "INPUT":
					var curOjbType = $(this).attr("type");
					switch (curOjbType) {
						case "checkbox":
							var checkboxName = $(this).attr("name");
							var selectedValueArray = selectValue.split(",");
							for (var i = 0; i < selectedValueArray.length; i++) {
								if (curformEle != undefined) {
									$("[name=" + checkboxName + "][value=" + selectedValueArray[i] + "]", $(curformEle)).prop("checked", true);
								} else {
									$(curparentEle + " [name=" + checkboxName + "][value=" + selectedValueArray[i] + "]").prop("checked", true);
								}
							}
							break;
						case "radio":
							var radioName = $(this).attr("name");
							if (curformEle != undefined) {
								$(curparentEle + " [name=" + radioName + "][value=" + selectValue + "]", $(curformEle)).prop("checked", true);
							} else {
								$(curparentEle + " [name=" + radioName + "][value=" + selectValue + "]").prop("checked", true);
							}
							break;
					}
					break;
				case "SELECT":
					$("option[value=" + selectValue + "]", $(this)).prop("selected", true);
					/*if($(this).attr("selectxt")!=undefined){
						$("option[value="+selectValue+"]",$(this)).attr("selected", true); //设置Select的Text值为jQuery的项选中 			
					}*/
					break;

			}
		}
	});
	$("body").off('change', ":input");
	$("body").on('change', ":input", function (event) {
		var curOjbTagName = $(this)[0].tagName;
		if ($(this).closest('form').length == 1) {
			var curformEle = $(this).closest('form');
		}
		switch (curOjbTagName) {
			case "INPUTss":
				var curOjbType = $(this).attr("type");
				switch (curOjbType) {
					//selectValue="2,3" 
					case "checkbox":
						var checkboxName = $(this).attr("name");
						var cursleval = [];
						if (curformEle != undefined) {
							var checkboxArray = $('[name=' + checkboxName + ']', $(curformEle));
						} else {
							var checkboxArray = $(curparentEle + " [name=" + checkboxName + "]");
						}
						if (typeof ($(checkboxArray[0]).attr("selectValue")) != "undefined") {
							if (curformEle != undefined) {
								var checkedArray = $('[name=' + checkboxName + ']:checked', $(curformEle));
							} else {
								var checkedArray = $(curparentEle + " [name=" + checkboxName + "]:checked");
							}
							//selectValue set;
							for (var i = 0; i < checkedArray.length; i++) {
								cursleval.push($(checkedArray[i]).val());
							}
							cursleval = cursleval.join(",");
							$(checkboxArray[0]).attr("selectValue", cursleval);
						}
						break;
					case "radio":
						var radioName = $(this).attr("name");
						var cursleval = [];
						if (curformEle != undefined) {
							var radioArray = $('[name=' + radioName + ']', $(curformEle));
						} else {
							var radioArray = $(curparentEle + " [name=" + radioName + "]");

						}
						if (typeof ($(radioArray[0]).attr("selectValue")) != "undefined") {
							if (curformEle != undefined) {
								var checkedArray = $('[name=' + radioName + ']:checked', $(curformEle));
							} else {
								var checkedArray = $(curparentEle + " [name=" + radioName + "]:checked");
							}
							//selectValue set;
							cursleval = $(checkedArray).val();
							$(radioArray[0]).attr("selectValue", cursleval);
						}
						break;
				}
				break;
			case "SELECT":
				if (typeof ($(this).attr("selectValue")) != "undefined") {
					$(this).attr("selectValue", $(this).val());

				}
				break;

		}
	});
}
/*selectValue
selectxt*/

//选择日期start
/*
doDate({"year":'birth_year',"mon":'birth_mon',"day":'birth_day',"parentEle":"parentEle"});
*/
function doDate(args) {
	var dateDoFun = function (args) {
		this.year = args.year;
		this.mon = args.mon;
		this.day = args.day;
		//默认值
		var yearsSel = this.year.attr('selectValue');
		var monthsSel = this.mon.attr('selectValue');
		var daysSel = this.day.attr('selectValue');
		///默认文字
		var yearsSelTxt = "年";
		if (this.year.attr('selectxt') != undefined) {
			yearsSelTxt = this.year.attr('selectxt');
		}
		var monthsSelTxt = "月";
		if (this.year.attr('selectxt') != undefined) {
			monthsSelTxt = this.year.attr('selectxt');
		}
		var daysSelTxt = "日";
		if (this.year.attr('selectxt') != undefined) {
			daysSelTxt = this.year.attr('selectxt');
		}
		var years = new Date().getFullYear();
		//增量
		var years_add = this.year.attr('add_date');
		var months_add = this.mon.attr('add_date');
		var days_add = this.day.attr('add_date');
		if (years_add != undefined) {
			var endYears = years + parseInt(years_add);
		} else {
			var endYears = years;
		}

		var years_start = this.year.attr('start_date');
		var months_start = this.mon.attr('start_date');
		var days_start = this.day.attr('start_date');
		if (years_start != undefined) {
			years_start = parseInt(years_start);
		} else {
			years_start = 70;
		}

		//var months=months+parseInt(months_add);
		//var days=days+parseInt(days_add);
		//this.createDate(years,parseInt(years)-100,yearsSel,this.year,yearsSelTxt);
		this.createDate(endYears, parseInt(years) - years_start, yearsSel, this.year, yearsSelTxt);
		this.createDate(1, 12, monthsSel, this.mon, monthsSelTxt);
		this.createDate(1, 31, daysSel, this.day, daysSelTxt);


		//change
		this.year.change((function (TfThis) {
			return function (event) {
				TfThis.selDate(TfThis.year, TfThis.mon, TfThis.day, daysSelTxt);
			}
		})(this));
		this.mon.change((function (TfThis) {
			return function (event) {
				TfThis.selDate(TfThis.year, TfThis.mon, TfThis.day, daysSelTxt);
			}
		})(this));
	}
	dateDoFun.prototype = {
		"createDate": function (valueStar, valueEnd, selValue, innerId, defaultName) {

			$(innerId).append('<option value="" selected="selected" >' + defaultName + '</option>');
			if (valueStar < valueEnd) {
				for (i = valueStar; i <= valueEnd; i++) {
					_t();
				}
			} else {
				for (i = valueStar; i >= valueEnd; i--) {
					_t();
				}
			}
			function _t() {
				if (i == selValue) {
					$(innerId).append('<option value="' + i + '" selected="selected" >' + i + '</option>');
				} else {
					$(innerId).append('<option value="' + i + '" >' + i + '</option>');
				}

			}
		},
		selDate: function (year, month, day, defaultName) {
			var y = parseInt($(year).val());
			var m = parseInt($(month).val());
			var d = $(day).val();
			$(day).html('');
			$(day).append('<option value="" selected="selected" >' + defaultName + '</option>');
			if (((y % 4 == 0) && (y % 100 != 0)) || (y % 400 == 0) && m == 2) {
				for (i = 1; i <= 29; i++) { $(day).append('<option value="' + i + '" >' + i + '</option>'); }
			} else {
				if (m == 2) {
					for (i = 1; i <= 28; i++) { $(day).append('<option value="' + i + '" >' + i + '</option>') }
				} else {
					if ((m < 8 && m % 2 == 0) || (m > 7 && m % 2 == 1)) {
						for (i = 1; i <= 30; i++) { $(day).append('<option value="' + i + '" >' + i + '</option>'); }
					} else {
						for (i = 1; i <= 31; i++) { $(day).append('<option value="' + i + '" >' + i + '</option>'); }
					}
				};
			}
		}
	}

	var datename = "datename";
	if ($('[datename=' + args.year + ']').length <= 0) {
		datename = "name";
	}

	var parentEle = "";
	if (args.parentEle != undefined) {
		parentEle = args.parentEle;
	}

	if ($('[' + datename + '=' + args.year + ']', $(parentEle)).length > 0) {
		var year = $('[' + datename + '=' + args.year + ']', $(parentEle));
		var mon = $('[' + datename + '=' + args.mon + ']', $(parentEle));
		var day = $('[' + datename + '=' + args.day + ']', $(parentEle));
		new dateDoFun({
			"year": year,
			"mon": mon,
			"day": day
		});
	}
}




//选择日期end

/*handlebars生成模板 start*/
/*
var data1 = {title: "My New Posffsst", body: "This is my first post!"};
var data2=[
{"title":"ccc1","body":"1","center":"center1","bottom":"bottom1"},
{"title":"ccc2","body":"21","center":"center2","bottom":"bottom2"},
{"title":"ccc3","body":"31","center":"center3","bottom":"bottom3"}
]
// 单数据源 对 1个模板1个位置
creathtmlTpl({
	"data":data1,//数据
	"sourcetpl":"#entry-template1",//模板
	"insertsit":"#temp1",//插入位置的元素
	"insertmethod":"append"//插入方式
})
//insertmethod：append[不定义默认append],before,after;
*/
var creathtmlTpl = function (args) {
	var source = $(args.sourcetpl).html();
	var template = Handlebars.compile(source);
	var data = args.data;

	if (data instanceof Array) {
		var html = "";
		for (var i = 0; i < data.length; i++) {
			var curhtml = template(data[i]);
			html = html + curhtml;
		}
	} else {
		var html = template(data);
	}
	var curInsertMethod;
	if (args.insertmethod != undefined) {
		curInsertMethod = args.insertmethod;
	} else {
		curInsertMethod = "append";
	}
	$(args.insertsit)[curInsertMethod](html);
}

/*
//单数据源 对多个模板，多个位置
multipleTpl({
	"data":data2,
	"sourcetpl":["#entry-template1","#entry-template2"],//多个模板
	"insertsit":["#temp2","#temp3"],//多个位置 与模板一样对应
	"insertmethod":["before","after"],//多个插入方式与模板一样对应
	//"insertmethod":"append",//都是一个插入方式	
	"CallbackFun":function(args){
		console.log("CallbackFun 1条数据对多个模板，多个位置");//回调函数
	}
});
//兼容  单数据源 对 1个模板1个位置
multipleTpl({
	"data":data1,
	"sourcetpl":"#entry-template1",//1个模板
	"insertsit":"#temp1",//1个位置
	"insertmethod":"append",//1个插入方式
	"CallbackFun":function(args){
		console.log("CallbackFun:兼容  1条数据对 1个模板1个位置");//回调函数
	}
});
//insertmethod：append[不定义默认append],before,after;
*/
var multipleTpl = function (args) {

	if (args.sourcetpl instanceof Array) {
		for (var i = 0; i < args.sourcetpl.length; i++) {
			var curInsertMethod = "";
			if (args.insertmethod != undefined) {
				if (args.insertmethod instanceof Array) {
					curInsertMethod = args.insertmethod[i];
				} else {
					curInsertMethod = args.insertmethod;
				}
			} else {
				curInsertMethod = "append";
			}
			creathtmlTpl({
				"data": args.data,
				"sourcetpl": args.sourcetpl[i],
				"insertsit": args.insertsit[i],
				"insertmethod": curInsertMethod
			})

		}
	} else {
		var curInsertMethod = "";
		if (args.insertmethod != undefined) {
			curInsertMethod = args.insertmethod;
		} else {
			curInsertMethod = "append";
		}
		creathtmlTpl({
			"data": args.data,
			"sourcetpl": args.sourcetpl,
			"insertsit": args.insertsit,
			"insertmethod": curInsertMethod
		})
	}
	if (args.CallbackFun) {
		args.CallbackFun(args);
	}
}
/*handlebars生成模板 end*/
//serialize字符串转json
var strToObj = function (str) {
	str = str.replace(/&/g, "','");
	str = str.replace(/=/g, "':'");
	str = "({'" + str + "'})";
	obj = eval(str);
	return obj;
}

//下载文件组件
/*
	fileurl：请求的下载地址 
	<a href="javascript:;" class="js_downloadfile"  downLock="false" fileurl="ajax/ftpimg_ajaxsave_succ.html">下载文件</a>
*/
var downloadFile = function () {
	$("body").on('click', '.js_downloadfile', function (event) {
		event.preventDefault();
		/* Act on the event */
		var fileurl = $(this).attr("fileurl");
		var curojb = $(this);

		if (fileurl != undefined && fileurl != "") {
			if ($(this).attr("downLock") == "false") {
				new downloadFun({
					"fileurl": fileurl,
					"curojb": curojb
				});
			} else {
				alert("再次下载请稍后");
			}
		} else {
			alert("该文件无法下载");
		}


	});
	var downloadFun = function (args) {
		var fileurl = args.fileurl;
		var curojb = args.curojb;
		$.ajax({
			url: fileurl,
			type: 'POST',
			data: "",
			dataType: 'json',
			success: function (data) {
				if (data.status == 1) {
					$(curojb).attr("downLock", "true");
					var curojbTxt = $(curojb).html();
					discount(60, function (i) {
						$(curojb).html("再次下载请稍后（" + i + "）");
						if (i == 0) {
							$(curojb).attr("downLock", "false");
							$(curojb).html(curojbTxt);
						}
					});
					window.open(data.url);
				}
			}
		});
	}
}
//btn_turn on off 切换
var btnTurnFun = function () {
	var animTime = 200;
	var turnFun = function (args) {
		this.curojb = args.curojb;
		this.changeClass = args.changeClass;
		if (this.curojb.hasClass(this.changeClass)) {
			this.curojb.removeClass(this.changeClass);
			var left = $("i", this.curojb).width();
			$("i", this.curojb).animate({
				"left": left + "px"
			},
				animTime, function () {
					/* stuff to do after animation is complete */
				});

		} else {
			this.curojb.addClass(this.changeClass);
			$("i", this.curojb).animate({
				"left": 0 + "px"
			},
				animTime, function () {
					/* stuff to do after animation is complete */
				});
		}

	}
	$("body").on('click', '.js_btnturn', function (event) {
		var curojb = $(this);
		var changeClass = $(this).attr("changeClass");
		//调用
		new turnFun({
			"curojb": curojb,
			"changeClass": changeClass
		});

	});
	$(".js_btnturn").each(function (index, el) {
		var curojb = $(this);
		var changeClass = $(this).attr("changeClass");
		var left = $("i", curojb).width();
		if (curojb.hasClass(changeClass)) {
			$("i", curojb).css({ "left": "0px" });
		} else {
			$("i", curojb).css({ "left": left + "px" });
		}
	});
}
/*兼容placeholder*/
function placeholderFun() {
	//判断浏览器是否支持placeholder属性
	var supportPlaceholder = 'placeholder' in document.createElement('input');
	if (!supportPlaceholder) {
		$('[placeholder]').focus(function () {
			var input = $(this);
			if (input.val() == input.attr('placeholder')) {
				input.val('');
				input.removeClass('placeholder');
			}
		}).blur(function () {
			var input = $(this);
			if (input.val() == '' || input.val() == input.attr('placeholder')) {
				input.addClass('placeholder');
				input.val(input.attr('placeholder'));
			}
		});
		$('[placeholder]').each(function (index, el) {
			var input = $(this);
			if (input.val() == '' || input.val() == input.attr('placeholder')) {
				input.addClass('placeholder');
				input.val(input.attr('placeholder'));
			}
		});
		$('[placeholder]').parents('form').submit(function () {
			$(this).find('[placeholder]').each(function () {
				var input = $(this);
				if (input.val() == input.attr('placeholder')) {
					input.val('');
				}
			})
		});
	}

}

/*ajax 搜索提示*/
function ajaxSearchFun(args) {
	var curEventEle = null;
	$(args.eventEle).on("keyup", function (event) {
		curEventEle = $(this);
		if (!$(this).data("oldval")) {
			$(this).data("oldval", "");
		}
		if ($(this).val() != $(this).data("oldval")) {
			$(this).data("oldval", $(this).val());
			clearTimeout($(this).data("timeoutkey"));
			var timeoutKey = setTimeout(function (t) {
				return function () {
					$.ajax({
						url: args.promptUrl,
						type: "GET",
						dataType: "json",
						data: { "kw": $(t).val() },
						success: function (data) {
							if (data.data != undefined && data.data.length > 0) {
								var searchResultDiv = $("#searchResultDiv");
								searchResultDiv.css({
									left: $(t).offset().left + "px",
									top: ($(t).offset().top + $(t).outerHeight()) + "px",
									width: parseInt($(t).outerWidth() - 2) + "px"
								})
								searchResultDiv.show();
								searchResultDiv.html("");
								//数据
								var curdata = data.data;
								for (var i = 0; i < curdata.length; i++) {
									searchResultDiv.append($("<div class='searchResultItem' onclick=\"javascript:_gaq.push(['_trackEvent', 'index', 'search_result'])\">" + curdata[i] + "</div>"));
								}
								searchResultDiv.data("linksearch", $(t));
							}
						}
					})
				}
			}(this), 10);
			$(this).data("timeoutkey", timeoutKey);
		} else {

			var d = 0;
			switch (event.which) {
				case 38:
					d--;
					var currentIdx = 0;
					break;
				case 40:
					d++;
					var currentIdx = -1;
					break;
				case 13:
					clearTimeout($(this).data("timeoutkey"));
					$("#searchResultDiv").data("linksearch", $(this));
					searchSelect();
					return true;
			}

			var all = 0;
			$("#searchResultDiv").find(".searchResultItem").each(function (idx, ele) {
				if ($(ele).hasClass("cur")) {
					currentIdx = idx;
					$(ele).removeClass("cur");
				}
				all++;
			});
			if (all != 0) {
				currentIdx += d;
				currentIdx %= all;
			}
			if (d != 0) {
				$("#searchResultDiv .searchResultItem:eq(" + currentIdx + ")").addClass('cur');
			}


		}
	})
	$(args.eventEle).on("blur", function (event) {
		clearTimeout($(this).data("timeoutkey"));
		if ($(this).data("cancelblur") != "true") {
			$("#searchResultDiv").hide();
			$("#searchResultDiv").data("linksearch", null);
		}
	})
	$("<div id='searchResultDiv' style='position:absolute;border:1px solid #f0f1f6;display:none'></div>").appendTo("body");
	$("#searchResultDiv").on("mouseover", ".searchResultItem", function () {
		//$(this).closest("#searchResultDiv").find(".searchResultItem").removeClass('cur');
		//$(this).addClass('cur');
		$("#searchResultDiv").data("linksearch").data("cancelblur", "true");
	});
	$("#searchResultDiv").on("mouseout", ".searchResultItem", function () {
		var linkSearch = $("#searchResultDiv").data("linksearch");
		if (linkSearch != null) {
			$("#searchResultDiv").data("linksearch").data("cancelblur", "false");
		}
	})
	$("#searchResultDiv").on("click", ".searchResultItem", function () {
		$(this).closest("#searchResultDiv").find(".searchResultItem").removeClass('cur');
		$(this).addClass('cur');
		searchSelect();
	});
	function searchSelect() {
		var linkSearch = $("#searchResultDiv").data("linksearch");
		if (linkSearch != null) {
			linkSearch.data("cancelblur", "false");
			linkSearch.trigger('blur');
			if ($("#searchResultDiv .cur").length != 0) {
				linkSearch.val($("#searchResultDiv .cur").html());
			}
		}
		if (args.searchCallback != undefined) {

			var searchCall = eval(args.searchCallback);
			searchCall.call(null, { "eventEle": curEventEle, "postData": linkSearch.val() });//当前函数名      
		}
	}
}

//ajax 搜索提示 data
//data： {"data":["php\u4e2d\u7ea7\u7a0b\u5e8f\u5458","php\u540e\u53f0\u5de5\u7a0b\u5e08","php\u5f00\u53d1\u5de5\u7a0b\u5e08","php\u7a0b\u5e8f\u5458","php\u9ad8\u7ea7\u7a0b\u5e8f\u5458"],"status":1}

// 调用
//ajaxSearchFun({
//	"eventEle":".ajaxSearch",
//	"promptUrl":"select_ajax_test2.json",
//	"searchCallback":function(args){
//		//{"eventEle":"eventEle","postData":"postData"}
//		console.log(args);
//		$.ajax({
//			url:"select_ajax_test2-2.json",
//			type:"POST",
//			data:args.postData,
//			success:function(data){
//			  console.log("搜索结果:"+args.postData);
//			  console.log(args.eventEle);
//			}
//		});
//	}
//});

function morefilterFun(args) {
	$(".more_filter").each(function (index, el) {
		if ($(".filter_list1 li:gt(0) .cur", $(this)).length == 0) {
			$(this).addClass('overhide');
			$(".btn_more_filter", $(this)).addClass("up");
		}
	});
	$("body").on("click", ".btn_more_filter", function (event) {
		var filterParent = $(this).closest(".more_filter");
		if (filterParent.hasClass("overhide")) {
			filterParent.removeClass("overhide");
			$(this).removeClass("up");
		} else {
			filterParent.addClass("overhide");
			$(this).addClass("up");
		}
	});
}
//极简历展示
function fastResumeToggle() {
	$(".fast-resume .fresume-detail").each(function (index, el) {
		var detailH = $(this).height();
		var fastResume = $(this).closest(".fast-resume");
		if (detailH > 25) {
			$(this).addClass("ellipsis");
		} else {
			$(".btn-fresume-down", fastResume).css({ "display": "none" });
		}
	});

	$("body").off("click", ".fast-resume .btn-fresume-down");
	$("body").on("click", ".fast-resume .btn-fresume-down", function (event) {
		var fastResume = $(this).closest(".fast-resume");
		$(fastResume).removeClass("up");
		$(fastResume).addClass("down");
	});
	$("body").off("click", ".fast-resume .btn-fresume-up");
	$("body").on("click", ".fast-resume .btn-fresume-up", function (event) {
		var fastResume = $(this).closest(".fast-resume");
		$(fastResume).removeClass("down");
		$(fastResume).addClass("up");
	});
}
//极简历申请登录
function fastResumelogin() {
	$("body").on("click", ".fresume_login", function (event) {
		$($(this).closest('#popnormal-resume-urgent-create')).remove();
		$("#js-login").trigger("click");
	});
}
/*proxySelect 模拟Select start*/
/*
//html 代码
<div class="proxy_select"><i></i>
    <input class="proxy-txt form-control control-sm bor-c-green w-100" placeholder="职位"  type="text" readonly value="">
    <input class="proxy-val" placeholder=""  type="hidden"  value="">
    <ul class="option_group">
        <li val="1">公司1</li>
        <li val="2">公司2</li>
        <li val="3">公司3</li>
        <li val="4">公司4</li>
        <li val="5">公司5</li>
        <li val="6">公司6</li>
        <li val="7">公司7</li>
        <li val="8">公司8</li>
        <li val="9">公司9</li>
        <li val="10">公司10</li>
        <li val="11">公司11</li>
        <li val="12">公司12</li>
    </ul>
</div>
proxySelectFun();//js 调用 模拟Select
*/

function proxySelectFun() {
	function Selhtml(selOjb) {
		var options = $('select option', selOjb);
		var placeholder = $(options[0]).text();
		var selectedTxt = $('select option:selected', selOjb).text();
		if (placeholder == selectedTxt) {
			selectedTxt = "";
		}
		var selectedVal = $('select option:selected', selOjb).val();
		var html = [];
		html.push('');
		html.push('<input class="proxy-txt form-control" placeholder="' + placeholder + '"  type="text" readonly value="' + selectedTxt + '">');
		html.push('<input class="proxy-val" type="hidden"  value="' + selectedVal + '">');
		html.push('<ul class="option_group">');
		for (var i = 0; i < options.length; i++) {
			html.push('    <li val="' + $(options[i]).val() + '">' + $(options[i]).text() + '</li>');
		}
		html.push('</ul>');
		return html.join('');
	}
	var zIndex = 1000;
	$('.proxy_select').each(function (index, el) {
		var proxySelect = $(this);
		$(proxySelect).css({ "z-index": zIndex });
		zIndex--;
		if ($(".proxy-txt", proxySelect).length == 0) {
			$(".proxy_sel_hide", proxySelect).before(Selhtml(proxySelect));
		}
		var proxyTxtObj = $(".proxy-txt", proxySelect);
		var proxyValObj = $(".proxy-val", proxySelect);
		//样式
		$(".option_group", proxySelect).css({
			"border-color": $(proxyTxtObj).css("border-color"),
			"width": parseFloat(proxyTxtObj.css("width")) + parseFloat(proxyTxtObj.css('padding-right')) + parseFloat(proxyTxtObj.css('padding-left'))
		})
	});
	$("body").off('click', '.proxy_select .proxy-txt');
	$("body").on('click', '.proxy_select .proxy-txt', function (event) {
		var proxySelect = $(this).closest('.proxy_select');
		$(proxySelect).removeClass("proxy-un");
		$(".proxy-un .option_group").css({ "display": "none" });
		var proxyTxtObj = $(".proxy-txt", proxySelect);
		var proxyValObj = $(".proxy-val", proxySelect);
		var aniTime = 1;
		//默认值    
		var curProxyVal = $(proxyValObj).val();
		if (curProxyVal != "") {
			$(".option_group li", proxySelect).removeClass("cur");
			$('.option_group li[val=' + curProxyVal + ']', proxySelect).addClass("cur");
		}
		//slideToggle
		$(".option_group", proxySelect).slideToggle(aniTime);
		$(".option_group li", proxySelect).off("click");
		$(".option_group li", proxySelect).on("click", function (event) {
			var proxyTxt = $(this).text();
			var proxyVal = $(this).attr("val");
			$(proxyTxtObj).val(proxyTxt);
			$(proxyValObj).val(proxyVal);
			var curselOjb = $(this).closest('.proxy_select');
			$('select', curselOjb).val(proxyVal);
			$(".option_group", curselOjb).slideUp(aniTime);
		});
	});
	$("body").off('blur', '.proxy_select .proxy-txt');
	$("body").on('blur', '.proxy_select .proxy-txt', function (event) {
		var proxySelect = $(this).closest('.proxy_select');
		$(proxySelect).addClass("proxy-un");
	});
	$("body").click(function (event) {
		var proxy_select = $(event.target).closest('.proxy_select').length;
		if (proxy_select == 0) {
			$(".proxy-un .option_group").css({ "display": "none" });
		}
	})
}

/*proxySelect 模拟Select end*/
/*模拟 radio checkbox  样式  注意label 的for属性 与  radio checkbox  一一对应； start*/
/*
//checkbox
<div class="proxyinput_group">  
    <label class="proxyinput"> 
        <span class="h0hidden"><input type="checkbox" name="checkbox1" checked="checked"></span>张丰丰
    </label>
    <label class="proxyinput"> 
        <span class="h0hidden"><input type="checkbox" name="checkbox1" value="2"></span>张丰丰 
    </label>
    <label class="proxyinput"> 
        <span class="h0hidden"><input type="checkbox" name="checkbox1" value="3"></span>张丰丰 
    </label>
</div> 
//radio
<div class="proxyinput_group">                          
    <label class="proxyinput " for="sex_m">
         <span class="h0hidden"><input class="js_validate" type="radio" name="sex" id="sex_m" value="M"></span>男
    </label>
    <label class="proxyinput" for="sex_f">
        <span class="h0hidden"><input type="radio" name="sex" id="sex_f" value="F" checked="checked"></span>女
    </label>
</div>   
*/
function proxyInput() {
	$('.proxyinput [type="radio"]').each(function (index, el) {
		if ($(this).prop("checked")) {
			var proxyinput = $(this).closest('.proxyinput');
			var radioArr = $(this).closest('.proxyinput_group');
			$('.proxyinput', radioArr).removeClass('checked');
			$(proxyinput).addClass('checked');
		}

	});
	$('.proxyinput [type="radio"]').on('click', function (event) {
		var proxyinput = $(this).closest('.proxyinput');
		var radioArr = $(this).closest('.proxyinput_group');
		$('.proxyinput', radioArr).removeClass('checked');
		$(proxyinput).addClass('checked');
	});
	$('.proxyinput [type="checkbox"]').each(function (index, el) {
		if ($(this).prop("checked")) {
			var proxyinput = $(this).closest('.proxyinput');
			$(proxyinput).addClass('checked');
		}

	});
	/*.proxyinput_group 可以设置 maxlength="3"*/
	$('.proxyinput [type="checkbox"]').on('click', function (event) {
		var checkboxArr = $(this).closest('.proxyinput_group');
		var proxyinput = $(this).closest('.proxyinput');
		if ($(this).prop("checked")) {
			$(proxyinput).addClass('checked');

		} else {
			$(proxyinput).removeClass('checked');
		}

	});

}
/*模拟 radio checkbox  样式 end*/