<?php
	$iconarray=array(
		"Inbox"=>"fa fa-envelope",
		"General Settings"=>"fa fa-codepen",
		"Code Settings"=>"fa fa-plus-circle",
		"Core Settings"=>"fa fa-plus-circle",
		"GL Settings"=>"fa fa-calculator",
		"GL Interface"=>"fa fa-eye",
		"General Ledger"=>"fa fa-eye",
		"Inventory"=>"fa fa-stack-exchange",
		"Purchase"=>"fa fa-shopping-cart",
		"Manufacturing"=>"fa fa-industry",
		"Reports"=>"fa fa-align-left",
		"Sales"=>"fa fa-cubes",
		"Payroll"=>"fa fa-paypal",
		"Students"=>"fa fa-graduation-cap",
		"User Roles"=>"fa fa-user-plus",
		"SMS"=>"fa fa-envelope",
		"Routine"=>"fa fa-hourglass-half",
		"Attendance"=>"fa fa-snowflake-o",
		"Human Resource"=>"fa fa-users",
		"HRM Settings"=>"fa fa-cogs",
		"Approval"=>"fa fa-file",
    "Settings"=>"fa fa-cogs",
    "Member Settings"=>"fa fa-users",
	);
	$bizid = "";
	$mainmenus=array();
	if (isset($_SESSION["sbizid"])){
		$bizid = $_SESSION["sbizid"];
		
		$menus = $_SESSION["mainmenus"];
		
			
			for($i=0; $i<count($menus); $i++){
				
				$mainmenus[$menus[$i]['xmenu']][]=$menus[$i]['xsubmenuindex'].",".$menus[$i]['xsubmenu'].",".$menus[$i]['xurl'];
				
			}
	}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
	  <meta charset="utf-8">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <meta http-Equiv="Cache-Control" Content="no-cache">
      <meta http-Equiv="Pragma" Content="no-cache">
      <meta http-Equiv="Expires" Content="0">
	  <link rel="icon" href="<?php echo URL; ?>public/images/bizdir/100.jpg">
		  <title><?php echo APPNAME; ?></title>
	  <!-- Tell the browser to be responsive to screen width -->
	  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	  <link rel="icon" href="<?php echo URL; ?>public/images/icon/pvoice.ico">
	  <!-- Bootstrap 3.3.7 -->
	  <link rel="stylesheet" href="<?php echo URL; ?>public/theme/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- UI Autucomplete CSS -->
    <link href="<?php echo URL; ?>public/css/jquery-ui.css" rel="stylesheet">
	  <!-- Font Awesome -->
	  <link rel="stylesheet" href="<?php echo URL; ?>public/theme/bower_components/font-awesome/css/font-awesome.min.css">
	  <!-- Ionicons -->
	  <link rel="stylesheet" href="<?php echo URL; ?>public/theme/bower_components/Ionicons/css/ionicons.min.css">
	  <!-- Theme style -->
	  <link rel="stylesheet" href="<?php echo URL; ?>public/theme/dist/css/AdminLTE.min.css">
	  <!-- AdminLTE Skins. Choose a skin from the css/skins
		   folder instead of downloading all of them to reduce the load. -->
	  <link rel="stylesheet" href="<?php echo URL; ?>public/theme/dist/css/skins/_all-skins.min.css">
	  <!-- jvectormap -->
	  <link rel="stylesheet" href="<?php echo URL; ?>public/theme/bower_components/jvectormap/jquery-jvectormap.css">
	  <!-- Date Picker -->
	  <link rel="stylesheet" href="<?php echo URL; ?>public/theme/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
	  <!-- Daterange picker -->
	  <link rel="stylesheet" href="<?php echo URL; ?>public/theme/bower_components/bootstrap-daterangepicker/daterangepicker.css">
	  <!-- bootstrap wysihtml5 - text editor -->
	  <link rel="stylesheet" href="<?php echo URL; ?>public/theme/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	  <!-- Dashboard -->
	  <link rel="stylesheet" href="<?php echo URL; ?>public/css/dashboard/dashboard.css">
	  <script>
		function myFunction() {
			var url = window.location;
			// Will only work if string in href matches with location
			$('.treeview-menu li a[href="' + url + '"]').parent().addClass('active');
			// Will also work for relative and absolute hrefs
			$('.treeview-menu li a').filter(function() {
				return this.href == url;
			}).parent().parent().parent().addClass('active');
		}
	  </script>
	  <script>
			<?php

			  $uri = URL;
			  $bizname = Session::get('sbizlong');
			  $branch = Session::get('sbranch');
			  $bizadd = Session::get('sbizadd');
			  
			  echo "var baseuri = '{$uri}';";
			  echo "var bizname = '{$bizname}';";
			  echo "var branch = '{$branch}';";
			  echo "var bizadd = '{$bizadd}';";

			?>
		</script>

	  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	  <!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	  <![endif]-->
        <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
	  <!-- Google Font -->
	  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">	 
    </head>
    <body class="hold-transition skin-blue sidebar-mini" onload="myFunction();">
	  <div class="wrapper">
		  <header class="main-header">
		  <?php if(Session::get('srole')=="MEMBERS"){
				$mainmanu = "mainmenu/members";
			}else{
				$mainmanu = "mainmenu";
			} ?>
			<!-- Logo -->
			<a href="<?php echo URL.$mainmanu; ?>" class="logo">
			  <!-- mini logo for sidebar mini 50x50 pixels -->
			  <span class="logo-mini"><b>  <img class="" src="<?php echo URL; ?>public/images/side-logo.png" style="width: 30px;"> </span>
			  <!-- logo for regular state and mobile devices -->
			  <span class="logo-lg" style="font-weight: 600;"><img class="" src="<?php echo URL; ?>public/images/bizdir/100.jpg" style="width: 100px;"></span>
			</a>
			<!-- Header Navbar: style can be found in header.less -->
			<nav class="navbar navbar-static-top">
			  <!-- Sidebar toggle button-->
			  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
				<span class="sr-only">Toggle navigation</span>
			  </a>

			  <div class="navbar-custom-menu pull-left">
				<ul class="nav navbar-nav">
					<ul class="nav navbar-nav">
					  <!-- User Account: style can be found in dropdown.less -->
					  <li class="">
						  <span>
							<p class="new__p">
								<?php echo Session::get('sbizlong'); ?>
							</p>
						  </span>
						
					  </li>
					</ul>
				</ul>
			  </div>

			  <div class="navbar-custom-menu">	

				<?php					
					$id = Session::get('suser');
					$file='images/management/'.$id .'.jpg';
				    $imagename = "";	
					if(file_exists($file))
						$imagename = $file;
					else
						$imagename = 'images/products/noimage.jpg'; 
					?>
				  
				<ul class="nav navbar-nav">
				  <!-- User Account: style can be found in dropdown.less -->
                    <!--   toggle notfication-->
                    <?php 
                    if(Session::get('slevel') !=""){
                    ?>
                    <li class="dropdown user user-menu">
                        <a href="<?php echo URL; ?>approvallist">

                            <i class="fa fa-bell" aria-hidden="true"></i>
                           <span id="notification" class="badge bg-red" style="position: absolute;top: 6px;left: 27px;">0</span>
<!--                            Pending Request-->
                        </a>
                    </li>
                    <?php 
                    }
                    ?>
                    <!--   toggle notfication-->
                    

				  <li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					  <?php $file="" ?>
					  <img src="<?php echo URL; ?><?php echo $imagename ?>" class="user-image" alt="User Image">
					  <span class="hidden-xs">Profile</span>
					</a>
					<ul class="dropdown-menu">
					   <!-- User image -->

					  <li class="user-header">
						<img src="<?php echo URL; ?><?php echo $imagename ?>" class="img-circle" alt="User Image">
						<p>User : <?php echo Session::get('suser') ?></p>
						<?php if(Session::get('srole')=="MEMBERS"){ ?>
							<p>Name : <?php echo Session::get('sname') ?></p>
						<?php } ?>
					  </li>	
					  <!-- Menu Footer-->
					  <li class="user-footer">
					  <?php if (Session::get('srole')=="MEMBERS"){?>
						<div class="pull-left">
						  <a href="<?php echo URL.'profilemem/showuser/'.Session::get('suser'); ?>" class="btn btn-default btn-flat">Profile Update</a>
						</div>
						<div class="pull-right">
						  <a href="<?php echo URL; ?>mainmenu/logoutmem/<?php echo $bizid; ?>" class="btn btn-default btn-flat">Sign out</a>
						</div>
						<?php } else {?>
						<div class="pull-left">
						  <a href="<?php echo URL.'profile/showuser/'.Session::get('susersl'); ?>" class="btn btn-default btn-flat">Profile Update</a>
						</div>
						<div class="pull-right">
						  <a href="<?php echo URL; ?>mainmenu/logout/<?php echo $bizid; ?>" class="btn btn-default btn-flat">Sign out</a>
						</div>
						<?php } ?>
					  </li>
					</ul>
				  <!-- Control Sidebar Toggle Button -->
				  <!-- <li>
					<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
				  </li> -->
				</ul>
			  </div>
			</nav>
		  </header>

		  <div class="new_header_concep">  </div>
	  
		<aside class="main-sidebar">
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
			  <!-- sidebar menu: : style can be found in sidebar.less -->
			  <div class="user-panel">
				<div class="pull-left image">
				  <img src="<?php echo URL; ?><?php echo $imagename ?>" class="img-circle" alt="User Image">
				</div>
				<div class="pull-left info">
				  <p><?php echo Session::get('suser') ?></p>
				  <?php if (Session::get('srole')=="MEMBERS"){
					  $online = Session::get('sname');
				  }else{
					  $online = "Online";
				  } ?>
				  <a href="#"><i class="fa fa-circle text-success"></i> <?php echo $online; ?></a>
				</div>
			  </div>
			  <ul class="sidebar-menu" data-widget="tree">
			  <?php $i=0; foreach ($mainmenus as $key=>$value){ $menuid = explode(' ', $key); $i++; ?>
				  <?php if($i<2){ ?>

					<li><a href="<?php echo URL.$mainmanu; ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
				  <?php } ?>
				<li class="treeview">
				  <a href="#">
					<i class="<?php echo $iconarray[$key]; ?>"></i> <span><?php echo $key;?></span>
					<span class="pull-right-container">
					  <i class="fa fa-angle-left pull-right"></i>
					</span>
				  </a>
				  <ul class="treeview-menu">
				  <?php asort($value); foreach($value as $subkey=>$submenu){ $menuurl = explode(',',$submenu);?>
					<li class="" onclick="myFunction()"><a href="<?php echo URL.$menuurl[2]; ?>"><i class="fa fa-circle-o"></i> <?php echo $menuurl[1]; ?></a></li>
				  <?php } ?> 
				  </ul>
				</li>
			  <?php } ?>  
			  </ul>
			</section>
			<!-- /.sidebar -->
		</aside>
	  
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Main content -->
			<section class="content">

                <!-- <script>
                    $( document ).ready(function() {
                        setInterval(function() {
                            loadcount();
                        }, 5000);
                        loadcount();
                       function loadcount(){
                            $.ajax({
                                url:"<?php echo URL?>approvallist/countlist",
                                method:"GET",
//                                dataType:"json",
                                success:function(data)
                                {
                                    console.log(data);
                                    $('#notification').text(data);

                                }
                            });
                        }
                    });


                     // post chat message
                    $('body').on('click','#submit_chat',function() {
                         var message=$('#chat_input').val();
                         var to_email=$('#to_email').val();
                         var form_email=$('#form_email').val();

                        $.ajax({
                            url:"<?php echo URL?>jsondata/postchatMessage",
                            method:"POST",
                            data: {to_email:to_email,form_email:form_email,message:message},
                            success:function(data)
                            {
                                $('#message_list').html(data);
                                $('#chat_input').val("");
                                $('#message_list').animate({scrollTop:$(document).height()}, 'slow');
                            }
                        });
                    });

                </script> -->

                <div id="chatBox" class="hidden">

                        <div class="screen">
                            <div class="chat-user">
                                <img src="https://img.icons8.com/plasticine/2x/user.png" class="user-image" alt="User Image">
                                <span id="user_name">User Name</span>
                                <input type="hidden" id="to_email" name="user_email" value="">
                                <input type="hidden" id="form_email" name="user_email" value="<?php echo Session::get('suser')?>">
                                <i id="removeClasschat" class="fa fa-times pull-right"></i>
                            </div>
                            <div class="conversation" id="message_list">
<!--                                <div class="messages messages--received">-->
<!--                                    <div class="message">This codepen is an exemple of</div>-->
<!--                                    <div class="message">how to create the Facebook thumb up</div>-->
<!--                                </div>-->
<!--                                <div class="messages messages--sent">-->
<!--                                    <div class="message">Try to type</div>-->
<!--                                    <div class="message">or click the thumb up!</div>-->
<!--                                    <div class="message">;)</div>-->
<!--                                </div>-->
<!--                                <div class="messages messages--received">-->
<!--                                    <div class="message">Enjoy!</div>-->
<!--                                </div>-->
                            </div>
                            <div class="text-bar">
                                <form class="text-bar__field" id="form-message">
                                    <input type="text" id="chat_input" placeholder="Write Message.."/>
                                </form>
                                <div class="text-bar__thumb">
                                        <i id="submit_chat" class="fa fa-paper-plane fa-2x"></i>

                                </div>
                            </div>
                        </div>

                    <style>
                        .screen {
                            background-color: #fff;
                            height: 400px;
                            width: 300px;
                            margin: 0 auto;
                            box-shadow: 0 2px 2px rgba(0, 0, 0, 0.2);
                            position: fixed;
                            right: 2px;
                            bottom: 0;
                            z-index: 11;
                        }

                        .conversation {
                            height: calc(90% - 50px);
                            overflow: auto;
                            padding: 20px;
                            padding-bottom: 30px;
                        }

                        .messages {
                            margin-bottom: 10px;
                        }
                        .chat-user{
                            background: linear-gradient(178deg, #0d83b7 0%, #2eb7f3 100%);
                            color: #fff;
                        }
                        .chat-user img{
                            height: 40px;
                            width: 40px;
                            padding: 3px;
                            border-radius: 35px;
                        }
                        .chat-user i{
                            padding: 12px;
                        }
                        .messages--received .message {
                            float: left;
                            background-color: #ddd;
                            border-bottom-left-radius: 5px;
                            border-top-left-radius: 5px;
                        }
                        .messages--received .message:first-child {
                            border-top-left-radius: 15px;
                        }
                        .messages--received .message:last-child {
                            border-bottom-left-radius: 15px;
                        }
                        .messages--sent .message {
                            float: right;
                            background-color: #1998e6;
                            color: #fff;
                            border-bottom-right-radius: 5px;
                            border-top-right-radius: 5px;
                        }
                        .messages--sent .message:first-child {
                            border-top-right-radius: 15px;
                        }
                        .messages--sent .message:last-child {
                            border-bottom-right-radius: 15px;
                        }

                        .message {
                            display: inline-block;
                            margin-bottom: 2px;
                            clear: both;
                            padding: 7px 13px;
                            font-size: 12px;
                            border-radius: 15px;
                            line-height: 1.4;
                        }
                        .message--thumb {
                            background-color: transparent !important;
                            padding: 0;
                            margin-top: 5px;
                            margin-bottom: 10px;
                            width: 20px;
                            height: 20px;
                            border-radius: 0px !important;
                        }

                        .text-bar {
                            height: 50px;
                            border-top: 1px solid #ccc;
                        }
                        .text-bar__field {
                            float: left;
                            width: calc(100% - 50px);
                            height: 100%;
                        }
                        .text-bar__field input {
                            width: 100%;
                            height: 100%;
                            padding: 0 20px;
                            border: none;
                            position: relative;
                            vertical-align: middle;
                            font-size: 14px;
                            background: #f5f8fb;
                        }
                        .text-bar__thumb i{
                            float: right;
                            position: absolute;
                            padding: 10px;
                            color: red;
                        }

                    </style>
                </div>

	
	 