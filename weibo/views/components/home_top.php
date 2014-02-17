<div class="profile_pic_top" style="background-image:url(<?php echo $cover ?>)">
	<a class="set_skin" href="javascript:void(0)" title="模板设置"></a>
</div>
<div class="user_info S_bg5 clearfix"  uid="<?php echo $user['uid'] ?>" >
	<div class="head left">
		<div class="avatar">
			<img  width="180" height="180" src="<?php echo $user['avatar'] ?>" alt="">
			<a href="<?php echo site_url('set/avatar') ?>" class="W_btn_c change_avatar"><span>更换头像</span></a>
		</div>
		<ul class="user_atten clearfix">
			<li class="S_line1">
				<a href="" class="S_func1">
					<strong><?php echo $user['follow'] ?></strong>
					<span>关注</span>
				</a>
			</li>
			<li class="S_line1">
				<a href="" class="S_func1">
					<strong><?php echo $user['fans'] ?></strong>
					<span>粉丝</span>
				</a>
			</li>
			<li class="S_line1">
				<a href="" class="S_func1">
					<strong id="my_weibo"><?php echo $user['weibo'] ?></strong>
					<span>微博</span>
				</a>
			</li>
		</ul>
	</div>
	<div class="info">
		<div>
			<span class="name"><?php echo $user['username'] ?></span> 
			<a href="" class="W_level_ico color3"><span class="W_level_num l7"></span></a>
			<a href="<?php echo $user['domain'] ?>"><?php echo $user['domain'] ?></a>
		</div>
		<?php if ($user['intro']): ?>
			<p class="S_txt2"><?php echo $user['intro'] ?></p>
		<?php else: ?>
			<?php if (isset($user['me'])): ?>
				<p><a href="<?php echo site_url('set/info') ?>">一句话介绍一下自己吧，让别人更了解你</a></p>
			<?php else: ?>
				<p>他还没有填写个人简介</p>
			<?php endif ?>
		<?php endif ?>
		<p><i class="W_ico12 <?php echo $user['sex_ico'] ?>"></i><i class="W_vline S_line1_c">|</i><a href="#">求交往</a><i class="W_vline S_line1_c">|</i><a href=""><?php echo $user['location'] ?></a></p>
		<?php if (isset($user['me'])): ?>
			<p class="edit"><a href="<?php echo site_url('set/info') ?>" class="W_btn_c"><span>编辑个人资料</span></a></p>
		<?php else: ?>
			<div class="W_btn_c">
				<span>
					<em class="W_ico12 icon_addone"></em>已关注<em class="W_vline S_txt2">|</em>
					<a class="S_link2" href="javascript:void(0);">取消</a>
				</span>
			</div>
			<a class="W_btn_c"><span action-type="webim.conversation"><i class="W_chat_stat"></i>私信</span></a>
		<?php endif ?>
	</div>
</div>
<div class="S_bg4">
	<ul class="core_nav clearfix">
		<li class="current"><a href="#"><?php echo $user['call'] ?>的主页</a></li>
		<li><a href="#">微博</a></li>
		<li><a href="#">个人资料</a></li>
		<li><a href="#">相册</a></li>
		<li><a href="#">赞</a></li>
		<li><a href="#">足迹</a></li>
		<li><a href="#">更多</a></li>
	</ul>
</div>