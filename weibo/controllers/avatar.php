<?php 
Class Avatar extends Front_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('upload');
		$this->load->library('image_lib');
		$this->load->model('User_info_model');
		$this->uid=$this->session->userdata('uid');
	}
	/**
	 * 保存用户头像
	 */
	public function save(){
		$avatar=$this->crop();
		if($this->User_info_model->save(array('avatar'=>$avatar),$this->uid)){
			die(json_encode(array('status'=>1)));
		}
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
				die($avatar);
			}else{
				die('error');
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
	public function crop(){
		$img=$this->input->post('sImg');
		$file_name=basename($img);
		
		$arr=explode('/',$img);
		$new_path=$arr[0].'/'.$arr[1].'/';

		$config['source_image'] = $img;	
		$config['maintain_ratio'] = FALSE;
		$config['x_axis'] = $this->input->post('x'); 
		$config['y_axis'] = $this->input->post('y');
		$config['width']  = $this->input->post('w'); 
		$config['height'] = $this->input->post('h'); 
		
		// 剪裁
		$path=$new_path.'180/'.$arr[3];
		is_dir($path) || mkdir($path,0777,TRUE);
		$config['new_image'] = $path.'/'.$file_name;
		$this->image_lib->initialize($config);
		$this->image_lib->crop();

		// 缩放
		$config['source_image'] = $path.'/'.$file_name;	
		foreach (array(180,50,30) as $v) {
			$path=$new_path.$v.'/'.$arr[3];
			is_dir($path) || mkdir($path,0777,TRUE);
			$config['new_image'] = $path.'/'.$file_name;
			$config['width']  = $v; 
			$config['height']  = $v;
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
		}
		return $arr[3].'/'.$arr[4];
	}
}