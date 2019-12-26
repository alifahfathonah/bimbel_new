<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index(){
		$data['css'] = '
			<!-- chartist CSS -->
			<link href="'.base_url('assets/elite_admin/node_modules/morrisjs/morris.css').'" rel="stylesheet">
			<!--Toaster Popup message CSS -->
			<link href="'.base_url('assets/elite_admin/node_modules/toast-master/css/jquery.toast.css').'" rel="stylesheet">
			<!-- Dashboard 1 Page CSS -->
			<link href="'.base_url('assets/elite_admin/dist/css/pages/dashboard1.css').'" rel="stylesheet">
		';
		$data['js'] = '
			<!--morris JavaScript -->
			<script src="'.base_url('assets/elite_admin/node_modules/raphael/raphael-min.js').'"></script>
			<script src="'.base_url('assets/elite_admin/node_modules/morrisjs/morris.min.js').'"></script>
			<script src="'.base_url('assets/elite_admin/node_modules/jquery-sparkline/jquery.sparkline.min.js').'"></script>
			<!-- Popup message jquery -->
			<script src="'.base_url('assets/elite_admin/node_modules/toast-master/js/jquery.toast.js').'"></script>
			<!-- Chart JS -->
			<script src="'.base_url('assets/elite_admin/dist/js/dashboard1.js').'"></script>
			<script src="'.base_url('assets/elite_admin/node_modules/toast-master/js/jquery.toast.js').'"></script>
		';
		$data['page'] = 'dashboard/page_dashboard';
		$this->load->view('template/page', $data);
	}
}
