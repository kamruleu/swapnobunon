<?php 

class Mainmenu_Model extends Model{
	
	function __construct(){
		parent::__construct();
		
	}	
	public function getMainMenu($where){
        $fields = array("xmenuindex","xmenu","xsubmenuindex","xsubmenu","xurl");
//		print_r($this->db->select("pamenus", $fields, $where));die;
		return $this->db->select("pamenus", $fields, $where);
	}
	public function getTotalMember(){
		$fields=array("count(xsl) AS tmem");
			$where = " bizid = ". Session::get('sbizid') ." and xflag = 'Live' and zactive = '1'";		
		return $this->db->select("members", $fields, $where);
	}
	public function getCurrentDeposit(){
		$fields=array("COALESCE(sum(xamount*xsign),0) AS xamount");
			$where = " bizid = ". Session::get('sbizid') ."";		
		return $this->db->select("incexp", $fields, $where);
	}
	public function getIncExp($sign){
		$fields=array("COALESCE(sum(xamount),0) AS xamount");
			$where = " bizid = ". Session::get('sbizid') ." and xsign = ".$sign."";		
		return $this->db->select("incexp", $fields, $where);
	}
	public function getTodayIncExp($date, $sign){
		$fields=array("COALESCE(sum(xamount),0) AS xamount");
			$where = " bizid = ". Session::get('sbizid') ." and xdate = '".$date."' and xsign = ".$sign."";
		return $this->db->select("incexp", $fields, $where);
	}
	public function getMonYrIncExp($condition){
		$fields=array("COALESCE(sum(xamount),0) AS xamount");
			$where = " bizid = ". Session::get('sbizid') ." ".$condition."";
		return $this->db->select("incexp", $fields, $where);
	}


}