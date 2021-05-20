<?php
// defined('BASEPATH') or exit('No direct script access allowed');

class Dashbord extends CI_Controller
{

	public function index()
	{
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('welcome_message');
		$this->load->view('template/footer');
	}
}
