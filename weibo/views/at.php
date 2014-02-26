<div class="content clearfix">
	<?php $this->load->view('components/common_left_nav');?>
	<div class="main clearfix">
		<div class="box_center left">
			<div class="title">@我的微博</div>
			<div class="tab_normal clearfix">
				<div class="left">
					<a href="">所有人</a>	<i class="W_vline S_txt2">|</i><a href="">所有微博</a>
				</div>
				<div class="right">
					<span class="S_txt2"><i class="icon_lock"></i>消息箱功能设置设置</span>
					<a href="#" class="set">设置</a>
				</div>
			</div>
			<div class="weibo_list atme" >
				<?php if (!isset($weibo_list)): ?>
					<a href="" class="notes">没有内容哦~~</a>
				<?php else: ?>
					<?php foreach ($weibo_list as $v): ?>
						<div class="item clearfix" data-id="<?php echo $v['id'] ?>" data-atid="<?php echo $v['atid'] ?>">
							<div class="WB_screen">
								<a title="隐藏此条微博" class="W_ico12 icon_hide" action-type="at_delete" href="javascript:;"></a>
							</div>
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
													<a href="javascript:void(0)"><s class="W_ico20 icon_praised_b"></s>(<?php echo $forward['praise'] ?>)</a><i class="S_txt3">|</i><a href="javascript:void(0)" class="S_func2">转发(<?php echo $forward['turn'] ?>)</a><i class="S_txt3">|</i><a href="javascript:void(0)" class="S_func2">收藏</a><i class="S_txt3">|</i><a href="javascript:void(0)" class="S_func2">评论(<?php echo $forward['comment'] ?>)</a>
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
		</div>
		<div class="box_right right">
			<div class="item">
				<fieldset>
					<legend class="title">消息箱使用小帮助</legend>
				</fieldset>
				<div class="qa S_txt2">
					<i class="W_ico16 ico_q"></i>：什么是消息箱？<br/>
					A：是将@我的，评论，赞，私信等消息相关类-服务综合在一起的消息中心，在这里可以看到所有的消息提示。<br>
					<a href="#">点击这里提交意见反馈</a>
				</div>
			</div>
			<div class="item">
				<fieldset>
					<legend class="title">新浪微博意见反馈</legend>
				</fieldset>
				<div class="qa S_txt2">
					欢迎使用新浪微博并提出宝贵建议。请<a href="">点击这里</a>提交微博意见反馈。<br>
					<a href="#">微博常见问题</a><br>
					<a href="#">微博客服专区</a><br>
					<a href="#">全国人大常委会《关于加强网络信息保护的决定》</a>
				</div>
			</div>
		</div>
	</div>
</div>