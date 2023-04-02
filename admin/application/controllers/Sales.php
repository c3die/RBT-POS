<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class sales extends MY_Controller {
	function __construct(){
        parent::__construct();
		$this->load->model('auth_model');
        $this->load->library('form_validation');
		$this->load->model('sales_model');
		$this->load->model('Log_model');
		$this->load->model('cancel_sales_model');
		$this->load->model('customer_model');
		$this->load->model('category_model');
		$this->load->model('product_model');
		
		// Check Session Login
		if(!isset($_SESSION['logged_in'])){
			redirect(site_url('auth/login'));
		}
	}
	
	function index(){
		if(isset($_GET['search'])){
			$filter = '';
			if(!empty($_GET['id']) && $_GET['id'] != ''){
				$filter['sales_transaction.id LIKE'] = "%".$_GET['id']."%";
			}

			if(!empty($_GET['date_from']) && $_GET['date_from'] != ''){
				$filter['DATE(sales_transaction.date) >='] = $_GET['date_from'];
			}

			if(!empty($_GET['date_end']) && $_GET['date_end'] != ''){
				$filter['DATE(sales_transaction.date) <='] = $_GET['date_end'];
			}

			$total_row = $this->sales_model->count_total_filter($filter);
			$data['sales'] = $this->sales_model->get_filter($filter,url_param());
		}else{
			$total_row = $this->sales_model->count_total();
			$data['sales'] = $this->sales_model->get_all();
		}
		$data['paggination'] = get_paggination($total_row,get_search());
		$this->load->view('sales/index',$data);
	}
	
	
	function create(){
		// destry cart
		$this->cart->destroy();

		$data['code_sales'] = "OUT".strtotime(date("Y-m-d H:i:s"));
		$data['customers'] = $this->customer_model->showdatadb();
		$data['categories'] = $this->category_model->showdatadb();
		$this->load->view('sales/form',$data);
	}
	
	public function detail($id){
		$details = $this->sales_model->get_detail($id);
		if($details){
			$data['details'] = $details;
			$this->load->view('sales/detail',$data);
		}else{
			redirect(site_url('sales'));
		}
	}
	public function edit($id){
		// destry cart
		$this->cart->destroy();
		$data['suppliers'] = $this->supplier_model->get_all();
		$data['categories'] = $this->category_model->get_all();

		$transaction = $this->sales_model->get_detail($id);
		if($transaction){
			//print_r($transaction); exit;
			$data['carts'] = $this->_process_cart($transaction);
			$data['purchase'] = $transaction;
			$this->load->view('sales/form',$data);
		}else{
			redirect(site_url('sales'));
		}
	}

	private function _process_cart($transaction = ''){
		if($transaction & is_array($transaction)){
			foreach($transaction as $key => $item){
				$data = array(
					'id'      => $item->product_id,
					'qty'     => $item->quantity,
					'buying_price'     => $item->buying_price,
					'price'   => $item->price_item,
					'category_id' => $item->category_id,
					'category_name' => $item->category_name,
					'name'    => $item->product_name
				);
				$this->cart->insert($data);
			}
		}
		$response = array(
				'data' => $this->cart->contents() ,
				'total_item' => $this->cart->total_items(),
				'total_price' => $this->cart->total()
			);
		return $response;
	}

	public function check_id(){
		$id = $this->input->post('id');
		$check_id = $this->sales_model->get_by_id($id);
		if(!$check_id){
			echo "available";
		}else{
			echo "unavailable";
		}
	}
	
	public function check_category_id($category_id){
		$products = $this->product_model->get_by_category($category_id);
		echo json_encode($products);
	}
	public function check_product_id($product_id){
		$products = $this->product_model->get_by_id($product_id);
		echo json_encode($products);
	}
	public function add_item(){

		$product_id = $this->input->post('product_id');
		$quantity = $this->input->post('quantity');
		$buying_price = $this->input->post('buying_price');
		$sale_price = $this->input->post('sale_price');

		$get_product_detail =  $this->product_model->detail_by_id($product_id);
		if($get_product_detail){
			$data = array(
				'id'      => $product_id,
				'qty'     => $quantity,
				'buying_price'     => $buying_price,
				'price'   => $sale_price,
				'category_id' => $get_product_detail[0]['category_id'],
				'category_name' => $get_product_detail[0]['category_name'],
				'name'    => $get_product_detail[0]['product_name']
			);



			
			$this->cart->insert($data);
			echo json_encode(array('status' => 'ok',
							'data' => $this->cart->contents() ,
							'total_item' => $this->cart->total_items(),
							'total_price' => $this->cart->total()
						)
				);




		}else{
			echo json_encode(array('status' => 'error'));
		}

	}
	public function delete_item($rowid){
		if($this->cart->remove($rowid)) {
			echo number_format($this->cart->total());
		}else{
			echo "false";
		}
	}

	public function insert_log(){

		$this->form_validation->set_rules('sales_id', 'sales_id', 'required');
		

		$data1['log_name'] = escape($this->input->post('username'));
		$data1['activity'] = escape($this->input->post('activity'));
		$data1['name'] = escape($this->input->post('sales_id'));
		//$data1['date'] = escape($this->input->post('date'));

		$this->Log_model->insert($data1);
		redirect(site_url('sales'));

	}
	public function add_process(){
		$this->form_validation->set_rules('sales_id', 'sales_id', 'required');
		$this->form_validation->set_rules('customer_id', 'customer_id', 'required');
		$this->form_validation->set_rules('is_cash', 'is_cash', 'required');

		$carts =  $this->cart->contents();
		if($this->_check_qty($carts)){
			echo json_encode(array('status' => 'limit'));
			exit;
		}
		

		if($this->form_validation->run() != FALSE && !empty($carts) && is_array($carts)){
			$data['id'] = escape($this->input->post('sales_id'));
			$data['customer_id'] = escape($this->input->post('customer_id'));
			$data['is_cash'] = escape($this->input->post('is_cash'));
			$data['total_price'] = $this->cart->total();
			$data['total_item'] = $this->cart->total_items();

		
		


			if($data['is_cash'] == 0){
				$data['pay_deadline_date'] = date('Y-m-d', strtotime("+30 days"));
			}else{
				$data['pay_deadline_date'] = date('Y-m-d');
			}
			
			
			$this->sales_model->insert($data);
			if($data['id']){
				$this->_insert_purchase_data($data['id'],$carts);
			}
			echo json_encode(array('status' => 'ok'));
		}else{
			echo json_encode(array('status' => 'error'));
		}
	}
	
	private function _check_qty($carts){
		$status = false;
		foreach($carts as $key => $cart){
			$product = $this->product_model->get_by_id($cart['id']);
			if($cart['qty'] > $product[0]['product_qty']){
				$status = true;
				break;
			}
		}
		return $status;
	}

	public function cancel($id = ''){
        $check_id = $this->sales_model->get_by_id($id);
        if($check_id){
            $data['sales'] = $check_id[0];
            $this->load->view('sales/cancel',$data);
        }else{
            redirect(site_url('sales'));
        }
	}
	

	public function save($id = ''){
		$this->form_validation->set_rules('id', 'ID', 'required');
        $this->form_validation->set_rules('customer_id', 'customer_id', 'required');
        $this->form_validation->set_rules('is_cash', 'is_cash', 'required');
        $this->form_validation->set_rules('total_price', 'total_price', 'required');
		$this->form_validation->set_rules('total_item', 'total_item', 'required');
		$this->form_validation->set_rules('date', 'date', 'required');
		

		$data['id'] = escape($this->input->post('id'));
        $data['customer_id'] = escape($this->input->post('customer_id'));
        $data['is_cash'] = escape($this->input->post('is_cash'));
        $data['total_price'] = escape($this->input->post('total_price'));
        $data['total_item'] = escape($this->input->post('total_item'));
        $data['date'] = escape($this->input->post('date'));
        $data['status'] = escape($this->input->post('status'));

        
            
          
                
    	$this->cancel_sales_model->insert($data);
		
	
			

		$this->sales_model->delete($id);
		redirect(site_url('sales'));
        
    }
	private function _insert_purchase_data($sales_id,$carts){
		foreach($carts as $key => $cart){
			$purchase_data = array(
				'sales_id' => $sales_id,
				'product_id' => $cart['id'],
				'category_id' => $cart['category_id'],
				'quantity' => $cart['qty'],
				'price_item' => $cart['price'],
				'buying_price' => $cart['buying_price'],
				'subtotal' => $cart['subtotal']
			);
			$this->sales_model->insert_purchase_data($purchase_data);

			$this->product_model->update_qty_min($cart['id'],array('product_qty' => $cart['qty']));
		}
		$this->cart->destroy();
	}
	public function delete($transaction_id){
		$transaction = $this->sales_model->get_detail($transaction_id);
		foreach($transaction as $trans){
			$product = $this->product_model->get_by_id($trans->product_id);
			$total = $product[0]['product_qty'] - $trans->quantity;
			$this->product_model->update_qty($product[0]['id'] ,array('product_qty' => $total));
		}
		$this->sales_model->delete($transaction_id);
		$this->sales_model->delete_purchase_data_trx($transaction_id);

		
	}
	public function export_csv(){
		$filter = '';
		if(isset($_GET['search'])) {
			if (!empty($_GET['id']) && $_GET['id'] != '') {
				$filter['sales_transaction.id LIKE'] = "%" . $_GET['id'] . "%";
			}

			if (!empty($_GET['date_from']) && $_GET['date_from'] != '') {
				$filter['DATE(sales_transaction.date) >='] = $_GET['date_from'];
			}

			if (!empty($_GET['date_end']) && $_GET['date_end'] != '') {
				$filter['DATE(sales_transaction.date) <='] = $_GET['date_end'];
			}
		}
		$result = $this->sales_model->get_filter_csv($filter);
		if($result){
			$result = $this->_set_csv_format($result);
		}
		//echo json_encode($result);
		$this->csv_library->export('sales.csv',$result);
	}
	public function print_now($id = ""){
		$details = $this->sales_model->get_detail($id);
		if($details){
			$data['details'] = $details;
			$this->load->view("sales/print",$data);
		}else{
			redirect(site_url('sales'));
		}
	}
	
	private function _set_csv_format($datas){
		$result = false;
		if(is_array($datas)){
			$data_before = "";
			foreach($datas as $k => $data){
				$datas[$k]['is_cash'] = ($data['is_cash'] == 1) ? "Cash" : "Pay Later";
				$datas[$k]['pay_deadline_date'] = ($data['is_cash'] == 1) ? "" : $data["pay_deadline_date"];
				$datas[$k]['date'] = date("Y-m-d H:i:s",strtotime($data['date']));
				if($data['id'] == $data_before) {
					$datas[$k]['id'] = "";
					$datas[$k]['customer_id'] = "";
					$datas[$k]['customer_name'] = "";
					$datas[$k]['customer_phone'] = "";
					$datas[$k]['customer_address'] = "";
					$datas[$k]['category_name'] = "";
					$datas[$k]['total_price'] = "";
					$datas[$k]['total_item'] = "";
					$datas[$k]['is_cash'] = "";
					$datas[$k]['pay_deadline_date'] = "";

					$datas[$k]['date'] = "";
				}
				$data_before = $data['id'];
			}
			$result = $datas;
		}
		return $result;
	}
}
