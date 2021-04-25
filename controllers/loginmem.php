<?php
class Loginmem extends Controller{
	
	function __construct(){
		parent::__construct();		
		}
		
		public function index($biz=""){
			//echo $biz;die;
			if ($this->model->getBizness($biz)==null){
				header ('location: '.URL);
								
			}else{
			$this->view->bizness = $this->model->getBizness($biz);
			//$this->view->pass=Hash::create('sha256',"rajib",HASH_KEY);
			$this->view->renderlogin('loginmem/index');
			}			
		}
		
		function run($biz=""){	
			
			$this->model->run($biz);
		}
}