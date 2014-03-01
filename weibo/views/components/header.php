<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php if(isset($title)) echo $title?> 新浪微博-随时随地分享身边的新鲜事儿</title>
	<link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.ico') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/reset.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>">
	<!-- 调用用户自定义模板样式 -->
	<?php if(isset($style)) echo $style ?>
	<!-- 调用用户自定义模板样式 -->
	<script src="<?php echo base_url('assets/js/jquery-1.8.2.min.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/runui.js') ?>"></script>
	<script>
		var site_url="<?php echo base_url()?>";
	</script>
	<script src="<?php echo base_url('assets/js/weibo.js') ?>"></script>
	<?php if(isset($body_class)): ?>
		<?php switch ($body_class) {
			case 'index':
			?>
			<!-- index页js -->
			<script src="<?php echo base_url('assets/js/jquery.autosize.min.js') ?>"></script>
			<script src="<?php echo base_url('assets/js/Uploadify/jquery.uploadify.min.js') ?>"></script>
			<?php 
			break;
			case 'home my_index':
			?>
			<!-- home页js -->
			<script src="<?php echo base_url('assets/js/jquery.autosize.min.js') ?>"></script>
			<?php 
			break;
			case 'avatar':
			?>
			<!-- 修改用户头像js -->
			<script src="<?php echo base_url('assets/js/Uploadify/jquery.uploadify.min.js') ?>"></script>
			<script src="<?php echo base_url('assets/js/Jcrop/jquery.Jcrop.min.js') ?>"></script>
			<link rel="stylesheet" href="<?php echo base_url('assets/js/Jcrop/jquery.Jcrop.css') ?>">
			<?php 
			break;
			case 'set_info':
			?>
			<!-- 用户个人信息修改页js -->
			<script src="<?php echo base_url('assets/js/jquery.validate.js') ?>"></script>
			<script src="<?php echo base_url('assets/js/jquery.cxselect.min.js') ?>"></script>
			<?php 
			break;

			default:
			# code...
			break;
		} ?>
	<?php endif ?>
</head>
<body<?php if(isset($body_class)) echo ' class="'.$body_class.'"'; ?>>
<div class="miniblog">
	<div class="miniblog_fb">
		<div class="header global_nav">
			<div class="nav_bg">
				<div class="container">
					<div class="logo">
						<a href="<?php echo site_url() ?>"></a>
					</div>
					<div class="nav clearfix">
						<a href="<?php echo site_url() ?>" class="current">首页</a>
						<a href="#">热门<i class="ico_down"></i></a>
						<a href="#">游戏<i class="ico_down"></i></a>
						<a href="#">应用<i class="ico_down"></i></a>
					</div>
					<div class="search">
						<form action="<?php echo site_url('search') ?>">
							<input type="text" name="searchInput" placeholder="大家都在搜：香格里拉大火">
							<a href="javascript:void(0)" class="searchBtn"></a>
						</form>
					</div>
					<ul class="user clearfix">
						<li class="username" avatar="<?php echo $this->session->userdata('avatar') ?>" sex="<?php echo $this->session->userdata('sex') ?>" ><a href="<?php echo site_url('home') ?>"><?php echo $this->session->userdata('username') ?></a></li>
						<li class="editor" ><a href="javascript:void(0)"><i></i></a></li>
						<li class="msg">
							<a href="javascript:void(0)"><i></i><em class="W_new"></em></a>
							<ul>
								<li><a href="<?php echo base_url('comment/inbox') ?>">查看评论</a></li>
								<!-- 查看新评论 -->
								<li><a href="<?php echo base_url('at') ?>">查看@我</a></li>
								<li><a href="<?php echo base_url('letter') ?>">查看私信</a></li>
								<li><a href="<?php echo base_url('fans') ?>">查看粉丝</a></li>
							</ul>
							
						</li>
						<li class="setting" >
							<a href="javascript:void(0)"><i></i></a>
							<ul>
								<li><a href="<?php echo site_url('set/info') ?>">帐号设置</a></li>
								<li><a href="#">模板设置</a></li>
								<li><a href="<?php echo site_url('logout') ?>" class="logout">退出</a></li>
							</ul>
						</li>
						<li class="member" ><a href="javascript:void(0)"><i></i></a></li>
					</ul>
					<div class="gn_tips hide">
						<!--tip start-->
						<a href="javascript:void(0);" class="W_ico12 icon_close"></a>
						<ul class="tips_list">
							<li class="_comment"><span>1</span>条新评论，<a href="<?php echo site_url('comment/inbox') ?>">查看评论</a></li>
							<!-- 私信一直提示，其他刷新就不提示 -->
							<li class="_letter"><span>1</span>条新私信，<a href="<?php echo site_url('letter') ?>">查看私信</a></li>
							<li class="_atme"><span>2</span>条新@我，<a href="<?php echo site_url('at') ?>">查看@我</a></li>
						</ul>
						<!--tip end-->
					</div>
				</div>
			</div>
		</div>
		<div class="mail_active hide">
			<div class="box">
				<div>
					<span class="icon_errorB"></span>
				</div>
				<div>
					<p><strong>激活账号</strong></p>
					<p>你当前-的体验期还有<i class="S_spetxt">30</i>天，确认你的邮件地址就可以使用 <strong>新浪微博</strong> 的所有功能啦！邮件已经发送至 532499602@qq.com 。</p>
					<p><a href="#" class="W_btn_b"><span>立即激活</span></a><a href="#">重新发送确认邮件</a></p>
				</div>
			</div>
		</div>
		<div class="container main clearfix">