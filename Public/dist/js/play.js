var shTurnfun=function(){
	this.lock=false;
	this.Animtime=500;
	this.pagesLen=0;
	this.turnStatus=null;
	this.turnTimeout=null;
	this.waitTime=2000;
	this.showGroup=null;
	this.turnstatus=false;
	this.showingId = 0;
	this.toshowId =0;
	this.showstyle="block";
};

shTurnfun.prototype={
	init:function(args){
		if($(".wp-bannerize-support",args.turnconid).length!=0){
			$(".wp-bannerize-support",args.turnconid).remove();
		}
		if(args.showstyle!=undefined){
			this.showstyle=args.showstyle;
		}
		if(args.waittime!=undefined){
			this.waitTime=args.waittime;	
		}
		
		this.pagesLen=$(args.turnpage).length;
		if(this.pagesLen==0){
			return;//没有时
		}
		if($(args.turntab,args.turntabwrapid).length==0){
			$(args.turntabwrapid).append(this.tabscreate(args));
		}
		var tabs = $(args.turntab,args.turntabwrapid);
		var pages = $(args.turnpage);
	   	this.showGroup=new Array();	
	   	for(i = 0;i<tabs.length;i++){
	   		this.showGroup.push({"page":pages[i],"tab":tabs[i]});
	   	}
		$(args.turntab,args.turntabwrapid).click((function(TfThis){
			return function(event) {
				event.preventDefault();
				if(!TfThis.lock){
					var tabid=parseInt($(this).attr("tabid"));
					TfThis.toshowId=tabid;
					TfThis.showfun(args);				
				}
			}
		})(this));	
		this.turnstatus=args.turnstatus;
		this.showingId = args.showingid;
		this.toshowId =(this.showingId+1)%this.showGroup.length;
		$(args.turnpage).css('display','none');
		$(this.showGroup[this.showingId].page).css({'display':this.showstyle,'opacity': 1});
		$(this.showGroup[this.showingId].tab).addClass(args.turntabcur);
		if(this.turnstatus==true){
			clearTimeout(this.turnTimeout);
			this.turnTimeout=setTimeout(this.setTimeoutWrap(args,this),this.waitTime);
			$(args.turnwrapid).mouseenter((function(TfThis){
				return function(event) {
					TfThis.turnstatus=false;
					clearTimeout(TfThis.turnTimeout);
				}
			})(this));
			$(args.turnwrapid).mouseleave((function(TfThis){
				return function(event) {
					TfThis.turnstatus=true;
					if(!TfThis.lock){
					TfThis.toshowId = (TfThis.showingId+1)%TfThis.showGroup.length;
					clearTimeout(TfThis.turnTimeout);
					TfThis.turnTimeout=setTimeout(TfThis.setTimeoutWrap(args,TfThis),TfThis.waitTime);	
					}			
				}
			})(this));

		}			   	
		//自定义函数
		this.customfun(args);
	},
	tabscreate:function(args){
	    var tabshtml=[];
	        tabshtml.push('');
	        for(var a=0; a<this.pagesLen; a++){
	            tabshtml.push('<'+args.turntab+' class="tab" tabId="'+a+'"></'+args.turntab+'>');
	        }   
	    return tabshtml.join('');
	},
	setTimeoutWrap:function(args,TfThis){
		return function(){
			TfThis.showfun(args);
		}	
	},
	showfun:function(args){
		this.lock=true;
	
		$(this.showGroup[this.showingId].page).animate({
			opacity: 0},
			this.Animtime,(function(TfThis){return function(){
				$(TfThis.showGroup[TfThis.showingId].page).css({'display':'none',"opacity":'0'});
				$(TfThis.showGroup[TfThis.showingId].tab).removeClass(args.turntabcur)
				$(TfThis.showGroup[TfThis.toshowId].page).css({'display':TfThis.showstyle,'opacity':'0'});
				$(TfThis.showGroup[TfThis.toshowId].tab).addClass(args.turntabcur);
				$(TfThis.showGroup[TfThis.toshowId].page).animate({
					opacity: 1},
					TfThis.Animtime,(function(TfThis){return function(){
						TfThis.lock=false;					

						TfThis.showingId=TfThis.toshowId;
						if(TfThis.turnstatus==true){
							TfThis.toshowId = (TfThis.showingId+1)%TfThis.showGroup.length;
							clearTimeout(TfThis.turnTimeout);
							TfThis.turnTimeout=setTimeout(TfThis.setTimeoutWrap(args,TfThis),TfThis.waitTime);								
						}
					}})(TfThis));
			}})(this));
	},
	customfun:function(args){

	}

};

var lrTurnfun=function(){
	this.lock=false;
	this.Animtime=300;
	this.wrapWidth=0;
	this.pageWidth=0;
	this.pagesLen=0;
	this.conWidth=0;
	this.swipeWidth=0;
	this.turnStatus=null;
	this.turnTimeout=null;
	this.waitTime=1500;
	this.dir=null;
	this.swipelen=null;
	this.showGroup=null;
	this.curswipe=null;
	this.turnstatus=false;
	this.tabcurclass=null;
};
lrTurnfun.prototype={
	init:function(args){
		this.tabcurclass="."+args.turntabcur;
		if($(".wp-bannerize-support",args.turnconid).length!=0){
			$(".wp-bannerize-support",args.turnconid).remove();
		}
		if(args.waittime!=undefined){
			this.waitTime=args.waittime;
		}
		if(args.turnwrapwidth!=undefined){
			this.wrapWidth=args.turnwrapwidth;
		}else{
			this.wrapWidth=parseFloat($(args.turnwrapid).css("width"));
		}
		if(args.swipepagewidth!=undefined){
			this.pageWidth=args.swipepagewidth;
		}else{
			this.pageWidth=parseFloat($(args.swipepage).css("width"))+parseFloat($(args.swipepage).css('margin-right'))+parseFloat($(args.swipepage).css('margin-left'))+parseFloat($(args.swipepage).css('padding-right'))+parseFloat($(args.swipepage).css('padding-left'));			
		}
		this.pagesLen=$(args.swipepage).length;
		if(this.pagesLen==0){
			return;
		}
		this.swipelen=Math.ceil(this.pagesLen/(args.rownum*args.swipenum));

		if(this.pagesLen<=args.swipenum*args.rownum){
			this.conWidth=this.pageWidth*args.swipenum+2;
			
		}else{
			this.conWidth=this.pageWidth*Math.ceil(this.pagesLen/args.rownum)+2;	
		}
		//一屏
		if(this.swipelen==1){
			this.conWidth=this.wrapWidth;
		}

		
		this.swipeWidth=this.pageWidth*args.swipenum;
		$(args.turnwrapid).css({"overflow":"hidden"});
		/*$(args.swipepage).css({"float":"left"});*/
		$(args.turnconid).css("width",this.conWidth);	
		if($(args.turntab,args.turntabwrapid).length==0){
			$(args.turntabwrapid).append(this.tabscreate(args));
		}
		
		var tabs = $(args.turntab,args.turntabwrapid);
	   	this.showGroup=new Array();
	    var i = 0;
	    var dirleftML=0;
	    var dirrightML=0;
	    for(i = 0;i<tabs.length;i++){
    		dirleftML=-(i*this.swipeWidth)+(this.wrapWidth-this.swipeWidth)/2;
    		dirrightML=-((i*this.swipeWidth)-(this.wrapWidth-this.swipeWidth)/2);
	    	if(i==0){
		    	dirleftML=0;
		    	dirrightML=0;
	    	}
	    	if(i==tabs.length-1){
	    		dirleftML=-(this.conWidth-this.wrapWidth);
	    		dirrightML=-(this.conWidth-this.wrapWidth);
	    		
	    	}
	        this.showGroup.push({"dirleft":dirleftML,"dirright":dirrightML,"tab":tabs[i]});
	    };

		$(args.turntab,args.turntabwrapid).click((function(TfThis){
			return function(event) {
				event.preventDefault();
				if(!TfThis.lock){
					TfThis.curswipe=parseInt($(this).attr("tabid"));
					TfThis.swipelrfun(args,TfThis.dir);				
				}
			}
		})(this));	
		this.turnstatus=args.turnstatus;
		this.curswipe=0;
		this.dir="left";
		$(args.turntab,args.turntabwrapid).removeClass(args.turntabcur);
		$(this.showGroup[this.curswipe].tab).addClass(args.turntabcur);	

		if(this.turnstatus==true){
			clearTimeout(this.turnTimeout);
			this.turnTimeout=setTimeout(this.setTimeoutWrap(args,this.dir,this),this.waitTime);

			$(args.turnwrapid).mouseenter((function(TfThis){
				return function(event) {
					TfThis.turnstatus=false;
					clearTimeout(TfThis.turnTimeout);
				}
			})(this));
			$(args.turnwrapid).mouseleave((function(TfThis){
				return function(event) {
					TfThis.turnstatus=true;
					clearTimeout(TfThis.turnTimeout);
					TfThis.turnTimeout=setTimeout(TfThis.setTimeoutWrap(args,TfThis.dir,TfThis),TfThis.waitTime);				
				}
			})(this));
			if(args.goleftid!=undefined){
				$(args.goleftid).mouseenter((function(TfThis){
					return function(event) {
						TfThis.turnstatus=false;
						clearTimeout(TfThis.turnTimeout);
					}
				})(this));
				$(args.goleftid).mouseleave((function(TfThis){
					return function(event) {
						TfThis.turnstatus=true;
						clearTimeout(TfThis.turnTimeout);
						TfThis.turnTimeout=setTimeout(TfThis.setTimeoutWrap(args,TfThis.dir,TfThis),TfThis.waitTime);				
					}
				})(this));
			}
			if(args.gorightid!=undefined){
				$(args.gorightid).mouseenter((function(TfThis){
					return function(event) {
						TfThis.turnstatus=false;
						clearTimeout(TfThis.turnTimeout);
					}
				})(this));
				$(args.gorightid).mouseleave((function(TfThis){
					return function(event) {
						TfThis.turnstatus=true;
						clearTimeout(TfThis.turnTimeout);
						TfThis.turnTimeout=setTimeout(TfThis.setTimeoutWrap(args,TfThis.dir,TfThis),TfThis.waitTime);				
					}
				})(this));
			}			

		}
		if(args.goleftid!=undefined){
			if(this.swipelen==1){
				if(!($(args.goleftid).hasClass(args.leftright_unable_class))){
					$(args.goleftid).addClass(args.leftright_unable_class);
				}					
			}
			
			$(args.goleftid).click((function(TfThis){
				return function(event) {
					event.preventDefault();
					if(!TfThis.lock){
						var curtabid=parseInt($(TfThis.tabcurclass,args.turntabwrapid).attr("tabid"));
						if(curtabid<(TfThis.swipelen-1)){
							TfThis.lock=true;
							TfThis.curswipe=curtabid+1;
							TfThis.dir="left";
							TfThis.swipelrfun(args,TfThis.dir);
						}	
					}
					
				}
				
			})(this));
		}
		if(args.gorightid!=undefined){
			if(!($(args.gorightid).hasClass(args.leftright_unable_class))){
				$(args.gorightid).addClass(args.leftright_unable_class);
			}			
			$(args.gorightid).click((function(TfThis){
				return function(event) {
					if(!TfThis.lock){
						var curtabid=parseInt($(TfThis.tabcurclass,args.turntabwrapid).attr("tabid"));
						if(curtabid!=0){
							TfThis.lock=true;
							TfThis.curswipe=curtabid-1;					
							TfThis.dir="right";			
							TfThis.swipelrfun(args,TfThis.dir);						
						}
					}
					
				}	
			})(this));			
		}	



	},
	tabscreate:function(args){
	    var tabshtml=[];
	        tabshtml.push('');
	        for(var a=0; a<this.swipelen; a++){
	            tabshtml.push('<'+args.turntab+' class="tab" tabId="'+a+'"></'+args.turntab+'>');
	        }   
	    return tabshtml.join('');
	},
	setTimeoutWrap:function(args,dir,TfThis){
		return function(){
			TfThis.swipelrfun(args,dir);
		}	
	},
	swipelrfun:function(args,dir){

		this.lock=true;	
		if(this.turnstatus==true){
			if(this.curswipe==this.swipelen-1){
				this.dir="right";
			}
			if(this.curswipe==0){
				this.dir="left";
			}
		}
		if(args.goleftid!=undefined){
			if(this.curswipe==this.swipelen-1){
				if(!($(args.goleftid).hasClass(args.leftright_unable_class))){
					$(args.goleftid).addClass(args.leftright_unable_class);
				}
			}else{
				if($(args.goleftid).hasClass(args.leftright_unable_class)){
					$(args.goleftid).removeClass(args.leftright_unable_class);
				}
			}
		}
		if(args.gorightid!=undefined){
			if(this.curswipe==0){
				if(!($(args.gorightid).hasClass(args.leftright_unable_class))){
					$(args.gorightid).addClass(args.leftright_unable_class);
				}
			}else{
				if($(args.gorightid).hasClass(args.leftright_unable_class)){
					$(args.gorightid).removeClass(args.leftright_unable_class);
				}
			}
		}
		$(args.turntab,args.turntabwrapid).removeClass(args.turntabcur);
		$(this.showGroup[this.curswipe].tab).addClass(args.turntabcur);
		if(this.dir=="left"){
			var conMLeft=this.showGroup[this.curswipe].dirleft;
		}else{
			var conMLeft=this.showGroup[this.curswipe].dirright;
		}
		
		$(args.turnconid).animate({
		"margin-left":conMLeft+"px"
		}, this.Animtime,(function(TfThis){
			return function(event) {
				TfThis.lock=false;	
				if(TfThis.turnstatus==true){
					clearTimeout(TfThis.turnTimeout);
					TfThis.turnTimeout=setTimeout(TfThis.setTimeoutWrap(args,TfThis.dir,TfThis),TfThis.waitTime);
					if(TfThis.dir=="left"){
						TfThis.curswipe=TfThis.curswipe+1;
					}else{
						TfThis.curswipe=TfThis.curswipe-1;
					}
				}
			}
		})(this));
	}
}
