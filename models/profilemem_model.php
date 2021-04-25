<?php 

class Profilemem_Model extends Model{
	
	function __construct(){
		parent::__construct();
		
	}
	
	
	public function editUser($data, $user){
		$results = array(
			"xname" => $data['xname'],
			"xmobile" => $data['xmobile'],
			"xprevillage" => $data['xprevillage'],
			"xmemail" => $data['xmemail'],
			"xpasshint" => $data['xpassword'],
			"xpassword" => Hash::create('sha256',$data['xpassword'],HASH_KEY)
		);
			
			$where = "xflag='Live' and bizid = ". Session::get('sbizid') ." and xmember = '". $user ."'";
			return $this->db->update('members', $results, $where);
	}
	
	public function getSingleUser($user){
		$fields = array();
		$where = "xflag='Live' and bizid = ". Session::get('sbizid') ." and xmember = '". $user ."'" ;
		return $this->db->select("members", $fields, $where);
	}
	
	
	
}