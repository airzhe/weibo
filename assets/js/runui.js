/**	
 *===============
 * 微博表情弹出框插件
 *===============
 */
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
		face+='<ul class="faces_list clearfix">';
		face+='</ul>';
		face+='</div>';
		face+='<a class="W_close" href="javascript:void(0);" title="关闭"></a>';
		face+='</div>';
		face+='</div>';
		face+='<div class="arrow"></div>';
		face+='</div>';
		face+='<div class="face_mask"></div>';
		$('body').append(face);
		var hot_face=$('.hotFace');
		var mask=$('.face_mask');
		hot_face.css({left:_x,top:_y});
		mask.width($(document).width()).height($(document).height());
		close_btn=hot_face.find('.W_close');
		close_btn.on('click',function(){
			hot_face.remove();
			mask.remove();
		})
		mask.on('click',function(){
			close_btn.trigger('click');
		})
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