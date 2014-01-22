<?php 
class json extends Front_Controller{
	public function set_skin(){
		$set_template=<<<str
		<div class="W_layer set_template" style="top: 544px; left: 757.5px;">
			<div class="bg">
				<div class="wrap">
					<div class="title" style="cursor: move; -webkit-user-select: none;">
						个性化设置
					</div>
					<div class="content">
						<ul class="profile_tab S_line1 clearfix ">
							<li class="current S_line1"><a href="javascript:void(0)">套装</a></li>
							<li class="S_line1"><a href="javascript:void(0)">模板</a></li>
							<li class="S_line1"><a href="javascript:void(0)">封面图</a></li>
							<li class="S_line1"><a href="javascript:void(0)">自定义</a></li>
						</ul>
						<div>
							<div class="suitControlPanel">
								<ul class="tab_nosep clearfix">
									<li class="current"><a href="#">推荐</a></li>
									<li><a href="#">七天换装</a></li>
									<li><a href="#">会员</a></li>
									<li><a href="#">动态</a></li>
								</ul>
								<ul class="templete_list clearfix">
									<li><a href="" class="current"><img src="./assets/images/skin/suit/skin.png" alt="" width="123" height="73"><span>雨夜</span></a></li>
									<li><a href=""><img src="./assets/images/skin/suit/skin_001.png" alt="" width="123" height="73"><span>太空</span></a></li>
									<li><a href=""><img src="./assets/images/skin/suit/skin_002.png" alt="" width="123" height="73"><span>团团圆圆</span></a></li>
									<li><a href=""><img src="./assets/images/skin/suit/skin_003.png" alt="" width="123" height="73"><span>神偷奶爸2</span></a></li>
									<li><a href=""><img src="./assets/images/skin/suit/skin_004.png" alt="" width="123" height="73"><span>漓彩</span></a></li>
									<li><a href=""><img src="./assets/images/skin/suit/skin_005.png" alt="" width="123" height="73"><span>保护北冰洋</span></a></li>
									<li><a href=""><img src="./assets/images/skin/suit/skin_006.png" alt="" width="123" height="73"><span>带TA回家</span></a></li>
									<li><a href=""><img src="./assets/images/skin/suit/skin_007.png" alt="" width="123" height="73"><span>下雪啦</span></a></li>
								</ul>
							</div>
							<div class="sysControlPanel hide">
								<ul class="tab_nosep clearfix">
									<li class="current"><a href="#">推荐</a></li>
									<li><a href="#">童趣</a></li>
									<li><a href="#">时尚</a></li>
									<li><a href="#">校园</a></li>
									<li><a href="#">节日</a></li>
									<li><a href="#">经典</a></li>
								</ul>
								<ul class="templete_list clearfix">
									<li><a href="" class="current"><img src="./assets/images/skin/bg/skin.png" alt="" width="123" height="73"><span>风轻云淡</span></a></li>
									<li><a href=""><img src="./assets/images/skin/bg/skin_001.png" alt="" width="123" height="73"><span>我们结婚吧</span></a></li>
									<li><a href=""><img src="./assets/images/skin/bg/skin_002.png" alt="" width="123" height="73"><span>猫趣</span></a></li>
									<li><a href=""><img src="./assets/images/skin/bg/skin_003.png" alt="" width="123" height="73"><span>复古</span></a></li>
									<li><a href=""><img src="./assets/images/skin/bg/skin_004.png" alt="" width="123" height="73"><span>沙滩漫步</span></a></li>
									<li><a href=""><img src="./assets/images/skin/bg/skin_005.png" alt="" width="123" height="73"><span>漓彩</span></a></li>
									<li><a href=""><img src="./assets/images/skin/bg/skin_006.png" alt="" width="123" height="73"><span>Iam 80后</span></a></li>
									<li><a href=""><img src="./assets/images/skin/bg/skin_007.png" alt="" width="123" height="73"><span>梦幻</span></a></li>
								</ul>
							</div>
							<div class="coverControlPanel hide">
								<ul class="tab_nosep clearfix">
									<li class="current"><a href="#">推荐</a></li>
									<li><a href="#">卡通</a></li>
									<li><a href="#">田园</a></li>
									<li><a href="#">时尚</a></li>
									<li><a href="#">萌</a></li>
									<li><a href="#">静物</a></li>
									<li><a href="#">风景</a></li>
								</ul>
								<ul class="templete_list cover_list clearfix">
									<li><a href="" class="current"><img src="./assets/images/skin/cover/001_s.jpg" alt="" width="258" height="78"><span>弹钢琴的小老鼠</span></a></li>
									<li><a href=""><img src="./assets/images/skin/cover/002_s.jpg" alt="" width="258" height="78"><span>蝴蝶纷飞</span></a></li>
									<li><a href=""><img src="./assets/images/skin/cover/003_s.jpg" alt="" width="258" height="78"><span>绮丽街景</span></a></li>
									<li><a href=""><img src="./assets/images/skin/cover/004_s.jpg" alt="" width="258" height="78"><span>绿芽</span></a></li>
								</ul>
							</div>
							<div class="diyControlPanel hide">
								<ul class="tab_nosep clearfix">
									<li class="current"><a href="#">自定义模板</a></li>
									<li><a href="#">自定义封面图</a></li>
								</ul>
								<p><span>推荐配色</span></p>
								<ul class="diy_list clearfix">
									<li><a href="" class="current"><img src="./assets/images/skin/style/1.png" alt=""></a></li>
									<li><a href=""><img src="./assets/images/skin/style/2.png" alt=""></a></li>
									<li><a href=""><img src="./assets/images/skin/style/3.png" alt=""></a></li>
									<li><a href=""><img src="./assets/images/skin/style/4.png" alt=""></a></li>
									<li><a href=""><img src="./assets/images/skin/style/5.png" alt=""></a></li>
									<li><a href=""><img src="./assets/images/skin/style/6.png" alt=""></a></li>
									<li><a href=""><img src="./assets/images/skin/style/7.png" alt=""></a></li>
									<li><a href=""><img src="./assets/images/skin/style/8.png" alt=""></a></li>
									<li><a href=""><img src="./assets/images/skin/style/9.png" alt=""></a></li>
									<li><a href=""><img src="./assets/images/skin/style/10.png" alt=""></a></li>
								</ul>
							</div>
						</div>
						<div class="btn clearfix">
							<span>
								<label>
									<input style="" checked="checked" node-type="sync" class="W_checkbox" type="checkbox">
									<span style="" node-type="syncText">同步到微博</span>
								</label>
							</span>
							<span class="right">
								<a href="javascript:;" class="W_btn_a_disable"><span class="btn_30px W_f14">保存</span></a>
								<a href="javascript:;" action-type="cancel" class="W_btn_b" node-type="canncel"><span class="btn_30px W_f14">取消</span></a>
							</span>
						</div>
					</div>
					<a class="W_close" href="javascript:void(0);" title="关闭"></a>
				</div>
			</div>
		</div>
str;
echo json_encode($set_template);
	}
}