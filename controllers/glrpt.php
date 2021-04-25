<?php 
class Glrpt extends Controller{
	
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
				if($menus["xsubmenu"]=="GL Reports")
					$iscode=1;				
		}
		if($iscode==0)
			header('location: '.URL.'mainmenu');
			
		$this->view->js = array('public/js/datatable.js','views/distreg/js/codevalidator.js','views/glrpt/js/getaccdt.js');
								
		}
		
		public function index(){
					
			
			$this->view->rendermainmenu('glrpt/index');
			
		}
		
		

		function glrptmenu(){

            $icon_array = array(
                "Deposit Report"=>"fas fa-lira-sign",
				"Expense Report"=>"fas fa-hand-holding-usd",
				"Yearly Deposit Report"=>"fas fa-money-check-alt",
				"Report Summary"=>"fas fa-file-invoice-dollar",
            );
			
			$menuarr = array(
			"Ledger" => array("Deposit Report"=>URL."glrpt/ledger","Expense Report"=>URL."glrpt/expreport","Yearly Deposit Report"=>URL."glrpt/monthwisedep","Report Summary"=>URL."glrpt/rptsummary"),
			);
			// $menutable='<table class="table" style="width:100%"><tbody>';
			$menutable='
			  <link rel="stylesheet" href="'. URL.'/public/mdb/css/bootstrap.min.css">
			  <link rel="stylesheet" href="'.URL.'/public/mdb/css/mdb.min.css">
			  <link rel="stylesheet" href="'.URL.'/public/mdb/css/style.css">
			  <script  rel="stylesheet" src="'.URL.'/public/mdb/js/mdb.min"></script>
			  <script  rel="stylesheet" src="'.URL.'/public/mdb/js/popper.js"></script>
			  <link rel="stylesheet" href="'.URL.'/public/mdb/css/style.css">
			  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
			  <div class="row">';

			$count=1;
			foreach($menuarr as $key=>$value){
               // $menutable.='<p style="width: 100%;padding: 5px 22px; background: #3c8dbc; color: #fff;font-size: 16px;"><i class="fas fa-book"></i> '.$key.'</p>';
                foreach($value as $k=>$val){
                    $menutable.='<div class="col-md-3 mb-4">
                                    <div class="card card-cascade">
                                      <div class="view view-cascade gradient-card-header bg-info">
                                      <a href="'.$val.'">
                                        <h2 class="card-header-title mb-3 mt-3  text-center text-white">'.$k.'</h2>
                                        </a>
                                      </div>
                                      <div class="card-body card-body-cascade text-center">
                                         <a class="px-2 fa-lg tw-ic">';
                                            $menutable .= '<i class="'.$icon_array[$k].' fa-5x" style="color: #33b5e5;"> </i>';
//
                        $menutable .= ' </a>
                                        <hr>
                                        <a href="'.$val.'" class="px-2 fa-lg email-ic"><i class="fas fa-angle-double-right ml-"> </i>  Click Here</a>
                                   
                                      </div>
                                    
                                    </div></div>';

                }
			}

            $menutable.='</div>';
			$this->view->table = $menutable;
			$this->view->renderpage('glrpt/glrptmenu', false);
		}

		function ledger(){
			$this->view->breadcrumb = '<ul class="breadcrumb">
							<li><a href="'.URL.'glrpt/glrptmenu">GL Reports</a></li>
							<li class="active">Deposit Report</li>
						   </ul>';
			$btn = array(
				"Reset" => URL."glrpt/ledger",
			);	
			$dt = date("Y/m/d");
			
			$values = array(
				"xfdate"=>$dt,
				"xtdate"=>$dt,
				"xacc"=>"",
				"xaccdesc"=>"",
				"xsite"=>""	
				);
				
				$fields = array(
							array(
								"xfdate-datepicker~4" => 'From Date_""',
								"xtdate-datepicker~4" => 'To Date_""',								
								)
							);
				
				$dynamicForm = new Dynamicform("Deposit Report",$btn);		
				
				$this->view->dynform = $dynamicForm->createFormNew($fields, URL."glrpt/showledger", "Show Report",$values);
				
				$this->view->renderpage('glrpt/glrptfilter', false);
		
		}

		public function showledger(){
		
			$this->view->breadcrumb = '<ul class="breadcrumb">
							<li><a href="'.URL.'glrpt/glrptmenu">GL Reports</a></li>
							<li><a href="'.URL.'glrpt/ledger">Deposit Report</a></li>
							<li class="active">Deposit Report</li>
						   </ul>';
		
			$xfdate = $_POST['xfdate'];
			$fdt = str_replace('/', '-', $xfdate);
			$fdate = date('Y-m-d', strtotime($fdt));
			
			$xtdate = $_POST['xtdate'];
			$tdt = str_replace('/', '-', $xtdate);
			$tdate = date('Y-m-d', strtotime($tdt));
				
			$tblvalues=array();
			$btn = array(
				"Reset" => URL."glrpt/ledger",
			);
			
			$row = $this->model->getDeposit($fdate, $tdate);
			
			$tblsettings = array(
				"columns"=>array("0"=>"Date",1=>"Voucher No",2=>"Member",3=>"Narration",4=>"Amount"),
				"buttons"=>array(),
				"urlvals"=>array(),
				"sumfields"=>array("xamount"),
				);
			$table = new ReportingTable();
			
			$this->view->vfdate = "From ".$fdt." To ".$tdt;
			$this->view->vrptname = "Deposit Report";
			$this->view->org=Session::get('sbizlong');
			
			$this->view->table = $table->reportingtbl($tblsettings, $row);
				
			$this->view->renderpage('glrpt/reportpage');
		}

		function expreport(){
			$this->view->breadcrumb = '<ul class="breadcrumb">
							<li><a href="'.URL.'glrpt/glrptmenu">GL Reports</a></li>
							<li class="active">Expense Report</li>
						   </ul>';
			$btn = array(
				"Reset" => URL."glrpt/expreport",
			);	
			$dt = date("Y/m/d");
			
			$values = array(
				"xfdate"=>$dt,
				"xtdate"=>$dt,
				"xacc"=>"",
				"xaccdesc"=>"",
				"xsite"=>""	
				);
				
				$fields = array(
							array(
								"xfdate-datepicker~4" => 'From Date_""',
								"xtdate-datepicker~4" => 'To Date_""',								
								)
							);
				
				$dynamicForm = new Dynamicform("Expense Report",$btn);		
				
				$this->view->dynform = $dynamicForm->createFormNew($fields, URL."glrpt/showexpreport", "Show Report",$values);
				
				$this->view->renderpage('glrpt/glrptfilter', false);
		
		}

		public function showexpreport(){
		
			$this->view->breadcrumb = '<ul class="breadcrumb">
							<li><a href="'.URL.'glrpt/glrptmenu">GL Reports</a></li>
							<li><a href="'.URL.'glrpt/expreport">Expense Report</a></li>
							<li class="active">Expense Report</li>
						   </ul>';
		
			$xfdate = $_POST['xfdate'];
			$fdt = str_replace('/', '-', $xfdate);
			$fdate = date('Y-m-d', strtotime($fdt));
			
			$xtdate = $_POST['xtdate'];
			$tdt = str_replace('/', '-', $xtdate);
			$tdate = date('Y-m-d', strtotime($tdt));
				
			$tblvalues=array();
			$btn = array(
				"Reset" => URL."glrpt/expreport",
			);
			
			$row = $this->model->getExpense($fdate, $tdate);
			
			$tblsettings = array(
				"columns"=>array("0"=>"Date",1=>"Voucher No",2=>"Type",3=>"Narration",4=>"Amount"),
				"buttons"=>array(),
				"urlvals"=>array(),
				"sumfields"=>array("xamount"),
				);
			$table = new ReportingTable();
			
			$this->view->vfdate = "From ".$fdt." To ".$tdt;
			$this->view->vrptname = "Expense Report";
			$this->view->org=Session::get('sbizlong');
			
			$this->view->table = $table->reportingtbl($tblsettings, $row);
				
			$this->view->renderpage('glrpt/reportpage');
		}	

	function monthwisedep(){
		$this->view->breadcrumb = '<ul class="breadcrumb">
						<li><a href="'.URL.'glrpt/glrptmenu">GL Reports</a></li>
						<li class="active">Yearly Member Deposit Report</li>
					   </ul>';
		$btn = array(
			"Reset" => URL."glrpt/monthwisedep",
		);	
		$dt = date("Y");
		
		$values = array(
			"xyear"=>$dt
			);
			
			$fields = array(
						array(
							"xyear-select_Year" => 'Year_""'						
							)
						);
			
			$dynamicForm = new Dynamicform("Yearly Member Deposit Report",$btn);		
			
			$this->view->dynform = $dynamicForm->createFormNew($fields, URL."glrpt/showmonthwisedep", "Show Report",$values);
			
			$this->view->renderpage('glrpt/glrptfilter', false);
	
	}

	public function showmonthwisedep(){
		
		$this->view->breadcrumb = '<ul class="breadcrumb">
						<li><a href="'.URL.'glrpt/glrptmenu">GL Reports</a></li>
						<li><a href="'.URL.'glrpt/monthwisedep">Yearly Member Deposit Report</a></li>
						<li class="active">Yearly Member Deposit Report</li>
					   </ul>';
	
		$xyear = $_POST['xyear'];
			
		$tblvalues=array();
		$btn = array(
			"Reset" => URL."glrpt/monthwisedep",
		);
		
		$this->view->vfdate = "Year : ".$xyear;
		$this->view->vrptname = "Yearly Member Deposit Report";
		$this->view->org=Session::get('sbizlong');
		
		$this->view->table = $this->monthwiserpt($xyear);
			
		$this->view->renderpage('glrpt/reportpage');
	}

	function monthwiserpt($xyear){
		$memberdt = $this->model->getMemberdt();
		//print_r($memberdt);die;
		
		$table = '<div class="table-responsive"><table class="table table-bordered table-striped" style="width:100%">';
		$table.='<thead>';
		$table.='<tr>';
		$table.='<th class="text-center">Member</th><th class="text-center">Reg. fee</th><th class="text-center">Jan</th><th class="text-center">Feb</th><th class="text-center">Mar</th><th class="text-center">Apr</th><th class="text-center">May</th><th class="text-center">Jun</th><th class="text-center">Jul</th><th class="text-center">Aug</th><th class="text-center">Sep</th><th class="text-center">Oct</th><th class="text-center">Nov</th><th class="text-center">Dec</th><th class="text-center">Yearly</th><th>Total</th>';
		
		$memyrdep = $this->model->getMemberYearDeposit($xyear);
		$memreg = $this->model->getMemberReg($xyear);
		//print_r($memreg);
		
		$table.='</tr>';
		$table.='</thead>';
		$table.='<tbody>'; 

		
		$m=0;
		$month1 = 0;
		$month2 = 0;
		$month3 = 0;
		$month4 = 0;
		$month5 = 0;
		$month6 = 0;
		$month7 = 0;
		$month8 = 0;
		$month9 = 0;
		$month10 = 0;
		$month11 = 0;
		$month12 = 0;
		$yertotal = 0;
		$yrdeptotal = 0;
		$regtotal = 0;
		foreach($memberdt as $key=>$value){
			$membeposit = $this->model->getMemberDeposit($value['xmember'], $xyear);
			$found = array_search($value['xmember'], array_column($memreg, 'xmember'));
			$found_key = array_search($value['xmember'], array_column($memyrdep, 'xmember'));
			//var_dump($found_key);
			
			$memtotal = 0;
			
			$table.='<tr>';
				$table.='<td>'.$value['xmemidname'].'</td>';
				if(is_int($found)){
					$memtotal += $memreg[$found]['xamount'];
					$yertotal += $memreg[$found]['xamount'];
					$yrdeptotal += $memreg[$found]['xamount'];
					$regtotal += $memreg[$found]['xamount'];
					$table.='<td class="text-right">'.$memreg[$found]['xamount'].'</td>';	
				}else{
					$table.='<td class="text-right">0</td>';
				}
				if(!empty($membeposit)){
					$i=1;
					$m=0;
					while($i <= 12){
						if($membeposit[$m]['xmonth']==$i){
							if($i==1)
								$month1 += $membeposit[$m]['xamount'];
							elseif($i==2)
								$month2 += $membeposit[$m]['xamount'];
							elseif($i==3)
								$month3 += $membeposit[$m]['xamount'];
							elseif($i==4)
								$month4 += $membeposit[$m]['xamount'];
							elseif($i==5)
								$month5 += $membeposit[$m]['xamount'];
							elseif($i==6)
								$month6 += $membeposit[$m]['xamount'];
							elseif($i==7)
								$month7 += $membeposit[$m]['xamount'];
							elseif($i==8)
								$month8 += $membeposit[$m]['xamount'];
							elseif($i==9)
								$month9 += $membeposit[$m]['xamount'];
							elseif($i==10)
								$month10 += $membeposit[$m]['xamount'];
							elseif($i==11)
								$month11 += $membeposit[$m]['xamount'];
							elseif($i==12)
								$month12 += $membeposit[$m]['xamount'];

							//echo $m."Test</br>";
							$memtotal += $membeposit[$m]['xamount'];
							$yertotal += $membeposit[$m]['xamount'];
							$table.='<td class="text-right">'.$membeposit[$m]['xamount'].'</td>';
							if($m < count($membeposit)-1)
								$m++;
						}else{
							$table.='<td class="text-right">0</td>';
						}
						$i++;
					}

					if(is_int($found_key)){
						$memtotal += $memyrdep[$found_key]['xamount'];
						$yertotal += $memyrdep[$found_key]['xamount'];
						$yrdeptotal += $memyrdep[$found_key]['xamount'];
						$table.='<td class="text-right">'.$memyrdep[$found_key]['xamount'].'</td>';	
					}else{
						$table.='<td class="text-right">0</td>';
					}

					$table.='<td class="text-right"><strong>'.$memtotal.'</strong></td>';
				}else{
					$i=1;
					while($i <= 12){
						$table.='<td class="text-right">0</td>';
						$i++;
					}
					if(is_int($found_key)){
						$memtotal += $memyrdep[$found_key]['xamount'];
						$yertotal += $memyrdep[$found_key]['xamount'];
						$yrdeptotal += $memyrdep[$found_key]['xamount'];
						$table.='<td class="text-right">'.$memyrdep[$found_key]['xamount'].'</td>';	
					}else{
						$table.='<td class="text-right">0</td>';
					}
					$table.='<td class="text-right"><strong>'.$memtotal.'</strong></td>';
				}
			
				
			$table.='</tr>';
		}
		$table.='</tbody>';
		$table.='<tfoot>';
		$table.='<tr>';
		$table.='<td class="text-center"><strong>Total</strong></td><td class="text-right"><strong>'.$regtotal.'</strong></td><td class="text-right"><strong>'.$month1.'</strong></td><td class="text-right"><strong>'.$month2.'</strong></td><td class="text-right"><strong>'.$month3.'</strong></td><td class="text-right"><strong>'.$month4.'</strong></td><td class="text-right"><strong>'.$month5.'</strong><td class="text-right"><strong>'.$month6.'</strong></td><td class="text-right"><strong>'.$month7.'</strong></td><td class="text-right"><strong>'.$month8.'</strong></td><td class="text-right"><strong>'.$month9.'</strong></td><td class="text-right"><strong>'.$month10.'</strong></td><td class="text-right"><strong>'.$month11.'</strong></td><td class="text-right"><strong>'.$month12.'</strong></td><td class="text-right"><strong>'.$yrdeptotal.'</strong></td><td class="text-right"><strong>'.$yertotal.'</strong></td>';
		$table.='</tr>';
		$table.='</tfoot>';
		$table.='</table></div>';
		return $table;
	}

	function rptsummary(){
		$this->view->breadcrumb = '<ul class="breadcrumb">
						<li><a href="'.URL.'glrpt/glrptmenu">GL Reports</a></li>
						<li class="active">Report Summary</li>
					   </ul>';
		$btn = array(
			"Reset" => URL."glrpt/rptsummary",
		);	
		$month = date('F');
		$year = date("Y");
		
		$values = array(
			"xmonth"=>$month,
			"xyear"=>$year
			);
			
			$fields = array(
						array(
							"xmonth-select_Month" => 'Select Month*~red_""',
							"xyear-select_Year" => 'Select Year*~red_""'						
							)
						);
			
			$dynamicForm = new Dynamicform("Month Wise Report Summary",$btn);		
			
			$this->view->dynform = $dynamicForm->createFormNew($fields, URL."glrpt/showrptsummary", "Show Report",$values);
			
			$this->view->renderpage('glrpt/glrptfilter', false);
	
	}

	public function showrptsummary(){
		
		$this->view->breadcrumb = '<ul class="breadcrumb">
						<li><a href="'.URL.'glrpt/glrptmenu">GL Reports</a></li>
						<li><a href="'.URL.'glrpt/rptsummary">Report Summary</a></li>
						<li class="active">Report Summary</li>
					   </ul>';
	
		$xmonth = $_POST['xmonth'];
		$xyear = $_POST['xyear'];
			
		$tblvalues=array();
		$btn = array(
			"Reset" => URL."glrpt/rptsummary",
		);

		$this->view->vfdate = $xmonth.", ".$xyear;
		$this->view->vrptname = "Month Report Summary";
		$this->view->org=Session::get('sbizlong');
		
		$this->view->table = $this->ledgerTable($xmonth, $xyear);
			
		$this->view->renderpage('glrpt/reportpage');
	}

	public function ledgerTable($xmonth, $xyear){

		$date = $xmonth.' 01 '.$xyear;
		$xdate = date('Y-m-d', strtotime($date));
		$month = date('n', strtotime($xmonth));
		$opbal = $this->model->getOpbal($xdate)[0]['xbal'];
		$gettr = $this->model->getTransection($month, $xyear);
		//print_r($gettr);
		//echo $opbal;die;
		$table = '<table class="table table-striped table-bordered" cellspacing="0" width="100%">';
		$table.='<thead>';
		$table.='<tr>';
		$table.='<th>Purpose</th><th class="text-center">Type</th><th class="text-center">Income</th><th class="text-center">Expense</th><th class="text-center">Balance</th>';
		$baldr = 0;
		$balcr = 0;
		$bal = $opbal;
		$table.='</tr>';
		$table.='</thead>';
		$table.='<tbody>';
		$table.='<tr>';
		$table.='<td class="text-center"><strong>Opening Balance</strong></td><td></td>';

			if($bal>=0)
				$table.='<td class="text-right"><strong>'.number_format(floatval($bal), 2, '.', '').'</strong></td>';
			else
				$table.='<td class="text-right"><strong>0.00</strong></td>';
		
			if($bal<0)
				$table.='<td class="text-right"><strong>'.number_format(floatval(abs($bal)), 2, '.', '').'</strong></td>';
			else
				$table.='<td class="text-right"><strong>0.00</strong></td>';

			if($bal>=0)
				$table.='<td class="text-right"><strong>'.number_format(floatval($bal), 2, '.', '').'</strong></td>';
			else
				$table.='<td class="text-right"><strong>('.number_format(floatval(abs($bal)), 2, '.', '').')</strong></td>';
		
		foreach($gettr as $key=>$value){
						
			$table.='<tr>';
			$table.='<td>'.$value['xpurpose'].'</td><td>'.$value['xdoctype'].'</td>';
			if($value['xamount'] >= 0){
				$bal += $value['xamount'];
				$baldr += $value['xamount'];
				$table.='<td class="text-right">'.number_format(floatval($value['xamount']), 2, '.', '').'</td>';
			}else{
				$table.='<td class="text-right">0.00</td>';
			}
			if($value['xamount'] < 0){
				$bal += $value['xamount'];
				$balcr += $value['xamount'];
				$table.='<td class="text-right">'.number_format(floatval(abs($value['xamount'])), 2, '.', '').'</td>';
			}else{
				$table.='<td class="text-right">0.00</td>';
			}

			if($bal>=0)
				$table.='<td class="text-right">'.number_format(floatval($bal), 2, '.', '').'</td>';
			else
				$table.='<td class="text-right">('.number_format(floatval(abs($bal)), 2, '.', '').')</td>';
			$table.='</tr>';
		}
		$table.='</tbody>';
		$table.='<tfoot><tr>';
			$table.='<td><strong>Total</strong></td><td></td>';
			$table.='<td class="text-right"><strong>'.number_format(floatval($baldr), 2, '.', '').'</strong></td>';
			$table .= '<td class="text-right"><strong>' . number_format(floatval(abs($balcr)), 2, '.', '') . '</strong></td>';

			if($bal>=0)
				$table.='<td class="text-right"><strong>'.number_format(floatval($bal), 2, '.', '').'</strong></td>';
			else
				$table.='<td class="text-right"><strong>('.number_format(floatval(abs($bal)), 2, '.', '').')</strong></td>';
		$table.='</tr></tfoot>';
		$table.='</table>';
		
		return $table;	
	}

	function getYear($type){
		$this->model->getYear($type);
	}
}