<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log_model extends CI_Model {
	function __construct(){
        parent::__construct();
	}
	
	public function get_all($limit_offset = array()){
		if(!empty($limit_offset)){
			$query = $this->db->get("logs",$limit_offset['limit'],$limit_offset['offset']);
		}else{
			$query = $this->db->get("logs");
		}
		return $query->result();
	}
	public function showdatadb(){
		$this->db->select("*");
		$this->db->from("logs");
		$this->db->order_by("id desc");
		$this->db->limit(10);
		$q = $this->db->get();
		return $q->result();
	}
	public function count_total(){
		$query = $this->db->get("logs");
		return $query->num_rows();
	}
	public function get_all_array($filter = ''){
		if(!empty($filter)) {
			$query = $this->db->get_where("logs",$filter);
		}else{
			$query = $this->db->get_where("logs");
		}
		return $query->result_array();
	}
	public function get_last_id(){
		$this->db->order_by('id', 'DESC');

		$query = $this->db->get("logs",1,0);
		return $query->result();
	}public function count_total1(){
		$this->db->select("*");
		$this->db->from("logs");
		$this->db->where('status != "Deleted"  ');
		
		$q = $this->db->get();
		return $q->num_rows();
	}
	public function insert($data1)
	{
		$this->db->insert('logs', $data1);
	}



	public function update($id,$data){
		$this->db->where('id', $id);
		$this->db->update('logs', $data);
	}
	public function get_by_id($id){
		$response = false;
		$query = $this->db->get_where('logs',array('id' => $id));
		if($query && $query->num_rows()){
			$response = $query->result_array();
		}
		return $response;
	}
	public function delete($id){
		$this->db->delete('logs', array('id' => $id));
	}
	public function get_filter($filter = '',$limit_offset = array()){
		if(!empty($filter)){
			$query = $this->db->get_where("logs",$filter,$limit_offset['limit'],$limit_offset['offset']);
		}else{
			$query = $this->db->get("logs",$limit_offset['limit'],$limit_offset['offset']);
		}
		return $query->result();
	}
	public function count_total_filter($filter = array()){
		if(!empty($filter)){
			$query = $this->db->get_where("logs",$filter);
		}else{
			$query = $this->db->get("logs");
		}
		return $query->num_rows();
	}
}