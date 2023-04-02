<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('product_model');
        $this->load->library('form_validation');
        $this->load->model('Log_model');    
        $this->load->model('category_model');
        $this->load->model('supplier_model');
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

            $total_row = $this->product_model->count_total_filter($filter);
            $data['products'] = $this->product_model->get_filter($filter,url_param());
           
        }else{
            $total_row = $this->product_model->count_total();
            $data['products'] = $this->product_model->showdatadb();
        }
        $data['paggination'] = get_paggination($total_row,get_search());
        $data['asd'] = $this->category_model->get_all();
        $this->load->view('product/index',$data);
    }
    public function lowstock(){
        if(isset($_GET['search'])){
            $filter = array();
            if(!empty($_GET['value']) && $_GET['value'] != ''){
                $filter[$_GET['search_by'].' LIKE'] = "%".$_GET['value']."%";
            }

            $total_row = $this->product_model->count_total_filter($filter);
            $data['products'] = $this->product_model->get_filter($filter,url_param());
           
        }else{
            $total_row = $this->product_model->count_total();
            $data['products'] = $this->product_model->lowstock();
        }
        $data['paggination'] = get_paggination($total_row,get_search());
        $data['asd'] = $this->category_model->get_all();
        $this->load->view('product/lowstock',$data);
    }

    public function create(){
        $code_supplier = $this->product_model->get_last_id();
        if($code_supplier){
            $id = $code_supplier[0]->id;
            $data['code_product'] = generate_code('PRD',$id,4);
        }else{
            $data['code_product'] = 'PRD0001';
        }
        $data['categories'] = $this->supplier_model->showdatadb();
        $data['category'] = $this->category_model->showdatadb();
        
        $this->load->view('product/form',$data);
    }

    public function check_id(){
        $id = $this->input->post('id');
        $check_id = $this->product_model->get_by_id($id);
        if(!$check_id){
            echo "available";
        }else{
            echo "unavailable";
        }
    }

    public function edit($id = ''){
        $check_id = $this->product_model->get_by_id($id);
        if($check_id){
            $data['category'] = $this->category_model->showdatadb();
            $data['product'] = $check_id[0];
            $this->load->view('product/edit',$data);
        }else{
            redirect(site_url('product'));
        }
    }
    public function cancel($id = ''){
        $check_id = $this->product_model->get_by_id($id);
        if($check_id){
            $data['category'] = $this->category_model->get_all();
            $data['product'] = $check_id[0];
            $this->load->view('product/cancel',$data);
        }else{
            redirect(site_url('product'));
        }
    }


    public function add_item(){

	

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

    public function save($id = ''){
        $this->form_validation->set_rules('product_id', 'ID', 'required');
        $this->form_validation->set_rules('product_name', 'Name', 'required');
        $this->form_validation->set_rules('category_id', 'Category', 'required');
        $this->form_validation->set_rules('sale_price', 'price', 'required');
        $this->form_validation->set_rules('product_date', 'date', 'required');
        $this->form_validation->set_rules('reorder_level', 'reorder_level', 'required');
        
        $data['id'] = escape($this->input->post('product_id'));
        $data['product_name'] = escape($this->input->post('product_name'));
        $data['product_qty'] = escape($this->input->post('product_qty'));
        $data['category_id'] = escape($this->input->post('category_id'));
        $data['product_desc'] = escape($this->input->post('product_desc'));
        $data['reorder_level'] = escape($this->input->post('reorder_level'));
        $data['sale_price'] = escape($this->input->post('sale_price'));
     
        
        $data['date'] = escape($this->input->post('product_date'));
        $data['status'] = escape($this->input->post('status'));


         $data1['log_name'] = escape($this->input->post('username'));
        $data1['activity'] = escape($this->input->post('activity'));
        $data1['name'] = escape($this->input->post('product_name'));
        $data1['date'] = escape($this->input->post('product_date'));




        if ($this->form_validation->run() != FALSE && !empty($id)) {
            // EDIT
            $check_id = $this->product_model->get_by_id($id);
            if($check_id){
                unset($data['id']);
                $this->product_model->update($id,$data);
            }
        }elseif($this->form_validation->run() != FALSE && empty($id)){
            // INSERT NEW
            $this->product_model->insert($data);
        }else{
            $this->session->set_flashdata('form_false', 'Please check your form.');
            redirect(site_url('product/create'));
        }
        $this->Log_model->insert($data1);

        redirect(site_url('product'));
    }
    public function delete($id){
        $this->product_model->delete($id);
        redirect(site_url('product'));
    }
    public function export_csv(){
        $filter = false;
        if(isset($_GET['search'])) {
            if (!empty($_GET['value']) && $_GET['value'] != '') {
                $filter[$_GET['search_by'] . ' LIKE'] = "%" . $_GET['value'] . "%";
            }
        }
        $data = $this->product_model->get_all_array($filter);
        $this->csv_library->export('products.csv',$data);
    }
}
