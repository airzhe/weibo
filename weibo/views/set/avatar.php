<style>
	.uploadify .uploadify-button {
		font-size: 12px;
		height:30px;
		line-height: 30px;
		text-align: right;
	}
	.uploadify span{margin-right: 7px;}
	.uploadify:hover .uploadify-button {
		background-position: 0 -30px;
		color:#fff;
	}
	.uploadify-queue{display: none;}
</style>
<div class="content clearfix">
	<?php $this->load->view('components/set_left_nav');?>
	<div class="main">
		<div class="box_center">
			<div class="title clearfix">头像<span class="S_txt2 right">无法上传头像？<a href="#">尝试普通方式上传</a></span></div>
			<div class="upload_avatar">
				<p><strong>选择上传方式</strong></p>
				<div class="upload_btn">
					<a href="" class="W_btn_b"><span>选择上传</span></a>
				</div>
				<p class="S_txt2">仅支持JPG、GIF、PNG格式，文件小于5M（使用高质量图片，可生成高清头像）</p>
				<p><input type="checkbox" name="" checked="checked">上传原始图片，生成高清头像</p>
				<div class="preview clearfix">
					<div class="big left">
						<div class="img_300">
							<img src="<?php echo base_url('/assets/images/up_bg.gif')?>" alt="" width="300" height="300">
						</div>
					</div>
					<div class="small">
						<p>您上传的图片将会自动生成三种尺寸头像，请注意中小尺寸的头像是否清晰</p>
						<div class="avatar clearfix">
							<div class="img_180 left">
								<img id="img_180" src="<?php echo $avatar['big'] ?>" alt="" width="180" height="180">
								<p>大尺寸头像,180*180像素</p>
							</div>
							<div class="right">
								<div class="img_50">
									<img id="img_50" src="<?php echo $avatar['big'] ?>" alt="" width="50" height="50">
									<p>中尺寸头像</p><p>50*50像素</p><p>（自动生成）</p>
								</div>
								<div class="img_30">
									<img id="img_30" src="<?php echo $avatar['big'] ?>" alt="" width="30" height="30">
									<p>小尺寸头像</p><p>30*30像素</p><p>（自动生成）</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<p class="submit"><a href="" class="W_btn_a"><span>保存</span></a><a href="" class="W_btn_c"><span>取消</span></a></p>
			</div>
		</div>
	</div>
</div>