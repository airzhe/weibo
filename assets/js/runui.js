/**	
 *==============================
 * 微博表情弹出框插件
 * 通过冒泡时间实现点击文档关闭弹出框
 *==============================
 */
 (function($){
 	$.fn.extend({
 		"callface": function(){
 			$('.hotFace').remove();
			//获取对象的坐标，并设置提示框坐标
			var _h=$(this).height();
			var _x=$(this).offset().left;
			var _y=$(this).offset().top+_h+6;
			// 获取要输入内容的文本框的id;
			var textarea_id;
			if($(this).attr('action-id')){
				textarea_id=$(this).attr('action-id');
			}else{
				// var input_detail=$(this).closest('p').prev('textarea');
				// if(!input_detail.attr('id') || input_detail.attr('id')==''){
				// 	var time=new Date();
				// 	input_detail.attr('id',time.getTime());
				// }
				// textarea_id=input_detail.attr('id');
			}
			//创建提示框，显示后移除。
			var face='';
			face+='<div class="hotFace W_layer" action-id='+ textarea_id +'>';
			face+='<div class="bg">';
			face+='<div class="wrap">';
			face+='<div class="content">';
			face+='<ul class="profile_tab S_line1 clearfix ">';
			face+='<li class="current S_line1"><a href="#">常用表情</a></li><li class="S_line1"><a href="#">魔法表情</a></li>';
			face+='</ul>';
			face+='<ul class="tab_nosep clearfix">';
			face+='<li class="current"><a href="#">默认</a></li><li><a href="#">浪小花</a></li><li><a href="#">暴走漫画</a></li><li><a href="#">小恐龙</a></li><li><a href="#">圣诞新年</a></li>';
			face+='</ul>';	
			face+='</div>';
			face+='<ul class="faces_list clearfix">';
			face+='</ul>';
			face+='<a class="W_close" href="javascript:void(0);" title="关闭"></a>';
			face+='</div>';
			face+='</div>';
			face+='<div class="arrow"></div>';
			face+='</div>';
			$('body').append(face);
			var hot_face=$('.hotFace');
			hot_face.css({left:_x,top:_y});
			close_btn=hot_face.find('.W_close');
			//关闭弹出框按钮
			close_btn.on('click',function(){
				hot_face.remove();
			})
			//阻止冒泡
			hot_face.find('.content').on('click',function(e){
				e.stopPropagation();
			})
			//点击关闭窗口
			$(document).on('click',function(){
				close_btn.trigger('click');
			})
		}	
	})
})(jQuery);
/**	
 *===============
 * 移动层插件
 *===============
 */
 $.fn.extend({
 	drag:function(options){
		//默认配置
		var _default={drag:'.drag'}
		var opt = $.extend(_default, options);
		//
		var self=$(this);
		var title=self.find(opt.drag);
		//更改标题样式为小手
		title.css({'cursor':'move','user-select':'none'});
		/* 绑定鼠标左键按住事件 */
		title.on('mousedown',function(e){
			/* 获取需要拖动节点的left、top */
		var o_d_l=self.offset().left;//left
		var o_d_t=self.offset().top;//top
		/* 获取当前鼠标的坐标 */
		var o_m_l=e.pageX;
		var o_m_t=e.pageY;
		/* 绑定拖动事件 */
		/* 由于拖动时，可能鼠标会移出元素，所以应该使用全局（document）元素 */
		$(document).on('mousemove',function(e){
			/* 获取当前鼠标的坐标 */
			var n_m_l=e.pageX;
			var n_m_t=e.pageY;
			/* 计算鼠标移动了的位置 */
			var d_l=n_m_l-o_m_l;
			var d_t=n_m_t-o_m_t;
			/* 设置移动后的元素坐标 */
			self.offset({left:o_d_l + d_l,top:o_d_t + d_t});
		})
		/* 当鼠标左键松开，解除事件绑定 */
		$(document).on('mouseup',function(){
			$(this).off('mousemove');
		})
	})
	}
});



/**	
 *===============
 * mask遮照层
 *===============
 */
 $.extend({
 	"mask":function(){
 		$('body').append('<div class="W_mask"></div>');
 		$('.W_mask').width($(document).width()).height($(document).height());
 	}
 })

/**	
 *===================
 * 新信息提示插件
 * obj参数为json对象
 * 如：$a={0:9,1:9,2:9};
 *===================
 */
 $.extend({
 	'msg':function(obj){
 		var msg_tips=$('.gn_tips');
 		msg_tips.show();
 		for(var key in obj){
 			switch(key)
 			{
 				case '0':
 				msg_tips.find('._comment').show().find('span').html(obj[key]);
 				break;
 				case '1':
 				msg_tips.find('._letter').show().find('span').html(obj[key]);
 				break;
 				case '2':
 				msg_tips.find('._atme').show().find('span').html(obj[key]);
 				break;
 			}
 		}
 	}
 })


//获得对象在页面中心的位置
function get_pos(obj,top){
	//位置
	var pos = [];
	//获取当前窗口距离页面顶部高度 
	var scrolltop = $(document).scrollTop();
	pos[0] = ($(window).width() - obj.width()) / 2;
	pos[1] =top?top + scrolltop:($(window).height() - obj.height()) / 2 + scrolltop + 50;
	return pos;
}

/**
 *=================================
 * 提示框（用于提示操作成功，或操作失败）
 * 位置位于点击按钮的附近位置。
 * 动画展示，默认1秒后移除提示框,可用来替代js默认的alert
 * v_type （0,提示在对象上方。1,提示挡住对象）
 *================================= 
 */

 $.fn.extend({
 	"tips": function(options){
 		var _default = {
 			type:'',
 			text:'操作成功!',
 			v_type:1,
 			timeout:1,
 		};
 		var opt = $.extend(_default, options);
 		$('.W_layer.tips').remove();

		//创建提示框，显示后移除。
		var _class='W_layer tips '+opt.type;
		
		var _ico=opt.type?'icon_error':'icon_succ';
		var _html='<div class="bg"><div class="wrap"><div class="content"><p><i class="'+_ico+'"></i>'+opt.text+'</p></div></div></div>'
		$('body').append($('<div/>',{class:_class,html:_html}));

		var tips=$('.W_layer.tips');
		//获取对象的坐标，并设置提示框坐标
		if(opt.type!='center'){
			var _w=$(this).width();
			var _h=$(this).height();
			var _offsetY=opt.v_type?(54-_h)/2:58;
			var _x=$(this).offset().left-((128-_w)/2);
			var _y=$(this).offset().top-_offsetY;
		}else{
			$.mask();
			var pos=get_pos(tips);
			var _x= pos[0];
			var _y=pos[1];
		}

		tips.offset({top:_y,left:_x});;
		tips.children('.bg').animate({top:0}).delay(opt.timeout*1000).animate({top:54},function(){
			$(this).parent().remove();
			if(opt.type=='center'){
				tips.remove();
			}
		});
	}
})


/**	
 *===============
 * modal弹出框插件
 *===============
 */

 $.fn.extend({
 	"modal": function (options) {
 		var _default = {
 			//显示类型，center为在屏幕中心显示
 			type:'',
 			//（0,提示在对象上方。1,提示在对象下方）
 			v_type:1,
 			//距离顶部多少像素
 			top:'',
 			title: '', 
 			content: '<p><i class="icon_ask"></i>确认要删除这条微博吗？</p>', 
 			btn: '<p><a class="W_btn_a"><span class="btn_30px W_f14">确定</span></a> <a class="W_btn_b close"><span class="btn_30px W_f14">取消</span></a></p>',
 			close_handler: function () {}
 		};
 		var opt = $.extend(_default, options);

 		$("div.modal").remove();

			//创建提示框，显示后移除。
			var _class='W_layer modal '+opt.type;
			var _html='<div class="bg"><div class="title">'+opt.title+'</div><div class="wrap"><div class="content">'+opt.content+opt.btn+'</div></div></div>'
			$('body').append($('<div/>',{class:_class,html:_html}));

			//设置弹出框样式
			var modal=$('div.modal');

			//回调函数
			
			//关闭弹出框
			var close_btn=modal.find('.close'); 
			close_btn.on('click',function(){
				// 关闭时回调函数
				opt.close_handler();
				modal.fadeOut('fast',function(){
					$(this).remove();
					if(opt.type=='center'){
						$('.W_mask').remove();
					}
				})
			})
			// //关闭的方式
			// if(opt.c_type==0){
			// 	$(document).on('keydown',function(e){
			// 		if(e.which===27)
			// 			close_btn.trigger('click');
			// 	})
			// }
			position(this);
		//设置弹出框的位置
		function position(self){
			if(opt.type!='center'){
				var _w=$(self).width();
				var _h=$(self).height();
				var _offsetY=opt.v_type?-(_h+4):(modal.height()+4);
				var _x=$(self).offset().left-((modal.width()-_w)/2);
				var _y=$(self).offset().top-_offsetY;
			}else{
				$.mask();
				var pos=get_pos($('.W_layer'),opt.top);
				var _x= pos[0];
				var _y=pos[1];
			}
			modal.css({left: _x,top:_y});
		}
	}
});


/**	
 *===================
 * 文本框当前位置插入文字
 *===================
 */
 (function($){
 	$.fn.extend({
 		insertAtCaret: function(myValue){
 			var $t=$(this)[0];
 			if (document.selection) {
 				this.focus();
 				sel = document.selection.createRange();
 				sel.text = myValue;
 				this.focus();
 			}
 			else 
 				if ($t.selectionStart || $t.selectionStart == '0') {
 					var startPos = $t.selectionStart;
 					var endPos = $t.selectionEnd;
 					var scrollTop = $t.scrollTop;
 					$t.value = $t.value.substring(0, startPos) + myValue + $t.value.substring(endPos, $t.value.length);
 					this.focus();
 					$t.selectionStart = startPos + myValue.length;
 					$t.selectionEnd = startPos + myValue.length;
 					$t.scrollTop = scrollTop;
 				}
 				else {
 					this.value += myValue;
 					this.focus();
 				}
 			}
 		})	
 })(jQuery);
