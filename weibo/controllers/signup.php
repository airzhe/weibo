<?php 
/**
 * 用户注册页面
 */
Class signup extends Front_Controller{
	public function __construct(){
		parent::__construct();
		
		// 如果已经登录过，跳转至home页面
		$this->User_model->loggedin() == FALSE || redirect(site_url());
	}
	public function index(){
		if($this->input->post()){
			// php端表单字段验证
			$this->load->model('User_info_model');
			$this->load->library('form_validation');
			$rules = array_merge($this->User_model->rules,$this->User_info_model->rules);
			$this->form_validation->set_rules($rules);
			// 自定义错误信息验证生日不能为0
			$this->form_validation->set_message('is_natural_no_zero', '%s 字段不完整');
			if ($this->form_validation->run() == TRUE) {
				// 调用模型添加用户数据到数据库
				if($uid=$this->User_model->insert()){
					$this->User_info_model->insert($uid);
					success('注册成功...','index');
				}
			}else{
				echo (validation_errors()); 
			}
		}else{
			$this->partial('signup');
		}
	}


	/**
	 * 生成验证码
	 */
	public function code(){
		session_id() || session_start();
		$this->load->library('code');
		$this->code->height=35;
		$this->code->font_size=24;
		$this->code->font='./assets/data/Quickie.ttf';
		$this->code->show();
	}
	/**
	 * 验证验证码
	 */
	public function auth_code(){
		session_id() || session_start();
		$code=$this->input->post('code');
		if(strtoupper($code)!=$_SESSION['code']){
			die('false');
		}else{
			die('true');
		}
	}
	/**
	 * 验证帐号是否存在
	 */
	public function account_exist(){
		$data=$this->input->post();
		$arr=$this->User_model->get_by($data);
		//如果为真,则记录存在
		if(empty($arr)){
			die('true');
		}else{
			die('false');
		}
	}
	/**
	 * 验证昵称是否存在
	 */
	public function username_exist(){
		$data=$this->input->post();
		$this->load->model('User_info_model');
		$arr=$this->User_info_model->get_by($data);
		//如果为真,则记录存在
		if(empty($arr)){
			die('true');
		}else{
			die('false');
		}
	}
	/**
	* 昵称正则验证
	*/
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
	* 所在地验证
	*/
	public function location_check($value){
		if(!$value){
			$this->form_validation->set_message('location_check', '%s 字段不完整');
			return false;
		}else{
			return true;
		}
	}
}
