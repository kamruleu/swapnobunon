<?php 

class Members_Model extends Model{
	
	function __construct(){
		parent::__construct();
		
	}
	public function create($data){
			
		$results = $this->db->insert('members', array(
			"xmember"=>$data['xmember'],
			"xname"=>$data['xname'],
			"xfname"=>$data['xfname'],
			"xmname"=>$data['xmname'],
			"xwname"=>$data['xwname'],
			"xperhome"=>$data['xperhome'],
			"xpervillage"=>$data['xpervillage'],
			"xperpostoffice" => $data['xperpostoffice'],
			"xperthana" => $data['xperthana'],
			"xperzila" => $data['xperzila'],
			"xmobile" => $data['xmobile'],
			"xnid" => $data['xnid'],
			"xhousename" => $data['xhousename'],
			"xroadname" => $data['xroadname'],
			"xprevillage" => $data['xprevillage'],
			"xprepostoffice" => $data['xprepostoffice'],
			"xprethana" => $data['xprethana'],
			"xprezila" => $data['xprezila'],
			"xphone" => $data['xphone'],
			"xnominee" => $data['xnominee'],
			"xrelation" => $data['xrelation'],
			"xidentyname" => $data['xidentyname'],
			"zactive" => $data['zactive'],
			"xdate" => $data['xdate'],
			"xentrydate" => $data['xentrydate'],
			"xemail"=>Session::get('suser'),
			"bizid"=>Session::get('sbizid'),
			));
		
		return $results;	
	}
	
	public function editCustomer($data, $cus){
		$results = array(
			"xmember"=>$data['xmember'],
			"xname"=>$data['xname'],
			"xfname"=>$data['xfname'],
			"xmname"=>$data['xmname'],
			"xwname"=>$data['xwname'],
			"xperhome"=>$data['xperhome'],
			"xpervillage"=>$data['xpervillage'],
			"xperpostoffice" => $data['xperpostoffice'],
			"xperthana" => $data['xperthana'],
			"xperzila" => $data['xperzila'],
			"xmobile" => $data['xmobile'],
			"xnid" => $data['xnid'],
			"xhousename" => $data['xhousename'],
			"xroadname" => $data['xroadname'],
			"xprevillage" => $data['xprevillage'],
			"xprepostoffice" => $data['xprepostoffice'],
			"xprethana" => $data['xprethana'],
			"xprezila" => $data['xprezila'],
			"xphone" => $data['xphone'],
			"xnominee" => $data['xnominee'],
			"xrelation" => $data['xrelation'],
			"xidentyname" => $data['xidentyname'],
			"zactive" => $data['zactive'],
			"xupdatetime" => $data['xupdatetime'],
			"xuemail"=>Session::get('suser'),
			);
			
			$where = "xflag='Live' and bizid = ". Session::get('sbizid') ." and xmember = '". $cus."'";
			return $this->db->update('members', $results, $where);
	}
	
	public function getSingleCustomer($cus){
		$fields = array();
		$where = "xflag='Live' and xmember = '". $cus."'" ;
		return $this->db->select("members", $fields, $where);
	}
	
	public function getCustomersByLimit($limit=""){
		$fields = array("xmember", "xname", "xfname","xmname","xmobile","zactive");
		$where = " xflag='Live' and bizid = ". Session::get('sbizid') ."";	
		return $this->db->select("members", $fields, $where, " order by xmember desc", $limit);
	}
	
	public function getKeyValue($table,$keyfield,$prefix,$num){
		
		return $this->db->keyIncrement($table,$keyfield,$prefix,$num);
	}
	
	public function delete($where){
			//echo $where;die;
		$postdata=array(
			"zactive" => "0",
			"xflag" => "Deleted",
			"xuemail" => Session::get('suser'),
			"xupdatetime" => date("Y-m-d H:i:s")
			);
		
		$this->db->update('members', $postdata, $where);
			
	}
	
}