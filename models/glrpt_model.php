<?php

class Glrpt_Model extends Model{
	
	function __construct(){
		parent::__construct();
		
	}
	

	public function getDeposit($fdt, $tdt){
		
		$fields = array("xdate","xvoucher","concat(xmember,', (',(select xname from members where members.xmember=incexp.xmember),')')","xnarration", "xamount");
		$where = "bizid = ". Session::get('sbizid') ." and xdate between '". $fdt ."' and '". $tdt ."' and xstatus='Confirmed' and xsign = '1'";
		return $this->db->select("incexp", $fields, $where," order by xdate");
	}
	public function getExpense($fdt, $tdt){
		
		$fields = array("xdate","xvoucher","xdoctype","xnarration", "xamount");
		$where = "bizid = ". Session::get('sbizid') ." and xdate between '". $fdt ."' and '". $tdt ."' and xstatus='Confirmed' and xsign = '-1'";
		return $this->db->select("incexp", $fields, $where," order by xdate");
	}

	public function getMemberdt(){
		
		$fields = array("concat(xmember,', (',xname,')') as xmemidname","xmember");
		$where = "bizid = ". Session::get('sbizid') ."";
		return $this->db->select("members", $fields, $where," order by xmember");
	}
	public function getMemberReg($xyear){
		
		$fields = array("xmember","sum(xamount) as xamount");
		$where = "bizid = ". Session::get('sbizid') ." and xdoctype='Registration' and xsign=1 and xyear=".$xyear."";
		return $this->db->select("incexp", $fields, $where," group by xmember order by xmember");
	}
	public function getMemberDeposit($member, $xyear){
		
		$fields = array("xmember","xmonth","sum(xamount) as xamount");
		$where = "bizid = ". Session::get('sbizid') ." and xmember='".$member."' and xdoctype='Monthly' and xsign=1 and xyear=".$xyear."";
		return $this->db->select("incexp", $fields, $where," group by xmonth order by xmonth");
	}

	public function getMemberYearDeposit($xyear){
		
		$fields = array("xmember","sum(xamount) as xamount");
		$where = "bizid = ". Session::get('sbizid') ." and xdoctype='Yearly' and xsign=1 and xyear=".$xyear."";
		return $this->db->select("incexp", $fields, $where," group by xmember order by xmember");
	}

	public function getOpbal($xdate){
		
		$fields = array("COALESCE(sum(xamount*xsign),0) as xbal");
		$where = "bizid = ". Session::get('sbizid') ." and xdate < '".$xdate."'";
		return $this->db->select("incexp", $fields, $where);
	}

	public function getTransection($month, $xyear){
		
		$fields = array("xpurpose", "xdoctype", "sum(xamount*xsign) as xamount");
		$where = "bizid = ". Session::get('sbizid') ." and xmonth = ".$month." and xyear=".$xyear."";
		return $this->db->select("incexp", $fields, $where," group by xpurpose,xdoctype order by xpurpose");
	}

	public function getYear($type){
		$fields = array("xcode");
		$where = " xrecflag='Live' and bizid = ". Session::get('sbizid') ." and xcodetype = '".$type."'";	
		echo json_encode($this->db->select("secodes", $fields, $where," order by codeid"));
	}
	
}