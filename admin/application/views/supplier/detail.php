<?php $this->load->view('element/head');?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            Supplier Details
               
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <ul class="nav nav-tabs">
                        <li role="presentation"><a href="<?php echo site_url('supplier/create');?>">Add Supplier</a></li>
                        <li role="presentation" class="active"><a href="<?php echo site_url('supplier');?>">List Transaction</a></li>
                    </ul>
                    <div class="box">
                        <div class="box-header">
                           
                            <div class="pull-right">
                                <span><a href="<?php echo site_url('supplier');?>" class="btn btn-sm btn-danger">Back</a></span>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Supplier ID</th>
                                    <th>Supplier Name</th>
                                    <th>Supplier Email</th>
                                    <th>Supplier Address</th>
                                    <th>Supplier  Phone</th>

                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo $details[0]->supplier_id;?></td>
                                        <td><?php echo $details[0]->company_name;?></td>
                                        <td><?php echo $details[0]->email;?></td>
                                        <td><?php echo $details[0]->supplier_address;?></td>
                                        <td><?php echo $details[0]->supplier_phone;?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr />
                            <h4><b>Supplier Item</b></h4>
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>

                                        <th>Description</th>
                                        <th>Price</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if(isset($details) && is_array($details)){ ?>
                                    <?php foreach($details as $transaksi){?>
                                        <tr>
                                            <td><?php echo $transaksi->product_name;?></td>
                                            <td><?php echo $transaksi->product_desc;?></td>
                                            <td>₱<?php echo $transaksi->selling_price;?></td>
                                           
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                      
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
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