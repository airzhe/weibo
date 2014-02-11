<?php 
Class login extends Front_Controller{
	public function __construct(){
		parent::__construct();

		// 如果已经登录过，跳转至index页面
		$this->User_model->loggedin() == FALSE || redirect(site_url());
	}
	public function index(){
		if($this->input->post()){
			$this->load->library('form_validation');
			$rules =$this->User_model->rules;
			//登录时去除验证验证
			unset($rules['code']);
			$rules['account']['rules']=$rules['passwd']['rules']='trim|required|xss_clean';

			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == TRUE) {
				if ($this->User_model->login() == TRUE) {
					redirect(site_url());
				}
				else {
					error('用户名或密码错误','login');
				}		
			}else{
				echo (validation_errors()); 
			}
		}else{
			$this->partial('login');
		}
	}
}