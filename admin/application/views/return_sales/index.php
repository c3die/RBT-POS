<?php $this->load->view('element/head');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Sales Return Transaction
       
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs">
            <li role="presentation"><a href="<?php echo site_url('return_sales/create');?>">Add Sales Returns</a></li>
            <li role="presentation" class="active"><a href="<?php echo site_url('return_sales');?>">Sales Returns List</a></li>
          </ul>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Sales DataTable</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form action="<?php echo site_url('return_sales?search=true');?>" method="GET">
                <input type="hidden" class="form-control" name="search" value="true"/>
                <div class="box-body pad">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="id">Sales Code</label>
                      <input type="text" class="form-control" name="id" value="<?php echo !empty($_GET['id']) ? $_GET['id'] : '';?>"/>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Date From</label>
                      <div class="input-group date">
                        <input type="text" class="form-control datepicker-transaction" name="date_from" value="<?php echo !empty($_GET['date_from']) ? $_GET['date_from'] : '';?>"/>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Date End</label>
                      <div class="input-group date">
                        <input type="text" class="form-control datepicker-transaction" name="date_end" value="<?php echo !empty($_GET['date_end']) ? $_GET['date_end'] : '';?>"/>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="submit">&nbsp</label>
                      <input type="submit" value="Search" class="form-control btn btn-warning">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="submit">&nbsp</label>
                      <a href="<?php echo site_url('return_sales/export_csv');?>" class="form-control btn btn-info"><i class="fa fa-file-csv"></i> Export Excel</a>
                    </div>
                  </div>
                </div>
              </form>
              <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th>Return ID</th>
                  <th>Sales TRX ID</th>
                  <th>Total Item</th>
                  <th>Total Price</th>
                  <th>Return of goods</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php if(isset($sales) && is_array($sales)){ ?>
                  <?php foreach($sales as $sales){?>
						<tr>
						  <td><?php echo $sales->id;?></td>
						  <td>
							<?php echo $sales->sales_id;?>
							<a target="_blank" href="<?php echo site_url('sales/detail').'/'.$sales->sales_id;?>" class="btn btn-xs btn-primary">
							  Detail
							</a>
						  </td>
						  <td><?php echo $sales->total_item;?></td>
						  <td>₱<?php echo number_format($sales->total_price);?></td>
						  <td><?php echo $sales->is_return == 1 ? "Complete" : "Not Complete";?></td>
						  <td><?php echo $sales->date;?></td>
						  <td>
							<?php if($sales->is_return == 0){?>
								<a href="<?php echo site_url('return_sales/edit').'/'.$sales->id;?>" class="btn btn-xs btn-warning">Edit</a>
							<?php }else{ ?>
								<span class="btn-xs btn-success">Complete</span>		
							<?php } ?>
							
						  </td>
						</tr>
                  <?php } ?>
                <?php } ?>
                </tbody>
                <tfoot>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="text-center">
              <?php echo $paggination;?>
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $this->load->view('element/footer');?>