<div class="content clearfix">
	<?php $this->load->view('components/common_left_nav');?>
	<div class="main clearfix">
		<div class="box_center left">
			<div class="title">收到的赞</div>
			<div class="tab_normal clearfix">
				<div class="left">
					<a href="" class="W_btn_a"><span><i class="icon_mes"></i>发私信</span></a>
					<a href="" class="W_btn_b"><span>全部置为已读</span></a>
				</div>
				<div class="right">
					<span class="S_txt2"><i class="W_ico16 icon_lock"></i>消息箱功能设置设置</span>
					<a href="#" class="set">设置</a>
				</div>
			</div>
			<div class="msg_list">
				<?php if (!count($praise)): ?>
					<a href="" class="notes">没有内容哦~~</a>
				<?php else: ?>
					<?php foreach ($praise as $v): ?>
						<div class="item">
							<div class="avatar">
								<a href="<?php echo $v['domain'] ?>"><img width="50" height="50" src="<?php echo $v['avatar'] ?>" alt=""></a> 
							</div>
							<div class="msg_main">
								<div><a href="#"><strong><?php echo $v['username'] ?></strong></a>赞了你的微博<span class="W_ico20 icon_praised_bc"></span></div>
								<div class="S_txt2">对我的微博： <a href="#"><?php echo $v['weibo'] ?></a></div>
								<div class="S_txt2"><span><?php echo $v['time'] ?></span> 来自 <a href="#">新浪微博</a></div>
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
