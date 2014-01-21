<?php 
class face extends Front_Controller{
	/**
	 * 输出表情数据
	 */
	public function index(){
		if(!$this->input->is_ajax_request()){
			show_404();
		}
		$face_url=base_url('assets/images/hotFace');
		// 读取配置项获得表情数组
		$this->config->load('face', TRUE);
		$faces = $this->config->item('faces', 'face');
		$face_list='';
		foreach ($faces as $key => $value) {
			$face_list.="<li><img src='{$face_url}/{$value}.gif' alt='{$key}' title='{$key}'>";
		}
		die($face_list);
	}
}
