<?php 
/**
 * 用户个人主页类
 */
Class u extends Front_Controller{
	public function __construct(){
		parent::__construct();
		$this->uid=(int)$this->uri->rsegment(3);
		if(!$this->uid)$this->uid=$this->session->userdata('uid');

		$this->load->model("User_info_model");
		$this->load->model("Weibo_model");
		$this->load->library('weibo');
		$this->load->library('member');
		//载入分页配置文件
		$this->config->load('W_weibo', TRUE);
		// 加密类
		$this->load->library('encry');
		// 分配自定义模板
		$this->set_skin();

	}
	// 我的主页
	public function index(){
		//取得用户个人信息
		$this->get_user();
		//取得用户微博信息
		$this->select();
		//微博分页
		$this->page();
		// 侧边栏关注
		$this->get_follow();
		// 侧边栏粉丝
		$this->get_fans();
		// 侧边栏相册
		$this->get_picture();
		$this->data['body_class'] = 'home my_index';
		$this->view('home',$this->data);
	}
	// 用户信息
	private function get_user(){
		$user=$this->User_info_model->get_detail_info($this->uid);
		if(empty($user)){
			show_404();
		}
		$this->data['title'] = $user['username'].'的微博|';
		if($this->uid==$this->session->userdata('uid')){
			$user['me']=TRUE;
			$user['call']='我';
		}else{
			$user['call']=$user['sex']=='男'?'他':'她';
			// 关注关系
			$this->load->model('Follow_model');
			$user['relation']=$this->Follow_model->relation($this->uid);
		}
		// 分配用户id，js分页用
		$user['uid']=$this->uid;
		$this->data['user']=$user;
		// p($user);
	}
	//取得微博及转发的微博数据
	private function select(){
		$weibo_list=$this->_select_weibo_list();
		$forward_list=$this->_select_forward_list($weibo_list);
		//判断是否是ajax请求
		if(!$this->input->is_ajax_request()){
			if(count($weibo_list))  $this->data['weibo_list']=$weibo_list;
			if(count($forward_list)) $this->data['forward_list']=$forward_list;
		}else{
			//=============================测试代码===============================
			sleep(1);
			foreach ($weibo_list as $v) {
				$_weibo=<<<str
				<div class="item clearfix" data-id="{$v['id']}">
					<div class="WB_screen">
						<a title="删除此条微博" class="W_ico12 icon_close" action-type="weibo_delete" href="javascript:;"></a>
					</div>
					<div class="detail">
						<div class="content">
							{$v['content']}
						</div>
						<div class="func clearfix S_txt2">
							<div class="from left">
								<a href="#" class="S_link2 time">{$v['time']}</a> 来自<a href="" class="S_link2">新浪微博</a> 
							</div>
							<div class="handle right">
								<a href="javascript:void(0)"><s class="W_ico20 icon_praised_b"></s>({$v['praise']})</a><i class="S_txt3">|</i><a href="javascript:void(0)">转发({$v['turn']})</a><i class="S_txt3">|</i><a href="javascript:void(0)">收藏</a><i class="S_txt3">|</i><a href="javascript:void(0)">评论({$v['collect']})</a>
							</div>
						</div>
					</div>
				</div>
str;
				$weibo[]=$_weibo;
			}
			$arr=array('status'=>1,'count'=>count($weibo),'weibo_list'=>implode('', $weibo));
			die(json_encode($arr));
		}
	}
	//查询微博
	private function _select_weibo_list(){
		// 如果是ajax请求
		$offset=5;
		if(!$this->input->is_ajax_request()){
			$start=0;
		}else{
			$start=$this->input->post('start');
		}
		$this->per_page=$this->config->item('home_per_page', 'W_weibo');
		$current_page=$this->input->get('p')?$this->input->get('p'):1;
		//分配当前面页面开始id
		$this->data['weibo_start']=($current_page-1)*$this->per_page+$offset;
		$weibo_list=$this->db->order_by("time", "desc")->limit($offset,($current_page-1)*$this->per_page+$start)->get_where('weibo',array('uid'=>$this->uid))->result_array();
		if(empty($weibo_list)) return;

		//读取微博配图
		foreach ($weibo_list as $key => $value) {
			//格式化微博内容和发布时间
			$weibo_list[$key]['content']=$this->weibo->f_content($value['content']);
			$weibo_list[$key]['time']=$this->weibo->f_time($value['time']);
			$pic_count=$value['picture'];
			if($pic_count){
				$_pic=$this->db->get_where('picture',array('wid'=>$value['id']))->result_array();
				$weibo_list[$key]['pic']=$_pic;
				//分配图片路径
				if($pic_count==1){
					$weibo_list[$key]['pic_path']='images/content/thumbnail/';
				}else{
					$weibo_list[$key]['pic_path']='images/content/square/';
					if($pic_count==2 || $pic_count==4){
						$weibo_list[$key]['pic_class']='lotspic_list inner_width';
					}else{
						$weibo_list[$key]['pic_class']='lotspic_list';
					}
				}
			}
		}
		return $weibo_list;
	}
	//取得转发的微博
	private function _select_forward_list($weibo_list){
		if(empty($weibo_list)) return;
		//转发的原微博
		$arr=array('username','domain','weibo.id','content','picture','isturn','iscomment','time','praise','turn','collect','comment','weibo.uid');
		$forward_arr=array();
		foreach ($weibo_list as $k => $v) {
			if($v['isturn']){
				$forward_arr[]=$v['isturn'];
			}
		}
		$forward_list=array();
		if(empty($forward_arr)) return;
		$this->db->join('user_info', 'user_info.uid = weibo.uid');
		$_forward_list=$this->db->where_in('weibo.id',$forward_arr)->select($arr)->get('weibo')->result_array();
		if(empty($_forward_list)) return;
		foreach ($_forward_list as $k => $v) {
			$forward_list[$v['id']]=$v;
		}
		foreach ($forward_list as $key => $value) {
				//格式化内容和发布时间
			$forward_list[$key]=$this->weibo->f_url($value);
			$forward_list[$key]['content']=$this->weibo->f_content($value['content']);
			$forward_list[$key]['time']=$this->weibo->f_time($value['time']);
			$pic_count=$value['picture'];
			if($pic_count){
				$_pic=$this->db->get_where('picture',array('wid'=>$value['id']))->result_array();
				$forward_list[$key]['pic']=$_pic;
					//分配图片路径
				if($pic_count==1){
					$forward_list[$key]['pic_path']='images/content/thumbnail/';
				}else{
					$forward_list[$key]['pic_path']='images/content/square/';
					if($pic_count==2 || $pic_count==4){
						$forward_list[$key]['pic_class']='lotspic_list inner_width';
					}else{
						$forward_list[$key]['pic_class']='lotspic_list';
					}
				}
			}
		}
		return $forward_list;
	}
		//分页
	private function page(){
		//分页
		$count=$this->db->where(array('uid'=>$this->uid))->from('weibo')->count_all_results();
		$this->load->library('pagination');
		
		$config['total_rows'] = $count;
		$config['per_page'] = $this->config->item('index_per_page', 'W_weibo');
		
		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] = '<p id="page" class="page hide">';
		$this->pagination->initialize($config);
		$this->data['page']= $this->pagination->create_links();	
	}
	//获取用户关注
	private function get_follow(){
		$_myfollow_list=$this->member->get_follow($this->uid);
		$myfollow_list=$this->weibo->format(array_slice($_myfollow_list,0,4));
		$this->data['myfollow_list']=$myfollow_list;
	}
	//获取用户粉丝
	private function get_fans(){
		$_myfans_list=$this->member->get_fans($this->uid);
		$myfans_list=$this->weibo->format(array_slice($_myfans_list,0,4));
		$this->data['myfans_list']=$myfans_list;
	}
	//获取用户相册
	private function get_picture(){
		$sql="SELECT p.`picture`
		FROM `{$this->db->dbprefix}picture` AS p
		JOIN `{$this->db->dbprefix}weibo` AS w ON w.id = p.wid
		AND w.uid =$this->uid 
		ORDER BY w.`time` DESC
		LIMIT 0 , 8";
		$picture_list=$this->db->query($sql)->result_array();
		$this->data['picture_list']=$picture_list;
	}
	//发送私信
	public function send_letter(){
		if(!$this->input->is_ajax_request()){
			show_404();
		}
		$this->member->letter();
	}
	//单条微博
	public function weibo($uid,$wid){
		//解密id
		$wid=$this->encry->decrypt($wid);
		if(!$wid) show_404();
		//取得用户个人信息
		$this->get_user();
		//获取单条微博信息
		$weibo=$this->get_weibo($wid);
		//获取微博转发信息
		$forward=$this->get_forward($weibo);
		// 侧边栏关注
		$this->get_follow();
		// 侧边栏粉丝
		$this->get_fans();
		// 侧边栏相册
		$this->get_picture();

		$this->data['body_class'] = 'home single_weibo';
		if(count($weibo)) $this->data['weibo']=$weibo;
		if(count($forward)) $this->data['forward']=$forward;
		$this->view('single_weibo',$this->data);
	}
	private function get_weibo($wid){
		//获得对应id的微博信息
		// $wid=(int)$this->encry->decrypt($wid);
		$arr=array('username','domain','weibo.id','content','picture','isturn','iscomment','time','praise','turn','collect','comment','weibo.uid');
		$this->db->join('user_info', 'user_info.uid = weibo.uid');
		$weibo=$this->db->select($arr)->get_where('weibo',array('weibo.id'=>$wid,'weibo.uid'=>$this->uid))->row_array();
		if(empty($weibo)) return;
		//格式化微博内容和发布时间
		$weibo['content']=$this->weibo->f_content($weibo['content']);
		$weibo['time']=$this->weibo->f_time($weibo['time']);
		//读取微博配图
		$pic_count=$weibo['picture'];
		if($pic_count){
			$_pic=$this->db->get_where('picture',array('wid'=>$weibo['id']))->result_array();
			$weibo['pic']=$_pic;
			//单张图片
			if($pic_count==1){
				$weibo['pic_path']='images/content/thumbnail/';	
			}else{
				//多张图
				$weibo['pic_path']='images/content/square/';
				if($pic_count==2 || $pic_count==4){
					$weibo['pic_class']='lotspic_list inner_width';
				}else{
					$weibo['pic_class']='lotspic_list';
				}
			}
		}
		return $weibo;
	}
	private function get_forward($weibo){
		//读取转发的微博内容
		if(!$weibo['isturn']) return;
		$arr=array('username','domain','weibo.id','content','picture','isturn','iscomment','time','praise','turn','collect','comment','weibo.uid');		
		$this->db->join('user_info', 'user_info.uid = weibo.uid');
		$forward=$this->db->select($arr)->get_where('weibo',array('weibo.id'=>$weibo['isturn']))->row_array();
		if(empty($forward))return;
		//格式化微博内容和发布时间
		$forward['content']=$this->weibo->f_content($forward['content']);
		$forward['time']=$this->weibo->f_time($forward['time']);

		//读取转发微博配图
		$pic_count=$forward['picture'];
		if($pic_count){
			$_pic=$this->db->get_where('picture',array('wid'=>$forward['id']))->result_array();
			$forward['pic']=$_pic;
			//单张图片
			if($pic_count==1){
				$forward['pic_path']='images/content/thumbnail/';	
			}else{
				//多张图
				$forward['pic_path']='images/content/square/';
				if($pic_count==2 || $pic_count==4){
					$forward['pic_class']='lotspic_list inner_width';
				}else{
					$forward['pic_class']='lotspic_list';
				}
			}
		}
		return $forward;
	}
	/**
	 * 添加关注
	 * @return [type] [description]
	 */
	public function follow(){
		if(!$this->input->is_ajax_request()){
			show_404();
		}
		$this->member->follow();
	}
	/**
	 * 取消关注
	 * @return [type] [description]
	 */
	public function cancle_follow(){
		if(!$this->input->is_ajax_request()){
			show_404();
		}
		$this->member->cancle_follow();
	}
	
}