<div class="content clearfix">
	<?php $this->load->view('components/follow_fans_left_nav');?>
	<div class="main">
		<div class="box_center">
			<div class="title">全部关注 <span class="num">(35个)</span> <i class="icon_warnS"></i><a href="#" class="tips">开通微博会员</a><span class="S_txt2">可提高关注上限</span></div>
			<div class="tab_normal clearfix">
				<div class="left">
					<a href="" class="W_btn_c"><span><i class="icon_recmd"></i>为你分组</span></a>
					<a href="" class="W_btn_c"><span>全部关注</span></a>
					<a href="" class="W_btn_c"><span>按关注时间排序</span></a>
					<a href="javascript:void(0)" class="W_btn_c_disable"><span>添加到</span></a>
					<a href="javascript:void(0)" uid="" username="" action-type="cancle_follow" class="W_btn_c_disable"><span>取消关注</span></a>
					<span class="selectText hide">已经选择<span class="S_spetxt">2</span>人</span>
					<a href="javascript:void(0)" class="cancel_select hide">取消选择</a>
				</div>
				<div class="right">
					<div class="input_search">
						<input type="text" name="search" value="输入昵称或备注" >
						<a href="" class="W_ico20 iconsearch"></a>
					</div>
				</div>
			</div>
			<div class="myfollow_list clearfix">
				<?php if (!isset($myfollow_list)): ?>
					<p class="W_tips W_empty S_txt2"><i class="icon_warnS"></i>你还没有关注的人</p>
				<?php else: ?>
					<?php foreach ($myfollow_list as $v): ?>
						<div class="item">
							<div class="avatar"> <a href="<?php echo $v['domain'] ?>"><img src="<?php echo $v['avatar'] ?>" width="50" height="50" alt=""></a></div>
							<div class="info">
								<ul>
									<li><a href="<?php echo $v['domain'] ?>" class="S_func1"><?php echo $v['username'] ?></a></li>
									<?php if ($v['relation']==1): ?>
										<li><i class="W_ico12 icon_addone"></i>已关注</li>
									<?php else: ?>
										<li><i class="W_ico12 icon_addtwo"></i>互相关注</li>
									<?php endif ?>
									<li><a href="#" class="S_link2">未分组</a></li>
								</ul>
							</div>
							<div class="intro S_txt2">
								<?php if ($v['intro']): ?>
									简介：<?php echo $v['intro'] ?>
								<?php else: ?>
									他还没有填写个人简介
								<?php endif ?>
							</div>
							<div class="introHover S_txt2"><a href="javascript:void(0)"><s class="W_chat_stat"></s>私信</a><i class="S_line1_c">|</i><a href="#">设置备注</a><i class="S_line1_c">|</i><a href="javascript:void(0)" uid="<?php echo $v['uid'] ?>" username="<?php echo $v['username'] ?>" action-type="cancle_follow">取消关注</a></div>
							<div class="introHover S_txt2">
								<?php if ($v['source']=='search'): ?>
									通过 <a href="#" class="S_link2">微博搜索</a>关注
								<?php else: ?>
									通过 <a href="#" class="S_link2">新浪微博</a>关注
								<?php endif ?>
							</div>
						</div>
					<?php endforeach ?>
				<?php endif ?>
				<div class="item">
					<div class="avatar"> <img src="assets/images/2.jpg" width="50" height="50" alt=""></div>
					<div class="info">
						<ul>
							<li><a href="#" class="S_func1">包子包子肉肉</a></li>
							<li><i class="W_ico12 icon_addtwo"></i>互相关注</li>
							<li><a href="#" class="S_link2">未分组</a></li>
						</ul>
					</div>
					<div class="intro S_txt2">简介：😱请叫我坏脾气姑娘😱</div>
					<div class="introHover S_txt2"><a href="javascript:void(0)"><s class="W_chat_stat"></s>私信</a><i class="S_line1_c">|</i><a href="#">设置备注</a><i class="S_line1_c">|</i><a href="javascript:void(0)">取消关注</a></div>
					<div class="introHover S_txt2">通过 <a href="#" class="S_link2">iPhone客户端</a> 关注</div>
				</div>
				<div class="item">
					<div class="avatar"> <img src="assets/images/01.jpg" width="50" height="50" alt=""></div>
					<div class="info">
						<ul>
							<li><a href="#" class="S_func1">Babyface_乖乖M</a></li>
							<li><i class="W_ico12 icon_addone"></i>已关注</li>
							<li><a href="#" class="S_link2">未分组</a></li>
						</ul>
					</div>
					<div class="intro S_txt2">简介：简介：93后财经和传媒双专业学生。摩羯女，慢吞吞。</div>
					<div class="introHover S_txt2"><a href="javascript:void(0)">求关注</a><i class="S_line1_c">|</i><a href="#">设置备注</a><i class="S_line1_c">|</i><a href="javascript:void(0)">取消关注</a></div>
					<div class="introHover S_txt2">通过 <a href="#" class="S_link2">iPhone客户端</a> 关注</div>
				</div>
				<div class="item">
					<div class="avatar"> <img src="assets/images/1.jpg" width="50" height="50" alt=""></div>
					<div class="info">
						<ul>
							<li><a href="#" class="S_func1">小殷爱录像</a></li>
							<li><i class="W_ico12 icon_addone"></i>已关注</li>
							<li><a href="#" class="S_link2">未分组</a></li>
						</ul>
					</div>
					<div class="intro S_txt2">简介：简介：×菊花教教主× MR曼秀雷敦</div>
					<div class="introHover S_txt2"><a href="javascript:void(0)">求关注</a><i class="S_line1_c">|</i><a href="#">设置备注</a><i class="S_line1_c">|</i><a href="javascript:void(0)">取消关注</a></div>
					<div class="introHover S_txt2">通过 <a href="#" class="S_link2">iPhone客户端</a> 关注</div>
				</div>
				<div class="item">
					<div class="avatar"> <img src="assets/images/4.jpg" width="50" height="50" alt=""></div>
					<div class="info">
						<ul>
							<li><a href="#" class="S_func1">糗事百科</a></li>
							<li><i class="W_ico12 icon_addone"></i>已关注</li>
							<li><a href="#" class="S_link2">未分组</a></li>
						</ul>
					</div>
					<div class="intro S_txt2"> 简介：有事请私信 商务合作请联系qq50620*** 投稿请猛击：http://www.qiu***baike.com/***</div>
					<div class="introHover S_txt2"><a href="javascript:void(0)">求关注</a><i class="S_line1_c">|</i><a href="#">设置备注</a><i class="S_line1_c">|</i><a href="javascript:void(0)">取消关注</a></div>
					<div class="introHover S_txt2">通过 <a href="#" class="S_link2">iPhone客户端</a> 关注</div>
				</div>
				<div class="item">
					<div class="avatar"> <img src="assets/images/02.jpg" width="50" height="50" alt=""></div>
					<div class="info">
						<ul>
							<li><a href="#" class="S_func1">南方周末</a></li>
							<li><i class="W_ico12 icon_addone"></i>已关注</li>
							<li><a href="#" class="S_link2">未分组</a></li>
						</ul>
					</div>
					<div class="intro S_txt2">简介：中国深具公信力和发行量最大的新闻周报</div>
					<div class="introHover S_txt2"><a href="javascript:void(0)">求关注</a><i class="S_line1_c">|</i><a href="#">设置备注</a><i class="S_line1_c">|</i><a href="javascript:void(0)">取消关注</a></div>
					<div class="introHover S_txt2">通过 <a href="#" class="S_link2">iPhone客户端</a> 关注</div>
				</div>
				<div class="item">
					<div class="avatar"> <img src="assets/images/04.jpg" width="50" height="50" alt=""></div>
					<div class="info">
						<ul>
							<li><a href="#" class="S_func1">苍井空</a></li>
							<li><i class="W_ico12 icon_addtwo"></i>互相关注</li>
							<li><a href="#" class="S_link2">未分组</a></li>
						</ul>
					</div>
					<div class="intro S_txt2">简介：大家好！我是苍井空. 有时演电影,唱歌,有时在电视节目中露露脸。为了更好的交流.我在努力地学习中文ing 工作邮箱：solaaoi@sina.cn</div>
					<div class="introHover S_txt2"><a href="javascript:void(0)">求关注</a><i class="S_line1_c">|</i><a href="#">设置备注</a><i class="S_line1_c">|</i><a href="javascript:void(0)">取消关注</a></div>
					<div class="introHover S_txt2">通过 <a href="#" class="S_link2">iPhone客户端</a> 关注</div>
				</div>
				<div class="item">
					<div class="avatar"> <img src="assets/images/3.jpg" width="50" height="50" alt=""></div>
					<div class="info">
						<ul>
							<li><a href="#" class="S_func1">梦境漫游指南</a></li>
							<li><i class="W_ico12 icon_addone"></i>已关注</li>
							<li><a href="#" class="S_link2">未分组</a></li>
						</ul>
					</div>
					<div class="intro S_txt2">简介：What goes around comes back around.[英语视频听译者;科技评论者,安卓应用汉化者]</div>
					<div class="introHover S_txt2"><a href="javascript:void(0)">求关注</a><i class="S_line1_c">|</i><a href="#">设置备注</a><i class="S_line1_c">|</i><a href="javascript:void(0)">取消关注</a></div>
					<div class="introHover S_txt2">通过 <a href="#" class="S_link2">新浪微博</a> 关注</div>
				</div>
			</div>
			<!-- <p class="page">
				<a href="#"><span>1</span></a><a href="#"><span>2</span></a><a href="#"><span>下一页</span></a>
			</p> -->
		</div>
	</div>
</div>