<?php $this->load->view('element/head');?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            Customer
               
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <ul class="nav nav-tabs">
                        <li role="presentation"><a href="<?php echo site_url('customer/create');?>">Add Customer</a></li>
                        <li role="presentation" class="active"><a href="<?php echo site_url('customer');?>">List Customer</a></li>
                    </ul>
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Data Table Customer</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form action="<?php echo site_url('customer?search=true');?>" method="GET">
                                <input type="hidden" class="form-control" name="search" value="true"/>
                                <div class="box-body pad">
                                    <?php echo search_form('customer');?>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="submit">&nbsp</label>
                                            <input type="submit" value="Search" class="form-control btn btn-warning">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="submit">&nbsp</label>
                                            <a href="<?php echo site_url('customer/export_csv').get_uri();?>" class="form-control btn btn-info"><i class="fa fa-file-csv"></i> Export Excel</a>
                                            
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form class="form-horizontal" method="POST" action="<?php echo site_url('customer/delete');?>">
                            <input type="hidden" id="status" name="status" value="1">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Name of Store</th>
                                    <th>Customer Name</th>
                                    <th>Contact</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(isset($customers) && is_array($customers)){ ?>
                                    <?php foreach($customers as $customer){?>
                                        <tr>
                                            <td><?php echo $customer->id;?></td>
                                            <td><?php echo $customer->store_name;?></td>
                                            <td><?php echo $customer->customer_name;?></td>
                                            <td><?php echo $customer->customer_phone;?></td>
                                            <td><?php echo $customer->customer_address;?></td>
                                            <td>
                                           
                                                <a href="<?php echo site_url('customer/edit').'/'.$customer->id;?>" class="btn btn-xs btn-primary">Edit</a>
                                                <a  href="<?php echo site_url('customer/cancel').'/'.$customer->id;?>" class="btn btn-xs btn-danger">remove</a>
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