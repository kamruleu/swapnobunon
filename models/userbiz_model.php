<?php 

class Userbiz_Model extends Model{
	
	function __construct(){
		parent::__construct();
		
	}
	
	
	public function saveUser($data){		
			return $this->db->insert('pausers', $data);
	}
	
	public function edituser($data){
		
		$ddata = array(
					"zuserfullname"=>$data['zuserfullname'],
					"zusermobile"=>$data['zusermobile'],
					"zuseradd"=>$data['zuseradd'],
					"zpassword"=>$data['zpassword'],
					"zaltemail"=>$data['zaltemail'],
					"zrole"=>$data['zrole']
					);
		
		$where = " bizid='".$data["bizid"]."' and zemail='".$data["zemail"]."'";
		
		return $this->db->update("pausers",$ddata, $where);
	}
	
	public function getSingleUser($user, $biz){
		$fields = array("*, (select bizlong from pabuziness where bizid=".$biz.") as bizlong");
		//print_r($this->db->select("pabuziness", $fields));die;
		$where = "xrecflag='Live' and bizid = ". Session::get('sbizid') ." and zemail = '". $user ."'" ;	
		//print_r($this->db->select("seitem", $fields, $where));die;
		return $this->db->select("pausers", $fields, $where);
	}
	
	public function getSingleUserbysl($user, $biz){
		$fields = array("*, (select bizlong from pabuziness where bizid=".$biz.") as bizlong");
		//print_r($this->db->select("pabuziness", $fields));die;
		$where = "xrecflag='Live' and bizid = ". $biz ." and xusersl = '". $user ."'" ;	
		//print_r($this->db->select("seitem", $fields, $where));die;
		return $this->db->select("pausers", $fields, $where);
	}
	
	public function getUserList($biz){
		$fields = array("bizid,xusersl,(select bizlong from pabuziness where pausers.bizid=pabuziness.bizid) as bizlong,zemail,zuserfullname,zrole");
		//print_r($this->db->select("pabuziness", $fields));die;
		$where = " bizid = ". $biz ."" ;	
		//print_r($this->db->select("seitem", $fields, $where));die;
		return $this->db->select("pausers", $fields, $where);
	}
	public function dbdelete($where){
	    return $this->db->dbdelete("pausers",$where);
	}
	public function getallbiz(){
		$fields = array("bizid", "bizlong");
		//print_r($this->db->select("pabuziness", $fields));die;
		$where = " zactive=1 and bizid!=99";	
		return $this->db->select("pabuziness", $fields, $where, " order by bizid");
	}
	public function getbiz($biz){
		$fields = array("bizid", "bizlong");
		//print_r($this->db->select("pabuziness", $fields));die;
		$where = " zactive=1 and bizid=".$biz;	
		return $this->db->select("pabuziness", $fields, $where);
	}
	
	
	
}