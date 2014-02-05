<?php
/**
 * index页面控制器
 */
Class index extends Front_Controller{
	public function __construct(){
		parent::__construct();
		$this->data['title'] = '我的首页';
		$this->data['body_class'] = 'index';
		$this->load->model('User_info_model');
		$this->load->model('Follow_model');
	}
	public function index(){
		$user=$this->User_info_model->get_basic_info();
		if($user['avatar']==''){
			$user['avatar']=$user['sex']=='男'?'assets/images/male_avatar.gif':'assets/images/female_avatar.gif';
		}else{
			
		}
		$this->data['user']=$user;
		$this->config->load('W_weibo', TRUE);
		$this->page();
		$this->select();
		$this->view('index',$this->data);
	}
	/**
	 * 查询所有关注人的微博列表
	 */
	public function select(){
		$this->_where();
		// 如果是ajax请求,每次读取5条记录，否则读取10条
		if(!$this->input->is_ajax_request()){
			$num=10;
			$offset=0;
		}else{
			$num=5;
			$offset=$this->input->post('offset');
		}
		$this->per_page=$this->config->item('index_per_page', 'W_weibo');
		$current_page=$this->uri->segment(2)?(int)$this->uri->segment(2):1;
		$this->db->order_by("weibo.time", "desc")->limit($num,($current_page-1)*$this->per_page+$offset);
		$this->db->join('weibo', 'user_info.uid = weibo.uid');
		$arr=array('username','avatar','sex','domain','content','isturn','iscomment','time','praise','turn','collect','comment','weibo.uid');
		$weibo_list=$this->db->select($arr)->get('user_info')->result_array();

		$this->load->library('weibo');
		$weibo_list=$this->weibo->format($weibo_list);
		// 如果是ajax请求输入输入，否则赋值给$this->data
		if(!$this->input->is_ajax_request()){
			$this->data['weibo_list']=$weibo_list;
			$this->data['weibo_offset']=($current_page-1)*$this->per_page+$num;
		}else{
			
			foreach ($weibo_list as $v) {
				$v['avatar']=base_url($v['avatar']);
				$_weibo=<<<str
				<div class="item clearfix">
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
								<a href=""><s class="W_ico20 icon_praised_b"></s>({$v['praise']})</a><i class="S_txt3">|</i><a href="">转发({$v['turn']})</a><i class="S_txt3">|</i><a href="">收藏</a><i class="S_txt3">|</i><a href="">评论({$v['collect']})</a>
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
	/**
	 * 发单条新微博
	 */
	public function send(){
		$this->load->library('weibo');
		$this->weibo->send();
	}
	/**
	 * 分页
	 */
	private function page(){
		// 查询条件
		$this->_where();
		//分页
		$count=$this->db->from('weibo')->count_all_results();
		$this->load->library('pagination');
		$config['base_url'] = site_url('page');
		$config['total_rows'] = $count;
		$config['per_page'] = $this->config->item('index_per_page', 'W_weibo');
		$config['uri_segment'] = 2;
		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] = '<p id="page" class="page hide">';
		$this->pagination->initialize($config);
		$this->data['page']= $this->pagination->create_links();		
	}
	/**
	 * 公用sql查询条件
	 */
	private function _where(){
		$uid=$this->session->userdata('uid');
		$follow_arr=$this->db->select('follow')->get_where('follow',array('fans'=>$uid))->result_array();
		$follow_id=array();
		foreach ($follow_arr as $v) {
			$follow_id[]=current($v);
		}
		if(count($follow_id)){
			$this->db->where_in('weibo.uid', $follow_id);
		}
		$this->db->or_where(array('weibo.uid'=>$uid));
	}
}