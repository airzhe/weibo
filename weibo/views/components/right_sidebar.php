<div class="sidebar right">
	<!-- 关注/粉丝 -->
	<div class="relation">
		<h4><a href="#" class="S_func1">关注/粉丝</a><span class="S_txt2"><?php echo $user['call'] ?>的关注和粉丝</span></h4>
		<div>
			<fieldset>
				<legend class="title"><a href="#" class="S_func1"><?php echo $user['call'] ?>的关注(<?php echo $user['follow'] ?>)</a></legend>
				<?php if (isset($user['me']) and count($myfollow_list)): ?>
					<a class="more" href="<?php echo site_url('follow') ?>">更多»</a>
				<?php else: ?>
					<a class="more" href="#">更多»</a>
				<?php endif ?>
			</fieldset>
			<ul class="clearfix">
				<?php if (count($myfollow_list)): ?>
					<?php foreach ($myfollow_list as $v): ?>
						<li><a href="<?php echo $v['domain'] ?>"><img src="<?php echo $v['avatar'] ?>" alt="" width="50" height="50"></a><a href="<?php echo $v['domain'] ?>" class="S_func1" title="<?php echo $v['username'] ?>"><?php echo $v['username'] ?></a></li>
					<?php endforeach ?>
				<?php else: ?>
					<p class="W_tips W_empty S_txt2"><i class="icon_warnS"></i>你还没有关注的人</p>
				<?php endif ?>
			</ul>
			<fieldset>
				<legend class="title"><a href="#" class="S_func1"><?php echo $user['call'] ?>的粉丝(<?php echo $user['fans'] ?>)</a></legend>
				<?php if (isset($user['me']) and count($myfans_list)): ?>
					<a class="more" href="<?php echo site_url('fans') ?>">更多»</a>
				<?php else: ?>
					<a class="more" href="#">更多»</a>
				<?php endif ?>
				
			</fieldset>
			<ul class="clearfix">
				<?php if (count($myfans_list)): ?>
					<?php foreach ($myfans_list as $v): ?>
						<li><a href="<?php echo $v['domain'] ?>"><img src="<?php echo $v['avatar'] ?>" alt="" width="50" height="50"></a><a href="<?php echo $v['domain'] ?>" class="S_func1" title="<?php echo $v['username'] ?>"><?php echo $v['username'] ?></a></li>
					<?php endforeach ?>
				<?php else: ?>
					<p class="W_tips W_empty S_txt2"><i class="icon_warnS"></i>目前还没有人关注你</p>
				<?php endif ?>
			</ul>
		</div>
	</div>
	<!-- 微相册 -->
	<div class="album">
		<h4><a href="#" class="S_func1">微相册</a><span class="S_txt2">10,000,000+人在用</span></h4>
		<div>
			<ul class="picitems clearfix">
				<li><a href="#"><img src="./assets/images/pic1.jpg" alt="" width="72" height="72"></a></li>
				<li><a href="#"><img src="./assets/images/pic2.jpg" alt="" width="72" height="72"></a></li>
				<li><a href="#"><img src="./assets/images/pic3.jpg" alt="" width="72" height="72"></a></li>
				<li><a href="#"><img src="./assets/images/pic4.jpg" alt="" width="72" height="72"></a></li>
				<li><a href="#"><img src="./assets/images/pic5.jpg" alt="" width="72" height="72"></a></li>
				<li><a href="#"><img src="./assets/images/pic6.jpg" alt="" width="72" height="72"></a></li>
				<li><a href="#"><img src="./assets/images/pic7.jpg" alt="" width="72" height="72"></a></li>
				<li><a href="#"><img src="./assets/images/pic8.jpg" alt="" width="72" height="72"></a></li>
			</ul>
		</div>
	</div>
</div>