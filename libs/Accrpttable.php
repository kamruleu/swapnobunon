<?php

class Accrpttable{
	/*
	* $fields is the field header to be render
	* $row is array of data selected from db
	* $keyval is for edit or delete url id
	* $opbal is the opening balance
	* $acc account code
	* $acc account code description
	**/
	private $decimals="";
	
	public function __construct(){
		$this->decimals = Session::get("sbizdecimals");
	}
	
	public function generalTable($fields, $row, $keyval, $opbal, $acc, $accdesc){
		
				
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
		
		$baldr = 0;
		$balcr = 0;
		$bal = $opbal;
		$table.='</tr>';
		$table.='</thead>';
		$table.='<tbody>';
		$table.='<tr>';
			$table.='<td><strong>'.$acc.'</strong></td><td><strong>'.$accdesc.'</strong></td><td></td><td></td><td></td><td></td><td></td>';
		$table.='</tr>';
		$table.='<tr>';
			
			
			$table.='</tr>';
		
		foreach($row as $key=>$value){
						
			$table.='<tr>';
			
			foreach($value as $str){
				$keyofval =  array_search($str, $value); 
					switch ($keyofval){
						case "xqty":
							$str = number_format(floatval($str), 0, '.', '');
							break;
						case "xbal":
							$str = number_format(floatval($str), 0, '.', '');
							break;
						case "xtotcost":
							$str = number_format(floatval($str), $this->decimals, '.', '');
							break;		
						case "xstdcost":
							$str = number_format(floatval($str), $this->decimals, '.', '');
							break;
						case "xstdprice":
							$str = number_format(floatval($str), $this->decimals, '.', '');
							break;
						case "xvatpct":
							$str = number_format(floatval($str), $this->decimals, '.', '');
							break;
						case "xvatamt":
							$str = number_format(floatval($str), $this->decimals, '.', '');
							break;
						case "xdisc":
							$str = number_format(floatval($str), $this->decimals, '.', '');
							break;
						case "xprimedr":
							$str = number_format(floatval($str), $this->decimals, '.', '');
							$bal+=$str;
							$baldr+=$str;
							break;	
						case "xprimecr":
							$str = number_format(floatval($str), $this->decimals, '.', '');
							$bal-=$str;
							$balcr+=$str;
							break;		
						default:
							$str = $str;
				}
				$table.='<td>'.htmlentities($str).'</td>';
			}
			
			$table.='</tr>';
		}
		$table.='</tbody>';
		$table.='<tfoot><tr>';
			$xcol = 0;
			foreach($head as $hd){
				if($hd=="Dr. Amount")
					$table.='<td><strong>'.$baldr.'</strong></td>';
				else if($hd=="Cr. Amount")
					$table.='<td><strong>'.abs($balcr).'</strong></td>';
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
	public function ledgerTable($fields, $row, $keyval, $opbal, $acc, $accdesc, $acctype=""){
		
				
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
        $table.='<td><strong>'.$acc.'</strong></td><td><strong>'.$accdesc.'</strong></td><td></td><td></td><td></td><td></td><td></td>';
		$table.='</tr>';
		$table.='<tr>';
			
			$xcol = 0;
			foreach($head as $hd){
				if($hd=="Dr. Amount"){
					if($bal>=0)
						$table.='<td><strong>'.number_format(floatval($bal), $this->decimals, '.', '').'</strong></td>';
					else
						$table.='<td><strong>0</strong></td>';
				}
				else if($hd=="Cr. Amount"){
					if($bal<0)
						$table.='<td><strong>'.number_format(floatval(abs($bal)), $this->decimals, '.', '').'</strong></td>';
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
						case "xqty":
							$str = number_format(floatval($str), 0, '.', '');
							break;
						case "xbal":
							$str = number_format(floatval($str), 0, '.', '');
							break;
						case "xtotcost":
							$str = number_format(floatval($str), $this->decimals, '.', '');
							break;		
						case "xstdcost":
							$str = number_format(floatval($str), $this->decimals, '.', '');
							break;
						case "xstdprice":
							$str = number_format(floatval($str), $this->decimals, '.', '');
							break;
						case "xvatpct":
							$str = number_format(floatval($str), $this->decimals, '.', '');
							break;
						case "xvatamt":
							$str = number_format(floatval($str), $this->decimals, '.', '');
							break;
						case "xdisc":
							$str = number_format(floatval($str), $this->decimals, '.', '');
							break;
						case "xprimedr":
							$str = number_format(floatval($str), $this->decimals, '.', '');
							$bal+=$str;
							$baldr+=$str;
							break;	
						case "xprimecr":
							$str = number_format(floatval($str), $this->decimals, '.', '');
							$bal-=$str;
							$balcr+=$str;
							break;		
						default:
							$str = $str;
				}
				$table.='<td>'.htmlentities($str).'</td>';
			}
			if($acctype=="Liability" || $acctype=="Income" || $acctype=="Supplier"){
				if($bal>0)
					$table.='<td>('.htmlentities(number_format(floatval($bal), $this->decimals, '.', '')).')</td>';
				else
					$table.='<td>'.htmlentities(number_format(floatval(abs($bal)), $this->decimals, '.', '')).'</td>';
			}else if($acctype=="Asset" || $acctype=="Expenditure" || $acctype=="Customer"){
				if($bal<0)
					$table.='<td>('.htmlentities(number_format(floatval(abs($bal)), $this->decimals, '.', '')).')</td>';
				else
					$table.='<td>'.htmlentities(number_format(floatval($bal), $this->decimals, '.', '')).'</td>';
			}
			$table.='</tr>';
		}
		$table.='</tbody>';
		$table.='<tfoot><tr>';
			$xcol = 0;
			foreach($head as $hd){
				if($hd=="Dr. Amount")
					$table.='<td><strong>'.number_format(floatval($baldr), $this->decimals, '.', '').'</strong></td>';
				else if($hd=="Cr. Amount") {
                    $table .= '<td><strong>' . number_format(floatval(abs($balcr)), $this->decimals, '.', '') . '</strong></td>';

                }
				else{
					
					if($xcol==3)
						$table.='<td><strong>Total</strong></td>';
					else
						$table.='<td></td>';
				}
				$xcol++;
			}

			if($bal > 0){
                $table .= '<td><strong>' . number_format(floatval($bal), $this->decimals, '.', '') . '</strong></td>';
            }else{
                $table .= '<td><strong>' . number_format(floatval(abs($bal)), $this->decimals, '.', '') . '</strong></td>';
            }

		$table.='</tr></tfoot>';
		$table.='</table>';
		
		return $table;	
	}


	public function cashbankbook($rows, $obal, $groupval){
		
		$grouprec = [];
		$bal = 0;

		$finalbal = 0;
		$finaldr = 0;
		$finalcr = 0;
		foreach($rows as $key=>$value){
			$keyval = $value[$groupval];
			$grouprec[$keyval][]=$value;
		}
		$grandbal = 0;
		$grandtotaldr = 0;
		$grandtotalcr = 0;
		//print_r($grouprec); die;
		$table = '<table id="grouptable" class="table table-striped table-bordered" cellspacing="0" width="100%">';
		$table .= "<tr>";
				$table .= '<td><strong>Account</strong></td><td><strong>Date</strong></td><td><strong>Voucher</strong></td><td><strong>Narration</strong></td><td><strong>Debit</strong></td><td><strong>Credit</strong></td><td><strong>Balance</strong></td></tr>';

		$obalrec = [];
		
		foreach($obal as $key=>$value){
			$keyval = $value[$groupval];
			$obalrec[$keyval][]=$value;
		}

		$arrdif = array_diff_key($obalrec, $grouprec);
		
		if(!empty($arrdif)){

			foreach($arrdif as $k=>$v){
				$opbal = $v[0]['xprime'];
				$table .= '<tr><td>'.$v[0]['xacc'].'</td><td>'.$v[0]['xdesc'].'</td><td></td><td></td><td></td><td></td><td></td></tr>';
				$table .= "<tr>";
				$table.='<td></td><td></td><td></td><td><strong>Opening Balance</strong></td>';
				if($opbal>=0){
						$table.='<td><strong>'.number_format(floatval($opbal), $this->decimals, '.', '').'</strong></td>';
						$finaldr+=$opbal;
					}else
						$table.='<td><strong>0</strong></td>';
				if($opbal<0){
						$table.='<td><strong>'.number_format(floatval(abs($opbal)), $this->decimals, '.', '').'</strong></td>';
						$finalcr+=$opbal;
					}else
						$table.='<td><strong>0</strong></td><td></td>';

				$table.='<td></td>';			
				$table .= "</tr>";

				$finalbal+=$opbal;
				
			}

		}

				
		foreach($grouprec as $key=>$val){
			$opbal=0;

			foreach($obal as $k=>$v){
				if($key==$v["xacc"])
					$opbal=$v["xprime"];
			}

			$bal = $opbal;
			
			$totaldr = 0;
			$totalcr = 0;

			if($opbal>0){
				$totaldr = $opbal;
			}else{
				$totalcr = $opbal;
			}
			
				$table .= '<tr><td>'.$key.'</td><td>'.$val[0]["xaccdesc"].'</td><td></td><td></td><td></td><td></td><td></td></tr>';
				$table .= "<tr>";
				$table.='<td></td><td></td><td></td><td><strong>Opening Balance</strong></td>';
				if($opbal>=0)
						$table.='<td><strong>'.number_format(floatval($opbal), $this->decimals, '.', '').'</strong></td>';
					else
						$table.='<td><strong>0</strong></td>';
				if($opbal<0)
						$table.='<td><strong>'.number_format(floatval(abs($opbal)), $this->decimals, '.', '').'</strong></td>';
					else
						$table.='<td><strong>0</strong></td><td></td>';

				$table.='<td></td>';			
				$table .= "</tr>";	
				foreach($val as $k=>$values){
					$bal += $values["xprime"];
					$table .= "<tr>";
						if($values["xprime"]>=0){
							$totaldr += $values["xprime"];
							$table .= '<td></td><td>'.$values["xdate"].'</td><td>'.$values["xvoucher"].'</td><td>'.$values["xnarration"].'</td><td>'.$values["xprime"].'</td><td>0</td>';
							if ($bal>=0)
								$table .= '<td>'.$bal.'</td>';
							else
								$table .= '<td>('.abs($bal).')</td>';
						}
						else{
							$totalcr += $values["xprime"];
							$table .= '<td></td><td>'.$values["xdate"].'</td><td>'.$values["xvoucher"].'</td><td>'.$values["xnarration"].'</td><td>0</td><td>'.abs($values["xprime"]).'</td>';
							if ($bal>=0)
								$table .= '<td>'.$bal.'</td>';
							else
								$table .= '<td>('.abs($bal).')</td>';
						}
					$table .= "</tr>";
					
				}
				$grandbal += $bal;

				$grandtotaldr += $totaldr;
				$grandtotalcr += $totalcr;
				$table .= '<tr><td></td><td></td><td></td><td><strong>Total</strong></td><td><strong>'.$totaldr.'</strong></td><td><strong>'.abs($totalcr).'</strong></td><td></td></tr>';	

		}
		$grandbal += $finalbal;
		$grandtotaldr += $finaldr;
		$grandtotaldr += $finalcr;
		if($grandbal>=0){
			$table .= '<tr><td></td><td></td><td></td><td><strong>All Accounts Total</strong></td><td><strong>'.$grandtotaldr.'</strong></td><td><strong>'.abs($grandtotalcr).'</strong></td><td><strong>'.$grandbal.'</td></tr></strong>';
		}
		else{
			$table .= '<tr><td></td><td></td><td></td><td><strong>All Accounts Total</strong></td><td><strong>'.$grandtotaldr.'</strong></td><td><strong>'.abs($grandtotalcr).'</strong></td><td><strong>('.abs($grandbal).')</strong></td></tr>';
		}

		$table .= "</table>";

		return $table;

	}

	public function apacincexp($rows, $obal, $groupval, $type){
		
		$grouprec = [];
		$bal = 0;

		$finalbal = 0;
		$finaldr = 0;
		$finalcr = 0;
		foreach($rows as $key=>$value){
			$keyval = $value[$groupval];
			$grouprec[$keyval][]=$value;
		}
		$grandbal = 0;
		$grandtotaldr = 0;
		$grandtotalcr = 0;
		//print_r($grouprec); die;
		$table = '<table id="grouptable" class="table table-striped table-bordered" cellspacing="0" width="100%">';
		$table .= "<tr>";
				$table .= '<td><strong>Account</strong></td><td><strong>Date</strong></td><td><strong>Voucher</strong></td><td><strong>Narration</strong></td><td><strong>Debit</strong></td><td><strong>Credit</strong></td><td><strong>Balance</strong></td></tr>';

		$obalrec = [];
		
		foreach($obal as $key=>$value){
			$keyval = $value[$groupval];
			$obalrec[$keyval][]=$value;
		}

		$arrdif = array_diff_key($obalrec, $grouprec);
		
		if(!empty($arrdif)){

			foreach($arrdif as $k=>$v){
				$opbal = $v[0]['xprime'];
				
				$table .= '<tr><td>'.$v[0]['xacc'].'</td><td>'.$v[0]['xdesc'].'</td><td></td><td></td><td></td><td></td><td></td></tr>';
				$table .= "<tr>";
				$table.='<td></td><td></td><td></td><td><strong>Opening Balance</strong></td>';
				if($opbal>=0){
						$table.='<td><strong>'.number_format(floatval($opbal), $this->decimals, '.', '').'</strong></td>';
						$finaldr+=$opbal;
					}else
						$table.='<td><strong>0</strong></td>';
				if($opbal<0){
						$table.='<td><strong>'.number_format(floatval(abs($opbal)), $this->decimals, '.', '').'</strong></td>';
						$finalcr+=$opbal;	
					}else
						$table.='<td><strong>0</strong></td><td></td>';

				$table.='<td></td>';			
				$table .= "</tr>";

				$finalbal+=$opbal;
				
			}

		}

				
		foreach($grouprec as $key=>$val){
			$opbal=0;

			foreach($obal as $k=>$v){
				if($key==$v["xacc"])
					$opbal=$v["xprime"];
			}

			$bal = $opbal;
			
			$totaldr = 0;
			$totalcr = 0;

			if($opbal>0){
				$totaldr = $opbal;
			}else{
				$totalcr = $opbal;
			}
			
				$table .= '<tr><td>'.$key.'</td><td>'.$val[0]["xaccdesc"].'</td><td></td><td></td><td></td><td></td><td></td></tr>';
				$table .= "<tr>";
				$table.='<td></td><td></td><td></td><td><strong>Opening Balance</strong></td>';
				
				if($opbal>=0)
						$table.='<td><strong>'.number_format(floatval($opbal), $this->decimals, '.', '').'</strong></td>';
					else
						$table.='<td><strong>0</strong></td>';
				if($opbal<0)
						$table.='<td><strong>'.number_format(floatval(abs($opbal)), $this->decimals, '.', '').'</strong></td>';
					else
						$table.='<td><strong>0</strong></td><td></td>';

				$table.='<td></td>';			
				$table .= "</tr>";	
				foreach($val as $k=>$values){
					$bal += $values["xprime"];
					$table .= "<tr>";
					if($type=="Accounts Payable" || $type=="Income"){
						if($values["xprime"]>=0){
							$totaldr += $values["xprime"];
							$table .= '<td></td><td>'.$values["xdate"].'</td><td>'.$values["xvoucher"].'</td><td>'.$values["xnarration"].'</td><td>'.$values["xprime"].'</td><td>0</td>';
							if ($bal>=0)
								$table .= '<td>('.$bal.')</td>';
							else
								$table .= '<td>'.abs($bal).'</td>';
						}
						else{
							$totalcr += $values["xprime"];
							$table .= '<td></td><td>'.$values["xdate"].'</td><td>'.$values["xvoucher"].'</td><td>'.$values["xnarration"].'</td><td>0</td><td>'.abs($values["xprime"]).'</td>';
							if ($bal>=0)
								$table .= '<td>('.$bal.')</td>';
							else
								$table .= '<td>'.abs($bal).'</td>';
						}
					}else{

						if($values["xprime"]>=0){
							$totaldr += $values["xprime"];
							$table .= '<td></td><td>'.$values["xdate"].'</td><td>'.$values["xvoucher"].'</td><td>'.$values["xnarration"].'</td><td>'.$values["xprime"].'</td><td>0</td>';
							if ($bal>=0)
								$table .= '<td>'.$bal.'</td>';
							else
								$table .= '<td>('.abs($bal).')</td>';
						}
						else{
							$totalcr += $values["xprime"];
							$table .= '<td></td><td>'.$values["xdate"].'</td><td>'.$values["xvoucher"].'</td><td>'.$values["xnarration"].'</td><td>0</td><td>'.abs($values["xprime"]).'</td>';
							if ($bal>=0)
								$table .= '<td>'.$bal.'</td>';
							else
								$table .= '<td>('.abs($bal).')</td>';
						}
					}
					$table .= "</tr>";
					
				}
				$grandbal += $bal;

				$grandtotaldr += $totaldr;
				$grandtotalcr += $totalcr;
				$table .= '<tr><td></td><td></td><td></td><td><strong>Total</strong></td><td><strong>'.$totaldr.'</strong></td><td><strong>'.abs($totalcr).'</strong></td><td></td></tr>';	

		}
		$grandtotaldr += $finaldr;
		$grandtotalcr += $finalcr;
		$grandbal += $finalbal;
		if($type=="Accounts Payable" || $type=="Income"){
			if($grandbal>=0){
				$table .= '<tr><td></td><td></td><td></td><td><strong>All Accounts Total</strong></td><td><strong>'.$grandtotaldr.'</strong></td><td><strong>('.$grandtotalcr.')</strong></td><td><strong>('.$grandbal.')</td></tr></strong>';
			}
			else{
				$table .= '<tr><td></td><td></td><td></td><td><strong>All Accounts Total</strong></td><td><strong>'.$grandtotaldr.'</strong></td><td><strong>'.abs($grandtotalcr).'</strong></td><td><strong>'.abs($grandbal).'</strong></td></tr>';
			}
		}else{
			if($grandbal>=0){
				$table .= '<tr><td></td><td></td><td></td><td><strong>All Accounts Total</strong></td><td><strong>'.$grandtotaldr.'</strong></td><td><strong>'.abs($grandtotalcr).'</strong></td><td><strong>'.$grandbal.'</td></tr></strong>';
			}
			else{
				$table .= '<tr><td></td><td></td><td></td><td><strong>All Accounts Total</strong></td><td><strong>'.$grandtotaldr.'</strong></td><td><strong>('.abs($grandtotalcr).')</strong></td><td><strong>('.abs($grandbal).')</strong></td></tr>';
			}
		}
		$table .= "</table>";

		return $table;

	}

	
}
