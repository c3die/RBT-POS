<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {
	function __construct(){
        parent::__construct();
	}
	
	public function check_login($username,$password){
		$query = $this->db->get_where("admin",array("username" => $username, "password" => $password) );
		return $query->result();
	}
	public function check_forgot($email){
		$query = $this->db->get_where("user",array("Email" => $email) );
		return $query->result();
	}
	public function get_profile($user_id){
		$query = $this->db->get_where("admin",array("id" => $user_id) );
		return $query->result();
	}
	public function set_session($id,$username){
		$newdata = array(
			'id'		=> $id,
			'username'  => $username,
			'logged_in' => TRUE
		);
		$this->session->set_userdata($newdata);
	}
	public function unset_session(){
		session_destroy();
	}
	public function set_cookie_remember($username){
		setcookie('remember_me',$username, time() + (86400 * 30), "/");
	}	
	public function unset_cookie_remember(){
		setcookie('remember_me','',0,'/');
	}
	function asd()
	{

		$this->db->select("username,password");
		$this->db->from("user");
		$this->db->where('email != "Cedrickbarzaga92@gmail.com"');
		
		$this->db->limit(1);
		$q = $this->db->get();
		return $q->result(); 


	}
}