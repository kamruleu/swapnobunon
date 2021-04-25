<?php
class Userbiz extends Controller{
	
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
				if($menus["xsubmenu"]=="Create User")
					$iscode=1;							
		}
		if($iscode==0)
			header('location: '.URL.'mainmenu');
			
		$this->view->js = array('public/js/datatable.js','views/items/js/codevalidator.js');
		
		$this->values = array(
			"bizid"=>"0",
			"bizlong"=>"",
			"zemail"=>"",			
			"zpassword"=>"",			
			"zuserfullname"=>"",
			"zusermobile"=>"",
			"zuseradd"=>"",
			"zaltemail"=>"",
			"zrole"=>"0"
			);
		
		$this->fields = array(array(
							"bizlong-text"=>'Company Name_maxlength="100"',
							"bizid-hidden"=>'_',
							),array(
							"zemail-text"=>'Username/Email_maxlength="100" email="true"',
							"zuserfullname-text"=>'Full User Name_minlength="4" maxlength="50"'
							),
						array(
							"zusermobile-text"=>'Mobile No_maxlength="14"',
							"zaltemail-text"=>'Alternate Email_maxlength="100" email="true"'
							),
						array(
							"zpassword-password"=>'Password_maxlength="256"',
							
							),		
						array(
							"zuseradd-textarea"=>'Full Address_maxlength="250"',
							"zrole-checkbox_1"=>'Admin_""'
							)		
						);
			
		}
		
		public function index(){		
			
			$this->view->rendermainmenu('userbiz/index');
		}
		
		public function saveuser(){
			
			$result = "";
			
			
			$form = new Form();
				$data = array();
				
				
				$pass = Hash::create('sha256',$_POST['zpassword'],HASH_KEY);
				
				$role="USER";
				if($_POST["zrole"]==1){
					$role="ADMIN";
				}
				
				try{
					
					
					
					
				$form	->post('zemail')
						->val('minlength', 7)
						->val('maxlength', 100)
						->val('checkemail')
										
						->post('bizid')
				
						->post('zuserfullname')
						->val('minlength', 1)
						->val('maxlength', 50)
						
						->post('zusermobile')
						->val('maxlength', 14)
				
						->post('zaltemail')
						->val('maxlength', 100)
						
						
						->post('zuseradd')
						->val('maxlength', 250);
						
						
						
				$form	->submit();
				
				$data = $form->fetch();

				
				$user = $data["zemail"];
				
				$data['zrole'] = $role;
				$data['xemail'] = Session::get('suser');
				
				$data['zpassword'] = $pass;
				//print_r($data);
				$success = $this->model->saveUser($data);


				
				}catch(Exception $e){
					//echo $e->getMessage();die;
					$result = $e->getMessage();
					
				}
				if($result==""){
				
					$result = "Saved successfully";
				}else{
					$result = "Failed to save!";
				
				}
				$this->showentry($data['bizid'], $result);
	
		
		}
		
		public function showbiz($biz, $result=""){
		
		$tblvalues=array();
		$btn = array(
		);
		
		$tblvalues = $this->model->getbiz($biz);
		
		if(count($tblvalues)>0){
			
			$this->values["bizlong"]=$tblvalues[0]["bizlong"];
			$this->values["bizid"]=$tblvalues[0]["bizid"];
		}
		
			$dynamicForm = new Dynamicform("User", $btn, $result);		
			
			$this->view->dynform = $dynamicForm->createForm($this->fields, URL."userbiz/saveuser/", "Save",$this->values);
			$this->view->table=$this->userlist($biz);
			$this->view->renderpage('userbiz/userentry');
		}
		
		
		
		public function showentry($biz, $result=""){
		
		$tblvalues=array();
		$btn = array(
			);
		
		$tblvalues = $this->model->getbiz($biz);
		
		if(count($tblvalues)>0){
			
			$this->values["bizlong"]=$tblvalues[0]["bizlong"];
			$this->values["bizid"]=$tblvalues[0]["bizid"];
		}
		
		/*
		if(count($tblvalues)>0){
			$this->values["bizid"]=$biz;
			$this->values["bizlong"]=$tblvalues['bizlong'];
			$this->values["zemail"]=$tblvalues['zemail'];
			$this->values["zpassword"]=$tblvalues['zpassword'];
			$this->values["zuserfullname"]=$tblvalues['zuserfullname'];
			$this->values["zusermobile"]=$tblvalues['zusermobile'];
			$this->values["zuseradd"]=$tblvalues['zuseradd'];
			$this->values["zaltemail"]=$tblvalues['zaltemail'];			
		
		}*/
			
			
			$dynamicForm = new Dynamicform("User", $btn, $result);		
			
			$this->view->dynform = $dynamicForm->createForm($this->fields, URL."profile/saveusers", "Save",$this->values);
			
			$this->view->table=$this->userlist($biz);
			
			$this->view->renderpage('userbiz/userentry');
		}
		
		public function showuser($biz,$usersl, $result=""){
		
		$tblvalues=array();
		$btn = array(
			);
		
		$tblvalues = $this->model->getSingleUserbysl($usersl,$biz);
		
		if(count($tblvalues)>0){
			$this->values["bizid"]=$biz;
			$this->values["bizlong"]=$tblvalues[0]['bizlong'];
			$this->values["zemail"]=$tblvalues[0]['zemail'];
			$this->values["zpassword"]="";
			$this->values["zuserfullname"]=$tblvalues[0]['zuserfullname'];
			$this->values["zusermobile"]=$tblvalues[0]['zusermobile'];
			$this->values["zuseradd"]=$tblvalues[0]['zuseradd'];
			$this->values["zaltemail"]=$tblvalues[0]['zaltemail'];			
		
		}
		$this->values["zrole"]="0";
		if($tblvalues[0]['zrole']=='ADMIN'){
		    $this->values["zrole"]="1";
		}	
			$dynamicForm = new Dynamicform("User", $btn, $result);		
			
			$this->view->dynform = $dynamicForm->createForm($this->fields, URL."userbiz/updateuser", "Edit",$this->values);
			
			$this->view->table=$this->userlist($biz);
			
			$this->view->renderpage('userbiz/userentry');
		}
		
		function userlist($biz){ 
			$fields = array(
			            "bizid-ID",
			            "xusersl-User No",
			            "bizlong-Company",
						"zemail-Username",
						"zuserfullname-Name",
						"zrole-Role"
						);
			$table = new Datatable();
			$row = $this->model->getUserList($biz);
			
			$table = $table->createTable($fields, $row, "xusersl", URL."userbiz/showuser/".$biz."/",URL."userbiz/deleteuser/".$biz."/");
			return $table;
		}
		
		function deleteuser($biz,$user){
		    $where = " where xusersl=".$user; 
			$result = $this->model->dbdelete($where);
			$message="";
			if($result){
			    $message = "Deleted successfully!";
			}
			$this->showentry($biz, $message);
		}
		
		function updateuser(){
		    
		    $form = new Form();
				$data = array();
				
				
				$pass = Hash::create('sha256',$_POST['zpassword'],HASH_KEY);
				
				$role="USER";
				if($_POST["zrole"]==1){
					$role="ADMIN";
				}
				
				try{
					
					
					
					
				$form	->post('zemail')
						->val('minlength', 7)
						->val('maxlength', 100)
						->val('checkemail')
										
						->post('bizid')
				
						->post('zuserfullname')
						->val('minlength', 1)
						->val('maxlength', 50)
						
						->post('zusermobile')
						->val('maxlength', 14)
				
						->post('zaltemail')
						->val('maxlength', 100)
						
						
						->post('zuseradd')
						->val('maxlength', 250);
						
						
						
				$form	->submit();
				
				$data = $form->fetch();	
				
				
				$data['zrole'] = $role;
				$data['xemail'] = Session::get('suser');
				
				$data['zpassword'] = $pass;
				//print_r($data);
				
				
				 
				$success =  $this->model->edituser($data);
				
				
				}catch(Exception $e){
					//echo $e->getMessage();die;
					$result = $e->getMessage();
					
				}
				if($result==""){
				
					$result = "Updated successfully";
				}else{
					$result = "Failed to save!";
				
				}
				$this->showentry( $data['bizid'], $result);
		    
		   
		   }
		
		function companylist(){ 
			$fields = array(
						"bizid-Company ID",
						"bizlong-Organization/Name"						
						);
			$table = new Datatable();
			$row = $this->model->getallbiz();
			
			$this->view->table = $table->createTable($fields, $row, "bizid", URL."userbiz/showbiz/");
			$this->view->renderpage('userbiz/companylist');
		}
		
		
}