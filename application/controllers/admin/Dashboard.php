<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	
	public function index()
	{
		// print_r($_SESSION['$user_id']);
		// die;
		if(isset($_SESSION['$user_id'])){
		
			// die('session_set'.$_SESSION['$user_id']);
			
			$this->load->view('adminpanel/dashboard');
		}
	
	else{
		redirect('admin/logout');
	}
}
}