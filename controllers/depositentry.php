<?php
class Depositentry extends Controller{
	
	private $upvalues = array();
	private $values = array();
	private $fields = array();
	
	function __construct(){
		parent::__construct();
		Session::init();
		$logged = Session::get('loggedIn');
			if($logged == false){
				Session::destroy();
				header('location: '.URL.'login');
				exit;
			}
			
		$usersessionmenu = 	Session::get('mainmenus');
		
		$iscode=0;
		foreach($usersessionmenu as $menus){
				if($menus["xsubmenu"]=="Deposit Entry")
					$iscode=1;							
		}
		//echo $iscode;die;
		if($iscode==0)
			header('location: '.URL.'mainmenu');
			
		$this->view->js = array('public/js/datatable.js','public/js/imageshow.js','views/depositentry/js/codevalidator.js','views/depositentry/js/getaccdt.js');
		$date = date("Y/m/d");
		$this->upvalues = array(
			"xvoucher"=>"",
			"xsearchby"=>"",
			"xstatus"=>""
			);
		$this->values = array(
			"xvoucher"=>"",
			"xdate"=>$date,
			"xmember"=>"",
			"xname"=>"",
			"xdoctype"=>"",
			"xtxnno"=>"",
			"xamount"=>"0",
			"xmobile"=>"",
			"xnarration"=>"",
			"xstatus"=>""
			);
			
			$this->fields = array(
						
						array(
							"xvoucher-text"=>'Voucher No_maxlength="20" readonly placeholder="Will be created automatically"',
							"xdate-datepicker"=>'Date_',
							"xtxnno-text"=>'Transecton No_maxlength="200" placeholder="Transecton No"',
							"xdoctype-select_Deposit Type"=>'Deposit Type_maxlength="20" required',
							),
						array(
							"xmember-text"=>'Member ID*~red_maxlength="200" placeholder="Search with ID or Name" required',
							"xname-text"=>'Member Name_maxlength="200" readonly',
							"xmobile-text"=>'Mobile_maxlength="20" readonly',
							"xamount-text~3_number"=>'Amount(TK)*~red_number="true" minlength="1" maxlength="18"  required',
							),
						array(
							"xnarration-textarea~12"=>'Narration*~red_maxlength="5000" placeholder="Write here about deposit...." required',
							"xstatus-hidden"=>'',
							)
						);
		}
		
		public function index(){
		
		
		$btn = array(
			"Reset" => URL."depositentry/depentry",
		);	
		
		
		// form data
		
			$dynamicForm = new Dynamicform("Deposit Entry",$btn);		
			
			$this->view->dynform = $dynamicForm->createFormNew($this->fields, URL."depositentry/savedeposit", "Save",$this->values);
			
			$this->view->rendermainmenu('depositentry/index');
			
		}
		
		public function savedeposit(){
				$xdate = $_POST['xdate'];
				$dt = str_replace('/', '-', $xdate);
				$date = date('Y-m-d', strtotime($dt));
				$month = date('m', strtotime($date));
				$year = date('Y', strtotime($date));

				$inparray = array();
				foreach($this->values as $key=> $value ){
					$inparray[$key] = $_POST[$key];
				}
				$inparray['xdate'] = $date;
				$keyfieldval = $this->model->getKeyValue("incexp","xvoucher","DEPV","6");
				//echo $keyfieldval;die;
				$form = new Form();
				$data = array();
				$success=0;
				$result = "";
				try{
						$getmember = $this->model->checkMember($_POST["xmember"]);
						// $where = "bizid = ". Session::get('sbizid') ." and xtxnno = '".$_POST["xtxnno"]."'";
						// $checktxn = $this->model->searchVoucher($where);

						if(empty($getmember)){
							throw new Exception("Sorry!! Invalid Member Id!");
						}

						if($_POST["xamount"] <= 0){
							throw new Exception("Amount would be greater than 0!");
						}

						// if($_POST["xtxnno"]==""){
						// 	throw new Exception("Please Enter Transection No!");
						// }

						// if(!empty($checktxn)){
						// 	throw new Exception("Sorry!! Duplicate Transection No!");
						// }

				$form	->post('xmember')
						->val('maxlength', 20)

						->post('xtxnno')
						->val('maxlength', 200)
				
						->post('xdoctype')
						->val('maxlength', 200)
						
						->post('xamount')
						->val('maxlength', 18)
						
						->post('xnarration')
						->val('maxlength', 5000);
						
				$form	->submit();
				
				$data = $form->fetch();
				
				$data['xvoucher'] = $keyfieldval;
				$data['xdate'] = $date;
				$data['xmonth'] = $month;
				$data['xyear'] = $year;
				$data['xentrydate'] = date("Y-m-d");
				//print_r($data);die;				
				$success = $this->model->create($data);
				
				if(empty($success))
					$success=0;
				
				
				}catch(Exception $e){
					
					$this->result = $e->getMessage();
					
				}
				
				
				
				if($success>0)
					$this->result = "saved";
				
				if($success == 0 && empty($this->result))
					$this->result = "Failed to save Deposit!";
				
				 $this->showentry($keyfieldval, $this->result, $inparray);
				 
		}
		
		public function editdeposit($voucher){
			$xdate = $_POST['xdate'];
			$dt = str_replace('/', '-', $xdate);
			$date = date('Y-m-d', strtotime($dt));
			$month = date('m', strtotime($date));
			$year = date('Y', strtotime($date));

			$inparray = array();
			foreach($this->values as $key=> $value ){
				$inparray[$key] = $_POST[$key];
			}
			$inparray['xdate'] = $date;
			$result = "";
			$success=false;
			$form = new Form();
			$data = array();
				
				try{
					$getmember = $this->model->checkMember($_POST["xmember"]);
					// $where = "bizid = ". Session::get('sbizid') ." and xtxnno = '".$_POST["xtxnno"]."' and xvoucher != '".$_POST["xvoucher"]."'";
					// $checktxn = $this->model->searchVoucher($where);

					if($_POST["xmember"]==""){
						throw new Exception("Please Enter Member ID!");
					}

					if(empty($getmember)){
						throw new Exception("Sorry!! Invalid Member Id!");
					}

					if($_POST["xamount"] <= 0){
						throw new Exception("Amount would be greater than 0!");
					}

					// if($_POST["xtxnno"]==""){
					// 	throw new Exception("Please Enter Transection No!");
					// }

					// if(!empty($checktxn)){
					// 	throw new Exception("Sorry!! Duplicate Transection No!");
					// }
				
				
				$form	->post('xmember')
						->val('maxlength', 20)

						->post('xtxnno')
						->val('maxlength', 200)
				
						->post('xdoctype')
						->val('maxlength', 200)
						
						->post('xamount')
						->val('maxlength', 18)
						
						->post('xnarration')
						->val('maxlength', 5000);
						
				$form	->submit();
				
				$data = $form->fetch();	
				//print_r($data);die;
				
				$data['xuemail'] = Session::get('suser');
				$data['xupdatetime'] = date("Y-m-d H:i:s");
				$data['xdate'] = $date;
				$data['xmonth'] = $month;
				$data['xyear'] = $year;
				$success = $this->model->editDeposit($data, $voucher);
				
				
				}catch(Exception $e){
					//echo $e->getMessage();die;
					$result = $e->getMessage();
					
				}
				if($result==""){
					if($success)
						$result = "edited";
					else
						$result = "Edit failed!";
					
				}
				 $this->showdeposit($voucher, $result, $inparray);
				
		
		}
		
		public function showdeposit($voucher="", $result="", $inparray=array()){
		
		$tblvalues=array();
		$btn = array(
			"Reset" => URL."depositentry/depentry"
		);
		
		$tblvalues = $this->model->getSingleDeposit($voucher);
		
		if(empty($tblvalues) || $result != "edited")
			$tblvalues=$inparray;
		else
			$tblvalues=$tblvalues[0];
			$tblvalues['xstatus']=$result;
			
		// form data
			$dynamicForm = new Dynamicform("Deposit Update", $btn, $result);

			$this->view->dynform = $dynamicForm->createFormNew($this->fields, URL."depositentry/editdeposit/".$voucher, "Update",$tblvalues);
			
			$this->view->renderpage('depositentry/depentry');
		}
		
		
		
		public function showentry($voucher, $result="", $inparray=array()){
		//echo $cus;die;
		
		$tblvalues=array();
		$btn = array(
			"Reset" => URL."depositentry/depentry"
		);
		
		$tblvalues = $this->model->getSingleDeposit($voucher);
		//print_r($tblvalues);die;
		
		if(empty($tblvalues)){
			$tblvalues=$inparray;
			$tblvalues['xstatus']=$result;
			$btnurl = URL."depositentry/savedeposit";
			$btnname = "Save";
		}else{
			$tblvalues=$tblvalues[0];
			$tblvalues['xstatus']=$result;
			$btnurl = URL."depositentry/editdeposit/".$voucher;
			$btnname = "Update";
		}
			
		// form data
			
			$dynamicForm = new Dynamicform("Deposit Update", $btn, $result);	
			
			$this->view->dynform = $dynamicForm->createFormNew($this->fields, $btnurl, $btnname, $tblvalues);
			
			$this->view->renderpage('depositentry/depentry');
		}
		
		function depupdate($status="", $inparray=array()){
			//echo $status;die;
			//print_r($inparray);
			if(!empty($inparray)){
				$this->upvalues = $inparray;
				$this->upvalues['xstatus'] = $status;
			}else{
				$this->upvalues = array(
					"xvoucher"=>"",
					"xsearchby"=>"",
					"xstatus"=>""
					);
			}
			
				$this->fields = array(
							
							array(
								"xvoucher-text~4"=>'Voucher No / Transection No*~red_maxlength="20" placeholder="Enter Voucher no or Transection no" required',
								"xsearchby-select_Deposit Search"=>'Search By*~red_maxlength="20" required',
								"xstatus-hidden"=>'',
								)
							);
			$btn = array(
				"Reset" => URL."depositentry/depupdate"
			);
	
				$dynamicForm = new Dynamicform("Deposit Update",$btn);
	
				$this->view->dynform = $dynamicForm->createFormNew($this->fields, URL."depositentry/searchvoucher", "Search",$this->upvalues);
				
				$this->view->renderpage('depositentry/depentry', false);
		}

		public function searchvoucher(){
			//echo $cus;die;
			$result = "";
			$voucher = $_POST["xvoucher"];
			$searchby = $_POST["xsearchby"];
			$inparray = array();

			foreach($this->upvalues as $key=> $value ){
				$inparray[$key] = $_POST[$key];
			}

			try{

				$voucher = trim($voucher," ");
				if($voucher==""){
					throw new Exception("Please enter ".$searchby."!");
				}

				$where = "";
				if($searchby == 'Voucher'){
					$where = "bizid = ". Session::get('sbizid') ." and xvoucher = '".$voucher."' and xsign = 1";
				}elseif($searchby == 'Transection No'){
					$where = "bizid = ". Session::get('sbizid') ." and xtxnno = '".$voucher."' and xsign = 1";
				}

				$tblvalues=array();
				$tblvalues = $this->model->searchVoucher($where);
				if(empty($tblvalues))
					throw new Exception($searchby." not found!");

			}catch(Exception $e){
				$result = $e->getMessage();
			}

			if($result != "")
				$this->depupdate($result, $inparray);
			else
				$this->showentry($tblvalues[0]['xvoucher']);
			}
		
		function depentry(){
				
		$btn = array(
			"Reset" => URL."depositentry/depentry"
		);

		// form data
		//echo $_SERVER['REQUEST_URI'];
			$dynamicForm = new Dynamicform("Deposit Entry",$btn);

			$this->view->dynform = $dynamicForm->createFormNew($this->fields, URL."depositentry/savedeposit", "Save",$this->values);
			
			$this->view->renderpage('depositentry/depentry', false);
		}

		function getdoctype($type){
			$this->model->getdoctype($type);
		}

		function getMemberByName(){
			$this->model->getMemberByName();
		}
		
}