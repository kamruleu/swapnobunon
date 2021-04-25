     <?php $leavedatafortb = $this->empleavedetail; ?>
    <?php
      foreach ($leavedatafortb as $key => $value) {
        $name = $value['xname'];
      }
    ?>
 
      <div class="row" style="width: 2250px;">
        <div class="col-md-6">
          <div class="box box-info">
            <div class="box-header with-border">
              <a type="button" id="delbtn" class="btn btn-info" data-toggle="modal" role="button" href="<?php echo URL; ?>mainmenu"><span class="glyphicon glyphicon-menu-left"></span>Back</a>
              <h3 class="box-title" style="margin-left: 380px;">Leave Summary of <?php echo $name; ?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <table id="dtbl" class="table table-striped table-bordered" cellspacing="0" width="100%">
             
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
                foreach ($leavedatafortb as $key => $value) {

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
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>


       <div class="row" style="width: 2250px;">
        <div class="col-md-6">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title" style="margin-left: 460px;">Details</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <?php $empappdetails = $this->empappdetail; ?>

               <table id="dtbl" class="table table-striped table-bordered" cellspacing="0" width="100%">
             
                <thead>
                  <th>Apply Date</th>
                  <th>Leave Type</th>
                  <th>From Date</th>
                  <th>To Date</th>
                  <th>Days</th>
                  <th>Status</th>
                  
                  
                  
                </thead>
                
              
              <?php

                  $totalleave = 0;
                  $totalappl = 0;
                  $totalrem = 0;
                  $totalapr = 0;
                  $totalrep = 0;
                  $totalpen = 0;
                foreach ($empappdetails as $key => $value) {

                 
                  $appdate = $value['xdate'];
                  $empName = $value['xleavetype'];
                  $empId = $value['xfromdate'];
                  $leavetype = $value['xtodate'];
                  $fromdate=$value['xnumdays'];
                  $todate=$value['xstatus'];
                  
                 

                   
                  ?>
                  
                
                    <tr>
                      
                        <td><?php echo $appdate ?></td>
                        <td><?php echo $empName ?></td>
                        <td><?php echo $empId ?></td>
                        <td><?php echo $leavetype ?></td>
                        <td><?php echo $fromdate ?></td>
                        <td><?php echo $todate ?></td>
                        
                        
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








       