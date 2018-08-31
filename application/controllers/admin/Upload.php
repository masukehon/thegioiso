<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends MY_Controller {

	public function index()
	{
		if($this->input->post()) {

			$this->load->library('lib_upload');

			$data = $this->lib_upload->upload('product', 'image');
		}

		$data['page'] = 'admin/pages/upload';
		$this->load->view('admin/master_layout', $data);
	}

}

/* End of file Upload.php */
/* Location: ./application/views/admin/pages/Upload.php */