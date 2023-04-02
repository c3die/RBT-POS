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
              <h1 style="text-align: center"> Are you sure to cancel this Transaction ?</h1>
              <?php if($this->session->flashdata('form_false')){?>
                <div class="alert alert-danger text-center">
                  <strong><?php echo $this->session->flashdata('form_false');?></strong>
                </div>
              <?php } ?>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
            <?php if(!empty($sales)){?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('sales/save').'/'.$sales['id'];?>">
            
           
            <?php }
            if(!empty($sales)){?>
             <form class="form-horizontal" method="POST" action="<?php echo site_url('sales/delete').'/'.$sales['id'];?>">
            
            <?php } ?>
              <div class="box-body">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="Code"></label>
                    <div class="col-sm-8">
                    
                 
                      <input type="hidden" name="id" value="<?php echo !empty($sales) ? $sales['id'] : $code_sales;?>" id="id" class="form-control"/>
                      <input type="hidden" name="customer_id" value="<?php echo !empty($sales) ? $sales['customer_id'] : $code_sales;?>" id="customer_id" class="form-control"/>
                      <input type="hidden" name="is_cash" value="<?php echo !empty($sales) ? $sales['is_cash'] : $code_sales;?>" id="is_cash" class="form-control"/>
                      <input type="hidden" name="total_price" value="<?php echo !empty($sales) ? $sales['total_price'] : $code_sales;?>" id="total_price" class="form-control"/>
                      <input type="hidden" name="total_item" value="<?php echo !empty($sales) ? $sales['total_item'] : $code_sales;?>" id="total_item" class="form-control"/>
                      <input type="hidden" name="date" value="<?php echo !empty($sales) ? $sales['date'] : $code_sales;?>" id="date" class="form-control"/>
                     
                     
                     
                     
                     
                     
                      <input type="hidden" name="status" value="Deleted" id="status" class="form-control"/>
                  
                   
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="name"></label>
                    <div class="col-sm-8">

                    </div>
                    </div></div>
               
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="date"></label>
                    <div class="col-sm-8">
                     
                       </div>
                  </div>
                  
                     <input type="hidden" name="status" value="Deleted" id="status" class="form-control"/>
                  
                  
                    </div>

                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-md-3 col-md-offset-4">
                  <a class="btn btn-danger" href="<?php echo site_url('sales');?>">Cancel</a>
                 
                  <button class="btn btn-success pull-right"  type="submit" type="submit">REMOVE</button>
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