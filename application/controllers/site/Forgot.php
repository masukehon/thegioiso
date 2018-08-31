<?php 

defined('BASEPATH') OR exit('No direct script access allowed');



class Forgot extends MY_Controller {



	public function __construct()

	{

		parent::__construct();

		$this->load->model('admin_model');

		$this->load->library('form_validation');

	}

	public function reset()

	{

		if ($this->input->post()) 

		{

			$this->form_validation->set_rules('email', 'email', 'valid_email|required');

			if ($this->form_validation->run()) {

				$email = $this->input->post('email', true);

				$hashReset = randomHash();

				$link = 'http://thegioiso.net.vn/resetpassword/'.$hashReset;

				$content = "Click vào đường dẫn để cập nhật mật khẩu mới !!!! ";

				$content .= "</br>".$link;

				$data = array(

					'hash_reset' => $hashReset

				);



				$this->db->where('email', $email);

				if ($this->db->update('admin', $data))

				{

					$this->load->library('email');

					$config['protocol']    = 'smtp';

					$config['smtp_host']    = 'mail.thegioiso.net.vn';

					$config['smtp_port']    = '465';

					$config['smtp_timeout'] = '7';

					$config['smtp_user']    = 'admin@thegioiso.net.vn';

					$config['smtp_pass']    = 'thegioiso2017';

					$config['charset']    = 'utf-8';

					$config['newline']    = '\r\n';

					$config['crlf']    = '\r\n';

					$config['mailtype'] = 'html'; 

					$config['smtp_crypto'] = 'ssl'; 



					$this->email->initialize($config);





					$this->email->from('admin@thegioiso.net.vn', 'Admin');

					$this->email->to($email); 



					$this->email->subject('Quên mật khẩu thế giới số');

					$this->email->message($content);  



					if ($this->email->send()) {

						$this->session->set_flashdata('successRest', '<div class="alert alert-success">Vui lòng kiểm tra email để cập nhật lại mật khẩu !!!!</div>');



					}

				}

				



			}

			$successRest = $this->session->flashdata('successRest');

			$data['successRest'] = $successRest;

			

		}

		$data['page'] = 'site/pages/forgot';

		$this->load->view('site/pre_layout', $data);

	}



	public function resetpassword()

	{



		$this->load->library('form_validation');

		$hash = $this->uri->segment(2);

		$input['where'] = array('hash_reset' => $hash);

		if($this->admin_model->get_total($input) <= 0)

		{

			show_error('The link not exist !!!!');

		}

		else

		{

			if ($this->input->post()) {

				$this->form_validation->set_rules('password', 'password', 'required|min_length[5]');

				$this->form_validation->set_rules('prepassword', 'prepassword', 'required|matches[password]');

				if ($this->form_validation->run()) {

					$password = $this->input->post('password', true);

					$data = array(

						'password' => md5($password),

						'hash_reset' => ""

					);



					$this->db->where('hash_reset', $hash);

					if ($this->db->update('admin', $data)) {

						$this->session->set_flashdata('successPass', '<div class="alert alert-success">Cập nhật mật khẩu thành công !!!</div>');

					}

					

				}

			}

		}

		$successPass = $this->session->flashdata('successPass');

		$data['successPass'] = $successPass;

		$data['page'] = 'site/pages/reset_password';

		$this->load->view('site/pre_layout', $data);

	}

}

/* End of file Forgot.php */

/* Location: ./application/controllers/site/Forgot.php */