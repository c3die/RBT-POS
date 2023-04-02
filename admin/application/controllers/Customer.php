<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class customer extends MY_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('customer_model');
        $this->load->model('Log_model');
        $this->load->library('form_validation');

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
            $total_row = $this->customer_model->count_total_filter($filter);
            $data['customers'] = $this->customer_model->get_filter($filter,url_param());
        }
        else{
            $total_row = $this->customer_model->count_total();
            $data['customers'] = $this->customer_model->showdatadb();
        }
        
        $data['paggination'] = get_paggination($total_row,get_search());

        $this->load->view('customer/index',$data);
    }

    public function create(){
        $code_supplier = $this->customer_model->get_last_id();
        if($code_supplier){
            $id = $code_supplier[0]->id;
            $data['code_customer'] = generate_code('CUST',$id,4);
        }else{
            $data['code_customer'] = 'CUST0001';
        }

        $this->load->view('customer/form',$data);
    }

    public function edit($id = ''){
        $check_id = $this->customer_model->get_by_id($id);
        if($check_id){
            $data['customer'] = $check_id[0];
            $this->load->view('customer/edit',$data);
        }else{
            redirect(site_url('customer'));
        }
    }
    public function cancel($id = ''){
        $check_id = $this->customer_model->get_by_id($id);
        if($check_id){
            $data['customer'] = $check_id[0];
            $this->load->view('customer/cancel',$data);
        }else{
            redirect(site_url('customer'));
        }
    }

    public function save($id = ''){
        $this->form_validation->set_rules('customer_id', 'ID', 'required');
        $this->form_validation->set_rules('store_name', 'Name', 'required');
        $this->form_validation->set_rules('customer_name', 'Name', 'required');
        $this->form_validation->set_rules('customer_phone', 'phone', 'required');
        $this->form_validation->set_rules('customer_address', 'address', 'required');
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('facebook', 'facebook', 'required');
        $this->form_validation->set_rules('customer_date', 'date', 'required');

        $data['id'] = escape($this->input->post('customer_id'));
        $data['store_name'] = escape($this->input->post('store_name'));
        $data['customer_name'] = escape($this->input->post('customer_name'));
        $data['customer_phone'] = escape($this->input->post('customer_phone'));
        $data['customer_address'] = escape($this->input->post('customer_address'));
        $data['email'] = escape($this->input->post('email'));
        $data['facebook'] = escape($this->input->post('facebook'));
        $data['date'] = escape($this->input->post('customer_date'));
        $data['status'] = escape($this->input->post('status'));


        ///////////////////


            /// logs

        $data1['log_name'] = escape($this->input->post('username'));
		$data1['activity'] = escape($this->input->post('activity'));
		$data1['name'] = escape($this->input->post('store_name'));
		$data1['date'] = escape($this->input->post('customer_date'));

		///////////
        if ($this->form_validation->run() != FALSE && !empty($id)) {
            // EDIT
            $check_id = $this->customer_model->get_by_id($id);
            if($check_id){
                unset($data['id']);
                $this->customer_model->update($id,$data);
            }
        }elseif($this->form_validation->run() != FALSE && empty($id)){
            // INSERT NEW
           
            $this->customer_model->insert($data);
        }else{
            $this->session->set_flashdata('form_false', 'Please check your form.');
            redirect(site_url('customer/create'));
        }

        $this->Log_model->insert($data1);
        redirect(site_url('customer'));
    }
  
    public function export_csv(){
        $filter = false;
        if(isset($_GET['search'])) {
            if (!empty($_GET['value']) && $_GET['value'] != '') {
                $filter[$_GET['search_by'] . ' LIKE'] = "%" . $_GET['value'] . "%";
            }
        }
        $data = $this->customer_model->get_all_array($filter);
        $this->csv_library->export('customers.csv',$data);
    }
}
