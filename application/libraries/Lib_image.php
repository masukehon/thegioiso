<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lib_image
{
	protected $ci;

	public function __construct()
	{
		$this->ci =& get_instance();
	}

	public function cut($path)
	{
		$config = $this->config($path);

		$this->ci->load->library('image_lib');

		$this->ci->image_lib->initialize($config);

		return $this->ci->image_lib->resize();
	}

	protected function config($path = '')
	{
		$config['image_library'] = 'gd2';
		$config['source_image'] = $path;
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = FALSE;
		$config['width']     = 500;
		$config['height']   = 500;

		return $config;
	}

}

/* End of file lib_image.php */
/* Location: ./application/libraries/lib_image.php */
