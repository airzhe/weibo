<div class="content clearfix">
	<?php $this->load->view('components/common_left_nav');?>
	<div class="main clearfix">
		<div class="box_center left">
			<div class="title">
				<a href="#" class="tit">收到的评论<span class="current"></span></a>
				<a href="<?php echo site_url('comment/outbox') ?>" class="tit">发出的评论</a>
			</div>
			<div class="comment_list">
				<?php foreach ($comment as $v): ?>
					<div class="item clearfix">
						<div class="face">
							<a href="<?php echo $v['domain'] ?>"><img width="50" height="50" src="<?php echo $v['avatar'] ?>" alt=""></a>
						</div>
						<div class="comment">
							<div class="message_arrow">
								<em class="S_line1_c">◆</em>
								<span class="S_bg1_c">◆</span>
							</div>
							<p><a href="<?php echo $v['domain'] ?>"><?php echo $v['username'] ?></a>：<?php echo $v['content']?></p>
							<p class="S_txt2">
								<?php if ($v['isreplay']): ?>
									回复我的评论<a href="" class="S_link2"><?php echo $v['weibo'] ?></a>
								<?php else: ?>
									评论我的微博<a href="" class="S_link2"><?php echo $v['weibo'] ?></a>
								<?php endif ?>
							</p>
							<p class="S_txt2 info"><?php echo $v['time']?>来自<a href="" class="S_link2">新浪微博</a><span class="right"> <a href="">回复</a></span></p>
						</div>
					</div>
				<?php endforeach ?>
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