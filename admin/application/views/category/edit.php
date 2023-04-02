<?php $this->load->view('element/head');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Category Form
       
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
	
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="<?php echo site_url('category/create');?>">Add Category</a></li>
            <li role="presentation"><a href="<?php echo site_url('category');?>">List Category</a></li>
          </ul>
		  <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Category</h3>
              <?php if($this->session->flashdata('form_false')){?>
                <div class="alert alert-danger text-center">
                  <strong><?php echo $this->session->flashdata('form_false');?></strong>
                </div>
              <?php } ?>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php if(!empty($category)){?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('category/save').'/'.$category['id'];?>">
            <?php }else{?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('category/save');?>">
            <?php } ?>
              <div class="box-body">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="kode">Category Code</label>
                    <div class="col-sm-8">
                    <input type="text" value="<?php echo !empty($category) ? $category['id'] : $code_cat;?>" id="kode" class="form-control" disabled/>
                    <input type="hidden" name="category_id" value="<?php echo !empty($category) ? $category['id'] : $code_cat;?>" id="category_id" class="form-control"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="name">Category Name</label>
                    <div class="col-sm-8">
                      <input type="text" value="<?php echo !empty($category) ? $category['category_name'] : '';?>" name="category_name" placeholder="Category Name" id="name" class="form-control" required/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="address">Description</label>
                    <div class="col-sm-8">
                    <input type="hidden" name="status" value="ㅤ" id="status" class="form-control"/>
                  
                    <textarea name="category_desc" placeholder="Description" id="desc" class="form-control"/><?php echo !empty($category) ? $category['category_desc'] : '';?></textarea>
                    <input type="hidden" value="edit Category" name="activity"  id="activity" class="form-control"/>
                      <input type="hidden" value="<?php echo $this->username;  ?>" name="username"  id="username" class="form-control"/>

                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="date">Date</label>
                    <div class="col-sm-8">
                      <input type="text" value="<?php echo !empty($category) ? $category['date'] : date('Y-m-d H:i:s');?>" id="date" class="form-control" disabled/>
                      <input type="hidden" name="category_date" value="<?php echo !empty($category) ? $category['date'] : date('Y-m-d H:i:s');?>" id="category_date" class="form-control"/>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-md-3 col-md-offset-4">
                  <a class="btn btn-danger" href="<?php echo site_url('category');?>">Cancel</a>
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