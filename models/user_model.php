<?php 

class User_Model extends Model{
	
	function __construct(){
		parent::__construct();
		
	}
	public function create($data){
			
		$results = $this->db->insert('pausers', array(
			"bizid" => $data['bizid'],
			"xuserrow" => $data['xuserrow'],
			"zemail" => $data['zemail'],
			"zuserfullname" => $data['zuserfullname'],
			"zusermobile" => $data['zusermobile'],
			"zaltemail" => $data['zaltemail'],
			"zpassword" => Hash::create('sha256',$data['zpassword'],HASH_KEY),
			"zpasshint" => $data['zpassword'],
			"zuseradd" => $data['zuseradd'],
			"zcomments" => $data['zcomments'],
			"zrole" => $data['zrole'],
			"xbranch" => $data['xbranch'],
			"zactive" => $data['zactive']
			));
		
		return $results;	
	}
	
	public function editUser($data, $user){
		$results = array(
			"zemail" => $data['zemail'],
			"zuserfullname" => $data['zuserfullname'],
			"zusermobile" => $data['zusermobile'],
			"zaltemail" => $data['zaltemail'],
			"zpassword" => Hash::create('sha256',$data['zpassword'],HASH_KEY),
			"zpasshint" => $data['zpassword'],
			"zuseradd" => $data['zuseradd'],
			"zcomments"=> $data['zcomments'],
			"zrole" => $data['zrole'],
			"xbranch" => $data['xbranch'],
			"zactive"=> $data['zactive']);
			
			$where = "xrecflag='Live' and bizid = ". Session::get('sbizid') ." and xusersl = '". $user ."'";
			return $this->db->update('pausers', $results, $where);
	}
	
	public function getSingleUser($usersl){
		$fields = array();
		$where = "xrecflag='Live' and xusersl = '". $usersl."'" ;
		return $this->db->select("pausers", $fields, $where);
	}
	
	public function getUsersByLimit($limit=""){
		$fields = array("xusersl","zemail", "zuserfullname", "zusermobile","xbranch", "zrole", "zactive");
		//print_r($this->db->select("pabuziness", $fields));die;
		$where = " xrecflag='Live' and bizid = ". Session::get('sbizid') ."";	
		return $this->db->select("pausers", $fields, $where, " order by xusersl", $limit);
	}
	
	public function rowplus($table, $col){
		return $this->db->rowplus($table, $col);
	}
	
	public function delete($where){
			//echo $where;die;
			$postdata=array(
				"xrecflag" => "Deleted",
				"xemail" => Session::get('suser'),
				"zutime" => date("Y-m-d H:i:s")
				);
		
		$this->db->update('pausers', $postdata, $where);
			
	}

	public function getRoles(){
		$fields = array("zrole");
		$where = " xrecflag='Live'";	
		echo json_encode($this->db->select("paroles", $fields, $where));
	}

	public function getdoctype($type){
		$fields = array("xcode");
		$where = " xrecflag='Live' and bizid = ". Session::get('sbizid') ." and xcodetype = '".$type."'";	
		echo json_encode($this->db->select("secodes", $fields, $where));
	}
	
}