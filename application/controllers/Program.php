<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Program extends CI_Controller
{
	public $data = [];

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
	}

	public function index()
	{

		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		else if (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			show_error('You must be an administrator to view this page.');
		}
		else
		{
			$this->data['title'] = $this->lang->line('index_heading');
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			//list the users
			$this->data['program'] = $this->program_model->program(null)->result();
			//USAGE NOTE - you can do more complicated queries like this
			//$this->data['users'] = $this->ion_auth->where('field', 'value')->users()->result();
			$this->data['css'] = '
				<link href="'.base_url('assets/elite_admin/node_modules/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css').'" rel="stylesheet">
				<!-- Color picker plugins css -->
				<link href="'.base_url('assets/elite_admin/node_modules/jquery-asColorPicker-master/css/asColorPicker.css').'" rel="stylesheet">
				<!-- Date picker plugins css -->
				<link href="'.base_url('assets/elite_admin/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css').'" rel="stylesheet" type="text/css" />
				<link href="'.base_url('assets/elite_admin/dist/css/pages/form-icheck.css').'" rel="stylesheet">
				<link href="'.base_url('assets/elite_admin/node_modules/icheck/skins/all.css').'" rel="stylesheet">
				<link href="'.base_url('assets/elite_admin/node_modules/sweetalert/sweetalert.css').'" rel="stylesheet">
			';
			$this->data['js'] = '
				<!-- This is data table -->
				<script src="'.base_url('assets/elite_admin/node_modules/datatables/jquery.dataTables.min.js').'"></script>
				<!-- start - This is for export functionality only -->
				<!--
				<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
				<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
				<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
				<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
				<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
				<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
				!-->
				<!-- Plugin JavaScript -->
				<script src="'.base_url('assets/elite_admin/node_modules/moment/moment.js').'"></script>
				<script src="'.base_url('assets/elite_admin/node_modules/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js').'"></script>
				<!-- Color Picker Plugin JavaScript -->
				<script src="'.base_url('assets/elite_admin/node_modules/jquery-asColorPicker-master/libs/jquery-asColor.js').'"></script>
				<script src="'.base_url('assets/elite_admin/node_modules/jquery-asColorPicker-master/libs/jquery-asGradient.js').'"></script>
				<script src="'.base_url('assets/elite_admin/node_modules/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js').'"></script>
				<!-- Date Picker Plugin JavaScript -->
				<script src="'.base_url('assets/elite_admin/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js').'"></script>
				<script src="'.base_url('assets/elite_admin/node_modules/icheck/icheck.min.js').'"></script>
				<script src="'.base_url('assets/elite_admin/node_modules/icheck/icheck.init.js').'"></script>
				<script src="'.base_url('assets/elite_admin/node_modules/sweetalert/sweetalert.min.js').'"></script>
				<script src="'.base_url('assets/elite_admin/node_modules/sweetalert/jquery.sweet-alert.custom.js').'"></script>
			';
			$this->data['page'] = 'program/index';
			$this->_render_page('template' . DIRECTORY_SEPARATOR . 'page', $this->data);
			//$this->_render_page('auth' . DIRECTORY_SEPARATOR . 'index', $this->data);
		}
	}

	/**
	 * Create a new user
	 */
	public function create_program() {
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()){
			redirect('auth', 'refresh');
		}

		//validasi
		$this->form_validation->set_rules($this->program_model->rules());

		if ($this->form_validation->run() === true){
			$program['program'] = $this->input->post('program');
			$program['harga'] = $this->input->post('harga');
			$program['keterangan'] = $this->input->post('keterangan');
			$this->program_model->save($program);
			echo '<div class="alert alert-success alert-dismissable">
					<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
					Data User Berhasil Ditambahkan.
				</div>';
			echo '<script> document.getElementById("add_button").style.visibility = "hidden"; </script>';
		}else{
			if(validation_errors()){
				$this->data['message'] = validation_errors();
			}else{
				$this->data['message'] = $this->session->flashdata('message');
			}

			$this->data['program'] = [
				'name' => 'program',
				'id' => 'program',
				'type' => 'text',
				'class' => 'form-control',
				'required' => true,
				'value' => $this->form_validation->set_value('program'),
			];
			$this->data['keterangan'] = [
				'name' => 'keterangan',
				'id' => 'keterangan',
				'type' => 'text',
				'class' => 'form-control',
				'required' => true,
				'value' => $this->form_validation->set_value('keterangan'),
			];
			$this->data['harga'] = [
				'name' => 'harga',
				'id' => 'harga',
				'type' => 'text',
				'class' => 'form-control',
				'required' => true,
				'value' => $this->form_validation->set_value('harga'),
			];
			
			if(!is_null($this->input->post('cek_form'))){
				echo '
					<div class="alert alert-danger alert-dismissable">
						<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
						'.$this->data['message'].'
					</div>
				';
				echo '<script>document.getElementById("add_button").className = "btn btn-danger proses_modal"; </script>';
			}else{
				$this->load->view('program/create_program', $this->data);
			}

		}
	}
	
	public function edit_program($id_program) {
		//$update = false;
		if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->program_model->program('id_program='.$id_program)->row()->id_program == $id_program))){
			redirect('auth', 'refresh');
		}

		$program = $this->program_model->program('id_program='.$id_program)->row();

		// validate form input
		$this->form_validation->set_rules($this->program_model->rules());

		//if (isset($_POST) && !empty($_POST)){

			if ($this->form_validation->run() === TRUE){
				$data = [
					'program' => $this->input->post('program'),
					'harga' => $this->input->post('harga'),
					'keterangan' => $this->input->post('keterangan'),
				];
				$this->program_model->update($program->id_program, $data);
					//$update = true;
					echo '<div class="alert alert-success alert-dismissable">
						<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
						Data User Berhasil Diedit.
						</div>';
					echo '<script> document.getElementById("add_button").style.visibility = "hidden"; </script>';
			
			} else {
		//}

		// display the edit user form
		$this->data['csrf'] = $this->_get_csrf_nonce();

		// set the flash data error message if there is one
		//$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		if(validation_errors()){
				$this->data['message'] = validation_errors();
			}else{
				$this->data['message'] = $this->session->flashdata('message');
			}

		// pass the user to the view
		$this->data['id_program'] = $program->id_program;

		$this->data['program'] = [
			'name'  => 'program',
			'id'    => 'program',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $this->form_validation->set_value('program', $program->program),
		];
		$this->data['harga'] = [
			'name'  => 'harga',
			'id'    => 'harga',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $this->form_validation->set_value('harga', $program->harga),
		];
		$this->data['keterangan'] = [
			'name'  => 'keterangan',
			'id'    => 'keterangan',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => $this->form_validation->set_value('keterangan', $program->keterangan),
		];

		if(!is_null($this->input->post('cek_form'))){
			//if($update == false){
				echo '
					<div class="alert alert-danger alert-dismissable">
						<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
						'.$this->data['message'].'
					</div>
				';
				echo '<script>document.getElementById("edit_button").className = "btn btn-danger proses_modal"; </script>';
			//}
		}else{
			$this->load->view('program/edit_program', $this->data);
		}
		}

	}

	public function delete_program(){
		$this->program_model->delete_program($_POST['id_program']);
	}

	/**
	 * @return array A CSRF key-value pair
	 */
	public function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return [$key => $value];
	}

	/**
	 * @return bool Whether the posted CSRF token matches
	 */
	public function _valid_csrf_nonce(){
		$csrfkey = $this->input->post($this->session->flashdata('csrfkey'));
		if ($csrfkey && $csrfkey === $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
			return FALSE;
	}

	/**
	 * @param string     $view
	 * @param array|null $data
	 * @param bool       $returnhtml
	 *
	 * @return mixed
	 */
	public function _render_page($view, $data = NULL, $returnhtml = FALSE)//I think this makes more sense
	{

		$viewdata = (empty($data)) ? $this->data : $data;

		$view_html = $this->load->view($view, $viewdata, $returnhtml);

		// This will return html on 3rd argument being true
		if ($returnhtml)
		{
			return $view_html;
		}
	}

}
