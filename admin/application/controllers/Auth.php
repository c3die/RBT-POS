<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {
	function __construct(){
        parent::__construct();
		$this->load->model('auth_model');
		$this->load->model('user_model');
        $this->load->library('form_validation');		
	}
	
	function index(){
		redirect(site_url());
	}
	
	function login(){		
		// Check Session Login
		if(isset($_SESSION['logged_in'])){
			redirect(site_url());
		}
		
		// Check Remember Me
	
		$this->load->view('auth/login');
	}
	function forgot(){
		$this->load->view('auth/forgot');
	}
	
	
	function forgot_process(){
		$email = escape($this->input->post("email"));		
	//	$password = escape($this->input->post("password"));
		
		if($email){
			$check_forgot = $this->auth_model->check_forgot($email);	
		}
		
		if($check_forgot){
			$id = $check_forgot[0]->id;
			$check_id = $this->user_model->get_by_id($id);
			if($check_id){
				$data['user'] = $check_id[0];
			}
			 $data['users'] = $this->user_model->user_filter($email);
			$this->session->set_flashdata('forgot_success', 'Success');
			$this->load->view('auth/forgot', $data);
			
		}else{
			$this->session->set_flashdata('login_false', 'Incorrect  Credentials!');
			redirect(site_url('auth/login'));
		}
	}
	public function login_process($check_login = false){
		// Check Session Login
		if(isset($_SESSION['logged_in'])){
			redirect(site_url('home/dashboard'));
		}
		// Check Remember Me
		
		$username = escape($this->input->post("username"));		
		$password = escape($this->input->post("password"));
		
		if($username && $password){
			$check_login = $this->auth_model->check_login($username,$password);	
		}
		
		if($check_login){
			$id = $check_login[0]->id;
			$this->auth_model->set_session($id,$username);
			
			redirect(site_url());
		}else{
			$this->session->set_flashdata('login_false', 'Incorrect Login Credentials!');
			redirect(site_url('auth/login'));
		}
	}
	
	function logout(){
		$this->auth_model->unset_session();
		$this->auth_model->unset_cookie_remember();
		redirect(site_url());
	}
}
