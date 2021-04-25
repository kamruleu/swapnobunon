<?php
class Mainmenu extends Controller{
	
	function __construct(){
		parent::__construct();
		Session::init();
		$logged = Session::get('loggedIn');
			if($logged == false){
				Session::destroy();
				header('location: '.URL.'login');
				exit;
			}
			$this->view->js = array('public/js/datatable.js','views/mainmenu/js/chart.js');
		}
		
		public function index(){

			if(Session::get('srole') == "EMPLOYEE"){

				$xdate = date("Y/m/d");
				$dt = str_replace('/', '-', $xdate);
				$date = date('Y-m-d', strtotime($dt));
				$year = date('Y',strtotime($date));
				$month = date('m',strtotime($date));
				$id = Session::get('suser');
				$this->view->rendermainmenu('mainmenu/indexforemployee');

			}else{
			    

			$where = "bizid = ". Session::get('sbizid') ." and zrole = '". Session::get('srole')."'";
			
			$menus = $this->model->getMainMenu($where);
			$arr=array();
			for($i=0; $i<count($menus); $i++){
				
				$arr[$menus[$i]['xmenu']][]=$menus[$i]['xsubmenu'].",".$menus[$i]['xurl'];
			}

			//----------------bizcur-----------------//
			$this->view->bizcur = Session::get('sbizcur');
			date_default_timezone_set("Asia/Dhaka");
			$date = date('Y-m-d');
			$month = date('n');
			$year = date('Y');
			$dt = date('Y-m-d H:i:s');
			$tdt = str_replace('/', '-', $dt);
			$tdate = date('Y-m-d', strtotime($tdt));

			//------------Sales-----------------//
			$this->view->tmem = $this->model->getTotalMember()[0]['tmem'];
			$this->view->currentdeposit = $this->model->getCurrentDeposit()[0]['xamount'];

			$this->view->totalexp = $this->model->getIncExp(-1)[0]['xamount'];
			$this->view->totalinc = $this->model->getIncExp(1)[0]['xamount'];

			$this->view->tinc = $this->model->getTodayIncExp($date, 1)[0]['xamount'];
			$this->view->texp = $this->model->getTodayIncExp($date, -1)[0]['xamount'];

			$this->view->cmonthinc = $this->model->getMonYrIncExp(" and xmonth = ".$month." and xyear = ".$year." and xsign = 1")[0]['xamount'];
			$this->view->cmonthexp = $this->model->getMonYrIncExp(" and xmonth = ".$month." and xyear = ".$year." and xsign = -1")[0]['xamount'];

			$this->view->cyrinc = $this->model->getMonYrIncExp(" and xyear = ".$year." and xsign = 1")[0]['xamount'];
			$this->view->cyrexp = $this->model->getMonYrIncExp(" and xyear = ".$year." and xsign = -1")[0]['xamount'];
			
			$this->view->rendermainmenu('mainmenu/index');
			}
		}

		public function members(){

			//----------------bizcur-----------------//
			$this->view->bizcur = Session::get('sbizcur');
			date_default_timezone_set("Asia/Dhaka");
			$date = date('Y-m-d');
			$month = date('n');
			$year = date('Y');
			$dt = date('Y-m-d H:i:s');
			$tdt = str_replace('/', '-', $dt);
			$tdate = date('Y-m-d', strtotime($tdt));

			//------------Sales-----------------//
			$this->view->tmem = $this->model->getTotalMember()[0]['tmem'];
			$this->view->currentdeposit = $this->model->getCurrentDeposit()[0]['xamount'];

			$this->view->totalexp = $this->model->getIncExp(-1)[0]['xamount'];
			$this->view->totalinc = $this->model->getIncExp(1)[0]['xamount'];

			$this->view->tinc = $this->model->getTodayIncExp($date, 1)[0]['xamount'];
			$this->view->texp = $this->model->getTodayIncExp($date, -1)[0]['xamount'];

			$this->view->cmonthinc = $this->model->getMonYrIncExp(" and xmonth = ".$month." and xyear = ".$year." and xsign = 1")[0]['xamount'];
			$this->view->cmonthexp = $this->model->getMonYrIncExp(" and xmonth = ".$month." and xyear = ".$year." and xsign = -1")[0]['xamount'];

			$this->view->cyrinc = $this->model->getMonYrIncExp(" and xyear = ".$year." and xsign = 1")[0]['xamount'];
			$this->view->cyrexp = $this->model->getMonYrIncExp(" and xyear = ".$year." and xsign = -1")[0]['xamount'];
			
					
			$where = "bizid = ". Session::get('sbizid') ." and zrole = '". Session::get('srole')."'";
			
			$menus = $this->model->getMainMenu($where);
			$arr=array();
			for($i=0; $i<count($menus); $i++){
				
				$arr[$menus[$i]['xmenu']][]=$menus[$i]['xsubmenu'].",".$menus[$i]['xurl'];
			}
			
			$this->view->rendermainmenu('mainmenu/index');
		}
		function logout(){
			Session::destroy();
			header('location: ' . URL . 'login/index');
			exit;
		}
		function logoutmem($biz){
			Session::destroy();
			header('location: ' . URL . 'loginmem/index/' . $biz);
			exit;
		}


}