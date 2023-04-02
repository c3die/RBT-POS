<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends MY_Controller {
    function __construct(){
        parent::__construct();
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
            
            $total_row = $this->Log_model->count_total_filter($filter);
            $data['log'] = $this->Log_model->get_filter($filter,url_param());
        }else{
            $total_row = $this->Log_model->count_total();
            $data['log'] = $this->Log_model->showdatadb();
        }
        $data['paggination'] = get_paggination($total_row,get_search());

        $this->load->view('log/index',$data);
    }

  



    public function export_csv(){
        $filter = false;
        if(isset($_GET['search'])) {
            if (!empty($_GET['value']) && $_GET['value'] != '') {
                $filter[$_GET['search_by'] . ' LIKE'] = "%" . $_GET['value'] . "%";
            }
        }
        $data = $this->Log_model->get_all_array($filter);
        $this->csv_library->export('users.csv',$data);
    }
}
