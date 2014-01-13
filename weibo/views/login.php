 <!doctype html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>新浪微博-随时随地分享身边的新鲜事儿</title>
 	<link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon .ico') ?>">
 	<link rel="stylesheet" href="<?php echo base_url('assets/css/reset.css') ?>">
 	<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>">
 	<script src="<?php echo base_url('assets/js/jquery-1.8.2.min.js') ?>"></script>
 	<script>
 		$(document).ready(function(){
 			/**
 			 * 登录文本框获得焦点隐藏提示文字，失去焦点显示提示文字
 			 */
 			 $('.login_form').find('input').on('focus',function(){
 			 	$(this).next('span').hide();
 			 })
 			 $('.login_form').find('input').on('blur',function(){
 			 	if($(this).val()==''){
 			 		$(this).next('span').show();
 			 	}
 			 })
 			})
 	</script>
 </head>
 <body class="body_login">
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
 					<a href=""><span>立即注册</span></a>
 				</div>
 				<div class="show_img">
 					<img src="<?php echo base_url('assets/images/wireless.jpg') ?>" alt="">
 				</div>
 			</div>
 			<div class="loginbox right">
 				<div class="login_form">
 					<p class="title">普通登录<i>|</i><a href="#">二维码登录</a></p>
 					<form action="">
 						<p>
 							<input type="text" name="account">
 							<span>请输入帐号</span>
 						</p>
 						<p>
 							<input type="text" name="passwd">
 							<span>请输入密码</span>
 						</p>
 						<p class="auto_login clearfix">
 							<label for="login_form_savestate" title="建议在网吧或公共电脑上取消该选项。" >
 								<input type="checkbox" class="checkbox" name="savestate" checked="checked" id="login_form_savestate">下次自动登录
 							</label>
 							<i class="icon_ask"></i>
 							<a href="#" class="right">忘记密码</a>
 						</p>
 						<div class="submit"><button><i></i>登录</button></div>
 						<p class="clearfix">还没微博<a href="#" class="right">立即注册</a></p>
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