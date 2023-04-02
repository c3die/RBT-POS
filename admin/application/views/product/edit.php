<?php $this->load->view('element/head');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Product Form
        
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
	
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="<?php echo site_url('product/create');?>">Add Product</a></li>
            <li role="presentation"><a href="<?php echo site_url('product');?>">List Product</a></li>
          </ul>
		  <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Product</h3>
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
                    <label class="col-sm-4 control-label" for="kode">Product Code</label>
                    <div class="col-sm-8">
                    <input type="text" value="<?php echo !empty($product) ? $product['id'] : $code_product;?>" id="kode" class="form-control" disabled/>
                      <input type="hidden" name="product_id" value="<?php echo !empty($product) ? $product['id'] : $code_product;?>" id="product_id" class="form-control"/>
                      <input type="hidden" name="status" value="" id="status" class="form-control"/>
                  
                          <input type="hidden" value="edit Product" name="activity"  id="activity" class="form-control"/>
                      <input type="hidden" value="<?php echo $this->username;  ?>" name="username"  id="username" class="form-control"/>


                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="name">Product Name</label>
                    <div class="col-sm-8">
                      <input type="text" value="<?php echo !empty($product) ? $product['product_name'] : '';?>" name="product_name" placeholder="Product Name" id="name" class="form-control" required/>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="date">Date</label>
                    <div class="col-sm-8">
                      <input type="text" value="<?php echo !empty($product) ? $product['date'] : date('Y-m-d H:i:s');?>" id="date" class="form-control" disabled/>
                      <input type="hidden" name="product_date" value="<?php echo !empty($product) ? $product['date'] : date('Y-m-d H:i:s');?>" id="product_date" class="form-control"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="category_id">Category</label>
                    <div class="col-sm-8">
                      <select class="form-control" id="category_id" name="category_id">
                        <?php if(isset($category) && is_array($category)){?>
                          <?php foreach($category as $item){?>
                            <option value="<?php echo $item->id;?>" <?php if(!empty($product) && $item->id == $product['category_id']) echo 'selected="selected"';?>>
                              <?php echo $item->category_name;?>
                            </option>
                          <?php }?>
                        <?php }?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="address">Description</label>
                    <div class="col-sm-4">
                      <select name="product_desc" placeholder="Description" id="desc" class="form-control"/><?php echo !empty($product) ? $product['product_desc'] : '';?>
                      <option value="normal size bottle">REGULAR size bottle</option>
                      <option value="Mismo">MISMO</option>
                      <option value="330ml">330ml</option>
                      <option value="500ml">500ml</option>
                      <option value="500ml">800ml</option>
                      <option value="1 litters">1 litters</option>
                      <option value="1 litters">1 litters</option>
                      <option value="1.5 litters">1.5 litters</option>
                      <option value="2 litters">2 litters</option>
                      <option value="2.5 litters">2.5 litters</option>
                      <option value="5 litters">5 litters</option>
                      <option value="6 litters">6 litters</option>
                      <option value="7 litters">7 litters</option>
                      
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"  for="address">Quantity</label>
                    <div class="col-sm-2">
                      <input type="number"  onkeypress="return isNumeric(event)"  oninput="maxLengthCheck(this)" value="<?php echo !empty($product) ? $product['product_qty'] : '1';?>" name="product_qty" placeholder="Quantity" id="qty" min="1" max="999" class="form-control"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="address">Selling Price</label>
                    <div class="col-sm-2">
                      <input type="number" onkeypress="return isNumeric(event)"  oninput="maxLengthCheck(this)" min="1" max="9999" value="<?php echo !empty($product) ? $product['sale_price'] : '0';?>" name="sale_price" placeholder="Product Sale" id="sale" class="form-control" required/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="address">Re-order Level</label>
                    <div class="col-sm-2">
                    <input type="number"  onkeypress="return isNumeric(event)"  oninput="maxLengthCheck(this)" value="<?php echo !empty($product) ? $product['reorder_level'] : '0';?>" name="reorder_level" placeholder="Quantity" id="reorder_level" min="0" max="999" class="form-control"/>
                    
                    </div>
                  </div>
                </div>
                
               
                
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-md-3 col-md-offset-4">
                  <a class="btn btn-danger" href="<?php echo site_url('product');?>">Cancel</a>
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