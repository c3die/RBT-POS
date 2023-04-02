
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar "   >

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel" >
        <div class="pull-left image">
          <img src="http://localhost/RBT-POS/admin/uploads/userav.png" class="img-circle" alt="User Image">
        </div>
       
        <div class="pull-left info"   >
          <p><?php echo $this->username;?></p>
          <!-- Status -->
          <a href="#"><i class="fas fa-circle text-success"></i > Admin</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
       <!-- <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div> -->
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <!--<li class="header">HEADER</li>-->
        <!-- Optionally, you can add icons to the links -->
        <li class="<?php echo is_menu('home','dashboard');?>"><a href="<?php echo site_url();?>"><i class="fa fa-tachometer-alt" aria-hidden="true"></i> <span s>Dashboard</span></a></li>
        <li class="treeview <?php echo is_menu('supplier');?>">
          <a href="#"><i class="fa fa-people-carry"></i> <span>Supplier</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu"> 
			<li class="<?php echo is_menu('supplier');?>"><a href="<?php echo site_url('supplier');?>"><i class="fa fa-people-carry" aria-hidden="true"></i> <span> List Supplier</span></a></li>
			<li class="<?php echo is_menu('supplier','create');?>"><a href="<?php echo site_url('supplier/create');?>"><i class="fa fa-plus-square" aria-hidden="true"></i> <span> Add Supplier</span></a></li>
          </ul>
        </li>
        <li class="treeview <?php echo is_menu('customer');?>">
          <a href="#"><i class="fa fa-user-friends"></i> <span>Customer</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li class="<?php echo is_menu('customer');?>"><a href="<?php echo site_url('customer');?>"><i class="fa fa-user-friends" aria-hidden="true"></i> <span>List Customer</span></a></li>
            <li class="<?php echo is_menu('customer','create');?>"><a href="<?php echo site_url('customer/create');?>"><i class="fa fa-plus-square" aria-hidden="true"></i> <span>Add Customer</span></a></li>
          </ul>
        </li>
        <li class="treeview <?php echo is_menu('category');?>">
          <a href="#"><i class="fa fa-th-list"></i> <span>Category</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li class="<?php echo is_menu('category');?>"><a href="<?php echo site_url('category');?>"><i class="fa fa-th-list" aria-hidden="true"></i> <span>List Category</span></a></li>
            <li class="<?php echo is_menu('category','create');?>"><a href="<?php echo site_url('category/create');?>"><i class="fa fa-plus-square" aria-hidden="true"></i> <span>Add Category</span></a></li>
          </ul>
        </li>
        <li class="treeview <?php echo is_menu('product');?>">
          <a href="#"><i class="fa fa-box-open"></i> <span>Product</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li class="<?php echo is_menu('product');?>"><a href="<?php echo site_url('product');?>"><i class="fa fa-box-open" aria-hidden="true"></i> <span>List Product</span></a></li>
            <li class="<?php echo is_menu('product','create');?>"><a href="<?php echo site_url('product/create');?>"><i class="fa fa-plus-square" aria-hidden="true"></i> <span>Add Product</span></a></li>
            
          </ul>
        </li>
		
        <li class="treeview <?php echo is_menu('sales');?>">
          <a href="#"><i class="fa fa-cash-register"></i> <span>Sales Transaction</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li class="<?php echo is_menu('sales');?>"><a href="<?php echo site_url('sales');?>"><i class="fa fa-chart-area" aria-hidden="true"></i> <span>List Sales</span></a></li>
            <li class="<?php echo is_menu('sales','create');?>"><a href="<?php echo site_url('sales/create');?>"><i class="fa fa-plus-square" aria-hidden="true"></i> <span>Add Sales</span></a></li>
             <li class="<?php echo is_menu('cancel_sales');?>"><a href="<?php echo site_url('cancel_sales');?>"><i class="fa fa-list" aria-hidden="true"></i> <span>CANCEL ORDER</span></a></li>
          </ul>
        </li>

        <li class="treeview <?php echo is_menu('transaction');?>">
          <a href="#"><i class="fa fa-receipt"></i> <span>Purchase Transactions</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu"> 
			<li class="<?php echo is_menu('transaction');?>"><a href="<?php echo site_url('transaction');?>"><i class="fa fa-chart-area" aria-hidden="true"></i> <span>List Transactions</span></a></li>
			<li class="<?php echo is_menu('transaction','create');?>"><a href="<?php echo site_url('transaction/create');?>"><i class="fa fa-plus-square" aria-hidden="true"></i> <span>Add Transactions</span></a></li>
          </ul>
        </li>
        
        <li class="<?php echo is_menu('dues');?>"><a href="<?php echo site_url('dues');?>"><i class="fa fa-coins" aria-hidden="true"></i> <span>List Dues</span></a></li>
        <li class="treeview <?php echo is_menu('return_sales');?>">
          <a href="#"><i class="fa fa-undo"></i> <span>Sales Returns</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li class="<?php echo is_menu('return_sales');?>"><a href="<?php echo site_url('return_sales');?>"><i class="fa fa-undo" aria-hidden="true"></i> <span>List Sales Returns</span></a></li>
            <li class="<?php echo is_menu('return_sales','create');?>"><a href="<?php echo site_url('return_sales/create');?>"><i class="fa fa-plus-square" aria-hidden="true"></i> <span>Add Sales Returns</span></a></li>
          </ul>
        </li>
        <li class="treeview <?php echo is_menu('return_purchase');?>">
          <a href="#"><i class="fa fa-share"></i> <span>Return Purchase</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li class="<?php echo is_menu('return_purchase');?>"><a href="<?php echo site_url('return_purchase');?>"><i class="fa fa-share" aria-hidden="true"></i> <span>List Return Purchase</span></a></li>
            <li class="<?php echo is_menu('return_purchase','create');?>"><a href="<?php echo site_url('return_purchase/create');?>"><i class="fa fa-plus-square" aria-hidden="true"></i> <span>Add Return Purchase</span></a></li>
          </ul>
        </li>
        <li class="treeview <?php echo is_menu('user');?>">
          <a href="#"><i class="fa fa-user-friends"></i> <span>user</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li class="<?php echo is_menu('user');?>"><a href="<?php echo site_url('user');?>"><i class="fa fa-user-friends" aria-hidden="true"></i> <span>List User</span></a></li>
            <li class="<?php echo is_menu('user','create');?>"><a href="<?php echo site_url('user/create');?>"><i class="fa fa-plus-square" aria-hidden="true"></i> <span>Add User</span></a></li>
          </ul>
        </li>
        </li>
        <li class="treeview <?php echo is_menu('log');?>">
          <a href="<?php echo site_url('log');?>"><i class="fa fa-book-open"></i> <span>Audit Trails</span> <i class="fa fa-angle-left pull-right"></i></a>
         
        </li>
      </ul>
      <br />
      <br />
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
