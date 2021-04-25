 <!-- <style>
 .table {
	background-image: url("http://localhost:8080/swapnobunon/public/images/bizdir/99.jpg");
	background-position: center;
	background-repeat: no-repeat;
	background-attachment: fixed;
	background-size: 550px;
 }
 
 </style> -->
 
 <div class="panel">
            <div style="float: right;"><a class="btn btn-primary" href="javascript:void(0);" onclick="window.print();" role="button"><span class="glyphicon glyphicon-print"></span>&nbsp;Print</a></div>
			<?php echo $this->breadcrumb; ?>
			<div id="printdiv"> 
			<div class="panel-heading">
                <div style="text-align: center;">
					<img src="<?php echo URL; ?>public/images/bizdir/100.jpg" alt="sb logo" style="height: 62px;">
					<h5><strong><?php echo $this->vrptname; ?></strong></h5>
					<h5><strong><?php echo $this->vfdate; ?></strong></h5>	
					<h5><strong><?php if(!empty($this->subsubacc)){echo $this->subsubacc;} ?></strong></h5>
                </div>
			</div>
            <div class="panel-body" >
				<?php echo $this->table;?>
			</div>
			</div>
        </div>

