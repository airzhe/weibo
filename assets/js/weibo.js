$(document).ready(function(){
	/**	
	* 查看消息，设置时隐藏新消息提示框
	*/
	$('.global_nav  .msg,.global_nav .setting').hover(function(){
		$('.gn_tips').hide();
	},function(){
		$('.gn_tips').show();
	})
	/**	
	* 点击关闭新消息提示框
	*/
	$('.gn_tips').find('.icon_close').on('click',function(){
		$('.gn_tips').hide();
	})
	/**	
	* 点击表情按钮，调出表情对话框
	*/
	$("[action-type='face']").on('click',function(e){
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
	})
	/**	
	* 文本框自适应
	*/
	// $('.home .comment').find('textarea').autosize(); 
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
		var id=ControlPanel.data('id');
		if(ControlPanel.is(':empty')){
			$.ajax({
				url:site_url+'json/set_skin',
				type:'post',
				data:{id:id},
				success:function(data){
					ControlPanel.html(data);
					ControlPanel.find('.tab_nosep').find('li').eq(0).addClass('current');
					ControlPanel.find('ul:last').find('a').eq(0).addClass('current');
				}
			})
		}
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
				$('.set_template').find('.profile_tab').find('li').eq(0).trigger('click');
			}
		})
	})
	/**
	*点击切换套装
	*/
	$('body').on('click','.sysControlPanel .template_list a',function(){
		$('.sysControlPanel').find('.template_list').find('a').removeClass('current');
		$(this).addClass('current');
		var href=site_url+'assets/skin/template/'+$(this).data('link')+'/skin.css';
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
	})
	/**
	*点击切换封面图
	*/
	$('body').on('click','.cover_list a',function(){
		$('.cover_list').find('a').removeClass('current');
		$(this).addClass('current');
		var bg_img=site_url+'assets/images/skin/cover/'+$(this).data('link');
		console.log(bg_img);
		$('.profile_pic_top').css('background-image','url('+bg_img+')');
	})
	/**
	*点击切换样式
	*/
	$('body').on('click','.diy_list a',function(){
		var css=$(this).find('span').html();
		if(css==''){
			$(this).tips({type:'error',text:'样式不可用',timeout:1});
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
	})
	/**
	*关闭按钮
	*/
	$('body').on('click','.set_template .W_close',function(){
		$('.set_template').remove();
	})
	// text
	$('.forward').click(function(){
		$(this).modal({type:'center'});
	})
	//消息提醒
	var $a={0:2,1:6,2:8};
	$.msg($a);
})