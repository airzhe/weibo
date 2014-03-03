 <!doctype html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>新浪微博-随时随地分享身边的新鲜事儿</title>
 	<link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon .ico') ?>">
 	<link rel="stylesheet" href="<?php echo base_url('assets/css/reset.css') ?>">
 	<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>">
 	<script src="<?php echo base_url('assets/js/jquery-1.8.2.min.js') ?>"></script>
 	<script src="<?php echo base_url('assets/js/jquery.validate.js') ?>"></script>
 	<script src="<?php echo base_url('assets/js/runui.js') ?>"></script>
 	<script src="<?php echo base_url('assets/js/login.js') ?>"></script>
 	<style>
 	.form_tips{position:absolute;line-height: 28px;top:2px;}
 	.form_tips .icon_close{position:absolute;right:7px;top:11px;}
	.form_tips .wrap .content{background: #fffae1;padding:0 5px;}
	.arrow_tips{background:url(http://img.t.sinajs.cn/t5/style/images/layer/layer_arrow_tips.png) no-repeat;width:10px;height:8px;bottom:-4px;left:50%;margin-left:-7px;overflow:hidden;position:absolute}
 	</style>
 </head>
 <body class="login">
 	<div class="container">
 		<div class="header">
 			<div class="logo">
 				<img src="<?php echo base_url('assets/images/logo.png') ?>" alt="">
 			</div>
 		</div>
 		<div class="content clearfix">
 			<div class="leftbox left">
 				<div class="top">
 					还没有微博帐号？现在加入
 					<a href="" class="btn_reg_red"><span>立即注册</span></a>
 				</div>
 				<div class="show_img">
 					<img src="<?php echo base_url('assets/images/wireless.jpg') ?>" alt="">
 				</div>
 			</div>
 			<div class="loginbox right">
 				<div class="W_login_form">
 					<p class="title">普通登录<i class="W_vline S_txt2">|</i><a href="#">二维码登录</a></p>
 					<form action="#" method="post">
 						<p>
 							<input class="W_input" type="text" name="account" maxlength="128">
 							<span>请输入帐号</span>
 						</p>
 						<p>
 							<input class="W_input" type="password" name="passwd" maxlength="24">
 							<span>请输入密码</span>
 						</p>
 						<p class="auto_login clearfix">
 							<label for="login_form_savestate" title="建议在网吧或公共电脑上取消该选项。" >
 								<input type="checkbox" class="checkbox" name="savestate" checked="checked" id="login_form_savestate">下次自动登录
 							</label>
 							<i class="icon_ask"></i>
 							<a href="#" class="right">忘记密码</a>
 						</p>
 						<a href="javascript:void(0)" class="W_btn_g" id="submit"><span>登录</span></a>
 						<p class="S_txt2 clearfix ">还没微博？<a href="signup">立即注册！</a></p>
 					</form>
 					<div class="login_mode">
 						
 					</div>
 				</div>
 			</div>
 		</div>
 		<div class="footer">
 			<p>
 				<a href="#">iPhone/iPad</a>
 				<a href="#">Android</a>
 				<a href="#">Windows</a>
 				<a href="#">Phone</a>
 				<a href="#">其他手机端</a>
 				<a href="#">微博桌面</a>
 			</p>
 			<p>
 				<a href="#">微博帮助</a><i>|</i>
 				<a href="#">意见反馈</a><i>|</i>
 				<a href="#">微博认证及合作</a><i>|</i>
 				<a href="#">开放平台</a><i>|</i>
 				<a href="#">微博招聘</a><i>|</i>
 				<a href="#">新浪网导航</a><i>|</i>
 			</p>
 			<p>Copyright © 1996-2013 SINA 北京微梦创科网络技术有限公司京网文[2011]0398-130号京ICP证号全国人大常委会关于加强网络信息保护的决定</p>
 		</div>
 	</div>
 </body>
 </html>