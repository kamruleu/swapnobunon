<?php 

class Loginmem_Model extends Model{
	
	function __construct(){
		parent::__construct();
		
	}
	public function run($biz){
		//echo $biz;die;
		$sth = $this->db->prepare("SELECT xsl, bizid, xmember, xname, 'MEMBERS' as zrole FROM members 
							WHERE xmember = :login and xpassword = :password and bizid = :bizid and zactive='1' and xflag = 'Live'"); 
		$sth->execute(array(
			':login' => $_POST['login'],
			':password' => Hash::create('sha256',$_POST['password'],HASH_KEY),
			':bizid' => $biz
		));
		
		$data = $sth->fetch();
		//print_r($data);die;
		
		$where = "bizid = ". $data['bizid'] ." and zrole = '". $data['zrole'] ."' and xmenutype='Main Menu'";
		
		$menus = $this->getMainMenu($where);
		
		$bizdata = $this->getBizness($biz);
		//print_r($bizdata); die;
		
		
		$count = $sth->rowCount();
		
		
		//echo $count;die;
		if($count>0){
			Session::init();
			Session::set('suser', $data['xmember']);
			Session::set('sname', $data['xname']);
			Session::set('srole', $data['zrole']);
			Session::set('sbizid', $data['bizid']);
			Session::set('susersl', $data['xsl']);
			Session::set('sbizshort', $bizdata[0]['bizshort']);
			Session::set('sbizlong', $bizdata[0]['bizlong']);
			Session::set('sbizadd', $bizdata[0]['bizadd1']);
			Session::set('svatpct', $bizdata[0]['bizvatpct']);
			Session::set('sbizcur', $bizdata[0]["bizcur"]);
			Session::set('schkinv', $bizdata[0]["bizchkinv"]);
			Session::set('sbizdecimals', $bizdata[0]["bizdecimals"]);
			Session::set('sbizitemauto', $bizdata[0]["bizitemauto"]);
			Session::set('sbizcusauto', $bizdata[0]["bizcusauto"]);
			Session::set('sbizsupauto', $bizdata[0]["bizsupauto"]);
			Session::set('sbizdateformat', $bizdata[0]["bizdateformat"]);
			Session::set('syearoffset', $bizdata[0]["bizyearoffset"]);
			Session::set('loggedIn', true);
			Session::set('mainmenus', $menus);
			
			
			header('location: '. URL .'mainmenu/members');
		}else{
			header('location: '. URL .'loginmem/index/'.$biz);
		}
	}
	
	public function getBizness($biz){
		$fields = array("bizid", "bizshort", "bizlong", "bizcur", "bizdecimals","bizitemauto","bizcusauto","bizsupauto","bizdateformat",
		"bizadd1", "bizvatpct", "bizchkinv","bizyearoffset");
		
		$where = "bizid = ".$biz;	
		//print_r($this->db->select("pabuziness", $fields, $where));die;
		return $this->db->select("pabuziness", $fields, $where);
	}
	
		public function getMainMenu($where){
		$fields = array("xmenuindex","xmenu","xsubmenuindex","xsubmenu","xurl");
			
		return $this->db->select("pamenus", $fields, $where);
	}
}