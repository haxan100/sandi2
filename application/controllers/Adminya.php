<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Adminya extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('AllModel');
		// $this->load->library(array('excel', 'session'));

	}


	public function index()
	{
		if (!$this->cek()) {

			redirect('Adminya/Login', 'refresh');
		}
		$this->load->view('Admin/Header');
		$this->load->view('Admin/Sidebar');
		$this->load->view('Admin/Konten');
		$this->load->view('Admin/Footer');
	}
	public function getKomentar()
	{
		$data = $this->AllModel->getKomentarSemua();
		$start  = isset($_POST['start']) ? $_POST['start'] : 0;
		$no = $start + 1;
		$datatable['draw']            = isset($_POST['draw']) ? $_POST['draw'] : 1;
		$datatable['recordsTotal']    = $data['total'];
		$datatable['recordsFiltered'] = $data['total'];
		$datatable['data']            = array();
		foreach ($data['data'] as $row) {
			$stat = "Di Tampilkan";
			if($row->status==0){
				$stat="Belum DI Tampilkan";
			}

			$fields = array($no++);
			$fields[] = $row->nama;
			$fields[] = $row->email;
			$fields[] = $row->ucapan;
			$fields[] = $row->konfirmasi;
			$fields[] = $row->created_at;
			$fields[] = $stat;
			$fields[] = '
			<button  class="btn btn-primary Ubah"  data-id="' .$row->id_ucapan. '" 
			data-status="' . $row->status . '" >
			Ubah
			</button>';

			$datatable['data'][] = $fields;
		}

		echo json_encode($datatable);

		# code...
	}
	public function getUndangan()
	{
		$data = $this->AllModel->getUndanganSemua();
		$start  = isset($_POST['start']) ? $_POST['start'] : 0;
		$no = $start + 1;
		$datatable['draw']            = isset($_POST['draw']) ? $_POST['draw'] : 1;
		$datatable['recordsTotal']    = $data['total'];
		$datatable['recordsFiltered'] = $data['total'];
		$datatable['data']            = array();
		foreach ($data['data'] as $row) {
			

			$fields = array($no++);
			$fields[] = $row->nama_undangan;
			$fields[] = $row->no_hp;
			$fields[] = base_url() .$row->link;
			$fields[] = '
			<button  class="btn btn-primary Ubah"  data-id="' .$row->id_undangan. '" data-no_hp="' . $row->no_hp . '"  data-nama_undangan="' . $row->nama_undangan . '" >Ubah </button>

			<button class="btn btn-warning my-1  btn-block btnKlikLink text-white" 
			data-id_undangan="' . $row->id_undangan . '"		
			data-nama_undangan="' . $row->nama_undangan . '"
			data-no_wa="' . $row->no_hp . '"
			data-link_teman="' . $row->link . '"
		><i class="fa fa-envelope"></i></i> Kirin Wa</button>


			<button  class="btn btn-danger Hapus"  data-id="' .$row->id_undangan. '" data-no_hp="' . $row->no_hp . '" data-nama_undangan="' . $row->nama_undangan . '">Hapus </button>';

			$datatable['data'][] = $fields;
		}

		echo json_encode($datatable);

		# code...
	}
	public function GantiStatusKomentar()
	{
		$id =$this->input->post('id');
		$status =$this->input->post('status');
		$data = array('status' => $status );
		$d = $this->AllModel->UbahStatusKomentar($id,$data);
		$pesan = array(
			'pesan' =>$d , 
			'error' =>false , 
		);
		echo json_encode($pesan);
		

	}
	public function bank()
	{
		$this->load->view('Admin/Header');
		$this->load->view('Admin/Sidebar');
		$this->load->view('Admin/Bank');
		$this->load->view('Admin/Footer');
	}
	public function undangan()
	{
		if(!$this->cek()){
			
			redirect('Adminya/Login','refresh');
		
		}
		$this->load->view('Admin/Header');
		$this->load->view('Admin/Sidebar');
		$this->load->view('Admin/Undangan');
		$this->load->view('Admin/Footer');
	}
	function slug($string, $spaceRepl = "-")
	{
		$string = str_replace("&", "and", $string);
		$string = preg_replace("/[^a-zA-Z0-9 _-]/", "", $string);
		$string = strtolower($string);
		$string = preg_replace("/[ ]+/", " ", $string);
		$string = str_replace(" ", $spaceRepl, $string);
		return $string;
	}
	public function tambahUndangan()
	{
		$nama = $this->input->post('nama');
		$no_hp= $this->input->post('no_hp');
		$link = $this->slug($nama) ;
		$pesan = "gagal Menambah Data";
		$error = true;
		$data  = array(
			'nama_undangan' => $nama,
			'no_hp' => $no_hp,
			'link' => $link,
		 );
		 if($this->AllModel->tambah($data,'undangan')){
			$pesan = "Berhasil Menambah Data";
			$error = false;
		 }else{
			$pesan = "gagal Menambah Data";
			$error = true;
		 }
		 echo json_encode(array(
			 'error' => $error,
			 'pesan' => $pesan,
		
		));
		 
		# code...
	}
	public function updateUndangan()
	{
		$id = $this->input->post('id');
		$nama_undangan = $this->input->post('nama_undangan');
		$no_hp = $this->input->post('nomor_hp');
		$data = array(
			'no_hp' => $no_hp,
			'nama_undangan' => $nama_undangan,
		);
		$d = $this->AllModel->UbahUndangan($id, $data);
		$pesan = array(
			'pesan' => $d,
			'error' => false,
		);
		echo json_encode($pesan);
	}
	public function HapusUndangan()
	{
		$id = $this->input->post('id');
		$nama_undangan = $this->input->post('nama');
		$data = $this->AllModel->getUndanganByID($id);
		$status = false;
		if($data==""){
			$pesan ="Data Tidak Ada!";
		}else{
			$c = $this->AllModel->HapusUndangan($id);
		}
		if($c){
			$pesan =" Data Berhasil Di Hapus";
			$status = true;
		}else{
			$pesan = " Data Gagal Di Hapus";
			$status = false;
		}
		$pesan = array(
			'pesan' => $pesan,
			'status' =>$status ,
		);
		echo json_encode($pesan);
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('Member/login', 'refresh');
		# code...
	}
	public function logoutProcess()
	{
		$this->session->sess_destroy();
		echo json_encode(array('pesan' => "Terimakasih!"));
		
	}
	public function login()
	{
		$this->load->view('Admin/Login');
		# code...
	}
	public function LoginProcess()
	{
		$u = $this->input->post('u');
		$p = $this->input->post('p');
		$data = $this->AllModel->getAdmin($u,$p);
		$error = true;
		if($data==""||$data==null){
			$pesan ="Maaf, Password Tidak Ada!";
			$error = true;
		}else{
			$pesan ="Selemat Datang ,$u!";
			$error = false;
		}
		if(!$error){
			
			$array = array(
				'id_admin' => $data->id_admin,
				'nama_admin' => $data->u,
				'login_admin' => true,
			);
			
			$this->session->set_userdata( $array );
			
		}
		echo json_encode( array('pesan' =>$pesan ,'error'=>$error ));
		# code...
	}
	public function cek()
	{
		if($this->session->userdata('login_admin')){
			return true;
		}else{
			return false;
		}
	}

}
        
   
