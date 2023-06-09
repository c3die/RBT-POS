<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cancel_sales_model extends CI_Model {
	private $table;
	private $select_default;
	function __construct(){
        parent::__construct();
		$this->table = 'cancelsales';
		
		$this->select_default = 'cancelsales.id AS id, customer_name, customer_phone, total_price, total_item,cancelsales.date AS date,cancelsales.pay_deadline_date,cancelsales.is_cash,cancelsales.status   ';
	}
	
	public function get_all($limit_offset = array()){
		$this->db->select($this->select_default);
		$this->db->join('customer', 'customer.id = cancelsales.customer_id', 'left');
		
		$this->db->order_by("date", "desc");
		if(!empty($limit_offset)){
			$query = $this->db->get($this->table,$limit_offset['limit'],$limit_offset['offset']);
		}else{
			$query = $this->db->get($this->table);
		}
		return $query->result();
	}
	public function count_total(){
		$query = $this->db->order_by("date", "desc")->get($this->table);
		return $query->num_rows();
	}
	public function get_all_array($filter = false){
		if($filter){
			$query = $this->db->order_by("date", "desc")->get_where($this->table,$filter);
		}else{
			$query = $this->db->order_by("date", "desc")->get($this->table);
		}
		return $query->result_array();
	}
	public function get_last_id(){
		$this->db->order_by('id', 'DESC');

		$query = $this->db->get($this->table,1,0);
		return $query->result();
	}
	public function insert($data){
		$this->db->insert('cancelsales', $data);
	}
	public function update($id,$data){
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
	}
	public function get_by_id($id){
		$response = false;
		$query = $this->db->get_where($this->table,array('id' => $id));
		if($query && $query->num_rows()){
			$response = $query->result_array();
		}
		return $response;
	}
	
	public function showdatadb(){
		$this->db->select("*");
		$this->db->from("cancelsales");
		$this->db->where('status != "deleted"');
		
		$this->db->limit(10);
		$q = $this->db->get();
		return $q->result();
	}


	public function delete($id){
		$this->db->where('id',$id);
		$this->db->update('sales_transaction',$data);
	
	}
	public function get_detail($id){
		$sql = "SELECT *, cancelsales.id AS id, product.id as product_id, cancelsales.date as date 
				FROM cancelsales 
				JOIN sales_data ON cancelsales.id = sales_data.sales_id 
				JOIN product ON product.id = sales_data.product_id 
				JOIN customer ON customer.id = cancelsales.customer_id 
				JOIN category ON category.id = sales_data.category_id 
				WHERE sales_data.sales_id = '".$id."'";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_filter_csv($filter = ''){
		$this->db->select('cancelsales.id AS id, cancelsales.total_price, cancelsales.total_item,cancelsales.date AS date,
					cancelsales.is_cash, cancelsales.pay_deadline_date,
					customer.id as customer_id,customer.customer_name,customer.customer_phone,customer.customer_address,
					category.category_name,
					product.id as product_id,product.product_name,product.product_desc,
					sales_data.quantity,sales_data.price_item,sales_data.subtotal');

		$this->db->join('sales_data', 'cancelsales.id = sales_data.sales_id');
		$this->db->join('customer', 'customer.id = cancelsales.customer_id');
		$this->db->join('category', 'category.id = sales_data.category_id');
		$this->db->join('product', 'product.id = sales_data.product_id');
		
		$this->db->order_by("cancelsales.date", "desc");
		
		$filter['type'] = '1';
		$this->db->where($filter);
		
		$query = $this->db->get($this->table);
		return $query->result_array();
	}

	public function get_filter($filter = '',$limit_offset = array(),$is_array = false){
		$this->db->select($this->select_default);
		$this->db->join('customer', 'customer.id = cancelsales.customer_id', 'left');
		$this->db->order_by("date", "desc");
		if(!empty($filter)){
			$this->db->where($filter);
			if($limit_offset){
				$this->db->limit($limit_offset['limit'],$limit_offset['offset']);
			}
			$query = $this->db->get($this->table);
		}else{
			$query = $this->db->get($this->table,$limit_offset['limit'],$limit_offset['offset']);
		}
		if($is_array){
			return $query->result_array();
		}else{
			return $query->result();
		}
	}

	public function count_total_filter($filter = array()){
		if(!empty($filter)){
			$query = $this->db->get_where($this->table,$filter);
		}else{
			$query = $this->db->get($this->table);
		}
		return $query->num_rows();
	}
	public function insert_purchase_data($data){
		$this->db->insert('sales_data', $data);
	}
	public function delete_purchase_data_trx($transaction_id){
		$this->db->delete('sales_data', array('sales_id' => $transaction_id));
	}

	/*
	 * Dues Disini
	 */
	public function count_total_filter_dues($filter = array()){
		$filter['is_cash'] = 0;
		$query = $this->db->order_by("date", "desc")->get_where($this->table,$filter);
		return $query->num_rows();
	}
	public function get_filter_dues($filter = '',$limit_offset = array(),$is_array = false){
		$filter['is_cash'] = 0;
		
		$this->db->select($this->select_default);
		$this->db->join('customer', 'customer.id = cancelsales.customer_id', 'left');
		$this->db->where($filter);
		if($limit_offset){
			$this->db->limit($limit_offset['limit'],$limit_offset['offset']);
		}
		$query = $this->db->order_by($this->table.".date", "desc")->get($this->table);

		if($is_array){
			$resopnse = $query->result_array();
		}else{
			$resopnse = $query->result();
		}
		return $resopnse;
	}
}