<div class="content clearfix">
	<?php $this->load->view('components/follow_fans_left_nav');?>
	<div class="main">
		<div class="box_center">
			<div class="title">已有<?php echo $fans_total ?>人关注你 <a href="#"><i class="W_ico16 icon_trash"></i>垃圾箱 </a><a href="#" class="tips">没有尚未处理的关注请求</a></div>
			<div class="tab_normal clearfix">
				<div class="left">
					<a href="" class="W_btn_c"><span>全部</span></a>
					<a href="" class="W_btn_c"><span>按关注时间排序</span></a>
				</div>
				<div class="right">
					<div class="input_search">
						<input type="text" name="search" value="输入昵称或备注" >
						<a href="" class="W_ico20 iconsearch"></a>
					</div>
				</div>
			</div>
			<div class="myfans_list">
				<?php if (!isset($myfans_list)): ?>
					<p class="W_tips W_empty S_txt2"><i class="icon_warnS"></i>目前还没有人关注你</p>
				<?php else: ?>
					<?php foreach ($myfans_list as $v): ?>
						<div class="item clearfix">
							<div class="avatar left"> 
								<a href="<?php echo $v['domain'] ?>"><img src="<?php echo $v['avatar'] ?>" width="50" height="50" alt=""></a>
							</div>
							<div class="con clearfix">
								<div class="con_left left">
									<div class="name">
										<a href="<?php echo $v['domain'] ?>"><?php echo $v['username'] ?></a>
										<span class="addr"><i class="W_ico12 male"></i><?php echo $v['location'] ?></span>
									</div>
									<div>关注 <a href="javascript:void(0)"><?php echo $v['follow'] ?></a><i class="W_vline S_line1_c">|</i>粉丝 <a href="#"><?php echo $v['fans'] ?></a><i class="W_vline S_line1_c">|</i>微博 <a href="javascript:void(0)"><?php echo $v['weibo'] ?></a></div>
									<div>
										<?php if ($v['source']=='search'): ?>
											通过 <a href="#" class="S_link2">微博搜索</a>关注
										<?php else: ?>
											通过 <a href="#" class="S_link2">新浪微博</a>关注
										<?php endif ?>
										<a href="#" class="detail_more">更多</a>
									</div>
								</div>
								<div class="con_right right">
									<?php if ($v['relation']==2): ?>
										<a uid="<?php echo $v['uid'] ?>" source="fans" href="javascript:void(0)" class="addFollow W_btn_b"><span><i class="W_ico12 icon_addone"></i><em class="W_vline S_txt2">|</em><em class="addicon">+</em>关注</span></a>
									<?php else: ?>
										<a href="javascript:void(0)" class="W_btn_c"><span><i class="W_ico12 icon_addtwo"></i>互相关注</span></a>
									<?php endif ?>
									<a href="#"><i class="W_chat_stat"></i>私信</a><i class="S_line1_c">|</i><a uid="<?php echo $v['uid'] ?>" username="<?php echo $v['username'] ?>" href="javascript:void(0)" class="remove_fans">移除粉丝</a><i class="S_line1_c">|</i><a href="">举报</a>
								</div>
							</div>
						</div>
					<?php endforeach ?>
				<?php endif ?>
			</div>
		</div>
	</div>
</div>