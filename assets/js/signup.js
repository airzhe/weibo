$(document).ready(function(){
	/**
	 * 生日
	 */
	var myDate = new Date();
	$("#dateSelector").DateSelector({
		ctlYearId: 'idYear',
		ctlMonthId: 'idMonth',
		ctlDayId: 'idDay',
		defYear: myDate.getFullYear(),
		defMonth: (myDate.getMonth()+1),
		defDay: myDate.getDate(),
		minYear: 1900,
		maxYear: (myDate.getFullYear()+1)
	});

	/**
	 * 地区
	 */
	$.cxSelect.defaults.url=site_url+"assets/js/city.min.js";
	$("#city").cxSelect({
		selects:["province","city"]
	});
	/**
	 * 点击更改验证码
	 */
	$("#code,.verify_refresh").on('click',function(){
		$('#code').attr('src',site_url+'signup/code?'+Math.random());
	})
	/**
	 * 文本框获得焦点，显示提示信息
	 */
	$('[type=text],[type=password]').focus(function(){
		$(this).parents('.info_list').find('.tips').show();
	})
	$("[name^=birthday]").val('0');
	/**
	 * 表单提交事件
	 */
	$('#submit').on('click',function(){
		$('select').not(':hidden').each(function(){
			if(this.value==0){
				var tips=$(this).parent('.inp').next('.tips');
				tips.show().find('p').find('label').html('请选择');
				return false;
			}else{
				var tips=$(this).parent('.inp').next('.tips');
				tips.hide();
			}
		})
		$('form').submit();
	})
	/**
	 * 表单验证
	 */
	jQuery.validator.addMethod("userNameFormat", function(value) {  
		return (/^[a-zA-Z0-9_\-\u4E00-\u9FA5]{4,24}$/.test(value));
	});
	$('form').validate({
		onkeyup:false,
		submitHandler:function(form){
			var span=$('#submit').find('span');
			span.prepend($('<i/>',{class:'ico_loading'}));
			var padding=(span.innerWidth()-span.width())/2-8;
			span.css({'padding-left':padding,'padding-right':padding});
			console.log('ok');
			form.submit();
		},
		errorPlacement: function(error, element) {
			var p=element.parents('.info_list').find('.tips').find('p');
			p.append(error);
		},
		success: function(element) {
			var p=element.parents('.info_list').find('.tips').find('p');
			p.find('label').remove();
			p.remove('class').find('i').removeClass().addClass('icon_succ');
		},
		highlight: function(element, errorClass) {
			var tips=$(element).parents('.info_list').find('.tips');
			tips.show();
			var p=tips.find('p');
			p.find('label').remove();
			p.find('i').removeClass().addClass('icon_rederrorS');
			p.addClass('error')
		},
		rules:{
			account:{
				required:true,
				email:true,
				remote: {
				    url : site_url+'signup/account_exist',	//后台处理程序
				    type: "post",               			//数据发送方式 
				    data: {                     			//要传递的数据
				    	account: function() {
				    		return $("[name=account]").val();
				    	}
				    }
				}
			},
			passwd:{
				required:true,
				rangelength:[6,16]
			},
			username:{
				required:true,
				userNameFormat:true,
				remote: {
				    url : site_url+'signup/username_exist',	//后台处理程序
				    type: "post",               			//数据发送方式 
				    data: {                     			//要传递的数据
				    	username: function() {
				    		return $("[name=username]").val();
				    	}
				    }
				}
			},
			sex:'required',
			code:{
				required:true,
				remote: {
					    url: site_url+'signup/auth_code',	//后台处理程序
					    type: "post",               		//数据发送方式 
					    data: {                     		//要传递的数据
					    	code: function() {
					    		return $("[name=code]").val();
					    	}
					    }
					}
				}
			},
			messages:{
				account:{
					required:'请输入邮箱地址',
					email:'请输入正确的邮箱地址',
					remote:'帐号已经存在，请更换。'
				},
				passwd:{
					required:'请输入密码',
					rangelength:'请输入6-16位数字、字母或常用符号，字母区分大小写'
				},
				username:{
					required:'请输入昵称',
					userNameFormat:'请输入4-24位字符：支持中文、英文、数字、“-”、“_”',
					remote:'用户名已经存在，请更换。'
				},
				sex:'请选择性别',
				code:{
					required:'请输入验证码',
					remote:'验证码输入有误'
				}
			},
		})
})