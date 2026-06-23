<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct() {

		parent::__construct();

		$this->load->model('main_model');


	}

	public function index()
	{

		header('Location:https://wordpress.com');
// 		$this->load->view('users/home');
	}
}
