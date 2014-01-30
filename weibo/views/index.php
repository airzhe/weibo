<?php $this->load->view('components/common_left_nav');?>
<div class="main clearfix">
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
						<a href="javascript:void(0)" class="S_func1"><i class="W_ico16 icon_img"></i>图片</a>
						<a href="javascript:void(0)" class="S_func1"><i class="W_ico16 icon_video"></i>视频</a>
						<a href="javascript:void(0)" class="S_func1"><i class="W_ico16 icon_qing"></i>话题</a>
						<a href="javascript:void(0)" class="S_func1"><i class="W_ico16 icon_chang"></i>长微博</a>
					</div>
					<a href="javascript:void(0)" class="send_btn W_btn_v W_btn_v_disable right "><span>发布</span></a>
				</div>
				<div class="W_layer image_upload">
					<div class="bg">
						<div class="wrap">
							<div class="title">图片上传</div>
							<div class="content">
								<ul class="clearfix">
									<li class="S_line2"><a href="javascript:void(0)"><span></span></a></li>
									<li class="S_line2"><a href="javascript:void(0)"><span><i class="ico_l_ones"></i>拼图上传</span></a></li>
									<li class="S_line2"><a href="javascript:void(0)"><span><i class="ico_l_screenshot"></i>截屏上传</span></a></li>
									<li class="S_line2"><a href="javascript:void(0)"><span><i class="ico_l_toalbum"></i>传至相册</span></a></li>
								</ul>
							</div>
						</div>
					</div>
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
				<div class="weibo_list">
					<a href="" class="notes">有 1 条新微博，点击查看</a>
					<div class="item clearfix">
						<div class="face">
							<img  width="50" height="50" src="<?php echo base_url('assets/images/1.jpg') ?>" alt="">
						</div>
						<div class="detail">
							<div><a class="name S_func1" href="#">小殷爱录像</a></div>
							<div class="content">
								从前有个国王,他两个女儿的眼泪都会变成钻石.大女儿嫁给了一个用她的眼泪创造了一个个城堡的王子,小女儿却嫁给了牧羊人.国王临死见到他们的时候,大女儿满身金银珠宝,而小女儿和牧羊人仍是贫穷.国王很惊讶的说:明明她的一滴眼泪就够你们生活的很好. 牧羊人说:可是我舍不得让她哭啊.....
							</div>
							<div class="media_prev">
								<ul>
									<li>
										<a href="javascript:void(0)"><img src="<?php echo base_url('assets/images/7cff6573jw1ebibx4063cj20c60fhgmn.jpg') ?>" alt=""></a>
									</li>
								</ul>
							</div>
							<div class="func clearfix S_txt2">
								<div class="from left"><a href="#" class="S_link2 time">今天 07:48</a> 来自<a href="" class="S_link2">新浪微博</a> </div>
								<div class="handle right"><a href=""><s class="W_ico20 icon_praised_b"></s>(29)</a><i class="S_txt3">|</i><a href="">转发(71)</a><i class="S_txt3">|</i><a href="">收藏</a><i class="S_txt3">|</i><a href="">评论(22)</a></div>
							</div>
							<!-- 评论 -->
							<div class="comment S_line1">
								<div class="WB_arrow">
									<em class="S_line1_c">◆</em>
									<span class="S_bg4_c">◆</span>
								</div>
								<div class="W_loading">
									<span>正在加载，请稍候...</span>
								</div>
								<div class="W_tips tips_warn clearfix">
									<p>
										<span class="icon_warnS"></span>
										<span class="txt">新浪微博社区管理中心举报处理大厅，<a href="#">欢迎查阅！</a></span>
										<span class="close right"><a href="javascript:void(0);" class="W_ico12 icon_close"></a></span>
									</p>
								</div>
								<textarea name="" id="" class="W_input"></textarea>
								<p class="clearfix"><a href="javascript:void(0)" action-type="face"><i class="W_ico16 ico_faces"></i></a><input type="checkbox" name="" class="W_checkbox">同时转发到我的微博<a href="" class="W_btn_b right"><span>评论</span></a></p>
								<div class="C_item S_line1">
									<div class="face left">
										<img src="./assets/images/_1.jpg" width="30" height="30" alt="">
									</div>
									<div class="C_detail">
										<p><a href="">D瓜哥-李_君</a>：回复<a href="">@叉色-xsir</a>:恩，说实话我对这块专门看过一些资料。所以问的比较多。哈哈<span class="S_txt2">(1月5日 22:07)</span></p>
										<p class="info"><a href="#"><i class="W_ico20 icon_praised_b"></i></a><i class="S_txt3">|</i><a href="#">查看对话</a><i class="S_txt3">|</i><a href="#">回复</a></p>
									</div>
								</div>
								<div class="C_item S_line1">
									<div class="face left">
										<img src="./assets/images/_2.jpg" width="30" height="30" alt="">
									</div>
									<div class="C_detail">
										<p><a href="">叉色-xsir</a>：前端后端都有啊。。。前端优化问的还蛮细的<span class="S_txt2">(1月5日 22:07)</span></p>
										<p class="info"><a href="#"><i class="W_ico20 icon_praised_b"></i></a><i class="S_txt3">|</i><a href="#">回复</a></p>
										<!-- 回复对话框 -->
										<div class="repeat S_line1 S_bg1">
											<div class="WB_arrow"><em class="S_line1_c">◆</em><span class=" S_bg1_c">◆</span></div>
											<div class="S_line1 input clearfix">
												<textarea name="" class="W_input" cols="30" rows="10"></textarea>
												<p class="clearfix">
													<span class="left"><a href="javascript:void(0)" action-type="face"><i class="W_ico16 ico_faces"></i></a><input type="checkbox" name="" class="W_checkbox"> 同时转发到我的微博</span>
													<a href="" class="W_btn_a right"><span>评论</span></a>
												</p>
											</div>
										</div>
										<!-- 回复对话框 -->
									</div>
								</div>
							</div>
							<!-- 评论结束 -->
						</div>
					</div>
					<div class="item clearfix">
						<div class="face">
							<img  width="50" height="50" src="<?php echo base_url('assets/images/2.jpg') ?>" alt="">
						</div>
						<div class="detail">
							<div><a class="name S_func1" href="#">包子包子肉肉</a></div>
							<div class="content">
								转发微博
							</div>
							<div class="forwardContent"> 
								<div><a class="name S_func1" href="#">@收集世上的美景</a></div>
								<div class="content">
									【中国最美五大沙漠】巴丹吉林沙漠，塔克拉玛干沙漠，鸣沙山—月牙泉，古尔班通古特沙漠，沙坡头。一生一定要去次沙漠，体验烈日风沙，体味孤独辽远，它在那里等你，等候了千年。什么时候启程吧！
								</div>	
								<div class="media_prev">
									<ul>
										<li>
											<a href="javascript:void(0)"><img src="<?php echo base_url('assets/images/c31ab1f2jw1ecfxy8kvhej20c811xaga.jpg') ?>" alt=""></a>
										</li>
									</ul>
								</div>
								<div class="func clearfix S_txt2">
									<div class="from left"><a href="#" class="S_func2 time">1月11日 23:01</a> 来自<a href="" class="S_func2">pull</a> </div>
									<div class="handle right"><a href=""><s class="W_ico20 icon_praised_b"></s>(19)</a><i class="S_txt3">|</i><a href="" class="S_func2">转发(71)</a><i class="S_txt3">|</i><a href="" class="S_func2">收藏</a><i class="S_txt3">|</i><a href="" class="S_func2">评论(22)</a></div>
								</div>
							</div>

							<div class="func clearfix S_txt2">
								<div class="from left"><a href="#" class="time S_link2">今天 07:48</a> 来自<a href="" class="S_link2">新浪微博</a> </div>
								<div class="handle right"><a href=""><s class="W_ico20 icon_praised_b"></s>(29)</a><i class="S_txt3">|</i><a href="">转发(71)</a><i class="S_txt3">|</i><a href="">收藏</a><i class="S_txt3">|</i><a href="">评论(22)</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="box_right right">
		<a class="set_skin" href="#" title="模板设置"></a>
		<div class="user_info">
			<a href="home"><img  width="80" height="80" src='<?php echo base_url("assets/images/$user[avatar].gif") ?>' alt=""></a>
			<div>
				<a href="home" class="username S_func1"><?php echo $user['username'] ?></a>
				<br>
				<a href="" class="W_level_ico color3"><span class="W_level_num l7"></span></a>
			</div>
		</div>
		<ul class="user_atten clearfix">
			<li>
				<a href="#" class="S_func1">
					<strong><?php echo $user['follow'] ?></strong>
					<span>关注</span>
				</a>
			</li>
			<li>
				<a href="#" class="S_func1">
					<strong><?php echo $user['fans'] ?></strong>
					<span>粉丝</span>
				</a>
			</li>
			<li>
				<a href="#" class="S_func1">
					<strong><?php echo $user['weibo'] ?></strong>
					<span>微博</span>
				</a>
			</li>
		</ul>
		<div class="hot_topics">
			<fieldset>
				<legend class="S_txt2"><a href="#">热门话题</a></legend>
			</fieldset>
			<ul>
				<li><a href="#">#汤唯遭遇电信诈骗#</a><span class="total S_txt2">2634万</span></li>
				<li><a href="#">#当时忍住就好了#</a><span class="total S_txt2">328万</span></li>
				<li><a href="#">#爱情公寓4#</a><span class="total S_txt2">285</span></li>
				<li><a href="#">#孙悟空后人#</a><span class="total S_txt2">3万</span></li>
				<li><a href="#">#来自星星的你#</a><span class="total S_txt2">854万</span></li>
				<li><a href="#">#中国好歌曲#</a><span class="total S_txt2">677</span></li>
			</ul>
		</div>		
	</div>
</div>