<div class="content clearfix">
	<?php $this->load->view('components/common_left_nav');?>
	<div class="main clearfix">
		<div class="box_center left">
			<div class="title">与 <?php echo $user['username'] ?> 的对话</div>
			<div class="tab_normal clearfix">
				<div class="left">
					<a href="" class="W_btn_b"><span>批量删除</span></a>
				</div>
				<div class="right">
					<span class="S_txt2"><i class="icon_lock"></i>消息箱功能设置设置</span>
					<a href="#" class="set">设置</a>
				</div>
			</div>
			<div class="send_private_msgbox">
				<p style="line-height:24px;">
					<span class="left"><em class="icon_mes"></em>发私信给：<?php echo $user['username'] ?></span><span class="right">私信字数在1000以内</span>
				</p>
				<input type="hidden" name="username" value="<?php echo $user['username'] ?>">
				<textarea id="letter" name="letter_content" class="W_input" placeholder="发私信" title="输入要发送的私信"></textarea>
				<p class="hide clearfix"><a href="javascript:void(0)" action-type="face" action-id="letter"><i class="W_ico16 ico_faces"></i></a><a href="javascript:void(0)" action-type="submit_letter" <?php echo "action-data='uid={$user['uid']}&username={$user['username']}'" ?>  class="conversation W_btn_b right "><span>发送</span></a></p>
			</div>
			<div class="comment_list msg_dialogue">
				<?php if (!isset($letter_list)): ?>
					<p class="W_tips W_empty S_txt2"><i class="icon_warnS"></i>咦？暂时没有内容哦，稍后再来试试吧~~</p>
				<?php else: ?>
					<?php foreach ($letter_list as $v): ?>
						<div class="item item_<?php echo $v['class'] ?> clearfix">
							<fieldset class="S_line2 msg_time_line">
								<legend class="time_tit S_txt3"><?php echo $v['time'] ?></legend>
							</fieldset>
							<?php if ($v['class']=='me'): ?>
								<div class="face">
									<a href="<?php echo $v['domain'] ?>"><img width="50" height="50" src="<?php echo $v['avatar'] ?>" alt=""></a>
								</div>
							<?php endif ?>
							<div class="comment">
								<div class="message_arrow">
									<em class="S_line1_c">◆</em>
									<span class="S_bg1_c">◆</span>
								</div>
								<p>
									<?php echo $v['content'] ?>
								</p>
							</div>
							<?php if ($v['class']=='ta'): ?>
								<div class="face">
									<a href="<?php echo $v['domain'] ?>"><img width="50" height="50" src="<?php echo $v['avatar'] ?>" alt=""></a>
								</div>
							<?php endif ?>
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