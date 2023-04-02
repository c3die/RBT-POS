<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class category extends MY_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('category_model');
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
            
            $total_row = $this->category_model->count_total_filter($filter);
            
            $result = $this->category_model->get_filter($filter,url_param());
            $data['categories'] = $result;
        }else{
            $total_row = $this->category_model->count_total();
            
            $result = $this->category_model->showdatadb();
            $data['categories'] = $result;
        }
        $data['paggination'] = get_paggination($total_row,get_search());

        $this->load->view('category/index',$data);
    }

    public function create(){

        
        $code_supplier = $this->category_model->get_last_id();
        if($code_supplier){
            $id = $code_supplier[0]->id;
            $data['code_cat'] = generate_code('CTG',$id,4);
        }else{
            $data['code_cat'] = 'CTG0001';
        }

        $this->load->view('category/form',$data);
    }

    public function check_id(){
        $id = $this->input->post('id');
        $check_id = $this->category_model->get_by_id($id);
        if(!$check_id){
            echo "available";
        }else{
            echo "unavailable";
        }
    }

    public function edit($id = ''){
        $check_id = $this->category_model->get_by_id($id);
        if($check_id){
            $data['category'] = $check_id[0];
            $this->load->view('category/edit',$data);
        }else{
            redirect(site_url('category'));
        }
    }
    public function cancel($id = ''){
        $check_id = $this->category_model->get_by_id($id);
        if($check_id){
            $data['category'] = $check_id[0];
            $this->load->view('category/cancel',$data);
        }else{
            redirect(site_url('category'));
        }
    }

    public function save($id = ''){
        $this->form_validation->set_rules('category_id', 'ID', 'required');
        $this->form_validation->set_rules('category_name', 'Nama', 'required');
        $this->form_validation->set_rules('category_date', 'Tanggal', 'required');

        $data['id'] = escape($this->input->post('category_id'));
        $data['category_name'] = escape($this->input->post('category_name'));
        $data['category_desc'] = escape($this->input->post('category_desc'));
        $data['date'] = escape($this->input->post('category_date'));
        $data['status'] = escape($this->input->post('status'));



        $data1['log_name'] = escape($this->input->post('username'));
        $data1['activity'] = escape($this->input->post('activity'));
        $data1['name'] = escape($this->input->post('category_name'));
        $data1['date'] = escape($this->input->post('category_date'));


        if ($this->form_validation->run() != FALSE && !empty($id)) {
            // EDIT
            $check_id = $this->category_model->get_by_id($id);
            if($check_id){
                unset($data['id']);
                $this->category_model->update($id,$data);
            }
        }elseif($this->form_validation->run() != FALSE && empty($id)){
            // INSERT NEW
            $this->category_model->insert($data);
        }else{
            $this->session->set_flashdata('form_false', 'Please check your form.');
            redirect(site_url('category/create'));
        }
         $this->Log_model->insert($data1);
        redirect(site_url('category'));
    }
    public function delete($id){
        $check_id = $this->category_model->get_by_id($id);
        if($check_id){
            $this->category_model->delete($id);
        }
        redirect(site_url('category'));
    }
    public function export_csv(){
        $filter = false;
        if(isset($_GET['search'])) {
            if (!empty($_GET['value']) && $_GET['value'] != '') {
                $filter[$_GET['search_by'] . ' LIKE'] = "%" . $_GET['value'] . "%";
            }
        }
        $data = $this->category_model->get_all_array($filter);
        $this->csv_library->export('category.csv',$data);
    }
}
