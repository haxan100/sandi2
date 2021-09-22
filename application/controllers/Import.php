<?php 
        
defined('BASEPATH') OR exit('No direct script access allowed');

// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// require 'vendor/autoload.php';
require APPPATH . '/third_party/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
class Import extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('AllModel');
		// $this->load->library(array('excel', 'session'));

	}
public function index()
{
                
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
	function randomString($length = 2)
	{
		$str = "";
		$characters = array_merge(range('a', 'z'), range('a', 'z'));
		$max = count($characters) - 1;
		for ($i = 0; $i < $length; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		return $str;
	}
	public function import_excel()
	{
		// Load plugin PHPExcel nya
		// include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
		$berhasil = 0;
		$excelreader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		$data = array();
		$data['title'] = 'Import Excel Sheet | TechArise';
		$data['breadcrumbs'] = array('Home' => '#');

		if (!empty($_FILES['fileExcel']['name'])) {
			// get file extension
		
			$extension = pathinfo($_FILES['fileExcel']['name'], PATHINFO_EXTENSION);
			$berhasil = 0;

			if ($extension == 'csv') {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
			} elseif ($extension == 'xlsx') {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			} else {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
			}
			// file path
			$spreadsheet = $reader->load($_FILES['fileExcel']['tmp_name']);
			// var_dump($spreadsheet);die;
			$allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

			// array Count
			$arrayCount = count($allDataInSheet);
			$hasilRow = $arrayCount - 1;
			$ugagal = "";
			$duplicateuser = '';
			$duplicateCount = 0;
			// var_dump($arrayCount);die;
			$numrow = 1; // untuk mengecek duplikat 

			foreach ($allDataInSheet as $row) {

				// var_dump($row);die;
				if ($numrow > 1) {
					// var_dump($row);die;
					$cek = $this->db->query("SELECT * FROM `undangan` where no_hp= '" . $row['B'] . "' ");
					$hasil = count($cek->result());
					if ($hasil >= 1) {
						$duplicateCount++;
						$duplicateuser .= $row['A'];
					}
				}
				$numrow++;
			}
			// var_dump($duplicateCount);die;
			if ($duplicateCount >= 1) {
				$numrow = 1;
				$this->session->set_flashdata('flash_data', "Error.: <br> $duplicateCount terdapat duplikat! <br> $duplicateuser");
				
				redirect('Adminya/Undangan','refresh');
				
			}  else {
				$numrow = 1;
				foreach ($allDataInSheet as $row) {
					if ($numrow > 1) {
						$link = $this->slug($row['A']);
						$cekLink = $this->AllModel->CekLinkDup($link);
						$cl =0 ;
						if(!empty($cekLink)){
							$link = $link ."_".$this->randomString();
						}
						$data = array(
							'nama_undangan' => $row['A'],
							'no_hp' => $row['B'],
							'link' => $link,								  	  
						);						
						$this->AllModel->tambah($data,'undangan');
						$this->session->set_flashdata('flash_data', "$hasilRow  Data berhasil di import.");
						$sukses = true;
						
					}
					$numrow++;
				}
				
				redirect('Adminya/Undangan','refresh');
				
			}
		}
	}
        
}
        
    /* End of file  Import.php */
        
                            