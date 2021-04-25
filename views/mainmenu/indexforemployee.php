      <!-- /.row -->
      <div class="row" style="width: 2250px;">
        <div class="col-md-6">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title" style="margin-left: 460px;">Leave Details</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <?php echo $this->leavedata;?>
              
            </div>
          </div> 
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row" style="width: 2250px;">
        <div class="col-md-6">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title" style="margin-left: 450px;">Leave Apply Report</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="dtbl" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <?php $leavedatafortb = $this->leavereport; ?>
              <!-- <?php print_r($leavedatafortb); ?> -->
              
                <thead>
                  <th>Employee Name</th>
                  <th>Employee ID</th>
                  <th>Leave Type</th>
                  <th>From Date</th>
                  <th>To Date</th>
                  <th>Days</th>
                  <th>Status</th>
                  <th>Details</th>
                  <th>Report</th>
                  
                </thead>
                
              
              <?php
                foreach ($leavedatafortb as $key => $value) {
                  $empName = $value['xname'];
                  $empId = $value['xfacultyid'];
                  $leavetype = $value['xleavetype'];
                  $fromdate=$value['xfromdate'];
                  $todate=$value['xtodate'];
                  $days=$value['xnumdays'];
                  $status=$value['xstatus'];
                  $xsl=$value['xsl'];
                  

                  ?>
                  
                
                    <tr>
                      
                        <td><?php echo $empName ?></td>
                        <td><?php echo $empId ?></td>
                        <td><?php echo $leavetype ?></td>
                        <td><?php echo $fromdate ?></td>
                        <td><?php echo $todate ?></td>
                        <td><?php echo $days ?></td>
                        <td><?php echo $status ?></td>
                        <td><a type="button" id="delbtn" class="btn btn-info" data-toggle="modal" role="button" href="<?php echo URL; ?>mainmenu/detail/<?php echo $empId; ?>">Details</a>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info" href="<?php echo URL; ?>mainmenu/detail/<?php echo $empId; ?>">View</button>
                        </td>
                        <td><a id="delbtn" class="btn btn-success" role="button" href="<?php echo URL; ?>mainmenu/reportedemp/<?php echo $xsl; ?>">Reported</a></td>
                      
                    </tr>
                    <?php
                    }
                  ?>

              </table>
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>

      <!--Modal-->

       <div class="modal modal-info fade" id="modal-info">
          <div class="modal-dialog">
            <div class="modal-content"  style="width: 800px;">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="text-align: center;">Leave Summary</h4>
              </div>
              <div class="modal-body">
                <table id="dtbl" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <?php $leaveempdata = $this->empleavedetail; ?>
                <thead>
                  <th>Leave Type</th>
                  <th>Number of days</th>
                  <th>Approved Days</th>
                  <th>Reported Days</th>
                  <th>Pending Days</th>
                  <th>Total Apply</th>
                  <th>Remaining Days</th>
                  
                  
                </thead>
                
              
              <?php

                  $totalleave = 0;
                  $totalappl = 0;
                  $totalrem = 0;
                  $totalapr = 0;
                  $totalrep = 0;
                  $totalpen = 0;
                foreach ($leaveempdata as $key => $value) {

                  $a = 0;
                 $b = 0;
                 $c = 0;
                 $d = 0;
                 $totalapp = 0;

                 $a=$value['xnumdays'];
                 $b=$value['aprleave'];
                 $c=$value['repleave'];
                 $d=$value['penleave'];

                 $totalapp = $b+$c+$d;
                 $remdays = $a-$totalapp;

                  $empName = $value['xleavetype'];
                  $empId = $value['xnumdays'];
                  $leavetype = $value['aprleave'];
                  $fromdate=$value['repleave'];
                  $todate=$value['penleave'];
                  $ttalapp=$totalapp;
                  $rmdays=$remdays;
                 

                      $totalleave += $value["xnumdays"];
                     $totalappl += $ttalapp;
                     $totalrem += $rmdays;
                     $totalapr += $value['aprleave'];
                     $totalrep += $value['repleave'];
                     $totalpen += $value['penleave'];
                  ?>
                  
                
                    <tr>
                      
                        <td><?php echo $empName ?></td>
                        <td><?php echo $empId ?></td>
                        <td><?php echo $leavetype ?></td>
                        <td><?php echo $fromdate ?></td>
                        <td><?php echo $todate ?></td>
                        <td><?php echo $ttalapp ?></td>
                        <td><?php echo $rmdays ?></td>
                        
                    </tr>
                    <?php

                    
                     
                     
                    }
                    ?>

                  <tr>
                    <th>Total:</th>
                    <th><?php echo $totalleave; ?></th>
                    <th><?php echo $totalapr; ?></th>
                    <th><?php echo $totalrep; ?></th>
                    <th><?php echo $totalpen; ?></th>
                    <th><?php echo $totalappl; ?></th>
                    <th><?php echo $totalrem; ?></th>

                  </tr>

              </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
      
 <!-- Approve Data-->

     <div class="row" style="width: 2250px;">
        <div class="col-md-6">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title" style="margin-left: 450px;">Leave Apply Approve</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="dtbl" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <?php $leavedatafortb = $this->leaveapprove; ?>
              <!-- <?php print_r($leavedatafortb); ?> -->
              
                <thead>

                  <th>Employee Name</th>
                  <th>Employee ID</th>
                  <th>Leave Type</th>
                  <th>From Date</th>
                  <th>To Date</th>
                  <th>Days</th>
                  <th>Status</th>
                  <th>View</th>
                  <th>Approve</th>
                  
                </thead>
                
              
              <?php
                foreach ($leavedatafortb as $key => $value) {
                  $empName = $value['xname'];
                  $empId = $value['xfacultyid'];
                  $leavetype = $value['xleavetype'];
                  $fromdate=$value['xfromdate'];
                  $todate=$value['xtodate'];
                  $days=$value['xnumdays'];
                  $status=$value['xstatus'];
                  $xsl=$value['xsl'];
                  

                  ?>
                  
                
                    <tr>
                      
                        <td><?php echo $empName ?></td>
                        <td><?php echo $empId ?></td>
                        <td><?php echo $leavetype ?></td>
                        <td><?php echo $fromdate ?></td>
                        <td><?php echo $todate ?></td>
                        <td><?php echo $days ?></td>
                        <td><?php echo $status ?></td>
                        <td><a id="" class="btn btn-info" role="button" href="<?php echo URL; ?>mainmenu/detail/<?php echo $empId; ?>">Details</a>
                        <td><a id="delbtn" class="btn btn-success" role="button" href="<?php echo URL; ?>mainmenu/approveemp/<?php echo $xsl; ?>">Approve</a></td>
                      
                    </tr>
                    <?php
                    }
                  ?>

              </table>
                  
              
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>

