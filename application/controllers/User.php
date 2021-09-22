<?php 
        
defined('BASEPATH') OR exit('No direct script access allowed');
        
class User extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('AllModel');
		
	}
	

public function index()
{
	$data['ayat'] = $this->AllModel->getAyat();
	$data['ucapan'] = $this->AllModel->getKomentarTampil();
	$this->load->view('User/Templates',$data);               
}
public function getAyat()
{
 $data = $this->AllModel->getAyat();
 var_dump($data);die;
	# code...
}
public function i()
{
	
	# code...
}
public function user2()
{
	$data['ayat'] = $this->AllModel->getAyat();
	$data['ucapan'] = $this->AllModel->getKomentarTampil();
	$this->load->view('User/User2',$data);               
}
public function user3()
{
	$this->load->view('User/User3');
	
	# code...
}
public function modal()
{
	$this->load->view('User/Modal');
	
	# code...
}
        
}
        
    /* End of file  User.php */
        
                            