<?php
class Viewatt extends Controller{
	
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
				if($menus["xsubmenu"]=="Daily Attendance Report")
					$iscode=1;				
		}
		if($iscode==0)
			header('location: '.URL.'mainmenu');
			
		$this->view->js = array('public/js/datatable.js','views/distreg/js/codevalidator.js');
		$dt = date("Y/m/d");		
		$date = date('Y-m-d', strtotime($dt));
		$year = date('Y',strtotime($date));
		$month = date('M',strtotime($date));
		$this->values = array(
			
			"xdate"=>$dt,
			);
			$this->fields = array(
						array(
							"xdate-datepicker" => 'Date_""'
							
							)		
						);
			
			 	
		}
		
		public function index(){
			$btn = array(
				"Clear" => URL."viewatt/stuattentry",
			);
			$this->view->rendermainmenu('viewatt/index');
		}

		
		
		function studentlist(){
			
			if(empty($_POST['xdate'])){
				header ('location: '.URL.'viewatt/stuattentry');
				exit;
			}

			$dt = $_POST['xdate'];
			$dat = str_replace('/', '-', $dt);
			$date = date('Y-m-d', strtotime($dat));

			//$date = date('Y-d-m', strtotime($dt));
			
			
			$frmvalues=array(
					"xdate"=>$date,
									
					);
		
			$this->view->org=Session::get('sbizlong');
			
			
			$dynamicForm = new Dynamicform("Filter Students",array());

			$this->view->dynform = $dynamicForm->createForm($this->fields,"","",$frmvalues, URL."viewatt/studentlist");
			
			$studentatt=$this->model->getClassAttended($date);
			//print_r($studentatt);
		  	$this->view->atttable=$this->renderTable($studentatt);
			
			$this->view->renderpage('viewatt/stuattentry', false);
		}
		
		function stuattentry(){
				
		$btn = array(
			"Clear" => URL."viewatt/stuattentry"
		);
		
			$dynamicForm = new Dynamicform("Filter Students",$btn);		
			
			$this->view->dynform = $dynamicForm->createForm($this->fields,"","",$this->values, URL."viewatt/studentlist");
			
			$this->view->atttable="";
			
			$this->view->renderpage('viewatt/stuattentry', false);
		}

		function renderTable($row){

				$date="";

			foreach ($row as $key => $value) 
				{

					
					$date = $value['xdate'];
					
				}
			$table = '<table class="table table-bordered table-striped" style="width:100%">';
			$table.='<header style="font-size: 20px; text-align:center; margin-bottom:5px; font-weight:bold;">Daily Attendance Report</header>';
			$table.='<div>';
			$table.='<div style="text-align:center; font-weight:bold;">Date: '.$date.' </div>';
			$table.='</div>';
			$table.='<thead>';
			$table.='<tr><th>Employee ID</th><th>Name</th><th>Present?</th><th>Time</th></tr>';
			$table.='</thead>';
			$table.='<tbody>';
			
			foreach ($row as $key => $value) {
				
			  	if($value['xdevice']=="Manual"){
			  		$table.='<tr>';
			   		$table.='<td>'.$value['xfacultyid'].'</td>';
			  		$table.='<td>'.$value['xname'].'</td>';
					if($value['xattflag'] == "Present"){
						$table.='<td>Present</td>';
					}else if($value['xattflag'] == "Late"){
						$table.='<td>Late</td>';
					}
					else if($value['xattflag'] == "Absent"){
						$table.='<td>Absent</td>';
					}
					$table.='<td>'.$value['xtime'].'</td>';
			  		
			  		$table.='</tr>';
			  	}
			}
			
			$table.='</tbody>';
			$table.='</table>';
			return $table;
		}
		public function getatt(){
			$this->model->getClassAttended("Three","Section A","Day","2018-03-21");
		}
		
}