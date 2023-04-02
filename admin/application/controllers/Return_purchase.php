<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class return_purchase extends MY_Controller {
	function __construct(){
        parent::__construct();
		$this->load->model('auth_model');
        $this->load->library('form_validation');
		$this->load->model('return_purchase_model');
		$this->load->model('transaction_model');
		$this->return_purchase = $this->return_purchase_model;
		$this->load->model('Log_model');
		$this->load->model('return_sales_model');
		$this->sales = $this->return_sales_model;
		$this->load->model('customer_model');
		$this->load->model('sales_model');
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
				$filter['purchase_transaction.id LIKE'] = "%".$_GET['id']."%";
			}

			if(!empty($_GET['date_from']) && $_GET['date_from'] != ''){
				$filter['DATE(purchase_transaction.date) >='] = $_GET['date_from'];
			}

			if(!empty($_GET['date_end']) && $_GET['date_end'] != ''){
				$filter['DATE(purchase_transaction.date) <='] = $_GET['date_end'];
			}

			$total_row = $this->return_purchase->count_total_filter($filter);
			$data['sales'] = $this->return_purchase->get_filter($filter,url_param());
		}else{
			$total_row = $this->return_purchase->count_total();
			$data['sales'] = $this->return_purchase->get_all(url_param());
		}
		$data['paggination'] = get_paggination($total_row,get_search());
		$this->load->view('return_purchase/index',$data);
	}
	
	function create(){
		if(isset($_GET['search'])){
			$filter = '';
			if(!empty($_GET['id']) && $_GET['id'] != ''){
				$filter['purchase_transaction.id LIKE'] = "%".$_GET['id']."%";
			}

			if(!empty($_GET['date_from']) && $_GET['date_from'] != ''){
				$filter['DATE(purchase_transaction.date) >='] = $_GET['date_from'];
			}

			if(!empty($_GET['date_end']) && $_GET['date_end'] != ''){
				$filter['DATE(purchase_transaction.date) <='] = $_GET['date_end'];
			}

			$total_row = $this->transaction_model->count_total_filter($filter);
			$data['sales'] = $this->transaction_model->get_filter($filter,url_param());
		}else{
			$total_row = $this->transaction_model->count_total();
			$data['sales'] = $this->transaction_model->get_all(url_param());
		}
		$data['return'] = true;
		$data['paggination'] = get_paggination($total_row,get_search());
		$this->load->view('return_purchase/return_index',$data);
	}

	function create_return($id){
		// destry cart
		$this->cart->destroy();

		$details = $this->transaction_model->get_detail($id);
		if(!$details){
			redirect(site_url());
		}
		$cart_data = $this->_process_cart($details);
		//print_r($cart_data); exit;
		$data['carts'] = $cart_data;
		$data['code_sales'] = $id;
		$data['code_return_sales'] = "RETP".strtotime(date("Y-m-d H:i:s"));
		$data['customers'] = $this->customer_model->get_all();
		$data['categories'] = $this->category_model->get_all();
		$data['details'] = $details;
		$this->load->view('return_purchase/form',$data);
	}
	
	public function detail($id){
		$details = $this->return_purchase->get_detail_by_id($id);
		if($details){
			$data['details'] = $details;
			$this->load->view('return_purchase/detail',$data);
		}else{
			redirect(site_url('return_purchase'));
		}
	}

	public function update_cart($rowid = ''){
		$qty = $this->input->post("qty");
		$data = array(
			'rowid' => $rowid,
			'qty'   => $qty
		);
		$this->cart->update($data);

		echo json_encode(
			array(
				'data' => $this->cart->contents(),
				'total' => $this->cart->total()
			)
		);
	}

	private function _process_cart($transaction = ''){
		if(!empty($transaction) & is_array($transaction)){
			foreach($transaction as $key => $item){
				$data = array(
					'id'      => $item->product_id,
					'qty'     => $item->quantity,
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
		$sale_price = $this->input->post('sale_price');

		$get_product_detail =  $this->product_model->detail_by_id($product_id);
		if($get_product_detail){
			$data = array(
				'id'      => $product_id,
				'qty'     => $quantity,
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

		$this->form_validation->set_rules('return_id', 'return_id', 'required');
		

		$data1['log_name'] = escape($this->input->post('username'));
		$data1['activity'] = escape($this->input->post('activity'));
		$data1['name'] = escape($this->input->post('return_id'));
		$data1['date'] = escape($this->input->post('date'));

		$this->Log_model->insert($data1);
		echo json_encode(array('status' => 'ok'));

	}
	public function add_process(){
		$this->form_validation->set_rules('return_id', 'return_id', 'required');
		$this->form_validation->set_rules('return_code', 'return_code', 'required');
		$this->form_validation->set_rules('return_date', 'return_date', 'required');

		$carts =  $this->cart->contents();

		if($this->form_validation->run() != FALSE && !empty($carts) && is_array($carts)){
			$data['id'] = escape($this->input->post('return_id'));
			$data['sales_return_id'] = escape($this->input->post('return_code'));
			$data['total_price'] = $this->cart->total();
			$data['total_item'] = $this->cart->total_items();
			$data['is_return'] = "0";
			$data['date'] = escape($this->input->post('return_date'));

			$this->return_purchase->insert($data);
			if($data['id']){
				$this->_insert_purchase_data($data['id'],$carts);
			}
			echo json_encode(array('status' => 'ok'));
		}else{
			echo json_encode(array('status' => 'error', 'carts' => $carts));
		}
	}

	public function edit($return_id){
		// destry cart
		$this->cart->destroy();

		$details = $this->return_purchase->get_detail_by_id($return_id);
		$details_sales = $this->return_purchase->get_detail_by_sales_id($return_id);
		if((!$details || $details[0]->is_return == 1) && (!$details_sales || $details_sales[0]->is_return == 1)){
			redirect(site_url('return_purchase'));
		}
		if(!$details){
			$details = $details_sales;
		}
		$cart_data = $this->_process_cart($details);
		//print_r($this->db); exit;
		$data['edit'] = true;
		$data['carts'] = $cart_data;
		$data['code_sales'] = $details[0]->sales_return_id;
		$data['code_return_sales'] = $details[0]->id;
		$data['date'] = $details[0]->date;
		$data['details'] = $details;
		$this->load->view('return_purchase/form',$data);
	}

	public function update($return_id = 0){
		$details = $this->return_purchase->get_detail_by_id($return_id);
		$details_sales = $this->return_purchase->get_detail_by_sales_id($return_id);
		if((!$details || $details[0]->is_return == 1) && (!$details_sales || $details_sales[0]->is_return == 1)){
			redirect(site_url('return_purchase'));
		}
		if(!$details){
			$details = $details_sales;
		}

		$carts =  $this->cart->contents();
		$is_return = escape($this->input->post("is_return"));
		$return_by = escape($this->input->post("return_by"));
		$check_qty = $this->_check_qty($carts);
		if(!empty($carts) && is_array($carts) && $check_qty){
			// Delete Row on sales_data table
			foreach($details as $detail){
				if($details_sales){
					$this->return_purchase->delete_data_sales($detail->sales_return_id);
				}else{
					$this->return_purchase->delete_data($detail->id);
				}
			}

			$data['id'] = $return_id;
			$data['total_price'] = $this->cart->total();
			$data['total_item'] = $this->cart->total_items();
			$data['is_return'] = ($is_return != "undefined") ? (int)$is_return : "0";
			$data['return_by'] = ($return_by != "undefined") ? (int)$return_by : "0";

			$is_return_old = $details[0]->is_return;
			if($is_return == 1 && $is_return_old != 1 && strpos($details[0]->sales_return_id, "RETS") !== false && $return_by == 1){
				// Update product and return purchase
				foreach($carts as $cart){
					$this->product_model->update_qty_add($cart['id'],array('product_qty' => $cart['qty']));
				}
			}
			$this->return_purchase->update($return_id,$data);
			
			if($data['id']){

				$this->_insert_purchase_data($data['id'],$carts);
			}

			echo json_encode(array('status' => 'ok','is_return' => $is_return));
		}else if(!$check_qty){
			echo json_encode(array('status' => 'limit'));
		}else{
			echo json_encode(array('status' => 'error','is_return' => $is_return));
		}
	}

	private function _check_qty($carts){
		$result = true;
		foreach($carts as $cart) {
			// Check Quantity Product
			$product = $this->product_model->get_by_id($cart['id']);
			$qty = $product[0]['product_qty'];
			if($cart['qty'] > $qty){
				$result = false;
				break;
			}
		}
		return $result;
	}

	private function _insert_purchase_data($sales_id,$carts){
		foreach($carts as $key => $cart){
			$purchase_data = array(
				'transaction_id' => $sales_id,
				'product_id' => $cart['id'],
				'category_id' => $cart['category_id'],
				'quantity' => $cart['qty'],
				'price_item' => $cart['price'],
				'subtotal' => $cart['subtotal']
			);
			$this->transaction_model->insert_purchase_data($purchase_data);

			//$this->product_model->update_qty_min($cart['id'],array('product_qty' => $cart['qty']));
		}
		$this->cart->destroy();
	}
	public function delete($return_id){
		$details = $this->return_purchase->get_detail_by_id($return_id);
		$details_sales = $this->return_purchase->get_detail_by_sales_id($return_id);

		$this->return_purchase->delete($return_id);

		if((!$details || $details[0]->is_return == 1) && (!$details_sales || $details_sales[0]->is_return == 1)){
			redirect(site_url('return_purchase'));
		}
		if(!$details){
			$details = $details_sales;
		}

		// Delete Row on sales_data table
		foreach($details as $detail){
			$this->return_purchase->delete_data($detail->sales_id);
		}
		$this->return_purchase->delete($return_id);
		redirect(site_url('return_purchase'));
	}
	public function export_csv(){
		$data = $this->return_purchase->get_filter('',url_param(),true);
		$this->csv_library->export('return-purchase.csv',$data);
	}
}
