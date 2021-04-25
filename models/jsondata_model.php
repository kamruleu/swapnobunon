<?php 

class Jsondata_Model extends Model{
	
	function __construct(){
		parent::__construct();
		
	}
	
		
	public function getItemInfoForSale($searchby, $val){
		echo json_encode($this->db->getItemMaster($searchby, $val));
	}
	
	public function getItemStock($xitemcode, $xwh){
		echo json_encode($this->db->getIMBalance($xitemcode, $xwh));
	}
	
	public function getPoint($cus){
		$points = array("point"=>$this->db->getCustomerPoint($cus));
		echo json_encode($points);
	}
	
	public function isMyCus($cus){
		
		$fields = array();
		
		$where = "xrecflag='Live' and bizid = ". Session::get('sbizid') ." and xcus = '". $cus."' and xagent='". Session::get('suser') ."'" ;	
		
		if( empty($this->db->select("secus", $fields, $where))){
			return false;
		}else{
			return true;
		}
	
	}
	public function getSuppliersByLimit($limit=""){
		$fields = array("xsup", "xorg", "xadd1","xmobile", "xsupemail");
		
		$where = " xrecflag='Live' and bizid = ". Session::get('sbizid') ."";	
		return $this->db->select("sesup", $fields, $where, " order by xsup desc", $limit);
	}
	public function getcrSuppliersByLimit($limit=""){
		$fields = array("xsup as xsupcr", "xorg", "xadd1","xmobile", "xsupemail");
		
		$where = " xrecflag='Live' and bizid = ". Session::get('sbizid') ."";	
		return $this->db->select("sesup", $fields, $where, " order by xsup desc", $limit);
	}
	public function getCustomersByLimit($limit=""){
		$fields = array("xcus", "xorg", "xadd1","xmobile", "xcusemail");
		
		$where = " xrecflag='Live' and bizid = ". Session::get('sbizid') ."";	
		return $this->db->select("secus", $fields, $where, " order by xcus desc", $limit);
	}
	public function getBusinessList(){
		$fields = array("bizlong");
		
		$where = " zactive=1";	
		return $this->db->select("pabuziness", $fields, $where, " order by bizid desc");
	}
	public function getSchoolByLimit($limit=""){
		$fields = array("xcus", "xorg", "xadd1","xmobile", "xcusemail");
		
		$where = " xrecflag='Live' and xgcus = 'School' and bizid = ". Session::get('sbizid') ."";	
		return $this->db->select("secus", $fields, $where, " order by xcus desc", $limit);
	}
	public function getcrCustomersByLimit($limit=""){
		$fields = array("xcus as xcuscr", "xorg", "xadd1","xmobile", "xcusemail");
		
		$where = " xrecflag='Live' and bizid = ". Session::get('sbizid') ."";	
		return $this->db->select("secus", $fields, $where, " order by xcus desc", $limit);
	}
	public function getoutletbysup($sup){
		$fields = array("xoutlet", "xdesc", "xadd1");
		
		$where = " bizid = ". Session::get('sbizid') ." and xsup='".$sup."'";	
		return $this->db->select("sesupoutlet", $fields, $where);
	}
	
	public function getCustomer($cus){
		$fields = array("*");
		$where = "xrecflag='Live' and bizid = ". Session::get('sbizid') ." and xcus = '". $cus ."'";	
		echo json_encode($this->db->select("secus", $fields, $where));
	}
	public function getCustomerBal($cus){
		$fields = array("*");
		$where = " bizid = ". Session::get('sbizid') ." and xaccsub = '". $cus ."'";	
		echo json_encode($this->db->select("vcustomerbal", $fields, $where));
	}
	public function cusgeoloc(){
		$fields = array("*");
		$where = " DATE_FORMAT(xdate,'%Y-%m-%d')='2018-06-05'";	
		echo json_encode($this->db->select("emp_movement", $fields, $where));
	}
	public function getSupplier($sup){
		$fields = array("*");
		$where = "xrecflag='Live' and bizid = ". Session::get('sbizid') ." and xsup = '". $sup ."'";	
		echo json_encode($this->db->select("sesup", $fields, $where));
	}
	public function getInfoRinDetail($rin){
		$fields = array("*","(select xbalance from vospbal where mlminfo.bizid=vospbal.bizid and mlminfo.xrdin=vospbal.xrdin) as xospbal");
		$where = "xrecflag='Live' and bizid = ". Session::get('sbizid') ." and xrdin = '". $rin ."'";	
		echo json_encode($this->db->select("mlminfo", $fields, $where));
	}

	public function getSubcode1($acc, $accsub){
		$fields = array();
		$where = "xrecflag='Live' and bizid = ". Session::get('sbizid') ." and xacc = '". $acc ."' and xaccsub = '". $accsub ."'";	
		echo json_encode($this->db->select("glchartsub1", $fields, $where));
	}

	//GL List Area

	public function getGlchartByLimit($limit=""){
		$fields = array("xacc", "xdesc", "xacctype","xaccusage", "xaccsource");
		//print_r($this->db->select("pabuziness", $fields));die;
		$where = " xrecflag='Live' and bizid = ". Session::get('sbizid') ."";	
		return $this->db->select("glchart", $fields, $where, " order by xacc desc", $limit);
	}
	public function getGlchartsubByLimit($limit=""){
		$fields = array("xacc", "xdesc", "xacctype","xaccusage", "xaccsource");
		//print_r($this->db->select("pabuziness", $fields));die;
		$where = " xrecflag='Live' and xaccsource='Sub Account' and bizid = ". Session::get('sbizid') ."";	
		return $this->db->select("glchart", $fields, $where, " order by xacc desc", $limit);
	}
	public function getGlchartSubList($limit=""){
		$fields = array("xacc","(select xdesc from glchart where glchart.xacc=glchartsub.xacc) as xaccdesc","xaccsub","xdesc");
		//print_r($this->db->select("pabuziness", $fields));die;
		$where = " xrecflag='Live' and bizid = ". Session::get('sbizid') ."";	
		return $this->db->select("glchartsub", $fields, $where, " order by xacc, xaccsub", $limit);
	}
	public function getGlchartcrByLimit($limit=""){
		$fields = array("xacc as xacccr", "xdesc", "xacctype","xaccusage", "xaccsource");
		//print_r($this->db->select("pabuziness", $fields));die;
		$where = " xrecflag='Live' and xaccusage in ('Cash', 'Bank') and bizid = ". Session::get('sbizid') ."";	
		return $this->db->select("glchart", $fields, $where, " order by xacccr desc", $limit);
	}
	
	public function getGlchartexpByLimit($limit=""){
		$fields = array("xacc", "xdesc", "xacctype","xaccusage", "xaccsource");
		//print_r($this->db->select("pabuziness", $fields));die;
		$where = " xrecflag='Live' and xacctype = 'Expenditure' and bizid = ". Session::get('sbizid') ."";	
		return $this->db->select("glchart", $fields, $where, " order by xacc desc", $limit);
	}
	
	public function getGlchartincByLimit($limit=""){
		$fields = array("xacc", "xdesc", "xacctype","xaccusage", "xaccsource");
		//print_r($this->db->select("pabuziness", $fields));die;
		$where = " xrecflag='Live' and xacctype = 'Income' and bizid = ". Session::get('sbizid') ."";	
		return $this->db->select("glchart", $fields, $where, " order by xacc desc", $limit);
	}
	
	public function getPurchaseList(){
		$fields = array("date_format(xdate, '%d-%m-%Y') as xdate","xponum","xsup","(select xorg from sesup where sesup.bizid=pomst.bizid and sesup.xsup=pomst.xsup) as xsupname","xsupdoc");
		//print_r($this->db->select("pabuziness", $fields));die;
		$where = "xrecflag='Live' and xstatus='Confirmed' and bizid = ". Session::get('sbizid') ;	
		//print_r($this->db->select("seitem", $fields, $where));die;
		return $this->db->select("pomst", $fields, $where);
	}
	public function getChatlist($toUser, $toEmail, $formEmail){

        $fields = array("id","to_user","from_user","message","date");
//        print_r($this->db->select("tbl_erp_chat", $fields));die;
        $where = "to_user in('".$toEmail."','".$formEmail."') AND from_user in('".$toEmail."','".$formEmail."')";
        $data= $this->db->select("tbl_erp_chat", $fields, $where);
        return $data;
    }
    public function postChatmessage($toUser, $formEmail, $message){
	   return $this->db->insert('tbl_erp_chat',array(
	        "to_user"=>$toUser,
	        "from_user"=>$formEmail,
	        "message"=>$message
        ));

    }

}