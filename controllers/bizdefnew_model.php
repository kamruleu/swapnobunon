<?php 

class Bizdefnew_Model extends Model{
	
	function __construct(){
		parent::__construct();
		
	}
	
	public function saveBizdefnew($data){

		$results = $this->db->insert('pabuziness',$data);
			
		return $results;
	}

	public function editBizdefnew($data, $bizid){
		
			$where = "bizid = ". $bizid ."";
			return $this->db->update('pabuziness', $data, $where);
	}
	public function getBizByLimit(){
		$fields = array("bizid", "bizshort", "bizlong","bizadd1","bizadd2");
		//print_r($this->db->select("pabuziness", $fields));die;
		$where = "1=1";	
		return $this->db->select("pabuziness", $fields, $where);
	}
	
	public function getSingleDef($bizid){
		$fields = array();
		//print_r($this->db->select("pabuziness", $fields));die;
		$where = " bizid = ". $bizid ."" ;	
		//print_r($this->db->select("seitem", $fields, $where));die;
		return $this->db->select("pabuziness", $fields, $where);
	}
	public function saveRole($bizid){
			
		$results = $this->db->insert('paroles', array(
			"bizid" => $bizid,
			"zrole" => 'ADMIN',
			"xkeymenu" => ""
			));
		return $results;	
	}
	public function getMenu(){
		$fields = array();
		//print_r($this->db->select("pabuziness", $fields));die;
		$where = " bizid='100' and zrole='ADMIN'";	
		return $this->db->select("pamenus", $fields, $where);
	}
	public function saveMenu($data){

		$results = $this->db->insert('pamenus',$data);
			
		return $results;
	}
}