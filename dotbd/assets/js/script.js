
var app = angular.module("myApp", ["ngRoute","ngCookies"]);

app.config(['$routeProvider','$locationProvider','$qProvider',function($routeProvider,$locationProvider,$qProvider) {
	//$locationProvider.html5Mode(true);
	//$locationProvider.html5Mode(true).hashPrefix('!');
    $qProvider.errorOnUnhandledRejections(false);

    $routeProvider
    .when("/", {
        templateUrl : "template/home.html",
        controller : "main"
    })
    .when("/home", {
        templateUrl : "template/home.html",
        controller : "main"
    })
    .when("/cart", {
        templateUrl : "template/cart.html",
        controller : "main"
    })
    .when("/about", {
        templateUrl : "View/template/about-us.php",
        controller : "main"
    })
    .when("/search", {
        templateUrl : "View/template/search.php",
        controller : "main"
    })
    .when("/shop/:ctg", {
        templateUrl : "View/template/shop.php",
        controller : "main"
    })
    .when("/signin", {
        templateUrl : "View/template/login.php",
        controller : "main"
    })
    .when("/payment_req", {
        templateUrl : "View/template/payment_req.php",
        controller : "main"
    })
    .when("/payment_cor", {
        templateUrl : "View/template/payment_cor.php",
        controller : "main"
    })
    .when("/payment", {
        templateUrl : "View/template/payment.php",
        controller : "main"
    })
    .when("/successreq/:rnum", {
        templateUrl : "View/template/successreq.php",
        controller : "main"
    })
    .when("/bkashreq/:rnum", {
        templateUrl : "View/template/bkashreq.php",
        controller : "main"
    })
    .when("/successcor/:cnum", {
        templateUrl : "View/template/successcor.php",
        controller : "main"
    })
    .when("/sale", {
        templateUrl : "View/template/sale.php",
        controller : "main"
    })

    .when("/product", {
        templateUrl : "View/template/product_list.php",
        controller : "main"
    })

    .when("/csale", {
        templateUrl : "View/template/corporate_sale.php",
        controller : "main"
    })
    .when("/trackorder", {
        templateUrl : "View/template/track.php",
        controller : "main"
    })
    .when("/bin", {
        templateUrl : "View/template/binstatus.php",
        controller : "main"
    })
    .when("/quickview/:id", {
        templateUrl : "template/quickview.html",
        controller : "main"
    })

    .when("/brand/:sup", {
        templateUrl : "View/template/brand.php",
        controller : "main"
    })
    .when("/bv/:bv", {
        templateUrl : "View/template/bv.php",
        controller : "main"
    })
    .when("/contact", {
        templateUrl : "View/template/contact.php",
        controller : "main"
    })
    .when("/fail", {
        templateUrl : "View/template/fail.php",
        controller : "main"
    })
    .when("/cancel", {
        templateUrl : "View/template/cancel.php",
        controller : "main"
    })
    .when("/c_cus", {
        templateUrl : "View/template/create_customer.php",
        controller : "main"
    })
.when("/orderdetails/:odid", {
        templateUrl : "View/template/order-information.php",
        controller : "main"
    })

     .when("/myacc", {
        templateUrl : "View/template/myaccount.php",
        controller : "main"
    })

     .when("/invoice", {
        templateUrl : "View/template/invoice_list.php",
        controller : "main"
    })

     .when("/invoice_det/:invnum", {
        templateUrl : "View/template/invoice_det.php",
        controller : "main"
    })
     .when("/wishlist", {
        templateUrl : "View/template/wishlist.php",
        controller : "main"
    })
     .when("/register", {
        templateUrl : "View/register.php",
        controller : "main"
    })
     .when("/checkout", {
        templateUrl : "template/checkout.html",
        controller : "main"
    })
     .when("/checkoutr", {
        templateUrl : "View/template/checkoutr.php",
        controller : "main"
    })

     .when("/checkoutcor", {
        templateUrl : "View/template/checkoutcor.php",
        controller : "main"
    })
     .when("/checkoutreq", {
        templateUrl : "View/template/checkoutreq.php",
        controller : "main"
    })

     .when("/ldcreq", {
        templateUrl : "View/template/ldcreq.php",
        controller : "main"
    })
     .when("/orderhis", {
        templateUrl : "View/template/orderhistory.php",
        controller : "main"
    })
      .when("/notice", {
        templateUrl : "View/template/notice.php",
        controller : "main"
    })

    .when("/return", {
        templateUrl : "View/template/return.php",
        controller : "main"
    })
    .otherwise({redirectTo: "/home"});
}]);


app.controller('main',[ '$scope','$cookies','$http','$location','$routeParams',function( $scope,$cookies,$http,$location,$routeParams){
$scope.form ={};
$scope.data ={};
$scope.ch =[];
$scope.au =[];
$scope.cmt =[];
$scope.cor = [];
$scope.pq =1;
$scope.wp = '';

if($cookies.get('cmt') != undefined || $cookies.get('cmt') != '')
{
     $scope.cmnt = $cookies.get('cmt');
}
else
{
    $scope.cmnt = '';
}

if($cookies.get('name') != undefined || $cookies.get('name') != '')
{
     $scope.name = $cookies.get('name');
}
else
{
    $scope.name = '';
}

if($cookies.get('mn') != undefined || $cookies.get('mn') != '')
{
     $scope.mn = $cookies.get('mn');
}
else
{
    $scope.mn = '';
}

if($cookies.get('em') != undefined || $cookies.get('em') != '')
{
     $scope.em = $cookies.get('em');
}
else
{
    $scope.em = '';
}

if($cookies.get('ck') != undefined)
{
     $scope.retstk = $cookies.get('ck');
}
else
{
    $scope.retstk = 'false';
}

if($scope.outl == undefined)
{
    $scope.outl =[];
}
else
{

}



if($scope.count == undefined)
{
    $scope.c =$cookies.getObject('chart');
    angular.forEach($scope.c, function(value, key) {
                            
                              $scope.ct = value.count;
                                         
                        });
    if($scope.ct == undefined || $scope.ct == '')
    {
    $scope.count = 0;
    }
    else
    {
        $scope.count = $scope.ct;
    }
}
$scope.ckbal = false;
$scope.cbal = function(){

    $scope.fp();

    if($cookies.getObject('auth') == "" || $cookies.getObject('auth') == null || $cookies.getObject('auth') == undefined)
        {
            $scope.rin = '';
        }
        else
        {
            $scope.rin = $scope.auth.rin;

            $http({
  method: 'get',
  url: 'api/balance.php?username=apiuser&password=1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67&rin='+$scope.rin
 }).then(function successCallback(response) {
   $scope.balance = response.data[0].balance;
              });
        }
        
    
    if( $scope.total > $scope.balance)
    {
       return $scope.ckbal = true;  
    }
    else
    {
       return $scope.ckbal = false; 
    }
}


//$scope.customer = 'rcust';
$scope.rcust = true;
$scope.ocust = false;
$scope.ctgid = 'Toiletries';
 $scope.sp = 0;
 $scope.old = false;
 $scope.guest = true;
 $scope.retailer = false;
 $scope.payment = "Online Payment";
 $scope.aut = $cookies.getObject('auth');
 if($cookies.getObject('auth') == undefined || $cookies.getObject('auth') == '')
 {
 	var index = '';
 	$scope.auth = $scope.aut;
 }
 else
 {
 	var index = 0;
 	$scope.auth = $scope.aut[index];

 }

$scope.check = function()
{
	if($cookies.getObject('auth') == "" || $cookies.getObject('auth') == null || $cookies.getObject('auth') == undefined || $cookies.getObject('auth') == [] || $cookies.getObject('auth') == 0 )
	{
		return false;
	}
	else
	{
		return true;
	}
}


if($cookies.getObject('chart') == "" || $cookies.getObject('chart') == null || $cookies.getObject('chart') == undefined )
  {
    $scope.ch =[];
    $cookies.putObject('chart',$scope.ch); 
  }
  else
  {
    $scope.ch = $cookies.getObject('chart');
  }


    

  if($cookies.getObject('auth') == "" || $cookies.getObject('auth') == null || $cookies.getObject('auth') == undefined )
  {
  	$scope.au =[];
    $cookies.putObject('auth',$scope.au); 
  }
 
if($cookies.getObject('auth') == "" || $cookies.getObject('auth') == null || $cookies.getObject('auth') == undefined)
{
    $scope.rin = '';
}
else
{
    
    $scope.rin = $scope.auth.rin;
}

if($cookies.getObject('auth') == "" || $cookies.getObject('auth') == null || $cookies.getObject('auth') == undefined)
{
    $scope.bin = '';
}
else
{
    
    $scope.bin = $scope.auth.bin;
}

 
  $scope.tp = function()
           {
            if($cookies.getObject('auth') == "" || $cookies.getObject('auth') == null || $cookies.getObject('auth') == undefined)
            {

            }
        else{

            if($scope.auth.rin != undefined){

                if($cookies.get('ck') != undefined)
                    {
                         $scope.retstk = $cookies.get('ck');
                    }
                    else
                    {
                        $scope.retstk = 'false';
                    }

                if($scope.retstk == 'true' || $scope.retstk == 'corporate')
                {
                   	$scope.total =0;
                       angular.forEach($scope.cart, function(value, key) {
                        $scope.price = value.qty * value.price;
                        $scope.total += $scope.price;            
                         });
                    return $scope.total;
                }
               if($scope.retstk == 'false')
                {
                $scope.total =0;
               angular.forEach($scope.cart, function(value, key) {
                $scope.price = value.qty * value.rprice;
                $scope.total += $scope.price;            
                 });
                    return $scope.total;
                }
            
            }
            else
            {
            $scope.total =0;
    angular.forEach($scope.cart, function(value, key) {
            $scope.price = value.qty * value.price;
            $scope.total += $scope.price;            
        });
    return $scope.total;
            }
        }
        if($scope.auth == '')
        {
            $scope.total =0;
    angular.forEach($scope.cart, function(value, key) {
            $scope.price = value.qty * value.price;
            $scope.total += $scope.price;            
        });
    return $scope.total;
        }
}


$scope.tpoint = function()
           {
            
                    $scope.totalbv =0;
                       angular.forEach($scope.cart, function(value, key) {
                        $scope.bv = (value.qty-0) * (value.bv-0);
                        $scope.totalbv += $scope.bv;            
                         });
                    return $scope.totalbv;
                }

$scope.tpbv = function()
           {
            
                    $scope.totalbv =0;
                       angular.forEach($scope.cart, function(value, key) {
                        $scope.bv = (value.qty-0) * (value.bv-0);
                        $scope.totalbv += $scope.bv;            
                         });
                    return $scope.totalbv;
                }


$scope.fp = function()
           {
           		return $scope.tp() + $scope.sp;
			}


$scope.fprice= $scope.fp();
$scope.remove = function(item) {
 $scope.index = 0; 
  $scope.index = $scope.cart.indexOf(item);
       $scope.ch.splice($scope.index, 1);
       $cookies.putObject('chart',$scope.ch);
        $scope.show();
        $scope.cbal();
        
}

$scope.plus = function(item) {
	$scope.index = item;
 for(i in $scope.ch) {
if($scope.ch[i].id == $scope.index)
{ 
	$scope.ch[i].qty = $scope.ch[i].qty +1;
	 $cookies.putObject('chart',$scope.ch);
}
}
  $scope.show();
}

$scope.minus = function(item) {
	$scope.index = item;
 for(i in $scope.ch) {
 	if($scope.ch[i].qty > 1){
if($scope.ch[i].id == $scope.index)
{ 
	$scope.ch[i].qty = $scope.ch[i].qty - 1;
	 $cookies.putObject('chart',$scope.ch);
}

 $scope.show();
}
}
}

$scope.qty = function() {
	return $scope.pq;
}

$scope.pluss = function() {
	return $scope.pq += 1;
	$scope.qty();

}

$scope.minuss = function() {
if($scope.pq > 1){
	return $scope.pq -=1;
	$scope.qty();
}
}

$scope.clear = function()
{
  $scope.cl = [];
  $cookies.putObject('chart',$scope.cl);
  //alert("Cart Clear");
   $scope.show();   
}

$scope.show = function()
{
	return	$scope.cart = $cookies.getObject('chart');
}

$scope.al = function()
{
  alert($scope.ch.length);
}

	$scope.free = function()
	{
		return $scope.sp = 0;
	}

$scope.quick = function()
	{
		return $scope.sp = 50;
	}
	
  $scope.add2 =function(id){
$scope.id = id;
 alert($scope.id);
}

$scope.product = function(id) 
{
	$scope.id =id;
	$scope.pro = "product is = " +$scope.id;
}

if($scope.limit == undefined)
{
	$scope.parpage = 9;
	$scope.limit ='9';
}

$scope.pp = function()
{
	$scope.parpage = $scope.limit;
	$scope.allctgproduct();
	$scope.ctgproduct();
}
$scope.ppbv = function()
{
    $scope.parpage = $scope.limit;
    $scope.bv_p();
    $scope.bv();
}
$scope.ppre = function()
{
    $scope.parpage = $scope.limit;
    $scope.retproduct_p();
    $scope.retproduct();
}
$scope.pps = function()
{
	$scope.parpage = $scope.limit;
	$scope.search_p();
	$scope.search();
}

$scope.ppb = function()
{
	$scope.parpage = $scope.limit;
	$scope.allbrandproduct();
	$scope.brand();
}
if($scope.page == undefined)
{
	$scope.page =0;
}

$scope.allctgproduct = function()
{
	$scope.ctg = $routeParams.ctg;
    if($scope.ctg == "all")
    {
	$http({
  method: 'get',
  url: 'api/item.php?username=apiuser&password=1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67'
 }).then(function successCallback(response) {
   $scope.np = response.data;
$scope.totalPage =  Math.ceil($scope.np/$scope.parpage);
$scope.tlp =[];
$scope.lid =0;
for (var i = 0; i < $scope.totalPage; i++) {
        $scope.tlp.push(i);
        $scope.lid+=1;
        }
 });
}
else
{
    $http({
  method: 'get',
  url: 'api/item_p.php?username=apiuser&password=1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67&ctg='+$scope.ctg
 }).then(function successCallback(response) {
   $scope.np = response.data;
$scope.totalPage =  Math.ceil($scope.np/$scope.parpage);
$scope.tlp =[];
$scope.lid =0;
for (var i = 0; i < $scope.totalPage; i++) {
        $scope.tlp.push(i);
        $scope.lid+=1;
        }
 });
}
}

$scope.allbrandproduct = function()
{
	$scope.brand = $routeParams.sup;
	$http({
  method: 'get',
  url: 'api/bitem.php?username=apiuser&password=1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67&xsup='+$scope.brand
 }).then(function successCallback(response) {
   $scope.np = response.data;
$scope.totalPage =  Math.ceil($scope.np/$scope.parpage);
$scope.tlp =[];
$scope.lid =0;
for (var i = 0; i < $scope.totalPage; i++) {
        $scope.tlp.push(i);
        $scope.lid+=1;
        }
 });
}

$scope.brand = function()
{
	$scope.startfrom = $scope.parpage*$scope.page;
$scope.ofset = $scope.startfrom;
	$scope.bnd = $routeParams.sup;

	$http({
  method: 'get',
  url: 'api/bitem.php?username=apiuser&password=1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67&xsup='+$scope.bnd+'&lim='+$scope.parpage+'&ofset='+$scope.ofset
 }).then(function successCallback(response) {
 $scope.bproduct = response.data;
 });
}

$scope.brandName = function()
{
	$scope.id = $routeParams.id;
	$http({
  method: 'get',
  url: 'Model/brandName.php?id='+$scope.id
 }).then(function successCallback(response) {
 $scope.bname = response.data['0'];
 });
}
 //alert($scope.totalPage);
$scope.ctgproduct = function()
{
	$scope.startfrom = $scope.parpage*$scope.page;
$scope.ofset = $scope.startfrom;
	$scope.ctg = $routeParams.ctg;

	$http({
  method: 'get',
  url: 'api/item.php?username=apiuser&password=1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67&lim='+$scope.parpage+'&ofset='+$scope.ofset+'&ctg='+$scope.ctg
 }).then(function successCallback(response) {
 $scope.product = response.data;
 });
}

$scope.ctgelectronics = function()
{
  $scope.parpage = 8;
  $scope.startfrom = $scope.parpage*$scope.page;
$scope.ofset = $scope.startfrom;
  $scope.ctg = "Electronics";

  $http({
  method: 'get',
  url: 'api/item.php?username=apiuser&password=1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67&lim='+$scope.parpage+'&ofset='+$scope.ofset+'&ctg='+$scope.ctg
 }).then(function successCallback(response) {
 $scope.producte = response.data;
 });
}


$scope.ctgoa = function()
{
  $scope.parpage = 8;
  $scope.startfrom = $scope.parpage*$scope.page;
$scope.ofset = $scope.startfrom;
  $scope.ctg = "Office Appliances";

  $http({
  method: 'get',
  url: 'api/item.php?username=apiuser&password=1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67&lim='+$scope.parpage+'&ofset='+$scope.ofset+'&ctg='+$scope.ctg
 }).then(function successCallback(response) {
 $scope.productoa = response.data;
 
 });
}



$scope.corporate = function()
{
    $scope.startfrom = $scope.parpage*$scope.page;
$scope.ofset = $scope.startfrom;

    $http({
  method: 'get',
  url: 'api/citem.php?username=apiuser&password=1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67&lim='+$scope.parpage+'&ofset='+$scope.ofset
 }).then(function successCallback(response) {
 $scope.cproduct = response.data;
 });
}


$scope.allproduct = function()
{

    $http({
  method: 'get',
  url: 'api/allitem.php?username=apiuser&password=1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67'
 }).then(function successCallback(response) {
 $scope.allproduct = response.data;
 });
}


$scope.corporate_p = function()
{
    $http({
  method: 'get',
  url: 'api/citem.php?username=apiuser&password=1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67'
 }).then(function successCallback(response) {
   $scope.np = response.data;
$scope.totalPage =  Math.ceil($scope.np/$scope.parpage);
$scope.tlp =[];
$scope.lid =0;
for (var i = 0; i < $scope.totalPage; i++) {
        $scope.tlp.push(i);
        $scope.lid+=1;
        }
 });
}


$scope.retproduct = function()
{
    $scope.startfrom = $scope.parpage*$scope.page;
$scope.ofset = $scope.startfrom;
if($cookies.getObject('auth') == "" || $cookies.getObject('auth') == null || $cookies.getObject('auth') == undefined)
{
    $scope.rin = '';
}
else
{
    $scope.rin = $scope.auth.rin;
}
    $http({
  method: 'get',
  url: 'api/ritem.php?username=apiuser&password=1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67&lim='+$scope.parpage+'&ofset='+$scope.ofset+'&rin='+$scope.rin
 }).then(function successCallback(response) {
 $scope.reproduct = response.data;
 });
}

$scope.retproduct_p = function()
{
    if($cookies.getObject('auth') == "" || $cookies.getObject('auth') == null || $cookies.getObject('auth') == undefined)
{
    $scope.rin = '';
}
else
{
    $scope.rin = $scope.auth.rin;
}

    $http({
  method: 'get',
  url: 'api/ritem.php?username=apiuser&password=1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67&rin='+$scope.rin
 }).then(function successCallback(response) {
   $scope.np = response.data;
$scope.totalPage =  Math.ceil($scope.np/$scope.parpage);
$scope.tlp =[];
$scope.lid =0;
for (var i = 0; i < $scope.totalPage; i++) {
        $scope.tlp.push(i);
        $scope.lid+=1;
        }
 });
}
$scope.i = 0;
$scope.outlate = function(item)
{
$scope.sup = item;
    $http({
  method: 'get',
  url: 'api/outlate.php?username=apiuser&password=1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67&sup='+$scope.sup
 }).then(function successCallback(response) {
 $scope.out = response.data;
 });
}

$scope.outlate1 = function(item)
{
$scope.sup = item;
    $http({
  method: 'get',
  url: 'api/outlate.php?username=apiuser&password=1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67&sup='+$scope.sup
 }).then(function successCallback(response) {
 $scope.out1 = response.data;
 });
}

$scope.outlate2 = function(item)
{
$scope.sup = item;
    $http({
  method: 'get',
  url: 'api/outlate.php?username=apiuser&password=1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67&sup='+$scope.sup
 }).then(function successCallback(response) {
 $scope.out2 = response.data;
 });
}

$scope.outlate3 = function(item)
{
$scope.sup = item;
    $http({
  method: 'get',
  url: 'api/outlate.php?username=apiuser&password=1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67&sup='+$scope.sup
 }).then(function successCallback(response) {
 $scope.out3 = response.data;
 });
}

$scope.outlate4 = function(item)
{
$scope.sup = item;
    $http({
  method: 'get',
  url: 'api/outlate.php?username=apiuser&password=1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67&sup='+$scope.sup
 }).then(function successCallback(response) {
 $scope.out4 = response.data;
 });
}

$scope.outlate5 = function(item)
{
$scope.sup = item;
    $http({
  method: 'get',
  url: 'api/outlate.php?username=apiuser&password=1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67&sup='+$scope.sup
 }).then(function successCallback(response) {
 $scope.out5 = response.data;
 });
}


$scope.odn ='';
$scope.searchOrder = function()
{
	$scope.odAddess='';
$scope.on = $scope.odnumber;
	$http({
  method: 'get',
  url: 'Model/searchOrder.php?on='+$scope.on
 }).then(function successCallback(response) {
 $scope.od = response.data['0'];
 $scope.odn =$scope.od.onumber;
 });
}

$scope.orderdetails = function()
{
$scope.on = $routeParams.odid;

	$http({
  method: 'get',
  url: 'Model/searchOrder.php?on='+$scope.on
 }).then(function successCallback(response) {
 $scope.od = response.data['0'];
 $scope.odn =$scope.od.onumber;
 });
}

$scope.odetails = function()
{
$scope.on = $routeParams.odid;
	$http({
  method: 'get',
  url: 'Model/odDetails.php?oid='+$scope.on
 }).then(function successCallback(response) {
 $scope.odl = response.data;
$scope.odt =0;
 angular.forEach($scope.odl, function(value, key) {
            $scope.odp = value.qty * value.price;
            $scope.odt += $scope.odp;            
        });
 });
}

$scope.printDiv = function(divName) {
	$scope.name = $scope.odn+'.pdf';
  html2canvas(document.getElementById(divName), {
            onrendered: function (canvas) {
                var data = canvas.toDataURL();
                var docDefinition = {
                    content: [{
                        image: data,
                        width: 500,
                    }]
                };
                pdfMake.createPdf(docDefinition).download($scope.name);
            }
        });
} 



$scope.rtproduct = function()
{
	$http({
  method: 'get',
  url: 'Model/rtpProduct.php?id='+$scope.id
 }).then(function successCallback(response) {
 $scope.rtp = response.data;
 });
}

$scope.active = 0;
$scope.pg = function(id)
{
	$scope.page =id;
	$scope.ctgproduct();
	$scope.active = id;
	
}



$scope.pgs = function(id)
{
	$scope.page =id;
	$scope.active = id;
	$scope.search();
    $scope.search_p();
}

$scope.pgbv = function(id)
{
    $scope.page =id;
    $scope.active = id;
    $scope.bv_p();
    $scope.bv();
    
}

$scope.pgre = function(id)
{
    $scope.page =id;
    $scope.active = id;
    $scope.retproduct();
    $scope.retproduct_p();
}


$scope.cust = function(cst)
{
     $scope.customer = cst;
     if($scope.customer === 'ocust')
     {
        $scope.ocust = true;
        $scope.rcust = false;
     }
     if($scope.customer === 'rcust')
     {
        $scope.rcust = true;
        $scope.ocust = false;
     }
}

$scope.pgb = function(id)
{
	$scope.page =id;
	$scope.brand();
	$scope.active = id;
}


$scope.quickview = function()
{
	$scope.id = $routeParams.id;
	$http({
  method: 'get',
  url: 'api/item.php?username=apiuser&password=1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67&id='+$scope.id
 }).then(function successCallback(response) {
 $scope.Items = response.data['0'];

 });
}

$scope.sitem = function(id)
{
    $scope.id = id;
    $http({
  method: 'get',
  url: 'api/item.php?username=apiuser&password=1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67&id='+$scope.id
 }).then(function successCallback(response) {
 $scope.citem = response.data['0'];
 });
}



$scope.cid = function()
	{
		$http({
  method: 'get',
  url: 'api/item.php?username=apiuser&password=ca0af5821f64fbcce24a2d24dff5efb6b1746a0de0c9e69c605c4fbe924d2fd8&id='+$scope.id
 }).then(function successCallback(response) {
 $scope.Items = response.data['0'];
 return $scope.ctgid = $scope.Items.xcat;
 });
	}




$scope.zoomimage = function(image)
{
	$scope.zoom = image;
}





$scope.subscribe = function()
{
    $http.post(  
                "Model/subscribe.php",  
                {'email':$scope.form.semail}  
           ).then(function successCallback(response) {
                $scope.message = response.data.message;
                alert($scope.message);
                $scope.form.semail = "";
              });

}


$scope.login = function(email,password)
{
	$scope.email=email; 
	$scope.password = password;
	$http.post(  
                "Model/login.php",  
                {'email':$scope.email, 'password':$scope.password}  
           ).then(function successCallback(response) {

                $scope.login = response.data;
                if( $scope.login.id != undefined )
 				 {
 				 	$scope.au.push({id:$scope.login.id, name:$scope.login.name, email:$scope.login.email, phone:$scope.login.phone, type:$scope.login.type, image:$scope.login.image , address:$scope.login.address });
               		 $cookies.putObject('auth',$scope.au); 
                 alert($scope.login.message);
                 $scope.aut = $cookies.getObject('auth');
                 var index =0;
                 $location.path('home');
                  return $scope.auth = $scope.aut[index];
                 }
                 else
                 {
                 	alert($scope.login.message);
                 }
              });
}


$scope.loginr = function(user,password)
{
    $scope.email=user; 
    $scope.password = password;
    $scope.usr = 'apiuser';
    $scope.psw = '1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67';
    $http.post(  
                "api/login.php",  
                {'username':$scope.usr,'password':$scope.psw ,'user':$scope.email, 'passwordr':$scope.password}  
           ).then(function successCallback(response) {

                $scope.login = response.data['0'];
                
                if( $scope.login.bizid != undefined )
                 {
                    $scope.au.push({id:$scope.login.bizid, name:$scope.login.xfname,  phone:$scope.login.xmobile, rin:$scope.login.xrdin , address:$scope.login.xadd1, bin:$scope.login.bin, balance:$scope.login.balance,membertype:$scope.login.membertype});
                     $cookies.putObject('auth',$scope.au); 
                 alert($scope.login.message);

                 $scope.aut = $cookies.getObject('auth');
                 $scope.cbal();
                 var index =0;
                 $location.path('home');
                  return $scope.auth = $scope.aut[index];
                  
                 }
                 else
                 {
                    alert($scope.login.message);
                 }
              });
}


$scope.ldc = function()
{
    if($scope.auth.membertype !='LDC')
    {
        alert('Apply for LDC');
    }
    else
    {
        if($scope.tpoint() >= 2500)
        {
            $location.path('ldcreq');
        }
        else
        {
            alert('No Enough Order');
        }
    }
}


$scope.loginvr = function(user,password)
{
    $scope.email=user; 
    $scope.password = password;
    $scope.usr = 'apiuser';
    $scope.psw = '1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67';
    $http.post(  
                "api/login.php",  
                {'username':$scope.usr,'password':$scope.psw ,'user':$scope.email, 'passwordr':$scope.password}  
           ).then(function successCallback(response) {

                $scope.login = response.data['0'];
                
                if( $scope.login.bizid != undefined )
                 {
                    $scope.au.push({id:$scope.login.bizid, name:$scope.login.xfname,  phone:$scope.login.xmobile, rin:$scope.login.xrdin , address:$scope.login.xadd1, bin:$scope.login.bin, balance:$scope.login.balance});
                     $cookies.putObject('auth',$scope.au); 
                 alert($scope.login.message);
                 $scope.aut = $cookies.getObject('auth');
                 $scope.cbal();
                 var index =0;
                 $location.path('checkoutreq');
                  return $scope.auth = $scope.aut[index];
                  
                 }
                 else
                 {
                    alert($scope.login.message);
                 }
              });
}


$scope.loginc = function(email,password)
{
	$scope.email=email; 
	$scope.password = password;
	//alert($scope.email + $scope.password);
	$http.post(  
                "Model/login.php",  
                {'email':$scope.email, 'password':$scope.password}  
           ).then(function successCallback(response) {
                $scope.login = response.data;
                if( $scope.login.id != undefined )
 				 {
 				 	$scope.au.push({id:$scope.login.id, name:$scope.login.name,email:$scope.login.email, phone:$scope.login.phone, type:$scope.login.type, image:$scope.login.image , address:$scope.login.address });
               		 $cookies.putObject('auth',$scope.au); 
                  alert($scope.login.message);
                 	$scope.aut = $cookies.getObject('auth');
                 	var index =0;
                  return $scope.auth = $scope.aut[index];
                 }
                 else
                 {
                 	alert($scope.login.message);
                 }
              });
}

$scope.account = function(type)
{

	$scope.type = type;
	if($scope.type === 'old')
	{
		$scope.guest = false;
		$scope.retailer = false;
		return $scope.old = true;
	}

	if($scope.type === 'guest')
	{
		$scope.old = false;
		$scope.retailer = false;
		return $scope.guest = true;
	}

	if($scope.type === 'Retailer')
	{
		$scope.old = false;
		 $scope.guest = false;
		return $scope.retailer = true;
	}
}

$scope.errfname = '';
$scope.errlname = '';
$scope.erraemail = '';
$scope.errapassword = '';
$scope.errphone = '';
$scope.erraddress = '';
$scope.errcountry ='';
$scope.errcity ='';
$scope.errpostcode ='';
$scope.errstate ='';
$scope.cstname ='';
$scope.cuscheck = function()
{
    $scope.cin = $scope.form.cin;
    $http({
  method: 'get',
  url: 'api/check_cin.php?username=apiuser&password=1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67&cin='+$scope.cin
 }).then(function successCallback(response) {
  $scope.cust = response.data[0];
  $scope.cstname = $scope.cust.xorg;
  $scope.form.name = $scope.cust.xorg;
  $scope.cin_search();
 });
    
}

$scope.rincheck = function()
{
    $scope.rin = $scope.form.rfrin;
    $http({
  method: 'get',
  url: 'api/check_rin.php?username=apiuser&password=1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67&rin='+$scope.rin
 }).then(function successCallback(response) {
  $scope.form.rfname = response.data[0].xorg;

 });
    
}


$scope.binst = function()
{
    

     if($cookies.getObject('auth') == "" || $cookies.getObject('auth') == null || $cookies.getObject('auth') == undefined)
        {
            $scope.rin = '';
        }
        else
        {
            
            $scope.rin = $scope.auth.rin;
        }

    $http({
  method: 'get',
  url: 'api/binst.php?username=apiuser&password=1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67&rin='+$scope.rin
 }).then(function successCallback(response) {
  $scope.binst = response.data;

 });
    
}



$scope.cin_search = function()
{
    $scope.mobile = $scope.form.mobile;
    $http({
  method: 'get',
  url: 'api/check_cin.php?username=apiuser&password=1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67&phone='+$scope.mobile
 }).then(function successCallback(response) {
  $scope.cust = response.data;
  $scope.cstcin = response.data;
  //alert("Your CIN : "+$scope.cstcin+" And Name : "+$scope.cstname)
 });
    
}



$scope.c_cus = function()
{
    
            if($cookies.getObject('auth') == "" || $cookies.getObject('auth') == null || $cookies.getObject('auth') == undefined)
        {
            $scope.rin = '';
        }
        else
        {
            
            $scope.rin = $scope.auth.rin;
        }

        if($cookies.getObject('auth') == "" || $cookies.getObject('auth') == null || $cookies.getObject('auth') == undefined)
        {
            $scope.bin = '';
        }
        else
        {
            
            $scope.bin = $scope.auth.bin;
        }




        $scope.err = 0;
        

        if($scope.form.cname == '' || $scope.form.cname == undefined)
        {
             $scope.errcname = 'background-color: #f7dede;';
             $scope.err++;
        }
        else
        {
             $scope.errcname = 'background-color: #bfe5bc;';
             $scope.err--;
        }

        if($scope.form.cemail == '' || $scope.form.cemail == undefined)
        {
             $scope.errcemail = 'background-color: #f7dede;';
             $scope.err++;
        }
        else
        {
            $scope.errcemail ='background-color: #bfe5bc;';
             $scope.err--;
        }

        if($scope.form.cpassword == '' || $scope.form.cpassword == undefined)
        {
             $scope.errcpassword = 'background-color: #f7dede;';
             $scope.err++;
        }
        else
        {
            $scope.errcpassword ='background-color: #bfe5bc;';
             $scope.err--;
        }

        if($scope.form.cconpassword == '' || $scope.form.cconpassword == undefined)
        {
             $scope.errcconpassword = 'background-color: #f7dede;';
             $scope.err++;
        }
        else
        {
            if($scope.form.cconpassword == $scope.form.cpassword)
            {
            $scope.errcconpassword ='background-color: #bfe5bc;';
             $scope.err--;
            }
            else
            {
                $scope.errcconpassword = 'background-color: #f7dede;';
                $scope.err++;
                alert('Password not Match !!');
            }
        }

        if($scope.form.cmobile == '' || $scope.form.cmobile == undefined)
        {
             $scope.errcmobile = 'background-color: #f7dede;';
             $scope.err++;
        }
        else
        {
            $scope.errcmobile ='background-color: #bfe5bc;';
             $scope.err--;
        }
   

        if($scope.form.caddress == '' || $scope.form.caddress == undefined)
        {
             $scope.errcaddress = 'background-color: #f7dede;';
             $scope.err++;
        }
        else
        {
            $scope.errcaddress = 'background-color: #bfe5bc;';
            $scope.err--;
        }

        
            if($scope.err == -6 )
            {

                /*$http({
              method: 'get',
              url: 'Model/c_cus.php?xorg='+$scope.form.cname+'&password='+$scope.form.cpassword+'&xcusemail='+$scope.form.cemail+'&xmobile='+$scope.form.cmobile+'&xdeliveryadd='+$scope.form.caddress+'&xagent='+$scope.rin+'&bin='+$scope.bin
             }).then(function successCallback(response) {
              $scope.cus = response.data[0];
              console.log(response.data);
             });*/


             $http.post(  
                    "api/c_cus.php",  
                    {'xorg':$scope.form.cname,'password':$scope.form.cpassword,'xcusemail':$scope.form.cemail,'xmobile':$scope.form.cmobile,'xdeliveryadd':$scope.form.caddress,'xagent':$scope.rin,'bin':$scope.bin}  
               ).then(function successCallback(response) {
                    $scope.cus = response.data[0];
                    alert($scope.cus.message +' Your CIN : '+$scope.cus.xcus);  
                  });
            }
        
}








$scope.confirm = function()
{
	if($scope.old == true)
	{
		if($scope.check() == false)
		{
			alert("Please Login first");
		}
	}

	if($scope.check() == true)
		{
			$scope.guest = false;
		}

	if($scope.retailer == true)
	{
		if($scope.check() == false)
		{
			alert("Please Login first");
		}
	}

	if($scope.guest == true)
	{
		$scope.err = 0;
		
		if($scope.form.fname == '' || $scope.form.lname == '' || $scope.form.aemail == '' || $scope.form.apassword == '' || $scope.form.phone =='' || $scope.form.fname == undefined || $scope.form.lname == undefined || $scope.form.aemail == undefined || $scope.form.apassword == undefined || $scope.form.phone == undefined )
		{
			alert("Please fill Personal details required Field");
		}

		if($scope.form.fname == '' || $scope.form.fname == undefined)
		{
			 $scope.errfname = 'background-color: #f7dede;';
			 $scope.err++;
		}
		else
		{
			 $scope.errfname = 'background-color: #bfe5bc;';
			 $scope.err--;
		}

		if($scope.form.lname == '' || $scope.form.lname == undefined)
		{
			 $scope.errlname = 'background-color: #f7dede;';
			 $scope.err++;
		}
		else
		{
			$scope.errlname = 'background-color: #bfe5bc;';
			 $scope.err--;
		}

		if($scope.form.aemail == '' || $scope.form.aemail == undefined)
		{
			 $scope.erraemail = 'background-color: #f7dede;';
			 $scope.err++;
		}
		else
		{
			$scope.erraemail ='background-color: #bfe5bc;';
			 $scope.err--;
		}

		if($scope.form.apassword == '' || $scope.form.apassword == undefined)
		{
			 $scope.errapassword = 'background-color: #f7dede;';
			 $scope.err++;
		}
		else
		{
			$scope.errapassword ='background-color: #bfe5bc;';
			 $scope.err--;
		}

		if($scope.form.phone == '' || $scope.form.phone == undefined)
		{
			 $scope.errphone = 'background-color: #f7dede;';
			 $scope.err++;
		}
		else
		{
			$scope.errphone ='background-color: #bfe5bc;';
			 $scope.err--;
		}
	}
		$scope.errm =0;
		$scope.address ='Company: '+ $scope.form.company + ', Address: ' + $scope.form.address + ', City :'+ $scope.form.city + ', postcode:' + $scope.form.postcode + ', State: '+$scope.form.state + ', Country:' + $scope.form.country;

		if($scope.form.address == '' || $scope.form.address == undefined)
		{
			 $scope.erraddress = 'background-color: #f7dede;';
			 $scope.errm++;
		}
		else
		{
			$scope.erraddress = 'background-color: #bfe5bc;';
			$scope.errm--;
		}

		if($scope.form.country == '' || $scope.form.country == undefined)
		{
			 $scope.errcountry = 'background-color: #f7dede;';
			 $scope.errm++;
		}
		else
		{
			$scope.errcountry ='background-color: #bfe5bc;';
			$scope.errm--;
		}

		if($scope.form.city == '' || $scope.form.city == undefined)
		{
			 $scope.errcity = 'background-color: #f7dede;';
			 $scope.errm++;
		}
		else
		{
			$scope.errcity ='background-color: #bfe5bc;';
			$scope.errm--;
		}

		if($scope.form.postcode == '' || $scope.form.postcode == undefined)
		{
			 $scope.errpostcode = 'background-color: #f7dede;';
			 $scope.errm++;
		}
		else
		{
			$scope.errpostcode ='background-color: #bfe5bc;';
			$scope.errm--;
		}

		if($scope.form.state == '' || $scope.form.state == undefined)
		{
			 $scope.errstate = 'background-color: #f7dede;';
			 $scope.errm++;
		}
		else
		{
			$scope.errstate ='background-color: #bfe5bc;';
			$scope.errm--;
		}

				if($scope.form.phone == undefined || $scope.form.phone == '')
				{
					$scope.phone = $scope.auth.phone;
					
				}
				else
				{
					$scope.phone = $scope.form.phone;
				}
				
				if($scope.form.comment == undefined || $scope.form.comment == '')
				{
					$scope.comment = '';
				}
				else
				{
					$scope.comment = $scope.form.comment;
				}

				if($scope.form.ref == undefined || $scope.form.ref == '')
				{
					$scope.ref = '';
				}
				else
				{
					$scope.ref = $scope.form.ref;
				}

		if($scope.guest == true)
		{
			if($scope.err == -5 && $scope.errm == -5)
			{
                if($scope.payment == 'Wallet')
                {
				$http.post(  
	                "Model/reg.php",  
	                {'fname':$scope.form.fname,'lname':$scope.form.lname,'password':$scope.form.apassword,'email':$scope.form.aemail,'phone':$scope.form.phone,'company':$scope.form.company,'address':$scope.form.address,'country':$scope.form.country}  
	           ).then(function successCallback(response) {
	                $scope.user = response.data;
	                $scope.uid =  $scope.user.lastId;
	                $http.post(  
	                "Model/order.php",  
	                {'total':$scope.fp(),'ref':$scope.ref,'scost':$scope.sp,'address':$scope.address,'phone':$scope.phone,'payment':$scope.payment,'user':$scope.uid,'comment':$scope.comment}  
	           ).then(function successCallback(response) {
	                $scope.order = response.data;
	                angular.forEach($scope.cart, function(value, key) {
	                  		$scope.pid = value.id;
				            $scope.oprice = value.price;
				            $scope.oqty = value.qty;
				            $scope.color = ''; 
				                  $http.post(  
							                "Model/orderdetails.php",  
							                {'orderId':$scope.order.orderId,'pId':$scope.pid,'on':$scope.order.orderNumber,'price':$scope.oprice,'qty':$scope.oqty,'color':$scope.color}  
							           ).then(function successCallback(response) {
							                $scope.od = response.data;
							              });     
				        });
	                  alert($scope.order.message);
	              });   
	              });
           }
           else
           {
            $location.path('payment');
           }
			}
		}
	else
		{
			if($scope.check() == true)
				{
					$scope.uid = $scope.auth.id;
				}
		if($scope.errm == -5)
			{
				$http.post(  
	                "Model/order.php",  
	                {'total':$scope.fp(),'ref':$scope.ref,'scost':$scope.sp,'address':$scope.address,'phone':$scope.phone,'payment':$scope.payment,'user':$scope.uid,'comment':$scope.comment}  
	           ).then(function successCallback(response) {
	                $scope.order = response.data;
	                  angular.forEach($scope.cart, function(value, key) {
	                  		$scope.pid = value.id;
				            $scope.oprice = value.price;
				            $scope.oqty = value.qty;
				            $scope.color = ''; 
				                  $http.post(  
							                "Model/orderdetails.php",  
							                {'orderId':$scope.order.orderId,'pId':$scope.pid,'on':$scope.order.orderNumber,'price':$scope.oprice,'qty':$scope.oqty,'color':$scope.color}  
							           ).then(function successCallback(response) {
							                $scope.od = response.data;
							              });     
				        });
	                  alert($scope.order.message);
	              });
	       	}
		}
}

$scope.od = [];

$scope.docnumber = function(bin,rin)
{

   if($cookies.getObject('auth') == "" || $cookies.getObject('auth') == null || $cookies.getObject('auth') == undefined)
        {
            $scope.rin = '';
        }
        else
        {
            $scope.rin = $scope.auth.rin;
        }

        if($cookies.getObject('auth') == "" || $cookies.getObject('auth') == null || $cookies.getObject('auth') == undefined)
        {
            $scope.bin = '';
        }
        else
        {
            $scope.bin = $scope.auth.bin;
        }


        $http({
  method: 'get',
  url: 'api/docnum.php?username=apiuser&password=1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67&bin='+$scope.bin+'&rin='+$scope.rin
 }).then(function successCallback(response) {
   $scope.od = response.data[0];

   $scope.form.odnum = $scope.od.dn;
 });


}

$scope.confirmr = function(odn)
{
        if($cookies.getObject('auth') == "" || $cookies.getObject('auth') == null || $cookies.getObject('auth') == undefined)
        {
            $scope.rin = '';
        }
        else
        {
            $scope.rin = $scope.auth.rin;
        }

        if($cookies.getObject('auth') == "" || $cookies.getObject('auth') == null || $cookies.getObject('auth') == undefined)
        {
            $scope.bin = '';
        }
        else
        {
            $scope.bin = $scope.auth.bin;
        }

    
        $scope.err = 0;
        

        if($scope.form.cin == '' || $scope.form.cin == undefined)
        {
             $scope.errcin = 'background-color: #f7dede;';
             $scope.err++;
        }
        else
        {
             $scope.errcin = 'background-color: #bfe5bc;';
             $scope.err--;
        }

        if($scope.form.name == '' || $scope.form.name == undefined)
        {
             $scope.errname = 'background-color: #f7dede;';
             $scope.err++;
        }
        else
        {
            $scope.errname = 'background-color: #bfe5bc;';
             $scope.err--;
        }

        if($scope.form.rfrin == '' || $scope.form.rfrin == undefined)
        {
             $scope.errrfrin = 'background-color: #f7dede;';
             $scope.err++;
        }
        else
        {
            $scope.errrfrin ='background-color: #bfe5bc;';
             $scope.err--;
        }

        if($scope.form.omobile == '' || $scope.form.omobile == undefined)
        {
             $scope.errmobile = 'background-color: #f7dede;';
             $scope.err++;
        }
        else
        {
            $scope.errmobile ='background-color: #bfe5bc;';
             $scope.err--;
        }

        if($scope.form.oaddress == '' || $scope.form.oaddress == undefined)
        {
             $scope.erroaddress = 'background-color: #f7dede;';
             $scope.err++;
        }
        else
        {
            $scope.erroaddress ='background-color: #bfe5bc;';
             $scope.err--;
        }
            if($scope.err == -5)
            {
                
                $scope.row = 0;
                $scope.cus = $scope.form.cin;
                $scope.cusname = $scope.form.name;
                $scope.odnum = $scope.form.odnum;
                if($scope.odnum != '' || $scope.odnum != undefined)
                {
                angular.forEach($scope.cart, function(value, key) {
                            $scope.pid = value.id;
                            $scope.row += 1;
                            $scope.qty = value.qty;
                            
                            $http.post(  
                                            "api/r_order.php",  
                                            {'id':value.id,'bin':$scope.bin,'rin':$scope.rin,'xrow':$scope.row,'refrin':$scope.form.rfrin,'xcus':$scope.cus,'xcusdt':$scope.cusname,'xqty':$scope.qty,'odnum':$scope.odnum}  
                                       ).then(function successCallback(response) {
                                            $scope.od = response.data[0];
                                            
                                          });  

                        
                        });
                if($scope.od >0 || $scope.od !='')
                {
                    alert('Order Posted Successfully...');
                    $scope.ch =[];
                        $cookies.putObject('chart',$scope.ch);
                    $scope.path = 'invoice_det/'+$scope.odnum;
                    $location.path($scope.path);
                }
                else
                {
                    alert('Order can\'t  Posted ');
                }

                }

                
        }
    
        
}

//7zy#L33v930m

$scope.docnum = function()
{

   if($cookies.getObject('auth') == "" || $cookies.getObject('auth') == null || $cookies.getObject('auth') == undefined)
        {
            $scope.rin = '';
        }
        else
        {
            $scope.rin = $scope.auth.rin;
        }

        if($cookies.getObject('auth') == "" || $cookies.getObject('auth') == null || $cookies.getObject('auth') == undefined)
        {
            $scope.bin = '';
        }
        else
        {
            $scope.bin = $scope.auth.bin;
        }


        $http({
  method: 'get',
  url: 'api/docnumber.php?username=apiuser&password=1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67&bin='+$scope.bin+'&rin='+$scope.rin
 }).then(function successCallback(response) {
   $scope.od = response.data[0];

   $scope.form.odnum = $scope.od.dn;
 });


}



$scope.confirmcor = function(odn)
{
        if($cookies.getObject('auth') == "" || $cookies.getObject('auth') == null || $cookies.getObject('auth') == undefined)
        {
            $scope.rin = '';
        }
        else
        {
            $scope.rin = $scope.auth.rin;
        }

        if($cookies.getObject('auth') == "" || $cookies.getObject('auth') == null || $cookies.getObject('auth') == undefined)
        {
            $scope.bin = '';
        }
        else
        {
            $scope.bin = $scope.auth.bin;
        }

    
        $scope.err = 0;
        $scope.er = 0;
        
        
        $cookies.put('name',$scope.form.name); 
        $scope.name = $cookies.get('name');
        $cookies.put('mn',$scope.form.omobile); 
        $scope.mn = $cookies.get('mn');
        $cookies.put('em',$scope.form.email); 
        $scope.em = $cookies.get('em');
        
        
        $scope.c =$cookies.getObject('chart');
    angular.forEach($scope.c, function(value, key) {
                            
                              $scope.ct = value.count;

                              if($scope.ct == 1)
                              {
                                  if($scope.form.outlet1 == '' || $scope.form.outlet1 == undefined)
                                {
                                     $scope.er = 1;
                                }
                                else
                                {
                                    $cookies.put('ot1',$scope.form.outlet1);
                                }
                            }
                            else if($scope.ct == 2)
                              {
                                  if($scope.form.outlet2 == '' || $scope.form.outlet2 == undefined)
                                {
                                     $scope.er = 1;
                                }
                                else
                                {
                                    $cookies.put('ot2',$scope.form.outlet2);
                                }
                            }

                            else if($scope.ct == 3)
                              {
                                  if($scope.form.outlet3 == '' || $scope.form.outlet3 == undefined)
                                {
                                     $scope.er = 1;
                                }
                                else
                                {
                                    $cookies.put('ot3',$scope.form.outlet3);
                                }
                            }
                            else if($scope.ct == 4)
                              {
                                  if($scope.form.outlet4 == '' || $scope.form.outlet4 == undefined)
                                {
                                     $scope.er = 1;
                                }
                                else
                                {
                                    $cookies.put('ot4',$scope.form.outlet4);
                                }
                            }
                            else if($scope.ct == 5)
                              {
                                  if($scope.form.outlet5 == '' || $scope.form.outlet5 == undefined)
                                {
                                     $scope.er = 1;
                                }
                                else
                                {
                                    $cookies.put('ot5',$scope.form.outlet5);
                                }
                            }
                            else 
                              {
                                     $scope.er = 0;
                            }
                                         
                        });
    if($scope.er==1)
    {
        alert('Select Outlet');
    }
    else
    {



        if($scope.form.cin == '' || $scope.form.cin == undefined)
        {
             $scope.errcin = 'background-color: #f7dede;';
             $scope.err++;
        }
        else
        {
             $scope.errcin = 'background-color: #bfe5bc;';
             $cookies.put('cin',$scope.form.cin);
             $scope.err--;
        }

        if($scope.form.name == '' || $scope.form.name == undefined)
        {
             $scope.errname = 'background-color: #f7dede;';
             $scope.err++;
        }
        else
        {
            $scope.errname = 'background-color: #bfe5bc;';
            $cookies.put('name',$scope.form.name);
             $scope.err--;
        }

        if($scope.form.rfrin == '' || $scope.form.rfrin == undefined)
        {
             $scope.errrfrin = 'background-color: #f7dede;';
             $scope.err++;
        }
        else
        {
            $scope.errrfrin ='background-color: #bfe5bc;';
            $cookies.put('rfrin',$scope.form.rfrin);
             $scope.err--;
        }

        if($scope.form.omobile == '' || $scope.form.omobile == undefined)
        {
             $scope.errmobile = 'background-color: #f7dede;';
             $scope.err++;
        }
        else
        {
            $scope.errmobile ='background-color: #bfe5bc;';
            $cookies.put('mobile',$scope.form.omobile);
             $scope.err--;
        }

        if($scope.form.oaddress == '' || $scope.form.oaddress == undefined)
        {
             $scope.erroaddress = 'background-color: #f7dede;';
             $scope.err++;
        }
        else
        {
            $scope.erroaddress ='background-color: #bfe5bc;';
             $scope.err--;
        }
            if($scope.err == -5)
            {



                if($scope.payment == 'Wallet')
                {

                $scope.row = 0;
                $scope.cus = $scope.form.cin;
                $scope.cusname = $scope.form.name;
                
                $scope.odnum = $scope.form.odnum;
                if($scope.odnum != '' || $scope.odnum != undefined)
                {
                angular.forEach($scope.cart, function(value, key) {
                            $scope.pid = value.id;
                            $scope.row += 1;
                            if(value.count ==1)
                            {
                                $scope.xsupdt = $scope.form.outlet1;
                            }
                            if(value.count ==2)
                            {
                                $scope.xsupdt = $scope.form.outlet2;
                            }
                            if(value.count ==3)
                            {
                                $scope.xsupdt = $scope.form.outlet3;
                            }
                            if(value.count ==4)
                            {
                                $scope.xsupdt = $scope.form.outlet4;
                            }
                            if(value.count ==5)
                            {
                                $scope.xsupdt = $scope.form.outlet5;
                            }
                            $scope.qty = value.qty;
                            
                            $http.post(  
                                            "api/c_order.php",  
                                            {'id':value.id,'bin':$scope.bin,'rin':$scope.rin,'xrow':$scope.row,'refrin':$scope.form.rfrin,'xcus':$scope.cus,'xcusdt':$scope.cusname,'xqty':$scope.qty,'odnum':$scope.odnum,'xsupdt':$scope.xsupdt,'xpay':$scope.payment}  
                                       ).then(function successCallback(response) {
                                            $scope.od = response.data[0];
                                            console.log($scope.od);
                                          });  

                        
                        });
                if($scope.od.id > 0 || $scope.od.id !='')
                {
                    alert('Order Posted Successfully...');
                    $scope.ch =[];
                        $cookies.putObject('chart',$scope.ch);
                    $scope.path = 'invoice_det/'+$scope.odnum;
                    $location.path($scope.path);
                }
                else
                {
                    alert('Order can\'t  Posted ');
                }

                }

                }
                else
                {
                    $location.path('payment_cor');
                   //alert("Online Payment Not available");
                }
        }
    
    }
}


$scope.confirmcorssl = function()
{

        if($cookies.getObject('auth') == "" || $cookies.getObject('auth') == null || $cookies.getObject('auth') == undefined)
        {
            $scope.rin = '';
        }
        else
        {
            $scope.rin = $scope.auth.rin;
        }

        if($cookies.getObject('auth') == "" || $cookies.getObject('auth') == null || $cookies.getObject('auth') == undefined)
        {
            $scope.bin = '';
        }
        else
        {
            $scope.bin = $scope.auth.bin;
        }



                $scope.row = 0;
                $scope.cus = $cookies.get('cin');
                $scope.cusname = $cookies.get('name');
                $scope.rfrin = $cookies.get('rfrin');
                $scope.odnum = $routeParams.cnum;
                if($scope.odnum != '' || $scope.odnum != undefined)
                {
                angular.forEach($scope.cart, function(value, key) {
                            $scope.pid = value.id;
                            $scope.row += 1;
                            if(value.count ==1)
                            {
                                $scope.xsupdt = $cookies.get('ot1');
                            }
                            if(value.count ==2)
                            {
                                $scope.xsupdt = $cookies.get('ot2');
                            }
                            if(value.count ==3)
                            {
                                $scope.xsupdt = $cookies.get('ot3');
                            }
                            if(value.count ==4)
                            {
                                $scope.xsupdt = $cookies.get('ot4');
                            }
                            if(value.count ==5)
                            {
                                $scope.xsupdt = $cookies.get('ot5');
                            }
                            $scope.qty = value.qty;
                            
                            //alert(value.id+$scope.bin+$scope.rin+$scope.row+$scope.rfrin+$scope.cus+$scope.cusname+$scope.qty+$scope.odnum+$scope.xsupdt+$scope.payment);

                            $http.post(  
                                            "api/c_order.php",  
                                            {'id':value.id,'bin':$scope.bin,'rin':$scope.rin,'xrow':$scope.row,'refrin':$scope.rfrin,'xcus':$scope.cus,'xcusdt':$scope.cusname,'xqty':$scope.qty,'odnum':$scope.odnum,'xsupdt':$scope.xsupdt,'xpay':$scope.payment}  
                                       ).then(function successCallback(response) {
                                            $scope.od = response.data[0];
                                            console.log($scope.od);
                                          });  

                        
                        });
                if($scope.od = "" || $scope.od != undefined)
                {
                    alert('Order Posted Successfully...');
                    $scope.ch =[];
                        $cookies.putObject('chart',$scope.ch);
                    $scope.path = 'invoice_det/'+$scope.odnum;
                    $location.path($scope.path);
                }
                else
                {
                    alert('Order can\'t  Posted ');
                }

                }

        
}

$scope.reqnum = function(bin,rin)
{

   if($cookies.getObject('auth') == "" || $cookies.getObject('auth') == null || $cookies.getObject('auth') == undefined)
        {
            $scope.rin = '';
        }
        else
        {
            $scope.rin = $scope.auth.rin;
        }

        if($cookies.getObject('auth') == "" || $cookies.getObject('auth') == null || $cookies.getObject('auth') == undefined)
        {
            $scope.bin = '';
        }
        else
        {
            $scope.bin = $scope.auth.bin;
        }


        $http({
  method: 'get',
  url: 'api/reqnum.php?username=apiuser&password=ca0af5821f64fbcce24a2d24dff5efb6b1746a0de0c9e69c605c4fbe924d2fd8&bin='+$scope.bin+'&rin='+$scope.rin
 }).then(function successCallback(response) {
   $scope.req = response.data[0];

   $scope.form.reqnum = $scope.req.dn;

   
 });


}


$scope.confirmreq = function()
{
        if($cookies.getObject('auth') == "" || $cookies.getObject('auth') == null || $cookies.getObject('auth') == undefined)
        {
            $scope.rin = '';
        }
        else
        {
            $scope.rin = $scope.auth.rin;
        }

        if($cookies.getObject('auth') == "" || $cookies.getObject('auth') == null || $cookies.getObject('auth') == undefined)
        {
            $scope.bin = '';
        }
        else
        {
            $scope.bin = $scope.auth.bin;
        }

    
        $scope.err = 0;
        

        if($scope.form.comment == '' || $scope.form.comment == undefined)
        {
             $scope.errcom = 'background-color: #f7dede;';
             $scope.err++;
        }
        else
        {
             $scope.errcom = 'background-color: #bfe5bc;';
             $scope.err--;
        }
 
    

            //$scope.cmt.push({com:$scope.form.comment});
                 $cookies.put('cmt',$scope.form.comment); 
                 $scope.cmnt = $cookies.get('cmt');
                 $cookies.put('em',$scope.form.email); 
                 $scope.em = $cookies.get('em');
                 $scope.reqnum = $scope.form.reqnum;

                 
       
            if($scope.err == -1)
            {
                if($scope.payment == 'Wallet')
                {
                $scope.reqnum = $scope.form.reqnum;
                $scope.xnote = $scope.form.comment;


                $scope.usr = 'apiuser';
                $scope.psw = '1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67';
                $http.post(  
                "api/req.php",  
                {'username':$scope.usr,'password':$scope.psw ,'rin':$scope.rin, 'bin':$scope.bin,'reqnum':$scope.reqnum,'xnote':$scope.xnote,'xpaymethod':$scope.payment}  
                    ).then(function successCallback(response) {
                     $scope.reqd = response.data['0'];
                     
                     if($scope.reqd.r == 1)
                     {
                        alert("Requisition Posted Successfully");
                        $scope.row = 0;


                        angular.forEach($scope.cart, function(value, key) {
                            $scope.row += 1;
                            $scope.qty = value.qty;
                            $scope.rate = value.rprice;
                            $scope.sku = value.xitemcode;
                            
                            $http.post(  
                                "http://37.34.252.0/api/reqdt.php",  
                                {'username':$scope.usr,'password':$scope.psw,'rin':$scope.rin,'reqnum':$scope.reqnum,'xrow':$scope.row,'xitemcode':$scope.sku,'xqty':$scope.qty,'rate':$scope.rate,'xpaymethod':$scope.payment}  
                                 ).then(function successCallback(response) {
                                            $scope.reqdet = response.data[0];
                                            
                                          });                          
                        });

                        $scope.ch =[];
                        $cookies.putObject('chart',$scope.ch);
                        $location.path('home');

                    }
                    else
                        {
                            alert("Requisition can't Posted");
                        }


                     });
               }
               else if($scope.payment == 'Bkash')
               {
                   
                   $scope.url = 'bkashreq/'+$scope.reqnum;
                $location.path($scope.url);
               }
               else
               {
                $location.path('payment_req');
               }
        }
    
        
}


$scope.confirmreqssl = function()
{
        if($cookies.getObject('auth') == "" || $cookies.getObject('auth') == null || $cookies.getObject('auth') == undefined)
        {
            $scope.rin = '';
        }
        else
        {
            $scope.rin = $scope.auth.rin;
        }

        if($cookies.getObject('auth') == "" || $cookies.getObject('auth') == null || $cookies.getObject('auth') == undefined)
        {
            $scope.bin = '';
        }
        else
        {
            $scope.bin = $scope.auth.bin;
        }

    
        $scope.err = 0;
    
        $scope.rnum = $routeParams.rnum;
        

        
            if($scope.err == 0)
            {
                
                $scope.reqnum = $routeParams.rnum;
                $scope.xnote = $scope.cmnt;


                $scope.usr = 'apiuser';
                $scope.psw = '1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67';
                
                $http.post(  
                "api/req.php",  
                {'username':$scope.usr,'password':$scope.psw ,'rin':$scope.rin, 'bin':$scope.bin,'reqnum':$scope.reqnum,'xnote':$scope.xnote,'xpaymethod':$scope.payment}  
                    ).then(function successCallback(response) {
                     $scope.reqd = response.data['0'];
                     
                     if($scope.reqd.r == 1)
                     {
                        alert("Requisition Posted Successfully");
                        $scope.row = 0;


                        angular.forEach($scope.cart, function(value, key) {
                            $scope.row += 1;
                            $scope.qty = value.qty;
                            $scope.rate = value.rprice;
                            $scope.sku = value.xitemcode;
                            
                            $http.post(  
                                "api/reqdt.php",  
                                {'username':$scope.usr,'password':$scope.psw,'rin':$scope.rin,'reqnum':$scope.reqnum,'xrow':$scope.row,'xitemcode':$scope.sku,'xqty':$scope.qty,'rate':$scope.rate,'xpaymethod':$scope.payment}  
                                 ).then(function successCallback(response) {
                                            $scope.reqdet = response.data[0];
                                            
                                          });                          
                        });

                        $scope.ch =[];
                        $cookies.putObject('chart',$scope.ch);
                        $cookies.put('cmt',$scope.ch);
                        $location.path('home');

                    }
                    else
                        {
                            alert("Requisition can't Posted");
                        }


                     });
               
        }
    
        
}




$scope.b_pay = function() { 
    $scope.id = $scope.form.trxid;

  $http({
  method: 'get',
  url: 'Model/bkash.php?trxid='+$scope.id
 }).then(function successCallback(response) {
  $scope.bkash = response.data[0];
  if($scope.bkash.trxst[0] == '0000')
  {
        if($cookies.getObject('auth') == "" || $cookies.getObject('auth') == null || $cookies.getObject('auth') == undefined)
        {
            $scope.rin = '';
        }
        else
        {
            $scope.rin = $scope.auth.rin;
        }

        if($cookies.getObject('auth') == "" || $cookies.getObject('auth') == null || $cookies.getObject('auth') == undefined)
        {
            $scope.bin = '';
        }
        else
        {
            $scope.bin = $scope.auth.bin;
        }

    
        $scope.err = 0;
    
        $scope.rnum = $routeParams.rnum;
        

        
            if($scope.err == 0)
            {
                
                $scope.reqnum = $routeParams.rnum;
                $scope.xnote = $scope.cmnt;


                $scope.usr = 'apiuser';
                $scope.psw = '1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67';
                
                $http.post(  
                "api/req.php",  
                {'username':$scope.usr,'password':$scope.psw ,'rin':$scope.rin, 'bin':$scope.bin,'reqnum':$scope.reqnum,'xnote':$scope.xnote,'xpaymethod':$scope.payment}  
                    ).then(function successCallback(response) {
                     $scope.reqd = response.data['0'];
                     
                     if($scope.reqd.r == 1)
                     {
                        alert("Requisition Posted Successfully");
                        $scope.row = 0;


                        angular.forEach($scope.cart, function(value, key) {
                            $scope.row += 1;
                            $scope.qty = value.qty;
                            $scope.rate = value.rprice;
                            $scope.sku = value.xitemcode;
                            
                            $http.post(  
                                "api/reqdt.php",  
                                {'username':$scope.usr,'password':$scope.psw,'rin':$scope.rin,'reqnum':$scope.reqnum,'xrow':$scope.row,'xitemcode':$scope.sku,'xqty':$scope.qty,'rate':$scope.rate,'xpaymethod':$scope.payment}  
                                 ).then(function successCallback(response) {
                                            $scope.reqdet = response.data[0];
                                            
                                          });                          
                        });

                        $scope.ch =[];
                        $cookies.putObject('chart',$scope.ch);
                        $cookies.put('cmt',$scope.ch);
                        $location.path('home');

                    }
                    else
                        {
                            alert("Requisition can't Posted");
                        }


                     });
               
        }
    }
    else
    {
        alert($scope.bkash.message);
    }
 });
}





$scope.wallet = function()
{
	$scope.purl= '#!wallet';
    $scope.cbal();
    
	return $scope.payment = "Wallet";
}

$scope.ssl = function()
{
	$scope.purl= '#!ssl';
	return $scope.payment = "Online payment";
}

$scope.bkash = function()
{
	$scope.purl= '#!bkash';
	return $scope.payment = "Bkash";
}

$scope.logout = function()
{
	$scope.au =[];
    $cookies.putObject('auth',$scope.au); 
    $scope.old = false;
    $scope.retailer = false;
    $scope.cbal();
    $scope.show();
    return $scope.guest = true;
}


$scope.bv = function() { 
$scope.bv = $routeParams.bv;
$scope.startfrom = $scope.parpage*$scope.page;
$scope.ofset = $scope.startfrom;
    
  $http({
  method: 'get',
  url: 'api/bv.php?username=apiuser&password=1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67&bv='+$scope.bv+'&lim='+$scope.parpage+'&ofset='+$scope.ofset
 }).then(function successCallback(response) {
  $scope.bv_p();
  $scope.bproduct = response.data;
 });
}


$scope.bv_p = function()
{
    $scope.bv = $routeParams.bv;
    
    $http({
  method: 'get',
  url: 'api/bv_p.php?username=apiuser&password=1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67&bv='+$scope.bv
 }).then(function successCallback(response) {
   $scope.np = response.data;
$scope.totalPage =  Math.ceil($scope.np/$scope.parpage);
$scope.tlp =[];
$scope.lid =0;
for (var i = 0; i < $scope.totalPage; i++) {
        $scope.tlp.push(i);
        $scope.lid+=1;
        }
 });
return $scope.lid;
}


$scope.search = function() { 

$scope.startfrom = $scope.parpage*$scope.page;
$scope.ofset = $scope.startfrom;
if( $scope.form.search == undefined || $scope.form.search =='' )
{
            $scope.q = '';
  $http({
  method: 'get',
  url: 'api/search.php?username=apiuser&password=1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67&lim='+$scope.parpage+'&ofset='+$scope.ofset
 }).then(function successCallback(response) {
  $scope.sproduct = response.data;
  $scope.search_p();
 });   
}
else
{
	$scope.q = $scope.form.search;
  $http({
  method: 'get',
  url: 'api/search.php?username=apiuser&password=1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67&q='+$scope.q+'&lim='+$scope.parpage+'&ofset='+$scope.ofset
 }).then(function successCallback(response) {
  $scope.search_p();
  $scope.sproduct = response.data;
 });
}
}

$scope.new_p = function() { 

  $http({
  method: 'get',
  url: 'api/new_item.php?username=apiuser&password=1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67'
 }).then(function successCallback(response) {
  $scope.nproduct = response.data;
 });
}

$scope.rel_p = function() { 

  $http({
  method: 'get',
  url: 'api/rel_item.php?username=apiuser&password=1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67&cat='+$scope.ctgid
 }).then(function successCallback(response) {
  $scope.rproduct = response.data;
 });
}

$scope.cat = function() { 

  $http({
  method: 'get',
  url: 'api/category.php?username=apiuser&password=1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67'
 }).then(function successCallback(response) {
  $scope.xcat = response.data;
 });
}

$scope.invoice = function() { 
    if($cookies.getObject('auth') == "" || $cookies.getObject('auth') == null || $cookies.getObject('auth') == undefined)
        {
            $scope.rin = '';
        }
        else
        {
            $scope.rin = $scope.auth.rin;
        }

  $http({
  method: 'get',
  url: 'api/invoice_list.php?username=apiuser&password=1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67&rin='+$scope.rin
 }).then(function successCallback(response) {
  $scope.invoice = response.data;
 });
}

$scope.tdis= 0;
$scope.tr = 0;
$scope.tbv = 0;




$scope.invoice_det = function() { 
    $scope.inv = $routeParams.invnum;

  $http({
  method: 'get',
  url: 'api/invoice_det.php?username=apiuser&password=1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67&invnum='+$scope.inv
 }).then(function successCallback(response) {
  $scope.invoicedet = response.data;
  angular.forEach($scope.invoicedet, function(value, key) {
                            $scope.tdis += (value.xdisc-0);  
                            $scope.tr += (value.xqty * value.xsalesprice);
                            $scope.tbv += (value.xpoint-0);          
                        });
 });
}

$scope.search_p = function()
{
    $scope.q = $scope.form.search;
    if( $scope.form.search == undefined || $scope.form.search =='' )
{
    $http({
  method: 'get',
  url: 'api/search_page.php?username=apiuser&password=1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67'
 }).then(function successCallback(response) {
   $scope.np = response.data;
$scope.totalPage =  Math.ceil($scope.np/$scope.parpage);
$scope.tlp =[];
$scope.lid =0;
for (var i = 0; i < $scope.totalPage; i++) {
        $scope.tlp.push(i);
        $scope.lid+=1;
        }
 });
}
else
{
    $http({
  method: 'get',
  url: 'api/search_page.php?username=apiuser&password=1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67&q='+$scope.q
 }).then(function successCallback(response) {
   $scope.np = response.data;
$scope.totalPage =  Math.ceil($scope.np/$scope.parpage);
$scope.tlp =[];
$scope.lid =0;
for (var i = 0; i < $scope.totalPage; i++) {
        $scope.tlp.push(i);
        $scope.lid+=1;
        }
 });
return $scope.lid;
}
}

$scope.allsrcproduct = function()
{
	$scope.qa = $scope.form.search;
	if( $scope.form.search == undefined || $scope.form.search =='' )
{
	$http({
  method: 'get',
  url: 'Model/allsrcProduct.php'
 }).then(function successCallback(response) {
   $scope.np = response.data;
$scope.totalPage =  Math.ceil($scope.np/$scope.parpage);
$scope.tlp =[];
$scope.lid =0;
for (var i = 0; i < $scope.totalPage; i++) {
        $scope.tlp.push(i);
        $scope.lid+=1;
        }
 });
}
else
{
	$http({
  method: 'get',
  url: 'Model/allsrcProduct.php?q='+$scope.qa
 }).then(function successCallback(response) {
   $scope.np = response.data;
$scope.totalPage =  Math.ceil($scope.np/$scope.parpage);
$scope.tlp =[];
$scope.lid =0;
for (var i = 0; i < $scope.totalPage; i++) {
        $scope.tlp.push(i);
        $scope.lid+=1;
        }
 });
return $scope.lid;
}
}


$scope.add =function(id,qty,name,image,price,rprice,sku,source,point)
{
    $scope.source = source;



    if($cookies.getObject('auth') == "" || $cookies.getObject('auth') == null || $cookies.getObject('auth') == undefined)
        {
            $scope.rin = '';
        }
        else
        {
            $scope.rin = $scope.auth.rin;
        }

    if($scope.rin != '')
    {

    if($scope.source == 'OSP')
    {
	$scope.id = id;
	$scope.qty = qty;
    $scope.sku = sku;
	$scope.name = name;
	$scope.image = image;
	$scope.price = price;
    $scope.rprice = rprice;
    $scope.source = source;
    $scope.bv = point;

    if($cookies.get('ck') == 'true' || $cookies.get('ck') == 'corporate')
    {
       // $cookies.remove("chart");
       $scope.car = $cookies.getObject('chart');
       angular.forEach($scope.car, function (index, value) {
             $scope.remove(index-1);
             $scope.tp();
            $scope.fp();
        });
       
        //alert($cookies.getObject('chart'));
        if($cookies.getObject('chart') == '' || $cookies.getObject('chart').length <= 0)
        {
            $scope.rck = false;
        $cookies.put('ck',$scope.rck);
        $scope.add(id,qty,name,image,price,rprice,sku,source);
            $scope.show();
        }
        
    }
    else
    {

	$scope.duplicate = 0;
	angular.forEach($scope.cart, function(value, key) {
	                  		if ( value.id == id)
	                  		{
	                  			$scope.duplicate = 1;
	                  			$scope.plus(id);
	                  		}            
				        });
	if($scope.duplicate == 0)
	{
 $scope.ch.push({id:$scope.id, qty:$scope.qty, name:$scope.name, image:$scope.image , price:$scope.price, rprice:$scope.rprice, xitemcode:$scope.sku,source:$scope.source,bv:$scope.bv});
 $cookies.putObject('chart',$scope.ch); 
 $scope.cart = $cookies.getObject('chart');
 $scope.rck=false;
 $cookies.put('ck',$scope.rck); 
 $scope.cbal();
 $scope.show();
 $scope.tp();
 $scope.fp();
	}
	else
	{
		//alert("Already added to Cart");
	}
}
}
else
{
    alert('Only Retail Product');
}
}
else
{
    $scope.id = id;
    $scope.qty = qty;
    $scope.sku = sku;
    $scope.name = name;
    $scope.image = image;
    $scope.price = price;
    $scope.rprice = rprice;
    $scope.source = source;
    $scope.bv = point;
    $scope.duplicate = 0;
    angular.forEach($scope.cart, function(value, key) {
                            if ( value.id == id)
                            {
                                $scope.duplicate = 1;
                                $scope.plus(id);
                            }            
                        });
    if($scope.duplicate == 0)
    {
 $scope.ch.push({id:$scope.id, qty:$scope.qty, name:$scope.name, image:$scope.image , price:$scope.price, rprice:$scope.rprice, xitemcode:$scope.sku,source:$scope.source,bv:$scope.bv});
 $cookies.putObject('chart',$scope.ch); 
 $scope.cart = $cookies.getObject('chart');
 $scope.rck=false;
 $cookies.put('ck',$scope.rck); 
 $scope.cbal();
 $scope.show();
 $scope.tp();
 $scope.fp();

 var x = document.getElementById("snackbar");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
    }
    else
    {
        //alert("Already added to Cart");
    }
}
}

$scope.cle = function()
{
   return $cookies.remove("chart");
}
$scope.addr =function(id,qty,name,image,price,rprice,sku,point)
{
    $scope.id = id;
    $scope.sku = sku;
    $scope.qty = qty;
    $scope.name = name;
    $scope.image = image;
    $scope.price = price;
    $scope.rprice = rprice;
    $scope.bv = point;
    if($cookies.get('ck') == 'false' || $cookies.get('ck') == 'corporate')
    {
       // $cookies.remove("chart");
       $scope.car = $cookies.getObject('chart');
       angular.forEach($scope.car, function (index, value) {
             $scope.remove(index-1);
             $scope.tp();
            $scope.fp();
        });
       
        //alert($cookies.getObject('chart'));
        if($cookies.getObject('chart') == '' || $cookies.getObject('chart').length <= 0)
        {
            $scope.rck= true;
        $cookies.put('ck',$scope.rck);
        $scope.addr(id,qty,name,image,price,rprice,sku,point);
            $scope.show();
        }
        
    }
    else
    {
    
    $scope.duplicate = 0;
    angular.forEach($scope.cart, function(value, key) {
                            if ( value.id == id)
                            {
                                $scope.duplicate = 1;
                                $scope.plus(id);
                            }            
                        });
    if($scope.duplicate == 0)
    {
 $scope.ch.push({id:$scope.id, qty:$scope.qty, name:$scope.name, image:$scope.image , price:$scope.price, rprice:$scope.rprice, xitemcode:$scope.sku,bv:$scope.bv });
 $cookies.putObject('chart',$scope.ch); 
 $scope.cart = $cookies.getObject('chart');
 $scope.rck= true;
 $cookies.put('ck',$scope.rck);
 $scope.show();
 $scope.tp();
 $scope.fp();
    }
    else
    {
        //alert("Already added to Cart");
    }
}

}



$scope.addc =function(id,qty,name,image,price,sup,sku,point)
{
    
    $scope.id = id;
    $scope.sku = sku;
    $scope.qty = qty;
    $scope.name = name;
    $scope.image = image;
    $scope.price = price;
    $scope.sup = sup; 
    $scope.bv = point;
    if($cookies.get('ck') == 'false' || $cookies.get('ck') == 'true')
    {
       // $cookies.remove("chart");
       $scope.car = $cookies.getObject('chart');
       angular.forEach($scope.car, function (index, value) {
             $scope.remove(index);
        });
       
        //alert($cookies.getObject('chart'));
        if($cookies.getObject('chart') == '' || $cookies.getObject('chart').length <= 0)
        {
            $scope.rc= 'corporate';
            $cookies.put('ck',$scope.rc);
        $scope.addc(id,qty,name,image,price,sup,sku,point);
            $scope.show();
        }
        
    }
    else
    {
    $scope.duplicate = 0;
    angular.forEach($scope.cart, function(value, key) {
                            if ( value.id == id)
                            {
                                $scope.duplicate = 1;
                                $scope.plus(id);
                            }
                            if((value.count-0) >=5 )
                            {
                                alert('you added maximum number of cart');
                                $scope.duplicate = 1;
                            }            
                        });
    if($scope.duplicate == 0)
    {
        $scope.count +=1;
        $scope.outlet ='form.outlet'+$scope.count;
 $scope.ch.push({count:$scope.count,id:$scope.id, qty:$scope.qty, name:$scope.name, image:$scope.image , price:$scope.price, sup:$scope.sup, xitemcode:$scope.sku,bv:$scope.bv,outlet:$scope.outlet });
 $cookies.putObject('chart',$scope.ch); 
 $scope.cart = $cookies.getObject('chart');
 console.log($scope.cart);
 $scope.rc= 'corporate';
 $cookies.put('ck',$scope.rc);
 $scope.show();
 $scope.tp();
 $scope.fp();
    }
    else
    {
        //alert("Already added to Cart");
    }

}


}






}]);


