<?php 

class Viewatt_Model extends Model{
	
	function __construct(){
		parent::__construct();		
	}
	
	public function getClassAttended($date){
		$fields = array("xfacultyid","xtime","xattflag","xname","xdevice");
		
		$where = "bizid = ". Session::get('sbizid') ." and xdate='".$date."'";
		
		return $this->db->select("vempatt", $fields, $where);
	}
	
}