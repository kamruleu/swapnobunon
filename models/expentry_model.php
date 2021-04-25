<?php

class Expentry_Model extends Model{
	
	function __construct(){
		parent::__construct();
		
	}
	public function create($data){

		$getcodeid = $this->getCodeId($data['xdoctype']);
			
		$results = $this->db->insert('incexp', array(
			"xvoucher"=>$data['xvoucher'],
			"xmember"=>"",
			"xtxnno"=>$data['xtxnno'],
			"xdoctype"=>$data['xdoctype'],
			"xdoc"=>$getcodeid[0]['codeid'],
			"xamount"=>$data['xamount'],
			"xnarration"=>$data['xnarration'],
			"xpurpose" => "Regular Expense",
			"xdate" => $data['xdate'],
			"xmonth" => $data['xmonth'],
			"xyear" => $data['xyear'],
			"xsign" => "-1",
			"xstatus" => "Confirmed",
			"xentrydate" => $data['xentrydate'],
			"xemail"=>Session::get('suser'),
			"bizid"=>Session::get('sbizid'),
			));
		
		return $results;	
	}
	
	public function editDeposit($data, $voucher){
		$getcodeid = $this->getCodeId($data['xdoctype']);
		$results = array(
			"xmember"=>"",
			"xtxnno"=>$data['xtxnno'],
			"xdoctype"=>$data['xdoctype'],
			"xdoc"=>$getcodeid[0]['codeid'],
			"xamount"=>$data['xamount'],
			"xnarration"=>$data['xnarration'],
			"xdate" => $data['xdate'],
			"xmonth" => $data['xmonth'],
			"xyear" => $data['xyear'],
			"xupdatetime" => $data['xupdatetime'],
			"xuemail"=>Session::get('suser'),
			);
			
			$where = "bizid = ". Session::get('sbizid') ." and xvoucher = '". $voucher ."'";
			return $this->db->update('incexp', $results, $where);
	}
	
	public function getSingleDeposit($voucher){
		$fields = array("*", "(select xname from members where members.xmember=incexp.xmember) as xname", "(select xmobile from members where members.xmember=incexp.xmember) as xmobile");
		$where = "bizid = ". Session::get('sbizid') ." and xvoucher = '". $voucher ."'" ;
		return $this->db->select("incexp", $fields, $where);
	}

	public function checkMember($member){
		$fields = array();
		$where = " xflag='Live' and zactive='1' and bizid = ". Session::get('sbizid') ." and xmember = '".$member."'";	
		return $this->db->select("members", $fields, $where);
	}
	
	public function getKeyValue($table,$keyfield,$prefix,$num){
		
		return $this->db->keyIncrement($table,$keyfield,$prefix,$num);
	}

	public function getCodeId($code){
		$fields = array("codeid");
		$where = " xrecflag='Live' and bizid = ". Session::get('sbizid') ." and xcode = '".$code."'";	
		return $this->db->select("secodes", $fields, $where);
	}

	public function getdoctype($type){
		$fields = array("xcode");
		$where = " xrecflag='Live' and bizid = ". Session::get('sbizid') ." and xcodetype = '".$type."'";	
		echo json_encode($this->db->select("secodes", $fields, $where));
	}

	public function getMemberByName(){
		$fields = array("CONCAT(xmember, '~', xname) as value", "xmember", "xname", "xfname","xmname","xmobile");
		$where = " xflag='Live' and zactive = '1' and bizid = ". Session::get('sbizid') ."";	
		echo json_encode($this->db->select("members", $fields, $where, " order by xmember desc"));
	}
	
	public function searchVoucher($where){
		$fields = array();
		return $this->db->select("incexp", $fields, $where);
	}
}