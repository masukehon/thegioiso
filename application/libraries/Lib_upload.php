<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lib_upload
{
	protected $ci;

	public function __construct()
	{
		$this->ci =& get_instance();
	}

	public function upload($folder, $input_name)
	{
		$config = $this->config($folder);

		$this->ci->load->library('upload', $config);
		$this->ci->load->library('lib_image');

		if ($this->ci->upload->do_upload($input_name)){
			$data = $this->ci->upload->data();
			$path = './upload/'.$folder.'/' . $data['file_name'];
			$this->ci->lib_image->cut($path);
		}
		else{
			$data = $this->ci->upload->display_errors();
		}
		return $data;
	}

	public function uploads($folder, $input_name)
	{
		$this->ci->load->library('lib_image');
		$config = $this->config($folder);

		$file  = $_FILES[$input_name];
		
		$count = count($file['name']);

		$image_list = array();

		for ($i=0; $i <= $count - 1; $i++) {

			$_FILES['userfile']['name']     = $file['name'][$i];
			$_FILES['userfile']['type']     = $file['type'][$i];
			$_FILES['userfile']['tmp_name'] = $file['tmp_name'][$i];
			$_FILES['userfile']['error']    = $file['error'][$i];
			$_FILES['userfile']['size']     = $file['size'][$i];

			$this->ci->load->library('upload', $config);

			if($this->ci->upload->do_upload())
			{
				$data = $this->ci->upload->data();

				$path = './upload/image/' . $data['file_name'];
				$this->ci->lib_image->cut($path);
				
				$image_list[] = $data['file_name'];
			} else {
				return false;
			}
		}
		return $image_list;
	}

	public function config($folder = '')
	{
		$config = array();
		$config['upload_path'] = './upload/'. $folder;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']  = '10240';
		$config['max_width']  = '3000';
		$config['max_height']  = '1500';

		return $config;
	}

}

/* End of file lib_upload.php */
/* Location: ./application/libraries/lib_upload.php */
