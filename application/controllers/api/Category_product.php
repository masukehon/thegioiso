<?phpdefined('BASEPATH') OR exit('No direct script access allowed');class Category_product extends MY_Controller {	public function __construct()    {        parent::__construct();        $this->load->model('category_product_model');    }	public function index()	{		$id_parent_category = $this->uri->segment(3);		$where = array('id' => $id_parent_category);		if($this->category_product_model->check_exists($where)) {			$input['where'] = array('id_parent_category' => $id_parent_category);			$list = $this->category_product_model->get_list($input);			$result = array();                        foreach ($list as $category) {                $item = array(                'id' => $category->id,                'name' => $category->name            	);                $result[] = $item;            }            echo json_encode($result);            return;		} else {			$error = array('error' => 'No exists');			echo json_encode($error);		}	}}/* End of file Category_product.php *//* Location: ./application/controllers/api/Category_product.php */