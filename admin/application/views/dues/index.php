<?php $this->load->view('element/head');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dues
        
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="<?php echo site_url('dues');?>">List Dues</a></li>
          </ul>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Dues Data Table</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form action="<?php echo site_url('dues?search=true');?>" method="GET">
                <input type="hidden" class="form-control" name="search" value="true"/>
                <div class="box-body pad">
                  <div class="col-md-1">
                    <div class="form-group">
                      <label>&nbsp</label>
                      <a href="#" id="dues-reset" class="btn btn-danger btn-sm pull-left">Reset</a>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="id">Transaction Code</label>
                      <input type="text" class="form-control" name="id" value="<?php echo !empty($_GET['id']) ? $_GET['id'] : '';?>"/>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Date From</label>
                      <select class="form-control" name="date_range" id="dues-date-range">
                        <option value="">Select Days..</option>
                        <option value="7" <?php echo !empty($_GET['date_range']) && $_GET['date_range'] == 7 ? "selected":"";?>>7 Days</option>
                        <option value="14" <?php echo !empty($_GET['date_range']) && $_GET['date_range'] == 14 ? "selected":"";?>>14 Days</option>
                        <option value="30" <?php echo !empty($_GET['date_range']) && $_GET['date_range'] == 30 ? "selected":"";?>>30 Days</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Date Transaction</label>
                      <div class="input-group date">
                        <input type="text" class="form-control datepicker" name="date_trx" value="<?php echo !empty($_GET['date_trx']) ? $_GET['date_trx'] : '';?>"/>
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
                      <a href="<?php echo site_url('dues/export_csv').get_uri();?>" class="form-control btn btn-info"><i class="fa fa-file-csv"></i> Export Excel</a>
                    </div>
                  </div>
                </div>
              </form>
              <table id="example1" class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                  <th>Transaction ID</th>
                  <th>Customer Name</th>
                  <th>Total Item</th>
                  <th>Total Price</th>
                  <th>Due</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php if(isset($dues) && is_array($dues)){ ?>
                  <?php foreach($dues as $dues){?>
                    <tr>
                      <td><?php echo $dues->id;?></td>
                      <td><?php echo $dues->customer_name;?></td>
                      <td><?php echo $dues->total_item;?></td>
                      <td>₱<?php echo number_format($dues->total_price);?></td>
                      <?php 
                      
                      
                      if ($dues->pay_deadline_date < date("Y-m-d")){ ?>
							  <td ><span class="alert alert-danger"><?php echo $dues->pay_deadline_date ?></span></td>
                <?php } elseif($dues->pay_deadline_date > date("Y-m-d")){ ?>
							  <td ><span class="alert alert-warning"><?php echo $dues->pay_deadline_date ?></span></td>
                <?php } ?>
                      <td>
                        <a href="<?php echo site_url('dues/detail').'/'.$dues->id;?>" class="btn btn-xs btn-primary">Detail</a>
                         </td>
                    </tr>
                  <?php } ?>
                <?php } ?>
                </tbody>
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