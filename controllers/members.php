<?php
class Members extends Controller{
	
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
				if($menus["xsubmenu"]=="Member Entry")
					$iscode=1;							
		}
		if($iscode==0)
			header('location: '.URL.'mainmenu');
			
		$this->view->js = array('public/js/datatable.js','public/js/imageshow.js','views/members/js/codevalidator.js','views/members/js/getaccdt.js');
		$date = date("Y/m/d");
		$this->values = array(
			"xmember"=>"",
			"xdate"=>$date,
			"xname"=>"",
			"xfname"=>"",
			"xmname"=>"",
			"xwname"=>"",
			"xperhome"=>"",
			"xpervillage"=>"",
			"xperpostoffice"=>"",
			"xperthana"=>"",
			"xperzila"=>"",
			"xmobile"=>"",
			"xnid"=>"",
			"xhousename"=>"",
			"xroadname"=>"",
			"xprevillage"=>"",
			"xprepostoffice"=>"",
			"xprethana"=>"",
			"xprezila"=>"",
			"xphone"=>"",
			"xnominee"=>"",
			"xrelation"=>"",
			"xidentyname"=>"",
			"zactive"=>"1",
			"xstatus"=>""
			);
			
			$this->fields = array(
						
						array(
							"xmember-text~4"=>'Customer Code_maxlength="20" readonly placeholder="Code will be created automatically."',
							"xdate-datepicker~4"=>'Date_',
							"xname-text~4"=>'Member Name*~red_maxlength="200" required',
							"xfname-text~4"=>'Father Name_maxlength="200"',
							"xmname-text~4"=>'Mother Name_maxlength="200"',
							"xwname-text~4"=>'Wife Name_maxlength="200"',
							),		
						array(
							"sfieldset"=>'Permanent Address',
							"xperhome-text"=>'Home_maxlength="200"',
							"xpervillage-text"=>'Village_maxlength="200"',
							"xperpostoffice-text"=>'Post Office_maxlength="200"',
							"xperzila-select_DISTRICT"=>'Zilla_maxlength="200"',
							),
						array(
							"xperthana-select_THANA"=>'Thana_maxlength="200"',
							"xmobile-text"=>'Mobile_maxlength="11"',
							"xnid-text"=>'National ID_maxlength="20"',
							"efieldset"=>'End Test',
							),
						array(
							"sfieldset"=>'Present Address',
							"xhousename-text"=>'House Name_maxlength="200"',
							"xroadname-text"=>'Road Name and No_maxlength="200"',
							"xprevillage-text"=>'Village_maxlength="200"',
							"xprepostoffice-text"=>'Post Office_maxlength="200"',
							),
						array(
							"xprezila-select_DISTRICT"=>'Zilla_maxlength="200"',
							"xprethana-select_THANA"=>'Thana_maxlength="200"',
							"xphone-text"=>'Phone_maxlength="20"',
							"efieldset"=>'End Test',
							),
						array(
							"sfieldset"=>'Nominee Info',
							"xnominee-text~3"=>'Nominee Name_maxlength="200"',
							"xrelation-text~3"=>'Relation_maxlength="200"',
							"xidentyname-text~3"=>'Identifier name_maxlength="20"',
							"zactive-checkbox_1"=>'Active?_""',
							"xstatus-hidden"=>'',
							"efieldset"=>'End Test',
							)
						);
		}
		
		public function index(){
		
		
		$btn = array(
			"Clear" => URL."members/customerentry",
		);	
		
		
		// form data
		
			$dynamicForm = new Dynamicform("Member Create",$btn);		
			
			$this->view->dynform = $dynamicForm->createFormNew($this->fields, URL."members/savecustomers", "Save",$this->values,URL."members/showpost");
			
			$this->view->rendermainmenu('members/index');
			
		}
		
		public function savecustomers(){
				// if (!isset($_POST['xmember'])){
				// 	header ('location: '.URL.'members');
				// 	exit;
				// }
		
				$keyfieldval = $this->model->getKeyValue("members","xmember","SB","3");
				//echo $keyfieldval;die;
				$xdate = $_POST['xdate'];
				$dt = str_replace('/', '-', $xdate);
				$date = date('Y-m-d', strtotime($dt));
				$form = new Form();
				$data = array();
				$success=0;
				$result = "";
				try{
						if($_POST["xname"]==""){
							throw new Exception("Please Enter Member Name!");
						}
				$form	->post('xname')
						->val('minlength', 4)
						->val('maxlength', 200)
				
						->post('xfname')
						->val('maxlength', 200)
						
						->post('xmname')
						->val('maxlength', 200)
						
						->post('xwname')
						->val('maxlength', 200)
						
						->post('xperhome')
						->val('maxlength', 300)
						
						->post('xpervillage')
						->val('maxlength', 300)
						
						->post('xperpostoffice')
						->val('maxlength', 150)
						
						->post('xperthana')
						->val('maxlength', 150)
						
						->post('xperzila')
						->val('maxlength', 100)
						
						->post('xmobile')
						->val('maxlength', 20)
						
						->post('xnid')
						->val('maxlength', 20)
						
						->post('xhousename')
						->val('maxlength', 300)
						
						->post('xroadname')
						->val('maxlength', 150)
						
						->post('xprevillage')
						->val('maxlength', 200)
						
						->post('xprepostoffice')
						->val('maxlength', 150)
						
						->post('xprethana')
						->val('maxlength', 100)
						
						->post('xprezila')
						->val('maxlength', 100)
						
						->post('xphone')
						->val('maxlength', 20)
						
						->post('xnominee')
						->val('maxlength', 200)
						
						->post('xrelation')
						->val('maxlength', 200)
						
						->post('xidentyname')
						->val('maxlength', 200)
						
						->post('zactive');
						
				$form	->submit();
				
				$data = $form->fetch();
				
				$data['xmember'] = $keyfieldval;
				$data['xdate'] = $date;
				$data['xentrydate'] = date("Y-m-d");
				//print_r($data);die;				
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
						$imgupload->store_uploaded_image('images/members/large/','imagefield', 400, 400,$keyfieldval);
						$imgupload->store_uploaded_image('images/members/small/','imagefield', 171, 181,$keyfieldval);
					}
				}
				
				if($success == 0 && empty($this->result))
					$this->result = "Failed to save Member!";
				
				 $this->showentry($keyfieldval, $this->result);
				 //return json_encode($age);
				 
				 
				
		}
		
		public function editcustomer($cus){

			if (!isset($_POST['xmember'])){
					header ('location: '.URL.'members');
					exit;
				}
			$result = "";
			
			$success=false;
			$form = new Form();
				$data = array();
				
				try{
					
					if($_POST["xmember"]==""){
						throw new Exception("Please Enter Member ID!");
					}

					if($_POST["xname"]==""){
						throw new Exception("Please Enter Member Name!");
					}
				
				
				$form	->post('xmember')
						->val('minlength', 1)
						->val('maxlength', 20)
										
				
						->post('xname')
						->val('minlength', 4)
						->val('maxlength', 200)
				
						->post('xfname')
						->val('maxlength', 200)
						
						->post('xmname')
						->val('maxlength', 200)
						
						->post('xwname')
						->val('maxlength', 200)
						
						->post('xperhome')
						->val('maxlength', 300)
						
						->post('xpervillage')
						->val('maxlength', 300)
						
						->post('xperpostoffice')
						->val('maxlength', 150)
						
						->post('xperthana')
						->val('maxlength', 150)
						
						->post('xperzila')
						->val('maxlength', 100)
						
						->post('xmobile')
						->val('maxlength', 20)
						
						->post('xnid')
						->val('maxlength', 20)
						
						->post('xhousename')
						->val('maxlength', 300)
						
						->post('xroadname')
						->val('maxlength', 150)
						
						->post('xprevillage')
						->val('maxlength', 200)
						
						->post('xprepostoffice')
						->val('maxlength', 150)
						
						->post('xprethana')
						->val('maxlength', 100)
						
						->post('xprezila')
						->val('maxlength', 100)
						
						->post('xphone')
						->val('maxlength', 20)
						
						->post('xnominee')
						->val('maxlength', 200)
						
						->post('xrelation')
						->val('maxlength', 200)
						
						->post('xidentyname')
						->val('maxlength', 200)
						
						->post('zactive');
						
				$form	->submit();
				
				$data = $form->fetch();	
				//print_r($data);die;
				
				$data['xuemail'] = Session::get('suser');
				$data['xupdatetime'] = date("Y-m-d H:i:s");
				$success = $this->model->editCustomer($data, $cus);
				
				
				}catch(Exception $e){
					//echo $e->getMessage();die;
					$result = $e->getMessage();
					
				}
				if($result==""){
				if($success){
					$result = "edited";
					$file = 'images/members/small/'.$cus.'.jpg';
					if ($_FILES['imagefield']["name"]){
						if(file_exists($file))
							unlink($file); 
						
						$imgupload = new ImageUpload();
						$imgupload->store_uploaded_image('images/members/large/','imagefield', 400, 400, $cus);
						$imgupload->store_uploaded_image('images/members/small/','imagefield', 171, 181, $cus);
						
					}
				}
				else
					$result = "Edit failed!";
				
				}
				 $this->showcustomer($cus, $result);
				
		
		}
		
		public function showcustomer($cus="", $result=""){
		if($cus==""){
			header ('location: '.URL.'members');
			exit;
		}
		$tblvalues=array();
		$btn = array(
			"New" => URL."members/customerentry"
		);
		
		$tblvalues = $this->model->getSingleCustomer($cus);
		
		if(empty($tblvalues))
			$tblvalues=$this->values;
		else
			$tblvalues=$tblvalues[0];
			$tblvalues['xstatus']=$result;
			
		
			
		// form data
		
			
			$dynamicForm = new Dynamicform("Member Create", $btn, $result);
			
			$file = 'images/members/small/'.$cus.'.jpg';
		
				$imagename = "";	
			if(file_exists($file))
				$imagename = '../../'.$file;
			else
				$imagename = '../../images/members/noimage.jpg';

			$imgfield=array("Member Image", $imagename);

			$this->view->dynform = $dynamicForm->createFormNew($this->fields, URL."members/editcustomer/".$cus, "Update",$tblvalues, URL."members/showpost","",$imgfield);
			
			$this->view->renderpage('members/customerentry');
		}
		
		
		
		public function showentry($cus, $result=""){
		//echo $cus;die;
		
		$tblvalues=array();
		$btn = array(
			"Clear" => URL."members/customerentry"
		);
		
		$tblvalues = $this->model->getSingleCustomer($cus);
		//print_r($tblvalues);die;
		
		if(empty($tblvalues))
			$tblvalues=$this->values;
		else
			$tblvalues=$tblvalues[0];
			$tblvalues['xstatus']=$result;
			
		if($result == "saved"){
			$btnurl = URL."members/editcustomer/".$cus;
			$btnname = "Update";
		}else{
			$btnurl = URL."members/savecustomers";
			$btnname = "Save";
		}
			
		// form data
			
			$dynamicForm = new Dynamicform("Member Create", $btn, $result);	
				$file = 'images/members/small/'.$cus.'.jpg';
		
		$imagename = "";	
		if(file_exists($file))
			$imagename = '../'.$file;
		else
			$imagename = '../images/members/noimage.jpg';
			
			$imgfield=array("Member Image", $imagename);
			
			$this->view->dynform = $dynamicForm->createFormNew($this->fields, $btnurl, $btnname, $tblvalues ,URL."members/showpost","",$imgfield);
			
			$this->view->renderpage('members/customerentry');
		}
		
		function customerlist(){
			$btn = '<div>
				<a href="'.URL.'members/allcustomers" class="btn btn-primary">Print Member List</a>
				</div>
				<div>
				<hr/>
				</div>';
			$this->view->table = $btn.$this->itemTable();
			
			$this->view->renderpage('members/customerlist', false);
		}
		
		function picklist(){
			$this->view->table = $this->customerPickTable();
			
			$this->view->renderpage('members/customerpicklist', false);
		}
		
		function customerPickTable(){
			$fields = array(
						"xmember-Member ID",
						"xname-Name",
						"xfname-Fathers Nmae",
						"xmname-Mothers Name",
						"xmobile-Mobile"
						);
			$table = new Datatable();
			$row = $this->model->getCustomersByLimit();
			
			return $table->picklistTable($fields, $row, "xmember");
		}
		
		function itemTable(){
			$fields = array(
						"xmember-Member ID",
						"xname-Name",
						"xfname-Fathers Nmae",
						"xmname-Mothers Name",
						"xmobile-Mobile"
						);
			$table = new Datatable();
			$row = $this->model->getCustomersByLimit();
			
			return $this->createDataTable($fields, $row, "xmember", URL."members/showcustomer/", URL."members/deletecustomer/");
		}
		
		function allcustomers(){
			$fields = array(
						"xmember-Member ID",
						"xname-Name",
						"xfname-Fathers Nmae",
						"xmname-Mothers Name",
						"xmobile-Mobile"
						);
			$table = new Datatable();
			$row = $this->model->getCustomersByLimit();
			$btn = '<div><a class="btn btn-primary" href="javascript:void(0);" onclick="window.print();" role="button">
			<span class="glyphicon glyphicon-print"></span>&nbsp;Print</a>
			</div><div id="printdiv"><div style="text-align:center">'.Session::get('sbizlong').'<br/>Member List</div><hr/>';
			$this->view->table=$btn.$table->myTable($fields, $row, "xmember")."</div>";
			$this->view->renderpage('members/customerlist', false);
		}
		
		function customerentry(){
				
		$btn = array(
			"Reset" => URL."members/customerentry"
		);

		// form data
		//echo $_SERVER['REQUEST_URI'];
			$dynamicForm = new Dynamicform("Member Create",$btn);
			if($_SERVER['REQUEST_URI'] == "/swapnobunon/members/customerentry")		
				$imagename = '../images/members/noimage.jpg';
			else
				$imagename = '../../images/members/noimage.jpg';

			$imgfield=array("Member Image", $imagename);

			$this->view->dynform = $dynamicForm->createFormNew($this->fields, URL."members/savecustomers", "Save",$this->values, URL."members/showpost", "", $imgfield);
			
			$this->view->renderpage('members/customerentry', false);
		}
		
		public function deletecustomer($cus){
			$where = "bizid=".Session::get('sbizid')." and xmember='".$cus."'";
			$this->model->delete($where);
			$this->view->message = "";
			$this->customerlist();
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
					$table.='<td>'.$value['xmember'].'</td>';
					$table.='<td>'.$value['xname'].'</td>';
					$table.='<td>'.$value['xfname'].'</td>';
					$table.='<td>'.$value['xmname'].'</td>';
					$table.='<td>'.$value['xmobile'].'</td>';
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
		
}