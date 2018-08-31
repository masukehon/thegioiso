<?php



defined('BASEPATH') OR exit('No direct script access allowed');







class MY_Model extends CI_Model {







	// Ten table



	public $table = '';



	



	// Key chinh cua table



	public $key = 'id';



	



	// Order mac dinh (VD: $order = array('id', 'desc))



	public $order = '';



	



	// Cac field select mac dinh khi get_list (VD: $select = 'id, name')



	public $select = '';











	/**



	 * Them du lieu vao ban



	 * @param  $data: du lieu can them



	 * @return true/fasle



	 */



	public function create($data = array())



	{

		$this->db->cache_delete_all();



		if ($this->db->insert($this->table, $data)) {



			return $this->db->insert_id();



		} else {



			return false;



		}



	}







	/**



	 * update theo id



	 * @param  $id: id cua bang can sua



	 * @param  $data: du lieu thay doi



	 * @return true/false



	 */	



	public function update($id, $data)



	{

		$this->db->cache_delete_all();



		if (!$id) {



			return false;



		}



		$where = array();



		$where[$this->key] = $id;



		$this->update_rule($where, $data);



		return $id;

	}







	/**



	 * update co dieu kien



	 * @param  $where: dieu kien sua doi



	 * @param  $data: du lieu moi



	 * @return true/fase



	 */



	public function update_rule($where, $data)



	{



		if (!$where) {



			return false;



		}



		$this->db->where($where);



		$this->db->update($this->table, $data);



		return true;



	}







	/**



	 * @param  $id: id cua bang



	 * @return true/ false



	 */



	public function delete($id)



	{

		$this->db->cache_delete_all();



		if (!$id) {



			return false;



		}







		if (is_numeric($id)) {



			$where = array($this->key => $id);



		} else {



			$where = $this->key . " IN (". $id . ") ";



		}



		$this->del_rule($where);







		return true;



	}







	/**



	 * @param  $where: dieu kien xoa



	 * @return [type]



	 */



	public function del_rule($where)



	{



		if (!$where) {



			return false;



		}







		$this->db->where($where);



		$this->db->delete($this->table);







		return true;



	}







	/**



	 * @param  $sql: lenh sql



	 * @return 



	 */



	public function query($sql)



	{

		$this->db->cache_on();



		$rows = $this->db->query($sql);



		return $rows->result;



	}







	/**



	 * Lay thong tin cua row tu id



	 * $id : id can lay thong tin



	 * $field : cot du lieu ma can lay



	 */



	function get_info($id, $field = '')



	{

		$this->db->cache_on();



		if (!$id)



		{



			return FALSE;



		}



		$where = array();



		$where[$this->key] = $id;



		return $this->get_info_rule($where, $field);



	}



	



	/**



	 * Lay thong tin cua row tu dieu kien



	 * $where: Mảng điều kiện



	 * $field: Cột muốn lấy dữ liệu



	 */



	function get_info_rule($where = array(), $field= '')



	{



		if($field)



		{



			$this->db->select($field);



		}



		$this->db->where($where);



		$query = $this->db->get($this->table);



		if ($query->num_rows())



		{



			return $query->row();



		}



		



		return FALSE;



	}



	



	/**



	 * Lay tong so



	 */



	function get_total($input = array())



	{

		$this->db->cache_on();



		$this->get_list_set_input($input);



		$query = $this->db->get($this->table);



		return $query->num_rows();



	}



	



	/**



	 * Lay tong so



	 * $field: cot muon tinh tong



	 */



	function get_sum($field, $where = array())



	{

		$this->db->cache_on();



		$this->db->select_sum($field);//tinh rong



		$this->db->where($where);//dieu kien



		$this->db->from($this->table);



		$row = $this->db->get()->row();



		foreach ($row as $f => $v)



		{



			$sum += $v;



		}



		return $sum;



	}



	



	/**



	 * Lay 1 row



	 */



	function get_row($input = array())

	

	{

		$this->db->cache_on();



		$this->get_list_set_input($input);



		$query = $this->db->get($this->table);



		return $query->row();



	}



	



	/**



	 * Lay danh sach



	 * $input : mang cac du lieu dau vao



	 */



	function get_list($input = array())



	{

		$this->db->cache_on();



	    //xu ly ca du lieu dau vao



		$this->get_list_set_input($input);



		//thuc hien truy van du lieu



		$query = $this->db->get($this->table);



		//echo $this->db->last_query();



		return $query->result();



	}



	



	/**



	 * Gan cac thuoc tinh trong input khi lay danh sach



	 * $input : mang du lieu dau vao



	 */



	



	protected function get_list_set_input($input = array())



	{



	

		// Thêm điều kiện cho câu truy vấn truyền qua biến $input['where'] 



		//(vi du: $input['where'] = array('email' => 'hocphp@gmail.com'))



		if ((isset($input['where'])) && $input['where'])



		{



			$this->db->where($input['where']);



		}



		// Thêm điều kiện cho câu truy vấn truyền qua biến $input['or_where'] 
		//(vi du: $input['or_where'] = array('email' => 'hocphp@gmail.com','email' => 'hocdotnet@gmail.com'))
		if ((isset($input['or_where'])) && $input['or_where'])
		{
			$this->db->or_where($input['or_where']);
		}



		//tim kiem like



		// $input['like'] = array('name' => 'abc');



		if ((isset($input['like'])) && $input['like'])



		{



			$this->db->like($input['like'][0], $input['like'][1]); 



		}



		



		// Thêm sắp xếp dữ liệu thông qua biến $input['order'] 



		//(ví dụ $input['order'] = array('id','DESC'))



		if (isset($input['order'][0]) && isset($input['order'][1]))



		{



			$this->db->order_by($input['order'][0], $input['order'][1]);


		}
		else if (isset($input['order']['order'])) {
            $this->db->order_by($input['order']['order']);
		}



		else



		{



			//mặc định sẽ sắp xếp theo id giảm dần 



			$order = ($this->order == '') ? array($this->table.'.'.$this->key, 'desc') : $this->order;



            $this->db->order_by($order[0], $order[1]);



		}





		// Thêm điều kiện limit cho câu truy vấn thông qua biến $input['limit'] 



		//(ví dụ $input['limit'] = array('10' ,'0')) 



		if (isset($input['limit'][0]) && isset($input['limit'][1]))



		{



			$this->db->limit($input['limit'][0], $input['limit'][1]);



		}



	}



	/**



	 * kiểm tra sự tồn tại của dữ liệu theo 1 điều kiện nào đó



	 * $where : mang du lieu dieu kien



	 */



	function check_exists($where = array())



	{



		$this->db->cache_on();



		$this->db->where($where);



	    //thuc hien cau truy van lay du lieu



		$query = $this->db->get($this->table);



		if($query->num_rows() > 0){



			return TRUE;



		}else{



			return FALSE;



		}



	}



	public function getLastID()



	{

		$this->db->cache_on();



		return $this->db->insert_id();

	}



}







/* End of file MY_Model.php */



/* Location: ./application/core/MY_Model.php */