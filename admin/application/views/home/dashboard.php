<?php
$db = mysqli_connect("localhost","root","","rbt-database");
if(!$db){
    echo "Problem in database connection..." .mysqli_error();
}else{
    $sql =  "SELECT product.product_name, COUNT(sales_data.product_id) AS NumberOfOrders FROM sales_data LEFT JOIN product ON sales_data.product_id = product.id GROUP BY product_name ORDER BY COUNT(product_id) DESC LIMIT 3";
    $result = mysqli_query($db,$sql);
    $chart_data = "";
    while($row = mysqli_fetch_array($result)){
        $productname[] = $row['product_name'];
        $sales[] = $row['NumberOfOrders'];
    }
}
?>
<?php $this->load->view('element/head');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        
      </h1>
    
    </section>

    <!-- Main content -->
    <section class="content" >
		<div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12" >
        <a href="<?php echo site_url('supplier');?>" style="color: Black" >
          <div class="info-box" style="box-shadow: 2px 5px 2px 1px steelblue;">
            <span class="info-box-icon bg-blue"><i class="fas fa-people-carry"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Suppliers</span>
              <span class="info-box-number"><?php echo $suppliers;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
        <a href="<?php echo site_url('product');?>"style="color: Black">
          <div class="info-box" style="box-shadow: 2px 5px 2px 1px steelblue;">
            <span class="info-box-icon bg-blue" ><i class="fas fa-box-open"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Products</span>
              <span class="info-box-number"><?php echo $products;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box" style="box-shadow: 2px 5px 2px 1px steelblue;">
          <a href="<?php echo site_url('product/lowstock');?>"  style="color: Black" >
            <span class="info-box-icon bg-blue"><i class="fa fa-undo"></i></span>

            <div class="info-box-content">
              <span class="info-box-text" >Low Stock</span>

              <?php if ($productsss < 1){ ?>
                <span class="info-box-number " style="color: Black;"><?php echo $productsss ?></span>
                <?php } else if ($productsss > 0){ ?>
                  <span class="info-box-number " style="color: Orange;"><?php echo $productsss ?></span>
                  <?php } else if ($productsss > 5){ ?>
                  <span class="info-box-number " style="color: red;"><?php echo $productsss ?></span>
                <?php }?> 



            <!--   <span class="info-box-number " style="color: red;"><?php echo $productsss;?></span>-->
        </a>  
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->


        <div class="clearfix visible-sm-block"></div>

<div class="col-md-3 col-sm-6 col-xs-12">
  <div class="info-box" style="box-shadow: 2px 5px 2px 1px steelblue;">
  <a href="<?php echo site_url('customer');?>" style="color: Black">
    <span class="info-box-icon bg-blue"><i class="fas fa-user-friends"></i></span>

    <div class="info-box-content">
      <span class="info-box-text" >Customers</span>
      <span class="info-box-number"><?php echo $customers;?></span>
</a>  
    </div>
    <!-- /.info-box-content -->
  </div>
  <!-- /.info-box -->
</div>
<!-- /.col -->


  
<div class="col-md-3 col-sm-6 col-xs-12">
        <a href="<?php echo site_url('dues');?>"style="color: Black">  
          <div class="info-box" style="box-shadow: 2px 5px 2px 1px steelblue;">
            <span class="info-box-icon  bg-blue" ><i class="fa fa-credit-card" aria-hidden="true"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">credit</span>
              <?php if ($dues < 1){ ?>
                <span class="info-box-number " style="color: Black;"><?php echo $dues ?></span>
                <?php } else if ($dues > 0){ ?>
                  <span class="info-box-number " style="color: Orange;"><?php echo $dues ?></span>
                  <?php } else if ($dues > 5){ ?>
                  <span class="info-box-number " style="color: red;"><?php echo $dues ?></span>
               
                  <?php }?>   
              
              
              
              </div>
            <!-- /.info-box-content -->
          </div>
          </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
        <a href="<?php echo site_url('transaction');?>"style="color: Black">  
          <div class="info-box" style="box-shadow: 2px 5px 2px 1px steelblue;">
            <span class="info-box-icon  bg-blue" ><i class="fa fa-money-bill-wave" aria-hidden="true"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Monthly Expenses</span>
              <span class="info-box-number"><?php  $query = $this->db->query('SELECT SUM( total_price)as total FROM purchase_transaction where MONTH(date) =  MONTH (CURRENT_DATE()) ')->row(); echo '₱'.floatval($query->total);?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
      <!--  </div>
         <div class="col-md-3 col-sm-6 col-xs-12">
       <a href="<?php echo site_url('transaction');?>"style="color: Black">
          <div class="info-box">
            <span class="info-box-icon bg-"><i class="fa fa-money-bill-wave" aria-hidden="true"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Expenses Yearly</span>
              <span class="info-box-number"><?php // $query = $this->db->query('SELECT SUM( total_price)as total FROM purchase_transaction where YEAR(date) =  YEAR (CURRENT_DATE()) ')->row(); echo '₱'.floatval($query->total);?></span>
            </div>
            
          </div>-->
           
        </div>
  


        <div class="col-md-3 col-sm-6 col-xs-12">
        <a href="<?php echo site_url('sales');?>"style="color: Black">
          <div class="info-box" style="box-shadow: 2px 5px 2px 1px steelblue;">
            <span class="info-box-icon  bg-blue"><i class="fas fa-dollar-sign"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"> Daily Earnings</span>
              <span class="info-box-number"><?php 
             $query = $this->db->query('SELECT sum(subtotal) - sum(buying_price)  AS total FROM sales_data WHERE  day(date) = day(current_date)')->row(); echo '₱'.floatval($query->total);
          //    $query = $this->db->query('SELECT SUM( total_price)as total FROM sales_transaction WHERE is_cash = 1 AND day(date) = day(current_date)')->row(); echo '₱'.floatval($query->total);?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
        <a href="<?php echo site_url('sales');?>"style="color: Black">
          <div class="info-box" style="box-shadow: 2px 5px 2px 1px steelblue;">
            <span class="info-box-icon  bg-blue"><i class="fas fa-dollar-sign"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Monthly Earnings </span>
              <span class="info-box-number"><?php 
          $query = $this->db->query('SELECT sum(subtotal) - sum(buying_price) AS total FROM sales_data WHERE month(date) = month(current_date)')->row(); echo '₱'.floatval($query->total);
             // $query = $this->db->query('SELECT SUM( total_price)as total FROM sales_transaction WHERE is_cash = 1 AND month(date) = month(current_date)')->row(); echo '₱'.floatval($query->total);?>
              
            </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        </div>
        <div class="row">

<div class="col-md-12">
  <div class="box">
    <div class="box-header with-border">
      <h3  style="text-align: center"><i ></i>   </h3>

              <div class="box-tools pull-right">
                <button data-widget="collapse" class="btn btn-box-tool" type="button"><i class="fa fa-minus"></i>
                </button>
                
                <button data-widget="remove" class="btn btn-box-tool" type="button"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <p class="text-center">
                  
                  </p>

                  <div class="chart">
					  <table id="example3"  class="table table-bordered table-striped table-hover" >
            <thead>
						<tr>
						 


          </div>
       
            
          
<body>
 <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>


<canvas id="chartjs_bar"   ></canvas>
       


 
   
<script type="text/javascript">
      var ctx = document.getElementById("chartjs_bar").getContext('2d');
      var myChart = new Chart(ctx,{
          type: 'bar',
          data: {
            labels: <?php echo json_encode($productname); ?>,
            
            datasets: [{
              backgroundColor: ["steelblue", "steelblue","steelblue"],
                data: <?php echo json_encode($sales);?>
                
            }]
          },
          options:{
            legend: {display: false},
            title :{
              display: true,
              text : "TOP 3 SELLING PRODUCT",
              fontFamily: 'Circular Std Book',
                      fontSize: 14,
            }
         
          }
      });
    </script>

							
						 <!--

						  <th>PRODUCT NAME</th>
						  <th>NUMBER OF ORDER</th>
						 
						</tr>
						</thead>
						<tbody>
						<?php// if(isset($tprod) && is_array($tprod)){ ?>
						  <?php// foreach($tprod as $tprod){?>
							<tr>
							  <td><?php// echo $tprod->customer_name;?></td>
							  <td  > <span class="alert bg-purple"> <?php// echo $tprod->NumberOfOrders;?></span></td>
				
							
						  <?php// } ?>
						<?php //} ?>

            -->




				
							</tr>
            
						</tbody>
					  </table>
            
              </div>
        </a>
        </div>
      <div class="col-md-4"  style="box-shadow: 2px 5px 2px 1px steelblue;">
				  <div class=" bg-blue"style="text-align : Center;  border-radius: 10px; ">
          <span style=" font-weight: bold; font-size:24px">Loyal Customer </span>
          <table id="example1" class="table table-bordered table-striped table-hover">
          <div style="text-align : Center: font-size: 15px" >
					  
            <thead>
						<tr>
						 
						  <th>Customer Name</th>
              <th>Number of order</th>
						</tr>
						</thead>

            <tbody  style=" color: black; ">
						<?php if(isset($tprod) && is_array($tprod)){ ?>
						  <?php foreach($tprod as $tprod){?>
							<tr>
							  <td  ><?php echo $tprod->customer_name;?></td>
							  <td  ><?php echo $tprod->NumberOfOrders;?></td>
							 
							</tr>
						  <?php } ?>
						<?php } ?>
						</tbody>



            </table>
					</div>
				  </div>
      </div>

    
	
                  <!-- /.chart-responsive -->
               



                
                <!-- /.col -->
         
            
         
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
 </div>
        <div class="row">


    
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $this->load->view('element/footer');?>


