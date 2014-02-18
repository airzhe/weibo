<?php 
Class set extends Front_Controller{
	public function __construct(){
		parent::__construct();
		$this->output->enable_profiler(FALSE);
		$this->load->model("User_info_model");
		$this->uid=$this->session->userdata('uid');
	}
	/**
	 * 修改个人信息
	 */
	public function info(){


		$this->data['title'] = '个人信息';
		$this->data['body_class'] = 'set_info';
		$user=$this->User_info_model->get_detail_info($this->uid);
		$this->data['user']=$user;
		$this->view('set/index',$this->data);
	}
	/**
	 * 修改个性域名
	 */
	public function domain(){

		$domain=$this->input->post('domain');
		// 检测域名是否存在
		ob_start();
		$this->check_domain();
		$result=ob_get_contents();
		ob_clean();

		if($result=='false')die('域名已经存在，请更换');
		// 写入用户信息表
		if($this->User_info_model->save(array('domain'=>$domain),$this->uid)){
			// 写入路由表
			$data = array(
				'slug' => $domain ,
				'route' => 'u/index/'.$this->uid,
				'uid' => $this->uid,
				);
			if($this->db->insert('routes', $data)){
				die(json_encode(array('status'=>1)));
			} 			
		}
		die(json_encode(array('status'=>0)));
	}
	// 检测域名是否存在
	public function check_domain($domain=NULL){
		if(is_null($domain)){
			$domain=$this->input->post('domain');
		}
		// 加载系统预留域名
		$this->config->load('W_domain', TRUE);
		$reserve_domain=$this->config->item('reserve_domain', 'W_domain');
		// 判断是否是系统预留域名
		if(in_array($domain,$reserve_domain)){
			die('false');
		}else{
			$result=$this->db->where(array('domain'=>$domain))->from('user_info')->count_all_results();
			if($result){
				echo 'false';
			}else{
				echo 'true';
			}
		}
	}
	/**
	 * 修改用户头像
	 */
	public function avatar(){
		$this->data['title'] = '头像设置';
		$this->data['body_class'] = 'avatar';
		$user=$this->User_info_model->get_detail_info($this->uid);
		$this->data['avatar']=$user['avatar'];
		$this->view('set/avatar',$this->data);
	}
	/**
	 * 修改用户密码
	 */
	public function security(){
		$this->data['title'] = '帐号安全';
		$this->view('set/security',$this->data);
	}

}
