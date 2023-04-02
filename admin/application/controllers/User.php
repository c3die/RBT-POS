<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user extends MY_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('Log_model');
        $this->load->library('form_validation');
        $this->load->library('encryption');


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
            
            $total_row = $this->user_model->count_total_filter($filter);
            $data['users'] = $this->user_model->get_filter($filter,url_param());
        }else{
            $total_row = $this->user_model->count_total();
            $data['users'] = $this->user_model->showdatadb();
        }
        $data['paggination'] = get_paggination($total_row,get_search());

        $this->load->view('user/index',$data);
    }

    public function create(){
        $code_supplier = $this->user_model->get_last_id();
        if($code_supplier){
            $id = $code_supplier[0]->id;
            $data['code_user'] = generate_code('user',$id,4);
        }else{
            $data['code_user'] = 'user0001';
        }

        $this->load->view('user/form',$data);
    }

    public function edit($id = ''){
        $check_id = $this->user_model->get_by_id($id);
        if($check_id){
            $data['user'] = $check_id[0];
            $this->load->view('user/edit',$data);
        }else{
            redirect(site_url('user'));
        }
    } public function cancel($id = ''){
        $check_id = $this->user_model->get_by_id($id);
        if($check_id){
            $data['user'] = $check_id[0];
            $this->load->view('user/cancel',$data);
        }else{
            redirect(site_url('user'));
        }
    }

    public function save($id = ''){
        $this->form_validation->set_rules('id', 'id', 'required');
        $this->form_validation->set_rules('fullname', 'fullname', 'required');
        $this->form_validation->set_rules('email', 'email', 'required');
       
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('birthday', 'birthday', 'required');
        $this->form_validation->set_rules('contact', 'contact', 'required');
        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('recovery', 'recovery', 'required');
       
        
        $data['id'] = escape($this->input->post('id'));
        $data['fullname'] = escape($this->input->post('fullname'));
        $data['email'] = escape($this->input->post('email'));
       
        $data['address'] = escape($this->input->post('address'));
        $data['birthday'] = escape($this->input->post('birthday'));
        $data['contact'] = escape($this->input->post('contact'));
        $data['username'] = escape($this->input->post('username'));
        $data['password'] = escape($this->input->post('password'));
        $data['recovery'] = escape($this->input->post('recovery'));
        $data['status'] = escape($this->input->post('status'));
        $data['date'] = escape($this->input->post('date1'));



        $data1['log_name'] = escape($this->input->post('username1'));
        $data1['activity'] = escape($this->input->post('activity'));
        $data1['name'] = escape($this->input->post('fullname'));
        $data1['date'] = escape($this->input->post('date1'));



        if ($this->form_validation->run() != FALSE && !empty($id)) {
            // EDIT

              
            $check_id = $this->user_model->get_by_id($id);
            if($check_id){
                unset($data['id']);
                $this->user_model->update($id,$data);
            }
        }elseif($this->form_validation->run() != FALSE && empty($id)){
            // INSERT NEW
           
        
            $this->user_model->insert($data);
        }else{
            $this->session->set_flashdata('form_false', 'Please check your form.');
            redirect(site_url('user/create'));
        }
        $this->Log_model->insert($data1);
        redirect(site_url('user'));
    }
    public function delete($id){
        $check_id = $this->user_model->get_by_id($id);
        if($check_id){
            $this->user_model->delete($id);
        }
        redirect(site_url('user'));
    }
    public function export_csv(){
        $filter = false;
        if(isset($_GET['search'])) {
            if (!empty($_GET['value']) && $_GET['value'] != '') {
                $filter[$_GET['search_by'] . ' LIKE'] = "%" . $_GET['value'] . "%";
            }
        }
        $data = $this->user_model->get_all_array($filter);
        $this->csv_library->export('users.csv',$data);
    }
}
