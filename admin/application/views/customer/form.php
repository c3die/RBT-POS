<?php $this->load->view('element/head');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Customer Form
        
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
	
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="<?php echo site_url('customer/create');?>">Add Customer</a></li>
            <li role="presentation"><a href="<?php echo site_url('customer');?>">List Customer</a></li>
          </ul>
		  <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Customer</h3>
              <?php if($this->session->flashdata('form_false')){?>
                <div class="alert alert-danger text-center">
                  <strong><?php echo $this->session->flashdata('form_false');?></strong>
                </div>
              <?php } ?>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php if(!empty($customer)){?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('customer/save').'/'.$customer['id'];?>">
            <?php }else{?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('customer/save');?>">
            <?php } ?>
              <div class="box-body">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="Code">Customer Code</label>
                    <div class="col-sm-8">
                      <input type="text" value="<?php echo !empty($customer) ? $customer['id'] : $code_customer;?>" id="code" class="form-control" disabled/>
                      <input type="hidden" name="customer_id" value="<?php echo !empty($customer) ? $customer['id'] : $code_customer;?>" id="customer_id" class="form-control"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="store_name">Name Of Store</label>
                    <div class="col-sm-8">
                      <input type="text" value="<?php echo !empty($user) ? $user['store_name'] : '';?>" name="store_name" placeholder="Enter Name Of Store" id="store_name" class="form-control" required/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="name">Name</label>
                    <div class="col-sm-8">
                      <input type="text" value="<?php echo !empty($customer) ? $customer['customer_name'] : '';?>" name="customer_name" placeholder="Enter Name" id="name" class="form-control" required/>
                    </div>
                  </div>
                  <div class="form-group">
                  <label class="col-sm-4 control-label" for="address">Address</label>
                    <div class="col-sm-8">
                      <textarea name="customer_address" placeholder="Address" id="address" class="form-control"/><?php echo !empty($customer) ? $customer['customer_address'] : '';?></textarea>
                    </div>
                    
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="date">Date</label>
                    <div class="col-sm-8">
                      <input type="text" value="<?php echo !empty($customer) ? $customer['date'] : date('Y-m-d H:i:s');?>" id="date" class="form-control" disabled/>
                      <input type="hidden" name="customer_date" value="<?php echo !empty($customer) ? $customer['date'] : date('Y-m-d H:i:s');?>" id="customer_date" class="form-control"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="phone">Contact</label>
                    <div class="col-sm-8">
                      <input type="number" onkeypress="return isNumeric(event)"  oninput="maxLengthCheck(this)" min="1" max="99999999999" value="<?php echo !empty($customer) ? $customer['customer_phone'] : '';?>" name="customer_phone" placeholder="Phone" id="phone" class="form-control"/>
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-4 control-label" for="email">Email Address</label>
                    <div class="col-sm-8">
                      <input type="text" value="<?php echo !empty($customer) ? $customer['email'] : '';?>" name="email" placeholder="email" id="email" class="form-control"/>
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-4 control-label" for="facebook">Facebook</label>
                    <div class="col-sm-8">
                      <input type="text" value="<?php echo !empty($customer) ? $customer['facebook'] : '';?>" name="facebook" placeholder="Phone" id="facebook" class="form-control"/>
                    </div>
                    <input type="hidden" name="status" value="" id="status" class="form-control"/>
                   
                      
                      <input type="hidden" value="add new customer" name="activity"  id="activity" class="form-control"/>
                      <input type="hidden" value="<?php echo $this->username;  ?>" name="username"  id="username" class="form-control"/>
                      
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-md-3 col-md-offset-4">
                  <a class="btn btn-danger" href="<?php echo site_url('customer');?>">Cancel</a>
                  <button class="btn btn-success pull-right" type="submit">Save</button>
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