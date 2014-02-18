/**	
* /获得文字长度(英文两个算一个字符，中文汉字占一个字符。)
*/
function getMessageLength (b) { 
	var a = b.match(/[^\x00-\x80]/g); 
	var l=b.length + (!a ? 0 : a.length);
	return Math.ceil(l/2); 
}
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
		// 触发textarea的keyup事件
		$('#'+obj_id).trigger('keyup');
	})
	/**	
	* 点击插入图片按钮，调出插入图片对话框
	*/
	$("[action-type='upload_image']").on('click',function(e){
		$(this).imageUpload();
		var flag=1;
		$('#image_upload').uploadify({
			'buttonImage' : site_url+'assets/images/upload.png',
			'buttonText' : '选择上传',
			'swf'      : site_url+'assets/js/Uploadify/uploadify.swf',
			'uploader' : '',
			'width':'82',
			'fileTypeExts' : '*.gif; *.jpg; *.jpeg; *.png',
			'fileSizeLimit':'5120',
			'onUploadStart':function(){
				// console.log('readyUpload');
				var _val=$('#weibo_input_detail').val();
				if (flag==1){
					$('#weibo_input_detail').val(_val+'分享图片');
					flag++;
				}
				$('.loading').show();
			},
			'onUploadSuccess' : function(file,data) {

			}
		})
	})
	/**	
	* 文本框自适应
	*/
	// $('.home .comment').find('textarea').autosize();

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
	//消息提醒
	var $a={0:2,1:6,2:8};
	$.msg($a);
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
		console.log('run....');
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
			$('.weibo_list').find('.notes').remove();
			var weibo='';
			var avatar=$('.user_info').find('img').attr('src');
			var name=$('.user_info').find('.username').text();
			weibo+='<div class="item clearfix hide" data-id> ';
			weibo+='<div class="WB_screen">';
			weibo+='<a title="删除此条微博" class="W_ico12 icon_close" action-type="weibo_delete" href="javascript:;"></a>';
			weibo+='</div>';
			weibo+='<div class="face">';
			weibo+='<img  width="50" height="50" src="' + avatar + '" alt="">';
			weibo+='</div>';
			weibo+='<div class="detail">';
			weibo+='<div><a class="name S_func1" href="#">' + name + '</a></div>';
			weibo+='<div class="content">';
			weibo+='</div>';
			weibo+='<div class="func clearfix S_txt2">';
			weibo+='<div class="from left"><a href="#" class="S_link2 time"></a> 来自<a href="" class="S_link2">新浪微博</a> </div>';
			weibo+='<div class="handle right"><a href=""><s class="W_ico20 icon_praised_b"></s>(0)</a><i class="S_txt3">|</i><a href="">转发(0)</a><i class="S_txt3">|</i><a href="">收藏</a><i class="S_txt3">|</i><a href="">评论(0)</a></div>';
			weibo+='</div>';
			weibo+='</div>';
			weibo+='</div>';
			$(weibo).prependTo('.weibo_list').fadeOut();
			var content=$('#weibo_input_detail').val();
			$.ajax({
				type:'post',
				url:site_url+'index/send',
				dataType:'json',
				data:{content:content},
				success:function(data){
					if(data.status==1){
						//微博总数+1
						$('#my_weibo').html(+$('#my_weibo').html()+1);
						//
						var _item=$('.item:hidden');
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
	// $('.forwardContent').hover(function(){
	// 	$(this).find('.time').hide();
	// },function(){

	// })
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
	$("[action-type='cancle_follow']").on('click',function(e){
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
				$.ajax({
					type:'post',
					url:site_url+'index/delete',
					dataType:'json',
					data:{id:id},
					success:function(data){
						if(data.status==1){
							item.animate({height:0,opacity:0},600,function(){
								item.remove();
							});
							$('#my_weibo').html(+$('#my_weibo').html()-1);
						}
					}
				})
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
				var offset=$('.weibo_list').data('offset');
				$.ajax({
					type:'post',
					url:site_url+'index/select',
					dataType:'json',
					data:{offset:offset},
					success:function(data){
						if(data.status==1){
							// self.find('i').remove();
							$(data.weibo_list).appendTo($('.weibo_list'));
							// 每次读取5条
							$('.weibo_list').data('offset',offset+5);
							var _offset=$('.weibo_list').data('offset');
							// 每页读取20条
							if(data.count<5 || _offset%20==0){
								// $('.PRF_feed_list_more').remove();
								$("[node-type='lazyload']").remove();
								$('#page').show();
							}else{
								// 恢复scroll事件
								$(window).on("scroll",lazyload);
							}
						}
					},
					//返回为空或为
					error:function(){
						//$('.PRF_feed_list_more').remove();
						$("[node-type='lazyload']").remove();
						$('#page').show();
					}
				})
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
		var offset=$('.weibo_list').data('offset');
		var uid=$('.user_info').attr('uid');
		$.ajax({
			type:'post',
			url:site_url+'u/index/'+uid,
			dataType:'json',
			data:{offset:offset},
			success:function(data){
				if(data.status==1){
					self.find('i').remove();
					$(data.weibo_list).appendTo($('.weibo_list'));
					// 每次读取5条
					$('.weibo_list').data('offset',offset+5);
					var _offset=$('.weibo_list').data('offset');
					console.log(_offset,data.count);
					// 每页读取20条
					if(data.count<5 || _offset%20==0){
						$('.PRF_feed_list_more').remove();
						$('#page').show();
					}
				}
			},
			//返回为空或为
			error:function(){
				$('.PRF_feed_list_more').remove();
				$('#page').show();
			}
		})
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
	$(".save_info").on('click',function(){
		$(this).parents('form').submit();
	})
	if($('body.set_info').length==1){
		jQuery.validator.addMethod("domainFormat", function(value) {  
			return (/^[a-zA-Z0-9]{4,20}$/.test(value));
		});
		$(".form_domain").validate({
			onkeyup:false,
			// debug:true,
			submitHandler:function(form){
				var submit=$(form).find('.btn .W_btn_a span');
				submit.prepend($('<i/>',{class:'ico_loading'}));
				var domain=$("[name=domain]").val();
				console.log('run....');
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
					    url : site_url+'set/check_domain/',			//后台处理程序
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