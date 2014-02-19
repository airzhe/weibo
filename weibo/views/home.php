<?php $this->load->view('components/home_top') ?>
<div class="wrap S_bg4 clearfix">
	<div class="main left">
		<p class="tab_radious">
			<a href="#" class="active"><strong>全部</strong><span class="tabarrow"></span></a>
			<i class="S_txt3">|</i>
			<a href="#">原创</a>
			<i class="S_txt3">|</i>
			<a href="#">图片</a>
		</p>
		<div class="weibo_list feed_self" 
		<?php if (isset($weibo_offset)): ?>
			data-offset="<?php echo $weibo_offset ?>"
		<?php endif ?> 
		>
		<?php if (!isset($weibo_list)): ?>
			<p class="W_tips W_empty S_txt2"><i class="icon_warnS"></i>咦？暂时没有内容哦，稍后再来试试吧~~</p>
		<?php else: ?>
			<?php foreach ($weibo_list as $v): ?>
				<div class="item clearfix" data-id="<?php echo $v['id'] ?>">
					<?php if ($v['uid']==$this->session->userdata('uid')): ?>
						<div class="WB_screen">
							<a title="删除此条微博" class="W_ico12 icon_close" action-type="weibo_delete" href="javascript:;"></a>
						</div>
					<?php endif ?>
					
					<div class="detail">
						
						<div class="content">
							<?php echo $v['content'] ?>
						</div>
						<div class="func clearfix S_txt2">
							<div class="from left">
								<a href="#" class="S_link2 time"><?php echo $v['time'] ?></a> 来自<a href="" class="S_link2">新浪微博</a> 
							</div>
							<div class="handle right">
								<a href="javascript:void(0)"><s class="W_ico20 icon_praised_b"></s>(<?php echo $v['praise'] ?>)</a><i class="S_txt3">|</i><a href="javascript:void(0)">转发(<?php echo $v['turn'] ?>)</a><i class="S_txt3">|</i><a href="javascript:void(0)">收藏</a><i class="S_txt3">|</i><a href="javascript:void(0)">评论(<?php echo $v['collect'] ?>)</a>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach ?>
		<?php endif ?>
	</div>
	<!-- <div class="weibo_list feed_self">
		<div class="item">
			<div class="detail">
				<div class="content">
					这个很适合我，我的小马好累吖
				</div>
				<div class="media_prev">
					<ul>
						<li>
							<a href="javascript:void(0)"><img src="<?php echo base_url('assets/images/abb9e8d9jw1ec436y9swrj20a008s74i.jpg') ?>" alt=""></a>
						</li>
					</ul>
				</div>
				<div class="func clearfix S_txt2">
					<div class="from left"><a href="#" class="time">今天 07:48</a> 来自<a href="">新浪微博</a> </div>
					<div class="handle right"><a href=""><s class="icon_praised_b"></s>(29)</a><i class="S_txt3">|</i><a href="javascript:void(0)" class="forward">转发(71)</a><i class="S_txt3">|</i><a href="">收藏</a><i class="S_txt3">|</i><a href="">评论(22)</a></div>
				</div>
			</div>
		</div>
		<div class="item">
			<div class="detail">
				<div class="content">
					今天考试，开卷我就蒙了，不会写，监考老师转圈，将近30分钟，我一个字没写，老师看看我，我看看老师。40分钟的时候，我卷子写满。
				</div>
				<div class="func clearfix S_txt2">
					<div class="from left"><a href="#" class="time">今天 07:48</a> 来自<a href="">iPhone客户端</a> </div>
					<div class="handle right"><a href=""><s class="icon_praised_b"></s>(29)</a><i class="S_txt3">|</i><a href="">转发(71)</a><i class="S_txt3">|</i><a href="">收藏</a><i class="S_txt3">|</i><a href="">评论(22)</a></div>
				</div>
			</div>
		</div>
		<div class="item">
			<div class="detail">
				<div class="content">
					有几个是拼图的，这种小的尺寸全部是用一般的胶水冷压的，热激活胶水是粘超大型木皮用的。做这种其实不难，拼图案更复杂些。//<a href="#">@发粪涂墙的胖子</a>: 看起来要完贴皮啊 ，而且妥妥的手工制作了， 机器好像不怎么派得上用场。 <a href="#">@小殷爱录像</a> 说的那种热敏胶有卖的？
				</div>
				<div class="forwardContent"> 
					<div><a class="name" href="#">@湖边的森林6</a></div>
					<div class="content">
						随着年龄的增长我觉得自己越来越稳重拉阿哈哈哈哈哈叉腰仰天长笑！！
					</div>	
					<div class="media_prev">
						<ul class="lotspic_list clearfix">
							<li>
								<a href="javascript:void(0)"><img src="<?php echo base_url('assets/images/img1.jpg') ?>" alt=""></a>
							</li>
							<li>
								<a href="javascript:void(0)"><img src="<?php echo base_url('assets/images/img2.jpg') ?>" alt=""></a>
							</li>
							<li>
								<a href="javascript:void(0)"><img src="<?php echo base_url('assets/images/img3.jpg') ?>" alt=""></a>
							</li>
							<li>
								<a href="javascript:void(0)"><img src="<?php echo base_url('assets/images/img4.jpg') ?>" alt=""></a>
							</li>
							<li>
								<a href="javascript:void(0)"><img src="<?php echo base_url('assets/images/img5.jpg') ?>" alt=""></a>
							</li>
							<li>
								<a href="javascript:void(0)"><img src="<?php echo base_url('assets/images/img6.jpg') ?>" alt=""></a>
							</li>
							<li>
								<a href="javascript:void(0)"><img src="<?php echo base_url('assets/images/img7.jpg') ?>" alt=""></a>
							</li>
							<li>
								<a href="javascript:void(0)"><img src="<?php echo base_url('assets/images/img8.jpg') ?>" alt=""></a>
							</li>
							<li>
								<a href="javascript:void(0)"><img src="<?php echo base_url('assets/images/img9.jpg') ?>" alt=""></a>
							</li>
						</ul>
					</div>
					<div class="func clearfix S_txt2">
						<div class="from left"><a href="#" class="time">1月11日 23:01</a> 来自<a href="">pull</a> </div>
						<div class="handle right"><a href=""><s class="icon_praised_b"></s>(19)</a><i class="S_txt3">|</i><a href="">转发(71)</a><i class="S_txt3">|</i><a href="">收藏</a><i class="S_txt3">|</i><a href="">评论(22)</a></div>
					</div>
				</div>
				<div class="func clearfix S_txt2">
					<div class="from left"><a href="#" class="time">今天 07:48</a> 来自<a href="">iPhone客户端</a> </div>
					<div class="handle right"><a href=""><s class="icon_praised_b"></s>(29)</a><i class="S_txt3">|</i><a href="javascript:void(0)" class="forward">转发(71)</a><i class="S_txt3">|</i><a href="">收藏</a><i class="S_txt3">|</i><a href="">评论(22)</a></div>
				</div>
			</div>
		</div>
	</div> -->
	<a class="PRF_feed_list_more SW_fun_bg S_line2" href="javascript:void(0)"><span>查看更多微博»</span></a>
	<?php echo $page ?>
</div>
<?php $this->load->view('components/right_sidebar') ?>
</div>