$(document).ready(function(){
	/**
	 * 登录文本框获得焦点隐藏提示文字，失去焦点显示提示文字
	 */
	 $('.W_input').on('focus',function(){
	 	$(this).next('span').hide();
	 })
	 $('.W_input').on('blur',function(){
	 	if($(this).val()==''){
	 		$(this).next('span').show();
	 	}
	 })
	 $('.W_input+span').on('click',function(){
	 	 $(this).prev('.W_input').trigger('focus');
	 })
	/**
	 * 表单提交事件
	 */
	 $('#submit').on('click',function(){
	 	$('form').submit();
	 })
	/**
	 * 表单验证
	 */
	//文本框鼠标按下清除表单提示
	$('form').on('keydown','.form_tips+input',function(){
		$('.form_tips').remove();
	})
	/**
	 * 登录验证
	 */
	 $('form').validate({
	 	// debug:true,
		//阻止键盘按下或失去焦点时出发验证事件。
		onkeyup:false,
		onfocusout:false,
		//点击提交按钮只显示一个错误提示
		showErrors:function(errorMap,errorList) {
			//如果验证通过就返回
			if($.isEmptyObject(errorMap)){
				return;
			}
			//循环一次退出
			for(var key in errorMap){
				$('.form_tips').remove();
				_obj='[name='+key+']';
				$(_obj).form_tips({msg:errorMap[key]});
				break;
			}
		},
		 //验证通过执行函数
		 submitHandler:function(form){
		 	$('#submit').find('span').prepend($('<i/>',{class:'ico_loading'}));
		 	form.submit();
		 },
		 rules:{
		 	account:'required',
		 	passwd:'required'
		 },
		 messages:{
		 	account:'用户名不能为空',
		 	passwd:'密码不能为空'
		 }
		})
	})