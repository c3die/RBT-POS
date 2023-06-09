<?php $this->load->view('element/head');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Sales Return Transaction Form
        
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
	
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="<?php echo site_url('return_sales/create');?>">Add Sales Return</a></li>
            <li role="presentation"><a href="<?php echo site_url('return_sales');?>">Sales Returns List</a></li>
          </ul>
		  <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Sales Returns</h3>
              <?php if($this->session->flashdata('form_false')){?>
                <div class="alert alert-danger text-center">
                  <strong><?php echo $this->session->flashdata('form_false');?></strong>
                </div>
              <?php } ?>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php if(!empty($edit) && $edit){?>
            <form id="transaction-form" class="form-horizontal" method="POST" action="<?php echo site_url('return_sales/update').'/'.$code_return_sales;?>">
            <?php }else{?>
            <form id="transaction-form" class="form-horizontal" method="POST" action="<?php echo site_url('return_sales/add_process');?>">
            <?php } ?>
              <div class="box-body">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="code">Sales Return Code</label>
                    <div class="col-sm-8">
                      <input type="text" name="id" value="<?php echo !empty($code_return_sales) ? $code_return_sales : '';?>" class="form-control" disabled/>
                      <input type="hidden" name="return_id" id="return_id" value="<?php echo !empty($code_return_sales) ? $code_return_sales : '';?>"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="code">Sales Code</label>
                     <div class="col-sm-8">
                       <input type="text" name="id" value="<?php echo !empty($code_sales) ? $code_sales : '';?>" class="form-control" disabled/>
                       <input type="hidden" name="return_code" id="return_code" value="<?php echo !empty($code_sales) ? $code_sales : '';?>"/>
                     </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="date">Date</label>
                     <input type="hidden" value="add new Return Sales" name="activity"  id="activity" class="form-control"/>
                      <input type="hidden" value="<?php echo $this->username;  ?>" name="username"  id="username" class="form-control"/>
                    <div class="col-sm-8">
                      <input type="text" value="<?php echo !empty($date) ? $date : date('Y-m-d H:i:s');?>" id="date" class="form-control" disabled/>
                      <input type="hidden" name="return_date" value="<?php echo !empty($date) ? $date : date('Y-m-d H:i:s');?>" id="return_date" class="form-control"/>
                    </div>
                  </div>
                  <?php if(!empty($edit) && $edit){?>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="date">Return of goods</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="is_return" id="is_return">
                            <option value="1" <?php echo (int)$details[0]->is_return == 1 ? "selected" : "";?>>Yes</option>
                            <option value="0" <?php echo (int)$details[0]->is_return == 0 ? "selected" : "";?>>No</option>
                        </select>
                    </div>
                  </div>
                  <?php } ?>
                </div>
                <div class="col-md-11 col-md-offset-1">
                  <h3 class="content-title">Information on the item you want to return</h3>
                  <div class="content-process">
                    <table class="table">
                      <thead>
                        <tr>
                          <td>Category</td>
                          <td>Item Name</td>
                          <td>Amount</td>
                          <td>Unit Purchase Price</td>
                          <td>Action</td>
                        </tr>
                      </thead>
                      <tbody id="transaction-item">
                        <?php if(!empty($carts) && is_array($carts)){?>
                            <?php foreach($carts['data'] as $k => $cart){?>
                              <tr id="<?php echo $k;?>" class="cart-value">
                                <td><?php echo $cart['category_name'];?></td>
                                <td><?php echo $cart['name'];?></td>
                                <td><input type="number" row-id="<?php echo $k;?>" class="return_sales_qty" value="<?php echo $cart['qty'];?>" max="<?php echo $cart['qty'];?>" min="1"/></td>
                                <td>₱<?php echo number_format($cart['price']);?></td>
                                <td><span class="btn btn-danger btn-sm transaction-delete-item" data-cart="<?php echo $k;?>"><i class="fa fa-times-circle"></i></span></td>
                              </tr>
                            <?php }?>
                        <?php }?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td>Total Sales</td>
                          <td id="total-purchase"><?php echo !empty($carts) ? '$'.number_format($carts['total_price']) : '';?></td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-md-3 col-md-offset-4">
                  <a class="btn btn-danger" href="<?php echo site_url('return_sales');?>">Cancel</a>
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