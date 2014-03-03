/**	
* /获得文字长度(英文两个算一个字符，中文汉字占一个字符。)
*/
function getMessageLength (b) { 
	var a = b.match(/[^\x00-\x80]/g); 
	var l=b.length + (!a ? 0 : a.length);
	return Math.ceil(l/2); 
}
/**	
* 判断图片是否加载完成。
*/
function loadImage(url,callback,obj) {
    var img = new Image(); //创建一个Image对象，实现图片的预下载
    img.src = url;
    if(img.complete) { // 如果图片已经存在于浏览器缓存，直接调用回调函数
    	callback.call(obj);
        return; // 直接返回，不用再处理onload事件
    }
    img.onload = function () { //图片下载完毕时异步调用callback函数。
        callback.call(obj);//将回调函数的this替换为Image对象
    };
};
/**
 * 获取get参数
 * @return {[object]} [返回数组对象]
 */
 function getArgs(url){
 	var args = {};
 	var match = null;
 	var search = url;
 	var reg = /(?:([^&]+)=([^&]+))/g;
 	while((match = reg.exec(search))!==null){
 		args[match[1]] = match[2];
 	}
 	return args;
 }
 /**
 * 异步轮询取得用户消息通知
 */
 function get_msg(){
 	$.getJSON(site_url+'common/get_msg',function(data){
 		if(data.status==1){
 			//消息提醒 1:评论、2：私信、3@我、0：首页动态
 			var msg;
 			var num=0;
 			if(msg=data.msg){
 				for(var key in msg){
 					num+=msg[key];
 				}
 				//顶部导航栏新消息图标提醒
 				$('.global_nav').find('.W_new').show();
 				//左侧导航栏消息总条数提醒
 				$('.left_nav').find('.W_new_count').text(num).show();
 				//调用显示消息插件
 				$.msg(msg);
 			}
 			if(news=data.news){
 				$('.left_nav').find('.W_new').show();
 				//主页新微博提示
 				if($('body.index').length==1){
 					if($('.weibo_list').find('.notes').length==1){
 						$('.weibo_list').find('.notes').children('span').text(news);
 					}else{
 						var notes='<a href="javascript:void(0)" action-type="load_news" class="notes">有 <span>'+ news +'</span> 条新微博，点击查看</a>'
 						$('.weibo_list').prepend($(notes));
 					}
 				}
 			}
 		}
 		setTimeout(function(){
 			get_msg();
 		},5000)
 	})
 }
 var media_expand='\
 <div class="media_expand SW_fun2 S_line1 S_bg1"  node-type="feed_list_media_disp">\
 <p class="medis_func S_txt3">\
 <a class="retract" href="javascript:void(0);"><em class="W_ico12 ico_retract"></em>收起</a><i class="W_vline">|</i>\
 <a class="show_big" href="javascript:void(0);" target="_blank"><em class="W_ico12 ico_showbig"></em>查看大图</a><i class="W_vline">|</i>\
 <a class="turn_left" href="javascript:void(0);" ><em class="W_ico12 ico_turnleft"></em>向左转</a><i class="W_vline">|</i>\
 <a class="turn_right" href="javascript:void(0);"><em class="W_ico12 ico_turnright"></em>向右转</a>\
 </p>\
 <div>\
 <img src="'+ site_url +'assets/images/blank.gif" alt="">\
 </div>\
 </div>\
 ';
 /**
 * 格式化、组合微博
 * @return {[type]} [description]
 */
 function f_weibo(weibo_list,forward_list,source){
 	var item;
 	var count=weibo_list.length;
 	var new_weibo_class='';
 	$(weibo_list).each(function(i){
 		// 定义最后一个微博class
 		if(i==(count-1)) new_weibo_class=' weibo_new';
 		var weibo=weibo_list[i];
		//微博              
		item+='<div class="item clearfix'+ new_weibo_class +'" data-id="'+ weibo['id'] +'">';
		//是否可以删除
		if(weibo['me']){
			item+='<div class="WB_screen">\
			<a title="删除此条微博" class="W_ico12 icon_close" action-type="weibo_delete" href="javascript:;"></a>\
			</div>\
			';
		}
		if (source!='home') {
			//用户个人主页不显示头像
			item+='<div class="face">\
			<a href="'+ weibo['domain'] +'"><img width="50" height="50" src="'+  weibo['avatar'] +'" alt=""></a>\
			</div>\
			';
		};
		item+='<div class="detail">';
		if (source!='home') {
			//用户个人主页不显示昵称
			item+='<div>\
			<a class="name S_func1" href="'+ weibo['domain'] +'">'+ weibo['username'] +'</a>\
			</div>\
			';
		}
		item+='<div class="content">'+ weibo['content'] +'</div>';
		//微博配图
		if(weibo['picture']){
			if(weibo['pic_class']) var _class=weibo['pic_class'];
			item+='<div class="media_prev">\
			<ul class="'+ _class +' clearfix">\
			';
			var pic;
			$(weibo['pic']).each(function(i){
					//列表图
					pic=weibo['pic'][i];
					item+='<li><a href="javascript:void(0)"><img src="'+ site_url + weibo['pic_path'] + pic['picture'] +'" alt=""></a></li>';
				})
			item+='</ul></div>'+ media_expand;
		}
		//转发
		if(weibo['isturn']!=0){
			var wid=weibo['isturn'];
			item+='<div class="forwardContent">\
			<div class="WB_arrow">\
			<em class="S_line1_c">◆</em>\
			<span class="S_bg1_c">◆</span>\
			</div>\
			';
			if(forward_list && forward_list[wid]){
				var forward=forward_list[wid];
				item+='<div>\
				<a class="name S_func1" href="'+ forward['domain'] +'">@'+ forward['username'] +'</a>\
				</div>\
				<div class="content">\
				'+ forward['content'] +'\
				</div>\
				';
				if(forward['picture']){
					if(forward['pic_class']) var _class=forward['pic_class'];
					item+='<div class="media_prev">\
					<ul class="'+ _class +' clearfix">\
					';
					var pic;
					$(forward['pic']).each(function(i){
  				 		//列表图
  				 		pic=forward['pic'][i];
  				 		item+='<li><a href="javascript:void(0)"><img src="'+ site_url + forward['pic_path'] + pic['picture'] +'" alt=""></a></li>';
  				 	})
					item+='</ul></div>'+ media_expand;
				}
				item+='<div class="func clearfix S_txt2">\
				<div class="from left">\
				<a href="#" class="S_func2 time">'+ forward['time'] +'</a> 来自<a href="" class="S_func2">新浪微博</a> \
				</div>\
				<div class="handle right">\
				<a href="javascript:void(0)"><s class="W_ico20 icon_praised_b"></s>('+ forward['praise'] +')</a><i class="S_txt3">|</i><a href="'+ forward['url'] +'" class="S_func2">转发('+ forward['turn'] +')</a><i class="S_txt3">|</i><a href="'+ forward['url'] +'" class="S_func2">评论('+ forward['comment'] +')</a>\
				</div>\
				</div>\
				';
			}else{
				item+='<div class="WB_deltxt">\
				抱歉，此微博已被作者删除。查看帮助：<a href="">http://t.cn/zWSudZc</a>\
				</div>';
			}
			item+='</div>';
		}							
		item+='<div class="func clearfix S_txt2">\
		<div class="from left">\
		<a href="#" class="S_link2 time">'+ weibo['time'] +'</a> 来自<a href="" class="S_link2">新浪微博</a> \
		</div>\
		<div class="handle right">\
		<a href="javascript:void(0)" action-type="praise"><s class="W_ico20 icon_praised_b"></s>('+ weibo['praise'] +')</a><i class="S_txt3">|</i><a href="javascript:void(0)" action-type="turn" >转发('+ weibo['turn'] +')</a><i class="S_txt3">|</i><a href="javascript:void(0)" action-type="collect">收藏</a><i class="S_txt3">|</i><a href="javascript:void(0)" action-type="comment">评论('+ weibo['comment'] +')</a>\
		</div>\
		</div>\
		<!-- 评论 -->\
		<div class="comment S_line1 hide">\
		<div class="WB_arrow">\
		<em class="S_line1_c">◆</em>\
		<span class="S_bg4_c">◆</span>\
		</div>\
		</div>\
		<!-- 评论结束 -->\
		</div>\
		</div>\
		';
	})
return item;
}
$(document).ready(function(){
	/**	
	* 定义共用变量
	*/
	var user={};
	user.name=$('.global_nav').find('.username').children('a').text();
	//用户头像
	var avatar=$('.global_nav').find('.username').attr('avatar');
	if(avatar){
		user.avatar=site_url+'images/avatar/50/'+avatar;
	}else{
		var sex=$('.global_nav').find('.username').attr('sex');
		user.avatar = sex=='男'?site_url + 'assets/images/male_avatar_50.gif':site_url + 'assets/images/female_avatar_50.gif';
	}
	user.domain=$('.global_nav').find('.username').children('a').attr('href');

	//首页发新weibo
	var weibo='\
	<div class="item clearfix hide" data-id> \
	<div class="WB_screen">\
	<a title="删除此条微博" class="W_ico12 icon_close" action-type="weibo_delete" href="javascript:;"></a>\
	</div>\
	<div class="face">\
	<a href="'+ user.domain +'"><img  width="50" height="50" src="' + user.avatar + '" alt=""></a>\
	</div>\
	<div class="detail">\
	<div><a class="name S_func1" href="'+ user.domain +'">' + user.name + '</a></div>\
	<div class="content">\
	</div>\
	<div class="func clearfix S_txt2">\
	<div class="from left"><a href="#" class="S_link2 time"></a> 来自<a href="" class="S_link2">新浪微博</a> </div>\
	<div class="handle right"><a href="javascript:void(0)"><s class="W_ico20 icon_praised_b"></s>(0)</a><i class="S_txt3">|</i><a href="javascript:void(0)" action-type="turn">转发(0)</a><i class="S_txt3">|</i><a href="javascript:void(0)" action-type="collect">收藏</a><i class="S_txt3">|</i><a href="javascript:void(0)" action-type="comment">评论(0)</a></div>\
	</div>\
	</div>\
	</div>\
	';
	/**	
	* 查看消息，设置时隐藏新消息提示框
	*/
	$('.global_nav  .msg,.global_nav .setting').hover(function(){
		$('.gn_tips').hide();
	},function(){
		if(!$('.gn_tips').hasClass('hide'))	$('.gn_tips').show();
	})
	/**	
	* 点击关闭新消息提示框
	*/
	$('.gn_tips').find('.icon_close').on('click',function(){
		$('.gn_tips').addClass('hide').find('li').andSelf().hide();
		$.post(site_url+'common/flush_msg');
	})
	/**	
	* 点击表情按钮，调出表情对话框
	*/
	$("body").on('click',"[action-type='face']",function(e){
		//阻止冒泡
		e.stopPropagation();
		//调用弹出框插件
		$(this).callface();
		//ajax请求表情gif地址
		$.ajax(
		{
			url:site_url+'face',
			success:function(data){
				$('.faces_list').html(data);
			}
		})
	})
	/**	
	* 点击插入相应的表情
	*/
	$('body').on('click','.faces_list li',function(){
		var title = '['+$(this).find('img').attr('title')+']';
		var obj_id=$(this).parents('.hotFace').attr('action-id');
		$('#'+obj_id).insertAtCaret(title);
		// 触发textarea的keyup事件
		$('#'+obj_id).trigger('keyup');
	})
	/**	
	* 点击插入图片按钮，调出插入图片对话框
	*/
	$("[action-type='upload_image']").on('click',function(e){
		var textarea=$('#weibo_input_detail');
		
		//关闭图片上传框时候检测微博内容
		$(this).imageUpload({
			callback_handler:function(){
				if($.trim(textarea.val())=='分享图片'){
					textarea.val('').trigger('keyup');
				}
			}
		});
		$('#image_upload').uploadify({
			'buttonText' : '',
			'swf'      : site_url+'assets/js/Uploadify/uploadify.swf',
			'uploader' : site_url+'index/image',
			'width':'195',
			'height':'84',
			'fileTypeExts' : '*.gif; *.jpg; *.jpeg; *.png',
			'fileSizeLimit':'5120',
			'onUploadStart':function(){
				// 判断只执行一次
				if($('.add').find('#image_upload').length==0){
					$('.image_upload').find('ul.btn').css({'position':'absolute','z-index':'-1'});
					$('.image_upload').find('.hide').show();
				}
				// 插入li元素
				var li='<li><img src="'+ site_url+'assets/images/blank.gif" action-data width="80" height="80"><a href="javascript:;" action-type="deleteImg" class="ico_delpic"></a></li>';
				$('.image_upload').find('.add').before(li).prev('li').append($('<i>',{class:'ico_loading_upload'}));
				//判断图片数量是否达到9个
				num=0;
				if($('.image_upload').find('.list').find("li:not('.add')").length==9){
					num=9;
				}
			},
			'onUploadSuccess' : function(file,data) {
				console.log(typeof(data));
				$('.image_upload').find('.ico_loading_upload').remove();
				//检测微博发布框是否为空
				if($.trim(textarea.val())=='') textarea.val('分享图片').trigger('keyup');
				//加载上传的图片
				var img=data.replace("images/content/square/","");
				$('.image_upload').find('.add').prev('li').find('img').attr({'src':site_url+data,'action-data':img});				

				//判断图片数量是否达到9个
				if(num==9) {
					$('#image_upload').uploadify('stop');
					$('#image_upload').uploadify('cancel','*');
					$('.image_upload').find('.add').addClass('transparent');
				}
			},
			'onQueueComplete':function(){
				// 判断只执行一次
				if($('.add').find('#image_upload').length==0){
					$('#image_upload').appendTo('.add');
				}
			}
		})
		//
	})
	//删除上传图片
	$('body').on('click',"[action-type='deleteImg']",function(){
		$(this).parent('li').remove();
		//检测微博发布框
		var textarea=$('#weibo_input_detail');
		var li_count=$('.image_upload').find('.list').find("li:not('.add')").length;
		var content= $.trim(textarea.val());
		//如果有图片文本框为空则让文本框内容为“分享图片”
		if(li_count>0 && content==''){
			textarea.val('分享图片');
		}else if(li_count==0 && content=='分享图片'){
			textarea.val('');
		}
		textarea.trigger('keyup');
		//显示上传按钮
		if($('.image_upload').find('.add.transparent').length==1){
			$('.image_upload').find('.add').removeClass('transparent');
		}
	})

	/**
	* 微博发表框获得焦点
	*/
	$('.send_weibo').find('textarea').on('focus',function(){
		$(this).parent().addClass('clicked');
	}).on('blur',function(){
		$(this).parent().removeClass('clicked');
	})
	/**
	* 微博输入提示
	*/
	$('.send_weibo').find('textarea').on('keyup',function(){
		var count=getMessageLength($.trim($(this).val()));
		var num=140-count;
		//判断输入的文字长度是否超过140
		if(num>=0){
			$('.tips_num').find('span').html('还可以输入');
			$('#num_count').removeClass().html(num);
			$('.send_btn').removeClass('W_btn_v_disable');
		}else{
			$('.tips_num').find('span').html('已经超过');
			$('#num_count').addClass('S_error').html(Math.abs(num));
			$('.send_btn').addClass('W_btn_v_disable');
		}
		//输入框内容为空按钮不可点击
		if($.trim($(this).val())==''){
			$('.send_btn').addClass('W_btn_v_disable');
		}
	})
	/**
	* 微博提交按钮
	*/
	$('.send_btn').on('click',function(){
		if(!$(this).hasClass('W_btn_v_disable')){
			// 微博配图
			var img=[];
			if($('.image_upload').length!=0){
				$('.image_upload').find('.list').find('img').each(function(){
					var _img=$(this).attr('action-data');
					img.push(_img);
				})
			}
			$('.weibo_list').find('.notes').remove();
			var item=weibo;
			// 如果有图片发布
			if(img.length>0){
				var pic_node='';
				// 得到相应数据
				var img_count=img.length;
				if(img_count==1){
					var pic_path='images/content/thumbnail/';
				}else{
					var pic_path='images/content/square/';
					if(img_count==2 || img_count==4){
						var _class='lotspic_list inner_width';
					}else{
						var _class='lotspic_list';
					}
				}
				// 组合变量
				pic_node+='<div class="media_prev">\
				<ul class="'+ _class +' clearfix">\
				';
				var picture;
				for(var key in img){
					//列表图
					picture=img[key];
					pic_node+='<li><a href="javascript:void(0)"><img src="'+ site_url + pic_path + picture +'" alt=""></a></li>';
				}
				pic_node +='</ul></div>'+ media_expand;
				pic_node += media_expand;
			}
			$(item).prependTo('.weibo_list').fadeOut();
			//插入图片节点
			var _item=$('.item:hidden');
			_item.find('.content').after(pic_node);
			var content=$('#weibo_input_detail').val();
			$.ajax({
				type:'post',
				url:site_url+'index/send',
				dataType:'json',
				data:{content:content,img:img},
				success:function(data){
					if(data.status==1){
						//移除图片列表
						if($('.image_upload').length!=0)$('.image_upload').remove();
						//微博总数+1
						$('#my_weibo').html(+$('#my_weibo').html()+1);
						//
						
						_item.data('id',data.id);
						_item.find('.content').html(data.content);
						_item.fadeIn().find('.time').html(data.time);
						$('#weibo_input_detail').val('').trigger('keyup');
						//提示发布成功
						$('.send_succpic').fadeIn();
						setTimeout(function(){
							$('.send_succpic').fadeOut();
						},1000)
					}
				}
			})
		}else{
			$('.send_weibo').find('textarea').addClass('empty');
			setTimeout(function(){
				$('.send_weibo').find('textarea').removeClass('empty');
			},800)
		}
	})
	/**	
	* 微博配图js效果
	*/
	//点击小图显示loading,大图加载完成显示大图.隐藏小图。移除loading...
	function hide_media_prev(obj){
		//移除loading
		$(this).parents('li').find('i').remove();
		//隐藏小图区域
		$(this).parents('.media_prev').hide().next('.media_expand').show();
	}
	//点击显示大图
	$('.weibo_list').on('click','.media_prev img',function(){
		//loading
		$(this).parents('li').append($("<i>",{'class':'ico_loading'}));
		var _img_url=$(this).attr('src');
		//中图url
		var img_url=_img_url.replace(/content\/(\w+?)\//,"content/bmiddle/");
		//大图url
		var large_img_url=_img_url.replace(/content\/(\w+?)\//,"content/large/");
		//执行函数加载图片隐藏小图
		loadImage(img_url,hide_media_prev,this);
		//
		$(this).parents('.media_prev')
		.next('.media_expand').find('img').attr('src',img_url)
		.parents('.media_expand').find('.show_big').attr('href',large_img_url);
	})
	//收起大图，显示小图
	$('.weibo_list').on('click','.media_expand img,.media_expand .retract',function(){
		$(this).parents('.media_expand').hide().prev('.media_prev').show();
		if($(this).is($('img'))) {
			$(this).removeClass()
		}else{
			$(this).parents('.media_expand').find('img').removeClass()
		}
	})
	//图片向左转
	$('.weibo_list').on('click','.media_expand .turn_left',function(){
		var img=$(this).parent().next().find('img');
		var rot;
		switch (img.attr('class')) {
			case undefined:
			rot='rot3';
			break;
			case 'rot3':
			rot='rot2';
			break;
			case 'rot2':
			rot='rot1'
			break;
		}
		img.removeAttr('class').addClass(rot);
	})
	//图片向右边
	$('.weibo_list').on('click','.media_expand .turn_right',function(){
		var img=$(this).parent().next().find('img');
		var rot;
		switch (img.attr('class')) {
			case undefined:
			rot='rot1';
			break;
			case 'rot1':
			rot='rot2';
			break;
			case 'rot2':
			rot='rot3'
			break;
		}
		img.removeAttr('class').addClass(rot);
	})
	/**
	*设置皮肤
	*/
	$('.set_skin').on('click',function(){
		$.ajax({
			url:site_url+'assets/data/set_skin.json',
			dataType:'json',
			success:function(data){
				$a=data;
				$('body').append($a);
				$('.set_template').drag({drag:'.title'});
				if($('body.home').length!=0)$.mask();
				$('.set_template').find('.profile_tab').children('li').eq(0).trigger('click');
			}
		})
	})

	/**	
	* 通过attr('c')判断用户是否点击更改,并激活确定按钮
	*/
	window.click=0;
	$('body').on('click',".set_template .Panel ul:not('.tab_nosep') li",function(){
		var template=$('.set_template');
		if(template.attr('c')!=1){
			template.attr('c',1).find('.W_btn_a_disable').removeClass().addClass('W_btn_a');
		}
		// 获得点击总数
		var click=window.click;
		window.click=click+1;
		console.log('count'+click);
	})

	/**	
	* 自定义皮肤选项卡
	*/ 
	$('body').on('click','.set_template .profile_tab li',function(){
		//切换样式
		var index=$(this).index();
		var ControlPanel=$('.profile_tab').next('div').children('div').eq(index);
		ControlPanel.show().siblings('div').hide();
		$(this).addClass('current').siblings().removeClass('current');
		//绑定数据
		var type=ControlPanel.data('type');
		if(ControlPanel.is(':empty')){
			$.ajax({
				url:site_url+'json/set_skin',
				type:'post',
				data:{type:type},
				success:function(data){
					ControlPanel.html(data);
					ControlPanel.find('.tab_nosep').find('li').eq(0).addClass('current');
					ControlPanel.find('ul:last').find('a').eq(0).addClass('current');
				}
			})
		}
	})

	/**
	*点击切换套装
	*/
	$('body').on('click','.suitControlPanel .template_list a',function(){
		$('.suitControlPanel').find('.template_list').find('a').removeClass('current');
		$(this).addClass('current');
		var id=$(this).data('link');
		var link=site_url+'assets/skin/suit/' + id;
		var cover=link+'/images/profile_cover.jpg';
		$('.profile_pic_top').css('background-image','url('+ cover +')');
		var href=link + '/skin.css';
		if($('#css_template').length==0){
			$("<link>")
			.attr({ id:'css_skin',
				rel: "stylesheet",
				type: "text/css",
				href: href
			})
			.appendTo("head");
			console.log(href);
		}else{
			$('#css_template').attr('href',href);
		}
		// 记录点击次数 及点击id
		var count=window.click;
		$('.suitControlPanel').data('click',++count).data('id',id);
		// 保存
		console.log('suit_click'+$('.suitControlPanel').data('click')+$('.suitControlPanel').data('sid'));
	})
	
	/**
	*点击切换模板
	*/
	$('body').on('click','.tmpControlPanel .template_list a',function(){
		$('.tmpControlPanel').find('.template_list').find('a').removeClass('current');
		$(this).addClass('current');
		var id=$(this).data('link');
		var href=site_url+'assets/skin/template/'+ id +'/skin.css';
		if($('#css_template').length==0){
			$("<link>")
			.attr({ id:'css_skin',
				rel: "stylesheet",
				type: "text/css",
				href: href
			})
			.appendTo("head");
		}else{
			$('#css_template').attr('href',href);
		}
		// 记录点击次数
		var count=window.click;
		$('.tmpControlPanel').data('click',++count).data('id',id);
		console.log('template_click'+$('.tmpControlPanel').data('click'));
	})
	/**
	*点击切换封面图
	*/
	$('body').on('click','.cover_list a',function(){
		$('.cover_list').find('a').removeClass('current');
		$(this).addClass('current');
		var id=$(this).data('link');
		var bg_img=site_url+'assets/skin/cover/'+id;
		console.log(bg_img);
		$('.profile_pic_top').css('background-image','url('+bg_img+')');
		// 记录点击次数
		var count=window.click;
		$('.coverControlPanel').data('click',++count).data('id',id);
		console.log('cover_click'+$('.coverControlPanel').data('click'));
	})
	/**
	*点击切换样式
	*/
	$('body').on('click','.diy_list a',function(){
		var css=$(this).find('span').html();
		if(css==''){
			$(this).tips({type:'error',v_type:0,text:'样式不可用',timeout:1});
			return;
		}
		$('.diy_list').find('a').removeClass('current');
		$(this).addClass('current');
		var href=site_url+"assets/skin/style/"+css;
		if($('#css_style').length==0){
			$("<link>")
			.attr({ id:'css_skin',
				rel: "stylesheet",
				type: "text/css",
				href: href
			})
			.appendTo("head");
		}else{
			$('#css_style').attr('href',href);
		}
		// 记录点击次数
		var count=window.click;
		$('.diyControlPanel').data('click',++count).data('id',css);
		console.log('diy_click'+$('.diyControlPanel').data('click'));
	})
	/**
	*关闭按钮
	*/
	$('body').on('click','.set_template .W_close,.set_template .W_btn_b',function(){
		if($('.set_template').attr('c')==1){
			$(this).modal({
				type:'center M_confirm',
				title:'提示',
				content:'<p><i class="icon_warnM"></i>您的个性化设置还没有保存，确认关闭吗？</p>',
				ok_handler:function(){
					$('.set_template').fadeOut('fast',function(){
						$(this).remove();
						$('.W_mask:last').remove();
						window.location.reload();
					})
				}
			});
		}else{
			$('.set_template').remove();
			$('.W_mask').remove();
		}
	})
	/**
	*确定按钮
	*/
	$('body').on('click','.set_template .W_btn_a',function(){
		var suit     = $('.suitControlPanel').data('click')	 +'#'+ $('.suitControlPanel').data('id');
		var template = $('.tmpControlPanel').data('click')   +'#'+ $('.tmpControlPanel').data('id');
		var cover    = $('.coverControlPanel').data('click') +'#'+ $('.coverControlPanel').data('id');
		var style    = $('.diyControlPanel').data('click')	 +'#'+ $('.diyControlPanel').data('id');
		$.ajax({
			url:site_url+'skin/save',
			type:'post',
			dataType:'json',
			data:{suit:suit,template:template,cover:cover,style:style},
			success:function(data){
				if(data.status==1){
					$('.set_template').fadeOut(100,function(){
						$(this).remove();
						$('body').tips({
							type:'center',
							callback_handler:function(){
								window.location.reload();
							}
						})
					})
				}
			}
		})
	})
	/**
	* 顶部导航搜索按钮事件
	*/
	$('.searchBtn').on('click',function(){
		var keyword=$(this).prev('[name=searchInput]').val();
		if($.trim(keyword)=='')return;
		$(this).parent('form').submit();
	})
	/**
	* 搜索页面加关注
	*/
	$('.addFollow').on('click',function(){
		var self=$(this);
		//通过什么关注
		var source=self.attr('source');
		var follow_id=$(this).attr('uid');
		var relation;
		var url;
		switch (source) {
			case 'search':
			url=site_url+'search/follow';
			break;
			case 'fans':
			url=site_url+'fans/follow';
			break;
		}
		$.ajax({
			type:'post',
			url:url,
			dataType:'json',
			data:{follow_id:follow_id,source:source},
			success:function(data){
				if(data.status==1){
					switch (source) {
						case 'search':
						if(self.attr('relation')!=2) relation='r_1';
						self.before('<img src="http://localhost/work/weibo/assets/images/transparent.gif" alt="" class="icon_connect '+ relation +'">');
						break;
						case 'fans':
						self.before('<a href="javascript:void(0)" class="W_btn_c"><span><i class="W_ico12 icon_addtwo"></i>互相关注</span></a>');
						break;
					}
					self.tips({type:'center'})
					self.remove();
				}
			}
		})
	})
	/**
	* 关注列表点击事件
	*/
	$('.myfollow_list').find('.item').on('click',function(){
		$(this).toggleClass('selected');
		var selected=$('.myfollow_list').find('.item.selected');
		var num=selected.length;
		// 获取uid、username集合
		var uid=new Array;
		var username=new Array;
		selected.find("[action-type='cancle_follow']").each(function(){
			uid.push($(this).attr('uid'));
			username.push($(this).attr('username'))
		});
		toggle_active(num,uid,username);
	})
	//切换激活状态
	function toggle_active(num,uid,username){
		//设置参数默认值
		var num = arguments[0] ? arguments[0] : 0;
		var uid = arguments[1] ? arguments[1] : '';
		var username = arguments[2] ? arguments[2] : '';

		var tab_normal=$('.tab_normal');
		tab_normal.find("[action-type='cancle_follow']").attr({'uid':uid,'username':username});
		if(num>0){
			//切换按钮激活状态
			tab_normal.find('.W_btn_c_disable').removeClass().addClass('W_btn_a');
			$('.selectText,.cancel_select').show();
			//显示选中个数
			$('.selectText').find('span').text(num);
		}else{
			tab_normal.find('.W_btn_a').removeClass().addClass('W_btn_c_disable');
			$('.selectText,.cancel_select').hide();
		}
	}
	// 取消选择
	$('.tab_normal').find('.cancel_select').on('click',function(){
		$('.myfollow_list').find('.item.selected').removeClass('selected');
		$('.selectText,.cancel_select').hide();
		$('.tab_normal').find('.W_btn_a').removeClass().addClass('W_btn_c_disable');
		toggle_active();
	})
	/**
	* 取消关注
	*/
	$('.myfollow_list ').find("[action-type='cancle_follow']").on('click',function(e){
		// 阻止冒泡
		e.stopPropagation();
		var self=$(this);
		// 如果按钮不可用就返回
		if(self.hasClass('W_btn_c_disable')) return;
		var username=self.attr('username');
		if(username.indexOf(",") > 0 ) username='这些人';
		
		$(this).modal({
			type:'center M_confirm',
			title:'提示',
			content:'<p><i class="icon_warnM"></i>确认要取消对'+username+'的关注吗</p>',
			ok_handler:function(){
				// 移除确认对话框
				$('.set_template').fadeOut('fast',function(){
					$(this).remove();
					$('.W_mask:last').remove();
					
				})
				// 执行取消关注操作
				var follow_id=self.attr('uid');
				$.ajax({
					type:'post',
					url:site_url+'follow/cancle',
					dataType:'json',
					data:{follow_id:follow_id},
					success:function(data){
						if(data.status==1){
							if(self.find('span').length>0){
								$('.myfollow_list').find('.item.selected').remove();
								toggle_active();
							}else{
								self.parents('.item').remove();
							}
						}
					}
				})
			}
		});
		
	})
	/**
	* 移除粉丝
	*/
	$('.remove_fans').on('click',function(){
		var self=$(this);
		var username=self.attr('username');
		$(this).modal({
			v_type:0,
			content:'<p><i class="icon_warn"></i>确定要移除' + username + '？</p>',
			ok_handler:function(){
				$('.set_template').fadeOut('fast',function(){
					$(this).remove();
				})
					// 执行移除粉丝操作
					var fans_id=self.attr('uid');
					$.ajax({
						type:'post',
						url:site_url+'fans/remove',
						dataType:'json',
						data:{fans_id:fans_id},
						success:function(data){
							if(data.status==1){
								self.parents('.item').remove();
							}
						}
					})
				}
			});
	})
	//删除微博
	$('.weibo_list').on('click',"[action-type='weibo_delete']",function(){
		var self=$(this);
		self.modal({
			v_type:0,
			content:'<p><i class="icon_warn"></i>确认要删除这条微博吗？</p>',
			ok_handler:function(){
				$('.set_template').fadeOut('fast',function(){
					$(this).remove();
				})
				//执行删除操作
				var item=self.parents('.item');
				var id=item.data('id');
				$.post(site_url+'index/delete',{id:id},function(data){
					if(data.status==1){
						item.animate({height:0,opacity:0},600,function(){
							item.remove();
						});
						$('#my_weibo').html(+$('#my_weibo').html()-1);
						var start = $('.weibo_list').data('start');
						$('.weibo_list').data('start',start-1);
					}
				},'json')
			}
		});
	})
	//删除at记录
	$('.weibo_list').on('click',"[action-type='at_delete']",function(){
		var self=$(this);
		self.modal({
			type:'center M_confirm',
			content:'<p><i class="icon_warn"></i>确认要隐藏这条@我的微博吗？</p>',
			ok_handler:function(){
				$('.set_template').fadeOut('fast',function(){
					$(this).remove();
				})
				//执行删除操作
				var item=self.parents('.item');
				var id=item.data('atid');

				$.post(site_url+'at/delete',{id:id},function(data){
					if(data.status==1){
						item.animate({height:0,opacity:0},400,function(){
							item.remove();
						});
					}
				},'json')
			}
		});
	})
	/**
	* 
	* index 页查看更多
	*/
	if($('body.index').length>0){
		$(window).on("scroll",function lazyload(){
			var bottom = $('body').height()-$(document).scrollTop()-$(window).height();
			if (bottom<340) {
				$(window).off("scroll");
				// var self=$(this);
				// self.prepend('<i class="ico_loading"></i>');
				var start=$('.weibo_list').data('start');
				$.post(site_url+'index/select',{start:start},function(data){
					if(data.status==1){
							// self.find('i').remove();
							var weibo_list=data.weibo_list;
							var forward_list=data.forward_list;
							var item=f_weibo(weibo_list,forward_list);

							$(item).appendTo($('.weibo_list'));
							// 每次读取5条
							$('.weibo_list').data('start',start+5);
							var _start=$('.weibo_list').data('start');
							// 每页读取20条
							if(weibo_list.length<5 || _start%20==0){
								$("[node-type='lazyload']").remove();
								$('#page').show();
							}else{
								// 恢复scroll事件
								$(window).on("scroll",lazyload);
							}
						}else{
							$("[node-type='lazyload']").remove();
							$('#page').show();
						}
					},'json')
			}
		})
		//如果微博数少于10则解除绑定事件
		if($('.weibo_list').find('.item').length<10){
			$("[node-type='lazyload']").remove();
			$('#page').show();
			$(window).off("scroll");
		}
	}
	/**
	* 
	* 用户 页查看更多
	*/
	if($('.weibo_list').find('.item').length<5){
		$('#page').show();
		$('.PRF_feed_list_more').remove();
	}

	$('.PRF_feed_list_more').on('click',function(){
		var self=$(this);
		self.prepend('<i class="ico_loading"></i>');
		var start=$('.weibo_list').data('start');
		var uid=$('.user_info').attr('uid');
		$.post(site_url+'u/index/'+uid,{start:start},function(data){
			if(data.status==1){
					//移除loading
					self.find('i').remove();
					var weibo_list=data.weibo_list;
					var forward_list=data.forward_list;
					var item=f_weibo(weibo_list,forward_list,'home');

					$(item).appendTo($('.weibo_list'));
					// 每次读取5条
					$('.weibo_list').data('start',start+5);
					var _start=$('.weibo_list').data('start');
					// console.log(_start,data.count);
					// 每页读取20条
					if(weibo_list.length<5 || _start%20==0){
						$('.PRF_feed_list_more').remove();
						$('#page').show();
					}
				}else{
					$('.PRF_feed_list_more').remove();
					$('#page').show();
				}
			},'json')
	})
	/**
	* 修改个人信息
	*/
	$('.personinfo ').find('.item').has('.acc_form').find('ul').on('click',function(){
		$(this).parent().toggleClass('active').siblings().removeClass('active');
	})
	$("[action='close_item']").on('click',function(){
		$(this).parents('.item').removeClass('active');
	})
	// 保存按钮触发表单提交事件
	$(".save_info:not('#save_info')").on('click',function(){
		$(this).parents('form').submit();
	})
	if($('body.set_info').length==1){
		//用户个性域名验证
		jQuery.validator.addMethod("domainFormat", function(value) {  
			return (/^[a-zA-Z0-9]{4,20}$/.test(value));
		});
		$(".form_domain").validate({
			onkeyup:false,
			submitHandler:function(form){
				var submit=$(form).find('.btn .W_btn_a span');
				submit.prepend($('<i/>',{class:'ico_loading'}));
				var domain=$("[name=domain]").val();
				$.ajax({
					type:'post',
					url:site_url+'set/domain/',
					dataType:'json',
					data:{domain:domain},
					success:function(data){
						if(data.status==1){
							submit.tips({
								text:'设置成功',
								callback_handler:function(){
									window.location.reload();
								}
							});
							submit.find('i').fadeOut();
						}
					}
				})
			},
			errorPlacement: function(error, element) {
				element.parents('.info_item').find('.tips').append(error).find('.S_txt2').remove();
				element.parents('.info_item').find('.tips').find('i').removeClass().addClass('icon_rederrorS');
			},
			success: function(element) {
				element.parents('.info_item').find('.tips').find('i').removeClass().addClass('icon_succ');
			},
			rules:{
				domain:{
					required:true,
					domainFormat:true,
					remote: {
					    url : site_url+'set/domain_exist/',			//后台处理程序
					    type: "post",               			//数据发送方式 
					    data: {                     			//要传递的数据
					    	account: function() {
					    		return $("[name=domain]").val();
					    	}
					    }
					}
				}
			},
			messages:{
				domain:{
					required:'域名不能为空',
					domainFormat:'个性化域名请使用长度为4～20个字符的数字或者字母',
					remote:'域名已经存在，请更换。'
				}
			}
		})
		//用户修改昵称验证
		jQuery.validator.addMethod("userNameFormat", function(value) {  
			return (/^[a-zA-Z0-9_\-\u4E00-\u9FA5]{4,24}$/.test(value));
		});
		$(".form_username").validate({
			onkeyup:false,
			submitHandler:function(form){
				var submit=$(form).find('.btn .W_btn_a span');
				submit.prepend($('<i/>',{class:'ico_loading'}));
				var username=$("[name=username]").val();
				$.ajax({
					type:'post',
					url:site_url+'set/username/',
					dataType:'json',
					data:{username:username},
					success:function(data){
						if(data.status==1){
							submit.tips({
								text:'设置成功',
								callback_handler:function(){
									window.location.reload();
								}
							});
							submit.find('i').fadeOut();
						}
					}
				})
			},
			errorPlacement: function(error, element) {
				element.parents('.info_item').find('.tips').append(error).find('.S_txt2').remove();
				element.parents('.info_item').find('.tips').find('i').removeClass().addClass('icon_rederrorS');
			},
			success: function(element) {
				element.parents('.info_item').find('.tips').find('i').removeClass().addClass('icon_succ');
			},
			rules:{
				username:{
					required:true,
					userNameFormat:true,
					remote: {
					    url : site_url+'set/username_exist/',	//后台处理程序
					    type: "post",               			//数据发送方式 
					    data: {                     			//要传递的数据
					    	account: function() {
					    		return $("[name=username]").val();
					    	}
					    }
					}
				}
			},
			messages:{
				username:{
					required:'用户昵称不能为空',
					userNameFormat:'个性化域名请使用长度为4～20个字符的数字或者字母',
					remote:'用户昵称已经存在，请更换。'
				}
			}
		})
		//用户修改密码验证
		$(".form_passwd").validate({
			onkeyup:false,
			debug:true,
			submitHandler:function(form){
				var submit=$(form).find('.btn .W_btn_a span');
				submit.prepend($('<i/>',{class:'ico_loading'}));
				var passwd=$("[name=passwd]").val();
				$.ajax({
					type:'post',
					url:site_url+'set/passwd/',
					dataType:'json',
					data:$('form').serialize(),
					success:function(data){
						if(data.status==1){
							submit.tips({
								text:'设置成功',
								callback_handler:function(){
									window.location.reload();
								}
							});
							submit.find('i').fadeOut();
						}
					}
				})
			},
			errorPlacement: function(error, element) {
				element.parents('.info_item').find('.tips').append(error).find('.S_txt2').remove();
				element.parents('.info_item').find('.tips').find('i').removeClass().addClass('icon_rederrorS');
			},
			success: function(element) {
				element.parents('.info_item').find('.tips').find('i').removeClass().addClass('icon_succ');
			},
			rules:{
				passwd:{
					required:true,
					remote: {
					    url : site_url+'set/auth_passwd/',	//后台处理程序
					    type: "post",               			//数据发送方式 
					    data: {                     			//要传递的数据
					    	account: function() {
					    		return $("[name=passwd]").val();
					    	}
					    }
					}
				},
				newPasswd:{
					required:true,
					rangelength:[6,16]
				},
				rePasswd:{
					required:true,
					rangelength:[6,16],
					equalTo:"#newPasswd"
				}
			},
			messages:{
				passwd:{
					required:'请输入当前密码',
					remote:'当前密码错误'
				},
				newPasswd:{
					required:'请设置密码',
					rangelength:'密码长度为6-16位'
				},
				rePasswd:{
					required:'请输入确认密码',
					rangelength:'密码长度为6-16位',
					equalTo:'两次密码不一致'
				}
			}
		})
		/**
		 * 地区
		 */
		 $.cxSelect.defaults.url=site_url+"assets/js/city.min.js";
		 $("#city").cxSelect({
		 	selects:["province","city"]
		 });
		//用户个人资料修改
		$("#save_info").on('click',function(){
			var self=$(this);
			self.find('span').prepend($('<i/>',{class:'ico_loading'}));
			$.ajax({
				type:'post',
				url:site_url+'set/info/',
				dataType:'json',
				data:$('.form_info').serialize(),
				success:function(data){
					if(data.status==1){
						self.tips({
							text:'设置成功',
							callback_handler:function(){
								window.location.reload();
							}
						});
						self.find('i').fadeOut();
					}
				}
			})
		})
		//
	}
	/**
	* 修改用户头像
	*/
	if($('body.avatar').length==1){
		$('#avatar_upload').uploadify({
			'buttonImage' : site_url+'assets/images/upload.png',
			'buttonText' : '选择上传',
			'swf'      : site_url+'assets/js/Uploadify/uploadify.swf',
			'uploader' : site_url+'avatar/upload/',
			'width':'82',
			'fileTypeExts' : '*.gif; *.jpg; *.jpeg; *.png',
			'fileSizeLimit':'5120',
			'onUploadStart':function(){
				$('.ico_loading_upload').show();
			},
			'onUploadSuccess' : function(file,data) {
				if(data=='error')return;
				$('.ico_loading_upload').hide();
				$('.submit').show();
				$('.preview').find('img').attr('src',site_url+data);
			$('[name=sImg]').val(data);//表单input元素隐藏图片地址
			//对图像进行js裁切
			$('#img_300').Jcrop({
				onChange: updatePreview,
				onSelect: updatePreview,
				aspectRatio:1,
				boxWidth:300,
				boxHeight:300,
				bgColor:'white'
			},function(){
				jcrop_api = this;
					dim = jcrop_api.getBounds();//利用api获取图片实际宽度、高度。
					dims = jcrop_api.getWidgetSize();//利用api获取图片在画布中的宽度、高度。
					sizeRatio=jcrop_api.getScaleFactor();//图片缩放比例
					$s=180*sizeRatio[0];//选框大小
					if(dim[0]<$s)$s=dim[0];
					if(dim[1]<$s)$s=dim[1];
					jcrop_api.setSelect(getCoord());//设置初始化时选框
					$('.jcrop-holder').css({'left':(300-dims[0])/2,'top':(300-dims[1])/2});//让上传的图片居中显示
				})
				function getCoord(){//获取初始化是选框坐标
					x1=(dim[0]-$s)/2;
					y1=(dim[1]-$s)/2;
					x2=(dim[0]-$s)/2+$s;
					y2=(dim[1]-$s)/2+$s;
					return [x1,y1,x2,y2];
				}
				function updatePreview(c){
					$('#x').val(c.x);
					$('#y').val(c.y);
					$('#w').val(c.w);
					$('#h').val(c.h);
					var arr=[180,50,30];//图像大小
					for (var i = 0; i < arr.length; i++) {
						var rx=arr[i]/c.w;
						$('#img_'+arr[i]).css({//改变图片宽、高等样式
							width:Math.round(dim[0]*rx),
							height:Math.round(dim[1]*rx),
							left:'-'+ Math.round(c.x*rx) +'px',
							top:'-'+ Math.round(c.y*rx) +'px',
						})
					}
				}
			}
		})
}
	//保存头像按钮事件
	$("[action='save_avatar']").on('click',function(){
		$(this).modal({
			type:'center M_confirm',
			top:'100',
			content:'<p><i class="icon_warnM"></i>稍等，头像保存中。</p>',
			btn:''
		})
		$.ajax({
			type:'post',
			url:site_url+'avatar/save/',
			dataType:'json',
			data:$("form").serialize(),
			success:function(data){
				if(data.status==1){
					$('.W_layer').remove();
					$(window).tips({
						type:'center',
						callback_handler:function(){
							location.href=site_url+'home';
						}
					});
				}else{
					console.log(data.status);
				}
			}
		})
	})
	/**
	* 微博评论
	*/
	$(".weibo_list").on('click','.comment .icon_close',function(){
		$(this).parents('.W_tips').remove();
	})
	$(".weibo_list").on('click',"[action-type='comment']",function(event,source){
		//每次请求显示最大条数
		var source= arguments[1] ? arguments[1] : 'item';
		var limit = source=='item'?10:20;

		var self=$(this);
		var comment=self.parents('.item').find('.comment');
		// 点击时如果有数据就移除
		if(!comment.find('.WB_arrow').is(':only-child')) {
			comment.find('.WB_arrow').nextAll().remove();
			comment.hide();
			return;
		}
		/**
		* 显示微博列表
		*/
		comment.show().append('<div class="W_loading"><i class="ico_loading"></i><span>正在加载，请稍候...</span></div>');
		var id=self.parents('.item').data('id');
		$.ajax({
			url:site_url+'single_weibo/select_comment/' + source,
			type:'post',
			dataType:'json',
			data:{id:id},
			success:function(data){
				var id = new Date().getTime();
				if(data.status==1){
					comment.find('.W_loading').remove();
					//评论框加载
					var title='\
					<div class="W_tips tips_warn clearfix">\
					<p>\
					<span class="icon_warnS"></span>\
					<span class="txt">新浪微博社区管理中心举报处理大厅，<a href="#">欢迎查阅！</a></span>\
					<span class="close right"><a href="javascript:void(0);" class="W_ico12 icon_close"></a></span>\
					</p>\
					</div>\
					<textarea name="" id="'+ id +'" class="W_input"></textarea>\
					<p class="clearfix"><a href="javascript:void(0)" action-type="face" action-id="'+ id +'"><i class="W_ico16 ico_faces"></i></a><input type="checkbox" name="" class="W_checkbox">同时转发到我的微博<a href="javascript:void(0)" class="W_btn_a right" action-type="post"><span class="btn_30px W_f14">评论</span></a></p>';
					$(title).appendTo(comment);
					//显示数据库评论总条数
					if(!data.count){
						self.text('评论(0)');
						return;
					}
					self.text('评论('+(parseInt(data.count))+')');
					//遍历评论加载
					$(data.result).each(function(i){
						var _comment=data.result[i];
						if(_comment['me']){
							del='<a href="javascript:void(0);" action-type="delete" data-cid=' + _comment['id'] +' class="hover">删除</a><i class="S_txt3 hover">|</i>';
						}else{
							del='';
						}
						item='\
						<div class="C_item S_line1">\
						<div class="face left">\
						<a href="'+ _comment['domain'] +'"><img src="'+ _comment['avatar'] +'" width="30" height="30" alt=""></a>\
						</div>\
						<div class="C_detail">\
						<p><a href="'+ _comment['domain'] +'" class="username">'+ _comment['username'] +'</a>：'+ _comment['content'] +'<span class="S_txt2">('+ _comment['time'] +')</span></p>\
						<p class="info">'+ del +'<a href="#"><i class="W_ico20 icon_praised_b"></i></a><i class="S_txt3">|</i><a href="javascript:void(0)" action-type="reply" data-cid=' + _comment['id'] + '>回复</a></p>\
						</div>\
						</div>\
						';
						$(item).appendTo(comment);
					})
					//显示后面还有多少条记录
					if(data.count-limit>0){
						var url=site_url+data.url;
						var remainder=data.count-10;
						var more='\
						<p class="more S_line1">\
						后面还有'+ remainder +'条评论，<a href="'+ url +'">点击查看<span class="CH">&gt;&gt;</span></a>\
						</p>\
						';
						$(more).appendTo(comment)
					}
					//文本框自适应高度
					if(source='item') comment.find('textarea').autosize();
				}
			}
		})
		//
	})
	/**	
	* 删除评论事件
	*/
	$('.weibo_list').on('click',".C_item [action-type='delete']",function(){
		var self=$(this);
		var cid=$(this).data('cid');
		$.post(site_url+'single_weibo/del_comment',{cid:cid},function(data){
			if(data.status==1){
				//评论-1
				var comment_count=self.parents('.detail').find("[action-type='comment']");
				num=/\d+/.exec(comment_count.text());
				comment_count.text('评论('+(parseInt(num)-1)+')');

				self.parents('.C_item').fadeOut(function(){
					$(this).remove();
				})
			}
		},'json');
	})
	//评论回复事件
	$('.weibo_list').on('click',".C_item [action-type='reply']",function(){
		if(!$(this).parent('.info').is(':last-child')){
			$(this).parent('.info').nextAll('.repeat').remove();
			return;
		}
		var cid=$(this).data('cid');
		// 文本框id
		var id = new Date().getTime();
		var username=$(this).parents('.C_detail').find('.username').text();
		var replay='\
		<div class="repeat S_line1 S_bg1" data-cid="'+ cid +'">\
		<div class="WB_arrow"><em class="S_line1_c">◆</em><span class=" S_bg1_c">◆</span></div>\
		<div class="S_line1 input clearfix">\
		<textarea name="" id="'+id+'" class="W_input" cols="30" rows="10"></textarea>\
		<p class="clearfix">\
		<span class="left"><a href="javascript:void(0)" action-type="face" action-id="'+ id +'"><i class="W_ico16 ico_faces"></i></a><input type="checkbox" name="" class="W_checkbox"> 同时转发到我的微博</span>\
		<a href="javascript:void(0)" class="W_btn_a right" action-type="doReply"><span class="btn_30px W_f14">评论</span></a>\
		</p>\
		</div>\
		</div>\
		';
		$(replay).insertAfter($(this).parent('.info'));
		//文本框自适应高度
		$(this).parents('.C_detail').find('textarea').focus().val('回复@'+ username +':').autosize();
	})
	//评论提交按钮
	$('.weibo_list').on('click',"[action-type='post'],[action-type='doReply']",function(){
		var self=$(this);
		var wid=self.parents('.item').data('id');
		textarea=self.parent('p').prev('textarea');
		var content=textarea.val();
		var count=getMessageLength(content);
		// 评论为空提示
		if($.trim(content)=='' || count>140){
			if($.trim(content)==''){
				text="写点东西吧，评论内容不能为空哦。";
			}else{
				text="评论内容在140字以内";
			}
			$(window).modal({
				type:'center M_confirm',
				title:'提示',
				content:'<p><i class="icon_warnM"></i>'+ text +'</p>',
				btn:'<p class="btn"><a class="W_btn_a ok"><span class="btn_30px W_f14">确定</span></a></p>',
				ok_handler:function(){
					textarea.focus();
				}
			});
			return;
		}
		var isreplay=self.parents('.repeat').data('cid');
		$.ajax({
			url:site_url+'single_weibo/send_comment/',
			type:'post',
			dataType:'json',
			data:{wid:wid,content:content,isreplay:isreplay},
			success:function(data){
				if(data.status==1){
					//评论+1
					var comment_count=self.parents('.detail').find("[action-type='comment']");
					num=/\d+/.exec(comment_count.text());
					comment_count.text('评论('+(parseInt(num)+1)+')');
					//清空文本框值
					textarea.val('');
					
					// 添加评论到评论列表
					var content='';
					var _comment='\
					<div class="C_item S_line1">\
					<div class="face left">\
					<a href="'+user.domain +'"><img src="'+ user.avatar +'" width="30" height="30" alt=""></a>\
					</div>\
					<div class="C_detail">\
					<p><a href="'+ user.domain +'" class="username">'+ user.name +'</a>：'+ data.content +'<span class="S_txt2">('+ data.time +')</span></p>\
					<p class="info"><a href="javascript:void(0);" action-type="delete" data-cid=' + data.id +'>删除</a><i class="S_txt3 hover">|</i><a href="#"><i class="W_ico20 icon_praised_b"></i></a><i class="S_txt3">|</i><a href="javascript:void(0)" action-type="reply" data-cid=' + 1 + '>回复</a></p>\
					</div>\
					</div>\
					';
					$(_comment).insertAfter(self.parents('.comment').children('p').first());
					//如果为回复则删除回复节点
					self.parents('.repeat').remove();
					self.tips({
						type:'center',
						text:'评论发表成功',
						callback_handler:function(){

						}
					});
				}
			}
		})
		//
	})
	/**
	* 微博转发
	*/
	$('.weibo_list').on('click',"[action-type='turn']",function(){
		var self=$(this);
		var id = new Date().getTime();
		var weibo=self.parents('.item');
		var wid=weibo.data('id');
		var username=weibo.find('.name').eq(0).text();
		var href=weibo.find('.name').eq(0).attr('href');
		var weibo_content=weibo.find('.content').eq(0).html();
		var content='\
		<div class="forward_content" data-wid='+ wid +'><a class="S_func1" href="'+ href +'" target="_top">@'+ username +'</a>'+ weibo_content +'</div>\
		<textarea name="content" class="W_input" id='+ id +' cols="30" rows="10"></textarea>\
		<p class="clearfix"><a href="javascript:void(0)" action-type="face" action-id="'+ id +'"><i class="W_ico16 ico_faces"></i></a><input type="checkbox" name="" class="W_checkbox">同时评论给'+ username +'<a href="javascript:void(0)" class="W_btn_a right" action-type="turn_submit"><span class="btn_30px W_f14">转发</span></a></p>\
		';
		self.modal({
			title:'转发微博',
			type:'center turn_weibo',
			content:content,
			btn:''
		})
	})
	// 转发按钮提交事件
	$('body').on('click',"[action-type='turn_submit']",function(){
		var self=$(this);
		var turn=self.parents('.turn_weibo');
		var content=$.trim(turn.find("[name='content']").val());
		if(content=='') content="转发微博";
		var isturn=turn.find('.forward_content').data('wid');
		$.post(site_url+'single_weibo/turn',{isturn:isturn,content:content},function(data){
			if(data.status==1){
				// 添加转发到列表
				if($('.W_chat_stat').length==0){
					$('.weibo_list').find('.notes').remove();
					//微博总数+1
					$('#my_weibo').html(+$('#my_weibo').html()+1);
					//转发数+1
					var original_weibo=$('[data-id='+isturn+']');
					var forward_count=original_weibo.find("[action-type='turn']");
					num=/\d+/.exec(forward_count.text());
					forward_count.text('转发('+(parseInt(num)+1)+')');

					//转发的微博内容
					var _weibo=original_weibo.find('.detail').clone();
					var WB_arrow='\
					<div class="WB_arrow">\
					<em class="S_line1_c">◆</em>\
					<span class="S_bg1_c">◆</span>\
					</div>\
					';
					_weibo.attr('class','forwardContent');
					_weibo.prepend($(WB_arrow));
					_weibo.find('.comment').remove();
					_weibo.find('.forwardContent').remove();
					_weibo.find('.name').text('@'+_weibo.find('.name').text());
					_weibo.find('.func').find('a').not(':has(s)').addClass('S_func2');
					//转发、评论按钮链接到该微博单条页面
					_weibo.find("[action-type='collect']").next('i').andSelf().remove();
					_weibo.find("[action-type='comment']").attr('href',site_url+'single_weibo/'+data._wid);
					_weibo.find('.handle').find('a').removeAttr('action-type');

					$(weibo).prependTo('.weibo_list').fadeOut();

					var _item=$('.item:hidden');
					_item.data('id',data.id);
					_item.find('.content').html(data.content);
					//插入转发微博内容
					_item.find('.content').after(_weibo);
					_item.find('.time').html(data.time);
					_item.fadeIn();
				}
				// 关闭转发提示框架
				turn.fadeOut(100,function(){
					$(this).remove();
					$('body').tips({
						type:'center',
						text:'转发成功'
					})
				})
			}
		},'json');
		//
	})
	/**
	* 微博收藏
	*/
	$('.weibo_list').on('click',"[action-type='collect']",function(){
		var self=$(this);
		var id=self.parents('.item').data('id');
		$.post(site_url+'single_weibo/collect',{id:id},function(data){
			if(data.status==1){
				self.tips({text:'收藏成功'});
				self.text('取消收藏');
				self.attr('action-type','del_collect');
			}
		},'json')
	})
	// 取消收藏
	$('.weibo_list').on('click',"[action-type='del_collect']",function(){
		var self=$(this);
		var id=self.parents('.item').data('id');
		self.modal({
			v_type:0,
			content:'<p><i class="icon_warn"></i>确定要取消收藏么？</p>',
			ok_handler:function(){
				$.post(site_url+'single_weibo/del_collect',{id:id},function(data){
					if(data.status==1){
						self.tips({v_type:0,text:'取消成功'});
						self.attr('action-type','collect');
						self.text('收藏');
					}
				},'json')
			}
		})
		
	})
	/**
	* 微博点赞
	*/
	$('.weibo_list').on('click',"[action-type='praise']",function(){
		var self=$(this);
		var id=self.parents('.item').data('id');
		if(!self.hasClass('active')){
			//点赞
			$.post(site_url+'single_weibo/praise',{id:id},function(data){
				if(data.status==1){
					self.addClass('active').find('s').addClass('icon_praised_bc');
				}
			},'json')
		}else{
			//取消赞
			$.post(site_url+'single_weibo/del_praise',{id:id},function(data){
				if(data.status==1){
					self.removeClass().find('s').removeClass('icon_praised_bc');
				}
			},'json')
		}
	})
	/**
	* 发出的评论页删除评论
	*/
	$('.comment_list').on('click',"[action-type='delete']",function(){
		var self=$(this);
		var cid=$(this).data('cid');
		$.post(site_url+'single_weibo/del_comment',{cid:cid},function(data){
			if(data.status==1){
				self.parents('.item').fadeOut(function(){
					$(this).remove();
				})
			}
		},'json');
	})
	/**
	 * 私信
	 */
	 $("[action-type='conversation']").on('click',function(e){
	 	// 阻止冒泡
	 	e.stopPropagation();

	 	var self=$(this);
	 	var data=self.attr('action-data');
	 	if(data){
	 		var user=getArgs(data);
	 		username=user.username;
	 	}else{
	 		username='';
	 	}
	 	var id = new Date().getTime();
	 	var form='<div class="form_private clearfix">\
	 	<form>\
	 	<div class="clearfix">\
	 	<div class="tit">发给：</div>\
	 	<div class="inp"><input class="text" type="text" name="username" value="'+ username+'" required></div>\
	 	</div>\
	 	<div class="clearfix">\
	 	<div class="tit">内容：</div>\
	 	<div class="inp">\
	 	<textarea name="letter_content" id="'+ id +'" required></textarea>\
	 	<div><a href="javascript:void(0)" action-type="face" action-id="'+ id +'"><i class="W_ico16 ico_faces"></i></a></div>\
	 	</div>\
	 	</div>\
	 	</form>\
	 	</div>\
	 	';
	 	var btn='<p><a action-data="'+ data +'" action-type="submit_letter" href="javascript:void(0)" class="W_btn_b"><span class="btn_30px W_f14"><em node-type="btnText">发送</em></span></a></p>';
	 	self.modal({
	 		type:'center W_private_letter',
	 		title:'发私信',
	 		content:form,
	 		btn:btn
	 	})
	 	$('.W_private_letter').drag({drag:'.title'});
	 })
	 //发送私信按钮
	 $('body').on('click',"[action-type='submit_letter']",function(){
	 	// 判断非空
	 	var username=$("[name='username']");
	 	var content=$("[name='letter_content']");
	 	var arr = [username,content];
	 	for (var i = 0; i<arr.length; i++) {
	 		if(arr[i].val()==''){
	 			arr[i].addClass('empty');
	 			setTimeout(function(){
	 				arr[i].removeClass('empty');
	 			},800)
	 			return;
	 		}
	 	};

	 	var self=$(this);
	 	var data=self.attr('action-data');
	 	if(data){
	 		var user=getArgs(data);
	 		var uid=user.uid;
	 	}else{
	 		var uid='';
	 	}
	 	$.post(site_url+'u/send_letter',{username:username.val(),content:content.val(),uid:uid},function(data){
	 		if(data.status==1){
	 			$('.W_private_letter').remove();
	 			$('body').tips({
	 				type:'center',
	 				text:'发送成功',
	 				callback_handler:function(){
	 					if((self.hasClass('conversation'))) window.location.reload();
	 				}
	 			});
	 		}
	 	},'json')
	 })
	/**
	 * 个人主页添加关注按钮
	 */
	 $('.info').on('click',"[action-type='add_follow']",function(){
	 	var self=$(this);
	 	var follow_id=self.attr('uid');
	 	var username=self.attr('username');
	 	$.post(site_url+'u/follow',{follow_id:follow_id},function(data){
	 		if(data.status==1){
	 			self.tips();
	 			//关注数+1
	 			$('#my_fans').html(+$('#my_fans').html()+1);
	 			var relation=self.attr('relation');
	 			var text,_rela;
	 			if(relation==0){
	 				//已关注
	 				text='已关注';
	 				_rela=1;
	 				ico='icon_addone';
	 			}else{
	 				//相互关注
	 				text='互相关注';
	 				_rela=3;
	 				ico='icon_addtwo';
	 			}
	 			var _relation='<div class="W_btn_c">\
	 			<span>\
	 			<em class="W_ico12 '+ ico +'"></em>'+ text +'<em class="W_vline S_txt2">|</em>\
	 			<a class="S_link2" relation="'+ _rela +'" action-type="cancle_follow" uid="'+ follow_id +'" username="'+ username +'" href="javascript:void(0);">取消</a>\
	 			</span>\
	 			</div>';
	 			self.replaceWith(_relation);
	 		}
	 	},'json')
	 })
	/**
	 * 个人主页取消关注按钮
	 */
	 $('.info').on('click',"[action-type='cancle_follow']",function(){
	 	var self=$(this);
	 	var follow_id=self.attr('uid');
	 	var username=self.attr('username');
	 	$(this).modal({
	 		v_type:0,
	 		content:'<p><i class="icon_warn"></i>确认要取消对'+username+'的关注吗</p>',
	 		ok_handler:function(){
				// 移除确认对话框
				$('.set_template').fadeOut('fast',function(){
					$(this).remove();
					$('.W_mask:last').remove();
				})
				$.post(site_url+'u/cancle_follow',{follow_id:follow_id},function(data){
					if(data.status==1){
						var relation=self.attr('relation');
						var _rela=relation==1?0:2;

						$('#my_fans').html(+$('#my_fans').html()-1);
						var _relation='<a uid="'+ follow_id +'" username="'+ username +'" relation="'+ _rela +'" action-type="add_follow" source="weibo" href="javascript:void(0)" class="add_follow W_btn_b"><span><em class="addicon">+</em>关注</span></a>';
						self.parents('.W_btn_c').replaceWith(_relation);
					}
				},'json')
			}
		})
	 })
	/**
	 * 单条微博页面js
	 */
	 if($('body.single_weibo').length==1){
	 	$('.core_nav').find('li.current').removeClass();
	 	$('.core_nav').find("li:contains('微博')").addClass('current');

	 	$("[action-type='comment']").trigger('click',['weibo']);
	 }
	 /**
	  * 私信页面js
	  */
	  $('body.letter').find('.item').on('click',function(){
	  	var url=$(this).attr('href');
	  	window.location.href = url;
	  })
	  $('.send_private_msgbox textarea').on('focus',function(){
	  	$(this).css('height',70).next('p').show();
	  })
  	/**
    * 异步轮询取得用户消息通知
    */
    get_msg();
    /**
     * 主页点击加载最新微博
     */
     $('.weibo_list').on('click',"[action-type='load_news']",function(){
     	var self=$(this);
     	var offset=self.find('span').text();
     	//loading
     	self.replaceWith('<div class="W_loading"><i class="ico_loading"></i><span>正在加载，请稍候...</span></div>');
     	//页面加载时间，求时间差
     	var time=$('.weibo_list').attr('load-time');
     	$.post(site_url+'index/select',{offset:offset,time:time},function(data){
     		if(data.status==1){
     			//清空消息提醒
     			$.post(site_url+'common/flush_news');
     			//取得返回数据
     			var weibo_list=data.weibo_list;
     			var forward_list=data.forward_list;
     			var time=data._time;
     			var item=f_weibo(weibo_list,forward_list);
     			//移除之前的时间线
     			$('fieldset.between_line').remove();
     			$('.weibo_new').removeClass('weibo_new');
     			//时间分割线
     			item+='<fieldset class="S_line2 between_line" node-type="feed_list_timeTip">\
     			<legend class="S_txt3" node-type="feed_list_timeText">'+ time +'，你看到这里</legend>\
     			</fieldset>\
     			';
     			//隐藏提示
     			$('.weibo_list').children('.notes').remove();
     			$('.weibo_list').children('.W_loading').remove();
     			$('.global_nav').find('.W_new').hide();

     			$(item).prependTo($('.weibo_list'));
     		}
		//
	},'json')
		//
	})
	/**
	* 返回顶部
	*/
	$(document).scroll(function(){
		if($(this).scrollTop()>300){
			$('.gotop').fadeIn();
		}else{
			$('.gotop').fadeOut();
		}
	})
	$('.gotop').on('click',function(){
		$(document).scrollTop(0);
		$(this).hide();
	})
})