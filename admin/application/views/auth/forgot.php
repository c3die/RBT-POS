

<?php $this->load->view('element/head');?>
<body class="hold-transition login-page">
<div class="login-box">

  <div class="login-logo">

    <a href="#"><b> Rjhaynne Beverage Trading </b>pos</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
  <a href="<?php echo site_url('Auth/login');?>">Back to login</a>
  <p class="login-box-msg">-Forgot Password-</p>
	
	<?php if($this->session->flashdata('forgot_success')){?>
		<div class="alert alert  bg-green">
			<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
			<h4>
				<i class=""></i>
			</h4>
			<?php echo $this->session->flashdata('forgot_success');?>
		</div>
	<?php } ?>
    
	<form action="<?php echo site_url('auth/forgot_process');?>" method="post">
  <label class="" for="date">Enter your Email Address <label>
      <div class="form-group has-feedback">
        <input type="text" name="email" class="form-control" placeholder="Enter Here">
      </div>
    



      <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Password</th>
                                  
                                </tr>
                                </thead>
                           <tbody>
                                <?php if(isset($users) && is_array($users)){ ?>
                                    <?php foreach($users as $user){?>
                                        <tr>
                                        <td><?php echo $user->id;?></td>
                                            <td><?php echo $user->username;?></td>
                                            <td><?php echo $user->password;?></td>
                                     
                                          
                                        </tr>
                                    <?php } ?>
                                <?php } ?>




                                    





                                    </table>

    
        <!-- /.col -->
        
        <div class="col-xs-8">
          <button type="submit" class="btn btn-success btn-block btn-flat"> submit</button>
          
        </div>
        
      </div>
    
    </form>
    
    
  <!--   <a href="register.html" class="text-center">Register a new membership</a>-->
    
  </div>
  <!-- /.login-box-body -->
</div>
</body>
<?php $this->load->view('element/footer');?>