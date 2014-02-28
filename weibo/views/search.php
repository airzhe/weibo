<div class="search_head" >
	<div class="logo">
		<a href="#" class="logo_img"></a>
	</div>
	<div  class="type">
		<a href="#">综合</a>
		<a href="#">微博</a>
		<a href="#" class="curr">找人</a>
		<a href="#">图片</a>
		<a href="#">应用</a>
	</div>
	<div class="s_from">
		<form action="#">
			<input type="text" name="searchInput" value="<?php echo $keyword ?>">
			<a href="javascript:void(0)" class="searchBtn">搜索</a>
		</form>
		<span><a href="#">高级搜索</a><a href="#">设置</a><a href="#">帮助</a></span>
	</div>
</div>
<div class="S_content clearfix">
	<div class="S_content_l">
		<p class="filter clearfix">所有地区<a href="#">[切换]</a><i class="S_line1_c">|</i><a href="#">所有用户</a><i class="S_line1_c">|</i><a href="#">不限性别</a><i class="S_line1_c">|</i><a href="#" class="right">不限年龄</a> <a href="#">更多条件</a></p>
		<div class="result_list">
			<?php if (count($user)): ?>
				<?php foreach ($user as $v): ?>
					<div class="item clearfix">
						<div class="avatar left"> <a href="<?php echo $v['domain'] ?>" targte="_blank"><img src="<?php if(isset($v['b_avatar'])) echo $v['b_avatar'];else echo  $v['avatar'] ?>" width="80" height="80" alt=""></a></div>
						<div class="detail">
							<div class="info">
								<div class="name"><?php echo $v['username'] ?></div>
								<div><i class="W_ico12 <?php echo $v['sex_ico'] ?>"></i><span class="addr"><?php echo $v['location'] ?></span><a href="<?php echo $v['domain'] ?>" targte="_blank"><?php echo $v['domain'] ?></a></div>
								<div class="num">关注<a href="javascript:void(0)"><?php echo $v['follow'] ?></a><i class="W_vline S_line1_c">|</i>粉丝<a href="#"><?php echo $v['fans'] ?></a><i class="W_vline S_line1_c">|</i>微博<a href="javascript:void(0)"><?php echo $v['weibo'] ?></a></div>
								<?php if ($v['intro']): ?>
									<div>简介： <?php echo $v['intro'] ?></div>
								<?php endif ?>
							</div>
							<!-- 如果搜索用户不能于当前用户才显示右边相关操作 -->
							<?php if (!($v['uid']==$this->session->userdata('uid'))): ?>
								<div class="operate">
									<!-- 判断和用户之间的关系 -->
									<?php if ($v['relation']==0 || $v['relation']==2): ?>
										<a uid="<?php echo $v['uid'] ?>" relation="<?php echo $v['relation'] ?>" source="search" href="javascript:void(0);" class="W_addbtn addFollow"><span class="addicon">+</span>加关注</a>
									<?php else: ?>
										<img src="<?php echo base_url('assets/images/transparent.gif') ?>" alt="" class="icon_connect r_<?php echo $v['relation'] ?>">
									<?php endif ?>
									<p><a target="_blank" href="#" ><span class="search_icon searchper_icon"></span>TA的好友</a></p>
								</div>
							<?php endif ?>
						</div>
					</div>
				<?php endforeach ?>
			<?php endif ?>
		</div>
		<p><span>找到 <?php echo count($user) ?> 条结果</span></p>
		<div class="s_from">
			<form action="#">
				<input type="text" name="searchInput" value="<?php echo $keyword ?>">
				<a href="javascript:void(0)" class="searchBtn">搜索</a>
			</form>
			<p>欢迎提交微博搜索使用反馈，请直接<a href="#">发表意见</a>或您可以关注萌小搜<a href="#">@微博搜索</a>获取搜索技巧。</p>
		</div>
	</div>
	<div class="S_content_r">

	</div>
</div>
</div>
<div class="footer S_txt2">
	<p>微博帮助　意见反馈　开放平台　微博招聘　新浪网导航</p>
	<p class="clearfix">北京微梦创科网络技术有限公司 京网文[2011]0398-130号 京ICP证100780号<span class="right">Copyright © 1996-2013 SINA</span></p>
</div>
</div>
</div>
</body>
</html>