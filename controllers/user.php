<?php
class User extends Controller{
	
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
				if($menus["xsubmenu"]=="User Management")
					$iscode=1;							
		}
		if($iscode==0)
			header('location: '.URL.'mainmenu');
			
		$this->view->js = array('public/js/datatable.js','public/js/imageshow.js','views/user/js/codevalidator.js','views/user/js/getaccdt.js');
		$date = date("Y/m/d");
		$this->values = array(
							"zemail"=>"",
							"zpassword"=>"",
							"xconfirm"=>"",
							"zrole"=>"",
							"xbranch"=>"",
							"zactive"=>"1",
							"zuserfullname"=>"",
							"zusermobile"=>"",
							"zuseradd"=>"",
							"zaltemail"=>"",
							"zcomments"=>"",
							"xstatus"=>""
							);
			
		$this->fields = array(
				
						array(
							"zemail-text~4"=>'User Email*~red_maxlength="100" required',
							"zuserfullname-text~4"=>'Full User Name_minlength="4" maxlength="50"',
							"zusermobile-text~4"=>'Mobile No_maxlength="14"',
							"zaltemail-text~4"=>'Alternate Email_maxlength="100" email="true"',
							"zpassword-password~4"=>'Password*~red_maxlength="256" required',
							"xconfirm-password~4"=>'Confirm Password*~red_equalTo="#zpassword" required'
							),		
						array(
							"zuseradd-textarea~12"=>'Full Address_maxlength="250"'

							),
						array(
							"zcomments-textarea~12"=>'Comments_maxlength="250"'
							),
						array(
							"zrole-select~4_zrole"=>'Role*~red_"" required',
							"xbranch-select~4_Branch"=>'Branch*~red_""',
							"zactive-checkbox_1"=>'Active?*~red_""',
							"xstatus-hidden"=>'',
							)
						);
		}
		
		public function index(){
		
		
		$btn = array(
			"Clear" => URL."user/userentry",
		);	
		
		
		// form data
		
			$dynamicForm = new Dynamicform("User Create",$btn);		
			
			$this->view->dynform = $dynamicForm->createFormNew($this->fields, URL."user/saveusers", "Save",$this->values,URL."user/showpost");
			
			$this->view->rendermainmenu('user/index');
			
		}
		
		public function saveusers(){
				if (!isset($_POST['zemail'])){
					header ('location: '.URL.'user');
					exit;
				}
		
				$form = new Form();
				$data = array();
				$success=0;
				$result = "";

				try{
						
				$row = $this->model->rowplus("pausers", "xuserrow");

				$form	->post('zemail')
						->val('minlength', 3)
						->val('maxlength', 100)
										
				
						->post('zuserfullname')
						->val('minlength', 1)
						->val('maxlength', 50)
						
						->post('zusermobile')
						->val('maxlength', 14)
				
						->post('zaltemail')
						->val('maxlength', 100)
						
						
						->post('zpassword')
						->val('minlength', 6)
						->val('maxlength', 256)
						
						->post('zuseradd')
						->val('maxlength', 250)
						
						->post('zcomments')
						->val('maxlength', 250)
						
						->post('zrole')
						
						->post('xbranch')
						
						->post('zactive');
						
				$form	->submit();
				
				$data = $form->fetch();
				
				$data['bizid'] = Session::get('sbizid');
				$data['xuserrow'] = $row;
				$username = $data['zemail'];
				$success = $this->model->create($data);
				
				if(empty($success))
					$success=0;
				
				
				}catch(Exception $e){
					
					$this->result = $e->getMessage();
					
				}
				
				
				
				if($success>0){
					$this->result = "saved";

					if ($_FILES['imagefield']["name"]){
						$imgupload = new ImageUpload();
						$imgupload->store_uploaded_image('images/management/','imagefield', 171, 181, $username);
					}
				}
				
				if($success == 0 && empty($this->result))
					$this->result = "Failed to save User!";
				
				 $this->showentry($success, $this->result);
				 //return json_encode($age);
				 
				 
				
		}
		
		public function edituser($user){

				if (!isset($_POST['zemail'])){
					header ('location: '.URL.'user');
					exit;
				}
				$result = "";
				
				$success=false;
				$form = new Form();
				$data = array();
				
				try{

				$form	->post('zemail')
						->val('minlength', 3)
						->val('maxlength', 100)
										
				
						->post('zuserfullname')
						->val('minlength', 1)
						->val('maxlength', 50)
						
						->post('zusermobile')
						->val('maxlength', 14)
				
						->post('zaltemail')
						->val('maxlength', 100)
						
						
						->post('zpassword')
						->val('minlength', 6)
						->val('maxlength', 250)
						
						->post('zuseradd')
						->val('maxlength', 250)
						
						->post('zcomments')
						->val('maxlength', 250)
						
						->post('zrole')
						
						->post('xbranch')
						
						->post('zactive');
						
				$form	->submit();
				
				$data = $form->fetch();	
				//print_r($data);die;
				
				$data['bizid'] = Session::get('sbizid');
				$data['xemail'] = Session::get('suser');
				$data['zutime'] = date("Y-m-d H:i:s");

				$success = $this->model->editUser($data, $user);
				
				
				}catch(Exception $e){
					//echo $e->getMessage();die;
					$result = $e->getMessage();
					
				}
				if($result==""){
				if($success){
					$result = "edited";
					$file = 'images/management/'.$data['zemail'].'.jpg';
					if ($_FILES['imagefield']["name"]){
						if(file_exists($file))
							unlink($file); 
						
						$imgupload = new ImageUpload();
						$imgupload->store_uploaded_image('images/management/','imagefield', 171, 181, $data['zemail']);
						
					}
				}
				else
					$result = "Edit failed!";
				
				}
				 $this->showuser($user, $result);
				
		
		}
		
		public function showuser($cus="", $result=""){
		if($cus==""){
			header ('location: '.URL.'user');
			exit;
		}
		$tblvalues=array();
		$btn = array(
			"New" => URL."user/userentry"
		);
		
		$tblvalues = $this->model->getSingleUser($cus);
		//print_r($tblvalues);die;
		if(empty($tblvalues))
			$tblvalues=$this->values;
		else
			$tblvalues=$tblvalues[0];
			$tblvalues['xstatus']=$result;
			
		
			
		// form data
		
			
			$dynamicForm = new Dynamicform("User Create", $btn, $result);
			
			$file = 'images/management/'.$cus.'.jpg';
		
				$imagename = "";	
			if(file_exists($file))
				$imagename = '../../'.$file;
			else
				$imagename = '../../images/management/noimage.jpg';

			$imgfield=array("User Image", $imagename);

			$this->view->dynform = $dynamicForm->createFormNew($this->fields, URL."user/edituser/".$cus, "Update",$tblvalues, URL."user/showpost","",$imgfield);
			
			$this->view->renderpage('user/userentry');
		}
		
		
		
		public function showentry($cus, $result=""){
		//echo $cus;die;
		
		$tblvalues=array();
		$btn = array(
			"Clear" => URL."user/userentry"
		);
		
		$tblvalues = $this->model->getSingleUser($cus);
		//print_r($tblvalues);die;
		
		if(empty($tblvalues))
			$tblvalues=$this->values;
		else
			$tblvalues=$tblvalues[0];
			$tblvalues['xstatus']=$result;
			
		if($result == "saved"){
			$btnurl = URL."user/edituser/".$cus;
			$btnname = "Update";
		}else{
			$btnurl = URL."user/saveusers";
			$btnname = "Save";
		}
			
		// form data
			
			$dynamicForm = new Dynamicform("User Create", $btn, $result);	
				$file = 'images/management/'.$cus.'.jpg';
		
		$imagename = "";	
		if(file_exists($file))
			$imagename = '../'.$file;
		else
			$imagename = '../images/management/noimage.jpg';
			
			$imgfield=array("User Image", $imagename);
			
			$this->view->dynform = $dynamicForm->createFormNew($this->fields, $btnurl, $btnname, $tblvalues ,URL."user/showpost","",$imgfield);
			
			$this->view->renderpage('user/userentry');
		}
		
		function userlist(){
			$btn = '<div>
				<a href="'.URL.'user/allusers" class="btn btn-primary">Print User List</a>
				</div>
				<div>
				<hr/>
				</div>';
			$this->view->table = $btn.$this->itemTable();
			
			$this->view->renderpage('user/userlist', false);
		}
		
		function picklist(){
			$this->view->table = $this->userPickTable();
			
			$this->view->renderpage('user/userpicklist', false);
		}
		
		function userPickTable(){
			$fields = array(
						"xusersl-UserID",
						"zemail-User",
						"zuserfullname-Name",
						"zusermobile-Mobile",
						"zuseradd-Address",
						"zrole-Role"
						);
			$table = new Datatable();
			$row = $this->model->getUsersByLimit();
			
			return $table->picklistTable($fields, $row, "xusersl");
		}
		
		function itemTable(){
			$fields = array(
						"xusersl-UserID",
						"zemail-User",
						"zuserfullname-Name",
						"zusermobile-Mobile",
						"zuseradd-Address",
						"zrole-Role"
						);
			$table = new Datatable();
			$row = $this->model->getUsersByLimit();
			
			return $this->createDataTable($fields, $row, "xusersl", URL."user/showuser/", URL."user/deleteuser/");
		}
		
		function allusers(){
			$fields = array(
						"xusersl-UserID",
						"zemail-User",
						"zuserfullname-Name",
						"zusermobile-Mobile",
						"zuseradd-Address",
						"zrole-Role",
						"zactive-Active"
						);
			$table = new Datatable();
			$row = $this->model->getUsersByLimit();
			$btn = '<div><a class="btn btn-primary" href="javascript:void(0);" onclick="window.print();" role="button">
			<span class="glyphicon glyphicon-print"></span>&nbsp;Print</a>
			</div><div id="printdiv"><div style="text-align:center">'.Session::get('sbizlong').'<br/>User List</div><hr/>';
			$this->view->table=$btn.$table->myTable($fields, $row, "xusersl")."</div>";
			$this->view->renderpage('user/userlist', false);
		}
		
		function userentry(){
				
		$btn = array(
			"Reset" => URL."user/userentry"
		);

		// form data
		//echo $_SERVER['REQUEST_URI'];
			$dynamicForm = new Dynamicform("User Create",$btn);
			if($_SERVER['REQUEST_URI'] == "/swapnobunon/user/userentry")		
				$imagename = '../images/management/noimage.jpg';
			else
				$imagename = '../../images/management/noimage.jpg';

			$imgfield=array("User Image", $imagename);

			$this->view->dynform = $dynamicForm->createFormNew($this->fields, URL."user/saveusers", "Save",$this->values, URL."user/showpost", "", $imgfield);
			
			$this->view->renderpage('user/userentry', false);
		}
		
		public function deleteuser($usersl){
			$where = "bizid=".Session::get('sbizid')." and xusersl='".$usersl."'";
			$this->model->delete($where);
			$this->view->message = "";
			$this->userlist();
		}

		public function createDataTable($fields, $row, $keyval, $actionurledit="", $actionurldelete="",$actionbtn="Delete"){
			
			$head = array();
			foreach($fields as $str){
				$st=explode('-',$str);
				
				$head[] = $st[1];
			}
			$table = '<div class="table-responsive"><table id="dtbl" class="table table-striped table-bordered" cellspacing="0" width="100%">';
			$table.='<thead>';
			$table.='<tr>';
			foreach($head as $hd){
				$table.='<th>'.$hd.'</th>';
			}
			$table.='<th>Status</th>';
			$table.='<th>Edit</th>';
			$table.='<th>Delete</th>';
			
			$table.='</tr>';
			$table.='</thead>';
			$table.='<tbody>';
			
			foreach($row as $key=>$value){
				$table.='<tr>';
					$table.='<td>'.$value['xusersl'].'</td>';
					$table.='<td>'.$value['zemail'].'</td>';
					$table.='<td>'.$value['zuserfullname'].'</td>';
					$table.='<td>'.$value['zusermobile'].'</td>';
					$table.='<td>'.$value['xbranch'].'</td>';
					$table.='<td>'.$value['zrole'].'</td>';
					if($value['zactive']==1)
						$table.='<td><span class="label label-success">Active</span></td>';
					else
						$table.='<td><span class="label label-warning">Inactive</span></td>';
	
					$table.='<td><a class="btn btn-info" id="'.$value[$keyval].'"  href="'.$actionurledit.$value[$keyval].'" role="button">View</a></td>';
					$table.='<td><a id="delbtn" class="btn btn-danger" href="'.$actionurldelete.$value[$keyval].'" role="button">'.$actionbtn.'</a></td>';
				$table.='</tr>';
			}
			//die;
			$table.='</tbody>';
			$table.='</table></div>';
			
			return $table;	
		}

		function getRoles(){
			$this->model->getRoles();
		}

		function getdoctype($type){
			$this->model->getdoctype($type);
		}
}