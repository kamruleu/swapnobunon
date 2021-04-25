<?php
class Bizdefnew extends Controller{
	
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
				if($menus["xsubmenu"]=="Create New Business")
					$iscode=1;							
		}
		if($iscode==0)
			header('location: '.URL.'mainmenu');
			
		$this->view->js = array('public/js/datatable.js','public/js/imageshow.js','views/studentmst/js/codevalidator.js');
		$dt = date("Y/m/d");
		$this->values = array(
			"bizshort"=>"",
			"bizlong"=>"",
			"bizadd1"=>"",
			"bizadd2"=>"",
			"bizdistrict"=>"",
			"bizthana"=>"",
			"bizemail"=>"",
			"bizfax"=>"",
			"bizphone1"=>"",
			"bizphone2"=>"",
			"bizmobile"=>"",
			"bizcur"=>"BDT",
			"bizvatpct"=>"0",
			"bizchkinv"=>"YES",
			"bizdecimals"=>"2",
			"bizitemauto"=>"YES",
			"bizcusauto"=>"YES",
			"bizsupauto"=>"YES",
			"bizdateformat"=>"dd-MM-yyyy",
			"bizyearoffset"=>"6",
			"bizid"=>"0",
			"xbin"=>"",
			"xbinimage"=>"",
			"xtin"=>"",
			"xtinimage"=>"",
			"xtradelic"=>"",
			"xtradelicimage"=>"",
			"xrjsc"=>"",
			"xrjscimage"=>"",
			"xassocno"=>"",
			"xassocimage"=>"",
			"xtradelicexpdate"=>"",
			"xassocexpdate"=>"",
			);
			
			$this->fields = array(
						array(
							"bizshort-text"=>'Company Short Name_maxlength="6"',
							"bizlong-text"=>'Company Name_maxlength="150"'
							),
						array(
							"bizadd1-textarea"=>'Address 1_maxlength="250"'
							),
						array(
							"bizadd2-textarea"=>'Address 2_maxlength="250"'
							),	
						array(
							"bizdistrict-text"=>'District_maxlength="30"',
							"bizthana-text"=>'Thana_maxlength="50"'
							),		
						array(
							"bizemail-text"=>'Email_maxlength="50"',
							"bizfax-text"=>'Fax_maxlength="20"'
							),		
						array(
							"bizphone1-text"=>'Phone 1_maxlength="20"',
							"bizphone2-text"=>'Phone 2_maxlength="20"'
							),
						array(
							"Comapny Documents-div_#0D68B9"=>''
						),		
						array(
							"xbin-text"=>'BIN_maxlength="14"',
							"xbinimage-file"=>'BIN File_""'
							),		
						array(
							"xtin-text"=>'TIN_maxlength="14"',
							"xtinimage-file"=>'TIN File_""'
							),		
						array(
							"xtradelic-text"=>'Trade Lic. No_maxlength="14"',
							"xtradelicimage-file"=>'Trade Lic. File_""',
							"xtradelicexpdate-datepicker" => 'Trade Lic. Exp. Date_""',
							),		
						array(
							"xrjsc-text"=>'Comapany No_maxlength="14"',
							"xrjscimage-file"=>'RJSC Certificate_""'
							),		
						array(
							"xassocno-text"=>'Association No_maxlength="14"',
							"xassocimage-file"=>'Association File_""',
							"xassocexpdate-datepicker" => 'Association Exp. Date_""',
							),
						array(
							"Business Setup-div_#0D68B9"=>''
						),		
						array(
							"bizmobile-text"=>'Mobile_maxlength="14"',
							"bizcusauto-radio_YES_NO"=>'Customer Code Auto_""'
							),
						array(
							"bizvatpct-text"=>'Vat PCT_maxlength="18"',
							"bizchkinv-radio_YES_NO"=>'Inventory Check_""'
							),	
						array(
							"bizdecimals-text"=>'Decimals_maxlength="18"',
							"bizitemauto-radio_YES_NO"=>'Item Code Auto_""'
							),
						array(
							"bizcur-select_Currency"=>'Currency_maxlength="3"',
							"bizsupauto-radio_YES_NO"=>'Suplier Code Auto_""'
							),
						array(
							"bizdateformat-text"=>'Date Format_maxlength="11"',
							"bizyearoffset-text"=>'Year Offset_maxlength="2"'
							),		
						array(
							"bizid-hidden"=>'_""'
							)
						);
		
		}
		
		public function savebizdefnew(){
			
			//$bizid = $_POST['bizid'];
			$tradelicexpdate="";
			$assocexpdate = "";
			if($_POST['xtradelicexpdate']!=""){
				$xdate = $_POST['xtradelicexpdate'];
				$dt = str_replace('/', '-', $xdate);
				$tradelicexpdate = date('Y-m-d', strtotime($dt));
			}

			if($_POST['xassocexpdate']!=""){
				$xdate = $_POST['xassocexpdate'];
				$dt = str_replace('/', '-', $xdate);
				$assocexpdate = date('Y-m-d', strtotime($dt));
			}
			$result = "";
			
			$success=false;
			$form = new Form();
				$data = array();
				
				try{
			
				$form	->post('bizshort')
						->val('maxlength', 6)
						
						->post('bizlong')
						->val('maxlength', 150)
						
						->post('bizadd1')
						->val('maxlength', 250)
						
						->post('bizadd2')
						->val('maxlength', 250)
						
						->post('bizdistrict')
						->val('maxlength', 30)
						
						->post('bizthana')
						->val('maxlength', 50)
						
						->post('bizemail')
						->val('maxlength', 50)
						
						->post('bizfax')
						->val('maxlength', 20)
						
						->post('bizphone1')
						->val('maxlength', 20)
						
						->post('bizphone2')
						->val('maxlength', 20)
						
						->post('bizmobile')
						->val('maxlength', 14)
						
						->post('bizcusauto')
						
						->post('bizvatpct')
						->val('maxlength', 18)
						
						->post('bizchkinv')
						
						->post('bizdecimals')
						->val('maxlength', 18)
						
						->post('bizitemauto')
						
						->post('bizcur')
						->val('maxlength', 3)
						
						->post('bizsupauto')

						->post('xbin')

						->post('xtin')

						->post('xtradelic')

						->post('xrjsc')

						->post('xassocno')
						
						->post('bizdateformat')
						->val('maxlength', 11)
						
						->post('bizyearoffset')
						->val('maxlength', 2);
						
				$form	->submit();
				
				$data = $form->fetch();	
				if($tradelicexpdate!="")
				    $data["xtradelicexpdate"]=$tradelicexpdate;
				if($assocexpdate!="")
				    $data["xassocexpdate"]=$assocexpdate;
				$binfilename="";

				$tinfilename="";

				$tradelicfilename="";

				$rjscfilename="";

				$assocfilename=""; 

				

				if ($_FILES['xbinimage']["name"]){
					$data['xbinimage'] = "public/images/bizdir/".$_FILES['xbinimage']["name"];
					$binfilename=$_FILES['xbinimage']["name"];
					
				}
				if($_FILES['xtinimage']["name"]){
					$data['xtinimage'] = "public/images/bizdir/".$_FILES['xtinimage']["name"];
					$tinfilename=$_FILES['xtinimage']["name"];
					
				}
				if($_FILES['xtradelicimage']["name"]){
					$data['xtradelicimage'] = "public/images/bizdir/".$_FILES['xtradelicimage']["name"];
					$tradelicfilename=$_FILES['xtradelicimage']["name"];
					
				}
				if($_FILES['xrjscimage']["name"]){
					$data['xrjscimage'] = "public/images/bizdir/".$_FILES['xrjscimage']["name"];
					$rjscfilename=$_FILES['xrjscimage']["name"];
					
				}
				if($_FILES['xassocimage']["name"]){
					$data['xassocimage'] = "public/images/bizdir/".$_FILES['xassocimage']["name"];
					$assocfilename=$_FILES['xassocimage']["name"]; 
					
				}	
				

				$success = $this->model->saveBizdefnew($data);
				//print_r($success);die;
				$getmenu = $this->model->getMenu();
				
				}catch(Exception $e){
					//echo $e->getMessage();die;
					$result = $e->getMessage();
					
				}finally{
				if($result==""){
				if($success){
					$result = "Save successfully";
					$this->model->saveRole($success);
					foreach ($getmenu as $key => $value) {
						$menudt = array(
							"bizid"=>$success,
							"zrole"=>$value['zrole'],
							"xmenuindex"=>$value['xmenuindex'],
							"xsubmenuindex"=>$value['xsubmenuindex'],
							"xmenu"=>$value['xmenu'],
							"xsubmenu"=>$value['xsubmenu'],
							"xurl"=>$value['xurl'],
							"xmenutype"=>$value['xmenutype']
						);

						$this->model->saveMenu($menudt);
					}
					

					if ($_FILES['imagefield']["name"]){
						$imgupload = new ImageUpload();
						$imgupload->store_uploaded_image('public/images/bizdir/','imagefield', 64, 62, $success);
					}

					if ($_FILES['xbinimage']["name"]){
						
						$imgupload = new ImageUpload();
						$imgupload->store_uploaded_originimage('public/images/bizdir/','xbinimage', 800, 650, $binfilename);
					}

					
					
					if ($_FILES['xtinimage']["name"]){
												
						$imgupload = new ImageUpload();
						$imgupload->store_uploaded_originimage('public/images/bizdir/','xtinimage', 800, 650, $tinfilename);
					}

					
					
					if ($_FILES['xtradelicimage']["name"]){
						
						$imgupload = new ImageUpload();
						$imgupload->store_uploaded_originimage('public/images/bizdir/','xtradelicimage', 800, 650, $tradelicfilename);
					}

					if ($_FILES['xrjscimage']["name"]){
						
						$imgupload = new ImageUpload();
						$imgupload->store_uploaded_originimage('public/images/bizdir/','xrjscimage', 800, 650, $rjscfilename);
					}

					if ($_FILES['xassocimage']["name"]){
						
						$imgupload = new ImageUpload();
						$imgupload->store_uploaded_originimage('public/images/bizdir/','xassocimage', 800, 650, $assocfilename);
					}
					
				}
				else
					$result = "Operation failed!";
				
				}
				 $this->showdef($result);
				
				}
		}

		public function editbizdefnew(){
			
			$bizid = $_POST['bizid'];

			$tradelicexpdate="";
			$assocexpdate = "";
			if($_POST['xtradelicexpdate']!=""){
				$xdate = $_POST['xtradelicexpdate'];
				$dt = str_replace('/', '-', $xdate);
				$tradelicexpdate = date('Y-m-d', strtotime($dt));
			}

			if($_POST['xassocexpdate']!=""){
				$xdate = $_POST['xassocexpdate'];
				$dt = str_replace('/', '-', $xdate);
				$assocexpdate = date('Y-m-d', strtotime($dt));
			}
			$result = "";
			
			$success=false;
			$form = new Form();
				$data = array();
				
				try{
			
				$form	->post('bizshort')
						->val('maxlength', 6)
						
						->post('bizlong')
						->val('maxlength', 150)
						
						->post('bizadd1')
						->val('maxlength', 250)
						
						->post('bizadd2')
						->val('maxlength', 250)
						
						->post('bizdistrict')
						->val('maxlength', 30)
						
						->post('bizthana')
						->val('maxlength', 50)
						
						->post('bizemail')
						->val('maxlength', 50)
						
						->post('bizfax')
						->val('maxlength', 20)
						
						->post('bizphone1')
						->val('maxlength', 20)
						
						->post('bizphone2')
						->val('maxlength', 20)
						
						->post('bizmobile')
						->val('maxlength', 14)
						
						->post('bizcusauto')
						
						->post('bizvatpct')
						->val('maxlength', 18)
						
						->post('bizchkinv')
						
						->post('bizdecimals')
						->val('maxlength', 18)
						
						->post('bizitemauto')
						
						->post('bizcur')
						->val('maxlength', 3)
						
						->post('bizsupauto')

						->post('xbin')

						->post('xtin')

						->post('xtradelic')

						->post('xrjsc')

						->post('xassocno')
						
						->post('bizdateformat')
						->val('maxlength', 11)
						
						->post('bizyearoffset')
						->val('maxlength', 2);
						
				$form	->submit();
				
				$data = $form->fetch();	
				//print_r($data);die;
				
				//$data['bizid'] = Session::get('sbizid');
				//$data['zemail'] = Session::get('suser');
				$data['zutime'] = date("Y-m-d H:i:s");
				if($tradelicexpdate!="")
				    $data["xtradelicexpdate"]=$tradelicexpdate;
				if($assocexpdate!="")
				    $data["xassocexpdate"]=$assocexpdate;

				$binfilename="";

				$tinfilename="";

				$tradelicfilename="";

				$rjscfilename="";

				$assocfilename=""; 

				$binfile = "";

				$tinfile = "";

				$licfile = "";

				$rjscfile = "";

				$assocfile = "";

				if ($_FILES['xbinimage']["name"]){
					$data['xbinimage'] = "public/images/bizdir/".$_FILES['xbinimage']["name"];
					$binfilename=$_FILES['xbinimage']["name"];
					$binfile = 'public/images/bizdir/'.$data["xbinimage"];
				}
				if($_FILES['xtinimage']["name"]){
					$data['xtinimage'] = "public/images/bizdir/".$_FILES['xtinimage']["name"];
					$tinfilename=$_FILES['xtinimage']["name"];
					$tinfile = 'public/images/bizdir/'.$data["xtinimage"];
				}
				if($_FILES['xtradelicimage']["name"]){
					$data['xtradelicimage'] = "public/images/bizdir/".$_FILES['xtradelicimage']["name"];
					$tradelicfilename=$_FILES['xtradelicimage']["name"];
					$licfile = 'public/images/bizdir/'.$data["xtradelicimage"];
				}
				if($_FILES['xrjscimage']["name"]){
					$data['xrjscimage'] = "public/images/bizdir/".$_FILES['xrjscimage']["name"];
					$rjscfilename=$_FILES['xrjscimage']["name"];
					$rjscfile = 'public/images/bizdir/'.$data["xrjscimage"];
				}
				if($_FILES['xassocimage']["name"]){
					$data['xassocimage'] = "public/images/bizdir/".$_FILES['xassocimage']["name"];
					$assocfilename=$_FILES['xassocimage']["name"]; 
					$assocfile = 'public/images/bizdir/'.$data["xassocimage"];
				}

				$success = $this->model->editBizdefnew($data, $bizid);
				
				
				}catch(Exception $e){
					//echo $e->getMessage();die;
					$result = $e->getMessage();
					
				}finally{
				if($result==""){
				if($success){
					$result = "Edited successfully";
					$file = 'public/images/bizdir/'.$bizid.'.png';

					if ($_FILES['imagefield']["name"]){
						if(file_exists($file))
							unlink($file); 
						
						$imgupload = new ImageUpload();
						$imgupload->store_uploaded_image('public/images/bizdir/','imagefield', 64, 62, $bizid);
					}

					
					
					if ($_FILES['xbinimage']["name"]){
						if(file_exists($binfile))
							unlink($binfile); 
						
						$imgupload = new ImageUpload();
						$imgupload->store_uploaded_originimage('public/images/bizdir/','xbinimage', 800, 650, $binfilename);
					}

					
					
					if ($_FILES['xtinimage']["name"]){
						if(file_exists($tinfile))
							unlink($tinfile); 
						
						$imgupload = new ImageUpload();
						$imgupload->store_uploaded_originimage('public/images/bizdir/','xtinimage', 800, 650, $tinfilename);
					}

					
					
					if ($_FILES['xtradelicimage']["name"]){
						if(file_exists($licfile))
							unlink($licfile); 
						
						$imgupload = new ImageUpload();
						$imgupload->store_uploaded_originimage('public/images/bizdir/','xtradelicimage', 800, 650, $tradelicfilename);
					}

					if ($_FILES['xrjscimage']["name"]){
						if(file_exists($rjscfile))
							unlink($rjscfile); 
						
						$imgupload = new ImageUpload();
						$imgupload->store_uploaded_originimage('public/images/bizdir/','xrjscimage', 800, 650, $rjscfilename);
					}

					if ($_FILES['xassocimage']["name"]){
						if(file_exists($assocfile))
							unlink($assocfile); 
						
						$imgupload = new ImageUpload();
						$imgupload->store_uploaded_originimage('public/images/bizdir/','xassocimage', 800, 650, $assocfilename);
					}

				}
				else
					$result = "Edit failed!";
				
				}
				 $this->showdef($bizid);
				
				}
		}

		public function showdef($result=""){
			$tblvalues=array();
			$btn = array(	
				//"Clear" => URL."bizdefnew/bizdefentry"
			);
			$file = 'public/images/bizdir/'.$result.'.jpg';
			
			$imagename = "";	
			if(file_exists($file))
				$imagename = '../public/images/bizdir/'.$result.'.jpg';
			else
				$imagename = '../public/images/bizdir/directory.png';
			
			$this->view->filename = $imagename;
			
			$tblvalues = $this->model->getSingleDef($result);
			
			if(empty($tblvalues))
				$tblvalues=$this->values;
			else
				$tblvalues=$tblvalues[0];
				
				$dynamicForm = new Dynamicform("New Business", $btn, $result);		
				
				$this->view->dynform = $dynamicForm->createForm($this->fields, URL."bizdefnew/editbizdefnew", "Edit",$tblvalues,"","","imagefield");
				//$this->fields, URL."stufaculty/editfaculty/".$tchr, "Edit",$tblvalues ,URL."stufaculty/showpost","","imagefield"
				
				$this->view->table = "";//$this->renderTable();
				
				$this->view->renderpage('bizdefnew/defentry');
			}

			public function showeditdef($result=""){
			$tblvalues=array();
			$btn = array(
				//"Clear" => URL."bizdefnew/bizdefentry"
			);
			$file = 'public/images/bizdir/'.$result.'.jpg';
			
			$imagename = "";	
			if(file_exists($file))
				$imagename = '../../../public/images/bizdir/'.$result.'.jpg';
			else
				$imagename = '../../../public/images/bizdir/directory.png';
			
			$this->view->filename = $imagename;
			
			$tblvalues = $this->model->getSingleDef($result);
			
			if(empty($tblvalues))
				$tblvalues=$this->values;
			else
				$tblvalues=$tblvalues[0];
				
				$dynamicForm = new Dynamicform("New Business", $btn, $result);		
				
				$this->view->dynform = $dynamicForm->createForm($this->fields, URL."bizdefnew/editbizdefnew", "Edit",$tblvalues,"","","imagefield");
				//$this->fields, URL."stufaculty/editfaculty/".$tchr, "Edit",$tblvalues ,URL."stufaculty/showpost","","imagefield"
				
				$this->view->table = "";//$this->renderTable();
				
				$this->view->renderpage('bizdefnew/defentry');
			}


			function bizdefentry(){
				
			$btn = array(
				"Clear" => URL."bizdefnew/bizdefentry"
			);

			// form data
			
				$dynamicForm = new Dynamicform("New Business",$btn);		
				$imagename = '../images/products/noimage.jpg';
				
				$this->view->filename = $imagename;
				$this->view->dynform = $dynamicForm->createForm($this->fields, URL."bizdefnew/savebizdefnew", "Save",$this->values, "","","imagefield");
				
				$this->view->table = "";
				
				$this->view->renderpage('bizdefnew/defentry', false);
		}

		function bizdeflist(){
			
			$this->view->table = $this->itemTable();
			
			$this->view->renderpage('bizdefnew/customerlist', false);
		}

		function itemTable(){
			$fields = array(
						"bizid-Bizid",
						"bizshort-Short Name",
						"bizlong-Long Name",
						"bizadd1-Address 1",
						"bizadd2-Address 2",
						);
			$table = new Datatable();
			$row = $this->model->getBizByLimit();
			
			return $table->createTable($fields, $row, "bizid", URL."bizdefnew/showeditdef/");
		}
		
			public function index(){
		
		
				$btn = array(
					"Clear" => URL."stufaculty/stufacultyentry",
				);	
				
				
				// form data
				
					$dynamicForm = new Dynamicform("New Business",$btn);		
					
					$this->view->dynform = $dynamicForm->createForm($this->fields, URL."stufaculty/savefaculty", "Save",$this->values,URL."stufaculty/showpost","imagefield");
					
					//$this->view->table = $this->renderTable();
					
					$this->view->rendermainmenu('bizdefnew/index');
					
				}
		
		
}