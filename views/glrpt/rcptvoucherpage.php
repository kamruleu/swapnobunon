 <div class="panel" >
            <div class="panel-heading" width="70%">
			<div style="float: right;"><a class="btn btn-primary" href="javascript:void(0);" onclick="window.print();" role="button"><span class="glyphicon glyphicon-print"></span>&nbsp;Print</a></div>
			<?php echo $this->breadcrumb; ?>
            <div id="printdiv">
                <div style="text-align: center;">
                    <h4><strong><?php echo $this->org; ?></strong></h4>
					<h5><strong><?php echo $this->vrptname; ?></strong></h5>					
                </div>
				<div style="float: left;">
                    <p><b>Voucher No: <?php echo $this->voucher; ?></b></p>
                    <p><b>Receipt Method: <?php echo $this->paymethod; ?></b></p>
					
                </div>
				<div style="float: right;">
                    <p>Date: <?php echo $this->xdate; ?></p>
					<p>Cheque No: <?php echo $this->xcheque; ?></p>						
                </div>
				<div>
                    <table class="table table-bordered">
						<tbody>
							<tr>
								<th>Receive From: <?php echo $this->payto; ?></th>
								<th>Account Description </th>
								<th>Amount </th>
							</tr>
							<tr>
								<td>Being: <?php echo $this->xnarration; ?></td>
								<td><?php echo $this->xaccdesc; ?></td>
                                <td><?php echo abs($this->xprime); ?></td>


                            </tr>
							<tr>
							</tr>
							
						</tbody>
						<tfoot>
							<tr style="background-color:button-info">
								<td colspan="4"><b><?php echo $this->inword; ?></b></td>
							</tr>
						</tfoot>
					</table>
                    <div>
                        <table class="table">
                            <!-- <tr style="height:70px">
                                <td align="left">Prepared By:</td>
                                <td align="left">Approved By:</td>
                                <td align="left">Re Approved By:</td>
                            </tr> -->
                            <tr>
                                <?php
                                if($this->apprdt != ""){
                                    $apparray = explode(";", $this->apprdt);
                                    foreach ($apparray as $key => $value) {
                                        $appdt = explode(":", $value);
                                        ?>

                                        <td>
                                            <img style="height: 50px;width: 100px;" src="<?php echo URL;?>images/signature/<?php echo $appdt[1] ?>.jpg" alt="" />
                                            </br>

                                            <span>Approved <?php echo $appdt[0] ?></span>
                                        </td>
                                        <?php
                                    }
                                }
                                ?>
                            </tr>
                        </table>
                    </div>
						
                </div>
            </div>

			</div>
            
        </div>

