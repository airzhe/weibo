<?php 
Class set extends Front_Controller{

	public $rules_username = array(
		'username' => array(
			'field' => 'username', 
			'label' => '昵称', 
			'rules' => 'trim|required|min_length[4]|max_length[24]|callback_username_check|is_unique[user_info.username]|xss_clean'
			)
		);
	public $rules_passwd = array(
		'passwd' => array(
			'field' => 'passwd', 
			'label' => '密码', 
			'rules' => 'trim|required|min_length[6]|max_length[16]|xss_clean'
			),
		'newPasswd' => array(
			'field' => 'newPasswd', 
			'label' => '新密码', 
			'rules' => 'trim|required|min_length[6]|max_length[16]|xss_clean'
			),
		'rePasswd' => array(
			'field' => 'rePasswd', 
			'label' => '重复密码', 
			'rules' => 'matches[newPasswd]'
			)
		);
	public function __construct(){
		parent::__construct();
		$this->output->enable_profiler(FALSE);
		$this->load->model("User_model");
		$this->load->model("User_info_model");
		$this->load->library('form_validation');
		$this->uid=$this->session->userdata('uid');	
	}
	/**
	 * 修改个人信息
	 */
	public function info(){
		if($this->input->post()){
			// 取得表单数据
			$info=$this->input->post();
			$info['location']=serialize($info['location']);
			// 去的数据库数据
			$_info=$this->db->select('truename,location,sex,intro')->get_where('user_info',array('uid'=>$this->uid))->row_array();
			// 得到修改了那些数据
			$arr=array_diff($info, $_info);
			// 如果用户没有操作就返回
			if(empty($arr)) die(json_encode(array('status'=>1)));
			if($this->User_info_model->save($arr,$this->uid)){
				die(json_encode(array('status'=>1)));
			}
			die(json_encode(array('status'=>0)));
		}else{
			$this->data['title'] = '个人信息';
			$this->data['body_class'] = 'set_info';
			$user=$this->User_info_model->get_detail_info($this->uid);
			$this->data['user']=$user;
			$this->view('set/index',$this->data);
		}
	}
	/**
	 * 修改个性域名
	 */
	public function domain(){

		$domain=$this->input->post('domain');
		// 正则验证
		if(!preg_match('@^[a-zA-Z0-9]{4,20}$@', $domain)){
			return ;
		}
		// 检测域名是否存在
		ob_start();
		$this->domain_exist();
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
	public function domain_exist($domain=NULL){
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
	 * 修改个性域名
	 */
	public function username(){
		$username=$this->input->post('username');
		$rules = $this->rules_username;
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() == TRUE) {
			if($this->User_info_model->save(array('username'=>$username),$this->uid)){
				// 写入用户信息表
				$this->session->set_userdata(array('username'=>$username));
				die(json_encode(array('status'=>1)));
			}
		}else{
			// echo (validation_errors()); 
			die(json_encode(array('status'=>0)));
		}
	}
	// 检测域名是否存在
	public function username_exist(){
		$username=$this->input->post('username');
		$result=$this->db->where(array('username'=>$username))->from('user_info')->count_all_results();
		if($result){
			echo 'false';
		}else{
			echo 'true';
		}
	}
	// 昵称正则验证
	public function username_check($value){
		$preg='@^[a-zA-Z0-9_\-\x{4e00}-\x{9fa5}]+$@u';
		if(!preg_match($preg, $value)){
			$this->form_validation->set_message('username_check', '%s 字段格式不正确');
			return false;
		}else{
			return true;
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
		$this->data['body_class'] = 'set_info';
		$this->view('set/security',$this->data);
	}
	public function passwd(){
		$rules = $this->rules_passwd;
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() == TRUE) {
			// 检测密码
			ob_start();
			$this->auth_passwd();
			$result=ob_get_contents();
			ob_clean();
			if($result=='false')die('密码输入错误');
			$_passwd=$this->input->post('newPasswd');
			$passwd=$this->User_model->hash($_passwd);
			if($this->User_model->save(array('passwd'=>$passwd),$this->uid)){
				die(json_encode(array('status'=>1)));
			}
		}else{
			die(json_encode(array('status'=>0)));
		}
	}
	public function auth_passwd(){
		$_passwd=$this->input->post('passwd');
		$passwd=$this->User_model->hash($_passwd);
		$result=$this->db->where(array('id'=>$this->uid,'passwd'=>$passwd))->from('user')->count_all_results();
		if($result){
			echo 'true';
		}else{
			echo 'false';
		}
	}

}
