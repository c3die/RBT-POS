<?php $this->load->view('element/head');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      CANCEL Form
      
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
	
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs">
            
          </ul>
		  <div class="box box-info">
            <div class="box-header with-border">
              <h1 style="text-align: center"> Are you sure to removed this PRODUCT ?</h1>
              <?php if($this->session->flashdata('form_false')){?>
                <div class="alert alert-danger text-center">
                  <strong><?php echo $this->session->flashdata('form_false');?></strong>
                </div>
              <?php } ?>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php if(!empty($product)){?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('product/save').'/'.$product['id'];?>">
            <?php }else{?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('product/save');?>">
            <?php } ?>
              <div class="box-body">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="Code"></label>
                    <div class="col-sm-8">
                      <input type="hidden" name="product_id" value="<?php echo !empty($product) ? $product['id'] : $code_product;?>" id="product_id" class="form-control"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="name"></label>
                    <div class="col-sm-8">
                        <input type="hidden" name="product_name" value="<?php echo !empty($product) ? $product['product_name'] : $product_name;?>" id="product_name" class="form-control"/>
                        <input type="hidden" name="category_id" value="ㅤ" id="category_id" class="form-control"/>
                        <input type="hidden" name="sale_price" value="<?php echo !empty($product) ? $product['sale_price'] : $product_name;?>" id="sale_price" class="form-control"/>
                  
                    </div>
                    </div></div>

                      <input type="hidden" value="delete Product" name="activity"  id="activity" class="form-control"/>
                      <input type="hidden" value="<?php echo $this->username;  ?>" name="username"  id="username" class="form-control"/>
               
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="date"></label>
                    <div class="col-sm-8">
                     
                      <input type="hidden" name="product_date" value="<?php echo !empty($product) ? $product['date'] : date('Y-m-d H:i:s');?>" id="product_date" class="form-control" />
                    </div>
                  </div>
                  
                     <input type="hidden" name="status" value="Deleted" id="status" class="form-control"/>
                  
                  
                    </div>
                 <!--   <div class="form-group">
                    <label class="col-sm-4 control-label" for="status">status</label>
                    <div class="col-sm-8">
                      <input type="text" value="1" name="product_phone" placeholder="status" id="status" class="form-control" disabled/>
                    </div>
                    -->
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-md-3 col-md-offset-4">
                  <a class="btn btn-danger" href="<?php echo site_url('product');?>">Cancel</a>
                  <button class="btn btn-success pull-right" type="submit">REMOVE</button>
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