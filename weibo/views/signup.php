<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>新浪微博注册</title>
	<link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon .ico') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/reset.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>">
	<script src="<?php echo base_url('assets/js/jquery-1.8.2.min.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.validate.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.calendar.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.cxselect.min.js') ?>"></script>
	<script>
		var site_url= '<?php echo site_url()?>'
	</script>
	<script src="<?php echo base_url('assets/js/signup.js') ?>"></script>
</head>
<body class="signup">
	<div class="header_line">
		
	</div>
	<div class="container">
		<div class="reg_header">
			<div class="logo_big">
			</div>
		</div>
		<div class="content">
			<div class="reg_title"><a  class="cur">个人注册</a> <i class="vline">|</i> 企业注册</div>
			<div class="reg_info clearfix">
				<div class="W_reg_form  left">
					<form action="signup" method="post">
						<div class="info_list clearfix">
							<div class="tit left"><i>*</i>邮箱：</div>
							<div class="inp">
								<input class="W_input" type="text" placeholder="请输入您的常用邮箱" name="account">
								<div class="attachment">没有邮箱？<a href="#">用手机注册</a></div>
							</div>
							<div class="tips">
								<p class="notice"><i class="icon_warn"></i><label>您输入的邮箱将作为微博登录名</label></p>
							</div>
						</div>
						<div class="info_list clearfix">
							<div class="tit left"><i>*</i>设置密码：</div>
							<div class="inp">
								<input class="W_input" type="password" name="passwd">
							</div>
							<div class="tips">
								<p class="notice"><i class="icon_warn"></i><label>请输入6-16位数字、字母或常用符号，字母区分大小写</label></p>
							</div>
						</div>
						<div class="info_list clearfix">
							<div class="tit left"><i>*</i>昵称：</div>
							<div class="inp">
								<input class="W_input" type="text" name="username">
							</div>
							<div class="tips">
								<p class="notice"><i class="icon_warn"></i><label>请输入4-24位字符：支持中文、英文、数字、“-”、“_”</label></p>
							</div>
						</div>
						<div class="info_list clearfix">
							<div class="tit left"><i>*</i>生日：</div>
							<div class="inp">
								<select id="idYear" name="birthday[]" data="0"></select> 年 <select id="idMonth" name="birthday[]" data="1"></select> 月 <select id="idDay" name="birthday[]" data="1"></select> 日
							</div>
							<div class="tips" style="margin-left:80px;top:8px;">
								<p class="error"><i class="icon_rederrorS"></i><label></label></p>
							</div>
						</div>
						<div class="info_list clearfix">
							<div class="tit left"><i>*</i>性别：</div>
							<div class="inp choose">
								<label><input type="radio" name="sex">男</label>
								<label><input type="radio" name="sex">女</label>
							</div>
							<div class="tips">
								<p class="notice"><i class="icon_rederrorS"></i></p>
							</div>
						</div>
						<div class="info_list clearfix">
							<div class="tit left"><i>*</i>所在地：</div>
							<div class="inp" id="city">
								<select class="province" data-val="浙江" data-title="选择省" name="locaotion[]"></select>
								<select class="city" data-title="选择市" name="locaotion[]" disabled="disabled"></select>
								<select class="area" data-title="选择地区" name="locaotion[]" disabled="disabled"></select>
							</div>
							<div class="tips" style="margin-left:60px;">
								<p class="error"><i class="icon_rederrorS"></i><label></label></p>
							</div>
						</div>
						<div class="info_list clearfix">
							<div class="tit left" style="margin-top:8px;"><i>*</i>验证码：</div>
							<div class="inp">
								<input class="W_input" type="text" name="code">
								<img src="<?php  echo 'code' ?>" alt="" id="code">
								<a href="javascript:void(0);" title="看不清，换一张" class="verify_refresh"></a>
							</div>
							<div class="tips">
								<p class="error"><i class="icon_warn"></i><label>请输入验证码</label></p>
							</div>
						</div>
						<div class="info_list">
							<div class="inp">
								<a href="javascript:void(0)" class="W_btn_big W_btn_g" id="submit"><span>立即注册</span></a>
							</div>
						</div>
						<div class="info_list">
							<div class="inp">
								<ul class="agreement">
									<li><a href="#">新浪微博服务使用协议</a></li>
									<li><a href="#">新浪微博个人信息保护政策</a></li>
									<li><a href="#">全国人大常委会关于加强网络信息保护的决定</a></li>
								</ul>
							</div>
						</div>
					</form>
				</div>
				<div class="reg_sidebar right">
					<p>已有帐号，<a href="login">直接登录»</a></p>
					<p>手机快速注册</p>
					<p class="S_txt2">编辑短信：</p>
					<p class="p3">6-16位数字</p>
					<p class="S_txt2">作为登录密码发送至：</p>
					<p class="p3">1069 009 088</p>
					<p class="S_txt2">即可注册成功。</p>
				</div>
			</div>
		</div>
		<p class="footer clearfix">
			<span class="left"><i class="footer_logo"></i>北京微梦创科网络技术有限公司 京网文[2011]0398-130号 京ICP证100780号</span> <span class="right">Copyright © 1996-2013 SINA</span> 
		</p>
	</div>
</body>
</html>