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
				$.mask();
				$('.set_template').find('.profile_tab').find('li').eq(0).trigger('click');
			}
		})
	})
	// text
	$('.forward').click(function(){
		$(this).modal({type:'center'});
	})
})