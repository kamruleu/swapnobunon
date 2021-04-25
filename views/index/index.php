<div class="all_erp_box">


    <div class="header__erp">
        <div class="container">
            <img class="" src="<?php echo URL; ?>public/images/bizdir/100.jpg" style=" height: 68px;">
        </div>
    </div>
    <div class="header_top">
        <div class="banner_text_erp">
            <div class="container">
                <h3> List Of Login Portals </h3>
                <!-- <p> Our landing page template works for all the devices, so you only have to setup it once, <br> and get beautiful results forever. </p> -->
            </div>
        </div>
        <img class="img-responsive" src="<?php echo URL; ?>public/images/11.png">
        <span class="body-effect effect-snow"></span>
    </div>

</div>

<div class="erp__list_area">
    <div class="container">
        <div class="new_erp_concep">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-xl-6">
                    <img class="new_erp_concep_images" src="<?php echo URL; ?>public/images/bAnner.svg">
                </div>
                <div class="col-sm-12 col-md-6 col-xl-6">
                
                <p style="font-size: 20px; color: #6F8394"><strong> Admin Portal </strong></p>
                    <?php

                    foreach($this->bizness as $key=>$value){


                        $file = 'public/images/bizdir/'.$value['bizid'].'.jpg';
                        if(file_exists($file))
                            $imgbiz = 'public/images/bizdir/'. $value['bizid'].".jpg";
                        else
                            $imgbiz = 'public/images/bizdir/noImages.png';
                        ?>
                        <div class="erp_list images_erpp">
                            <?php
                            echo '<a href="login/index/'. $value['bizid'] .'"   class="">';
                            echo '<img src="'. URL .$imgbiz .'" alt="">';
                            echo '</a>';
                            ?>
                            <div class="repText">
                                <h3> <?php   echo '<p><strong>'. $value['bizlong'] .'</strong></p>';?></h3>
                                <p> <?php echo '<p>'. $value['bizadd1'] .'</p>'; ?> </p>
                            </div>
                        </div>
                    <?php } ?>
                    <?php

                    foreach($this->bizness as $key=>$value){
                        ?>
                    <p style="font-size: 20px; color: #6F8394"><strong> Member Portal </strong></p>
                    <div class="erp_list images_erpp">
                            <?php
                            echo '<a href="loginmem/index/'. $value['bizid'] .'"   class="">';
                            echo '<img src="public/images/bizdir/100.jpg" alt="">';
                            echo '</a>';
                            ?>
                            <div class="repText">
                                <h3> <?php   echo '<p><strong>Member Login</strong></p>';?></h3>
                                <?php echo '<a href="loginmem/index/'. $value['bizid'] .'">Click here to login member.</a>'; ?>
                            </div>
                        </div>
                        <?php } ?>
                </div>


            </div>
        </div>

    </div>
</div>