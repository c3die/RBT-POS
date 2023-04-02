<?php $this->load->view('element/head');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Supplier Form
       
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">
	
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="<?php echo site_url('supplier/create');?>">Add Supplier</a></li>
            <li role="presentation"><a href="<?php echo site_url('supplier');?>">List Supplier</a></li>
          </ul>
		  <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Supplier</h3>
              <?php if($this->session->flashdata('form_false')){?>
                <div class="alert alert-danger text-center">
                  <strong><?php echo $this->session->flashdata('form_false');?></strong>
                </div>
              <?php } ?>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php if(!empty($supplier)){?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('supplier/save').'/'.$supplier['id'];?>">
            <?php }else{?>
         <   <form class="form-horizontal" method="POST" action="<?php echo site_url('supplier/save');?>"> 
           <!-- <form class="form-horizontal" method="POST" action="<?php echo site_url('supplier/save1');?>">-->
            <?php } ?>
              <div class="box-body">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="code">Supplier Code</label>
                    <div class="col-sm-8">
                      <input type="text" value="<?php echo !empty($supplier) ? $supplier['id'] : $code_supplier;?>" id="kode" class="form-control" disabled/>
                      <input type="hidden" name="supplier_id" value="<?php echo !empty($supplier) ? $supplier['id'] : $code_supplier;?>" id="suplier_id" class="form-control"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="name">Company Name</label>
                    <div class="col-sm-8">
                      <input type="text" value="<?php echo !empty($supplier) ? $supplier['company_name'] : '';?>" name="company_name" placeholder="Company Name" id="company_name" class="form-control" required/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="name">Supplier Name</label>
                    <div class="col-sm-8">
                      <input type="text" value="<?php echo !empty($supplier) ? $supplier['supplier_name'] : '';?>" name="supplier_name" placeholder="Supplier Name" id="name" class="form-control" required/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="name">Email</label>
                    <div class="col-sm-8">
                      <input type="text" value="<?php echo !empty($supplier) ? $supplier['email'] : '';?>" name="email" placeholder="Email" id="email" class="form-control" required/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="address">Address</label>
                    <div class="col-sm-8">
                      <textarea name="supplier_address" placeholder="Address" id="address" class="form-control"><?php echo !empty($supplier) ? $supplier['supplier_address'] : '';?></textarea>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="date">Date</label>
                    <div class="col-sm-8">
                      <input type="text" value="<?php echo !empty($supplier) ? $supplier['date'] : date('Y-m-d');?>" id="date" class="form-control" disabled/>
                      <input type="hidden" name="supplier_date" value="<?php echo !empty($supplier) ? $supplier['date'] : date('Y-m-d H:i:s');?>" id="supplier_date" class="form-control"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="phone">Contact</label>
                    <div class="col-sm-8">
                      <input type="number" onkeypress="return isNumeric(event)"  oninput="maxLengthCheck(this)" min="1" max="99999999999" value="<?php echo !empty($supplier) ? $supplier['supplier_phone'] : '';?>" name="supplier_phone" placeholder="Phone" id="phone" class="form-control"/>
                     
                     
                      <input type="hidden" name="status" value="" id="status" class="form-control"/>
                      
                      <input type="hidden" value="Edit supplier" name="activity"  id="activity" class="form-control"/>
                      <input type="hidden" value="<?php echo $this->username;  ?>" name="username"  id="username" class="form-control"/>
                      
                    
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-md-3 col-md-offset-4">
                  <a class="btn btn-danger" href="<?php echo site_url('supplier');?>">Cancel</a>
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