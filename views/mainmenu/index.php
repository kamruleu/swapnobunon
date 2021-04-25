<?php 
if(Session::get('sbizid')!=99){
$bizcur = $this->bizcur;

 ?>

    <style type="text/css">
        .bg-red p {
            margin: 0 0 0px;
        }

        .bg-yellow p {
            margin: 0 0 0px;
        }

        .bg-aqua p {
            margin: 0 0 2px;
        }

        .bg-green p {
            margin: 0 0 2px;
        }
    </style>
    <!-- Main content -->
    <section class="">



        <div class="account__boxx">
            <div class="row">

                <div class="col-lg-3 col-xs-12">
                    <div class="info-box">
                        <h4 class="text-left text-uppercase"><b>Total Deposits</b></h4>
                        <div class="info_box__details">
                            <img class="" src="<?php echo URL; ?>public/images/nPic.png">
                            <h2 class="text-right ">
                                <b>
                                    <span class="info-box-number"><?php 
                    echo number_format($this->totalinc, 2, '.', ''); ?><small><?php echo " ".$bizcur; ?></small></span>
                                </b>
                            </h2>

                        </div>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-lg-3 col-xs-12">
                    <div class="info-box">
                        <h4 class="text-left text-uppercase"><b>Total Expenses</b></h4>
                        <div class="info_box__details">
                            <img class="" src="<?php echo URL; ?>public/images/nPic1.png">
                            <h2 class="text-right ">
                                <b>
                                    <span class="info-box-number"><?php
                    echo number_format($this->totalexp, 2, '.', '');  ?><small><?php echo " ".$bizcur; ?></small></span>
                                </b>
                            </h2>

                        </div>
                    </div>




                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <div class="col-lg-3 col-xs-12">


                    <div class="info-box">
                        <h4 class="text-left text-uppercase"><b>Current Deposits</b></h4>
                        <div class="info_box__details">
                            <img class="" src="<?php echo URL; ?>public/images/nPic2.png">
                            <h2 class="text-right ">
                                <?php echo number_format($this->currentdeposit, 2, '.', ''); ?><small><?php echo " ".$bizcur; ?></small>
                            </h2>

                        </div>
                    </div>

                    <!-- <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-database"></i></span>

            <div class="info-box-content">
              <span style="white-space: normal;" class="info-box-text">Total Stock In Amount</span>
              <span class="info-box-number"><?php echo " ".$this->stock[0]["xtotal"]; ?></span>
            </div>
          </div> -->

                </div>

                <!-- /.col -->
                <div class="col-lg-3 col-xs-12">


                    <div class="info-box">
                        <h4 class="text-left text-uppercase"><b>Total Members</b></h4>
                        <div class="info_box__details">
                            <img class="" src="<?php echo URL; ?>public/images/nPic3.png">
                            <h2 class="text-right ">
                                <?php echo $this->tmem ?>
                            </h2>

                        </div>
                    </div>

                    <!-- <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Customer</span>
              <span class="info-box-number"><?php echo $totalcus ?></span>
            </div>
          </div> -->

                </div>
            </div>
        </div>

        <!-- /.row -->
        <div class="row">
            

            <div class="col-lg-12 col-xs-12">
                <div class="box box-warning">
                    <div class="box-header with-border">

                        <div class="info-box info_box_right">
                            <h4 class="text-left text-uppercase"><b>Today's </b></h4>
                            <div class="info_box__details">
                                <img class="info_box__details_right_images" src="<?php echo URL; ?>public/images/nPic.png">
                                <div class="text-right today__rasult">
                                    <p> <b> Today's Deposits </b> : <?php echo $this->tinc; ?> BDT</p>
                                    <p> <b> Today's Expenses </b> : <?php echo $this->texp; ?> BDT</p>
                                </div>
                            </div>
                        </div>

                        <div class="info-box info_box_right">
                            <h4 class="text-left text-uppercase"><b>Current Month  </b></h4>
                            <div class="info_box__details">
                                <img class="info_box__details_right_images" src="<?php echo URL; ?>public/images/nPic1.png">
                                <div class="text-right today__rasult">
                                    <p> <b> Current Month Deposits </b> : <?php echo $this->cmonthinc; ?> BDT</p>
                                    <p> <b> Current Month Expenses </b> : <?php echo $this->cmonthexp; ?> BDT</p>
                                </div>
                            </div>
                        </div>

                        <div class="info-box info_box_right">
                            <h4 class="text-left text-uppercase"><b> Current Year </b></h4>
                            <div class="info_box__details">
                                <img class="info_box__details_right_images" src="<?php echo URL; ?>public/images/nPic2.png">
                                <div class="text-right today__rasult today__rasult_two">
                                  <p> <b> Current Year Deposits </b>: <?php echo $this->cyrinc." ".$bizcur; ?></p>
                                  <p> <b> Current Year Expenses </b>  : <?php echo $this->cyrexp." ".$bizcur; ?></p>
                                </div>
                            </div>
                        </div>

                </div>
            </div>


        </div>
        <!-- /.col -->
        </div>

       
    </section>
    <!-- /.content -->
    <?php }else{ ?>
    <div class="text-center">
        <img src="<?php echo URL;?>public/images/bizdir/<?php echo Session::get('sbizid');?>.jpg" alt="">
        <h1><?php echo Session::get('sbizlong');?></h1>
    </div>

    <?php } ?>