<?php 
Class Avatar extends Front_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('upload');
		$this->load->library('image_lib');
	}
	/**
	 * 用户上传头像
	 */
	function upload(){
		$avatar=$_FILES['Filedata'];
		if($avatar['error']==0 and is_uploaded_file($avatar['tmp_name'])){
			$info = pathinfo($avatar['name']);
			// 路径
			$upload_path='images/avatar/300/'.date("Ym").'/';
			is_dir($upload_path) || mkdir($upload_path,0777,TRUE);
			// 文件名
			$file_name=time().mt_rand(0,1000).'.'.$info['extension'];

			// 配置项
			$config['upload_path'] = $upload_path;
			$config['file_name'] = $file_name;
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			// 默认0,系统配置文件中上传大小,单位k
			$config['max_size'] = '1000';
			$config['max_width']  = '1024';
			$config['max_height']  = '1024';
			$this->upload->initialize($config);
			
			if ($this->upload->do_upload('Filedata'))
			{
				$arr=$this->upload->data();
				$avatar=$config['upload_path'].$arr['file_name'];
				$this->zoom($avatar,300,300);
				die(base_url($avatar));
			}else{
				echo $this->upload->display_errors();
				die;
			}
		}
	}
	/**
	 * 缩放图片
	 */
	private function zoom($img,$w,$h){
		
		if(!is_file($img)) return;

		// 加载图像处理类
		$config['source_image'] = $img;
		$config['maintain_ratio'] = TRUE;
		// 缩略图文件名

		$config['width'] = $w;
		$config['height'] = $h;

		$this->image_lib->initialize($config);
		$this->image_lib->resize();

	}

}