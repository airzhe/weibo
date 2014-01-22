<?php 
class json extends Front_Controller{
	public function set_skin(){
		if(!$this->input->is_ajax_request()){
			show_404();
		}
		$id=$this->input->post('id');
		if(!$id)die;
		// 读取配置项获得皮肤数组
		$this->config->load('W_skin', TRUE);
		$skin = $this->config->item('skin', 'W_skin');
		$data='<ul class="tab_nosep clearfix">';
		foreach ($skin[$id]['tab_nosep'] as  $value) {
			$data.='<li><a href="#">'.$value.'</a></li>';
		}
		$data.='</ul>';
		switch ($id) {
			case 'style':
				$class="diy_list";
				$data.='<p><span>推荐配色</span></p>';
				break;
			case 'cover':
				$class="templete_list cover_list";
				break;
			default:
				$class="templete_list";
				break;
		}
		$data.='<ul class="'.$class.' clearfix">';
		foreach ($skin[$id]['templete_list'] as $key => $value) {
			$data.='<li><a href=""><img src="./assets/images/skin/'.$id.'/'.$key.'"><span>'.$value.'</span></a></li>';
		}
		$data.='</ul>';
		die($data);
	}
}