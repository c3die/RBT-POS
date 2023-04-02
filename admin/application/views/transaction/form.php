<?php $this->load->view('element/head');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Purchase Transaction Form

      </h1>
      
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
	
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="<?php echo site_url('transaction/create');?>">Add Transaction</a></li>
            <li role="presentation"><a href="<?php echo site_url('transaction');?>">List Transaction</a></li>
          </ul>
		  <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Transaction</h3>
              <?php if($this->session->flashdata('form_false')){?>
                <div class="alert alert-danger text-center">
                  <strong><?php echo $this->session->flashdata('form_false');?></strong>
                </div>
              <?php } ?>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php if(!empty($transaction)){?>
            <form id="transaction-form" class="form-horizontal" method="POST" action="<?php echo site_url('transaction/update').'/'.$transaction[0]->id;?>">
            <?php }else{?>
            <form id="transaction-form" class="form-horizontal" method="POST" action="<?php echo site_url('Transaction/add_process');?>">
            <?php } ?>
              <div class="box-body">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="code">Transaction Code</label>
                    <div class="col-sm-8">
                      <input data-attr="" type="text" name="transaction_id" data-origin="<?php echo !empty($transaction) ? $transaction[0]->id : '';?>" value="<?php echo !empty($transaction) ? $transaction[0]->id : $code_transaction;?>" id="code_transaction" class="form-control" disabled/>
                        <input type="hidden" name="transaction_id" id="transaction_id" value="<?php echo !empty($code_transaction) ? $code_transaction : '';?>"/>



                        <input type="hidden" value="add new Purchase Transaction" name="activity"  id="activity" class="form-control"/>
                      <input type="hidden" value="<?php echo $this->username;  ?>" name="username"  id="username" class="form-control"/>
                      
                      <span class="help-inline label label-danger" id="status_code"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="category_id">Supplier</label>
                   

                  
                  


                    <div class="col-sm-8">
                      <select class="form-control" id="supplier_id" name="supplier_id">
                        <?php if(isset($suppliers) && is_array($suppliers)){?>
                          <?php foreach($suppliers as $item){?>
                            <option value="<?php echo $item->id;?>" <?php if(!empty($transaction) && $item->id == $transaction[0]->supplier_id) echo 'selected="selected"';?>>
                              <?php echo $item->supplier_name;?>
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
                </div>
                <div class="col-md-12">
                  <h3 class="content-title">Item Information</h3>
                  <div class="content-process">
                    <table class="table">
                      <thead>
                        <tr>
                          <td>Category</td>
                          <td>Item Name</td>
                          <td>Qty</td>
                          <td>Buying Price</td>
                          <td>Tax% </td>
                          <td>Discount </td>
                          <td>Selling Price</td>
                          <td>Total Price</td>
                          <td>Act.</td>
                        </tr>
                      </thead>
                      <tbody id="transaction-item">
                        <tr>
                          <td>
                            <select class="form-control" id="transaction_category_id" name="category_id">
                              <option value="0">
                                Please Select One...
                              </option>
                              <?php if(isset($category) && is_array($category)){?>
                                <?php foreach($category as $item){?>
                                  <option value="<?php echo $item->id;?>">
                                    <?php echo $item->category_name;?>
                                  </option>
                                <?php }?>
                              <?php }?>
                            </select>
                          </td>
                          <td>
                            <select class="form-control" name="product_id" id="transaction_product_id"></select>
                          </td>
                          <td>
                            <input type="number" id="sum" class="form-control" name="sum" min="1" value="1"/>
                          </td>
                          <td>
                            <input type="text" class="form-control form-price-format discount-trx" data-attr="0" id="sale_price" name="sale_price" placeholder="Buying Price" required/>
                           
                          </td>
                          <td>
                            <input type="number" value="12%" min="" max="100" class="form-control tax-trx" data-attr="1" id="tax" name="tax" placeholder="12%" disabled/>
                          </td>
                          <td>
                            <input type="number" value="0" min="0" max="100" class="form-control discount-trx" data-attr="1" id="disc_1" name="disc_1" placeholder="Discount 1" />
                          </td>
                          <td>
                            <input type="text" class="form-control" id="selling_price" name="selling_price" placeholder="Selling Price"/>
                          </td>
                          <td>
                            <input type="text" class="form-control" id="net_unit_price" name="net_unit_price" placeholder="Net Unit Price"/>
                          </td>

                          <td>
                          <a href="#" class="btn btn-primary" id="add-item">add to Cart <i class="fa fa-folder-plus"></i></a>
                          </td>
                        </tr>
                        <?php if(!empty($carts) && is_array($carts)){?>
                            <?php foreach($carts['data'] as $k => $cart){?>
                              <tr id="<?php echo $k;?>" class="cart-value">
                                <td><?php echo $cart['category_name'];?></td>
                                <td><?php echo $cart['name'];?></td>
                                <td><?php echo $cart['qty'];?></td>
                                <td><?php echo $cart['selling_price'];?></td>
                                <td>₱<?php echo number_format($cart['price']);?></td>
                                <td><span class="btn btn-danger btn-sm transaction-delete-item" data-cart="<?php echo $k;?>"><i class="fa fa-times-circle"></i></span></td>
                              </tr>
                            <?php }?>
                        <?php }?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th colspan="3">Total Purchases</th>
                          <th colspan="2" id="total-purchase"><?php echo !empty($carts) ? '₱'.number_format($carts['total_price']) : '';?></th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-md-3 col-md-offset-4">
                  <a class="btn btn-danger" href="<?php echo site_url('transaction');?>">Cancel</a>
                  <a class="btn btn-success pull-right" href="#" id="submit-transaction1">Submit</a>
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