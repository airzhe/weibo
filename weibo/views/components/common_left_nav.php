<script>
	$(document).ready(function(){
		var type="<?php echo $this->uri->segment(1)=='set'?$this->uri->segment(2):$this->uri->segment(1);?>";
		$('.left_nav').find('a').each(function(){
			if($(this).data('type')==type){
				$(this).addClass('curr').parents('ul').prev('a').addClass('curr');
				$(this).parent().next('.group').find('li').first().css({'background':'#e6e6e6','font-weight':'bold'});
				return;
			}
		})
	})
</script>
<div class="left_nav left">
	<ul>
		<li><a href="#"><i class="W_ico20 ico_myhomepage"></i>首页<i class="new"></i></a></li>
		<li>
			<a href="#" data-type="msg"><i class="W_ico20 ico_message"></i><em class="W_new_count">2</em>消息</a>
			<ul>
				<li><a href="" data-type="at"><i class="W_ico20 ico_lev_at"></i>提到我的</a></li>
				<li><a href="" data-type="comment"><i class="W_ico20 ico_lev_comment"></i>评论</a></li>
				<li><a href="" data-type="praise"><i class="W_ico20 ico_lev_like"></i>赞</a></li>
				<li><a href="" data-type="letter"><i class="W_ico20 ico_lev_letter"></i>私信</a></li>
				<li><a href="" ><i class="W_ico20 ico_lev_leave"></i>未关注人的私信</a></li>
			</ul>
		</li>
		<li><a href="#"><i class="W_ico20 ico_favor"></i>收藏</a></li>
		<li><a href="#"><i class="W_ico20 ico_sendtome"></i>发给我的</a></li>
	</ul>
	<ul class="goodfriend">
		<li><a href=""><i class="W_ico20 ico_goodfriend"></i>好友圈</a></li>
		<li></li>
	</ul>
	<div class="group">
		<fieldset>
			<legend class="S_txt2">分组</legend>
		</fieldset>
		<ul>
			<li><a href="#"><i class="W_ico20 ico_group"></i>同事</a></li>
			<li><a href="#"><i class="W_ico20 ico_group"></i>同学</a></li>
			<li><a href="#"><i class="W_ico20 ico_group"></i>朋友</a></li>
			<li><a href="#"><i class="W_ico20 ico_group"></i>家人</a></li>
			<li><a href="#"><i class="W_ico20 ico_group"></i>明星</a></li>
		</ul>
	</div>
</div>