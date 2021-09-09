
<script src="<?php echo base_url() ?>my-assets/js/admin_js/json/service.js.php" ></script>
<!-- service Invoice js -->
<script src="<?php echo base_url() ?>my-assets/js/admin_js/service.js" type="text/javascript"></script>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo display('service_invoice') ?></h4>
                </div>
            </div>
            <?php echo form_open_multipart('service/service/insert_service_invoice', array('class' => 'form-vertical', 'id' => '', 'name' => '')) ?>
            <div class="panel-body">
                <div class="row">

                    <div class="col-sm-8" id="payment_from_1">
                        <div class="form-group row">
                            <label for="customer_name" class="col-sm-3 col-form-label"><?php
                                echo display('customer_name').'/'.display('phone');
                                ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input type="text" size="100"  name="customer_name" class=" form-control" placeholder='<?php echo display('customer_name').'/'.display('phone') ?>' id="customer_name" tabindex="1" onkeyup="customer_autocomplete()" required="required"/>

                                <input id="autocomplete_customer_id" class="customer_hidden_value abc" type="hidden" name="customer_id">
                            </div>
                             <?php if($this->permission1->method('add_customer','create')->access()){ ?>
                            <div  class=" col-sm-3">
                               <a href="#" class="client-add-btn btn btn-success" aria-hidden="true" data-toggle="modal" data-target="#cust_info"><i class="ti-plus m-r-2"></i></a>
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group row">
                             <label for="employee" class="col-sm-4 col-form-label"><?php
                                echo display('employee');
                                ?> <i class="text-danger">*</i></label>
                                <div class="col-sm-8">
                                    <select name="employee_id[]" class="form-control" multiple="multiple" required="">
                                        <option value=""> select One</option>
                                        <?php foreach($employee_list as $employee){?>  
                                        <option value="<?php echo $employee['id']?>"><?php echo $employee['first_name'].' '.$employee['last_name']?></option>
                                      <?php } ?>

                                    </select>
                                </div>
                        </div>
                    </div>

                    <div class="col-sm-8" id="payment_from_2">
                        <div class="form-group row">
                            <label for="customer_name_others" class="col-sm-3 col-form-label"><?php echo display('customer_name') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input  autofill="off" type="text"  size="100" name="customer_name_others" placeholder='<?php echo display('customer_name') ?>' id="customer_name_others" class="form-control" />
                            </div>

                            <div  class="col-sm-3">
                                <input  onClick="active_customer('payment_from_2')" type="button" id="myRadioButton_2" class="checkbox_account btn btn-success" name="customer_confirm_others" value="<?php echo display('old_customer') ?>">
                            </div>
                        </div>
                          <div class="form-group row">
                            <label for="customer_name_others_address" class="col-sm-3 col-form-label"><?php echo display('customer_mobile') ?> </label>
                            <div class="col-sm-6">
                                <input type="text"  size="100" name="customer_mobile" class=" form-control" placeholder='<?php echo display('customer_mobile') ?>' id="customer_name_others_mobile" />
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="customer_name_others_address" class="col-sm-3 col-form-label"><?php echo display('address') ?> </label>
                            <div class="col-sm-6">
                                <input type="text"  size="100" name="customer_name_others_address" class=" form-control" placeholder='<?php echo display('address') ?>' id="customer_name_others_address" />
                            </div>
                        </div> 
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="date" class="col-sm-4 col-form-label"><?php echo display('hanging_over') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-8">
                                <?php
                       
                                $date = date('Y-m-d');
                                ?>
                                <input class="datepicker form-control" type="text" size="50" name="invoice_date" id="date" required value="<?php echo $date; ?>" tabindex="6" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="normalinvoice">
                        <thead>
                            <tr>
                                <th class="text-center product_field"><?php echo display('service_name') ?> <i class="text-danger">*</i></th>
                                <th class="text-center"><?php echo display('quantity') ?> <i class="text-danger">*</i></th>
                                <th class="text-center invoice_fields" ><?php echo display('charge') ?> <i class="text-danger">*</i></th>

                                <?php if ($discount_type == 1) { ?>
                                    <th class="text-center"><?php echo display('discount_percentage') ?> %</th>
                                <?php } elseif ($discount_type == 2) { ?>
                                    <th class="text-center"><?php echo display('discount') ?> </th>
                                <?php } elseif ($discount_type == 3) { ?>
                                    <th class="text-center"><?php echo display('fixed_dis') ?> </th>
                                <?php } ?>

                                <th class="text-center"><?php echo display('total') ?> 
                                </th>
                                <th class="text-center"><?php echo display('action') ?></th>
                            </tr>
                        </thead>
                        <tbody id="addinvoiceItem">
                            <tr>
                                <td class="product_field">
                                    <input type="text" name="service_name" onkeypress="invoice_serviceList(1);" class="form-control serviceSelection" placeholder='<?php echo display('service_name') ?>' required="" id="service_name" tabindex="7">

                                    <input type="hidden" class="autocomplete_hidden_value service_id_1" name="service_id[]" id="SchoolHiddenId"/>

                                    <input type="hidden" class="baseUrl" value="<?php echo base_url(); ?>" />
                                </td>

                                <td>
                                    <input type="text" name="product_quantity[]" onkeyup="quantity_calculate(1);" onchange="quantity_calculate(1);" class="total_qntt_1 form-control text-right" id="total_qntt_1" placeholder="0.00" min="0" tabindex="8" required="required"/>
                                </td>
                                <td class="invoice_fields">
                                    <input type="text" name="product_rate[]" id="price_item_1" class="price_item1 price_item form-control text-right" tabindex="9" required="" onkeyup="quantity_calculate(1);" onchange="quantity_calculate(1);" placeholder="0.00" min="0" />
                                </td>
                                <!-- Discount -->
                                <td>
                                    <input type="text" name="discount[]" onkeyup="quantity_calculate(1);"  onchange="quantity_calculate(1);" id="discount_1" class="form-control text-right" min="0" tabindex="10" placeholder="0.00"/>
                                    <input type="hidden" value="<?php echo $discount_type?>" name="discount_type" id="discount_type_1">
                                </td>


                                <td class="invoice_fields">
                                    <input class="total_price form-control text-right" type="text" name="total_price[]" id="total_price_1" value="0.00" readonly="readonly" />
                                </td>

                                <td>
                                    <!-- Tax calculate start-->
                              <?php $x=0;
                             foreach($taxes as $taxfldt){?>
                                    <input id="total_tax<?php echo $x;?>_1" class="total_tax<?php echo $x;?>_1" type="hidden">
                                    <input id="all_tax<?php echo $x;?>_1" class="total_tax<?php echo $x;?>" type="hidden" name="tax[]">
                                   
                                    <!-- Tax calculate end-->

                                    <!-- Discount calculate start-->
                                   
                                    <?php $x++;} ?>
                                    <!-- Tax calculate end-->

                                    <!-- Discount calculate start-->
                                    <input type="hidden" id="total_discount_1" class="" />
                                    <input type="hidden" id="all_discount_1" class="total_discount" name="discount_amount[]" />
                                 
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>

                                  <tr><td colspan="3" rowspan="2">
                        <center><label  for="details" class="  col-form-label text-center"><?php echo display('invoice_details') ?></label></center>
                        <textarea name="inva_details" class="form-control" placeholder="<?php echo display('invoice_details') ?>"></textarea>
                        </td>
                        <td class="text-right" colspan="1"><b><?php echo display('service_discount') ?>:</b></td>
                        <td class="text-right">
                            <input type="text" onkeyup="quantity_calculate(1);"  onchange="quantity_calculate(1);" id="invoice_discount" class="form-control text-right" name="invoice_discount" placeholder="0.00"  />
                                <input type="hidden" id="txfieldnum">
                        </td>
                        <td><button type="button" id="add_invoice_item" class="btn btn-info" name="add-invoice-item"  onClick="addInputField('addinvoiceItem');" ><i class='fa fa-plus'></i></button>
                            <input type="hidden" name="" id="discount_type" value="<?php echo $discount_type?>">
                        </td>
                        </tr>

             
                        <tr>
                            
                            <td class="text-right" colspan="1"><b><?php echo display('total_discount') ?>:</b></td>
                            <td class="text-right">
                                <input type="text" id="total_discount_ammount" class="form-control text-right" name="total_discount" value="0.00" readonly="readonly" />
                            </td>
                              <td></td>
                        </tr>                     
                            <?php $x=0;
                             foreach($taxes as $taxfldt){?>
                            <tr class="hideableRow hiddenRow">
                               
                        <td class="text-right" colspan="4"><b><?php echo $taxfldt['tax_name'] ?></b></td>
                        <td class="text-right">
                            <input id="total_tax_ammount<?php echo $x;?>" tabindex="-1" class="form-control text-right valid totalTax" name="total_tax<?php echo $x;?>" value="0.00" readonly="readonly" aria-invalid="false" type="text">
                        </td>
                       
                       <td></td>
                         
                        </tr>
                    <?php $x++;}?>
                         
            <tr>
                            <td colspan="3"></td>
                            <td class="text-right" colspan="1"><b><?php echo display('total_tax') ?>:</b></td>
                            <td class="text-right">
                                <input type="text" id="total_tax_amount" class="form-control text-right" name="total_tax_amount" value="0.00" readonly="readonly" />
                            </td>
                            <td><button type="button" class="toggle btn-warning">
        <i class="fa fa-angle-double-down"></i>
      </button></td>
                        </tr>                

                         <tr>
                            <td class="text-right" colspan="4"><b><?php echo display('shipping_cost') ?>:</b></td>
                            <td class="text-right">
                                <input type="text" id="shipping_cost" class="form-control text-right" name="shipping_cost" onkeyup="quantity_calculate(1);"  onchange="quantity_calculate(1);"  placeholder="0.00"  />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4"  class="text-right"><b><?php echo display('grand_total') ?>:</b></td>
                            <td class="text-right">
                                <input type="text" id="grandTotal" class="form-control text-right" name="grand_total_price" value="0.00" readonly="readonly" />
                            </td>
                        </tr>
                         <tr>
                            <td colspan="4"  class="text-right"><b><?php echo display('previous'); ?>:</b></td>
                            <td class="text-right">
                                <input type="text" id="previous" class="form-control text-right" name="previous" value="0.00" readonly="readonly" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4"  class="text-right"><b><?php echo display('net_total'); ?>:</b></td>
                            <td class="text-right">
                                <input type="text" id="n_total" class="form-control text-right" name="n_total" value="0" readonly="readonly" placeholder="" />
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
                               

                                <input type="hidden" name="baseUrl" class="baseUrl" value="<?php echo base_url(); ?>"/>
                            </td>
                            <td class="text-right" colspan="3"><b><?php echo display('paid_ammount') ?>:</b></td>
                            <td class="text-right">
                                <input type="text" id="paidAmount" 
                                       onkeyup="invoice_paidamount();" class="form-control text-right" name="paid_amount" placeholder="0.00" tabindex="13" value=""/>
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
                                <input type="button" id="full_paid_tab" class="btn btn-warning" value="<?php echo display('full_paid') ?>" tabindex="14" onClick="full_paid()"/>

                                <input type="submit" id="add_invoice" class="btn btn-success" name="add-invoice" value="<?php echo display('submit') ?>" tabindex="15"/>
                            </td>

                            <td class="text-right" colspan="3"><b><?php echo display('due') ?>:</b></td>
                            <td class="text-right">
                                <input type="text" id="dueAmmount" class="form-control text-right" name="due_amount" value="0.00" readonly="readonly"/>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
      
</div>

