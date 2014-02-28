<div class="content clearfix">
	<?php $this->load->view('components/common_left_nav');?>
	<div class="main clearfix">
		<div class="box_center left">
			<div class="title">私信</div>
			<div class="tab_normal clearfix">
				<div class="left">
					<a action-type="conversation" href="javascript:void(0)" class="W_btn_a"><span><i class="icon_mes"></i>发私信</span></a>
					<a href="javascript:void(0)" class="W_btn_b"><span>清空所有私信</span></a>
				</div>
				<div class="right">
					<span class="S_txt2"><i class="icon_lock"></i>消息箱功能设置设置</span>
					<a href="javascript:void(0)" class="set">设置</a>
				</div>
			</div>
			<div class="msg_list">
				<?php if (!isset($letter_list)): ?>
					<p class="W_tips W_empty S_txt2"><i class="icon_warnS"></i>咦？暂时没有内容哦，稍后再来试试吧~~</p>
				<?php else: ?>
					<?php foreach ($letter_list as $v): ?>
						
						<div class="item">

							<div class="avatar">
								<a href="<?php echo $v['domain'] ?>">
									<img src="<?php echo $v['avatar'] ?>" width="50" height="50" alt="">
								</a>
							</div>
							<div class="msg_main">
								<div class="msg_title"><?php echo $v['username'] ?></div>
								<a href="<?php echo site_url('letter/lists') ?>">
									<div class="msg_detail S_txt2"><span class="msg_ico msg_ico_reply"></span><?php echo $v['content'] ?></div>
									<span class="msg_time S_txt2"><?php echo $v['time'] ?></span>
								</a>
							</div>
							
						</div>
						
					<?php endforeach ?>
				<?php endif ?>
			</div>
		</div>
		<div class="box_right right">
			<div class="item">
				<fieldset>
					<legend class="title">消息箱使用小帮助</legend>
				</fieldset>
				<div class="qa S_txt2">
					<i class="W_ico16 ico_q"></i>：什么是消息箱？<br/>
					A：是将@我的，评论，赞，私信等消息相关类-服务综合在一起的消息中心，在这里可以看到所有的消息提示。<br>
					<a href="#">点击这里提交意见反馈</a>
				</div>
			</div>
			<div class="item">
				<fieldset>
					<legend class="title">新浪微博意见反馈</legend>
				</fieldset>
				<div class="qa S_txt2">
					欢迎使用新浪微博并提出宝贵建议。请<a href="">点击这里</a>提交微博意见反馈。<br>
					<a href="#">微博常见问题</a><br>
					<a href="#">微博客服专区</a><br>
					<a href="#">全国人大常委会《关于加强网络信息保护的决定》</a>
				</div>
			</div>
		</div>
	</div>
</div>