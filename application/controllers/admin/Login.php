<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{


	public function index()
	{
		if(isset($_SESSION['$user_id'])){
			redirect('admin/dashboard');
		}
		// check for invalid 
		$data = [];
		if(isset($_SESSION['error'])){
			die($_SESSION['error']);
			$data['error'] = $_SESSION['error'];
		}else{
			$data['error'] = "No Error";
			
		}
		// $this->load ->helper('url');
		$this->load->view('adminpanel/loginview',$data);
	}
	function login_post()
	{
		// $this->load->helper('url');
		// 		print_r($_POST);
		// die;

		if (isset($_POST)) {
			$email = $_POST['email'];
			$password = $_POST['password'];
			$query = $this->db->query("SELECT * FROM `backenduser` WHERE `username` = '$email' AND password= '$password'");

			if ($query->num_rows()) {
				//are valid
				$result = $query->result_array();
				// echo "<pre>";
				// print_r($result); die;

				$this->session->set_userdata('$user_id', $result[0]['uid']);
				// echo "<pre>";
				// print_r($result);
				// die;
				redirect('admin/dashboard');
			} else {
				//invalid
				$this->session->set_flashdata('$error','Invalid');
				redirect("admin/login");
			}
		} else {
			die("Invalid Input!");
		}
	}
	function logout(){
		session_destroy();
		redirect('admin/login');
	}
}
