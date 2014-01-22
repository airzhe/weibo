$(document).ready(function(){
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
		console.log(obj_id);
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
		var index=$(this).index();
		var ControlPanel=$('.profile_tab').next('div');
		ControlPanel.children('div').eq(index).show().siblings('div').hide();
		$(this).addClass('current').siblings().removeClass('current');
	})
	/**
	*设置皮肤
	*/
	$('.set_skin').on('click',function(){
		$.ajax({
			url:'http://localhost/php/34.php',
			dataType:'json',
			success:function(data){
				$a=data;
				$('body').append($a);
				$('.set_template').drag({drag:'.title'});
			}
		})
	})
})