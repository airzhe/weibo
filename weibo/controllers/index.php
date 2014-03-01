<?php
/**
 * index页面控制器
 */
Class index extends Front_Controller{
	public function __construct(){
		parent::__construct();
		$this->data['title'] = '我的首页';
		$this->data['body_class'] = 'index';
		$this->uid=$this->session->userdata('uid');
		$this->load->model('User_info_model');
		$this->load->model('Follow_model');
		$this->load->library('weibo');
		$this->config->load('W_weibo', TRUE);
		// 分配自定义模板
		$this->set_skin();
	}
	public function index(){
		//清空新微博客消息提醒
		set_msg($this->uid,0,TRUE);
		//取得用户基本信息
		$user=$this->User_info_model->get_basic_info();
		//取得微博数据
		$this->select();
		//载入分页配置文件
		$this->_page();
		$this->data['user']=$user;
		$this->view('index',$this->data);
	}
	/**
	 * 查询所有关注人的微博列表
	 */
	public function select(){
		$weibo_list=$this->_select_weibo_list();
		$forward_list=$this->_select_forward_list($weibo_list);
		
		// 如果是ajax请求输出json数据，否则赋值给$this->data
		if(!$this->input->is_ajax_request()){
			if(count($weibo_list)) $this->data['weibo_list']=$weibo_list;
			if(count($forward_list)) $this->data['forward_list']=$forward_list;
			
		}else{
			//=============================测试代码===============================
			sleep(1);
			foreach ($weibo_list as $v) {
				if($v['uid']==$this->uid){
					$WB_screen=<<<str
					<div class="WB_screen">
						<a title="删除此条微博" class="W_ico12 icon_close" action-type="weibo_delete" href="javascript:;"></a>
					</div>
str;
				}else{
					$WB_screen='';
				}
				$_weibo=<<<str
				<div class="item clearfix" data-id="{$v['id']}">
					{$WB_screen}
					<div class="face">
						<a href="{$v['domain']}"><img width="50" height="50" src="{$v['avatar']}" alt=""></a>
					</div>
					<div class="detail">
						<div>
							<a class="name S_func1" href="{$v['domain']}">{$v['username']}</a>
						</div>
						<div class="content">
							{$v['content']}
						</div>
						<div class="func clearfix S_txt2">
							<div class="from left">
								<a href="#" class="S_link2 time">{$v['time']}</a> 来自<a href="" class="S_link2">新浪微博</a> 
							</div>
							<div class="handle right">
								<a href="javascript:void(0)"><s class="W_ico20 icon_praised_b"></s>({$v['praise']})</a><i class="S_txt3">|</i><a href="javascript:void(0)">转发({$v['turn']})</a><i class="S_txt3">|</i><a href="javascript:void(0)">收藏</a><i class="S_txt3">|</i><a href="javascript:void(0)">评论({$v['comment']})</a>
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
	private function _select_weibo_list(){
		// 如果是ajax请求,每次读取5条记录，否则读取10条
		if(!$this->input->is_ajax_request()){		
			$start=0;
			$offset=10;
		}else{
			$start=$this->input->post('start');
			$offset=5;
		}
		//配置每次读取数量
		$this->per_page=$this->config->item('index_per_page', 'W_weibo');
		$current_page=$this->input->get('p')?$this->input->get('p'):1;
		//分配当前面页面开始id
		$this->data['weibo_start']=($current_page-1)*$this->per_page+$offset;
		//第一页时跳转到根url
		// if($this->uri->segment(1)=='page' and $current_page==1) redirect(site_url());
		//配置关联查询条件
		$start=($current_page-1)*$this->per_page+$start;
		$sql="SELECT `username`,`avatar`,`sex`,`domain`,`content`,`picture`,`isturn`,`iscomment`,`time`,`praise`,`turn`,`collect`,`comment`,w.`id`,w.`uid`
			FROM `{$this->db->dbprefix}weibo` w
			JOIN (
			SELECT `follow` uid
			FROM `{$this->db->dbprefix}follow`
			WHERE `fans` =$this->uid
			) AS f ON w.uid = f.uid
			OR w.uid =$this->uid
			JOIN `{$this->db->dbprefix}user_info` u
			ON w.uid=u.uid
			ORDER BY w.time DESC
			LIMIT $start,$offset";
		$weibo_list=$this->db->query($sql)->result_array();
		//如果为空则返回
		if(!count($weibo_list)) return;
		//获得微博配图
		foreach ($weibo_list as $key => $value) {
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
		$weibo_list=$this->weibo->format($weibo_list);
		return $weibo_list;
	}
	private function _select_forward_list($weibo_list){
		//转发的原微博
		$forward_arr=array();
		foreach ($weibo_list as $k => $v) {
			if($v['isturn']){
				$forward_arr[]=$v['isturn'];
			}
		}
		$forward_list=array();
		if(empty($forward_arr)) return;
		$arr=array('username','avatar','sex','domain','content','picture','isturn','iscomment','time','praise','turn','collect','comment','weibo.id','weibo.uid');
		$this->db->join('user_info', 'user_info.uid = weibo.uid');
		$_forward_list=$this->db->where_in('weibo.id',$forward_arr)->select($arr)->get('weibo')->result_array();
		if(empty($_forward_list)) return;
		foreach ($_forward_list as $k => $v) {
			$forward_list[$v['id']]=$v;
		}
		foreach ($forward_list as $key => $value) {
			$forward_list[$key]=$this->weibo->f_url($value);
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
		$forward_list=$this->weibo->format($forward_list);
		return $forward_list;
	}
	/**
	 * 发单条新微博
	 */
	public function send(){
		if(!$this->input->is_ajax_request()){
			show_404();
		}
		$this->weibo->send();
	}
	/**
	 * 新微博图片处理 包括上传、裁切、缩放
	 */
	public function image(){
		$this->weibo->image();	
	}
	/**
	 * 分页
	 */
	private function _page(){
		// 查询条件
		$sql="SELECT COUNT( * ) 
			FROM `{$this->db->dbprefix}weibo` w
			JOIN (
			SELECT `follow` uid
			FROM `{$this->db->dbprefix}follow`
			WHERE `fans` =$this->uid
			) AS f ON w.uid = f.uid
			OR w.uid =$this->uid";
		//分页
		$_count=$this->db->query($sql)->row_array();
		$count=current($_count);
		$this->load->library('pagination');
		$config['total_rows'] = $count;
		$config['per_page'] = $this->config->item('index_per_page', 'W_weibo');
		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] = '<p id="page" class="page hide">';
		$this->pagination->initialize($config);
		$this->data['page']= $this->pagination->create_links();		
	}
	/**
	 * 删除一条微博
	 */
	public function delete(){
		if(!$this->input->is_ajax_request()){
			show_404();
		}
		$id=$this->input->post('id');
		$this->load->model('Weibo_model');
		$this->db->where(array('id'=>$id,'uid'=>$this->uid))->delete('weibo');

		if($this->db->affected_rows()){
			//删除微博配图记录
			$this->db->where(array('wid'=>$id))->delete('picture');
			//用户微博数量 -1
			$this->User_info_model->inc('weibo',$this->uid,'-1');
			die(json_encode(array('status'=>1)));
		}
		die(json_encode(array('status'=>0)));
	}
}