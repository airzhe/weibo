<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>头像设置 新浪微博-随时随地分享身边的新鲜事儿</title>
	<link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon .ico') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/reset.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>">
	<script src="<?php echo base_url('assets/js/jquery-1.8.2.min.js') ?>"></script>
</head>
<body class="body_home body_follow">
	<div class="miniblog">
		<div class="miniblog_fb">
			<div class="header global_nav">
				<div class="nav_bg">
					<div class="container">
						<div class="logo">
							<a href=""></a>
						</div>
						<div class="nav clearfix">
							<a href="#" class="current">首页</a>
							<a href="#">热门<i class="arrow"></i></a>
							<a href="#">游戏<i class="arrow"></i></a>
							<a href="#">应用<i class="arrow"></i></a>
						</div>
						<div class="search">
							<input type="text" name="searchInput" value="大家都在搜：香格里拉大火">
							<a href="javascript:void(0)" class="btn"></a>
						</div>


						<ul class="user clearfix">
							<li class="username" ><a href="javascript:void(0)">air_zhe</a></li>
							<li class="editor" ><a href="javascript:void(0)"><i></i></a></li>
							<li class="msg" >
								<a href="javascript:void(0)"><i></i></a>
								<ul>
									<li><a href="#"></a></li>
									<li><a href="#"></a></li>
									<li><a href="#"></a></li>
								</ul>
							</li>
							<li class="setting" ><a href="javascript:void(0)"><i></i></a></li>
							<li class="member" ><a href="javascript:void(0)"><i></i></a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="container main">
				<div class="content clearfix">
					<div class="left_nav left">
						<fieldset>
							<legend class="S_txt2">帐号设置</legend>
						</fieldset>
						<div class="level_Box">
							<div class="lev"><a href=""><i class="W_ico20 ico_connect"></i>个人信息</a></div>
							<div class="lev"><a href="" class="curr"><i class="W_ico20 ico_avater"></i>头像</a></div>
							<div class="lev"><a href=""><i class="W_ico20 ico_security"></i>帐号安全</a></div>
						</div>
						<div class="level_Box">
							<div class="lev"><a href=""><i class="W_ico20 ico_privacy"></i>隐私设置</a></div>
							<div class="lev"><a href=""><i class="W_ico20 ico_message"></i>消息设置</a></div>
							<div class="lev"><a href=""><i class="W_ico20 ico_prefer"></i>偏好设置</a></div>
						</div>
					</div>
					<div class="main">
						<div class="box_center">
							<div class="title clearfix">头像<span class="S_txt2 right">无法上传头像？<a href="#">尝试普通方式上传</a></span></div>
							<div class="upload_avatar">
								<p><strong>选择上传方式</strong></p>
								<div class="upload_btn">
									<a href="" class="S_func1"><span>选择上传</span></a>
								</div>
								<p class="S_txt2">仅支持JPG、GIF、PNG格式，文件小于5M（使用高质量图片，可生成高清头像）</p>
								<p><input type="checkbox" name="" checked="checked">上传原始图片，生成高清头像</p>
								<div class="preview clearfix">
									<div class="big left">
										<div class="img_300">
											<img src="./assets/images/up_bg.gif" alt="" width="300" height="300">
										</div>
									</div>
									<div class="small">
										<p>您上传的图片将会自动生成三种尺寸头像，请注意中小尺寸的头像是否清晰</p>
										<div class="avatar clearfix">
											<div class="img_180 left">
												<img id="img_180" src="./assets/images/blank.gif" alt="" width="180" height="180">
												<p>大尺寸头像,180*180像素</p>
											</div>
											<div class="right">
												<div class="img_50">
													<img id="img_50" src="./assets/images/blank.gif" alt="" width="50" height="50">
													<p>中尺寸头像</p><p>50*50像素</p><p>（自动生成）</p>
												</div>
												<div class="img_30">
													<img id="img_30" src="./assets/images/blank.gif" alt="" width="30" height="30">
													<p>小尺寸头像</p><p>30*30像素</p><p>（自动生成）</p>
												</div>
											</div>
										</div>
									</div>
								</div>
								<p class="submit upload_btn"><a href=""><span>保存</span></a><a href=""><span>取消</span></a></p>
							</div>
						</div>
					</div>
				</div>
				<!-- 返回顶部 -->
				<a class="gotop S_txt2" href="javascript:void(0);">
					<span>
						<s class="icon_gotop"></s>
						返回顶部
					</span>
				</a>
				<!-- 返回顶部结束 -->
			</div>
			<div class="global_footer"></div>
		</div>
	</div>
</body>
</html>