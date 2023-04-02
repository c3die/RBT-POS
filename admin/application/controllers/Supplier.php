<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends MY_Controller {
	function __construct(){
        parent::__construct();
		$this->load->model('supplier_model');
		$this->load->model('Log_model');
        $this->load->library('form_validation');
		$this->load->model('transaction_model');
		
		// Check Session Login
		if(!isset($_SESSION['logged_in'])){
			redirect(site_url('auth/login'));
		}
	}
	
	public function index(){
		if(isset($_GET['search'])){
			$filter = array();
			if(!empty($_GET['value']) && $_GET['value'] != ''){
				$filter[$_GET['search_by'].' LIKE'] = "%".$_GET['value']."%";
			}

			$total_row = $this->supplier_model->count_total_filter($filter);
			$data['suppliers'] = $this->supplier_model->get_filter($filter,url_param());
		}else{
			$total_row = $this->supplier_model->count_total();
			$data['suppliers'] = $this->supplier_model->showdatadb();
		}
		$data['paggination'] = get_paggination($total_row,get_search());

		$this->load->view('supplier/index',$data);
	}
	public function detail($id){
		$details = $this->transaction_model->supp_detail($id);
		if($details){
			$data['details'] = $details;
			$this->load->view('supplier/detail',$data);
		}else{
			redirect(site_url('supplier'));
		}
	}
	public function create(){
		$code_supplier = $this->supplier_model->get_last_id();
		if($code_supplier){
			$id = $code_supplier[0]->id;
			$data['code_supplier'] = generate_code('SUP',$id);
		}else{
			$data['code_supplier'] = 'SUP001';
		}
		
		$this->load->view('supplier/form',$data);
	}

	public function edit($id = ''){
		$check_id = $this->supplier_model->get_by_id($id);
		if($check_id){
			$data['supplier'] = $check_id[0];
			$this->load->view('supplier/edit',$data);
		}else{
			redirect(site_url('supplier'));
		}
	}
	public function cancel($id = ''){
		$check_id = $this->supplier_model->get_by_id($id);
		if($check_id){
			$data['supplier'] = $check_id[0];
			$this->load->view('supplier/cancel',$data);
		}else{
			redirect(site_url('supplier'));
		}
	}




	public function save($id = ''){
		$this->form_validation->set_rules('supplier_id', 'ID', 'required');
		$this->form_validation->set_rules('company_name', 'Company_Name', 'required');
		$this->form_validation->set_rules('supplier_name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('supplier_date', 'date', 'required');
		//////

	
		
	



		//////

		$data['id'] = escape($this->input->post('supplier_id'));
		$data['Company_Name'] = escape($this->input->post('company_name'));
		$data['supplier_name'] = escape($this->input->post('supplier_name'));
		$data['email'] = escape($this->input->post('email'));
		$data['supplier_phone'] = escape($this->input->post('supplier_phone'));
		$data['supplier_address'] = escape($this->input->post('supplier_address'));
		$data['date'] = escape($this->input->post('supplier_date'));
		$data['status'] = escape($this->input->post('status'));

		//// for logs
		
		$data1['log_name'] = escape($this->input->post('username'));
		$data1['activity'] = escape($this->input->post('activity'));
		$data1['name'] = escape($this->input->post('company_name'));
		$data1['date'] = escape($this->input->post('supplier_date'));

		
	
		

		if ($this->form_validation->run() != FALSE && !empty($id)) {       
			// EDIT
			$check_id = $this->supplier_model->get_by_id($id);
			if($check_id){
				unset($data['id']);
				$this->Log_model->insert($data1);
				$this->supplier_model->update($id,$data);
			}
		}elseif($this->form_validation->run() != FALSE && empty($id)){
			// INSERT NEW

			$this->Log_model->insert($data1);
			$this->supplier_model->insert($data);
		
		}else{
			$this->session->set_flashdata('form_false', 'Please check your form.');
			redirect(site_url('supplier/create'));
		}
		
		
		redirect(site_url('supplier'));
	}


	


































	public function export_csv(){
		$filter = false;
		if(isset($_GET['search'])) {
			$filter = array();
			if (!empty($_GET['value']) && $_GET['value'] != '') {
				$filter[$_GET['search_by'] . ' LIKE'] = "%" . $_GET['value'] . "%";
			}
		}
		$data = $this->supplier_model->get_all_array($filter);
		$this->csv_library->export('supplier.csv',$data);
	}
}
