<?php 
class json extends Front_Controller{
	public function set_skin(){
		if(!$this->input->is_ajax_request()){
			show_404();
		}
		$id=$this->input->post('type');
		if(!$id)die;
		// 读取配置项获得皮肤数组
		$this->config->load('W_skin', TRUE);
		$skin = $this->config->item('skin', 'W_skin');
		//图片扩展名
		$extension='.png';
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
				$extension='.jpg';
				$class="template_list cover_list";
				break;
			default:
				$class="template_list";
				break;
		}
		$data.='<ul class="'.$class.' clearfix">';
		$info=array();
		$base_url=base_url();
		foreach ($skin[$id]['template_list'] as $key => $value) {
			if(strpos($value,'###')){
				$info=explode('###',$value);
			}else{
				$info[0]=$value;
				$info[1]='';
			}
			$data.='<li><a href="javascript:void(0)" data-link="'.$info[1].'"><img src="'.base_url().'assets/skin/'.$id.'/'.$key.$extension.'"><span>'.$info[0].'</span></a></li>';
		}
		$data.='</ul>';
		die(json_encode(['data'=>$data]));
	}
}