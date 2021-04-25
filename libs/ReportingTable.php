<?php

class ReportingTable{
	
	private $decimals="";
	
	public function __construct(){
		$this->decimals = Session::get("sbizdecimals");
	}
	/*
		Sample parameters for reportingtbl();
		
		$tblsettings = array(
							"columns"=>array("0"=>"ID",1=>"Address",2=>"Phone",3=>"Fees",4=>"Count"),
							"buttons"=>array("Show"=>URL."test/","Delete"=>URL."test/"),
							"urlvals"=>array("id","phone"),
							"sumfields"=>array("fees","count"),
							);
							
		$rows = array(0=>array("id"=>"1001","add"=>"Abdul Wahab","phone"=>"01827366502","fees"=>350,"count"=>2),
					  1=>array("id"=>"1002","add"=>"Shamsun Nahar","phone"=>"01826579376","fees"=>435,"count"=>4));
		
	**/
	public function reportingtbl($tblsettings,$rows){
		
		$columncount = 0;
		$colexist = false;
		$buttonexist = false;
		if(array_key_exists("columns",$tblsettings)){
			$columncount = count($tblsettings["columns"]);
			$colexist = true;
		}
		if(array_key_exists("buttons",$tblsettings)){
			$columncount = $columncount+count($tblsettings["buttons"]);
			$buttonexist = true;
		}
		$table="";
		
		$table.= '<div class="table-responsive"><table class="table table-bordered table-striped">';
			$table.='<thead>';
				$table.='<tr>';
				for($i=0; $i<$columncount; $i++){
					if($colexist){
					if(array_key_exists($i,$tblsettings["columns"]))
						$table.='<th>'.$tblsettings["columns"][$i].'</th>';
					else
						$table.='<th></th>';
					}
				}			
				$table.='</tr>';
			$table.='</thead>';
			$table.='<tbody>';
			if(count($rows)>0){	
				for($j=0; $j<count($rows); $j++){
				$table.='<tr>';					
						foreach($rows[$j] as $key=>$value){
							if($key == "xamount")
								$table.='<td class="text-right">'.$value.'</td>';
							else
								$table.='<td>'.$value.'</td>';
						}
						if($buttonexist){
							foreach($tblsettings["buttons"] as $key=>$value){
								$urlval = "";
								if(array_key_exists("urlvals",$tblsettings)){
									foreach($tblsettings["urlvals"] as $vals){
										$urlval .= $rows[$j][$vals]."/"; 
									}
								}
								$urlval=rtrim($urlval,"/");
								$table.='<td><a class="btn btn-info" href="'.$value.$urlval.'" role="button">'.$key.'</a></td>';
							}
						}
				$table.='</tr>';		
				}
			}
			$table.='</tbody>';
			if(array_key_exists("sumfields",$tblsettings)){
			$table.='<tfoot>';
				$table.='<tr>';
					
						$i=0;
					if(!empty($rows)){	
						foreach($rows[0] as $k=>$v){
							if($i==0)
								$table.='<td><strong>'."Total".'</strong></td>';							
							elseif(in_array($k,$tblsettings["sumfields"])){
									$table.='<td class="text-right"><strong>'.array_sum(array_column($rows,$k)).'</strong></td>';								
							}else
								$table.='<td></td>';
							$i++;
						}
					}
						if(array_key_exists("buttons",$tblsettings))
							for($b=0; $b<count($tblsettings["buttons"]); $b++)
								$table.='<td></td>';
				
				$table.='</tr>';
			$table.='</tfoot>';
			}			
		$table.= '</table></div>';
		return $table;	
	}
	
	/*$tblsettings = array(
	"columns"=>array("0"=>"ID",1=>"Address",2=>"Phone",3=>"Fees",4=>"Count"), //column names
	"groupfield"=>"Account~xacc",
	"grouprecords"=>array("Description~xaccdesc","Date~xdate"), //database records columns to show in group
	"detailsection"=>array("xitemcode","xitemdesc","xqty","xratepor","xunitpur","xtotal"),
	"buttons"=>array("Show"=>URL."test/","Delete"=>URL."test/"),
	"urlvals"=>array("id","phone"),
	"sumfields"=>array("fees","count"),
	);*/
				

	public function SingleGroupReportingtbl($tblsettings,$rows){
		
		$grouprec = [];

		$groupby = explode("~", $tblsettings["groupfield"]); 
		
		foreach($rows as $key=>$value){
			$keyval = $value[$groupby[1]];
			$grouprec[$keyval][]=$value;
		}

		$columncount = 0;
		$colexist = false;
		$buttonexist = false;
		if(array_key_exists("columns",$tblsettings)){
			if(!empty($tblsettings["columns"])){
				$columncount = count($tblsettings["columns"]);
				$colexist = true;
			}
		}
		if(array_key_exists("buttons",$tblsettings)){
			if(!empty($tblsettings["buttons"])){
				$columncount = $columncount+count($tblsettings["buttons"]);
				$buttonexist = true;
			}
		}
		$table="";
		
		$table.= '<table id="grouptable" border="1" class="table table-bordered table-striped">';
			$table.='<thead>';
				$table.='<tr>';
				for($i=0; $i<$columncount; $i++){
					if($colexist){
					if(array_key_exists($i,$tblsettings["columns"]))
						$table.='<th>'.$tblsettings["columns"][$i].'</th>';
					else
						$table.='<th></th>';
					}
				}			
				$table.='</tr>';
			$table.='</thead>';
			$table.='<tbody>';
			foreach($grouprec as $gkey=>$gval){
				
				$table.='<tr><td colspan='.$columncount.'><strong>'.$groupby[0].' :</strong>'.$gkey.'</td>';
				
				
				
				$table.='</tr>';

				if(!empty($tblsettings["grouprecords"])){					
					for($i=0; $i<count($tblsettings["grouprecords"]); $i++){
						$groupbynext=explode("~",$tblsettings["grouprecords"][$i]);
						$table .= '<tr><td colspan='.$columncount.'><strong>'.$groupbynext[0].' :</strong>'.$gval[0][$groupbynext[1]].'</td>';
						
						$table.='</tr>';
					}
				}

				if(count($gval)>0){	
					for($j=0; $j<count($gval); $j++){
					$table.='<tr>';					
							
							foreach($tblsettings["detailsection"] as $details){
								if(is_numeric($gval[$j][$details]) && $details!="xqty" && $details!="xqtypo" && $details!="xqtyso")
									$table.='<td>'.number_format(floatval($gval[$j][$details]), $this->decimals, '.', '').'</td>';
								else
									$table.='<td>'.$gval[$j][$details].'</td>';
							}
							if($buttonexist){
								foreach($tblsettings["buttons"] as $key=>$value){
									$urlval = "";
									if(array_key_exists("urlvals",$tblsettings)){
										foreach($tblsettings["urlvals"] as $vals){
											$urlval .= $rows[$j][$vals]."/"; 
										}
									}
									$urlval=rtrim($urlval,"/");
									$table.='<td><a class="btn btn-info" href="'.$value.$urlval.'" role="button">'.$key.'</a></td>';
								}
							}
					$table.='</tr>';		
					}
				}

				$table.='<tr>';
					
						$i=0;
						if(!empty($tblsettings["sumfields"]) && !empty($gval)){
							
							foreach($tblsettings["detailsection"] as $details){
								
								if($i==0)
									$table.='<td><strong>'."Total".'</strong></td>';
								elseif(in_array($details,$tblsettings["sumfields"])){
										$table.='<td><strong>'.array_sum(array_column($gval,$details)).'</strong></td>';
									}else{										
										$table.='<td></td>';
									}
									$i++;
								}
							
						}
						if(array_key_exists("buttons",$tblsettings))
							for($b=0; $b<count($tblsettings["buttons"]); $b++)
								$table.='<td></td>';
				
				$table.='</tr>';
			}
			$table.='</tbody>';
			if(array_key_exists("sumfields",$tblsettings)){
			$table.='<tfoot style="display: table-row-group;">';
				$table.='<tr>';
					
						$i=0;
						if(!empty($tblsettings["sumfields"]) && !empty($gval)){
							
							foreach($tblsettings["detailsection"] as $details){
								if($i==0)
									$table.='<td><strong>'."Report Total".'</strong></td>';
								elseif(in_array($details,$tblsettings["sumfields"])){
										$total = 0;
										foreach($grouprec as $kkey=>$kval){
											$total+=array_sum(array_column($kval,$details));
										}
										$table.='<td><strong>'.$total.'</strong></td>';
									}else{										
										$table.='<td></td>';
									}
									$i++;
							}
						}
						if(array_key_exists("buttons",$tblsettings))
							for($b=0; $b<count($tblsettings["buttons"]); $b++)
								$table.='<td></td>';
				
				$table.='</tr>';
			$table.='</tfoot>';
			}			
		$table.= '</table>';
		return  $table;	
	}


	public function itemledgerTable($fields, $row, $keyval, $opbal, $item, $itemdesc){
		
				
		$head = array();
		foreach($fields as $str){
			$st=explode('-',$str);
			
			$head[] = $st[1];
		}
		$table = '<table id="grouptable" class="table table-striped table-bordered" cellspacing="0" width="100%">';
		$table.='<thead>';
		$table.='<tr>';
		foreach($head as $hd){
			$table.='<th>'.$hd.'</th>';
		}
		$table.='<th>Balance</th>';
		$baldr = 0;
		$balcr = 0;
		$bal = $opbal;
		$table.='</tr>';
		$table.='</thead>';
		$table.='<tbody>';
		$table.='<tr>';
			$table.='<td><strong>'.$item.'</strong></td><td><strong>'.$itemdesc.'</strong></td><td></td><td></td><td></td><td></td><td></td>';
		$table.='</tr>';
		$table.='<tr>';
			
			$xcol = 0;
			foreach($head as $hd){
				if($hd=="Receive"){
					if($bal>=0)
						$table.='<td><strong>'.$bal.'</strong></td>';
					else
						$table.='<td><strong>0</strong></td>';
				}
				else if($hd=="Issue"){
					if($bal<0)
						$table.='<td><strong>'.$bal.'</strong></td>';
					else
						$table.='<td><strong>0</strong></td>';
				}
				else{
					
					if($xcol==3)
						$table.='<td><strong>Opening Balance</strong></td>';
					else
						$table.='<td></td>';
				}
				$xcol++;	
			}
			
			$table.='<td></td></tr>';
		
		foreach($row as $key=>$value){
						
			$table.='<tr>';
			
			foreach($value as $str){
				$keyofval =  array_search($str, $value); 
					switch ($keyofval){						
						case "xbal":
							$str = number_format(floatval($str), 0, '.', '');
							break;
						case "xtotcost":
							$str = number_format(floatval($str), $this->decimals, '.', '');
							break;						
						case "xqtydr":							
							$bal+=$str;
							$baldr+=$str;
							break;	
						case "xqtycr":
							//$str = number_format(floatval($str), $this->decimals, '.', '');
							$bal-=$str;
							$balcr+=$str;
							break;		
						default:
							$str = $str;
				}
				$table.='<td>'.htmlentities($str).'</td>';
			}
			
				if($bal>=0)
					$table.='<td>'.$bal.'</td>';
				
			
				if($bal<0)
					$table.='<td>'.$bal.'</td>';
				
			$table.='</tr>';
		}
		$table.='</tbody>';
		$table.='<tfoot><tr>';
			$xcol = 0;
			foreach($head as $hd){
				if($hd=="Receive")
					$table.='<td><strong>'.$baldr.'</strong></td>';
				else if($hd=="Issue")
					$table.='<td><strong>'.$balcr.'</strong></td>';
				else{
					
					if($xcol==3)
						$table.='<td><strong>Total</strong></td>';
					else
						$table.='<td></td>';
				}
				$xcol++;	
			}
		$table.='</tr></tfoot>';
		$table.='</table>';
		
		return $table;	
	}
	
}
