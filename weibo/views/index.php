<?php $this->load->view('components/common_left_nav');?>
<div class="main clearfix">
	<div class="box_right right">
		<a class="set_skin" href="javascript:void(0)" action-type="set_skin" title="模板设置"></a>
		<div class="user_info">
			<a href="<?php echo site_url('home') ?>"><img  width="80" height="80" src="<?php echo $user['avatar'] ?>" alt=""></a>
			<div>
				<a href="<?php echo site_url('home') ?>" class="username S_func1"><?php echo $user['username'] ?></a>
				<br>
				<a href="" class="W_level_ico color3"><span class="W_level_num l7"></span></a>
			</div>
		</div>
		<ul class="user_atten clearfix">
			<li>
				<a href="<?php echo site_url('follow') ?>" class="S_func1">
					<strong id="my_follow"><?php echo $user['follow'] ?></strong>
					<span>关注</span>
				</a>
			</li>
			<li>
				<a href="<?php echo site_url('fans') ?>" class="S_func1">
					<strong id="my_fans"><?php echo $user['fans'] ?></strong>
					<span>粉丝</span>
				</a>
			</li>
			<li>
				<a href="<?php echo site_url('home') ?>" class="S_func1">
					<strong id="my_weibo"><?php echo $user['weibo'] ?></strong>
					<span>微博</span>
				</a>
			</li>
		</ul>
		<div class="hot_topics">
			<fieldset>
				<legend class="S_txt2"><a href="#">推荐用户</a></legend>
			</fieldset>
			<ul>
				<?php foreach ($recommend_user as $v): ?>
					<li><a href="<?php echo $v['domain'] ?>"><?php echo $v['username'] ?></a><span class="total S_txt2"><?php echo $v['fans'] ?> 粉丝</span></li>
				<?php endforeach ?>
			</ul>
		</div>		
	</div>
	<div class="box_center left">
		<div>
			<div class="send_weibo">
				<div class="title_area">
					有什么新鲜事想告诉大家？
					<s></s>
				</div>
				<div class="W_input input">
					<textarea name="" title="微博输入框" class="input_detail" id="weibo_input_detail"></textarea>
					<span class="arrow"></span>
					<div class="send_succpic hide">
						<p class="icon_succB"></p>
						<p class="txt">发布成功</p>
					</div>
				</div>
				<div class="tips_num S_txt2">发言请遵守社区公约，<span>还可以输入</span><i id="num_count">140</i>字</div>
				<div class="func_area clearfix">
					<div class="kind_detail left">
						<a href="javascript:void(0)" class="S_func1" action-type="face" action-id="weibo_input_detail"><i class="W_ico16 icon_face"></i>表情</a>
						<a href="javascript:void(0)" class="S_func1" action-type="upload_image" action-id="weibo_input_detail"><i class="W_ico16 icon_img"></i>图片</a>
						<a href="javascript:void(0)" class="S_func1 disable"><i class="W_ico16 icon_video"></i>视频</a>
						<a href="javascript:void(0)" class="S_func1 disable"><i class="W_ico16 icon_qing"></i>话题</a>
						<a href="javascript:void(0)" class="S_func1 disable"><i class="W_ico16 icon_chang"></i>长微博</a>
					</div>
					<a href="javascript:void(0)" class="send_btn W_btn_v W_btn_v_disable right "><span>发布</span></a>
				</div>
			</div>
			<div class="weibo">
				<div class="feed_nav">
					<h3>微博</h3>
					<div class="bg"></div>
					<p class="weibo_type">
						<a href="#" class="active">全部</a>
						<a href="#">原创</a>
						<a href="#">图片</a>
						<a href="#">视频</a>
						<a href="#">音乐</a>
					</p>
				</div>
				<div class="weibo_list" <?php if (isset($weibo_start)){echo "data-start=$weibo_start";} ?> load-time=<?php echo time() ?> >
					<?php if (!isset($weibo_list)): ?>
						<a href="" class="notes">您还没有发表过微博，赶快发表篇试试吧。</a>
					<?php else: ?>
						<?php foreach ($weibo_list as $v): ?>
							<div class="item clearfix" data-id="<?php echo $v['id'] ?>">
								<?php if(isset($v['me'])): ?>
									<div class="WB_screen">
										<a title="删除此条微博" class="W_ico12 icon_close" action-type="weibo_delete" href="javascript:;"></a>
									</div>
								<?php endif ?>
								<div class="face">
									<a href="<?php echo $v['domain'] ?>"><img width="50" height="50" src="<?php echo $v['avatar'] ?>" alt=""></a>
								</div>
								<div class="detail">
									<div>
										<a class="name S_func1" href="<?php echo $v['domain'] ?>"><?php echo $v['username'] ?></a>
									</div>
									<div class="content">
										<?php echo $v['content'] ?>
									</div>
									<!-- 微博配图 -->
									<?php if ($v['picture']): ?>
										<div class="media_prev">
											<ul <?php if(isset($v['pic_class'])) echo "class='{$v['pic_class']} clearfix'" ?>>
												<?php foreach ($v['pic'] as $key => $_v): ?>
													<li>
														<a href="javascript:void(0)"><img src="<?php echo base_url().$v['pic_path'].$_v['picture'] ?>" alt=""></a>
													</li>
												<?php endforeach ?>
											</ul>
										</div>
										<div class="media_expand SW_fun2 S_line1 S_bg1"  node-type="feed_list_media_disp">
											<p class="medis_func S_txt3">
												<a class="retract" href="javascript:void(0);"><em class="W_ico12 ico_retract"></em>收起</a><i class="W_vline">|</i>
												<a class="show_big" href="javascript:void(0);" target="_blank"><em class="W_ico12 ico_showbig"></em>查看大图</a><i class="W_vline">|</i>
												<a class="turn_left" href="javascript:void(0);" ><em class="W_ico12 ico_turnleft"></em>向左转</a><i class="W_vline">|</i>
												<a class="turn_right" href="javascript:void(0);"><em class="W_ico12 ico_turnright"></em>向右转</a>
											</p>
											<div>
												<img src="<?php echo base_url('assets/images/blank.gif') ?>" alt="">
											</div>
										</div>
									<?php endif ?>
									<!-- 转发 -->
									<?php if ($v['isturn']):$wid=$v['isturn'] ?>
										<div class="forwardContent">
											<div class="WB_arrow">
												<em class="S_line1_c">◆</em>
												<span class="S_bg1_c">◆</span>
											</div>
											<?php if (isset($forward_list[$wid])): $forward=$forward_list[$wid]?>
												<div>
													<a class="name S_func1" href="<?php echo $forward['domain'] ?>">@<?php echo $forward['username'] ?></a>
												</div>
												<div class="content">
													<?php echo $forward['content'] ?>
												</div>
												<!-- 转发的微博配图 -->
												<?php if ($forward['picture']): ?>
													<div class="media_prev">
														<ul <?php if(isset($forward['pic_class'])) echo "class='{$forward['pic_class']} clearfix'" ?>>
															<?php foreach ($forward['pic'] as $key => $_v): ?>
																<li>
																	<a href="javascript:void(0)"><img src="<?php echo base_url().$forward['pic_path'].$_v['picture'] ?>" alt=""></a>
																	<!-- <i class="ico_loading"></i> -->
																</li>
															<?php endforeach ?>
														</ul>
													</div>
													<div class="media_expand SW_fun2 S_line1 S_bg1"  node-type="feed_list_media_disp">
														<p class="medis_func S_txt3">
															<a class="retract" href="javascript:void(0);"><em class="W_ico12 ico_retract"></em>收起</a><i class="W_vline">|</i>
															<a class="show_big" href="javascript:void(0);" target="_blank"><em class="W_ico12 ico_showbig"></em>查看大图</a><i class="W_vline">|</i>
															<a class="turn_left" href="javascript:void(0);" ><em class="W_ico12 ico_turnleft"></em>向左转</a><i class="W_vline">|</i>
															<a class="turn_right" href="javascript:void(0);"><em class="W_ico12 ico_turnright"></em>向右转</a>
														</p>
														<div>
															<img src="<?php echo base_url('assets/images/blank.gif') ?>" alt="">
														</div>
													</div>
												<?php endif ?>
												<div class="func clearfix S_txt2">
													<div class="from left">
														<a href="#" class="S_func2 time"><?php echo $forward['time'] ?></a> 来自<a href="" class="S_func2">新浪微博</a> 
													</div>
													<div class="handle right">
														<a href="javascript:void(0)"><s class="W_ico20 icon_praised_b"></s>(<?php echo $forward['praise'] ?>)</a><i class="S_txt3">|</i><a href="<?php echo $forward['url'] ?>" class="S_func2">转发(<?php echo $forward['turn'] ?>)</a><i class="S_txt3">|</i><a href="<?php echo $forward['url'] ?>" class="S_func2">评论(<?php echo $forward['comment'] ?>)</a>
													</div>
												</div>
											<?php else: ?>
												<div class="WB_deltxt">
													抱歉，此微博已被作者删除。查看帮助：<a href="">http://t.cn/zWSudZc</a>
												</div>
											<?php endif ?>
										</div>
									<?php endif ?>
									<div class="func clearfix S_txt2">
										<div class="from left">
											<a href="#" class="S_link2 time"><?php echo $v['time'] ?></a> 来自<a href="" class="S_link2">新浪微博</a> 
										</div>
										<div class="handle right">
											<a href="javascript:void(0)" action-type="praise"><s class="W_ico20 icon_praised_b"></s>(<?php echo $v['praise'] ?>)</a><i class="S_txt3">|</i><a href="javascript:void(0)" action-type="turn" >转发(<?php echo $v['turn'] ?>)</a><i class="S_txt3">|</i><a href="javascript:void(0)" action-type="collect">收藏</a><i class="S_txt3">|</i><a href="javascript:void(0)" action-type="comment">评论(<?php echo $v['comment'] ?>)</a>
										</div>
									</div>
									<!-- 评论 -->
									<div class="comment S_line1 hide">
										<div class="WB_arrow">
											<em class="S_line1_c">◆</em>
											<span class="S_bg4_c">◆</span>
										</div>
									</div>
									<!-- 评论结束 -->
								</div>
							</div>
						<?php endforeach ?>
					<?php endif ?>
				</div>
				<div class="W_loading"  node-type="lazyload">
					<i class="ico_loading"></i><span>正在加载，请稍候...</span>
				</div>
				<?php echo $page ?>
			</div>
		</div>
	</div>
</div>