<?php $this->load->view('element/head');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Sales Transaction Form
       
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
	
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="<?php echo site_url('sales/create');?>">Add Sales</a></li>
            <li role="presentation"><a href="<?php echo site_url('sales');?>">Sales List</a></li>
          </ul>
		  <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Sales</h3>
              <?php if($this->session->flashdata('form_false')){?>
                <div class="alert alert-danger text-center">
                  <strong><?php echo $this->session->flashdata('form_false');?></strong>
                </div>
              <?php } ?>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php if(!empty($sales)){?>
            <form id="transaction-form" class="form-horizontal" method="POST" action="<?php echo site_url('sales/update').'/'.$sales[0]->id;?>">
            <?php }else{?>
            <form id="transaction-form"  class="form-horizontal" method="POST" action="<?php echo site_url('sales/add_process');?>">
            <?php } ?>
              <div class="box-body">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="code">Sales Code</label>
                    <div class="col-sm-8">
                      <input type="text" name="id" value="<?php echo !empty($code_sales) ? $code_sales : '';?>" class="form-control" disabled/>
                      <input type="hidden" name="sales_id" id="sales_id" value="<?php echo !empty($code_sales) ? $code_sales : '';?>"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="customer_id">Customer</label>
                     <input type="hidden" value="add new Sales Transaction" name="activity"  id="activity" class="form-control"/>
                      <input type="hidden" value="<?php echo $this->username;  ?>" name="username"  id="username" class="form-control"/>
                    <div class="col-sm-8">
                      <select class="form-control" id="customer_id" name="customer_id">
                        <?php if(isset($customers) && is_array($customers)){?>
                          <?php foreach($customers as $item){?>
                            <option value="<?php echo $item->id;?>" <?php if(!empty($sales) && $item->id == $sales[0]->customer_id) echo 'selected="selected"';?>>
                              <?php echo $item->customer_name;?>
                            </option>
                          <?php }?>
                        <?php }?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="date">Date</label>
                    <div class="col-sm-8">
                      <input type="text" value="<?php echo date('Y-m-d H:i:s');?>" id="date" class="form-control" disabled/>
                      <input type="hidden" name="date" value="<?php echo date('Y-m-d H:i:s');?>" id="date" class="form-control"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="category_id">Payment Method</label>
                    <div class="col-sm-8">
                      <select class="form-control" id="is_cash" name="is_cash">
                     
                      <option value="1" <?php if(!empty($sales) && $sales[0]->is_cash == true) echo 'selected="selected"';?>>
                          Cash/Gcash
                        </option>
                       
                      <option value="0" <?php if(!empty($sales) && $sales[0]->is_cash == false) echo 'selected="selected"';?>>
                        Credit (automatic 30 Days grace period)
                        </option>
                    
                        
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-11 col-md-offset-1">
                  <h3 class="content-title">Item Information</h3>
                  <div class="content-process">
                    <table class="table">
                      <thead>
                        <tr>
                          <td>Category</td>
                          <td>Item Name</td>
                          <td>Qty</td>
                         
                          <td>Selling Price</td>
                          <td>Discount</td>
                          <td>Price</td>
                          <td>Input Item</td>
                        </tr>
                      </thead>
                      <tbody id="transaction-item">
                        <tr>
                          <td>
                            <select class="form-control" id="transaction_category_id" name="category_id">
                              <option value="0">
                                Please Select One
                              </option>
                              <?php if(isset($categories) && is_array($categories)){?>
                                <?php foreach($categories as $item){?>
                                  <option value="<?php echo $item->id;?>">
                                    <?php echo $item->category_name;?>
                                  </option>
                                <?php }?>
                              <?php }?>
                            </select>
                          </td>
                          <td>
                            <select class="form-control" id="transaction_product_id" name="product_id"></select>
                          </td>
                          <td>
                            <input type="number"  onkeypress="return isNumeric(event)"  oninput="maxLengthCheck(this)" id="sum" class="form-control" name="sum" min="1" max="999"   value="1" />
                          </td>

                         
                            <select style="display: none;"class="form-control" data-attr="0" id="buying_price" name="buying_price" disabled></select>
                         
                          <td>
                            <select class="form-control"  data-attr="0" id="sale_price" name="sale_price"  disabled></select>
                          </td>
                          <td>
                            <input type="number" value="0" min="0" max="100" onkeypress="return isNumeric(event)"  oninput="maxLengthCheck(this)" class="form-control discount-trx1" data-attr="1" id="disc_1" name="disc_1" placeholder="Discount 1" />
                          </td>
                          <td>
                            <input   value="0" onkeypress="return isNumeric(event)"  oninput="maxLengthCheck(this)" class="form-control" id="net_unit_price1" name="net_unit_price1" placeholder="Net Unit Price" disabled/>
                          </td>
                          <td>
                            <a href="#" class="btn btn-primary" id="add-item1"> add to cart <i class="fa fa-folder-plus"></i></a>
                          </td>
                        </tr>
                        <?php if(!empty($carts) && is_array($carts)){?>
                            <?php foreach($carts['data'] as $k => $cart){?>
                              <tr id="<?php echo $k;?>" class="cart-value">
                                <td><?php echo $cart['category_name'];?></td>
                                <td><?php echo $cart['name'];?></td>
                                <td><?php echo $cart['qty'];?></td>
                                <td><?php echo $cart['buying_price'];?></td>
                                <td>₱<?php echo number_format($cart['price']);?></td>
                                <td><span class="btn btn-danger btn-sm transaction-delete-item" data-cart="<?php echo $k;?>"><i class="fa fa-times-circle"></i></span></td>
                              </tr>
                            <?php }?>
                        <?php }?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td>Total Sales</td>
                         
                          <td id="total-purchase"><?php echo !empty($carts) ? '₱'.number_format($carts['total_price']) : '';?>
                        
                          
                        </td>
                        
                        
                        </tr>
                      </tfoot>
                      
                    </table>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-md-3 col-md-offset-4">
                  <a class="btn btn-danger" href="<?php echo site_url('sales');?>">Cancel</a>
                  <a class="btn btn-success pull-right" href="#" id="submit-transaction">Submit</a>
                </div>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
		</div>
        <!-- /.col -->
      </div>
	  <!-- row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $this->load->view('element/footer');?>
