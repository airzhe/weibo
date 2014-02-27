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
	<fieldset>
		<legend class="S_txt2">关系中心</legend>
	</fieldset>
	<div><a href="<?php echo site_url('follow') ?>" data-type="follow"><i class="W_ico20 ico_connect ico_myfollow"></i>关注</a></div>
	<div class="group">
		<ul>
			<li><a href="#">全部关注(35)</a></li>
			<li><a href="#">同事</a></li>
			<li><a href="#">同学</a></li>
			<li><a href="#">朋友</a></li>
			<li><a href="#">家人</a></li>
			<li><a href="#">明星</a></li>
		</ul>
	</div>
	<div><a href="<?php echo site_url('fans') ?>" data-type="fans"><i class="W_ico20 ico_connect ico_myfans"></i>粉丝(11)</a></div>
</div>