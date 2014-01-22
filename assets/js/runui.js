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
 *===============
 * modal弹出框插件
 *===============
 */

 $.extend({
 	"modal": function (options) {
 		var _default = {
 			top:'',
 			width: 400, 
 			height:'',
 			title: '提示', 
 			body: '加载中...', 
 			footer: '<button>确定</button> <button>取消</button>',
 			c_type:1,
 			callback: function (){}
 		};
 		var opt = $.extend(_default, options);

 		$("div.modal").remove();

			//创建弹出框
			var div='';
			div+='<div class="modal">';
			div+='<div class="modal_title"><h2>'+ opt['title'] +'</h2><i class="close">×</i></div>';
			div+='<div class="modal_body">'+ opt['body'] +'</div>';
			if(opt.footer){
				div+='<div class="modal_footer">'+ opt['footer'] +'</div>';
			}
			div+='</div>';
			div+='<div class="modal_bg"></div>';
			$(div).appendTo("body");

			//设置弹出框和背景遮照样式
			var modal=$('div.modal');
			modal.css({width:opt['width'],height:opt['height']});
			var modal_bg=$('.modal_bg');
			//回调函数
			opt.callback(modal);
			//关闭弹出框
			var close_btn=modal.find('.close'); 
			close_btn.on('click',function(){
				modal.fadeOut('fast',function(){
					$(this).remove();
					$(".modal_bg").remove();
				})
			})
			//关闭的方式
			if(opt.c_type==0){
				$(document).on('keydown',function(e){
					if(e.which===27)
						close_btn.trigger('click');
				})
				modal_bg.on('click',function(){
					close_btn.trigger('click')
				})
			}
			position();
			//改变窗口大小触发事件
			window.onresize=function(){
				position();
			}
		//设置弹出框的位置
		function position(){
			var pos=get_pos(modal);
			modal.css(
			{
				left: pos[0],
				top: pos[1]
			});
			modal_bg.width($(document).width()).height($(document).height());
		}
		//获得对象在页面中心的位置
		function get_pos(obj){
		 var pos = [];//位置
		 pos[0] = ($(window).width() - obj.width()) / 2;
		 pos[1] = opt['top']?opt['top']:($(window).height() - obj.height()) / 2 - 50;
		 return pos;
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