<script>
	$.fn.extend({
		"cassFaces": function(){
			$('.hotfaces').remove();
		//获取对象的坐标，并设置提示框坐标
		var _h=$(this).height();
		var _x=$(this).offset().left;
		var _y=$(this).offset().top-_h;

		//创建提示框，显示后移除。
		var faces='';
		faces+='<div class="hotfaces hide">';
		faces+='<div class="bg">';
		faces+='<div class="content">';
		faces+='<ul class="title S_line1 clearfix ">';
		faces+='<li class="current S_line1"><a href="#">常用表情</a></li><li class="S_line1"><a href="#" class="disable">魔法表情</a></li>';
		faces+='</ul>';
		faces+='<ul class="tab clearfix">';
		faces+='<li class="current"><a href="#">默认</a></li><li><a href="#">浪小花</a></li><li><a href="#">暴走漫画</a></li><li><a href="#">小恐龙</a></li><li><a href="#">圣诞新年</a></li>';
		faces+='</ul>';
		faces+='<ul class="facess_list clearfix">';
		faces+='<li text="[让红包飞]"><img src="./assets/images/hotFace/hongbaofei2014_thumb.gif" alt="让红包飞" title="让红包飞"></li><li text="[求红包]"><img src="./assets/images/hotFace/lxhhongbao2014_thumb.gif" alt="求红包" title="求红包"></li><li text="[青啤鸿运当头]"><img src="./assets/images/hotFace/hongyun_thumb.gif" alt="青啤鸿运当头" title="青啤鸿运当头"></li><li text="[笑哈哈]"><img src="./assets/images/hotFace/lxhwahaha_thumb.gif" alt="笑哈哈" title="笑哈哈"></li><li text="[得意地笑]"><img src="./assets/images/hotFace/lxhdeyidixiao_thumb.gif" alt="得意地笑" title="得意地笑"></li><li text="[lt火车票]"><img src="./assets/images/hotFace/lttickets_thumb.gif" alt="lt火车票" title="lt火车票"></li><li text="[moc转发]"><img src="./assets/images/hotFace/moczhuanfa_thumb.gif" alt="moc转发" title="moc转发"></li><li text="[ali哇]"><img src="./assets/images/hotFace/aliwanew_thumb.gif" alt="ali哇" title="ali哇"></li><li text="[bm可爱]"><img src="./assets/images/hotFace/bmkeai_thumb.gif" alt="bm可爱" title="bm可爱"></li><li text="[xkl转圈]"><img src="./assets/images/hotFace/xklzhuanquan_thumb.gif" alt="xkl转圈" title="xkl转圈"></li><li text="[ppb鼓掌]"><img src="./assets/images/hotFace/ppbguzhang_thumb.gif" alt="ppb鼓掌" title="ppb鼓掌"></li><li text="[din推撞]"><img src="./assets/images/hotFace/dintuizhuang_thumb.gif" alt="din推撞" title="din推撞"></li><li text="[草泥马]"><img src="./assets/images/hotFace/shenshou_thumb.gif" alt="草泥马" title="草泥马"></li><li text="[神马]"><img src="./assets/images/hotFace/horse2_thumb.gif" alt="神马" title="神马"></li><li text="[浮云]"><img src="./assets/images/hotFace/fuyun_thumb.gif" alt="浮云" title="浮云"></li><li text="[给力]"><img src="./assets/images/hotFace/geili_thumb.gif" alt="给力" title="给力"></li><li text="[围观]"><img src="./assets/images/hotFace/wg_thumb.gif" alt="围观" title="围观"></li><li text="[威武]"><img src="./assets/images/hotFace/vw_thumb.gif" alt="威武" title="威武"></li><li text="[熊猫]"><img src="./assets/images/hotFace/panda_thumb.gif" alt="熊猫" title="熊猫"></li><li text="[兔子]"><img src="./assets/images/hotFace/rabbit_thumb.gif" alt="兔子" title="兔子"></li><li text="[奥特曼]"><img src="./assets/images/hotFace/otm_thumb.gif" alt="奥特曼" title="奥特曼"></li><li text="[囧]"><img src="./assets/images/hotFace/j_thumb.gif" alt="囧" title="囧"></li><li text="[互粉]"><img src="./assets/images/hotFace/hufen_thumb.gif" alt="互粉" title="互粉"></li><li text="[礼物]"><img src="./assets/images/hotFace/liwu_thumb.gif" alt="礼物" title="礼物"></li><li text="[呵呵]"><img src="./assets/images/hotFace/smilea_thumb.gif" alt="呵呵" title="呵呵"></li><li text="[嘻嘻]"><img src="./assets/images/hotFace/tootha_thumb.gif" alt="嘻嘻" title="嘻嘻"></li><li text="[哈哈]"><img src="./assets/images/hotFace/laugh.gif" alt="哈哈" title="哈哈"></li><li text="[可爱]"><img src="./assets/images/hotFace/tza_thumb.gif" alt="可爱" title="可爱"></li><li text="[可怜]"><img src="./assets/images/hotFace/kl_thumb.gif" alt="可怜" title="可怜"></li><li text="[挖鼻屎]"><img src="./assets/images/hotFace/kbsa_thumb.gif" alt="挖鼻屎" title="挖鼻屎"></li><li text="[吃惊]"><img src="./assets/images/hotFace/cj_thumb.gif" alt="吃惊" title="吃惊"></li><li text="[害羞]"><img src="./assets/images/hotFace/shamea_thumb.gif" alt="害羞" title="害羞"></li><li text="[挤眼]"><img src="./assets/images/hotFace/zy_thumb.gif" alt="挤眼" title="挤眼"></li><li text="[闭嘴]"><img src="./assets/images/hotFace/bz_thumb.gif" alt="闭嘴" title="闭嘴"></li><li text="[鄙视]"><img src="./assets/images/hotFace/bs2_thumb.gif" alt="鄙视" title="鄙视"></li><li text="[爱你]"><img src="./assets/images/hotFace/lovea_thumb.gif" alt="爱你" title="爱你"></li><li text="[泪]"><img src="./assets/images/hotFace/sada_thumb.gif" alt="泪" title="泪"></li><li text="[偷笑]"><img src="./assets/images/hotFace/heia_thumb.gif" alt="偷笑" title="偷笑"></li><li text="[亲亲]"><img src="./assets/images/hotFace/qq_thumb.gif" alt="亲亲" title="亲亲"></li><li text="[生病]"><img src="./assets/images/hotFace/sb_thumb.gif" alt="生病" title="生病"></li><li text="[太开心]"><img src="./assets/images/hotFace/mb_thumb.gif" alt="太开心" title="太开心"></li><li text="[懒得理你]"><img src="./assets/images/hotFace/ldln_thumb.gif" alt="懒得理你" title="懒得理你"></li><li text="[右哼哼]"><img src="./assets/images/hotFace/yhh_thumb.gif" alt="右哼哼" title="右哼哼"></li><li text="[左哼哼]"><img src="./assets/images/hotFace/zhh_thumb.gif" alt="左哼哼" title="左哼哼"></li><li text="[嘘]"><img src="./assets/images/hotFace/x_thumb.gif" alt="嘘" title="嘘"></li><li text="[衰]"><img src="./assets/images/hotFace/cry.gif" alt="衰" title="衰"></li><li text="[委屈]"><img src="./assets/images/hotFace/wq_thumb.gif" alt="委屈" title="委屈"></li><li text="[吐]"><img src="./assets/images/hotFace/t_thumb.gif" alt="吐" title="吐"></li><li text="[打哈欠]"><img src="./assets/images/hotFace/k_thumb.gif" alt="打哈欠" title="打哈欠"></li><li text="[抱抱]"><img src="./assets/images/hotFace/bba_thumb.gif" alt="抱抱" title="抱抱"></li><li text="[怒]"><img src="./assets/images/hotFace/angrya_thumb.gif" alt="怒" title="怒"></li><li text="[疑问]"><img src="./assets/images/hotFace/yw_thumb.gif" alt="疑问" title="疑问"></li><li text="[馋嘴]"><img src="./assets/images/hotFace/cza_thumb.gif" alt="馋嘴" title="馋嘴"></li><li text="[拜拜]"><img src="./assets/images/hotFace/88_thumb.gif" alt="拜拜" title="拜拜"></li><li text="[思考]"><img src="./assets/images/hotFace/sk_thumb.gif" alt="思考" title="思考"></li><li text="[汗]"><img src="./assets/images/hotFace/sweata_thumb.gif" alt="汗" title="汗"></li><li text="[困]"><img src="./assets/images/hotFace/sleepya_thumb.gif" alt="困" title="困"></li><li text="[睡觉]"><img src="./assets/images/hotFace/sleepa_thumb.gif" alt="睡觉" title="睡觉"></li><li text="[钱]"><img src="./assets/images/hotFace/money_thumb.gif" alt="钱" title="钱"></li><li text="[失望]"><img src="./assets/images/hotFace/sw_thumb.gif" alt="失望" title="失望"></li><li text="[酷]"><img src="./assets/images/hotFace/cool_thumb.gif" alt="酷" title="酷"></li><li text="[花心]"><img src="./assets/images/hotFace/hsa_thumb.gif" alt="花心" title="花心"></li><li text="[哼]"><img src="./assets/images/hotFace/hatea_thumb.gif" alt="哼" title="哼"></li><li text="[鼓掌]"><img src="./assets/images/hotFace/gza_thumb.gif" alt="鼓掌" title="鼓掌"></li><li text="[晕]"><img src="./assets/images/hotFace/dizzya_thumb.gif" alt="晕" title="晕"></li><li text="[悲伤]"><img src="./assets/images/hotFace/bs_thumb.gif" alt="悲伤" title="悲伤"></li><li text="[抓狂]"><img src="./assets/images/hotFace/crazya_thumb.gif" alt="抓狂" title="抓狂"></li><li text="[黑线]"><img src="./assets/images/hotFace/h_thumb.gif" alt="黑线" title="黑线"></li><li text="[阴险]"><img src="./assets/images/hotFace/yx_thumb.gif" alt="阴险" title="阴险"></li><li text="[怒骂]"><img src="./assets/images/hotFace/nm_thumb.gif" alt="怒骂" title="怒骂"></li><li text="[心]"><img src="./assets/images/hotFace/hearta_thumb.gif" alt="心" title="心"></li><li text="[伤心]"><img src="./assets/images/hotFace/unheart.gif" alt="伤心" title="伤心"></li><li text="[猪头]"><img src="./assets/images/hotFace/pig.gif" alt="猪头" title="猪头"></li><li text="[ok]"><img src="./assets/images/hotFace/ok_thumb.gif" alt="ok" title="ok"></li><li text="[耶]"><img src="./assets/images/hotFace/ye_thumb.gif" alt="耶" title="耶"></li><li text="[good]"><img src="./assets/images/hotFace/good_thumb.gif" alt="good" title="good"></li><li text="[不要]"><img src="./assets/images/hotFace/no_thumb.gif" alt="不要" title="不要"></li><li text="[赞]"><img src="./assets/images/hotFace/z2_thumb.gif" alt="赞" title="赞"></li><li text="[来]"><img src="./assets/images/hotFace/come_thumb.gif" alt="来" title="来"></li><li text="[弱]"><img src="./assets/images/hotFace/sad_thumb.gif" alt="弱" title="弱"></li><li text="[蜡烛]"><img src="./assets/images/hotFace/lazu_thumb.gif" alt="蜡烛" title="蜡烛"></li><li text="[钟]"><img src="./assets/images/hotFace/clock_thumb.gif" alt="钟" title="钟"></li><li text="[话筒]"><img src="./assets/images/hotFace/m_thumb.gif" alt="话筒" title="话筒"></li><li text="[蛋糕]"><img src="./assets/images/hotFace/cake.gif" alt="蛋糕" title="蛋糕"></li>';
		faces+='</ul>';
		faces+='</div>';
		faces+='</div>';
		faces+='<div class="arrow"></div>';
		faces+='<a class="W_close" href="javascript:void(0);" title="关闭"></a>';
		faces+='</div>';
		$('body').append(faces);
		$('.hotfaces').css({left:_x,top:_y});
	}
})
</script>