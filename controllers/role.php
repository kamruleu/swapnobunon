<?php
class Role extends Controller{
	public $menus=array();
	function __construct(){
		parent::__construct();
		Session::init();
		$logged = Session::get('loggedIn');
			if($logged == false){
				Session::destroy();
				header('location: '.URL.'login');
				exit;
			}
		// session menu management
		$usersessionmenu = 	Session::get('mainmenus');
		
		$iscode=0;
		foreach($usersessionmenu as $menus){
				if($menus["xsubmenu"]=="Role Management")
					$iscode=1;							
		}
		if($iscode==0)	
			header('location: '.URL.'mainmenu');
		// session menu management ENDS
		
			$this->menus=array(					
				
				array(
					"menuindex"=>"1",
					"menu"=>"Settings",
					"submenuindex"=>"1",
					"submenu"=>"Deposit Type",
					"url"=>"code/index/Deposit Type",
					"menutype"=>"Main Menu"
				),
				array(
					"menuindex"=>"1",
					"menu"=>"Settings",
					"submenuindex"=>"2",
					"submenu"=>"Txn Type",
					"url"=>"code/index/Txn Type",
					"menutype"=>"Main Menu"
				),
				array(
					"menuindex"=>"1",
					"menu"=>"Settings",
					"submenuindex"=>"3",
					"submenu"=>"Expense Type",
					"url"=>"code/index/Expense Type",
					"menutype"=>"Main Menu"
				),
				array(
					"menuindex"=>"1",
					"menu"=>"Settings",
					"submenuindex"=>"4",
					"submenu"=>"Year",
					"url"=>"code/index/Year",
					"menutype"=>"Main Menu"
				),
				array(
					"menuindex"=>"1",
					"menu"=>"Settings",
					"submenuindex"=>"5",
					"submenu"=>"Month",
					"url"=>"code/index/Month",
					"menutype"=>"Main Menu"
				),
				array(
					"menuindex"=>"1",
					"menu"=>"Settings",
					"submenuindex"=>"6",
					"submenu"=>"Branch",
					"url"=>"code/index/Branch",
					"menutype"=>"Main Menu"
				),
				array(
					"menuindex"=>"2",
					"menu"=>"Member Settings",
					"submenuindex"=>"1",
					"submenu"=>"Member Entry",
					"url"=>"members",
					"menutype"=>"Main Menu"
				),
				array(
					"menuindex"=>"3",
					"menu"=>"General Ledger",
					"submenuindex"=>"1",
					"submenu"=>"Deposit Entry",
					"url"=>"depositentry",
					"menutype"=>"Main Menu"
				),
				array(
					"menuindex"=>"3",
					"menu"=>"General Ledger",
					"submenuindex"=>"2",
					"submenu"=>"Expense Entry",
					"url"=>"expentry",
					"menutype"=>"Main Menu"
				),
				array(
					"menuindex"=>"3",
					"menu"=>"General Ledger",
					"submenuindex"=>"3",
					"submenu"=>"GL Reports",
					"url"=>"glrpt",
					"menutype"=>"Main Menu"
				),
				array(
					"menuindex"=>"4",
					"menu"=>"User Roles",
					"submenuindex"=>"1",
					"submenu"=>"User Management",
					"url"=>"user",
					"menutype"=>"Main Menu"
				),
				array(
					"menuindex"=>"4",
					"menu"=>"User Roles",
					"submenuindex"=>"2",
					"submenu"=>"Role Management",
					"url"=>"role",
					"menutype"=>"Main Menu"
				)
				
			);
		//add page related java scripts/jquery in array. Only rendered on this page load	
		$this->view->js = array('public/js/datatable.js','views/codes/js/codevalidator.js');
		}
		public function index(){
			
			$head=array("Menu Index","Menu","Submenu Index","Submenu","URL","Menu Type");
			$table = new Datatable();
			
			$fields = array("zrole-Roles");
			
			$rows=$this->model->getRoles();
			
			$this->view->roles = $table->myTable($fields,$rows,"zrole", URL."role/editrole/", URL."role/roledelete/");
			
			$this->view->tblmenus = $table->arrayTable($head, $this->menus, "Create Role", URL."role/create");
			$this->view->message = "";
			$this->view->rendermainmenu('role/index');	
			
			//print_r($menus);
			//die;
		}
		
		public function create(){
			$menupost=array();
			$this->view->message = "";
			$role=$_POST['zrole'];
			$cols="`bizid`,`zrole`,`xmenu`,`xmenuindex`,`xsubmenu`,`xurl`,`xmenutype`,`xsubmenuindex`";
			
			if(isset($_POST["checkbox"])){
				
				
			foreach ($_POST["checkbox"] as $checkitem){
				
				foreach($this->menus as $menuarr){
					if($checkitem==$menuarr["submenu"]){
						$menupost[]=$menuarr;
					}
				}
			}
			
			$str="";
			
				for($i=0; $i<count($menupost); $i++){
					$query_parts[] = "('" . Session::get('sbizid') . "','" . $role . "', '" . $menupost[$i]['menu'] . "','" . $menupost[$i]['menuindex'] . "', '" . $menupost[$i]['submenu'] . "', '" . $menupost[$i]['url'] . "', '" . $menupost[$i]['menutype'] . "', '" . $menupost[$i]['submenuindex'] . "'),";
					
				}
			
				foreach ($query_parts as $key=>$value){
					$str.=$value;
				}
				
				
				$form = new Form();
				$data = array();
				
				try{
				$form	->post('zrole')
						->val('minlength', 1)
						->val('maxlength', 50);
						
												
				$form	->submit();
				
				$data = $form->fetch();	
				
				$data['bizid'] = Session::get('sbizid');
								
				$success = $this->model->create($data,"pamenus",$cols,rtrim($str,','));
						
				
				}catch(Exception $e){
					
					$this->view->message = $e->getMessage();
					
				}
				
			}else{
				$this->view->message = "Please select menus bellow...";
			}
			
			//$this->editrole($role);
			$this->showRoleMenus();
		}
		
		public function showRoleMenus(){
			
			$table = new Datatable();
			
			$fields = array("zrole-Roles");
			
			$rows=$this->model->getRoles();
			
			$this->view->roles = $table->myTable($fields,$rows,"zrole", URL."role/editrole/", URL."role/roledelete/");
			
			$head=array("Menu Index","Menu","Submenu","Submenu","URL","Menu Type");
			
			
			$this->view->tblmenus = $table->arrayTable($head, $this->menus, "Create Role", URL."role/create");
			
			
			
			$this->view->rendermainmenu('role/index');	
		}
		
		public function editrole($role){
			
			$usermenus = $this->model->getUserMenus($role);
			
			$head=array("Menu Index","Menu","Submenu","Submenu","URL","Menu Type");
			$table = new Datatable();
			
			$fields = array("zrole-Roles");
			
			$rows=$this->model->getRoles();
			
			$this->view->roles = $table->myTable($fields,$rows,"zrole", URL."role/editrole/", URL."role/roledelete/");
			
			$this->view->tblmenus = $table->arrayTable($head, $this->menus,"Update Role", URL."role/edit/".$role,$role, $usermenus);
			$this->view->message = "";
			$this->view->roletoedit = $role;
			$this->view->rendermainmenu('role/index');	
						
		}
		
		public function edit($role=""){
			
			$menupost=array();
			$cols="`bizid`,`zrole`,`xmenuindex`,`xmenu`,`xsubmenu`,`xurl`,`xmenutype`,`xsubmenuindex`";
			
			if(isset($_POST["checkbox"]) && isset($_POST['zrole'])){
			foreach ($_POST["checkbox"] as $checkitem){
				
				foreach($this->menus as $menuarr){
					if($checkitem==$menuarr["submenu"]){
						$menupost[]=$menuarr;
					}
				}
			}
			$str="";
			
				for($i=0; $i<count($menupost); $i++){
					$query_parts[] = "('" . Session::get('sbizid') . "','" . $role . "', '" . $menupost[$i]['menuindex'] . "','" . $menupost[$i]['menu'] . "', '" . $menupost[$i]['submenu'] . "', '" . $menupost[$i]['url'] . "', '" . $menupost[$i]['menutype'] . "', '" . $menupost[$i]['submenuindex'] . "'),";
					
				}
			
				foreach ($query_parts as $key=>$value){
					$str.=$value;
				}
			$where = " where bizid=".Session::get('sbizid')." and zrole='".$role."'";
			$editresult=$this->model->edit("pamenus",$cols,rtrim($str,','),$where);
			}
			$this->editrole($role);
		}
		
		public function roledelete($role){
			$where = "bizid=".Session::get('sbizid')." and zrole='".$role."'";
			$this->model->delete($where);
			$this->view->message = "";
			$this->showRoleMenus();
		}
			
}