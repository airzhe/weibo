<?php 
class member extends Front_Controller{
	public function __construct(){
		parent::__construct();
		if(!$this->input->is_ajax_request()){
			show_404();
		}
		$this->uid = $this->session->userdata('uid');

	}
	/**
	 * follow 添加关注
	 */
	public function follow(){
		$this->load->model('Follow_model');
		$follow_id=$this->input->post('follow_id');
		$this->Follow_model->add(array('follow'=>$follow_id,'fans'=>$this->uid));
		//关注总数+1
		$this->load->model('User_info_model');
		$this->User_info_model->inc('follow',$this->uid);

		//被关注者粉丝数+1
		$this->User_info_model->inc('fans',$follow_id);
		$data['status']=1;
		die(json_encode($data));
	}
}