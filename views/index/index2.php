<!-- 
<div class="page-header headertext">
               <h3><strong><p class="">List Of Business Directories</p></strong></h3>
        </div>

      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            
          </div>
          <div class="col-lg-6">
            
            <table class="table table-bordered table-striped">
            <?php foreach($this->bizness as $key=>$value){
                   $file = 'public/images/bizdir/'.$value['bizid'].'.jpg';
                   if(file_exists($file))
                     $imgbiz = 'public/images/bizdir/'. $value['bizid'].".jpg";
                   else
                     $imgbiz = 'public/images/bizdir/noImages.png';
         
                            echo '<tr>';
                            echo     '<td>';
                            echo         '<div class="row">';
                            echo             '<div class="col-xs-6 col-md-3">';
                            echo                 '<a href="login/index/'. $value['bizid'] .'"   class="thumbnail">';
                            echo                 '<img src="'. URL . $imgbiz .'" alt="">';
                            echo                 '</a>';
                            echo             '</div>';
                            echo             '<p><strong>'. $value['bizlong'] .'</strong></p>';
                            echo             '<p>'. $value['bizadd1'] .'</p>';
                            echo         '</div>';
                            echo     '</td>';
                            echo '</tr>';
           }
            ?>        
            </table>
          </div>
          <div class="col-lg-3">
            
          </div>
        </div> 
      </div>
   -->



 <div class="all_erp_box">
 <!-- <img class="" src="<?php echo URL; ?>public/images/creative-banner.png"> -->




  <div class="header__erp">
    <div class="container">
      <img class="" src="<?php echo URL; ?>public/images/logoERP.jpeg">
      </div>
    </div>
    <div class="header_top">
      <div class="banner_text_erp">
          <div class="container">
          <h3> List Of Business Directories </h3>
          <!-- <p> Our landing page template works for all the devices, so you only have to setup it once, <br> and get beautiful results forever. </p> -->
          </div>
        </div>
        <img class="img-responsive" src="<?php echo URL; ?>public/images/11.png">
        <span class="body-effect effect-snow"></span>
    </div>

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
              <?php foreach($this->bizness as $key=>$value){
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
           </div>


      </div>
      </div>

    </div>
  </div>