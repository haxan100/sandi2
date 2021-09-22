<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
                        
class AllModel extends CI_Model {
                        
public function login(){
                        
                                
}
public function getAyat()
{
	$this->db->from('ayat');
	return $this->db->get()->row();
	
	# code...
}
public function getKomentarTampil()
{
	$this->db->from('ucapan');
	$this->db->where('status', 1);
	
	return $this->db->get()->result();
	
	# code...
}
public function getKomentarSemua()
{
	$this->db->from('ucapan');	
	$data= $this->db->get();
	$hasil = $data->result();	
	$total =$data->num_rows();
	return  array(
		'total' => $total ,
		'data' =>$hasil ,
	);
	
	# code...
}
public function getUndanganSemua()
{
	$this->db->from('undangan');	
	$data= $this->db->get();
	$hasil = $data->result();	
	$total =$data->num_rows();
	return  array(
		'total' => $total ,
		'data' =>$hasil ,
	);
	
	# code...
}
public function UbahStatusKomentar($id,$data)
{
		$this->db->set($data);
		$this->db->where('id_ucapan',$id);
		return $this->db->update('ucapan'); 
}
public function UbahUndangan($id,$data)
{
		$this->db->set($data);
		$this->db->where('id_undangan',$id);
		return $this->db->update('undangan'); 
}
public function tambah($data,$tabel)
{
	return $this->db->insert($tabel, $data);
	
}
public function getUndanganByID($id)
{
	$this->db->from('undangan');
	$this->db->where('id_undangan', $id);
	return $this->db->get()->row();
	
}
public function HapusUndangan($id)
{
	$this->db->where('id_undangan', $id);
	
return	$this->db->delete('undangan');
	
}
public function CekLinkDup($link)
{
	$this->db->from('undangan');
	$this->db->where('link', $link);
	$s =$this->db->get()->result();
	return $s;
}
public function getAdmin($u,$p)
{
	$this->db->from('admin');
	$this->db->where('u', $u);
	$this->db->where('p', md5($p));
	return	$this->db->get()->row();
	echo $this->db->last_query();die;
	
}
                        
                            
                        
}
                        
/* End of file AllModel.php */
    
                        