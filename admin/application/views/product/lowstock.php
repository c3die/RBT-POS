<?php $this->load->view('element/head');?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Low Stock
                
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <ul class="nav nav-tabs">
                     
                       
                    </ul>
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Product Data Table</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form action="<?php echo site_url('product?search=true');?>" method="GET">
                                <input type="hidden" class="form-control" name="search" value="true"/>
                                <div class="box-body pad">
                                    <?php echo search_form('product');?>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="submit">&nbsp</label>
                                            <input type="submit" value="Search" class="form-control btn btn-warning">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="submit">&nbsp</label>
                                            <a href="<?php echo site_url('product/export_csv').get_uri();?>" class="form-control btn btn-info"><i class="fa fa-file-csv"></i> Export Excel</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Product Name</th>
                                    <th>Description</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                              
                                <?php if(isset($products) && is_array($products)){ ?>
                                    <?php foreach($products as $product){?>
                                        <tr>
                                            <td><?php echo $product->id;?></td>
                                            <td><?php echo $product->product_name;?></td>
                                            <td width="350px"><?php echo $product->product_desc;?></td>
                                            <?php if ($product->product_qty > $product->reorder_level){ ?>
							  <td ><span class="alert alert-warning"><?php echo $product->product_qty ?></span></td>
                <?php } else if ($product->product_qty <=  $product->reorder_level){ ?>
							  <td ><span class="alert alert-danger"><?php echo $product->product_qty ?></span></td>
                <?php }?> 
                                            <td><?php echo '₱'.$product->sale_price;?></td>
                                           
                                            <td>
                                                <a href="<?php echo site_url('transaction/create')?>" class="btn btn-xs btn-primary">Buy Product</a>
                                              
                                            </td>
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