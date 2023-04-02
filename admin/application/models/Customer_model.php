<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class customer_model extends CI_Model {
	function __construct(){
        parent::__construct();
	}
	
	public function get_all($limit_offset = array()){
		if(!empty($limit_offset)){
			$query = $this->db->get("customer",$limit_offset['limit'],$limit_offset['offset']);
		}else{
			$query = $this->db->get("customer");
		}
		return $query->result();
	}
	public function count_total(){
		$query = $this->db->get("customer");
		return $query->num_rows();
	}
	public function get_all_array($filter = false){
		if(!empty($filter)) {
			$query = $this->db->get_where("customer", $filter);
		}else{
			$query = $this->db->get("customer");
		}
		return $query->result_array();
	}
	public function get_last_id(){
		$this->db->order_by('id', 'DESC');

		$query = $this->db->get("customer",1,0);
		return $query->result();
	}
	public function insert($data){
		$this->db->insert('customer', $data);
	}
	public function update($id,$data){
		$this->db->where('id', $id);
		$this->db->update('customer', $data);
	}
	public function get_by_id($id){
		$response = false;
		$query = $this->db->get_where('customer',array('id' => $id));
		if($query && $query->num_rows()){
			$response = $query->result_array();
		}
		return $response;
	}
	public function showdatadb(){
		$this->db->select("*");
		$this->db->from("customer");
		$this->db->where('status != "Deleted"');
		$this->db->limit(10);
		$q = $this->db->get();
		return $q->result();
	}
	public function count_total1(){
		$this->db->select("*");
		$this->db->from("customer");
		$this->db->where('status != "Deleted"  ');
		
		$q = $this->db->get();
		return $q->num_rows();
	}

	public function delete($id){
		$this->db->where('id',$id);
		$this->db->update('customer',$data);
		
		
		
	}
	public function get_filter($filter = '',$limit_offset = array()){
		if(!empty($filter)){
			$query = $this->db->get_where("customer  ",$filter,$limit_offset['limit'],$limit_offset['offset']);
		
		}else{
			$query = $this->db->get("customer",$limit_offset['limit'],$limit_offset['offset']);
		}
		return $query->result();
	}

	public function count_total_filter($filter = array()){
		if(!empty($filter)){
			$query = $this->db->get_where("customer",$filter);
		}else{
			$query = $this->db->get("customer");
		}
		return $query->num_rows();
	}
}