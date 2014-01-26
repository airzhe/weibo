<?php 
/**
 * 用户注册页面
 */
Class signup extends Front_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		if($this->input->post()){
			// php端表单字段验证
			p($this->input->post());
			$this->load->model('User_info_model');
			$this->load->library('form_validation');
			$rules = array_merge($this->User_model->rules,$this->User_info_model->rules);
			$this->form_validation->set_rules($rules);
			$this->form_validation->set_message('is_natural_no_zero', '%s 字段不完整');
			if ($this->form_validation->run() == TRUE) {
				$data=$this->input->post();
				p($data);
			}else{
				echo (validation_errors()); 
			}
		}else{
			// session_id() || session_start();
			// var_dump($_SESSION);
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
