<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct(){
        parent::__construct();
		$this->load->model('Auth_model');
		$this->load->model('supplier_model');
		$this->load->model('customer_model');
		$this->load->model('product_model');
		$this->load->model('category_model');
        $this->load->model('sales_model');
        $this->load->model('return_sales_model');
		
		// Check Session Login
		if(!isset($_SESSION['logged_in'])){
			
			redirect(site_url('auth/login'));
		}
	}
	
	function index(){

		
		redirect(site_url('home/dashboard'));
	}
	
	function dashboard(){
		$date = date('Y-m-d', strtotime("+30 days"));
		$filter['DATE(sales_transaction.pay_deadline_date) <='] = $date;
		$limit_offset['limit'] = 10;
		$limit_offset['offset'] = 0;
        $data['dues'] = $this->sales_model->count_total_filter_dues($filter);
		
		$data['suppliers'] = $this->supplier_model->count_total1();
		$data['customers'] = $this->customer_model->count_total1();
		$data['products'] = $this->product_model->count_total1();
		$data['categories'] = $this->category_model->count_total();
		$data['sales_daily'] = $this->sales_daily();
	
		$data['sales_monthly'] = $this->sales_daily(true);
		$data['sales_return'] = $this->return_sales_model->get_all_not_returned();
		
		$data['productss'] = $this->product_model->lowstock();

		$data['productsss'] = $this->product_model->lowstock1();

		$data['tprod'] = $this->sales_model->topsell();

		$this->load->view('home/dashboard',$data);
	}
	


	private function sales_daily($daily = false){
		$today = date("Y-m-d",strtotime("today"));
		$yesterday = date("Y-m-d",strtotime("-1 day"));	
		if($daily){
			$yesterday = date("Y-m-d",strtotime("-30 day"));	
		}	

		$filter['DATE(sales_transaction.date) >='] = $yesterday;
		$filter['DATE(sales_transaction.date) <='] = $today;

		$sales = $this->sales_model->get_filter($filter,url_param());
		return $sales;
	}
}
