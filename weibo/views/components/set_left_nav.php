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
		<legend class="S_txt2">帐号设置</legend>
	</fieldset>
	<div class="level_Box">
		<div class="lev"><a href="<?php echo site_url('set/info') ?>" data-type='info'><i class="W_ico20 ico_account ico_personinfo"></i>个人信息</a></div>
		<div class="lev"><a href="<?php echo site_url('set/avatar') ?>" data-type='avatar'><i class="W_ico20 ico_account ico_avater"></i>头像</a></div>
		<div class="lev"><a href="<?php echo site_url('set/security') ?>" data-type='security'><i class="W_ico20 ico_account ico_security"></i>帐号安全</a></div>
	</div>
	<div class="level_Box">
		<div class="lev"><a href=""><i class="W_ico20 ico_account ico_privacy"></i>隐私设置</a></div>
		<div class="lev"><a href=""><i class="W_ico20 ico_account ico_message"></i>消息设置</a></div>
		<div class="lev"><a href=""><i class="W_ico20 ico_account ico_prefer"></i>偏好设置</a></div>
	</div>
</div>