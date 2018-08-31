<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class HistoryVideo extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('history_video_model');
    }
    public function index()
    {
        $box        = array();
        $videos     = $this->input->post('videos', true);
        $videosDeco = json_decode($videos);
        for ($i = 0, $lenght = count($videosDeco); $i < $lenght; $i++) {
            if ($videosDeco[$i]->time >= 3) {
                $data = array(
                    'id_video' => $videosDeco[$i]->id,
                    'time_seen' => $videosDeco[$i]->time
                );
                $this->history_video_model->create($data);
            }
        }
    }
}
/* End of file HistoryVideo.php */
/* Location: ./application/controllers/api/HistoryVideo.php */