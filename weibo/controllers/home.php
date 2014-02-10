<?php 
Class home extends Front_Controller{
	public function __construct(){
		parent::__construct();
		$this->data['body_class'] = 'home';
		$this->load->model("User_info_model");
		$this->load->model("Weibo_model");
		$this->load->library('weibo');
		$this->uid=$this->session->userdata('uid');
	}
	// 我的主页
	public function index(){
		$this->user($this->uid);
	}
	// 用户信息
	public function user($uid){
		$user=$this->User_info_model->get_detail_info($uid);
		if(empty($user)){
			show_404();
		}
		$this->data['title'] = $user['username'].'的微博|';
		if($uid==$this->uid){
			$user['me']=TRUE;
			$user['call']='我';
		}else{
			$user['call']=$user['sex']=='男'?'他':'她';
		}
		$user['avatar']=$user['avatar']['big'];
		
		$this->page($uid);
		$this->select($uid);
		$this->data['user']=$user;

		$this->view('home',$this->data);
	}
	//查询微博
	public function select($uid){
		// 如果是ajax请求
		$num=5;
		if(!$this->input->is_ajax_request()){
			$offset=0;
		}else{
			$offset=$this->input->post('offset');
		}
		//载入分页配置文件
		$this->config->load('W_weibo', TRUE);
		$this->per_page=$this->config->item('home_per_page', 'W_weibo');
		$current_page=$this->uri->segment(3)?(int)$this->uri->segment(2):1;

		$weibo_list=$this->db->order_by("time", "desc")->limit($num,($current_page-1)*$this->per_page+$offset)->get_where('weibo',array('uid'=>$uid))->result_array();
		foreach ($weibo_list as $k => $v) {
			$weibo_list[$k]['content']=$this->weibo->f_content($v['content']);
			$weibo_list[$k]['time']=$this->weibo->f_time($v['time']);
		}
		if(!$this->input->is_ajax_request()){
			$this->data['weibo_list']=$weibo_list;
			$this->data['weibo_offset']=($current_page-1)*$this->per_page+$num;
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
	//分页
	private function page($uid){
		//分页
		$count=$this->db->where(array('uid'=>$uid))->from('weibo')->count_all_results();
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
}