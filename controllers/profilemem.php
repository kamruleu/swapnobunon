<?php
class Profilemem extends Controller{
	
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
			
		
			
		$this->view->js = array('public/js/datatable.js','views/profilemem/js/codevalidator.js');
		
		$this->values = array(
			"xmember"=>"",
			"zoldpassword"=>"",
			"xpassword"=>"",
			"xconfirm"=>"",
			"xname"=>"",
			"xmobile"=>"",
			"xprevillage"=>"",
			"xmemail"=>""
			);
		
		$this->fields = array(array(
							"xmember-text"=>'Member ID_maxlength="20" readonly',
							"xname-text"=>'Full Member Name_minlength="4" maxlength="200"'
							),
						array(
							"xmobile-text"=>'Mobile No_maxlength="14"',
							"xmemail-text"=>'Email_maxlength="100" email="true"'
							),
						array(
							"xpassword-password"=>'New Password_maxlength="256"',
							"xconfirm-password"=>'Confirm New Password_equalTo="#xpassword"'
							),
						array(
							"zoldpassword-password"=>'Old Password_maxlength="250"'
							),		
						array(
							"xprevillage-textarea"=>'Full Address_maxlength="250"'
							)		
						);
			
		}
		
		
		
		public function edituser($user){
			
			if (empty($_POST['xmember'])){
					header ('location: '.URL.'profilemem/showuser/'.Session::get('suser'));
					exit;
				}
			$result = "";
			
			$success=false;
			$form = new Form();
				$data = array();
				$tblvalues = $this->model->getSingleUser($user);
				//print_r($tblvalues);die;
				$oldpostpass = Hash::create('sha256',$_POST['zoldpassword'],HASH_KEY);
				$oldpass = $tblvalues[0]['xpassword'];
				
				try{
					
					if($oldpostpass != $oldpass)
						throw new Exception("Current password did not matched!");
					
					
				$form	->post('xmember')
						->val('maxlength', 20)		
				
						->post('xname')
						->val('minlength', 1)
						->val('maxlength', 50)
						
						->post('xmobile')
						->val('maxlength', 14)
				
						->post('xmemail')
						->val('maxlength', 100)
						
						
						->post('xpassword')
						->val('minlength', 6)
						->val('maxlength', 250)
						
						->post('xprevillage')
						->val('maxlength', 250);
						
						
						
				$form	->submit();
				
				$data = $form->fetch();	
				//print_r($data);die;
				
				$data['bizid'] = Session::get('sbizid');
				$data['xemail'] = Session::get('suser');
				$data['zutime'] = date("Y-m-d H:i:s");
				$success = $this->model->editUser($data, $user);
				//ABL-10938-0095 yzeSYGE8 
				//mypass jutaPU%A
				
				}catch(Exception $e){
					//echo $e->getMessage();die;
					$result = $e->getMessage();
					
				}
				if($result==""){
				if($success)
					$result = "Profile updated successfully";
				else
					$result = "Profile update failed!";
				
				}
				 $this->showuser($user, $result);
				
		
		}
		
		public function showuser($user="", $result=""){
		if($user!=Session::get('suser')){
			header ('location: '.URL.'profilemem/showuser/'.Session::get('suser'));
			exit;
		}
		$tblvalues=array();
		$btn = array(
		);
		
		$tblvalues = $this->model->getSingleUser($user);
		
		if(empty($tblvalues))
			$tblvalues=$this->values;
		else{
			$tblvalues=$tblvalues[0];
			$tblvalues['zoldpassword']="";
		}
			$dynamicForm = new Dynamicform("Member Profile", $btn, $result);		
			
			$this->view->dynform = $dynamicForm->createForm($this->fields, URL."profilemem/edituser/".$user, "Update",$tblvalues);
			
			
			
			$this->view->rendermainmenu('profile/userentry');
		}
		
		
		
		public function showentry($user, $result=""){
		
		$tblvalues=array();
		$btn = array(
			);
		
		$tblvalues = $this->model->getSingleUser($user);
		
		if(empty($tblvalues))
			$tblvalues=$this->values;
		else{
			$tblvalues=$tblvalues[0];
			$tblvalues['zoldpassword']="";
		}
			
			
			$dynamicForm = new Dynamicform("Member Profile", $btn, $result);		
			
			$this->view->dynform = $dynamicForm->createForm($this->fields, URL."profilemem/editusers", "Save",$tblvalues );
			
			
			
			$this->view->rendermainmenu('profilemem/userentry');
		}
		
		
		public function showpost(){
			$user = $_POST['xagent'];
			
		$tblvalues=array();
		$btn = array(
			
		);
		
		$tblvalues = $this->model->getSingleUser($user);
		
		if(empty($tblvalues))
			$tblvalues=$this->values;
		else{
			$tblvalues=$tblvalues[0];
			$tblvalues['zoldpassword']="";
		}
			
			$dynamicForm = new Dynamicform("Member Profile", $btn);		
			
			$this->view->dynform = $dynamicForm->createForm($this->fields, URL."profilemem/editusers", "Update",$tblvalues);
			
			
			
			$this->view->rendermainmenu('profilemem/userentry');
		}
}