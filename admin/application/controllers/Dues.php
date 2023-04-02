<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dues extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('sales_model');
        $this->load->model('product_model');
        $this->load->library('form_validation');

        $this->load->model('category_model');

        // Check Session Login
        if (!isset($_SESSION['logged_in'])) {
            redirect(site_url('auth/login'));
        }
    }

    public function index()
    {
        $filter = '';
        if(!empty($_GET['id']) && $_GET['id'] != ''){
            $filter['sales_transaction.id LIKE'] = "%".$_GET['id']."%";
        }

        if(!empty($_GET['date_range']) && $_GET['date_range'] != ''){
            $date = date('Y-m-d', strtotime("+".$_GET['date_range']." days"));
            $filter['DATE(sales_transaction.pay_deadline_date) <='] = $date;
        }

        if(!empty($_GET['date_trx']) && $_GET['date_trx'] != ''){
            $filter['DATE(sales_transaction.date)'] = $_GET['date_trx'];
        }

        $total_row = $this->sales_model->count_total_filter_dues($filter);
        $data['dues'] = $this->sales_model->get_filter_dues($filter,url_param());
        //var_dump($this->db); exit;

        $data['paggination'] = get_paggination($total_row,get_search());
        $this->load->view('dues/index',$data);
    }
    public function detail($id){
        $data['details'] = $this->sales_model->get_detail($id);
        $this->load->view('dues/detail',$data);
    }
    public function update($id){
        $details = $this->sales_model->get_detail($id);
        if($details){
            $data['is_cash'] = 1;
            $this->sales_model->update($id,$data);
        }

        redirect(site_url('dues'));
    }
    public function export_csv(){
        $filter = false;
        if(!empty($_GET['id']) && $_GET['id'] != ''){
            $filter['sales_transaction.id LIKE'] = "%".$_GET['id']."%";
        }

        if(!empty($_GET['date_range']) && $_GET['date_range'] != ''){
            $date = date('Y-m-d', strtotime("+".$_GET['date_range']." days"));
            $filter['DATE(sales_transaction.pay_deadline_date) <='] = $date;
        }

        if(!empty($_GET['date_trx']) && $_GET['date_trx'] != ''){
            $filter['DATE(sales_transaction.date)'] = $_GET['date_trx'];
        }
        
        $data = $this->sales_model->get_filter_dues('',url_param(),true);
        $this->csv_library->export('dues.csv',$data);
    }
}