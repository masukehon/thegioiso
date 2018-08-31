<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider_video_model extends MY_Model {

	public function __construct()
	{	
		parent::__construct();
		$this->table = 'slider_video';
	}

}

/* End of file Video_model.php */
/* Location: ./application/models/Video_model.php */